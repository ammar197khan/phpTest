
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
  <h2>Update User</h2>
  <form action="{{ route('users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
    {{ csrf_field()}}
    @method('PATCH')
    <input type="text" method>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name"   name="name" value = "{{ $user->name }}">
    </div>
    <div class="form-group">
        <label for="comment">Comment:</label>
        <input type="text" class="form-control" id="comment" placeholder="Enter Comment" name="comment" value = "{{ $user->comment }}">
      </div>
    <div class="form-group">
        <label for="name">Upload Profile:</label>
        <input type="file" class="form-control" id="file"  name="image">
      </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

</body>
</html>
