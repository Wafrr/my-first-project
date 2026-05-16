const express = require('express');
const cors = require('cors');

const app = express();

app.use(cors());
app.use(express.json());

app.get('/', (req, res) => {
  res.send('Server is working');
});

app.get('/api/requests', (req, res) => {
  res.json([
    {
      id: 1,
      title: 'Test request',
      status: 'open'
    }
  ]);
});

const PORT = 3000;

app.listen(PORT, () => {
  console.log(`Server started on http://localhost:${PORT}`);
});