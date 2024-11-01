<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <div class="h-screen flex items-center justify-center bg-gray-100">
        <form id="feedbackForm" class="p-6 bg-white rounded shadow-lg w-80">
            <h2 class="text-lg font-bold mb-4">Feedback Form</h2>
            <label class="block mb-2">Name</label>
            <input type="text" name="name" required class="w-full p-2 border rounded mb-4">

            <label class="block mb-2">Email</label>
            <input type="email" name="email" required class="w-full p-2 border rounded mb-4">

            <label class="block mb-2">Subject</label>
            <input type="text" name="subject" required class="w-full p-2 border rounded mb-4">

            <label class="block mb-2">Message</label>
            <textarea name="message" required class="w-full p-2 border rounded mb-4"></textarea>

            <!-- reCAPTCHA -->
            <div class="g-recaptcha" data-sitekey="YOUR_SITE_KEY_HERE"></div>

            <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded">Submit</button>
        </form>
    </div>

    <script>
        document.getElementById("feedbackForm").onsubmit = async function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const response = await fetch('/api/process_feedback', {
                method: 'POST',
                body: JSON.stringify(Object.fromEntries(formData)),
                headers: { 'Content-Type': 'application/json' }
            });
            const result = await response.json();
            alert(result.message || result.error);
        };
    </script>
</body>
</html>
