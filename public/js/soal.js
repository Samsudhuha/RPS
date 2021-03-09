/**
 * Created by Razi on 2/2/2017.
 */

var elementPosition = $('#header-soal').offset();

document.addEventListener('contextmenu', event => event.preventDefault());

$(function() {
  $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });
});

$(window).scroll(function() {
  var position = $('#header-soal').css('position');
  if ($(window).scrollTop() > elementPosition.top && position === 'static') {
    $('#header-soal')
      .css('position', 'fixed')
      .css('top', '0');
  }
  if ($(window).scrollTop() < 20 && position === 'fixed') {
    $('#header-soal').css('position', 'static');
  }
});

$(document).on('click', '.jawaban-menjodohkan', () => {
  var selectedAnswer = []
  document.querySelectorAll('.jawaban-menjodohkan').forEach(function(component) {
    selectedAnswer.push(component.value);
  });
  $.post(
    'ajax/jawab',
    {
      tipe_soal: 'menjodohkakn',
      jawaban: selectedAnswer,
      id: $('.konten-soal').attr('id'),
      no: $('#header-soal-nomor-box').text()
    },
    function(data) {
      if (data == 'ERR-NOMOR0')
        alert(
          'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
        );
    }
  )
  // console.log(selectedAnswer, $('.konten-soal').attr('id'),  $('#header-soal-nomor-box').text())
})

// ! ajax ijs
$('body').click(function(evt) {
  if ($('.submit-jawaban-ijs').length){
    postJawabanIJS()
  }
})

// $(document).on('click', '.submit-jawaban-ijs', () => {
  let postJawabanIJS = (function () {
  var jawaban_ijs = $('#jawaban_ijs').val()

  if (jawaban_ijs.trim() === '') { // cek jawaban kosong
    return
  }

  if ($('#ragu2').is(':checked')) {

    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'isian',
        jawaban: 'IJS*:' + jawaban_ijs,
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box-ragu').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else{
          // alert('Jawaban berhasil di submit');
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
        }
      }
    )

  } else {

    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'tp',
        jawaban: 'IJS:' + jawaban_ijs,
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else{
          // alert('Jawaban berhasil di submit');
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
        }
      }
    )
  }
})

// ajax pgk-l1
// $(document).on('click', '.submit-btn-pgk-l1', () => { // trigger pake button
$(document).on('click', '.opsi-pgk-l1', () => {
  var pilihan = [];
  $("input:checkbox[name=jawaban_pgk_l1]:checked").each( function() {
    pilihan.push($(this).val().trim().toUpperCase());
  })
  if (pilihan.length == 0) {
    alert('Isi pilihan sebelum submit');
    return
  }
  if($('#ragu2').is(':checked')){
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_l1',
        jawaban: 'PGKL1:'+pilihan.join(';').toLowerCase(),
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box-ragu').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else{
          // alert('Jawaban berhasil di submit');
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
        }
      }
    )
  } else{
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_l1',
        jawaban: 'PGKL1:'+pilihan.join(';'),
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else{
          // alert('Jawaban berhasil di submit');
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
        }
      }
    )
  }
})

$(document).on('click', '.pilgan-bs-1', () => {
  var selectedAnswer = $("input:radio[name=pilgan-bs-1]:checked").val()
  if ($('#ragu2').is(':checked')) {
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_bs1',
        jawaban: selectedAnswer.toLowerCase(),
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box-ragu').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else
          $('.jawaban-sekarang').html(
            '<strong>' + selectedAnswer.toUpperCase() + '<strong>'
          );
      }
    )
  } else{
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_bs1',
        jawaban: selectedAnswer,
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else
          $('.jawaban-sekarang').html(
            '<strong>' + selectedAnswer.toUpperCase() + '<strong>'
          );
      }
    )
  }
  console.log(selectedAnswer, $('.konten-soal').attr('id'),  $('#header-soal-nomor-box').text())
})

$(document).on('click', '.pilgan-bs-l1', () => {
  bs = Array(5).fill(0)
  bs[0] = $("input:radio[name=pilgan-bs-1]:checked").val()
  bs[1] = $("input:radio[name=pilgan-bs-2]:checked").val()
  bs[2] = $("input:radio[name=pilgan-bs-3]:checked").val()
  bs[3] = $("input:radio[name=pilgan-bs-4]:checked").val()
  bs[4] = $("input:radio[name=pilgan-bs-5]:checked").val()
  // console.log(bs.join(';'))
  if ($('#ragu2').is(':checked')) {
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_bsl1',
        jawaban: bs.join(';').toLowerCase(),
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box-ragu').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
      }
    )
  } else{
    $.post(
      'ajax/jawab',
      {
        tipe_soal: 'pilihan_ganda_bsl1',
        jawaban: bs.join(';'),
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        if (data == 'ERR-NOMOR0')
          alert(
            'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
          );
        else
          $('.jawaban-sekarang').html(
            '<strong>' + "Y" + '<strong>'
          );
      }
    )
  }
  console.log(bs, $('.konten-soal').attr('id'),  $('#header-soal-nomor-box').text())
})

$(document).on('click', '.opsi', function() {
  if ($(this).hasClass('opsi-selected')) {
    var soal_id = $('.konten-soal').attr('id');
    $('#soal-' + soal_id).text('');
    $(this).removeClass('opsi-selected');
    if ($('#ragu2').is(':checked')) {
      $.post(
        'ajax/jawab',
        {
          jawaban: ' ',
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box-ragu').text()
        },
        function(data) {
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else
            $('.jawaban-sekarang').html(
              '<strong>' + data.toUpperCase() + '<strong>'
            );
        }
      );
    } else {
      $.post(
        'ajax/jawab',
        {
          jawaban: ' ',
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else
            $('.jawaban-sekarang').html(
              '<strong>' + data.toUpperCase() + '<strong>'
            );
        }
      );
    }
  } else {
    var soal_id = $('.konten-soal').attr('id');
    var soal_opsi = $(this).attr('value');
    $('#soal-' + soal_id).text(soal_opsi);

    $('.opsi').removeClass('opsi-selected');
    $(this).addClass('opsi-selected');
    if ($('#ragu2').is(':checked')) {
      $.post(
        'ajax/jawab',
        {
          jawaban: $(this).attr('value'),
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box-ragu').text()
        },
        function(data) {
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else
            $('.jawaban-sekarang').html(
              '<strong>' + data.toUpperCase() + '<strong>'
            );
        }
      );
    } else {
      $.post(
        'ajax/jawab',
        {
          jawaban: $(this)
            .attr('value')
            .toUpperCase(),
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else
            $('.jawaban-sekarang').html(
              '<strong>' + data.toUpperCase() + '<strong>'
            );
        }
      );
    }
  }
});

$(document).on('click', '#navigasi-tengah', function() {
  if ($('#ragu2').is(':checked')) {
    $('#ragu2').prop('checked', false);
  } else {
    $('#ragu2').prop('checked', true);
  }
  if ($('#ragu2').is(':checked')) {
    //jika check ragu2, sesuaikan sama tipe soal yang ada.
    if (document.getElementsByName('soal_id')[0]) {
      //jika essai
      var str = document.getElementsByName('jawaban')[0].innerHTML;
      str = '*' + str + '*';
      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'essai',
          jawaban: str,
          id: $('.konten-soal').attr('id'),
          soal_id: document.getElementsByName('soal_id')[0].value,
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box').attr('id', 'header-soal-nomor-box-ragu');
        }
      );
    
    } else if (document.getElementsByClassName('.jawaban-menjodohkan') && document.getElementsByClassName('.jawaban-menjodohkan').length > 0) {
      // ! ragu2 check untuk menjodohkan

      // ! lowercase jawaban
      var selectedAnswer = []
      document.querySelectorAll('.jawaban-menjodohkan').forEach(function(component) {
        selectedAnswer.push(component.value.toLowerCase());
      });

      if (pilihan.length == 0) {
        $('#ragu2').prop('checked', false);
        alert('Isi pilihan sebelum submit jawaban ragu-ragu');
        return
      }

      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'menjodohkakn',
          jawaban: selectedAnswer,
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box').attr(
            'id',
            'header-soal-nomor-box-ragu'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            // alert('Jawaban berhasil di submit');
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else if (document.getElementsByClassName('submit-btn-pgk-l1') && document.getElementsByClassName('submit-btn-pgk-l1').length > 0) {
      // ! ragu2 check untuk pgk-l1
      // console.log(document.getElementsByClassName('submit-btn-pgk-l1'));

      // ! lowercase jawaban
      var pilihan = [];
      $("input:checkbox[name=jawaban_pgk_l1]:checked").each( function() {
        pilihan.push($(this).val().trim().toLowerCase());
      })

      if (pilihan.length == 0) {
        $('#ragu2').prop('checked', false);
        alert('Isi pilihan sebelum submit jawaban ragu-ragu');
        return
      }

      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'pilihan_ganda_l1',
          jawaban: 'PGKL1:'+pilihan.join(';'),
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box').attr(
            'id',
            'header-soal-nomor-box-ragu'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            // alert('Jawaban berhasil di submit');
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else if (document.getElementById("jawaban_ijs") && document.getElementById("jawaban_ijs") != null) {
      // * ragu ragu ijs check
      // console.log('check ragu2 ijs')

      var jawaban_ijs = document.getElementById("jawaban_ijs").value;

      if (jawaban_ijs < 1) {
        $('#ragu2').prop('checked', false);
        alert('Isi jawaban sebelum submit jawaban ragu-ragu');
        return
      }

      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'isian',
          jawaban: 'IJS*:'+ jawaban_ijs,
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box').attr(
            'id',
            'header-soal-nomor-box-ragu'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            // alert('Jawaban berhasil di submit');
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else {
      // klik ragu-ragu soal pilgan, pgk-bs-1, pgk-bsl-1 
      console.log("ragu-ragu soal pilgan, pgk-bs-1, pgk-bsl-1")
      $.get(
        'ajax/jawaban',
        {
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          var jawaban = data;
          console.log(data)
          if(jawaban.length>1){
            jawaban = jawaban.slice(4, jawaban.length).toLowerCase()
            newAnswer = data.slice(0,4)+jawaban
          } else{
            newAnswer = data.toLowerCase()
          }
          $.post(
            'ajax/jawab',
            {
              jawaban: newAnswer,
              id: $('.konten-soal').attr('id'),
              no: $('#header-soal-nomor-box').text()
            },
            function(data) {
              $('#header-soal-nomor-box').attr(
                'id',
                'header-soal-nomor-box-ragu'
              );
            }
          );
          dataType: 'json';
        }
      );
    }
  } else {
    // uncheck ragu-ragu
    // console.log("uncheck ragu-ragu")
    if (document.getElementsByName('soal_id')[0]) {
      var str = document.getElementsByName('jawaban')[0].innerHTML;
      str.substr(1).slice(0, -1);
      console.log(str);
      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'essai',
          jawaban: str,
          id: $('.konten-soal').attr('id'),
          soal_id: document.getElementsByName('soal_id')[0].value,
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box-ragu').attr('id', 'header-soal-nomor-box');
        }
      );

    } else if (document.getElementsByClassName('submit-btn-pgk-l1') && document.getElementsByClassName('submit-btn-pgk-l1').length > 0) {
      // ! ragu2 uncheck untuk pgk-l1

      // console.log(document.getElementsByClassName('submit-btn-pgk-l1'));
      // console.log('pgk-l1 ragu2 uncheck');

      // ! uppercase jawaban
      var pilihan = [];
      $("input:checkbox[name=jawaban_pgk_l1]:checked").each( function() {
        pilihan.push($(this).val().trim().toUpperCase());
      })
      // console.log(pilihan);
      if (pilihan.length == 0) {
        $('#ragu2').prop('checked', true);
        alert('Isi pilihan sebelum submit');
        return
      }
      
      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'pilihan_ganda_l1',
          jawaban: 'PGKL1:'+pilihan.join(';'),
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box-ragu').text()
        },
        function(data) {
          // console.log(data)
          $('#header-soal-nomor-box-ragu').attr(
            'id',
            'header-soal-nomor-box'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else if (document.getElementsByClassName('.jawaban-menjodohkan') && document.getElementsByClassName('.jawaban-menjodohkan').length > 0) {
      // ! ragu2 uncheck untuk menjodohkan

      // ! uppercase jawaban
      var selectedAnswer = []
      document.querySelectorAll('.jawaban-menjodohkan').forEach(function(component) {
        selectedAnswer.push(component.value.toUpperCase());
      });

      if (pilihan.length == 0) {
        $('#ragu2').prop('checked', false);
        alert('Isi pilihan sebelum submit jawaban ragu-ragu');
        return
      }

      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'menjodohkakn',
          jawaban: selectedAnswer,
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box').text()
        },
        function(data) {
          $('#header-soal-nomor-box').attr(
            'id',
            'header-soal-nomor-box-ragu'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            // alert('Jawaban berhasil di submit');
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else if (document.getElementById("jawaban_ijs") && document.getElementById("jawaban_ijs") != null) {
      // * ragu ragu ijs uncheck

      var jawaban_ijs = document.getElementById("jawaban_ijs").value;

      if (jawaban_ijs < 1) {
        alert('Isi jawaban sebelum pilih ragu-ragu');
        return
      }

      $.post(
        'ajax/jawab',
        {
          tipe_soal: 'isian',
          jawaban: 'IJS:'+ jawaban_ijs,
          id: $('.konten-soal').attr('id'),
          no: $('#header-soal-nomor-box-ragu').text()
        },
        function(data) {
          $('#header-soal-nomor-box-ragu').attr(
            'id',
            'header-soal-nomor-box'
          );
          if (data == 'ERR-NOMOR0')
            alert(
              'Terjadi beberapa kesalahan, mohon restart browser anda dan login kembali.'
            );
          else{
            // alert('Jawaban berhasil di submit');
            $('.jawaban-sekarang').html(
              '<strong>' + "Y" + '<strong>'
            );
          }})

    } else {
      // uncheck pilgan & pgk-bs-1
      console.log("uncheck pilgan & pgk-bs-1")
      if ($('.opsi').hasClass('opsi-selected')) {
        $.get(
          'ajax/jawaban',
          {
            id: $('.konten-soal').attr('id'),
            no: $('#header-soal-nomor-box-ragu').text()
          },
          function(data) {
            var jawaban = data;
            $.post(
              'ajax/jawab',
              {
                jawaban: data.toUpperCase(),
                id: $('.konten-soal').attr('id'),
                no: $('#header-soal-nomor-box-ragu').text()
              },
              function(data) {
                $('#header-soal-nomor-box-ragu').attr(
                  'id',
                  'header-soal-nomor-box'
                );
              }
            );
          }
        );
      } else {
        $.get(
          'ajax/jawaban',
          {
            id: $('.konten-soal').attr('id'),
            no: $('#header-soal-nomor-box-ragu').text()
          },
          function(data) {
            var jawaban = data;
            $.post(
              'ajax/jawab',
              {
                jawaban: jawaban.toUpperCase(),
                id: $('.konten-soal').attr('id'),
                no: $('#header-soal-nomor-box-ragu').text()
              },
              function(data) {
                $('#header-soal-nomor-box-ragu').attr(
                  'id',
                  'header-soal-nomor-box'
                );
              }
            );
          }
        );
      }
    }
  }
});

function cekStatusLogin() {
  var data = {
    user_id: $('#user_id').val()
  };

  $.ajax({
    url: "/api/cek-status-ujian",
    type: 'post',
    dataType: 'json',
    contentType: 'application/json',
    error: function(data) {
      $('#logout').submit();
    },
    data: JSON.stringify(data)
  });
}

$(document).on('click', '.jawaban,  #daftar-soal', function() {
  // cekStatusLogin();
});

// $(document).on('click','#ragu2',function(){
//     if($("#ragu2").is(':checked')){
//     $.post('ujian/ragu2',
//     {
//         _token: $('input').attr('value'),
//         soal_id: $('.konten-soal').attr('id'),
//         status: 1
//     },
//     function(data, status){
//         $('#header-soal-nomor-box').attr('id', 'header-soal-nomor-box-ragu');
//     });
//     }else{
//         if($('.opsi').hasClass('opsi-selected')){
//             $.post('ujian/ragu2',
//             {
//                 _token: $('input').attr('value'),
//                 soal_id: $('.konten-soal').attr('id'),
//                 status: 2
//             },
//             function(data, status){
//                 $('#header-soal-nomor-box-ragu').attr('id', 'header-soal-nomor-box');
//             });
//         }else{
//             $.post('ujian/ragu2',
//             {
//                 _token: $('input').attr('value'),
//                 soal_id: $('.konten-soal').attr('id'),
//             },
//             function(data, status){
//                 $('#header-soal-nomor-box-ragu').attr('id', 'header-soal-nomor-box');
//             });
//         }
//     }
// });
$(document).ready(function() {
  // ketika reload
  if (document.getElementsByName('soal_id')[0]) {
    $.get(
      'ajax/jawaban',
      {
        tipe_soal: 'essai',
        id: $('.konten-soal').attr('id'),
        soal_id: document.getElementsByName('soal_id')[0].value,
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        if (data['status'] == '*') {
          $('#ragu2')[0].checked = true;
          $('#header-soal-nomor-box').attr('id', 'header-soal-nomor-box-ragu');
        }
        document.getElementsByName('jawaban')[0].innerHTML = data['jawaban'];
        if (data['jawaban'])
          window.awal = data['jawaban'].replace(/[^a-zA-Z]/g, '');
        else window.awal = '';
      }
    );
  } else {
    $.get(
      'ajax/jawaban',
      {
        id: $('.konten-soal').attr('id'),
        no: $('#header-soal-nomor-box').text()
      },
      function(data) {
        var jawaban = data;
        var soal = $('.konten-soal').attr('id');
        if (jawaban.length > 1) {
          type = jawaban.slice(0, 4).toUpperCase()
          if(type == 'BSL:'){
            //get jawaban soal BSL-1 setelah direfresh
            newAnswer = jawaban.slice(4, jawaban.length)
            arrNewAnswer = newAnswer.split(';')
            console.log(arrNewAnswer)
            for (i = 0; i < arrNewAnswer.length; i++) {
              if(arrNewAnswer[i] == 'b' || arrNewAnswer[i] == 'B'){
                $("#true"+(i+1)).prop("checked", true);
              } else if(arrNewAnswer[i] == 's' || arrNewAnswer[i] == 'S'){
                $("#false"+(i+1)).prop("checked", true);
              }
            }
            if(newAnswer == newAnswer.toLowerCase()){
              console.log('ragu2 BSL')
              $('#ragu2').prop('checked', true);
              $('#header-soal-nomor-box').attr(
                'id',
                'header-soal-nomor-box-ragu'
              );
            }
          }
          else if(jawaban.slice(0, 6) == 'PGKL1:') {
            //get jawaban soal PGK-1 setelah direfresh
            var jawaban_ragu2 = ['a', 'b', 'c', 'd', 'e'];
            var current_answer = jawaban.slice(6, jawaban.length);
            console.log(current_answer);

            // ! check jawaban ragu2 bukan
            var ragu2 = false;
            for (let el of jawaban_ragu2) {
              if (current_answer.indexOf(el.toLowerCase()) > -1) {
                ragu2 = true;
                break
              }
            }

            if (ragu2) {
              console.log('ragu2')
              $('#ragu2').prop('checked', true);
              $('#header-soal-nomor-box').attr(
                'id',
                'header-soal-nomor-box-ragu'
              );
              // ! dapetin jawaban pgk-l1 yang udah di submit yang ragu2
              var checkboxes = document.querySelectorAll(".opsi-pgk-l1");
              checkboxes.forEach((item, index) => {
                if (current_answer.indexOf(item.value.toLowerCase()) > -1){
                  item.checked = true;
                }
              })

            } else {

              // ! dapetin jawaban pgk-l1 yang udah di submit
              var checkboxes = document.querySelectorAll(".opsi-pgk-l1");
              checkboxes.forEach((item, index) => {
                if (current_answer.indexOf(item.value.toUpperCase()) > -1){
                  item.checked = true;
                }
              })
            }

            

          } else if(jawaban.slice(0, 4) == 'IJS:' || jawaban.slice(0, 5) == 'IJS*:') {

            if (jawaban.indexOf('IJS*:') > -1) {
              $('#header-soal-nomor-box').attr(
                'id',
                'header-soal-nomor-box-ragu'
              );
              $('#ragu2').prop('checked', true);
            }else{
              $('#ragu2').prop('checked', false);
            }
            
            var awal_jawaban = jawaban.indexOf(':') + 1;
            var ijs_answer = jawaban.slice(awal_jawaban, jawaban.length);
            document.getElementById("jawaban_ijs").value = ijs_answer;
            console.log(ijs_answer);

          } else if (Array.isArray(jawaban)) {
            if(document.getElementsByClassName('submit-menjodohkan')) {
              var number = 'a'
              jawaban.forEach(statement => {
                console.log(statement);
                document.getElementById('menjodohkan-'+number).value = statement.toUpperCase();
                number = String.fromCharCode(number.charCodeAt() + 1)
              })
            }
          } 
        } else if(["T", "t", "F", "f"].includes(jawaban)){
          //get jawaban soal pgk-bs-1 setelah direfresh
          if(jawaban == jawaban.toLowerCase()) {
            $('#ragu2')[0].checked = true;
            $('#header-soal-nomor-box').attr(
              'id',
              'header-soal-nomor-box-ragu'
            );
          }
          if(jawaban == 'T' || jawaban == 't'){
            $("#true").prop("checked", true);
          } else{
            $("#false").prop("checked", true);
          }
        }else if (jawaban != ' ') {
          $('#' + jawaban.toLowerCase()).addClass('opsi-selected');
          if (jawaban != jawaban.toUpperCase()) {
            $('#ragu2')[0].checked = true;
            $('#header-soal-nomor-box').attr(
              'id',
              'header-soal-nomor-box-ragu'
            );
          }
        }
      }
    );
  }

  //membuat current soal
  var soal_id = $('.konten-soal').attr('id');
  $('#soal-' + soal_id).removeClass('jawaban-ragu');
  $('#soal-' + soal_id)
    .next()
    .removeClass('nomor-ragu');
  $('#soal-' + soal_id)
    .next()
    .removeClass('nomor-sudah');
  $('#soal-' + soal_id).addClass('jawaban-sekarang');
  $('#soal-' + soal_id)
    .next()
    .addClass('nomor-sekarang');

  $('#toggle-daftar-soal').click(function() {
    if ($('#daftar-soal').is(':visible')) {
      $('#toggle-daftar-soal').animate({ right: '-=300px' });
      $('#daftar-soal-arrow-left').show();
      $('#daftar-soal-arrow-right').hide();
      $('#daftar-soal-text').show();
      $(this).css('width', '50px');
      // document.getElementById("class-navigasi-kanan").className = "col-lg-5";
      // document.getElementById("class-navigasi-tengah").className = "col-lg-2";
      // document.getElementById("class-navigasi-kiri").className = "col-lg-5";
    } else {
      $('#toggle-daftar-soal').animate({ right: '+=300px' });
      $('#daftar-soal-arrow-left').hide();
      $('#daftar-soal-arrow-right').show();
      $('#daftar-soal-text').hide();
      $(this).css('width', '50px');
      // document.getElementById("class-navigasi-kanan").className = "col-lg-2";
      // document.getElementById("class-navigasi-tengah").className = "col-lg-2";
      // document.getElementById("class-navigasi-kiri").className = "col-lg-2";
    }
    $('#daftar-soal').toggle('slide', { direction: 'right' });
  });
});
