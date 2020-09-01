@extends('mail.layout')
@section('content')
<style>
    .conteudo { box-sizing: border-box;float: left;display: block;width: 100%;background: #ffffff;padding: 2em }
</style>
<h2 style="text-align: center">Lab Necy Vieira</h2> 
    <h3 style="text-align: center">Cliente entrando em contato</h3>
    <p><b>Prezado (a)</b> {{ Rafael Nogueira }} </p>
    <p> Você recebeu uma solicitação de contato através do site <b>LAB NECY VIEIRA</b>.</p>
    <p>
        <b>DADOS DO CLIENTE:</b><br>
        <b>Nome: </b> {{ $nome }} <br>
        <b>Telefone: </b> {{ $telefone}} <br>
        <b>Mensagem: </b> {{ $mensagem }} <br>
    </p>
    <br>
    <p>Atenciosamente,</p>
    <p><a HREF="https://necyvieira.herokuapp.com/public/site/">https://necyvieira.herokuapp.com/public/site/</a></p>
@endsection  