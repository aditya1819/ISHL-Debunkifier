const mongoose = require('mongoose');

const attemptSchema = new mongoose.Schema({
  userId: String,
  questionId: mongoose.Schema.Types.ObjectId,
  result: { type: String, enum: ['pass', 'fail'] },
  submittedAt: { type: Date, default: Date.now }
});

module.exports = mongoose.model('Attempt', attemptSchema);