<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


<div class="wrap">
    <h2>Configurações do Plugin de Integração com o ACSnet</h2>
<br>
    <form method="post" id="form">
        <input type="hidden" name="action" value='piacs_saveSettings'>
        
        <div class="tabs">
            <ul id="tabs-nav">
                <li><a href="#geral">Geral</a></li>
                <li><a href="#products">Produtos</a></li>
                <li><a href="#orders">Pedidos</a></li>
                <li><a href="#nfe">NFe</a></li>
                <li><a href="#logs">Logs</a></li>
            </ul>

            <div id="tabs-content">
                <div id="geral" class="tab-content">
                    <?php require_once "admin_home.php" ?>
                </div>

                <div id="products" class="tab-content">
                    <?php require_once "admin_products.php" ?>
                </div>

                <div id="orders" class="tab-content">
                    <?php require_once "admin_orders.php" ?>
                </div>

                <div id="nfe" class="tab-content">
                    <?php require_once "admin_nfe.php" ?>
                </div>

                <div id="logs" class="tab-content">
                    <?php require_once "admin_logs.php" ?>
                </div>

            </div>
        </div>

        <br>
        <a href="#" id='salvar' class="button button-primary" onclick="salvar()"><span>Salvar Dados </span></a>

    </form>
</div>

<style type="text/css">
    ul#tabs-nav {
      list-style: none;
      margin: 0;
      padding: 5px;
      overflow: auto;
      border-top: 1px solid #000;
    }
    ul#tabs-nav li {
      float: left;
      margin-right: 2px;
      padding: 8px 10px;
      border-bottom: none;
      cursor: pointer;
    }
    ul#tabs-nav li:hover,
    ul#tabs-nav li.active {
      border: 1px double;
      background-color: #EEE;
    }
    #tabs-nav li a {
      color: #000;
    }
    .tab-content {
      padding: 10px;
      background-color: #FFF;
    }
</style>

<script type="text/javascript">

    // Show the first tab and hide the rest
    jQuery('#tabs-nav li:first-child').addClass('active');
    jQuery('.tab-content').hide();
    jQuery('.tab-content:first').show();

    // Click function
    jQuery('#tabs-nav li').click(function(){
        jQuery('#tabs-nav li').removeClass('active');
        jQuery(this).addClass('active');
        jQuery('.tab-content').hide();

        var activeTab = jQuery(this).find('a').attr('href');
        jQuery(activeTab).fadeIn();
        return false;
    });






    function salvar(element){
        var load = jQuery('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="sr-only">Loading...</span>');

        jQuery('#salvar').prop("disabled",true).find('span').append(load);
        jQuery("#campos_getprod_input").val(JSON.stringify(jQuery("#campos_getprod").val()))

        jQuery.ajax({
            type: "POST",
            url: "<?= admin_url( 'admin-ajax.php' ) ?>",

            data: jQuery('#form').serialize(),
            success: function (output) {
                window.location.reload();
            }
        });
    };

</script>