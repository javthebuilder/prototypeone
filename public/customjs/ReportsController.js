!function(){var e=angular.module("app",["AppServices"]).constant("API_URL","/reports");e.controller("ReportsController",["$http","API_URL","PNotifyFactory","SQLSTATEFactory",function(e,t,r,o){var l=this;$("select").select2({width:"100%"}),null==$("#form_title").val()&&(l.search=$("#globalsearch").val(),$("#globalsearch").focus()),l.applyFilters=function(){location.href=t+"?search="+l.search},l.globalSearch=function(){l.applyFilters()},$("#ApplyGlobalFilters").click(function(){l.applyFilters()})}]),e.controller("ReportsGenerateController",["$http","API_URL","PNotifyFactory","SQLSTATEFactory","ProductsFactory","UserFactory",function(e,t,r,o,l,a){var s=this;$("#filterCollapseCheckbox").prop("checked",!1),s.pk_permalink=$("#pk_permalink").val(),$("select").select2({width:"100%"}),l.SearchProductsPerStore("#fk_products","products",s),a.SearchUser("#fk_users",s),"1701"==s.pk_permalink&&$("#fk_stores option[value='All'] ").remove(),s.applyFilters=function(){var e=t+"/show/"+s.pk_permalink+"?",r=$("#dateFrom").val(),o=$("#dateTo").val(),l=$("#fk_stores").val(),a=$("#fk_products").val(),p=$("#fk_users").val(),i=$("#fk_categories").val(),c=$("#audittype").val(),k=$("#reporttype").val();if("1701"==s.pk_permalink)e+="dateFrom="+r+"&dateTo="+o+"&fk_stores="+l+"&fk_products="+a+"&productdesc="+$("#fk_products option[value='"+a+"'").text();else if("1702"==s.pk_permalink||"1703"==s.pk_permalink||"1705"==s.pk_permalink){e+="dateFrom="+r+"&dateTo="+o+"&fk_stores="+l+"&fk_categories="+i+"&fk_users="+p+"&fullname="+$("#fk_users option[value='"+p+"'").text()+"&reporttype="+k}else if("1704"==s.pk_permalink||"1706"==s.pk_permalink)e+="fk_stores="+l+"&fk_categories="+i;else if("1707"==s.pk_permalink){e+="dateFrom="+r+"&dateTo="+o+"&fk_users="+p+"&fullname="+$("#fk_users option[value='"+p+"'").text()+"&fk_categories="+i+"&fk_stores="+l+"&reporttype="+k}else if("1708"==s.pk_permalink){e+="audittype="+c+"&productdesc="+$("#fk_products option[value='"+a+"'").text()+"&fk_products="+a+"&fk_stores="+l+"&fk_users="+p+"&fullname="+$("#fk_users option[value='"+p+"'").text()+"&fk_categories="+i}location.href=e},$("#ApplyGlobalFilters").click(function(){s.applyFilters()}),$("#printreports").click(function(){$("#headerdescription").prop("hidden",!1),$("#reportsMstrDiv").printThis()})}])}();