(function($){
    var opts = {
        container: '#awForm',
        svgSprite: 'https://draggable.github.io/formeo/assets/img/formeo-sprite.svg',
        events: {
            onSave: function(e){
                $('[name="jform[params][awform]"]').val(JSON.stringify(e.formData));
            }
        }
    };
    
    $( document ).ready(function(){
        var fData = $('[name="jform[params][awform]"]').val();
        if(fData == ''){
            fData = null;
        }else {
            fData = fData;
        }
       const form = new window.Formeo(opts,fData);
    })
}(jQuery));
