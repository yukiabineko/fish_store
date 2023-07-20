@extends($layout)

@section('css')
  <link rel="stylesheet" href="{{ asset('css/products/show.css')}}">
@endsection

@section('js')
  <script src="{{ asset('js/products/show.js')}}"></script>    
@endsection


<!---------------コンテンツ-------------------------------------->
@section('contents')
    @if ($layout == "admin.app")
      <div class="page-title">
        <h3>{{ $product->name }}詳細</h3>
      </div> 
    @endif

    <!------コンテンツ -->
    <article class="main-contents">
<!--------------------------画面上部---------------------------------------------------------------------------->
      <section class="datas">
        <!--左サイドメイン画像 -->
        <img 
          src="{{ asset('storage/products/products'.$product->id.'/'.$product->thumbnail() )}}" 
          alt="メイン画像" class="main-img">

        <!-- 右サイド -->
        <div class="info">
              <!-- 商品名 -->
              <div class="product-name">
                <h3>{{ $product->name }}</h3>
              </div>

              <!--価格　-->
              <div class="price-contents">
                <span class="price-title">価格</span>
                <div class="price">
                  <span class="quantity">1パック</span>
                  <span class="price-number">{{ $product->tax() }}</span>円(税込)
                </div>
              </div>

            <!--注文数/在庫 -->
            @if (Auth::check() && Auth::user()->admin == 0 && (int)$product->stock > 0)
              <div class="order-contens">
                <span class="oder-title">注文数</span>
                <select  id="select">
                    @for ($i = 0; $i < (int)$product->stock; $i++)
                        <option value="{{ $i}}">{{ $i}}</option>
                    @endfor
                </select>
              </div>
            @else
                <div class="stock">
                  <span class="stock-title">在庫</span>
                  @if ( $product->category == 0)
                     <span class="stock-data">生鮮食品のため店舗へご確認ください。</span> 
                  @else
                    @if ((int)$product->stock != 0)
                      <span class="stock-data"><span class="stock-number">
                        {{ $product->stock  }}
                      </span>個</span>
                    @else
                      <span class="sold-out">売り切れ</span>
                    @endif    
                  @endif
                  
                </div>  
            @endif

            <!-- 商品説明 -->
            <div class="description-contents">
              <div class="description-title">商品説明</div>
              <div class="description-text">{!! nl2br(e($product->info)) !!}</div>
            </div>
            

            <!-- ボタンの分岐 -->
            @if(Auth::check() && Auth::user()->admin == 1)
               <div class="admin-btns">
                <a href="{{ route('admin.products_edit', $product)}}" class="admin-btn edit-button">商品編集</a>
                <form onsubmit="return confirm('削除しますか？')" action="{{ route('admin.products_destroy',$product)}}" class="del-form" method="POST">
                  @csrf
                  @method('delete')
                  <button type="submit" class="admin-btn del-button">削除する</button>
                </form>
               </div>
            @elseif( Auth::check() && Auth::user()-> admin == 0)
               <div class="btns">
                 <button class="btn">買い物かごに入れる</button>
               </div>
            @else
              <div class="btns">
                <a href="{{ route('login')}}" class="btns-button">ログインしてください</a>
              </div>
            @endif
        </div>
      </section>
<!--------------------------画面下部---------------------------------------------------------------------------->
      @if ( count( $product->images()->get()) > 1)
          <section class="images">
            <span class="arrow arrow-left"><<</span>
            <div class="img-wrapper">
            @foreach ($product->images()->get() as $i=>$img)
              @if ($i != 0)
                <img 
                  src="{{ asset('storage/products/products'.$img->product_id.'/'.$img->path)}}" 
                  alt="画像" class="sub-img" id="img-{{$img->id}}"> 
              @endif
            @endforeach
          </div>
          <span class="arrow arrow-right">>></span>
        </section>  
      @endif
    </article>
@endsection