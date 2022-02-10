<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload</title>
</head>

<body>
    <div>
        <form action="{{route('upload.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="mycsv" id="mycsv">
            <input type="submit" value="Upload">
        </form>
    </div>
</body>

</html>
