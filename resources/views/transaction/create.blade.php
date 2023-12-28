@extends('layout.conquer')

@section('content')
<div class="container">
    <h2>Form Create Account </h2>

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">   
                <i class="fa fa-reorder"></i> Silahkan Isi Data Transaksi
            </div>
            <div class="tools">
                <a href="" class="collapse"></a>
            </div>
        </div>

        @if(session('status'))
                    <div class="alert alert-danger">
                        {{session('status')}}
                    </div>
        @endif
        
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('transactions.store')}}">
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label>Credit Number</label>
                        <input type="text" class="form-control" 
                        name="credit_account" placeholder="Isikan Credit Number">
                    </div>

                    <div class="form-group">
                        <label>Debit Number</label>
                        <input type="text" class="form-control" 
                        name="debit_account" placeholder="Isikan Debit Number">
                    </div>

                    <div class="form-group">
                        <label>Input Nominal</label>
                        <input type="text" class="form-control" 
                        name="amount" placeholder="Isikan Nominal">
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-info">Transfer</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection    