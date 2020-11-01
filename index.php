<?php
    require_once("Controller/IndexController.php");
    $indexController = new Controller\IndexController();
    $todos = null;
    $todos = $indexController->index();
?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='utf-8' />
    <title>Home page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>

        $(document).ready(function() {
            let todos = <?php echo json_encode($todos); ?>;
            let dataEvent = [];
            // for (let [index, todo] of Object.entries(todos)) {
            //     let color = "";
            //     switch(todo['status']) {
            //       case "Planning":
            //         color = "#17a2b8";
            //         break;
            //       case "Doing":
            //         color = "#28a745";
            //         break;
            //       case "Complete":
            //         color = "#ffc107";
            //         break;
            //     }
            //     dataEvent.push({
            //         id : todo['id'], 
            //         title : todo['taskName'], 
            //         start : todo['startDate'], 
            //         end : todo['endDate'], 
            //         color : color
            //     });
            // }

            for (let [index, todo] of Object.entries(todos)) {
                let color = "";
                switch(todo['status']) {
                  case "Planning":
                    color = "#17a2b8";
                    break;
                  case "Doing":
                    color = "#28a745";
                    break;
                  case "Complete":
                    color = "#ffc107";
                    break;
                }
                dataEvent.push({
                    id : todo['id'], 
                    title : todo['taskName'],
                    start : todo['createDate'],
                    color : color
                });
            }

            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    center: 'dayGridMonth, dayGridWeek, dayGridDay'
                },
                events: dataEvent
            });
            
            calendar.render();

            calendar.on('dateClick', function(info) {
                window.location.href = './view/todo.php?date='+info.dateStr;
            });
        });

    </script>
</head>
<body>
    <div id='calendar'></div>
</body>
</html>