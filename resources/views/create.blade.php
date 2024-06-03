@extends('layouts.app')
@section('content')
@if(session()->has('success'))
<div class="alert alert-success">
    {{session()->get('success')}}
</div>
@endif
<a class="text-light" href="{{route('orders.index')}}">Back to List</a>
<div class="card">
    <div class="card-body">
        <p style="font-size:20px; font-weight:bold;">Create Order</p>

        <form action="{{route('orders.store')}}" class="was-validated" method="POST">
           
            @csrf
            <div class="form-group has-validation">
                <label for="name">Product Name</label>
                <input type="text" name="p_name" id="p_name" class="form-control" value="" required> 
                @if($errors->has('p_name'))
                    <span class="invalid-feedback">
                        <strong>{{$errors->first('p_name')}}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-validation">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="" required>
                @if($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{$errors->first('email')}}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group has-validation">
                <label for="name">Product Count</label>
                <input type="text" name="order_count" id="order_count" class="form-control" value="" required> 
                @if($errors->has('order_count'))
                    <span class="invalid-feedback">
                        <strong>{{$errors->first('order_count')}}</strong>
                    </span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Create Order</button>
        </form>
    </div>
</div>
@endsection
   