<div class="container-fluid">
    <div id="wentOutDIV" class="spinner-border text-primary" role="status" style="display:none">
        <span class="sr-only">Loading...</span>
    </div>
    <div id="successDIV" class="alert alert-success " style="display:none"></div>
    <div><button type="button" class="btn btn-default" data-url='{{ url('/getTargetSolutionsData/employees') }}'>Get
            Employees!</button></div>
    <div><button type="button" class="btn btn-default" data-url='{{ url('/getTargetSolutionsData/positions') }}'>Get
            Positions!</button></div>
    <div><button type="button" class="btn btn-default"
            data-url='{{ url('/getTargetSolutionsData/employees_profile') }}'>Get
            Employees- Can Act, Position, Org & Shift!</button></div>
    <div><button type="button" class="btn btn-default" data-url='{{ url('/getTargetSolutionsData/credentials') }}'>Get
            Credentials!</button></div>
    <div><button type="button" class="btn btn-default"
            data-url='{{ url('/getTargetSolutionsData/employees_credentials') }}'>Get
            Employees- Credentials!</button></div>
    <div><button type="button" class="btn btn-default"
            data-url='{{ url('getTargetSolutionsData/employees_credentials_complete') }}'>Get
            Employees- Credentials (Completed)!</button></div>

</div>
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous">
</script>

<script>
    $(".btn").click(function (e) {
        e.preventDefault();
        $.ajax({
            url: $(this).data('url'),
            method: 'GET',
            beforeSend: function () {
                $('#successDIV').hide();
                $('#wentOutDIV').show();
            },
            success: function (result) {
                $('#wentOutDIV').hide();
                $('#successDIV').html(result.success).show();
            }
        });
    });

</script>
