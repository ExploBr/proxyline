@extends('layouts.admin')
@section('content')


   <div id="app">
      <admin-main-component :user = '@json(session('token'))'></admin-main-component>
   </div>


@endsection