
const jwt = require('jsonwebtoken');

const authenticate = (req, res, next) => {
  const authHeader = req.headers.authorization;
  if (!authHeader) return res.status(401).json({ error: 'Missing token' });

  const token = authHeader.split(' ')[1];

  try {
    const decoded = jwt.verify(token, process.env.JWT_SECRET);
    req.user = { id: decoded.sub }; // attach user info
    next();
  } catch (err) {
    return res.status(403).json({ error: 'Invalid token' });
  }
};

module.exports = authenticate;