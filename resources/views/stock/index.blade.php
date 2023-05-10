@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;

    }
    .mynav{
    display: grid;
    grid-template-columns: 1fr 1fr;
  }

  .cancel{
    display: flex;
    flex-direction: row-reverse;
  }

  .my-td {
    display: grid !important;
    grid-template-columns: 1fr 1fr !important;
    gap: 10px !important;
  }

  #product-delete {
    color: rgb(235, 2, 2);
  }

  #product-delete:hover {
    cursor: pointer;
  }
  </style>
@endpush

@section('content')
<nav class="mynav page-breadcrumb">
  <ol class="breadcrumb" style="flex-none">
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">Products Table</li>
  </ol>

  <div class="cancel">
    <div></div>
    <a href="{{route('products.create')}}"><button class="btn btn-success mb-1 mb-md-0">Add Product</button></a>
  </div>
</nav>

<div class="row">

  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Products Table</h6>
        <div class="table-responsive">
          <table id="dataTableExample" class="table table-bordered table-striped mt-3">
            <thead>
              <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Manufacturers</th>
                <th>Strength</th>
                <th>Unit of Measure</th>
                <th>Package Size</th>
                <th>Package Quantity</th>
                <th>Items in Box</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
                <?php $number = 1; ?>
                                    
                @foreach ($products->stocks as $product)
                <tr>
                    <td>{{ $number }}</td>
                    <?php $number++; ?>
                    <td>{{ count($product->stocks) }}</td>
                    
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script defer>
    
    var del = document.getElementById('product-delete');
    var frm = document.getElementById('frm');
    del.addEventListener("click",function (e) {
        frm.submit();
    })
    
  </script>
@endpush