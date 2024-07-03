// Formatar telefone
function formatPhoneNumber(phoneNumber) {
    return phoneNumber ? phoneNumber.replace(/\D/g, '').replace(/(\d{2})(\d)/, '($1) $2').replace(/(\d)(\d{4})$/, '$1-$2') : '-';
 }
 
 // Limpar Nulos
 function cleanNull(str) {
    return str.split(null).join(' - ')
 }
 
 function alteraCorIcones(cor, icone) {
    $(`.icon-search, ${icone}`).attr('icon-fill', cor);
 }
 
 function selecionaItemMenu(nameClass) {
    $(nameClass).addClass('selected');
 }
 //Limpar apenas as informações
 $(document).on('change', '#select-estado', function (event) {
    event.preventDefault();
    $('.ondeEstamosInfo').html('').hide()
 })
 
 function selecionaEstadoMapa(uf) {
    if (uf != "") {
       selecionaEstado(uf);
       $('#select-estado').val(uf).attr('ufAnterior', uf);
    }
 }
 
 //ajax ou fetch para puxar unidades
 function getUnidades(uf) {
    console.log(siglaEstado(uf))
 }
 
 function selecionaEstadoMapa(uf) {
    if (uf != "") {
       selecionaEstado(uf);
       $('#select-estado').val(uf).attr('ufAnterior', uf);
    }
 }
 //ajax ou fetch para puxar unidades
 function getUnidades(uf) {
    console.log(siglaEstado(uf))
 }
 
 function siglaEstado(nomeEstado) {
    listaEstadoUF = [];
    listaEstadoUF["acre"] = 'AC'
    listaEstadoUF["alagoas"] = 'AL'
    listaEstadoUF["amapa"] = 'AP'
    listaEstadoUF["amazonas"] = 'AM'
    listaEstadoUF["bahia"] = 'BA'
    listaEstadoUF["ceara"] = 'CE'
    listaEstadoUF["distrito_federal"] = 'DF'
    listaEstadoUF["espirito_santo"] = 'ES'
    listaEstadoUF["goias"] = 'GO'
    listaEstadoUF["maranhao"] = 'MA'
    listaEstadoUF["mato_grosso"] = 'MT'
    listaEstadoUF["mato_grosso_do_sul"] = 'MS'
    listaEstadoUF["minas_gerais"] = 'MG'
    listaEstadoUF["para"] = 'PA'
    listaEstadoUF["paraiba"] = 'PB'
    listaEstadoUF["parana"] = 'PR'
    listaEstadoUF["pernambuco"] = 'PE'
    listaEstadoUF["piaui"] = 'PI'
    listaEstadoUF["rio_de_janeiro"] = 'RJ'
    listaEstadoUF["rio_grande_do_norte"] = 'RN'
    listaEstadoUF["rio_grande_do_sul"] = 'RS'
    listaEstadoUF["rondonia"] = 'RO'
    listaEstadoUF["Caminho_208"] = 'RR'
    listaEstadoUF["santa_catarina"] = 'SC'
    listaEstadoUF["sao_paulo"] = 'SP'
    listaEstadoUF["sergipe"] = 'SE'
    listaEstadoUF["tocantins"] = 'TO'
    return listaEstadoUF[nomeEstado]
 }
 
 function selecionaEstado(uf) {
    $('.ondeEstamosInfo').html(``);
    limpaMapa();
    $(`.mapa path#${uf}`).addClass('ufSelecionada');
    getTiposByEstadoArr(siglaEstado(uf))
    var unidades = document.getElementById('select-unidades');
    unidades.focus();
 }
 
 function limpaMapa() {
    $(`.mapa path`).attr('fill', '#F1F1F1').removeClass('ufSelecionada');
 }
 
 
 function changeUnidades(idUnidade) {
    $('.ondeEstamosInfo').html('');
    uf = siglaEstado(document.getElementById("select-estado").value)
    getEscola(idUnidade, uf);
    $('.ondeEstamos-clear, .ondeEstamosInfo').show();
 }
 
 
 function limpaBusca() {
    limpaMapa();
    $('.ondeEstamos-select').val('');
    $('#select-unidades').val('');
    $('#select-unidades').html('<option selected value="">'+$('.div-mapa').data('titleselect')+'</option>');
    $('.ondeEstamos-clear, .ondeEstamosInfo').hide();
 }
 
 /*******************************************/
 // Altera cores em componentes reutilizaveis
 alteraCorIcones('var(--escolas-principal)', '.icon-pin');
 
 //ALtera item selecionado no menu reutilizavel
 selecionaItemMenu('.item.escolas');
 selecionaItemMenu('.menu-segmento .item-onde-estamos');
 
 
 // Altera cores em componentes reutilizaveis
 alteraCorIcones('var(--escolas-principal)', '.icon-pin');
 
 //ALtera item selecionado no menu reutilizavel
 selecionaItemMenu('.item.escolas');
 selecionaItemMenu('.menu-segmento .item-onde-estamos');
 
 
 function getCidade(dataBody) {
 
    console.log(dataBody);
    $('#select-unidades').html('<option selected value="">'+$('.div-mapa').data('titleselect')+'</option>');
    dataBody.forEach(escola => {
       $('#select-unidades').append(`<option value="${escola.idPresenca}">${escola.txNomeApresentacao}</option>`);
    });
 }
 
 
 function returnEmpty(str) {
    if (str == null) {
       str = ''
    } else {
       str = str
    }
    return str
 }
 
 function getEscola(idUnidade, uf) {
    let dataBody = JSON.parse(localStorage.getItem('coTipo' + uf));
 
    dataBody.forEach(escola => {
       if (escola.idPresenca == idUnidade) {
          console.log(escola)
          var btnRemove = !escola.txSiteURL ? 'style="display:none"' : '';
          $('.ondeEstamosInfo').html(`
             <div class="ondeEstamosInfo-icone"></div>
                     <div class="ondeEstamosInfo-title">
                         <h6>${escola.txNomeApresentacao}</h6>
                     </div>
                     <div class="ondeEstamosInfo-texto">
                         <div class="ondeEstamosInfo-texto-item">
                             <span class="texto-item-title">Endereço</span>
                             <span class="texto-item-descr">${snull(escola.txLogradouro,'',', ')} ${snull(escola.txNumeroLogradouro,'',', ')} ${snull(escola.txBairro)}<br> ${escola.txNumeroCEP}, ${escola.txNomeCidade}</span>
                         </div>
 
                         <div class="ondeEstamosInfo-texto-item">
                             <span class="texto-item-title">Telefone </span>
                             <span class="texto-item-descr">${returnEmpty(formatPhoneNumber(escola.nuTelefone))}</span>
                         </div>
 
                         <div class="ondeEstamosInfo-texto-item">
                             <span class="texto-item-title">E-mail</span>
                             <span class="texto-item-descr">${snull(escola.txEmailContato)}</span>
                         </div>
 
                         <div class="ondeEstamosInfo-texto-item">
                             <span class="texto-item-title">Inspetoria</span>
                             <span class="texto-item-descr">${snull(escola.txUnidadeGestora,'-')}</span>
                         </div>
                     </div>
                     <div class="ondeEstamosInfo-button">
                         <a ${btnRemove} href="https://${returnEmpty(escola.txSiteURL)}" target="_blank" class="btn btn-branco-outline">Acesse o site</a>
                     </div>
             `);
       }
    });
 }
 
 function formataString(texto) {
    let txtFormatado = texto.toLowerCase();
 
    return txtFormatado.replaceAll('_', ' ');
 }
 
 
 function getTiposByEstadoArr(uf) {
   let tipoOndestamos = $('.div-mapa').data('segmento').split(',')

    Promise.all(tipoOndestamos.map(tipo => 
      fetch(`https://integrador.sig.rsb.org.br/api2/presenca/tipo/${tipo}`).then(resp => resp.json())
    )).then((resp) => {
      function filterName (item, index, array) {
          return (item.txSiglaEstado === uf);
        }
        var data = resp.flat().filter(filterName);
        localStorage.setItem(('coTipo'+uf),JSON.stringify(data));
        getCidade(data);
    });
 }
 
 /*Substituir null por -*/
 function snull(str, pos = '-', complemento = '') {
    if (str === null)
       return pos
    else
       return str + complemento
 }
 
 jQuery(function ($) {
 
   let tipoOndestamos = $('.div-mapa').data('segmento')
   tipoOndestamos = tipoOndestamos;
    const ondeEstamosColor = $('.div-mapa').data('color')
 
    //Mapa Selecionoado
    $().mapaSelecionado({
       tipo: tipoOndestamos,
       color: ondeEstamosColor
    })
 })