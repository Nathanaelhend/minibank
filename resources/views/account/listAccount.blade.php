@extends('layout.conquer')

@section('content')
<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Daftar Account
    </div>
  </div>
  <div class="portlet-body">

    @if(session('status'))
        <div class="alert alert-success">
            {{session('status')}}
        </div>
    @endif
    <table class="table">
      <thead>
        <tr>
          <th>Account No</th>
          <th>Name</th>
          <th>Balance</th>
          <th>Date Created</th>
        </tr>
      </thead>
      <tbody>
        @foreach($listAccount as $acc)
          <tr>
            <td>{{ $acc->account_no}}</td>
            <td>{{ $acc->name }}</td>
            <td>{{ $acc->balance }}</td> 
            <td>{{ $acc->created_at }}</td>
            
          </tr>
        @endforeach
      </tbody>
    </table>
@endsection  
