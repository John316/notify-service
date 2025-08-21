<!DOCTYPE html>
<html lang="en">
<head>
    <title>Users Status</title>
    <style>
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        form { display: inline; margin: 0; }
        input, select, button { padding: 5px; }
        .success { background-color: #d4edda; padding: 10px; margin-bottom: 15px; border: 1px solid #c3e6cb; }
    </style>
</head>
<body>
<h1>Users Status</h1>

@if(session('success'))
    <div class="success">{{ session('success') }}</div>
@endif

<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Telegram ID</th>
        <th>Subscribed</th>
        <th>Action</th>
        <th>Created At</th>
        <th>Updated At</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <form action="{{ route('users.update', $user) }}" method="POST">
                @csrf
                @method('PUT')
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>
                    <input type="text" name="telegram_id" value="{{ $user->telegram_id }}">
                </td>
                <td>
                    <select name="subscribed">
                        <option value="1" {{ $user->subscribed ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$user->subscribed ? 'selected' : '' }}>No</option>
                    </select>
                </td>
                <td>
                    <button type="submit">Update</button>
                </td>
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
            </form>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
