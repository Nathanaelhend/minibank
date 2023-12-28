@extends('layout.conquer')

@section('content')
<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Cari Transaksi
    </div>
  </div>
  <div class="portlet-body">
    <!-- resources/views/search.blade.php -->


<!-- resources/views/search.blade.php -->
<!-- resources/views/search-account.blade.php -->
<form action="#" method="get">
    <label for="">Inputkan Transaction Number</label>
    <input type="text" id="search-input" placeholder="Search Transaction...">
</form>
<div id="search-results"></div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search-input').on('input', function () {
            let id = $(this).val();
            $.ajax({
                url: '{{ route('getTransaction') }}',
                type: 'GET',
                data: { id : id },
                success: function (data) {
                    displayResults(data);
                },
            });
        });

        function displayResults(data) {
            console.log(data);
            let resultsContainer = $('#search-results');
            resultsContainer.empty();

            if (data.length > 0) {
                let table = $('<table>').addClass('table');
                let thead = $('<thead>').appendTo(table);
                let tbody = $('<tbody>').appendTo(table);

                let headerRow = $('<tr>').appendTo(thead);
                headerRow.append('<th>Transaction Number</th>');
                headerRow.append('<th>Credit Number</th>');
                headerRow.append('<th>Debit Number</th>');
                headerRow.append('<th>Amount</th>');
                headerRow.append('<th>Transaction Date</th>');
                
                $.each(data, function (index, transaction) {
                    let row = $('<tr>').appendTo(tbody);
                    row.append('<td>' + transaction.transaction_id + '</td>');
                    row.append('<td>' + transaction.credit_account + '</td>');
                    row.append('<td>' + transaction.debit_account + '</td>');
                    row.append('<td>' + transaction.amount + '</td>');
                    row.append('<td>' + transaction.created_at + '</td>');

                });

                resultsContainer.append(table);
            } else {
                resultsContainer.append('<p>No results found</p>');
            }
        }
    });
</script>

@endsection  
