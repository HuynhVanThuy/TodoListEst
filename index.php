<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

    $( document ).ready(function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                center: 'dayGridMonth, dayGridWeek, dayGridDay'
            }
        });
        
        calendar.render();

        calendar.on('dateClick', function(info) {
          console.log('clicked on ' + info.dateStr);
        });
    });

</script>
</head>
<body>
    <div id='calendar'></div>
</body>
</html>