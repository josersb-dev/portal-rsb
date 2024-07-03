<?php 
$acervo = $acervo[0];
?>

<?php if(!$acervo->title):?>
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
<?= $acervo->title ? '<h3>'.$acervo->title.'</h3>' : '';?>
    <div class="acervo-santidade-info info-<?= $type;?>">
        <?php if($acervo->imagem):?>
            <div class="santidade-info-img">
                <img src="<?= $acervo->imagem;?>" />
            </div>
        <?php endif;?>
    </div>
    <div class="santidade-resumo">
        <?= $acervo->descricao;?>
    </div>
</div>