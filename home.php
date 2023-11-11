<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar with Current Day Highlighted</title>
    <link rel="stylesheet" href="home.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        td {
            cursor: pointer;
        }

        .current-day {
            border-radius: 50%;
            background-color: yellow;
        }
    </style>
</head>

<body>

    <h2>Calendar</h2>

    <table id="calendar">
        <thead>
            <tr>
                <th>Sun</th>
                <th>Mon</th>
                <th>Tue</th>
                <th>Wed</th>
                <th>Thu</th>
                <th>Fri</th>
                <th>Sat</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <script>
        // Get current date information
        const today = new Date();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();
        const currentDay = today.getDate();

        // Function to generate calendar for the current month
        function generateCalendar(year, month, dayToHighlight) {
            const firstDay = new Date(year, month, 1);
            const lastDay = new Date(year, month + 1, 0);

            const tableBody = document.getElementById("calendar").getElementsByTagName("tbody")[0];
            tableBody.innerHTML = '';

            let date = 1;
            for (let i = 0; i < 6; i++) {
                const row = tableBody.insertRow(i);

                for (let j = 0; j < 7; j++) {
                    const cell = row.insertCell(j);

                    if (i === 0 && j < firstDay.getDay()) {
                        // Empty cells before the first day of the month
                    } else if (date > lastDay.getDate()) {
                        // Empty cells after the last day of the month
                    } else {
                        cell.innerHTML = date;

                        // Highlight the current day
                        if (date === dayToHighlight) {
                            cell.classList.add("current-day");
                        }

                        date++;
                    }
                }
            }
        }

        // Call the function to generate the calendar for the current month
        generateCalendar(currentYear, currentMonth, currentDay);
    </script>

</body>

</html>