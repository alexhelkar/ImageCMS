var productPhotoCZoom=window.productPhotoCZoom!==undefined,productPhotoDrop=window.productPhotoDrop!==undefined;var hrefOptions={next:"#photo .drop-content .next",prev:"#photo .drop-content .prev",gallery:"#photo .frame-fancy-gallery",cycle:false,footerContent:".frame-prices-buy",galleryContent:".items-thumbs"};var optionsPhoto={effectOn:"fadeIn",drop:"#photo",position:"absolute",before:"Product.beforeShowHref",after:"Product.onComplete",closed:"Product.afterClosedPhoto"};Product={changeVariant:function(a){a=a===undefined?body:a;a.find(genObj.parentBtnBuy).find(genObj.changeVariantProduct).on("change",function(){var f=parseInt($(this).attr("value")),b=$(this).closest(genObj.parentBtnBuy),l=b.find(genObj.prefV+f).find(genObj.infoBut),m=l.data("id"),d=$.trim(l.data("vname")),g=$.trim(l.data("number")),h=l.data("price"),i=l.data("addPrice"),c=l.data("origPrice"),k=$.trim(l.data("largeImage")),e=$.trim(l.data("mainImage")),j=l.data("maxcount");$(genObj.photoProduct).add($(genObj.mainThumb)).attr("href",k);$(genObj.imgVP).attr({src:e,alt:d});$(".leftProduct .items-thumbs > li").removeClass("active").filter(":eq(0)").addClass("active");if(c!==""){b.find(genObj.priceOrigVariant).html(c)}b.find(genObj.priceVariant).html(h);b.find(genObj.priceAddPrice).html(i);ShopFront.Cart.existsVnumber(g,b);ShopFront.Cart.existsVnames(d,b);ShopFront.Cart.condProduct(j,b,l);b.find(genObj.selVariant).hide();b.find(genObj.prefV+m).show();if(productPhotoCZoom){$(".mousetrap").remove();$(".cloud-zoom, .cloud-zoom-gallery").CloudZoom()}})},initDrop:function(a){$this=a;$this.data($.extend({frame:$this.closest(genObj.parentBtnBuy),mainPhoto:$this.attr("href"),title:$this.attr("title")},optionsPhoto));return true},resizePhoto:function(b,d,f){var e=b.find(".drop-content"),a=e.find("img");a.css({width:a.actual("width"),height:a.actual("height")});if(d!==undefined){d()}a.css({width:"",height:""});if(f!==undefined){f()}$.drop.method("center")(b)},changePhoto:function(a,b,d){hrefOptions.curHref=d;var c=a[1];b.parent().addClass("p_r");b.append('<div class="preloader"></div>');$('<img src="'+d+'">').one("load").each(function(){c.find(".drop-content .inside-padd").empty().append($(this).css("visibility","visible")).prepend('<span class="helper"></span>');var e=c.find(".content-carousel");$.drop.method("limitSize")(c);Product.resizePhoto(c,function(){$.drop.method("center")(c)});e.find(".jcarousel-item").eq($.inArray(hrefOptions.curHref,hrefOptions.thumbs)).focusin()})},beforeShowHref:function(a,e,d){var c=arguments,g=hrefOptions.cycle,h=$.extend({},a.data(),hrefOptions,a.closest(genObj.parentBtnBuy).find(genObj.infoBut).data()),i=$("#photo");i.html(_.template($("#framePhotoProduct").html(),h));var m=$(hrefOptions.next),k=$(hrefOptions.prev),n=e.find(".drop-content"),u=n.find("img");hrefOptions.curHref=u.attr("src");ShopFront.Cart.processBtnBuyCount(i);ShopFront.Cart.changeCount(i);var p=n.find(".inside-padd");function b(v){if(!g){if(v===0){k.attr("disabled","disabled")}if(v===s-1){m.attr("disabled","disabled")}}}function f(v){j.removeClass("active");if(v.is(k)){m.removeAttr("disabled")}else{k.removeAttr("disabled")}t=($.inArray(hrefOptions.curHref,hrefOptions.thumbs));if(v.is(k)){if(g){if(t!==0){t=t-1}else{t=s-1}}else{if(t!==0){t=t-1}if(t===0){k.attr("disabled","disabled")}}}else{if(g){if(t!==s-1){t=t+1}else{t=0}}else{if(t!==s-1){t=t+1}if(t===s-1){m.attr("disabled","disabled")}}}l.eq(t).parent().addClass("active");Product.changePhoto(c,p,hrefOptions.thumbs[t])}var q=e.find(".content-carousel");if($.existsN(q.find(".items-thumbs").children())){q.closest(".horizontal-carousel").show();var j=q.find(".items-thumbs > li").removeClass("active"),s=j.length,l=j.find("a");hrefOptions.thumbs=new Array();l.each(function(){hrefOptions.thumbs.push($(this).attr("href"))});var o=k.add(m).removeAttr("disabled").fadeIn(),t=($.inArray(u.attr("src"),hrefOptions.thumbs));j.eq(t).addClass("active");var r=j.parent();if($.existsN(r.parent(".jcarousel-clip"))){r.unwrap()}l.off("click").on("click",function(x){o.removeAttr("disabled");j.removeClass("active");$(this).parent().addClass("active");var v=$(this).attr("href"),w=($.inArray(v,hrefOptions.thumbs));x.preventDefault();Product.changePhoto(c,p,v);b(w)});o.off("click").on("click",function(v){f($(this))});b(t)}else{q.closest(".horizontal-carousel").hide()}wnd.unbind("resize.photo").bind("resize.photo",function(){Product.resizePhoto(e)})},afterClosedPhoto:function(b,a){a.find(".addingphoto").remove()},onComplete:function(c,b,a){var d=b.find(".content-carousel");b.find(".drop-content img").css("visibility","visible");ShopFront.Cart.changeCount(b.find(genObj.plusMinus));Product.resizePhoto(b,function(){d.parent().myCarousel($.extend({},carousel,{adding:{start:$.inArray(hrefOptions.curHref,hrefOptions.thumbs)},after:function(e){e.find("ul").css("visibility","visible")}}))})}};function initPhoto(){if(productPhotoCZoom){function a(){$(genObj.photoProduct).find("img").each(function(){var c=$(this),b=Math.ceil((c.parent().outerHeight()-c.height())/2),d=Math.ceil((c.parent().outerWidth()-c.width())/2);$("#forCloudZomm").empty().append(".cloud-zoom-lens{margin:"+b+"px 0 0 "+d+"px;}.mousetrap{top:"+b+"px !important;left:"+d+"px !important;}")});$(".leftProduct").off("mouseover",".mousetrap").on("mouseover",".mousetrap",function(){var b=$(".cloud-zoom-lens");if(b.width()>$(genObj.photoProduct).width()){$(this).remove();b.remove();$("#xBlock").empty()}})}}if(productPhotoCZoom){$(".cloud-zoom, .cloud-zoom-gallery").CloudZoom();body.append('<style id="forCloudZomm"></style>');a();$(genObj.photoProduct).find("img").load(function(){a()})}$(".item-product .items-thumbs > li > a").on("click.thumb",function(d){d.preventDefault();var c=$(this),b=c.attr("href");c.parent().siblings().removeClass("active").end().addClass("active");$(genObj.photoProduct).attr("href",b).find("img").attr("src",b)});if(productPhotoDrop&&productPhotoCZoom){$(".leftProduct").on("click.mousetrap",".mousetrap",function(){var b=$(this).prev();$(this).data($.extend({frame:b.closest(genObj.parentBtnBuy),mainPhoto:b.attr("href"),title:b.attr("title")},optionsPhoto)).drop({scrollContent:false}).trigger("click.drop")})}}function initPhotoTrEv(){}$(document).on("scriptDefer",function(){initPhoto();cuselInit(body,"#variantSwitcher");Product.changeVariant()});