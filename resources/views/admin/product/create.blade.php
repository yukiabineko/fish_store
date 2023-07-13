@extends('admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/form.css')}}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/form.js')}}"></script>
@endsection

@section('contents')
   <div class="page-title">
      <h2>商品登録</h2>
   </div>

   <!-- メインコンテンツ -->
   <article class="page-contents">
     <form action="#" class="product-form" enctype="multipart/form-data" method="POST">
        @csrf
        <div class="form-wrapper">
<!--------------------------------------------------------------------------->
            <!-- 左エリア -->
            <section class="image-forms">
                <h4>商品画像登録</h4>

                <!-- 追加、削除ボタン -->
                <div class="btns">
                    <button type="button" class="plus">+</button>
                    <button type="button" class="minus">-</button>
                </div>

                <!-- ファイル -->
                <div class="files">
                    <div class="file-box">
                        <input type="file" name="file[]" class="file" id="file">
                        <span class="file-text"></span>
                        <label for="file" class="file-label">写真選択</label>
                    </div>
                </div>
            </section>
<!--------------------------------------------------------------------------->
            <!-- 右エリア -->
            <section class="product-forms">
                <h4>商品情報入力</h4>
                <!-- 商品名 -->
                <div class="form-group">
                    <div class="form-title">商品名<span class="status">必須</span></div>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $product->name)}}">
                </div>

                <!-- 価格 -->
                <div class="form-group">
                    <div class="form-title">商品価格<span class="status">必須</span></div>
                    <input type="number" min=1  name="price" class="form-control" value="{{ old('price', $product->price)}}">
                </div>

                <!-- 在庫 -->
                <div class="form-group">
                    <div class="form-title">商品在庫<span class="status">任意</span></div>
                    <input type="number" min=0  name="stock" class="form-control" value="{{ old('stock', $product->stock)}}">
                </div>

                <!-- カテゴリー -->
                <div class="form-group">
                    <div class="form-title">商品カテゴリー<span class="status">必須</span></div>
                    <select name="category" class="form-control">
                        <option value="0" {{ old('title',$product->category) == 0 ? 'selected' : ''}}>日替わり商品</option>
                        <option value="1" {{ old('title',$product->category) == 1 ? 'selected' : ''}}>干物</option>
                        <option value="2" {{ old('title',$product->category) == 2 ? 'selected' : ''}}>うなぎ</option>
                    </select>
                </div>

                <!-- 商品説明ー -->
                <div class="form-group">
                    <div class="form-title">商品説明<span class="status">任意</span></div>
                    <textarea name="info"  cols="30" rows="10" class="form-control textarea">{{ old('info',$product->info)}}</textarea>
                </div>
            </section>
        </div>
        <!-- ボタン -->
        <div class="form-btns">
            <button type="submit">登録</button>
        </div>
     </form>
   </article>

@endsection