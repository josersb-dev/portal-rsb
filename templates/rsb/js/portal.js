
//Adicionando a classe do link do menu para a li
function classeDoLinkParaLi(){
    let links = document.querySelector('.sp-megamenu-parent').querySelectorAll('a');
    for(let l in links){
        let linkClass = links[l].className
        let liParent = links[l].parentNode

        if(linkClass)
            liParent.classList.add(linkClass)
    }
}



function outerHeight(elem){
    var curStyle = elem.currentStyle || window.getComputedStyle(elem);
    outerHeight = elem.offsetHeight;
    outerHeight += parseInt(curStyle.marginTop);
    outerHeight += parseInt(curStyle.marginBottom);

    return outerHeight //If you'd like to return the outerheight
}
function titleScripts(){
        let bannerTitle = document.querySelector('.banner-title')
        let bannerPadrao = document.querySelector('.rsb-padrao-title')
        if(bannerPadrao){
            fadeIn(bannerPadrao.querySelector('img'))
            let bannerSrc = bannerPadrao.querySelector('img').getAttribute('data-src')
            bannerPadrao.querySelector('img').setAttribute('src',bannerSrc)
            
        }

        
    }
    document.addEventListener('DOMContentLoaded',function(){
        titleScripts();
    })
window.onload = function() {
    // Função para redimensionar o elemento para o tamanho da janela

   

    function redimensionarElemento() {
        var elemento = document.getElementById('elementoRedimensionado');
        var larguraJanela = window.innerWidth;
        var alturaJanela = window.innerHeight;
        let bannerTitle = document.querySelector('.banner-title')
        let bannerPadrao = document.querySelector('.rsb-padrao-banner')
        
        if(!bannerPadrao)
            return false;
        
        if(bannerTitle)
            bannerTitle.style.opacity = 1
            bannerTitle.classList.add('animate__animated', 'animate__bounceInLeft')
        if(larguraJanela < 800){
            bannerPadrao.querySelector('img').style.height = (bannerTitle.offsetHeight+60)+'px'
        }else{
            bannerPadrao.querySelector('img').style.height = 'auto'
        }
    }
    
    // Chamando a função quando a página é carregada
    redimensionarElemento();

    
    
    // Chamando a função quando a janela é redimensionada
    window.addEventListener('resize', redimensionarElemento);
};


document.addEventListener('DOMContentLoaded',function(){

    classeDoLinkParaLi()
})


function fadeIn(elemento) {
    var opacidade = 0;
    var intervalo = setInterval(function() {
        if (opacidade < 1) {
            opacidade += 0.2;
            elemento.style.opacity = opacidade;
        } else {
            clearInterval(intervalo);
        }
    }, 100);
}

function fadeOut(elemento) {
    var opacidade = 1;
    var intervalo = setInterval(function() {
        if (opacidade > 0) {
            opacidade -= 0.1;
            elemento.style.opacity = opacidade;
        } else {
            clearInterval(intervalo);
        }
    }, 100);
}


//Noticias - adicionado classe nos parentes das imagens
jQuery(function($){
    let imgParentSpan = $('.texto_wysiwyg').find('img').parents('span')
    let imgParentP = $('.texto_wysiwyg').find('img').parents('p')
    if(imgParentP.css('text-align') == 'center'){
        if(imgParentSpan.length){
            imgParentSpan.addClass('imagem-span-center')
        }
        imgParentP.addClass('imagem-p-center')
    }
    imgParentSpan.addClass('imagem-span')
    
})


jQuery(function($){
    $('.rsb-lazy').lazy({
        effect: "fadeIn",
        effectTime: 500,
        threshold: 0
    })
})