@extends('layouts.app')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
  <style>
    table {
        border-top-color: rgb(203 213 225);
        border-top-width: 2px;
        border-top-style: solid;
    }

    #delete-btn:hover {
        cursor: pointer;
    }
  </style>
@endpush

@section('content')
<nav class="page-breadcrumb" style="display:flex">
    <ol class="breadcrumb" style="width: 75%">
        <li class="breadcrumb-item"><a href="{{ route('financialYear.index') }}">Financial Year</a></li>
        {{-- <li class="breadcrumb-item active" aria-current="page">Create year</li> --}}
    </ol>
    <div class="create-productManufacturer">
        <a href="{{ route('financialYear.create') }}" class="btn btn-md btn-primary">Create New
            Financial Year
            <span class="ml-2 mt-2 pt-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
                    <path
                        d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z" />
                </svg>
            </span>
        </a>
    </div>
</nav>



@if (session('status'))
<div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
        <use xlink:href="#check-circle-fill" /></svg>
    <p class="text-success">
        {{ session('status') }}
    </p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">Staff Table</h6>
          <p class="text-muted mb-3"></p>
          <div class="table-responsive">
              
            <table id="dataTableExample" class="table table-striped table-bordered">
              <thead style="">
                <tr>
                    <th class="pt-0">#</th>
                    <th class="pt-0">Name</th>
                    <th class="pt-0">Start Date</th>
                    <th class="pt-0">End Date</th>
                    <th>More</th>
                </tr>
              </thead>
              <tbody >
                
                    <?php $number = 1; ?>
                    @foreach ($financialYears as $financialYear)
                    <tr>
                        <td>{{ $number }}</td>
                        <?php $number++; ?>

                        <td>{{ $financialYear->name }}</td>

                        <td>{{ $financialYear->start_date }}</td>

                        <td>{{ $financialYear->end_date }}</td>

                        <td>
                            <div class="row">
                                <div class="d-flex">
                                    <div style="padding-right:10px;">
                                        <a href="{{ url('financialYear/' .$financialYear->id . '/edit') }}"
                                            class="text-success mr-3">
                                            Edit
                                        </a>
                                    </div>
                                    <form action="{{ url('financialYear/'.$financialYear->id) }}" method="post" id="deleteFyear">
                                        @csrf
                                        @method('DELETE')
                                        <p class="text-danger" id="delete-btn" onclick="submitForm()">Delete</p>
                                    </form>
                                </div>
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




@endsection


@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
<script defer>
    $('#dataTableExample').DataTable({
        "aLengthMenu": [
            [10, 30, 50, -1],
            [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
            search: ""
        }
    });

    $('#dataTableExample').each(function() {
        var datatable = $(this);
        // SEARCH - Add the placeholder for Search and Turn this into in-line form control
        var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
        search_input.attr('placeholder', 'Search');
        search_input.removeClass('form-control-sm');
                    // LENGTH - Inline-Form control
        var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
        length_sel.removeClass('form-control-sm');
    });

    function submitForm() {
        $('#deleteFyear').submit();
    }
</script>
@endpush
