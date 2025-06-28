require('dotenv').config();
const express = require('express');
const mongoose = require('mongoose');
const cors = require('cors');
const questionRoutes = require('./routes/questionRoutes');

const app = express();

app.use(cors());
app.use(express.json());
app.use('/api/questions', questionRoutes);

// Connect to MongoDB
mongoose.connect(process.env.MONGO_URI, { useNewUrlParser: true, useUnifiedTopology: true })
.then(() => {
  console.log('✅ MongoDB connected');
  app.listen(3001, () => console.log('🚀 Express API running on http://localhost:3001'));
})
.catch(err => console.error('MongoDB Error:', err));