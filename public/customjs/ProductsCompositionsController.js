angular.module("app",["AppServices"]).constant("API_URL","/products/compositions").config(["$httpProvider",function(t){t.defaults.headers.common["X-Requested-With"]="XMLHttpRequest"}]).controller("ProductsController",["$http","API_URL","PNotifyFactory","SQLSTATEFactory","GlobalFactory","ProductsFactory",function(t,o,i,e,s,n){var a=this;a.Search=function(){a.id=$("#pk_products").val(),a.searchitems=[],t.get("/products/compositions-search/"+a.id+"?search="+a.search,{}).then(function(t){var o=t.data;a.searchitems=o},function(t){e.state(t.data)})},a.LoadCompositions=function(){a.id=$("#pk_products").val(),a.compositions=[],t.get(o+"/"+a.id+"?v="+Math.random(),{}).then(function(t){var o=t.data;a.compositions=o.compositions,a.searchitems=o.searchitems,a.compositions.forEach(function(t,o){t.qty=parseFloat(t.qty)})},function(t){e.state(t.data)})},a.isNumber=function(t,o){switch(o){case"qty":isNaN(t.qty)&&(t.qty=1),parseFloat(t.qty)<=0&&(t.qty=1),t.qty=parseFloat(t.qty)}},a.RemoveCompositions=function(t){a.compositions.forEach(function(o,i){t.fk_compositions==o.fk_compositions&&a.compositions.splice(i,1)})},a.AddCompositions=function(t){var o=!1;a.compositions.forEach(function(i,e){t.pk_products==i.fk_compositions&&(i.qty=parseFloat(i.qty)+1,o=!0)}),o||a.compositions.push({fk_compositions:t.pk_products,qty:1,name:t.name})},a.SubmitCompositions=function(){PNotify.removeAll(),t.post(o+"/"+a.id,{compositions:a.compositions}).then(function(t){"success"==t.data?new PNotify({title:"Success",text:"Item Compositions saved!",type:"success"}):new PNotify({title:"Opps!",text:"Something went wrong! please try again",type:"error"})},function(t){e.state(t.data)})},a.SetQty=function(i,s){PNotify.removeAll(),a.modallabel="Manage Product Qty for ID: "+i,a.isprice=!1,a.isqty=!0,a.isvisibility=!1,a.isbarcode=!1,a.selectedID=i,a.currentaction="qty",a.qtylist=[],t.get(o+"/qtylist/"+i,{}).then(function(t){var o=t.data;a.qtylist=o.qtylist,a.qtylist.forEach(function(t,o){t.runningbalance=parseFloat(t.qty)}),"inventory"==o.type[0]?($("#ajaxmodalfooterprintdiv").prop("hidden",!0),$("#ajaxmodalfootersubmitdiv").prop("hidden",!1),$("#myModal").modal("show")):new PNotify({title:"Woops!",text:"Selected Product is non inventoriable",type:"info"})},function(t){e.state(t.data)})},$("#ajaxmodalfootersubmit").click(function(){PNotify.removeAll();var i="",e={};switch(a.currentaction){case"price":i=o+"/pricelist/"+a.selectedID,e=a.pricelist;break;case"qty":i=o+"/qtylist/"+a.selectedID,e=a.qtylist;break;case"visibility":i=o+"/visibility/"+a.selectedID,e=a.visibility;break;default:return void new PNotify({title:"Error(s) Found!",text:"action not initialized",type:"error"})}s.configAjaxSubmitModal("on"),t.post(i,{params:e}).then(function(t){t.data,location.reload()},function(t){new PNotify({title:"Error(s) found!",text:"please see logs for details",type:"error"}),console.log(t.data),s.configAjaxSubmitModal("off")})}),setTimeout(function(){a.LoadCompositions()},500)}]);