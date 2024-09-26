require('dotenv').config();
const Lalamove = require('@lalamove/lalamove-js');

const lalamove = new Lalamove({
  key: process.env.LALAMOVE_CLIENT_ID,
  secret: process.env.LALAMOVE_SECRET_KEY,
  country: process.env.LALAMOVE_COUNTRY_CODE,
  sandbox: true, // Use true for testing, set false for production
});