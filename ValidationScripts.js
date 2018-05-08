

/**
 *
 * @param CheckName
 * @param CheckDescription
 * @param CheckPhotos
 * @param CheckRegionComuna
 * @param CheckStreetNumber
 * @param CheckContactName
 * @param CheckEmail
 * @param CheckPhone
 * @returns {*}
 * @constructor
 *
 * Verifica que todos los campos del formulario hayan sido bien ingresados
 */

function FormValidation(CheckName, CheckDescription, CheckPhotos, CheckRegionComuna, CheckStreetNumber, CheckContactName, CheckEmail, CheckPhone) {
    bFormValidation = CheckName && CheckDescription && CheckPhotos && CheckStreetNumber && CheckRegionComuna && CheckContactName && CheckEmail && CheckPhone;
    return bFormValidation;
}


/**
 * LatinTextValidation(Text)
 *
 * @param Text
 * @returns {boolean}
 * @constructor
 *
 * Elimina los espacios y los numeros
 * Luego busca caracteres latinos
 */

function LatinTextValidation(Text) {
    Text = Text.replace(/\s+/g, "");
    Text = Text.replace(/\d/g, "");
    if (/^[A-Za-záéíóúÁÉÍÓÚñüÜ]+$/.test(Text)){
        return true;
    }
    else {
        return false;
    }
}

/**
 * NameValidation()
 *
 * @returns {boolean}
 * @constructor
 *
 * Valida el campo del formulario con nombre html = nombre.articulo
 * llamando a LatinTextValidation().
 */

function NameValidation() {
    var sNameInput = document.forms["AddArticleForm"]["nombre-articulo"].value;
    var bIsAlphabetic = LatinTextValidation(sNameInput) && !NumText(sNameInput);
    if (!bIsAlphabetic){
        alert("El Nombre del Artículo no es válido!")
    }
    return bIsAlphabetic;
}

/**
 * DescriptionValidation()
 * @returns {boolean}
 * @constructor
 *
 * Valida descripcion.articulo
 * No importa que este campo este vacio
 */

function DescriptionValidation() {
    var sDescriptionInput = document.forms["AddArticleForm"]["descripcion-articulo"].value;
    if (sDescriptionInput.length == 0){
        return true;
    }
    else {
        if (!LatinTextValidation(sDescriptionInput)) {
            alert("La Descripción no es válida!");
        }
        return LatinTextValidation(sDescriptionInput);
    }
}

var MaxPhotosNumber = 5;
var NumberOfPhoto = 1;
var str1 = "foto-articulo";

/**
 *
 * @returns {boolean}
 * @constructor
 *
 * AddNewPhoto()
 *
 * Muestra hasta 5 botones para asociar hasta 5 fotos al articulo.
 */

function AddNewPhoto() {
    if (NumberOfPhoto == MaxPhotosNumber+1){
        alert("Sólo se pueden subir como máximo 5 fotografías");
    }
    else if (document.forms["AddArticleForm"][str1.concat(NumberOfPhoto)].value == ""){
        alert("Seleccione una fotografía para asociarla al nuevo artículo");
    }
    else {
        NumberOfPhoto++;
        if (NumberOfPhoto <= MaxPhotosNumber){
            document.forms["AddArticleForm"][str1.concat(NumberOfPhoto)].style.display='block';
            return true;
        }
    }
}


/**
 *
 * @returns {boolean}
 * @constructor
 *
 * ValidatePhoto()
 *
 * Valida que haya al menos una foto asociada al articulo
 *
 */
function ValidatePhoto() {
    if (document.forms["AddArticleForm"]["foto-articulo[1]"].value !="") {
        return true;
    }
    else {
        alert("Debe ingresar al menos 1 fotografía para el nuevo artículo")
        return false;
    }
}


/**
 *
 * @param Text
 * @returns {boolean}
 * @constructor
 *
 * NumText(Text)
 *
 * Elimina los espacios y caracteres latinos
 * Luego busca numeros
 */

function NumText(Text) {
    Text = Text.replace(/\s+/g, "");
    //Text = Text.replace(/^[A-Za-záéíóúÁÉÍÓÚñüÜ]+$/,"");
    Text = Text.replace(/[A-Za-záéíóúÁÉÍÓÚñüÜ]/g, "");
    if (/^[0-9]+$/.test(Text)){
        return true;
    }
    else {return false}
}

/**
 *
 * @returns {boolean}
 * @constructor
 *
 * StreetNumberValidation()
 *
 * Valida que calle-articulo contenga numeros y caracteres latinos
 *
 */

function StreetNumberValidation() {
    var sStreetNumberInput = document.forms["AddArticleForm"]["calle-articulo"].value;
    var bIsAlphaNumeric = LatinTextValidation(sStreetNumberInput) && NumText(sStreetNumberInput);

    if (!bIsAlphaNumeric){
        alert("La Calle y el Número no son válidos!")
    }
    return bIsAlphaNumeric
}


/**
 *
 * @param Text
 * @returns {boolean}
 * @constructor
 *
 * TextNotEmpty(Text)
 *
 * Checkea que una string no este vacio.
 */

function TextNotEmpty(Text) {
    if (Text == ""){
        return false
    }
    else {return true}
}

/**
 *
 * @returns {boolean}
 * @constructor
 *
 * ValidateSelection()
 *
 * Valida la seleccion de una region y una comuna
 *
 */

function ValidateSelection() {
    var sRegion = document.forms["AddArticleForm"]["region-articulo"].value;
    var sComuna = document.forms["AddArticleForm"]["comuna-articulo"].value;
    var bValidSelection = TextNotEmpty(sRegion) && TextNotEmpty(sComuna);

    if (!bValidSelection){
        alert("Seleccione una Región y una Comuna!");
    }
    return bValidSelection
}


/**
 *
 * @returns {boolean}
 * @constructor
 *
 * ValidateContactName()
 *
 * Valida el Nombre de Contacto en caracteres latinos
 *
 */

function ValidateContactName() {
    var sContactNameInput = document.forms["AddArticleForm"]["nombre-contacto"].value;
    var bIsAlphabetic = LatinTextValidation(sContactNameInput) && !NumText(sContactNameInput);
    if (!bIsAlphabetic){
        alert("El Nombre de Contacto no es válido!")
    }
    return bIsAlphabetic;
}

/**
 *
 * @returns {boolean}
 * @constructor
 *
 * ValidateEmail()
 *
 * JavaScript code to validate an email id by w3resource
 * Disponible en: https://www.w3resource.com/javascript/form/email-validation.php
 *
 */

function ValidateEmail(){
    var email = document.forms["AddArticleForm"]["email-contacto"].value;
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))
    {
        return (true)
    }
    alert("El Mail de Contacto no es válido!")
    return (false)
}

/**
 *
 * @returns {boolean}
 * @constructor
 *
 * ValidatePhone()
 *
 * Valida que el Fono de contacto sea un numero Chileno.
 */


function ValidatePhone() {
    var Phone = document.forms["AddArticleForm"]["fono-contacto"].value;
    Phone = Phone.replace(/\s+/g, "");
    if (Phone.length == 0) return true;
    var CodePosition = Phone.indexOf("+56");
    var subNumber = Phone.slice(CodePosition+3);
    var bIsChileanNumber = ( CodePosition == 0) && (subNumber.length == 9) && NumText(subNumber)

    if (!bIsChileanNumber){
        alert("Sólo se validan los Fonos de Contacto que sigan el formato +56 XXX XXX XXX")
    }
    return bIsChileanNumber;
}

/**
 *
 * @type {{regiones: *[]}}
 *
 * Regiones y Comunas de Chile - CodePen2018
 *
 * Lista de seleccion dinamica de regiones y comunas implementada por Sergio Hidalgo
 * utilizando la librería JQuery de Javascript.
 * Disponible en: https://codepen.io/sergiohidalgo/pen/yNjdqg
 */

var RegionesYcomunas = {

    "regiones": [{
        "NombreRegion": "Arica y Parinacota",
        "comunas": ["Arica", "Camarones", "Putre", "General Lagos"]
    },
        {
            "NombreRegion": "Tarapacá",
            "comunas": ["Iquique", "Alto Hospicio", "Pozo Almonte", "Camiña", "Colchane", "Huara", "Pica"]
        },
        {
            "NombreRegion": "Antofagasta",
            "comunas": ["Antofagasta", "Mejillones", "Sierra Gorda", "Taltal", "Calama", "Ollagüe", "San Pedro de Atacama", "Tocopilla", "María Elena"]
        },
        {
            "NombreRegion": "Atacama",
            "comunas": ["Copiapó", "Caldera", "Tierra Amarilla", "Chañaral", "Diego de Almagro", "Vallenar", "Alto del Carmen", "Freirina", "Huasco"]
        },
        {
            "NombreRegion": "Coquimbo",
            "comunas": ["La Serena", "Coquimbo", "Andacollo", "La Higuera", "Paiguano", "Vicuña", "Illapel", "Canela", "Los Vilos", "Salamanca", "Ovalle", "Combarbalá", "Monte Patria", "Punitaqui", "Río Hurtado"]
        },
        {
            "NombreRegion": "Valparaíso",
            "comunas": ["Valparaíso", "Casablanca", "Concón", "Juan Fernández", "Puchuncaví", "Quintero", "Viña del Mar", "Isla de Pascua", "Los Andes", "Calle Larga", "Rinconada", "San Esteban", "La Ligua", "Cabildo", "Papudo", "Petorca", "Zapallar", "Quillota", "Calera", "Hijuelas", "La Cruz", "Nogales", "San Antonio", "Algarrobo", "Cartagena", "El Quisco", "El Tabo", "Santo Domingo", "San Felipe", "Catemu", "Llaillay", "Panquehue", "Putaendo", "Santa María", "Quilpué", "Limache", "Olmué", "Villa Alemana"]
        },
        {
            "NombreRegion": "Región del Libertador Gral. Bernardo O’Higgins",
            "comunas": ["Rancagua", "Codegua", "Coinco", "Coltauco", "Doñihue", "Graneros", "Las Cabras", "Machalí", "Malloa", "Mostazal", "Olivar", "Peumo", "Pichidegua", "Quinta de Tilcoco", "Rengo", "Requínoa", "San Vicente", "Pichilemu", "La Estrella", "Litueche", "Marchihue", "Navidad", "Paredones", "San Fernando", "Chépica", "Chimbarongo", "Lolol", "Nancagua", "Palmilla", "Peralillo", "Placilla", "Pumanque", "Santa Cruz"]
        },
        {
            "NombreRegion": "Región del Maule",
            "comunas": ["Talca", "ConsVtución", "Curepto", "Empedrado", "Maule", "Pelarco", "Pencahue", "Río Claro", "San Clemente", "San Rafael", "Cauquenes", "Chanco", "Pelluhue", "Curicó", "Hualañé", "Licantén", "Molina", "Rauco", "Romeral", "Sagrada Familia", "Teno", "Vichuquén", "Linares", "Colbún", "Longaví", "Parral", "ReVro", "San Javier", "Villa Alegre", "Yerbas Buenas"]
        },
        {
            "NombreRegion": "Región del Biobío",
            "comunas": ["Concepción", "Coronel", "Chiguayante", "Florida", "Hualqui", "Lota", "Penco", "San Pedro de la Paz", "Santa Juana", "Talcahuano", "Tomé", "Hualpén", "Lebu", "Arauco", "Cañete", "Contulmo", "Curanilahue", "Los Álamos", "Tirúa", "Los Ángeles", "Antuco", "Cabrero", "Laja", "Mulchén", "Nacimiento", "Negrete", "Quilaco", "Quilleco", "San Rosendo", "Santa Bárbara", "Tucapel", "Yumbel", "Alto Biobío", "Chillán", "Bulnes", "Cobquecura", "Coelemu", "Coihueco", "Chillán Viejo", "El Carmen", "Ninhue", "Ñiquén", "Pemuco", "Pinto", "Portezuelo", "Quillón", "Quirihue", "Ránquil", "San Carlos", "San Fabián", "San Ignacio", "San Nicolás", "Treguaco", "Yungay"]
        },
        {
            "NombreRegion": "Región de la Araucanía",
            "comunas": ["Temuco", "Carahue", "Cunco", "Curarrehue", "Freire", "Galvarino", "Gorbea", "Lautaro", "Loncoche", "Melipeuco", "Nueva Imperial", "Padre las Casas", "Perquenco", "Pitrufquén", "Pucón", "Saavedra", "Teodoro Schmidt", "Toltén", "Vilcún", "Villarrica", "Cholchol", "Angol", "Collipulli", "Curacautín", "Ercilla", "Lonquimay", "Los Sauces", "Lumaco", "Purén", "Renaico", "Traiguén", "Victoria", ]
        },
        {
            "NombreRegion": "Región de Los Ríos",
            "comunas": ["Valdivia", "Corral", "Lanco", "Los Lagos", "Máfil", "Mariquina", "Paillaco", "Panguipulli", "La Unión", "Futrono", "Lago Ranco", "Río Bueno"]
        },
        {
            "NombreRegion": "Región de Los Lagos",
            "comunas": ["Puerto Montt", "Calbuco", "Cochamó", "Fresia", "FruVllar", "Los Muermos", "Llanquihue", "Maullín", "Puerto Varas", "Castro", "Ancud", "Chonchi", "Curaco de Vélez", "Dalcahue", "Puqueldón", "Queilén", "Quellón", "Quemchi", "Quinchao", "Osorno", "Puerto Octay", "Purranque", "Puyehue", "Río Negro", "San Juan de la Costa", "San Pablo", "Chaitén", "Futaleufú", "Hualaihué", "Palena"]
        },
        {
            "NombreRegion": "Región Aisén del Gral. Carlos Ibáñez del Campo",
            "comunas": ["Coihaique", "Lago Verde", "Aisén", "Cisnes", "Guaitecas", "Cochrane", "O’Higgins", "Tortel", "Chile Chico", "Río Ibáñez"]
        },
        {
            "NombreRegion": "Región de Magallanes y de la AntárVca Chilena",
            "comunas": ["Punta Arenas", "Laguna Blanca", "Río Verde", "San Gregorio", "Cabo de Hornos (Ex Navarino)", "AntárVca", "Porvenir", "Primavera", "Timaukel", "Natales", "Torres del Paine"]
        },
        {
            "NombreRegion": "Región Metropolitana de Santiago",
            "comunas": ["Cerrillos", "Cerro Navia", "Conchalí", "El Bosque", "Estación Central", "Huechuraba", "Independencia", "La Cisterna", "La Florida", "La Granja", "La Pintana", "La Reina", "Las Condes", "Lo Barnechea", "Lo Espejo", "Lo Prado", "Macul", "Maipú", "Ñuñoa", "Pedro Aguirre Cerda", "Peñalolén", "Providencia", "Pudahuel", "Quilicura", "Quinta Normal", "Recoleta", "Renca", "San Joaquín", "San Miguel", "San Ramón", "Vitacura", "Puente Alto", "Pirque", "San José de Maipo", "Colina", "Lampa", "TilVl", "San Bernardo", "Buin", "Calera de Tango", "Paine", "Melipilla", "Alhué", "Curacaví", "María Pinto", "San Pedro", "Talagante", "El Monte", "Isla de Maipo", "Padre Hurtado", "Peñaflor"]
        }]
}
jQuery(document).ready(function () {

    var iRegion = 0;
    var htmlRegion = '<option value="">Seleccione región</option><option value=""></option>';
    var htmlComunas = '<option value="">Seleccione comuna</option><option value=""></option>';

    jQuery.each(RegionesYcomunas.regiones, function () {
        htmlRegion = htmlRegion + '<option value="' + RegionesYcomunas.regiones[iRegion].NombreRegion + '">' + RegionesYcomunas.regiones[iRegion].NombreRegion + '</option>';
        iRegion++;
    });

    jQuery('#regiones').html(htmlRegion);
    jQuery('#comunas').html(htmlComunas);

    jQuery('#regiones').change(function () {
        var iRegiones = 0;
        var valorRegion = jQuery(this).val();
        var htmlComuna = '<option value="">Seleccione comuna</option><option value=""></option>';
        jQuery.each(RegionesYcomunas.regiones, function () {
            if (RegionesYcomunas.regiones[iRegiones].NombreRegion == valorRegion) {
                var iComunas = 0;
                jQuery.each(RegionesYcomunas.regiones[iRegiones].comunas, function () {
                    htmlComuna = htmlComuna + '<option value="' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '">' + RegionesYcomunas.regiones[iRegiones].comunas[iComunas] + '</option>';
                    iComunas++;
                });
            }
            iRegiones++;
        });
        jQuery('#comunas').html(htmlComuna);
    });
    jQuery('#comunas').change(function () {
        if (jQuery(this).val() == '') {
            alert('selecciones Región');
        } else if (jQuery(this).val() == '') {
            alert('selecciones Comuna');
        }
    });
    jQuery('#regiones').change(function () {
        if (jQuery(this).val() == '') {
            alert('selecciones Región');
        }
    });

});