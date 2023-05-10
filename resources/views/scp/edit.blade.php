@extends('layouts.app')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }

</style>
@endpush

@section('content')
<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('scp.index') }}">Store Top Up</a></li>
        <li class="breadcrumb-item active" aria-current="page">Create Top Up</li>
    </ol>
</nav>

<div class="row">
    <div class="col-md-12 stretch-card">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="d-flex">
                        <div class="col-sm-10">
                            <h3 class="card-title">Create Top Up</h3>
                            <p class="text-muted">Fill out details to create new Top Up</p>
                        </div>
                        <div class="col-sm-2">
                            <a href="{{ route('scp.index') }}" class="btn btn-md btn-danger">Cancel <span><i
                                        class="fa-solid fa-ban"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ url('/scp/'.$storetopup->id) }}">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="requested_by">Requested By:</label>
                                <input required hidden type="text" class="form-control" value="{{ $storetopup->requested_by }}"
                                    placeholder="Enter Name" id="requested_by" name="requested_by">
                                <input required disabled type="text" class="form-control" value="{{ $storetopup->requested_by }}"
                                    placeholder="Enter Name" id="requested_by" name="requested_by">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="request_id">Request ID</label>
                                <input required hidden type="text" class="form-control" name="request_id"
                                    value="{{ $storetopup->request_id }}" placeholder="Request ID">
                                <input required disabled type="text" class="form-control" name="request_id"
                                    value="{{ $storetopup->request_id }}" placeholder="Request ID">
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="facility_id">Facility</label>
                                <input type="text" name="facility_id" id="" class="form-control"
                                    disabled
                                    @foreach ($facilities as $facility)
                                    @if ( $storetopup->facility_id == $facility->id )
                                    value ="{{ $facility->name }}"
                                    @endif
                                    @endforeach
                                >
                                <input type="text" name="facility_id" id="" class="form-control"
                                    hidden
                                    @foreach ($facilities as $facility)
                                    @if ( $storetopup->facility_id == $facility->id )
                                    value ="{{ $facility->name }}"
                                    @endif
                                    @endforeach
                                >
                            </div>
                        </div><!-- Col -->
                        <div class="col-sm-3">
                            <div class="mb-3">
                                <label class="form-label" for="request_date">Date</label>
                                <input required hidden type="date" class="form-control" value="{{ $storetopup->request_date }}"
                                    name="request_date" placeholder="Enter Date">
                                <input required disabled type="date" class="form-control" value="{{ $storetopup->request_date }}"
                                    name="request_date" placeholder="Enter Date">
                            </div>
                        </div><!-- Col -->
                    </div><!-- Row -->

                    <div class="row">
                        <div class="col-md-12 stretch-card">
                            <div class="card">

                                <div class="card-body">

                                    <h6 class="card-title">Top Up Table</h6>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="dataTableExample">
                                            <thead>
                                                <tr>
                                                    <th class="pt-0">#</th>
                                                    <th class="pt-0">Product Name</th>
                                                    <th class="pt-0">Strength</th>
                                                    <th class="pt-0">Unit of Issue</th>
                                                    <th class="pt-0">Unit Size</th>
                                                    <th class="pt-0">Available Units</th>
                                                    <th class="pt-0">Requested Units</th>
                                                    <th class="pt-0">Allocated Units</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $number = 1; ?>
                                                @foreach ($storetopupDetails as $storetopupDetail)
                                                    <tr>
                                                        <td>{{ $number }}</td>
                                                        <?php $number++; ?>
    
                                                        <td>
                                                            <div class="form-group hidden">
                                                                <input hidden type="text" name="product_name[]"
                                                                    value="{{ $storetopupDetail->product_name }}"
                                                                    class="form-control">
                                                            </div>
                                                            @foreach ($products as $product)
                                                            @if ( $storetopupDetail->product_name == $product->id)
                                                            {{ $product->product_name }}
                                                            @endif
                                                            @endforeach
                                                        </td>    
    
                                                        <td>
                                                            <div class="form-group hidden">
                                                                <input hidden type="text" name="strength[]"
                                                                    value="{{ $storetopupDetail->strength }}"
                                                                    class="form-control">
                                                            </div>
                                                            {{ $storetopupDetail->strength }}
                                                        </td>
    
                                                        <td>
                                                            <div class="form-group hidden">
                                                                <input hidden type="text" name="unit_of_issue[]"
                                                                    value="{{ $storetopupDetail->unit_of_issue }}"
                                                                    class="form-control">
                                                            </div>
                                                            {{ $storetopupDetail->unit_of_issue }}
                                                        </td>
    
                                                        <td>
                                                            <div class="form-group hidden">
                                                                <input hidden type="text" name="unit_size[]"
                                                                    value="{{ $storetopupDetail->unit_size }}"
                                                                    class="form-control">
                                                            </div>
                                                            {{ $storetopupDetail->unit_size }}
                                                        </td>
    
                                                        <td>
                                                            <div class="form-group hidden">
                                                                <input hidden type="text" name="available_units[]"
                                                                    value="{{ $storetopupDetail->available_units }}"
                                                                    class="form-control">
                                                            </div>
                                                            {{ $storetopupDetail->available_units }}
                                                        </td>
    
                                                        <td>
                                                            <div class="form-group">
                                                                <input hidden type="text" name="requested_units[]"
                                                                    value="{{ $storetopupDetail->requested_units }}"
                                                                    class="form-control">
                                                            </div>
                                                            {{ $storetopupDetail->requested_units }}
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" name="allocated_units[]"
                                                                    class="form-control">
                                                            </div>
                                                        </td>
                                                    </tr>                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary submit">Submit form</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@push('plugin-scripts')
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
<script>
    $(document).ready(function () {
        $('#dataTableExample').DataTable();
    });

</script>

@endpush
