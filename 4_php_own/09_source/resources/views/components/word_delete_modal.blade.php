<div id="delete-word-confirm-modal-content" class='py-3 px-5'>
  <div id='delete-word-info-contant' class='pt-3'>
    <div class='text-center w-100'><h3 class='pt-5'>{{ 'この単語を削除しますか？' }}</h3></div>
    <div class='row border-bottom border-1 border-dark pt-5'>
      <div id='delete-word-info-title' class='col-12'><h3>word-title</h3></div>
    </div>
    <div id='delete-word-info-detail' class='pt-5 word_detail' style="overflow:auto;"></div>
  </div>
  <form class="justify-content-center pt-5" method="POST" action="{{ url('/delete_word') }}">
    <input id='delete_word_id' type="hidden" name='delete_word_id' >
    <div class="pt-5 row align-items-center">
      @csrf
      <div class="col-md-6">
        <div class="col-md-12 btn btn-secondary word-modal-close">
            {{ __('閉じる') }}
        </div>
      </div>
      <div class="col-md-6">
        <button type="submit" class="col-md-12 btn btn-danger">
          {{ __('削除') }}
        </button>
      </div>  
    </div>
  </form>
</div>