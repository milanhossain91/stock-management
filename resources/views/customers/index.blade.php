@extends('layouts.app')

@section('title', 'Customers')

<style>
    .page-item .page-link {
        color: #343a40;
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        margin: 0 2px;
        transition: all 0.3s ease;
    }

    .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
        box-shadow: 0 2px 6px rgba(0, 123, 255, 0.3);
    }

    .page-item .page-link:hover {
        background-color: #e2e6ea;
    }
</style>

@section('actions')
    <a href="{{ route('customers.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg"></i> Add Customer
    </a>
@endsection

@section('content')
<div class="col-md-8 mb-3">
    <input type="text" id="liveSearch" class="form-control" placeholder="Search by name...">
</div>

<div class="table-responsive" id="productTable">
    @include('customers.table')
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#liveSearch').on('keyup', function() {
            let query = $(this).val();
            $.ajax({
                url: "{{ route('customers.search') }}",
                type: "GET",
                data: { search: query },
                success: function(data) {
                    $('#productTable').html(data);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });

        // $(document).on('click', '.pagination a', function(e) {
        //     e.preventDefault();
        //     let url = $(this).attr('href');
        //     $.get(url, function(data) {
        //         $('#productTable').html(data);
        //     });
        // });
    });
</script>