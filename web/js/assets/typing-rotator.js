!function(r){var s,n,o=3e3,d=3800,l=d-3e3,a=70,h=150,c=500,f=c+800,u=600,e=1500;function C(s){var i=v(s);if(s.parents(".brk-headline").hasClass("type")){var e=s.parent(".brk-words-rotators");e.addClass("selected").removeClass("waiting"),setTimeout(function(){e.removeClass("selected"),s.removeClass("is-visible").addClass("is-hidden").children("i").removeClass("in").addClass("out")},c),setTimeout(function(){b(i,h)},f)}else if(s.parents(".brk-headline").hasClass("letters")){var t=s.children("i").length>=i.children("i").length;!function s(i,e,t,a){i.removeClass("in").addClass("out");i.is(":last-child")?t&&setTimeout(function(){C(v(e))},o):setTimeout(function(){s(i.next(),e,t,a)},a);if(i.is(":last-child")&&r("html").hasClass("no-csstransitions")){var n=v(e);p(e,n)}}(s.find("i").eq(0),s,t,a),m(i.find("i").eq(0),i,t,a)}else s.parents(".brk-headline").hasClass("clip")?s.parents(".brk-words-rotators").animate({width:"2px"},u,function(){p(s,i),b(i)}):s.parents(".brk-headline").hasClass("loading-bar")?(s.parents(".brk-words-rotators").removeClass("is-loading"),p(s,i),setTimeout(function(){C(i)},d),setTimeout(function(){s.parents(".brk-words-rotators").addClass("is-loading")},l)):(p(s,i),setTimeout(function(){C(i)},o))}function b(s,i){s.parents(".brk-headline").hasClass("type")?(m(s.find("i").eq(0),s,!1,i),s.addClass("is-visible").removeClass("is-hidden")):s.parents(".brk-headline").hasClass("clip")&&s.parents(".brk-words-rotators").animate({width:s.width()+10},u,function(){setTimeout(function(){C(s)},e)})}function m(s,i,e,t){s.addClass("in").removeClass("out"),s.is(":last-child")?(i.parents(".brk-headline").hasClass("type")&&setTimeout(function(){i.parents(".brk-words-rotators").addClass("waiting")},200),e||setTimeout(function(){C(i)},o)):setTimeout(function(){m(s.next(),i,e,t)},t)}function v(s){return s.is(":last-child")?s.parent().children().eq(0):s.next()}function p(s,i){s.removeClass("is-visible").addClass("is-hidden"),i.removeClass("is-hidden").addClass("is-visible")}r(".brk-headline.letters").find("b").each(function(){var s=r(this),e=s.text().split(""),t=s.hasClass("is-visible");for(i in e)0<s.parents(".rotate-2").length&&(e[i]="<em>"+e[i]+"</em>"),e[i]=t?'<i class="in">'+e[i]+"</i>":"<i>"+e[i]+"</i>";var a=e.join("");s.html(a).css("opacity",1)}),s=r(".brk-headline"),n=o,s.each(function(){var s=r(this);if(s.hasClass("loading-bar"))n=d,setTimeout(function(){s.find(".brk-words-rotators").addClass("is-loading")},l);else if(s.hasClass("clip")){var i=s.find(".brk-words-rotators"),e=i.width()+10;i.css("width",e)}else if(!s.hasClass("type")){var t=s.find(".brk-words-rotators b"),a=0;t.each(function(){var s=r(this).width();a<s&&(a=s)}),s.find(".brk-words-rotators").css("width",a+60)}setTimeout(function(){C(s.find(".is-visible").eq(0))},n)}),r(window).resize(function(){if(headline=r(".brk-headline"),!headline.hasClass("type")){var s=headline.find(".brk-words-rotators b"),i=0;s.each(function(){var s=r(this).width();i<s&&(i=s)}),headline.find(".brk-words-rotators").css("width",i)}})}(jQuery);


