<?php 
    use \Rsbebook\Component\Rsbebook\Site\Controller\EbooksController;

    $concentimentoUso = EbooksController::getTermos(8563);
    $licencaUso = EbooksController::getTermos(8562);
?>
<div class="modal fade" id="formEbook" aria-hidden="true" aria-labelledby="formEbookLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formEbookLabel">Modal 1</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formulario-ebook">
                    <form method="POST" action="" class="form-ebooks" id="form-ebooks" >

                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Seu Nome</label>
                            <input class="form-control text" type="text" name="nome" placeholder="Seu Nome" value="" />
                        </div>

                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Seu E-mail</label>
                            <input class="form-control text" type="email" name="email" placeholder="Seu E-mail" value="" />
                        </div>

                        <div class="form-check">
                            <input class="form-check-input check" type="checkbox" id="check-aceite-licenca" name="termo_licenca_uso" />
                            <label class="form-check-label label-check" for="check-aceite-licenca" data-bs-target="#termoLicencaUso" data-bs-toggle="modal"> Concordo com os <span style="color: #3c65c0; cursor: pointer;">termos de Licença de uso</span>. </label>
                        </div>

                        <input type="hidden" name="ebookid" />

                        <div class="form-check">
                            <input class="form-check-input check" type="checkbox" id="check-aceite-uso" name="termo_consentimento_uso" />
                            <label class="form-check-label label-check" for="check-aceite-uso"> Concordo com os <span style="cursor: pointer; color: #3c65c0;">termos de Consentimento de uso</span>. </label>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="">
                        <button class="btn btn-azul" data-enviar-ebook>Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--button class="btn btn-primary" data-bs-target="#termoLicencaUso" data-bs-toggle="modal">Enviar</button-->


<div class="modal fade" id="termoLicencaUso" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">TERMO DE LICENÇA DE USO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $licencaUso->introtext;?>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button class="btn btn-primary aceiteOk" >Aceito</button>
            </div>
        </div>
    </div>
</div>
