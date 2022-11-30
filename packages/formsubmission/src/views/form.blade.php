<!DOCTYPE html>
<html>
<head>
    <title>Simple Form Submission Package</title>

    <style>
        input[type=text], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=email], select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #45a049;
        }

        div {
            border-radius: 5px;
            background-color: #f2f2f2;
            padding: 20px;
        }

        textarea {
            width: 100%;
            height: 150px;
            padding: 12px 20px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-radius: 4px;
            background-color: #f8f8f8;
            font-size: 16px;
            resize: none;
        }
    </style>

</head>
<body>

<h3>Submit the form</h3>

<div>
    <form action="{{route('contact-form')}}" method="post">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" placeholder="Your name..">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Your email..">

        <label for="message">Message</label>
        <textarea id="message" name="message" cols="30" rows="10" placeholder="Your message.."></textarea>
        <input type="submit" value="Submit">
    </form>
</div>

</body>
</html>
