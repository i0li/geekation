//***********************************//
//      チャット単語画面のサイズ調整    
//***********************************//
$(function() {
  //メイン画面のサイズを画面いっぱいに設定
  let header_area = $('#header');
  let main_area = $('#in_room_area');

  let window_height = $(window).height();
  let header_height = header_area.outerHeight();

  main_area.height(window_height - header_height);

  //単語帳エリアの高さを調整
  let word_area_header = $('#word_area_header');
  let word_area_contants = $('#word_area_contents');

  let word_area_header_height = word_area_header.outerHeight();
  word_area_contants.height(window_height - (header_height + word_area_header_height));

  //チャットエリアの高さを調整
  let chat_area_contants = $('#chat_area_contants');
  let chat_send_form_area = $('#chat_send_form_area');

  let chat_send_form_area_height = chat_send_form_area.outerHeight();
  chat_area_contants.height(window_height - (header_height + chat_send_form_area_height));
});

//***********************************//
//     チャット単語画面のサイズ再調整  
//***********************************//
$(window).on('resize',function(){
  //メイン画面のサイズを画面いっぱいに設定
  let header_area = $('#header');
  let main_area = $('#in_room_area');

  let window_height = $(window).height();
  let header_height = header_area.outerHeight();

  main_area.height(window_height - header_height);

  //単語帳エリアの高さを調整
  let word_area_header = $('#word_area_header');
  let word_area_contants = $('#word_area_contents');

  let word_area_header_height = word_area_header.outerHeight();
  word_area_contants.height(window_height - (header_height + word_area_header_height));

  //チャットエリアの高さを調整
  let chat_area_contants = $('#chat_area_contants');
  let chat_send_form_area = $('#chat_send_form_area');

  let chat_send_form_area_height = chat_send_form_area.outerHeight();
  chat_area_contants.height(window_height - (header_height + chat_send_form_area_height));
});


//***********************************//
//  　スクロール開始位置を一番下に設定  
//***********************************//
$(function() {
  let chat_area_contants = $('#chat_area_contants');
  chat_area_contants[0].scrollTo(0, chat_area_contants[0].scrollHeight);
});

//***********************************//
//             絞り込み表示  
//***********************************//
$(function () {
  //--- キーワード検索
  searchWord = function(){
    let searchText = $(this).val(), // 検索ボックスに入力された値
        targetSection,
        targetText,
        hit_count;
    //入力フォームに何か入力された時、検索を行う
    if (searchText) {
      $('#word_area_contents .section-area').each(function() {
        hit_count = 0;
        targetSection = $(this).find('.word-info').each(function() {
        targetText = $(this).find('.word-title').text();
  
          // 検索対象となるリストに入力された文字列が存在するかどうかを判断(無かった場合-1が返される)
          if (targetText.indexOf(searchText) != -1) {
            console.log(targetText);
            hit_count = ++hit_count;
            $(this).show();
          } else {
            $(this).hide();
          }
        });
  
        //一つもヒットしていない章は非表示に
        if (hit_count == 0) {
          $(this).hide();
        }
      });
    //入力フォームに何もない場合は全て表示(章検索が効いている場合はその章のみ表示)
    } else {
      $('#word_area_contents .section-area').each(function() {
        $(this).show();
        $(this).find('.word-info').each(function(){
          $(this).show();
        });
      searchSection($('#search-section'));
      });
    }
  };
  //--- 章検索
  searchSection = function(sectionForm) {
    //デフォルト値が選択されている場合
    if(sectionForm.val()=="default"){
      $('#word_area_contents .section-area').each(function() {
        $(this).show();
      });
      return;
    }

    //章番号が選択されている場合
    let searchSectionTitle = sectionForm.val() + '章';
    $('#word_area_contents .section-area').each(function() {
      targetSectionTitle = $(this).find('.section_title').text();
      if(searchSectionTitle == targetSectionTitle){
        $(this).show();
      }else{
        $(this).hide();
      }
    });
  };

  $('#search-word').on('input', searchWord);
  $('#search-section').change(function(){
    searchSection($('#search-section'));
  });
});


//***********************************//
//              modals
//***********************************//
$(function () {
  //--------------------
  // 単語詳細情報モーダル用
  //--------------------
  adjustModalArea("#word-info-modal-content") ;
  $(".word-info-modal-open").click(
    function(){
      $(this).blur() ;	//ボタンからフォーカスを外す
      if($("#modal-overlay")[0]) return false ;		//新しくモーダルウィンドウを起動しない
      //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
      $("body").append('<div id="modal-overlay"></div>');

      //単語詳細モーダルを選択された単語の情報に書き換える
      //データはajaxでデータベースより取得する
      let selected_word_id = $(this).find('.selected_word_id').val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type:'get',
        url: '/get_word_info',
        dataType: 'json',
        data: { 'selected_word_id' : selected_word_id},
      })
        .done((res) => {
          let selected_word_info = res ;
          $('#word-info-user-name h5').text('作成者 : ' + selected_word_info['create_user_name']);
          $('#word-info-page-num h5').text('p.' + selected_word_info['page']);
          $('#word-info-title h3').text(selected_word_info['title']);
          $('#search-google-link a')[0].setAttribute('href', escapeHtml('https://www.google.com/search?q=' + selected_word_info['title']));
          //単語詳細情報は改行も込みで表示する
          $("#word-info_detail").append('<div id="word-info_detail_box"></div>');
          let textarea_value_array = selected_word_info['detail'].split(/\r?\n/g);
          $.each(textarea_value_array, function(index, value){
            $("#word-info_detail_box").append('<h5>'+value+'</h5>');
          })

          //[$modal-overlay]をフェードインさせる
          $("#modal-overlay").fadeIn();
          $("#word-info-modal-content").fadeIn();
        })
        .fail((error) => {
          console.log(error.statuText);
        });
    }
  );

  //--------------------
  // 　単語登録モーダル用
  //--------------------
  adjustModalArea("#create-word-modal-content") ;
  adjustTextareaHeight();
  $("#create-word-modal-open").click(
    function(){
      $(this).blur() ;	//ボタンからフォーカスを外す
      if($("#modal-overlay")[0]) return false ;		//新しくモーダルウィンドウを起動しない
      //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
      $("body").append('<div id="modal-overlay"></div>');

      //[$modal-overlay]をフェードインさせる
      $("#modal-overlay").fadeIn();
      $("#create-word-modal-content").fadeIn();
    }
  );
  //--------------------
  // 　単語編集モーダル用
  //--------------------
  adjustModalArea("#edit-word-modal-content") ;
  adjustTextareaHeight();
  $(".edit-word-modal-open").click(
    function(){
      $(this).blur() ;	//ボタンからフォーカスを外す
      if($("#modal-overlay")[0]) return false ;		//新しくモーダルウィンドウを起動しない
      //オーバーレイ用のHTMLコードを、[body]内の最後に生成する
      $("body").append('<div id="modal-overlay"></div>');

      let edit_word_id = $(this).val();
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type:'get',
        url: '/get_word_info',
        dataType: 'json',
        data: { 'selected_word_id' : edit_word_id},
      })
        .done((res) => {
          let edit_word_info = res ;
          $('#edit_word_id').val(edit_word_id);
          $('#edit_word_title').val(edit_word_info['title']);
          $('#edit_section_index').val(edit_word_info['section_index']);
          $('#edit_page_num').val(edit_word_info['page']);
          $('#edit_word_detail').val(edit_word_info['detail']);

          //[$modal-overlay]をフェードインさせる
          $("#modal-overlay").fadeIn();
          $("#edit-word-modal-content").fadeIn();
        })
        .fail((error) => {
          console.log(error.statuText);
        });
    }
  );

//--------------------
// 単語削除確認モーダル用
//--------------------
adjustModalArea("#delete-word-confirm-modal-content") ;
$("#delete-word-confirm-modal-open").click(
  function(){
    $(this).blur() ;	//ボタンからフォーカスを外す

    //選択された単語の情報に書き換える
    let delete_word_id = $('#edit_word_id').val();
    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
      },
      type:'get',
      url: '/get_word_info',
      dataType: 'json',
      data: { 'selected_word_id' : delete_word_id},
    })
      .done((res) => {
        let delete_word_info = res ;
        $('#delete_word_id').val(delete_word_id); 
        $('#delete-word-info-title h3').text(delete_word_info['title']);
        //単語詳細情報は改行も込みで表示する
        $("#delete-word-info-detail").append('<div id="delete-word-info-detail-box"></div>');
        let delete_textarea_value_array = delete_word_info['detail'].split(/\r?\n/g);
        $.each(delete_textarea_value_array, function(index, value){
          $("#delete-word-info-detail-box").append('<h5>'+value+'</h5>');
        })
    
        //[$modal-overlay]をフェードインさせる
        $("#delete-word-confirm-modal-content").fadeIn();
      })
      .fail((error) => {
        console.log(error.statuText);
      });
  }
);


  //------------
  //モーダル用関数
  //------------
  //閉じるボタンを押した時用
  $(".word-modal-close").unbind().click(function(){
    //[#modal-overlay]と[#modal-close]をフェードアウトする
    $("#word-info-modal-content").fadeOut('fast');
    $("#create-word-modal-content").fadeOut('fast');
    $("#edit-word-modal-content").fadeOut('fast');
    $("#delete-word-confirm-modal-content").fadeOut('normal')
    $("#modal-overlay").fadeOut(function(){
      //フェードアウト後、不必要なものは削除
      $("#modal-overlay").remove();
      if($('#word-info_detail_box').length){
        $('#word-info_detail_box').remove();
      };
      if($('#delete-word-info-detail-box').length){
        $('#delete-word-info-detail-box').remove();
      };

      //バリデーションに引っかかった場合はエラー表示を消す
      let invalid_forms = $('.is-invalid')
      invalid_forms.each(function(){
        this.classList.remove('is-invalid');
      });
      let invalid_messages = $('.invalid-feedback')
      invalid_messages.each(function() {
        this.remove();
      });
      
    });
  });
  //--- 位置・サイズ調整
  function adjustModalArea(target_modal_id){
    parent_width = $('#word_area').width();
    parent_height = $('#word_area').height();
    $(target_modal_id).width(parent_width*0.7);
    $(target_modal_id).height(parent_height*0.8);

    let header_area_height = $('#header').outerHeight();

    let w = $('#word_area').width();
    let h = $('#word_area').height();
  
    let cw = $(target_modal_id).outerWidth();
    let ch = $(target_modal_id).outerHeight();
  
    let pxleft = ((w - cw)/2);
    let pxtop = ((h - ch)/2) + header_area_height;
  
    $(target_modal_id).css({"left": pxleft + "px"});
    $(target_modal_id).css({"top": pxtop + "px"});
  }
  //--- textareaの高さ調整
  function adjustTextareaHeight(){
    let parent_height = $("#create-word-modal-content").outerHeight();
    $('.word_detail').css({"height": (parent_height*0.97-415) + "px"})
  }
  //--- XSS対策
  function escapeHtml(str) {
    str = str.replace(/&/g, '&amp;');
    str = str.replace(/</g, '&lt;');
    str = str.replace(/>/g, '&gt;');
    str = str.replace(/"/g, '&quot;');
    str = str.replace(/'/g, '&#39;');
    return str;
  }
  //画面がリサイズされた時用
  $( window ).resize( function() {
    adjustModalArea("#word-info-modal-content");
    adjustModalArea("#create-word-modal-content");
    adjustModalArea("#edit-word-modal-content");
    adjustModalArea("#delete-word-confirm-modal-content") ;
    adjustTextareaHeight();
  });
});

//***********************************//
//    　　　 メッセージ送信用
//***********************************//

window.Echo.channel('ChatChannel')
.listen('SendChatEvent',function(data){

  if(data['chat_contants']['room_id'] == current_room_id){
    if(data['chat_contants']['user_id'] == login_user_id){
      let receive_textarea_value_array = data['chat_contants']['text'].split(/\r?\n/g);
      let receive_chat_contants = '<div class="message_box w-100 text-end"> \
                                    <div class="d-flex flex-row-reverse ms-3 mt-3 text-secondary"> \
                                      <div class="pe-2">' + data['chat_contants']['send_at'] + '</div>\
                                    </div>\
                                    <div class="bg-white me-3 px-3 py-2 alert alert-secondary message-box">';
      $.each(receive_textarea_value_array, function(index, value){
        receive_chat_contants += value+'</br>';
      })
      receive_chat_contants += '</div> </div>';
    
      $('#chat_area_contants').append(receive_chat_contants)
      let chat_area_contants = $('#chat_area_contants');
      chat_area_contants[0].scrollTo(0, chat_area_contants[0].scrollHeight);
    }else{
      let receive_textarea_value_array = data['chat_contants']['text'].split(/\r?\n/g);
      let receive_chat_contants = '<div class="message_box w-100"> \
                                    <div class="d-flex flex-row ms-3 mt-3 text-secondary align-items-center pb-1"> \
                                      <img src="' + data['chat_contants']['user_icon'] + '" class="border rounded-circle img-responsive me-2" width="30px">\
                                      <div class="pe-2">'+ data['chat_contants']['user_name'] +'</div>\
                                      <div class="pe-2">' + data['chat_contants']['send_at'] + '</div>\
                                    </div>\
                                    <div class="bg-white ms-3 px-3 py-2 alert alert-secondary message-box">';
      $.each(receive_textarea_value_array, function(index, value){
        receive_chat_contants += value+'</br>';
      })
      receive_chat_contants += '</div> </div>';
    
      $('#chat_area_contants').append(receive_chat_contants)
      let chat_area_contants = $('#chat_area_contants');
      chat_area_contants[0].scrollTo(0, chat_area_contants[0].scrollHeight);
    }
  }
});

//textareaに文字列が入力されたら送信ボタンを表示する
$(function() {
  //最初は送信ボタンを表示しない
  $('#chat_send_button').hide();
  $('#chat_contants').on('input', function(){
    let chat_contants_value = $('#chat_contants').val();
    if(chat_contants_value){
      $('#chat_send_button').show();
    }else{
      $('#chat_send_button').hide();
    }
  });
})

//textareaの高さを値により変更 
$('#chat_contants').on("input", function () {
  this.style.height = 0;
  this.style.height = (this.scrollHeight) + "px";
  $(window).trigger('resize');
});

//textareaの値を非同期で送信
$(function() {
  $("#chat_send_button").click(
    function(){
      let chat_contants_value = $('#chat_contants').val();
      $('#chat_contants').val('');
      $('#chat_send_button').hide()
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        type:'post',
        url: '/send_chat',
        dataType: 'json',
        data: { 'chat_contants' : chat_contants_value},
      })

      //textareaの高さを初期化
      $('#chat_contants')[0].style.height = 0;
      $(window).trigger('resize');
  })
})