
jQuery('#export').click(function (event) {
    jQuery.ajax({
        dataType: "json",
        url: omni_admin_ajax.ajax_url,
        type: 'get',
        data : {
            action: 'omni_wp_theme_export_opt_in_results'
        },
        success: function (response) {
            exportCSVFile(response);
        },
        error: function (error) {

        }
    });
});

function convertToCSV(objArray) {
    var array = typeof objArray != 'object' ? JSON.parse(objArray) : objArray;
    var str = '';

    for (var i = 0; i < array.length; i++) {
        var line = '';
        for (var index in array[i]) {
            if (line != '') line += ','

            line += array[i][index];
        }

        str += line + '\r\n';
    }

    return str;
}

function exportCSVFile(jsonObject) {
    var d = new Date();
    var year = d.getFullYear();
    var date = d.getDate();
    var month = d.getMonth();
    var hours = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();

    var fileTitle = 'export_' + year + '-' + month + '-' + date + '_' + hours + '.' + min + '.' + sec;

    var csv = this.convertToCSV(jsonObject);

    var exportedFilenmae = fileTitle + '.csv' || 'export.csv';

    var blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    if (navigator.msSaveBlob) { // IE 10+
        navigator.msSaveBlob(blob, exportedFilenmae);
    } else {
        var link = document.createElement("a");
        if (link.download !== undefined) { // feature detection
            // Browsers that support HTML5 download attribute
            var url = URL.createObjectURL(blob);
            link.setAttribute("href", url);
            link.setAttribute("download", exportedFilenmae);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    }
}
