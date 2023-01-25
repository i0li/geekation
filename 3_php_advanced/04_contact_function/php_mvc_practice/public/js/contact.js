function confirm() {
  var is_valid = true;

  const formElement = document.forms.contact_form;
  var name  = formElement.name.value;
  var kana  = formElement.kana.value;
  var tel   = formElement.tel.value;
  var email = formElement.email.value;
  var body  = formElement.body.value;

  var name_error_text  = document.getElementsByClassName('error-text name')[0];
  var kana_error_text  = document.getElementsByClassName('error-text kana')[0];
  var tel_error_text   = document.getElementsByClassName('error-text tel')[0];
  var email_error_text = document.getElementsByClassName('error-text email')[0];
  var body_error_text  = document.getElementsByClassName('error-text body')[0];
 
  //氏名のバリデーション
  if(name.length == 0){
    is_valid = false;
    name_error_text.innerText = '氏名を入力してください';
    formElement.name.classList.add("red-border");
  }else if(name.length > 10){
    is_valid = false;
    name_error_text.innerText = '10文字以内で入力してください';
    formElement.name.classList.add("red-border");
  }else{
    name_error_text.innerText = '';
    formElement.name.classList.remove("red-border")
  }

  //フリガナのバリデーション
  if(kana.length == 0){
    is_valid = false;
    kana_error_text.innerText = 'フリガナを入力してください';
    formElement.kana.classList.add("red-border");
  }else if(kana.length > 10){
    is_valid = false;
    kana_error_text.innerText = '10文字以内で入力してください';
    formElement.kana.classList.add("red-border");
  }else{
    kana_error_text.innerText = '';
    formElement.kana.classList.remove("red-border")
  }

  //電話番号のバリデーション
  if(tel.match(/[^0-9]+/)){
    is_valid = false;
    tel_error_text.innerText = '数字のみで入力してください';
    formElement.tel.classList.add("red-border");
  }else{
    tel_error_text.innerText = '';
    formElement.tel.classList.remove("red-border")
  }

  //メールアドレスのバリデーション
  if(email.length == 0){
    is_valid = false;
    email_error_text.innerText = 'メールアドレスを入力してください';
    formElement.email.classList.add("red-border");
  }else if(! email.match(/.+@.+/)){
    is_valid = false;
    email_error_text.innerText = 'メールアドレスに「@」を挿入してください';
    formElement.email.classList.add("red-border");
  }else{
    email_error_text.innerText = '';
    formElement.email.classList.remove("red-border")
  }

  //お問い合わせ内容のバリデーション
  if(body.length == 0){
    is_valid = false;
    body_error_text.innerText = 'お問い合わせ内容を入力してください';
    formElement.body.classList.add("red-border"); 
  }else{
    body_error_text.innerText = '';
    formElement.body.classList.remove("red-border")
  }

  return is_valid;
}