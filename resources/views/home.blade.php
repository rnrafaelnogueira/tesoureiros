@extends('adminlte::page')

@section('content')
<div class="container">



    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h4>NOV/2017<br>DEZ/2018</h4></span>

            <div class="info-box-content">
              <span class="info-box-text">Receita <br><strong>R$ {!! $total_financeiro['total_receita_anual'] !!}</strong></span>
              <span class="info-box-text">Despesa <br> <strong>R$ {!! $total_financeiro['total_despesa_anual'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>NOV<br>2017</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br><strong>R$ {!! $total_financeiro['total_receita_nov_2017'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_nov_2017'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>DEZ<br>2017</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_dez_2017'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_dez_2017'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>JAN<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_jan_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_jan_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>FEV<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_fev_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_fev_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>MAR<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_mar_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_mar_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

                <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>ABR<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_abr_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_abr_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>MAI<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_mai_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_mai_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>JUN<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_jun_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_jun_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>JUL<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_jul_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_jul_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>AGO<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_ago_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_ago_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>SET<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_set_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_set_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>OUT<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_out_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_out_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>NOV<br>2018</h3></span>
            <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_nov_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_nov_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-16">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><h3>DEZ<br>2018</h3></span>
             <div class="info-box-content">
              <span class="info-box-text">Receita  <br> <strong>R$ {!! $total_financeiro['total_receita_dez_2018'] !!}</strong></span>
              <span class="info-box-text">Despesa  <br> <strong>R$ {!! $total_financeiro['total_despesa_dez_2018'] !!}</strong></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <!-- /.col -->

      </div>
      <!-- /.row -->

      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          
         
          <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total por categoria - Nov 2017 e Dez 2017</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Categoria</th>
                    <th>Novembro</th>
                    <th>Dezembro</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($categorias as $categoria)
                  <tr>
                      <td>{{ $categoria }}</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->

            </div>
           
           <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total por categoria - 1º Semestre 2018</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Categoria</th>
                    <th>JAN</th>
                    <th>FEV</th>
                    <th>MAR</th>
                    <th>ABR</th>
                    <th>MAI</th>
                    <th>JUN</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($categorias as $categoria)
                  <tr>
                      <td>{{ $categoria }}</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
              
            </div>

            <!-- TABLE: LATEST ORDERS -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Total por categoria - 2º Semestre 2018</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Categoria</th>
                    <th>JUL</th>
                    <th>AGO</th>
                    <th>SET</th>
                    <th>OUT</th>
                    <th>NOV</th>
                    <th>DEZ</th>
                  </tr>
                  </thead>
                  <tbody>
                   @foreach ($categorias as $categoria)
                  <tr>
                      <td>{{ $categoria }}</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                      <td>R$ 0</td>
                  </tr>
                  @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
              
            </div>

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
     
</div></section>
</div>
@endsection
