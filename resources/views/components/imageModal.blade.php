<div class="modal fade" id="imageModal{{ $employee->id }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $employee->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Center + Large modal --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel{{ $employee->id }}">Guard's Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @if($employee->image)
                    <img src="{{ asset('storage/' . $employee->image) }}" 
                         alt="Guard Image" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-width: 60%; height: auto; border-radius: 15px;">
                @else
                    <span class="text-muted">No image</span>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
