@if($errors->has('edit_word_title') || $errors->has('edit_page_num') || $errors->has('edit_word_detail'))
<div id="edit-word-modal-content" class='py-3 px-5' style="display : block;">
@else
<div id="edit-word-modal-content" class='py-3 px-5' style="display : none;">
@endif
  <div class='text-end'>
    <img src="img/close_icon.png" class="rounded-circle img-responsive hover-expand word-modal-close" width="30px">
  </div>

  <div id='edit-word-contant' class=''>
    <form class="justify-content-center" method="POST" action="{{ url('edit_word') }}">
    @csrf
      <input id='edit_word_id' type="hidden" name="edit_word_id">
      <div class='text-center w-100'><h3 class='mb-0'>{{ '単語編集' }}</h3></div>
      <!--単語名　入力フォーム-->
      <div class="pt-3 row align-items-center">
        <label for="edit_word_title" class="col-md-5 col-form-label text-start">{{ '単語' }}</label>
        <div class="col-md-12">
            <input id="edit_word_title" type="text" class="form-control @error('edit_word_title') is-invalid @enderror" name="edit_word_title" value="{{ old('edit_word_title') }}" required autocomplete="word_ttile" autofocus>
            @error('edit_word_title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      </div>
      <!-- 章　ページ　入力フォーム -->
      <div class="pt-3 row align-items-center">
        <div class='col-6 px-3'>
          <label for="edit_section_index" class="col-md-5 col-form-label text-start">{{ '章' }}</label>
          <select id="edit_section_index" class="form-select" name="edit_section_index">
            @for($section_index=1;$section_index<=(count($words));$section_index++)
              @if($section_index == old('edit_section_index'))
                <option value={{$section_index}} selected>{{$section_index}}章</option>
              @else
                <option value={{$section_index}}>{{$section_index}}章</option>
              @endif
            @endfor
          </select>
        </div>
        <div class='col-6 px-3'>
          <label for="edit_page_num" class="col-md-5 col-form-label text-start">{{ 'ページ数' }}</label>
          <div class="col-md-12">
              <input id="edit_page_num" type="text" class="form-control @error('edit_page_num') is-invalid @enderror" name="edit_page_num" value="{{ old('edit_page_num') }}" required autocomplete="edit_page_num">
              @error('edit_page_num')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
          </div>
        </div>
      </div>
      <!-- 単語詳細説明　入力フォーム -->
      <div class="pt-3 row align-items-center">
        <label for="edit_word_detail" class="col-md-5 col-form-label text-start">{{ '説明' }}</label>
        <div class="col-md-12">
          <textarea id="edit_word_detail" class="form-control @error('edit_word_detail') is-invalid @enderror h-30 word_detail" name="edit_word_detail" required autocomplete="edit_word_detail">{{ old('edit_word_detail') }}</textarea>
          @error('edit_word_detail')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>
      </div>
      <!-- 登録ボタン -->
      <div class="pt-5 row align-items-center">
        <div class="col-md-6">
          <button type="submit" class="col-md-12 btn btn-primary">
              {{ '更新' }}
          </button>
        </div>
        <div class="col-md-6">
          <div id='delete-word-confirm-modal-open' class="col-md-12 btn btn-danger">
              {{ '削除' }}
          </div>
        </div>
      </div>
    </form>
  </div>
</div>