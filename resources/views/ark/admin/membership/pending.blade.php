<x-app-layout>
    <x-slot name="sidebar">
        <x-side-bar></x-side-bar>
    </x-slot>
{{--    <x-slot name="header">--}}
{{--        <x-header></x-header>--}}
{{--    </x-slot>--}}
    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pending Membership Applications</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Applied On</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($applications as $application)
                            <tr>
                                <td>{{ $application->first_name }} {{ $application->family_name }}</td>
                                <td>{{ $application->email }}</td>
                                <td>{{ $application->created_at->format('M d, Y') }}</td>
                                <td>
{{--                                    <a href="{{ route('admin.membership.view', $application->id) }}"--}}
{{--                                       class="btn btn-sm btn-info">--}}
{{--                                        <i class="fas fa-eye"></i> View--}}
{{--                                    </a>--}}
                                    <form action="{{ route('admin.membership.approve', $application->id) }}"
                                          method="POST" style="display: inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fas fa-check"></i> Approve
                                        </button>
                                    </form>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal"
                                            data-target="#rejectModal{{ $application->id }}">
                                        <i class="fas fa-times"></i> Reject
                                    </button>

                                    <!-- Reject Modal -->
                                    <div class="modal fade" id="rejectModal{{ $application->id }}" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Reject Application</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.membership.reject', $application->id) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>Remarks</label>
                                                            <textarea name="remarks" class="form-control" rows="3" required></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Confirm Reject</button>
                                                    </div>
                                                </form>
                                            </div>
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
</x-app-layout>
