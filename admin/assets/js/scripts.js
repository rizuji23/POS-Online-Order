$("#foto_produk").fileinput({
    theme: 'fas',

    allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
    overwriteInitial: false,
    maxFileSize: 102400,
    maxFilesNum: 10,

    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});

$("#thumb_foto").fileinput({
    theme: 'fas',

    allowedFileExtensions: ['jpg', 'png', 'gif', 'jpeg'],
    overwriteInitial: false,
    maxFileSize: 102400,
    maxFilesNum: 10,

    slugCallback: function (filename) {
        return filename.replace('(', '_').replace(']', '_');
    }
});


$(document).ready(function () {
    $('#hargaproduk').mask('000.000.000', {
        reverse: true
    });
    
    $('.uangpemasukan').mask('000.000.000', {
        reverse: true
    });
})

function load_dataproduk(where) {
    $('#loading').show();

    if (where == '*') {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDataProduk': '*'
            },
            success: function (data) {
                $('#loading').hide()
                $('#dataproduk').html(data)
            }
        });
    } else {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDataProduk': where
            },
            success: function (data) {
                $('#loading').hide()
                $('#dataproduk').html(data)
            }
        });
    }
}

function load_datauserm(where) {
    $('#loading').show();

    if (where == '*') {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDatauserm': '*'
            },
            success: function (data) {
                $('#loading').hide()
                $('#datauserm').html(data)
            }
        });
    } else {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDataProduk': where
            },
            success: function (data) {
                $('#loading').hide()
                $('#dataproduk').html(data)
            }
        });
    }
}


function load_datausert(where) {
    $('#loading').show();

    if (where == '*') {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDatausert': '*'
            },
            success: function (data) {
                $('#loading').hide()
                $('#datausert').html(data)
            }
        });
    } else {
        $.ajax({
            url: 'config/api.php',
            method: 'POST',
            data: {
                'tableDataProduk': where
            },
            success: function (data) {
                $('#loading').hide()
                $('#dataproduk').html(data)
            }
        });
    }
}

window.onload = function () {
    load_dataproduk('*');
    load_datauserm('*');
    load_datausert('*')
}


function hapusproduk(produk) {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataprodukh': produk
        },
        success: function (data) {
            load_dataproduk('*');
        }
    });
}

function detailproduk(produk) {
    $('#loadingprodukdetail').show();
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataDetailp': produk
        },
        success: function (data) {
            $('#loadingprodukdetail').hide();
            $('#detailProduct').modal('show');
            $('#dataModal').html(data)
        }
    })
}

function detailUser(users) {
    $('#loadingprodukdetail').show();
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataDetailUsers': users
        },
        success: function (data) {
            $('#loadingprodukdetail').hide();
            $('#detailUsers').modal('show');
            $('#dataModal').html(data)
        }
    })
}

$('.btnDetailP').click(function () {
    var penjualan = $(this).attr('id');
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataDetailPenjualan': penjualan
        },
        success: function (data) {
            $('#loadingprodukdetail').hide();
            $('#detailPenjualan').modal('show');
            $('#dataModal').html(data)
        }
    })
})


function detailKredit(kredit) {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataDetailkredit': kredit
        },
        success: function (data) {
            $('#loadingprodukdetail').hide();
            $('#detailKredit').modal('show');
            $('#dataModal').html(data)
        }
    })
}


function detailDebit(debit) {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'dataDetaildebit': debit
        },
        success: function (data) {
            $('#loadingprodukdetail').hide();
            $('#detailDebit').modal('show');
            $('#dataModal').html(data)
        }
    })
}