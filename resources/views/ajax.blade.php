<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>

<script type="text/javascript" charset="utf-8">

$(document).on('click', '#btnSelector', function(event) {
    event.preventDefault();
    /* Act on the event */

    getMessage();

});
var getMessage = function(){
    $.ajax({
        type:'GET',
        url:'/ajax/post', //Make sure your URL is correct
        dataType: 'json', //Make sure your returning data type dffine as json
        data:'_token = <?php echo csrf_token() ?>',
        success:function(data){
            console.log(data); //Please share cosnole data
            if(data.msg) //Check the data.msg isset?
            {
                $("#msg").html(data.msg); //replace html by data.msg
            }

        }
    });
}
</script>

<body>

<div id = 'msg'>This message will be replaced using Ajax. Click the button to replace the message.</div>
<input type="button" value="Replace Message" id='btnSelector'>

</body>
</html>
