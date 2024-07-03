<?php if(!count($acervo)):?>
    <div class="acervo-escolha">
        <?php if($tratamento): ?>
            Escolha um(a) <br><?= $tratamento ;?>(a) ao lado
            <?php else: ?>
            Escolha uma <br>opção ao lado 
        <?php endif;?>
    </div>
<?php endif;?>


<?php if(isset($_GET['open'])): ?>
    <span id="acervo-salesiano"></span>
<?php endif;?>

<div class="acervo-santidade">
    <div class="acervo-santidade-info info-<?= $type;?>">
        <?php foreach($acervo as $download): ?>
            <div class="download-item">
                <a href="<?= $download->arquivo;?>" target="_blank">
                    <span class="download-text">
                        <?= $download->title;?>
                    </span>
                    <span class="download-button zoomText">
                        <i class="fas fa-download"></i>
                        <span>Download</span>
                    </span>
                </a>
            </div>
        <?php endforeach;?>
    </div>
</div>



<?php 

$doc->addScriptDeclaration("
jQuery(function($){
	$( document ).ready( function() {
		let dataCor = $('#rsb-padrao-category').find('a.active').data('color')
        dataCor = dataCor.replace('color-hover','background')
		$('.info-download').find('.download-button').addClass(dataCor)
	} )
})
");