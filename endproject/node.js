<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraphHopper API Test</title>
</head>
<body>
    <h2>Route Optimization Test</h2>
    <button onclick="getRoute()">Get Route</button>
    <pre id="output"></pre>

    <script>
        function getRoute() {
            const apiKey = "YOUR_API_KEY"; // Replace with your actual GraphHopper API Key
            const url = https://graphhopper.com/api/1/route?point=52.517036,13.38886&point=52.520008,13.404954&vehicle=car&key=${apiKey};

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById("output").textContent = JSON.stringify(data, null, 2);
                })
                .catch(error => console.error("Error:", error));
        }
    </script>
</body>
</html>