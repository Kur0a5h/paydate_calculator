<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Paydate Calc</title>
</head>
<body>
    <form action="calc.php" method="POST">
        <input type="text" name='paydateOne' placeholder='First Paydate'>
        <input type="text" name='numberOfPaydates' placeHolder='# of Paydates'>
        <select name='paydateModel'>
            <option>Weekly</option>
            <option>Bi-Weekly</option>
            <option>Monthly</option>
        </select>
        <br>
        <button type='submit' name='submit' value='submit'>Calculate Paydays</button>
    </form>
</body>
</html>