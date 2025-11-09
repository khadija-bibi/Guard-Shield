<div class="modal fade" id="feedbackModal{{ $request->id }}" tabindex="-1" aria-labelledby="feedbackModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title" id="feedbackModalLabel">Feedback</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="{{ route('feedback.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="request_id" value="{{ $request->id }}">
                    <!-- Comment Field -->
                    <div class="mb-3">
                        <label for="comment" class="form-label fw-semibold">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Write your feedback here..." required></textarea>
                    </div>

                    <!-- Rating Field -->
                    <div class="mb-3 text-center">
                        <label class="form-label fw-semibold d-block mb-2">Rating</label>
                        <div class="tabler-stars d-flex justify-content-center gap-2">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" name="rating" id="star{{ $i }}_{{ $request->id }}" value="{{ $i }}" hidden>
                                <label for="star{{ $i }}_{{ $request->id }}" class="star-label" data-value="{{ $i }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-star" width="30" height="30" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ccc" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 17.75l-6.172 3.245l1.179-6.873l-5-4.867l6.9-1l3.093-6.253l3.093 6.253l6.9 1l-5 4.867l1.179 6.873z" />
                                    </svg>
                                </label>
                            @endfor
                        </div>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="submit" class="btn btn-success px-4">Submit</button>
                        <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .tabler-stars .star-label svg {
        transition: stroke 0.2s, fill 0.2s;
        cursor: pointer;
    }
    .tabler-stars .star-label:hover svg,
    .tabler-stars .star-label:hover ~ .star-label svg {
        stroke: #f5b301;
        fill: #f5b301;
    }
    .tabler-stars input:checked ~ .star-label svg {
        stroke: #f5b301;
        fill: #f5b301;
    }
</style>
