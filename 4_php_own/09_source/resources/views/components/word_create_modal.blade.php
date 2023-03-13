@if($errors->has('create_word_title') || $errors->has('create_page_num') || $errors->has('create_word_detail'))
<div id="create-word-modal-content" class='py-3 px-5' style="display : block;">
@else
<div id="create-word-modal-content" class='py-3 px-5' style="display : none;">
@endif
  <div class='text-end'>
    <img src="img/close_icon.png" class="rounded-circle img-responsive hover-expand word-modal-close" width="30px">
  </div>

  <div id='create-word-contant' class=''>
    <form class="justify-content-center" method="POST" action="{{ url('create_word') }}">
    @csrf
      <div class='text-center w-100'><h3 class='mb-0'>{{ '単語登録' }}</h3></div>
      <!--単語名　入力フォーム-->
      <div class="pt-3 row align-items-center">
        <label for="create_word_title" class="col-md-5 col-form-label text-start">{{ '単語' }}</label>
        <div class="col-md-12">
            <input id="create_word_title" type="text" class="form-control @error('create_word_title') is-invalid @enderror" name="create_word_title" value="{{ old('create_word_title') }}" required autocomplete="word_ttile">
            @error('create_word_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div>
      <!-- 章　ページ　入力フォーム -->
      <div class="pt-3 row align-items-cente">
        <div class='col-6 px-3'>
          <label for="create_section_index" class="col-md-5 col-form-label text-start">{{ '章' }}</label>
          <select id="create_section_index" class="form-select" name="create_section_index">
            @for($section_index=1;$section_index<=(count($words));$section_index++)
              @if($section_index == old('create_section_index'))
                <option value={{$section_index}} selected>{{$section_index}}章</option>
              @else
                <option value={{$section_index}}>{{$section_index}}章</option>
              @endif
            @endfor
          </select>
        </div>
        <div class='col-6 px-3'>
          <label for="create_page_num" class="col-md-5 col-form-label text-start">{{ 'ページ数' }}</label>
          <div class="col-md-12">
              <input id="create_page_num" type="text" class="form-control @error('create_page_num') is-invalid @enderror" name="create_page_num" value="{{ old('create_page_num') }}" required autocomplete="create_page_num">
              @error('create_page_num')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>
      </div>
      <!-- 単語詳細説明　入力フォーム -->
      <div class="pt-3 row align-items-center">
        <label for="create_word_detail" class="col-md-5 col-form-label text-start">{{ '説明' }}</label>
        <div class="col-md-12">
          <textarea id="create_word_detail" class="form-control @error('create_word_detail') is-invalid @enderror h-30 word_detail" name="create_word_detail" required autocomplete="create_word_detail">{{ old('create_word_detail') }}</textarea>
          @error('create_word_detail')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>
      <!-- 登録ボタン -->
      <div class="pt-5 row align-items-center">
        <div class="col-md-12">
          <button type="submit" class="w-100 btn btn-primary">
              {{ __('登録') }}
          </button>
        </div>
      </div>
    </form>
  </div>
</div>