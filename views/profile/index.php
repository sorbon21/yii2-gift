<div class="site-index">

    <div class="jumbotron">
        <h1><?=$stock->name?></h1>
        <h3>
            <?=$stock->description?>
        </h3>
        <p><button class="btn btn-lg btn-success"  onclick="getPrize(<?=$stock->id?>)">Получить приз</button></p>
            <p id="result">

            </p>
    </div>
</div>
<script>
    function getPrize(id) {
        $.ajax({
            url: '/profile/get-prize?id='+id,
            type: 'get',
            success: function (res) {
                var msg=JSON.parse(res);
                $("#result").html(`<h4 class='alert alert-success'>${msg[0].msg}</h4>`);
            },
            error: function () {
                alert('Error!');
            }
        })
    }
</script>
