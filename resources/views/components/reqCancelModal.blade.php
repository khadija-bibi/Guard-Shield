<div class="modal fade" id="reqCancelModal{{ $response->request_id }}" tabindex="-1" aria-labelledby="reqCancelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="reqCancelModalLabel">Mark Request as Cancelled</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body text-center">
                <p class="fw-medium text-dark">
                    Are you sure you want to mark this service request as <span class="fw-bold text-success">Cancelled</span>?
                </p>
                <p class="text-muted" style="font-size: 14px;">
                    Once confirmed, status will be updated to <b>CANCELLED</b>.
                </p>

            </div>

            <div class="modal-footer justify-content-center">
                <form action="{{ route('service-request.confirmResponse', ['id' => $response->request_id, 'status' => 'CANCELLED']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success px-4">Yes, Mark as Cancelled</button>
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
