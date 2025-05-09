<div class="modal fade" id="freezeModal" tabindex="-1" aria-labelledby="freezeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="freezeModalLabel">
                    {{ $company->is_freeze ? 'Unfreeze Company' : 'Freeze Company' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure that you want to {{ $company->is_freeze ? 'unfreeze' : 'freeze' }} this company?
            </div>
            <div class="modal-footer">
                <form action="{{ route('companies.freeze', $company->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="is_freeze" value="{{ $company->is_freeze ? 0 : 1 }}">
                    <button type="submit" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </form>
            </div>
        </div>
    </div>
</div>
