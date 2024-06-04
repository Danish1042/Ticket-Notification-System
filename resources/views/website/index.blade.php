@extends('website.layouts.app')

@section('content')
    <div class="card p-3 bg-light text-dark">
        <div class="card-body">
            {{-- <h5 class="card-title">Main Card Title</h5>
            <p class="card-text">Main card content goes here. This is the main container card.</p> --}}
            <div class="card-deck">
                @foreach ($tickets->chunk(3) as $ticketChunk)
                    <div class="row">
                        @foreach ($ticketChunk as $ticket)
                            <div class="col-md-4">
                                <div class="card mb-3 fancy-card" style="border: 1px solid rgb(110, 130, 241);">
                                    <img class="card-img-top" src="{{ asset('images/tickets.jpeg') }}" height="80%"
                                        width="80%" alt="Ticket Image">
                                    <div class="card-body bg-dark text-white">
                                        <h5 class="card-title">{{ substr($ticket->title, 0, 25) }}</h5>
                                        <p class="card-text">{{ substr($ticket->description, 0, 60) }}</p>
                                        @if (auth()->user())
                                            @if (in_array($ticket->id, $userTickets))
                                                <button class="btn btn-info" disabled>Already Taken</button>
                                            @else
                                                <button class="btn btn-primary buy-ticket"
                                                    data-ticket-id="{{ $ticket->id }}">Buy Ticket</button>
                                            @endif
                                        @else
                                            <button class="btn btn-primary buy-ticket"
                                                data-ticket-id="{{ $ticket->id }}">Buy Ticket</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection


<!-- Bootstrap Modal -->
<div class="modal fade" id="buyTicketModal" tabindex="-1" role="dialog" aria-labelledby="buyTicketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="buyTicketModalLabel">Book Me</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="myForm" method="POST" action="{{ route('book-me') }}">
                    @csrf
                    <input type="hidden" class="form-control" id="ticket_id" name="ticket_id" readonly>
                    <div class="mb-3 mt-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" readonly>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Description:</label>
                        <textarea class="form-control" id="description" name="description" readonly></textarea>
                    </div>
                    <div class="mb-3 mt-3">
                        <label for="expiry" class="form-label">Expiry:</label>
                        <input type="text" class="form-control" id="expiry" name="expiry" readonly>
                    </div>
                    <button type="submit" id="submit" class="btn btn-info">Book me</button>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // button submit
        $(document).ready(function() {
            $('#myForm').on('submit', function() {
                $('#submit').prop('disabled', true);
                $('#submit').text(
                'Processing...'); // Optional: Change the button text to indicate processing
            });
        });

        $(document).ready(function() {


            $('.buy-ticket').click(function() {
                var ticketId = $(this).data('ticket-id');
                $.ajax({
                    url: "{{ route('tickets.buy') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        ticket_id: ticketId
                    },
                    success: function(response) {
                        if (response.authenticated) {
                            // Show the Bootstrap modal
                            // console.log(response.modalContent.title);
                            $('#buyTicketModal input[name="ticket_id"]').val(response
                                .modalContent
                                .id);

                            $('#buyTicketModal input[name="title"]').val(response.modalContent
                                .title);
                            // $('#buyTicketModal input[name="description"]').val(response.modalContent.description);
                            $('#buyTicketModal textarea[name="description"]').val(response
                                .modalContent.description);
                            var expiryDate = new Date(response.modalContent.expiry);

                            // Get the parts of the date (year, month, day)
                            var year = expiryDate.getFullYear();
                            var month = ('0' + (expiryDate.getMonth() + 1)).slice(-
                                2); // Adding 1 because getMonth() returns zero-based month
                            var day = ('0' + expiryDate.getDate()).slice(-2);

                            // Construct the date string in "YYYY-MM-DD" format
                            var formattedExpiry = day + '-' + month + '-' + year;

                            // Set the value of the input field
                            $('#buyTicketModal input[name="expiry"]').val(formattedExpiry);
                            // $('#buyTicketModal .modal-body').html(response.ticket);
                            $('#buyTicketModal').modal('show');

                        } else {
                            // Show login message
                            swal("Authentication!",
                                "You need to log in first before you can proceed further.",
                                "info");
                        }
                    },
                    error: function() {
                        alert('An error occurred. Please try again.');
                    }
                });
            });
        });
    </script>
@endpush
