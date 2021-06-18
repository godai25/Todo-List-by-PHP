/****************************************************************
* 機　能： 入力された値が日付でYYYY/MM/DD形式になっているか調べる
* 引　数： strDate = 入力された値
* 戻り値： 正 = true　不正 = false
****************************************************************/
function chkDate(strDate) {
  if(!strDate.match(/^\d{4}\/\d{2}\/\d{2}$/)){
      return false;
  }
  var y = strDate.split("/")[0];
  var m = strDate.split("/")[1] - 1;
  var d = strDate.split("/")[2];
  var date = new Date(y,m,d);
  if(date.getFullYear() != y || date.getMonth() != m || date.getDate() != d){
      return false;
  }
  return true;
}