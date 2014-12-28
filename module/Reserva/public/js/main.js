/**
 * Created by ggarcia on 05/01/2015.
 */

function add_huesped(nombre, doc, fechaNac) {
    var fieldSet = $('#huespedesFieldset');
    var currentCount = $('#huespedesFieldset > fieldset').length;
    var template = $('#huespedesFieldset > span').data('template');
    template = template.replace(/__index__/g, currentCount);
    fieldSet.append(template);
    if(nombre !== undefined) {
        fieldSet.find('fieldset:first-of-type input.nombre').val(nombre);
    }
    if(doc !== undefined) {
        fieldSet.find('fieldset:first-of-type input.documento').val(doc);
    }
    if(fechaNac !== undefined) {
        fieldSet.find('fieldset:first-of-type input.fechaNac').val(fechaNac);
    }
    update_huesped_count();
    return false;
}

var autocomplete_focus = function(event, ui) {
    $("#autocomplete").val(ui.item.label);
    return false;
};

var autcomplete_select = function( event, ui ) {
    $("#clienteFieldset .email").val( ui.item.value[0].email );
    $("#clienteFieldset .telefono").val( ui.item.value[0].telefono);
    $("#clienteFieldset .tipoHuesped").val( ui.item.value[0].idTipoHuesped);
    $("#clienteFieldset .idCliente" ).val( ui.item.value[0].cliente );
    add_huesped(ui.item.label, ui.item.value[0].documento, ui.item.value[0].fechaNacimiento);
    return false;
};

function update_huesped_count() {
    var cantAdultos = 0;
    var cantMenores = 0;
    $('#huespedesFieldset > fieldset').each(function(index, element) {
        var fechaNac = $(this).find('.fechaNac').val();
        if(fechaNac.trim()) {
            var edad = _calculateAge(new Date(fechaNac));
            if(edad < 5) {
                cantMenores++;
            } else {
                cantAdultos++;
            }
        }
    })
    $("input[name='reserva[cantidadAdulto]']").val(cantAdultos);
    $("input[name='reserva[cantidadMenor]']").val(cantMenores);
}

function remove_huesped(element) {
    $(element.parentNode).remove();
    update_huesped_count();
}
$(document).ready(function() {
    $('#huespedesFieldset').change(function() {
        update_huesped_count();
    })
});