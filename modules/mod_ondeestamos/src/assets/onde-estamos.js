(function($){
    $.fn.mapaSelecionado = function(settings){
        var config = $.extend( {
            tipo: '',
            color: $('.div-mapa').data('color')
        }, settings, config );

        function gMarkMap() {
            var arr = []
            /*async function apiReq(){
                return await fetch('https://integrador.sig.rsb.org.br/api2/presenca/tipo/'+config.tipo).then(response=>response.json()).then(response=>{
                    mydata = response
                    for(var i of mydata)
                    {
                        arr.push(i.txSiglaEstado)
                    }
                })
            }*/
            
            config.tipo = config.tipo.split(',')

            Promise.all(config.tipo.map(tipo => 
                fetch(`https://integrador.sig.rsb.org.br/api2/presenca/tipo/${tipo}`)
                .then(resp => resp.json())
              )).then((resp) => {
                console.log(resp)
                  var data = resp.flat()
                  for(var i of data)
                    {
                        arr.push(i.txSiglaEstado)
                    }

                    $('.mapa-brasil svg path').each(function() {
                        if(in_array(siglaEstado($(this).attr('id')), arr) != -1) {
                            let el = $(this)
                            $(this).addClass('fillPresenca')
                        } else {
                            $(this).on('click', function(e) {
                                e.preventDefault();
                                return false;
                            })
                            if($(this).attr('id') != undefined) {
                                $('.ondeEstamos-select [value= "' + $(this).attr('id') + '"]').attr('disabled', true)
                            }
                        }
                    })
              } );

            $(document).on('click', '.mapa-brasil svg path', function(event) {
                event.preventDefault();
                $('.mapa-brasil svg path').removeClass('fills')
                $(this).addClass('fills')
                $('.ondeEstamos-select').val($(this).attr('id')).change()
            })
            $(document).on('change', '.ondeEstamos-select', function() {
                $('.mapa-brasil svg path').removeClass('fills')
                $('.mapa-brasil svg path').find('#' + $(this).val()).addClass('fills')
            })
           /* apiReq().then(response => {
                $('.mapa-brasil svg path').each(function() {
                    if(in_array(siglaEstado($(this).attr('id')), arr) != -1) {
                        let el = $(this)
                        $(this).addClass('fillPresenca')
                    } else {
                        $(this).on('click', function(e) {
                            e.preventDefault();
                            return false;
                        })
                        if($(this).attr('id') != undefined) {
                            $('.ondeEstamos-select [value= "' + $(this).attr('id') + '"]').attr('disabled', true)
                        }
                    }
                })
            });*/
        }
        
        function in_array(needle, haystack) {
            var found = 0;
            for(var i = 0, len = haystack.length; i < len; i++) {
                if(haystack[i] == needle) return i;
                found++;
            }
            return -1;
        }
        
        function addStyleColor(color) {
            $('head').append(`
                <style>
                .fillPresenca.fills,.fillPresenca:hover,.ufSelecionada {
                    fill:${color} !important
                  }
                  .fillPresenca {
                    fill:#d5d5d5;
                    cursor:pointer
                  }
                  </style>
                  `)
        }
        $(document).ready(function() {
            setTimeout(() => {
                gMarkMap()
                addStyleColor(config.color) 
            }, 500);
        })
    };
})(jQuery);

//formatar telefone
function telFormater(str){
    return str ? str.replaceAll(' ','').replace(/(\d{2})/, "($1) ").replace('-','') : '-'
}

function telFormater(tel){
    tel=tel.replace(/\D/g,"");
    tel=tel.replace(/^(\d{2})(\d)/g,"($1) $2");
    tel=tel.replace(/(\d)(\d{4})$/,"$1-$2"); 
    return tel;
}

function limpaNull(str){
    return str.split(null).join(' - ')
}

//Limpar apenas as informações
$(document).on('change','#select-estado',function(event){
    event.preventDefault();
    $('.ondeEstamosInfo').html('').hide()
})

//Remover duplicidade
const uniqueObj = (data,key) => {
	return [...new Map(data.map(item =>
  [item[key.trim()], item])).values()];
}