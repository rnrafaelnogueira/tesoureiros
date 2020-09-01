<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Template E-mail</title>
</head>
<style>
    body, html { margin: 0; padding: 0; background: #d2d2d2; font-family: Roboto,RobotoDraft,Helvetica,Arial,sans-serif }
    .white { background: #ffffff;min-width: 380px }
</style>
<body class="corpo">
    <table class='bg-email' style="height: 100%;width: 100%; margin:0px;border-top:8px solid rgb(81,81,81);background:rgb(241,241,241);color:rgb(0,0,0);font-size:medium">
        <tr>
            <td style="padding: 2em 0">
                <div class='main' style="max-width: 800px;margin: 0 auto">
                    <!-- Topo -->
                    <img src="https://arquivos.sfiec.org.br/imagens/app-email-header.png" alt="sistema-fiec" style="max-width: 100%;display: table">

                    <!-- Corpo -->
                    <div class="banner">
                        <img src="https://arquivos.sfiec.org.br/imagens/app-email-bg.png" alt="Sfiec Email" style="max-width: 100%;display: table">
                    </div>

                    <!-- Conteúdo -->
                    <div class="conteudo" style="box-sizing: border-box;float: left;display: block;width: 100%;background: #ffffff;padding: 2em; font-size: 13px ">
                        @yield('content')
                    </div>
                                                    
                    <!-- Rodape -->
                    <div class="queremos-ouvir" style="font-size: 13px; background: #196839;color: white;float: left;display: block;text-align: center;width: 100% ">
                        <h2 class="font-lig" >Queremos ouvir você</h2>
                        <span class="tel" style="font-size: 33px">(85) 4009.6300<br> </span>
                        <p style="font-size: 12px;line-height: 13px">Atendimento telefônico de segunda a sexta-feira, das 7h às 19h, <br>e aos sábados, das 8h às 14h, exceto em feriados nacionais ou locais.</p>
                    </div>

                    <!-- Endereço -->
                    <div class="endereco" style="box-sizing:border-box; color: #000000;display: block;float: left;font-size: 10px;line-height: 15px;background: #ffffff;padding: 1em;width: 100% ">
                    <div class="linha" style="float: left;width: 50%;display: block"> 
                        © 2019 Todos os direitos reservados
                    </div>
                    <div class="linha" style="float: left;width: 50%;display: block"> 
                        Sistema FIEC - Sistema Federação das Indústrias do Estado do Ceará<br>
                        Av. Barão de Studart, 1980 - Aldeota - Fortaleza/CE - CEP: 60.120-024
                    </div>
                    </div>
                </div>
            </td>
        </tr>        
</table>
<!-- End Main -->
</body>
</html>