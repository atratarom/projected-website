require("dotenv").config();
const express = require("express");
const axios = require("axios");
const cors = require("cors");

const app = express();
app.use(cors());
app.use(express.json());

const TRACCAR_API_URL = "http://your-traccar-server/api";
const TRACCAR_USERNAME = process.env.TRACCAR_USERNAME;
const TRACCAR_PASSWORD = process.env.TRACCAR_PASSWORD;

// Fetch GPS Data from Traccar
app.get("/api/locations", async (req, res) => {
  try {
    const response = await axios.get(`${TRACCAR_API_URL}/positions`, {
      auth: { username: TRACCAR_USERNAME, password: TRACCAR_PASSWORD },
    });
    res.json(response.data);
  } catch (error) {
    res.status(500).json({ error: "Error fetching GPS data" });
  }
});

// Start Server
const PORT = process.env.PORT || 5000;
app.listen(PORT, () => console.log(`Server running on port ${PORT}`));
