<form method="post" action="{{ route('users.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password">
    <!-- Add more input fields as needed -->
    <button type="submit">Add User</button>
</form>
