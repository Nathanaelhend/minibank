@extends('layout.conquer')

@section('content')
<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Daftar Transaksi
    </div>
  </div>
  <div class="portlet-body">

    <table class="table">
      <thead>
        <tr>
          <th>Transaction Number</th>
          <th>Credit Number</th>
          <th>Debit Number</th>
          <th>Amount</th>
          <th>Transaction Date</th>
        </tr>
      </thead>
      <tbody>
        @foreach($listTransaction as $t)
          <tr>
            <td>{{ $t->transaction_id}}</td>
            <td>{{ $t->credit_account}}</td>
            <td>{{ $t->debit_account }}</td> 
            <td>{{ $t->amount }}</td>
            <td>{{ $t->created_at }}</td>
            
          </tr>
        @endforeach
      </tbody>
    </table>
@endsection  
