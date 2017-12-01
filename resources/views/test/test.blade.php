<html>
<head></head>
<body>
<form method="POST" action="/files">
    {{csrf_field()}}
    <input type="file" name="file">
    <button type="submit">summit</button>


</form>




</body>
</html>