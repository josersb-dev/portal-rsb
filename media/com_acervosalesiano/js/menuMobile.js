function criarNavResponsivo(selector, onde){

  let textoSelecione = 'Escolha uma opção';
  let itemInicio = `<div class="itemInicio"> <span>${textoSelecione}</span> <i class="fas fa-chevron-down"></i></div>`;
  let itemsNav = $( selector ).html()

  let layNav = `
   <div class="navAcervoItems">
   	 ${itemInicio}
     <ul>
        ${itemsNav}
     </ul>
   </div>
  `;

  $( document ).on('click','.navAcervoItems .itemInicio',function(){
    $(this).toggleClass('active')
    $('.navAcervoItems').find('ul').slideToggle('slow')
  })

  $(onde).html(layNav)
  let textActive = `<span>${$('.navAcervoItems').find('a.active span:first-child').text()}</span> <i class="fas fa-chevron-down"></i>`;
    textActive = $('.navAcervoItems').find('a.active').length ? textActive : '<span>'+textoSelecione+'</span> <i class="fas fa-chevron-down"></i>'
    $('.navAcervoItems').find('.itemInicio').html(textActive)
}