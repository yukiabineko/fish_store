@extends('admin.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin/form.css')}}">
@endsection

@section('js')
    <script src="{{ asset('js/admin/form.js')}}"></script>
@endsection

@section('contents')
   <div class="page-title">
      <h3>商品登録</h3>
   </div>
   @include('admin.product.form',['edit' => false])
   
@endsection