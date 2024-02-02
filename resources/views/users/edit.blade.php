<form method="post" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <input type="text" name="name" value="{{ $user->name }}">
    <input type="email" name="email" value="{{ $user->email }}">
    <!-- Add more input fields as needed -->
    <button type="submit">Update User</button>
</form>
