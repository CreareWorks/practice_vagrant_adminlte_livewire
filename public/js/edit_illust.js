//バックから値を受け取る
let edit_img = Laravel.toDataURL;
let illust_id = Laravel.id;
//imgを生成しtoDataURLの内容を保持させる
let output_img = document.createElement('img');
output_img.src = edit_img;

// canvas
let cnvs = document.getElementById('canvas');
let ctx = cnvs.getContext('2d');

// 変数宣言
const cnvWidth = 500;
const cnvHeight = 500;
let cnvColor = "255, 0, 0, 1";  // 線の色
let cnvBold = 5;  // 線の太さ
let clickFlg = 0;  // クリック中の判定 1:クリック開始 2:クリック中
let bgColor = "rgb(255,255,255)";
// canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
setBgColor();

//DBで保持していたtoDataURLの描画情報を初期設定
ctx.drawImage(output_img,0,0);

// canvas上でのイベント
$("#canvas").mousedown(function(){
  clickFlg = 1; // マウス押下開始
}).mouseup(function(){
  clickFlg = 0; // マウス押下終了
}).mousemove(function(e){
  // マウス移動処理
  if(!clickFlg) return false;
  draw(e.offsetX, e.offsetY);
});

// 描画処理
function draw(x, y) {
  ctx.lineWidth = cnvBold;
  ctx.strokeStyle = 'rgba('+cnvColor+')';
  // 初回処理の判定
  if (clickFlg == "1") {
    clickFlg = "2";
    ctx.beginPath();
    ctx.lineCap = "round";  //線を角丸にする
    ctx.moveTo(x, y);
  } else {
    ctx.lineTo(x, y);
  }
  ctx.stroke();
};

// 色の変更
$(".color a").click(function(){
  cnvColor = $(this).data("color");
  return false;
});

// 線の太さ変更
$(".bold a").click(function(){
  cnvBold = $(this).data("bold");
  return false;
});

// 描画クリア
$("#clear").click(function(){
  ctx.clearRect(0,0,cnvWidth,cnvHeight);
  setBgColor();
});

function setBgColor(){
  // canvasの背景色を設定(指定がない場合にjpeg保存すると背景が黒になる)
  ctx.fillStyle = bgColor;
  ctx.fillRect(0,0,cnvWidth,cnvHeight);
}

//投稿ボタンバリ
$("#target_title").change(function(){
  if($("#target_title").val() === ""){
    $("#target_submit_btn").prop("disabled", true);
  }else{
    $("#target_submit_btn").prop("disabled", false);
  }
});

//編集画像送信
//投稿処理
$("#target_submit_btn").click(function () {
  let canvas = document.getElementById('canvas');
  let base64 = canvas.toDataURL("image/jpeg");
  let title_txt = $("#target_title").val();
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    }
  });
  $.ajax({
    //POST通信
    type: "put",
    //ここでデータの送信先URLを指定します。
    url: `/updateIllust/${illust_id}`,
    dataType: "html",
    data: {
      title: title_txt,
      toDataURL: base64,
    },

  })
  //通信が成功したとき
  .then((res) => {
    $("#target_msg").html('編集内容を保存しました。')
  })
  //通信が失敗したとき
  .fail((error) => {
    console.log('失敗')
  });
});