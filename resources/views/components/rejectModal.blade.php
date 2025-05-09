<div class="modal fade" id="rejectModal{{ $company->id }}" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject Company Request</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to reject this company request?
            </div>
            <div class="modal-footer">
                <form action="{{ route('company.verify', ['id' => $company->id, 'status' => 'Reject']) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>