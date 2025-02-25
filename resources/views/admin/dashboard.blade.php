
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Admin Dashboard</h1>
    <p>Manage orders below.</p>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-primary">View Orders</a>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add New Product</a>
</div>
@endsection