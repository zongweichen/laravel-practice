<!-- 指定繼承 layout.master 母模板 --> 


@extends('layout.master') 

<!-- 傳送資料到母模板，並指定變數為 title --> 
@section('title', $title) 

<!-- 傳送資料到母模板，並指定變數為 content -->
@section('content') 

<h1>{{ $title }}</h1> 

<!-- @include('component.socialButton') -->

@include("component.errors")
<form action="/merchandise/{{$merchandise -> id}}/edit" method="post">
    {{ csrf_field() }}
    <label>
        商品名稱：
        <input type="text" name="name" value="{{ old('name', $merchandise->name) }}">
    </label>
    <label>
        商品英文名稱：
        <input type="text" name="name_en" value="{{ old('name', $merchandise->name_en) }}">
    </label>
    <label>
        商品介紹：
        <input type="text" name="introduction" value="{{ old('name', $merchandise->introduction) }}">
    </label>
    <label>
        商品英文介紹：
        <input type="text" name="introduction_en" value="{{ old('name', $merchandise->introduction_en) }}">
    </label>
    <label>
        商品照片：
        <input type="text" name="photo" value="{{ old('name', $merchandise->photo) }}">
    </label>
    <label>
        商品價格：
        <input type="text" name="price" value="{{ old('name', $merchandise->price) }}">
    </label>
    <label>
        商品剩餘數量：
        <input type="text" name="remain_count" value="{{ old('name', $merchandise->remain_count) }}">
    </label>
    <button type="submit">更新</button>




    
</form>
@endsection 



