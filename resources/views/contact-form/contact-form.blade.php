<html lang="en">
<head>
    <title>Laravel Ajax jquery Validation Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>

<div class="container panel panel-default ">
    <h2 class="panel-heading">Laravel Ajax jquery Validation</h2>
    <form id="contact-form">
        <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Enter Name" id="name">
            <span class="text-danger" id="name-error"></span>
        </div>

        <div class="form-group">
            <input type="text" name="email" class="form-control" placeholder="Enter Email" id="email">
            <span class="text-danger" id="email-error"></span>
        </div>

        <div class="form-group">
            <input type="text" name="mobile_number" class="form-control" placeholder="Enter Mobile Number" id="mobile_number">
            <span class="text-danger" id="mobile-number-error"></span>
        </div>

        <div class="form-group">
            <input type="text" name="subject" class="form-control" placeholder="Enter subject" id="subject">
            <span class="text-danger" id="subject-error"></span>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="message" placeholder="Message" id="message"></textarea>
            <span class="text-danger" id="message-error"></span>
        </div>
        <div class="form-group">
            <button class="btn btn-success" id="submit">Submit</button>
        </div>
        <div class="form-group">
            <b><span class="text-success" id="success-message"> </span><b>
        </div>
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#contact-form').on('submit', function (event) {
        event.preventDefault();
        $('#name-error').text('');
        $('#email-error').text('');
        $('#mobile-number-error').text('');
        $('#subject-error').text('');
        $('#message-error').text('');

        name = $('#name').val();
        email = $('#email').val();
        mobile_number = $('#mobile_number').val();
        subject = $('#subject').val();
        message = $('#message').val();

        $.ajax({
            url: "/contact-form",
            type: "POST",
            data: {
                name: name,
                email: email,
                mobile_number: mobile_number,
                subject: subject,
                message: message,
            },
            success: function (response) {
                console.log(response);
                if (response) {
                    $('#success-message').text(response.success);
                    $("#contact-form")[0].reset();
                }
            },
            error: function(response) {
                $('#name-error').text(response.responseJSON.errors.name);
                $('#email-error').text(response.responseJSON.errors.email);
                $('#mobile-number-error').text(response.responseJSON.errors.mobile_number);
                $('#subject-error').text(response.responseJSON.errors.subject);
                $('#message-error').text(response.responseJSON.errors.message);
            }
        });
    });

</script>

</body>
</html>
