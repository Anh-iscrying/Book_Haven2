@extends('layouts.app') {{-- Giả sử bạn có một layout chung --}}

@section('content')
    
        <title>Giỏ hàng</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">  <!-- CSS chung của ứng dụng -->
        <link rel="stylesheet" href="{{ asset('css/Giỏ_hàng.css') }}"> <!-- CSS riêng cho trang giỏ hàng -->
    
    <div class="box_cart">
        <div class="box_cart_item">
            <h1>Giỏ Hàng</h1>
            <table>
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá tiền</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    @php
                        $total_price = 0;
                    @endphp
                    @if (session('cart') && !empty(session('cart')))
                        @foreach (session('cart') as $book_id => $item)
                            @php
                                $item_total = $item['price'] * $item['quantity'];
                                $total_price += $item_total;
                            @endphp
                            <tr data-book-id="{{ $book_id }}">
                                <td><img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['title'] }}"></td>
                                <td>{{ $item['title'] }}</td>
                                <td><input type="number" value="{{ $item['quantity'] }}" min="1"
                                        onchange="updateQuantity(this)"></td>
                                <td class="price" data-price="{{ $item['price'] }}" data-raw-price="{{ $item['price'] }}">{{ number_format($item['price'], 0, ',', '.') }}₫</td>
                                <td><button class="button" onclick="removeItem(this)">Xóa</button></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan='5'>Giỏ hàng trống.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <div class="total">
                Tổng cộng: <span id="total-price">{{ number_format($total_price, 0, ',', '.') }}₫</span>
            </div>

            <div class="note">
                <label for="note">Ghi chú:</label>
                <textarea id="note" rows="4" style="width: 100%;"></textarea>
            </div>

            <a href="{{ route('thanh.toan') }}">
            <button class="button" onclick="checkout()">Thanh toán</button>
            </a>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function updateTotal() {
            let total = 0;
            const rows = document.querySelectorAll('#cart-items tr');
            rows.forEach(row => {
                const quantityInput = row.querySelector('input[type="number"]');
                const priceCell = row.querySelector('.price');
                const unitPrice = parseFloat(priceCell.dataset.rawPrice); // Lấy giá trị từ data-raw-price
                const quantity = quantityInput.value;
                const itemTotal = unitPrice * quantity;
                console.log({quantity, unitPrice, itemTotal})  //debug
                priceCell.innerText = numberWithCommas(itemTotal.toFixed(0)) + '₫';
                total += itemTotal;
            });
            document.getElementById('total-price').innerText = numberWithCommas(total.toFixed(0)) + '₫';
        }

        function removeItem(button) {
            const row = button.closest('tr');
            const bookId = row.dataset.bookId;
            console.log(bookId)  //debug
            fetch("{{ route('giohang.remove') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: `book_id=${bookId}`
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                if (data.success) {
                    row.remove(); // Use row.remove() instead of row.parentNode.removeChild(row)
                    updateTotal();
                } else {
                    alert('Có lỗi xảy ra khi xóa sản phẩm.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi kết nối đến server.');
            });
        }

        function updateQuantity(input) {
            const row = input.closest('tr');
            const bookId = row.dataset.bookId;
            const quantity = input.value;
            fetch("{{ route('giohang.update') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: `book_id=${bookId}&quantity=${quantity}`
            })
            .then(response => response.json()) // Parse the JSON response
            .then(data => {
                if (data.success) {
                    updateTotal();
                } else {
                    alert('Có lỗi xảy ra khi cập nhật số lượng.');
                }
            })
            .catch(error => {
                console.error('Lỗi:', error);
                alert('Có lỗi xảy ra khi kết nối đến server.');
            });
        }

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        function checkout() {
            window.location.href = "{{ route('thanh.toan') }}"; // Chuyển sang trang thanh toán
        }
    </script>
@endsection