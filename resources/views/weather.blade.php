<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <style>
        .preview {
            width: 300px;
            height: 250px;
        }
    </style>
</head>
<body>
<nav class="navbar bg-body-tertiary bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="https://www.panel.prodooh.com/assets/images/default/prodooh.png" alt="Logo" class="d-inline-block align-text-top">
        </a>
    </div>
</nav>
<div class="container pt-5">
    <div class="row">
        <div class="col-6">
            <form>
                <div class="form-floating">
                    <select class="form-select" id="input" a>
                        <option selected>Lugares...</option>
                        <option value="canada">Canada</option>
                        <option value="cancun">Cancún</option>
                        <option value=bogota>Bogota</option>
                    </select>
                    <label for="floatingSelect">Selecciona un lugar</label>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="preview mx-auto">
                <img src="{{asset('/images/preview.png')}}" width="300" height="250" id="image">
                <div id="text"></div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script>
    $('#input').change(function () {
        $.ajax({
            url: "{{url('getWeather')}}",
            data: {"venue": $('#input').val()},
            type: "post",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                $('#clima').remove();
                $('#text').append("<h2 id='clima' class='text-center'>Se detecto un clima de " + data.main.temp + "°C</h2>");
                if (data.main.temp < 15) {
                    $("#image").attr("src", "{{asset('images/frio.jpg')}}");
                    console.log("frio");
                } else if (data.main.temp >= 15 && data.main.temp <= 22) {
                    $("#image").attr("src", "{{asset('images/lluvia.jpg')}}");
                    console.log("medio");
                } else if (data.main.temp >= 23) {
                    $("#image").attr("src", "{{asset('images/soleado.jpg')}}");
                    console.log("calor");
                } else {
                    $("#image").attr("src", "{{asset('images/preview.png')}}");
                    console.log("no entra");
                }
            }
        });
    })
</script>
</body>
</html>
