@extends('layout.conquer')

@section('content')
<div class="portlet">
  <div class="portlet-title">
    <div class="caption">
      <i class="fa fa-reorder"></i>Cari Account
    </div>
  </div>
  <div class="portlet-body">

<form action="#" method="get">
    <label for="">Inputkan Nomor Account</label>
    <input type="text" id="search-input" placeholder="Search Account...">
</form>
<div id="search-results"></div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#search-input').on('input', function () {
            let id = $(this).val();
            $.ajax({
                url: '{{ route('getAccount') }}',
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
                headerRow.append('<th>Account Number</th>');
                headerRow.append('<th>Account Name</th>');
                headerRow.append('<th>Balance</th>');

                $.each(data, function (index, account) {
                    let row = $('<tr>').appendTo(tbody);
                    row.append('<td>' + account.account_no + '</td>');
                    row.append('<td>' + account.name + '</td>');
                    row.append('<td>' + account.balance + '</td>');
                });

                resultsContainer.append(table);
            } else {
                resultsContainer.append('<p>No results found</p>');
            }
        }
    });
</script>

@endsection  
