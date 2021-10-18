
var conocimientos = array('HTML5','CSS3','JavaScript','JQuery','SASS','LESS','GULP','GRUNT');
var experiencia = 1;
var personalidad = array('simpátic@','espíritu inquieto','un poco friki','me gusta trabajar en equipo');

function ofertaFrontEnd(conocimientos,experiencia,personalidad){
    var estoyPreparado = conocimientos + experiencia + personalidad;

    if(estoyPreparado){
        var mensaje = "¡Queremos conocerte!";
        mandarMiCV('hola@ole.agency');

    }else{
        var mensaje = "Gracias por tu interés! Quizás en otra ocasión";
        pasarLaOfertaAunAmigo();
    }
    return mensaje;
}



