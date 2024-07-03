<div class="modal fade" id="formEbook" aria-hidden="true" aria-labelledby="formEbookLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="formEbookLabel">Modal 1</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="formulario-ebook">
                    <form method="POST" action="https://www.rsb.org.br/newsletter/register" class="form-ebooks">
                        <span class="alert alert-danger">Preencha os dados abaixo e receba o e-book em seu e-mail!</span>
                        <input type="hidden" name="_token" value="BBMhOFMx1m73UEvJM5ZoTpWdh7hInFDuKd0N9Olv" />
                        <input type="hidden" name="ebook-id" value="1" />
                        <input type="hidden" name="module" value="ebook" />

                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Seu Nome</label>
                            <input class="form-control text" type="text" name="name" placeholder="Seu Nome" value="" />
                        </div>

                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Seu E-mail</label>
                            <input class="form-control text" type="email" name="email" placeholder="Seu E-mail" value="" />
                        </div>

                        <div class="form-check">
                            <input class="form-check-input check" type="checkbox" id="check-aceite-licenca" name="aceitar-termos-licenca" />
                            <label class="form-check-label label-check" for="check-aceite-licenca"> Concordo com os <span style="color: #3c65c0; cursor: pointer;">termos de Licença de uso</span>. </label>
                        </div>

                        <input type="text" name="ebookid" />

                        <div class="form-check">
                            <input class="form-check-input check" type="checkbox" id="check-aceite-uso" name="aceitar-termos-uso" />
                            <label class="form-check-label label-check" for="check-aceite-uso"> Concordo com os <span style="cursor: pointer; color: #3c65c0;">termos de Consentimento de uso</span>. </label>
                        </div>

                        <div class="btn-submit-ebook">
                            <button class="btn btn-azul">Enviaraaa</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Enviar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">TERMO DE LICENÇA DE USO</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">Hide this modal and show the first with the button below. <a class="aceiteOk" data-bs-target="#formEbook" data-bs-toggle="modal">Ok</a></div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#formEbook" data-bs-toggle="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>
<button class="btn btn-primary" data-bs-target="#formEbook" data-bs-toggle="modal">Open first modal</button>
