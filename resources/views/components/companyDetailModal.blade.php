<div class="modal fade" id="companyDetailModal{{ $company->id }}" tabindex="-1" aria-labelledby="companyDetailModalLabel{{ $company->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
            <div class="modal-header">
                <h5 class="modal-title" id="companyDetailModalLabel{{ $company->id }}">Company Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p><strong>Name:</strong> {{ $company->name }}</p>
                <p><strong>Email:</strong> {{ $company->email ?? 'N/A' }}</p>
                <p><strong>Description:</strong> {{ $company->description ?? 'No description available.' }}</p>
                <p><strong>Address:</strong> {{ $company->address ?? 'Not provided' }}</p>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
