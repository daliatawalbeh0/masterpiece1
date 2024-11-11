@extends('adminlayouts.app')

@section('content')
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Approved Donations</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Approved Donations</h6>
                </div>
                <div class="table-responsive p-3">
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>

                                <th>User</th>

                                <th>Condition</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($approvedDonations as $donation)
                            <tr>
                                <td>{{ $donation->item ? $donation->item->title : 'N/A' }}</td>
                                <td>{{ $donation->item ? $donation->item->description : 'N/A' }}</td>

                                <td>{{ $donation->donor ? $donation->donor->name : 'N/A' }}</td> <!-- هنا يتم عرض اسم المتبرع -->

                                <td>{{ $donation->item ? $donation->item->condition : 'N/A' }}</td>


                                    <td>
                                        <a href="{{ route('admindashboard.items.approved_donations.show', $donation->id) }}" class="btn btn-info btn-sm" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admindashboard.items.approved_donations.edit', $donation->id) }}" class="btn btn-primary btn-sm" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admindashboard.items.approved_donations.destroy', $donation->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
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
