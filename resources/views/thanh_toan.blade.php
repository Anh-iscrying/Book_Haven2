<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Thanh_toán.css') }}">
    <title>Thông tin giao hàng</title>
</head>
<body>
    <header>
        <div class="header">
            <a href="{{ route('giohang') }}"><</a>
        </div>
    </header>

    <div class="container">
        <h1>Thông tin giao hàng</h1>
        <form id="order-form" method="POST" action="{{ route('thanh.toan.process') }}" enctype="multipart/form-data">
            @csrf

            <label for="name">Họ và tên:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            @error('email')
                <div class="error" id="email-error" style="color: red;">{{ $message }}</div>
            @enderror

            <label for="address">Địa chỉ:</label>
            <input type="text" id="address" name="address" required>

            <label for="phone">Số điện thoại:</label>
            <input type="text" id="phone" name="phone" required>
            @error('phone')
                <div class="error" id="phone-error" style="color: red;">{{ $message }}</div>
            @enderror

            <label for="payment-method">Phương thức thanh toán:</label>
            <select id="payment-method" name="payment_method" required>
                <option value="">Chọn phương thức</option>
                <option value="cod">Thanh toán khi nhận hàng (COD)</option>
                <option value="online">Thanh toán trực tiếp</option>
                <option value="transfer">Chuyển khoản</option>
            </select>

            <div class="shipping-method" id="shipping-method-container" style="display: none;">
                <label for="delivery-method">Phương thức vận chuyển:</label>
                <select id="delivery-method" name="delivery_method">
                    <option value="">Chọn phương thức</option>
                    <option value="standard">Giao hàng tiêu chuẩn</option>
                    <option value="express">Giao hàng nhanh</option>
                </select>
                @error('delivery_method')
                    <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div id="transfer-details" style="display: none;">
                <label for="transfer-note">Thông tin chuyển khoản<br> Vietcombank <br>1234567890 <br> Nguyễn Văn A</label>

                <label for="transfer-receipt">Tải ảnh biên lai chuyển khoản:</label>
                <input type="file" id="transfer-receipt" name="transfer_receipt" accept="image/*">
                @error('transfer_receipt')
                    <div class="error" style="color: red;">{{ $message }}</div>
                @enderror
            </div>

            <div class="product-list">
                <h3>Sản phẩm đã chọn:</h3>
                @if ($cart && !empty($cart))
                    @foreach ($cart as $book_id => $item)
                        <div class="product">
                            <span><img src="{{ asset('images/' . $item['image']) }}" alt=""></span>
                            <span>{{ $item['title'] }}</span>
                            <span>{{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}₫</span>
                        </div>
                    @endforeach
                @else
                    <p>Giỏ hàng trống.</p>
                @endif
            </div>

            <div class="total">
                Tổng cộng: <span id="total-amount">{{ number_format($total_price, 0, ',', '.') }}₫</span>
            </div>

            <button type="submit" class="button">Hoàn tất đơn hàng</button>
        </form>
    </div>

    <script>
        const paymentMethodSelect = document.getElementById('payment-method');
        const shippingMethodContainer = document.getElementById('shipping-method-container');
        const transferDetails = document.getElementById('transfer-details');
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phone-error');

        paymentMethodSelect.addEventListener('change', function() {
            if (this.value === 'online') {
                shippingMethodContainer.style.display = 'none';
                transferDetails.style.display = 'none';
            } else if (this.value === 'transfer') {
                shippingMethodContainer.style.display = 'block';
                transferDetails.style.display = 'block';
            } else {
                shippingMethodContainer.style.display = 'block';
                transferDetails.style.display = 'none';
            }
        });

        document.getElementById('order-form').addEventListener('submit', function(event) {
            let isValid = true;
            //Kiểm tra số điện thoại
            const phoneRegex = /^0\d{9}$/;
            if (!phoneRegex.test(phoneInput.value)) {
                phoneError.style.display = 'block';
                isValid = false;
            } else {
                phoneError.style.display = 'none';
            }
        
            //Kiểm tra email
            const emailRegex = /^[a-zA-Z0-9._%+-]+@gmail\.com$/;
            if (!emailRegex.test(emailInput.value)) {
                emailError.style.display = 'block';
                isValid = false;
            } else {
                emailError.style.display = 'none';
            }

             if (!isValid) {
                event.preventDefault(); // Prevent form submission
             }
        });
    </script>
</body>
</html>