$(document).ready(function () {
  $('#illust_table').DataTable({
    // 日本語表示
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
    }
  });
  $('#contract_table').DataTable({
    "language": {
      "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
    }
  });

  //投稿処理
  $("#target_ajax_btn").click(function () {
    let contract_text = $("#contract_text").val();
    let earnings_text = $("#earnings_text").val();
    $.ajaxSetup({
      headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      }
    });
    $.ajax({
      //POST通信
      type: "post",
      //ここでデータの送信先URLを指定します。
      url: "/ajaxTable",
      dataType: "html",
      data: {
        // ↓これをリクエストで受け付ける
        // PHP側で受け取るPOST名となる : JSで渡したい変数
        contract_text: contract_text,
        earnings_text: earnings_text,
      },
    })

    //通信が成功したとき resはバックエンドからreturnした値
    .then((res) => {

      //controllerから値を受け取る parseJOSNで文字化け対策。
      let test_data = $.parseJSON(res);

      $('#ajax_table').DataTable({
        //2回目以降の検索時、一度リセット
        destroy: true,
        //日本語設定
        language: {
          url: "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Japanese.json"
        },
        //dataTablesで使用する為、dataプロパティへ格納する。
        data: test_data,
        columns: [
          { data: "id"},
          { data: "name"},
          { data: "price"},
        ]
      });
    })

    //通信が失敗したとき
    .fail((error) => {
      //文字を出力させる
      console.log('失敗')
    });
  });
});