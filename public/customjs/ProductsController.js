angular.module("app",["AppServices"]).constant("API_URL","/products").config(["$httpProvider",function(t){t.defaults.headers.common["X-Requested-With"]="XMLHttpRequest"}]).controller("ProductsController",["$http","API_URL","PNotifyFactory","SQLSTATEFactory","GlobalFactory","ProductsFactory",function(t,e,i,o,a,r){var l=this;null==$("#form_title").val()&&(l.search=$("#globalsearch").val(),$("#globalsearch").focus()),l.Delete=function(a,r){l.selectedID=a,l.selectedStat=r,l.form_title="delete",i.setConfirmation(l,t,o,e)},l.applyFilters=function(){var t=$("#fk_categories").val(),i=$("#producttype").val();location.href=e+"?search="+l.search+"&fk_categories="+t+"&producttype="+i},l.globalSearch=function(){l.applyFilters()},$("#ApplyGlobalFilters").click(function(){l.applyFilters()}),l.isNumber=function(t,e){switch(e){case"price":isNaN(t.priceadj)&&(t.priceadj=0);break;case"discount":isNaN(t.discountadj)&&(t.discountadj=0);break;case"qty":isNaN(t.qtyadj)&&(t.qtyadj=0),t.qty=parseFloat(t.qty),t.qtyadj=parseFloat(t.qtyadj),t.runningbalance=parseFloat(t.qty)+parseFloat(t.qtyadj),t.runningbalance<0&&(t.qtyadj=0,t.runningbalance=parseFloat(t.qty)+parseFloat(t.qtyadj))}},l.ShowQtyList=function(t){console.log(t)},l.SetPrices=function(i,a){PNotify.removeAll(),l.modallabel="Manage Product Prices for ID: "+i,l.isprice=!0,l.isqty=!1,l.isvisibility=!1,l.isbarcode=!1,l.selectedID=i,l.currentaction="price",l.pricelist=[],t.get(e+"/pricelist/"+i,{}).then(function(t){var e=t.data;l.pricelist=e,$("#ajaxmodalfooterprint").prop("hidden",!0),$("#ajaxmodalfootersubmit").prop("hidden",!1),$("#myModal").modal("show")},function(t){o.state(t.data)})},l.SetQty=function(i,a){PNotify.removeAll(),l.modallabel="Manage Product Qty for ID: "+i,l.isprice=!1,l.isqty=!0,l.isvisibility=!1,l.isbarcode=!1,l.selectedID=i,l.currentaction="qty",l.qtylist=[],t.get(e+"/qtylist/"+i,{}).then(function(t){var e=t.data;l.qtylist=e.qtylist,l.qtylist.forEach(function(t,e){t.runningbalance=parseFloat(t.qty)}),"inventory"==e.type[0]?($("#ajaxmodalfooterprintdiv").prop("hidden",!0),$("#ajaxmodalfootersubmitdiv").prop("hidden",!1),$("#myModal").modal("show")):new PNotify({title:"Woops!",text:"Selected Product is non inventoriable",type:"info"})},function(t){o.state(t.data)})},l.SetVisibility=function(i,a){PNotify.removeAll(),l.modallabel="Manage Product Visibility for ID: "+i,l.isprice=!1,l.isqty=!1,l.isvisibility=!0,l.isbarcode=!1,l.selectedID=i,l.currentaction="visibility",l.visibility=[],t.get(e+"/visibility/"+i,{}).then(function(t){var e=t.data;l.visibility=e,l.visibility.forEach(function(t,e){t.selected="1"==t.selected}),$("#ajaxmodalfooterprintdiv").prop("hidden",!0),$("#ajaxmodalfootersubmitdiv").prop("hidden",!1),$("#myModal").modal("show")},function(t){o.state(t.data)})},l.PrintBarcode=function(i,o){l.modallabel="Print Barcode",l.isprice=!1,l.isqty=!1,l.isvisibility=!1,l.isbarcode=!0,l.selectedID=i,l.currentaction="printbarcode",t.get(e+"/show/"+i).then(function(t){var e=t.data;$("#productbarcode").html(""),$("#productbarcode").barcode(e.barcode,"code128",{barWidth:1,barHeight:50}),$("#ajaxmodalfooterprintdiv").prop("hidden",!1),$("#ajaxmodalfootersubmitdiv").prop("hidden",!0),$("#myModal").modal("show")},function(t){new PNotify({title:"Error(s) found!",text:"please see logs for details",type:"error"}),console.log(t)})},$("#ajaxmodalfooterprint").click(function(){$("#productbarcode").printThis()}),$("#ajaxmodalfootersubmit").click(function(){PNotify.removeAll();var i="",o={};switch(l.currentaction){case"price":i=e+"/pricelist/"+l.selectedID,o=l.pricelist;break;case"qty":i=e+"/qtylist/"+l.selectedID,o=l.qtylist;break;case"visibility":i=e+"/visibility/"+l.selectedID,o=l.visibility;break;default:return void new PNotify({title:"Error(s) Found!",text:"action not initialized",type:"error"})}a.configAjaxSubmitModal("on"),t.post(i,{params:o}).then(function(t){t.data,location.reload()},function(t){new PNotify({title:"Error(s) found!",text:"please see logs for details",type:"error"}),console.log(t.data),a.configAjaxSubmitModal("off")})}),$("select").select2({width:"100%"}),l.SetProductType=function(){"inventory"==$("#type").val()?($("#divfk_supplier").prop("hidden",!1),$("#divcost").prop("hidden",!1),$("#divuom").prop("hidden",!1),$("#divalertqty").prop("hidden",!1)):($("#divfk_supplier").prop("hidden",!0),$("#divcost").prop("hidden",!0),$("#divuom").prop("hidden",!0),$("#divalertqty").prop("hidden",!0))},null!=$("#form_title").val()&&l.SetProductType(),$("#type").change(function(){l.SetProductType()})}]);