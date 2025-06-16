<div>
  <form wire:submit="login">
    <div>
      <label for="username">Username</label>
      <input type="username" id="username" wire:model="username" placeholder="Username">
      @error('username')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <div>
      <label for="password">Password</label>
      <input type="password" id="password" wire:model="password" placeholder="Password">
      @error('password')
        <span class="text-red-500">{{ $message }}</span>
      @enderror
    </div>

    <button type="submit">Login</button>
  </form>
</div>
