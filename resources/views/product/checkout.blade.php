@extends('layouts.main')


@section('stripe-css')

<style>
  .StripeElement {
    width: 100%;
     background-color: white;
     padding: 8px 12px;
     border-radius: 4px;
     border: 1px solid transparent;
     box-shadow: 0 1px 3px 0 #e6ebf1;
    -webkit-transition: box-shadow 150ms ease;
    transition: box-shadow 150ms ease;
 }

 .StripeElement--focus {
     box-shadow: 0 1px 3px 0 #cfd7df;
 }

 .StripeElement--invalid {
     border-color: #fa755a;
 }

 .StripeElement--webkit-autofill {
     background-color: #fefde5 !important;
 }

 #card-errors{
   color: #fa755a;
 }
</style>
    
@endsection
@section('extra-css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>

@endsection

@section('content')
<div class="container">
  @include('flash-message')
    
    <h1 class="checkout-heading mt-5 border-top border-bottom border-secondary pt-2" style="border-top-width: 2px !important; border-bottom-width: 2px !important">Checkout</h1>
    
    <div class="row">    
        <div class="col-lg-7 billing-section">
          <div class="panel-body">
            {{-- @if (Session::has('success'))  
                <div class="alert alert-success text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('success') }}</p>
                </div>
            @else
                <div class="alert alert-danger text-center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                <p>{{ Session::get('error') }}</p>
                </div>

             @endif  --}}
          
            <form 
                action="{{ route('checkout.post') }}"
                method="post"
                class="require-validation"
                data-cc-on-file="false"
                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                id="payment-form">
                @csrf
                <h2 class="mt-3 mb-3" style="font-size: 20px"><b>Billing Details</b></h2>
                <div class="form-group">
                    <label for="" class="mb-0"><b>Email Address</b></label>
                    <input type="text" name="email" class="form-control" id="email" value="{{ old('email') }}" required>
                    @error('email')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="" class="mb-0"><b>Name</b></label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
                    @error('name')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="" class="mb-0"><b>Address</b></label>
                    <input type="text" name="address" id="address" placeholder="" class="form-control" value="{{ old('address') }}" required>
                    @error('address')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <div class="form-group">
                    <label for="" class="mb-0"><b>City</b></label>
                    <input type="text" name="city" id="city" placeholder="" class="form-control" value="{{ old('city') }}" required>
                    @error('city')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <div class="form-group col-md-6 pl-0 float-left">
                    <label for="" class="mb-0"><b>Postal Code</b></label>
                    <input type="text" id="postalcode" name="postalcode" placeholder="" class="form-control" value="{{ old('postalcode') }}" required>
                    @error('postalcode')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <div class="form-group col-md-6 pr-0 float-left">
                    <label for="" class="mb-0"><b>Phone</b></label>
                    <input type="number" id="phone" name="phone" placeholder="" class="form-control" value="{{ old('phone') }}" required>
                    @error('phone')
                    <p class="alert alert-danger">{{ $message ?? ''}}</p> 
                    @enderror
                </div> 
                <h2 class="mt-3 mb-3" style="font-size: 20px"><b>Payment Details</b></h2>

                    <div class="form-group">
                        <label for="name_on_card" class="mb-0"><b>Name on Card</b></label>
                        <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="{{ old('name_on_card') }}" required>
                    </div>
                   
                    <div class="form-row ml-1">
                      <label for="card-element"><b>Credit or debit card</b></label>
                     <div id="card-element"></div>
                     <div id="card-errors" role="alert"></div>
                  </div>
                 

                    <button type="submit" class="btn btn-success form-control mb-5">Complete Order</button>

            </form>
          </div>
        </div>
        <div class="col-lg-5 order-section">
            <h2 class="mt-3 mb-3" style="font-size: 20px"><b>Your Order</b></h2>
                {{-- {{ dd(session()->get('cart')) }} --}}
                <table class="table table-hover table-condensed">
                    <thead>
                        <th style="width:23%"></th>
                        <th></th>
                        <th></th>
                        <th></th>

                    </thead>
                    <tbody>
                      @if (session()->get('cart'))
                          
                        <?php $total = 0 ?>
                        @foreach ($cart as $key => $value)
                        <?php $total += $cart[$key]['price'] * $cart[$key]['quantity'] ?>
                          <tr>
                              <td><img src="{{ asset('storage/public/'.$cart[$key]['picture']) }}" width="100%"/></td>
                              <td colspan="2" style="font-size: 14px">{{ $cart[$key]['name'] }}<br><br>
                                                                      ${{ $cart[$key]['price'] }} ,00</td>
                              <td><div class="ml-4 mt-4 border pl-3">{{ $cart[$key]['quantity'] }}</div></td>
                          </tr>
                                              
                          @endforeach
                        
                        </tbody>
                        <tfoot>
                        
                            <tr>
                                <td><b>Total :</b></td>
                                <td colspan="2"></td>
                                <td class="text-center"><strong>${{ $total }},00</strong></td>
                            </tr>
                        @else
                          <h3>Your cart is empty!</h3>    
                        @endif
                        @if (session()->has('coupon'))
                            
                          <tr>
                              <td><b>Discount:</b> </td>
                              <td><b>({{ session()->get('coupon')['name'] }})</b></td>
                              <td>
                                <form action="{{ route('coupon.delete') }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit">Remove</button>
                                </form>
                              </td>
                              <td class="text-center"><strong>-{{ $discount }}$</strong></td>
                          </tr>
                        
                          <tr>
                            <td colspan="2"><b>New Total :</b></td>
                            <td></td>
                                
                            <td class="text-center"><strong>${{ $newTotal }},00</strong></td>
                        </tr>
                      @endif

                    </tfoot>
                    
                </table>
                @if (!session()->has('coupon'))
                    <a href="#" style="color: black"><b>Have a Code?</b></a>
                    <div class="code-container border border-dark">
                    <form action="{{ route('coupon.store') }}" method="POST">
                        @csrf
                        <input type="text" name="coupon_code" class="ml-2 mt-2" style="height: 37px; width: 80%">
                        <button type="submit" class="btn btn-primary border border-dark ml-0 ">Apply</button>
                      </form>
                    </div>
                @endif    

        </div>
    </div> 
</div>

<script type="text/javascript">
jQuery(document).ready(function() {
  // Create a Stripe client
  var stripe = Stripe('pk_test_51Hj7S4HAyKRbFRW8aodjssAU2voiFCUvERptNeB21rQpcyWOIlMPhbZrQTLMg2TRA3A3NaVlK74k3WqnSqzWHusO00zxqZIoFD');

  // Create an instance of Elements
  var elements = stripe.elements();

  // Custom styling can be passed to options when creating an Element.
  // (Note that this demo uses a wider set of styles than the guide below.)
  var style = {
      base: {
          color: '#32325d',
          lineHeight: '24px',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
             color: '#aab7c4'
          }
     },
     invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
     }
};

// Create an instance of the card Element
var card = elements.create('card', {
  style: style,
  hidePostalCode: true

  });

// Add an instance of the card Element into the `card-element` <div>
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.addEventListener('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
      displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
    event.preventDefault();

    var options = {
      name: document.getElementById('name_on_card').value,
      address_line1: document.getElementById('address').value,
      address_city: document.getElementById('city').value,
      address_zip: document.getElementById('postalcode').value
    }

    stripe.createToken(card, options).then(function(result) {
    if (result.error) {
        // Inform the user if there was an error
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
    } else {
       // Send the token to your server
       stripeTokenHandler(result.token);
    }
 });
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
})
</script>
    
@endsection

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" ></script>



<style type="text/css">

.StripeElement {
  box-sizing: border-box;

  height: 40px;

  padding: 10px 12px;

  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;

  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}

.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}

.StripeElement--invalid {
  border-color: #fa755a;
}

.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;
}

</style>


 