<!-- Modal -->
<div wire:ignore.self class="modal fade" id="DataModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
  aria-labelledby="DataModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DataModalLabel">{{ $selected_id ? 'Update User' : 'Create User' }}</h5>
        <button wire:click.prevent="cancel()" type="button" class="btn-close" data-bs-dismiss="modal"
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          @if ($selected_id)
            <input type="hidden" wire:model="selected_id">
          @endif
          <div class="form-group">
            <label for="name"></label>
            <input wire:model.live="name" type="text" class="form-control" id="name" placeholder="Name">
            @error('name')
              <span class="error text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="email"></label>
            <input wire:model.live="email" type="text" class="form-control" id="email" placeholder="Email">
            @error('email')
              <span class="error text-danger">{{ $message }}</span>
            @enderror
          </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Close</button>
        <button type="button" wire:click.prevent="save()"
          class="btn btn-primary">{{ $selected_id ? 'Update' : 'Create' }}</button>
      </div>
    </div>
  </div>
</div>
