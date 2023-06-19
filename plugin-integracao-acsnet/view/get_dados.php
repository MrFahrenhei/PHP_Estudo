<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<div class="wrap">
    <h2>Busca de Produtos no WebService</h2>
    <br><br><br>

    <button id='button' class="button button-primary" onclick="getDados(this)"><span>Consulta Produtos no WebService</span></button>
    
    <br><br><br>

    <div style="display:none" id="success" class="alert alert-success" role="alert">
        Tudo certo com a atualização de produtos a partir do Web Service. Foram lidos <b><span id="tot"></span></b> produtos no WebService.
    </div>

    <div style="display:none" id="zero" class="alert alert-warning" role="alert">
        Foi possível conectar no Webservice mas ele esta retornando uma lista vazia de produtos.
    </div>    

    <div style="display:none" id="error" class="alert alert-danger" role="alert">
        Ocorreu um erro ao consultar os produtos no Web Service.
    </div>

    <div style="display:none" class="progress">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
    </div>


</div>


<script type="text/javascript">
	
function getDados(element){
    jQuery(element).prop("disabled",true);
    jQuery('.alert').fadeOut('fast');
    jQuery('.progress').fadeIn();

    jQuery.ajax({
        type: "POST",
        url: "<?= admin_url( 'admin-ajax.php' ) ?>",
        data: {
            action: 'piacs_getDados'
        },
        success: function (output){
            console.log(output);
            jQuery('.progress').fadeOut('normal', function(){
                jQuery('#tot').text(output);

                if(output == 0){
                    jQuery('#zero').fadeIn();
                }else{
                    jQuery('#success').fadeIn();
                }

            });
            jQuery(element).prop("disabled",false);
        },
        error: function (output){
            console.log(output);
            jQuery('.progress').fadeOut('normal', function(){
                jQuery('#error').fadeIn();
            });
            jQuery(element).prop("disabled",false);
                
        }


    });

};

</script>