//送信準備
$(document).ready(function(){
    $.ajaxSetup({
       headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
    });
  //フォームのsubmitを拾う
  $('#postSend').on('click', '.btn-primary', function(event){
    //通常のアクションをキャンセルする
    event.preventDefault();
    //Formの参照を取る
    $form = $(this).parents('form:first');
    $.ajax({
         url : $form.attr('action'), //Formのアクションを取得して指定する
         type: $form.attr('method'),//Formのメソッドを取得して指定する
         data: $form.serialize(),　 //データにFormがserialzeした結果を入れる
         timeout: 10000,
         beforeSend : function(xhr, settings){
             //Buttonを無効にする
             $('#postSend').attr('disabled' , true);
         },
         complete: function(xhr, textStatus){
              $('#btnProfileUpdate').attr('disabled' , false);
         },
    }).done(function(data){ //ajaxの通信に成功した場合
      console.debug("result" + data);
          alert("success!");
      }).fail(function(data){ //ajaxの通信に失敗した場合
        console.debug("result" + data);
          alert("error!");
      });
  });
  });