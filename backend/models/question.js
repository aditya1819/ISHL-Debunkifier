const mongoose = require('mongoose');

const questionSchema = new mongoose.Schema({
  title: String,
  content: String,
  type: { type: String, enum: ['tutorial', 'exercise'] },
  options: [String],
  answer: String,
});

module.exports = mongoose.model('Question', questionSchema);