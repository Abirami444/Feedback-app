const express = require('express');
const nodemailer = require('nodemailer');
const bodyParser = require('body-parser');

const app = express();
const PORT = process.env.PORT || 3000;

// Middleware to parse form data
app.use(bodyParser.urlencoded({ extended: true }));

// Route to display the feedback form
app.get('/', (req, res) => {
  res.sendFile(__dirname + '/feedback_form.html');
});

// Route to handle form submission
app.post('/submit-feedback', (req, res) => {
  const { name, email, subject, message } = req.body;

  // Configure Nodemailer
  const transporter = nodemailer.createTransport({
    service: 'gmail',
    auth: {
      user: 'utube2763@gmail.com', // Replace with your email
      pass: 'ouhu qbsl qdrs rdxo'      // Replace with your app-specific password
    }
  });

  // Email options for admin
  const mailOptionsAdmin = {
    from: email, // User's email from the form submission
    to: 'utube2763@gmail.com', // Your personal email for testing
    subject: `New Feedback: ${subject}`,
    text: `From: ${name}\nEmail: ${email}\n\nMessage:\n${message}`
};


  // Email options for acknowledgment
  const mailOptionsUser = {
    from: 'utube2763@gmail.com', // Replace with your email
    to: email,
    subject: 'Thank you for your feedback!',
    text: `Dear ${name},\n\nThank you for your feedback. We will review it soon.\n\nRegards,\nYour Team`
  };

  // Send email to admin
  transporter.sendMail(mailOptionsAdmin, (error, info) => {
    if (error) {
      return res.status(500).send('Error sending email to admin.');
    }

    // Send acknowledgment email to user
    transporter.sendMail(mailOptionsUser, (error, info) => {
      if (error) {
        return res.status(500).send('Error sending acknowledgment email.');
      }
      res.send('Feedback submitted successfully!');
    });
  });
});

// Start the server
app.listen(PORT, () => {
  console.log(`Server is running on http://localhost:${PORT}`);
});
