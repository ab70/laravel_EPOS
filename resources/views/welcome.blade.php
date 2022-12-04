<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Title of the document</title>
</head>

<body>
    <div class="container">
        <form action="{{route('create-payment')}}" method="post">
            @csrf
            <input type="submit" value="pay now">
        </form>
    </div>
</body>

</html>