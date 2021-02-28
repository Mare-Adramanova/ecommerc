@extends('layouts.main')
@section('extra-css')
<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#color').change(function(){
            var color = $('#color').val();
            var prodId = $('#prodId').val();
           
            $.ajax({
                type: 'get',
                dataType: 'html',
                url: "{{ route('get_by_color') }}",
                data: "color=" + color + "& prodId=" + prodId,
                
                success: function(data) {
                   
                    $('#size').append(data);
                    
                     console.log(data);
                }   
                        
            });
        });
    })
    
</script>  
    
@endsection
@section('content')

    <div class="container">
        
        <div class="card flex-row flex-wrap border border-secondary">
            <div class="card-header border border-danger">
                <img src="{{ asset('storage/public/'.$product->picture) }}" alt="" class="float-left" style="width: 250px">

            </div>
            <div class="card-block px-2 col-lg-8 border border-danger border-right-0">
                <div class="card-title mt-5 border-bottom">
                    <h4><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h4> 
                </div>
                <div class="text text-danger border-bottom"><h3>{{ $product->presentPrice() }}</h3> </div>
                
                   
                
                <div class="card-text border-bottom mt-3 mb-2">

                    @if ($product->rating > 0 )
                        <div class="product_rating float-left">
                            <span class="rating_icon">
                                        
                                @for($i = 0; $i < $product->rating; $i++)
                            <span class="light">&#9733;</span>
                                @endfor
                                @for($i = 0; $i < 5 - $product->rating; $i++)
                            <span class=" ">&#9733;</span>
                                @endfor
                            </span>
                            <span>{{$product->rating}}.0</span>
                            
                       
                        <a href="viewCart" id="ShowCart"><i class="fa fa-angle-down"></i></a>
                        <table class="table" id="cart">
                            <thead>
                                <tr>
                                  <th>Stars</th>
                                  <th>Progres</th>
                                  <th> % </th>
                                  <th></th>
                                </tr>
                              </thead>
                            <tr>
                            <td><div class="float-left mr-1"><b>5 stars</b></div></td>
                            <td colspan="3"><div class="progress">
                                <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_5 }}; height:8px"></div>
                              </div></td>
                            <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_5 }}</div></td>
                            </tr>
                            <tr>
                                <td><div class="float-left mr-1"><b>4 stars</b></div></td>
                                <td colspan="3"><div class="progress">
                                    <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_4 }}; height:8px"></div>
                                  </div></td>
                                <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_4 }}</div></td>
                            </tr>
                            <tr>
                                <td><div class="float-left mr-1"><b>3 stars</b></div></td>
                                <td colspan="3"><div class="progress">
                                    <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_3 }}; height:8px"></div>
                                  </div></td>
                                <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_3 }}</div></td>
                            </tr>
                            <tr>
                                <td><div class="float-left mr-1"><b>2 stars</b></div></td>
                                <td colspan="3"><div class="progress">
                                    <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_2 }}; height:8px"></div>
                                  </div></td>
                                <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_2 }}</div></td>
                            </tr>
                            <tr>
                                <td><div class="float-left mr-1"><b>1 stars</b></div></td>
                                <td colspan="3"><div class="progress">
                                    <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_1 }}; height:8px"></div>
                                  </div></td>
                                <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_1 }}</div></td>
                            </tr>
                        </table>
                    </div>           
                    @endif
                    <a href="#review" class="text-danger">{{count($product->comments)}} Reviews</a>
                </div>
                <div class="card-text border-bottom">
                    <p>{{ $product->description }}</p>
                </div>
                         
                <form action="{{ route('cart.index', $product->id) }}" method="GET">
                    @csrf
                 <label for="color">Color:</label>  <br> 
                 <select name="color_name" id="color">
                    <option value="">color</option>
                    @foreach ($color_product as $item)
                    <option value="{{ $item->color->id }}">{{ $item->color->name }} </option>
                   @endforeach
                   
                </select> 
                
                <input type="hidden" value="{{ $product->id }}" id="prodId">
               
                <br>
                <label for="size">{{ trans('Size :') }}</label>
                <select name="size_id" id="size" class="form-control" required>
                    <option value="">{{ trans('pleaseSelect') }}</option>
                </select> 
                
                    
                    <input type="submit" class="btn btn-danger border-bottom mt-3 mr-5 mb-3  float-left" value="Add To Cart">
                    <input type="submit" name="saveForLater" class="btn btn-danger border-bottom mt-3 mr-5 mb-3  float-left" value="Save for later">
                </form>
           
                {{-- <a href="{{ route('cart.index', $product->id) }}" class="btn btn-danger border-bottom mt-3" value="Add To Cart">Add To Cart</a> --}}
                {{-- <a href="{{ route('saveForLater.store', $product->id) }}" class="btn btn-danger border-bottom mb-2" value="Save for later">Save for later</a> --}}
                
            </div>
        </div>

        <div class="review-container">
            
            
            <div class="card flex-row flex-wrap border border-secondary">
                <div class="card-header float-left" style="width: 420px" id="review">
                <h3>Customer Reviews ( {{ count($product->comments) }} )</h3>
                <table class="table">
                    <thead>
                        <tr>
                          <th>Stars</th>
                          <th>Progres</th>
                          <th> % </th>
                          <th></th>
                        </tr>
                      </thead>
                    <tr>
                    <td><div class="float-left mr-1"><b>5 stars</b></div></td>
                    <td colspan="3"><div class="progress">
                        <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_5 }}; height:8px"></div>
                      </div></td>
                    <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_5 }}</div></td>
                    </tr>
                    <tr>
                        <td><div class="float-left mr-1"><b>4 stars</b></div></td>
                        <td colspan="3"><div class="progress">
                            <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_4 }}; height:8px"></div>
                          </div></td>
                        <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_4 }}</div></td>
                    </tr>
                    <tr>
                        <td><div class="float-left mr-1"><b>3 stars</b></div></td>
                        <td colspan="3"><div class="progress">
                            <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_3 }}; height:8px"></div>
                          </div></td>
                        <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_3 }}</div></td>
                    </tr>
                    <tr>
                        <td><div class="float-left mr-1"><b>2 stars</b></div></td>
                        <td colspan="3"><div class="progress">
                            <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_2 }}; height:8px"></div>
                          </div></td>
                        <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_2 }}</div></td>
                    </tr>
                    <tr>
                        <td><div class="float-left mr-1"><b>1 stars</b></div></td>
                        <td colspan="3"><div class="progress">
                            <div class="progress-bar mt-1 float-left" style="width:{{ $product->stars_1 }}; height:8px"></div>
                          </div></td>
                        <td> <div class="border border-dark" style="width: 50px">{{ $product->stars_1 }}</div></td>
                    </tr>
                </table>
                
                    @if (count($product->comments) > 0)
                        <ul class="list-group list-group-flush ">
                        
                            @foreach ($product->comments->take(6) as $comment)
                            
                            <li class="list-group-item">
                                <div class="customer-name float-left col-md-5" style="width: 150px">
                                   <dt>{{ Auth::user()->name ?? ""}}</dt>
                                </div>
                                <div class="customer-comment float-left col-md-7">
                                    @if ($comment->rating > 0 )
                                    <div class="product_rating">
                                        <span class="rating_icon">
                                        
                                            @for($i = 0; $i < $comment->rating; $i++)
                                            <span class="light">&#9733;</span>
                                            @endfor
                                            @for($i = 0; $i < 5 - $comment->rating; $i++)
                                            <span class=" ">&#9733;</span>
                                            @endfor
                                        </span>

                                    </div>
                                    
                                    @endif
                                   
                                    {!! htmlspecialchars_decode($comment->text) !!}
                                </div>    
                                
                            </li>
        
                            @endforeach
       
                        </ul> 
                   @else
                         <h3>There is no reviews yet</h3>       
                   @endif

                </div>
                <div class="card-body card-block px-2 col-lg-5 ">
                    <div class="card-text  ratings">
                        <h3>Write Review</h3>
                        <form class="form-group" action="{{ route('comments.store', ['product_id'=>$product->id]) }}" method="POST">
                            @csrf
                            <div class="rating_submit_inner">

                            <label for="radio1" >&#9733;</label>
                            <input id="radio1" type="radio" name="rating" value="5" class="star"/>

                            <label for="radio2">&#9733;</label>
                            <input id="radio2" type="radio" name="rating" value="4" class="star"/>

                            <label for="radio3">&#9733;</label>
                            <input id="radio3" type="radio" name="rating" value="3" class="star"/>

                            <label for="radio4">&#9733;</label>
                            <input id="radio4" type="radio" name="rating" value="2" class="star"/>

                            <label for="radio5">&#9733;</label>
                            <input id="radio5" type="radio" name="rating" value="1" class="star"/>
                            </div>
                            
                            <div class="row">
                    
                                <textarea class="form-control col-md-7 mx-4" name="text" placeholder="write your review" ></textarea>
                            
                                <input type="submit" class="btn btn-primary col-md-3 ">
                                
                                
                    
                            </div>
                            
                            
                        </form>
                    </div> 
                   
                </div>
            </div>
            

        </div>
        <div class="card">
            <h3 class="mt-3 card-header text-danger">People Also Viewed</h3>
            <div class="row mb-5 text-center">
            @if ($category != "")
                
            
                @foreach ($category->products->take(8) as $product)
                <div class="col-3 pt-1 pb-5 card-body ">
                    <div class="card-header">
                    <a href="{{ route('products.show', $product->id) }}"><img src="{{ asset('storage/public/'.$product->picture) }}"  alt="product" style="width: 140px"></a>

                    </div>
                    <div class="card-body">
                        <div class="card-title">
                            <h6><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></h6>
                            <div class="product-price">{{ $product->presentPrice() }}</div>

                        </div>

                    </div>
                    
                </div>
                @endforeach
                @endif    
            </div> 
        </div>
      
        
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $("#color").change(function(){
            $.ajax({
                url: "{{ route('get_by_color') }}?color_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#size').html(data.html);
                }
            });
        });
    </script>
     --}}
    
     
@endsection
{{-- @section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />



    <script type="text/javascript">
        $("#color").change(function(){
            $.ajax({
                url: "{{ route('get_by_color') }}?color_id=" + $(this).val(),
                method: 'GET',
                success: function(data) {
                    $('#size').html(data.html);
                }
            });
        });
    </script>
    
@endsection --}}

<style type="text/css">
    .star {
        display: none;
    }
    .rating_submit_inner {
    display: block;
    direction: rtl;
    unicode-bidi: bidi-override;
   
}
    .ratings label:hover {
        transform: scale(1.35, 1.35);
    }
    .ratings label {
        color: rgb(196, 191, 191);
        transition: transform .15s ease;
        font-size: 25px;
        cursor: pointer;
    }
    
    .ratings label:hover, label:hover ~ label{
        color: darkorange;
        
    }
    .rating_submit_inner .star:checked ~ label{
        color: darkorange;
    }
    span .light{
        color: darkorange;
    }
#cart{
    display:none;
}
#ShowCart:hover + #cart{
    display:block;
}
    
    </style>
    
        
    