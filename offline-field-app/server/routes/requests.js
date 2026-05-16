const express = require('express');
const fs = require('fs/promises');
const path = require('path');
const { v4: uuidv4 } = require('uuid');
const validateRequest = require('../middleware/validateRequest');

const router = express.Router();

const DATA_PATH = path.join(__dirname, '../data/requests.json');

async function readRequests() {
  const data = await fs.readFile(DATA_PATH, 'utf-8');
  return JSON.parse(data);
}

async function writeRequests(data) {
  await fs.writeFile(DATA_PATH, JSON.stringify(data, null, 2));
}

router.get('/', async (req, res, next) => {
  try {
    const requests = await readRequests();
    res.status(200).json(requests);
  } catch (error) {
    next(error);
  }
});

router.post('/', validateRequest, async (req, res, next) => {
  try {
    const requests = await readRequests();

    const newRequest = {
      id: uuidv4(),
      title: req.body.title,
      description: req.body.description || '',
      priority: req.body.priority || 'medium',
      status: req.body.status || 'open',
      createdAt: new Date().toISOString()
    };

    requests.push(newRequest);

    await writeRequests(requests);

    res.status(201).json(newRequest);
  } catch (error) {
    next(error);
  }
});

router.patch('/:id', async (req, res, next) => {
  try {
    const requests = await readRequests();

    const index = requests.findIndex(item => item.id === req.params.id);

    if (index === -1) {
      return res.status(404).json({
        message: 'Request not found'
      });
    }

    requests[index] = {
      ...requests[index],
      ...req.body
    };

    await writeRequests(requests);

    res.status(200).json(requests[index]);
  } catch (error) {
    next(error);
  }
});
router.delete('/:id', async (req, res, next) => {
  try {
    const requests = await readRequests();

    const filtered = requests.filter(item => item.id !== req.params.id);

    if (filtered.length === requests.length) {
      return res.status(404).json({
        message: 'Request not found'
      });
    }

    await writeRequests(filtered);

    res.status(204).send();
  } catch (error) {
    next(error);
  }
});

module.exports = router;