module.exports = (req, res, next) => {
  const { title, priority, status } = req.body;

  if (!title || title.trim().length < 3) {
    return res.status(400).json({
      message: 'Title is required'
    });
  }

  const allowedPriorities = ['low', 'medium', 'high'];
  const allowedStatuses = ['open', 'in_progress', 'done'];

  if (priority && !allowedPriorities.includes(priority)) {
    return res.status(400).json({
      message: 'Invalid priority'
    });
  }

  if (status && !allowedStatuses.includes(status)) {
    return res.status(400).json({
      message: 'Invalid status'
    });
  }

  next();
};