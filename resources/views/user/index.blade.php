<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif
  <h2>Users</h2>
  <p></p>            
  <table class="table">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Comment</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
        @php $i = 1;    @endphp
        @if(!empty($users))
        @foreach($users as $user)
      <tr>
        <td>{{ $i++ }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->comment }}</td>
        <td>
            <a href="{{ route('users.show',  $user->id) }}" class="btn">View</a>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-default">Edit</a>
            <form action="{{ route('users.destroy',$user->id) }}" method="Post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                </form>
        </td>
      </tr>
      @endforeach
      @endif
      
    </tbody>
  </table>
</div>

</body>
</html>