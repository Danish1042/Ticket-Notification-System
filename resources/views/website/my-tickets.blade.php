@extends('website.layouts.app')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@section('content')
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2500
            });
        </script>
    @endif
    <div class="container mt-3">
        <div class="card" style="height: 470px;">
            <div class="card-body">
                <div class="row justify-content-center mt-10">
                    <div class="col-md-12">
                        <div class="table-responsive" style="max-height: 450px; overflow-y: auto;">
                            <table class="table table-striped table-hover table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Ticket No</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th colspan="2" align="center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tickets">
                                    @if ($tickets->count() > 0)
                                    
                                        @foreach ($tickets as $ticket)
                                            <tr id="ticket-row-{{ $ticket->id }}">
                                                <th scope="row">{{ $ticket->id }}</th>
                                                <td>{{ $ticket->title }}</td>
                                                <td>{{ $ticket->description }}</td>
                                                <td>{{ $ticket->getStatus() }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm delete-user-ticket"
                                                        data-ticket-id="{{ $ticket->id }}">Remove</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5">No Ticket Added</td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            $('.delete-user-ticket').click(function() {
                var ticketId = $(this).data('ticket-id');
                var row = $('#ticket-row-' + ticketId);

                Swal.fire({
                    title: "Are you sure?",
                    text: "Once deleted, you will Loose your ticket",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ url('distroy-tickets') }}/" + ticketId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(response) {
                                if (response.success) {
                                    row.remove();
                                    Swal.fire(
                                        'Deleted!',
                                        'User-tickets association has been removed.',
                                        'success'
                                    );
                                } else {
                                    Swal.fire(
                                        'Failed!',
                                        'Failed to remove user-tickets association.',
                                        'error'
                                    );
                                }
                            },
                            error: function() {
                                Swal.fire(
                                    'Error!',
                                    'An error occurred. Please try again.',
                                    'error'
                                );
                            }
                        });
                    } else {
                        Swal.fire(
                            'Cancelled',
                            'User-tickets association is safe :)',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endpush
