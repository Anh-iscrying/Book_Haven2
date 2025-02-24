@extends('layouts.app') {{-- Giả sử bạn có một layout chung --}}

@section('content')
    <div class="container">
        <h1>Hỗ trợ khách hàng</h1>

        <div class="support-request">
            <h2>Gửi yêu cầu hỗ trợ</h2>
            <form id="supportForm">
                <input type="text" id="customerName" placeholder="Tên khách hàng" required>
                <input type="email" id="customerEmail" placeholder="Email" required>
                <textarea id="supportMessage" placeholder="Nội dung yêu cầu hỗ trợ" required></textarea>
                <button type="submit">Gửi yêu cầu</button>
            </form>
        </div>

    </div>
@endsection

@section('modal')
    <div id="myModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Giỏ Hàng</h5>
                <span class="close">×</span>
            </div>
            <div class="modal-body">

                <!--Giỏ hàng-->
                <div class="cart-items">

                    <div class="cart-row">

                        <div class="cart-item cart-column">
                            <img class="cart-item-image"
                                src="https://dorahome.info/wp-content/uploads/2022/05/tron-bo-truyen-dai-doremon-24-tap-doc-xuoi-1.jpg">
                            <span class="cart-item-title">Combo Doraemon tập dài</span>
                        </div>
                        <span class="cart-price cart-column">250000đ</span>
                        <div class="cart-quantity cart-column">
                            <input class="cart-quantity-input" type="number" value="1">
                            <button class="btn btn-danger" type="button">Xóa</button>
                        </div>
                    </div>

                    <div class="cart-row">
                        <div class="cart-item cart-column">
                            <img class="cart-item-image" src="https://stbhatay.com.vn/wp-content/uploads/2023/02/sv27.webp">
                            <span class="cart-item-title">Shin cậu bé bút chì tập 27</span>
                        </div>
                        <span class="cart-price cart-column">25000đ</span>
                        <div class="cart-quantity cart-column">
                            <input class="cart-quantity-input" type="number" value="2">
                            <button class="btn btn-danger" type="button">Xóa</button>
                        </div>
                    </div>
                    <div class="cart-total">
                        <strong class="cart-total-title">Tổng Cộng:</strong>
                        <span class="cart-total-price">VNĐ</span>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary close-footer">Đóng</button>
                <button type="button" class="btn btn-primary order">Thanh Toán</button>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('javascript/Hỗ_trợ.js') }}"></script>
    <script>
        const cart = document.getElementById("cart");
        const modal = document.getElementById("myModal");
        const closeModal = document.getElementsByClassName("close")[0];
        const closefooter = document.getElementsByClassName("close-footer")[0];

        cart.onclick = function() {
            modal.style.display = "block";
        }
        closeModal.onclick = function() {
            modal.style.display = "none";
        }
        closefooter.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection