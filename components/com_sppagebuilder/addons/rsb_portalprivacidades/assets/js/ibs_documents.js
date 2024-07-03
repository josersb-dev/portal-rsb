jQuery(function($){


	/*Deixando o primeiro aberto*/
	function openP(){
		let el = $('.ibs-documents-item').eq(0)
		el.find('h3').addClass('show')
		el.find('.ibs-documents-items').show()
	}
	
	openP()
	
	/*IBS DOcuments*/
	$( document ).on('click','.ibs-documents-item h3',function(event) {
		event.preventDefault()
		let sliP = $( this ).next('.ibs-documents-items');

		$('.ibs-documents-item .ibs-documents-items').not(sliP).slideUp();
	  sliP.slideToggle( "slow", function() {
	    // Animation complete.
	  });

	  $(this).toggleClass('show')
	  $('.ibs-documents-item h3').not($(this)).removeClass('show')
	});

	$( document ).on('click','.ibs-documents-items li h4',function() {

		let sli = $( this ).next('ul');
		let el = $(this);

		$('.ibs-documents-items li ul').not(sli).slideUp();

	  $( this ).next('ul').slideToggle( "slow", function() {
	    // Animation complete.
	  });

	  el.toggleClass('show')
	  $('.ibs-documents-items li h4').not(el).removeClass('show')
	});

	//Exibir intenção
	$( document ).on('click', '.ibs-documents-items .ibsDocumentFile a',function(ev){
	    ev.preventDefault();
	    let file =  $(this).data('file')

	    let tema = `
	        <div class="ibsDocumentM animate__animated animate__fadeIn">
	            <div class="ibsDocumentMContent animate__animated animate__fadeInLeft">
	            	<span class="pClose"><i class="fa fa-times-circle" aria-hidden="true"></i></span>
	                <div class="ibsMcontent">
	                    <iframe height="100%" width="100%" src="${file}" frameborder="0"></iframe>
	                </div>
	            </div>
	        </div>
	    `;

	    if($('.ibsDocumentM').length == 0){
	        $('body').append(tema);
	        //removendo
	        //$('.velasDaFeItem').removeClass('loadingInt')
	    }
	});

	    $( document ).on('click','.pClose',function(ev){
	        ev.preventDefault();

	        let el = $(this).parents('.ibsDocumentM')

	        el.find('.ibsDocumentMContent').removeClass('animate__animated animate__fadeInLeft').addClass('animate__animated animate__fadeOutLeft')

	        setTimeout(function() {
	            setTimeout(function() {
	                $(this).remove();
	                $('body').css('overflow-y','auto')
	            }.bind(el), 600);
	            $(this).removeClass('animate__fadeIn').addClass('animate__fadeOut')
	        }.bind(el), 1000);
	    })

	    $( document ).on('click','.popIntencaoContent',function(ev){
	        ev.stopPropagation();
	    })
})