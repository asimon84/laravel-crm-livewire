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

new DataTable('#myDataTable', {
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

$(document).on('click', '.view-record', function() {
    $('#record-modal-id').val('');
    $('#record-modal-string').val('');
    $('#record-modal-text').html('');
    $('#record-modal-json').val('');
    $('#record-modal-boolean').val('');
    $('#record-modal-integer').val('');
    $('#record-modal-float').val('');

    $.ajax({
        url: '/record/'+$(this).data('id'),
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // console.log('Data received:', data);
            $('#record-modal-id').val(data.id);
            $('#record-modal-string').val(data.string);
            $('#record-modal-text').html(data.text);
            $('#record-modal-json').val(data.json);
            $('#record-modal-boolean').val(data.boolean.toString());
            $('#record-modal-integer').val(data.integer);
            $('#record-modal-float').val(data.float);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    });
});

$(document).on('click', '.edit-record', function() {
    $('#record-modal-id').val('');
    $('#record-modal-string').val('');
    $('#record-modal-text').html('');
    $('#record-modal-json').val('');
    $('#record-modal-boolean').val('');
    $('#record-modal-integer').val('');
    $('#record-modal-float').val('');

    $.ajax({
        url: '/record/'+$(this).data('id'),
        type: 'POST',
        dataType: 'json',
        success: function(data) {
            // console.log('Data received:', data);
            $('#record-modal-id').val(data.id);
            $('#record-modal-string').val(data.string);
            $('#record-modal-text').html(data.text);
            $('#record-modal-json').val(data.json);
            $('#record-modal-boolean').val(data.boolean.toString());
            $('#record-modal-integer').val(data.integer);
            $('#record-modal-float').val(data.float);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX error:', textStatus, errorThrown);
        }
    });
});