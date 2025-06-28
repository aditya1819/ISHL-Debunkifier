const express = require('express');
const router = express.Router();
const Question = require('../models/question');
const Attempt = require('../models/attempt');

const authMiddleware = require('../middleware/authMiddleware');
// 1. GET /api/questions?type=tutorial|exercise
router.get('/', authMiddleware, async (req, res) => {
  const { type, userId } = req.query;
  const questions = await Question.find({ type });

  if (userId) {
    const attempts = await Attempt.find({ userId });
    const attemptedIds = attempts.map(a => a.questionId.toString());

    const withAttemptStatus = questions.map(q => ({
      ...q._doc,
      attempted: attemptedIds.includes(q._id.toString()),
    }));

    return res.json(withAttemptStatus);
  }

  res.json(questions);
});

// 2. GET /api/questions/:id
router.get('/:id', authMiddleware, async (req, res) => {
  const question = await Question.findById(req.params.id);
  res.json(question);
});

// 3. POST /api/questions/:id/submit
router.post('/:id/submit', authMiddleware, async (req, res) => {
  const { userId, selectedAnswer } = req.body;
  const question = await Question.findById(req.params.id);

  const result = question.answer === selectedAnswer ? 'pass' : 'fail';

  await Attempt.create({
    userId,
    questionId: question._id,
    result
  });

  res.json({ result });
});

// 4. GET /api/questions/:id/solution
router.get('/:id/solution', authMiddleware, async (req, res) => {
  const question = await Question.findById(req.params.id);
  res.json({ solution: question.answer });
});

module.exports = router;