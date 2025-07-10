@extends('master')

@section('content')
     <section class="return-process-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 m-auto">
                        <form action="" method="POST" class="return-process-form form-group" enctype="multipart/form-data">
                            <div class="text-center">
                                <h3 class="return-process-form-title">Product Return Process</h3>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="name">Name*</label>
                                        <input type="text" name="name" value="" placeholder="Name*" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="phone">Phone</label>
                                        <input type="number" name="phone" value="" placeholder="Phone*" class="form-control" />
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="phone">Email(optional)</label>
                                        <input type="number" name="phone" value="" placeholder="Phone*" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="input-item-wrapper">
                                        <label for="address">Massage*</label>
                                        <textarea name="" rows="6" class="form-control" placeholder="Your Massage" required></textarea>
                                    </div>
                                </div>
                               
                         </div>
                            <div class="return-process-btn-outer">
                                <button type="submit" id="productReturnProcess" class="return-process-btn-inner">
                                   Send Massage
                                </button>
                            </div>
                        </form>                
                    </div>
                </div>
            </div>
        </section>
@endsection