<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>E-mail</title>
</head>
<style>
    body, html { margin: 0; padding: 0; background: #d2d2d2; font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif }
    .white { background: #ffffff;min-width: 380px }
</style>
<body class="corpo">
    <table class='bg-email' style="height: 100%;width: 100%; margin:0px;border-top:8px solid #E08E7A;background:rgb(241,241,241);color:rgb(0,0,0);font-size:medium">
        <tr>
            <td style="padding: 2em 0">
                <div class='main' style="max-width: 800px;margin: 0 auto">
    
                    <!-- Corpo -->
                    <div class="banner">
                        <img src="https://necyvieira.herokuapp.com/imagem_carrocel2.jpg" alt="Sfiec Email" style="max-width: 100%;display: table">
                    </div>

                    <!-- Conteúdo -->
                    <div class="conteudo" style="box-sizing: border-box;float: left;display: block;width: 100%;background: #ffffff;padding: 2em; font-size: 13px ">
                    <h2 style="text-align: center">Lab Necy Vieira</h2> 
                            <h3 style="text-align: center">Nova solicitação</h3>
                            <p><b>Prezado (a)</b> Rafael Nogueira </p>
                            <p> Você recebeu uma solicitação de serviço através do site <b>LAB NECY VIEIRA</b>.</p>
                            <p>
                                
                                <b>DADOS DA SLICITAÇÃO:</b><br>
                                <b>Serviço: </b> {{ $servico }} <br>
                                <b>Nome: </b> {{ $nome }} <br>
                                <b>Telefone: </b> {{ $telefone}} <br>
                                <b>Detalhes: </b> {{ $detalhes }} <br>
                            </p>
                            <br>
                            <p>Atenciosamente,</p>
                            <p><a HREF="https://necyvieira.herokuapp.com/public/site/">https://necyvieira.herokuapp.com/public/site/</a></p> 
                    </div>        
                </div>
            </td>
        </tr>        
</table>
<!-- End Main -->
</body>
</html>
    