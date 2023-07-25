<!DOCTYPE html>
<html>
<head>
    <title>Calendario con opción de selección</title>
    <style>
        /* Estilos para el calendario */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .container {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: flex-end;
            align-items: flex-start;
            margin: 20px;
            width: 100%;
        }

        .calendar-card {
            width: 350px;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            text-align: center;
        }

        table {
            width: 100%;
            margin-bottom: 10px;
        }

        th, td {
            text-align: center;
            padding: 10px;
        }

        td {
            cursor: pointer;
        }

        /* Estilos para el input */
        .date-input-container {
            display: flex;
            align-items: center;
            margin-top: 20px;
        }

        .date-input-label {
            margin-right: 10px;
        }

        .date-input {
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>
<body>
        <div>
            <div class="calendar-card">
                <h2>Opción de Selección</h2>
                <div class="date-input-container">
                    <label class="date-input-label" for="selectedDate">Seleccionar fecha:</label>
                    <input class="date-input" type="date" id="selectedDate">
                </div>
            </div>
        </div>
    </div>

</body>
</html>
