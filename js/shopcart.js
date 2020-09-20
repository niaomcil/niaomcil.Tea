window.onload=function(){
    var cartTable = document.getElementById('cartTable');
    var tr = cartTable.children[1].rows;//获取table下的tbody下的每一行
    var checkInputs = document.getElementsByClassName('check');
    var checkAllInputs = document.getElementsByClassName('check-all');
    var selectedTotal = document.getElementById('selectedTotal');
    var priceTotal = document.getElementById('priceTotal');
 //计算总数和价格
    function getTotal(){
        var selected = 0;
        var price = 0;
        for(var i=0;i < tr.length; i++){
            if(tr[i].getElementsByTagName('input')[0].checked){
              selected += parseInt(tr[i].getElementsByTagName('input')[1].value);
              price += parseFloat(tr[i].cells[4].innerHTML);//cells属性为获得tr下面的td
            }
        }
        selectedTotal.innerHTML = selected;
        priceTotal.innerHTML = price.toFixed(2);//保留两位小数
     }
     for(var i=0;i<checkInputs.length;i++){
         checkInputs[i].onclick = function(){
             if(this.className === 'check-all check'){//如果点击的是全选按钮，则使所有按钮的状态和它相同
              for(var j=0;j<checkInputs.length;j++){
              checkInputs[j].checked = this.checked;
              }
             }
            if(this.checked == false){//如果其中一个变为未选中状态，则使全选按钮取消选中
                for(var i=0;i<checkAllInputs.length;i++){
                    checkAllInputs[i].checked = false;
                }
            }
            getTotal();
        }
    }
     for(var i=0;i<checkInputs.length;i++){
     checkInputs[i].onclick = function(){
     if(this.className === 'check-all check'){//如果点击的是全选按钮，则使所有按钮的状态和它相同
      for(var j=0;j<checkInputs.length;j++){
      checkInputs[j].checked = this.checked;
      }
     }
     if(this.checked == false){//如果其中一个变为未选中状态，则使全选按钮取消选中
      for(var i=0;i<checkAllInputs.length;i++){
      checkAllInputs[i].checked = false;
      }
     }
     getTotal();
     }
 }
 
 selected.onclick = function(){
     if(foot.className == 'foot'){
         if(selectedTotal.innerHTML != 0){
          foot.className = 'foot show';
         }
     }else{
        foot.className = 'foot';
     }
 }
 selectedViewList.onclick = function(e){
  var el = e.srcElement;
      if(el.className == 'del'){
      var index = el.getAttribute('index');
      var input = tr[index].getElementsByTagName('input')[0];
      input.checked = false;
      input.onclick();
      }
 }
 //增减商品数量事件代理
 for(var i=0;i<tr.length;i++){
      tr[i].onclick = function(e){
          var num_jia = document.getElementById("num-jia");
          var num_jian = document.getElementById("num-jian");
          var input_num = document.getElementById("input-num");
          num_jia.onclick = function() {
              input_num.value = parseInt(input_num.value) + 1;
          }
          num_jian.onclick = function() {
              if(input_num.value <= 1) {
                  input_num.value = 1;
              } else {
                  input_num.value = parseInt(input_num.value) - 1;
              }
          }
          getTotal();
    }
 }
}