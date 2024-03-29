@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="my-4 p-3 bg-dark text-white"><h4 class="m-0">Checkout Page</h4></div>
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-product">
                    <h4><a href="{{route('cart')}}" title="Back to cart" class="text-danger"><i class="fas fa-shopping-basket" ></i></a> Your orders</h4>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Book</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Price</th>
                            <th scope="col">Sub Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach(Cart::getContent() as $item)
                        <tr>
                            <td>{{$item->name}}</td>
                            <td>{{$item->qty}}</td>
                            <td>&#8369;{{$item->price}}</td>
                            <td>&#8369;{{$item->getPriceSumWithConditions()}}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="billing-address my-4">
                    <div class="p-3 bg-light my-4"><h4 class="m-0">Billing address</h4></div>

                    <form action="{{route('cart.proceed')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="shipping_name" class="form-control {{$errors->has('shipping_name')? 'is-invalid' : ''}}" value="{{Auth::user()? Auth::user()->name : ''}}" placeholder="Name">

                            @if($errors->has('shipping_name'))
                                <span class="invalid-feedback"><strong>{{$errors->first('shipping_name')}}</strong></span>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" name="mobile_no" class="form-control {{$errors->has('mobile_no') ? 'is-invalid': ''}}" placeholder="Mobile number">

                            @if($errors->has('mobile_no'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('mobile_no')}}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea name="address" class="form-control {{$errors->has('address')? 'is-invalid' : ''}}" placeholder="Shipping Address" cols="30" rows="5"></textarea>
                            @if($errors->has('address'))
                                <span class="invalid-feedback">
                                    <strong>{{$errors->first('address')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="payment-area my-4 py-5 px-3 bg-light">
                            <input type="submit" value="Proceed to payment" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart-summary my-3">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order summary</h4>
                        </div>
                        <div class="card-body">
                            <p>Total products = {{Cart::getContent()->count()}}</p>
                            <p>Product Cost = &#8369;{{Cart::getSubTotal()}}</p>
                            <p>Shipping cost = &#8369;0.00 </p>
                            <p><strong>Total cost = &#8369;{{Cart::getSubTotal()}}</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
