@extends('adminlayouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Approved Deal Exchanges</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Approved Deal Exchanges</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>User</th>
                                <th>Item</th>
                                <th>Offered User</th>
                                <th>Offered Item</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedDealExchanges as $exchange)
                            <tr>
                                <td>{{ $exchange->user->name }}</td>
                                <td>{{ $exchange->item->title }}</td>
                                <td>{{ $exchange->offeredUser->name }}</td>
                                <td>{{ $exchange->offeredItem->title }}</td>
                                <td>{{ $exchange->status }}</td>
                                <td>
                                    <!-- زر العرض -->
                                    <a href="{{ route('admindashboard.exchanges.show', $exchange->id) }}" class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
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

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endsection
