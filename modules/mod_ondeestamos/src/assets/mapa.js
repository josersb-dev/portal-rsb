function getDataMapa(callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4) {
        callback(xhr.response);
      }
    };
    xhr.open('GET', 'https://assets.rsb.org.br/v1/js/mapa.json');
    xhr.send();
}

function getElements(ElemClass){
    return document.getElementsByClassName(ElemClass);
}

function log(data){console.log(data)}

function generateMapa(){
  getDataMapa(function (data){
    mapaLib = JSON.parse(data);
    ColletionMapa = getElements('mapa');
    for (let i = 0; i < ColletionMapa.length; i++) {
      MapaKey = ColletionMapa[i].getAttribute('class').replace('mapa ', '');
      MapaSVG = (mapaLib[MapaKey].svg).replace("width=", "width='"+ColletionMapa[i].getAttribute('mapa-width')+"px'");
      MapaSVG = (MapaSVG).replace("height=", "height='"+ColletionMapa[i].getAttribute('mapa-width')+"px'");
      MapaSVG = (MapaSVG).replaceAll("{{color}}", ColletionMapa[i].getAttribute('color-fill'));
      document.getElementsByClassName(MapaKey)[0].innerHTML = MapaSVG;
    }
  })
}

  generateMapa();
