const express = require('express');
const cors = require('cors');
const config = require('./config/env_config');
const routes = require('./routes/index.route');
const app = express();


const port = config.PORT || 3333;

app.use(cors());
app.use(express.json());

//Routes
routes(app);

//Start server
app.listen(port, () => {
    console.log(`Server running on port ${port}`);
});
