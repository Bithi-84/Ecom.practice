<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\color;
use App\Models\GalleryImage;
use App\Models\Product;
use App\Models\Review;
use App\Models\size;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function productCreate()
    {   $categories = Category::get();
        $subCategories = SubCategory::get();
        return view('backend.product.create',compact('categories','subCategories'));
    }

    public function productStore(Request $request)
    {
        $product = new Product();

         if(isset($request->image)){
         $imageName = rand().'-product-'.'.'.$request->image->extension();
         $request->image->move('backend/images/product',$imageName);
         $product->image = $imageName;
        }

        $product->name = $request->name;
        $product->slug=str::slug ($request->name);
        $product->cat_id= $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sku_code= $request->sku_code;
        $product->buying_price = $request->buying_price;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->qty = $request->qty;
        $product->description= $request->description;
        $product->policy= $request->policy;
        $product->product_type= $request->product_type;
        
        $product->save();

        // add color....
        if(isset($request->color) && $request->color[0] !=null){
           
            foreach ($request->color as $color_name){
            $color = new color();
            $color-> product_id = $product->id;
            $color-> color_name= $color_name;

            $color->save();
        }

    }

          
        // add size....

        if(isset($request->size) && $request->size[0] !=null){
             foreach ($request->size as $size_name){
            $size = new size();
            $size-> product_id = $product->id;
            $size-> size_name= $size_name;

            $size->save();
        }
        }


        // GalleryImage....

        if (isset($request->galleryImage)){
            foreach($request->galleryImage as $image){
                $galleryImage = new GalleryImage();

                $galleryImage->product_id = $product->id;

                 $imageName = rand().'-galleryImage-'.'.'.$image->extension();
                 $image->move('backend/images/galleryImage',$imageName);
                 
                 $galleryImage->image = $imageName;

                 $galleryImage->save();
            }
        }
       

        return redirect()->back();
    }

    public function productList()
    {
        $products = Product::orderBy('id','desc')->with('category','subCategory')->get();
        //  dd($products);
        return view('backend.product.list',compact('products'));
    }


    public function productDelete($id)
    {
        $product = Product::find($id);
        $colors = color::where('product_id', $product->id)->get();
        
        // dd($color);
        $sizes = size:: where('product_id', $product->id)->get();
        $reviews = Review:: where('product_id', $product->id)->get();
        $galleryImages = GalleryImage:: where('product_id', $product->id)->get();

        if($product->image && file_exists('backend/images/product/'.$product->image))
         
       { unlink('backend/images/product/'.$product->image);
      
      }

        $product->delete();

        // Color Delete

        if($colors->isNotEmpty()){
           
            foreach($colors as $color){
                $color->delete();
            }
        }

        // size Delete

        if($sizes->isNotEmpty()){
           
            foreach($sizes as $size){
                $size->delete();
            }
        }

         // reviews Delete

        if($reviews->isNotEmpty()){
           
            foreach($reviews as $review){
                $review->delete();
            }
        }

         // size Delete

        if($galleryImages->isNotEmpty()){
           
            foreach($galleryImages as $image){
            
                 if($image->image && file_exists('backend/images/galleryImage/'.$image->image))
         
       { unlink('backend/images/galleryImage/'.$image->image);
      
      }

                $image->delete();
            }
        }

        return redirect()->back();
    }

    public function productEdit($id)
{
    $product = Product::where('id',$id)->with('color','size','galleryImage')->first();
    // dd($product);
    $categories = Category::get();
    $subCategories = SubCategory::get();
    return view ('backend.product.edit',compact('product','categories','subCategories'));
}

public function productUpdate(Request $request,$id)
{      

        $product = Product::find($id);

       

      if(isset($request->image)){

       if($product->image && file_exists('backend/images/product/'.$product->image))
         
       { unlink('backend/images/product/'.$product->image);
      
      }

         $imageName = rand().'-product-'.'.'.$request->image->extension();
         $request->image->move('backend/images/product',$imageName);
         $product->image = $imageName;
        }


        if (isset($request->galleryImage)){

            $images = GalleryImage::where('product_id', $product->id)->get();

            if($images->isNotEmpty()){

                 foreach($images as $singleImage){
         
               if($singleImage->image && file_exists('backend/images/galleryImage/'.$singleImage->image))
         
               { unlink('backend/images/galleryImage/'.$singleImage->image);
      
                }

                $singleImage->delete();

      }
         

            }

        
      foreach($request->galleryImage as $image){
                $galleryImage = new GalleryImage();

                $galleryImage->product_id = $product->id;

                 $imageName = rand().'-galleryImage-'.'.'.$image->extension();
                 $image->move('backend/images/galleryImage',$imageName);
                 
                 $galleryImage->image = $imageName;

                 $galleryImage->save();
            }
        }


         // add color....
        if(isset($request->color) && $request->color[0] !=null){
              $colors = color::where('product_id', $product->id)->get();
             if($colors->isNotEmpty()){
           
            foreach($colors as $color){
                $color->delete();
            }
        }
           
            foreach ($request->color as $color_name){
            $color = new color();
            $color-> product_id = $product->id;
            $color-> color_name= $color_name;

            $color->save();
        }
    }


    // add size....

        if(isset($request->size) && $request->size[0] !=null){
             
            $sizes = size:: where('product_id', $product->id)->get();
             if($sizes->isNotEmpty()){
           
            foreach($sizes as $size){
                $size->delete();
            }
        }
             foreach ($request->size as $size_name){
            $size = new size();
            $size-> product_id = $product->id;
            $size-> size_name= $size_name;

            $size->save();
        }
        }

        $product->name = $request->name;
        $product->slug=str::slug ($request->name);
        $product->cat_id= $request->cat_id;
        $product->sub_cat_id = $request->sub_cat_id;
        $product->sku_code= $request->sku_code;
        $product->buying_price = $request->buying_price;
        $product->regular_price = $request->regular_price;
        $product->discount_price = $request->discount_price;
        $product->qty = $request->qty;
        $product->description= $request->description;
        $product->policy= $request->policy;
        $product->product_type= $request->product_type;

        $product->save();
        return redirect()->back();
}

    
}
