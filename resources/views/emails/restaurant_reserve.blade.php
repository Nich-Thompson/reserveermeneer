<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8"/>
</head>
<body>
<h1>Reservering bij {{$restaurant->name}}</h1>

<div>
    <div>
        <h3>Hallo, {{$firstname}} {{$lastname}}</h3>
        <p>De reservering die jij hebt geplaatst voor {{$date}} om {{$time}} bij restaurant {{$restaurant->name}} is
            succesvol ontvangen.</p>
        @if($waiting_list === true)
            <strong>Daar in tegen sta je wel op de wachtlijst, het is dus niet zeker of er plaats is in het
                restaurant voor jouw reservering!</strong>
        @endif
    </div>
</div>
</body>
</html>
