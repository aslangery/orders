<?php if(!defined('APP')) die();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Приложение</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script type="text/javascript">
        function changeState(id, state)
        {
            $("#list").load("index.php?task=order.changeState", {'id': id, 'state':state});
        }
    </script>

</head>
<body>
<div id="auth">
    {{auth}}
</div>
<div id="list">
{{content}}
</div>
</body>
</html>

