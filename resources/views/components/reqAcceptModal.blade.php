<div class="modal fade" id="reqAcceptModal{{ $request->id }}" tabindex="-1" aria-labelledby="reqAcceptModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Accept Service Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to accept this service request?
            </div>
            <div class="modal-footer">
                <form action="{{ route('service-request.verify', ['id' => $request->id, 'status' => 'approved']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>