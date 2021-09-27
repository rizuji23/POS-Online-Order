$('.container-custom').scroll(function () {
    if ($('.container-custom').scrollTop() > 10) {
        $('.navbar').addClass('shadows');
    } else {
        $('.navbar').removeClass('shadows');
    }
});

$(document).ready(function () {
    var texthp = $('#pharga').text();
    var texta = texthp.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    $('#pharga').text(texta)
})



function openNav() {
    document.getElementById("mySidenav").style.width = "270px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
$(document).ready(function () {
    $('.minus').click(function () {
        var $input = $(this).parent().find('input');
        var count = parseInt($input.val()) - 1;
        count = count < 1 ? 1 : count;
        $input.val(count);
        $input.change();
        return false;
    });
    $('.plus').click(function () {
        var $input = $(this).parent().find('input');
        $input.val(parseInt($input.val()) + 1);
        $input.change();
        return false;

    });
});


$('.minus2').click(function () {
    var $input = $(this).parent().find('.qty-input2');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);

    return false;
});
$('.plus2').click(function () {
    var $input = $(this).parent().find('.qty-input2');
    $input.val(parseInt($input.val()) + 1);

    return false;

});

$('.qty-input2').change(function () {
    if ($(this).val() == 0) {
        $(this).val("1");
    }
})

$('.qty-input').change(function () {
    if ($(this).val() == 0) {
        $(this).val("1");
    }
})


$('.cart').click(function () {
    location.href = 'cart.php';

})

function load_cartcontainer() {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'datacart': 1
        },
        success: function (data) {
            $('#cart-container').html(data)
        }
    })
}

$('#btnbeli').click(function () {
    $('#pesan').css('display', 'block')
    $('#pesan').fadeIn("slow")
})

$('#batalalert').click(function () {
    $('#pesan').css('display', 'none')


})

$('#backpesanan').click(function () {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'batalpesanan': 1
        },
        success: function (data) {
            if (data) {
                document.location.href = 'home.php'
            } else {
                console.log(data)
            }
        }
    })
})


$('#masuk_tamu').click(function () {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'masuktamu': 1
        },
        success: function (data) {
            location.href = 'home.php';
        }
    })
})


$('.kategori_minum').click(function () {
    var kat = $(this).attr('id');
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'kategori_minum': kat
        },
        success: function (data) {
            $('#slideminuman').html(data);

        }
    })

    $('.lists').removeClass('active-menu');
    $('.lists').addClass('active-menu')
})


$(document).ready(function () {
    $('#slideprodukfoto').find('.carousel-item').first().addClass('active');
    $('.carousel-indicators').find('.lists').first().addClass('active');
});


function load_cart() {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'cart-in': '*'
        },
        success: function (data) {
            $('.cart-in').html(data)
        }
    })
}

function load_cartcount() {
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'cartcount': '*'
        },
        success: function (data) {
            $('.cart-counts').html(data)
        }
    })
}

window.onload = function () {
    load_cart();
    load_cartcount();
    load_cartcontainer();
    hitung_sub();
}

function hidetoast(data) {
    $('.toast-alert').css('display', 'none');
    $('.data-toast').text(data);
}

$('.addcart').click(function () {
    var cd = $(this).attr('id');
    var qty = $('.qty-input').val();
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'cartproduk': cd,
            'qty': qty
        },
        success: function (data) {
            load_cart()
            load_cartcount()
            $('.toast-alert').css('display', 'block');
            $('.data-toast').text(data);
            setInterval(hidetoast, 3000)

        }
    })
})

function update_total() {

    $('.subs').each(function () {

        var harga = $(this).find('.harga_produk').val().split('.').join("");
        var qty = $(this).find('.qty-input2').val();
        var total = parseInt(qty * harga);

        var total2 = total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
        $(this).find('.text-subs-harga').text("Rp. " + total2)



        $(this).find('.harga_sub').val(total2);
    })

    var sum = 0;
    $('.text-subs-harga').each(function () {

        var total = $(this).text().split('.').join("");
        var total2 = total.split('Rp.').join("")
        sum += parseInt(total2);

    })

    var sum2 = sum.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");


}

function hitung_sub() {
    var sum1 = 0;
    $('.subs').each(function () {
        var harga = $(this).find('.text-subs-harga').text().split('.').join("");
        var har = harga.split('Rp').join("");
        sum1 += parseInt(har)
    })

    var sum_result = sum1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    $('.sub_harga_t').text("Rp. " + sum_result)

}

$(document).ready(function () {
    update_total()
    $('.qty-input2').change(function () {
        update_total()
        hitung_sub()

    })

    $('.plus2').click(function () {
        update_total()
        hitung_sub()
    })
    $('.minus2').click(function () {
        update_total()
        hitung_sub()
    })

    $('.hapus_cart').click(function () {
        var ids = $(this).attr('id');
        $('#hapusalert').html(`<div class="alert-content">
        <div class="alert-box">
            <div class="alert-b-content">
                <div class="dialog text-center">
                    <p>Yakin?</p>
                    <span>Produk ingin dihapus?</span>
                </div>

            </div>

            <hr>
            <div class="promp">
                <div class="row no-gutters">
                    <div class="col">
                        <div class="batal-p text-center">
                            <a href="javascript:void(0)" class="batalalert">Batal</a>
                        </div>

                    </div>

                    <div class="col">
                        <div class="beli-p text-center">
                            <a href="hapus.php?pro=` + ids + `" id="hapusnow">Hapus</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>`)
        $('#hapusalert').css('display', 'block');
    })

})

$('#hapusalert').on('click', '.batalalert', function () {
    $('#hapusalert').css('display', 'none');
})

$(document).ready(function () {
    $('#belialert').click(function () {
        $('#form_cart').submit();
    })
})

$('#btngunakan').click(function () {
    var kode = $('#kode').val();
    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'kode': kode
        },
        success: function (data) {
            $('.toast-alert').css('display', 'block');
            $('.data-toast').text(data);
            setInterval(hidetoast, 3000)

        }
    })

    $.ajax({
        url: 'config/api.php',
        method: 'POST',
        data: {
            'kode2': kode
        },
        success: function (data) {
            $('#pesanan-a').html(data)

        }
    })
})

$('#belialert2').click(function () {
    $('#formpesanan').submit();
})

$('#follow').click(function () {
    $('#social').css('display', 'block');
    closeNav()
})

$('#btnsearch').click(function () {
    $('#search').css('display', 'block');
    closeNav()
})

$('#batalsocial').click(function () {
    $('#social').css('display', 'none');
    closeNav()
})

$('.slideside').on('swiperight', function () {
    openNav();
})