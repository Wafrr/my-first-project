const express = require('express');
const cors = require('cors');

const app = express();

app.use(cors());
app.use(express.json());

let requests = [];

app.get('/api/requests', (req, res) => {
  res.json(requests);
});

app.post('/api/requests', (req, res) => {
  const newRequest = {
    id: Date.now(),
    ...req.body
  };

  requests.push(newRequest);

  res.status(201).json(newRequest);
});

app.listen(3000, () => {
  console.log('Server started on http://localhost:3000');
});