var chart = c3.generate(
    {
        bindto: '#record-chart',
        data: {
            x: 'dates',
            columns: window.chartData,
            type: 'line'
        },
        axis: {
            x: {
                type: 'timeseries',
                tick: {
                    format: '%Y-%m-%d'
                }
            },
            y: {
                min: 0,
                padding: {
                    bottom: 0
                }
            }
        }
    });

new DataTable('#recordTable', {
    processing: true,
    serverSide: true,
    ajax: window.route,
    columns: [
        {data: 'id', name: 'id', searchable: true},
        {data: 'string', name: 'string', className: 'truncate-text', searchable: true},
        {data: 'text', name: 'text', className: 'truncate-text', searchable: true},
        {data: 'json', name: 'json', className: 'truncate-text', searchable: true},
        {data: 'boolean', name: 'boolean', searchable: true},
        {data: 'integer', name: 'integer', searchable: true},
        {data: 'float', name: 'float', searchable: true},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});

new bootstrap.Modal(document.getElementById('recordModal'));

$.callModal = function (id, disabled) {
    var modalId = $('#record-modal-id');
    var modalString = $('#record-modal-string');
    var modalText = $('#record-modal-text');
    var modalJson = $('#record-modal-json');
    var modalBoolean = $('#record-modal-boolean');
    var modalInteger = $('#record-modal-integer');
    var modalFloat = $('#record-modal-float');

    modalString.prop('disabled', disabled);
    modalText.prop('disabled', disabled);
    modalJson.prop('disabled', disabled);
    modalBoolean.prop('disabled', disabled);
    modalInteger.prop('disabled', disabled);
    modalFloat.prop('disabled', disabled);

    modalId.val('');
    modalString.val('');
    modalText.html('');
    modalJson.val('');
    modalBoolean.val('');
    modalInteger.val('');
    modalFloat.val('');

    $.ajax({
        url: '/record/' + id,
        type: "GET",
        dataType: 'json',
        success: function (data) {
            // console.log('Data received:', data);
            modalId.val(data.id);
            modalString.val(data.string);
            modalText.html(data.text);
            modalJson.val(data.json);
            modalBoolean.val(data.boolean.toString());
            modalInteger.val(data.integer);
            modalFloat.val(data.float);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    });
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('input[name="_token"]').val()
    }
});

$.editRecord = function () {
    $.ajax({
        url: '/record/' + $('#record-modal-id').val(),
        type: "POST",
        dataType: 'json',
        data: {
            string: $('#record-modal-string').val(),
            text: $('#record-modal-text').html(),
            json: $('#record-modal-json').val(),
            boolean: $('#record-modal-boolean').val(),
            integer: $('#record-modal-integer').val(),
            float: $('#record-modal-float').val()
        },
        success: function (data) {
            // console.log('Data received:', data);
            $('#recordModal').modal('hide');
            $('#recordTable').DataTable().draw();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    });
};

$.deleteRecord = function (id, table, tr) {
    $.ajax({
        url: '/record/' + id,
        type: "DELETE",
        dataType: 'json',
        success: function (data) {
            // console.log('Data received:', data);
            table.DataTable().row(tr).remove().draw();
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    });
};

$(document).on('click', '.view-record', function () {
    $('#save-button').hide();
    $.callModal($(this).data('id'), true);
});

$(document).on('click', '.edit-record', function () {
    $('#save-button').show();
    $.callModal($(this).data('id'), false);
});

$(document).on('click', '#save-button', function () {
    $.editRecord();
});

$(document).on('click', '.delete-record', function () {
    $.deleteRecord($(this).data('id'), $('#recordTable'), $(this).closest('tr'));
});
