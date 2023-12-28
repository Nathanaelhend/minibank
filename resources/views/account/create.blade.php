@extends('layout.conquer')

@section('content')
<div class="container">
    <h2>Form Create Account </h2>

    <div class="portlet">
        <div class="portlet-title">
            <div class="caption">   
                <i class="fa fa-reorder"></i> Silahkan Isi Data
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
        
        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        
        <div class="portlet-body form">
            <form role="form" method="POST" action="{{route('accounts.store')}}">
                @csrf
                <div class="form-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" 
                        name="name" placeholder="Isikan Nama Anda">
                        <span class="help-block">
                        *Inputkan Nama</span>
                    </div>

                    <div class="form-group">
                        <label>Input Balance</label>
                        <input type="text" class="form-control" 
                        name="balance" placeholder="Isikan Balance Anda">
                        <span class="help-block">
                        *Inputkan Balance</span>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-default">Cancel</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection    