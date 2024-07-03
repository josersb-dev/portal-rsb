
function envioAjax(){
    let url = '/index.php?option=com_rsbebook&task=ebooks.ajaxAction';
    let data = {
        nome: document.querySelector('[name="nome"]').value,
        email: document.querySelector('[name="email"]').value,
        ebookId: document.querySelector('[name="ebookid"]').value,
        termo_licenca_uso: document.querySelector('[name="termo_licenca_uso"]').value,
        termo_consentimento_uso: document.querySelector('[name="termo_consentimento_uso"]').checked ? 1 : 0
    };
    let requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data),
    };

    fetch(url, requestOptions)
        .then(response => {

            if (!response.ok) {
                throw new Error('Erro na solicitação AJAX');
            }
            return response.json();
        })
        .then(data => {
            // Manipular a resposta JSON aqui
            let classObrigatorio = document.querySelectorAll('.campo-obrigatorio')

             if(classObrigatorio){
                for(let cl of classObrigatorio){
                    cl.classList.remove('campo-obrigatorio')
                }
            }
            
            if(data.camposObrigatorios){
                for(let name of data.camposObrigatorios){
                    document.querySelector('[name="'+name+'"]').classList.add('campo-obrigatorio')
                }
            }
        })
        .catch(error => {
            // Lidar com erros
            console.error(error);
        });
}

document.addEventListener('DOMContentLoaded',function(){
    
    document.querySelector('[data-enviar-ebook]').addEventListener('click', async function(event) {
        event.preventDefault(); // Impede o comportamento padrão do link (enviar o formulário)

        if (document.querySelector('[name="termo_licenca_uso"]').checked) {
            let textoBotao = event.target.innerHTML
            textoBotao.innerHTML = 'Carregando...'
            await envioAjax()
        } else {
            alert('Por favor, aceite os termos de licença antes de enviar o formulário.');
        }
    }); 
})

jQuery(document).ready(function () {

    $(document).on('click','.ebookDownload',function(event){
        event.preventDefault()
        $('#formEbook').modal('show')
        let ebookTitle = $(this).data('title');
        let ebookId = $(this).data('ebookid')
        
        $('.form-ebooks').each (function(){
            this.reset();
          });

        $('#formEbook').find('.modal-title').text(ebookTitle)
        $('#formEbook').find('[name=\"ebookid\"]').val(ebookId)

        
    })

    /*$('#formEbook').on('show.bs.modal',function(event){
        let ebookId = $(this).find('[name=\"ebookid\"]').val()
        let ebookIdTarget = event.relatedTarget.getAttribute('data-ebookid')
    })*/

    let ebooks = $('.rsb-ebooks').find('.ebook');
    let tempo = 500
    ebooks.each(function(i){
        let ebookImage = $(this).find('img').data('src');
        let ebookSrc = $(this).find('img')
        ebookSrc.attr('src',ebookImage)

            ebookSrc.addClass('animate__animated animate__fadeIn')
    })

    $( document ).on('mouseover','.ebook',function(){
        $(this).find('.ebook-back').show().addClass('animate__animated animate__fadeInUpBig').removeClass('animate__fadeOutLeft')
    })

    $( document ).on('mouseleave','.ebook',function(){
        $(this).find('.ebook-content').addClass('animate__animated animate__fadeOutLeft').removeClass('animate__fadeInLeft')
    })


    function modalCheck(sel,selOk,selModal,tggle){
        $(document).on('change',sel,function(event){
        
        if(!$(this).is(':checked')){
          $(this).val('')
            return false;
        }
      
        let selInput = $(this)
        /*$(selModal).modal({
          fadeDuration: 100
        });*/
          $(selModal).modal('show')
          $(tggle).modal('hide')
          $(this).filter(':checkbox').prop('checked',false)	
        })
      
         $(document).on('click',selOk,function(event,tggle){
            event.preventDefault()
            $(selModal).modal('hide')
            $(tggle).modal('show')
            $(sel).filter(':checkbox').prop('checked',true)
            $(sel).val(1)
         })
      }

      $('#termoLicencaUso').on('hide.bs.modal', function (e) {
        $('#formEbook').modal('show')
      })

      modalCheck('[name=\"termo_licenca_uso\"]','.aceiteOk','#termoLicencaUso','#formEbook')
});
