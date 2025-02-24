@extends('layouts.app')  {{-- Giả sử bạn có layout app.blade.php --}}

@section('content')
<div class="container">
    <h1>Quản lý đơn hàng</h1>
    <div id="order-list">
        <!-- Danh sách đơn hàng sẽ được hiển thị ở đây -->
    </div>
    <div id="order-details" class="hidden">
        <!-- Chi tiết đơn hàng sẽ hiển thị ở đây -->
    </div>
</div>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/QLTD.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('javascript/QLTD.js') }}"></script>
@endsection