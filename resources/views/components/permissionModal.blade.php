<div class="modal fade" id="roleModal{{ $role->id }}" tabindex="-1" aria-labelledby="roleModalLabel{{ $role->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roleModalLabel{{ $role->id }}">Role Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if($role->permissions->isNotEmpty())
                {{$role -> permissions->pluck('name')->implode(', ')}}
                @else
                    <p>No permissions assigned.</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

