@extends('layouts.app')

@section('title', 'Phân Loại Sản Phẩm')

@section('content')
    <section class="cartegory">
        <div class="container">
            <div class="cartegory-top row">
                <p>Trang chủ <span>→</span>
                <p>Sản phẩm </p><span>→</span>
                <p>{{ $category->category_name }}</p>
                </p>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="cartegory-left">
                    <ul>
                        @foreach($categories as $category)
                            <li class="cartegory-left-li"><a href="{{ route('phanloai', $category->category_id) }}">{{ $category->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>


                <div class="cartegory-right row">
                    <div class="cartegory-right-top-item">
                        <p>{{ $category->category_name }}</p>
                    </div>
                    <div class="cartegory-right-top-item">
                        <button><span>Bộ lọc</span></button>
                    </div>
                    <div class="cartegory-right-top-item">
                        <select name="" id="">
                            <option value="">Sắp xếp</option>
                            <option value="">Từ cao đến thấp</option>
                            <option value="">Từ thấp đến cao</option>
                        </select>
                    </div>

                    <div class="cartegory-right-content row">
                        @foreach($books as $book)
                        <div class="cartegory-right-content-item">
                            <img src="{{ asset('images/' . $book->book_image) }}" alt="{{ $book->book_title }}">
                            <h1>{{ $book->book_title }}</h1>
                            <p>{{ number_format($book->book_original_price, 0, ',', '.') }} <sup>đ</sup></p>
                        </div>
                        @endforeach
                    </div>

                    <div class="cartegory-right-bottom">
                        <div id="pagination">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src=""></script>
@endsection