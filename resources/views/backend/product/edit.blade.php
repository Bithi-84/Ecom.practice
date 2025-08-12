@extends('backend.master')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Product</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Edit Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{ url('/admin/product/update/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="form-group">
                                        <label for="name">Product Name*</label>
                                        <input type="text" class="form-control" name ="name" value="{{$product->name}}" id="name"placeholder="Enter Product Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Product Code</label>
                                        <input type="text" class="form-control" name ="sku_code" value="{{$product->sku_code}}" id="sku_code"placeholder="Enter Product Code Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Select Category*</label>
                                        <select name ="cat_id" class="form-control">
                                            <option selected disable>Select Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" @if ($category->id == $product->cat_id)
                                                    selected
                                                @endif>{{ $category->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                      <div class="form-group">
                                        <label for="name">Select SubCategory</label>
                                        <select name ="sub_cat_id" class="form-control">
                                            <option selected disable>Select Category</option>
                                            @foreach ($subCategories as $subcategory)
                                                <option value="{{ $subcategory->id }}"@if ($subcategory->id == $product->sub_cat_id)
                                                    selected
                                                @endif>{{ $subcategory->name }}</option>
                                            @endforeach
                                        </select>

                                      </div>
                                         
                                      <div class="form-group" id="color_fields">
                                        <label for="name">Product Color (optional)</label>
                                        @foreach ($product->color as $singleColor )
                                            <input type="text" class="form-control" name ="color[]" value="{{$singleColor->color_name}}" id="color"placeholder="Enter Product color" >
                                        @endforeach
                                    </div>
                                    <botton type ="botton" class ="btn btn-primary" id ="add_color">Add More</botton>

                                    <div class="form-group" id="size_fields">
                                        <label for="name">Product Size (optional)</label>
                                        @foreach ($product->size as $singleSize )
                                            <input type="text" class="form-control" name ="size[]" value="{{$singleSize->size_name}}" id="size"placeholder="Enter Product size" >
                                        @endforeach
                                    </div>
                                    <botton type ="botton" class ="btn btn-primary" id ="add_size">Add More</botton>

                                      <div class="form-group">
                                        <label for="name">Product Quantity*</label>
                                        <input type="number" class="form-control" name ="qty" value={{$product->qty}} id="qty"placeholder="Enter Product qty Name" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Product Buying price*</label>
                                        <input type="number" class="form-control" name ="buying_price" value="{{$product->buying_price}}" id="buying_price"placeholder="Enter buying price" required>
                                    </div>

                                     <div class="form-group">
                                        <label for="name">Product Regular Price*</label>
                                        <input type="number" class="form-control" name ="regular_price" value="{{$product->regular_price}}" id="regular_price"placeholder="Enter regular price" required>
                                    </div>
                                          
                                     <div class="form-group">
                                        <label for="name">Product Discount Price</label>
                                        <input type="number" class="form-control" name ="discount_price" value="{{$product->discount_price}}" id="discount_price"placeholder="Enter discount price">
                                    </div>

                                     <div class="form-group">
                                        <label for="name">Product Description*</label>
                                        <textarea id="summernote" name="description" class="form-control" required>{{$product->description}}</textarea>
        
                                    </div>

                                      <div class="form-group">
                                        <label for="name">Product Policy*</label>
                                        <textarea id="summernote2" name="policy" class="form-control" required>{{$product->policy}}</textarea>
                
                                      </div>

                                       <div class="form-group">
                                        <label for="name">Select Product Type*</label>
                                        <select name ="product_type" class="form-control">
                                            <option selected disable>Select product type</option>
                                            
                                             <option value="hot" @if ($product->product_type == "hot")
                                                 selected
                                             @endif>Hot Products</option>
                                             <option value="new" @if ($product->product_type =="new")
                                                 selected
                                             @endif>New Arrivals</option>
                                             <option value="regular" @if ($product->product_type == "regular")
                                                 selected
                                             @endif>Regular products</option>
                                             <option value="discount" @if ($product->product_type == "discount")
                                                 selected
                                             @endif>Discount Products</option>
                                           
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile"> Product Image Name*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="image"
                                                    id="image" accept="image/*" >
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        <img src="{{asset('backend/images/product/'.$product->image)}}" height="100" width="100">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputFile"> Gallery Image Name*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="galleryImage[]" multiple
                                                    id="galleryImage" accept="image/*" >
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text">Upload</span>
                                            </div>
                                        </div>
                                        @foreach ($product->galleryImage as $image )
                                            <img src="{{asset('backend/images/galleryImage/'.$image->image)}}" height="100" width="100">
                                        @endforeach
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>





                    </div>

                </div>

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@push('script')
    <script>
        $(function() {
            image.init();
        });
    </script>
<script>
  $(function () {
    // Summernote
    $('#summernote').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

<script>
  $(function () {
    // Summernote
    $('#summernote2').summernote()

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
      mode: "htmlmixed",
      theme: "monokai"
    });
  })
</script>

<script>
    $(document).ready(function()
{
    $("#add_color").click(function()
{
    $("#color_fields").append('<input type="text" class="form-control" name ="color[]" id="color"placeholder="Enter Product color" >')
})
})
        
    
</script>

<script>
    $(document).ready(function()
{
    $("#add_size").click(function()
{
    $("#size_fields").append('<input type="text" class="form-control" name ="size[]" id="size"placeholder="Enter Product size" >')
})
})
        
    
</script>
@endpush
