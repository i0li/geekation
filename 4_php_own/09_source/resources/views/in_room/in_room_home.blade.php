@extends('layouts.app')

@section('custom-script')
<script src="{{ asset('js/myscript.js') }}" defer></script>
<script>
  let login_user_id = @json(Auth::user()->id);
  let current_room_id = @json($selected_room_info->id);
</script>
@endsection

@section('back-button')
<a class="link-secondary" href="{{ url('/home') }}">
  <li class="list-group-item border-0 ms-5"><img src="img/back_icon.png" class="rounded-circle img-responsive hover-expand" width="40px"></li>
</a>
@endsection

@section('header-title', $selected_room_info->room_name)

@section('content')
<main class="py-0 overflow-hidden">
<div id='in_room_area' class="container mx-0">
  <div class="row h-100 vw-100">
    <!---------------------------------------- 
                     単語帳エリア
    ----------------------------------------->
    <div id='word_area' class="col-6 m-0 p-0 border-end border-secondary border-2">

      <!-- 単語詳細モーダル -->
      @component('components.word_info_modal')
      @endcomponent
      <!-- 単語登録モーダル -->
      @component('components.word_create_modal')
        @slot('words', $words)
      @endcomponent
      <!-- 単語編集モーダル -->
      @component('components.word_edit_modal')
        @slot('words', $words)
      @endcomponent
      <!-- 単語削除確認モーダル -->
      @component('components.word_delete_modal')
      @endcomponent

      <!-- 単語帳エリア ヘッダー -->
      <div id='word_area_header' class="row bg-gray my-sticky-top w-100 mx-0 px-3 py-3 border-bottom border-gray border-2 d-flex align-items-center">
        <!-- 検索フォーム -->
        <div class="col-6">
          <input id='search-word' type='text' class='form-control' placeholder="キーワード検索">
        </div>
        <!-- 章による絞り込み検索 -->
        <div class="col-4">
          <select id="search-section" class="form-select">
            <option value="default" selected>{{ '全章' }}</option>
            @for($section_index=1;$section_index<=(count($words));$section_index++)
              <option value={{$section_index}}>{{$section_index}}章</option>
            @endfor
          </select>
        </div>
        <!-- 単語追加ボタン -->
        <div class="col-2 text-end">
          <div id="create-word-modal-open"><img src="img/plus_icon.png" class="rounded-circle img-responsive hover-expand" width="30px"></div>
        </div>
      </div>

      <!--単語表示エリア-->
      <div id='word_area_contents' style="overflow:auto;">
        @for($section_index=0;$section_index<(count($words));$section_index++)
          <div class='section-area'>
            <h3 class='px-3 pt-4 pb-2 my-0 border-bottom section_title bg-white'>{{$section_index + 1}}章</h3>
            @if(count($words[$section_index])!=0)
              @for($word_index=0;$word_index<(count($words[$section_index]));$word_index++)
                <div class='row w-100 mx-0 px-2 py-2 border-bottom border-gray border-1 align-items-center hover-white word-info word-info-modal-open' style="height:50px">
                  <input type='hidden' class='selected_word_id' value='{{ $words[$section_index][$word_index]->word_id }}'>
                  <div class="col-8 text-start word-title">{{ $words[$section_index][$word_index]->title }}</div>
                  <div class="col-2 text-end word-page">p.{{ $words[$section_index][$word_index]->page }}</div>
                  <div class="col-2 text-end word-user_name d-flex flex-row-reverse align-items-center">
                    @if(Auth::user()->id == $words[$section_index][$word_index]->create_user_id)
                      <input class="hover-expand edit_word_id edit-word-modal-open" type="image" src="img/edit_icon.png" value="{{ $words[$section_index][$word_index]->word_id }}" alt="編集" width="25px" height="25px">
                    @else
                      {{ $words[$section_index][$word_index]->create_user_name }}
                    @endif
                  </div>
                </div>
              @endfor
            @endif
          </div>
        @endfor
      </div>
    </div>

    <!----------------------------------------
                   チャットエリア
    ----------------------------------------->
    <div id='chat_area' class="col-6 m-0 p-0">
      <div id="chat_area_contants" class="px-0" style="overflow:auto;">
        @foreach($chats as $chat)
          @if(Auth::user()->id == $chat->user_id)
            <div class="message_box w-100 text-end">
              <div class='d-flex flex-row-reverse ms-3 mt-3 text-secondary'>
                <div class='pe-3'>{{$chat->send_at}}</div>
              </div>
              <div class="bg-white me-3 px-3 py-2 alert alert-secondary message-box">
                {!! nl2br(e($chat->text)) !!}
              </div>
            </div>
          @else
            <div class="message_box w-100">
              <div class='d-flex flex-row ms-3 mt-3 text-secondary align-items-center pb-1'>
                <img src="{{ asset($chat->icon_path) }}" class="border rounded-circle img-responsive me-2" width="30px">
                <div class='pe-2'>{{$chat->user_name}}</div>
                <div class='pe-2'>{{$chat->send_at}}</div>
              </div>
              <div class="bg-white ms-3 px-3 py-2 alert alert-secondary message-box">
                {!! nl2br(e($chat->text)) !!}
              </div>
            </div>
          @endif
        @endforeach
      </div>

      <!-- 送信ボタンエリア -->
      <div id="chat_send_form_area" class="row d-flex align-items-center w-100 mx-0  border-top bg-white border-gray border-2 px-3 py-2">
        <div class='col-11'>
          <textarea id="chat_contants" class="form-control me-3" name="chat_contants" rows="1" style="overflow-y:hidden;"></textarea>
        </div>
        <div class='col-1 d-flex align-items-center'>
          <input id="chat_send_button" class="hover-expand" type="image" src="img/send_icon.png" alt="送信" width="30px" height="30px">
        </div>
      </div>

    </div>
  </div>
</div>
</main>
@endsection

@section('modal-overlay')
  @if($errors->any() &&  !$errors->has('chat_contants'))
  <div id="modal-overlay" style='display:block;'></div>
  @endif
@endsection
