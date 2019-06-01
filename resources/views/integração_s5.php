<?php
	
	//- mssql_quote_fix : Fixar aspas para mssql 
function mssql_quote_fix($text) 
{ 
   $text = str_replace("'", "''", $text); 
    return $text; 
} 
	
	function m_getEndereco(){ 
		//$l_endereco_requisicao = $_SERVER['SERVER_NAME'];  
          
        $l_endereco_requisicao =  'srvjava15.sfiec.org.br'; 
             
        sc_lookup(rs_wsdl,"SELECT prod,hom,url_default, 
							      isnull((select case when endereco is not null and rtrim(ltrim(endereco))<>'' then 'S' else 'N' end 
										    from tbl_protheus_enderecos_validos 
										   where ambiente = 'P' 
										     and ativo = 'S' 
										     and endereco = rtrim(ltrim('$l_endereco_requisicao'))),'N') as endereco_prod_valido 
							FROM ( 
							     select row_number() OVER (ORDER BY url_default ASC) AS linha, up.url_wsdl as prod, uh.url_wsdl as hom,url_default from tbl_protheus_url_projeto p  
								  inner join tbl_protheus_url up on p.id_url_s5_pj_prod = up.id 
								  inner join tbl_protheus_url uh on p.id_url_s5_pj_hom = uh.id 
								  where p.pasta_proj = 'CRM' or url_default = 'S' 
							 ) T where linha = 1");  
             
        $l_serv_prod = {rs_wsdl[0][0]};  
    
        $l_serv_hom ={rs_wsdl[0][1]};              
    
        $l_endereco_prod_valido = empty({rs_wsdl[0][3]}) ? 'N' : {rs_wsdl[0][3]};               
    
        if($l_endereco_prod_valido == 'S'){  
               
            $l_endereco = $l_serv_prod;  
    
        }else{  
            $l_endereco = $l_serv_hom;  
        }  
    
        return $l_endereco;      
      
    } 


	function m_getEnderecoUnidade(){ 
		//$l_endereco_requisicao = $_SERVER['SERVER_NAME'];  
          
        $l_endereco_requisicao =  'srvjava15.sfiec.org.br'; 
             
        sc_lookup(rs_wsdl,"SELECT prod,hom,url_default, 
							      isnull((select case when endereco is not null and rtrim(ltrim(endereco))<>'' then 'S' else 'N' end 
										    from tbl_protheus_enderecos_validos 
										   where ambiente = 'P' 
										     and ativo = 'S' 
										     and endereco = rtrim(ltrim('$l_endereco_requisicao'))),'N') as endereco_prod_valido 
							FROM ( 
							     select row_number() OVER (ORDER BY url_default ASC) AS linha, up.url_wsdl as prod, uh.url_wsdl as hom,url_default from tbl_protheus_url_projeto p  
								  inner join tbl_protheus_url up on p.id_url_s5_unidade_prod = up.id 
								  inner join tbl_protheus_url uh on p.id_url_s5_unidade_hom = uh.id 
								  where p.pasta_proj = 'CRM' or url_default = 'S' 
							 ) T where linha = 1");  
             
        $l_serv_prod = {rs_wsdl[0][0]};  
    
        $l_serv_hom ={rs_wsdl[0][1]};              
    
        $l_endereco_prod_valido = empty({rs_wsdl[0][3]}) ? 'N' : {rs_wsdl[0][3]};               
    
        if($l_endereco_prod_valido == 'S'){  
               
            $l_endereco = $l_serv_prod;  
    
        }else{  
            $l_endereco = $l_serv_hom;  
        }  
    
        return $l_endereco;      
      
    } 
	
	
	function m_integra_pj_s5($p_id_empresa){
		
		$l_retorno  = array();
		$l_retorno['msg']="";
		$l_retorno['erro'] = 0;
		$l_url = "";
	
		sc_lookup(rs_dados_empresa, "
			SELECT
			  e.id            as id,
			  e.cgc 		  as cnpj,
			  e.razao_social  as razao_social,
			  e.nome_fantasia as nome_fantasia,
			  case when ce.cei like '%X%' then '' else ce.cei end as cei,
			  rtrim(e.inscricao_estadual),
			  rtrim(e.inscricao_municipal),
			  e.observacao,
			  e.fone_1,
			  e.endereco,
			  e.id_cnae_principal as cod_cnae,
			  rtrim(c.cnae)       as descricao_cnae,
			  tb2.descricao       as bairro,
			  e.cep,
			  e.id_municipio      as cod_municipio,
			  tm.descricao  	  as cidade,
			  e.estado 		      as uf,
			  rtrim(e.complemento),
			  CONVERT(nvarchar(30), DATEADD(hh, 3, getdate()), 127) as data_criacao,
			  CONVERT(nvarchar(30), DATEADD(mi, 2, DATEADD(hh, 3, getdate())), 127) as data_expiracao 
			FROM
			  empresas e
			  LEFT JOIN tbl_crm_cei ce ON e.id = ce.id_empresa
			  LEFT JOIN tbl_cnae2 c ON e.id_cnae_principal = c.cod_cnae
			  LEFT JOIN tbl_municipio tm ON tm.id = e.id_municipio
			  LEFT JOIN tbl_bairro tb2 ON tb2.id = e.id_bairro  
			WHERE e.informal = 'N'
			  AND e.id = $p_id_empresa		
		");
	
		 if(empty({rs_dados_empresa})){                  				 
			$l_retorno['erro'] = 1;
			$l_retorno['msg']  = 'Empresa não identificada';		                 
             
			return $l_retorno;
			 
         }else{
			 
			 $l_url = 'https://ws1.soc.com.br/WSSoc/EmpresaWs?wsdl';//m_getEndereco(); 
 
             if(!$l_url){ 
				 
				 $l_retorno['erro'] = 1;
				 $l_retorno['msg']  = 'Servidor não encontrado!';   
				 
				 return $l_retorno;				 
				 
             }else {
				 

				 				 
				 $l_cod_transacao = md5(uniqid(rand(), true));
				 
				 //$l_password_digest = base64_encode(sha1($l_cod_transacao.{rs_dados_empresa[0][18]}.'Z'.'4939a9536ea95ba', true)); // nonce + data de criação (Created) + chaveAcesso
				 //$l_password_digest = base64_encode(sha1($l_cod_transacao.$l_data_criacao.'4939a9536ea95ba', true)); // nonce + data de criação (Created) + chaveAcesso
				 $l_cod_transacao   = base64_encode($l_cod_transacao);
				 
				 $l_chave_acesso = '4939a9536ea95ba';
				 
				 $l_login = 'erpessoa';  //[visit_login]
				 
				 $l_query = " 
                    insert into tbl_crm_log_pj_s5 ( 
                    id_empresa, url_wsdl, cod_transacao, login_cadastro, data_cadastro 
                    ) 
                    values ( 
                        '".$p_id_empresa."', '".$l_url."', '".$l_cod_transacao."', '".$l_login."', getdate() 
                    ); 
                "; 
                 
                sc_exec_sql($l_query); 

                sc_lookup(rs_id_log, "SELECT IDENT_CURRENT('tbl_crm_log_pj_s5')");
				 
				 sc_lookup(rs_empresa_s5, "select id, matriz, codigo_empresa_s5 from tbl_empresa_unidade_s5 where id_empresa = '".$p_id_empresa."'");
				 
				 if(empty({rs_empresa_s5[0][0]})){					 
					 $l_acao   		   = 'Incluir';	
					 $l_acao_2 		   = 'incluir';
					 $l_tag_ativo 	   = '';
					 $l_tag_tipo_busca = '';
					 $l_codigo_s5	   = '';
					 $l_metodo 		   = 'incluirEmpresa';
					 //$l_empresa_matriz = 'S';
				 }elseif(!empty({rs_empresa_s5[0][0]}) and {rs_empresa_s5[0][1]} == 'S'){
					 $l_acao   		   = 'Alterar';
					 $l_acao_2 		   = 'alterar';
					 $l_tag_ativo 	   = '<ativo>S</ativo>'; 
					 $l_tag_tipo_busca = '<tipoBusca>CODIGO_SOC</tipoBusca>';
					 $l_codigo_s5	   = '<codigo>'.{rs_empresa_s5[0][2]}.'</codigo>';
					 $l_metodo         = 'alterarEmpresa';
				 }else{
					 $l_retorno['erro'] = 1;
					 $l_retorno['msg']  = 'A empresa não é matriz, é uma unidade!';  
					 return $l_retorno;					 
				 }
				 
				 sc_lookup(rs_parametros_unidade, "select codigo_empresa_principal_s5, codigo_responsavel_s5, codigo_usuario_s5 from tbl_parametros_s5 where id_unidade = 49");
				 
				 if(!empty({rs_parametros_unidade})){
					 $l_cod_empresa     = {rs_parametros_unidade[0][0]};
					 $l_cod_responsavel = {rs_parametros_unidade[0][1]};
					 $l_cod_usuario     = {rs_parametros_unidade[0][2]};				 
				 }else{
					 $l_retorno['erro'] = 1;
				 	 $l_retorno['msg']  = 'Unidade sem permissão de acesso para integração!'; 
					 return $l_retorno;					 		 	
				 }
				 				 
				 
				  $l_xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.soc.age.com/">
				   <soapenv:Body>
					  <ser:'.$l_acao_2.'Empresa>
						 <'.$l_acao.'EmpresaWsVo>
							<identificacaoWsVo>
							   <codigoEmpresaPrincipal>'.$l_cod_empresa.'</codigoEmpresaPrincipal>
							   <codigoResponsavel>'.$l_cod_responsavel.'</codigoResponsavel>
							   <codigoUsuario>'.$l_cod_usuario.'</codigoUsuario>
							</identificacaoWsVo>
							<dadosEmpresaWsVo>
							   <nomeAbreviado>'.{rs_dados_empresa[0][3]}.'</nomeAbreviado>
							   <razaoSocial>'.{rs_dados_empresa[0][2]}.'</razaoSocial>
							   <cnpjCeiCpf>CNPJ</cnpjCeiCpf>
							   <numeroCnpj>'.{rs_dados_empresa[0][1]}.'</numeroCnpj>
							   <numeroCei>'.{rs_dados_empresa[0][4]}.'</numeroCei>
							   <inscricaoEstadual>'.{rs_dados_empresa[0][5]}.'</inscricaoEstadual>
							   <inscricaoMunicipal>'.{rs_dados_empresa[0][6]}.'</inscricaoMunicipal>
							   <observacao>'.{rs_dados_empresa[0][7]}.'</observacao>
							   <telefoneCat>'.{rs_dados_empresa[0][8]}.'</telefoneCat>
							   <endereco>
								  <bairro>'.{rs_dados_empresa[0][12]}.'</bairro>
								  <cep>'.{rs_dados_empresa[0][13]}.'</cep>
								  <cidade>'.{rs_dados_empresa[0][15]}.'</cidade>
								  <codigoMunicipio>'.{rs_dados_empresa[0][14]}.'</codigoMunicipio>
								  <complemento>'.{rs_dados_empresa[0][17]}.'</complemento>
								  <endereco>'.{rs_dados_empresa[0][9]}.'</endereco>
								  <estado>'.{rs_dados_empresa[0][16]}.'</estado>
							   </endereco>
							   <codigoCnae>'.{rs_dados_empresa[0][10]}.'</codigoCnae>
							   <descricaoCnae>'.{rs_dados_empresa[0][11]}.'</descricaoCnae>							   
							</dadosEmpresaWsVo>
							'.$l_codigo_s5.'
							'.$l_tag_tipo_busca.'
							'.$l_tag_ativo.'
						 </'.$l_acao.'EmpresaWsVo>
					  </ser:'.$l_acao_2.'Empresa>
				   </soapenv:Body>
				</soapenv:Envelope>';	
				
				 /*
				  $l_xml_request ='<?xml version="1.0" encoding="UTF-8"?>
							<identificacaoWsVo>
							   <codigoEmpresaPrincipal>521389</codigoEmpresaPrincipal>
							   <codigoResponsavel>304643</codigoResponsavel>
							   <codigoUsuario>338074</codigoUsuario>
							</identificacaoWsVo>
							<dadosEmpresaWsVo>
							   <nomeAbreviado>Grendene</nomeAbreviado>
							   <razaoSocial>GRENDENE S A</razaoSocial>
							   <cnpjCeiCpf>CNPJ</cnpjCeiCpf>
							   <numeroCnpj>89850341000160</numeroCnpj>
							   <numeroCei></numeroCei>
							   <inscricaoEstadual></inscricaoEstadual>
							   <inscricaoMunicipal></inscricaoMunicipal>
							   <observacao></observacao>
							   <telefoneCat>5421099418</telefoneCat>
							   <endereco>
								  <bairro>Alto da Expectativa</bairro>
								  <cep>62040125</cep>
								  <cidade>Sobral</cidade>
								  <codigoMunicipio>2312908</codigoMunicipio>
								  <complemento></complemento>
								  <endereco>Av Pimentel Gomes, 214</endereco>
								  <estado>CE</estado>
							   </endereco>
							   <codigoCnae>1533500</codigoCnae>
							   <descricaoCnae>Fabricação de calçados de material sintético</descricaoCnae>							   
							</dadosEmpresaWsVo>
							<codigo>582138</codigo>
							<tipoBusca>CODIGO_SOC</tipoBusca>
							<ativo>S</ativo>
						';
				 */
				 //$l_option = array('trace'=> true, 'cache_wsdl' => WSDL_CACHE_NONE, 'soap_version' => SOAP_1_1, 'exeptions' => true);
				 
				 $l_option = array( 
					 'soap_version'=> SOAP_1_1, 
					 'encoding'=>'UTF-8',
					  'trace' => 1, 
        'exceptions' => true,
        'cache_wsdl' => WSDL_CACHE_NONE
				 );
				 
				 //$l_option = array('codigoEmpresaPrincipal'=> $l_cod_empresa, 'codigoResponsavel' => $l_cod_responsavel, 'codigoUsuario' => $l_cod_usuario);
				 
				 try{
     		
					// $l_client = new SoapClient($l_url,$l_option);
					 header('Content-Type: text/plain; charset=UTF-8');
					 $l_client = new SoapClient($l_url, $l_option);
					 
					 $header = soapClientWSSecurityHeader($l_cod_empresa,$l_chave_acesso);
					
					 $l_client->__setSoapHeaders($header); 
					 					 
					 $l_xml_request_array =  
					array('AlterarEmpresaWsVo' =>
						  array('identificacaoWsVo'=> 
								array('codigoEmpresaPrincipal'=> 521389,
									  'codigoResponsavel'=> 304643,
									  'codigoUsuario'=>338074,
									  'homologacao' => 'S')),										   
						  array('dadosEmpresaWsVo'=> 
								array('nomeAbreviado' => 'Grendene',
									  'razaoSocial'=> 'GRENDENE S A',
									  'numeroCnpj'=> '89850341000160')
							   )
						  );
					 $l_xml_request_array['AlterarEmpresaWsVo']['dadosEmpresaWsVo'] = array('nomeAbreviado' => 'Grendene',
									  'razaoSocial'=> 'GRENDENE S A',
									  'numeroCnpj'=> '89850341000160');
					 $l_xml_request_array['AlterarEmpresaWsVo']['identificacaoWsVo'] = array('codigoEmpresaPrincipal'=> 521389,
									  'codigoResponsavel'=> 304643,
									  'codigoUsuario'=>338074,
									  'homologacao' => 'S');					 
					 $l_xml_request_array['AlterarEmpresaWsVo']['tipoBusca'] = 'CODIGO_SOC';
					 $l_xml_request_array['AlterarEmpresaWsVo']['codigo'] = 582138;
					 
					 $l_xml_request_array = (object) $l_xml_request_array;
					 
					 try{
						 
						 if($l_metodo == 'incluirEmpresa'){
							 
							 $l_ret = $l_client->incluirEmpresa($l_xml_request_array);
						 
						 }else{	
							 
							 $l_ret = $l_client->alterarEmpresa($l_xml_request_array);					 
						 
						 }
						 
						 //return $l_ret->EmpresaRetorno;
						 
						 if($l_metodo == 'incluirEmpresa'){
							 $l_retorno['msg'] = $l_ret->incluirEmpresaResponse->EmpresaRetorno->informacaoGeral->mensagem;
							 $l_retorno['codigoMensagem'] =$l_ret->incluirEmpresaResponse->EmpresaRetorno->informacaoGeral->codigoMensagem;
							 $l_retorno['codigoEmpresa'] =$l_ret->incluirEmpresaResponse->EmpresaRetorno->codigo;
							 $l_retorno['acao']= $l_acao; 	
							 $l_retorno['erro'] = $l_ret->incluirEmpresaResponse->EmpresaRetorno->informacaoGeral->numeroErros;
							 
							 if($l_retorno['codigoMensagem'] == 'SOC-100'){
								 
								 //m_integra_pj_unidade_s5($p_id_empresa, $l_empresa_matriz, $l_retorno['codigoEmpresa']);
								 
								 /*sc_exec_sql ("INSERT INTO tbl_empresa_unidade_s5 
								     		(id_empresa, cnpj, codigo_empresa_s5, codigo_unidade_s5, 
											matriz, login_cadastro, data_cadastro) 
											VALUES ('".$p_id_empresa."', '".{rs_dados_empresa[0][1]}."', '".$l_retorno['codigoEmpresa']."', 
											'".$l_retorno['codigoUnidade']."', '".$l_empresa_matriz."', '".$l_login."', getdate() )");*/							 
							 }
						 
						 }else{	
							 
							  $l_retorno['msg'] = $l_ret->EmpresaRetorno->informacaoGeral->mensagem;
							  $l_retorno['codigoMensagem'] = $l_ret->EmpresaRetorno->informacaoGeral->codigoMensagem;
							  $l_retorno['codigoEmpresa'] = $l_ret->EmpresaRetorno->codigo;
							  $l_retorno['acao']= $l_acao; 		
							  $l_retorno['erro'] = $l_ret->EmpresaRetorno->informacaoGeral->numeroErros;
						 }					
						 
						 /*sc_exec_sql("
								update tbl_crm_log_pj_s5 set
								acao = '".$l_acao."',
								xml_request  = '".$l_xml_request."',
								retorno_erro = ".$l_retorno['erro'].",
								retorno_msg  = '".$l_retorno['msg']."'
							where id = '".{rs_id_log[0][0]}."'
						");*/
						 
						 return $l_retorno;						 
						 
					 } catch(SoapFault $exception) { // Tentativa de chamar a funcao do WS

						 $l_retorno['erro'] = 1;
						 $l_retorno['msg']  = mssql_quote_fix($exception->__toString());	
						 
						/* sc_exec_sql("
								update tbl_crm_log_pj_s5 set
								acao = '".$l_acao."',
								xml_request  = '".$l_xml_request."',
								retorno_erro = ".$l_retorno['erro'].",
								retorno_msg  = 'Funcao WS".$l_retorno['msg']."'
							where id = '".{rs_id_log[0][0]}."'
						");*/
						 
						 return $l_retorno;
			
					} //FIM do try-catch chamada da função					 
				 
				 } catch(SoapFault $exception) {
			
					$l_retorno['erro'] = 1;
					$l_retorno['msg']  = mssql_quote_fix($exception->__toString());	
					  sc_exec_sql("
							update tbl_crm_log_pj_s5 set
							acao = '".$l_acao."',
							xml_request  = '".$l_xml_request."',
							retorno_erro = ".$l_retorno['erro'].",
							retorno_msg  = 'Conexao WS|".$l_retorno['msg']."'
						where id = '".{rs_id_log[0][0]}."'
					");
					 
					 return $l_retorno;
					 
				}//Fim do Try-Catch conexao WS	
								
			 }		 
		 }
	}

	
function soapClientWSSecurityHeader($user, $password)
   {
	
	$tm_created   = gmdate('Y-m-d\TH:i:s\Z', strtotime("-1 minutes"));
	$tm_expires = gmdate('Y-m-d\TH:i:s\Z', strtotime("2 minutes"));
      // Creating date using yyyy-mm-ddThh:mm:ssZ format
   //   $tm_created = gmdate('Y-m-d\TH:i:s\Z');
   //   $tm_expires = gmdate('Y-m-d\TH:i:s\Z', gmdate('U') + 180); //only necessary if using the timestamp element

      // Generating and encoding a random number
      $simple_nonce = mt_rand();
      $encoded_nonce = base64_encode($simple_nonce);

      // Compiling WSS string
      $passdigest = base64_encode(sha1($simple_nonce . $tm_created . $password, true));

      // Initializing namespaces
      $ns_wsse = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
      $ns_wsu = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
      $password_type = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest';
      $encoding_type = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary';

      // Creating WSS identification header using SimpleXML
      $root = new SimpleXMLElement('<root/>');

      $security = $root->addChild('wsse:Security', null, $ns_wsse);

      //the timestamp element is not required by all servers
      $timestamp = $security->addChild('wsu:Timestamp', null, $ns_wsu);
      $timestamp->addAttribute('wsu:Id', 'TS-32E6B34377D7E4A58614607283662392');
      $timestamp->addChild('wsu:Created', $tm_created, $ns_wsu);
      $timestamp->addChild('wsu:Expires', $tm_expires, $ns_wsu);

      $usernameToken = $security->addChild('wsse:UsernameToken', null, $ns_wsse);
	$usernameToken->addAttribute('wsu:Id', 'UsernameToken-32E6B34377D7E4A58614607283662221');
      $usernameToken->addChild('wsse:Username', $user, $ns_wsse);
      $usernameToken->addChild('wsse:Password', $passdigest, $ns_wsse)->addAttribute('Type', $password_type);
      $usernameToken->addChild('wsse:Nonce', $encoded_nonce, $ns_wsse)->addAttribute('EncodingType', $encoding_type);
      $usernameToken->addChild('wsu:Created', $tm_created, $ns_wsu);

      // Recovering XML value from that object
      $root->registerXPathNamespace('wsse', $ns_wsse);
      $full = $root->xpath('/root/wsse:Security');
      $auth = $full[0]->asXML();

      return new SoapHeader($ns_wsse, 'Security', new SoapVar($auth, XSD_ANYXML), true);
   }

	function m_integra_pj_unidade_s5($p_id_empresa, $l_empresa_matriz = null, $l_cod_empresa_vinculo = null){
		
		$l_retorno  = array();
		$l_retorno['msg']="";
		$l_retorno['erro'] = 0;
		$l_url = "";
	
		sc_lookup(rs_dados_empresa, "
			SELECT
			  e.id            as id,
			  e.cgc 		  as cnpj,
			  e.razao_social  as razao_social,
			  e.nome_fantasia as nome_fantasia,
			  case when ce.cei like '%X%' then '' else ce.cei end as cei,
			  e.inscricao_estadual,
			  e.inscricao_municipal,
			  e.observacao,
			  e.fone_1,
			  e.endereco,
			  e.id_cnae_principal as cod_cnae,
			  rtrim(c.cnae)       as descricao_cnae,
			  tb2.descricao       as bairro,
			  e.cep,
			  e.id_municipio      as cod_municipio,
			  tm.descricao  	  as cidade,
			  e.estado 		      as uf,
			  e.complemento,
			  CONVERT(nvarchar(30), DATEADD(hh, 3, getdate()), 127) as data_criacao,
			  CONVERT(nvarchar(30), DATEADD(mi, 2, DATEADD(hh, 3, getdate())), 127) as data_expiracao 
			FROM
			  empresas e
			  LEFT JOIN tbl_crm_cei ce ON e.id = ce.id_empresa
			  LEFT JOIN tbl_cnae2 c ON e.id_cnae_principal = c.cod_cnae
			  LEFT JOIN tbl_municipio tm ON tm.id = e.id_municipio
			  LEFT JOIN tbl_bairro tb2 ON tb2.id = e.id_bairro  
			WHERE e.informal = 'N'
			  AND e.id = $p_id_empresa		
		");
	
		 if(empty({rs_dados_empresa})){
			 
			 $l_retorno['erro'] = 1;
			 $l_retorno['msg']  = 'Empresa não identificada';		                 
             
			 return $l_retorno;
			 
         }else{
			 
			 $l_url = m_getEnderecoUnidade(); 
 
             if(!$l_url){ 
				 
				 $l_retorno['erro'] = 1;
				 $l_retorno['msg']  = 'Servidor não encontrado!';   
				 
				 return $l_retorno;                
				 
             }else {
				 
				 $l_cod_transacao = md5(uniqid(rand(), true));
				 
				 $l_password_digest = base64_encode(sha1($l_cod_transacao.{rs_dados_empresa[0][18]}.'Z'.'4939a9536ea95ba', true)); // nonce + data de criação (Created) + chaveAcesso
				 $l_cod_transacao   = base64_encode($l_cod_transacao);
				 
				 $l_login = 'erpessoa';  //[visit_login]
				 
				 $l_query = " 
                    insert into tbl_crm_log_pj_s5 ( 
                    id_empresa, url_wsdl, cod_transacao, login_cadastro, data_cadastro 
                    ) 
                    values ( 
                        '".$p_id_empresa."', '".$l_url."', '".$l_cod_transacao."', '".$l_login."', getdate() 
                    ); 
                "; 
                 
                sc_exec_sql($l_query); 

                sc_lookup(rs_id_log, "SELECT IDENT_CURRENT('tbl_crm_log_pj_s5')");
				 
				 sc_lookup(rs_empresa_s5, "select id from tbl_empresa_unidade_s5 where id_empresa = '".$p_id_empresa."' and matriz = 'N'");
				 
				 if((empty({rs_empresa_s5[0][0]}) and $l_empresa_matriz == 'S') || (empty({rs_empresa_s5[0][0]}) and $l_empresa_matriz == null)){	
					 $l_acao_2 = 'incluir';
				 }else{
					 $l_acao_2 = 'alterar';
				 }
				 
				 sc_lookup(rs_parametros_unidade, "select codigo_empresa_principal_s5, codigo_responsavel_s5, codigo_usuario_s5 from tbl_parametros_s5 where id_unidade = 49");
				 
				 if(!empty({rs_parametros_unidade})){
					 $l_cod_empresa     = {rs_parametros_unidade[0][0]};
					 $l_cod_responsavel = {rs_parametros_unidade[0][1]};
					 $l_cod_usuario     = {rs_parametros_unidade[0][2]};				 
				 }else{
					 $l_retorno['erro'] = 1;
				 	 $l_retorno['msg']  = 'Unidade sem permissão de acesso para integração!'; 
					 return $l_retorno;					 	
				 }
				 
				 if($l_empresa_matriz == 'S'){
					 
					 $l_codigo_empresa_matriz = $l_cod_empresa_vinculo;
				 
				 }else{
					 
					 $l_empresa_matriz = 'N';
					 
					 sc_lookup(rs_raiz_cnpj, "select SUBSTRING(cgc, 1, 8)cgc from empresas where id = '".$p_id_empresa."'");
				 
					 if(!empty({rs_raiz_cnpj[0][0]})){

						 $l_raiz_cnpj = {rs_raiz_cnpj[0][0]};

						 sc_lookup(rs_empresa_matriz, "select codigo_empresa_s5 from tbl_empresa_unidade_s5 where cnpj like '".$l_raiz_cnpj."%' and matriz = 'S'");

						 if(!empty({rs_empresa_matriz[0][0]})){
							 $l_codigo_empresa_matriz = {rs_empresa_matriz[0][0]};					 
						 }else{
							 $l_retorno['erro'] = 1;
							 $l_retorno['msg']  = 'Não foi localizado a empresa matriz para realização do vínculo!'; 
							 return $l_retorno;	
						 }				 
					 }				 
				 }			 
				 				 
				 $l_xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.soc.age.com/">
				    <soapenv:Header>
						<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
							<wsu:Timestamp wsu:Id="TS-32E6B34377D7E4A58614607283662392">
								<wsu:Created>'.{rs_dados_empresa[0][18]}.'Z</wsu:Created>
								<wsu:Expires>'.{rs_dados_empresa[0][19]}.'Z</wsu:Expires>
							</wsu:Timestamp>
							<wsse:UsernameToken wsu:Id="UsernameToken-32E6B34377D7E4A58614607283662221">
								<wsse:Username>'.$l_cod_empresa.'</wsse:Username>
								<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">'.$l_password_digest.'</wsse:Password>
								<wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">'.$l_cod_transacao.'</wsse:Nonce>
								<wsu:Created>'.{rs_dados_empresa[0][18]}.'Z</wsu:Created>
							</wsse:UsernameToken>
						</wsse:Security>
				   </soapenv:Header>
				   <soapenv:Body>
					  <ser:'.$l_acao_2.'Unidade>
					  		<unidade>
								<ativo>S</ativo>
								<bairro>'.{rs_dados_empresa[0][12]}.'</bairro>
								<cep>'.{rs_dados_empresa[0][13]}.'</cep>
								<cidade>'.{rs_dados_empresa[0][15]}.'</cidade>
								<cnpj_cei>'.{rs_dados_empresa[0][1]}.'</cnpj_cei>
								<codigoCnae>'.{rs_dados_empresa[0][10]}.'</codigoCnae>
								<codigoEmpresa>'.$l_codigo_empresa_matriz.'</codigoEmpresa>
								<codigoMunicipio>'.{rs_dados_empresa[0][14]}.'</codigoMunicipio>
								<complemento>'.{rs_dados_empresa[0][17]}.'</complemento>
								<descricaoCnae>'.{rs_dados_empresa[0][11]}.'</descricaoCnae>
								<endereco>'.{rs_dados_empresa[0][9]}.'</endereco>
								<estado>'.{rs_dados_empresa[0][16]}.'</estado>
								<identificacaoWsVo>
								   <codigoEmpresaPrincipal>'.$l_cod_empresa.'</codigoEmpresaPrincipal>
								   <codigoResponsavel>'.$l_cod_responsavel.'</codigoResponsavel>
								   <codigoUsuario>'.$l_cod_usuario.'</codigoUsuario>
								</identificacaoWsVo>
								<inscricaoEstadual>'.{rs_dados_empresa[0][5]}.'</inscricaoEstadual>
								<inscricaoMunicipal>'.{rs_dados_empresa[0][6]}.'</inscricaoMunicipal>
								<nome>'.{rs_dados_empresa[0][3]}.'</nome>
								<razaoSocial>'.{rs_dados_empresa[0][2]}.'</razaoSocial>
								<telefoneCat>'.{rs_dados_empresa[0][8]}.'</telefoneCat>
							 </unidade>
					  </ser:'.$l_acao_2.'Unidade>
				   </soapenv:Body>
				</soapenv:Envelope>';				 
			 
			    //return $l_xml_request;
				
				$l_option = array('trace'=> true, 'cache_wsdl' => WSDL_CACHE_NONE, 'soap_version' => SOAP_1_1, 'exeptions' => true);
				 
				try{
     		
					//$l_client = new SoapClient($l_url,$l_option);
					 $l_client = new SoapClient($l_url); 
				 
				 
					try{

						if($l_acao_2 == 'incluir'){

								 $l_ret = $l_client->incluirUnidade($l_xml_request);

							 }else{	

								 $l_ret = $l_client->alterarUnidade($l_xml_request);							 

							 }

						if($l_acao_2 == 'incluir'){
							
							$l_retorno['codigoUnidade'] = $l_ret->incluirUnidadeResponse->UnidadeRetorno->codigo;
							$l_retorno['codigoEmpresa'] = $l_ret->incluirUnidadeResponse->UnidadeRetorno->codigoEmpresa;
							$l_retorno['acao']= $l_acao_2; 	
							
							if($l_retorno['codigoUnidade']){
								$l_retorno['msg']  = 'Operação realizada com sucesso!';
								$l_retorno['erro'] = 0;								
									
								sc_exec_sql ("INSERT INTO tbl_empresa_unidade_s5 
								     	(id_empresa, cnpj, codigo_empresa_s5, codigo_unidade_s5, 
										matriz, login_cadastro, data_cadastro, login_alteracao, data_alteracao) 
										VALUES ('".$p_id_empresa."', '".{rs_dados_empresa[0][1]}."', '".$l_retorno['codigoEmpresa']."', 
										'".$l_retorno['codigoUnidade']."', '".$l_empresa_matriz."', '".$l_login."', getdate(), '".$l_login."', getdate())");	
							
							}else{
								$l_retorno['msg']  = $l_ret->Fault->faultstring;
								$l_retorno['codigoMensagem'] = $l_ret->Fault->faultcode;
								$l_retorno['erro'] = 1;							
							}

						}else{
							
							$l_retorno['codigoUnidade'] = $l_ret->alterarUnidadeResponse->UnidadeRetorno->codigo;
							$l_retorno['codigoEmpresa'] = $l_ret->alterarUnidadeResponse->UnidadeRetorno->codigoEmpresa;
							$l_retorno['acao']= $l_acao_2; 	
							
							if($l_retorno['codigoUnidade']){
								$l_retorno['msg']  = 'Operação realizada com sucesso!';
								$l_retorno['erro'] = 0;
							
							}else{
								$l_retorno['msg']  = $l_ret->Fault->faultstring;
								$l_retorno['codigoMensagem'] = $l_ret->Fault->faultcode;
								$l_retorno['erro'] = 1;							
							}
						}					

						/*sc_exec_sql("
									update tbl_crm_log_pj_s5 set
									acao = '".$l_acao."',
									xml_request  = '".$l_xml_request."',
									retorno_erro = ".$l_retorno['erro'].",
									retorno_msg  = '".$l_retorno['msg']."'
								where id = '".{rs_id_log[0][0]}."'
							");*/

						return $l_retorno;

					}catch (SoapFault $exception){
						$l_retorno['erro'] = 1;
						$l_retorno['msg']  = mssql_quote_fix($exception->__toString());	

						/* sc_exec_sql("
									update tbl_crm_log_pj_s5 set
									acao = '".$l_acao."',
									xml_request  = '".$l_xml_request."',
									retorno_erro = ".$l_retorno['erro'].",
									retorno_msg  = 'Funcao WS".$l_retorno['msg']."'
								where id = '".{rs_id_log[0][0]}."'
							");*/

						return $l_retorno;
					} //FIM do try-catch chamada da função
				 
				}catch(SoapFault $exception) {
			
					$l_retorno['erro'] = 1;
					$l_retorno['msg']  = mssql_quote_fix($exception->__toString());	
					  sc_exec_sql("
							update tbl_crm_log_pj_s5 set
							acao = '".$l_acao."',
							xml_request  = '".$l_xml_request."',
							retorno_erro = ".$l_retorno['erro'].",
							retorno_msg  = 'Conexao WS|".$l_retorno['msg']."'
						where id = '".{rs_id_log[0][0]}."'
					");
					 
					 return $l_retorno;

				}//Fim do Try-Catch conexao WS	
			
			 }		 
		 }
	}

	function m_integra_pf_s5($p_id_cadastro){
		
		sc_lookup(rs_dados_pf, "
			SELECT 
				c.id_aluno,
				c.nome,
				c.cpf,
				convert(varchar(10),c.data_nasc,103) as data_nascimento,
				c.identidade,
				c.orgao_expedidor,
				c.uf_orgao_expedidor,
				c.nome_mae,
				c.cep,
				c.endereco,
				b.descricao as bairro,
				m.descricao as cidade,
				m.id as cod_municipio,
				c.estado as uf,
				c.sexo,
				c.fone,
				c.celular,
				mu.descricao as naturalidade,
				ec.cod_s5 as estado_civil,
				cc.cod_matricula_func,
				convert(varchar(10),cc.data_admissao,103) as data_admissao,
				c.email,
				d.descricao as setor,
				cc.cargo,
				c.pis_nis,  
				cb.id as cod_cbo,
				c.codigo_cliente_s5,
				em.cgc as cnpj,
				em.razao_social
			FROM cadastro c
			LEFT JOIN tbl_crm_cadastro_complemento cc ON  cc.id_cadastro = c.id_aluno
			LEFT JOIN tbl_crm_cadastro_especialidade ce ON ce.id_cadastro = c.id_aluno
			LEFT JOIN tbl_crm_especialidade e ON e.id = ce.id_especialidade
			LEFT JOIN tbl_bairro b ON b.id = c.id_bairro
			LEFT JOIN tbl_municipio m ON m.id = c.id_municipio
			LEFT JOIN tbl_municipio mu ON mu.id = c.id_naturalidade
			LEFT JOIN tbl_estado_civil ec ON ec.id = c.id_estado_civil
			LEFT JOIN tbl_crm_departamento d ON d.id = cc.id_departamento
			LEFT JOIN cbo cb ON cb.id = cc.id_cbo
			LEFT JOIN empresas em ON em.id = cc.id_empresa_vinc_emprego
			WHERE c.id_aluno = $p_id_cadastro		
		");
		
		if(empty({rs_dados_pf})){     
             return array (  
                 0 => false, 
                 1 => 'Cliente não identificado!' 
             ); 
         }else{
			 
			 //$l_url = m_getEndereco(); 
 
             if(!$l_url){ 
                 return array (  
                     0 => false, 
                     1 => 'Servidor não encontrado!' 
                 );
				 
             }else { 
				 
				 $l_query = " 
                    insert into tbl_crm_log_pf_s5 ( 
                    id_cadastro, url_wsdl, login_cadastro, data_cadastro 
                    ) 
                    values ( 
                        '".$p_id_cadastro."', '".$l_url."', '".[visit_login]."', getdate() 
                    ); 
                "; 
                 
                sc_exec_sql($l_query); 

                sc_lookup(rs_id_log, " 
                    select top 1 
                        id,  
                        convert(date, data_cadastro),  
                        left(convert(time, data_cadastro), 8) 
                    from tbl_crm_log_pf_s5 where id_empresa = '".$p_id_cadastro."' 
                    order by id desc 
                ");
				 
				 /*if(!empty({rs_dados_empresa[0][27]})){					 
					 $l_acao   = 'Incluir';	
					 $l_acao_2 = 'incluir';
				 }else{
					 $l_acao   = 'Alterar';
					 $l_acao_2 = 'alterar';
				 }*/
				 				 
				 $l_xml_request = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://services.soc.age.com/">
					   <soapenv:Body>
						  <ser:importacaoFuncionario>
							 <Funcionario>
								<atualizarFuncionario>?</atualizarFuncionario>
								<cargoWsVo>
								   <atualizaDescricaoRequisitosCargoPeloCbo>?</atualizaDescricaoRequisitosCargoPeloCbo>
								   <cbo>'.{rs_dados_pf[0][26]}.'</cbo>
								   <nome>'.{rs_dados_pf[0][24]}.'</nome>
								</cargoWsVo>
								<criarFuncionario>?</criarFuncionario>
								<destravarFuncionarioBloqueado>?</destravarFuncionarioBloqueado>
								<funcionarioWsVo>
								   <bairro>'.{rs_dados_pf[0][11]}.'</bairro>
								   <cep>'.{rs_dados_pf[0][9]}.'</cep>
								   <chaveProcuraFuncionario>CPF</chaveProcuraFuncionario>
								   <cidade>'.{rs_dados_pf[0][12]}.'</cidade>
								   <cnpjEmpresaFuncionario>'.{rs_dados_pf[0][28]}.'</cnpjEmpresaFuncionario>
								   <codigoMunicipio>'.{rs_dados_pf[0][13]}.'</codigoMunicipio>
								   <cpf>'.{rs_dados_pf[0][3]}.'</cpf>
								   <dataAdmissao>'.{rs_dados_pf[0][21]}.'</dataAdmissao>
								   <dataNascimento>'.{rs_dados_pf[0][4]}.'</dataNascimento>
								   <email>'.{rs_dados_pf[0][22]}.'</email>
								   <endereco>'.{rs_dados_pf[0][10]}.'</endereco>
								   <estado>'.{rs_dados_pf[0][14]}.'</estado>
								   <estadoCivil>'.{rs_dados_pf[0][19]}.'</estadoCivil>
								   <matricula>'.{rs_dados_pf[0][20]}.'</matricula>
								   <naturalidade>'.{rs_dados_pf[0][18]}.'</naturalidade>
								   <nomeFuncionario>'.{rs_dados_pf[0][2]}.'</nomeFuncionario>
								   <nomeMae>'.{rs_dados_pf[0][8]}.'</nomeMae>
								   <pis>'.{rs_dados_pf[0][25]}.'</pis>
								   <razaoSocialEmpresaFuncionario>'.{rs_dados_pf[0][29]}.'</razaoSocialEmpresaFuncionario>
								   <regimeTrabalho>Normal</regimeTrabalho>
								   <rg>'.{rs_dados_pf[0][5]}.'</rg>
								   <rgOrgaoEmissor>'.{rs_dados_pf[0][6]}.'</rgOrgaoEmissor>
								   <rgUf>'.{rs_dados_pf[0][7]}.'</rgUf>
								   <sexo>'.{rs_dados_pf[0][15]}.'</sexo>
								   <situacao>Ativo</situacao>
								   <telefoneCelular>'.{rs_dados_pf[0][17]}.'</telefoneCelular>
								   <telefoneResidencial>'.{rs_dados_pf[0][16]}.'</telefoneResidencial>
								   <tipoContratacao>CLT</tipoContratacao>
								</funcionarioWsVo>
								<identificacaoWsVo>
								   <chaveAcesso>?</chaveAcesso>
								   <codigoEmpresaPrincipal>?</codigoEmpresaPrincipal>
								   <codigoResponsavel>?</codigoResponsavel>
								   <codigoUsuario>?</codigoUsuario>
								</identificacaoWsVo>
								 <naoImportarFuncionarioSemHierarquia>?</naoImportarFuncionarioSemHierarquia>
							  </Funcionario>
						  </ser:importacaoFuncionario>
					   </soapenv:Body>
					</soapenv:Envelope>';
			 
			    //return $l_xml_request;
				 
				try {
					/*$l_client = new SoapClient($l_url);

					$l_response = $l_client->IncluirSolicitacao(
						array('value' => $l_xml_request)
					);

					$l_xml_response = simplexml_load_string($l_response->IncluirSolicitacaoResult);		

					$l_retorno_ws[1] = $l_xml_response->atendimento->atendimentoRetorno->retornos->retorno->descricaoRetorno;

					if($l_xml_response->atendimento->atendimentoRetorno->haErros == 'N'){
						$l_retorno_ws[0] = 1;
					}
					else{
						$l_retorno_ws[0] = 0;
					}*/
				}
				catch (Exception $e){
					//$l_retorno_ws = array (0, $e->getMessage());
				}
				

				/*if($l_retorno_ws[0]){
					foreach({rs_dados} as $l_row){
						sc_exec_sql("
							update tbl_crm_atendimento_saude_servico 
							set integracao_softlab = 'S'
							where id = '".$l_row[1]."';
						");
					}
				}*/
				 
				$l_acao = substr($l_acao, 0); 

				/*sc_exec_sql("
					update tbl_crm_log_pf_s5 set
						acao = '".$l_acao."',
						xml_request  = '".$l_xml_request."',
						retorno_erro = '".$l_retorno_ws[0]."',
						retorno_msg  = '".$l_retorno_ws[1]."'
					where id = '".{rs_id_log[0][0]}."';
				");
				
				return array ( 
					0 => $l_retorno_ws[0],
					1 => $l_retorno_ws[1]
				);*/
			 
			 }		 
		 }	
	}
?>