<div class="modal fade" id="reqPaidModal{{ $request->id }}" tabindex="-1" aria-labelledby="reqPaidModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="reqPaidModalLabel">Mark Request as Paid</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <p class="fw-medium text-dark">
                    Are you sure you want to mark this service request as <span class="fw-bold text-success">Paid</span>?
                </p>
                <p class="text-muted" style="font-size: 14px;">
                    Once confirmed, payment status will be updated to <b>DONE</b>.
                </p>
            </div>

            <div class="modal-footer justify-content-center">
                <form action="{{ route('service-request.verifyPayment', ['id' => $request->id, 'status' => 'DONE']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success px-4">Yes, Mark as Paid</button>
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
