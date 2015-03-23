/**
 * Created by ggarcia on 05/01/2015.
 */

var autocomplete_focus = function(event, ui) {
    $("#clienteAutocomplete").val(ui.item.label);
    return false;
};

function calculate_amount() {

}



var autcomplete_select = function( event, ui ) {
    var client_id = ui.item.value;
    if(client_id != 0) {
        $.ajax('/contabilidad?page=ventas_cliente&cod='+client_id,{
            beforeSend: function() {
                $('#clientInfo').addClass('active');
            },
            success: function(data) {
                console.log(data);
                $('#clientInfo').html(data);
                $("#clienteAutocomplete").css('display','none');
            },
            complete: function() {
                $('#clientInfo').removeClass('active');
            }
        })
        $('#clienteAutocomplete').val(ui.item.label)
        $('#cliente').val(client_id)
    } else {
        $('#myModal').modal('show');
    }

    return false;
};

var autocomplete_response = function(event, ui) {
    // ui.content is the array that's about to be sent to the response callback.
    if (ui.content.length === 0) {
        ui.content.push({
            label: 'Agregar Cliente',
            value: 0
        });
    }
    return false;
}

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
    $('#formulario').on('change', function() {
        calculate_amount();
    });
    $('#huespedesFieldset').change(function() {
        update_huesped_count();
    });
    $('#habitaciones').on('click', function(event) {
        var clickedElementId = event.target.id;
        if(clickedElementId.indexOf('solucion') != -1) {
            var clickedElement = $('#'+clickedElementId);
            var idsHabs = clickedElement.data('habitaciones').toString();
            $('.habitacionItem').removeClass('active');
            clickedElement.addClass('active');
            $('#idsHabitaciones').val(idsHabs);
        }

    })
});