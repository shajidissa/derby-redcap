/****************************************************************************************************/
/*****************Bundled JavaScript Packages**********************************************************/
/****************************************************************************************************/

/*! jQuery v1.12.4 | (c) jQuery Foundation | jquery.org/license */
!function(a,b){"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){var c=[],d=a.document,e=c.slice,f=c.concat,g=c.push,h=c.indexOf,i={},j=i.toString,k=i.hasOwnProperty,l={},m="1.12.4",n=function(a,b){return new n.fn.init(a,b)},o=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,p=/^-ms-/,q=/-([\da-z])/gi,r=function(a,b){return b.toUpperCase()};n.fn=n.prototype={jquery:m,constructor:n,selector:"",length:0,toArray:function(){return e.call(this)},get:function(a){return null!=a?0>a?this[a+this.length]:this[a]:e.call(this)},pushStack:function(a){var b=n.merge(this.constructor(),a);return b.prevObject=this,b.context=this.context,b},each:function(a){return n.each(this,a)},map:function(a){return this.pushStack(n.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(e.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(0>a?b:0);return this.pushStack(c>=0&&b>c?[this[c]]:[])},end:function(){return this.prevObject||this.constructor()},push:g,sort:c.sort,splice:c.splice},n.extend=n.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||n.isFunction(g)||(g={}),h===i&&(g=this,h--);i>h;h++)if(null!=(e=arguments[h]))for(d in e)a=g[d],c=e[d],g!==c&&(j&&c&&(n.isPlainObject(c)||(b=n.isArray(c)))?(b?(b=!1,f=a&&n.isArray(a)?a:[]):f=a&&n.isPlainObject(a)?a:{},g[d]=n.extend(j,f,c)):void 0!==c&&(g[d]=c));return g},n.extend({expando:"jQuery"+(m+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===n.type(a)},isArray:Array.isArray||function(a){return"array"===n.type(a)},isWindow:function(a){return null!=a&&a==a.window},isNumeric:function(a){var b=a&&a.toString();return!n.isArray(a)&&b-parseFloat(b)+1>=0},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},isPlainObject:function(a){var b;if(!a||"object"!==n.type(a)||a.nodeType||n.isWindow(a))return!1;try{if(a.constructor&&!k.call(a,"constructor")&&!k.call(a.constructor.prototype,"isPrototypeOf"))return!1}catch(c){return!1}if(!l.ownFirst)for(b in a)return k.call(a,b);for(b in a);return void 0===b||k.call(a,b)},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?i[j.call(a)]||"object":typeof a},globalEval:function(b){b&&n.trim(b)&&(a.execScript||function(b){a.eval.call(a,b)})(b)},camelCase:function(a){return a.replace(p,"ms-").replace(q,r)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()},each:function(a,b){var c,d=0;if(s(a)){for(c=a.length;c>d;d++)if(b.call(a[d],d,a[d])===!1)break}else for(d in a)if(b.call(a[d],d,a[d])===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(o,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(s(Object(a))?n.merge(c,"string"==typeof a?[a]:a):g.call(c,a)),c},inArray:function(a,b,c){var d;if(b){if(h)return h.call(b,a,c);for(d=b.length,c=c?0>c?Math.max(0,d+c):c:0;d>c;c++)if(c in b&&b[c]===a)return c}return-1},merge:function(a,b){var c=+b.length,d=0,e=a.length;while(c>d)a[e++]=b[d++];if(c!==c)while(void 0!==b[d])a[e++]=b[d++];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;g>f;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,e,g=0,h=[];if(s(a))for(d=a.length;d>g;g++)e=b(a[g],g,c),null!=e&&h.push(e);else for(g in a)e=b(a[g],g,c),null!=e&&h.push(e);return f.apply([],h)},guid:1,proxy:function(a,b){var c,d,f;return"string"==typeof b&&(f=a[b],b=a,a=f),n.isFunction(a)?(c=e.call(arguments,2),d=function(){return a.apply(b||this,c.concat(e.call(arguments)))},d.guid=a.guid=a.guid||n.guid++,d):void 0},now:function(){return+new Date},support:l}),"function"==typeof Symbol&&(n.fn[Symbol.iterator]=c[Symbol.iterator]),n.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(a,b){i["[object "+b+"]"]=b.toLowerCase()});function s(a){var b=!!a&&"length"in a&&a.length,c=n.type(a);return"function"===c||n.isWindow(a)?!1:"array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a}var t=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=ga(),z=ga(),A=ga(),B=function(a,b){return a===b&&(l=!0),0},C=1<<31,D={}.hasOwnProperty,E=[],F=E.pop,G=E.push,H=E.push,I=E.slice,J=function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},K="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",L="[\\x20\\t\\r\\n\\f]",M="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",N="\\["+L+"*("+M+")(?:"+L+"*([*^$|!~]?=)"+L+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+M+"))|)"+L+"*\\]",O=":("+M+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+N+")*)|.*)\\)|)",P=new RegExp(L+"+","g"),Q=new RegExp("^"+L+"+|((?:^|[^\\\\])(?:\\\\.)*)"+L+"+$","g"),R=new RegExp("^"+L+"*,"+L+"*"),S=new RegExp("^"+L+"*([>+~]|"+L+")"+L+"*"),T=new RegExp("="+L+"*([^\\]'\"]*?)"+L+"*\\]","g"),U=new RegExp(O),V=new RegExp("^"+M+"$"),W={ID:new RegExp("^#("+M+")"),CLASS:new RegExp("^\\.("+M+")"),TAG:new RegExp("^("+M+"|[*])"),ATTR:new RegExp("^"+N),PSEUDO:new RegExp("^"+O),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+L+"*(even|odd|(([+-]|)(\\d*)n|)"+L+"*(?:([+-]|)"+L+"*(\\d+)|))"+L+"*\\)|)","i"),bool:new RegExp("^(?:"+K+")$","i"),needsContext:new RegExp("^"+L+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+L+"*((?:-\\d)?\\d*)"+L+"*\\)|)(?=[^-]|$)","i")},X=/^(?:input|select|textarea|button)$/i,Y=/^h\d$/i,Z=/^[^{]+\{\s*\[native \w/,$=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,_=/[+~]/,aa=/'|\\/g,ba=new RegExp("\\\\([\\da-f]{1,6}"+L+"?|("+L+")|.)","ig"),ca=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:0>d?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},da=function(){m()};try{H.apply(E=I.call(v.childNodes),v.childNodes),E[v.childNodes.length].nodeType}catch(ea){H={apply:E.length?function(a,b){G.apply(a,I.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function fa(a,b,d,e){var f,h,j,k,l,o,r,s,w=b&&b.ownerDocument,x=b?b.nodeType:9;if(d=d||[],"string"!=typeof a||!a||1!==x&&9!==x&&11!==x)return d;if(!e&&((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,p)){if(11!==x&&(o=$.exec(a)))if(f=o[1]){if(9===x){if(!(j=b.getElementById(f)))return d;if(j.id===f)return d.push(j),d}else if(w&&(j=w.getElementById(f))&&t(b,j)&&j.id===f)return d.push(j),d}else{if(o[2])return H.apply(d,b.getElementsByTagName(a)),d;if((f=o[3])&&c.getElementsByClassName&&b.getElementsByClassName)return H.apply(d,b.getElementsByClassName(f)),d}if(c.qsa&&!A[a+" "]&&(!q||!q.test(a))){if(1!==x)w=b,s=a;else if("object"!==b.nodeName.toLowerCase()){(k=b.getAttribute("id"))?k=k.replace(aa,"\\$&"):b.setAttribute("id",k=u),r=g(a),h=r.length,l=V.test(k)?"#"+k:"[id='"+k+"']";while(h--)r[h]=l+" "+qa(r[h]);s=r.join(","),w=_.test(a)&&oa(b.parentNode)||b}if(s)try{return H.apply(d,w.querySelectorAll(s)),d}catch(y){}finally{k===u&&b.removeAttribute("id")}}}return i(a.replace(Q,"$1"),b,d,e)}function ga(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ha(a){return a[u]=!0,a}function ia(a){var b=n.createElement("div");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function ja(a,b){var c=a.split("|"),e=c.length;while(e--)d.attrHandle[c[e]]=b}function ka(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&(~b.sourceIndex||C)-(~a.sourceIndex||C);if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function la(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function ma(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function na(a){return ha(function(b){return b=+b,ha(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function oa(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=fa.support={},f=fa.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return b?"HTML"!==b.nodeName:!1},m=fa.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=n.documentElement,p=!f(n),(e=n.defaultView)&&e.top!==e&&(e.addEventListener?e.addEventListener("unload",da,!1):e.attachEvent&&e.attachEvent("onunload",da)),c.attributes=ia(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=ia(function(a){return a.appendChild(n.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=Z.test(n.getElementsByClassName),c.getById=ia(function(a){return o.appendChild(a).id=u,!n.getElementsByName||!n.getElementsByName(u).length}),c.getById?(d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c?[c]:[]}},d.filter.ID=function(a){var b=a.replace(ba,ca);return function(a){return a.getAttribute("id")===b}}):(delete d.find.ID,d.filter.ID=function(a){var b=a.replace(ba,ca);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){return"undefined"!=typeof b.getElementsByClassName&&p?b.getElementsByClassName(a):void 0},r=[],q=[],(c.qsa=Z.test(n.querySelectorAll))&&(ia(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\r\\' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+L+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+L+"*(?:value|"+K+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),ia(function(a){var b=n.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+L+"*[*^$|!~]?="),a.querySelectorAll(":enabled").length||q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=Z.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&ia(function(a){c.disconnectedMatch=s.call(a,"div"),s.call(a,"[s!='']:x"),r.push("!=",O)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=Z.test(o.compareDocumentPosition),t=b||Z.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===n||a.ownerDocument===v&&t(v,a)?-1:b===n||b.ownerDocument===v&&t(v,b)?1:k?J(k,a)-J(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,g=[a],h=[b];if(!e||!f)return a===n?-1:b===n?1:e?-1:f?1:k?J(k,a)-J(k,b):0;if(e===f)return ka(a,b);c=a;while(c=c.parentNode)g.unshift(c);c=b;while(c=c.parentNode)h.unshift(c);while(g[d]===h[d])d++;return d?ka(g[d],h[d]):g[d]===v?-1:h[d]===v?1:0},n):n},fa.matches=function(a,b){return fa(a,null,null,b)},fa.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(T,"='$1']"),c.matchesSelector&&p&&!A[b+" "]&&(!r||!r.test(b))&&(!q||!q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return fa(b,n,null,[a]).length>0},fa.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},fa.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&D.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},fa.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},fa.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=fa.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=fa.selectors={cacheLength:50,createPseudo:ha,match:W,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(ba,ca),a[3]=(a[3]||a[4]||a[5]||"").replace(ba,ca),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||fa.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&fa.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return W.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&U.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(ba,ca).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+L+")"+a+"("+L+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=fa.attr(d,a);return null==e?"!="===b:b?(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(P," ")+" ").indexOf(c)>-1:"|="===b?e===c||e.slice(0,c.length+1)===c+"-":!1):!0}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h,t=!1;if(q){if(f){while(p){m=b;while(m=m[p])if(h?m.nodeName.toLowerCase()===r:1===m.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){m=q,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n&&j[2],m=n&&q.childNodes[n];while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if(1===m.nodeType&&++t&&m===b){k[a]=[w,n,t];break}}else if(s&&(m=b,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n),t===!1)while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if((h?m.nodeName.toLowerCase()===r:1===m.nodeType)&&++t&&(s&&(l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),k[a]=[w,t]),m===b))break;return t-=e,t===d||t%d===0&&t/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||fa.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ha(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=J(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ha(function(a){var b=[],c=[],d=h(a.replace(Q,"$1"));return d[u]?ha(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ha(function(a){return function(b){return fa(a,b).length>0}}),contains:ha(function(a){return a=a.replace(ba,ca),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ha(function(a){return V.test(a||"")||fa.error("unsupported lang: "+a),a=a.replace(ba,ca).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:function(a){return a.disabled===!1},disabled:function(a){return a.disabled===!0},checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return Y.test(a.nodeName)},input:function(a){return X.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:na(function(){return[0]}),last:na(function(a,b){return[b-1]}),eq:na(function(a,b,c){return[0>c?c+b:c]}),even:na(function(a,b){for(var c=0;b>c;c+=2)a.push(c);return a}),odd:na(function(a,b){for(var c=1;b>c;c+=2)a.push(c);return a}),lt:na(function(a,b,c){for(var d=0>c?c+b:c;--d>=0;)a.push(d);return a}),gt:na(function(a,b,c){for(var d=0>c?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=la(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=ma(b);function pa(){}pa.prototype=d.filters=d.pseudos,d.setFilters=new pa,g=fa.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){c&&!(e=R.exec(h))||(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=S.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(Q," ")}),h=h.slice(c.length));for(g in d.filter)!(e=W[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?fa.error(a):z(a,i).slice(0)};function qa(a){for(var b=0,c=a.length,d="";c>b;b++)d+=a[b].value;return d}function ra(a,b,c){var d=b.dir,e=c&&"parentNode"===d,f=x++;return b.first?function(b,c,f){while(b=b[d])if(1===b.nodeType||e)return a(b,c,f)}:function(b,c,g){var h,i,j,k=[w,f];if(g){while(b=b[d])if((1===b.nodeType||e)&&a(b,c,g))return!0}else while(b=b[d])if(1===b.nodeType||e){if(j=b[u]||(b[u]={}),i=j[b.uniqueID]||(j[b.uniqueID]={}),(h=i[d])&&h[0]===w&&h[1]===f)return k[2]=h[2];if(i[d]=k,k[2]=a(b,c,g))return!0}}}function sa(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function ta(a,b,c){for(var d=0,e=b.length;e>d;d++)fa(a,b[d],c);return c}function ua(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;i>h;h++)(f=a[h])&&(c&&!c(f,d,e)||(g.push(f),j&&b.push(h)));return g}function va(a,b,c,d,e,f){return d&&!d[u]&&(d=va(d)),e&&!e[u]&&(e=va(e,f)),ha(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||ta(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:ua(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=ua(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?J(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=ua(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):H.apply(g,r)})}function wa(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=ra(function(a){return a===b},h,!0),l=ra(function(a){return J(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];f>i;i++)if(c=d.relative[a[i].type])m=[ra(sa(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;f>e;e++)if(d.relative[a[e].type])break;return va(i>1&&sa(m),i>1&&qa(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(Q,"$1"),c,e>i&&wa(a.slice(i,e)),f>e&&wa(a=a.slice(e)),f>e&&qa(a))}m.push(c)}return sa(m)}function xa(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,o,q,r=0,s="0",t=f&&[],u=[],v=j,x=f||e&&d.find.TAG("*",k),y=w+=null==v?1:Math.random()||.1,z=x.length;for(k&&(j=g===n||g||k);s!==z&&null!=(l=x[s]);s++){if(e&&l){o=0,g||l.ownerDocument===n||(m(l),h=!p);while(q=a[o++])if(q(l,g||n,h)){i.push(l);break}k&&(w=y)}c&&((l=!q&&l)&&r--,f&&t.push(l))}if(r+=s,c&&s!==r){o=0;while(q=b[o++])q(t,u,g,h);if(f){if(r>0)while(s--)t[s]||u[s]||(u[s]=F.call(i));u=ua(u)}H.apply(i,u),k&&!f&&u.length>0&&r+b.length>1&&fa.uniqueSort(i)}return k&&(w=y,j=v),t};return c?ha(f):f}return h=fa.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=wa(b[c]),f[u]?d.push(f):e.push(f);f=A(a,xa(e,d)),f.selector=a}return f},i=fa.select=function(a,b,e,f){var i,j,k,l,m,n="function"==typeof a&&a,o=!f&&g(a=n.selector||a);if(e=e||[],1===o.length){if(j=o[0]=o[0].slice(0),j.length>2&&"ID"===(k=j[0]).type&&c.getById&&9===b.nodeType&&p&&d.relative[j[1].type]){if(b=(d.find.ID(k.matches[0].replace(ba,ca),b)||[])[0],!b)return e;n&&(b=b.parentNode),a=a.slice(j.shift().value.length)}i=W.needsContext.test(a)?0:j.length;while(i--){if(k=j[i],d.relative[l=k.type])break;if((m=d.find[l])&&(f=m(k.matches[0].replace(ba,ca),_.test(j[0].type)&&oa(b.parentNode)||b))){if(j.splice(i,1),a=f.length&&qa(j),!a)return H.apply(e,f),e;break}}}return(n||h(a,o))(f,b,!p,e,!b||_.test(a)&&oa(b.parentNode)||b),e},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=ia(function(a){return 1&a.compareDocumentPosition(n.createElement("div"))}),ia(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||ja("type|href|height|width",function(a,b,c){return c?void 0:a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&ia(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||ja("value",function(a,b,c){return c||"input"!==a.nodeName.toLowerCase()?void 0:a.defaultValue}),ia(function(a){return null==a.getAttribute("disabled")})||ja(K,function(a,b,c){var d;return c?void 0:a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),fa}(a);n.find=t,n.expr=t.selectors,n.expr[":"]=n.expr.pseudos,n.uniqueSort=n.unique=t.uniqueSort,n.text=t.getText,n.isXMLDoc=t.isXML,n.contains=t.contains;var u=function(a,b,c){var d=[],e=void 0!==c;while((a=a[b])&&9!==a.nodeType)if(1===a.nodeType){if(e&&n(a).is(c))break;d.push(a)}return d},v=function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c},w=n.expr.match.needsContext,x=/^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,y=/^.[^:#\[\.,]*$/;function z(a,b,c){if(n.isFunction(b))return n.grep(a,function(a,d){return!!b.call(a,d,a)!==c});if(b.nodeType)return n.grep(a,function(a){return a===b!==c});if("string"==typeof b){if(y.test(b))return n.filter(b,a,c);b=n.filter(b,a)}return n.grep(a,function(a){return n.inArray(a,b)>-1!==c})}n.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?n.find.matchesSelector(d,a)?[d]:[]:n.find.matches(a,n.grep(b,function(a){return 1===a.nodeType}))},n.fn.extend({find:function(a){var b,c=[],d=this,e=d.length;if("string"!=typeof a)return this.pushStack(n(a).filter(function(){for(b=0;e>b;b++)if(n.contains(d[b],this))return!0}));for(b=0;e>b;b++)n.find(a,d[b],c);return c=this.pushStack(e>1?n.unique(c):c),c.selector=this.selector?this.selector+" "+a:a,c},filter:function(a){return this.pushStack(z(this,a||[],!1))},not:function(a){return this.pushStack(z(this,a||[],!0))},is:function(a){return!!z(this,"string"==typeof a&&w.test(a)?n(a):a||[],!1).length}});var A,B=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,C=n.fn.init=function(a,b,c){var e,f;if(!a)return this;if(c=c||A,"string"==typeof a){if(e="<"===a.charAt(0)&&">"===a.charAt(a.length-1)&&a.length>=3?[null,a,null]:B.exec(a),!e||!e[1]&&b)return!b||b.jquery?(b||c).find(a):this.constructor(b).find(a);if(e[1]){if(b=b instanceof n?b[0]:b,n.merge(this,n.parseHTML(e[1],b&&b.nodeType?b.ownerDocument||b:d,!0)),x.test(e[1])&&n.isPlainObject(b))for(e in b)n.isFunction(this[e])?this[e](b[e]):this.attr(e,b[e]);return this}if(f=d.getElementById(e[2]),f&&f.parentNode){if(f.id!==e[2])return A.find(a);this.length=1,this[0]=f}return this.context=d,this.selector=a,this}return a.nodeType?(this.context=this[0]=a,this.length=1,this):n.isFunction(a)?"undefined"!=typeof c.ready?c.ready(a):a(n):(void 0!==a.selector&&(this.selector=a.selector,this.context=a.context),n.makeArray(a,this))};C.prototype=n.fn,A=n(d);var D=/^(?:parents|prev(?:Until|All))/,E={children:!0,contents:!0,next:!0,prev:!0};n.fn.extend({has:function(a){var b,c=n(a,this),d=c.length;return this.filter(function(){for(b=0;d>b;b++)if(n.contains(this,c[b]))return!0})},closest:function(a,b){for(var c,d=0,e=this.length,f=[],g=w.test(a)||"string"!=typeof a?n(a,b||this.context):0;e>d;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&n.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?n.uniqueSort(f):f)},index:function(a){return a?"string"==typeof a?n.inArray(this[0],n(a)):n.inArray(a.jquery?a[0]:a,this):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(n.uniqueSort(n.merge(this.get(),n(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function F(a,b){do a=a[b];while(a&&1!==a.nodeType);return a}n.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return u(a,"parentNode")},parentsUntil:function(a,b,c){return u(a,"parentNode",c)},next:function(a){return F(a,"nextSibling")},prev:function(a){return F(a,"previousSibling")},nextAll:function(a){return u(a,"nextSibling")},prevAll:function(a){return u(a,"previousSibling")},nextUntil:function(a,b,c){return u(a,"nextSibling",c)},prevUntil:function(a,b,c){return u(a,"previousSibling",c)},siblings:function(a){return v((a.parentNode||{}).firstChild,a)},children:function(a){return v(a.firstChild)},contents:function(a){return n.nodeName(a,"iframe")?a.contentDocument||a.contentWindow.document:n.merge([],a.childNodes)}},function(a,b){n.fn[a]=function(c,d){var e=n.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=n.filter(d,e)),this.length>1&&(E[a]||(e=n.uniqueSort(e)),D.test(a)&&(e=e.reverse())),this.pushStack(e)}});var G=/\S+/g;function H(a){var b={};return n.each(a.match(G)||[],function(a,c){b[c]=!0}),b}n.Callbacks=function(a){a="string"==typeof a?H(a):n.extend({},a);var b,c,d,e,f=[],g=[],h=-1,i=function(){for(e=a.once,d=b=!0;g.length;h=-1){c=g.shift();while(++h<f.length)f[h].apply(c[0],c[1])===!1&&a.stopOnFalse&&(h=f.length,c=!1)}a.memory||(c=!1),b=!1,e&&(f=c?[]:"")},j={add:function(){return f&&(c&&!b&&(h=f.length-1,g.push(c)),function d(b){n.each(b,function(b,c){n.isFunction(c)?a.unique&&j.has(c)||f.push(c):c&&c.length&&"string"!==n.type(c)&&d(c)})}(arguments),c&&!b&&i()),this},remove:function(){return n.each(arguments,function(a,b){var c;while((c=n.inArray(b,f,c))>-1)f.splice(c,1),h>=c&&h--}),this},has:function(a){return a?n.inArray(a,f)>-1:f.length>0},empty:function(){return f&&(f=[]),this},disable:function(){return e=g=[],f=c="",this},disabled:function(){return!f},lock:function(){return e=!0,c||j.disable(),this},locked:function(){return!!e},fireWith:function(a,c){return e||(c=c||[],c=[a,c.slice?c.slice():c],g.push(c),b||i()),this},fire:function(){return j.fireWith(this,arguments),this},fired:function(){return!!d}};return j},n.extend({Deferred:function(a){var b=[["resolve","done",n.Callbacks("once memory"),"resolved"],["reject","fail",n.Callbacks("once memory"),"rejected"],["notify","progress",n.Callbacks("memory")]],c="pending",d={state:function(){return c},always:function(){return e.done(arguments).fail(arguments),this},then:function(){var a=arguments;return n.Deferred(function(c){n.each(b,function(b,f){var g=n.isFunction(a[b])&&a[b];e[f[1]](function(){var a=g&&g.apply(this,arguments);a&&n.isFunction(a.promise)?a.promise().progress(c.notify).done(c.resolve).fail(c.reject):c[f[0]+"With"](this===d?c.promise():this,g?[a]:arguments)})}),a=null}).promise()},promise:function(a){return null!=a?n.extend(a,d):d}},e={};return d.pipe=d.then,n.each(b,function(a,f){var g=f[2],h=f[3];d[f[1]]=g.add,h&&g.add(function(){c=h},b[1^a][2].disable,b[2][2].lock),e[f[0]]=function(){return e[f[0]+"With"](this===e?d:this,arguments),this},e[f[0]+"With"]=g.fireWith}),d.promise(e),a&&a.call(e,e),e},when:function(a){var b=0,c=e.call(arguments),d=c.length,f=1!==d||a&&n.isFunction(a.promise)?d:0,g=1===f?a:n.Deferred(),h=function(a,b,c){return function(d){b[a]=this,c[a]=arguments.length>1?e.call(arguments):d,c===i?g.notifyWith(b,c):--f||g.resolveWith(b,c)}},i,j,k;if(d>1)for(i=new Array(d),j=new Array(d),k=new Array(d);d>b;b++)c[b]&&n.isFunction(c[b].promise)?c[b].promise().progress(h(b,j,i)).done(h(b,k,c)).fail(g.reject):--f;return f||g.resolveWith(k,c),g.promise()}});var I;n.fn.ready=function(a){return n.ready.promise().done(a),this},n.extend({isReady:!1,readyWait:1,holdReady:function(a){a?n.readyWait++:n.ready(!0)},ready:function(a){(a===!0?--n.readyWait:n.isReady)||(n.isReady=!0,a!==!0&&--n.readyWait>0||(I.resolveWith(d,[n]),n.fn.triggerHandler&&(n(d).triggerHandler("ready"),n(d).off("ready"))))}});function J(){d.addEventListener?(d.removeEventListener("DOMContentLoaded",K),a.removeEventListener("load",K)):(d.detachEvent("onreadystatechange",K),a.detachEvent("onload",K))}function K(){(d.addEventListener||"load"===a.event.type||"complete"===d.readyState)&&(J(),n.ready())}n.ready.promise=function(b){if(!I)if(I=n.Deferred(),"complete"===d.readyState||"loading"!==d.readyState&&!d.documentElement.doScroll)a.setTimeout(n.ready);else if(d.addEventListener)d.addEventListener("DOMContentLoaded",K),a.addEventListener("load",K);else{d.attachEvent("onreadystatechange",K),a.attachEvent("onload",K);var c=!1;try{c=null==a.frameElement&&d.documentElement}catch(e){}c&&c.doScroll&&!function f(){if(!n.isReady){try{c.doScroll("left")}catch(b){return a.setTimeout(f,50)}J(),n.ready()}}()}return I.promise(b)},n.ready.promise();var L;for(L in n(l))break;l.ownFirst="0"===L,l.inlineBlockNeedsLayout=!1,n(function(){var a,b,c,e;c=d.getElementsByTagName("body")[0],c&&c.style&&(b=d.createElement("div"),e=d.createElement("div"),e.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",c.appendChild(e).appendChild(b),"undefined"!=typeof b.style.zoom&&(b.style.cssText="display:inline;margin:0;border:0;padding:1px;width:1px;zoom:1",l.inlineBlockNeedsLayout=a=3===b.offsetWidth,a&&(c.style.zoom=1)),c.removeChild(e))}),function(){var a=d.createElement("div");l.deleteExpando=!0;try{delete a.test}catch(b){l.deleteExpando=!1}a=null}();var M=function(a){var b=n.noData[(a.nodeName+" ").toLowerCase()],c=+a.nodeType||1;return 1!==c&&9!==c?!1:!b||b!==!0&&a.getAttribute("classid")===b},N=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,O=/([A-Z])/g;function P(a,b,c){if(void 0===c&&1===a.nodeType){var d="data-"+b.replace(O,"-$1").toLowerCase();if(c=a.getAttribute(d),"string"==typeof c){try{c="true"===c?!0:"false"===c?!1:"null"===c?null:+c+""===c?+c:N.test(c)?n.parseJSON(c):c}catch(e){}n.data(a,b,c)}else c=void 0;
}return c}function Q(a){var b;for(b in a)if(("data"!==b||!n.isEmptyObject(a[b]))&&"toJSON"!==b)return!1;return!0}function R(a,b,d,e){if(M(a)){var f,g,h=n.expando,i=a.nodeType,j=i?n.cache:a,k=i?a[h]:a[h]&&h;if(k&&j[k]&&(e||j[k].data)||void 0!==d||"string"!=typeof b)return k||(k=i?a[h]=c.pop()||n.guid++:h),j[k]||(j[k]=i?{}:{toJSON:n.noop}),"object"!=typeof b&&"function"!=typeof b||(e?j[k]=n.extend(j[k],b):j[k].data=n.extend(j[k].data,b)),g=j[k],e||(g.data||(g.data={}),g=g.data),void 0!==d&&(g[n.camelCase(b)]=d),"string"==typeof b?(f=g[b],null==f&&(f=g[n.camelCase(b)])):f=g,f}}function S(a,b,c){if(M(a)){var d,e,f=a.nodeType,g=f?n.cache:a,h=f?a[n.expando]:n.expando;if(g[h]){if(b&&(d=c?g[h]:g[h].data)){n.isArray(b)?b=b.concat(n.map(b,n.camelCase)):b in d?b=[b]:(b=n.camelCase(b),b=b in d?[b]:b.split(" ")),e=b.length;while(e--)delete d[b[e]];if(c?!Q(d):!n.isEmptyObject(d))return}(c||(delete g[h].data,Q(g[h])))&&(f?n.cleanData([a],!0):l.deleteExpando||g!=g.window?delete g[h]:g[h]=void 0)}}}n.extend({cache:{},noData:{"applet ":!0,"embed ":!0,"object ":"clsid:D27CDB6E-AE6D-11cf-96B8-444553540000"},hasData:function(a){return a=a.nodeType?n.cache[a[n.expando]]:a[n.expando],!!a&&!Q(a)},data:function(a,b,c){return R(a,b,c)},removeData:function(a,b){return S(a,b)},_data:function(a,b,c){return R(a,b,c,!0)},_removeData:function(a,b){return S(a,b,!0)}}),n.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=n.data(f),1===f.nodeType&&!n._data(f,"parsedAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=n.camelCase(d.slice(5)),P(f,d,e[d])));n._data(f,"parsedAttrs",!0)}return e}return"object"==typeof a?this.each(function(){n.data(this,a)}):arguments.length>1?this.each(function(){n.data(this,a,b)}):f?P(f,a,n.data(f,a)):void 0},removeData:function(a){return this.each(function(){n.removeData(this,a)})}}),n.extend({queue:function(a,b,c){var d;return a?(b=(b||"fx")+"queue",d=n._data(a,b),c&&(!d||n.isArray(c)?d=n._data(a,b,n.makeArray(c)):d.push(c)),d||[]):void 0},dequeue:function(a,b){b=b||"fx";var c=n.queue(a,b),d=c.length,e=c.shift(),f=n._queueHooks(a,b),g=function(){n.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return n._data(a,c)||n._data(a,c,{empty:n.Callbacks("once memory").add(function(){n._removeData(a,b+"queue"),n._removeData(a,c)})})}}),n.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?n.queue(this[0],a):void 0===b?this:this.each(function(){var c=n.queue(this,a,b);n._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&n.dequeue(this,a)})},dequeue:function(a){return this.each(function(){n.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=n.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=n._data(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}}),function(){var a;l.shrinkWrapBlocks=function(){if(null!=a)return a;a=!1;var b,c,e;return c=d.getElementsByTagName("body")[0],c&&c.style?(b=d.createElement("div"),e=d.createElement("div"),e.style.cssText="position:absolute;border:0;width:0;height:0;top:0;left:-9999px",c.appendChild(e).appendChild(b),"undefined"!=typeof b.style.zoom&&(b.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:1px;width:1px;zoom:1",b.appendChild(d.createElement("div")).style.width="5px",a=3!==b.offsetWidth),c.removeChild(e),a):void 0}}();var T=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,U=new RegExp("^(?:([+-])=|)("+T+")([a-z%]*)$","i"),V=["Top","Right","Bottom","Left"],W=function(a,b){return a=b||a,"none"===n.css(a,"display")||!n.contains(a.ownerDocument,a)};function X(a,b,c,d){var e,f=1,g=20,h=d?function(){return d.cur()}:function(){return n.css(a,b,"")},i=h(),j=c&&c[3]||(n.cssNumber[b]?"":"px"),k=(n.cssNumber[b]||"px"!==j&&+i)&&U.exec(n.css(a,b));if(k&&k[3]!==j){j=j||k[3],c=c||[],k=+i||1;do f=f||".5",k/=f,n.style(a,b,k+j);while(f!==(f=h()/i)&&1!==f&&--g)}return c&&(k=+k||+i||0,e=c[1]?k+(c[1]+1)*c[2]:+c[2],d&&(d.unit=j,d.start=k,d.end=e)),e}var Y=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===n.type(c)){e=!0;for(h in c)Y(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,n.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(n(a),c)})),b))for(;i>h;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f},Z=/^(?:checkbox|radio)$/i,$=/<([\w:-]+)/,_=/^$|\/(?:java|ecma)script/i,aa=/^\s+/,ba="abbr|article|aside|audio|bdi|canvas|data|datalist|details|dialog|figcaption|figure|footer|header|hgroup|main|mark|meter|nav|output|picture|progress|section|summary|template|time|video";function ca(a){var b=ba.split("|"),c=a.createDocumentFragment();if(c.createElement)while(b.length)c.createElement(b.pop());return c}!function(){var a=d.createElement("div"),b=d.createDocumentFragment(),c=d.createElement("input");a.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",l.leadingWhitespace=3===a.firstChild.nodeType,l.tbody=!a.getElementsByTagName("tbody").length,l.htmlSerialize=!!a.getElementsByTagName("link").length,l.html5Clone="<:nav></:nav>"!==d.createElement("nav").cloneNode(!0).outerHTML,c.type="checkbox",c.checked=!0,b.appendChild(c),l.appendChecked=c.checked,a.innerHTML="<textarea>x</textarea>",l.noCloneChecked=!!a.cloneNode(!0).lastChild.defaultValue,b.appendChild(a),c=d.createElement("input"),c.setAttribute("type","radio"),c.setAttribute("checked","checked"),c.setAttribute("name","t"),a.appendChild(c),l.checkClone=a.cloneNode(!0).cloneNode(!0).lastChild.checked,l.noCloneEvent=!!a.addEventListener,a[n.expando]=1,l.attributes=!a.getAttribute(n.expando)}();var da={option:[1,"<select multiple='multiple'>","</select>"],legend:[1,"<fieldset>","</fieldset>"],area:[1,"<map>","</map>"],param:[1,"<object>","</object>"],thead:[1,"<table>","</table>"],tr:[2,"<table><tbody>","</tbody></table>"],col:[2,"<table><tbody></tbody><colgroup>","</colgroup></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:l.htmlSerialize?[0,"",""]:[1,"X<div>","</div>"]};da.optgroup=da.option,da.tbody=da.tfoot=da.colgroup=da.caption=da.thead,da.th=da.td;function ea(a,b){var c,d,e=0,f="undefined"!=typeof a.getElementsByTagName?a.getElementsByTagName(b||"*"):"undefined"!=typeof a.querySelectorAll?a.querySelectorAll(b||"*"):void 0;if(!f)for(f=[],c=a.childNodes||a;null!=(d=c[e]);e++)!b||n.nodeName(d,b)?f.push(d):n.merge(f,ea(d,b));return void 0===b||b&&n.nodeName(a,b)?n.merge([a],f):f}function fa(a,b){for(var c,d=0;null!=(c=a[d]);d++)n._data(c,"globalEval",!b||n._data(b[d],"globalEval"))}var ga=/<|&#?\w+;/,ha=/<tbody/i;function ia(a){Z.test(a.type)&&(a.defaultChecked=a.checked)}function ja(a,b,c,d,e){for(var f,g,h,i,j,k,m,o=a.length,p=ca(b),q=[],r=0;o>r;r++)if(g=a[r],g||0===g)if("object"===n.type(g))n.merge(q,g.nodeType?[g]:g);else if(ga.test(g)){i=i||p.appendChild(b.createElement("div")),j=($.exec(g)||["",""])[1].toLowerCase(),m=da[j]||da._default,i.innerHTML=m[1]+n.htmlPrefilter(g)+m[2],f=m[0];while(f--)i=i.lastChild;if(!l.leadingWhitespace&&aa.test(g)&&q.push(b.createTextNode(aa.exec(g)[0])),!l.tbody){g="table"!==j||ha.test(g)?"<table>"!==m[1]||ha.test(g)?0:i:i.firstChild,f=g&&g.childNodes.length;while(f--)n.nodeName(k=g.childNodes[f],"tbody")&&!k.childNodes.length&&g.removeChild(k)}n.merge(q,i.childNodes),i.textContent="";while(i.firstChild)i.removeChild(i.firstChild);i=p.lastChild}else q.push(b.createTextNode(g));i&&p.removeChild(i),l.appendChecked||n.grep(ea(q,"input"),ia),r=0;while(g=q[r++])if(d&&n.inArray(g,d)>-1)e&&e.push(g);else if(h=n.contains(g.ownerDocument,g),i=ea(p.appendChild(g),"script"),h&&fa(i),c){f=0;while(g=i[f++])_.test(g.type||"")&&c.push(g)}return i=null,p}!function(){var b,c,e=d.createElement("div");for(b in{submit:!0,change:!0,focusin:!0})c="on"+b,(l[b]=c in a)||(e.setAttribute(c,"t"),l[b]=e.attributes[c].expando===!1);e=null}();var ka=/^(?:input|select|textarea)$/i,la=/^key/,ma=/^(?:mouse|pointer|contextmenu|drag|drop)|click/,na=/^(?:focusinfocus|focusoutblur)$/,oa=/^([^.]*)(?:\.(.+)|)/;function pa(){return!0}function qa(){return!1}function ra(){try{return d.activeElement}catch(a){}}function sa(a,b,c,d,e,f){var g,h;if("object"==typeof b){"string"!=typeof c&&(d=d||c,c=void 0);for(h in b)sa(a,h,c,d,b[h],f);return a}if(null==d&&null==e?(e=c,d=c=void 0):null==e&&("string"==typeof c?(e=d,d=void 0):(e=d,d=c,c=void 0)),e===!1)e=qa;else if(!e)return a;return 1===f&&(g=e,e=function(a){return n().off(a),g.apply(this,arguments)},e.guid=g.guid||(g.guid=n.guid++)),a.each(function(){n.event.add(this,b,e,d,c)})}n.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=n._data(a);if(r){c.handler&&(i=c,c=i.handler,e=i.selector),c.guid||(c.guid=n.guid++),(g=r.events)||(g=r.events={}),(k=r.handle)||(k=r.handle=function(a){return"undefined"==typeof n||a&&n.event.triggered===a.type?void 0:n.event.dispatch.apply(k.elem,arguments)},k.elem=a),b=(b||"").match(G)||[""],h=b.length;while(h--)f=oa.exec(b[h])||[],o=q=f[1],p=(f[2]||"").split(".").sort(),o&&(j=n.event.special[o]||{},o=(e?j.delegateType:j.bindType)||o,j=n.event.special[o]||{},l=n.extend({type:o,origType:q,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&n.expr.match.needsContext.test(e),namespace:p.join(".")},i),(m=g[o])||(m=g[o]=[],m.delegateCount=0,j.setup&&j.setup.call(a,d,p,k)!==!1||(a.addEventListener?a.addEventListener(o,k,!1):a.attachEvent&&a.attachEvent("on"+o,k))),j.add&&(j.add.call(a,l),l.handler.guid||(l.handler.guid=c.guid)),e?m.splice(m.delegateCount++,0,l):m.push(l),n.event.global[o]=!0);a=null}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=n.hasData(a)&&n._data(a);if(r&&(k=r.events)){b=(b||"").match(G)||[""],j=b.length;while(j--)if(h=oa.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o){l=n.event.special[o]||{},o=(d?l.delegateType:l.bindType)||o,m=k[o]||[],h=h[2]&&new RegExp("(^|\\.)"+p.join("\\.(?:.*\\.|)")+"(\\.|$)"),i=f=m.length;while(f--)g=m[f],!e&&q!==g.origType||c&&c.guid!==g.guid||h&&!h.test(g.namespace)||d&&d!==g.selector&&("**"!==d||!g.selector)||(m.splice(f,1),g.selector&&m.delegateCount--,l.remove&&l.remove.call(a,g));i&&!m.length&&(l.teardown&&l.teardown.call(a,p,r.handle)!==!1||n.removeEvent(a,o,r.handle),delete k[o])}else for(o in k)n.event.remove(a,o+b[j],c,d,!0);n.isEmptyObject(k)&&(delete r.handle,n._removeData(a,"events"))}},trigger:function(b,c,e,f){var g,h,i,j,l,m,o,p=[e||d],q=k.call(b,"type")?b.type:b,r=k.call(b,"namespace")?b.namespace.split("."):[];if(i=m=e=e||d,3!==e.nodeType&&8!==e.nodeType&&!na.test(q+n.event.triggered)&&(q.indexOf(".")>-1&&(r=q.split("."),q=r.shift(),r.sort()),h=q.indexOf(":")<0&&"on"+q,b=b[n.expando]?b:new n.Event(q,"object"==typeof b&&b),b.isTrigger=f?2:3,b.namespace=r.join("."),b.rnamespace=b.namespace?new RegExp("(^|\\.)"+r.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=e),c=null==c?[b]:n.makeArray(c,[b]),l=n.event.special[q]||{},f||!l.trigger||l.trigger.apply(e,c)!==!1)){if(!f&&!l.noBubble&&!n.isWindow(e)){for(j=l.delegateType||q,na.test(j+q)||(i=i.parentNode);i;i=i.parentNode)p.push(i),m=i;m===(e.ownerDocument||d)&&p.push(m.defaultView||m.parentWindow||a)}o=0;while((i=p[o++])&&!b.isPropagationStopped())b.type=o>1?j:l.bindType||q,g=(n._data(i,"events")||{})[b.type]&&n._data(i,"handle"),g&&g.apply(i,c),g=h&&i[h],g&&g.apply&&M(i)&&(b.result=g.apply(i,c),b.result===!1&&b.preventDefault());if(b.type=q,!f&&!b.isDefaultPrevented()&&(!l._default||l._default.apply(p.pop(),c)===!1)&&M(e)&&h&&e[q]&&!n.isWindow(e)){m=e[h],m&&(e[h]=null),n.event.triggered=q;try{e[q]()}catch(s){}n.event.triggered=void 0,m&&(e[h]=m)}return b.result}},dispatch:function(a){a=n.event.fix(a);var b,c,d,f,g,h=[],i=e.call(arguments),j=(n._data(this,"events")||{})[a.type]||[],k=n.event.special[a.type]||{};if(i[0]=a,a.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,a)!==!1){h=n.event.handlers.call(this,a,j),b=0;while((f=h[b++])&&!a.isPropagationStopped()){a.currentTarget=f.elem,c=0;while((g=f.handlers[c++])&&!a.isImmediatePropagationStopped())a.rnamespace&&!a.rnamespace.test(g.namespace)||(a.handleObj=g,a.data=g.data,d=((n.event.special[g.origType]||{}).handle||g.handler).apply(f.elem,i),void 0!==d&&(a.result=d)===!1&&(a.preventDefault(),a.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,a),a.result}},handlers:function(a,b){var c,d,e,f,g=[],h=b.delegateCount,i=a.target;if(h&&i.nodeType&&("click"!==a.type||isNaN(a.button)||a.button<1))for(;i!=this;i=i.parentNode||this)if(1===i.nodeType&&(i.disabled!==!0||"click"!==a.type)){for(d=[],c=0;h>c;c++)f=b[c],e=f.selector+" ",void 0===d[e]&&(d[e]=f.needsContext?n(e,this).index(i)>-1:n.find(e,this,null,[i]).length),d[e]&&d.push(f);d.length&&g.push({elem:i,handlers:d})}return h<b.length&&g.push({elem:this,handlers:b.slice(h)}),g},fix:function(a){if(a[n.expando])return a;var b,c,e,f=a.type,g=a,h=this.fixHooks[f];h||(this.fixHooks[f]=h=ma.test(f)?this.mouseHooks:la.test(f)?this.keyHooks:{}),e=h.props?this.props.concat(h.props):this.props,a=new n.Event(g),b=e.length;while(b--)c=e[b],a[c]=g[c];return a.target||(a.target=g.srcElement||d),3===a.target.nodeType&&(a.target=a.target.parentNode),a.metaKey=!!a.metaKey,h.filter?h.filter(a,g):a},props:"altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){return null==a.which&&(a.which=null!=b.charCode?b.charCode:b.keyCode),a}},mouseHooks:{props:"button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,b){var c,e,f,g=b.button,h=b.fromElement;return null==a.pageX&&null!=b.clientX&&(e=a.target.ownerDocument||d,f=e.documentElement,c=e.body,a.pageX=b.clientX+(f&&f.scrollLeft||c&&c.scrollLeft||0)-(f&&f.clientLeft||c&&c.clientLeft||0),a.pageY=b.clientY+(f&&f.scrollTop||c&&c.scrollTop||0)-(f&&f.clientTop||c&&c.clientTop||0)),!a.relatedTarget&&h&&(a.relatedTarget=h===a.target?b.toElement:h),a.which||void 0===g||(a.which=1&g?1:2&g?3:4&g?2:0),a}},special:{load:{noBubble:!0},focus:{trigger:function(){if(this!==ra()&&this.focus)try{return this.focus(),!1}catch(a){}},delegateType:"focusin"},blur:{trigger:function(){return this===ra()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return n.nodeName(this,"input")&&"checkbox"===this.type&&this.click?(this.click(),!1):void 0},_default:function(a){return n.nodeName(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}},simulate:function(a,b,c){var d=n.extend(new n.Event,c,{type:a,isSimulated:!0});n.event.trigger(d,null,b),d.isDefaultPrevented()&&c.preventDefault()}},n.removeEvent=d.removeEventListener?function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c)}:function(a,b,c){var d="on"+b;a.detachEvent&&("undefined"==typeof a[d]&&(a[d]=null),a.detachEvent(d,c))},n.Event=function(a,b){return this instanceof n.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?pa:qa):this.type=a,b&&n.extend(this,b),this.timeStamp=a&&a.timeStamp||n.now(),void(this[n.expando]=!0)):new n.Event(a,b)},n.Event.prototype={constructor:n.Event,isDefaultPrevented:qa,isPropagationStopped:qa,isImmediatePropagationStopped:qa,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=pa,a&&(a.preventDefault?a.preventDefault():a.returnValue=!1)},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=pa,a&&!this.isSimulated&&(a.stopPropagation&&a.stopPropagation(),a.cancelBubble=!0)},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=pa,a&&a.stopImmediatePropagation&&a.stopImmediatePropagation(),this.stopPropagation()}},n.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){n.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return e&&(e===d||n.contains(d,e))||(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),l.submit||(n.event.special.submit={setup:function(){return n.nodeName(this,"form")?!1:void n.event.add(this,"click._submit keypress._submit",function(a){var b=a.target,c=n.nodeName(b,"input")||n.nodeName(b,"button")?n.prop(b,"form"):void 0;c&&!n._data(c,"submit")&&(n.event.add(c,"submit._submit",function(a){a._submitBubble=!0}),n._data(c,"submit",!0))})},postDispatch:function(a){a._submitBubble&&(delete a._submitBubble,this.parentNode&&!a.isTrigger&&n.event.simulate("submit",this.parentNode,a))},teardown:function(){return n.nodeName(this,"form")?!1:void n.event.remove(this,"._submit")}}),l.change||(n.event.special.change={setup:function(){return ka.test(this.nodeName)?("checkbox"!==this.type&&"radio"!==this.type||(n.event.add(this,"propertychange._change",function(a){"checked"===a.originalEvent.propertyName&&(this._justChanged=!0)}),n.event.add(this,"click._change",function(a){this._justChanged&&!a.isTrigger&&(this._justChanged=!1),n.event.simulate("change",this,a)})),!1):void n.event.add(this,"beforeactivate._change",function(a){var b=a.target;ka.test(b.nodeName)&&!n._data(b,"change")&&(n.event.add(b,"change._change",function(a){!this.parentNode||a.isSimulated||a.isTrigger||n.event.simulate("change",this.parentNode,a)}),n._data(b,"change",!0))})},handle:function(a){var b=a.target;return this!==b||a.isSimulated||a.isTrigger||"radio"!==b.type&&"checkbox"!==b.type?a.handleObj.handler.apply(this,arguments):void 0},teardown:function(){return n.event.remove(this,"._change"),!ka.test(this.nodeName)}}),l.focusin||n.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){n.event.simulate(b,a.target,n.event.fix(a))};n.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=n._data(d,b);e||d.addEventListener(a,c,!0),n._data(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=n._data(d,b)-1;e?n._data(d,b,e):(d.removeEventListener(a,c,!0),n._removeData(d,b))}}}),n.fn.extend({on:function(a,b,c,d){return sa(this,a,b,c,d)},one:function(a,b,c,d){return sa(this,a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,n(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return b!==!1&&"function"!=typeof b||(c=b,b=void 0),c===!1&&(c=qa),this.each(function(){n.event.remove(this,a,c,b)})},trigger:function(a,b){return this.each(function(){n.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];return c?n.event.trigger(a,b,c,!0):void 0}});var ta=/ jQuery\d+="(?:null|\d+)"/g,ua=new RegExp("<(?:"+ba+")[\\s/>]","i"),va=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,wa=/<script|<style|<link/i,xa=/checked\s*(?:[^=]|=\s*.checked.)/i,ya=/^true\/(.*)/,za=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g,Aa=ca(d),Ba=Aa.appendChild(d.createElement("div"));function Ca(a,b){return n.nodeName(a,"table")&&n.nodeName(11!==b.nodeType?b:b.firstChild,"tr")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function Da(a){return a.type=(null!==n.find.attr(a,"type"))+"/"+a.type,a}function Ea(a){var b=ya.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function Fa(a,b){if(1===b.nodeType&&n.hasData(a)){var c,d,e,f=n._data(a),g=n._data(b,f),h=f.events;if(h){delete g.handle,g.events={};for(c in h)for(d=0,e=h[c].length;e>d;d++)n.event.add(b,c,h[c][d])}g.data&&(g.data=n.extend({},g.data))}}function Ga(a,b){var c,d,e;if(1===b.nodeType){if(c=b.nodeName.toLowerCase(),!l.noCloneEvent&&b[n.expando]){e=n._data(b);for(d in e.events)n.removeEvent(b,d,e.handle);b.removeAttribute(n.expando)}"script"===c&&b.text!==a.text?(Da(b).text=a.text,Ea(b)):"object"===c?(b.parentNode&&(b.outerHTML=a.outerHTML),l.html5Clone&&a.innerHTML&&!n.trim(b.innerHTML)&&(b.innerHTML=a.innerHTML)):"input"===c&&Z.test(a.type)?(b.defaultChecked=b.checked=a.checked,b.value!==a.value&&(b.value=a.value)):"option"===c?b.defaultSelected=b.selected=a.defaultSelected:"input"!==c&&"textarea"!==c||(b.defaultValue=a.defaultValue)}}function Ha(a,b,c,d){b=f.apply([],b);var e,g,h,i,j,k,m=0,o=a.length,p=o-1,q=b[0],r=n.isFunction(q);if(r||o>1&&"string"==typeof q&&!l.checkClone&&xa.test(q))return a.each(function(e){var f=a.eq(e);r&&(b[0]=q.call(this,e,f.html())),Ha(f,b,c,d)});if(o&&(k=ja(b,a[0].ownerDocument,!1,a,d),e=k.firstChild,1===k.childNodes.length&&(k=e),e||d)){for(i=n.map(ea(k,"script"),Da),h=i.length;o>m;m++)g=k,m!==p&&(g=n.clone(g,!0,!0),h&&n.merge(i,ea(g,"script"))),c.call(a[m],g,m);if(h)for(j=i[i.length-1].ownerDocument,n.map(i,Ea),m=0;h>m;m++)g=i[m],_.test(g.type||"")&&!n._data(g,"globalEval")&&n.contains(j,g)&&(g.src?n._evalUrl&&n._evalUrl(g.src):n.globalEval((g.text||g.textContent||g.innerHTML||"").replace(za,"")));k=e=null}return a}function Ia(a,b,c){for(var d,e=b?n.filter(b,a):a,f=0;null!=(d=e[f]);f++)c||1!==d.nodeType||n.cleanData(ea(d)),d.parentNode&&(c&&n.contains(d.ownerDocument,d)&&fa(ea(d,"script")),d.parentNode.removeChild(d));return a}n.extend({htmlPrefilter:function(a){return a.replace(va,"<$1></$2>")},clone:function(a,b,c){var d,e,f,g,h,i=n.contains(a.ownerDocument,a);if(l.html5Clone||n.isXMLDoc(a)||!ua.test("<"+a.nodeName+">")?f=a.cloneNode(!0):(Ba.innerHTML=a.outerHTML,Ba.removeChild(f=Ba.firstChild)),!(l.noCloneEvent&&l.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||n.isXMLDoc(a)))for(d=ea(f),h=ea(a),g=0;null!=(e=h[g]);++g)d[g]&&Ga(e,d[g]);if(b)if(c)for(h=h||ea(a),d=d||ea(f),g=0;null!=(e=h[g]);g++)Fa(e,d[g]);else Fa(a,f);return d=ea(f,"script"),d.length>0&&fa(d,!i&&ea(a,"script")),d=h=e=null,f},cleanData:function(a,b){for(var d,e,f,g,h=0,i=n.expando,j=n.cache,k=l.attributes,m=n.event.special;null!=(d=a[h]);h++)if((b||M(d))&&(f=d[i],g=f&&j[f])){if(g.events)for(e in g.events)m[e]?n.event.remove(d,e):n.removeEvent(d,e,g.handle);j[f]&&(delete j[f],k||"undefined"==typeof d.removeAttribute?d[i]=void 0:d.removeAttribute(i),c.push(f))}}}),n.fn.extend({domManip:Ha,detach:function(a){return Ia(this,a,!0)},remove:function(a){return Ia(this,a)},text:function(a){return Y(this,function(a){return void 0===a?n.text(this):this.empty().append((this[0]&&this[0].ownerDocument||d).createTextNode(a))},null,a,arguments.length)},append:function(){return Ha(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Ca(this,a);b.appendChild(a)}})},prepend:function(){return Ha(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=Ca(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return Ha(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return Ha(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},empty:function(){for(var a,b=0;null!=(a=this[b]);b++){1===a.nodeType&&n.cleanData(ea(a,!1));while(a.firstChild)a.removeChild(a.firstChild);a.options&&n.nodeName(a,"select")&&(a.options.length=0)}return this},clone:function(a,b){return a=null==a?!1:a,b=null==b?a:b,this.map(function(){return n.clone(this,a,b)})},html:function(a){return Y(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a)return 1===b.nodeType?b.innerHTML.replace(ta,""):void 0;if("string"==typeof a&&!wa.test(a)&&(l.htmlSerialize||!ua.test(a))&&(l.leadingWhitespace||!aa.test(a))&&!da[($.exec(a)||["",""])[1].toLowerCase()]){a=n.htmlPrefilter(a);try{for(;d>c;c++)b=this[c]||{},1===b.nodeType&&(n.cleanData(ea(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=[];return Ha(this,arguments,function(b){var c=this.parentNode;n.inArray(this,a)<0&&(n.cleanData(ea(this)),c&&c.replaceChild(b,this))},a)}}),n.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){n.fn[a]=function(a){for(var c,d=0,e=[],f=n(a),h=f.length-1;h>=d;d++)c=d===h?this:this.clone(!0),n(f[d])[b](c),g.apply(e,c.get());return this.pushStack(e)}});var Ja,Ka={HTML:"block",BODY:"block"};function La(a,b){var c=n(b.createElement(a)).appendTo(b.body),d=n.css(c[0],"display");return c.detach(),d}function Ma(a){var b=d,c=Ka[a];return c||(c=La(a,b),"none"!==c&&c||(Ja=(Ja||n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement),b=(Ja[0].contentWindow||Ja[0].contentDocument).document,b.write(),b.close(),c=La(a,b),Ja.detach()),Ka[a]=c),c}var Na=/^margin/,Oa=new RegExp("^("+T+")(?!px)[a-z%]+$","i"),Pa=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e},Qa=d.documentElement;!function(){var b,c,e,f,g,h,i=d.createElement("div"),j=d.createElement("div");if(j.style){j.style.cssText="float:left;opacity:.5",l.opacity="0.5"===j.style.opacity,l.cssFloat=!!j.style.cssFloat,j.style.backgroundClip="content-box",j.cloneNode(!0).style.backgroundClip="",l.clearCloneStyle="content-box"===j.style.backgroundClip,i=d.createElement("div"),i.style.cssText="border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute",j.innerHTML="",i.appendChild(j),l.boxSizing=""===j.style.boxSizing||""===j.style.MozBoxSizing||""===j.style.WebkitBoxSizing,n.extend(l,{reliableHiddenOffsets:function(){return null==b&&k(),f},boxSizingReliable:function(){return null==b&&k(),e},pixelMarginRight:function(){return null==b&&k(),c},pixelPosition:function(){return null==b&&k(),b},reliableMarginRight:function(){return null==b&&k(),g},reliableMarginLeft:function(){return null==b&&k(),h}});function k(){var k,l,m=d.documentElement;m.appendChild(i),j.style.cssText="-webkit-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%",b=e=h=!1,c=g=!0,a.getComputedStyle&&(l=a.getComputedStyle(j),b="1%"!==(l||{}).top,h="2px"===(l||{}).marginLeft,e="4px"===(l||{width:"4px"}).width,j.style.marginRight="50%",c="4px"===(l||{marginRight:"4px"}).marginRight,k=j.appendChild(d.createElement("div")),k.style.cssText=j.style.cssText="-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",k.style.marginRight=k.style.width="0",j.style.width="1px",g=!parseFloat((a.getComputedStyle(k)||{}).marginRight),j.removeChild(k)),j.style.display="none",f=0===j.getClientRects().length,f&&(j.style.display="",j.innerHTML="<table><tr><td></td><td>t</td></tr></table>",j.childNodes[0].style.borderCollapse="separate",k=j.getElementsByTagName("td"),k[0].style.cssText="margin:0;border:0;padding:0;display:none",f=0===k[0].offsetHeight,f&&(k[0].style.display="",k[1].style.display="none",f=0===k[0].offsetHeight)),m.removeChild(i)}}}();var Ra,Sa,Ta=/^(top|right|bottom|left)$/;a.getComputedStyle?(Ra=function(b){var c=b.ownerDocument.defaultView;return c&&c.opener||(c=a),c.getComputedStyle(b)},Sa=function(a,b,c){var d,e,f,g,h=a.style;return c=c||Ra(a),g=c?c.getPropertyValue(b)||c[b]:void 0,""!==g&&void 0!==g||n.contains(a.ownerDocument,a)||(g=n.style(a,b)),c&&!l.pixelMarginRight()&&Oa.test(g)&&Na.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f),void 0===g?g:g+""}):Qa.currentStyle&&(Ra=function(a){return a.currentStyle},Sa=function(a,b,c){var d,e,f,g,h=a.style;return c=c||Ra(a),g=c?c[b]:void 0,null==g&&h&&h[b]&&(g=h[b]),Oa.test(g)&&!Ta.test(b)&&(d=h.left,e=a.runtimeStyle,f=e&&e.left,f&&(e.left=a.currentStyle.left),h.left="fontSize"===b?"1em":g,g=h.pixelLeft+"px",h.left=d,f&&(e.left=f)),void 0===g?g:g+""||"auto"});function Ua(a,b){return{get:function(){return a()?void delete this.get:(this.get=b).apply(this,arguments)}}}var Va=/alpha\([^)]*\)/i,Wa=/opacity\s*=\s*([^)]*)/i,Xa=/^(none|table(?!-c[ea]).+)/,Ya=new RegExp("^("+T+")(.*)$","i"),Za={position:"absolute",visibility:"hidden",display:"block"},$a={letterSpacing:"0",fontWeight:"400"},_a=["Webkit","O","Moz","ms"],ab=d.createElement("div").style;function bb(a){if(a in ab)return a;var b=a.charAt(0).toUpperCase()+a.slice(1),c=_a.length;while(c--)if(a=_a[c]+b,a in ab)return a}function cb(a,b){for(var c,d,e,f=[],g=0,h=a.length;h>g;g++)d=a[g],d.style&&(f[g]=n._data(d,"olddisplay"),c=d.style.display,b?(f[g]||"none"!==c||(d.style.display=""),""===d.style.display&&W(d)&&(f[g]=n._data(d,"olddisplay",Ma(d.nodeName)))):(e=W(d),(c&&"none"!==c||!e)&&n._data(d,"olddisplay",e?c:n.css(d,"display"))));for(g=0;h>g;g++)d=a[g],d.style&&(b&&"none"!==d.style.display&&""!==d.style.display||(d.style.display=b?f[g]||"":"none"));return a}function db(a,b,c){var d=Ya.exec(b);return d?Math.max(0,d[1]-(c||0))+(d[2]||"px"):b}function eb(a,b,c,d,e){for(var f=c===(d?"border":"content")?4:"width"===b?1:0,g=0;4>f;f+=2)"margin"===c&&(g+=n.css(a,c+V[f],!0,e)),d?("content"===c&&(g-=n.css(a,"padding"+V[f],!0,e)),"margin"!==c&&(g-=n.css(a,"border"+V[f]+"Width",!0,e))):(g+=n.css(a,"padding"+V[f],!0,e),"padding"!==c&&(g+=n.css(a,"border"+V[f]+"Width",!0,e)));return g}function fb(a,b,c){var d=!0,e="width"===b?a.offsetWidth:a.offsetHeight,f=Ra(a),g=l.boxSizing&&"border-box"===n.css(a,"boxSizing",!1,f);if(0>=e||null==e){if(e=Sa(a,b,f),(0>e||null==e)&&(e=a.style[b]),Oa.test(e))return e;d=g&&(l.boxSizingReliable()||e===a.style[b]),e=parseFloat(e)||0}return e+eb(a,b,c||(g?"border":"content"),d,f)+"px"}n.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=Sa(a,"opacity");return""===c?"1":c}}}},cssNumber:{animationIterationCount:!0,columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":l.cssFloat?"cssFloat":"styleFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=n.camelCase(b),i=a.style;if(b=n.cssProps[h]||(n.cssProps[h]=bb(h)||h),g=n.cssHooks[b]||n.cssHooks[h],void 0===c)return g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:i[b];if(f=typeof c,"string"===f&&(e=U.exec(c))&&e[1]&&(c=X(a,b,e),f="number"),null!=c&&c===c&&("number"===f&&(c+=e&&e[3]||(n.cssNumber[h]?"":"px")),l.clearCloneStyle||""!==c||0!==b.indexOf("background")||(i[b]="inherit"),!(g&&"set"in g&&void 0===(c=g.set(a,c,d)))))try{i[b]=c}catch(j){}}},css:function(a,b,c,d){var e,f,g,h=n.camelCase(b);return b=n.cssProps[h]||(n.cssProps[h]=bb(h)||h),g=n.cssHooks[b]||n.cssHooks[h],g&&"get"in g&&(f=g.get(a,!0,c)),void 0===f&&(f=Sa(a,b,d)),"normal"===f&&b in $a&&(f=$a[b]),""===c||c?(e=parseFloat(f),c===!0||isFinite(e)?e||0:f):f}}),n.each(["height","width"],function(a,b){n.cssHooks[b]={get:function(a,c,d){return c?Xa.test(n.css(a,"display"))&&0===a.offsetWidth?Pa(a,Za,function(){return fb(a,b,d)}):fb(a,b,d):void 0},set:function(a,c,d){var e=d&&Ra(a);return db(a,c,d?eb(a,b,d,l.boxSizing&&"border-box"===n.css(a,"boxSizing",!1,e),e):0)}}}),l.opacity||(n.cssHooks.opacity={get:function(a,b){return Wa.test((b&&a.currentStyle?a.currentStyle.filter:a.style.filter)||"")?.01*parseFloat(RegExp.$1)+"":b?"1":""},set:function(a,b){var c=a.style,d=a.currentStyle,e=n.isNumeric(b)?"alpha(opacity="+100*b+")":"",f=d&&d.filter||c.filter||"";c.zoom=1,(b>=1||""===b)&&""===n.trim(f.replace(Va,""))&&c.removeAttribute&&(c.removeAttribute("filter"),""===b||d&&!d.filter)||(c.filter=Va.test(f)?f.replace(Va,e):f+" "+e)}}),n.cssHooks.marginRight=Ua(l.reliableMarginRight,function(a,b){return b?Pa(a,{display:"inline-block"},Sa,[a,"marginRight"]):void 0}),n.cssHooks.marginLeft=Ua(l.reliableMarginLeft,function(a,b){return b?(parseFloat(Sa(a,"marginLeft"))||(n.contains(a.ownerDocument,a)?a.getBoundingClientRect().left-Pa(a,{
marginLeft:0},function(){return a.getBoundingClientRect().left}):0))+"px":void 0}),n.each({margin:"",padding:"",border:"Width"},function(a,b){n.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];4>d;d++)e[a+V[d]+b]=f[d]||f[d-2]||f[0];return e}},Na.test(a)||(n.cssHooks[a+b].set=db)}),n.fn.extend({css:function(a,b){return Y(this,function(a,b,c){var d,e,f={},g=0;if(n.isArray(b)){for(d=Ra(a),e=b.length;e>g;g++)f[b[g]]=n.css(a,b[g],!1,d);return f}return void 0!==c?n.style(a,b,c):n.css(a,b)},a,b,arguments.length>1)},show:function(){return cb(this,!0)},hide:function(){return cb(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){W(this)?n(this).show():n(this).hide()})}});function gb(a,b,c,d,e){return new gb.prototype.init(a,b,c,d,e)}n.Tween=gb,gb.prototype={constructor:gb,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||n.easing._default,this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(n.cssNumber[c]?"":"px")},cur:function(){var a=gb.propHooks[this.prop];return a&&a.get?a.get(this):gb.propHooks._default.get(this)},run:function(a){var b,c=gb.propHooks[this.prop];return this.options.duration?this.pos=b=n.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):this.pos=b=a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):gb.propHooks._default.set(this),this}},gb.prototype.init.prototype=gb.prototype,gb.propHooks={_default:{get:function(a){var b;return 1!==a.elem.nodeType||null!=a.elem[a.prop]&&null==a.elem.style[a.prop]?a.elem[a.prop]:(b=n.css(a.elem,a.prop,""),b&&"auto"!==b?b:0)},set:function(a){n.fx.step[a.prop]?n.fx.step[a.prop](a):1!==a.elem.nodeType||null==a.elem.style[n.cssProps[a.prop]]&&!n.cssHooks[a.prop]?a.elem[a.prop]=a.now:n.style(a.elem,a.prop,a.now+a.unit)}}},gb.propHooks.scrollTop=gb.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},n.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},_default:"swing"},n.fx=gb.prototype.init,n.fx.step={};var hb,ib,jb=/^(?:toggle|show|hide)$/,kb=/queueHooks$/;function lb(){return a.setTimeout(function(){hb=void 0}),hb=n.now()}function mb(a,b){var c,d={height:a},e=0;for(b=b?1:0;4>e;e+=2-b)c=V[e],d["margin"+c]=d["padding"+c]=a;return b&&(d.opacity=d.width=a),d}function nb(a,b,c){for(var d,e=(qb.tweeners[b]||[]).concat(qb.tweeners["*"]),f=0,g=e.length;g>f;f++)if(d=e[f].call(c,b,a))return d}function ob(a,b,c){var d,e,f,g,h,i,j,k,m=this,o={},p=a.style,q=a.nodeType&&W(a),r=n._data(a,"fxshow");c.queue||(h=n._queueHooks(a,"fx"),null==h.unqueued&&(h.unqueued=0,i=h.empty.fire,h.empty.fire=function(){h.unqueued||i()}),h.unqueued++,m.always(function(){m.always(function(){h.unqueued--,n.queue(a,"fx").length||h.empty.fire()})})),1===a.nodeType&&("height"in b||"width"in b)&&(c.overflow=[p.overflow,p.overflowX,p.overflowY],j=n.css(a,"display"),k="none"===j?n._data(a,"olddisplay")||Ma(a.nodeName):j,"inline"===k&&"none"===n.css(a,"float")&&(l.inlineBlockNeedsLayout&&"inline"!==Ma(a.nodeName)?p.zoom=1:p.display="inline-block")),c.overflow&&(p.overflow="hidden",l.shrinkWrapBlocks()||m.always(function(){p.overflow=c.overflow[0],p.overflowX=c.overflow[1],p.overflowY=c.overflow[2]}));for(d in b)if(e=b[d],jb.exec(e)){if(delete b[d],f=f||"toggle"===e,e===(q?"hide":"show")){if("show"!==e||!r||void 0===r[d])continue;q=!0}o[d]=r&&r[d]||n.style(a,d)}else j=void 0;if(n.isEmptyObject(o))"inline"===("none"===j?Ma(a.nodeName):j)&&(p.display=j);else{r?"hidden"in r&&(q=r.hidden):r=n._data(a,"fxshow",{}),f&&(r.hidden=!q),q?n(a).show():m.done(function(){n(a).hide()}),m.done(function(){var b;n._removeData(a,"fxshow");for(b in o)n.style(a,b,o[b])});for(d in o)g=nb(q?r[d]:0,d,m),d in r||(r[d]=g.start,q&&(g.end=g.start,g.start="width"===d||"height"===d?1:0))}}function pb(a,b){var c,d,e,f,g;for(c in a)if(d=n.camelCase(c),e=b[d],f=a[c],n.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=n.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function qb(a,b,c){var d,e,f=0,g=qb.prefilters.length,h=n.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=hb||lb(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;i>g;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),1>f&&i?c:(h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:n.extend({},b),opts:n.extend(!0,{specialEasing:{},easing:n.easing._default},c),originalProperties:b,originalOptions:c,startTime:hb||lb(),duration:c.duration,tweens:[],createTween:function(b,c){var d=n.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;d>c;c++)j.tweens[c].run(1);return b?(h.notifyWith(a,[j,1,0]),h.resolveWith(a,[j,b])):h.rejectWith(a,[j,b]),this}}),k=j.props;for(pb(k,j.opts.specialEasing);g>f;f++)if(d=qb.prefilters[f].call(j,a,k,j.opts))return n.isFunction(d.stop)&&(n._queueHooks(j.elem,j.opts.queue).stop=n.proxy(d.stop,d)),d;return n.map(k,nb,j),n.isFunction(j.opts.start)&&j.opts.start.call(a,j),n.fx.timer(n.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always)}n.Animation=n.extend(qb,{tweeners:{"*":[function(a,b){var c=this.createTween(a,b);return X(c.elem,a,U.exec(b),c),c}]},tweener:function(a,b){n.isFunction(a)?(b=a,a=["*"]):a=a.match(G);for(var c,d=0,e=a.length;e>d;d++)c=a[d],qb.tweeners[c]=qb.tweeners[c]||[],qb.tweeners[c].unshift(b)},prefilters:[ob],prefilter:function(a,b){b?qb.prefilters.unshift(a):qb.prefilters.push(a)}}),n.speed=function(a,b,c){var d=a&&"object"==typeof a?n.extend({},a):{complete:c||!c&&b||n.isFunction(a)&&a,duration:a,easing:c&&b||b&&!n.isFunction(b)&&b};return d.duration=n.fx.off?0:"number"==typeof d.duration?d.duration:d.duration in n.fx.speeds?n.fx.speeds[d.duration]:n.fx.speeds._default,null!=d.queue&&d.queue!==!0||(d.queue="fx"),d.old=d.complete,d.complete=function(){n.isFunction(d.old)&&d.old.call(this),d.queue&&n.dequeue(this,d.queue)},d},n.fn.extend({fadeTo:function(a,b,c,d){return this.filter(W).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=n.isEmptyObject(a),f=n.speed(b,c,d),g=function(){var b=qb(this,n.extend({},a),f);(e||n._data(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=n.timers,g=n._data(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&kb.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));!b&&c||n.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=n._data(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=n.timers,g=d?d.length:0;for(c.finish=!0,n.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;g>b;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),n.each(["toggle","show","hide"],function(a,b){var c=n.fn[b];n.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(mb(b,!0),a,d,e)}}),n.each({slideDown:mb("show"),slideUp:mb("hide"),slideToggle:mb("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){n.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),n.timers=[],n.fx.tick=function(){var a,b=n.timers,c=0;for(hb=n.now();c<b.length;c++)a=b[c],a()||b[c]!==a||b.splice(c--,1);b.length||n.fx.stop(),hb=void 0},n.fx.timer=function(a){n.timers.push(a),a()?n.fx.start():n.timers.pop()},n.fx.interval=13,n.fx.start=function(){ib||(ib=a.setInterval(n.fx.tick,n.fx.interval))},n.fx.stop=function(){a.clearInterval(ib),ib=null},n.fx.speeds={slow:600,fast:200,_default:400},n.fn.delay=function(b,c){return b=n.fx?n.fx.speeds[b]||b:b,c=c||"fx",this.queue(c,function(c,d){var e=a.setTimeout(c,b);d.stop=function(){a.clearTimeout(e)}})},function(){var a,b=d.createElement("input"),c=d.createElement("div"),e=d.createElement("select"),f=e.appendChild(d.createElement("option"));c=d.createElement("div"),c.setAttribute("className","t"),c.innerHTML="  <link/><table></table><a href='/a'>a</a><input type='checkbox'/>",a=c.getElementsByTagName("a")[0],b.setAttribute("type","checkbox"),c.appendChild(b),a=c.getElementsByTagName("a")[0],a.style.cssText="top:1px",l.getSetAttribute="t"!==c.className,l.style=/top/.test(a.getAttribute("style")),l.hrefNormalized="/a"===a.getAttribute("href"),l.checkOn=!!b.value,l.optSelected=f.selected,l.enctype=!!d.createElement("form").enctype,e.disabled=!0,l.optDisabled=!f.disabled,b=d.createElement("input"),b.setAttribute("value",""),l.input=""===b.getAttribute("value"),b.value="t",b.setAttribute("type","radio"),l.radioValue="t"===b.value}();var rb=/\r/g,sb=/[\x20\t\r\n\f]+/g;n.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=n.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,n(this).val()):a,null==e?e="":"number"==typeof e?e+="":n.isArray(e)&&(e=n.map(e,function(a){return null==a?"":a+""})),b=n.valHooks[this.type]||n.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=n.valHooks[e.type]||n.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(rb,""):null==c?"":c)}}}),n.extend({valHooks:{option:{get:function(a){var b=n.find.attr(a,"value");return null!=b?b:n.trim(n.text(a)).replace(sb," ")}},select:{get:function(a){for(var b,c,d=a.options,e=a.selectedIndex,f="select-one"===a.type||0>e,g=f?null:[],h=f?e+1:d.length,i=0>e?h:f?e:0;h>i;i++)if(c=d[i],(c.selected||i===e)&&(l.optDisabled?!c.disabled:null===c.getAttribute("disabled"))&&(!c.parentNode.disabled||!n.nodeName(c.parentNode,"optgroup"))){if(b=n(c).val(),f)return b;g.push(b)}return g},set:function(a,b){var c,d,e=a.options,f=n.makeArray(b),g=e.length;while(g--)if(d=e[g],n.inArray(n.valHooks.option.get(d),f)>-1)try{d.selected=c=!0}catch(h){d.scrollHeight}else d.selected=!1;return c||(a.selectedIndex=-1),e}}}}),n.each(["radio","checkbox"],function(){n.valHooks[this]={set:function(a,b){return n.isArray(b)?a.checked=n.inArray(n(a).val(),b)>-1:void 0}},l.checkOn||(n.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})});var tb,ub,vb=n.expr.attrHandle,wb=/^(?:checked|selected)$/i,xb=l.getSetAttribute,yb=l.input;n.fn.extend({attr:function(a,b){return Y(this,n.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){n.removeAttr(this,a)})}}),n.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return"undefined"==typeof a.getAttribute?n.prop(a,b,c):(1===f&&n.isXMLDoc(a)||(b=b.toLowerCase(),e=n.attrHooks[b]||(n.expr.match.bool.test(b)?ub:tb)),void 0!==c?null===c?void n.removeAttr(a,b):e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:(a.setAttribute(b,c+""),c):e&&"get"in e&&null!==(d=e.get(a,b))?d:(d=n.find.attr(a,b),null==d?void 0:d))},attrHooks:{type:{set:function(a,b){if(!l.radioValue&&"radio"===b&&n.nodeName(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}},removeAttr:function(a,b){var c,d,e=0,f=b&&b.match(G);if(f&&1===a.nodeType)while(c=f[e++])d=n.propFix[c]||c,n.expr.match.bool.test(c)?yb&&xb||!wb.test(c)?a[d]=!1:a[n.camelCase("default-"+c)]=a[d]=!1:n.attr(a,c,""),a.removeAttribute(xb?c:d)}}),ub={set:function(a,b,c){return b===!1?n.removeAttr(a,c):yb&&xb||!wb.test(c)?a.setAttribute(!xb&&n.propFix[c]||c,c):a[n.camelCase("default-"+c)]=a[c]=!0,c}},n.each(n.expr.match.bool.source.match(/\w+/g),function(a,b){var c=vb[b]||n.find.attr;yb&&xb||!wb.test(b)?vb[b]=function(a,b,d){var e,f;return d||(f=vb[b],vb[b]=e,e=null!=c(a,b,d)?b.toLowerCase():null,vb[b]=f),e}:vb[b]=function(a,b,c){return c?void 0:a[n.camelCase("default-"+b)]?b.toLowerCase():null}}),yb&&xb||(n.attrHooks.value={set:function(a,b,c){return n.nodeName(a,"input")?void(a.defaultValue=b):tb&&tb.set(a,b,c)}}),xb||(tb={set:function(a,b,c){var d=a.getAttributeNode(c);return d||a.setAttributeNode(d=a.ownerDocument.createAttribute(c)),d.value=b+="","value"===c||b===a.getAttribute(c)?b:void 0}},vb.id=vb.name=vb.coords=function(a,b,c){var d;return c?void 0:(d=a.getAttributeNode(b))&&""!==d.value?d.value:null},n.valHooks.button={get:function(a,b){var c=a.getAttributeNode(b);return c&&c.specified?c.value:void 0},set:tb.set},n.attrHooks.contenteditable={set:function(a,b,c){tb.set(a,""===b?!1:b,c)}},n.each(["width","height"],function(a,b){n.attrHooks[b]={set:function(a,c){return""===c?(a.setAttribute(b,"auto"),c):void 0}}})),l.style||(n.attrHooks.style={get:function(a){return a.style.cssText||void 0},set:function(a,b){return a.style.cssText=b+""}});var zb=/^(?:input|select|textarea|button|object)$/i,Ab=/^(?:a|area)$/i;n.fn.extend({prop:function(a,b){return Y(this,n.prop,a,b,arguments.length>1)},removeProp:function(a){return a=n.propFix[a]||a,this.each(function(){try{this[a]=void 0,delete this[a]}catch(b){}})}}),n.extend({prop:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return 1===f&&n.isXMLDoc(a)||(b=n.propFix[b]||b,e=n.propHooks[b]),void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){var b=n.find.attr(a,"tabindex");return b?parseInt(b,10):zb.test(a.nodeName)||Ab.test(a.nodeName)&&a.href?0:-1}}},propFix:{"for":"htmlFor","class":"className"}}),l.hrefNormalized||n.each(["href","src"],function(a,b){n.propHooks[b]={get:function(a){return a.getAttribute(b,4)}}}),l.optSelected||(n.propHooks.selected={get:function(a){var b=a.parentNode;return b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex),null},set:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex)}}),n.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){n.propFix[this.toLowerCase()]=this}),l.enctype||(n.propFix.enctype="encoding");var Bb=/[\t\r\n\f]/g;function Cb(a){return n.attr(a,"class")||""}n.fn.extend({addClass:function(a){var b,c,d,e,f,g,h,i=0;if(n.isFunction(a))return this.each(function(b){n(this).addClass(a.call(this,b,Cb(this)))});if("string"==typeof a&&a){b=a.match(G)||[];while(c=this[i++])if(e=Cb(c),d=1===c.nodeType&&(" "+e+" ").replace(Bb," ")){g=0;while(f=b[g++])d.indexOf(" "+f+" ")<0&&(d+=f+" ");h=n.trim(d),e!==h&&n.attr(c,"class",h)}}return this},removeClass:function(a){var b,c,d,e,f,g,h,i=0;if(n.isFunction(a))return this.each(function(b){n(this).removeClass(a.call(this,b,Cb(this)))});if(!arguments.length)return this.attr("class","");if("string"==typeof a&&a){b=a.match(G)||[];while(c=this[i++])if(e=Cb(c),d=1===c.nodeType&&(" "+e+" ").replace(Bb," ")){g=0;while(f=b[g++])while(d.indexOf(" "+f+" ")>-1)d=d.replace(" "+f+" "," ");h=n.trim(d),e!==h&&n.attr(c,"class",h)}}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):n.isFunction(a)?this.each(function(c){n(this).toggleClass(a.call(this,c,Cb(this),b),b)}):this.each(function(){var b,d,e,f;if("string"===c){d=0,e=n(this),f=a.match(G)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else void 0!==a&&"boolean"!==c||(b=Cb(this),b&&n._data(this,"__className__",b),n.attr(this,"class",b||a===!1?"":n._data(this,"__className__")||""))})},hasClass:function(a){var b,c,d=0;b=" "+a+" ";while(c=this[d++])if(1===c.nodeType&&(" "+Cb(c)+" ").replace(Bb," ").indexOf(b)>-1)return!0;return!1}}),n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){n.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),n.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}});var Db=a.location,Eb=n.now(),Fb=/\?/,Gb=/(,)|(\[|{)|(}|])|"(?:[^"\\\r\n]|\\["\\\/bfnrt]|\\u[\da-fA-F]{4})*"\s*:?|true|false|null|-?(?!0\d)\d+(?:\.\d+|)(?:[eE][+-]?\d+|)/g;n.parseJSON=function(b){if(a.JSON&&a.JSON.parse)return a.JSON.parse(b+"");var c,d=null,e=n.trim(b+"");return e&&!n.trim(e.replace(Gb,function(a,b,e,f){return c&&b&&(d=0),0===d?a:(c=e||b,d+=!f-!e,"")}))?Function("return "+e)():n.error("Invalid JSON: "+b)},n.parseXML=function(b){var c,d;if(!b||"string"!=typeof b)return null;try{a.DOMParser?(d=new a.DOMParser,c=d.parseFromString(b,"text/xml")):(c=new a.ActiveXObject("Microsoft.XMLDOM"),c.async="false",c.loadXML(b))}catch(e){c=void 0}return c&&c.documentElement&&!c.getElementsByTagName("parsererror").length||n.error("Invalid XML: "+b),c};var Hb=/#.*$/,Ib=/([?&])_=[^&]*/,Jb=/^(.*?):[ \t]*([^\r\n]*)\r?$/gm,Kb=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,Lb=/^(?:GET|HEAD)$/,Mb=/^\/\//,Nb=/^([\w.+-]+:)(?:\/\/(?:[^\/?#]*@|)([^\/?#:]*)(?::(\d+)|)|)/,Ob={},Pb={},Qb="*/".concat("*"),Rb=Db.href,Sb=Nb.exec(Rb.toLowerCase())||[];function Tb(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(G)||[];if(n.isFunction(c))while(d=f[e++])"+"===d.charAt(0)?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function Ub(a,b,c,d){var e={},f=a===Pb;function g(h){var i;return e[h]=!0,n.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function Vb(a,b){var c,d,e=n.ajaxSettings.flatOptions||{};for(d in b)void 0!==b[d]&&((e[d]?a:c||(c={}))[d]=b[d]);return c&&n.extend(!0,a,c),a}function Wb(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===e&&(e=a.mimeType||b.getResponseHeader("Content-Type"));if(e)for(g in h)if(h[g]&&h[g].test(e)){i.unshift(g);break}if(i[0]in c)f=i[0];else{for(g in c){if(!i[0]||a.converters[g+" "+i[0]]){f=g;break}d||(d=g)}f=f||d}return f?(f!==i[0]&&i.unshift(f),c[f]):void 0}function Xb(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}n.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:Rb,type:"GET",isLocal:Kb.test(Sb[1]),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Qb,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":n.parseJSON,"text xml":n.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?Vb(Vb(a,n.ajaxSettings),b):Vb(n.ajaxSettings,a)},ajaxPrefilter:Tb(Ob),ajaxTransport:Tb(Pb),ajax:function(b,c){"object"==typeof b&&(c=b,b=void 0),c=c||{};var d,e,f,g,h,i,j,k,l=n.ajaxSetup({},c),m=l.context||l,o=l.context&&(m.nodeType||m.jquery)?n(m):n.event,p=n.Deferred(),q=n.Callbacks("once memory"),r=l.statusCode||{},s={},t={},u=0,v="canceled",w={readyState:0,getResponseHeader:function(a){var b;if(2===u){if(!k){k={};while(b=Jb.exec(g))k[b[1].toLowerCase()]=b[2]}b=k[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return 2===u?g:null},setRequestHeader:function(a,b){var c=a.toLowerCase();return u||(a=t[c]=t[c]||a,s[a]=b),this},overrideMimeType:function(a){return u||(l.mimeType=a),this},statusCode:function(a){var b;if(a)if(2>u)for(b in a)r[b]=[r[b],a[b]];else w.always(a[w.status]);return this},abort:function(a){var b=a||v;return j&&j.abort(b),y(0,b),this}};if(p.promise(w).complete=q.add,w.success=w.done,w.error=w.fail,l.url=((b||l.url||Rb)+"").replace(Hb,"").replace(Mb,Sb[1]+"//"),l.type=c.method||c.type||l.method||l.type,l.dataTypes=n.trim(l.dataType||"*").toLowerCase().match(G)||[""],null==l.crossDomain&&(d=Nb.exec(l.url.toLowerCase()),l.crossDomain=!(!d||d[1]===Sb[1]&&d[2]===Sb[2]&&(d[3]||("http:"===d[1]?"80":"443"))===(Sb[3]||("http:"===Sb[1]?"80":"443")))),l.data&&l.processData&&"string"!=typeof l.data&&(l.data=n.param(l.data,l.traditional)),Ub(Ob,l,c,w),2===u)return w;i=n.event&&l.global,i&&0===n.active++&&n.event.trigger("ajaxStart"),l.type=l.type.toUpperCase(),l.hasContent=!Lb.test(l.type),f=l.url,l.hasContent||(l.data&&(f=l.url+=(Fb.test(f)?"&":"?")+l.data,delete l.data),l.cache===!1&&(l.url=Ib.test(f)?f.replace(Ib,"$1_="+Eb++):f+(Fb.test(f)?"&":"?")+"_="+Eb++)),l.ifModified&&(n.lastModified[f]&&w.setRequestHeader("If-Modified-Since",n.lastModified[f]),n.etag[f]&&w.setRequestHeader("If-None-Match",n.etag[f])),(l.data&&l.hasContent&&l.contentType!==!1||c.contentType)&&w.setRequestHeader("Content-Type",l.contentType),w.setRequestHeader("Accept",l.dataTypes[0]&&l.accepts[l.dataTypes[0]]?l.accepts[l.dataTypes[0]]+("*"!==l.dataTypes[0]?", "+Qb+"; q=0.01":""):l.accepts["*"]);for(e in l.headers)w.setRequestHeader(e,l.headers[e]);if(l.beforeSend&&(l.beforeSend.call(m,w,l)===!1||2===u))return w.abort();v="abort";for(e in{success:1,error:1,complete:1})w[e](l[e]);if(j=Ub(Pb,l,c,w)){if(w.readyState=1,i&&o.trigger("ajaxSend",[w,l]),2===u)return w;l.async&&l.timeout>0&&(h=a.setTimeout(function(){w.abort("timeout")},l.timeout));try{u=1,j.send(s,y)}catch(x){if(!(2>u))throw x;y(-1,x)}}else y(-1,"No Transport");function y(b,c,d,e){var k,s,t,v,x,y=c;2!==u&&(u=2,h&&a.clearTimeout(h),j=void 0,g=e||"",w.readyState=b>0?4:0,k=b>=200&&300>b||304===b,d&&(v=Wb(l,w,d)),v=Xb(l,v,w,k),k?(l.ifModified&&(x=w.getResponseHeader("Last-Modified"),x&&(n.lastModified[f]=x),x=w.getResponseHeader("etag"),x&&(n.etag[f]=x)),204===b||"HEAD"===l.type?y="nocontent":304===b?y="notmodified":(y=v.state,s=v.data,t=v.error,k=!t)):(t=y,!b&&y||(y="error",0>b&&(b=0))),w.status=b,w.statusText=(c||y)+"",k?p.resolveWith(m,[s,y,w]):p.rejectWith(m,[w,y,t]),w.statusCode(r),r=void 0,i&&o.trigger(k?"ajaxSuccess":"ajaxError",[w,l,k?s:t]),q.fireWith(m,[w,y]),i&&(o.trigger("ajaxComplete",[w,l]),--n.active||n.event.trigger("ajaxStop")))}return w},getJSON:function(a,b,c){return n.get(a,b,c,"json")},getScript:function(a,b){return n.get(a,void 0,b,"script")}}),n.each(["get","post"],function(a,b){n[b]=function(a,c,d,e){return n.isFunction(c)&&(e=e||d,d=c,c=void 0),n.ajax(n.extend({url:a,type:b,dataType:e,data:c,success:d},n.isPlainObject(a)&&a))}}),n._evalUrl=function(a){return n.ajax({url:a,type:"GET",dataType:"script",cache:!0,async:!1,global:!1,"throws":!0})},n.fn.extend({wrapAll:function(a){if(n.isFunction(a))return this.each(function(b){n(this).wrapAll(a.call(this,b))});if(this[0]){var b=n(a,this[0].ownerDocument).eq(0).clone(!0);this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstChild&&1===a.firstChild.nodeType)a=a.firstChild;return a}).append(this)}return this},wrapInner:function(a){return n.isFunction(a)?this.each(function(b){n(this).wrapInner(a.call(this,b))}):this.each(function(){var b=n(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=n.isFunction(a);return this.each(function(c){n(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){n.nodeName(this,"body")||n(this).replaceWith(this.childNodes)}).end()}});function Yb(a){return a.style&&a.style.display||n.css(a,"display")}function Zb(a){if(!n.contains(a.ownerDocument||d,a))return!0;while(a&&1===a.nodeType){if("none"===Yb(a)||"hidden"===a.type)return!0;a=a.parentNode}return!1}n.expr.filters.hidden=function(a){return l.reliableHiddenOffsets()?a.offsetWidth<=0&&a.offsetHeight<=0&&!a.getClientRects().length:Zb(a)},n.expr.filters.visible=function(a){return!n.expr.filters.hidden(a)};var $b=/%20/g,_b=/\[\]$/,ac=/\r?\n/g,bc=/^(?:submit|button|image|reset|file)$/i,cc=/^(?:input|select|textarea|keygen)/i;function dc(a,b,c,d){var e;if(n.isArray(b))n.each(b,function(b,e){c||_b.test(a)?d(a,e):dc(a+"["+("object"==typeof e&&null!=e?b:"")+"]",e,c,d)});else if(c||"object"!==n.type(b))d(a,b);else for(e in b)dc(a+"["+e+"]",b[e],c,d)}n.param=function(a,b){var c,d=[],e=function(a,b){b=n.isFunction(b)?b():null==b?"":b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};if(void 0===b&&(b=n.ajaxSettings&&n.ajaxSettings.traditional),n.isArray(a)||a.jquery&&!n.isPlainObject(a))n.each(a,function(){e(this.name,this.value)});else for(c in a)dc(c,a[c],b,e);return d.join("&").replace($b,"+")},n.fn.extend({serialize:function(){return n.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=n.prop(this,"elements");return a?n.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!n(this).is(":disabled")&&cc.test(this.nodeName)&&!bc.test(a)&&(this.checked||!Z.test(a))}).map(function(a,b){var c=n(this).val();return null==c?null:n.isArray(c)?n.map(c,function(a){return{name:b.name,value:a.replace(ac,"\r\n")}}):{name:b.name,value:c.replace(ac,"\r\n")}}).get()}}),n.ajaxSettings.xhr=void 0!==a.ActiveXObject?function(){return this.isLocal?ic():d.documentMode>8?hc():/^(get|post|head|put|delete|options)$/i.test(this.type)&&hc()||ic()}:hc;var ec=0,fc={},gc=n.ajaxSettings.xhr();a.attachEvent&&a.attachEvent("onunload",function(){for(var a in fc)fc[a](void 0,!0)}),l.cors=!!gc&&"withCredentials"in gc,gc=l.ajax=!!gc,gc&&n.ajaxTransport(function(b){if(!b.crossDomain||l.cors){var c;return{send:function(d,e){var f,g=b.xhr(),h=++ec;if(g.open(b.type,b.url,b.async,b.username,b.password),b.xhrFields)for(f in b.xhrFields)g[f]=b.xhrFields[f];b.mimeType&&g.overrideMimeType&&g.overrideMimeType(b.mimeType),b.crossDomain||d["X-Requested-With"]||(d["X-Requested-With"]="XMLHttpRequest");for(f in d)void 0!==d[f]&&g.setRequestHeader(f,d[f]+"");g.send(b.hasContent&&b.data||null),c=function(a,d){var f,i,j;if(c&&(d||4===g.readyState))if(delete fc[h],c=void 0,g.onreadystatechange=n.noop,d)4!==g.readyState&&g.abort();else{j={},f=g.status,"string"==typeof g.responseText&&(j.text=g.responseText);try{i=g.statusText}catch(k){i=""}f||!b.isLocal||b.crossDomain?1223===f&&(f=204):f=j.text?200:404}j&&e(f,i,j,g.getAllResponseHeaders())},b.async?4===g.readyState?a.setTimeout(c):g.onreadystatechange=fc[h]=c:c()},abort:function(){c&&c(void 0,!0)}}}});function hc(){try{return new a.XMLHttpRequest}catch(b){}}function ic(){try{return new a.ActiveXObject("Microsoft.XMLHTTP")}catch(b){}}n.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(a){return n.globalEval(a),a}}}),n.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET",a.global=!1)}),n.ajaxTransport("script",function(a){if(a.crossDomain){var b,c=d.head||n("head")[0]||d.documentElement;return{send:function(e,f){b=d.createElement("script"),b.async=!0,a.scriptCharset&&(b.charset=a.scriptCharset),b.src=a.url,b.onload=b.onreadystatechange=function(a,c){(c||!b.readyState||/loaded|complete/.test(b.readyState))&&(b.onload=b.onreadystatechange=null,b.parentNode&&b.parentNode.removeChild(b),b=null,c||f(200,"success"))},c.insertBefore(b,c.firstChild)},abort:function(){b&&b.onload(void 0,!0)}}}});var jc=[],kc=/(=)\?(?=&|$)|\?\?/;n.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=jc.pop()||n.expando+"_"+Eb++;return this[a]=!0,a}}),n.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(kc.test(b.url)?"url":"string"==typeof b.data&&0===(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&kc.test(b.data)&&"data");return h||"jsonp"===b.dataTypes[0]?(e=b.jsonpCallback=n.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(kc,"$1"+e):b.jsonp!==!1&&(b.url+=(Fb.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||n.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){void 0===f?n(a).removeProp(e):a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,jc.push(e)),g&&n.isFunction(f)&&f(g[0]),g=f=void 0}),"script"):void 0}),n.parseHTML=function(a,b,c){if(!a||"string"!=typeof a)return null;"boolean"==typeof b&&(c=b,b=!1),b=b||d;var e=x.exec(a),f=!c&&[];return e?[b.createElement(e[1])]:(e=ja([a],b,f),f&&f.length&&n(f).remove(),n.merge([],e.childNodes))};var lc=n.fn.load;n.fn.load=function(a,b,c){if("string"!=typeof a&&lc)return lc.apply(this,arguments);var d,e,f,g=this,h=a.indexOf(" ");return h>-1&&(d=n.trim(a.slice(h,a.length)),a=a.slice(0,h)),n.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(e="POST"),g.length>0&&n.ajax({url:a,type:e||"GET",dataType:"html",data:b}).done(function(a){f=arguments,g.html(d?n("<div>").append(n.parseHTML(a)).find(d):a)}).always(c&&function(a,b){g.each(function(){c.apply(this,f||[a.responseText,b,a])})}),this},n.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){n.fn[b]=function(a){return this.on(b,a)}}),n.expr.filters.animated=function(a){return n.grep(n.timers,function(b){return a===b.elem}).length};function mc(a){return n.isWindow(a)?a:9===a.nodeType?a.defaultView||a.parentWindow:!1}n.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=n.css(a,"position"),l=n(a),m={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=n.css(a,"top"),i=n.css(a,"left"),j=("absolute"===k||"fixed"===k)&&n.inArray("auto",[f,i])>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),n.isFunction(b)&&(b=b.call(a,c,n.extend({},h))),null!=b.top&&(m.top=b.top-h.top+g),null!=b.left&&(m.left=b.left-h.left+e),"using"in b?b.using.call(a,m):l.css(m)}},n.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){n.offset.setOffset(this,a,b)});var b,c,d={top:0,left:0},e=this[0],f=e&&e.ownerDocument;if(f)return b=f.documentElement,n.contains(b,e)?("undefined"!=typeof e.getBoundingClientRect&&(d=e.getBoundingClientRect()),c=mc(f),{top:d.top+(c.pageYOffset||b.scrollTop)-(b.clientTop||0),left:d.left+(c.pageXOffset||b.scrollLeft)-(b.clientLeft||0)}):d},position:function(){if(this[0]){var a,b,c={top:0,left:0},d=this[0];return"fixed"===n.css(d,"position")?b=d.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),n.nodeName(a[0],"html")||(c=a.offset()),c.top+=n.css(a[0],"borderTopWidth",!0),c.left+=n.css(a[0],"borderLeftWidth",!0)),{top:b.top-c.top-n.css(d,"marginTop",!0),left:b.left-c.left-n.css(d,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent;while(a&&!n.nodeName(a,"html")&&"static"===n.css(a,"position"))a=a.offsetParent;return a||Qa})}}),n.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(a,b){var c=/Y/.test(b);n.fn[a]=function(d){return Y(this,function(a,d,e){var f=mc(a);return void 0===e?f?b in f?f[b]:f.document.documentElement[d]:a[d]:void(f?f.scrollTo(c?n(f).scrollLeft():e,c?e:n(f).scrollTop()):a[d]=e)},a,d,arguments.length,null)}}),n.each(["top","left"],function(a,b){n.cssHooks[b]=Ua(l.pixelPosition,function(a,c){return c?(c=Sa(a,b),Oa.test(c)?n(a).position()[b]+"px":c):void 0})}),n.each({Height:"height",Width:"width"},function(a,b){n.each({
padding:"inner"+a,content:b,"":"outer"+a},function(c,d){n.fn[d]=function(d,e){var f=arguments.length&&(c||"boolean"!=typeof d),g=c||(d===!0||e===!0?"margin":"border");return Y(this,function(b,c,d){var e;return n.isWindow(b)?b.document.documentElement["client"+a]:9===b.nodeType?(e=b.documentElement,Math.max(b.body["scroll"+a],e["scroll"+a],b.body["offset"+a],e["offset"+a],e["client"+a])):void 0===d?n.css(b,c,g):n.style(b,c,d,g)},b,f?d:void 0,f,null)}})}),n.fn.extend({bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)}}),n.fn.size=function(){return this.length},n.fn.andSelf=n.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return n});var nc=a.jQuery,oc=a.$;return n.noConflict=function(b){return a.$===n&&(a.$=oc),b&&a.jQuery===n&&(a.jQuery=nc),n},b||(a.jQuery=a.$=n),n});

/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>2)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.6",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.6",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.6",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.6",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.6",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h4 class="popover-title"></h4><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.6",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");
d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.6",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);

/*! jQuery UI - v1.11.4 - 2015-09-06
* http://jqueryui.com
* Includes: core.js, widget.js, mouse.js, position.js, draggable.js, droppable.js, resizable.js, selectable.js, sortable.js, accordion.js, autocomplete.js, button.js, datepicker.js, dialog.js, menu.js, progressbar.js, selectmenu.js, slider.js, spinner.js, tabs.js, tooltip.js, effect.js, effect-blind.js, effect-bounce.js, effect-clip.js, effect-drop.js, effect-explode.js, effect-fade.js, effect-fold.js, effect-highlight.js, effect-puff.js, effect-pulsate.js, effect-scale.js, effect-shake.js, effect-size.js, effect-slide.js, effect-transfer.js
* Copyright 2015 jQuery Foundation and other contributors; Licensed MIT */
(function(e){"function"==typeof define&&define.amd?define(["jquery"],e):e(jQuery)})(function(e){function t(t,s){var n,a,o,r=t.nodeName.toLowerCase();return"area"===r?(n=t.parentNode,a=n.name,t.href&&a&&"map"===n.nodeName.toLowerCase()?(o=e("img[usemap='#"+a+"']")[0],!!o&&i(o)):!1):(/^(input|select|textarea|button|object)$/.test(r)?!t.disabled:"a"===r?t.href||s:s)&&i(t)}function i(t){return e.expr.filters.visible(t)&&!e(t).parents().addBack().filter(function(){return"hidden"===e.css(this,"visibility")}).length}function s(e){for(var t,i;e.length&&e[0]!==document;){if(t=e.css("position"),("absolute"===t||"relative"===t||"fixed"===t)&&(i=parseInt(e.css("zIndex"),10),!isNaN(i)&&0!==i))return i;e=e.parent()}return 0}function n(){this._curInst=null,this._keyEvent=!1,this._disabledInputs=[],this._datepickerShowing=!1,this._inDialog=!1,this._mainDivId="ui-datepicker-div",this._inlineClass="ui-datepicker-inline",this._appendClass="ui-datepicker-append",this._triggerClass="ui-datepicker-trigger",this._dialogClass="ui-datepicker-dialog",this._disableClass="ui-datepicker-disabled",this._unselectableClass="ui-datepicker-unselectable",this._currentClass="ui-datepicker-current-day",this._dayOverClass="ui-datepicker-days-cell-over",this.regional=[],this.regional[""]={closeText:"Done",prevText:"Prev",nextText:"Next",currentText:"Today",monthNames:["January","February","March","April","May","June","July","August","September","October","November","December"],monthNamesShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],dayNames:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],dayNamesShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],dayNamesMin:["Su","Mo","Tu","We","Th","Fr","Sa"],weekHeader:"Wk",dateFormat:"mm/dd/yy",firstDay:0,isRTL:!1,showMonthAfterYear:!1,yearSuffix:""},this._defaults={showOn:"focus",showAnim:"fadeIn",showOptions:{},defaultDate:null,appendText:"",buttonText:"...",buttonImage:"",buttonImageOnly:!1,hideIfNoPrevNext:!1,navigationAsDateFormat:!1,gotoCurrent:!1,changeMonth:!1,changeYear:!1,yearRange:"c-10:c+10",showOtherMonths:!1,selectOtherMonths:!1,showWeek:!1,calculateWeek:this.iso8601Week,shortYearCutoff:"+10",minDate:null,maxDate:null,duration:"fast",beforeShowDay:null,beforeShow:null,onSelect:null,onChangeMonthYear:null,onClose:null,numberOfMonths:1,showCurrentAtPos:0,stepMonths:1,stepBigMonths:12,altField:"",altFormat:"",constrainInput:!0,showButtonPanel:!1,autoSize:!1,disabled:!1},e.extend(this._defaults,this.regional[""]),this.regional.en=e.extend(!0,{},this.regional[""]),this.regional["en-US"]=e.extend(!0,{},this.regional.en),this.dpDiv=a(e("<div id='"+this._mainDivId+"' class='ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>"))}function a(t){var i="button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a";return t.delegate(i,"mouseout",function(){e(this).removeClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&e(this).removeClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&e(this).removeClass("ui-datepicker-next-hover")}).delegate(i,"mouseover",o)}function o(){e.datepicker._isDisabledDatepicker(v.inline?v.dpDiv.parent()[0]:v.input[0])||(e(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),e(this).addClass("ui-state-hover"),-1!==this.className.indexOf("ui-datepicker-prev")&&e(this).addClass("ui-datepicker-prev-hover"),-1!==this.className.indexOf("ui-datepicker-next")&&e(this).addClass("ui-datepicker-next-hover"))}function r(t,i){e.extend(t,i);for(var s in i)null==i[s]&&(t[s]=i[s]);return t}function h(e){return function(){var t=this.element.val();e.apply(this,arguments),this._refresh(),t!==this.element.val()&&this._trigger("change")}}e.ui=e.ui||{},e.extend(e.ui,{version:"1.11.4",keyCode:{BACKSPACE:8,COMMA:188,DELETE:46,DOWN:40,END:35,ENTER:13,ESCAPE:27,HOME:36,LEFT:37,PAGE_DOWN:34,PAGE_UP:33,PERIOD:190,RIGHT:39,SPACE:32,TAB:9,UP:38}}),e.fn.extend({scrollParent:function(t){var i=this.css("position"),s="absolute"===i,n=t?/(auto|scroll|hidden)/:/(auto|scroll)/,a=this.parents().filter(function(){var t=e(this);return s&&"static"===t.css("position")?!1:n.test(t.css("overflow")+t.css("overflow-y")+t.css("overflow-x"))}).eq(0);return"fixed"!==i&&a.length?a:e(this[0].ownerDocument||document)},uniqueId:function(){var e=0;return function(){return this.each(function(){this.id||(this.id="ui-id-"+ ++e)})}}(),removeUniqueId:function(){return this.each(function(){/^ui-id-\d+$/.test(this.id)&&e(this).removeAttr("id")})}}),e.extend(e.expr[":"],{data:e.expr.createPseudo?e.expr.createPseudo(function(t){return function(i){return!!e.data(i,t)}}):function(t,i,s){return!!e.data(t,s[3])},focusable:function(i){return t(i,!isNaN(e.attr(i,"tabindex")))},tabbable:function(i){var s=e.attr(i,"tabindex"),n=isNaN(s);return(n||s>=0)&&t(i,!n)}}),e("<a>").outerWidth(1).jquery||e.each(["Width","Height"],function(t,i){function s(t,i,s,a){return e.each(n,function(){i-=parseFloat(e.css(t,"padding"+this))||0,s&&(i-=parseFloat(e.css(t,"border"+this+"Width"))||0),a&&(i-=parseFloat(e.css(t,"margin"+this))||0)}),i}var n="Width"===i?["Left","Right"]:["Top","Bottom"],a=i.toLowerCase(),o={innerWidth:e.fn.innerWidth,innerHeight:e.fn.innerHeight,outerWidth:e.fn.outerWidth,outerHeight:e.fn.outerHeight};e.fn["inner"+i]=function(t){return void 0===t?o["inner"+i].call(this):this.each(function(){e(this).css(a,s(this,t)+"px")})},e.fn["outer"+i]=function(t,n){return"number"!=typeof t?o["outer"+i].call(this,t):this.each(function(){e(this).css(a,s(this,t,!0,n)+"px")})}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e("<a>").data("a-b","a").removeData("a-b").data("a-b")&&(e.fn.removeData=function(t){return function(i){return arguments.length?t.call(this,e.camelCase(i)):t.call(this)}}(e.fn.removeData)),e.ui.ie=!!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()),e.fn.extend({focus:function(t){return function(i,s){return"number"==typeof i?this.each(function(){var t=this;setTimeout(function(){e(t).focus(),s&&s.call(t)},i)}):t.apply(this,arguments)}}(e.fn.focus),disableSelection:function(){var e="onselectstart"in document.createElement("div")?"selectstart":"mousedown";return function(){return this.bind(e+".ui-disableSelection",function(e){e.preventDefault()})}}(),enableSelection:function(){return this.unbind(".ui-disableSelection")},zIndex:function(t){if(void 0!==t)return this.css("zIndex",t);if(this.length)for(var i,s,n=e(this[0]);n.length&&n[0]!==document;){if(i=n.css("position"),("absolute"===i||"relative"===i||"fixed"===i)&&(s=parseInt(n.css("zIndex"),10),!isNaN(s)&&0!==s))return s;n=n.parent()}return 0}}),e.ui.plugin={add:function(t,i,s){var n,a=e.ui[t].prototype;for(n in s)a.plugins[n]=a.plugins[n]||[],a.plugins[n].push([i,s[n]])},call:function(e,t,i,s){var n,a=e.plugins[t];if(a&&(s||e.element[0].parentNode&&11!==e.element[0].parentNode.nodeType))for(n=0;a.length>n;n++)e.options[a[n][0]]&&a[n][1].apply(e.element,i)}};var l=0,u=Array.prototype.slice;e.cleanData=function(t){return function(i){var s,n,a;for(a=0;null!=(n=i[a]);a++)try{s=e._data(n,"events"),s&&s.remove&&e(n).triggerHandler("remove")}catch(o){}t(i)}}(e.cleanData),e.widget=function(t,i,s){var n,a,o,r,h={},l=t.split(".")[0];return t=t.split(".")[1],n=l+"-"+t,s||(s=i,i=e.Widget),e.expr[":"][n.toLowerCase()]=function(t){return!!e.data(t,n)},e[l]=e[l]||{},a=e[l][t],o=e[l][t]=function(e,t){return this._createWidget?(arguments.length&&this._createWidget(e,t),void 0):new o(e,t)},e.extend(o,a,{version:s.version,_proto:e.extend({},s),_childConstructors:[]}),r=new i,r.options=e.widget.extend({},r.options),e.each(s,function(t,s){return e.isFunction(s)?(h[t]=function(){var e=function(){return i.prototype[t].apply(this,arguments)},n=function(e){return i.prototype[t].apply(this,e)};return function(){var t,i=this._super,a=this._superApply;return this._super=e,this._superApply=n,t=s.apply(this,arguments),this._super=i,this._superApply=a,t}}(),void 0):(h[t]=s,void 0)}),o.prototype=e.widget.extend(r,{widgetEventPrefix:a?r.widgetEventPrefix||t:t},h,{constructor:o,namespace:l,widgetName:t,widgetFullName:n}),a?(e.each(a._childConstructors,function(t,i){var s=i.prototype;e.widget(s.namespace+"."+s.widgetName,o,i._proto)}),delete a._childConstructors):i._childConstructors.push(o),e.widget.bridge(t,o),o},e.widget.extend=function(t){for(var i,s,n=u.call(arguments,1),a=0,o=n.length;o>a;a++)for(i in n[a])s=n[a][i],n[a].hasOwnProperty(i)&&void 0!==s&&(t[i]=e.isPlainObject(s)?e.isPlainObject(t[i])?e.widget.extend({},t[i],s):e.widget.extend({},s):s);return t},e.widget.bridge=function(t,i){var s=i.prototype.widgetFullName||t;e.fn[t]=function(n){var a="string"==typeof n,o=u.call(arguments,1),r=this;return a?this.each(function(){var i,a=e.data(this,s);return"instance"===n?(r=a,!1):a?e.isFunction(a[n])&&"_"!==n.charAt(0)?(i=a[n].apply(a,o),i!==a&&void 0!==i?(r=i&&i.jquery?r.pushStack(i.get()):i,!1):void 0):e.error("no such method '"+n+"' for "+t+" widget instance"):e.error("cannot call methods on "+t+" prior to initialization; "+"attempted to call method '"+n+"'")}):(o.length&&(n=e.widget.extend.apply(null,[n].concat(o))),this.each(function(){var t=e.data(this,s);t?(t.option(n||{}),t._init&&t._init()):e.data(this,s,new i(n,this))})),r}},e.Widget=function(){},e.Widget._childConstructors=[],e.Widget.prototype={widgetName:"widget",widgetEventPrefix:"",defaultElement:"<div>",options:{disabled:!1,create:null},_createWidget:function(t,i){i=e(i||this.defaultElement||this)[0],this.element=e(i),this.uuid=l++,this.eventNamespace="."+this.widgetName+this.uuid,this.bindings=e(),this.hoverable=e(),this.focusable=e(),i!==this&&(e.data(i,this.widgetFullName,this),this._on(!0,this.element,{remove:function(e){e.target===i&&this.destroy()}}),this.document=e(i.style?i.ownerDocument:i.document||i),this.window=e(this.document[0].defaultView||this.document[0].parentWindow)),this.options=e.widget.extend({},this.options,this._getCreateOptions(),t),this._create(),this._trigger("create",null,this._getCreateEventData()),this._init()},_getCreateOptions:e.noop,_getCreateEventData:e.noop,_create:e.noop,_init:e.noop,destroy:function(){this._destroy(),this.element.unbind(this.eventNamespace).removeData(this.widgetFullName).removeData(e.camelCase(this.widgetFullName)),this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName+"-disabled "+"ui-state-disabled"),this.bindings.unbind(this.eventNamespace),this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus")},_destroy:e.noop,widget:function(){return this.element},option:function(t,i){var s,n,a,o=t;if(0===arguments.length)return e.widget.extend({},this.options);if("string"==typeof t)if(o={},s=t.split("."),t=s.shift(),s.length){for(n=o[t]=e.widget.extend({},this.options[t]),a=0;s.length-1>a;a++)n[s[a]]=n[s[a]]||{},n=n[s[a]];if(t=s.pop(),1===arguments.length)return void 0===n[t]?null:n[t];n[t]=i}else{if(1===arguments.length)return void 0===this.options[t]?null:this.options[t];o[t]=i}return this._setOptions(o),this},_setOptions:function(e){var t;for(t in e)this._setOption(t,e[t]);return this},_setOption:function(e,t){return this.options[e]=t,"disabled"===e&&(this.widget().toggleClass(this.widgetFullName+"-disabled",!!t),t&&(this.hoverable.removeClass("ui-state-hover"),this.focusable.removeClass("ui-state-focus"))),this},enable:function(){return this._setOptions({disabled:!1})},disable:function(){return this._setOptions({disabled:!0})},_on:function(t,i,s){var n,a=this;"boolean"!=typeof t&&(s=i,i=t,t=!1),s?(i=n=e(i),this.bindings=this.bindings.add(i)):(s=i,i=this.element,n=this.widget()),e.each(s,function(s,o){function r(){return t||a.options.disabled!==!0&&!e(this).hasClass("ui-state-disabled")?("string"==typeof o?a[o]:o).apply(a,arguments):void 0}"string"!=typeof o&&(r.guid=o.guid=o.guid||r.guid||e.guid++);var h=s.match(/^([\w:-]*)\s*(.*)$/),l=h[1]+a.eventNamespace,u=h[2];u?n.delegate(u,l,r):i.bind(l,r)})},_off:function(t,i){i=(i||"").split(" ").join(this.eventNamespace+" ")+this.eventNamespace,t.unbind(i).undelegate(i),this.bindings=e(this.bindings.not(t).get()),this.focusable=e(this.focusable.not(t).get()),this.hoverable=e(this.hoverable.not(t).get())},_delay:function(e,t){function i(){return("string"==typeof e?s[e]:e).apply(s,arguments)}var s=this;return setTimeout(i,t||0)},_hoverable:function(t){this.hoverable=this.hoverable.add(t),this._on(t,{mouseenter:function(t){e(t.currentTarget).addClass("ui-state-hover")},mouseleave:function(t){e(t.currentTarget).removeClass("ui-state-hover")}})},_focusable:function(t){this.focusable=this.focusable.add(t),this._on(t,{focusin:function(t){e(t.currentTarget).addClass("ui-state-focus")},focusout:function(t){e(t.currentTarget).removeClass("ui-state-focus")}})},_trigger:function(t,i,s){var n,a,o=this.options[t];if(s=s||{},i=e.Event(i),i.type=(t===this.widgetEventPrefix?t:this.widgetEventPrefix+t).toLowerCase(),i.target=this.element[0],a=i.originalEvent)for(n in a)n in i||(i[n]=a[n]);return this.element.trigger(i,s),!(e.isFunction(o)&&o.apply(this.element[0],[i].concat(s))===!1||i.isDefaultPrevented())}},e.each({show:"fadeIn",hide:"fadeOut"},function(t,i){e.Widget.prototype["_"+t]=function(s,n,a){"string"==typeof n&&(n={effect:n});var o,r=n?n===!0||"number"==typeof n?i:n.effect||i:t;n=n||{},"number"==typeof n&&(n={duration:n}),o=!e.isEmptyObject(n),n.complete=a,n.delay&&s.delay(n.delay),o&&e.effects&&e.effects.effect[r]?s[t](n):r!==t&&s[r]?s[r](n.duration,n.easing,a):s.queue(function(i){e(this)[t](),a&&a.call(s[0]),i()})}}),e.widget;var d=!1;e(document).mouseup(function(){d=!1}),e.widget("ui.mouse",{version:"1.11.4",options:{cancel:"input,textarea,button,select,option",distance:1,delay:0},_mouseInit:function(){var t=this;this.element.bind("mousedown."+this.widgetName,function(e){return t._mouseDown(e)}).bind("click."+this.widgetName,function(i){return!0===e.data(i.target,t.widgetName+".preventClickEvent")?(e.removeData(i.target,t.widgetName+".preventClickEvent"),i.stopImmediatePropagation(),!1):void 0}),this.started=!1},_mouseDestroy:function(){this.element.unbind("."+this.widgetName),this._mouseMoveDelegate&&this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate)},_mouseDown:function(t){if(!d){this._mouseMoved=!1,this._mouseStarted&&this._mouseUp(t),this._mouseDownEvent=t;var i=this,s=1===t.which,n="string"==typeof this.options.cancel&&t.target.nodeName?e(t.target).closest(this.options.cancel).length:!1;return s&&!n&&this._mouseCapture(t)?(this.mouseDelayMet=!this.options.delay,this.mouseDelayMet||(this._mouseDelayTimer=setTimeout(function(){i.mouseDelayMet=!0},this.options.delay)),this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(t)!==!1,!this._mouseStarted)?(t.preventDefault(),!0):(!0===e.data(t.target,this.widgetName+".preventClickEvent")&&e.removeData(t.target,this.widgetName+".preventClickEvent"),this._mouseMoveDelegate=function(e){return i._mouseMove(e)},this._mouseUpDelegate=function(e){return i._mouseUp(e)},this.document.bind("mousemove."+this.widgetName,this._mouseMoveDelegate).bind("mouseup."+this.widgetName,this._mouseUpDelegate),t.preventDefault(),d=!0,!0)):!0}},_mouseMove:function(t){if(this._mouseMoved){if(e.ui.ie&&(!document.documentMode||9>document.documentMode)&&!t.button)return this._mouseUp(t);if(!t.which)return this._mouseUp(t)}return(t.which||t.button)&&(this._mouseMoved=!0),this._mouseStarted?(this._mouseDrag(t),t.preventDefault()):(this._mouseDistanceMet(t)&&this._mouseDelayMet(t)&&(this._mouseStarted=this._mouseStart(this._mouseDownEvent,t)!==!1,this._mouseStarted?this._mouseDrag(t):this._mouseUp(t)),!this._mouseStarted)},_mouseUp:function(t){return this.document.unbind("mousemove."+this.widgetName,this._mouseMoveDelegate).unbind("mouseup."+this.widgetName,this._mouseUpDelegate),this._mouseStarted&&(this._mouseStarted=!1,t.target===this._mouseDownEvent.target&&e.data(t.target,this.widgetName+".preventClickEvent",!0),this._mouseStop(t)),d=!1,!1},_mouseDistanceMet:function(e){return Math.max(Math.abs(this._mouseDownEvent.pageX-e.pageX),Math.abs(this._mouseDownEvent.pageY-e.pageY))>=this.options.distance},_mouseDelayMet:function(){return this.mouseDelayMet},_mouseStart:function(){},_mouseDrag:function(){},_mouseStop:function(){},_mouseCapture:function(){return!0}}),function(){function t(e,t,i){return[parseFloat(e[0])*(p.test(e[0])?t/100:1),parseFloat(e[1])*(p.test(e[1])?i/100:1)]}function i(t,i){return parseInt(e.css(t,i),10)||0}function s(t){var i=t[0];return 9===i.nodeType?{width:t.width(),height:t.height(),offset:{top:0,left:0}}:e.isWindow(i)?{width:t.width(),height:t.height(),offset:{top:t.scrollTop(),left:t.scrollLeft()}}:i.preventDefault?{width:0,height:0,offset:{top:i.pageY,left:i.pageX}}:{width:t.outerWidth(),height:t.outerHeight(),offset:t.offset()}}e.ui=e.ui||{};var n,a,o=Math.max,r=Math.abs,h=Math.round,l=/left|center|right/,u=/top|center|bottom/,d=/[\+\-]\d+(\.[\d]+)?%?/,c=/^\w+/,p=/%$/,f=e.fn.position;e.position={scrollbarWidth:function(){if(void 0!==n)return n;var t,i,s=e("<div style='display:block;position:absolute;width:50px;height:50px;overflow:hidden;'><div style='height:100px;width:auto;'></div></div>"),a=s.children()[0];return e("body").append(s),t=a.offsetWidth,s.css("overflow","scroll"),i=a.offsetWidth,t===i&&(i=s[0].clientWidth),s.remove(),n=t-i},getScrollInfo:function(t){var i=t.isWindow||t.isDocument?"":t.element.css("overflow-x"),s=t.isWindow||t.isDocument?"":t.element.css("overflow-y"),n="scroll"===i||"auto"===i&&t.width<t.element[0].scrollWidth,a="scroll"===s||"auto"===s&&t.height<t.element[0].scrollHeight;return{width:a?e.position.scrollbarWidth():0,height:n?e.position.scrollbarWidth():0}},getWithinInfo:function(t){var i=e(t||window),s=e.isWindow(i[0]),n=!!i[0]&&9===i[0].nodeType;return{element:i,isWindow:s,isDocument:n,offset:i.offset()||{left:0,top:0},scrollLeft:i.scrollLeft(),scrollTop:i.scrollTop(),width:s||n?i.width():i.outerWidth(),height:s||n?i.height():i.outerHeight()}}},e.fn.position=function(n){if(!n||!n.of)return f.apply(this,arguments);n=e.extend({},n);var p,m,g,v,y,b,_=e(n.of),x=e.position.getWithinInfo(n.within),w=e.position.getScrollInfo(x),k=(n.collision||"flip").split(" "),T={};return b=s(_),_[0].preventDefault&&(n.at="left top"),m=b.width,g=b.height,v=b.offset,y=e.extend({},v),e.each(["my","at"],function(){var e,t,i=(n[this]||"").split(" ");1===i.length&&(i=l.test(i[0])?i.concat(["center"]):u.test(i[0])?["center"].concat(i):["center","center"]),i[0]=l.test(i[0])?i[0]:"center",i[1]=u.test(i[1])?i[1]:"center",e=d.exec(i[0]),t=d.exec(i[1]),T[this]=[e?e[0]:0,t?t[0]:0],n[this]=[c.exec(i[0])[0],c.exec(i[1])[0]]}),1===k.length&&(k[1]=k[0]),"right"===n.at[0]?y.left+=m:"center"===n.at[0]&&(y.left+=m/2),"bottom"===n.at[1]?y.top+=g:"center"===n.at[1]&&(y.top+=g/2),p=t(T.at,m,g),y.left+=p[0],y.top+=p[1],this.each(function(){var s,l,u=e(this),d=u.outerWidth(),c=u.outerHeight(),f=i(this,"marginLeft"),b=i(this,"marginTop"),D=d+f+i(this,"marginRight")+w.width,S=c+b+i(this,"marginBottom")+w.height,M=e.extend({},y),C=t(T.my,u.outerWidth(),u.outerHeight());"right"===n.my[0]?M.left-=d:"center"===n.my[0]&&(M.left-=d/2),"bottom"===n.my[1]?M.top-=c:"center"===n.my[1]&&(M.top-=c/2),M.left+=C[0],M.top+=C[1],a||(M.left=h(M.left),M.top=h(M.top)),s={marginLeft:f,marginTop:b},e.each(["left","top"],function(t,i){e.ui.position[k[t]]&&e.ui.position[k[t]][i](M,{targetWidth:m,targetHeight:g,elemWidth:d,elemHeight:c,collisionPosition:s,collisionWidth:D,collisionHeight:S,offset:[p[0]+C[0],p[1]+C[1]],my:n.my,at:n.at,within:x,elem:u})}),n.using&&(l=function(e){var t=v.left-M.left,i=t+m-d,s=v.top-M.top,a=s+g-c,h={target:{element:_,left:v.left,top:v.top,width:m,height:g},element:{element:u,left:M.left,top:M.top,width:d,height:c},horizontal:0>i?"left":t>0?"right":"center",vertical:0>a?"top":s>0?"bottom":"middle"};d>m&&m>r(t+i)&&(h.horizontal="center"),c>g&&g>r(s+a)&&(h.vertical="middle"),h.important=o(r(t),r(i))>o(r(s),r(a))?"horizontal":"vertical",n.using.call(this,e,h)}),u.offset(e.extend(M,{using:l}))})},e.ui.position={fit:{left:function(e,t){var i,s=t.within,n=s.isWindow?s.scrollLeft:s.offset.left,a=s.width,r=e.left-t.collisionPosition.marginLeft,h=n-r,l=r+t.collisionWidth-a-n;t.collisionWidth>a?h>0&&0>=l?(i=e.left+h+t.collisionWidth-a-n,e.left+=h-i):e.left=l>0&&0>=h?n:h>l?n+a-t.collisionWidth:n:h>0?e.left+=h:l>0?e.left-=l:e.left=o(e.left-r,e.left)},top:function(e,t){var i,s=t.within,n=s.isWindow?s.scrollTop:s.offset.top,a=t.within.height,r=e.top-t.collisionPosition.marginTop,h=n-r,l=r+t.collisionHeight-a-n;t.collisionHeight>a?h>0&&0>=l?(i=e.top+h+t.collisionHeight-a-n,e.top+=h-i):e.top=l>0&&0>=h?n:h>l?n+a-t.collisionHeight:n:h>0?e.top+=h:l>0?e.top-=l:e.top=o(e.top-r,e.top)}},flip:{left:function(e,t){var i,s,n=t.within,a=n.offset.left+n.scrollLeft,o=n.width,h=n.isWindow?n.scrollLeft:n.offset.left,l=e.left-t.collisionPosition.marginLeft,u=l-h,d=l+t.collisionWidth-o-h,c="left"===t.my[0]?-t.elemWidth:"right"===t.my[0]?t.elemWidth:0,p="left"===t.at[0]?t.targetWidth:"right"===t.at[0]?-t.targetWidth:0,f=-2*t.offset[0];0>u?(i=e.left+c+p+f+t.collisionWidth-o-a,(0>i||r(u)>i)&&(e.left+=c+p+f)):d>0&&(s=e.left-t.collisionPosition.marginLeft+c+p+f-h,(s>0||d>r(s))&&(e.left+=c+p+f))},top:function(e,t){var i,s,n=t.within,a=n.offset.top+n.scrollTop,o=n.height,h=n.isWindow?n.scrollTop:n.offset.top,l=e.top-t.collisionPosition.marginTop,u=l-h,d=l+t.collisionHeight-o-h,c="top"===t.my[1],p=c?-t.elemHeight:"bottom"===t.my[1]?t.elemHeight:0,f="top"===t.at[1]?t.targetHeight:"bottom"===t.at[1]?-t.targetHeight:0,m=-2*t.offset[1];0>u?(s=e.top+p+f+m+t.collisionHeight-o-a,(0>s||r(u)>s)&&(e.top+=p+f+m)):d>0&&(i=e.top-t.collisionPosition.marginTop+p+f+m-h,(i>0||d>r(i))&&(e.top+=p+f+m))}},flipfit:{left:function(){e.ui.position.flip.left.apply(this,arguments),e.ui.position.fit.left.apply(this,arguments)},top:function(){e.ui.position.flip.top.apply(this,arguments),e.ui.position.fit.top.apply(this,arguments)}}},function(){var t,i,s,n,o,r=document.getElementsByTagName("body")[0],h=document.createElement("div");t=document.createElement(r?"div":"body"),s={visibility:"hidden",width:0,height:0,border:0,margin:0,background:"none"},r&&e.extend(s,{position:"absolute",left:"-1000px",top:"-1000px"});for(o in s)t.style[o]=s[o];t.appendChild(h),i=r||document.documentElement,i.insertBefore(t,i.firstChild),h.style.cssText="position: absolute; left: 10.7432222px;",n=e(h).offset().left,a=n>10&&11>n,t.innerHTML="",i.removeChild(t)}()}(),e.ui.position,e.widget("ui.draggable",e.ui.mouse,{version:"1.11.4",widgetEventPrefix:"drag",options:{addClasses:!0,appendTo:"parent",axis:!1,connectToSortable:!1,containment:!1,cursor:"auto",cursorAt:!1,grid:!1,handle:!1,helper:"original",iframeFix:!1,opacity:!1,refreshPositions:!1,revert:!1,revertDuration:500,scope:"default",scroll:!0,scrollSensitivity:20,scrollSpeed:20,snap:!1,snapMode:"both",snapTolerance:20,stack:!1,zIndex:!1,drag:null,start:null,stop:null},_create:function(){"original"===this.options.helper&&this._setPositionRelative(),this.options.addClasses&&this.element.addClass("ui-draggable"),this.options.disabled&&this.element.addClass("ui-draggable-disabled"),this._setHandleClassName(),this._mouseInit()},_setOption:function(e,t){this._super(e,t),"handle"===e&&(this._removeHandleClassName(),this._setHandleClassName())},_destroy:function(){return(this.helper||this.element).is(".ui-draggable-dragging")?(this.destroyOnClear=!0,void 0):(this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"),this._removeHandleClassName(),this._mouseDestroy(),void 0)},_mouseCapture:function(t){var i=this.options;return this._blurActiveElement(t),this.helper||i.disabled||e(t.target).closest(".ui-resizable-handle").length>0?!1:(this.handle=this._getHandle(t),this.handle?(this._blockFrames(i.iframeFix===!0?"iframe":i.iframeFix),!0):!1)},_blockFrames:function(t){this.iframeBlocks=this.document.find(t).map(function(){var t=e(this);return e("<div>").css("position","absolute").appendTo(t.parent()).outerWidth(t.outerWidth()).outerHeight(t.outerHeight()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_blurActiveElement:function(t){var i=this.document[0];if(this.handleElement.is(t.target))try{i.activeElement&&"body"!==i.activeElement.nodeName.toLowerCase()&&e(i.activeElement).blur()}catch(s){}},_mouseStart:function(t){var i=this.options;return this.helper=this._createHelper(t),this.helper.addClass("ui-draggable-dragging"),this._cacheHelperProportions(),e.ui.ddmanager&&(e.ui.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(!0),this.offsetParent=this.helper.offsetParent(),this.hasFixedAncestor=this.helper.parents().filter(function(){return"fixed"===e(this).css("position")}).length>0,this.positionAbs=this.element.offset(),this._refreshOffsets(t),this.originalPosition=this.position=this._generatePosition(t,!1),this.originalPageX=t.pageX,this.originalPageY=t.pageY,i.cursorAt&&this._adjustOffsetFromHelper(i.cursorAt),this._setContainment(),this._trigger("start",t)===!1?(this._clear(),!1):(this._cacheHelperProportions(),e.ui.ddmanager&&!i.dropBehaviour&&e.ui.ddmanager.prepareOffsets(this,t),this._normalizeRightBottom(),this._mouseDrag(t,!0),e.ui.ddmanager&&e.ui.ddmanager.dragStart(this,t),!0)},_refreshOffsets:function(e){this.offset={top:this.positionAbs.top-this.margins.top,left:this.positionAbs.left-this.margins.left,scroll:!1,parent:this._getParentOffset(),relative:this._getRelativeOffset()},this.offset.click={left:e.pageX-this.offset.left,top:e.pageY-this.offset.top}},_mouseDrag:function(t,i){if(this.hasFixedAncestor&&(this.offset.parent=this._getParentOffset()),this.position=this._generatePosition(t,!0),this.positionAbs=this._convertPositionTo("absolute"),!i){var s=this._uiHash();if(this._trigger("drag",t,s)===!1)return this._mouseUp({}),!1;this.position=s.position}return this.helper[0].style.left=this.position.left+"px",this.helper[0].style.top=this.position.top+"px",e.ui.ddmanager&&e.ui.ddmanager.drag(this,t),!1},_mouseStop:function(t){var i=this,s=!1;return e.ui.ddmanager&&!this.options.dropBehaviour&&(s=e.ui.ddmanager.drop(this,t)),this.dropped&&(s=this.dropped,this.dropped=!1),"invalid"===this.options.revert&&!s||"valid"===this.options.revert&&s||this.options.revert===!0||e.isFunction(this.options.revert)&&this.options.revert.call(this.element,s)?e(this.helper).animate(this.originalPosition,parseInt(this.options.revertDuration,10),function(){i._trigger("stop",t)!==!1&&i._clear()}):this._trigger("stop",t)!==!1&&this._clear(),!1},_mouseUp:function(t){return this._unblockFrames(),e.ui.ddmanager&&e.ui.ddmanager.dragStop(this,t),this.handleElement.is(t.target)&&this.element.focus(),e.ui.mouse.prototype._mouseUp.call(this,t)},cancel:function(){return this.helper.is(".ui-draggable-dragging")?this._mouseUp({}):this._clear(),this},_getHandle:function(t){return this.options.handle?!!e(t.target).closest(this.element.find(this.options.handle)).length:!0},_setHandleClassName:function(){this.handleElement=this.options.handle?this.element.find(this.options.handle):this.element,this.handleElement.addClass("ui-draggable-handle")},_removeHandleClassName:function(){this.handleElement.removeClass("ui-draggable-handle")},_createHelper:function(t){var i=this.options,s=e.isFunction(i.helper),n=s?e(i.helper.apply(this.element[0],[t])):"clone"===i.helper?this.element.clone().removeAttr("id"):this.element;return n.parents("body").length||n.appendTo("parent"===i.appendTo?this.element[0].parentNode:i.appendTo),s&&n[0]===this.element[0]&&this._setPositionRelative(),n[0]===this.element[0]||/(fixed|absolute)/.test(n.css("position"))||n.css("position","absolute"),n},_setPositionRelative:function(){/^(?:r|a|f)/.test(this.element.css("position"))||(this.element[0].style.position="relative")},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),e.isArray(t)&&(t={left:+t[0],top:+t[1]||0}),"left"in t&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_isRootNode:function(e){return/(html|body)/i.test(e.tagName)||e===this.document[0]},_getParentOffset:function(){var t=this.offsetParent.offset(),i=this.document[0];return"absolute"===this.cssPosition&&this.scrollParent[0]!==i&&e.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),this._isRootNode(this.offsetParent[0])&&(t={top:0,left:0}),{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"!==this.cssPosition)return{top:0,left:0};var e=this.element.position(),t=this._isRootNode(this.scrollParent[0]);return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+(t?0:this.scrollParent.scrollTop()),left:e.left-(parseInt(this.helper.css("left"),10)||0)+(t?0:this.scrollParent.scrollLeft())}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,i,s,n=this.options,a=this.document[0];return this.relativeContainer=null,n.containment?"window"===n.containment?(this.containment=[e(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,e(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,e(window).scrollLeft()+e(window).width()-this.helperProportions.width-this.margins.left,e(window).scrollTop()+(e(window).height()||a.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],void 0):"document"===n.containment?(this.containment=[0,0,e(a).width()-this.helperProportions.width-this.margins.left,(e(a).height()||a.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top],void 0):n.containment.constructor===Array?(this.containment=n.containment,void 0):("parent"===n.containment&&(n.containment=this.helper[0].parentNode),i=e(n.containment),s=i[0],s&&(t=/(scroll|auto)/.test(i.css("overflow")),this.containment=[(parseInt(i.css("borderLeftWidth"),10)||0)+(parseInt(i.css("paddingLeft"),10)||0),(parseInt(i.css("borderTopWidth"),10)||0)+(parseInt(i.css("paddingTop"),10)||0),(t?Math.max(s.scrollWidth,s.offsetWidth):s.offsetWidth)-(parseInt(i.css("borderRightWidth"),10)||0)-(parseInt(i.css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(t?Math.max(s.scrollHeight,s.offsetHeight):s.offsetHeight)-(parseInt(i.css("borderBottomWidth"),10)||0)-(parseInt(i.css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relativeContainer=i),void 0):(this.containment=null,void 0)},_convertPositionTo:function(e,t){t||(t=this.position);var i="absolute"===e?1:-1,s=this._isRootNode(this.scrollParent[0]);return{top:t.top+this.offset.relative.top*i+this.offset.parent.top*i-("fixed"===this.cssPosition?-this.offset.scroll.top:s?0:this.offset.scroll.top)*i,left:t.left+this.offset.relative.left*i+this.offset.parent.left*i-("fixed"===this.cssPosition?-this.offset.scroll.left:s?0:this.offset.scroll.left)*i}},_generatePosition:function(e,t){var i,s,n,a,o=this.options,r=this._isRootNode(this.scrollParent[0]),h=e.pageX,l=e.pageY;return r&&this.offset.scroll||(this.offset.scroll={top:this.scrollParent.scrollTop(),left:this.scrollParent.scrollLeft()}),t&&(this.containment&&(this.relativeContainer?(s=this.relativeContainer.offset(),i=[this.containment[0]+s.left,this.containment[1]+s.top,this.containment[2]+s.left,this.containment[3]+s.top]):i=this.containment,e.pageX-this.offset.click.left<i[0]&&(h=i[0]+this.offset.click.left),e.pageY-this.offset.click.top<i[1]&&(l=i[1]+this.offset.click.top),e.pageX-this.offset.click.left>i[2]&&(h=i[2]+this.offset.click.left),e.pageY-this.offset.click.top>i[3]&&(l=i[3]+this.offset.click.top)),o.grid&&(n=o.grid[1]?this.originalPageY+Math.round((l-this.originalPageY)/o.grid[1])*o.grid[1]:this.originalPageY,l=i?n-this.offset.click.top>=i[1]||n-this.offset.click.top>i[3]?n:n-this.offset.click.top>=i[1]?n-o.grid[1]:n+o.grid[1]:n,a=o.grid[0]?this.originalPageX+Math.round((h-this.originalPageX)/o.grid[0])*o.grid[0]:this.originalPageX,h=i?a-this.offset.click.left>=i[0]||a-this.offset.click.left>i[2]?a:a-this.offset.click.left>=i[0]?a-o.grid[0]:a+o.grid[0]:a),"y"===o.axis&&(h=this.originalPageX),"x"===o.axis&&(l=this.originalPageY)),{top:l-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.offset.scroll.top:r?0:this.offset.scroll.top),left:h-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.offset.scroll.left:r?0:this.offset.scroll.left)}
},_clear:function(){this.helper.removeClass("ui-draggable-dragging"),this.helper[0]===this.element[0]||this.cancelHelperRemoval||this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1,this.destroyOnClear&&this.destroy()},_normalizeRightBottom:function(){"y"!==this.options.axis&&"auto"!==this.helper.css("right")&&(this.helper.width(this.helper.width()),this.helper.css("right","auto")),"x"!==this.options.axis&&"auto"!==this.helper.css("bottom")&&(this.helper.height(this.helper.height()),this.helper.css("bottom","auto"))},_trigger:function(t,i,s){return s=s||this._uiHash(),e.ui.plugin.call(this,t,[i,s,this],!0),/^(drag|start|stop)/.test(t)&&(this.positionAbs=this._convertPositionTo("absolute"),s.offset=this.positionAbs),e.Widget.prototype._trigger.call(this,t,i,s)},plugins:{},_uiHash:function(){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),e.ui.plugin.add("draggable","connectToSortable",{start:function(t,i,s){var n=e.extend({},i,{item:s.element});s.sortables=[],e(s.options.connectToSortable).each(function(){var i=e(this).sortable("instance");i&&!i.options.disabled&&(s.sortables.push(i),i.refreshPositions(),i._trigger("activate",t,n))})},stop:function(t,i,s){var n=e.extend({},i,{item:s.element});s.cancelHelperRemoval=!1,e.each(s.sortables,function(){var e=this;e.isOver?(e.isOver=0,s.cancelHelperRemoval=!0,e.cancelHelperRemoval=!1,e._storedCSS={position:e.placeholder.css("position"),top:e.placeholder.css("top"),left:e.placeholder.css("left")},e._mouseStop(t),e.options.helper=e.options._helper):(e.cancelHelperRemoval=!0,e._trigger("deactivate",t,n))})},drag:function(t,i,s){e.each(s.sortables,function(){var n=!1,a=this;a.positionAbs=s.positionAbs,a.helperProportions=s.helperProportions,a.offset.click=s.offset.click,a._intersectsWith(a.containerCache)&&(n=!0,e.each(s.sortables,function(){return this.positionAbs=s.positionAbs,this.helperProportions=s.helperProportions,this.offset.click=s.offset.click,this!==a&&this._intersectsWith(this.containerCache)&&e.contains(a.element[0],this.element[0])&&(n=!1),n})),n?(a.isOver||(a.isOver=1,s._parent=i.helper.parent(),a.currentItem=i.helper.appendTo(a.element).data("ui-sortable-item",!0),a.options._helper=a.options.helper,a.options.helper=function(){return i.helper[0]},t.target=a.currentItem[0],a._mouseCapture(t,!0),a._mouseStart(t,!0,!0),a.offset.click.top=s.offset.click.top,a.offset.click.left=s.offset.click.left,a.offset.parent.left-=s.offset.parent.left-a.offset.parent.left,a.offset.parent.top-=s.offset.parent.top-a.offset.parent.top,s._trigger("toSortable",t),s.dropped=a.element,e.each(s.sortables,function(){this.refreshPositions()}),s.currentItem=s.element,a.fromOutside=s),a.currentItem&&(a._mouseDrag(t),i.position=a.position)):a.isOver&&(a.isOver=0,a.cancelHelperRemoval=!0,a.options._revert=a.options.revert,a.options.revert=!1,a._trigger("out",t,a._uiHash(a)),a._mouseStop(t,!0),a.options.revert=a.options._revert,a.options.helper=a.options._helper,a.placeholder&&a.placeholder.remove(),i.helper.appendTo(s._parent),s._refreshOffsets(t),i.position=s._generatePosition(t,!0),s._trigger("fromSortable",t),s.dropped=!1,e.each(s.sortables,function(){this.refreshPositions()}))})}}),e.ui.plugin.add("draggable","cursor",{start:function(t,i,s){var n=e("body"),a=s.options;n.css("cursor")&&(a._cursor=n.css("cursor")),n.css("cursor",a.cursor)},stop:function(t,i,s){var n=s.options;n._cursor&&e("body").css("cursor",n._cursor)}}),e.ui.plugin.add("draggable","opacity",{start:function(t,i,s){var n=e(i.helper),a=s.options;n.css("opacity")&&(a._opacity=n.css("opacity")),n.css("opacity",a.opacity)},stop:function(t,i,s){var n=s.options;n._opacity&&e(i.helper).css("opacity",n._opacity)}}),e.ui.plugin.add("draggable","scroll",{start:function(e,t,i){i.scrollParentNotHidden||(i.scrollParentNotHidden=i.helper.scrollParent(!1)),i.scrollParentNotHidden[0]!==i.document[0]&&"HTML"!==i.scrollParentNotHidden[0].tagName&&(i.overflowOffset=i.scrollParentNotHidden.offset())},drag:function(t,i,s){var n=s.options,a=!1,o=s.scrollParentNotHidden[0],r=s.document[0];o!==r&&"HTML"!==o.tagName?(n.axis&&"x"===n.axis||(s.overflowOffset.top+o.offsetHeight-t.pageY<n.scrollSensitivity?o.scrollTop=a=o.scrollTop+n.scrollSpeed:t.pageY-s.overflowOffset.top<n.scrollSensitivity&&(o.scrollTop=a=o.scrollTop-n.scrollSpeed)),n.axis&&"y"===n.axis||(s.overflowOffset.left+o.offsetWidth-t.pageX<n.scrollSensitivity?o.scrollLeft=a=o.scrollLeft+n.scrollSpeed:t.pageX-s.overflowOffset.left<n.scrollSensitivity&&(o.scrollLeft=a=o.scrollLeft-n.scrollSpeed))):(n.axis&&"x"===n.axis||(t.pageY-e(r).scrollTop()<n.scrollSensitivity?a=e(r).scrollTop(e(r).scrollTop()-n.scrollSpeed):e(window).height()-(t.pageY-e(r).scrollTop())<n.scrollSensitivity&&(a=e(r).scrollTop(e(r).scrollTop()+n.scrollSpeed))),n.axis&&"y"===n.axis||(t.pageX-e(r).scrollLeft()<n.scrollSensitivity?a=e(r).scrollLeft(e(r).scrollLeft()-n.scrollSpeed):e(window).width()-(t.pageX-e(r).scrollLeft())<n.scrollSensitivity&&(a=e(r).scrollLeft(e(r).scrollLeft()+n.scrollSpeed)))),a!==!1&&e.ui.ddmanager&&!n.dropBehaviour&&e.ui.ddmanager.prepareOffsets(s,t)}}),e.ui.plugin.add("draggable","snap",{start:function(t,i,s){var n=s.options;s.snapElements=[],e(n.snap.constructor!==String?n.snap.items||":data(ui-draggable)":n.snap).each(function(){var t=e(this),i=t.offset();this!==s.element[0]&&s.snapElements.push({item:this,width:t.outerWidth(),height:t.outerHeight(),top:i.top,left:i.left})})},drag:function(t,i,s){var n,a,o,r,h,l,u,d,c,p,f=s.options,m=f.snapTolerance,g=i.offset.left,v=g+s.helperProportions.width,y=i.offset.top,b=y+s.helperProportions.height;for(c=s.snapElements.length-1;c>=0;c--)h=s.snapElements[c].left-s.margins.left,l=h+s.snapElements[c].width,u=s.snapElements[c].top-s.margins.top,d=u+s.snapElements[c].height,h-m>v||g>l+m||u-m>b||y>d+m||!e.contains(s.snapElements[c].item.ownerDocument,s.snapElements[c].item)?(s.snapElements[c].snapping&&s.options.snap.release&&s.options.snap.release.call(s.element,t,e.extend(s._uiHash(),{snapItem:s.snapElements[c].item})),s.snapElements[c].snapping=!1):("inner"!==f.snapMode&&(n=m>=Math.abs(u-b),a=m>=Math.abs(d-y),o=m>=Math.abs(h-v),r=m>=Math.abs(l-g),n&&(i.position.top=s._convertPositionTo("relative",{top:u-s.helperProportions.height,left:0}).top),a&&(i.position.top=s._convertPositionTo("relative",{top:d,left:0}).top),o&&(i.position.left=s._convertPositionTo("relative",{top:0,left:h-s.helperProportions.width}).left),r&&(i.position.left=s._convertPositionTo("relative",{top:0,left:l}).left)),p=n||a||o||r,"outer"!==f.snapMode&&(n=m>=Math.abs(u-y),a=m>=Math.abs(d-b),o=m>=Math.abs(h-g),r=m>=Math.abs(l-v),n&&(i.position.top=s._convertPositionTo("relative",{top:u,left:0}).top),a&&(i.position.top=s._convertPositionTo("relative",{top:d-s.helperProportions.height,left:0}).top),o&&(i.position.left=s._convertPositionTo("relative",{top:0,left:h}).left),r&&(i.position.left=s._convertPositionTo("relative",{top:0,left:l-s.helperProportions.width}).left)),!s.snapElements[c].snapping&&(n||a||o||r||p)&&s.options.snap.snap&&s.options.snap.snap.call(s.element,t,e.extend(s._uiHash(),{snapItem:s.snapElements[c].item})),s.snapElements[c].snapping=n||a||o||r||p)}}),e.ui.plugin.add("draggable","stack",{start:function(t,i,s){var n,a=s.options,o=e.makeArray(e(a.stack)).sort(function(t,i){return(parseInt(e(t).css("zIndex"),10)||0)-(parseInt(e(i).css("zIndex"),10)||0)});o.length&&(n=parseInt(e(o[0]).css("zIndex"),10)||0,e(o).each(function(t){e(this).css("zIndex",n+t)}),this.css("zIndex",n+o.length))}}),e.ui.plugin.add("draggable","zIndex",{start:function(t,i,s){var n=e(i.helper),a=s.options;n.css("zIndex")&&(a._zIndex=n.css("zIndex")),n.css("zIndex",a.zIndex)},stop:function(t,i,s){var n=s.options;n._zIndex&&e(i.helper).css("zIndex",n._zIndex)}}),e.ui.draggable,e.widget("ui.droppable",{version:"1.11.4",widgetEventPrefix:"drop",options:{accept:"*",activeClass:!1,addClasses:!0,greedy:!1,hoverClass:!1,scope:"default",tolerance:"intersect",activate:null,deactivate:null,drop:null,out:null,over:null},_create:function(){var t,i=this.options,s=i.accept;this.isover=!1,this.isout=!0,this.accept=e.isFunction(s)?s:function(e){return e.is(s)},this.proportions=function(){return arguments.length?(t=arguments[0],void 0):t?t:t={width:this.element[0].offsetWidth,height:this.element[0].offsetHeight}},this._addToManager(i.scope),i.addClasses&&this.element.addClass("ui-droppable")},_addToManager:function(t){e.ui.ddmanager.droppables[t]=e.ui.ddmanager.droppables[t]||[],e.ui.ddmanager.droppables[t].push(this)},_splice:function(e){for(var t=0;e.length>t;t++)e[t]===this&&e.splice(t,1)},_destroy:function(){var t=e.ui.ddmanager.droppables[this.options.scope];this._splice(t),this.element.removeClass("ui-droppable ui-droppable-disabled")},_setOption:function(t,i){if("accept"===t)this.accept=e.isFunction(i)?i:function(e){return e.is(i)};else if("scope"===t){var s=e.ui.ddmanager.droppables[this.options.scope];this._splice(s),this._addToManager(i)}this._super(t,i)},_activate:function(t){var i=e.ui.ddmanager.current;this.options.activeClass&&this.element.addClass(this.options.activeClass),i&&this._trigger("activate",t,this.ui(i))},_deactivate:function(t){var i=e.ui.ddmanager.current;this.options.activeClass&&this.element.removeClass(this.options.activeClass),i&&this._trigger("deactivate",t,this.ui(i))},_over:function(t){var i=e.ui.ddmanager.current;i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this.options.hoverClass&&this.element.addClass(this.options.hoverClass),this._trigger("over",t,this.ui(i)))},_out:function(t){var i=e.ui.ddmanager.current;i&&(i.currentItem||i.element)[0]!==this.element[0]&&this.accept.call(this.element[0],i.currentItem||i.element)&&(this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("out",t,this.ui(i)))},_drop:function(t,i){var s=i||e.ui.ddmanager.current,n=!1;return s&&(s.currentItem||s.element)[0]!==this.element[0]?(this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function(){var i=e(this).droppable("instance");return i.options.greedy&&!i.options.disabled&&i.options.scope===s.options.scope&&i.accept.call(i.element[0],s.currentItem||s.element)&&e.ui.intersect(s,e.extend(i,{offset:i.element.offset()}),i.options.tolerance,t)?(n=!0,!1):void 0}),n?!1:this.accept.call(this.element[0],s.currentItem||s.element)?(this.options.activeClass&&this.element.removeClass(this.options.activeClass),this.options.hoverClass&&this.element.removeClass(this.options.hoverClass),this._trigger("drop",t,this.ui(s)),this.element):!1):!1},ui:function(e){return{draggable:e.currentItem||e.element,helper:e.helper,position:e.position,offset:e.positionAbs}}}),e.ui.intersect=function(){function e(e,t,i){return e>=t&&t+i>e}return function(t,i,s,n){if(!i.offset)return!1;var a=(t.positionAbs||t.position.absolute).left+t.margins.left,o=(t.positionAbs||t.position.absolute).top+t.margins.top,r=a+t.helperProportions.width,h=o+t.helperProportions.height,l=i.offset.left,u=i.offset.top,d=l+i.proportions().width,c=u+i.proportions().height;switch(s){case"fit":return a>=l&&d>=r&&o>=u&&c>=h;case"intersect":return a+t.helperProportions.width/2>l&&d>r-t.helperProportions.width/2&&o+t.helperProportions.height/2>u&&c>h-t.helperProportions.height/2;case"pointer":return e(n.pageY,u,i.proportions().height)&&e(n.pageX,l,i.proportions().width);case"touch":return(o>=u&&c>=o||h>=u&&c>=h||u>o&&h>c)&&(a>=l&&d>=a||r>=l&&d>=r||l>a&&r>d);default:return!1}}}(),e.ui.ddmanager={current:null,droppables:{"default":[]},prepareOffsets:function(t,i){var s,n,a=e.ui.ddmanager.droppables[t.options.scope]||[],o=i?i.type:null,r=(t.currentItem||t.element).find(":data(ui-droppable)").addBack();e:for(s=0;a.length>s;s++)if(!(a[s].options.disabled||t&&!a[s].accept.call(a[s].element[0],t.currentItem||t.element))){for(n=0;r.length>n;n++)if(r[n]===a[s].element[0]){a[s].proportions().height=0;continue e}a[s].visible="none"!==a[s].element.css("display"),a[s].visible&&("mousedown"===o&&a[s]._activate.call(a[s],i),a[s].offset=a[s].element.offset(),a[s].proportions({width:a[s].element[0].offsetWidth,height:a[s].element[0].offsetHeight}))}},drop:function(t,i){var s=!1;return e.each((e.ui.ddmanager.droppables[t.options.scope]||[]).slice(),function(){this.options&&(!this.options.disabled&&this.visible&&e.ui.intersect(t,this,this.options.tolerance,i)&&(s=this._drop.call(this,i)||s),!this.options.disabled&&this.visible&&this.accept.call(this.element[0],t.currentItem||t.element)&&(this.isout=!0,this.isover=!1,this._deactivate.call(this,i)))}),s},dragStart:function(t,i){t.element.parentsUntil("body").bind("scroll.droppable",function(){t.options.refreshPositions||e.ui.ddmanager.prepareOffsets(t,i)})},drag:function(t,i){t.options.refreshPositions&&e.ui.ddmanager.prepareOffsets(t,i),e.each(e.ui.ddmanager.droppables[t.options.scope]||[],function(){if(!this.options.disabled&&!this.greedyChild&&this.visible){var s,n,a,o=e.ui.intersect(t,this,this.options.tolerance,i),r=!o&&this.isover?"isout":o&&!this.isover?"isover":null;r&&(this.options.greedy&&(n=this.options.scope,a=this.element.parents(":data(ui-droppable)").filter(function(){return e(this).droppable("instance").options.scope===n}),a.length&&(s=e(a[0]).droppable("instance"),s.greedyChild="isover"===r)),s&&"isover"===r&&(s.isover=!1,s.isout=!0,s._out.call(s,i)),this[r]=!0,this["isout"===r?"isover":"isout"]=!1,this["isover"===r?"_over":"_out"].call(this,i),s&&"isout"===r&&(s.isout=!1,s.isover=!0,s._over.call(s,i)))}})},dragStop:function(t,i){t.element.parentsUntil("body").unbind("scroll.droppable"),t.options.refreshPositions||e.ui.ddmanager.prepareOffsets(t,i)}},e.ui.droppable,e.widget("ui.resizable",e.ui.mouse,{version:"1.11.4",widgetEventPrefix:"resize",options:{alsoResize:!1,animate:!1,animateDuration:"slow",animateEasing:"swing",aspectRatio:!1,autoHide:!1,containment:!1,ghost:!1,grid:!1,handles:"e,s,se",helper:!1,maxHeight:null,maxWidth:null,minHeight:10,minWidth:10,zIndex:90,resize:null,start:null,stop:null},_num:function(e){return parseInt(e,10)||0},_isNumber:function(e){return!isNaN(parseInt(e,10))},_hasScroll:function(t,i){if("hidden"===e(t).css("overflow"))return!1;var s=i&&"left"===i?"scrollLeft":"scrollTop",n=!1;return t[s]>0?!0:(t[s]=1,n=t[s]>0,t[s]=0,n)},_create:function(){var t,i,s,n,a,o=this,r=this.options;if(this.element.addClass("ui-resizable"),e.extend(this,{_aspectRatio:!!r.aspectRatio,aspectRatio:r.aspectRatio,originalElement:this.element,_proportionallyResizeElements:[],_helper:r.helper||r.ghost||r.animate?r.helper||"ui-resizable-helper":null}),this.element[0].nodeName.match(/^(canvas|textarea|input|select|button|img)$/i)&&(this.element.wrap(e("<div class='ui-wrapper' style='overflow: hidden;'></div>").css({position:this.element.css("position"),width:this.element.outerWidth(),height:this.element.outerHeight(),top:this.element.css("top"),left:this.element.css("left")})),this.element=this.element.parent().data("ui-resizable",this.element.resizable("instance")),this.elementIsWrapper=!0,this.element.css({marginLeft:this.originalElement.css("marginLeft"),marginTop:this.originalElement.css("marginTop"),marginRight:this.originalElement.css("marginRight"),marginBottom:this.originalElement.css("marginBottom")}),this.originalElement.css({marginLeft:0,marginTop:0,marginRight:0,marginBottom:0}),this.originalResizeStyle=this.originalElement.css("resize"),this.originalElement.css("resize","none"),this._proportionallyResizeElements.push(this.originalElement.css({position:"static",zoom:1,display:"block"})),this.originalElement.css({margin:this.originalElement.css("margin")}),this._proportionallyResize()),this.handles=r.handles||(e(".ui-resizable-handle",this.element).length?{n:".ui-resizable-n",e:".ui-resizable-e",s:".ui-resizable-s",w:".ui-resizable-w",se:".ui-resizable-se",sw:".ui-resizable-sw",ne:".ui-resizable-ne",nw:".ui-resizable-nw"}:"e,s,se"),this._handles=e(),this.handles.constructor===String)for("all"===this.handles&&(this.handles="n,e,s,w,se,sw,ne,nw"),t=this.handles.split(","),this.handles={},i=0;t.length>i;i++)s=e.trim(t[i]),a="ui-resizable-"+s,n=e("<div class='ui-resizable-handle "+a+"'></div>"),n.css({zIndex:r.zIndex}),"se"===s&&n.addClass("ui-icon ui-icon-gripsmall-diagonal-se"),this.handles[s]=".ui-resizable-"+s,this.element.append(n);this._renderAxis=function(t){var i,s,n,a;t=t||this.element;for(i in this.handles)this.handles[i].constructor===String?this.handles[i]=this.element.children(this.handles[i]).first().show():(this.handles[i].jquery||this.handles[i].nodeType)&&(this.handles[i]=e(this.handles[i]),this._on(this.handles[i],{mousedown:o._mouseDown})),this.elementIsWrapper&&this.originalElement[0].nodeName.match(/^(textarea|input|select|button)$/i)&&(s=e(this.handles[i],this.element),a=/sw|ne|nw|se|n|s/.test(i)?s.outerHeight():s.outerWidth(),n=["padding",/ne|nw|n/.test(i)?"Top":/se|sw|s/.test(i)?"Bottom":/^e$/.test(i)?"Right":"Left"].join(""),t.css(n,a),this._proportionallyResize()),this._handles=this._handles.add(this.handles[i])},this._renderAxis(this.element),this._handles=this._handles.add(this.element.find(".ui-resizable-handle")),this._handles.disableSelection(),this._handles.mouseover(function(){o.resizing||(this.className&&(n=this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)),o.axis=n&&n[1]?n[1]:"se")}),r.autoHide&&(this._handles.hide(),e(this.element).addClass("ui-resizable-autohide").mouseenter(function(){r.disabled||(e(this).removeClass("ui-resizable-autohide"),o._handles.show())}).mouseleave(function(){r.disabled||o.resizing||(e(this).addClass("ui-resizable-autohide"),o._handles.hide())})),this._mouseInit()},_destroy:function(){this._mouseDestroy();var t,i=function(t){e(t).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove()};return this.elementIsWrapper&&(i(this.element),t=this.element,this.originalElement.css({position:t.css("position"),width:t.outerWidth(),height:t.outerHeight(),top:t.css("top"),left:t.css("left")}).insertAfter(t),t.remove()),this.originalElement.css("resize",this.originalResizeStyle),i(this.originalElement),this},_mouseCapture:function(t){var i,s,n=!1;for(i in this.handles)s=e(this.handles[i])[0],(s===t.target||e.contains(s,t.target))&&(n=!0);return!this.options.disabled&&n},_mouseStart:function(t){var i,s,n,a=this.options,o=this.element;return this.resizing=!0,this._renderProxy(),i=this._num(this.helper.css("left")),s=this._num(this.helper.css("top")),a.containment&&(i+=e(a.containment).scrollLeft()||0,s+=e(a.containment).scrollTop()||0),this.offset=this.helper.offset(),this.position={left:i,top:s},this.size=this._helper?{width:this.helper.width(),height:this.helper.height()}:{width:o.width(),height:o.height()},this.originalSize=this._helper?{width:o.outerWidth(),height:o.outerHeight()}:{width:o.width(),height:o.height()},this.sizeDiff={width:o.outerWidth()-o.width(),height:o.outerHeight()-o.height()},this.originalPosition={left:i,top:s},this.originalMousePosition={left:t.pageX,top:t.pageY},this.aspectRatio="number"==typeof a.aspectRatio?a.aspectRatio:this.originalSize.width/this.originalSize.height||1,n=e(".ui-resizable-"+this.axis).css("cursor"),e("body").css("cursor","auto"===n?this.axis+"-resize":n),o.addClass("ui-resizable-resizing"),this._propagate("start",t),!0},_mouseDrag:function(t){var i,s,n=this.originalMousePosition,a=this.axis,o=t.pageX-n.left||0,r=t.pageY-n.top||0,h=this._change[a];return this._updatePrevProperties(),h?(i=h.apply(this,[t,o,r]),this._updateVirtualBoundaries(t.shiftKey),(this._aspectRatio||t.shiftKey)&&(i=this._updateRatio(i,t)),i=this._respectSize(i,t),this._updateCache(i),this._propagate("resize",t),s=this._applyChanges(),!this._helper&&this._proportionallyResizeElements.length&&this._proportionallyResize(),e.isEmptyObject(s)||(this._updatePrevProperties(),this._trigger("resize",t,this.ui()),this._applyChanges()),!1):!1},_mouseStop:function(t){this.resizing=!1;var i,s,n,a,o,r,h,l=this.options,u=this;return this._helper&&(i=this._proportionallyResizeElements,s=i.length&&/textarea/i.test(i[0].nodeName),n=s&&this._hasScroll(i[0],"left")?0:u.sizeDiff.height,a=s?0:u.sizeDiff.width,o={width:u.helper.width()-a,height:u.helper.height()-n},r=parseInt(u.element.css("left"),10)+(u.position.left-u.originalPosition.left)||null,h=parseInt(u.element.css("top"),10)+(u.position.top-u.originalPosition.top)||null,l.animate||this.element.css(e.extend(o,{top:h,left:r})),u.helper.height(u.size.height),u.helper.width(u.size.width),this._helper&&!l.animate&&this._proportionallyResize()),e("body").css("cursor","auto"),this.element.removeClass("ui-resizable-resizing"),this._propagate("stop",t),this._helper&&this.helper.remove(),!1},_updatePrevProperties:function(){this.prevPosition={top:this.position.top,left:this.position.left},this.prevSize={width:this.size.width,height:this.size.height}},_applyChanges:function(){var e={};return this.position.top!==this.prevPosition.top&&(e.top=this.position.top+"px"),this.position.left!==this.prevPosition.left&&(e.left=this.position.left+"px"),this.size.width!==this.prevSize.width&&(e.width=this.size.width+"px"),this.size.height!==this.prevSize.height&&(e.height=this.size.height+"px"),this.helper.css(e),e},_updateVirtualBoundaries:function(e){var t,i,s,n,a,o=this.options;a={minWidth:this._isNumber(o.minWidth)?o.minWidth:0,maxWidth:this._isNumber(o.maxWidth)?o.maxWidth:1/0,minHeight:this._isNumber(o.minHeight)?o.minHeight:0,maxHeight:this._isNumber(o.maxHeight)?o.maxHeight:1/0},(this._aspectRatio||e)&&(t=a.minHeight*this.aspectRatio,s=a.minWidth/this.aspectRatio,i=a.maxHeight*this.aspectRatio,n=a.maxWidth/this.aspectRatio,t>a.minWidth&&(a.minWidth=t),s>a.minHeight&&(a.minHeight=s),a.maxWidth>i&&(a.maxWidth=i),a.maxHeight>n&&(a.maxHeight=n)),this._vBoundaries=a},_updateCache:function(e){this.offset=this.helper.offset(),this._isNumber(e.left)&&(this.position.left=e.left),this._isNumber(e.top)&&(this.position.top=e.top),this._isNumber(e.height)&&(this.size.height=e.height),this._isNumber(e.width)&&(this.size.width=e.width)},_updateRatio:function(e){var t=this.position,i=this.size,s=this.axis;return this._isNumber(e.height)?e.width=e.height*this.aspectRatio:this._isNumber(e.width)&&(e.height=e.width/this.aspectRatio),"sw"===s&&(e.left=t.left+(i.width-e.width),e.top=null),"nw"===s&&(e.top=t.top+(i.height-e.height),e.left=t.left+(i.width-e.width)),e},_respectSize:function(e){var t=this._vBoundaries,i=this.axis,s=this._isNumber(e.width)&&t.maxWidth&&t.maxWidth<e.width,n=this._isNumber(e.height)&&t.maxHeight&&t.maxHeight<e.height,a=this._isNumber(e.width)&&t.minWidth&&t.minWidth>e.width,o=this._isNumber(e.height)&&t.minHeight&&t.minHeight>e.height,r=this.originalPosition.left+this.originalSize.width,h=this.position.top+this.size.height,l=/sw|nw|w/.test(i),u=/nw|ne|n/.test(i);return a&&(e.width=t.minWidth),o&&(e.height=t.minHeight),s&&(e.width=t.maxWidth),n&&(e.height=t.maxHeight),a&&l&&(e.left=r-t.minWidth),s&&l&&(e.left=r-t.maxWidth),o&&u&&(e.top=h-t.minHeight),n&&u&&(e.top=h-t.maxHeight),e.width||e.height||e.left||!e.top?e.width||e.height||e.top||!e.left||(e.left=null):e.top=null,e},_getPaddingPlusBorderDimensions:function(e){for(var t=0,i=[],s=[e.css("borderTopWidth"),e.css("borderRightWidth"),e.css("borderBottomWidth"),e.css("borderLeftWidth")],n=[e.css("paddingTop"),e.css("paddingRight"),e.css("paddingBottom"),e.css("paddingLeft")];4>t;t++)i[t]=parseInt(s[t],10)||0,i[t]+=parseInt(n[t],10)||0;return{height:i[0]+i[2],width:i[1]+i[3]}},_proportionallyResize:function(){if(this._proportionallyResizeElements.length)for(var e,t=0,i=this.helper||this.element;this._proportionallyResizeElements.length>t;t++)e=this._proportionallyResizeElements[t],this.outerDimensions||(this.outerDimensions=this._getPaddingPlusBorderDimensions(e)),e.css({height:i.height()-this.outerDimensions.height||0,width:i.width()-this.outerDimensions.width||0})},_renderProxy:function(){var t=this.element,i=this.options;this.elementOffset=t.offset(),this._helper?(this.helper=this.helper||e("<div style='overflow:hidden;'></div>"),this.helper.addClass(this._helper).css({width:this.element.outerWidth()-1,height:this.element.outerHeight()-1,position:"absolute",left:this.elementOffset.left+"px",top:this.elementOffset.top+"px",zIndex:++i.zIndex}),this.helper.appendTo("body").disableSelection()):this.helper=this.element},_change:{e:function(e,t){return{width:this.originalSize.width+t}},w:function(e,t){var i=this.originalSize,s=this.originalPosition;return{left:s.left+t,width:i.width-t}},n:function(e,t,i){var s=this.originalSize,n=this.originalPosition;return{top:n.top+i,height:s.height-i}},s:function(e,t,i){return{height:this.originalSize.height+i}},se:function(t,i,s){return e.extend(this._change.s.apply(this,arguments),this._change.e.apply(this,[t,i,s]))},sw:function(t,i,s){return e.extend(this._change.s.apply(this,arguments),this._change.w.apply(this,[t,i,s]))},ne:function(t,i,s){return e.extend(this._change.n.apply(this,arguments),this._change.e.apply(this,[t,i,s]))},nw:function(t,i,s){return e.extend(this._change.n.apply(this,arguments),this._change.w.apply(this,[t,i,s]))}},_propagate:function(t,i){e.ui.plugin.call(this,t,[i,this.ui()]),"resize"!==t&&this._trigger(t,i,this.ui())},plugins:{},ui:function(){return{originalElement:this.originalElement,element:this.element,helper:this.helper,position:this.position,size:this.size,originalSize:this.originalSize,originalPosition:this.originalPosition}}}),e.ui.plugin.add("resizable","animate",{stop:function(t){var i=e(this).resizable("instance"),s=i.options,n=i._proportionallyResizeElements,a=n.length&&/textarea/i.test(n[0].nodeName),o=a&&i._hasScroll(n[0],"left")?0:i.sizeDiff.height,r=a?0:i.sizeDiff.width,h={width:i.size.width-r,height:i.size.height-o},l=parseInt(i.element.css("left"),10)+(i.position.left-i.originalPosition.left)||null,u=parseInt(i.element.css("top"),10)+(i.position.top-i.originalPosition.top)||null;i.element.animate(e.extend(h,u&&l?{top:u,left:l}:{}),{duration:s.animateDuration,easing:s.animateEasing,step:function(){var s={width:parseInt(i.element.css("width"),10),height:parseInt(i.element.css("height"),10),top:parseInt(i.element.css("top"),10),left:parseInt(i.element.css("left"),10)};n&&n.length&&e(n[0]).css({width:s.width,height:s.height}),i._updateCache(s),i._propagate("resize",t)}})}}),e.ui.plugin.add("resizable","containment",{start:function(){var t,i,s,n,a,o,r,h=e(this).resizable("instance"),l=h.options,u=h.element,d=l.containment,c=d instanceof e?d.get(0):/parent/.test(d)?u.parent().get(0):d;c&&(h.containerElement=e(c),/document/.test(d)||d===document?(h.containerOffset={left:0,top:0},h.containerPosition={left:0,top:0},h.parentData={element:e(document),left:0,top:0,width:e(document).width(),height:e(document).height()||document.body.parentNode.scrollHeight}):(t=e(c),i=[],e(["Top","Right","Left","Bottom"]).each(function(e,s){i[e]=h._num(t.css("padding"+s))}),h.containerOffset=t.offset(),h.containerPosition=t.position(),h.containerSize={height:t.innerHeight()-i[3],width:t.innerWidth()-i[1]},s=h.containerOffset,n=h.containerSize.height,a=h.containerSize.width,o=h._hasScroll(c,"left")?c.scrollWidth:a,r=h._hasScroll(c)?c.scrollHeight:n,h.parentData={element:c,left:s.left,top:s.top,width:o,height:r}))},resize:function(t){var i,s,n,a,o=e(this).resizable("instance"),r=o.options,h=o.containerOffset,l=o.position,u=o._aspectRatio||t.shiftKey,d={top:0,left:0},c=o.containerElement,p=!0;c[0]!==document&&/static/.test(c.css("position"))&&(d=h),l.left<(o._helper?h.left:0)&&(o.size.width=o.size.width+(o._helper?o.position.left-h.left:o.position.left-d.left),u&&(o.size.height=o.size.width/o.aspectRatio,p=!1),o.position.left=r.helper?h.left:0),l.top<(o._helper?h.top:0)&&(o.size.height=o.size.height+(o._helper?o.position.top-h.top:o.position.top),u&&(o.size.width=o.size.height*o.aspectRatio,p=!1),o.position.top=o._helper?h.top:0),n=o.containerElement.get(0)===o.element.parent().get(0),a=/relative|absolute/.test(o.containerElement.css("position")),n&&a?(o.offset.left=o.parentData.left+o.position.left,o.offset.top=o.parentData.top+o.position.top):(o.offset.left=o.element.offset().left,o.offset.top=o.element.offset().top),i=Math.abs(o.sizeDiff.width+(o._helper?o.offset.left-d.left:o.offset.left-h.left)),s=Math.abs(o.sizeDiff.height+(o._helper?o.offset.top-d.top:o.offset.top-h.top)),i+o.size.width>=o.parentData.width&&(o.size.width=o.parentData.width-i,u&&(o.size.height=o.size.width/o.aspectRatio,p=!1)),s+o.size.height>=o.parentData.height&&(o.size.height=o.parentData.height-s,u&&(o.size.width=o.size.height*o.aspectRatio,p=!1)),p||(o.position.left=o.prevPosition.left,o.position.top=o.prevPosition.top,o.size.width=o.prevSize.width,o.size.height=o.prevSize.height)},stop:function(){var t=e(this).resizable("instance"),i=t.options,s=t.containerOffset,n=t.containerPosition,a=t.containerElement,o=e(t.helper),r=o.offset(),h=o.outerWidth()-t.sizeDiff.width,l=o.outerHeight()-t.sizeDiff.height;t._helper&&!i.animate&&/relative/.test(a.css("position"))&&e(this).css({left:r.left-n.left-s.left,width:h,height:l}),t._helper&&!i.animate&&/static/.test(a.css("position"))&&e(this).css({left:r.left-n.left-s.left,width:h,height:l})}}),e.ui.plugin.add("resizable","alsoResize",{start:function(){var t=e(this).resizable("instance"),i=t.options;e(i.alsoResize).each(function(){var t=e(this);t.data("ui-resizable-alsoresize",{width:parseInt(t.width(),10),height:parseInt(t.height(),10),left:parseInt(t.css("left"),10),top:parseInt(t.css("top"),10)})})},resize:function(t,i){var s=e(this).resizable("instance"),n=s.options,a=s.originalSize,o=s.originalPosition,r={height:s.size.height-a.height||0,width:s.size.width-a.width||0,top:s.position.top-o.top||0,left:s.position.left-o.left||0};e(n.alsoResize).each(function(){var t=e(this),s=e(this).data("ui-resizable-alsoresize"),n={},a=t.parents(i.originalElement[0]).length?["width","height"]:["width","height","top","left"];e.each(a,function(e,t){var i=(s[t]||0)+(r[t]||0);i&&i>=0&&(n[t]=i||null)}),t.css(n)})},stop:function(){e(this).removeData("resizable-alsoresize")}}),e.ui.plugin.add("resizable","ghost",{start:function(){var t=e(this).resizable("instance"),i=t.options,s=t.size;t.ghost=t.originalElement.clone(),t.ghost.css({opacity:.25,display:"block",position:"relative",height:s.height,width:s.width,margin:0,left:0,top:0}).addClass("ui-resizable-ghost").addClass("string"==typeof i.ghost?i.ghost:""),t.ghost.appendTo(t.helper)},resize:function(){var t=e(this).resizable("instance");t.ghost&&t.ghost.css({position:"relative",height:t.size.height,width:t.size.width})},stop:function(){var t=e(this).resizable("instance");t.ghost&&t.helper&&t.helper.get(0).removeChild(t.ghost.get(0))}}),e.ui.plugin.add("resizable","grid",{resize:function(){var t,i=e(this).resizable("instance"),s=i.options,n=i.size,a=i.originalSize,o=i.originalPosition,r=i.axis,h="number"==typeof s.grid?[s.grid,s.grid]:s.grid,l=h[0]||1,u=h[1]||1,d=Math.round((n.width-a.width)/l)*l,c=Math.round((n.height-a.height)/u)*u,p=a.width+d,f=a.height+c,m=s.maxWidth&&p>s.maxWidth,g=s.maxHeight&&f>s.maxHeight,v=s.minWidth&&s.minWidth>p,y=s.minHeight&&s.minHeight>f;s.grid=h,v&&(p+=l),y&&(f+=u),m&&(p-=l),g&&(f-=u),/^(se|s|e)$/.test(r)?(i.size.width=p,i.size.height=f):/^(ne)$/.test(r)?(i.size.width=p,i.size.height=f,i.position.top=o.top-c):/^(sw)$/.test(r)?(i.size.width=p,i.size.height=f,i.position.left=o.left-d):((0>=f-u||0>=p-l)&&(t=i._getPaddingPlusBorderDimensions(this)),f-u>0?(i.size.height=f,i.position.top=o.top-c):(f=u-t.height,i.size.height=f,i.position.top=o.top+a.height-f),p-l>0?(i.size.width=p,i.position.left=o.left-d):(p=l-t.width,i.size.width=p,i.position.left=o.left+a.width-p))}}),e.ui.resizable,e.widget("ui.selectable",e.ui.mouse,{version:"1.11.4",options:{appendTo:"body",autoRefresh:!0,distance:0,filter:"*",tolerance:"touch",selected:null,selecting:null,start:null,stop:null,unselected:null,unselecting:null},_create:function(){var t,i=this;
this.element.addClass("ui-selectable"),this.dragged=!1,this.refresh=function(){t=e(i.options.filter,i.element[0]),t.addClass("ui-selectee"),t.each(function(){var t=e(this),i=t.offset();e.data(this,"selectable-item",{element:this,$element:t,left:i.left,top:i.top,right:i.left+t.outerWidth(),bottom:i.top+t.outerHeight(),startselected:!1,selected:t.hasClass("ui-selected"),selecting:t.hasClass("ui-selecting"),unselecting:t.hasClass("ui-unselecting")})})},this.refresh(),this.selectees=t.addClass("ui-selectee"),this._mouseInit(),this.helper=e("<div class='ui-selectable-helper'></div>")},_destroy:function(){this.selectees.removeClass("ui-selectee").removeData("selectable-item"),this.element.removeClass("ui-selectable ui-selectable-disabled"),this._mouseDestroy()},_mouseStart:function(t){var i=this,s=this.options;this.opos=[t.pageX,t.pageY],this.options.disabled||(this.selectees=e(s.filter,this.element[0]),this._trigger("start",t),e(s.appendTo).append(this.helper),this.helper.css({left:t.pageX,top:t.pageY,width:0,height:0}),s.autoRefresh&&this.refresh(),this.selectees.filter(".ui-selected").each(function(){var s=e.data(this,"selectable-item");s.startselected=!0,t.metaKey||t.ctrlKey||(s.$element.removeClass("ui-selected"),s.selected=!1,s.$element.addClass("ui-unselecting"),s.unselecting=!0,i._trigger("unselecting",t,{unselecting:s.element}))}),e(t.target).parents().addBack().each(function(){var s,n=e.data(this,"selectable-item");return n?(s=!t.metaKey&&!t.ctrlKey||!n.$element.hasClass("ui-selected"),n.$element.removeClass(s?"ui-unselecting":"ui-selected").addClass(s?"ui-selecting":"ui-unselecting"),n.unselecting=!s,n.selecting=s,n.selected=s,s?i._trigger("selecting",t,{selecting:n.element}):i._trigger("unselecting",t,{unselecting:n.element}),!1):void 0}))},_mouseDrag:function(t){if(this.dragged=!0,!this.options.disabled){var i,s=this,n=this.options,a=this.opos[0],o=this.opos[1],r=t.pageX,h=t.pageY;return a>r&&(i=r,r=a,a=i),o>h&&(i=h,h=o,o=i),this.helper.css({left:a,top:o,width:r-a,height:h-o}),this.selectees.each(function(){var i=e.data(this,"selectable-item"),l=!1;i&&i.element!==s.element[0]&&("touch"===n.tolerance?l=!(i.left>r||a>i.right||i.top>h||o>i.bottom):"fit"===n.tolerance&&(l=i.left>a&&r>i.right&&i.top>o&&h>i.bottom),l?(i.selected&&(i.$element.removeClass("ui-selected"),i.selected=!1),i.unselecting&&(i.$element.removeClass("ui-unselecting"),i.unselecting=!1),i.selecting||(i.$element.addClass("ui-selecting"),i.selecting=!0,s._trigger("selecting",t,{selecting:i.element}))):(i.selecting&&((t.metaKey||t.ctrlKey)&&i.startselected?(i.$element.removeClass("ui-selecting"),i.selecting=!1,i.$element.addClass("ui-selected"),i.selected=!0):(i.$element.removeClass("ui-selecting"),i.selecting=!1,i.startselected&&(i.$element.addClass("ui-unselecting"),i.unselecting=!0),s._trigger("unselecting",t,{unselecting:i.element}))),i.selected&&(t.metaKey||t.ctrlKey||i.startselected||(i.$element.removeClass("ui-selected"),i.selected=!1,i.$element.addClass("ui-unselecting"),i.unselecting=!0,s._trigger("unselecting",t,{unselecting:i.element})))))}),!1}},_mouseStop:function(t){var i=this;return this.dragged=!1,e(".ui-unselecting",this.element[0]).each(function(){var s=e.data(this,"selectable-item");s.$element.removeClass("ui-unselecting"),s.unselecting=!1,s.startselected=!1,i._trigger("unselected",t,{unselected:s.element})}),e(".ui-selecting",this.element[0]).each(function(){var s=e.data(this,"selectable-item");s.$element.removeClass("ui-selecting").addClass("ui-selected"),s.selecting=!1,s.selected=!0,s.startselected=!0,i._trigger("selected",t,{selected:s.element})}),this._trigger("stop",t),this.helper.remove(),!1}}),e.widget("ui.sortable",e.ui.mouse,{version:"1.11.4",widgetEventPrefix:"sort",ready:!1,options:{appendTo:"parent",axis:!1,connectWith:!1,containment:!1,cursor:"auto",cursorAt:!1,dropOnEmpty:!0,forcePlaceholderSize:!1,forceHelperSize:!1,grid:!1,handle:!1,helper:"original",items:"> *",opacity:!1,placeholder:!1,revert:!1,scroll:!0,scrollSensitivity:20,scrollSpeed:20,scope:"default",tolerance:"intersect",zIndex:1e3,activate:null,beforeStop:null,change:null,deactivate:null,out:null,over:null,receive:null,remove:null,sort:null,start:null,stop:null,update:null},_isOverAxis:function(e,t,i){return e>=t&&t+i>e},_isFloating:function(e){return/left|right/.test(e.css("float"))||/inline|table-cell/.test(e.css("display"))},_create:function(){this.containerCache={},this.element.addClass("ui-sortable"),this.refresh(),this.offset=this.element.offset(),this._mouseInit(),this._setHandleClassName(),this.ready=!0},_setOption:function(e,t){this._super(e,t),"handle"===e&&this._setHandleClassName()},_setHandleClassName:function(){this.element.find(".ui-sortable-handle").removeClass("ui-sortable-handle"),e.each(this.items,function(){(this.instance.options.handle?this.item.find(this.instance.options.handle):this.item).addClass("ui-sortable-handle")})},_destroy:function(){this.element.removeClass("ui-sortable ui-sortable-disabled").find(".ui-sortable-handle").removeClass("ui-sortable-handle"),this._mouseDestroy();for(var e=this.items.length-1;e>=0;e--)this.items[e].item.removeData(this.widgetName+"-item");return this},_mouseCapture:function(t,i){var s=null,n=!1,a=this;return this.reverting?!1:this.options.disabled||"static"===this.options.type?!1:(this._refreshItems(t),e(t.target).parents().each(function(){return e.data(this,a.widgetName+"-item")===a?(s=e(this),!1):void 0}),e.data(t.target,a.widgetName+"-item")===a&&(s=e(t.target)),s?!this.options.handle||i||(e(this.options.handle,s).find("*").addBack().each(function(){this===t.target&&(n=!0)}),n)?(this.currentItem=s,this._removeCurrentsFromItems(),!0):!1:!1)},_mouseStart:function(t,i,s){var n,a,o=this.options;if(this.currentContainer=this,this.refreshPositions(),this.helper=this._createHelper(t),this._cacheHelperProportions(),this._cacheMargins(),this.scrollParent=this.helper.scrollParent(),this.offset=this.currentItem.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},e.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.helper.css("position","absolute"),this.cssPosition=this.helper.css("position"),this.originalPosition=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,o.cursorAt&&this._adjustOffsetFromHelper(o.cursorAt),this.domPosition={prev:this.currentItem.prev()[0],parent:this.currentItem.parent()[0]},this.helper[0]!==this.currentItem[0]&&this.currentItem.hide(),this._createPlaceholder(),o.containment&&this._setContainment(),o.cursor&&"auto"!==o.cursor&&(a=this.document.find("body"),this.storedCursor=a.css("cursor"),a.css("cursor",o.cursor),this.storedStylesheet=e("<style>*{ cursor: "+o.cursor+" !important; }</style>").appendTo(a)),o.opacity&&(this.helper.css("opacity")&&(this._storedOpacity=this.helper.css("opacity")),this.helper.css("opacity",o.opacity)),o.zIndex&&(this.helper.css("zIndex")&&(this._storedZIndex=this.helper.css("zIndex")),this.helper.css("zIndex",o.zIndex)),this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName&&(this.overflowOffset=this.scrollParent.offset()),this._trigger("start",t,this._uiHash()),this._preserveHelperProportions||this._cacheHelperProportions(),!s)for(n=this.containers.length-1;n>=0;n--)this.containers[n]._trigger("activate",t,this._uiHash(this));return e.ui.ddmanager&&(e.ui.ddmanager.current=this),e.ui.ddmanager&&!o.dropBehaviour&&e.ui.ddmanager.prepareOffsets(this,t),this.dragging=!0,this.helper.addClass("ui-sortable-helper"),this._mouseDrag(t),!0},_mouseDrag:function(t){var i,s,n,a,o=this.options,r=!1;for(this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute"),this.lastPositionAbs||(this.lastPositionAbs=this.positionAbs),this.options.scroll&&(this.scrollParent[0]!==this.document[0]&&"HTML"!==this.scrollParent[0].tagName?(this.overflowOffset.top+this.scrollParent[0].offsetHeight-t.pageY<o.scrollSensitivity?this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop+o.scrollSpeed:t.pageY-this.overflowOffset.top<o.scrollSensitivity&&(this.scrollParent[0].scrollTop=r=this.scrollParent[0].scrollTop-o.scrollSpeed),this.overflowOffset.left+this.scrollParent[0].offsetWidth-t.pageX<o.scrollSensitivity?this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft+o.scrollSpeed:t.pageX-this.overflowOffset.left<o.scrollSensitivity&&(this.scrollParent[0].scrollLeft=r=this.scrollParent[0].scrollLeft-o.scrollSpeed)):(t.pageY-this.document.scrollTop()<o.scrollSensitivity?r=this.document.scrollTop(this.document.scrollTop()-o.scrollSpeed):this.window.height()-(t.pageY-this.document.scrollTop())<o.scrollSensitivity&&(r=this.document.scrollTop(this.document.scrollTop()+o.scrollSpeed)),t.pageX-this.document.scrollLeft()<o.scrollSensitivity?r=this.document.scrollLeft(this.document.scrollLeft()-o.scrollSpeed):this.window.width()-(t.pageX-this.document.scrollLeft())<o.scrollSensitivity&&(r=this.document.scrollLeft(this.document.scrollLeft()+o.scrollSpeed))),r!==!1&&e.ui.ddmanager&&!o.dropBehaviour&&e.ui.ddmanager.prepareOffsets(this,t)),this.positionAbs=this._convertPositionTo("absolute"),this.options.axis&&"y"===this.options.axis||(this.helper[0].style.left=this.position.left+"px"),this.options.axis&&"x"===this.options.axis||(this.helper[0].style.top=this.position.top+"px"),i=this.items.length-1;i>=0;i--)if(s=this.items[i],n=s.item[0],a=this._intersectsWithPointer(s),a&&s.instance===this.currentContainer&&n!==this.currentItem[0]&&this.placeholder[1===a?"next":"prev"]()[0]!==n&&!e.contains(this.placeholder[0],n)&&("semi-dynamic"===this.options.type?!e.contains(this.element[0],n):!0)){if(this.direction=1===a?"down":"up","pointer"!==this.options.tolerance&&!this._intersectsWithSides(s))break;this._rearrange(t,s),this._trigger("change",t,this._uiHash());break}return this._contactContainers(t),e.ui.ddmanager&&e.ui.ddmanager.drag(this,t),this._trigger("sort",t,this._uiHash()),this.lastPositionAbs=this.positionAbs,!1},_mouseStop:function(t,i){if(t){if(e.ui.ddmanager&&!this.options.dropBehaviour&&e.ui.ddmanager.drop(this,t),this.options.revert){var s=this,n=this.placeholder.offset(),a=this.options.axis,o={};a&&"x"!==a||(o.left=n.left-this.offset.parent.left-this.margins.left+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollLeft)),a&&"y"!==a||(o.top=n.top-this.offset.parent.top-this.margins.top+(this.offsetParent[0]===this.document[0].body?0:this.offsetParent[0].scrollTop)),this.reverting=!0,e(this.helper).animate(o,parseInt(this.options.revert,10)||500,function(){s._clear(t)})}else this._clear(t,i);return!1}},cancel:function(){if(this.dragging){this._mouseUp({target:null}),"original"===this.options.helper?this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper"):this.currentItem.show();for(var t=this.containers.length-1;t>=0;t--)this.containers[t]._trigger("deactivate",null,this._uiHash(this)),this.containers[t].containerCache.over&&(this.containers[t]._trigger("out",null,this._uiHash(this)),this.containers[t].containerCache.over=0)}return this.placeholder&&(this.placeholder[0].parentNode&&this.placeholder[0].parentNode.removeChild(this.placeholder[0]),"original"!==this.options.helper&&this.helper&&this.helper[0].parentNode&&this.helper.remove(),e.extend(this,{helper:null,dragging:!1,reverting:!1,_noFinalSort:null}),this.domPosition.prev?e(this.domPosition.prev).after(this.currentItem):e(this.domPosition.parent).prepend(this.currentItem)),this},serialize:function(t){var i=this._getItemsAsjQuery(t&&t.connected),s=[];return t=t||{},e(i).each(function(){var i=(e(t.item||this).attr(t.attribute||"id")||"").match(t.expression||/(.+)[\-=_](.+)/);i&&s.push((t.key||i[1]+"[]")+"="+(t.key&&t.expression?i[1]:i[2]))}),!s.length&&t.key&&s.push(t.key+"="),s.join("&")},toArray:function(t){var i=this._getItemsAsjQuery(t&&t.connected),s=[];return t=t||{},i.each(function(){s.push(e(t.item||this).attr(t.attribute||"id")||"")}),s},_intersectsWith:function(e){var t=this.positionAbs.left,i=t+this.helperProportions.width,s=this.positionAbs.top,n=s+this.helperProportions.height,a=e.left,o=a+e.width,r=e.top,h=r+e.height,l=this.offset.click.top,u=this.offset.click.left,d="x"===this.options.axis||s+l>r&&h>s+l,c="y"===this.options.axis||t+u>a&&o>t+u,p=d&&c;return"pointer"===this.options.tolerance||this.options.forcePointerForContainers||"pointer"!==this.options.tolerance&&this.helperProportions[this.floating?"width":"height"]>e[this.floating?"width":"height"]?p:t+this.helperProportions.width/2>a&&o>i-this.helperProportions.width/2&&s+this.helperProportions.height/2>r&&h>n-this.helperProportions.height/2},_intersectsWithPointer:function(e){var t="x"===this.options.axis||this._isOverAxis(this.positionAbs.top+this.offset.click.top,e.top,e.height),i="y"===this.options.axis||this._isOverAxis(this.positionAbs.left+this.offset.click.left,e.left,e.width),s=t&&i,n=this._getDragVerticalDirection(),a=this._getDragHorizontalDirection();return s?this.floating?a&&"right"===a||"down"===n?2:1:n&&("down"===n?2:1):!1},_intersectsWithSides:function(e){var t=this._isOverAxis(this.positionAbs.top+this.offset.click.top,e.top+e.height/2,e.height),i=this._isOverAxis(this.positionAbs.left+this.offset.click.left,e.left+e.width/2,e.width),s=this._getDragVerticalDirection(),n=this._getDragHorizontalDirection();return this.floating&&n?"right"===n&&i||"left"===n&&!i:s&&("down"===s&&t||"up"===s&&!t)},_getDragVerticalDirection:function(){var e=this.positionAbs.top-this.lastPositionAbs.top;return 0!==e&&(e>0?"down":"up")},_getDragHorizontalDirection:function(){var e=this.positionAbs.left-this.lastPositionAbs.left;return 0!==e&&(e>0?"right":"left")},refresh:function(e){return this._refreshItems(e),this._setHandleClassName(),this.refreshPositions(),this},_connectWith:function(){var e=this.options;return e.connectWith.constructor===String?[e.connectWith]:e.connectWith},_getItemsAsjQuery:function(t){function i(){r.push(this)}var s,n,a,o,r=[],h=[],l=this._connectWith();if(l&&t)for(s=l.length-1;s>=0;s--)for(a=e(l[s],this.document[0]),n=a.length-1;n>=0;n--)o=e.data(a[n],this.widgetFullName),o&&o!==this&&!o.options.disabled&&h.push([e.isFunction(o.options.items)?o.options.items.call(o.element):e(o.options.items,o.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),o]);for(h.push([e.isFunction(this.options.items)?this.options.items.call(this.element,null,{options:this.options,item:this.currentItem}):e(this.options.items,this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"),this]),s=h.length-1;s>=0;s--)h[s][0].each(i);return e(r)},_removeCurrentsFromItems:function(){var t=this.currentItem.find(":data("+this.widgetName+"-item)");this.items=e.grep(this.items,function(e){for(var i=0;t.length>i;i++)if(t[i]===e.item[0])return!1;return!0})},_refreshItems:function(t){this.items=[],this.containers=[this];var i,s,n,a,o,r,h,l,u=this.items,d=[[e.isFunction(this.options.items)?this.options.items.call(this.element[0],t,{item:this.currentItem}):e(this.options.items,this.element),this]],c=this._connectWith();if(c&&this.ready)for(i=c.length-1;i>=0;i--)for(n=e(c[i],this.document[0]),s=n.length-1;s>=0;s--)a=e.data(n[s],this.widgetFullName),a&&a!==this&&!a.options.disabled&&(d.push([e.isFunction(a.options.items)?a.options.items.call(a.element[0],t,{item:this.currentItem}):e(a.options.items,a.element),a]),this.containers.push(a));for(i=d.length-1;i>=0;i--)for(o=d[i][1],r=d[i][0],s=0,l=r.length;l>s;s++)h=e(r[s]),h.data(this.widgetName+"-item",o),u.push({item:h,instance:o,width:0,height:0,left:0,top:0})},refreshPositions:function(t){this.floating=this.items.length?"x"===this.options.axis||this._isFloating(this.items[0].item):!1,this.offsetParent&&this.helper&&(this.offset.parent=this._getParentOffset());var i,s,n,a;for(i=this.items.length-1;i>=0;i--)s=this.items[i],s.instance!==this.currentContainer&&this.currentContainer&&s.item[0]!==this.currentItem[0]||(n=this.options.toleranceElement?e(this.options.toleranceElement,s.item):s.item,t||(s.width=n.outerWidth(),s.height=n.outerHeight()),a=n.offset(),s.left=a.left,s.top=a.top);if(this.options.custom&&this.options.custom.refreshContainers)this.options.custom.refreshContainers.call(this);else for(i=this.containers.length-1;i>=0;i--)a=this.containers[i].element.offset(),this.containers[i].containerCache.left=a.left,this.containers[i].containerCache.top=a.top,this.containers[i].containerCache.width=this.containers[i].element.outerWidth(),this.containers[i].containerCache.height=this.containers[i].element.outerHeight();return this},_createPlaceholder:function(t){t=t||this;var i,s=t.options;s.placeholder&&s.placeholder.constructor!==String||(i=s.placeholder,s.placeholder={element:function(){var s=t.currentItem[0].nodeName.toLowerCase(),n=e("<"+s+">",t.document[0]).addClass(i||t.currentItem[0].className+" ui-sortable-placeholder").removeClass("ui-sortable-helper");return"tbody"===s?t._createTrPlaceholder(t.currentItem.find("tr").eq(0),e("<tr>",t.document[0]).appendTo(n)):"tr"===s?t._createTrPlaceholder(t.currentItem,n):"img"===s&&n.attr("src",t.currentItem.attr("src")),i||n.css("visibility","hidden"),n},update:function(e,n){(!i||s.forcePlaceholderSize)&&(n.height()||n.height(t.currentItem.innerHeight()-parseInt(t.currentItem.css("paddingTop")||0,10)-parseInt(t.currentItem.css("paddingBottom")||0,10)),n.width()||n.width(t.currentItem.innerWidth()-parseInt(t.currentItem.css("paddingLeft")||0,10)-parseInt(t.currentItem.css("paddingRight")||0,10)))}}),t.placeholder=e(s.placeholder.element.call(t.element,t.currentItem)),t.currentItem.after(t.placeholder),s.placeholder.update(t,t.placeholder)},_createTrPlaceholder:function(t,i){var s=this;t.children().each(function(){e("<td>&#160;</td>",s.document[0]).attr("colspan",e(this).attr("colspan")||1).appendTo(i)})},_contactContainers:function(t){var i,s,n,a,o,r,h,l,u,d,c=null,p=null;for(i=this.containers.length-1;i>=0;i--)if(!e.contains(this.currentItem[0],this.containers[i].element[0]))if(this._intersectsWith(this.containers[i].containerCache)){if(c&&e.contains(this.containers[i].element[0],c.element[0]))continue;c=this.containers[i],p=i}else this.containers[i].containerCache.over&&(this.containers[i]._trigger("out",t,this._uiHash(this)),this.containers[i].containerCache.over=0);if(c)if(1===this.containers.length)this.containers[p].containerCache.over||(this.containers[p]._trigger("over",t,this._uiHash(this)),this.containers[p].containerCache.over=1);else{for(n=1e4,a=null,u=c.floating||this._isFloating(this.currentItem),o=u?"left":"top",r=u?"width":"height",d=u?"clientX":"clientY",s=this.items.length-1;s>=0;s--)e.contains(this.containers[p].element[0],this.items[s].item[0])&&this.items[s].item[0]!==this.currentItem[0]&&(h=this.items[s].item.offset()[o],l=!1,t[d]-h>this.items[s][r]/2&&(l=!0),n>Math.abs(t[d]-h)&&(n=Math.abs(t[d]-h),a=this.items[s],this.direction=l?"up":"down"));if(!a&&!this.options.dropOnEmpty)return;if(this.currentContainer===this.containers[p])return this.currentContainer.containerCache.over||(this.containers[p]._trigger("over",t,this._uiHash()),this.currentContainer.containerCache.over=1),void 0;a?this._rearrange(t,a,null,!0):this._rearrange(t,null,this.containers[p].element,!0),this._trigger("change",t,this._uiHash()),this.containers[p]._trigger("change",t,this._uiHash(this)),this.currentContainer=this.containers[p],this.options.placeholder.update(this.currentContainer,this.placeholder),this.containers[p]._trigger("over",t,this._uiHash(this)),this.containers[p].containerCache.over=1}},_createHelper:function(t){var i=this.options,s=e.isFunction(i.helper)?e(i.helper.apply(this.element[0],[t,this.currentItem])):"clone"===i.helper?this.currentItem.clone():this.currentItem;return s.parents("body").length||e("parent"!==i.appendTo?i.appendTo:this.currentItem[0].parentNode)[0].appendChild(s[0]),s[0]===this.currentItem[0]&&(this._storedCSS={width:this.currentItem[0].style.width,height:this.currentItem[0].style.height,position:this.currentItem.css("position"),top:this.currentItem.css("top"),left:this.currentItem.css("left")}),(!s[0].style.width||i.forceHelperSize)&&s.width(this.currentItem.width()),(!s[0].style.height||i.forceHelperSize)&&s.height(this.currentItem.height()),s},_adjustOffsetFromHelper:function(t){"string"==typeof t&&(t=t.split(" ")),e.isArray(t)&&(t={left:+t[0],top:+t[1]||0}),"left"in t&&(this.offset.click.left=t.left+this.margins.left),"right"in t&&(this.offset.click.left=this.helperProportions.width-t.right+this.margins.left),"top"in t&&(this.offset.click.top=t.top+this.margins.top),"bottom"in t&&(this.offset.click.top=this.helperProportions.height-t.bottom+this.margins.top)},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var t=this.offsetParent.offset();return"absolute"===this.cssPosition&&this.scrollParent[0]!==this.document[0]&&e.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop()),(this.offsetParent[0]===this.document[0].body||this.offsetParent[0].tagName&&"html"===this.offsetParent[0].tagName.toLowerCase()&&e.ui.ie)&&(t={top:0,left:0}),{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if("relative"===this.cssPosition){var e=this.currentItem.position();return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.currentItem.css("marginLeft"),10)||0,top:parseInt(this.currentItem.css("marginTop"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t,i,s,n=this.options;"parent"===n.containment&&(n.containment=this.helper[0].parentNode),("document"===n.containment||"window"===n.containment)&&(this.containment=[0-this.offset.relative.left-this.offset.parent.left,0-this.offset.relative.top-this.offset.parent.top,"document"===n.containment?this.document.width():this.window.width()-this.helperProportions.width-this.margins.left,("document"===n.containment?this.document.width():this.window.height()||this.document[0].body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top]),/^(document|window|parent)$/.test(n.containment)||(t=e(n.containment)[0],i=e(n.containment).offset(),s="hidden"!==e(t).css("overflow"),this.containment=[i.left+(parseInt(e(t).css("borderLeftWidth"),10)||0)+(parseInt(e(t).css("paddingLeft"),10)||0)-this.margins.left,i.top+(parseInt(e(t).css("borderTopWidth"),10)||0)+(parseInt(e(t).css("paddingTop"),10)||0)-this.margins.top,i.left+(s?Math.max(t.scrollWidth,t.offsetWidth):t.offsetWidth)-(parseInt(e(t).css("borderLeftWidth"),10)||0)-(parseInt(e(t).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left,i.top+(s?Math.max(t.scrollHeight,t.offsetHeight):t.offsetHeight)-(parseInt(e(t).css("borderTopWidth"),10)||0)-(parseInt(e(t).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top])},_convertPositionTo:function(t,i){i||(i=this.position);var s="absolute"===t?1:-1,n="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,a=/(html|body)/i.test(n[0].tagName);return{top:i.top+this.offset.relative.top*s+this.offset.parent.top*s-("fixed"===this.cssPosition?-this.scrollParent.scrollTop():a?0:n.scrollTop())*s,left:i.left+this.offset.relative.left*s+this.offset.parent.left*s-("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():a?0:n.scrollLeft())*s}},_generatePosition:function(t){var i,s,n=this.options,a=t.pageX,o=t.pageY,r="absolute"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,h=/(html|body)/i.test(r[0].tagName);return"relative"!==this.cssPosition||this.scrollParent[0]!==this.document[0]&&this.scrollParent[0]!==this.offsetParent[0]||(this.offset.relative=this._getRelativeOffset()),this.originalPosition&&(this.containment&&(t.pageX-this.offset.click.left<this.containment[0]&&(a=this.containment[0]+this.offset.click.left),t.pageY-this.offset.click.top<this.containment[1]&&(o=this.containment[1]+this.offset.click.top),t.pageX-this.offset.click.left>this.containment[2]&&(a=this.containment[2]+this.offset.click.left),t.pageY-this.offset.click.top>this.containment[3]&&(o=this.containment[3]+this.offset.click.top)),n.grid&&(i=this.originalPageY+Math.round((o-this.originalPageY)/n.grid[1])*n.grid[1],o=this.containment?i-this.offset.click.top>=this.containment[1]&&i-this.offset.click.top<=this.containment[3]?i:i-this.offset.click.top>=this.containment[1]?i-n.grid[1]:i+n.grid[1]:i,s=this.originalPageX+Math.round((a-this.originalPageX)/n.grid[0])*n.grid[0],a=this.containment?s-this.offset.click.left>=this.containment[0]&&s-this.offset.click.left<=this.containment[2]?s:s-this.offset.click.left>=this.containment[0]?s-n.grid[0]:s+n.grid[0]:s)),{top:o-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+("fixed"===this.cssPosition?-this.scrollParent.scrollTop():h?0:r.scrollTop()),left:a-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+("fixed"===this.cssPosition?-this.scrollParent.scrollLeft():h?0:r.scrollLeft())}},_rearrange:function(e,t,i,s){i?i[0].appendChild(this.placeholder[0]):t.item[0].parentNode.insertBefore(this.placeholder[0],"down"===this.direction?t.item[0]:t.item[0].nextSibling),this.counter=this.counter?++this.counter:1;var n=this.counter;this._delay(function(){n===this.counter&&this.refreshPositions(!s)})},_clear:function(e,t){function i(e,t,i){return function(s){i._trigger(e,s,t._uiHash(t))}}this.reverting=!1;var s,n=[];if(!this._noFinalSort&&this.currentItem.parent().length&&this.placeholder.before(this.currentItem),this._noFinalSort=null,this.helper[0]===this.currentItem[0]){for(s in this._storedCSS)("auto"===this._storedCSS[s]||"static"===this._storedCSS[s])&&(this._storedCSS[s]="");this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper")}else this.currentItem.show();for(this.fromOutside&&!t&&n.push(function(e){this._trigger("receive",e,this._uiHash(this.fromOutside))}),!this.fromOutside&&this.domPosition.prev===this.currentItem.prev().not(".ui-sortable-helper")[0]&&this.domPosition.parent===this.currentItem.parent()[0]||t||n.push(function(e){this._trigger("update",e,this._uiHash())}),this!==this.currentContainer&&(t||(n.push(function(e){this._trigger("remove",e,this._uiHash())}),n.push(function(e){return function(t){e._trigger("receive",t,this._uiHash(this))}}.call(this,this.currentContainer)),n.push(function(e){return function(t){e._trigger("update",t,this._uiHash(this))}}.call(this,this.currentContainer)))),s=this.containers.length-1;s>=0;s--)t||n.push(i("deactivate",this,this.containers[s])),this.containers[s].containerCache.over&&(n.push(i("out",this,this.containers[s])),this.containers[s].containerCache.over=0);if(this.storedCursor&&(this.document.find("body").css("cursor",this.storedCursor),this.storedStylesheet.remove()),this._storedOpacity&&this.helper.css("opacity",this._storedOpacity),this._storedZIndex&&this.helper.css("zIndex","auto"===this._storedZIndex?"":this._storedZIndex),this.dragging=!1,t||this._trigger("beforeStop",e,this._uiHash()),this.placeholder[0].parentNode.removeChild(this.placeholder[0]),this.cancelHelperRemoval||(this.helper[0]!==this.currentItem[0]&&this.helper.remove(),this.helper=null),!t){for(s=0;n.length>s;s++)n[s].call(this,e);this._trigger("stop",e,this._uiHash())}return this.fromOutside=!1,!this.cancelHelperRemoval},_trigger:function(){e.Widget.prototype._trigger.apply(this,arguments)===!1&&this.cancel()},_uiHash:function(t){var i=t||this;return{helper:i.helper,placeholder:i.placeholder||e([]),position:i.position,originalPosition:i.originalPosition,offset:i.positionAbs,item:i.currentItem,sender:t?t.element:null}}}),e.widget("ui.accordion",{version:"1.11.4",options:{active:0,animate:{},collapsible:!1,event:"click",header:"> li > :first-child,> :not(li):even",heightStyle:"auto",icons:{activeHeader:"ui-icon-triangle-1-s",header:"ui-icon-triangle-1-e"},activate:null,beforeActivate:null},hideProps:{borderTopWidth:"hide",borderBottomWidth:"hide",paddingTop:"hide",paddingBottom:"hide",height:"hide"},showProps:{borderTopWidth:"show",borderBottomWidth:"show",paddingTop:"show",paddingBottom:"show",height:"show"},_create:function(){var t=this.options;this.prevShow=this.prevHide=e(),this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role","tablist"),t.collapsible||t.active!==!1&&null!=t.active||(t.active=0),this._processPanels(),0>t.active&&(t.active+=this.headers.length),this._refresh()},_getCreateEventData:function(){return{header:this.active,panel:this.active.length?this.active.next():e()}},_createIcons:function(){var t=this.options.icons;t&&(e("<span>").addClass("ui-accordion-header-icon ui-icon "+t.header).prependTo(this.headers),this.active.children(".ui-accordion-header-icon").removeClass(t.header).addClass(t.activeHeader),this.headers.addClass("ui-accordion-icons"))},_destroyIcons:function(){this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove()},_destroy:function(){var e;this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"),this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").removeUniqueId(),this._destroyIcons(),e=this.headers.next().removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").css("display","").removeAttr("role").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeUniqueId(),"content"!==this.options.heightStyle&&e.css("height","")},_setOption:function(e,t){return"active"===e?(this._activate(t),void 0):("event"===e&&(this.options.event&&this._off(this.headers,this.options.event),this._setupEvents(t)),this._super(e,t),"collapsible"!==e||t||this.options.active!==!1||this._activate(0),"icons"===e&&(this._destroyIcons(),t&&this._createIcons()),"disabled"===e&&(this.element.toggleClass("ui-state-disabled",!!t).attr("aria-disabled",t),this.headers.add(this.headers.next()).toggleClass("ui-state-disabled",!!t)),void 0)},_keydown:function(t){if(!t.altKey&&!t.ctrlKey){var i=e.ui.keyCode,s=this.headers.length,n=this.headers.index(t.target),a=!1;switch(t.keyCode){case i.RIGHT:case i.DOWN:a=this.headers[(n+1)%s];break;case i.LEFT:case i.UP:a=this.headers[(n-1+s)%s];break;case i.SPACE:case i.ENTER:this._eventHandler(t);break;case i.HOME:a=this.headers[0];break;case i.END:a=this.headers[s-1]}a&&(e(t.target).attr("tabIndex",-1),e(a).attr("tabIndex",0),a.focus(),t.preventDefault())}},_panelKeyDown:function(t){t.keyCode===e.ui.keyCode.UP&&t.ctrlKey&&e(t.currentTarget).prev().focus()},refresh:function(){var t=this.options;this._processPanels(),t.active===!1&&t.collapsible===!0||!this.headers.length?(t.active=!1,this.active=e()):t.active===!1?this._activate(0):this.active.length&&!e.contains(this.element[0],this.active[0])?this.headers.length===this.headers.find(".ui-state-disabled").length?(t.active=!1,this.active=e()):this._activate(Math.max(0,t.active-1)):t.active=this.headers.index(this.active),this._destroyIcons(),this._refresh()},_processPanels:function(){var e=this.headers,t=this.panels;this.headers=this.element.find(this.options.header).addClass("ui-accordion-header ui-state-default ui-corner-all"),this.panels=this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide(),t&&(this._off(e.not(this.headers)),this._off(t.not(this.panels)))
},_refresh:function(){var t,i=this.options,s=i.heightStyle,n=this.element.parent();this.active=this._findActive(i.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"),this.active.next().addClass("ui-accordion-content-active").show(),this.headers.attr("role","tab").each(function(){var t=e(this),i=t.uniqueId().attr("id"),s=t.next(),n=s.uniqueId().attr("id");t.attr("aria-controls",n),s.attr("aria-labelledby",i)}).next().attr("role","tabpanel"),this.headers.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}).next().attr({"aria-hidden":"true"}).hide(),this.active.length?this.active.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}).next().attr({"aria-hidden":"false"}):this.headers.eq(0).attr("tabIndex",0),this._createIcons(),this._setupEvents(i.event),"fill"===s?(t=n.height(),this.element.siblings(":visible").each(function(){var i=e(this),s=i.css("position");"absolute"!==s&&"fixed"!==s&&(t-=i.outerHeight(!0))}),this.headers.each(function(){t-=e(this).outerHeight(!0)}),this.headers.next().each(function(){e(this).height(Math.max(0,t-e(this).innerHeight()+e(this).height()))}).css("overflow","auto")):"auto"===s&&(t=0,this.headers.next().each(function(){t=Math.max(t,e(this).css("height","").height())}).height(t))},_activate:function(t){var i=this._findActive(t)[0];i!==this.active[0]&&(i=i||this.active[0],this._eventHandler({target:i,currentTarget:i,preventDefault:e.noop}))},_findActive:function(t){return"number"==typeof t?this.headers.eq(t):e()},_setupEvents:function(t){var i={keydown:"_keydown"};t&&e.each(t.split(" "),function(e,t){i[t]="_eventHandler"}),this._off(this.headers.add(this.headers.next())),this._on(this.headers,i),this._on(this.headers.next(),{keydown:"_panelKeyDown"}),this._hoverable(this.headers),this._focusable(this.headers)},_eventHandler:function(t){var i=this.options,s=this.active,n=e(t.currentTarget),a=n[0]===s[0],o=a&&i.collapsible,r=o?e():n.next(),h=s.next(),l={oldHeader:s,oldPanel:h,newHeader:o?e():n,newPanel:r};t.preventDefault(),a&&!i.collapsible||this._trigger("beforeActivate",t,l)===!1||(i.active=o?!1:this.headers.index(n),this.active=a?e():n,this._toggle(l),s.removeClass("ui-accordion-header-active ui-state-active"),i.icons&&s.children(".ui-accordion-header-icon").removeClass(i.icons.activeHeader).addClass(i.icons.header),a||(n.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"),i.icons&&n.children(".ui-accordion-header-icon").removeClass(i.icons.header).addClass(i.icons.activeHeader),n.next().addClass("ui-accordion-content-active")))},_toggle:function(t){var i=t.newPanel,s=this.prevShow.length?this.prevShow:t.oldPanel;this.prevShow.add(this.prevHide).stop(!0,!0),this.prevShow=i,this.prevHide=s,this.options.animate?this._animate(i,s,t):(s.hide(),i.show(),this._toggleComplete(t)),s.attr({"aria-hidden":"true"}),s.prev().attr({"aria-selected":"false","aria-expanded":"false"}),i.length&&s.length?s.prev().attr({tabIndex:-1,"aria-expanded":"false"}):i.length&&this.headers.filter(function(){return 0===parseInt(e(this).attr("tabIndex"),10)}).attr("tabIndex",-1),i.attr("aria-hidden","false").prev().attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_animate:function(e,t,i){var s,n,a,o=this,r=0,h=e.css("box-sizing"),l=e.length&&(!t.length||e.index()<t.index()),u=this.options.animate||{},d=l&&u.down||u,c=function(){o._toggleComplete(i)};return"number"==typeof d&&(a=d),"string"==typeof d&&(n=d),n=n||d.easing||u.easing,a=a||d.duration||u.duration,t.length?e.length?(s=e.show().outerHeight(),t.animate(this.hideProps,{duration:a,easing:n,step:function(e,t){t.now=Math.round(e)}}),e.hide().animate(this.showProps,{duration:a,easing:n,complete:c,step:function(e,i){i.now=Math.round(e),"height"!==i.prop?"content-box"===h&&(r+=i.now):"content"!==o.options.heightStyle&&(i.now=Math.round(s-t.outerHeight()-r),r=0)}}),void 0):t.animate(this.hideProps,a,n,c):e.animate(this.showProps,a,n,c)},_toggleComplete:function(e){var t=e.oldPanel;t.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all"),t.length&&(t.parent()[0].className=t.parent()[0].className),this._trigger("activate",null,e)}}),e.widget("ui.menu",{version:"1.11.4",defaultElement:"<ul>",delay:300,options:{icons:{submenu:"ui-icon-carat-1-e"},items:"> *",menus:"ul",position:{my:"left-1 top",at:"right top"},role:"menu",blur:null,focus:null,select:null},_create:function(){this.activeMenu=this.element,this.mouseHandled=!1,this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content").toggleClass("ui-menu-icons",!!this.element.find(".ui-icon").length).attr({role:this.options.role,tabIndex:0}),this.options.disabled&&this.element.addClass("ui-state-disabled").attr("aria-disabled","true"),this._on({"mousedown .ui-menu-item":function(e){e.preventDefault()},"click .ui-menu-item":function(t){var i=e(t.target);!this.mouseHandled&&i.not(".ui-state-disabled").length&&(this.select(t),t.isPropagationStopped()||(this.mouseHandled=!0),i.has(".ui-menu").length?this.expand(t):!this.element.is(":focus")&&e(this.document[0].activeElement).closest(".ui-menu").length&&(this.element.trigger("focus",[!0]),this.active&&1===this.active.parents(".ui-menu").length&&clearTimeout(this.timer)))},"mouseenter .ui-menu-item":function(t){if(!this.previousFilter){var i=e(t.currentTarget);i.siblings(".ui-state-active").removeClass("ui-state-active"),this.focus(t,i)}},mouseleave:"collapseAll","mouseleave .ui-menu":"collapseAll",focus:function(e,t){var i=this.active||this.element.find(this.options.items).eq(0);t||this.focus(e,i)},blur:function(t){this._delay(function(){e.contains(this.element[0],this.document[0].activeElement)||this.collapseAll(t)})},keydown:"_keydown"}),this.refresh(),this._on(this.document,{click:function(e){this._closeOnDocumentClick(e)&&this.collapseAll(e),this.mouseHandled=!1}})},_destroy:function(){this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-menu-icons ui-front").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show(),this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").removeUniqueId().removeClass("ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function(){var t=e(this);t.data("ui-menu-submenu-carat")&&t.remove()}),this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")},_keydown:function(t){var i,s,n,a,o=!0;switch(t.keyCode){case e.ui.keyCode.PAGE_UP:this.previousPage(t);break;case e.ui.keyCode.PAGE_DOWN:this.nextPage(t);break;case e.ui.keyCode.HOME:this._move("first","first",t);break;case e.ui.keyCode.END:this._move("last","last",t);break;case e.ui.keyCode.UP:this.previous(t);break;case e.ui.keyCode.DOWN:this.next(t);break;case e.ui.keyCode.LEFT:this.collapse(t);break;case e.ui.keyCode.RIGHT:this.active&&!this.active.is(".ui-state-disabled")&&this.expand(t);break;case e.ui.keyCode.ENTER:case e.ui.keyCode.SPACE:this._activate(t);break;case e.ui.keyCode.ESCAPE:this.collapse(t);break;default:o=!1,s=this.previousFilter||"",n=String.fromCharCode(t.keyCode),a=!1,clearTimeout(this.filterTimer),n===s?a=!0:n=s+n,i=this._filterMenuItems(n),i=a&&-1!==i.index(this.active.next())?this.active.nextAll(".ui-menu-item"):i,i.length||(n=String.fromCharCode(t.keyCode),i=this._filterMenuItems(n)),i.length?(this.focus(t,i),this.previousFilter=n,this.filterTimer=this._delay(function(){delete this.previousFilter},1e3)):delete this.previousFilter}o&&t.preventDefault()},_activate:function(e){this.active.is(".ui-state-disabled")||(this.active.is("[aria-haspopup='true']")?this.expand(e):this.select(e))},refresh:function(){var t,i,s=this,n=this.options.icons.submenu,a=this.element.find(this.options.menus);this.element.toggleClass("ui-menu-icons",!!this.element.find(".ui-icon").length),a.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-front").hide().attr({role:this.options.role,"aria-hidden":"true","aria-expanded":"false"}).each(function(){var t=e(this),i=t.parent(),s=e("<span>").addClass("ui-menu-icon ui-icon "+n).data("ui-menu-submenu-carat",!0);i.attr("aria-haspopup","true").prepend(s),t.attr("aria-labelledby",i.attr("id"))}),t=a.add(this.element),i=t.find(this.options.items),i.not(".ui-menu-item").each(function(){var t=e(this);s._isDivider(t)&&t.addClass("ui-widget-content ui-menu-divider")}),i.not(".ui-menu-item, .ui-menu-divider").addClass("ui-menu-item").uniqueId().attr({tabIndex:-1,role:this._itemRole()}),i.filter(".ui-state-disabled").attr("aria-disabled","true"),this.active&&!e.contains(this.element[0],this.active[0])&&this.blur()},_itemRole:function(){return{menu:"menuitem",listbox:"option"}[this.options.role]},_setOption:function(e,t){"icons"===e&&this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(t.submenu),"disabled"===e&&this.element.toggleClass("ui-state-disabled",!!t).attr("aria-disabled",t),this._super(e,t)},focus:function(e,t){var i,s;this.blur(e,e&&"focus"===e.type),this._scrollIntoView(t),this.active=t.first(),s=this.active.addClass("ui-state-focus").removeClass("ui-state-active"),this.options.role&&this.element.attr("aria-activedescendant",s.attr("id")),this.active.parent().closest(".ui-menu-item").addClass("ui-state-active"),e&&"keydown"===e.type?this._close():this.timer=this._delay(function(){this._close()},this.delay),i=t.children(".ui-menu"),i.length&&e&&/^mouse/.test(e.type)&&this._startOpening(i),this.activeMenu=t.parent(),this._trigger("focus",e,{item:t})},_scrollIntoView:function(t){var i,s,n,a,o,r;this._hasScroll()&&(i=parseFloat(e.css(this.activeMenu[0],"borderTopWidth"))||0,s=parseFloat(e.css(this.activeMenu[0],"paddingTop"))||0,n=t.offset().top-this.activeMenu.offset().top-i-s,a=this.activeMenu.scrollTop(),o=this.activeMenu.height(),r=t.outerHeight(),0>n?this.activeMenu.scrollTop(a+n):n+r>o&&this.activeMenu.scrollTop(a+n-o+r))},blur:function(e,t){t||clearTimeout(this.timer),this.active&&(this.active.removeClass("ui-state-focus"),this.active=null,this._trigger("blur",e,{item:this.active}))},_startOpening:function(e){clearTimeout(this.timer),"true"===e.attr("aria-hidden")&&(this.timer=this._delay(function(){this._close(),this._open(e)},this.delay))},_open:function(t){var i=e.extend({of:this.active},this.options.position);clearTimeout(this.timer),this.element.find(".ui-menu").not(t.parents(".ui-menu")).hide().attr("aria-hidden","true"),t.show().removeAttr("aria-hidden").attr("aria-expanded","true").position(i)},collapseAll:function(t,i){clearTimeout(this.timer),this.timer=this._delay(function(){var s=i?this.element:e(t&&t.target).closest(this.element.find(".ui-menu"));s.length||(s=this.element),this._close(s),this.blur(t),this.activeMenu=s},this.delay)},_close:function(e){e||(e=this.active?this.active.parent():this.element),e.find(".ui-menu").hide().attr("aria-hidden","true").attr("aria-expanded","false").end().find(".ui-state-active").not(".ui-state-focus").removeClass("ui-state-active")},_closeOnDocumentClick:function(t){return!e(t.target).closest(".ui-menu").length},_isDivider:function(e){return!/[^\-\u2014\u2013\s]/.test(e.text())},collapse:function(e){var t=this.active&&this.active.parent().closest(".ui-menu-item",this.element);t&&t.length&&(this._close(),this.focus(e,t))},expand:function(e){var t=this.active&&this.active.children(".ui-menu ").find(this.options.items).first();t&&t.length&&(this._open(t.parent()),this._delay(function(){this.focus(e,t)}))},next:function(e){this._move("next","first",e)},previous:function(e){this._move("prev","last",e)},isFirstItem:function(){return this.active&&!this.active.prevAll(".ui-menu-item").length},isLastItem:function(){return this.active&&!this.active.nextAll(".ui-menu-item").length},_move:function(e,t,i){var s;this.active&&(s="first"===e||"last"===e?this.active["first"===e?"prevAll":"nextAll"](".ui-menu-item").eq(-1):this.active[e+"All"](".ui-menu-item").eq(0)),s&&s.length&&this.active||(s=this.activeMenu.find(this.options.items)[t]()),this.focus(i,s)},nextPage:function(t){var i,s,n;return this.active?(this.isLastItem()||(this._hasScroll()?(s=this.active.offset().top,n=this.element.height(),this.active.nextAll(".ui-menu-item").each(function(){return i=e(this),0>i.offset().top-s-n}),this.focus(t,i)):this.focus(t,this.activeMenu.find(this.options.items)[this.active?"last":"first"]())),void 0):(this.next(t),void 0)},previousPage:function(t){var i,s,n;return this.active?(this.isFirstItem()||(this._hasScroll()?(s=this.active.offset().top,n=this.element.height(),this.active.prevAll(".ui-menu-item").each(function(){return i=e(this),i.offset().top-s+n>0}),this.focus(t,i)):this.focus(t,this.activeMenu.find(this.options.items).first())),void 0):(this.next(t),void 0)},_hasScroll:function(){return this.element.outerHeight()<this.element.prop("scrollHeight")},select:function(t){this.active=this.active||e(t.target).closest(".ui-menu-item");var i={item:this.active};this.active.has(".ui-menu").length||this.collapseAll(t,!0),this._trigger("select",t,i)},_filterMenuItems:function(t){var i=t.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&"),s=RegExp("^"+i,"i");return this.activeMenu.find(this.options.items).filter(".ui-menu-item").filter(function(){return s.test(e.trim(e(this).text()))})}}),e.widget("ui.autocomplete",{version:"1.11.4",defaultElement:"<input>",options:{appendTo:null,autoFocus:!1,delay:300,minLength:1,position:{my:"left top",at:"left bottom",collision:"none"},source:null,change:null,close:null,focus:null,open:null,response:null,search:null,select:null},requestIndex:0,pending:0,_create:function(){var t,i,s,n=this.element[0].nodeName.toLowerCase(),a="textarea"===n,o="input"===n;this.isMultiLine=a?!0:o?!1:this.element.prop("isContentEditable"),this.valueMethod=this.element[a||o?"val":"text"],this.isNewMenu=!0,this.element.addClass("ui-autocomplete-input").attr("autocomplete","off"),this._on(this.element,{keydown:function(n){if(this.element.prop("readOnly"))return t=!0,s=!0,i=!0,void 0;t=!1,s=!1,i=!1;var a=e.ui.keyCode;switch(n.keyCode){case a.PAGE_UP:t=!0,this._move("previousPage",n);break;case a.PAGE_DOWN:t=!0,this._move("nextPage",n);break;case a.UP:t=!0,this._keyEvent("previous",n);break;case a.DOWN:t=!0,this._keyEvent("next",n);break;case a.ENTER:this.menu.active&&(t=!0,n.preventDefault(),this.menu.select(n));break;case a.TAB:this.menu.active&&this.menu.select(n);break;case a.ESCAPE:this.menu.element.is(":visible")&&(this.isMultiLine||this._value(this.term),this.close(n),n.preventDefault());break;default:i=!0,this._searchTimeout(n)}},keypress:function(s){if(t)return t=!1,(!this.isMultiLine||this.menu.element.is(":visible"))&&s.preventDefault(),void 0;if(!i){var n=e.ui.keyCode;switch(s.keyCode){case n.PAGE_UP:this._move("previousPage",s);break;case n.PAGE_DOWN:this._move("nextPage",s);break;case n.UP:this._keyEvent("previous",s);break;case n.DOWN:this._keyEvent("next",s)}}},input:function(e){return s?(s=!1,e.preventDefault(),void 0):(this._searchTimeout(e),void 0)},focus:function(){this.selectedItem=null,this.previous=this._value()},blur:function(e){return this.cancelBlur?(delete this.cancelBlur,void 0):(clearTimeout(this.searching),this.close(e),this._change(e),void 0)}}),this._initSource(),this.menu=e("<ul>").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({role:null}).hide().menu("instance"),this._on(this.menu.element,{mousedown:function(t){t.preventDefault(),this.cancelBlur=!0,this._delay(function(){delete this.cancelBlur});var i=this.menu.element[0];e(t.target).closest(".ui-menu-item").length||this._delay(function(){var t=this;this.document.one("mousedown",function(s){s.target===t.element[0]||s.target===i||e.contains(i,s.target)||t.close()})})},menufocus:function(t,i){var s,n;return this.isNewMenu&&(this.isNewMenu=!1,t.originalEvent&&/^mouse/.test(t.originalEvent.type))?(this.menu.blur(),this.document.one("mousemove",function(){e(t.target).trigger(t.originalEvent)}),void 0):(n=i.item.data("ui-autocomplete-item"),!1!==this._trigger("focus",t,{item:n})&&t.originalEvent&&/^key/.test(t.originalEvent.type)&&this._value(n.value),s=i.item.attr("aria-label")||n.value,s&&e.trim(s).length&&(this.liveRegion.children().hide(),e("<div>").text(s).appendTo(this.liveRegion)),void 0)},menuselect:function(e,t){var i=t.item.data("ui-autocomplete-item"),s=this.previous;this.element[0]!==this.document[0].activeElement&&(this.element.focus(),this.previous=s,this._delay(function(){this.previous=s,this.selectedItem=i})),!1!==this._trigger("select",e,{item:i})&&this._value(i.value),this.term=this._value(),this.close(e),this.selectedItem=i}}),this.liveRegion=e("<span>",{role:"status","aria-live":"assertive","aria-relevant":"additions"}).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_destroy:function(){clearTimeout(this.searching),this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"),this.menu.element.remove(),this.liveRegion.remove()},_setOption:function(e,t){this._super(e,t),"source"===e&&this._initSource(),"appendTo"===e&&this.menu.element.appendTo(this._appendTo()),"disabled"===e&&t&&this.xhr&&this.xhr.abort()},_appendTo:function(){var t=this.options.appendTo;return t&&(t=t.jquery||t.nodeType?e(t):this.document.find(t).eq(0)),t&&t[0]||(t=this.element.closest(".ui-front")),t.length||(t=this.document[0].body),t},_initSource:function(){var t,i,s=this;e.isArray(this.options.source)?(t=this.options.source,this.source=function(i,s){s(e.ui.autocomplete.filter(t,i.term))}):"string"==typeof this.options.source?(i=this.options.source,this.source=function(t,n){s.xhr&&s.xhr.abort(),s.xhr=e.ajax({url:i,data:t,dataType:"json",success:function(e){n(e)},error:function(){n([])}})}):this.source=this.options.source},_searchTimeout:function(e){clearTimeout(this.searching),this.searching=this._delay(function(){var t=this.term===this._value(),i=this.menu.element.is(":visible"),s=e.altKey||e.ctrlKey||e.metaKey||e.shiftKey;(!t||t&&!i&&!s)&&(this.selectedItem=null,this.search(null,e))},this.options.delay)},search:function(e,t){return e=null!=e?e:this._value(),this.term=this._value(),e.length<this.options.minLength?this.close(t):this._trigger("search",t)!==!1?this._search(e):void 0},_search:function(e){this.pending++,this.element.addClass("ui-autocomplete-loading"),this.cancelSearch=!1,this.source({term:e},this._response())},_response:function(){var t=++this.requestIndex;return e.proxy(function(e){t===this.requestIndex&&this.__response(e),this.pending--,this.pending||this.element.removeClass("ui-autocomplete-loading")},this)},__response:function(e){e&&(e=this._normalize(e)),this._trigger("response",null,{content:e}),!this.options.disabled&&e&&e.length&&!this.cancelSearch?(this._suggest(e),this._trigger("open")):this._close()},close:function(e){this.cancelSearch=!0,this._close(e)},_close:function(e){this.menu.element.is(":visible")&&(this.menu.element.hide(),this.menu.blur(),this.isNewMenu=!0,this._trigger("close",e))},_change:function(e){this.previous!==this._value()&&this._trigger("change",e,{item:this.selectedItem})},_normalize:function(t){return t.length&&t[0].label&&t[0].value?t:e.map(t,function(t){return"string"==typeof t?{label:t,value:t}:e.extend({},t,{label:t.label||t.value,value:t.value||t.label})})},_suggest:function(t){var i=this.menu.element.empty();this._renderMenu(i,t),this.isNewMenu=!0,this.menu.refresh(),i.show(),this._resizeMenu(),i.position(e.extend({of:this.element},this.options.position)),this.options.autoFocus&&this.menu.next()},_resizeMenu:function(){var e=this.menu.element;e.outerWidth(Math.max(e.width("").outerWidth()+1,this.element.outerWidth()))},_renderMenu:function(t,i){var s=this;e.each(i,function(e,i){s._renderItemData(t,i)})},_renderItemData:function(e,t){return this._renderItem(e,t).data("ui-autocomplete-item",t)},_renderItem:function(t,i){return e("<li>").text(i.label).appendTo(t)},_move:function(e,t){return this.menu.element.is(":visible")?this.menu.isFirstItem()&&/^previous/.test(e)||this.menu.isLastItem()&&/^next/.test(e)?(this.isMultiLine||this._value(this.term),this.menu.blur(),void 0):(this.menu[e](t),void 0):(this.search(null,t),void 0)},widget:function(){return this.menu.element},_value:function(){return this.valueMethod.apply(this.element,arguments)},_keyEvent:function(e,t){(!this.isMultiLine||this.menu.element.is(":visible"))&&(this._move(e,t),t.preventDefault())}}),e.extend(e.ui.autocomplete,{escapeRegex:function(e){return e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")},filter:function(t,i){var s=RegExp(e.ui.autocomplete.escapeRegex(i),"i");return e.grep(t,function(e){return s.test(e.label||e.value||e)})}}),e.widget("ui.autocomplete",e.ui.autocomplete,{options:{messages:{noResults:"No search results.",results:function(e){return e+(e>1?" results are":" result is")+" available, use up and down arrow keys to navigate."}}},__response:function(t){var i;this._superApply(arguments),this.options.disabled||this.cancelSearch||(i=t&&t.length?this.options.messages.results(t.length):this.options.messages.noResults,this.liveRegion.children().hide(),e("<div>").text(i).appendTo(this.liveRegion))}}),e.ui.autocomplete;var c,p="ui-button ui-widget ui-state-default ui-corner-all",f="ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only",m=function(){var t=e(this);setTimeout(function(){t.find(":ui-button").button("refresh")},1)},g=function(t){var i=t.name,s=t.form,n=e([]);return i&&(i=i.replace(/'/g,"\\'"),n=s?e(s).find("[name='"+i+"'][type=radio]"):e("[name='"+i+"'][type=radio]",t.ownerDocument).filter(function(){return!this.form})),n};e.widget("ui.button",{version:"1.11.4",defaultElement:"<button>",options:{disabled:null,text:!0,label:null,icons:{primary:null,secondary:null}},_create:function(){this.element.closest("form").unbind("reset"+this.eventNamespace).bind("reset"+this.eventNamespace,m),"boolean"!=typeof this.options.disabled?this.options.disabled=!!this.element.prop("disabled"):this.element.prop("disabled",this.options.disabled),this._determineButtonType(),this.hasTitle=!!this.buttonElement.attr("title");var t=this,i=this.options,s="checkbox"===this.type||"radio"===this.type,n=s?"":"ui-state-active";null===i.label&&(i.label="input"===this.type?this.buttonElement.val():this.buttonElement.html()),this._hoverable(this.buttonElement),this.buttonElement.addClass(p).attr("role","button").bind("mouseenter"+this.eventNamespace,function(){i.disabled||this===c&&e(this).addClass("ui-state-active")}).bind("mouseleave"+this.eventNamespace,function(){i.disabled||e(this).removeClass(n)}).bind("click"+this.eventNamespace,function(e){i.disabled&&(e.preventDefault(),e.stopImmediatePropagation())}),this._on({focus:function(){this.buttonElement.addClass("ui-state-focus")},blur:function(){this.buttonElement.removeClass("ui-state-focus")}}),s&&this.element.bind("change"+this.eventNamespace,function(){t.refresh()}),"checkbox"===this.type?this.buttonElement.bind("click"+this.eventNamespace,function(){return i.disabled?!1:void 0}):"radio"===this.type?this.buttonElement.bind("click"+this.eventNamespace,function(){if(i.disabled)return!1;e(this).addClass("ui-state-active"),t.buttonElement.attr("aria-pressed","true");var s=t.element[0];g(s).not(s).map(function(){return e(this).button("widget")[0]}).removeClass("ui-state-active").attr("aria-pressed","false")}):(this.buttonElement.bind("mousedown"+this.eventNamespace,function(){return i.disabled?!1:(e(this).addClass("ui-state-active"),c=this,t.document.one("mouseup",function(){c=null}),void 0)}).bind("mouseup"+this.eventNamespace,function(){return i.disabled?!1:(e(this).removeClass("ui-state-active"),void 0)}).bind("keydown"+this.eventNamespace,function(t){return i.disabled?!1:((t.keyCode===e.ui.keyCode.SPACE||t.keyCode===e.ui.keyCode.ENTER)&&e(this).addClass("ui-state-active"),void 0)}).bind("keyup"+this.eventNamespace+" blur"+this.eventNamespace,function(){e(this).removeClass("ui-state-active")}),this.buttonElement.is("a")&&this.buttonElement.keyup(function(t){t.keyCode===e.ui.keyCode.SPACE&&e(this).click()})),this._setOption("disabled",i.disabled),this._resetButton()},_determineButtonType:function(){var e,t,i;this.type=this.element.is("[type=checkbox]")?"checkbox":this.element.is("[type=radio]")?"radio":this.element.is("input")?"input":"button","checkbox"===this.type||"radio"===this.type?(e=this.element.parents().last(),t="label[for='"+this.element.attr("id")+"']",this.buttonElement=e.find(t),this.buttonElement.length||(e=e.length?e.siblings():this.element.siblings(),this.buttonElement=e.filter(t),this.buttonElement.length||(this.buttonElement=e.find(t))),this.element.addClass("ui-helper-hidden-accessible"),i=this.element.is(":checked"),i&&this.buttonElement.addClass("ui-state-active"),this.buttonElement.prop("aria-pressed",i)):this.buttonElement=this.element},widget:function(){return this.buttonElement},_destroy:function(){this.element.removeClass("ui-helper-hidden-accessible"),this.buttonElement.removeClass(p+" ui-state-active "+f).removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html()),this.hasTitle||this.buttonElement.removeAttr("title")},_setOption:function(e,t){return this._super(e,t),"disabled"===e?(this.widget().toggleClass("ui-state-disabled",!!t),this.element.prop("disabled",!!t),t&&("checkbox"===this.type||"radio"===this.type?this.buttonElement.removeClass("ui-state-focus"):this.buttonElement.removeClass("ui-state-focus ui-state-active")),void 0):(this._resetButton(),void 0)},refresh:function(){var t=this.element.is("input, button")?this.element.is(":disabled"):this.element.hasClass("ui-button-disabled");t!==this.options.disabled&&this._setOption("disabled",t),"radio"===this.type?g(this.element[0]).each(function(){e(this).is(":checked")?e(this).button("widget").addClass("ui-state-active").attr("aria-pressed","true"):e(this).button("widget").removeClass("ui-state-active").attr("aria-pressed","false")}):"checkbox"===this.type&&(this.element.is(":checked")?this.buttonElement.addClass("ui-state-active").attr("aria-pressed","true"):this.buttonElement.removeClass("ui-state-active").attr("aria-pressed","false"))},_resetButton:function(){if("input"===this.type)return this.options.label&&this.element.val(this.options.label),void 0;var t=this.buttonElement.removeClass(f),i=e("<span></span>",this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(t.empty()).text(),s=this.options.icons,n=s.primary&&s.secondary,a=[];s.primary||s.secondary?(this.options.text&&a.push("ui-button-text-icon"+(n?"s":s.primary?"-primary":"-secondary")),s.primary&&t.prepend("<span class='ui-button-icon-primary ui-icon "+s.primary+"'></span>"),s.secondary&&t.append("<span class='ui-button-icon-secondary ui-icon "+s.secondary+"'></span>"),this.options.text||(a.push(n?"ui-button-icons-only":"ui-button-icon-only"),this.hasTitle||t.attr("title",e.trim(i)))):a.push("ui-button-text-only"),t.addClass(a.join(" "))}}),e.widget("ui.buttonset",{version:"1.11.4",options:{items:"button, input[type=button], input[type=submit], input[type=reset], input[type=checkbox], input[type=radio], a, :data(ui-button)"},_create:function(){this.element.addClass("ui-buttonset")},_init:function(){this.refresh()},_setOption:function(e,t){"disabled"===e&&this.buttons.button("option",e,t),this._super(e,t)},refresh:function(){var t="rtl"===this.element.css("direction"),i=this.element.find(this.options.items),s=i.filter(":ui-button");i.not(":ui-button").button(),s.button("refresh"),this.buttons=i.map(function(){return e(this).button("widget")[0]}).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(t?"ui-corner-right":"ui-corner-left").end().filter(":last").addClass(t?"ui-corner-left":"ui-corner-right").end().end()},_destroy:function(){this.element.removeClass("ui-buttonset"),this.buttons.map(function(){return e(this).button("widget")[0]}).removeClass("ui-corner-left ui-corner-right").end().button("destroy")}}),e.ui.button,e.extend(e.ui,{datepicker:{version:"1.11.4"}});var v;e.extend(n.prototype,{markerClassName:"hasDatepicker",maxRows:4,_widgetDatepicker:function(){return this.dpDiv},setDefaults:function(e){return r(this._defaults,e||{}),this},_attachDatepicker:function(t,i){var s,n,a;s=t.nodeName.toLowerCase(),n="div"===s||"span"===s,t.id||(this.uuid+=1,t.id="dp"+this.uuid),a=this._newInst(e(t),n),a.settings=e.extend({},i||{}),"input"===s?this._connectDatepicker(t,a):n&&this._inlineDatepicker(t,a)},_newInst:function(t,i){var s=t[0].id.replace(/([^A-Za-z0-9_\-])/g,"\\\\$1");return{id:s,input:t,selectedDay:0,selectedMonth:0,selectedYear:0,drawMonth:0,drawYear:0,inline:i,dpDiv:i?a(e("<div class='"+this._inlineClass+" ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'></div>")):this.dpDiv}},_connectDatepicker:function(t,i){var s=e(t);i.append=e([]),i.trigger=e([]),s.hasClass(this.markerClassName)||(this._attachments(s,i),s.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp),this._autoSize(i),e.data(t,"datepicker",i),i.settings.disabled&&this._disableDatepicker(t))},_attachments:function(t,i){var s,n,a,o=this._get(i,"appendText"),r=this._get(i,"isRTL");i.append&&i.append.remove(),o&&(i.append=e("<span class='"+this._appendClass+"'>"+o+"</span>"),t[r?"before":"after"](i.append)),t.unbind("focus",this._showDatepicker),i.trigger&&i.trigger.remove(),s=this._get(i,"showOn"),("focus"===s||"both"===s)&&t.focus(this._showDatepicker),("button"===s||"both"===s)&&(n=this._get(i,"buttonText"),a=this._get(i,"buttonImage"),i.trigger=e(this._get(i,"buttonImageOnly")?e("<img/>").addClass(this._triggerClass).attr({src:a,alt:n,title:n}):e("<button type='button'></button>").addClass(this._triggerClass).html(a?e("<img/>").attr({src:a,alt:n,title:n}):n)),t[r?"before":"after"](i.trigger),i.trigger.click(function(){return e.datepicker._datepickerShowing&&e.datepicker._lastInput===t[0]?e.datepicker._hideDatepicker():e.datepicker._datepickerShowing&&e.datepicker._lastInput!==t[0]?(e.datepicker._hideDatepicker(),e.datepicker._showDatepicker(t[0])):e.datepicker._showDatepicker(t[0]),!1}))},_autoSize:function(e){if(this._get(e,"autoSize")&&!e.inline){var t,i,s,n,a=new Date(2009,11,20),o=this._get(e,"dateFormat");o.match(/[DM]/)&&(t=function(e){for(i=0,s=0,n=0;e.length>n;n++)e[n].length>i&&(i=e[n].length,s=n);return s},a.setMonth(t(this._get(e,o.match(/MM/)?"monthNames":"monthNamesShort"))),a.setDate(t(this._get(e,o.match(/DD/)?"dayNames":"dayNamesShort"))+20-a.getDay())),e.input.attr("size",this._formatDate(e,a).length)}},_inlineDatepicker:function(t,i){var s=e(t);s.hasClass(this.markerClassName)||(s.addClass(this.markerClassName).append(i.dpDiv),e.data(t,"datepicker",i),this._setDate(i,this._getDefaultDate(i),!0),this._updateDatepicker(i),this._updateAlternate(i),i.settings.disabled&&this._disableDatepicker(t),i.dpDiv.css("display","block"))},_dialogDatepicker:function(t,i,s,n,a){var o,h,l,u,d,c=this._dialogInst;return c||(this.uuid+=1,o="dp"+this.uuid,this._dialogInput=e("<input type='text' id='"+o+"' style='position: absolute; top: -100px; width: 0px;'/>"),this._dialogInput.keydown(this._doKeyDown),e("body").append(this._dialogInput),c=this._dialogInst=this._newInst(this._dialogInput,!1),c.settings={},e.data(this._dialogInput[0],"datepicker",c)),r(c.settings,n||{}),i=i&&i.constructor===Date?this._formatDate(c,i):i,this._dialogInput.val(i),this._pos=a?a.length?a:[a.pageX,a.pageY]:null,this._pos||(h=document.documentElement.clientWidth,l=document.documentElement.clientHeight,u=document.documentElement.scrollLeft||document.body.scrollLeft,d=document.documentElement.scrollTop||document.body.scrollTop,this._pos=[h/2-100+u,l/2-150+d]),this._dialogInput.css("left",this._pos[0]+20+"px").css("top",this._pos[1]+"px"),c.settings.onSelect=s,this._inDialog=!0,this.dpDiv.addClass(this._dialogClass),this._showDatepicker(this._dialogInput[0]),e.blockUI&&e.blockUI(this.dpDiv),e.data(this._dialogInput[0],"datepicker",c),this
},_destroyDatepicker:function(t){var i,s=e(t),n=e.data(t,"datepicker");s.hasClass(this.markerClassName)&&(i=t.nodeName.toLowerCase(),e.removeData(t,"datepicker"),"input"===i?(n.append.remove(),n.trigger.remove(),s.removeClass(this.markerClassName).unbind("focus",this._showDatepicker).unbind("keydown",this._doKeyDown).unbind("keypress",this._doKeyPress).unbind("keyup",this._doKeyUp)):("div"===i||"span"===i)&&s.removeClass(this.markerClassName).empty(),v===n&&(v=null))},_enableDatepicker:function(t){var i,s,n=e(t),a=e.data(t,"datepicker");n.hasClass(this.markerClassName)&&(i=t.nodeName.toLowerCase(),"input"===i?(t.disabled=!1,a.trigger.filter("button").each(function(){this.disabled=!1}).end().filter("img").css({opacity:"1.0",cursor:""})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().removeClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!1)),this._disabledInputs=e.map(this._disabledInputs,function(e){return e===t?null:e}))},_disableDatepicker:function(t){var i,s,n=e(t),a=e.data(t,"datepicker");n.hasClass(this.markerClassName)&&(i=t.nodeName.toLowerCase(),"input"===i?(t.disabled=!0,a.trigger.filter("button").each(function(){this.disabled=!0}).end().filter("img").css({opacity:"0.5",cursor:"default"})):("div"===i||"span"===i)&&(s=n.children("."+this._inlineClass),s.children().addClass("ui-state-disabled"),s.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",!0)),this._disabledInputs=e.map(this._disabledInputs,function(e){return e===t?null:e}),this._disabledInputs[this._disabledInputs.length]=t)},_isDisabledDatepicker:function(e){if(!e)return!1;for(var t=0;this._disabledInputs.length>t;t++)if(this._disabledInputs[t]===e)return!0;return!1},_getInst:function(t){try{return e.data(t,"datepicker")}catch(i){throw"Missing instance data for this datepicker"}},_optionDatepicker:function(t,i,s){var n,a,o,h,l=this._getInst(t);return 2===arguments.length&&"string"==typeof i?"defaults"===i?e.extend({},e.datepicker._defaults):l?"all"===i?e.extend({},l.settings):this._get(l,i):null:(n=i||{},"string"==typeof i&&(n={},n[i]=s),l&&(this._curInst===l&&this._hideDatepicker(),a=this._getDateDatepicker(t,!0),o=this._getMinMaxDate(l,"min"),h=this._getMinMaxDate(l,"max"),r(l.settings,n),null!==o&&void 0!==n.dateFormat&&void 0===n.minDate&&(l.settings.minDate=this._formatDate(l,o)),null!==h&&void 0!==n.dateFormat&&void 0===n.maxDate&&(l.settings.maxDate=this._formatDate(l,h)),"disabled"in n&&(n.disabled?this._disableDatepicker(t):this._enableDatepicker(t)),this._attachments(e(t),l),this._autoSize(l),this._setDate(l,a),this._updateAlternate(l),this._updateDatepicker(l)),void 0)},_changeDatepicker:function(e,t,i){this._optionDatepicker(e,t,i)},_refreshDatepicker:function(e){var t=this._getInst(e);t&&this._updateDatepicker(t)},_setDateDatepicker:function(e,t){var i=this._getInst(e);i&&(this._setDate(i,t),this._updateDatepicker(i),this._updateAlternate(i))},_getDateDatepicker:function(e,t){var i=this._getInst(e);return i&&!i.inline&&this._setDateFromField(i,t),i?this._getDate(i):null},_doKeyDown:function(t){var i,s,n,a=e.datepicker._getInst(t.target),o=!0,r=a.dpDiv.is(".ui-datepicker-rtl");if(a._keyEvent=!0,e.datepicker._datepickerShowing)switch(t.keyCode){case 9:e.datepicker._hideDatepicker(),o=!1;break;case 13:return n=e("td."+e.datepicker._dayOverClass+":not(."+e.datepicker._currentClass+")",a.dpDiv),n[0]&&e.datepicker._selectDay(t.target,a.selectedMonth,a.selectedYear,n[0]),i=e.datepicker._get(a,"onSelect"),i?(s=e.datepicker._formatDate(a),i.apply(a.input?a.input[0]:null,[s,a])):e.datepicker._hideDatepicker(),!1;case 27:e.datepicker._hideDatepicker();break;case 33:e.datepicker._adjustDate(t.target,t.ctrlKey?-e.datepicker._get(a,"stepBigMonths"):-e.datepicker._get(a,"stepMonths"),"M");break;case 34:e.datepicker._adjustDate(t.target,t.ctrlKey?+e.datepicker._get(a,"stepBigMonths"):+e.datepicker._get(a,"stepMonths"),"M");break;case 35:(t.ctrlKey||t.metaKey)&&e.datepicker._clearDate(t.target),o=t.ctrlKey||t.metaKey;break;case 36:(t.ctrlKey||t.metaKey)&&e.datepicker._gotoToday(t.target),o=t.ctrlKey||t.metaKey;break;case 37:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,r?1:-1,"D"),o=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&e.datepicker._adjustDate(t.target,t.ctrlKey?-e.datepicker._get(a,"stepBigMonths"):-e.datepicker._get(a,"stepMonths"),"M");break;case 38:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,-7,"D"),o=t.ctrlKey||t.metaKey;break;case 39:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,r?-1:1,"D"),o=t.ctrlKey||t.metaKey,t.originalEvent.altKey&&e.datepicker._adjustDate(t.target,t.ctrlKey?+e.datepicker._get(a,"stepBigMonths"):+e.datepicker._get(a,"stepMonths"),"M");break;case 40:(t.ctrlKey||t.metaKey)&&e.datepicker._adjustDate(t.target,7,"D"),o=t.ctrlKey||t.metaKey;break;default:o=!1}else 36===t.keyCode&&t.ctrlKey?e.datepicker._showDatepicker(this):o=!1;o&&(t.preventDefault(),t.stopPropagation())},_doKeyPress:function(t){var i,s,n=e.datepicker._getInst(t.target);return e.datepicker._get(n,"constrainInput")?(i=e.datepicker._possibleChars(e.datepicker._get(n,"dateFormat")),s=String.fromCharCode(null==t.charCode?t.keyCode:t.charCode),t.ctrlKey||t.metaKey||" ">s||!i||i.indexOf(s)>-1):void 0},_doKeyUp:function(t){var i,s=e.datepicker._getInst(t.target);if(s.input.val()!==s.lastVal)try{i=e.datepicker.parseDate(e.datepicker._get(s,"dateFormat"),s.input?s.input.val():null,e.datepicker._getFormatConfig(s)),i&&(e.datepicker._setDateFromField(s),e.datepicker._updateAlternate(s),e.datepicker._updateDatepicker(s))}catch(n){}return!0},_showDatepicker:function(t){if(t=t.target||t,"input"!==t.nodeName.toLowerCase()&&(t=e("input",t.parentNode)[0]),!e.datepicker._isDisabledDatepicker(t)&&e.datepicker._lastInput!==t){var i,n,a,o,h,l,u;i=e.datepicker._getInst(t),e.datepicker._curInst&&e.datepicker._curInst!==i&&(e.datepicker._curInst.dpDiv.stop(!0,!0),i&&e.datepicker._datepickerShowing&&e.datepicker._hideDatepicker(e.datepicker._curInst.input[0])),n=e.datepicker._get(i,"beforeShow"),a=n?n.apply(t,[t,i]):{},a!==!1&&(r(i.settings,a),i.lastVal=null,e.datepicker._lastInput=t,e.datepicker._setDateFromField(i),e.datepicker._inDialog&&(t.value=""),e.datepicker._pos||(e.datepicker._pos=e.datepicker._findPos(t),e.datepicker._pos[1]+=t.offsetHeight),o=!1,e(t).parents().each(function(){return o|="fixed"===e(this).css("position"),!o}),h={left:e.datepicker._pos[0],top:e.datepicker._pos[1]},e.datepicker._pos=null,i.dpDiv.empty(),i.dpDiv.css({position:"absolute",display:"block",top:"-1000px"}),e.datepicker._updateDatepicker(i),h=e.datepicker._checkOffset(i,h,o),i.dpDiv.css({position:e.datepicker._inDialog&&e.blockUI?"static":o?"fixed":"absolute",display:"none",left:h.left+"px",top:h.top+"px"}),i.inline||(l=e.datepicker._get(i,"showAnim"),u=e.datepicker._get(i,"duration"),i.dpDiv.css("z-index",s(e(t))+1),e.datepicker._datepickerShowing=!0,e.effects&&e.effects.effect[l]?i.dpDiv.show(l,e.datepicker._get(i,"showOptions"),u):i.dpDiv[l||"show"](l?u:null),e.datepicker._shouldFocusInput(i)&&i.input.focus(),e.datepicker._curInst=i))}},_updateDatepicker:function(t){this.maxRows=4,v=t,t.dpDiv.empty().append(this._generateHTML(t)),this._attachHandlers(t);var i,s=this._getNumberOfMonths(t),n=s[1],a=17,r=t.dpDiv.find("."+this._dayOverClass+" a");r.length>0&&o.apply(r.get(0)),t.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""),n>1&&t.dpDiv.addClass("ui-datepicker-multi-"+n).css("width",a*n+"em"),t.dpDiv[(1!==s[0]||1!==s[1]?"add":"remove")+"Class"]("ui-datepicker-multi"),t.dpDiv[(this._get(t,"isRTL")?"add":"remove")+"Class"]("ui-datepicker-rtl"),t===e.datepicker._curInst&&e.datepicker._datepickerShowing&&e.datepicker._shouldFocusInput(t)&&t.input.focus(),t.yearshtml&&(i=t.yearshtml,setTimeout(function(){i===t.yearshtml&&t.yearshtml&&t.dpDiv.find("select.ui-datepicker-year:first").replaceWith(t.yearshtml),i=t.yearshtml=null},0))},_shouldFocusInput:function(e){return e.input&&e.input.is(":visible")&&!e.input.is(":disabled")&&!e.input.is(":focus")},_checkOffset:function(t,i,s){var n=t.dpDiv.outerWidth(),a=t.dpDiv.outerHeight(),o=t.input?t.input.outerWidth():0,r=t.input?t.input.outerHeight():0,h=document.documentElement.clientWidth+(s?0:e(document).scrollLeft()),l=document.documentElement.clientHeight+(s?0:e(document).scrollTop());return i.left-=this._get(t,"isRTL")?n-o:0,i.left-=s&&i.left===t.input.offset().left?e(document).scrollLeft():0,i.top-=s&&i.top===t.input.offset().top+r?e(document).scrollTop():0,i.left-=Math.min(i.left,i.left+n>h&&h>n?Math.abs(i.left+n-h):0),i.top-=Math.min(i.top,i.top+a>l&&l>a?Math.abs(a+r):0),i},_findPos:function(t){for(var i,s=this._getInst(t),n=this._get(s,"isRTL");t&&("hidden"===t.type||1!==t.nodeType||e.expr.filters.hidden(t));)t=t[n?"previousSibling":"nextSibling"];return i=e(t).offset(),[i.left,i.top]},_hideDatepicker:function(t){var i,s,n,a,o=this._curInst;!o||t&&o!==e.data(t,"datepicker")||this._datepickerShowing&&(i=this._get(o,"showAnim"),s=this._get(o,"duration"),n=function(){e.datepicker._tidyDialog(o)},e.effects&&(e.effects.effect[i]||e.effects[i])?o.dpDiv.hide(i,e.datepicker._get(o,"showOptions"),s,n):o.dpDiv["slideDown"===i?"slideUp":"fadeIn"===i?"fadeOut":"hide"](i?s:null,n),i||n(),this._datepickerShowing=!1,a=this._get(o,"onClose"),a&&a.apply(o.input?o.input[0]:null,[o.input?o.input.val():"",o]),this._lastInput=null,this._inDialog&&(this._dialogInput.css({position:"absolute",left:"0",top:"-100px"}),e.blockUI&&(e.unblockUI(),e("body").append(this.dpDiv))),this._inDialog=!1)},_tidyDialog:function(e){e.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar")},_checkExternalClick:function(t){if(e.datepicker._curInst){var i=e(t.target),s=e.datepicker._getInst(i[0]);(i[0].id!==e.datepicker._mainDivId&&0===i.parents("#"+e.datepicker._mainDivId).length&&!i.hasClass(e.datepicker.markerClassName)&&!i.closest("."+e.datepicker._triggerClass).length&&e.datepicker._datepickerShowing&&(!e.datepicker._inDialog||!e.blockUI)||i.hasClass(e.datepicker.markerClassName)&&e.datepicker._curInst!==s)&&e.datepicker._hideDatepicker()}},_adjustDate:function(t,i,s){var n=e(t),a=this._getInst(n[0]);this._isDisabledDatepicker(n[0])||(this._adjustInstDate(a,i+("M"===s?this._get(a,"showCurrentAtPos"):0),s),this._updateDatepicker(a))},_gotoToday:function(t){var i,s=e(t),n=this._getInst(s[0]);this._get(n,"gotoCurrent")&&n.currentDay?(n.selectedDay=n.currentDay,n.drawMonth=n.selectedMonth=n.currentMonth,n.drawYear=n.selectedYear=n.currentYear):(i=new Date,n.selectedDay=i.getDate(),n.drawMonth=n.selectedMonth=i.getMonth(),n.drawYear=n.selectedYear=i.getFullYear()),this._notifyChange(n),this._adjustDate(s)},_selectMonthYear:function(t,i,s){var n=e(t),a=this._getInst(n[0]);a["selected"+("M"===s?"Month":"Year")]=a["draw"+("M"===s?"Month":"Year")]=parseInt(i.options[i.selectedIndex].value,10),this._notifyChange(a),this._adjustDate(n)},_selectDay:function(t,i,s,n){var a,o=e(t);e(n).hasClass(this._unselectableClass)||this._isDisabledDatepicker(o[0])||(a=this._getInst(o[0]),a.selectedDay=a.currentDay=e("a",n).html(),a.selectedMonth=a.currentMonth=i,a.selectedYear=a.currentYear=s,this._selectDate(t,this._formatDate(a,a.currentDay,a.currentMonth,a.currentYear)))},_clearDate:function(t){var i=e(t);this._selectDate(i,"")},_selectDate:function(t,i){var s,n=e(t),a=this._getInst(n[0]);i=null!=i?i:this._formatDate(a),a.input&&a.input.val(i),this._updateAlternate(a),s=this._get(a,"onSelect"),s?s.apply(a.input?a.input[0]:null,[i,a]):a.input&&a.input.trigger("change"),a.inline?this._updateDatepicker(a):(this._hideDatepicker(),this._lastInput=a.input[0],"object"!=typeof a.input[0]&&a.input.focus(),this._lastInput=null)},_updateAlternate:function(t){var i,s,n,a=this._get(t,"altField");a&&(i=this._get(t,"altFormat")||this._get(t,"dateFormat"),s=this._getDate(t),n=this.formatDate(i,s,this._getFormatConfig(t)),e(a).each(function(){e(this).val(n)}))},noWeekends:function(e){var t=e.getDay();return[t>0&&6>t,""]},iso8601Week:function(e){var t,i=new Date(e.getTime());return i.setDate(i.getDate()+4-(i.getDay()||7)),t=i.getTime(),i.setMonth(0),i.setDate(1),Math.floor(Math.round((t-i)/864e5)/7)+1},parseDate:function(t,i,s){if(null==t||null==i)throw"Invalid arguments";if(i="object"==typeof i?""+i:i+"",""===i)return null;var n,a,o,r,h=0,l=(s?s.shortYearCutoff:null)||this._defaults.shortYearCutoff,u="string"!=typeof l?l:(new Date).getFullYear()%100+parseInt(l,10),d=(s?s.dayNamesShort:null)||this._defaults.dayNamesShort,c=(s?s.dayNames:null)||this._defaults.dayNames,p=(s?s.monthNamesShort:null)||this._defaults.monthNamesShort,f=(s?s.monthNames:null)||this._defaults.monthNames,m=-1,g=-1,v=-1,y=-1,b=!1,_=function(e){var i=t.length>n+1&&t.charAt(n+1)===e;return i&&n++,i},x=function(e){var t=_(e),s="@"===e?14:"!"===e?20:"y"===e&&t?4:"o"===e?3:2,n="y"===e?s:1,a=RegExp("^\\d{"+n+","+s+"}"),o=i.substring(h).match(a);if(!o)throw"Missing number at position "+h;return h+=o[0].length,parseInt(o[0],10)},w=function(t,s,n){var a=-1,o=e.map(_(t)?n:s,function(e,t){return[[t,e]]}).sort(function(e,t){return-(e[1].length-t[1].length)});if(e.each(o,function(e,t){var s=t[1];return i.substr(h,s.length).toLowerCase()===s.toLowerCase()?(a=t[0],h+=s.length,!1):void 0}),-1!==a)return a+1;throw"Unknown name at position "+h},k=function(){if(i.charAt(h)!==t.charAt(n))throw"Unexpected literal at position "+h;h++};for(n=0;t.length>n;n++)if(b)"'"!==t.charAt(n)||_("'")?k():b=!1;else switch(t.charAt(n)){case"d":v=x("d");break;case"D":w("D",d,c);break;case"o":y=x("o");break;case"m":g=x("m");break;case"M":g=w("M",p,f);break;case"y":m=x("y");break;case"@":r=new Date(x("@")),m=r.getFullYear(),g=r.getMonth()+1,v=r.getDate();break;case"!":r=new Date((x("!")-this._ticksTo1970)/1e4),m=r.getFullYear(),g=r.getMonth()+1,v=r.getDate();break;case"'":_("'")?k():b=!0;break;default:k()}if(i.length>h&&(o=i.substr(h),!/^\s+/.test(o)))throw"Extra/unparsed characters found in date: "+o;if(-1===m?m=(new Date).getFullYear():100>m&&(m+=(new Date).getFullYear()-(new Date).getFullYear()%100+(u>=m?0:-100)),y>-1)for(g=1,v=y;;){if(a=this._getDaysInMonth(m,g-1),a>=v)break;g++,v-=a}if(r=this._daylightSavingAdjust(new Date(m,g-1,v)),r.getFullYear()!==m||r.getMonth()+1!==g||r.getDate()!==v)throw"Invalid date";return r},ATOM:"yy-mm-dd",COOKIE:"D, dd M yy",ISO_8601:"yy-mm-dd",RFC_822:"D, d M y",RFC_850:"DD, dd-M-y",RFC_1036:"D, d M y",RFC_1123:"D, d M yy",RFC_2822:"D, d M yy",RSS:"D, d M y",TICKS:"!",TIMESTAMP:"@",W3C:"yy-mm-dd",_ticksTo1970:1e7*60*60*24*(718685+Math.floor(492.5)-Math.floor(19.7)+Math.floor(4.925)),formatDate:function(e,t,i){if(!t)return"";var s,n=(i?i.dayNamesShort:null)||this._defaults.dayNamesShort,a=(i?i.dayNames:null)||this._defaults.dayNames,o=(i?i.monthNamesShort:null)||this._defaults.monthNamesShort,r=(i?i.monthNames:null)||this._defaults.monthNames,h=function(t){var i=e.length>s+1&&e.charAt(s+1)===t;return i&&s++,i},l=function(e,t,i){var s=""+t;if(h(e))for(;i>s.length;)s="0"+s;return s},u=function(e,t,i,s){return h(e)?s[t]:i[t]},d="",c=!1;if(t)for(s=0;e.length>s;s++)if(c)"'"!==e.charAt(s)||h("'")?d+=e.charAt(s):c=!1;else switch(e.charAt(s)){case"d":d+=l("d",t.getDate(),2);break;case"D":d+=u("D",t.getDay(),n,a);break;case"o":d+=l("o",Math.round((new Date(t.getFullYear(),t.getMonth(),t.getDate()).getTime()-new Date(t.getFullYear(),0,0).getTime())/864e5),3);break;case"m":d+=l("m",t.getMonth()+1,2);break;case"M":d+=u("M",t.getMonth(),o,r);break;case"y":d+=h("y")?t.getFullYear():(10>t.getYear()%100?"0":"")+t.getYear()%100;break;case"@":d+=t.getTime();break;case"!":d+=1e4*t.getTime()+this._ticksTo1970;break;case"'":h("'")?d+="'":c=!0;break;default:d+=e.charAt(s)}return d},_possibleChars:function(e){var t,i="",s=!1,n=function(i){var s=e.length>t+1&&e.charAt(t+1)===i;return s&&t++,s};for(t=0;e.length>t;t++)if(s)"'"!==e.charAt(t)||n("'")?i+=e.charAt(t):s=!1;else switch(e.charAt(t)){case"d":case"m":case"y":case"@":i+="0123456789";break;case"D":case"M":return null;case"'":n("'")?i+="'":s=!0;break;default:i+=e.charAt(t)}return i},_get:function(e,t){return void 0!==e.settings[t]?e.settings[t]:this._defaults[t]},_setDateFromField:function(e,t){if(e.input.val()!==e.lastVal){var i=this._get(e,"dateFormat"),s=e.lastVal=e.input?e.input.val():null,n=this._getDefaultDate(e),a=n,o=this._getFormatConfig(e);try{a=this.parseDate(i,s,o)||n}catch(r){s=t?"":s}e.selectedDay=a.getDate(),e.drawMonth=e.selectedMonth=a.getMonth(),e.drawYear=e.selectedYear=a.getFullYear(),e.currentDay=s?a.getDate():0,e.currentMonth=s?a.getMonth():0,e.currentYear=s?a.getFullYear():0,this._adjustInstDate(e)}},_getDefaultDate:function(e){return this._restrictMinMax(e,this._determineDate(e,this._get(e,"defaultDate"),new Date))},_determineDate:function(t,i,s){var n=function(e){var t=new Date;return t.setDate(t.getDate()+e),t},a=function(i){try{return e.datepicker.parseDate(e.datepicker._get(t,"dateFormat"),i,e.datepicker._getFormatConfig(t))}catch(s){}for(var n=(i.toLowerCase().match(/^c/)?e.datepicker._getDate(t):null)||new Date,a=n.getFullYear(),o=n.getMonth(),r=n.getDate(),h=/([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g,l=h.exec(i);l;){switch(l[2]||"d"){case"d":case"D":r+=parseInt(l[1],10);break;case"w":case"W":r+=7*parseInt(l[1],10);break;case"m":case"M":o+=parseInt(l[1],10),r=Math.min(r,e.datepicker._getDaysInMonth(a,o));break;case"y":case"Y":a+=parseInt(l[1],10),r=Math.min(r,e.datepicker._getDaysInMonth(a,o))}l=h.exec(i)}return new Date(a,o,r)},o=null==i||""===i?s:"string"==typeof i?a(i):"number"==typeof i?isNaN(i)?s:n(i):new Date(i.getTime());return o=o&&"Invalid Date"==""+o?s:o,o&&(o.setHours(0),o.setMinutes(0),o.setSeconds(0),o.setMilliseconds(0)),this._daylightSavingAdjust(o)},_daylightSavingAdjust:function(e){return e?(e.setHours(e.getHours()>12?e.getHours()+2:0),e):null},_setDate:function(e,t,i){var s=!t,n=e.selectedMonth,a=e.selectedYear,o=this._restrictMinMax(e,this._determineDate(e,t,new Date));e.selectedDay=e.currentDay=o.getDate(),e.drawMonth=e.selectedMonth=e.currentMonth=o.getMonth(),e.drawYear=e.selectedYear=e.currentYear=o.getFullYear(),n===e.selectedMonth&&a===e.selectedYear||i||this._notifyChange(e),this._adjustInstDate(e),e.input&&e.input.val(s?"":this._formatDate(e))},_getDate:function(e){var t=!e.currentYear||e.input&&""===e.input.val()?null:this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return t},_attachHandlers:function(t){var i=this._get(t,"stepMonths"),s="#"+t.id.replace(/\\\\/g,"\\");t.dpDiv.find("[data-handler]").map(function(){var t={prev:function(){e.datepicker._adjustDate(s,-i,"M")},next:function(){e.datepicker._adjustDate(s,+i,"M")},hide:function(){e.datepicker._hideDatepicker()},today:function(){e.datepicker._gotoToday(s)},selectDay:function(){return e.datepicker._selectDay(s,+this.getAttribute("data-month"),+this.getAttribute("data-year"),this),!1},selectMonth:function(){return e.datepicker._selectMonthYear(s,this,"M"),!1},selectYear:function(){return e.datepicker._selectMonthYear(s,this,"Y"),!1}};e(this).bind(this.getAttribute("data-event"),t[this.getAttribute("data-handler")])})},_generateHTML:function(e){var t,i,s,n,a,o,r,h,l,u,d,c,p,f,m,g,v,y,b,_,x,w,k,T,D,S,M,C,N,A,P,I,H,z,F,E,O,j,W,L=new Date,R=this._daylightSavingAdjust(new Date(L.getFullYear(),L.getMonth(),L.getDate())),Y=this._get(e,"isRTL"),B=this._get(e,"showButtonPanel"),J=this._get(e,"hideIfNoPrevNext"),q=this._get(e,"navigationAsDateFormat"),K=this._getNumberOfMonths(e),V=this._get(e,"showCurrentAtPos"),U=this._get(e,"stepMonths"),Q=1!==K[0]||1!==K[1],G=this._daylightSavingAdjust(e.currentDay?new Date(e.currentYear,e.currentMonth,e.currentDay):new Date(9999,9,9)),X=this._getMinMaxDate(e,"min"),$=this._getMinMaxDate(e,"max"),Z=e.drawMonth-V,et=e.drawYear;if(0>Z&&(Z+=12,et--),$)for(t=this._daylightSavingAdjust(new Date($.getFullYear(),$.getMonth()-K[0]*K[1]+1,$.getDate())),t=X&&X>t?X:t;this._daylightSavingAdjust(new Date(et,Z,1))>t;)Z--,0>Z&&(Z=11,et--);for(e.drawMonth=Z,e.drawYear=et,i=this._get(e,"prevText"),i=q?this.formatDate(i,this._daylightSavingAdjust(new Date(et,Z-U,1)),this._getFormatConfig(e)):i,s=this._canAdjustMonth(e,-1,et,Z)?"<a class='ui-datepicker-prev ui-corner-all' data-handler='prev' data-event='click' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"e":"w")+"'>"+i+"</span></a>":J?"":"<a class='ui-datepicker-prev ui-corner-all ui-state-disabled' title='"+i+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"e":"w")+"'>"+i+"</span></a>",n=this._get(e,"nextText"),n=q?this.formatDate(n,this._daylightSavingAdjust(new Date(et,Z+U,1)),this._getFormatConfig(e)):n,a=this._canAdjustMonth(e,1,et,Z)?"<a class='ui-datepicker-next ui-corner-all' data-handler='next' data-event='click' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"w":"e")+"'>"+n+"</span></a>":J?"":"<a class='ui-datepicker-next ui-corner-all ui-state-disabled' title='"+n+"'><span class='ui-icon ui-icon-circle-triangle-"+(Y?"w":"e")+"'>"+n+"</span></a>",o=this._get(e,"currentText"),r=this._get(e,"gotoCurrent")&&e.currentDay?G:R,o=q?this.formatDate(o,r,this._getFormatConfig(e)):o,h=e.inline?"":"<button type='button' class='ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler='hide' data-event='click'>"+this._get(e,"closeText")+"</button>",l=B?"<div class='ui-datepicker-buttonpane ui-widget-content'>"+(Y?h:"")+(this._isInRange(e,r)?"<button type='button' class='ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler='today' data-event='click'>"+o+"</button>":"")+(Y?"":h)+"</div>":"",u=parseInt(this._get(e,"firstDay"),10),u=isNaN(u)?0:u,d=this._get(e,"showWeek"),c=this._get(e,"dayNames"),p=this._get(e,"dayNamesMin"),f=this._get(e,"monthNames"),m=this._get(e,"monthNamesShort"),g=this._get(e,"beforeShowDay"),v=this._get(e,"showOtherMonths"),y=this._get(e,"selectOtherMonths"),b=this._getDefaultDate(e),_="",w=0;K[0]>w;w++){for(k="",this.maxRows=4,T=0;K[1]>T;T++){if(D=this._daylightSavingAdjust(new Date(et,Z,e.selectedDay)),S=" ui-corner-all",M="",Q){if(M+="<div class='ui-datepicker-group",K[1]>1)switch(T){case 0:M+=" ui-datepicker-group-first",S=" ui-corner-"+(Y?"right":"left");break;case K[1]-1:M+=" ui-datepicker-group-last",S=" ui-corner-"+(Y?"left":"right");break;default:M+=" ui-datepicker-group-middle",S=""}M+="'>"}for(M+="<div class='ui-datepicker-header ui-widget-header ui-helper-clearfix"+S+"'>"+(/all|left/.test(S)&&0===w?Y?a:s:"")+(/all|right/.test(S)&&0===w?Y?s:a:"")+this._generateMonthYearHeader(e,Z,et,X,$,w>0||T>0,f,m)+"</div><table class='ui-datepicker-calendar'><thead>"+"<tr>",C=d?"<th class='ui-datepicker-week-col'>"+this._get(e,"weekHeader")+"</th>":"",x=0;7>x;x++)N=(x+u)%7,C+="<th scope='col'"+((x+u+6)%7>=5?" class='ui-datepicker-week-end'":"")+">"+"<span title='"+c[N]+"'>"+p[N]+"</span></th>";for(M+=C+"</tr></thead><tbody>",A=this._getDaysInMonth(et,Z),et===e.selectedYear&&Z===e.selectedMonth&&(e.selectedDay=Math.min(e.selectedDay,A)),P=(this._getFirstDayOfMonth(et,Z)-u+7)%7,I=Math.ceil((P+A)/7),H=Q?this.maxRows>I?this.maxRows:I:I,this.maxRows=H,z=this._daylightSavingAdjust(new Date(et,Z,1-P)),F=0;H>F;F++){for(M+="<tr>",E=d?"<td class='ui-datepicker-week-col'>"+this._get(e,"calculateWeek")(z)+"</td>":"",x=0;7>x;x++)O=g?g.apply(e.input?e.input[0]:null,[z]):[!0,""],j=z.getMonth()!==Z,W=j&&!y||!O[0]||X&&X>z||$&&z>$,E+="<td class='"+((x+u+6)%7>=5?" ui-datepicker-week-end":"")+(j?" ui-datepicker-other-month":"")+(z.getTime()===D.getTime()&&Z===e.selectedMonth&&e._keyEvent||b.getTime()===z.getTime()&&b.getTime()===D.getTime()?" "+this._dayOverClass:"")+(W?" "+this._unselectableClass+" ui-state-disabled":"")+(j&&!v?"":" "+O[1]+(z.getTime()===G.getTime()?" "+this._currentClass:"")+(z.getTime()===R.getTime()?" ui-datepicker-today":""))+"'"+(j&&!v||!O[2]?"":" title='"+O[2].replace(/'/g,"&#39;")+"'")+(W?"":" data-handler='selectDay' data-event='click' data-month='"+z.getMonth()+"' data-year='"+z.getFullYear()+"'")+">"+(j&&!v?"&#xa0;":W?"<span class='ui-state-default'>"+z.getDate()+"</span>":"<a class='ui-state-default"+(z.getTime()===R.getTime()?" ui-state-highlight":"")+(z.getTime()===G.getTime()?" ui-state-active":"")+(j?" ui-priority-secondary":"")+"' href='#'>"+z.getDate()+"</a>")+"</td>",z.setDate(z.getDate()+1),z=this._daylightSavingAdjust(z);M+=E+"</tr>"}Z++,Z>11&&(Z=0,et++),M+="</tbody></table>"+(Q?"</div>"+(K[0]>0&&T===K[1]-1?"<div class='ui-datepicker-row-break'></div>":""):""),k+=M}_+=k}return _+=l,e._keyEvent=!1,_},_generateMonthYearHeader:function(e,t,i,s,n,a,o,r){var h,l,u,d,c,p,f,m,g=this._get(e,"changeMonth"),v=this._get(e,"changeYear"),y=this._get(e,"showMonthAfterYear"),b="<div class='ui-datepicker-title'>",_="";if(a||!g)_+="<span class='ui-datepicker-month'>"+o[t]+"</span>";else{for(h=s&&s.getFullYear()===i,l=n&&n.getFullYear()===i,_+="<select class='ui-datepicker-month' data-handler='selectMonth' data-event='change'>",u=0;12>u;u++)(!h||u>=s.getMonth())&&(!l||n.getMonth()>=u)&&(_+="<option value='"+u+"'"+(u===t?" selected='selected'":"")+">"+r[u]+"</option>");_+="</select>"}if(y||(b+=_+(!a&&g&&v?"":"&#xa0;")),!e.yearshtml)if(e.yearshtml="",a||!v)b+="<span class='ui-datepicker-year'>"+i+"</span>";else{for(d=this._get(e,"yearRange").split(":"),c=(new Date).getFullYear(),p=function(e){var t=e.match(/c[+\-].*/)?i+parseInt(e.substring(1),10):e.match(/[+\-].*/)?c+parseInt(e,10):parseInt(e,10);return isNaN(t)?c:t},f=p(d[0]),m=Math.max(f,p(d[1]||"")),f=s?Math.max(f,s.getFullYear()):f,m=n?Math.min(m,n.getFullYear()):m,e.yearshtml+="<select class='ui-datepicker-year' data-handler='selectYear' data-event='change'>";m>=f;f++)e.yearshtml+="<option value='"+f+"'"+(f===i?" selected='selected'":"")+">"+f+"</option>";e.yearshtml+="</select>",b+=e.yearshtml,e.yearshtml=null}return b+=this._get(e,"yearSuffix"),y&&(b+=(!a&&g&&v?"":"&#xa0;")+_),b+="</div>"},_adjustInstDate:function(e,t,i){var s=e.drawYear+("Y"===i?t:0),n=e.drawMonth+("M"===i?t:0),a=Math.min(e.selectedDay,this._getDaysInMonth(s,n))+("D"===i?t:0),o=this._restrictMinMax(e,this._daylightSavingAdjust(new Date(s,n,a)));e.selectedDay=o.getDate(),e.drawMonth=e.selectedMonth=o.getMonth(),e.drawYear=e.selectedYear=o.getFullYear(),("M"===i||"Y"===i)&&this._notifyChange(e)},_restrictMinMax:function(e,t){var i=this._getMinMaxDate(e,"min"),s=this._getMinMaxDate(e,"max"),n=i&&i>t?i:t;return s&&n>s?s:n},_notifyChange:function(e){var t=this._get(e,"onChangeMonthYear");t&&t.apply(e.input?e.input[0]:null,[e.selectedYear,e.selectedMonth+1,e])},_getNumberOfMonths:function(e){var t=this._get(e,"numberOfMonths");return null==t?[1,1]:"number"==typeof t?[1,t]:t},_getMinMaxDate:function(e,t){return this._determineDate(e,this._get(e,t+"Date"),null)},_getDaysInMonth:function(e,t){return 32-this._daylightSavingAdjust(new Date(e,t,32)).getDate()},_getFirstDayOfMonth:function(e,t){return new Date(e,t,1).getDay()},_canAdjustMonth:function(e,t,i,s){var n=this._getNumberOfMonths(e),a=this._daylightSavingAdjust(new Date(i,s+(0>t?t:n[0]*n[1]),1));return 0>t&&a.setDate(this._getDaysInMonth(a.getFullYear(),a.getMonth())),this._isInRange(e,a)},_isInRange:function(e,t){var i,s,n=this._getMinMaxDate(e,"min"),a=this._getMinMaxDate(e,"max"),o=null,r=null,h=this._get(e,"yearRange");return h&&(i=h.split(":"),s=(new Date).getFullYear(),o=parseInt(i[0],10),r=parseInt(i[1],10),i[0].match(/[+\-].*/)&&(o+=s),i[1].match(/[+\-].*/)&&(r+=s)),(!n||t.getTime()>=n.getTime())&&(!a||t.getTime()<=a.getTime())&&(!o||t.getFullYear()>=o)&&(!r||r>=t.getFullYear())},_getFormatConfig:function(e){var t=this._get(e,"shortYearCutoff");return t="string"!=typeof t?t:(new Date).getFullYear()%100+parseInt(t,10),{shortYearCutoff:t,dayNamesShort:this._get(e,"dayNamesShort"),dayNames:this._get(e,"dayNames"),monthNamesShort:this._get(e,"monthNamesShort"),monthNames:this._get(e,"monthNames")}},_formatDate:function(e,t,i,s){t||(e.currentDay=e.selectedDay,e.currentMonth=e.selectedMonth,e.currentYear=e.selectedYear);var n=t?"object"==typeof t?t:this._daylightSavingAdjust(new Date(s,i,t)):this._daylightSavingAdjust(new Date(e.currentYear,e.currentMonth,e.currentDay));return this.formatDate(this._get(e,"dateFormat"),n,this._getFormatConfig(e))}}),e.fn.datepicker=function(t){if(!this.length)return this;e.datepicker.initialized||(e(document).mousedown(e.datepicker._checkExternalClick),e.datepicker.initialized=!0),0===e("#"+e.datepicker._mainDivId).length&&e("body").append(e.datepicker.dpDiv);var i=Array.prototype.slice.call(arguments,1);return"string"!=typeof t||"isDisabled"!==t&&"getDate"!==t&&"widget"!==t?"option"===t&&2===arguments.length&&"string"==typeof arguments[1]?e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this[0]].concat(i)):this.each(function(){"string"==typeof t?e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this].concat(i)):e.datepicker._attachDatepicker(this,t)}):e.datepicker["_"+t+"Datepicker"].apply(e.datepicker,[this[0]].concat(i))},e.datepicker=new n,e.datepicker.initialized=!1,e.datepicker.uuid=(new Date).getTime(),e.datepicker.version="1.11.4",e.datepicker,e.widget("ui.dialog",{version:"1.11.4",options:{appendTo:"body",autoOpen:!0,buttons:[],closeOnEscape:!0,closeText:"Close",dialogClass:"",draggable:!0,hide:null,height:"auto",maxHeight:null,maxWidth:null,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",of:window,collision:"fit",using:function(t){var i=e(this).css(t).offset().top;0>i&&e(this).css("top",t.top-i)}},resizable:!0,show:null,title:null,width:300,beforeClose:null,close:null,drag:null,dragStart:null,dragStop:null,focus:null,open:null,resize:null,resizeStart:null,resizeStop:null},sizeRelatedOptions:{buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},resizableRelatedOptions:{maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0},_create:function(){this.originalCss={display:this.element[0].style.display,width:this.element[0].style.width,minHeight:this.element[0].style.minHeight,maxHeight:this.element[0].style.maxHeight,height:this.element[0].style.height},this.originalPosition={parent:this.element.parent(),index:this.element.parent().children().index(this.element)},this.originalTitle=this.element.attr("title"),this.options.title=this.options.title||this.originalTitle,this._createWrapper(),this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog),this._createTitlebar(),this._createButtonPane(),this.options.draggable&&e.fn.draggable&&this._makeDraggable(),this.options.resizable&&e.fn.resizable&&this._makeResizable(),this._isOpen=!1,this._trackFocus()},_init:function(){this.options.autoOpen&&this.open()},_appendTo:function(){var t=this.options.appendTo;return t&&(t.jquery||t.nodeType)?e(t):this.document.find(t||"body").eq(0)},_destroy:function(){var e,t=this.originalPosition;this._untrackInstance(),this._destroyOverlay(),this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(),this.uiDialog.stop(!0,!0).remove(),this.originalTitle&&this.element.attr("title",this.originalTitle),e=t.parent.children().eq(t.index),e.length&&e[0]!==this.element[0]?e.before(this.element):t.parent.append(this.element)},widget:function(){return this.uiDialog},disable:e.noop,enable:e.noop,close:function(t){var i,s=this;if(this._isOpen&&this._trigger("beforeClose",t)!==!1){if(this._isOpen=!1,this._focusedElement=null,this._destroyOverlay(),this._untrackInstance(),!this.opener.filter(":focusable").focus().length)try{i=this.document[0].activeElement,i&&"body"!==i.nodeName.toLowerCase()&&e(i).blur()}catch(n){}this._hide(this.uiDialog,this.options.hide,function(){s._trigger("close",t)})}},isOpen:function(){return this._isOpen},moveToTop:function(){this._moveToTop()},_moveToTop:function(t,i){var s=!1,n=this.uiDialog.siblings(".ui-front:visible").map(function(){return+e(this).css("z-index")}).get(),a=Math.max.apply(null,n);return a>=+this.uiDialog.css("z-index")&&(this.uiDialog.css("z-index",a+1),s=!0),s&&!i&&this._trigger("focus",t),s},open:function(){var t=this;
return this._isOpen?(this._moveToTop()&&this._focusTabbable(),void 0):(this._isOpen=!0,this.opener=e(this.document[0].activeElement),this._size(),this._position(),this._createOverlay(),this._moveToTop(null,!0),this.overlay&&this.overlay.css("z-index",this.uiDialog.css("z-index")-1),this._show(this.uiDialog,this.options.show,function(){t._focusTabbable(),t._trigger("focus")}),this._makeFocusTarget(),this._trigger("open"),void 0)},_focusTabbable:function(){var e=this._focusedElement;e||(e=this.element.find("[autofocus]")),e.length||(e=this.element.find(":tabbable")),e.length||(e=this.uiDialogButtonPane.find(":tabbable")),e.length||(e=this.uiDialogTitlebarClose.filter(":tabbable")),e.length||(e=this.uiDialog),e.eq(0).focus()},_keepFocus:function(t){function i(){var t=this.document[0].activeElement,i=this.uiDialog[0]===t||e.contains(this.uiDialog[0],t);i||this._focusTabbable()}t.preventDefault(),i.call(this),this._delay(i)},_createWrapper:function(){this.uiDialog=e("<div>").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front "+this.options.dialogClass).hide().attr({tabIndex:-1,role:"dialog"}).appendTo(this._appendTo()),this._on(this.uiDialog,{keydown:function(t){if(this.options.closeOnEscape&&!t.isDefaultPrevented()&&t.keyCode&&t.keyCode===e.ui.keyCode.ESCAPE)return t.preventDefault(),this.close(t),void 0;if(t.keyCode===e.ui.keyCode.TAB&&!t.isDefaultPrevented()){var i=this.uiDialog.find(":tabbable"),s=i.filter(":first"),n=i.filter(":last");t.target!==n[0]&&t.target!==this.uiDialog[0]||t.shiftKey?t.target!==s[0]&&t.target!==this.uiDialog[0]||!t.shiftKey||(this._delay(function(){n.focus()}),t.preventDefault()):(this._delay(function(){s.focus()}),t.preventDefault())}},mousedown:function(e){this._moveToTop(e)&&this._focusTabbable()}}),this.element.find("[aria-describedby]").length||this.uiDialog.attr({"aria-describedby":this.element.uniqueId().attr("id")})},_createTitlebar:function(){var t;this.uiDialogTitlebar=e("<div>").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog),this._on(this.uiDialogTitlebar,{mousedown:function(t){e(t.target).closest(".ui-dialog-titlebar-close")||this.uiDialog.focus()}}),this.uiDialogTitlebarClose=e("<button type='button'></button>").button({label:this.options.closeText,icons:{primary:"ui-icon-closethick"},text:!1}).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar),this._on(this.uiDialogTitlebarClose,{click:function(e){e.preventDefault(),this.close(e)}}),t=e("<span>").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar),this._title(t),this.uiDialog.attr({"aria-labelledby":t.attr("id")})},_title:function(e){this.options.title||e.html("&#160;"),e.text(this.options.title)},_createButtonPane:function(){this.uiDialogButtonPane=e("<div>").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"),this.uiButtonSet=e("<div>").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane),this._createButtons()},_createButtons:function(){var t=this,i=this.options.buttons;return this.uiDialogButtonPane.remove(),this.uiButtonSet.empty(),e.isEmptyObject(i)||e.isArray(i)&&!i.length?(this.uiDialog.removeClass("ui-dialog-buttons"),void 0):(e.each(i,function(i,s){var n,a;s=e.isFunction(s)?{click:s,text:i}:s,s=e.extend({type:"button"},s),n=s.click,s.click=function(){n.apply(t.element[0],arguments)},a={icons:s.icons,text:s.showText},delete s.icons,delete s.showText,e("<button></button>",s).button(a).appendTo(t.uiButtonSet)}),this.uiDialog.addClass("ui-dialog-buttons"),this.uiDialogButtonPane.appendTo(this.uiDialog),void 0)},_makeDraggable:function(){function t(e){return{position:e.position,offset:e.offset}}var i=this,s=this.options;this.uiDialog.draggable({cancel:".ui-dialog-content, .ui-dialog-titlebar-close",handle:".ui-dialog-titlebar",containment:"document",start:function(s,n){e(this).addClass("ui-dialog-dragging"),i._blockFrames(),i._trigger("dragStart",s,t(n))},drag:function(e,s){i._trigger("drag",e,t(s))},stop:function(n,a){var o=a.offset.left-i.document.scrollLeft(),r=a.offset.top-i.document.scrollTop();s.position={my:"left top",at:"left"+(o>=0?"+":"")+o+" "+"top"+(r>=0?"+":"")+r,of:i.window},e(this).removeClass("ui-dialog-dragging"),i._unblockFrames(),i._trigger("dragStop",n,t(a))}})},_makeResizable:function(){function t(e){return{originalPosition:e.originalPosition,originalSize:e.originalSize,position:e.position,size:e.size}}var i=this,s=this.options,n=s.resizable,a=this.uiDialog.css("position"),o="string"==typeof n?n:"n,e,s,w,se,sw,ne,nw";this.uiDialog.resizable({cancel:".ui-dialog-content",containment:"document",alsoResize:this.element,maxWidth:s.maxWidth,maxHeight:s.maxHeight,minWidth:s.minWidth,minHeight:this._minHeight(),handles:o,start:function(s,n){e(this).addClass("ui-dialog-resizing"),i._blockFrames(),i._trigger("resizeStart",s,t(n))},resize:function(e,s){i._trigger("resize",e,t(s))},stop:function(n,a){var o=i.uiDialog.offset(),r=o.left-i.document.scrollLeft(),h=o.top-i.document.scrollTop();s.height=i.uiDialog.height(),s.width=i.uiDialog.width(),s.position={my:"left top",at:"left"+(r>=0?"+":"")+r+" "+"top"+(h>=0?"+":"")+h,of:i.window},e(this).removeClass("ui-dialog-resizing"),i._unblockFrames(),i._trigger("resizeStop",n,t(a))}}).css("position",a)},_trackFocus:function(){this._on(this.widget(),{focusin:function(t){this._makeFocusTarget(),this._focusedElement=e(t.target)}})},_makeFocusTarget:function(){this._untrackInstance(),this._trackingInstances().unshift(this)},_untrackInstance:function(){var t=this._trackingInstances(),i=e.inArray(this,t);-1!==i&&t.splice(i,1)},_trackingInstances:function(){var e=this.document.data("ui-dialog-instances");return e||(e=[],this.document.data("ui-dialog-instances",e)),e},_minHeight:function(){var e=this.options;return"auto"===e.height?e.minHeight:Math.min(e.minHeight,e.height)},_position:function(){var e=this.uiDialog.is(":visible");e||this.uiDialog.show(),this.uiDialog.position(this.options.position),e||this.uiDialog.hide()},_setOptions:function(t){var i=this,s=!1,n={};e.each(t,function(e,t){i._setOption(e,t),e in i.sizeRelatedOptions&&(s=!0),e in i.resizableRelatedOptions&&(n[e]=t)}),s&&(this._size(),this._position()),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option",n)},_setOption:function(e,t){var i,s,n=this.uiDialog;"dialogClass"===e&&n.removeClass(this.options.dialogClass).addClass(t),"disabled"!==e&&(this._super(e,t),"appendTo"===e&&this.uiDialog.appendTo(this._appendTo()),"buttons"===e&&this._createButtons(),"closeText"===e&&this.uiDialogTitlebarClose.button({label:""+t}),"draggable"===e&&(i=n.is(":data(ui-draggable)"),i&&!t&&n.draggable("destroy"),!i&&t&&this._makeDraggable()),"position"===e&&this._position(),"resizable"===e&&(s=n.is(":data(ui-resizable)"),s&&!t&&n.resizable("destroy"),s&&"string"==typeof t&&n.resizable("option","handles",t),s||t===!1||this._makeResizable()),"title"===e&&this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))},_size:function(){var e,t,i,s=this.options;this.element.show().css({width:"auto",minHeight:0,maxHeight:"none",height:0}),s.minWidth>s.width&&(s.width=s.minWidth),e=this.uiDialog.css({height:"auto",width:s.width}).outerHeight(),t=Math.max(0,s.minHeight-e),i="number"==typeof s.maxHeight?Math.max(0,s.maxHeight-e):"none","auto"===s.height?this.element.css({minHeight:t,maxHeight:i,height:"auto"}):this.element.height(Math.max(0,s.height-e)),this.uiDialog.is(":data(ui-resizable)")&&this.uiDialog.resizable("option","minHeight",this._minHeight())},_blockFrames:function(){this.iframeBlocks=this.document.find("iframe").map(function(){var t=e(this);return e("<div>").css({position:"absolute",width:t.outerWidth(),height:t.outerHeight()}).appendTo(t.parent()).offset(t.offset())[0]})},_unblockFrames:function(){this.iframeBlocks&&(this.iframeBlocks.remove(),delete this.iframeBlocks)},_allowInteraction:function(t){return e(t.target).closest(".ui-dialog").length?!0:!!e(t.target).closest(".ui-datepicker").length},_createOverlay:function(){if(this.options.modal){var t=!0;this._delay(function(){t=!1}),this.document.data("ui-dialog-overlays")||this._on(this.document,{focusin:function(e){t||this._allowInteraction(e)||(e.preventDefault(),this._trackingInstances()[0]._focusTabbable())}}),this.overlay=e("<div>").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()),this._on(this.overlay,{mousedown:"_keepFocus"}),this.document.data("ui-dialog-overlays",(this.document.data("ui-dialog-overlays")||0)+1)}},_destroyOverlay:function(){if(this.options.modal&&this.overlay){var e=this.document.data("ui-dialog-overlays")-1;e?this.document.data("ui-dialog-overlays",e):this.document.unbind("focusin").removeData("ui-dialog-overlays"),this.overlay.remove(),this.overlay=null}}}),e.widget("ui.progressbar",{version:"1.11.4",options:{max:100,value:0,change:null,complete:null},min:0,_create:function(){this.oldValue=this.options.value=this._constrainedValue(),this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({role:"progressbar","aria-valuemin":this.min}),this.valueDiv=e("<div class='ui-progressbar-value ui-widget-header ui-corner-left'></div>").appendTo(this.element),this._refreshValue()},_destroy:function(){this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"),this.valueDiv.remove()},value:function(e){return void 0===e?this.options.value:(this.options.value=this._constrainedValue(e),this._refreshValue(),void 0)},_constrainedValue:function(e){return void 0===e&&(e=this.options.value),this.indeterminate=e===!1,"number"!=typeof e&&(e=0),this.indeterminate?!1:Math.min(this.options.max,Math.max(this.min,e))},_setOptions:function(e){var t=e.value;delete e.value,this._super(e),this.options.value=this._constrainedValue(t),this._refreshValue()},_setOption:function(e,t){"max"===e&&(t=Math.max(this.min,t)),"disabled"===e&&this.element.toggleClass("ui-state-disabled",!!t).attr("aria-disabled",t),this._super(e,t)},_percentage:function(){return this.indeterminate?100:100*(this.options.value-this.min)/(this.options.max-this.min)},_refreshValue:function(){var t=this.options.value,i=this._percentage();this.valueDiv.toggle(this.indeterminate||t>this.min).toggleClass("ui-corner-right",t===this.options.max).width(i.toFixed(0)+"%"),this.element.toggleClass("ui-progressbar-indeterminate",this.indeterminate),this.indeterminate?(this.element.removeAttr("aria-valuenow"),this.overlayDiv||(this.overlayDiv=e("<div class='ui-progressbar-overlay'></div>").appendTo(this.valueDiv))):(this.element.attr({"aria-valuemax":this.options.max,"aria-valuenow":t}),this.overlayDiv&&(this.overlayDiv.remove(),this.overlayDiv=null)),this.oldValue!==t&&(this.oldValue=t,this._trigger("change")),t===this.options.max&&this._trigger("complete")}}),e.widget("ui.selectmenu",{version:"1.11.4",defaultElement:"<select>",options:{appendTo:null,disabled:null,icons:{button:"ui-icon-triangle-1-s"},position:{my:"left top",at:"left bottom",collision:"none"},width:null,change:null,close:null,focus:null,open:null,select:null},_create:function(){var e=this.element.uniqueId().attr("id");this.ids={element:e,button:e+"-button",menu:e+"-menu"},this._drawButton(),this._drawMenu(),this.options.disabled&&this.disable()},_drawButton:function(){var t=this;this.label=e("label[for='"+this.ids.element+"']").attr("for",this.ids.button),this._on(this.label,{click:function(e){this.button.focus(),e.preventDefault()}}),this.element.hide(),this.button=e("<span>",{"class":"ui-selectmenu-button ui-widget ui-state-default ui-corner-all",tabindex:this.options.disabled?-1:0,id:this.ids.button,role:"combobox","aria-expanded":"false","aria-autocomplete":"list","aria-owns":this.ids.menu,"aria-haspopup":"true"}).insertAfter(this.element),e("<span>",{"class":"ui-icon "+this.options.icons.button}).prependTo(this.button),this.buttonText=e("<span>",{"class":"ui-selectmenu-text"}).appendTo(this.button),this._setText(this.buttonText,this.element.find("option:selected").text()),this._resizeButton(),this._on(this.button,this._buttonEvents),this.button.one("focusin",function(){t.menuItems||t._refreshMenu()}),this._hoverable(this.button),this._focusable(this.button)},_drawMenu:function(){var t=this;this.menu=e("<ul>",{"aria-hidden":"true","aria-labelledby":this.ids.button,id:this.ids.menu}),this.menuWrap=e("<div>",{"class":"ui-selectmenu-menu ui-front"}).append(this.menu).appendTo(this._appendTo()),this.menuInstance=this.menu.menu({role:"listbox",select:function(e,i){e.preventDefault(),t._setSelection(),t._select(i.item.data("ui-selectmenu-item"),e)},focus:function(e,i){var s=i.item.data("ui-selectmenu-item");null!=t.focusIndex&&s.index!==t.focusIndex&&(t._trigger("focus",e,{item:s}),t.isOpen||t._select(s,e)),t.focusIndex=s.index,t.button.attr("aria-activedescendant",t.menuItems.eq(s.index).attr("id"))}}).menu("instance"),this.menu.addClass("ui-corner-bottom").removeClass("ui-corner-all"),this.menuInstance._off(this.menu,"mouseleave"),this.menuInstance._closeOnDocumentClick=function(){return!1},this.menuInstance._isDivider=function(){return!1}},refresh:function(){this._refreshMenu(),this._setText(this.buttonText,this._getSelectedItem().text()),this.options.width||this._resizeButton()},_refreshMenu:function(){this.menu.empty();var e,t=this.element.find("option");t.length&&(this._parseOptions(t),this._renderMenu(this.menu,this.items),this.menuInstance.refresh(),this.menuItems=this.menu.find("li").not(".ui-selectmenu-optgroup"),e=this._getSelectedItem(),this.menuInstance.focus(null,e),this._setAria(e.data("ui-selectmenu-item")),this._setOption("disabled",this.element.prop("disabled")))},open:function(e){this.options.disabled||(this.menuItems?(this.menu.find(".ui-state-focus").removeClass("ui-state-focus"),this.menuInstance.focus(null,this._getSelectedItem())):this._refreshMenu(),this.isOpen=!0,this._toggleAttr(),this._resizeMenu(),this._position(),this._on(this.document,this._documentClick),this._trigger("open",e))},_position:function(){this.menuWrap.position(e.extend({of:this.button},this.options.position))},close:function(e){this.isOpen&&(this.isOpen=!1,this._toggleAttr(),this.range=null,this._off(this.document),this._trigger("close",e))},widget:function(){return this.button},menuWidget:function(){return this.menu},_renderMenu:function(t,i){var s=this,n="";e.each(i,function(i,a){a.optgroup!==n&&(e("<li>",{"class":"ui-selectmenu-optgroup ui-menu-divider"+(a.element.parent("optgroup").prop("disabled")?" ui-state-disabled":""),text:a.optgroup}).appendTo(t),n=a.optgroup),s._renderItemData(t,a)})},_renderItemData:function(e,t){return this._renderItem(e,t).data("ui-selectmenu-item",t)},_renderItem:function(t,i){var s=e("<li>");return i.disabled&&s.addClass("ui-state-disabled"),this._setText(s,i.label),s.appendTo(t)},_setText:function(e,t){t?e.text(t):e.html("&#160;")},_move:function(e,t){var i,s,n=".ui-menu-item";this.isOpen?i=this.menuItems.eq(this.focusIndex):(i=this.menuItems.eq(this.element[0].selectedIndex),n+=":not(.ui-state-disabled)"),s="first"===e||"last"===e?i["first"===e?"prevAll":"nextAll"](n).eq(-1):i[e+"All"](n).eq(0),s.length&&this.menuInstance.focus(t,s)},_getSelectedItem:function(){return this.menuItems.eq(this.element[0].selectedIndex)},_toggle:function(e){this[this.isOpen?"close":"open"](e)},_setSelection:function(){var e;this.range&&(window.getSelection?(e=window.getSelection(),e.removeAllRanges(),e.addRange(this.range)):this.range.select(),this.button.focus())},_documentClick:{mousedown:function(t){this.isOpen&&(e(t.target).closest(".ui-selectmenu-menu, #"+this.ids.button).length||this.close(t))}},_buttonEvents:{mousedown:function(){var e;window.getSelection?(e=window.getSelection(),e.rangeCount&&(this.range=e.getRangeAt(0))):this.range=document.selection.createRange()},click:function(e){this._setSelection(),this._toggle(e)},keydown:function(t){var i=!0;switch(t.keyCode){case e.ui.keyCode.TAB:case e.ui.keyCode.ESCAPE:this.close(t),i=!1;break;case e.ui.keyCode.ENTER:this.isOpen&&this._selectFocusedItem(t);break;case e.ui.keyCode.UP:t.altKey?this._toggle(t):this._move("prev",t);break;case e.ui.keyCode.DOWN:t.altKey?this._toggle(t):this._move("next",t);break;case e.ui.keyCode.SPACE:this.isOpen?this._selectFocusedItem(t):this._toggle(t);break;case e.ui.keyCode.LEFT:this._move("prev",t);break;case e.ui.keyCode.RIGHT:this._move("next",t);break;case e.ui.keyCode.HOME:case e.ui.keyCode.PAGE_UP:this._move("first",t);break;case e.ui.keyCode.END:case e.ui.keyCode.PAGE_DOWN:this._move("last",t);break;default:this.menu.trigger(t),i=!1}i&&t.preventDefault()}},_selectFocusedItem:function(e){var t=this.menuItems.eq(this.focusIndex);t.hasClass("ui-state-disabled")||this._select(t.data("ui-selectmenu-item"),e)},_select:function(e,t){var i=this.element[0].selectedIndex;this.element[0].selectedIndex=e.index,this._setText(this.buttonText,e.label),this._setAria(e),this._trigger("select",t,{item:e}),e.index!==i&&this._trigger("change",t,{item:e}),this.close(t)},_setAria:function(e){var t=this.menuItems.eq(e.index).attr("id");this.button.attr({"aria-labelledby":t,"aria-activedescendant":t}),this.menu.attr("aria-activedescendant",t)},_setOption:function(e,t){"icons"===e&&this.button.find("span.ui-icon").removeClass(this.options.icons.button).addClass(t.button),this._super(e,t),"appendTo"===e&&this.menuWrap.appendTo(this._appendTo()),"disabled"===e&&(this.menuInstance.option("disabled",t),this.button.toggleClass("ui-state-disabled",t).attr("aria-disabled",t),this.element.prop("disabled",t),t?(this.button.attr("tabindex",-1),this.close()):this.button.attr("tabindex",0)),"width"===e&&this._resizeButton()},_appendTo:function(){var t=this.options.appendTo;return t&&(t=t.jquery||t.nodeType?e(t):this.document.find(t).eq(0)),t&&t[0]||(t=this.element.closest(".ui-front")),t.length||(t=this.document[0].body),t},_toggleAttr:function(){this.button.toggleClass("ui-corner-top",this.isOpen).toggleClass("ui-corner-all",!this.isOpen).attr("aria-expanded",this.isOpen),this.menuWrap.toggleClass("ui-selectmenu-open",this.isOpen),this.menu.attr("aria-hidden",!this.isOpen)},_resizeButton:function(){var e=this.options.width;e||(e=this.element.show().outerWidth(),this.element.hide()),this.button.outerWidth(e)},_resizeMenu:function(){this.menu.outerWidth(Math.max(this.button.outerWidth(),this.menu.width("").outerWidth()+1))},_getCreateOptions:function(){return{disabled:this.element.prop("disabled")}},_parseOptions:function(t){var i=[];t.each(function(t,s){var n=e(s),a=n.parent("optgroup");i.push({element:n,index:t,value:n.val(),label:n.text(),optgroup:a.attr("label")||"",disabled:a.prop("disabled")||n.prop("disabled")})}),this.items=i},_destroy:function(){this.menuWrap.remove(),this.button.remove(),this.element.show(),this.element.removeUniqueId(),this.label.attr("for",this.ids.element)}}),e.widget("ui.slider",e.ui.mouse,{version:"1.11.4",widgetEventPrefix:"slide",options:{animate:!1,distance:0,max:100,min:0,orientation:"horizontal",range:!1,step:1,value:0,values:null,change:null,slide:null,start:null,stop:null},numPages:5,_create:function(){this._keySliding=!1,this._mouseSliding=!1,this._animateOff=!0,this._handleIndex=null,this._detectOrientation(),this._mouseInit(),this._calculateNewMax(),this.element.addClass("ui-slider ui-slider-"+this.orientation+" ui-widget"+" ui-widget-content"+" ui-corner-all"),this._refresh(),this._setOption("disabled",this.options.disabled),this._animateOff=!1},_refresh:function(){this._createRange(),this._createHandles(),this._setupEvents(),this._refreshValue()},_createHandles:function(){var t,i,s=this.options,n=this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"),a="<span class='ui-slider-handle ui-state-default ui-corner-all' tabindex='0'></span>",o=[];for(i=s.values&&s.values.length||1,n.length>i&&(n.slice(i).remove(),n=n.slice(0,i)),t=n.length;i>t;t++)o.push(a);this.handles=n.add(e(o.join("")).appendTo(this.element)),this.handle=this.handles.eq(0),this.handles.each(function(t){e(this).data("ui-slider-handle-index",t)})},_createRange:function(){var t=this.options,i="";t.range?(t.range===!0&&(t.values?t.values.length&&2!==t.values.length?t.values=[t.values[0],t.values[0]]:e.isArray(t.values)&&(t.values=t.values.slice(0)):t.values=[this._valueMin(),this._valueMin()]),this.range&&this.range.length?this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({left:"",bottom:""}):(this.range=e("<div></div>").appendTo(this.element),i="ui-slider-range ui-widget-header ui-corner-all"),this.range.addClass(i+("min"===t.range||"max"===t.range?" ui-slider-range-"+t.range:""))):(this.range&&this.range.remove(),this.range=null)},_setupEvents:function(){this._off(this.handles),this._on(this.handles,this._handleEvents),this._hoverable(this.handles),this._focusable(this.handles)},_destroy:function(){this.handles.remove(),this.range&&this.range.remove(),this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all"),this._mouseDestroy()},_mouseCapture:function(t){var i,s,n,a,o,r,h,l,u=this,d=this.options;return d.disabled?!1:(this.elementSize={width:this.element.outerWidth(),height:this.element.outerHeight()},this.elementOffset=this.element.offset(),i={x:t.pageX,y:t.pageY},s=this._normValueFromMouse(i),n=this._valueMax()-this._valueMin()+1,this.handles.each(function(t){var i=Math.abs(s-u.values(t));(n>i||n===i&&(t===u._lastChangedValue||u.values(t)===d.min))&&(n=i,a=e(this),o=t)}),r=this._start(t,o),r===!1?!1:(this._mouseSliding=!0,this._handleIndex=o,a.addClass("ui-state-active").focus(),h=a.offset(),l=!e(t.target).parents().addBack().is(".ui-slider-handle"),this._clickOffset=l?{left:0,top:0}:{left:t.pageX-h.left-a.width()/2,top:t.pageY-h.top-a.height()/2-(parseInt(a.css("borderTopWidth"),10)||0)-(parseInt(a.css("borderBottomWidth"),10)||0)+(parseInt(a.css("marginTop"),10)||0)},this.handles.hasClass("ui-state-hover")||this._slide(t,o,s),this._animateOff=!0,!0))},_mouseStart:function(){return!0},_mouseDrag:function(e){var t={x:e.pageX,y:e.pageY},i=this._normValueFromMouse(t);return this._slide(e,this._handleIndex,i),!1},_mouseStop:function(e){return this.handles.removeClass("ui-state-active"),this._mouseSliding=!1,this._stop(e,this._handleIndex),this._change(e,this._handleIndex),this._handleIndex=null,this._clickOffset=null,this._animateOff=!1,!1},_detectOrientation:function(){this.orientation="vertical"===this.options.orientation?"vertical":"horizontal"},_normValueFromMouse:function(e){var t,i,s,n,a;return"horizontal"===this.orientation?(t=this.elementSize.width,i=e.x-this.elementOffset.left-(this._clickOffset?this._clickOffset.left:0)):(t=this.elementSize.height,i=e.y-this.elementOffset.top-(this._clickOffset?this._clickOffset.top:0)),s=i/t,s>1&&(s=1),0>s&&(s=0),"vertical"===this.orientation&&(s=1-s),n=this._valueMax()-this._valueMin(),a=this._valueMin()+s*n,this._trimAlignValue(a)},_start:function(e,t){var i={handle:this.handles[t],value:this.value()};return this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._trigger("start",e,i)},_slide:function(e,t,i){var s,n,a;this.options.values&&this.options.values.length?(s=this.values(t?0:1),2===this.options.values.length&&this.options.range===!0&&(0===t&&i>s||1===t&&s>i)&&(i=s),i!==this.values(t)&&(n=this.values(),n[t]=i,a=this._trigger("slide",e,{handle:this.handles[t],value:i,values:n}),s=this.values(t?0:1),a!==!1&&this.values(t,i))):i!==this.value()&&(a=this._trigger("slide",e,{handle:this.handles[t],value:i}),a!==!1&&this.value(i))},_stop:function(e,t){var i={handle:this.handles[t],value:this.value()};this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._trigger("stop",e,i)},_change:function(e,t){if(!this._keySliding&&!this._mouseSliding){var i={handle:this.handles[t],value:this.value()};this.options.values&&this.options.values.length&&(i.value=this.values(t),i.values=this.values()),this._lastChangedValue=t,this._trigger("change",e,i)}},value:function(e){return arguments.length?(this.options.value=this._trimAlignValue(e),this._refreshValue(),this._change(null,0),void 0):this._value()},values:function(t,i){var s,n,a;if(arguments.length>1)return this.options.values[t]=this._trimAlignValue(i),this._refreshValue(),this._change(null,t),void 0;if(!arguments.length)return this._values();if(!e.isArray(arguments[0]))return this.options.values&&this.options.values.length?this._values(t):this.value();for(s=this.options.values,n=arguments[0],a=0;s.length>a;a+=1)s[a]=this._trimAlignValue(n[a]),this._change(null,a);this._refreshValue()},_setOption:function(t,i){var s,n=0;switch("range"===t&&this.options.range===!0&&("min"===i?(this.options.value=this._values(0),this.options.values=null):"max"===i&&(this.options.value=this._values(this.options.values.length-1),this.options.values=null)),e.isArray(this.options.values)&&(n=this.options.values.length),"disabled"===t&&this.element.toggleClass("ui-state-disabled",!!i),this._super(t,i),t){case"orientation":this._detectOrientation(),this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-"+this.orientation),this._refreshValue(),this.handles.css("horizontal"===i?"bottom":"left","");break;case"value":this._animateOff=!0,this._refreshValue(),this._change(null,0),this._animateOff=!1;break;case"values":for(this._animateOff=!0,this._refreshValue(),s=0;n>s;s+=1)this._change(null,s);this._animateOff=!1;break;case"step":case"min":case"max":this._animateOff=!0,this._calculateNewMax(),this._refreshValue(),this._animateOff=!1;break;case"range":this._animateOff=!0,this._refresh(),this._animateOff=!1}},_value:function(){var e=this.options.value;return e=this._trimAlignValue(e)},_values:function(e){var t,i,s;if(arguments.length)return t=this.options.values[e],t=this._trimAlignValue(t);if(this.options.values&&this.options.values.length){for(i=this.options.values.slice(),s=0;i.length>s;s+=1)i[s]=this._trimAlignValue(i[s]);return i}return[]},_trimAlignValue:function(e){if(this._valueMin()>=e)return this._valueMin();if(e>=this._valueMax())return this._valueMax();var t=this.options.step>0?this.options.step:1,i=(e-this._valueMin())%t,s=e-i;return 2*Math.abs(i)>=t&&(s+=i>0?t:-t),parseFloat(s.toFixed(5))},_calculateNewMax:function(){var e=this.options.max,t=this._valueMin(),i=this.options.step,s=Math.floor(+(e-t).toFixed(this._precision())/i)*i;e=s+t,this.max=parseFloat(e.toFixed(this._precision()))},_precision:function(){var e=this._precisionOf(this.options.step);return null!==this.options.min&&(e=Math.max(e,this._precisionOf(this.options.min))),e},_precisionOf:function(e){var t=""+e,i=t.indexOf(".");return-1===i?0:t.length-i-1},_valueMin:function(){return this.options.min},_valueMax:function(){return this.max},_refreshValue:function(){var t,i,s,n,a,o=this.options.range,r=this.options,h=this,l=this._animateOff?!1:r.animate,u={};this.options.values&&this.options.values.length?this.handles.each(function(s){i=100*((h.values(s)-h._valueMin())/(h._valueMax()-h._valueMin())),u["horizontal"===h.orientation?"left":"bottom"]=i+"%",e(this).stop(1,1)[l?"animate":"css"](u,r.animate),h.options.range===!0&&("horizontal"===h.orientation?(0===s&&h.range.stop(1,1)[l?"animate":"css"]({left:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({width:i-t+"%"},{queue:!1,duration:r.animate})):(0===s&&h.range.stop(1,1)[l?"animate":"css"]({bottom:i+"%"},r.animate),1===s&&h.range[l?"animate":"css"]({height:i-t+"%"},{queue:!1,duration:r.animate}))),t=i}):(s=this.value(),n=this._valueMin(),a=this._valueMax(),i=a!==n?100*((s-n)/(a-n)):0,u["horizontal"===this.orientation?"left":"bottom"]=i+"%",this.handle.stop(1,1)[l?"animate":"css"](u,r.animate),"min"===o&&"horizontal"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({width:i+"%"},r.animate),"max"===o&&"horizontal"===this.orientation&&this.range[l?"animate":"css"]({width:100-i+"%"},{queue:!1,duration:r.animate}),"min"===o&&"vertical"===this.orientation&&this.range.stop(1,1)[l?"animate":"css"]({height:i+"%"},r.animate),"max"===o&&"vertical"===this.orientation&&this.range[l?"animate":"css"]({height:100-i+"%"},{queue:!1,duration:r.animate}))},_handleEvents:{keydown:function(t){var i,s,n,a,o=e(t.target).data("ui-slider-handle-index");switch(t.keyCode){case e.ui.keyCode.HOME:case e.ui.keyCode.END:case e.ui.keyCode.PAGE_UP:case e.ui.keyCode.PAGE_DOWN:case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(t.preventDefault(),!this._keySliding&&(this._keySliding=!0,e(t.target).addClass("ui-state-active"),i=this._start(t,o),i===!1))return}switch(a=this.options.step,s=n=this.options.values&&this.options.values.length?this.values(o):this.value(),t.keyCode){case e.ui.keyCode.HOME:n=this._valueMin();break;case e.ui.keyCode.END:n=this._valueMax();break;case e.ui.keyCode.PAGE_UP:n=this._trimAlignValue(s+(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.PAGE_DOWN:n=this._trimAlignValue(s-(this._valueMax()-this._valueMin())/this.numPages);break;case e.ui.keyCode.UP:case e.ui.keyCode.RIGHT:if(s===this._valueMax())return;n=this._trimAlignValue(s+a);break;case e.ui.keyCode.DOWN:case e.ui.keyCode.LEFT:if(s===this._valueMin())return;n=this._trimAlignValue(s-a)}this._slide(t,o,n)},keyup:function(t){var i=e(t.target).data("ui-slider-handle-index");this._keySliding&&(this._keySliding=!1,this._stop(t,i),this._change(t,i),e(t.target).removeClass("ui-state-active"))}}}),e.widget("ui.spinner",{version:"1.11.4",defaultElement:"<input>",widgetEventPrefix:"spin",options:{culture:null,icons:{down:"ui-icon-triangle-1-s",up:"ui-icon-triangle-1-n"},incremental:!0,max:null,min:null,numberFormat:null,page:10,step:1,change:null,spin:null,start:null,stop:null},_create:function(){this._setOption("max",this.options.max),this._setOption("min",this.options.min),this._setOption("step",this.options.step),""!==this.value()&&this._value(this.element.val(),!0),this._draw(),this._on(this._events),this._refresh(),this._on(this.window,{beforeunload:function(){this.element.removeAttr("autocomplete")}})},_getCreateOptions:function(){var t={},i=this.element;return e.each(["min","max","step"],function(e,s){var n=i.attr(s);void 0!==n&&n.length&&(t[s]=n)}),t},_events:{keydown:function(e){this._start(e)&&this._keydown(e)&&e.preventDefault()},keyup:"_stop",focus:function(){this.previous=this.element.val()},blur:function(e){return this.cancelBlur?(delete this.cancelBlur,void 0):(this._stop(),this._refresh(),this.previous!==this.element.val()&&this._trigger("change",e),void 0)},mousewheel:function(e,t){if(t){if(!this.spinning&&!this._start(e))return!1;this._spin((t>0?1:-1)*this.options.step,e),clearTimeout(this.mousewheelTimer),this.mousewheelTimer=this._delay(function(){this.spinning&&this._stop(e)},100),e.preventDefault()}},"mousedown .ui-spinner-button":function(t){function i(){var e=this.element[0]===this.document[0].activeElement;e||(this.element.focus(),this.previous=s,this._delay(function(){this.previous=s}))}var s;s=this.element[0]===this.document[0].activeElement?this.previous:this.element.val(),t.preventDefault(),i.call(this),this.cancelBlur=!0,this._delay(function(){delete this.cancelBlur,i.call(this)}),this._start(t)!==!1&&this._repeat(null,e(t.currentTarget).hasClass("ui-spinner-up")?1:-1,t)},"mouseup .ui-spinner-button":"_stop","mouseenter .ui-spinner-button":function(t){return e(t.currentTarget).hasClass("ui-state-active")?this._start(t)===!1?!1:(this._repeat(null,e(t.currentTarget).hasClass("ui-spinner-up")?1:-1,t),void 0):void 0},"mouseleave .ui-spinner-button":"_stop"},_draw:function(){var e=this.uiSpinner=this.element.addClass("ui-spinner-input").attr("autocomplete","off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml());this.element.attr("role","spinbutton"),this.buttons=e.find(".ui-spinner-button").attr("tabIndex",-1).button().removeClass("ui-corner-all"),this.buttons.height()>Math.ceil(.5*e.height())&&e.height()>0&&e.height(e.height()),this.options.disabled&&this.disable()
},_keydown:function(t){var i=this.options,s=e.ui.keyCode;switch(t.keyCode){case s.UP:return this._repeat(null,1,t),!0;case s.DOWN:return this._repeat(null,-1,t),!0;case s.PAGE_UP:return this._repeat(null,i.page,t),!0;case s.PAGE_DOWN:return this._repeat(null,-i.page,t),!0}return!1},_uiSpinnerHtml:function(){return"<span class='ui-spinner ui-widget ui-widget-content ui-corner-all'></span>"},_buttonHtml:function(){return"<a class='ui-spinner-button ui-spinner-up ui-corner-tr'><span class='ui-icon "+this.options.icons.up+"'>&#9650;</span>"+"</a>"+"<a class='ui-spinner-button ui-spinner-down ui-corner-br'>"+"<span class='ui-icon "+this.options.icons.down+"'>&#9660;</span>"+"</a>"},_start:function(e){return this.spinning||this._trigger("start",e)!==!1?(this.counter||(this.counter=1),this.spinning=!0,!0):!1},_repeat:function(e,t,i){e=e||500,clearTimeout(this.timer),this.timer=this._delay(function(){this._repeat(40,t,i)},e),this._spin(t*this.options.step,i)},_spin:function(e,t){var i=this.value()||0;this.counter||(this.counter=1),i=this._adjustValue(i+e*this._increment(this.counter)),this.spinning&&this._trigger("spin",t,{value:i})===!1||(this._value(i),this.counter++)},_increment:function(t){var i=this.options.incremental;return i?e.isFunction(i)?i(t):Math.floor(t*t*t/5e4-t*t/500+17*t/200+1):1},_precision:function(){var e=this._precisionOf(this.options.step);return null!==this.options.min&&(e=Math.max(e,this._precisionOf(this.options.min))),e},_precisionOf:function(e){var t=""+e,i=t.indexOf(".");return-1===i?0:t.length-i-1},_adjustValue:function(e){var t,i,s=this.options;return t=null!==s.min?s.min:0,i=e-t,i=Math.round(i/s.step)*s.step,e=t+i,e=parseFloat(e.toFixed(this._precision())),null!==s.max&&e>s.max?s.max:null!==s.min&&s.min>e?s.min:e},_stop:function(e){this.spinning&&(clearTimeout(this.timer),clearTimeout(this.mousewheelTimer),this.counter=0,this.spinning=!1,this._trigger("stop",e))},_setOption:function(e,t){if("culture"===e||"numberFormat"===e){var i=this._parse(this.element.val());return this.options[e]=t,this.element.val(this._format(i)),void 0}("max"===e||"min"===e||"step"===e)&&"string"==typeof t&&(t=this._parse(t)),"icons"===e&&(this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(t.up),this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(t.down)),this._super(e,t),"disabled"===e&&(this.widget().toggleClass("ui-state-disabled",!!t),this.element.prop("disabled",!!t),this.buttons.button(t?"disable":"enable"))},_setOptions:h(function(e){this._super(e)}),_parse:function(e){return"string"==typeof e&&""!==e&&(e=window.Globalize&&this.options.numberFormat?Globalize.parseFloat(e,10,this.options.culture):+e),""===e||isNaN(e)?null:e},_format:function(e){return""===e?"":window.Globalize&&this.options.numberFormat?Globalize.format(e,this.options.numberFormat,this.options.culture):e},_refresh:function(){this.element.attr({"aria-valuemin":this.options.min,"aria-valuemax":this.options.max,"aria-valuenow":this._parse(this.element.val())})},isValid:function(){var e=this.value();return null===e?!1:e===this._adjustValue(e)},_value:function(e,t){var i;""!==e&&(i=this._parse(e),null!==i&&(t||(i=this._adjustValue(i)),e=this._format(i))),this.element.val(e),this._refresh()},_destroy:function(){this.element.removeClass("ui-spinner-input").prop("disabled",!1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"),this.uiSpinner.replaceWith(this.element)},stepUp:h(function(e){this._stepUp(e)}),_stepUp:function(e){this._start()&&(this._spin((e||1)*this.options.step),this._stop())},stepDown:h(function(e){this._stepDown(e)}),_stepDown:function(e){this._start()&&(this._spin((e||1)*-this.options.step),this._stop())},pageUp:h(function(e){this._stepUp((e||1)*this.options.page)}),pageDown:h(function(e){this._stepDown((e||1)*this.options.page)}),value:function(e){return arguments.length?(h(this._value).call(this,e),void 0):this._parse(this.element.val())},widget:function(){return this.uiSpinner}}),e.widget("ui.tabs",{version:"1.11.4",delay:300,options:{active:null,collapsible:!1,event:"click",heightStyle:"content",hide:null,show:null,activate:null,beforeActivate:null,beforeLoad:null,load:null},_isLocal:function(){var e=/#.*$/;return function(t){var i,s;t=t.cloneNode(!1),i=t.href.replace(e,""),s=location.href.replace(e,"");try{i=decodeURIComponent(i)}catch(n){}try{s=decodeURIComponent(s)}catch(n){}return t.hash.length>1&&i===s}}(),_create:function(){var t=this,i=this.options;this.running=!1,this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible",i.collapsible),this._processTabs(),i.active=this._initialActive(),e.isArray(i.disabled)&&(i.disabled=e.unique(i.disabled.concat(e.map(this.tabs.filter(".ui-state-disabled"),function(e){return t.tabs.index(e)}))).sort()),this.active=this.options.active!==!1&&this.anchors.length?this._findActive(i.active):e(),this._refresh(),this.active.length&&this.load(i.active)},_initialActive:function(){var t=this.options.active,i=this.options.collapsible,s=location.hash.substring(1);return null===t&&(s&&this.tabs.each(function(i,n){return e(n).attr("aria-controls")===s?(t=i,!1):void 0}),null===t&&(t=this.tabs.index(this.tabs.filter(".ui-tabs-active"))),(null===t||-1===t)&&(t=this.tabs.length?0:!1)),t!==!1&&(t=this.tabs.index(this.tabs.eq(t)),-1===t&&(t=i?!1:0)),!i&&t===!1&&this.anchors.length&&(t=0),t},_getCreateEventData:function(){return{tab:this.active,panel:this.active.length?this._getPanelForTab(this.active):e()}},_tabKeydown:function(t){var i=e(this.document[0].activeElement).closest("li"),s=this.tabs.index(i),n=!0;if(!this._handlePageNav(t)){switch(t.keyCode){case e.ui.keyCode.RIGHT:case e.ui.keyCode.DOWN:s++;break;case e.ui.keyCode.UP:case e.ui.keyCode.LEFT:n=!1,s--;break;case e.ui.keyCode.END:s=this.anchors.length-1;break;case e.ui.keyCode.HOME:s=0;break;case e.ui.keyCode.SPACE:return t.preventDefault(),clearTimeout(this.activating),this._activate(s),void 0;case e.ui.keyCode.ENTER:return t.preventDefault(),clearTimeout(this.activating),this._activate(s===this.options.active?!1:s),void 0;default:return}t.preventDefault(),clearTimeout(this.activating),s=this._focusNextTab(s,n),t.ctrlKey||t.metaKey||(i.attr("aria-selected","false"),this.tabs.eq(s).attr("aria-selected","true"),this.activating=this._delay(function(){this.option("active",s)},this.delay))}},_panelKeydown:function(t){this._handlePageNav(t)||t.ctrlKey&&t.keyCode===e.ui.keyCode.UP&&(t.preventDefault(),this.active.focus())},_handlePageNav:function(t){return t.altKey&&t.keyCode===e.ui.keyCode.PAGE_UP?(this._activate(this._focusNextTab(this.options.active-1,!1)),!0):t.altKey&&t.keyCode===e.ui.keyCode.PAGE_DOWN?(this._activate(this._focusNextTab(this.options.active+1,!0)),!0):void 0},_findNextTab:function(t,i){function s(){return t>n&&(t=0),0>t&&(t=n),t}for(var n=this.tabs.length-1;-1!==e.inArray(s(),this.options.disabled);)t=i?t+1:t-1;return t},_focusNextTab:function(e,t){return e=this._findNextTab(e,t),this.tabs.eq(e).focus(),e},_setOption:function(e,t){return"active"===e?(this._activate(t),void 0):"disabled"===e?(this._setupDisabled(t),void 0):(this._super(e,t),"collapsible"===e&&(this.element.toggleClass("ui-tabs-collapsible",t),t||this.options.active!==!1||this._activate(0)),"event"===e&&this._setupEvents(t),"heightStyle"===e&&this._setupHeightStyle(t),void 0)},_sanitizeSelector:function(e){return e?e.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g,"\\$&"):""},refresh:function(){var t=this.options,i=this.tablist.children(":has(a[href])");t.disabled=e.map(i.filter(".ui-state-disabled"),function(e){return i.index(e)}),this._processTabs(),t.active!==!1&&this.anchors.length?this.active.length&&!e.contains(this.tablist[0],this.active[0])?this.tabs.length===t.disabled.length?(t.active=!1,this.active=e()):this._activate(this._findNextTab(Math.max(0,t.active-1),!1)):t.active=this.tabs.index(this.active):(t.active=!1,this.active=e()),this._refresh()},_refresh:function(){this._setupDisabled(this.options.disabled),this._setupEvents(this.options.event),this._setupHeightStyle(this.options.heightStyle),this.tabs.not(this.active).attr({"aria-selected":"false","aria-expanded":"false",tabIndex:-1}),this.panels.not(this._getPanelForTab(this.active)).hide().attr({"aria-hidden":"true"}),this.active.length?(this.active.addClass("ui-tabs-active ui-state-active").attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0}),this._getPanelForTab(this.active).show().attr({"aria-hidden":"false"})):this.tabs.eq(0).attr("tabIndex",0)},_processTabs:function(){var t=this,i=this.tabs,s=this.anchors,n=this.panels;this.tablist=this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role","tablist").delegate("> li","mousedown"+this.eventNamespace,function(t){e(this).is(".ui-state-disabled")&&t.preventDefault()}).delegate(".ui-tabs-anchor","focus"+this.eventNamespace,function(){e(this).closest("li").is(".ui-state-disabled")&&this.blur()}),this.tabs=this.tablist.find("> li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({role:"tab",tabIndex:-1}),this.anchors=this.tabs.map(function(){return e("a",this)[0]}).addClass("ui-tabs-anchor").attr({role:"presentation",tabIndex:-1}),this.panels=e(),this.anchors.each(function(i,s){var n,a,o,r=e(s).uniqueId().attr("id"),h=e(s).closest("li"),l=h.attr("aria-controls");t._isLocal(s)?(n=s.hash,o=n.substring(1),a=t.element.find(t._sanitizeSelector(n))):(o=h.attr("aria-controls")||e({}).uniqueId()[0].id,n="#"+o,a=t.element.find(n),a.length||(a=t._createPanel(o),a.insertAfter(t.panels[i-1]||t.tablist)),a.attr("aria-live","polite")),a.length&&(t.panels=t.panels.add(a)),l&&h.data("ui-tabs-aria-controls",l),h.attr({"aria-controls":o,"aria-labelledby":r}),a.attr("aria-labelledby",r)}),this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role","tabpanel"),i&&(this._off(i.not(this.tabs)),this._off(s.not(this.anchors)),this._off(n.not(this.panels)))},_getList:function(){return this.tablist||this.element.find("ol,ul").eq(0)},_createPanel:function(t){return e("<div>").attr("id",t).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy",!0)},_setupDisabled:function(t){e.isArray(t)&&(t.length?t.length===this.anchors.length&&(t=!0):t=!1);for(var i,s=0;i=this.tabs[s];s++)t===!0||-1!==e.inArray(s,t)?e(i).addClass("ui-state-disabled").attr("aria-disabled","true"):e(i).removeClass("ui-state-disabled").removeAttr("aria-disabled");this.options.disabled=t},_setupEvents:function(t){var i={};t&&e.each(t.split(" "),function(e,t){i[t]="_eventHandler"}),this._off(this.anchors.add(this.tabs).add(this.panels)),this._on(!0,this.anchors,{click:function(e){e.preventDefault()}}),this._on(this.anchors,i),this._on(this.tabs,{keydown:"_tabKeydown"}),this._on(this.panels,{keydown:"_panelKeydown"}),this._focusable(this.tabs),this._hoverable(this.tabs)},_setupHeightStyle:function(t){var i,s=this.element.parent();"fill"===t?(i=s.height(),i-=this.element.outerHeight()-this.element.height(),this.element.siblings(":visible").each(function(){var t=e(this),s=t.css("position");"absolute"!==s&&"fixed"!==s&&(i-=t.outerHeight(!0))}),this.element.children().not(this.panels).each(function(){i-=e(this).outerHeight(!0)}),this.panels.each(function(){e(this).height(Math.max(0,i-e(this).innerHeight()+e(this).height()))}).css("overflow","auto")):"auto"===t&&(i=0,this.panels.each(function(){i=Math.max(i,e(this).height("").height())}).height(i))},_eventHandler:function(t){var i=this.options,s=this.active,n=e(t.currentTarget),a=n.closest("li"),o=a[0]===s[0],r=o&&i.collapsible,h=r?e():this._getPanelForTab(a),l=s.length?this._getPanelForTab(s):e(),u={oldTab:s,oldPanel:l,newTab:r?e():a,newPanel:h};t.preventDefault(),a.hasClass("ui-state-disabled")||a.hasClass("ui-tabs-loading")||this.running||o&&!i.collapsible||this._trigger("beforeActivate",t,u)===!1||(i.active=r?!1:this.tabs.index(a),this.active=o?e():a,this.xhr&&this.xhr.abort(),l.length||h.length||e.error("jQuery UI Tabs: Mismatching fragment identifier."),h.length&&this.load(this.tabs.index(a),t),this._toggle(t,u))},_toggle:function(t,i){function s(){a.running=!1,a._trigger("activate",t,i)}function n(){i.newTab.closest("li").addClass("ui-tabs-active ui-state-active"),o.length&&a.options.show?a._show(o,a.options.show,s):(o.show(),s())}var a=this,o=i.newPanel,r=i.oldPanel;this.running=!0,r.length&&this.options.hide?this._hide(r,this.options.hide,function(){i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),n()}):(i.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),r.hide(),n()),r.attr("aria-hidden","true"),i.oldTab.attr({"aria-selected":"false","aria-expanded":"false"}),o.length&&r.length?i.oldTab.attr("tabIndex",-1):o.length&&this.tabs.filter(function(){return 0===e(this).attr("tabIndex")}).attr("tabIndex",-1),o.attr("aria-hidden","false"),i.newTab.attr({"aria-selected":"true","aria-expanded":"true",tabIndex:0})},_activate:function(t){var i,s=this._findActive(t);s[0]!==this.active[0]&&(s.length||(s=this.active),i=s.find(".ui-tabs-anchor")[0],this._eventHandler({target:i,currentTarget:i,preventDefault:e.noop}))},_findActive:function(t){return t===!1?e():this.tabs.eq(t)},_getIndex:function(e){return"string"==typeof e&&(e=this.anchors.index(this.anchors.filter("[href$='"+e+"']"))),e},_destroy:function(){this.xhr&&this.xhr.abort(),this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"),this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"),this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId(),this.tablist.unbind(this.eventNamespace),this.tabs.add(this.panels).each(function(){e.data(this,"ui-tabs-destroy")?e(this).remove():e(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role")}),this.tabs.each(function(){var t=e(this),i=t.data("ui-tabs-aria-controls");i?t.attr("aria-controls",i).removeData("ui-tabs-aria-controls"):t.removeAttr("aria-controls")}),this.panels.show(),"content"!==this.options.heightStyle&&this.panels.css("height","")},enable:function(t){var i=this.options.disabled;i!==!1&&(void 0===t?i=!1:(t=this._getIndex(t),i=e.isArray(i)?e.map(i,function(e){return e!==t?e:null}):e.map(this.tabs,function(e,i){return i!==t?i:null})),this._setupDisabled(i))},disable:function(t){var i=this.options.disabled;if(i!==!0){if(void 0===t)i=!0;else{if(t=this._getIndex(t),-1!==e.inArray(t,i))return;i=e.isArray(i)?e.merge([t],i).sort():[t]}this._setupDisabled(i)}},load:function(t,i){t=this._getIndex(t);var s=this,n=this.tabs.eq(t),a=n.find(".ui-tabs-anchor"),o=this._getPanelForTab(n),r={tab:n,panel:o},h=function(e,t){"abort"===t&&s.panels.stop(!1,!0),n.removeClass("ui-tabs-loading"),o.removeAttr("aria-busy"),e===s.xhr&&delete s.xhr};this._isLocal(a[0])||(this.xhr=e.ajax(this._ajaxSettings(a,i,r)),this.xhr&&"canceled"!==this.xhr.statusText&&(n.addClass("ui-tabs-loading"),o.attr("aria-busy","true"),this.xhr.done(function(e,t,n){setTimeout(function(){o.html(e),s._trigger("load",i,r),h(n,t)},1)}).fail(function(e,t){setTimeout(function(){h(e,t)},1)})))},_ajaxSettings:function(t,i,s){var n=this;return{url:t.attr("href"),beforeSend:function(t,a){return n._trigger("beforeLoad",i,e.extend({jqXHR:t,ajaxSettings:a},s))}}},_getPanelForTab:function(t){var i=e(t).attr("aria-controls");return this.element.find(this._sanitizeSelector("#"+i))}}),e.widget("ui.tooltip",{version:"1.11.4",options:{content:function(){var t=e(this).attr("title")||"";return e("<a>").text(t).html()},hide:!0,items:"[title]:not([disabled])",position:{my:"left top+15",at:"left bottom",collision:"flipfit flip"},show:!0,tooltipClass:null,track:!1,close:null,open:null},_addDescribedBy:function(t,i){var s=(t.attr("aria-describedby")||"").split(/\s+/);s.push(i),t.data("ui-tooltip-id",i).attr("aria-describedby",e.trim(s.join(" ")))},_removeDescribedBy:function(t){var i=t.data("ui-tooltip-id"),s=(t.attr("aria-describedby")||"").split(/\s+/),n=e.inArray(i,s);-1!==n&&s.splice(n,1),t.removeData("ui-tooltip-id"),s=e.trim(s.join(" ")),s?t.attr("aria-describedby",s):t.removeAttr("aria-describedby")},_create:function(){this._on({mouseover:"open",focusin:"open"}),this.tooltips={},this.parents={},this.options.disabled&&this._disable(),this.liveRegion=e("<div>").attr({role:"log","aria-live":"assertive","aria-relevant":"additions"}).addClass("ui-helper-hidden-accessible").appendTo(this.document[0].body)},_setOption:function(t,i){var s=this;return"disabled"===t?(this[i?"_disable":"_enable"](),this.options[t]=i,void 0):(this._super(t,i),"content"===t&&e.each(this.tooltips,function(e,t){s._updateContent(t.element)}),void 0)},_disable:function(){var t=this;e.each(this.tooltips,function(i,s){var n=e.Event("blur");n.target=n.currentTarget=s.element[0],t.close(n,!0)}),this.element.find(this.options.items).addBack().each(function(){var t=e(this);t.is("[title]")&&t.data("ui-tooltip-title",t.attr("title")).removeAttr("title")})},_enable:function(){this.element.find(this.options.items).addBack().each(function(){var t=e(this);t.data("ui-tooltip-title")&&t.attr("title",t.data("ui-tooltip-title"))})},open:function(t){var i=this,s=e(t?t.target:this.element).closest(this.options.items);s.length&&!s.data("ui-tooltip-id")&&(s.attr("title")&&s.data("ui-tooltip-title",s.attr("title")),s.data("ui-tooltip-open",!0),t&&"mouseover"===t.type&&s.parents().each(function(){var t,s=e(this);s.data("ui-tooltip-open")&&(t=e.Event("blur"),t.target=t.currentTarget=this,i.close(t,!0)),s.attr("title")&&(s.uniqueId(),i.parents[this.id]={element:this,title:s.attr("title")},s.attr("title",""))}),this._registerCloseHandlers(t,s),this._updateContent(s,t))},_updateContent:function(e,t){var i,s=this.options.content,n=this,a=t?t.type:null;return"string"==typeof s?this._open(t,e,s):(i=s.call(e[0],function(i){n._delay(function(){e.data("ui-tooltip-open")&&(t&&(t.type=a),this._open(t,e,i))})}),i&&this._open(t,e,i),void 0)},_open:function(t,i,s){function n(e){l.of=e,o.is(":hidden")||o.position(l)}var a,o,r,h,l=e.extend({},this.options.position);if(s){if(a=this._find(i))return a.tooltip.find(".ui-tooltip-content").html(s),void 0;i.is("[title]")&&(t&&"mouseover"===t.type?i.attr("title",""):i.removeAttr("title")),a=this._tooltip(i),o=a.tooltip,this._addDescribedBy(i,o.attr("id")),o.find(".ui-tooltip-content").html(s),this.liveRegion.children().hide(),s.clone?(h=s.clone(),h.removeAttr("id").find("[id]").removeAttr("id")):h=s,e("<div>").html(h).appendTo(this.liveRegion),this.options.track&&t&&/^mouse/.test(t.type)?(this._on(this.document,{mousemove:n}),n(t)):o.position(e.extend({of:i},this.options.position)),o.hide(),this._show(o,this.options.show),this.options.show&&this.options.show.delay&&(r=this.delayedShow=setInterval(function(){o.is(":visible")&&(n(l.of),clearInterval(r))},e.fx.interval)),this._trigger("open",t,{tooltip:o})}},_registerCloseHandlers:function(t,i){var s={keyup:function(t){if(t.keyCode===e.ui.keyCode.ESCAPE){var s=e.Event(t);s.currentTarget=i[0],this.close(s,!0)}}};i[0]!==this.element[0]&&(s.remove=function(){this._removeTooltip(this._find(i).tooltip)}),t&&"mouseover"!==t.type||(s.mouseleave="close"),t&&"focusin"!==t.type||(s.focusout="close"),this._on(!0,i,s)},close:function(t){var i,s=this,n=e(t?t.currentTarget:this.element),a=this._find(n);return a?(i=a.tooltip,a.closing||(clearInterval(this.delayedShow),n.data("ui-tooltip-title")&&!n.attr("title")&&n.attr("title",n.data("ui-tooltip-title")),this._removeDescribedBy(n),a.hiding=!0,i.stop(!0),this._hide(i,this.options.hide,function(){s._removeTooltip(e(this))}),n.removeData("ui-tooltip-open"),this._off(n,"mouseleave focusout keyup"),n[0]!==this.element[0]&&this._off(n,"remove"),this._off(this.document,"mousemove"),t&&"mouseleave"===t.type&&e.each(this.parents,function(t,i){e(i.element).attr("title",i.title),delete s.parents[t]}),a.closing=!0,this._trigger("close",t,{tooltip:i}),a.hiding||(a.closing=!1)),void 0):(n.removeData("ui-tooltip-open"),void 0)},_tooltip:function(t){var i=e("<div>").attr("role","tooltip").addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content "+(this.options.tooltipClass||"")),s=i.uniqueId().attr("id");return e("<div>").addClass("ui-tooltip-content").appendTo(i),i.appendTo(this.document[0].body),this.tooltips[s]={element:t,tooltip:i}},_find:function(e){var t=e.data("ui-tooltip-id");return t?this.tooltips[t]:null},_removeTooltip:function(e){e.remove(),delete this.tooltips[e.attr("id")]},_destroy:function(){var t=this;e.each(this.tooltips,function(i,s){var n=e.Event("blur"),a=s.element;n.target=n.currentTarget=a[0],t.close(n,!0),e("#"+i).remove(),a.data("ui-tooltip-title")&&(a.attr("title")||a.attr("title",a.data("ui-tooltip-title")),a.removeData("ui-tooltip-title"))}),this.liveRegion.remove()}});var y="ui-effects-",b=e;e.effects={effect:{}},function(e,t){function i(e,t,i){var s=d[t.type]||{};return null==e?i||!t.def?null:t.def:(e=s.floor?~~e:parseFloat(e),isNaN(e)?t.def:s.mod?(e+s.mod)%s.mod:0>e?0:e>s.max?s.max:e)}function s(i){var s=l(),n=s._rgba=[];return i=i.toLowerCase(),f(h,function(e,a){var o,r=a.re.exec(i),h=r&&a.parse(r),l=a.space||"rgba";return h?(o=s[l](h),s[u[l].cache]=o[u[l].cache],n=s._rgba=o._rgba,!1):t}),n.length?("0,0,0,0"===n.join()&&e.extend(n,a.transparent),s):a[i]}function n(e,t,i){return i=(i+1)%1,1>6*i?e+6*(t-e)*i:1>2*i?t:2>3*i?e+6*(t-e)*(2/3-i):e}var a,o="backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor",r=/^([\-+])=\s*(\d+\.?\d*)/,h=[{re:/rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[e[1],e[2],e[3],e[4]]}},{re:/rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,parse:function(e){return[2.55*e[1],2.55*e[2],2.55*e[3],e[4]]}},{re:/#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/,parse:function(e){return[parseInt(e[1],16),parseInt(e[2],16),parseInt(e[3],16)]}},{re:/#([a-f0-9])([a-f0-9])([a-f0-9])/,parse:function(e){return[parseInt(e[1]+e[1],16),parseInt(e[2]+e[2],16),parseInt(e[3]+e[3],16)]}},{re:/hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/,space:"hsla",parse:function(e){return[e[1],e[2]/100,e[3]/100,e[4]]}}],l=e.Color=function(t,i,s,n){return new e.Color.fn.parse(t,i,s,n)},u={rgba:{props:{red:{idx:0,type:"byte"},green:{idx:1,type:"byte"},blue:{idx:2,type:"byte"}}},hsla:{props:{hue:{idx:0,type:"degrees"},saturation:{idx:1,type:"percent"},lightness:{idx:2,type:"percent"}}}},d={"byte":{floor:!0,max:255},percent:{max:1},degrees:{mod:360,floor:!0}},c=l.support={},p=e("<p>")[0],f=e.each;p.style.cssText="background-color:rgba(1,1,1,.5)",c.rgba=p.style.backgroundColor.indexOf("rgba")>-1,f(u,function(e,t){t.cache="_"+e,t.props.alpha={idx:3,type:"percent",def:1}}),l.fn=e.extend(l.prototype,{parse:function(n,o,r,h){if(n===t)return this._rgba=[null,null,null,null],this;(n.jquery||n.nodeType)&&(n=e(n).css(o),o=t);var d=this,c=e.type(n),p=this._rgba=[];return o!==t&&(n=[n,o,r,h],c="array"),"string"===c?this.parse(s(n)||a._default):"array"===c?(f(u.rgba.props,function(e,t){p[t.idx]=i(n[t.idx],t)}),this):"object"===c?(n instanceof l?f(u,function(e,t){n[t.cache]&&(d[t.cache]=n[t.cache].slice())}):f(u,function(t,s){var a=s.cache;f(s.props,function(e,t){if(!d[a]&&s.to){if("alpha"===e||null==n[e])return;d[a]=s.to(d._rgba)}d[a][t.idx]=i(n[e],t,!0)}),d[a]&&0>e.inArray(null,d[a].slice(0,3))&&(d[a][3]=1,s.from&&(d._rgba=s.from(d[a])))}),this):t},is:function(e){var i=l(e),s=!0,n=this;return f(u,function(e,a){var o,r=i[a.cache];return r&&(o=n[a.cache]||a.to&&a.to(n._rgba)||[],f(a.props,function(e,i){return null!=r[i.idx]?s=r[i.idx]===o[i.idx]:t})),s}),s},_space:function(){var e=[],t=this;return f(u,function(i,s){t[s.cache]&&e.push(i)}),e.pop()},transition:function(e,t){var s=l(e),n=s._space(),a=u[n],o=0===this.alpha()?l("transparent"):this,r=o[a.cache]||a.to(o._rgba),h=r.slice();return s=s[a.cache],f(a.props,function(e,n){var a=n.idx,o=r[a],l=s[a],u=d[n.type]||{};null!==l&&(null===o?h[a]=l:(u.mod&&(l-o>u.mod/2?o+=u.mod:o-l>u.mod/2&&(o-=u.mod)),h[a]=i((l-o)*t+o,n)))}),this[n](h)},blend:function(t){if(1===this._rgba[3])return this;var i=this._rgba.slice(),s=i.pop(),n=l(t)._rgba;return l(e.map(i,function(e,t){return(1-s)*n[t]+s*e}))},toRgbaString:function(){var t="rgba(",i=e.map(this._rgba,function(e,t){return null==e?t>2?1:0:e});return 1===i[3]&&(i.pop(),t="rgb("),t+i.join()+")"},toHslaString:function(){var t="hsla(",i=e.map(this.hsla(),function(e,t){return null==e&&(e=t>2?1:0),t&&3>t&&(e=Math.round(100*e)+"%"),e});return 1===i[3]&&(i.pop(),t="hsl("),t+i.join()+")"},toHexString:function(t){var i=this._rgba.slice(),s=i.pop();return t&&i.push(~~(255*s)),"#"+e.map(i,function(e){return e=(e||0).toString(16),1===e.length?"0"+e:e}).join("")},toString:function(){return 0===this._rgba[3]?"transparent":this.toRgbaString()}}),l.fn.parse.prototype=l.fn,u.hsla.to=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t,i,s=e[0]/255,n=e[1]/255,a=e[2]/255,o=e[3],r=Math.max(s,n,a),h=Math.min(s,n,a),l=r-h,u=r+h,d=.5*u;return t=h===r?0:s===r?60*(n-a)/l+360:n===r?60*(a-s)/l+120:60*(s-n)/l+240,i=0===l?0:.5>=d?l/u:l/(2-u),[Math.round(t)%360,i,d,null==o?1:o]},u.hsla.from=function(e){if(null==e[0]||null==e[1]||null==e[2])return[null,null,null,e[3]];var t=e[0]/360,i=e[1],s=e[2],a=e[3],o=.5>=s?s*(1+i):s+i-s*i,r=2*s-o;return[Math.round(255*n(r,o,t+1/3)),Math.round(255*n(r,o,t)),Math.round(255*n(r,o,t-1/3)),a]},f(u,function(s,n){var a=n.props,o=n.cache,h=n.to,u=n.from;l.fn[s]=function(s){if(h&&!this[o]&&(this[o]=h(this._rgba)),s===t)return this[o].slice();var n,r=e.type(s),d="array"===r||"object"===r?s:arguments,c=this[o].slice();return f(a,function(e,t){var s=d["object"===r?e:t.idx];null==s&&(s=c[t.idx]),c[t.idx]=i(s,t)}),u?(n=l(u(c)),n[o]=c,n):l(c)},f(a,function(t,i){l.fn[t]||(l.fn[t]=function(n){var a,o=e.type(n),h="alpha"===t?this._hsla?"hsla":"rgba":s,l=this[h](),u=l[i.idx];return"undefined"===o?u:("function"===o&&(n=n.call(this,u),o=e.type(n)),null==n&&i.empty?this:("string"===o&&(a=r.exec(n),a&&(n=u+parseFloat(a[2])*("+"===a[1]?1:-1))),l[i.idx]=n,this[h](l)))})})}),l.hook=function(t){var i=t.split(" ");f(i,function(t,i){e.cssHooks[i]={set:function(t,n){var a,o,r="";if("transparent"!==n&&("string"!==e.type(n)||(a=s(n)))){if(n=l(a||n),!c.rgba&&1!==n._rgba[3]){for(o="backgroundColor"===i?t.parentNode:t;(""===r||"transparent"===r)&&o&&o.style;)try{r=e.css(o,"backgroundColor"),o=o.parentNode}catch(h){}n=n.blend(r&&"transparent"!==r?r:"_default")}n=n.toRgbaString()}try{t.style[i]=n}catch(h){}}},e.fx.step[i]=function(t){t.colorInit||(t.start=l(t.elem,i),t.end=l(t.end),t.colorInit=!0),e.cssHooks[i].set(t.elem,t.start.transition(t.end,t.pos))}})},l.hook(o),e.cssHooks.borderColor={expand:function(e){var t={};return f(["Top","Right","Bottom","Left"],function(i,s){t["border"+s+"Color"]=e}),t}},a=e.Color.names={aqua:"#00ffff",black:"#000000",blue:"#0000ff",fuchsia:"#ff00ff",gray:"#808080",green:"#008000",lime:"#00ff00",maroon:"#800000",navy:"#000080",olive:"#808000",purple:"#800080",red:"#ff0000",silver:"#c0c0c0",teal:"#008080",white:"#ffffff",yellow:"#ffff00",transparent:[null,null,null,0],_default:"#ffffff"}}(b),function(){function t(t){var i,s,n=t.ownerDocument.defaultView?t.ownerDocument.defaultView.getComputedStyle(t,null):t.currentStyle,a={};if(n&&n.length&&n[0]&&n[n[0]])for(s=n.length;s--;)i=n[s],"string"==typeof n[i]&&(a[e.camelCase(i)]=n[i]);else for(i in n)"string"==typeof n[i]&&(a[i]=n[i]);return a}function i(t,i){var s,a,o={};for(s in i)a=i[s],t[s]!==a&&(n[s]||(e.fx.step[s]||!isNaN(parseFloat(a)))&&(o[s]=a));return o}var s=["add","remove","toggle"],n={border:1,borderBottom:1,borderColor:1,borderLeft:1,borderRight:1,borderTop:1,borderWidth:1,margin:1,padding:1};e.each(["borderLeftStyle","borderRightStyle","borderBottomStyle","borderTopStyle"],function(t,i){e.fx.step[i]=function(e){("none"!==e.end&&!e.setAttr||1===e.pos&&!e.setAttr)&&(b.style(e.elem,i,e.end),e.setAttr=!0)}}),e.fn.addBack||(e.fn.addBack=function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}),e.effects.animateClass=function(n,a,o,r){var h=e.speed(a,o,r);return this.queue(function(){var a,o=e(this),r=o.attr("class")||"",l=h.children?o.find("*").addBack():o;l=l.map(function(){var i=e(this);return{el:i,start:t(this)}}),a=function(){e.each(s,function(e,t){n[t]&&o[t+"Class"](n[t])})},a(),l=l.map(function(){return this.end=t(this.el[0]),this.diff=i(this.start,this.end),this}),o.attr("class",r),l=l.map(function(){var t=this,i=e.Deferred(),s=e.extend({},h,{queue:!1,complete:function(){i.resolve(t)}});return this.el.animate(this.diff,s),i.promise()}),e.when.apply(e,l.get()).done(function(){a(),e.each(arguments,function(){var t=this.el;e.each(this.diff,function(e){t.css(e,"")})}),h.complete.call(o[0])})})},e.fn.extend({addClass:function(t){return function(i,s,n,a){return s?e.effects.animateClass.call(this,{add:i},s,n,a):t.apply(this,arguments)}}(e.fn.addClass),removeClass:function(t){return function(i,s,n,a){return arguments.length>1?e.effects.animateClass.call(this,{remove:i},s,n,a):t.apply(this,arguments)}}(e.fn.removeClass),toggleClass:function(t){return function(i,s,n,a,o){return"boolean"==typeof s||void 0===s?n?e.effects.animateClass.call(this,s?{add:i}:{remove:i},n,a,o):t.apply(this,arguments):e.effects.animateClass.call(this,{toggle:i},s,n,a)}}(e.fn.toggleClass),switchClass:function(t,i,s,n,a){return e.effects.animateClass.call(this,{add:i,remove:t},s,n,a)}})}(),function(){function t(t,i,s,n){return e.isPlainObject(t)&&(i=t,t=t.effect),t={effect:t},null==i&&(i={}),e.isFunction(i)&&(n=i,s=null,i={}),("number"==typeof i||e.fx.speeds[i])&&(n=s,s=i,i={}),e.isFunction(s)&&(n=s,s=null),i&&e.extend(t,i),s=s||i.duration,t.duration=e.fx.off?0:"number"==typeof s?s:s in e.fx.speeds?e.fx.speeds[s]:e.fx.speeds._default,t.complete=n||i.complete,t}function i(t){return!t||"number"==typeof t||e.fx.speeds[t]?!0:"string"!=typeof t||e.effects.effect[t]?e.isFunction(t)?!0:"object"!=typeof t||t.effect?!1:!0:!0}e.extend(e.effects,{version:"1.11.4",save:function(e,t){for(var i=0;t.length>i;i++)null!==t[i]&&e.data(y+t[i],e[0].style[t[i]])},restore:function(e,t){var i,s;for(s=0;t.length>s;s++)null!==t[s]&&(i=e.data(y+t[s]),void 0===i&&(i=""),e.css(t[s],i))},setMode:function(e,t){return"toggle"===t&&(t=e.is(":hidden")?"show":"hide"),t},getBaseline:function(e,t){var i,s;switch(e[0]){case"top":i=0;break;case"middle":i=.5;break;case"bottom":i=1;break;default:i=e[0]/t.height}switch(e[1]){case"left":s=0;break;case"center":s=.5;break;case"right":s=1;break;default:s=e[1]/t.width}return{x:s,y:i}},createWrapper:function(t){if(t.parent().is(".ui-effects-wrapper"))return t.parent();var i={width:t.outerWidth(!0),height:t.outerHeight(!0),"float":t.css("float")},s=e("<div></div>").addClass("ui-effects-wrapper").css({fontSize:"100%",background:"transparent",border:"none",margin:0,padding:0}),n={width:t.width(),height:t.height()},a=document.activeElement;try{a.id}catch(o){a=document.body}return t.wrap(s),(t[0]===a||e.contains(t[0],a))&&e(a).focus(),s=t.parent(),"static"===t.css("position")?(s.css({position:"relative"}),t.css({position:"relative"})):(e.extend(i,{position:t.css("position"),zIndex:t.css("z-index")}),e.each(["top","left","bottom","right"],function(e,s){i[s]=t.css(s),isNaN(parseInt(i[s],10))&&(i[s]="auto")}),t.css({position:"relative",top:0,left:0,right:"auto",bottom:"auto"})),t.css(n),s.css(i).show()},removeWrapper:function(t){var i=document.activeElement;
return t.parent().is(".ui-effects-wrapper")&&(t.parent().replaceWith(t),(t[0]===i||e.contains(t[0],i))&&e(i).focus()),t},setTransition:function(t,i,s,n){return n=n||{},e.each(i,function(e,i){var a=t.cssUnit(i);a[0]>0&&(n[i]=a[0]*s+a[1])}),n}}),e.fn.extend({effect:function(){function i(t){function i(){e.isFunction(a)&&a.call(n[0]),e.isFunction(t)&&t()}var n=e(this),a=s.complete,r=s.mode;(n.is(":hidden")?"hide"===r:"show"===r)?(n[r](),i()):o.call(n[0],s,i)}var s=t.apply(this,arguments),n=s.mode,a=s.queue,o=e.effects.effect[s.effect];return e.fx.off||!o?n?this[n](s.duration,s.complete):this.each(function(){s.complete&&s.complete.call(this)}):a===!1?this.each(i):this.queue(a||"fx",i)},show:function(e){return function(s){if(i(s))return e.apply(this,arguments);var n=t.apply(this,arguments);return n.mode="show",this.effect.call(this,n)}}(e.fn.show),hide:function(e){return function(s){if(i(s))return e.apply(this,arguments);var n=t.apply(this,arguments);return n.mode="hide",this.effect.call(this,n)}}(e.fn.hide),toggle:function(e){return function(s){if(i(s)||"boolean"==typeof s)return e.apply(this,arguments);var n=t.apply(this,arguments);return n.mode="toggle",this.effect.call(this,n)}}(e.fn.toggle),cssUnit:function(t){var i=this.css(t),s=[];return e.each(["em","px","%","pt"],function(e,t){i.indexOf(t)>0&&(s=[parseFloat(i),t])}),s}})}(),function(){var t={};e.each(["Quad","Cubic","Quart","Quint","Expo"],function(e,i){t[i]=function(t){return Math.pow(t,e+2)}}),e.extend(t,{Sine:function(e){return 1-Math.cos(e*Math.PI/2)},Circ:function(e){return 1-Math.sqrt(1-e*e)},Elastic:function(e){return 0===e||1===e?e:-Math.pow(2,8*(e-1))*Math.sin((80*(e-1)-7.5)*Math.PI/15)},Back:function(e){return e*e*(3*e-2)},Bounce:function(e){for(var t,i=4;((t=Math.pow(2,--i))-1)/11>e;);return 1/Math.pow(4,3-i)-7.5625*Math.pow((3*t-2)/22-e,2)}}),e.each(t,function(t,i){e.easing["easeIn"+t]=i,e.easing["easeOut"+t]=function(e){return 1-i(1-e)},e.easing["easeInOut"+t]=function(e){return.5>e?i(2*e)/2:1-i(-2*e+2)/2}})}(),e.effects,e.effects.effect.blind=function(t,i){var s,n,a,o=e(this),r=/up|down|vertical/,h=/up|left|vertical|horizontal/,l=["position","top","bottom","left","right","height","width"],u=e.effects.setMode(o,t.mode||"hide"),d=t.direction||"up",c=r.test(d),p=c?"height":"width",f=c?"top":"left",m=h.test(d),g={},v="show"===u;o.parent().is(".ui-effects-wrapper")?e.effects.save(o.parent(),l):e.effects.save(o,l),o.show(),s=e.effects.createWrapper(o).css({overflow:"hidden"}),n=s[p](),a=parseFloat(s.css(f))||0,g[p]=v?n:0,m||(o.css(c?"bottom":"right",0).css(c?"top":"left","auto").css({position:"absolute"}),g[f]=v?a:n+a),v&&(s.css(p,0),m||s.css(f,a+n)),s.animate(g,{duration:t.duration,easing:t.easing,queue:!1,complete:function(){"hide"===u&&o.hide(),e.effects.restore(o,l),e.effects.removeWrapper(o),i()}})},e.effects.effect.bounce=function(t,i){var s,n,a,o=e(this),r=["position","top","bottom","left","right","height","width"],h=e.effects.setMode(o,t.mode||"effect"),l="hide"===h,u="show"===h,d=t.direction||"up",c=t.distance,p=t.times||5,f=2*p+(u||l?1:0),m=t.duration/f,g=t.easing,v="up"===d||"down"===d?"top":"left",y="up"===d||"left"===d,b=o.queue(),_=b.length;for((u||l)&&r.push("opacity"),e.effects.save(o,r),o.show(),e.effects.createWrapper(o),c||(c=o["top"===v?"outerHeight":"outerWidth"]()/3),u&&(a={opacity:1},a[v]=0,o.css("opacity",0).css(v,y?2*-c:2*c).animate(a,m,g)),l&&(c/=Math.pow(2,p-1)),a={},a[v]=0,s=0;p>s;s++)n={},n[v]=(y?"-=":"+=")+c,o.animate(n,m,g).animate(a,m,g),c=l?2*c:c/2;l&&(n={opacity:0},n[v]=(y?"-=":"+=")+c,o.animate(n,m,g)),o.queue(function(){l&&o.hide(),e.effects.restore(o,r),e.effects.removeWrapper(o),i()}),_>1&&b.splice.apply(b,[1,0].concat(b.splice(_,f+1))),o.dequeue()},e.effects.effect.clip=function(t,i){var s,n,a,o=e(this),r=["position","top","bottom","left","right","height","width"],h=e.effects.setMode(o,t.mode||"hide"),l="show"===h,u=t.direction||"vertical",d="vertical"===u,c=d?"height":"width",p=d?"top":"left",f={};e.effects.save(o,r),o.show(),s=e.effects.createWrapper(o).css({overflow:"hidden"}),n="IMG"===o[0].tagName?s:o,a=n[c](),l&&(n.css(c,0),n.css(p,a/2)),f[c]=l?a:0,f[p]=l?0:a/2,n.animate(f,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){l||o.hide(),e.effects.restore(o,r),e.effects.removeWrapper(o),i()}})},e.effects.effect.drop=function(t,i){var s,n=e(this),a=["position","top","bottom","left","right","opacity","height","width"],o=e.effects.setMode(n,t.mode||"hide"),r="show"===o,h=t.direction||"left",l="up"===h||"down"===h?"top":"left",u="up"===h||"left"===h?"pos":"neg",d={opacity:r?1:0};e.effects.save(n,a),n.show(),e.effects.createWrapper(n),s=t.distance||n["top"===l?"outerHeight":"outerWidth"](!0)/2,r&&n.css("opacity",0).css(l,"pos"===u?-s:s),d[l]=(r?"pos"===u?"+=":"-=":"pos"===u?"-=":"+=")+s,n.animate(d,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){"hide"===o&&n.hide(),e.effects.restore(n,a),e.effects.removeWrapper(n),i()}})},e.effects.effect.explode=function(t,i){function s(){b.push(this),b.length===d*c&&n()}function n(){p.css({visibility:"visible"}),e(b).remove(),m||p.hide(),i()}var a,o,r,h,l,u,d=t.pieces?Math.round(Math.sqrt(t.pieces)):3,c=d,p=e(this),f=e.effects.setMode(p,t.mode||"hide"),m="show"===f,g=p.show().css("visibility","hidden").offset(),v=Math.ceil(p.outerWidth()/c),y=Math.ceil(p.outerHeight()/d),b=[];for(a=0;d>a;a++)for(h=g.top+a*y,u=a-(d-1)/2,o=0;c>o;o++)r=g.left+o*v,l=o-(c-1)/2,p.clone().appendTo("body").wrap("<div></div>").css({position:"absolute",visibility:"visible",left:-o*v,top:-a*y}).parent().addClass("ui-effects-explode").css({position:"absolute",overflow:"hidden",width:v,height:y,left:r+(m?l*v:0),top:h+(m?u*y:0),opacity:m?0:1}).animate({left:r+(m?0:l*v),top:h+(m?0:u*y),opacity:m?1:0},t.duration||500,t.easing,s)},e.effects.effect.fade=function(t,i){var s=e(this),n=e.effects.setMode(s,t.mode||"toggle");s.animate({opacity:n},{queue:!1,duration:t.duration,easing:t.easing,complete:i})},e.effects.effect.fold=function(t,i){var s,n,a=e(this),o=["position","top","bottom","left","right","height","width"],r=e.effects.setMode(a,t.mode||"hide"),h="show"===r,l="hide"===r,u=t.size||15,d=/([0-9]+)%/.exec(u),c=!!t.horizFirst,p=h!==c,f=p?["width","height"]:["height","width"],m=t.duration/2,g={},v={};e.effects.save(a,o),a.show(),s=e.effects.createWrapper(a).css({overflow:"hidden"}),n=p?[s.width(),s.height()]:[s.height(),s.width()],d&&(u=parseInt(d[1],10)/100*n[l?0:1]),h&&s.css(c?{height:0,width:u}:{height:u,width:0}),g[f[0]]=h?n[0]:u,v[f[1]]=h?n[1]:0,s.animate(g,m,t.easing).animate(v,m,t.easing,function(){l&&a.hide(),e.effects.restore(a,o),e.effects.removeWrapper(a),i()})},e.effects.effect.highlight=function(t,i){var s=e(this),n=["backgroundImage","backgroundColor","opacity"],a=e.effects.setMode(s,t.mode||"show"),o={backgroundColor:s.css("backgroundColor")};"hide"===a&&(o.opacity=0),e.effects.save(s,n),s.show().css({backgroundImage:"none",backgroundColor:t.color||"#ffff99"}).animate(o,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){"hide"===a&&s.hide(),e.effects.restore(s,n),i()}})},e.effects.effect.size=function(t,i){var s,n,a,o=e(this),r=["position","top","bottom","left","right","width","height","overflow","opacity"],h=["position","top","bottom","left","right","overflow","opacity"],l=["width","height","overflow"],u=["fontSize"],d=["borderTopWidth","borderBottomWidth","paddingTop","paddingBottom"],c=["borderLeftWidth","borderRightWidth","paddingLeft","paddingRight"],p=e.effects.setMode(o,t.mode||"effect"),f=t.restore||"effect"!==p,m=t.scale||"both",g=t.origin||["middle","center"],v=o.css("position"),y=f?r:h,b={height:0,width:0,outerHeight:0,outerWidth:0};"show"===p&&o.show(),s={height:o.height(),width:o.width(),outerHeight:o.outerHeight(),outerWidth:o.outerWidth()},"toggle"===t.mode&&"show"===p?(o.from=t.to||b,o.to=t.from||s):(o.from=t.from||("show"===p?b:s),o.to=t.to||("hide"===p?b:s)),a={from:{y:o.from.height/s.height,x:o.from.width/s.width},to:{y:o.to.height/s.height,x:o.to.width/s.width}},("box"===m||"both"===m)&&(a.from.y!==a.to.y&&(y=y.concat(d),o.from=e.effects.setTransition(o,d,a.from.y,o.from),o.to=e.effects.setTransition(o,d,a.to.y,o.to)),a.from.x!==a.to.x&&(y=y.concat(c),o.from=e.effects.setTransition(o,c,a.from.x,o.from),o.to=e.effects.setTransition(o,c,a.to.x,o.to))),("content"===m||"both"===m)&&a.from.y!==a.to.y&&(y=y.concat(u).concat(l),o.from=e.effects.setTransition(o,u,a.from.y,o.from),o.to=e.effects.setTransition(o,u,a.to.y,o.to)),e.effects.save(o,y),o.show(),e.effects.createWrapper(o),o.css("overflow","hidden").css(o.from),g&&(n=e.effects.getBaseline(g,s),o.from.top=(s.outerHeight-o.outerHeight())*n.y,o.from.left=(s.outerWidth-o.outerWidth())*n.x,o.to.top=(s.outerHeight-o.to.outerHeight)*n.y,o.to.left=(s.outerWidth-o.to.outerWidth)*n.x),o.css(o.from),("content"===m||"both"===m)&&(d=d.concat(["marginTop","marginBottom"]).concat(u),c=c.concat(["marginLeft","marginRight"]),l=r.concat(d).concat(c),o.find("*[width]").each(function(){var i=e(this),s={height:i.height(),width:i.width(),outerHeight:i.outerHeight(),outerWidth:i.outerWidth()};f&&e.effects.save(i,l),i.from={height:s.height*a.from.y,width:s.width*a.from.x,outerHeight:s.outerHeight*a.from.y,outerWidth:s.outerWidth*a.from.x},i.to={height:s.height*a.to.y,width:s.width*a.to.x,outerHeight:s.height*a.to.y,outerWidth:s.width*a.to.x},a.from.y!==a.to.y&&(i.from=e.effects.setTransition(i,d,a.from.y,i.from),i.to=e.effects.setTransition(i,d,a.to.y,i.to)),a.from.x!==a.to.x&&(i.from=e.effects.setTransition(i,c,a.from.x,i.from),i.to=e.effects.setTransition(i,c,a.to.x,i.to)),i.css(i.from),i.animate(i.to,t.duration,t.easing,function(){f&&e.effects.restore(i,l)})})),o.animate(o.to,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){0===o.to.opacity&&o.css("opacity",o.from.opacity),"hide"===p&&o.hide(),e.effects.restore(o,y),f||("static"===v?o.css({position:"relative",top:o.to.top,left:o.to.left}):e.each(["top","left"],function(e,t){o.css(t,function(t,i){var s=parseInt(i,10),n=e?o.to.left:o.to.top;return"auto"===i?n+"px":s+n+"px"})})),e.effects.removeWrapper(o),i()}})},e.effects.effect.scale=function(t,i){var s=e(this),n=e.extend(!0,{},t),a=e.effects.setMode(s,t.mode||"effect"),o=parseInt(t.percent,10)||(0===parseInt(t.percent,10)?0:"hide"===a?0:100),r=t.direction||"both",h=t.origin,l={height:s.height(),width:s.width(),outerHeight:s.outerHeight(),outerWidth:s.outerWidth()},u={y:"horizontal"!==r?o/100:1,x:"vertical"!==r?o/100:1};n.effect="size",n.queue=!1,n.complete=i,"effect"!==a&&(n.origin=h||["middle","center"],n.restore=!0),n.from=t.from||("show"===a?{height:0,width:0,outerHeight:0,outerWidth:0}:l),n.to={height:l.height*u.y,width:l.width*u.x,outerHeight:l.outerHeight*u.y,outerWidth:l.outerWidth*u.x},n.fade&&("show"===a&&(n.from.opacity=0,n.to.opacity=1),"hide"===a&&(n.from.opacity=1,n.to.opacity=0)),s.effect(n)},e.effects.effect.puff=function(t,i){var s=e(this),n=e.effects.setMode(s,t.mode||"hide"),a="hide"===n,o=parseInt(t.percent,10)||150,r=o/100,h={height:s.height(),width:s.width(),outerHeight:s.outerHeight(),outerWidth:s.outerWidth()};e.extend(t,{effect:"scale",queue:!1,fade:!0,mode:n,complete:i,percent:a?o:100,from:a?h:{height:h.height*r,width:h.width*r,outerHeight:h.outerHeight*r,outerWidth:h.outerWidth*r}}),s.effect(t)},e.effects.effect.pulsate=function(t,i){var s,n=e(this),a=e.effects.setMode(n,t.mode||"show"),o="show"===a,r="hide"===a,h=o||"hide"===a,l=2*(t.times||5)+(h?1:0),u=t.duration/l,d=0,c=n.queue(),p=c.length;for((o||!n.is(":visible"))&&(n.css("opacity",0).show(),d=1),s=1;l>s;s++)n.animate({opacity:d},u,t.easing),d=1-d;n.animate({opacity:d},u,t.easing),n.queue(function(){r&&n.hide(),i()}),p>1&&c.splice.apply(c,[1,0].concat(c.splice(p,l+1))),n.dequeue()},e.effects.effect.shake=function(t,i){var s,n=e(this),a=["position","top","bottom","left","right","height","width"],o=e.effects.setMode(n,t.mode||"effect"),r=t.direction||"left",h=t.distance||20,l=t.times||3,u=2*l+1,d=Math.round(t.duration/u),c="up"===r||"down"===r?"top":"left",p="up"===r||"left"===r,f={},m={},g={},v=n.queue(),y=v.length;for(e.effects.save(n,a),n.show(),e.effects.createWrapper(n),f[c]=(p?"-=":"+=")+h,m[c]=(p?"+=":"-=")+2*h,g[c]=(p?"-=":"+=")+2*h,n.animate(f,d,t.easing),s=1;l>s;s++)n.animate(m,d,t.easing).animate(g,d,t.easing);n.animate(m,d,t.easing).animate(f,d/2,t.easing).queue(function(){"hide"===o&&n.hide(),e.effects.restore(n,a),e.effects.removeWrapper(n),i()}),y>1&&v.splice.apply(v,[1,0].concat(v.splice(y,u+1))),n.dequeue()},e.effects.effect.slide=function(t,i){var s,n=e(this),a=["position","top","bottom","left","right","width","height"],o=e.effects.setMode(n,t.mode||"show"),r="show"===o,h=t.direction||"left",l="up"===h||"down"===h?"top":"left",u="up"===h||"left"===h,d={};e.effects.save(n,a),n.show(),s=t.distance||n["top"===l?"outerHeight":"outerWidth"](!0),e.effects.createWrapper(n).css({overflow:"hidden"}),r&&n.css(l,u?isNaN(s)?"-"+s:-s:s),d[l]=(r?u?"+=":"-=":u?"-=":"+=")+s,n.animate(d,{queue:!1,duration:t.duration,easing:t.easing,complete:function(){"hide"===o&&n.hide(),e.effects.restore(n,a),e.effects.removeWrapper(n),i()}})},e.effects.effect.transfer=function(t,i){var s=e(this),n=e(t.to),a="fixed"===n.css("position"),o=e("body"),r=a?o.scrollTop():0,h=a?o.scrollLeft():0,l=n.offset(),u={top:l.top-r,left:l.left-h,height:n.innerHeight(),width:n.innerWidth()},d=s.offset(),c=e("<div class='ui-effects-transfer'></div>").appendTo(document.body).addClass(t.className).css({top:d.top-r,left:d.left-h,height:s.innerHeight(),width:s.innerWidth(),position:a?"fixed":"absolute"}).animate(u,t.duration,t.easing,function(){c.remove(),i()})}});

/*!
 * jQuery UI Touch Punch 0.2.3
 *
 * Copyright 2011�2014, Dave Furfero
 * Dual licensed under the MIT or GPL Version 2 licenses.
 *
 * Depends:
 *  jquery.ui.widget.js
 *  jquery.ui.mouse.js
 */
!function(a){function f(a,b){if(!(a.originalEvent.touches.length>1)){a.preventDefault();var c=a.originalEvent.changedTouches[0],d=document.createEvent("MouseEvents");d.initMouseEvent(b,!0,!0,window,1,c.screenX,c.screenY,c.clientX,c.clientY,!1,!1,!1,!1,0,null),a.target.dispatchEvent(d)}}if(a.support.touch="ontouchend"in document,a.support.touch){var e,b=a.ui.mouse.prototype,c=b._mouseInit,d=b._mouseDestroy;b._touchStart=function(a){var b=this;!e&&b._mouseCapture(a.originalEvent.changedTouches[0])&&(e=!0,b._touchMoved=!1,f(a,"mouseover"),f(a,"mousemove"),f(a,"mousedown"))},b._touchMove=function(a){e&&(this._touchMoved=!0,f(a,"mousemove"))},b._touchEnd=function(a){e&&(f(a,"mouseup"),f(a,"mouseout"),this._touchMoved||f(a,"click"),e=!1)},b._mouseInit=function(){var b=this;b.element.bind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),c.call(b)},b._mouseDestroy=function(){var b=this;b.element.unbind({touchstart:a.proxy(b,"_touchStart"),touchmove:a.proxy(b,"_touchMove"),touchend:a.proxy(b,"_touchEnd")}),d.call(b)}}}(jQuery);

/*! Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version 3.0.1
 *
 * Requires jQuery >= 1.2.6
 */
(function (factory) {
    if ( typeof define === 'function' && define.amd ) {
        // AMD. Register as an anonymous module.
        define(['jquery'], factory);
    } else if ( typeof exports === 'object' ) {
        // Node/CommonJS style for Browserify
        module.exports = factory;
    } else {
        // Browser globals
        factory(jQuery);
    }
}(function ($) {
    $.fn.bgiframe = function(s) {
        s = $.extend({
            top         : 'auto', // auto == borderTopWidth
            left        : 'auto', // auto == borderLeftWidth
            width       : 'auto', // auto == offsetWidth
            height      : 'auto', // auto == offsetHeight
            opacity     : true,
            src         : 'javascript:false;',
            conditional : /MSIE 6\.0/.test(navigator.userAgent) // expression or function. return false to prevent iframe insertion
        }, s);

        // wrap conditional in a function if it isn't already
        if ( !$.isFunction(s.conditional) ) {
            var condition = s.conditional;
            s.conditional = function() { return condition; };
        }

        var $iframe = $('<iframe class="bgiframe"frameborder="0"tabindex="-1"src="'+s.src+'"'+
                           'style="display:block;position:absolute;z-index:-1;"/>');

        return this.each(function() {
            var $this = $(this);
            if ( s.conditional(this) === false ) { return; }
            var existing = $this.children('iframe.bgiframe');
            var $el = existing.length === 0 ? $iframe.clone() : existing;
            $el.css({
                'top': s.top == 'auto' ?
                    ((parseInt($this.css('borderTopWidth'),10)||0)*-1)+'px' : prop(s.top),
                'left': s.left == 'auto' ?
                    ((parseInt($this.css('borderLeftWidth'),10)||0)*-1)+'px' : prop(s.left),
                'width': s.width == 'auto' ? (this.offsetWidth + 'px') : prop(s.width),
                'height': s.height == 'auto' ? (this.offsetHeight + 'px') : prop(s.height),
                'opacity': s.opacity === true ? 0 : undefined
            });

            if ( existing.length === 0 ) {
                $this.prepend($el);
            }
        });
    };

    // old alias
    $.fn.bgIframe = $.fn.bgiframe;

    function prop(n) {
        return n && n.constructor === Number ? n + 'px' : n;
    }

}));

/*
 * jQuery Tools 1.2.4 - The missing UI library for the Web
 *
 * [tooltip, tooltip.dynamic]
 *
 * NO COPYRIGHTS OR LICENSES. DO WHAT YOU LIKE.
 *
 * http://flowplayer.org/tools/
 *
 * File generated: Mon Aug 30 11:53:49 GMT 2010
 */
(function(f){function p(a,b,c){var h=c.relative?a.position().top:a.offset().top,e=c.relative?a.position().left:a.offset().left,i=c.position[0];h-=b.outerHeight()-c.offset[0];e+=a.outerWidth()+c.offset[1];var j=b.outerHeight()+a.outerHeight();if(i=="center")h+=j/2;if(i=="bottom")h+=j;i=c.position[1];a=b.outerWidth()+a.outerWidth();if(i=="center")e-=a/2;if(i=="left")e-=a;return{top:h,left:e}}function u(a,b){var c=this,h=a.add(c),e,i=0,j=0,m=a.attr("title"),q=a.attr("data-tooltip"),r=n[b.effect],l,s=
a.is(":input"),v=s&&a.is(":checkbox, :radio, select, :button, :submit"),t=a.attr("type"),k=b.events[t]||b.events[s?v?"widget":"input":"def"];if(!r)throw'Nonexistent effect "'+b.effect+'"';k=k.split(/,\s*/);if(k.length!=2)throw"Tooltip: bad events configuration for "+t;a.bind(k[0],function(d){clearTimeout(i);if(b.predelay)j=setTimeout(function(){c.show(d)},b.predelay);else c.show(d)}).bind(k[1],function(d){clearTimeout(j);if(b.delay)i=setTimeout(function(){c.hide(d)},b.delay);else c.hide(d)});if(m&&
b.cancelDefault){a.removeAttr("title");a.data("title",m)}f.extend(c,{show:function(d){if(!e){if(q)e=f(q);else if(m)e=f(b.layout).addClass(b.tipClass).appendTo(document.body).hide().append(m);else if(b.tip)e=f(b.tip).eq(0);else{e=a.next();e.length||(e=a.parent().next())}if(!e.length)throw"Cannot find tooltip for "+a;}if(c.isShown())return c;e.stop(true,true);var g=p(a,e,b);d=d||f.Event();d.type="onBeforeShow";h.trigger(d,[g]);if(d.isDefaultPrevented())return c;g=p(a,e,b);e.css({position:"absolute",
top:g.top,left:g.left});l=true;r[0].call(c,function(){d.type="onShow";l="full";h.trigger(d)});g=b.events.tooltip.split(/,\s*/);e.bind(g[0],function(){clearTimeout(i);clearTimeout(j)});g[1]&&!a.is("input:not(:checkbox, :radio), textarea")&&e.bind(g[1],function(o){o.relatedTarget!=a[0]&&a.trigger(k[1].split(" ")[0])});return c},hide:function(d){if(!e||!c.isShown())return c;d=d||f.Event();d.type="onBeforeHide";h.trigger(d);if(!d.isDefaultPrevented()){l=false;n[b.effect][1].call(c,function(){d.type="onHide";
h.trigger(d)});return c}},isShown:function(d){return d?l=="full":l},getConf:function(){return b},getTip:function(){return e},getTrigger:function(){return a}});f.each("onHide,onBeforeShow,onShow,onBeforeHide".split(","),function(d,g){f.isFunction(b[g])&&f(c).bind(g,b[g]);c[g]=function(o){f(c).bind(g,o);return c}})}f.tools=f.tools||{version:"1.2.4"};f.tools.tooltip={conf:{effect:"toggle",fadeOutSpeed:"fast",predelay:0,delay:30,opacity:1,tip:0,position:["top","center"],offset:[0,0],relative:false,cancelDefault:true,
events:{def:"mouseenter,mouseleave",input:"focus,blur",widget:"focus mouseenter,blur mouseleave",tooltip:"mouseenter,mouseleave"},layout:"<div/>",tipClass:"tooltip"},addEffect:function(a,b,c){n[a]=[b,c]}};var n={toggle:[function(a){var b=this.getConf(),c=this.getTip();b=b.opacity;b<1&&c.css({opacity:b});c.show();a.call()},function(a){this.getTip().hide();a.call()}],fade:[function(a){var b=this.getConf();this.getTip().fadeTo(b.fadeInSpeed,b.opacity,a)},function(a){this.getTip().fadeOut(this.getConf().fadeOutSpeed,
a)}]};f.fn.tooltip2=function(a){var b=this.data("tooltip");if(b)return b;a=f.extend(true,{},f.tools.tooltip.conf,a);if(typeof a.position=="string")a.position=a.position.split(/,?\s/);this.each(function(){b=new u(f(this),a);f(this).data("tooltip",b)});return a.api?b:this}})(jQuery);
(function(g){function j(a){var c=g(window),d=c.width()+c.scrollLeft(),h=c.height()+c.scrollTop();return[a.offset().top<=c.scrollTop(),d<=a.offset().left+a.width(),h<=a.offset().top+a.height(),c.scrollLeft()>=a.offset().left]}function k(a){for(var c=a.length;c--;)if(a[c])return false;return true}var i=g.tools.tooltip;i.dynamic={conf:{classNames:"top right bottom left"}};g.fn.dynamic=function(a){if(typeof a=="number")a={speed:a};a=g.extend({},i.dynamic.conf,a);var c=a.classNames.split(/\s/),d;this.each(function(){var h=
g(this).tooltip2().onBeforeShow(function(e,f){e=this.getTip();var b=this.getConf();d||(d=[b.position[0],b.position[1],b.offset[0],b.offset[1],g.extend({},b)]);g.extend(b,d[4]);b.position=[d[0],d[1]];b.offset=[d[2],d[3]];e.css({visibility:"hidden",position:"absolute",top:f.top,left:f.left}).show();f=j(e);if(!k(f)){if(f[2]){g.extend(b,a.top);b.position[0]="top";e.addClass(c[0])}if(f[3]){g.extend(b,a.right);b.position[1]="right";e.addClass(c[1])}if(f[0]){g.extend(b,a.bottom);b.position[0]="bottom";e.addClass(c[2])}if(f[1]){g.extend(b,
a.left);b.position[1]="left";e.addClass(c[3])}if(f[0]||f[2])b.offset[0]*=-1;if(f[1]||f[3])b.offset[1]*=-1}e.css({visibility:"visible"}).hide()});h.onBeforeShow(function(){var e=this.getConf();this.getTip();setTimeout(function(){e.position=[d[0],d[1]];e.offset=[d[2],d[3]]},0)});h.onHide(function(){var e=this.getTip();e.removeClass(a.classNames)});ret=h});return a.api?ret:this}})(jQuery);
/*
* jQuery timepicker addon
* By: Trent Richardson [http://trentrichardson.com]
* Version 0.6.2
* Last Modified: 9/26/2010
*
* Copyright 2010 Trent Richardson
* Dual licensed under the MIT and GPL licenses.
* http://trentrichardson.com/Impromptu/GPL-LICENSE.txt
* http://trentrichardson.com/Impromptu/MIT-LICENSE.txt
*
* HERES THE CSS:
* .ui-timepicker-div dl{ text-align: left; }
* .ui-timepicker-div dl dt{ height: 25px; }
* .ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
*/
(function($){function Timepicker(singleton){if(typeof(singleton)==='boolean'&&singleton==true){this.regional=[];this.regional['']={currentText:'Now',ampm:false,timeFormat:'hh:mm tt',timeOnlyTitle:'Choose Time',timeText:'Time',hourText:'Hour',minuteText:'Minute',secondText:'Second'};this.defaults={showButtonPanel:true,timeOnly:false,showHour:true,showMinute:true,showSecond:false,showTime:true,stepHour:0.05,stepMinute:0.05,stepSecond:0.05,hour:0,minute:0,second:0,hourMin:0,minuteMin:0,secondMin:0,hourMax:23,minuteMax:59,secondMax:59,alwaysSetTime:true};$.extend(this.defaults,this.regional['']);}else{this.defaults=$.extend({},$.timepicker.defaults);}}Timepicker.prototype={$input:null,$timeObj:null,inst:null,hour_slider:null,minute_slider:null,second_slider:null,hour:0,minute:0,second:0,ampm:'',formattedDate:'',formattedTime:'',formattedDateTime:'',addTimePicker:function(dp_inst){var tp_inst=this;var currDT=this.$input.val();var regstr=this.defaults.timeFormat.toString().replace(/h{1,2}/ig,'(\\d?\\d)').replace(/m{1,2}/ig,'(\\d?\\d)').replace(/s{1,2}/ig,'(\\d?\\d)').replace(/t{1,2}/ig,'(am|pm|a|p)?').replace(/\s/g,'\\s?')+'$';if(!this.defaults.timeOnly){var dp_dateFormat=$.datepicker._get(dp_inst,'dateFormat');regstr='.{'+dp_dateFormat.length+',}\\s+'+regstr;}var order=this.getFormatPositions();var treg=currDT.match(new RegExp(regstr,'i'));if(treg){if(order.t!==-1){this.ampm=((treg[order.t]===undefined||treg[order.t].length===0)?'':(treg[order.t].charAt(0).toUpperCase()=='A')?'AM':'PM').toUpperCase();}if(order.h!==-1){if(this.ampm=='AM'&&treg[order.h]=='12'){this.hour=0;}else if(this.ampm=='PM'&&treg[order.h]!='12'){this.hour=(parseFloat(treg[order.h])+12).toFixed(0);}else{this.hour=treg[order.h];}}if(order.m!==-1){this.minute=treg[order.m];}if(order.s!==-1){this.second=treg[order.s];}}tp_inst.timeDefined=(treg)?true:false;if(typeof(dp_inst.stay_open)!=='boolean'||dp_inst.stay_open===false){setTimeout(function(){tp_inst.injectTimePicker(dp_inst,tp_inst);},10);}else{tp_inst.injectTimePicker(dp_inst,tp_inst);}},getFormatPositions:function(){var finds=this.defaults.timeFormat.toLowerCase().match(/(h{1,2}|m{1,2}|s{1,2}|t{1,2})/g);var orders={h:-1,m:-1,s:-1,t:-1};if(finds){for(var i=0;i<finds.length;i++){if(orders[finds[i].toString().charAt(0)]==-1){orders[finds[i].toString().charAt(0)]=i+1;}}}return orders;},injectTimePicker:function(dp_inst,tp_inst){var $dp=dp_inst.dpDiv;var opts=tp_inst.defaults;var hourMax=opts.hourMax-(opts.hourMax%opts.stepHour);var minMax=opts.minuteMax-(opts.minuteMax%opts.stepMinute);var secMax=opts.secondMax-(opts.secondMax%opts.stepSecond);if($dp.find("div#ui-timepicker-div-"+dp_inst.id).length===0){var noDisplay=' style="display:none;"';var html='<div class="ui-timepicker-div" id="ui-timepicker-div-'+dp_inst.id+'"><dl>'+'<dt class="ui_tpicker_time_label" id="ui_tpicker_time_label_'+dp_inst.id+'"'+((opts.showTime)?'':noDisplay)+'>'+opts.timeText+'</dt>'+'<dd class="ui_tpicker_time" id="ui_tpicker_time_'+dp_inst.id+'"'+((opts.showTime)?'':noDisplay)+'></dd>'+'<dt class="ui_tpicker_hour_label" id="ui_tpicker_hour_label_'+dp_inst.id+'"'+((opts.showHour)?'':noDisplay)+'>'+opts.hourText+'</dt>'+'<dd class="ui_tpicker_hour" id="ui_tpicker_hour_'+dp_inst.id+'"'+((opts.showHour)?'':noDisplay)+'></dd>'+'<dt class="ui_tpicker_minute_label" id="ui_tpicker_minute_label_'+dp_inst.id+'"'+((opts.showMinute)?'':noDisplay)+'>'+opts.minuteText+'</dt>'+'<dd class="ui_tpicker_minute" id="ui_tpicker_minute_'+dp_inst.id+'"'+((opts.showMinute)?'':noDisplay)+'></dd>'+'<dt class="ui_tpicker_second_label" id="ui_tpicker_second_label_'+dp_inst.id+'"'+((opts.showSecond)?'':noDisplay)+'>'+opts.secondText+'</dt>'+'<dd class="ui_tpicker_second" id="ui_tpicker_second_'+dp_inst.id+'"'+((opts.showSecond)?'':noDisplay)+'></dd>'+'</dl></div>';$tp=$(html);if(opts.timeOnly===true){$tp.prepend('<div class="ui-widget-header ui-helper-clearfix ui-corner-all">'+'<div class="ui-datepicker-title">'+opts.timeOnlyTitle+'</div>'+'</div>');$dp.find('.ui-datepicker-header, .ui-datepicker-calendar').hide();}tp_inst.hour_slider=$tp.find('#ui_tpicker_hour_'+dp_inst.id).slider({orientation:"horizontal",value:tp_inst.hour,min:opts.hourMin,max:hourMax,step:opts.stepHour,slide:function(event,ui){tp_inst.hour_slider.slider("option","value",ui.value);tp_inst.onTimeChange(dp_inst,tp_inst);}});tp_inst.minute_slider=$tp.find('#ui_tpicker_minute_'+dp_inst.id).slider({orientation:"horizontal",value:tp_inst.minute,min:opts.minuteMin,max:minMax,step:opts.stepMinute,slide:function(event,ui){tp_inst.minute_slider.slider("option","value",ui.value);tp_inst.onTimeChange(dp_inst,tp_inst);}});tp_inst.second_slider=$tp.find('#ui_tpicker_second_'+dp_inst.id).slider({orientation:"horizontal",value:tp_inst.second,min:opts.secondMin,max:secMax,step:opts.stepSecond,slide:function(event,ui){tp_inst.second_slider.slider("option","value",ui.value);tp_inst.onTimeChange(dp_inst,tp_inst);}});$dp.find('.ui-datepicker-calendar').after($tp);tp_inst.$timeObj=$('#ui_tpicker_time_'+dp_inst.id);if(dp_inst!==null){var timeDefined=tp_inst.timeDefined;tp_inst.onTimeChange(dp_inst,tp_inst);tp_inst.timeDefined=timeDefined;}}},onTimeChange:function(dp_inst,tp_inst){var hour=tp_inst.hour_slider.slider('value');var minute=tp_inst.minute_slider.slider('value');var second=tp_inst.second_slider.slider('value');var ampm=(hour<12)?'AM':'PM';var hasChanged=false;if(tp_inst.hour!=hour||tp_inst.minute!=minute||tp_inst.second!=second||(tp_inst.ampm.length>0&&tp_inst.ampm!=ampm)){hasChanged=true;}tp_inst.hour=parseFloat(hour).toFixed(0);tp_inst.minute=parseFloat(minute).toFixed(0);tp_inst.second=parseFloat(second).toFixed(0);tp_inst.ampm=ampm;tp_inst.formatTime(tp_inst);tp_inst.$timeObj.text(tp_inst.formattedTime);if(hasChanged){tp_inst.updateDateTime(dp_inst,tp_inst);tp_inst.timeDefined=true;}},formatTime:function(tp_inst){var tmptime=tp_inst.defaults.timeFormat.toString();var hour12=((tp_inst.ampm=='AM')?(tp_inst.hour):(tp_inst.hour%12));hour12=(hour12===0)?12:hour12;if(tp_inst.defaults.ampm===true){tmptime=tmptime.toString().replace(/hh/g,((hour12<10)?'0':'')+hour12).replace(/h/g,hour12).replace(/mm/g,((tp_inst.minute<10)?'0':'')+tp_inst.minute).replace(/m/g,tp_inst.minute).replace(/ss/g,((tp_inst.second<10)?'0':'')+tp_inst.second).replace(/s/g,tp_inst.second).replace(/TT/g,tp_inst.ampm.toUpperCase()).replace(/tt/g,tp_inst.ampm.toLowerCase()).replace(/T/g,tp_inst.ampm.charAt(0).toUpperCase()).replace(/t/g,tp_inst.ampm.charAt(0).toLowerCase());}else{tmptime=tmptime.toString().replace(/hh/g,((tp_inst.hour<10)?'0':'')+tp_inst.hour).replace(/h/g,tp_inst.hour).replace(/mm/g,((tp_inst.minute<10)?'0':'')+tp_inst.minute).replace(/m/g,tp_inst.minute).replace(/ss/g,((tp_inst.second<10)?'0':'')+tp_inst.second).replace(/s/g,tp_inst.second);tmptime=$.trim(tmptime.replace(/t/gi,''));}tp_inst.formattedTime=tmptime;return tp_inst.formattedTime;},updateDateTime:function(dp_inst,tp_inst){var dt=new Date(dp_inst.selectedYear,dp_inst.selectedMonth,dp_inst.selectedDay);var dateFmt=$.datepicker._get(dp_inst,'dateFormat');var formatCfg=$.datepicker._getFormatConfig(dp_inst);this.formattedDate=$.datepicker.formatDate(dateFmt,(dt===null?new Date():dt),formatCfg);var formattedDateTime=this.formattedDate;var timeAvailable=dt!==null&&tp_inst.timeDefined;if(this.defaults.timeOnly===true){formattedDateTime=this.formattedTime;}else if(this.defaults.timeOnly!==true&&(this.defaults.alwaysSetTime||timeAvailable)){formattedDateTime+=' '+this.formattedTime;}this.formattedDateTime=formattedDateTime;this.$input.val(formattedDateTime);this.$input.trigger("change");},setDefaults:function(settings){extendRemove(this.defaults,settings||{});return this;}};jQuery.fn.datetimepicker=function(o){var opts=(o===undefined?{}:o);var input=$(this);var tp=new Timepicker();var inlineSettings={};for(var attrName in tp.defaults){var attrValue=input.attr('time:'+attrName);if(attrValue){try{inlineSettings[attrName]=eval(attrValue);}catch(err){inlineSettings[attrName]=attrValue;}}}tp.defaults=$.extend(tp.defaults,inlineSettings);var beforeShowFunc=function(input,inst){tp.hour=tp.defaults.hour;tp.minute=tp.defaults.minute;tp.second=tp.defaults.second;tp.ampm='';tp.$input=$(input);tp.inst=inst;tp.addTimePicker(inst);if($.isFunction(opts.beforeShow)){opts.beforeShow(input,inst);}};var onChangeMonthYearFunc=function(year,month,inst){tp.updateDateTime(inst,tp);if($.isFunction(opts.onChangeMonthYear)){opts.onChangeMonthYear(year,month,inst);}};var onCloseFunc=function(dateText,inst){if(tp.timeDefined===true&&input.val()!=''){tp.updateDateTime(inst,tp);}if($.isFunction(opts.onClose)){opts.onClose(dateText,inst);}};tp.defaults=$.extend({},tp.defaults,opts,{beforeShow:beforeShowFunc,onChangeMonthYear:onChangeMonthYearFunc,onClose:onCloseFunc,timepicker:tp});$(this).datepicker(tp.defaults);};jQuery.fn.timepicker=function(opts){opts=$.extend(opts,{timeOnly:true});$(this).datetimepicker(opts);};$.datepicker._base_selectDate=$.datepicker._selectDate;$.datepicker._selectDate=function(id,dateStr){var target=$(id);var inst=this._getInst(target[0]);var tp_inst=$.datepicker._get(inst,'timepicker');if(tp_inst){inst.inline=true;inst.stay_open=true;$.datepicker._base_selectDate(id,dateStr);inst.stay_open=false;inst.inline=false;this._notifyChange(inst);this._updateDatepicker(inst);}else{$.datepicker._base_selectDate(id,dateStr);}};$.datepicker._base_updateDatepicker=$.datepicker._updateDatepicker;$.datepicker._updateDatepicker=function(inst){if(typeof(inst.stay_open)!=='boolean'||inst.stay_open===false){this._base_updateDatepicker(inst);this._beforeShow(inst.input,inst);}};$.datepicker._beforeShow=function(input,inst){var beforeShow=this._get(inst,'beforeShow');if(beforeShow){inst.stay_open=true;beforeShow.apply((inst.input?inst.input[0]:null),[inst.input,inst]);inst.stay_open=false;}};$.datepicker._base_doKeyPress=$.datepicker._doKeyPress;$.datepicker._doKeyPress=function(event){var inst=$.datepicker._getInst(event.target);var tp_inst=$.datepicker._get(inst,'timepicker');if(tp_inst){if($.datepicker._get(inst,'constrainInput')){var dateChars=$.datepicker._possibleChars($.datepicker._get(inst,'dateFormat'));var chr=String.fromCharCode(event.charCode===undefined?event.keyCode:event.charCode);var chrl=chr.toLowerCase();return event.ctrlKey||(chr<' '||!dateChars||dateChars.indexOf(chr)>-1||event.keyCode==58||event.keyCode==32||chr==':'||chr==' '||chrl=='a'||chrl=='p'||charl=='m');}}else{return $.datepicker._base_doKeyPress(event);}};$.datepicker._base_gotoToday=$.datepicker._gotoToday;$.datepicker._gotoToday=function(id){$.datepicker._base_gotoToday(id);var target=$(id);var dp_inst=this._getInst(target[0]);var tp_inst=$.datepicker._get(dp_inst,'timepicker');if(tp_inst){var date=new Date();var hour=date.getHours();var minute=date.getMinutes();var second=date.getSeconds();if((hour<tp_inst.defaults.hourMin||hour>tp_inst.defaults.hourMax)||(minute<tp_inst.defaults.minuteMin||minute>tp_inst.defaults.minuteMax)||(second<tp_inst.defaults.secondMin||second>tp_inst.defaults.secondMax)){hour=tp_inst.defaults.hourMin;minute=tp_inst.defaults.minuteMin;second=tp_inst.defaults.secondMin;}tp_inst.hour_slider.slider('value',hour);tp_inst.minute_slider.slider('value',minute);tp_inst.second_slider.slider('value',second);tp_inst.onTimeChange(dp_inst,tp_inst);}};function extendRemove(target,props){$.extend(target,props);for(var name in props)if(props[name]==null||props[name]==undefined)target[name]=props[name];return target;};$.timepicker=new Timepicker(true);})(jQuery);

/*!
 DataTables 1.10.13
 ©2008-2016 SpryMedia Ltd - datatables.net/license
*/
(function(h){"function"===typeof define&&define.amd?define(["jquery"],function(E){return h(E,window,document)}):"object"===typeof exports?module.exports=function(E,H){E||(E=window);H||(H="undefined"!==typeof window?require("jquery"):require("jquery")(E));return h(H,E,E.document)}:h(jQuery,window,document)})(function(h,E,H,k){function Y(a){var b,c,d={};h.each(a,function(e){if((b=e.match(/^([^A-Z]+?)([A-Z])/))&&-1!=="a aa ai ao as b fn i m o s ".indexOf(b[1]+" "))c=e.replace(b[0],b[2].toLowerCase()),
d[c]=e,"o"===b[1]&&Y(a[e])});a._hungarianMap=d}function J(a,b,c){a._hungarianMap||Y(a);var d;h.each(b,function(e){d=a._hungarianMap[e];if(d!==k&&(c||b[d]===k))"o"===d.charAt(0)?(b[d]||(b[d]={}),h.extend(!0,b[d],b[e]),J(a[d],b[d],c)):b[d]=b[e]})}function Fa(a){var b=m.defaults.oLanguage,c=a.sZeroRecords;!a.sEmptyTable&&(c&&"No data available in table"===b.sEmptyTable)&&F(a,a,"sZeroRecords","sEmptyTable");!a.sLoadingRecords&&(c&&"Loading..."===b.sLoadingRecords)&&F(a,a,"sZeroRecords","sLoadingRecords");
a.sInfoThousands&&(a.sThousands=a.sInfoThousands);(a=a.sDecimal)&&fb(a)}function gb(a){A(a,"ordering","bSort");A(a,"orderMulti","bSortMulti");A(a,"orderClasses","bSortClasses");A(a,"orderCellsTop","bSortCellsTop");A(a,"order","aaSorting");A(a,"orderFixed","aaSortingFixed");A(a,"paging","bPaginate");A(a,"pagingType","sPaginationType");A(a,"pageLength","iDisplayLength");A(a,"searching","bFilter");"boolean"===typeof a.sScrollX&&(a.sScrollX=a.sScrollX?"100%":"");"boolean"===typeof a.scrollX&&(a.scrollX=
a.scrollX?"100%":"");if(a=a.aoSearchCols)for(var b=0,c=a.length;b<c;b++)a[b]&&J(m.models.oSearch,a[b])}function hb(a){A(a,"orderable","bSortable");A(a,"orderData","aDataSort");A(a,"orderSequence","asSorting");A(a,"orderDataType","sortDataType");var b=a.aDataSort;b&&!h.isArray(b)&&(a.aDataSort=[b])}function ib(a){if(!m.__browser){var b={};m.__browser=b;var c=h("<div/>").css({position:"fixed",top:0,left:-1*h(E).scrollLeft(),height:1,width:1,overflow:"hidden"}).append(h("<div/>").css({position:"absolute",
top:1,left:1,width:100,overflow:"scroll"}).append(h("<div/>").css({width:"100%",height:10}))).appendTo("body"),d=c.children(),e=d.children();b.barWidth=d[0].offsetWidth-d[0].clientWidth;b.bScrollOversize=100===e[0].offsetWidth&&100!==d[0].clientWidth;b.bScrollbarLeft=1!==Math.round(e.offset().left);b.bBounding=c[0].getBoundingClientRect().width?!0:!1;c.remove()}h.extend(a.oBrowser,m.__browser);a.oScroll.iBarWidth=m.__browser.barWidth}function jb(a,b,c,d,e,f){var g,j=!1;c!==k&&(g=c,j=!0);for(;d!==
e;)a.hasOwnProperty(d)&&(g=j?b(g,a[d],d,a):a[d],j=!0,d+=f);return g}function Ga(a,b){var c=m.defaults.column,d=a.aoColumns.length,c=h.extend({},m.models.oColumn,c,{nTh:b?b:H.createElement("th"),sTitle:c.sTitle?c.sTitle:b?b.innerHTML:"",aDataSort:c.aDataSort?c.aDataSort:[d],mData:c.mData?c.mData:d,idx:d});a.aoColumns.push(c);c=a.aoPreSearchCols;c[d]=h.extend({},m.models.oSearch,c[d]);la(a,d,h(b).data())}function la(a,b,c){var b=a.aoColumns[b],d=a.oClasses,e=h(b.nTh);if(!b.sWidthOrig){b.sWidthOrig=
e.attr("width")||null;var f=(e.attr("style")||"").match(/width:\s*(\d+[pxem%]+)/);f&&(b.sWidthOrig=f[1])}c!==k&&null!==c&&(hb(c),J(m.defaults.column,c),c.mDataProp!==k&&!c.mData&&(c.mData=c.mDataProp),c.sType&&(b._sManualType=c.sType),c.className&&!c.sClass&&(c.sClass=c.className),h.extend(b,c),F(b,c,"sWidth","sWidthOrig"),c.iDataSort!==k&&(b.aDataSort=[c.iDataSort]),F(b,c,"aDataSort"));var g=b.mData,j=R(g),i=b.mRender?R(b.mRender):null,c=function(a){return"string"===typeof a&&-1!==a.indexOf("@")};
b._bAttrSrc=h.isPlainObject(g)&&(c(g.sort)||c(g.type)||c(g.filter));b._setter=null;b.fnGetData=function(a,b,c){var d=j(a,b,k,c);return i&&b?i(d,b,a,c):d};b.fnSetData=function(a,b,c){return S(g)(a,b,c)};"number"!==typeof g&&(a._rowReadObject=!0);a.oFeatures.bSort||(b.bSortable=!1,e.addClass(d.sSortableNone));a=-1!==h.inArray("asc",b.asSorting);c=-1!==h.inArray("desc",b.asSorting);!b.bSortable||!a&&!c?(b.sSortingClass=d.sSortableNone,b.sSortingClassJUI=""):a&&!c?(b.sSortingClass=d.sSortableAsc,b.sSortingClassJUI=
d.sSortJUIAscAllowed):!a&&c?(b.sSortingClass=d.sSortableDesc,b.sSortingClassJUI=d.sSortJUIDescAllowed):(b.sSortingClass=d.sSortable,b.sSortingClassJUI=d.sSortJUI)}function Z(a){if(!1!==a.oFeatures.bAutoWidth){var b=a.aoColumns;Ha(a);for(var c=0,d=b.length;c<d;c++)b[c].nTh.style.width=b[c].sWidth}b=a.oScroll;(""!==b.sY||""!==b.sX)&&ma(a);s(a,null,"column-sizing",[a])}function $(a,b){var c=na(a,"bVisible");return"number"===typeof c[b]?c[b]:null}function aa(a,b){var c=na(a,"bVisible"),c=h.inArray(b,
c);return-1!==c?c:null}function ba(a){var b=0;h.each(a.aoColumns,function(a,d){d.bVisible&&"none"!==h(d.nTh).css("display")&&b++});return b}function na(a,b){var c=[];h.map(a.aoColumns,function(a,e){a[b]&&c.push(e)});return c}function Ia(a){var b=a.aoColumns,c=a.aoData,d=m.ext.type.detect,e,f,g,j,i,h,l,q,r;e=0;for(f=b.length;e<f;e++)if(l=b[e],r=[],!l.sType&&l._sManualType)l.sType=l._sManualType;else if(!l.sType){g=0;for(j=d.length;g<j;g++){i=0;for(h=c.length;i<h;i++){r[i]===k&&(r[i]=B(a,i,e,"type"));
q=d[g](r[i],a);if(!q&&g!==d.length-1)break;if("html"===q)break}if(q){l.sType=q;break}}l.sType||(l.sType="string")}}function kb(a,b,c,d){var e,f,g,j,i,n,l=a.aoColumns;if(b)for(e=b.length-1;0<=e;e--){n=b[e];var q=n.targets!==k?n.targets:n.aTargets;h.isArray(q)||(q=[q]);f=0;for(g=q.length;f<g;f++)if("number"===typeof q[f]&&0<=q[f]){for(;l.length<=q[f];)Ga(a);d(q[f],n)}else if("number"===typeof q[f]&&0>q[f])d(l.length+q[f],n);else if("string"===typeof q[f]){j=0;for(i=l.length;j<i;j++)("_all"==q[f]||h(l[j].nTh).hasClass(q[f]))&&
d(j,n)}}if(c){e=0;for(a=c.length;e<a;e++)d(e,c[e])}}function N(a,b,c,d){var e=a.aoData.length,f=h.extend(!0,{},m.models.oRow,{src:c?"dom":"data",idx:e});f._aData=b;a.aoData.push(f);for(var g=a.aoColumns,j=0,i=g.length;j<i;j++)g[j].sType=null;a.aiDisplayMaster.push(e);b=a.rowIdFn(b);b!==k&&(a.aIds[b]=f);(c||!a.oFeatures.bDeferRender)&&Ja(a,e,c,d);return e}function oa(a,b){var c;b instanceof h||(b=h(b));return b.map(function(b,e){c=Ka(a,e);return N(a,c.data,e,c.cells)})}function B(a,b,c,d){var e=a.iDraw,
f=a.aoColumns[c],g=a.aoData[b]._aData,j=f.sDefaultContent,i=f.fnGetData(g,d,{settings:a,row:b,col:c});if(i===k)return a.iDrawError!=e&&null===j&&(K(a,0,"Requested unknown parameter "+("function"==typeof f.mData?"{function}":"'"+f.mData+"'")+" for row "+b+", column "+c,4),a.iDrawError=e),j;if((i===g||null===i)&&null!==j&&d!==k)i=j;else if("function"===typeof i)return i.call(g);return null===i&&"display"==d?"":i}function lb(a,b,c,d){a.aoColumns[c].fnSetData(a.aoData[b]._aData,d,{settings:a,row:b,col:c})}
function La(a){return h.map(a.match(/(\\.|[^\.])+/g)||[""],function(a){return a.replace(/\\\./g,".")})}function R(a){if(h.isPlainObject(a)){var b={};h.each(a,function(a,c){c&&(b[a]=R(c))});return function(a,c,f,g){var j=b[c]||b._;return j!==k?j(a,c,f,g):a}}if(null===a)return function(a){return a};if("function"===typeof a)return function(b,c,f,g){return a(b,c,f,g)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var c=function(a,b,f){var g,j;if(""!==f){j=La(f);
for(var i=0,n=j.length;i<n;i++){f=j[i].match(ca);g=j[i].match(V);if(f){j[i]=j[i].replace(ca,"");""!==j[i]&&(a=a[j[i]]);g=[];j.splice(0,i+1);j=j.join(".");if(h.isArray(a)){i=0;for(n=a.length;i<n;i++)g.push(c(a[i],b,j))}a=f[0].substring(1,f[0].length-1);a=""===a?g:g.join(a);break}else if(g){j[i]=j[i].replace(V,"");a=a[j[i]]();continue}if(null===a||a[j[i]]===k)return k;a=a[j[i]]}}return a};return function(b,e){return c(b,e,a)}}return function(b){return b[a]}}function S(a){if(h.isPlainObject(a))return S(a._);
if(null===a)return function(){};if("function"===typeof a)return function(b,d,e){a(b,"set",d,e)};if("string"===typeof a&&(-1!==a.indexOf(".")||-1!==a.indexOf("[")||-1!==a.indexOf("("))){var b=function(a,d,e){var e=La(e),f;f=e[e.length-1];for(var g,j,i=0,n=e.length-1;i<n;i++){g=e[i].match(ca);j=e[i].match(V);if(g){e[i]=e[i].replace(ca,"");a[e[i]]=[];f=e.slice();f.splice(0,i+1);g=f.join(".");if(h.isArray(d)){j=0;for(n=d.length;j<n;j++)f={},b(f,d[j],g),a[e[i]].push(f)}else a[e[i]]=d;return}j&&(e[i]=e[i].replace(V,
""),a=a[e[i]](d));if(null===a[e[i]]||a[e[i]]===k)a[e[i]]={};a=a[e[i]]}if(f.match(V))a[f.replace(V,"")](d);else a[f.replace(ca,"")]=d};return function(c,d){return b(c,d,a)}}return function(b,d){b[a]=d}}function Ma(a){return D(a.aoData,"_aData")}function pa(a){a.aoData.length=0;a.aiDisplayMaster.length=0;a.aiDisplay.length=0;a.aIds={}}function qa(a,b,c){for(var d=-1,e=0,f=a.length;e<f;e++)a[e]==b?d=e:a[e]>b&&a[e]--; -1!=d&&c===k&&a.splice(d,1)}function da(a,b,c,d){var e=a.aoData[b],f,g=function(c,d){for(;c.childNodes.length;)c.removeChild(c.firstChild);
c.innerHTML=B(a,b,d,"display")};if("dom"===c||(!c||"auto"===c)&&"dom"===e.src)e._aData=Ka(a,e,d,d===k?k:e._aData).data;else{var j=e.anCells;if(j)if(d!==k)g(j[d],d);else{c=0;for(f=j.length;c<f;c++)g(j[c],c)}}e._aSortData=null;e._aFilterData=null;g=a.aoColumns;if(d!==k)g[d].sType=null;else{c=0;for(f=g.length;c<f;c++)g[c].sType=null;Na(a,e)}}function Ka(a,b,c,d){var e=[],f=b.firstChild,g,j,i=0,n,l=a.aoColumns,q=a._rowReadObject,d=d!==k?d:q?{}:[],r=function(a,b){if("string"===typeof a){var c=a.indexOf("@");
-1!==c&&(c=a.substring(c+1),S(a)(d,b.getAttribute(c)))}},m=function(a){if(c===k||c===i)j=l[i],n=h.trim(a.innerHTML),j&&j._bAttrSrc?(S(j.mData._)(d,n),r(j.mData.sort,a),r(j.mData.type,a),r(j.mData.filter,a)):q?(j._setter||(j._setter=S(j.mData)),j._setter(d,n)):d[i]=n;i++};if(f)for(;f;){g=f.nodeName.toUpperCase();if("TD"==g||"TH"==g)m(f),e.push(f);f=f.nextSibling}else{e=b.anCells;f=0;for(g=e.length;f<g;f++)m(e[f])}if(b=b.firstChild?b:b.nTr)(b=b.getAttribute("id"))&&S(a.rowId)(d,b);return{data:d,cells:e}}
function Ja(a,b,c,d){var e=a.aoData[b],f=e._aData,g=[],j,i,n,l,q;if(null===e.nTr){j=c||H.createElement("tr");e.nTr=j;e.anCells=g;j._DT_RowIndex=b;Na(a,e);l=0;for(q=a.aoColumns.length;l<q;l++){n=a.aoColumns[l];i=c?d[l]:H.createElement(n.sCellType);i._DT_CellIndex={row:b,column:l};g.push(i);if((!c||n.mRender||n.mData!==l)&&(!h.isPlainObject(n.mData)||n.mData._!==l+".display"))i.innerHTML=B(a,b,l,"display");n.sClass&&(i.className+=" "+n.sClass);n.bVisible&&!c?j.appendChild(i):!n.bVisible&&c&&i.parentNode.removeChild(i);
n.fnCreatedCell&&n.fnCreatedCell.call(a.oInstance,i,B(a,b,l),f,b,l)}s(a,"aoRowCreatedCallback",null,[j,f,b])}e.nTr.setAttribute("role","row")}function Na(a,b){var c=b.nTr,d=b._aData;if(c){var e=a.rowIdFn(d);e&&(c.id=e);d.DT_RowClass&&(e=d.DT_RowClass.split(" "),b.__rowc=b.__rowc?sa(b.__rowc.concat(e)):e,h(c).removeClass(b.__rowc.join(" ")).addClass(d.DT_RowClass));d.DT_RowAttr&&h(c).attr(d.DT_RowAttr);d.DT_RowData&&h(c).data(d.DT_RowData)}}function mb(a){var b,c,d,e,f,g=a.nTHead,j=a.nTFoot,i=0===
h("th, td",g).length,n=a.oClasses,l=a.aoColumns;i&&(e=h("<tr/>").appendTo(g));b=0;for(c=l.length;b<c;b++)f=l[b],d=h(f.nTh).addClass(f.sClass),i&&d.appendTo(e),a.oFeatures.bSort&&(d.addClass(f.sSortingClass),!1!==f.bSortable&&(d.attr("tabindex",a.iTabIndex).attr("aria-controls",a.sTableId),Oa(a,f.nTh,b))),f.sTitle!=d[0].innerHTML&&d.html(f.sTitle),Pa(a,"header")(a,d,f,n);i&&ea(a.aoHeader,g);h(g).find(">tr").attr("role","row");h(g).find(">tr>th, >tr>td").addClass(n.sHeaderTH);h(j).find(">tr>th, >tr>td").addClass(n.sFooterTH);
if(null!==j){a=a.aoFooter[0];b=0;for(c=a.length;b<c;b++)f=l[b],f.nTf=a[b].cell,f.sClass&&h(f.nTf).addClass(f.sClass)}}function fa(a,b,c){var d,e,f,g=[],j=[],i=a.aoColumns.length,n;if(b){c===k&&(c=!1);d=0;for(e=b.length;d<e;d++){g[d]=b[d].slice();g[d].nTr=b[d].nTr;for(f=i-1;0<=f;f--)!a.aoColumns[f].bVisible&&!c&&g[d].splice(f,1);j.push([])}d=0;for(e=g.length;d<e;d++){if(a=g[d].nTr)for(;f=a.firstChild;)a.removeChild(f);f=0;for(b=g[d].length;f<b;f++)if(n=i=1,j[d][f]===k){a.appendChild(g[d][f].cell);
for(j[d][f]=1;g[d+i]!==k&&g[d][f].cell==g[d+i][f].cell;)j[d+i][f]=1,i++;for(;g[d][f+n]!==k&&g[d][f].cell==g[d][f+n].cell;){for(c=0;c<i;c++)j[d+c][f+n]=1;n++}h(g[d][f].cell).attr("rowspan",i).attr("colspan",n)}}}}function O(a){var b=s(a,"aoPreDrawCallback","preDraw",[a]);if(-1!==h.inArray(!1,b))C(a,!1);else{var b=[],c=0,d=a.asStripeClasses,e=d.length,f=a.oLanguage,g=a.iInitDisplayStart,j="ssp"==y(a),i=a.aiDisplay;a.bDrawing=!0;g!==k&&-1!==g&&(a._iDisplayStart=j?g:g>=a.fnRecordsDisplay()?0:g,a.iInitDisplayStart=
-1);var g=a._iDisplayStart,n=a.fnDisplayEnd();if(a.bDeferLoading)a.bDeferLoading=!1,a.iDraw++,C(a,!1);else if(j){if(!a.bDestroying&&!nb(a))return}else a.iDraw++;if(0!==i.length){f=j?a.aoData.length:n;for(j=j?0:g;j<f;j++){var l=i[j],q=a.aoData[l];null===q.nTr&&Ja(a,l);l=q.nTr;if(0!==e){var r=d[c%e];q._sRowStripe!=r&&(h(l).removeClass(q._sRowStripe).addClass(r),q._sRowStripe=r)}s(a,"aoRowCallback",null,[l,q._aData,c,j]);b.push(l);c++}}else c=f.sZeroRecords,1==a.iDraw&&"ajax"==y(a)?c=f.sLoadingRecords:
f.sEmptyTable&&0===a.fnRecordsTotal()&&(c=f.sEmptyTable),b[0]=h("<tr/>",{"class":e?d[0]:""}).append(h("<td />",{valign:"top",colSpan:ba(a),"class":a.oClasses.sRowEmpty}).html(c))[0];s(a,"aoHeaderCallback","header",[h(a.nTHead).children("tr")[0],Ma(a),g,n,i]);s(a,"aoFooterCallback","footer",[h(a.nTFoot).children("tr")[0],Ma(a),g,n,i]);d=h(a.nTBody);d.children().detach();d.append(h(b));s(a,"aoDrawCallback","draw",[a]);a.bSorted=!1;a.bFiltered=!1;a.bDrawing=!1}}function T(a,b){var c=a.oFeatures,d=c.bFilter;
c.bSort&&ob(a);d?ga(a,a.oPreviousSearch):a.aiDisplay=a.aiDisplayMaster.slice();!0!==b&&(a._iDisplayStart=0);a._drawHold=b;O(a);a._drawHold=!1}function pb(a){var b=a.oClasses,c=h(a.nTable),c=h("<div/>").insertBefore(c),d=a.oFeatures,e=h("<div/>",{id:a.sTableId+"_wrapper","class":b.sWrapper+(a.nTFoot?"":" "+b.sNoFooter)});a.nHolding=c[0];a.nTableWrapper=e[0];a.nTableReinsertBefore=a.nTable.nextSibling;for(var f=a.sDom.split(""),g,j,i,n,l,q,k=0;k<f.length;k++){g=null;j=f[k];if("<"==j){i=h("<div/>")[0];
n=f[k+1];if("'"==n||'"'==n){l="";for(q=2;f[k+q]!=n;)l+=f[k+q],q++;"H"==l?l=b.sJUIHeader:"F"==l&&(l=b.sJUIFooter);-1!=l.indexOf(".")?(n=l.split("."),i.id=n[0].substr(1,n[0].length-1),i.className=n[1]):"#"==l.charAt(0)?i.id=l.substr(1,l.length-1):i.className=l;k+=q}e.append(i);e=h(i)}else if(">"==j)e=e.parent();else if("l"==j&&d.bPaginate&&d.bLengthChange)g=qb(a);else if("f"==j&&d.bFilter)g=rb(a);else if("r"==j&&d.bProcessing)g=sb(a);else if("t"==j)g=tb(a);else if("i"==j&&d.bInfo)g=ub(a);else if("p"==
j&&d.bPaginate)g=vb(a);else if(0!==m.ext.feature.length){i=m.ext.feature;q=0;for(n=i.length;q<n;q++)if(j==i[q].cFeature){g=i[q].fnInit(a);break}}g&&(i=a.aanFeatures,i[j]||(i[j]=[]),i[j].push(g),e.append(g))}c.replaceWith(e);a.nHolding=null}function ea(a,b){var c=h(b).children("tr"),d,e,f,g,j,i,n,l,q,k;a.splice(0,a.length);f=0;for(i=c.length;f<i;f++)a.push([]);f=0;for(i=c.length;f<i;f++){d=c[f];for(e=d.firstChild;e;){if("TD"==e.nodeName.toUpperCase()||"TH"==e.nodeName.toUpperCase()){l=1*e.getAttribute("colspan");
q=1*e.getAttribute("rowspan");l=!l||0===l||1===l?1:l;q=!q||0===q||1===q?1:q;g=0;for(j=a[f];j[g];)g++;n=g;k=1===l?!0:!1;for(j=0;j<l;j++)for(g=0;g<q;g++)a[f+g][n+j]={cell:e,unique:k},a[f+g].nTr=d}e=e.nextSibling}}}function ta(a,b,c){var d=[];c||(c=a.aoHeader,b&&(c=[],ea(c,b)));for(var b=0,e=c.length;b<e;b++)for(var f=0,g=c[b].length;f<g;f++)if(c[b][f].unique&&(!d[f]||!a.bSortCellsTop))d[f]=c[b][f].cell;return d}function ua(a,b,c){s(a,"aoServerParams","serverParams",[b]);if(b&&h.isArray(b)){var d={},
e=/(.*?)\[\]$/;h.each(b,function(a,b){var c=b.name.match(e);c?(c=c[0],d[c]||(d[c]=[]),d[c].push(b.value)):d[b.name]=b.value});b=d}var f,g=a.ajax,j=a.oInstance,i=function(b){s(a,null,"xhr",[a,b,a.jqXHR]);c(b)};if(h.isPlainObject(g)&&g.data){f=g.data;var n=h.isFunction(f)?f(b,a):f,b=h.isFunction(f)&&n?n:h.extend(!0,b,n);delete g.data}n={data:b,success:function(b){var c=b.error||b.sError;c&&K(a,0,c);a.json=b;i(b)},dataType:"json",cache:!1,type:a.sServerMethod,error:function(b,c){var d=s(a,null,"xhr",
[a,null,a.jqXHR]);-1===h.inArray(!0,d)&&("parsererror"==c?K(a,0,"Invalid JSON response",1):4===b.readyState&&K(a,0,"Ajax error",7));C(a,!1)}};a.oAjaxData=b;s(a,null,"preXhr",[a,b]);a.fnServerData?a.fnServerData.call(j,a.sAjaxSource,h.map(b,function(a,b){return{name:b,value:a}}),i,a):a.sAjaxSource||"string"===typeof g?a.jqXHR=h.ajax(h.extend(n,{url:g||a.sAjaxSource})):h.isFunction(g)?a.jqXHR=g.call(j,b,i,a):(a.jqXHR=h.ajax(h.extend(n,g)),g.data=f)}function nb(a){return a.bAjaxDataGet?(a.iDraw++,C(a,
!0),ua(a,wb(a),function(b){xb(a,b)}),!1):!0}function wb(a){var b=a.aoColumns,c=b.length,d=a.oFeatures,e=a.oPreviousSearch,f=a.aoPreSearchCols,g,j=[],i,n,l,k=W(a);g=a._iDisplayStart;i=!1!==d.bPaginate?a._iDisplayLength:-1;var r=function(a,b){j.push({name:a,value:b})};r("sEcho",a.iDraw);r("iColumns",c);r("sColumns",D(b,"sName").join(","));r("iDisplayStart",g);r("iDisplayLength",i);var ra={draw:a.iDraw,columns:[],order:[],start:g,length:i,search:{value:e.sSearch,regex:e.bRegex}};for(g=0;g<c;g++)n=b[g],
l=f[g],i="function"==typeof n.mData?"function":n.mData,ra.columns.push({data:i,name:n.sName,searchable:n.bSearchable,orderable:n.bSortable,search:{value:l.sSearch,regex:l.bRegex}}),r("mDataProp_"+g,i),d.bFilter&&(r("sSearch_"+g,l.sSearch),r("bRegex_"+g,l.bRegex),r("bSearchable_"+g,n.bSearchable)),d.bSort&&r("bSortable_"+g,n.bSortable);d.bFilter&&(r("sSearch",e.sSearch),r("bRegex",e.bRegex));d.bSort&&(h.each(k,function(a,b){ra.order.push({column:b.col,dir:b.dir});r("iSortCol_"+a,b.col);r("sSortDir_"+
a,b.dir)}),r("iSortingCols",k.length));b=m.ext.legacy.ajax;return null===b?a.sAjaxSource?j:ra:b?j:ra}function xb(a,b){var c=va(a,b),d=b.sEcho!==k?b.sEcho:b.draw,e=b.iTotalRecords!==k?b.iTotalRecords:b.recordsTotal,f=b.iTotalDisplayRecords!==k?b.iTotalDisplayRecords:b.recordsFiltered;if(d){if(1*d<a.iDraw)return;a.iDraw=1*d}pa(a);a._iRecordsTotal=parseInt(e,10);a._iRecordsDisplay=parseInt(f,10);d=0;for(e=c.length;d<e;d++)N(a,c[d]);a.aiDisplay=a.aiDisplayMaster.slice();a.bAjaxDataGet=!1;O(a);a._bInitComplete||
wa(a,b);a.bAjaxDataGet=!0;C(a,!1)}function va(a,b){var c=h.isPlainObject(a.ajax)&&a.ajax.dataSrc!==k?a.ajax.dataSrc:a.sAjaxDataProp;return"data"===c?b.aaData||b[c]:""!==c?R(c)(b):b}function rb(a){var b=a.oClasses,c=a.sTableId,d=a.oLanguage,e=a.oPreviousSearch,f=a.aanFeatures,g='<input type="search" class="'+b.sFilterInput+'"/>',j=d.sSearch,j=j.match(/_INPUT_/)?j.replace("_INPUT_",g):j+g,b=h("<div/>",{id:!f.f?c+"_filter":null,"class":b.sFilter}).append(h("<label/>").append(j)),f=function(){var b=!this.value?
"":this.value;b!=e.sSearch&&(ga(a,{sSearch:b,bRegex:e.bRegex,bSmart:e.bSmart,bCaseInsensitive:e.bCaseInsensitive}),a._iDisplayStart=0,O(a))},g=null!==a.searchDelay?a.searchDelay:"ssp"===y(a)?400:0,i=h("input",b).val(e.sSearch).attr("placeholder",d.sSearchPlaceholder).on("keyup.DT search.DT input.DT paste.DT cut.DT",g?Qa(f,g):f).on("keypress.DT",function(a){if(13==a.keyCode)return!1}).attr("aria-controls",c);h(a.nTable).on("search.dt.DT",function(b,c){if(a===c)try{i[0]!==H.activeElement&&i.val(e.sSearch)}catch(d){}});
return b[0]}function ga(a,b,c){var d=a.oPreviousSearch,e=a.aoPreSearchCols,f=function(a){d.sSearch=a.sSearch;d.bRegex=a.bRegex;d.bSmart=a.bSmart;d.bCaseInsensitive=a.bCaseInsensitive};Ia(a);if("ssp"!=y(a)){yb(a,b.sSearch,c,b.bEscapeRegex!==k?!b.bEscapeRegex:b.bRegex,b.bSmart,b.bCaseInsensitive);f(b);for(b=0;b<e.length;b++)zb(a,e[b].sSearch,b,e[b].bEscapeRegex!==k?!e[b].bEscapeRegex:e[b].bRegex,e[b].bSmart,e[b].bCaseInsensitive);Ab(a)}else f(b);a.bFiltered=!0;s(a,null,"search",[a])}function Ab(a){for(var b=
m.ext.search,c=a.aiDisplay,d,e,f=0,g=b.length;f<g;f++){for(var j=[],i=0,n=c.length;i<n;i++)e=c[i],d=a.aoData[e],b[f](a,d._aFilterData,e,d._aData,i)&&j.push(e);c.length=0;h.merge(c,j)}}function zb(a,b,c,d,e,f){if(""!==b){for(var g=[],j=a.aiDisplay,d=Ra(b,d,e,f),e=0;e<j.length;e++)b=a.aoData[j[e]]._aFilterData[c],d.test(b)&&g.push(j[e]);a.aiDisplay=g}}function yb(a,b,c,d,e,f){var d=Ra(b,d,e,f),f=a.oPreviousSearch.sSearch,g=a.aiDisplayMaster,j,e=[];0!==m.ext.search.length&&(c=!0);j=Bb(a);if(0>=b.length)a.aiDisplay=
g.slice();else{if(j||c||f.length>b.length||0!==b.indexOf(f)||a.bSorted)a.aiDisplay=g.slice();b=a.aiDisplay;for(c=0;c<b.length;c++)d.test(a.aoData[b[c]]._sFilterRow)&&e.push(b[c]);a.aiDisplay=e}}function Ra(a,b,c,d){a=b?a:Sa(a);c&&(a="^(?=.*?"+h.map(a.match(/"[^"]+"|[^ ]+/g)||[""],function(a){if('"'===a.charAt(0))var b=a.match(/^"(.*)"$/),a=b?b[1]:a;return a.replace('"',"")}).join(")(?=.*?")+").*$");return RegExp(a,d?"i":"")}function Bb(a){var b=a.aoColumns,c,d,e,f,g,j,i,h,l=m.ext.type.search;c=!1;
d=0;for(f=a.aoData.length;d<f;d++)if(h=a.aoData[d],!h._aFilterData){j=[];e=0;for(g=b.length;e<g;e++)c=b[e],c.bSearchable?(i=B(a,d,e,"filter"),l[c.sType]&&(i=l[c.sType](i)),null===i&&(i=""),"string"!==typeof i&&i.toString&&(i=i.toString())):i="",i.indexOf&&-1!==i.indexOf("&")&&(xa.innerHTML=i,i=$b?xa.textContent:xa.innerText),i.replace&&(i=i.replace(/[\r\n]/g,"")),j.push(i);h._aFilterData=j;h._sFilterRow=j.join("  ");c=!0}return c}function Cb(a){return{search:a.sSearch,smart:a.bSmart,regex:a.bRegex,
caseInsensitive:a.bCaseInsensitive}}function Db(a){return{sSearch:a.search,bSmart:a.smart,bRegex:a.regex,bCaseInsensitive:a.caseInsensitive}}function ub(a){var b=a.sTableId,c=a.aanFeatures.i,d=h("<div/>",{"class":a.oClasses.sInfo,id:!c?b+"_info":null});c||(a.aoDrawCallback.push({fn:Eb,sName:"information"}),d.attr("role","status").attr("aria-live","polite"),h(a.nTable).attr("aria-describedby",b+"_info"));return d[0]}function Eb(a){var b=a.aanFeatures.i;if(0!==b.length){var c=a.oLanguage,d=a._iDisplayStart+
1,e=a.fnDisplayEnd(),f=a.fnRecordsTotal(),g=a.fnRecordsDisplay(),j=g?c.sInfo:c.sInfoEmpty;g!==f&&(j+=" "+c.sInfoFiltered);j+=c.sInfoPostFix;j=Fb(a,j);c=c.fnInfoCallback;null!==c&&(j=c.call(a.oInstance,a,d,e,f,g,j));h(b).html(j)}}function Fb(a,b){var c=a.fnFormatNumber,d=a._iDisplayStart+1,e=a._iDisplayLength,f=a.fnRecordsDisplay(),g=-1===e;return b.replace(/_START_/g,c.call(a,d)).replace(/_END_/g,c.call(a,a.fnDisplayEnd())).replace(/_MAX_/g,c.call(a,a.fnRecordsTotal())).replace(/_TOTAL_/g,c.call(a,
f)).replace(/_PAGE_/g,c.call(a,g?1:Math.ceil(d/e))).replace(/_PAGES_/g,c.call(a,g?1:Math.ceil(f/e)))}function ha(a){var b,c,d=a.iInitDisplayStart,e=a.aoColumns,f;c=a.oFeatures;var g=a.bDeferLoading;if(a.bInitialised){pb(a);mb(a);fa(a,a.aoHeader);fa(a,a.aoFooter);C(a,!0);c.bAutoWidth&&Ha(a);b=0;for(c=e.length;b<c;b++)f=e[b],f.sWidth&&(f.nTh.style.width=v(f.sWidth));s(a,null,"preInit",[a]);T(a);e=y(a);if("ssp"!=e||g)"ajax"==e?ua(a,[],function(c){var f=va(a,c);for(b=0;b<f.length;b++)N(a,f[b]);a.iInitDisplayStart=
d;T(a);C(a,!1);wa(a,c)},a):(C(a,!1),wa(a))}else setTimeout(function(){ha(a)},200)}function wa(a,b){a._bInitComplete=!0;(b||a.oInit.aaData)&&Z(a);s(a,null,"plugin-init",[a,b]);s(a,"aoInitComplete","init",[a,b])}function Ta(a,b){var c=parseInt(b,10);a._iDisplayLength=c;Ua(a);s(a,null,"length",[a,c])}function qb(a){for(var b=a.oClasses,c=a.sTableId,d=a.aLengthMenu,e=h.isArray(d[0]),f=e?d[0]:d,d=e?d[1]:d,e=h("<select/>",{name:c+"_length","aria-controls":c,"class":b.sLengthSelect}),g=0,j=f.length;g<j;g++)e[0][g]=
new Option(d[g],f[g]);var i=h("<div><label/></div>").addClass(b.sLength);a.aanFeatures.l||(i[0].id=c+"_length");i.children().append(a.oLanguage.sLengthMenu.replace("_MENU_",e[0].outerHTML));h("select",i).val(a._iDisplayLength).on("change.DT",function(){Ta(a,h(this).val());O(a)});h(a.nTable).on("length.dt.DT",function(b,c,d){a===c&&h("select",i).val(d)});return i[0]}function vb(a){var b=a.sPaginationType,c=m.ext.pager[b],d="function"===typeof c,e=function(a){O(a)},b=h("<div/>").addClass(a.oClasses.sPaging+
b)[0],f=a.aanFeatures;d||c.fnInit(a,b,e);f.p||(b.id=a.sTableId+"_paginate",a.aoDrawCallback.push({fn:function(a){if(d){var b=a._iDisplayStart,i=a._iDisplayLength,h=a.fnRecordsDisplay(),l=-1===i,b=l?0:Math.ceil(b/i),i=l?1:Math.ceil(h/i),h=c(b,i),k,l=0;for(k=f.p.length;l<k;l++)Pa(a,"pageButton")(a,f.p[l],l,h,b,i)}else c.fnUpdate(a,e)},sName:"pagination"}));return b}function Va(a,b,c){var d=a._iDisplayStart,e=a._iDisplayLength,f=a.fnRecordsDisplay();0===f||-1===e?d=0:"number"===typeof b?(d=b*e,d>f&&
(d=0)):"first"==b?d=0:"previous"==b?(d=0<=e?d-e:0,0>d&&(d=0)):"next"==b?d+e<f&&(d+=e):"last"==b?d=Math.floor((f-1)/e)*e:K(a,0,"Unknown paging action: "+b,5);b=a._iDisplayStart!==d;a._iDisplayStart=d;b&&(s(a,null,"page",[a]),c&&O(a));return b}function sb(a){return h("<div/>",{id:!a.aanFeatures.r?a.sTableId+"_processing":null,"class":a.oClasses.sProcessing}).html(a.oLanguage.sProcessing).insertBefore(a.nTable)[0]}function C(a,b){a.oFeatures.bProcessing&&h(a.aanFeatures.r).css("display",b?"block":"none");
s(a,null,"processing",[a,b])}function tb(a){var b=h(a.nTable);b.attr("role","grid");var c=a.oScroll;if(""===c.sX&&""===c.sY)return a.nTable;var d=c.sX,e=c.sY,f=a.oClasses,g=b.children("caption"),j=g.length?g[0]._captionSide:null,i=h(b[0].cloneNode(!1)),n=h(b[0].cloneNode(!1)),l=b.children("tfoot");l.length||(l=null);i=h("<div/>",{"class":f.sScrollWrapper}).append(h("<div/>",{"class":f.sScrollHead}).css({overflow:"hidden",position:"relative",border:0,width:d?!d?null:v(d):"100%"}).append(h("<div/>",
{"class":f.sScrollHeadInner}).css({"box-sizing":"content-box",width:c.sXInner||"100%"}).append(i.removeAttr("id").css("margin-left",0).append("top"===j?g:null).append(b.children("thead"))))).append(h("<div/>",{"class":f.sScrollBody}).css({position:"relative",overflow:"auto",width:!d?null:v(d)}).append(b));l&&i.append(h("<div/>",{"class":f.sScrollFoot}).css({overflow:"hidden",border:0,width:d?!d?null:v(d):"100%"}).append(h("<div/>",{"class":f.sScrollFootInner}).append(n.removeAttr("id").css("margin-left",
0).append("bottom"===j?g:null).append(b.children("tfoot")))));var b=i.children(),k=b[0],f=b[1],r=l?b[2]:null;if(d)h(f).on("scroll.DT",function(){var a=this.scrollLeft;k.scrollLeft=a;l&&(r.scrollLeft=a)});h(f).css(e&&c.bCollapse?"max-height":"height",e);a.nScrollHead=k;a.nScrollBody=f;a.nScrollFoot=r;a.aoDrawCallback.push({fn:ma,sName:"scrolling"});return i[0]}function ma(a){var b=a.oScroll,c=b.sX,d=b.sXInner,e=b.sY,b=b.iBarWidth,f=h(a.nScrollHead),g=f[0].style,j=f.children("div"),i=j[0].style,n=j.children("table"),
j=a.nScrollBody,l=h(j),q=j.style,r=h(a.nScrollFoot).children("div"),m=r.children("table"),p=h(a.nTHead),o=h(a.nTable),u=o[0],s=u.style,t=a.nTFoot?h(a.nTFoot):null,x=a.oBrowser,U=x.bScrollOversize,ac=D(a.aoColumns,"nTh"),P,L,Q,w,Wa=[],y=[],z=[],A=[],B,C=function(a){a=a.style;a.paddingTop="0";a.paddingBottom="0";a.borderTopWidth="0";a.borderBottomWidth="0";a.height=0};L=j.scrollHeight>j.clientHeight;if(a.scrollBarVis!==L&&a.scrollBarVis!==k)a.scrollBarVis=L,Z(a);else{a.scrollBarVis=L;o.children("thead, tfoot").remove();
t&&(Q=t.clone().prependTo(o),P=t.find("tr"),Q=Q.find("tr"));w=p.clone().prependTo(o);p=p.find("tr");L=w.find("tr");w.find("th, td").removeAttr("tabindex");c||(q.width="100%",f[0].style.width="100%");h.each(ta(a,w),function(b,c){B=$(a,b);c.style.width=a.aoColumns[B].sWidth});t&&I(function(a){a.style.width=""},Q);f=o.outerWidth();if(""===c){s.width="100%";if(U&&(o.find("tbody").height()>j.offsetHeight||"scroll"==l.css("overflow-y")))s.width=v(o.outerWidth()-b);f=o.outerWidth()}else""!==d&&(s.width=
v(d),f=o.outerWidth());I(C,L);I(function(a){z.push(a.innerHTML);Wa.push(v(h(a).css("width")))},L);I(function(a,b){if(h.inArray(a,ac)!==-1)a.style.width=Wa[b]},p);h(L).height(0);t&&(I(C,Q),I(function(a){A.push(a.innerHTML);y.push(v(h(a).css("width")))},Q),I(function(a,b){a.style.width=y[b]},P),h(Q).height(0));I(function(a,b){a.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+z[b]+"</div>";a.style.width=Wa[b]},L);t&&I(function(a,b){a.innerHTML='<div class="dataTables_sizing" style="height:0;overflow:hidden;">'+
A[b]+"</div>";a.style.width=y[b]},Q);if(o.outerWidth()<f){P=j.scrollHeight>j.offsetHeight||"scroll"==l.css("overflow-y")?f+b:f;if(U&&(j.scrollHeight>j.offsetHeight||"scroll"==l.css("overflow-y")))s.width=v(P-b);(""===c||""!==d)&&K(a,1,"Possible column misalignment",6)}else P="100%";q.width=v(P);g.width=v(P);t&&(a.nScrollFoot.style.width=v(P));!e&&U&&(q.height=v(u.offsetHeight+b));c=o.outerWidth();n[0].style.width=v(c);i.width=v(c);d=o.height()>j.clientHeight||"scroll"==l.css("overflow-y");e="padding"+
(x.bScrollbarLeft?"Left":"Right");i[e]=d?b+"px":"0px";t&&(m[0].style.width=v(c),r[0].style.width=v(c),r[0].style[e]=d?b+"px":"0px");o.children("colgroup").insertBefore(o.children("thead"));l.scroll();if((a.bSorted||a.bFiltered)&&!a._drawHold)j.scrollTop=0}}function I(a,b,c){for(var d=0,e=0,f=b.length,g,j;e<f;){g=b[e].firstChild;for(j=c?c[e].firstChild:null;g;)1===g.nodeType&&(c?a(g,j,d):a(g,d),d++),g=g.nextSibling,j=c?j.nextSibling:null;e++}}function Ha(a){var b=a.nTable,c=a.aoColumns,d=a.oScroll,
e=d.sY,f=d.sX,g=d.sXInner,j=c.length,i=na(a,"bVisible"),n=h("th",a.nTHead),l=b.getAttribute("width"),k=b.parentNode,r=!1,m,p,o=a.oBrowser,d=o.bScrollOversize;(m=b.style.width)&&-1!==m.indexOf("%")&&(l=m);for(m=0;m<i.length;m++)p=c[i[m]],null!==p.sWidth&&(p.sWidth=Gb(p.sWidthOrig,k),r=!0);if(d||!r&&!f&&!e&&j==ba(a)&&j==n.length)for(m=0;m<j;m++)i=$(a,m),null!==i&&(c[i].sWidth=v(n.eq(m).width()));else{j=h(b).clone().css("visibility","hidden").removeAttr("id");j.find("tbody tr").remove();var u=h("<tr/>").appendTo(j.find("tbody"));
j.find("thead, tfoot").remove();j.append(h(a.nTHead).clone()).append(h(a.nTFoot).clone());j.find("tfoot th, tfoot td").css("width","");n=ta(a,j.find("thead")[0]);for(m=0;m<i.length;m++)p=c[i[m]],n[m].style.width=null!==p.sWidthOrig&&""!==p.sWidthOrig?v(p.sWidthOrig):"",p.sWidthOrig&&f&&h(n[m]).append(h("<div/>").css({width:p.sWidthOrig,margin:0,padding:0,border:0,height:1}));if(a.aoData.length)for(m=0;m<i.length;m++)r=i[m],p=c[r],h(Hb(a,r)).clone(!1).append(p.sContentPadding).appendTo(u);h("[name]",
j).removeAttr("name");p=h("<div/>").css(f||e?{position:"absolute",top:0,left:0,height:1,right:0,overflow:"hidden"}:{}).append(j).appendTo(k);f&&g?j.width(g):f?(j.css("width","auto"),j.removeAttr("width"),j.width()<k.clientWidth&&l&&j.width(k.clientWidth)):e?j.width(k.clientWidth):l&&j.width(l);for(m=e=0;m<i.length;m++)k=h(n[m]),g=k.outerWidth()-k.width(),k=o.bBounding?Math.ceil(n[m].getBoundingClientRect().width):k.outerWidth(),e+=k,c[i[m]].sWidth=v(k-g);b.style.width=v(e);p.remove()}l&&(b.style.width=
v(l));if((l||f)&&!a._reszEvt)b=function(){h(E).on("resize.DT-"+a.sInstance,Qa(function(){Z(a)}))},d?setTimeout(b,1E3):b(),a._reszEvt=!0}function Gb(a,b){if(!a)return 0;var c=h("<div/>").css("width",v(a)).appendTo(b||H.body),d=c[0].offsetWidth;c.remove();return d}function Hb(a,b){var c=Ib(a,b);if(0>c)return null;var d=a.aoData[c];return!d.nTr?h("<td/>").html(B(a,c,b,"display"))[0]:d.anCells[b]}function Ib(a,b){for(var c,d=-1,e=-1,f=0,g=a.aoData.length;f<g;f++)c=B(a,f,b,"display")+"",c=c.replace(bc,
""),c=c.replace(/&nbsp;/g," "),c.length>d&&(d=c.length,e=f);return e}function v(a){return null===a?"0px":"number"==typeof a?0>a?"0px":a+"px":a.match(/\d$/)?a+"px":a}function W(a){var b,c,d=[],e=a.aoColumns,f,g,j,i;b=a.aaSortingFixed;c=h.isPlainObject(b);var n=[];f=function(a){a.length&&!h.isArray(a[0])?n.push(a):h.merge(n,a)};h.isArray(b)&&f(b);c&&b.pre&&f(b.pre);f(a.aaSorting);c&&b.post&&f(b.post);for(a=0;a<n.length;a++){i=n[a][0];f=e[i].aDataSort;b=0;for(c=f.length;b<c;b++)g=f[b],j=e[g].sType||
"string",n[a]._idx===k&&(n[a]._idx=h.inArray(n[a][1],e[g].asSorting)),d.push({src:i,col:g,dir:n[a][1],index:n[a]._idx,type:j,formatter:m.ext.type.order[j+"-pre"]})}return d}function ob(a){var b,c,d=[],e=m.ext.type.order,f=a.aoData,g=0,j,i=a.aiDisplayMaster,h;Ia(a);h=W(a);b=0;for(c=h.length;b<c;b++)j=h[b],j.formatter&&g++,Jb(a,j.col);if("ssp"!=y(a)&&0!==h.length){b=0;for(c=i.length;b<c;b++)d[i[b]]=b;g===h.length?i.sort(function(a,b){var c,e,g,j,i=h.length,k=f[a]._aSortData,m=f[b]._aSortData;for(g=
0;g<i;g++)if(j=h[g],c=k[j.col],e=m[j.col],c=c<e?-1:c>e?1:0,0!==c)return"asc"===j.dir?c:-c;c=d[a];e=d[b];return c<e?-1:c>e?1:0}):i.sort(function(a,b){var c,g,j,i,k=h.length,m=f[a]._aSortData,p=f[b]._aSortData;for(j=0;j<k;j++)if(i=h[j],c=m[i.col],g=p[i.col],i=e[i.type+"-"+i.dir]||e["string-"+i.dir],c=i(c,g),0!==c)return c;c=d[a];g=d[b];return c<g?-1:c>g?1:0})}a.bSorted=!0}function Kb(a){for(var b,c,d=a.aoColumns,e=W(a),a=a.oLanguage.oAria,f=0,g=d.length;f<g;f++){c=d[f];var j=c.asSorting;b=c.sTitle.replace(/<.*?>/g,
"");var i=c.nTh;i.removeAttribute("aria-sort");c.bSortable&&(0<e.length&&e[0].col==f?(i.setAttribute("aria-sort","asc"==e[0].dir?"ascending":"descending"),c=j[e[0].index+1]||j[0]):c=j[0],b+="asc"===c?a.sSortAscending:a.sSortDescending);i.setAttribute("aria-label",b)}}function Xa(a,b,c,d){var e=a.aaSorting,f=a.aoColumns[b].asSorting,g=function(a,b){var c=a._idx;c===k&&(c=h.inArray(a[1],f));return c+1<f.length?c+1:b?null:0};"number"===typeof e[0]&&(e=a.aaSorting=[e]);c&&a.oFeatures.bSortMulti?(c=h.inArray(b,
D(e,"0")),-1!==c?(b=g(e[c],!0),null===b&&1===e.length&&(b=0),null===b?e.splice(c,1):(e[c][1]=f[b],e[c]._idx=b)):(e.push([b,f[0],0]),e[e.length-1]._idx=0)):e.length&&e[0][0]==b?(b=g(e[0]),e.length=1,e[0][1]=f[b],e[0]._idx=b):(e.length=0,e.push([b,f[0]]),e[0]._idx=0);T(a);"function"==typeof d&&d(a)}function Oa(a,b,c,d){var e=a.aoColumns[c];Ya(b,{},function(b){!1!==e.bSortable&&(a.oFeatures.bProcessing?(C(a,!0),setTimeout(function(){Xa(a,c,b.shiftKey,d);"ssp"!==y(a)&&C(a,!1)},0)):Xa(a,c,b.shiftKey,d))})}
function ya(a){var b=a.aLastSort,c=a.oClasses.sSortColumn,d=W(a),e=a.oFeatures,f,g;if(e.bSort&&e.bSortClasses){e=0;for(f=b.length;e<f;e++)g=b[e].src,h(D(a.aoData,"anCells",g)).removeClass(c+(2>e?e+1:3));e=0;for(f=d.length;e<f;e++)g=d[e].src,h(D(a.aoData,"anCells",g)).addClass(c+(2>e?e+1:3))}a.aLastSort=d}function Jb(a,b){var c=a.aoColumns[b],d=m.ext.order[c.sSortDataType],e;d&&(e=d.call(a.oInstance,a,b,aa(a,b)));for(var f,g=m.ext.type.order[c.sType+"-pre"],j=0,i=a.aoData.length;j<i;j++)if(c=a.aoData[j],
c._aSortData||(c._aSortData=[]),!c._aSortData[b]||d)f=d?e[j]:B(a,j,b,"sort"),c._aSortData[b]=g?g(f):f}function za(a){if(a.oFeatures.bStateSave&&!a.bDestroying){var b={time:+new Date,start:a._iDisplayStart,length:a._iDisplayLength,order:h.extend(!0,[],a.aaSorting),search:Cb(a.oPreviousSearch),columns:h.map(a.aoColumns,function(b,d){return{visible:b.bVisible,search:Cb(a.aoPreSearchCols[d])}})};s(a,"aoStateSaveParams","stateSaveParams",[a,b]);a.oSavedState=b;a.fnStateSaveCallback.call(a.oInstance,a,
b)}}function Lb(a,b,c){var d,e,f=a.aoColumns,b=function(b){if(b&&b.time){var i=s(a,"aoStateLoadParams","stateLoadParams",[a,g]);if(-1===h.inArray(!1,i)&&(i=a.iStateDuration,!(0<i&&b.time<+new Date-1E3*i)&&!(b.columns&&f.length!==b.columns.length))){a.oLoadedState=h.extend(!0,{},g);b.start!==k&&(a._iDisplayStart=b.start,a.iInitDisplayStart=b.start);b.length!==k&&(a._iDisplayLength=b.length);b.order!==k&&(a.aaSorting=[],h.each(b.order,function(b,c){a.aaSorting.push(c[0]>=f.length?[0,c[1]]:c)}));b.search!==
k&&h.extend(a.oPreviousSearch,Db(b.search));if(b.columns){d=0;for(e=b.columns.length;d<e;d++)i=b.columns[d],i.visible!==k&&(f[d].bVisible=i.visible),i.search!==k&&h.extend(a.aoPreSearchCols[d],Db(i.search))}s(a,"aoStateLoaded","stateLoaded",[a,g])}}c()};if(a.oFeatures.bStateSave){var g=a.fnStateLoadCallback.call(a.oInstance,a,b);g!==k&&b(g)}else c()}function Aa(a){var b=m.settings,a=h.inArray(a,D(b,"nTable"));return-1!==a?b[a]:null}function K(a,b,c,d){c="DataTables warning: "+(a?"table id="+a.sTableId+
" - ":"")+c;d&&(c+=". For more information about this error, please see http://datatables.net/tn/"+d);if(b)E.console&&console.log&&console.log(c);else if(b=m.ext,b=b.sErrMode||b.errMode,a&&s(a,null,"error",[a,d,c]),"alert"==b)alert(c);else{if("throw"==b)throw Error(c);"function"==typeof b&&b(a,d,c)}}function F(a,b,c,d){h.isArray(c)?h.each(c,function(c,d){h.isArray(d)?F(a,b,d[0],d[1]):F(a,b,d)}):(d===k&&(d=c),b[c]!==k&&(a[d]=b[c]))}function Mb(a,b,c){var d,e;for(e in b)b.hasOwnProperty(e)&&(d=b[e],
h.isPlainObject(d)?(h.isPlainObject(a[e])||(a[e]={}),h.extend(!0,a[e],d)):a[e]=c&&"data"!==e&&"aaData"!==e&&h.isArray(d)?d.slice():d);return a}function Ya(a,b,c){h(a).on("click.DT",b,function(b){a.blur();c(b)}).on("keypress.DT",b,function(a){13===a.which&&(a.preventDefault(),c(a))}).on("selectstart.DT",function(){return!1})}function z(a,b,c,d){c&&a[b].push({fn:c,sName:d})}function s(a,b,c,d){var e=[];b&&(e=h.map(a[b].slice().reverse(),function(b){return b.fn.apply(a.oInstance,d)}));null!==c&&(b=h.Event(c+
".dt"),h(a.nTable).trigger(b,d),e.push(b.result));return e}function Ua(a){var b=a._iDisplayStart,c=a.fnDisplayEnd(),d=a._iDisplayLength;b>=c&&(b=c-d);b-=b%d;if(-1===d||0>b)b=0;a._iDisplayStart=b}function Pa(a,b){var c=a.renderer,d=m.ext.renderer[b];return h.isPlainObject(c)&&c[b]?d[c[b]]||d._:"string"===typeof c?d[c]||d._:d._}function y(a){return a.oFeatures.bServerSide?"ssp":a.ajax||a.sAjaxSource?"ajax":"dom"}function ia(a,b){var c=[],c=Nb.numbers_length,d=Math.floor(c/2);b<=c?c=X(0,b):a<=d?(c=X(0,
c-2),c.push("ellipsis"),c.push(b-1)):(a>=b-1-d?c=X(b-(c-2),b):(c=X(a-d+2,a+d-1),c.push("ellipsis"),c.push(b-1)),c.splice(0,0,"ellipsis"),c.splice(0,0,0));c.DT_el="span";return c}function fb(a){h.each({num:function(b){return Ba(b,a)},"num-fmt":function(b){return Ba(b,a,Za)},"html-num":function(b){return Ba(b,a,Ca)},"html-num-fmt":function(b){return Ba(b,a,Ca,Za)}},function(b,c){x.type.order[b+a+"-pre"]=c;b.match(/^html\-/)&&(x.type.search[b+a]=x.type.search.html)})}function Ob(a){return function(){var b=
[Aa(this[m.ext.iApiIndex])].concat(Array.prototype.slice.call(arguments));return m.ext.internal[a].apply(this,b)}}var m=function(a){this.$=function(a,b){return this.api(!0).$(a,b)};this._=function(a,b){return this.api(!0).rows(a,b).data()};this.api=function(a){return a?new u(Aa(this[x.iApiIndex])):new u(this)};this.fnAddData=function(a,b){var c=this.api(!0),d=h.isArray(a)&&(h.isArray(a[0])||h.isPlainObject(a[0]))?c.rows.add(a):c.row.add(a);(b===k||b)&&c.draw();return d.flatten().toArray()};this.fnAdjustColumnSizing=
function(a){var b=this.api(!0).columns.adjust(),c=b.settings()[0],d=c.oScroll;a===k||a?b.draw(!1):(""!==d.sX||""!==d.sY)&&ma(c)};this.fnClearTable=function(a){var b=this.api(!0).clear();(a===k||a)&&b.draw()};this.fnClose=function(a){this.api(!0).row(a).child.hide()};this.fnDeleteRow=function(a,b,c){var d=this.api(!0),a=d.rows(a),e=a.settings()[0],h=e.aoData[a[0][0]];a.remove();b&&b.call(this,e,h);(c===k||c)&&d.draw();return h};this.fnDestroy=function(a){this.api(!0).destroy(a)};this.fnDraw=function(a){this.api(!0).draw(a)};
this.fnFilter=function(a,b,c,d,e,h){e=this.api(!0);null===b||b===k?e.search(a,c,d,h):e.column(b).search(a,c,d,h);e.draw()};this.fnGetData=function(a,b){var c=this.api(!0);if(a!==k){var d=a.nodeName?a.nodeName.toLowerCase():"";return b!==k||"td"==d||"th"==d?c.cell(a,b).data():c.row(a).data()||null}return c.data().toArray()};this.fnGetNodes=function(a){var b=this.api(!0);return a!==k?b.row(a).node():b.rows().nodes().flatten().toArray()};this.fnGetPosition=function(a){var b=this.api(!0),c=a.nodeName.toUpperCase();
return"TR"==c?b.row(a).index():"TD"==c||"TH"==c?(a=b.cell(a).index(),[a.row,a.columnVisible,a.column]):null};this.fnIsOpen=function(a){return this.api(!0).row(a).child.isShown()};this.fnOpen=function(a,b,c){return this.api(!0).row(a).child(b,c).show().child()[0]};this.fnPageChange=function(a,b){var c=this.api(!0).page(a);(b===k||b)&&c.draw(!1)};this.fnSetColumnVis=function(a,b,c){a=this.api(!0).column(a).visible(b);(c===k||c)&&a.columns.adjust().draw()};this.fnSettings=function(){return Aa(this[x.iApiIndex])};
this.fnSort=function(a){this.api(!0).order(a).draw()};this.fnSortListener=function(a,b,c){this.api(!0).order.listener(a,b,c)};this.fnUpdate=function(a,b,c,d,e){var h=this.api(!0);c===k||null===c?h.row(b).data(a):h.cell(b,c).data(a);(e===k||e)&&h.columns.adjust();(d===k||d)&&h.draw();return 0};this.fnVersionCheck=x.fnVersionCheck;var b=this,c=a===k,d=this.length;c&&(a={});this.oApi=this.internal=x.internal;for(var e in m.ext.internal)e&&(this[e]=Ob(e));this.each(function(){var e={},g=1<d?Mb(e,a,!0):
a,j=0,i,e=this.getAttribute("id"),n=!1,l=m.defaults,q=h(this);if("table"!=this.nodeName.toLowerCase())K(null,0,"Non-table node initialisation ("+this.nodeName+")",2);else{gb(l);hb(l.column);J(l,l,!0);J(l.column,l.column,!0);J(l,h.extend(g,q.data()));var r=m.settings,j=0;for(i=r.length;j<i;j++){var p=r[j];if(p.nTable==this||p.nTHead.parentNode==this||p.nTFoot&&p.nTFoot.parentNode==this){var u=g.bRetrieve!==k?g.bRetrieve:l.bRetrieve;if(c||u)return p.oInstance;if(g.bDestroy!==k?g.bDestroy:l.bDestroy){p.oInstance.fnDestroy();
break}else{K(p,0,"Cannot reinitialise DataTable",3);return}}if(p.sTableId==this.id){r.splice(j,1);break}}if(null===e||""===e)this.id=e="DataTables_Table_"+m.ext._unique++;var o=h.extend(!0,{},m.models.oSettings,{sDestroyWidth:q[0].style.width,sInstance:e,sTableId:e});o.nTable=this;o.oApi=b.internal;o.oInit=g;r.push(o);o.oInstance=1===b.length?b:q.dataTable();gb(g);g.oLanguage&&Fa(g.oLanguage);g.aLengthMenu&&!g.iDisplayLength&&(g.iDisplayLength=h.isArray(g.aLengthMenu[0])?g.aLengthMenu[0][0]:g.aLengthMenu[0]);
g=Mb(h.extend(!0,{},l),g);F(o.oFeatures,g,"bPaginate bLengthChange bFilter bSort bSortMulti bInfo bProcessing bAutoWidth bSortClasses bServerSide bDeferRender".split(" "));F(o,g,["asStripeClasses","ajax","fnServerData","fnFormatNumber","sServerMethod","aaSorting","aaSortingFixed","aLengthMenu","sPaginationType","sAjaxSource","sAjaxDataProp","iStateDuration","sDom","bSortCellsTop","iTabIndex","fnStateLoadCallback","fnStateSaveCallback","renderer","searchDelay","rowId",["iCookieDuration","iStateDuration"],
["oSearch","oPreviousSearch"],["aoSearchCols","aoPreSearchCols"],["iDisplayLength","_iDisplayLength"],["bJQueryUI","bJUI"]]);F(o.oScroll,g,[["sScrollX","sX"],["sScrollXInner","sXInner"],["sScrollY","sY"],["bScrollCollapse","bCollapse"]]);F(o.oLanguage,g,"fnInfoCallback");z(o,"aoDrawCallback",g.fnDrawCallback,"user");z(o,"aoServerParams",g.fnServerParams,"user");z(o,"aoStateSaveParams",g.fnStateSaveParams,"user");z(o,"aoStateLoadParams",g.fnStateLoadParams,"user");z(o,"aoStateLoaded",g.fnStateLoaded,
"user");z(o,"aoRowCallback",g.fnRowCallback,"user");z(o,"aoRowCreatedCallback",g.fnCreatedRow,"user");z(o,"aoHeaderCallback",g.fnHeaderCallback,"user");z(o,"aoFooterCallback",g.fnFooterCallback,"user");z(o,"aoInitComplete",g.fnInitComplete,"user");z(o,"aoPreDrawCallback",g.fnPreDrawCallback,"user");o.rowIdFn=R(g.rowId);ib(o);var t=o.oClasses;g.bJQueryUI?(h.extend(t,m.ext.oJUIClasses,g.oClasses),g.sDom===l.sDom&&"lfrtip"===l.sDom&&(o.sDom='<"H"lfr>t<"F"ip>'),o.renderer)?h.isPlainObject(o.renderer)&&
!o.renderer.header&&(o.renderer.header="jqueryui"):o.renderer="jqueryui":h.extend(t,m.ext.classes,g.oClasses);q.addClass(t.sTable);o.iInitDisplayStart===k&&(o.iInitDisplayStart=g.iDisplayStart,o._iDisplayStart=g.iDisplayStart);null!==g.iDeferLoading&&(o.bDeferLoading=!0,e=h.isArray(g.iDeferLoading),o._iRecordsDisplay=e?g.iDeferLoading[0]:g.iDeferLoading,o._iRecordsTotal=e?g.iDeferLoading[1]:g.iDeferLoading);var v=o.oLanguage;h.extend(!0,v,g.oLanguage);v.sUrl&&(h.ajax({dataType:"json",url:v.sUrl,success:function(a){Fa(a);
J(l.oLanguage,a);h.extend(true,v,a);ha(o)},error:function(){ha(o)}}),n=!0);null===g.asStripeClasses&&(o.asStripeClasses=[t.sStripeOdd,t.sStripeEven]);var e=o.asStripeClasses,x=q.children("tbody").find("tr").eq(0);-1!==h.inArray(!0,h.map(e,function(a){return x.hasClass(a)}))&&(h("tbody tr",this).removeClass(e.join(" ")),o.asDestroyStripes=e.slice());e=[];r=this.getElementsByTagName("thead");0!==r.length&&(ea(o.aoHeader,r[0]),e=ta(o));if(null===g.aoColumns){r=[];j=0;for(i=e.length;j<i;j++)r.push(null)}else r=
g.aoColumns;j=0;for(i=r.length;j<i;j++)Ga(o,e?e[j]:null);kb(o,g.aoColumnDefs,r,function(a,b){la(o,a,b)});if(x.length){var w=function(a,b){return a.getAttribute("data-"+b)!==null?b:null};h(x[0]).children("th, td").each(function(a,b){var c=o.aoColumns[a];if(c.mData===a){var d=w(b,"sort")||w(b,"order"),e=w(b,"filter")||w(b,"search");if(d!==null||e!==null){c.mData={_:a+".display",sort:d!==null?a+".@data-"+d:k,type:d!==null?a+".@data-"+d:k,filter:e!==null?a+".@data-"+e:k};la(o,a)}}})}var U=o.oFeatures,
e=function(){if(g.aaSorting===k){var a=o.aaSorting;j=0;for(i=a.length;j<i;j++)a[j][1]=o.aoColumns[j].asSorting[0]}ya(o);U.bSort&&z(o,"aoDrawCallback",function(){if(o.bSorted){var a=W(o),b={};h.each(a,function(a,c){b[c.src]=c.dir});s(o,null,"order",[o,a,b]);Kb(o)}});z(o,"aoDrawCallback",function(){(o.bSorted||y(o)==="ssp"||U.bDeferRender)&&ya(o)},"sc");var a=q.children("caption").each(function(){this._captionSide=h(this).css("caption-side")}),b=q.children("thead");b.length===0&&(b=h("<thead/>").appendTo(q));
o.nTHead=b[0];b=q.children("tbody");b.length===0&&(b=h("<tbody/>").appendTo(q));o.nTBody=b[0];b=q.children("tfoot");if(b.length===0&&a.length>0&&(o.oScroll.sX!==""||o.oScroll.sY!==""))b=h("<tfoot/>").appendTo(q);if(b.length===0||b.children().length===0)q.addClass(t.sNoFooter);else if(b.length>0){o.nTFoot=b[0];ea(o.aoFooter,o.nTFoot)}if(g.aaData)for(j=0;j<g.aaData.length;j++)N(o,g.aaData[j]);else(o.bDeferLoading||y(o)=="dom")&&oa(o,h(o.nTBody).children("tr"));o.aiDisplay=o.aiDisplayMaster.slice();
o.bInitialised=true;n===false&&ha(o)};g.bStateSave?(U.bStateSave=!0,z(o,"aoDrawCallback",za,"state_save"),Lb(o,g,e)):e()}});b=null;return this},x,u,p,t,$a={},Pb=/[\r\n]/g,Ca=/<.*?>/g,cc=/^\d{2,4}[\.\/\-]\d{1,2}[\.\/\-]\d{1,2}([T ]{1}\d{1,2}[:\.]\d{2}([\.:]\d{2})?)?$/,dc=RegExp("(\\/|\\.|\\*|\\+|\\?|\\||\\(|\\)|\\[|\\]|\\{|\\}|\\\\|\\$|\\^|\\-)","g"),Za=/[',$£€¥%\u2009\u202F\u20BD\u20a9\u20BArfk]/gi,M=function(a){return!a||!0===a||"-"===a?!0:!1},Qb=function(a){var b=parseInt(a,10);return!isNaN(b)&&
isFinite(a)?b:null},Rb=function(a,b){$a[b]||($a[b]=RegExp(Sa(b),"g"));return"string"===typeof a&&"."!==b?a.replace(/\./g,"").replace($a[b],"."):a},ab=function(a,b,c){var d="string"===typeof a;if(M(a))return!0;b&&d&&(a=Rb(a,b));c&&d&&(a=a.replace(Za,""));return!isNaN(parseFloat(a))&&isFinite(a)},Sb=function(a,b,c){return M(a)?!0:!(M(a)||"string"===typeof a)?null:ab(a.replace(Ca,""),b,c)?!0:null},D=function(a,b,c){var d=[],e=0,f=a.length;if(c!==k)for(;e<f;e++)a[e]&&a[e][b]&&d.push(a[e][b][c]);else for(;e<
f;e++)a[e]&&d.push(a[e][b]);return d},ja=function(a,b,c,d){var e=[],f=0,g=b.length;if(d!==k)for(;f<g;f++)a[b[f]][c]&&e.push(a[b[f]][c][d]);else for(;f<g;f++)e.push(a[b[f]][c]);return e},X=function(a,b){var c=[],d;b===k?(b=0,d=a):(d=b,b=a);for(var e=b;e<d;e++)c.push(e);return c},Tb=function(a){for(var b=[],c=0,d=a.length;c<d;c++)a[c]&&b.push(a[c]);return b},sa=function(a){var b=[],c,d,e=a.length,f,g=0;d=0;a:for(;d<e;d++){c=a[d];for(f=0;f<g;f++)if(b[f]===c)continue a;b.push(c);g++}return b};m.util=
{throttle:function(a,b){var c=b!==k?b:200,d,e;return function(){var b=this,g=+new Date,h=arguments;d&&g<d+c?(clearTimeout(e),e=setTimeout(function(){d=k;a.apply(b,h)},c)):(d=g,a.apply(b,h))}},escapeRegex:function(a){return a.replace(dc,"\\$1")}};var A=function(a,b,c){a[b]!==k&&(a[c]=a[b])},ca=/\[.*?\]$/,V=/\(\)$/,Sa=m.util.escapeRegex,xa=h("<div>")[0],$b=xa.textContent!==k,bc=/<.*?>/g,Qa=m.util.throttle,Ub=[],w=Array.prototype,ec=function(a){var b,c,d=m.settings,e=h.map(d,function(a){return a.nTable});
if(a){if(a.nTable&&a.oApi)return[a];if(a.nodeName&&"table"===a.nodeName.toLowerCase())return b=h.inArray(a,e),-1!==b?[d[b]]:null;if(a&&"function"===typeof a.settings)return a.settings().toArray();"string"===typeof a?c=h(a):a instanceof h&&(c=a)}else return[];if(c)return c.map(function(){b=h.inArray(this,e);return-1!==b?d[b]:null}).toArray()};u=function(a,b){if(!(this instanceof u))return new u(a,b);var c=[],d=function(a){(a=ec(a))&&(c=c.concat(a))};if(h.isArray(a))for(var e=0,f=a.length;e<f;e++)d(a[e]);
else d(a);this.context=sa(c);b&&h.merge(this,b);this.selector={rows:null,cols:null,opts:null};u.extend(this,this,Ub)};m.Api=u;h.extend(u.prototype,{any:function(){return 0!==this.count()},concat:w.concat,context:[],count:function(){return this.flatten().length},each:function(a){for(var b=0,c=this.length;b<c;b++)a.call(this,this[b],b,this);return this},eq:function(a){var b=this.context;return b.length>a?new u(b[a],this[a]):null},filter:function(a){var b=[];if(w.filter)b=w.filter.call(this,a,this);
else for(var c=0,d=this.length;c<d;c++)a.call(this,this[c],c,this)&&b.push(this[c]);return new u(this.context,b)},flatten:function(){var a=[];return new u(this.context,a.concat.apply(a,this.toArray()))},join:w.join,indexOf:w.indexOf||function(a,b){for(var c=b||0,d=this.length;c<d;c++)if(this[c]===a)return c;return-1},iterator:function(a,b,c,d){var e=[],f,g,h,i,n,l=this.context,m,p,t=this.selector;"string"===typeof a&&(d=c,c=b,b=a,a=!1);g=0;for(h=l.length;g<h;g++){var s=new u(l[g]);if("table"===b)f=
c.call(s,l[g],g),f!==k&&e.push(f);else if("columns"===b||"rows"===b)f=c.call(s,l[g],this[g],g),f!==k&&e.push(f);else if("column"===b||"column-rows"===b||"row"===b||"cell"===b){p=this[g];"column-rows"===b&&(m=Da(l[g],t.opts));i=0;for(n=p.length;i<n;i++)f=p[i],f="cell"===b?c.call(s,l[g],f.row,f.column,g,i):c.call(s,l[g],f,g,i,m),f!==k&&e.push(f)}}return e.length||d?(a=new u(l,a?e.concat.apply([],e):e),b=a.selector,b.rows=t.rows,b.cols=t.cols,b.opts=t.opts,a):this},lastIndexOf:w.lastIndexOf||function(a,
b){return this.indexOf.apply(this.toArray.reverse(),arguments)},length:0,map:function(a){var b=[];if(w.map)b=w.map.call(this,a,this);else for(var c=0,d=this.length;c<d;c++)b.push(a.call(this,this[c],c));return new u(this.context,b)},pluck:function(a){return this.map(function(b){return b[a]})},pop:w.pop,push:w.push,reduce:w.reduce||function(a,b){return jb(this,a,b,0,this.length,1)},reduceRight:w.reduceRight||function(a,b){return jb(this,a,b,this.length-1,-1,-1)},reverse:w.reverse,selector:null,shift:w.shift,
sort:w.sort,splice:w.splice,toArray:function(){return w.slice.call(this)},to$:function(){return h(this)},toJQuery:function(){return h(this)},unique:function(){return new u(this.context,sa(this))},unshift:w.unshift});u.extend=function(a,b,c){if(c.length&&b&&(b instanceof u||b.__dt_wrapper)){var d,e,f,g=function(a,b,c){return function(){var d=b.apply(a,arguments);u.extend(d,d,c.methodExt);return d}};d=0;for(e=c.length;d<e;d++)f=c[d],b[f.name]="function"===typeof f.val?g(a,f.val,f):h.isPlainObject(f.val)?
{}:f.val,b[f.name].__dt_wrapper=!0,u.extend(a,b[f.name],f.propExt)}};u.register=p=function(a,b){if(h.isArray(a))for(var c=0,d=a.length;c<d;c++)u.register(a[c],b);else for(var e=a.split("."),f=Ub,g,j,c=0,d=e.length;c<d;c++){g=(j=-1!==e[c].indexOf("()"))?e[c].replace("()",""):e[c];var i;a:{i=0;for(var n=f.length;i<n;i++)if(f[i].name===g){i=f[i];break a}i=null}i||(i={name:g,val:{},methodExt:[],propExt:[]},f.push(i));c===d-1?i.val=b:f=j?i.methodExt:i.propExt}};u.registerPlural=t=function(a,b,c){u.register(a,
c);u.register(b,function(){var a=c.apply(this,arguments);return a===this?this:a instanceof u?a.length?h.isArray(a[0])?new u(a.context,a[0]):a[0]:k:a})};p("tables()",function(a){var b;if(a){b=u;var c=this.context;if("number"===typeof a)a=[c[a]];else var d=h.map(c,function(a){return a.nTable}),a=h(d).filter(a).map(function(){var a=h.inArray(this,d);return c[a]}).toArray();b=new b(a)}else b=this;return b});p("table()",function(a){var a=this.tables(a),b=a.context;return b.length?new u(b[0]):a});t("tables().nodes()",
"table().node()",function(){return this.iterator("table",function(a){return a.nTable},1)});t("tables().body()","table().body()",function(){return this.iterator("table",function(a){return a.nTBody},1)});t("tables().header()","table().header()",function(){return this.iterator("table",function(a){return a.nTHead},1)});t("tables().footer()","table().footer()",function(){return this.iterator("table",function(a){return a.nTFoot},1)});t("tables().containers()","table().container()",function(){return this.iterator("table",
function(a){return a.nTableWrapper},1)});p("draw()",function(a){return this.iterator("table",function(b){"page"===a?O(b):("string"===typeof a&&(a="full-hold"===a?!1:!0),T(b,!1===a))})});p("page()",function(a){return a===k?this.page.info().page:this.iterator("table",function(b){Va(b,a)})});p("page.info()",function(){if(0===this.context.length)return k;var a=this.context[0],b=a._iDisplayStart,c=a.oFeatures.bPaginate?a._iDisplayLength:-1,d=a.fnRecordsDisplay(),e=-1===c;return{page:e?0:Math.floor(b/c),
pages:e?1:Math.ceil(d/c),start:b,end:a.fnDisplayEnd(),length:c,recordsTotal:a.fnRecordsTotal(),recordsDisplay:d,serverSide:"ssp"===y(a)}});p("page.len()",function(a){return a===k?0!==this.context.length?this.context[0]._iDisplayLength:k:this.iterator("table",function(b){Ta(b,a)})});var Vb=function(a,b,c){if(c){var d=new u(a);d.one("draw",function(){c(d.ajax.json())})}if("ssp"==y(a))T(a,b);else{C(a,!0);var e=a.jqXHR;e&&4!==e.readyState&&e.abort();ua(a,[],function(c){pa(a);for(var c=va(a,c),d=0,e=c.length;d<
e;d++)N(a,c[d]);T(a,b);C(a,!1)})}};p("ajax.json()",function(){var a=this.context;if(0<a.length)return a[0].json});p("ajax.params()",function(){var a=this.context;if(0<a.length)return a[0].oAjaxData});p("ajax.reload()",function(a,b){return this.iterator("table",function(c){Vb(c,!1===b,a)})});p("ajax.url()",function(a){var b=this.context;if(a===k){if(0===b.length)return k;b=b[0];return b.ajax?h.isPlainObject(b.ajax)?b.ajax.url:b.ajax:b.sAjaxSource}return this.iterator("table",function(b){h.isPlainObject(b.ajax)?
b.ajax.url=a:b.ajax=a})});p("ajax.url().load()",function(a,b){return this.iterator("table",function(c){Vb(c,!1===b,a)})});var bb=function(a,b,c,d,e){var f=[],g,j,i,n,l,m;i=typeof b;if(!b||"string"===i||"function"===i||b.length===k)b=[b];i=0;for(n=b.length;i<n;i++){j=b[i]&&b[i].split&&!b[i].match(/[\[\(:]/)?b[i].split(","):[b[i]];l=0;for(m=j.length;l<m;l++)(g=c("string"===typeof j[l]?h.trim(j[l]):j[l]))&&g.length&&(f=f.concat(g))}a=x.selector[a];if(a.length){i=0;for(n=a.length;i<n;i++)f=a[i](d,e,f)}return sa(f)},
cb=function(a){a||(a={});a.filter&&a.search===k&&(a.search=a.filter);return h.extend({search:"none",order:"current",page:"all"},a)},db=function(a){for(var b=0,c=a.length;b<c;b++)if(0<a[b].length)return a[0]=a[b],a[0].length=1,a.length=1,a.context=[a.context[b]],a;a.length=0;return a},Da=function(a,b){var c,d,e,f=[],g=a.aiDisplay;c=a.aiDisplayMaster;var j=b.search;d=b.order;e=b.page;if("ssp"==y(a))return"removed"===j?[]:X(0,c.length);if("current"==e){c=a._iDisplayStart;for(d=a.fnDisplayEnd();c<d;c++)f.push(g[c])}else if("current"==
d||"applied"==d)f="none"==j?c.slice():"applied"==j?g.slice():h.map(c,function(a){return-1===h.inArray(a,g)?a:null});else if("index"==d||"original"==d){c=0;for(d=a.aoData.length;c<d;c++)"none"==j?f.push(c):(e=h.inArray(c,g),(-1===e&&"removed"==j||0<=e&&"applied"==j)&&f.push(c))}return f};p("rows()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=cb(b),c=this.iterator("table",function(c){var e=b,f;return bb("row",a,function(a){var b=Qb(a);if(b!==null&&!e)return[b];f||(f=Da(c,e));if(b!==
null&&h.inArray(b,f)!==-1)return[b];if(a===null||a===k||a==="")return f;if(typeof a==="function")return h.map(f,function(b){var e=c.aoData[b];return a(b,e._aData,e.nTr)?b:null});b=Tb(ja(c.aoData,f,"nTr"));if(a.nodeName){if(a._DT_RowIndex!==k)return[a._DT_RowIndex];if(a._DT_CellIndex)return[a._DT_CellIndex.row];b=h(a).closest("*[data-dt-row]");return b.length?[b.data("dt-row")]:[]}if(typeof a==="string"&&a.charAt(0)==="#"){var i=c.aIds[a.replace(/^#/,"")];if(i!==k)return[i.idx]}return h(b).filter(a).map(function(){return this._DT_RowIndex}).toArray()},
c,e)},1);c.selector.rows=a;c.selector.opts=b;return c});p("rows().nodes()",function(){return this.iterator("row",function(a,b){return a.aoData[b].nTr||k},1)});p("rows().data()",function(){return this.iterator(!0,"rows",function(a,b){return ja(a.aoData,b,"_aData")},1)});t("rows().cache()","row().cache()",function(a){return this.iterator("row",function(b,c){var d=b.aoData[c];return"search"===a?d._aFilterData:d._aSortData},1)});t("rows().invalidate()","row().invalidate()",function(a){return this.iterator("row",
function(b,c){da(b,c,a)})});t("rows().indexes()","row().index()",function(){return this.iterator("row",function(a,b){return b},1)});t("rows().ids()","row().id()",function(a){for(var b=[],c=this.context,d=0,e=c.length;d<e;d++)for(var f=0,g=this[d].length;f<g;f++){var h=c[d].rowIdFn(c[d].aoData[this[d][f]]._aData);b.push((!0===a?"#":"")+h)}return new u(c,b)});t("rows().remove()","row().remove()",function(){var a=this;this.iterator("row",function(b,c,d){var e=b.aoData,f=e[c],g,h,i,n,l;e.splice(c,1);
g=0;for(h=e.length;g<h;g++)if(i=e[g],l=i.anCells,null!==i.nTr&&(i.nTr._DT_RowIndex=g),null!==l){i=0;for(n=l.length;i<n;i++)l[i]._DT_CellIndex.row=g}qa(b.aiDisplayMaster,c);qa(b.aiDisplay,c);qa(a[d],c,!1);Ua(b);c=b.rowIdFn(f._aData);c!==k&&delete b.aIds[c]});this.iterator("table",function(a){for(var c=0,d=a.aoData.length;c<d;c++)a.aoData[c].idx=c});return this});p("rows.add()",function(a){var b=this.iterator("table",function(b){var c,f,g,h=[];f=0;for(g=a.length;f<g;f++)c=a[f],c.nodeName&&"TR"===c.nodeName.toUpperCase()?
h.push(oa(b,c)[0]):h.push(N(b,c));return h},1),c=this.rows(-1);c.pop();h.merge(c,b);return c});p("row()",function(a,b){return db(this.rows(a,b))});p("row().data()",function(a){var b=this.context;if(a===k)return b.length&&this.length?b[0].aoData[this[0]]._aData:k;b[0].aoData[this[0]]._aData=a;da(b[0],this[0],"data");return this});p("row().node()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]].nTr||null:null});p("row.add()",function(a){a instanceof h&&a.length&&(a=a[0]);
var b=this.iterator("table",function(b){return a.nodeName&&"TR"===a.nodeName.toUpperCase()?oa(b,a)[0]:N(b,a)});return this.row(b[0])});var eb=function(a,b){var c=a.context;if(c.length&&(c=c[0].aoData[b!==k?b:a[0]])&&c._details)c._details.remove(),c._detailsShow=k,c._details=k},Wb=function(a,b){var c=a.context;if(c.length&&a.length){var d=c[0].aoData[a[0]];if(d._details){(d._detailsShow=b)?d._details.insertAfter(d.nTr):d._details.detach();var e=c[0],f=new u(e),g=e.aoData;f.off("draw.dt.DT_details column-visibility.dt.DT_details destroy.dt.DT_details");
0<D(g,"_details").length&&(f.on("draw.dt.DT_details",function(a,b){e===b&&f.rows({page:"current"}).eq(0).each(function(a){a=g[a];a._detailsShow&&a._details.insertAfter(a.nTr)})}),f.on("column-visibility.dt.DT_details",function(a,b){if(e===b)for(var c,d=ba(b),f=0,h=g.length;f<h;f++)c=g[f],c._details&&c._details.children("td[colspan]").attr("colspan",d)}),f.on("destroy.dt.DT_details",function(a,b){if(e===b)for(var c=0,d=g.length;c<d;c++)g[c]._details&&eb(f,c)}))}}};p("row().child()",function(a,b){var c=
this.context;if(a===k)return c.length&&this.length?c[0].aoData[this[0]]._details:k;if(!0===a)this.child.show();else if(!1===a)eb(this);else if(c.length&&this.length){var d=c[0],c=c[0].aoData[this[0]],e=[],f=function(a,b){if(h.isArray(a)||a instanceof h)for(var c=0,k=a.length;c<k;c++)f(a[c],b);else a.nodeName&&"tr"===a.nodeName.toLowerCase()?e.push(a):(c=h("<tr><td/></tr>").addClass(b),h("td",c).addClass(b).html(a)[0].colSpan=ba(d),e.push(c[0]))};f(a,b);c._details&&c._details.detach();c._details=h(e);
c._detailsShow&&c._details.insertAfter(c.nTr)}return this});p(["row().child.show()","row().child().show()"],function(){Wb(this,!0);return this});p(["row().child.hide()","row().child().hide()"],function(){Wb(this,!1);return this});p(["row().child.remove()","row().child().remove()"],function(){eb(this);return this});p("row().child.isShown()",function(){var a=this.context;return a.length&&this.length?a[0].aoData[this[0]]._detailsShow||!1:!1});var fc=/^([^:]+):(name|visIdx|visible)$/,Xb=function(a,b,
c,d,e){for(var c=[],d=0,f=e.length;d<f;d++)c.push(B(a,e[d],b));return c};p("columns()",function(a,b){a===k?a="":h.isPlainObject(a)&&(b=a,a="");var b=cb(b),c=this.iterator("table",function(c){var e=a,f=b,g=c.aoColumns,j=D(g,"sName"),i=D(g,"nTh");return bb("column",e,function(a){var b=Qb(a);if(a==="")return X(g.length);if(b!==null)return[b>=0?b:g.length+b];if(typeof a==="function"){var e=Da(c,f);return h.map(g,function(b,f){return a(f,Xb(c,f,0,0,e),i[f])?f:null})}var k=typeof a==="string"?a.match(fc):
"";if(k)switch(k[2]){case "visIdx":case "visible":b=parseInt(k[1],10);if(b<0){var m=h.map(g,function(a,b){return a.bVisible?b:null});return[m[m.length+b]]}return[$(c,b)];case "name":return h.map(j,function(a,b){return a===k[1]?b:null});default:return[]}if(a.nodeName&&a._DT_CellIndex)return[a._DT_CellIndex.column];b=h(i).filter(a).map(function(){return h.inArray(this,i)}).toArray();if(b.length||!a.nodeName)return b;b=h(a).closest("*[data-dt-column]");return b.length?[b.data("dt-column")]:[]},c,f)},
1);c.selector.cols=a;c.selector.opts=b;return c});t("columns().header()","column().header()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTh},1)});t("columns().footer()","column().footer()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].nTf},1)});t("columns().data()","column().data()",function(){return this.iterator("column-rows",Xb,1)});t("columns().dataSrc()","column().dataSrc()",function(){return this.iterator("column",function(a,b){return a.aoColumns[b].mData},
1)});t("columns().cache()","column().cache()",function(a){return this.iterator("column-rows",function(b,c,d,e,f){return ja(b.aoData,f,"search"===a?"_aFilterData":"_aSortData",c)},1)});t("columns().nodes()","column().nodes()",function(){return this.iterator("column-rows",function(a,b,c,d,e){return ja(a.aoData,e,"anCells",b)},1)});t("columns().visible()","column().visible()",function(a,b){var c=this.iterator("column",function(b,c){if(a===k)return b.aoColumns[c].bVisible;var f=b.aoColumns,g=f[c],j=b.aoData,
i,n,l;if(a!==k&&g.bVisible!==a){if(a){var m=h.inArray(!0,D(f,"bVisible"),c+1);i=0;for(n=j.length;i<n;i++)l=j[i].nTr,f=j[i].anCells,l&&l.insertBefore(f[c],f[m]||null)}else h(D(b.aoData,"anCells",c)).detach();g.bVisible=a;fa(b,b.aoHeader);fa(b,b.aoFooter);za(b)}});a!==k&&(this.iterator("column",function(c,e){s(c,null,"column-visibility",[c,e,a,b])}),(b===k||b)&&this.columns.adjust());return c});t("columns().indexes()","column().index()",function(a){return this.iterator("column",function(b,c){return"visible"===
a?aa(b,c):c},1)});p("columns.adjust()",function(){return this.iterator("table",function(a){Z(a)},1)});p("column.index()",function(a,b){if(0!==this.context.length){var c=this.context[0];if("fromVisible"===a||"toData"===a)return $(c,b);if("fromData"===a||"toVisible"===a)return aa(c,b)}});p("column()",function(a,b){return db(this.columns(a,b))});p("cells()",function(a,b,c){h.isPlainObject(a)&&(a.row===k?(c=a,a=null):(c=b,b=null));h.isPlainObject(b)&&(c=b,b=null);if(null===b||b===k)return this.iterator("table",
function(b){var d=a,e=cb(c),f=b.aoData,g=Da(b,e),i=Tb(ja(f,g,"anCells")),j=h([].concat.apply([],i)),l,n=b.aoColumns.length,m,p,t,u,s,v;return bb("cell",d,function(a){var c=typeof a==="function";if(a===null||a===k||c){m=[];p=0;for(t=g.length;p<t;p++){l=g[p];for(u=0;u<n;u++){s={row:l,column:u};if(c){v=f[l];a(s,B(b,l,u),v.anCells?v.anCells[u]:null)&&m.push(s)}else m.push(s)}}return m}if(h.isPlainObject(a))return[a];c=j.filter(a).map(function(a,b){return{row:b._DT_CellIndex.row,column:b._DT_CellIndex.column}}).toArray();
if(c.length||!a.nodeName)return c;v=h(a).closest("*[data-dt-row]");return v.length?[{row:v.data("dt-row"),column:v.data("dt-column")}]:[]},b,e)});var d=this.columns(b,c),e=this.rows(a,c),f,g,j,i,n,l=this.iterator("table",function(a,b){f=[];g=0;for(j=e[b].length;g<j;g++){i=0;for(n=d[b].length;i<n;i++)f.push({row:e[b][g],column:d[b][i]})}return f},1);h.extend(l.selector,{cols:b,rows:a,opts:c});return l});t("cells().nodes()","cell().node()",function(){return this.iterator("cell",function(a,b,c){return(a=
a.aoData[b])&&a.anCells?a.anCells[c]:k},1)});p("cells().data()",function(){return this.iterator("cell",function(a,b,c){return B(a,b,c)},1)});t("cells().cache()","cell().cache()",function(a){a="search"===a?"_aFilterData":"_aSortData";return this.iterator("cell",function(b,c,d){return b.aoData[c][a][d]},1)});t("cells().render()","cell().render()",function(a){return this.iterator("cell",function(b,c,d){return B(b,c,d,a)},1)});t("cells().indexes()","cell().index()",function(){return this.iterator("cell",
function(a,b,c){return{row:b,column:c,columnVisible:aa(a,c)}},1)});t("cells().invalidate()","cell().invalidate()",function(a){return this.iterator("cell",function(b,c,d){da(b,c,a,d)})});p("cell()",function(a,b,c){return db(this.cells(a,b,c))});p("cell().data()",function(a){var b=this.context,c=this[0];if(a===k)return b.length&&c.length?B(b[0],c[0].row,c[0].column):k;lb(b[0],c[0].row,c[0].column,a);da(b[0],c[0].row,"data",c[0].column);return this});p("order()",function(a,b){var c=this.context;if(a===
k)return 0!==c.length?c[0].aaSorting:k;"number"===typeof a?a=[[a,b]]:a.length&&!h.isArray(a[0])&&(a=Array.prototype.slice.call(arguments));return this.iterator("table",function(b){b.aaSorting=a.slice()})});p("order.listener()",function(a,b,c){return this.iterator("table",function(d){Oa(d,a,b,c)})});p("order.fixed()",function(a){if(!a){var b=this.context,b=b.length?b[0].aaSortingFixed:k;return h.isArray(b)?{pre:b}:b}return this.iterator("table",function(b){b.aaSortingFixed=h.extend(!0,{},a)})});p(["columns().order()",
"column().order()"],function(a){var b=this;return this.iterator("table",function(c,d){var e=[];h.each(b[d],function(b,c){e.push([c,a])});c.aaSorting=e})});p("search()",function(a,b,c,d){var e=this.context;return a===k?0!==e.length?e[0].oPreviousSearch.sSearch:k:this.iterator("table",function(e){e.oFeatures.bFilter&&ga(e,h.extend({},e.oPreviousSearch,{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===d?!0:d}),1)})});t("columns().search()","column().search()",function(a,
b,c,d){return this.iterator("column",function(e,f){var g=e.aoPreSearchCols;if(a===k)return g[f].sSearch;e.oFeatures.bFilter&&(h.extend(g[f],{sSearch:a+"",bRegex:null===b?!1:b,bSmart:null===c?!0:c,bCaseInsensitive:null===d?!0:d}),ga(e,e.oPreviousSearch,1))})});p("state()",function(){return this.context.length?this.context[0].oSavedState:null});p("state.clear()",function(){return this.iterator("table",function(a){a.fnStateSaveCallback.call(a.oInstance,a,{})})});p("state.loaded()",function(){return this.context.length?
this.context[0].oLoadedState:null});p("state.save()",function(){return this.iterator("table",function(a){za(a)})});m.versionCheck=m.fnVersionCheck=function(a){for(var b=m.version.split("."),a=a.split("."),c,d,e=0,f=a.length;e<f;e++)if(c=parseInt(b[e],10)||0,d=parseInt(a[e],10)||0,c!==d)return c>d;return!0};m.isDataTable=m.fnIsDataTable=function(a){var b=h(a).get(0),c=!1;if(a instanceof m.Api)return!0;h.each(m.settings,function(a,e){var f=e.nScrollHead?h("table",e.nScrollHead)[0]:null,g=e.nScrollFoot?
h("table",e.nScrollFoot)[0]:null;if(e.nTable===b||f===b||g===b)c=!0});return c};m.tables=m.fnTables=function(a){var b=!1;h.isPlainObject(a)&&(b=a.api,a=a.visible);var c=h.map(m.settings,function(b){if(!a||a&&h(b.nTable).is(":visible"))return b.nTable});return b?new u(c):c};m.camelToHungarian=J;p("$()",function(a,b){var c=this.rows(b).nodes(),c=h(c);return h([].concat(c.filter(a).toArray(),c.find(a).toArray()))});h.each(["on","one","off"],function(a,b){p(b+"()",function(){var a=Array.prototype.slice.call(arguments);
a[0]=h.map(a[0].split(/\s/),function(a){return!a.match(/\.dt\b/)?a+".dt":a}).join(" ");var d=h(this.tables().nodes());d[b].apply(d,a);return this})});p("clear()",function(){return this.iterator("table",function(a){pa(a)})});p("settings()",function(){return new u(this.context,this.context)});p("init()",function(){var a=this.context;return a.length?a[0].oInit:null});p("data()",function(){return this.iterator("table",function(a){return D(a.aoData,"_aData")}).flatten()});p("destroy()",function(a){a=a||
!1;return this.iterator("table",function(b){var c=b.nTableWrapper.parentNode,d=b.oClasses,e=b.nTable,f=b.nTBody,g=b.nTHead,j=b.nTFoot,i=h(e),f=h(f),k=h(b.nTableWrapper),l=h.map(b.aoData,function(a){return a.nTr}),p;b.bDestroying=!0;s(b,"aoDestroyCallback","destroy",[b]);a||(new u(b)).columns().visible(!0);k.off(".DT").find(":not(tbody *)").off(".DT");h(E).off(".DT-"+b.sInstance);e!=g.parentNode&&(i.children("thead").detach(),i.append(g));j&&e!=j.parentNode&&(i.children("tfoot").detach(),i.append(j));
b.aaSorting=[];b.aaSortingFixed=[];ya(b);h(l).removeClass(b.asStripeClasses.join(" "));h("th, td",g).removeClass(d.sSortable+" "+d.sSortableAsc+" "+d.sSortableDesc+" "+d.sSortableNone);b.bJUI&&(h("th span."+d.sSortIcon+", td span."+d.sSortIcon,g).detach(),h("th, td",g).each(function(){var a=h("div."+d.sSortJUIWrapper,this);h(this).append(a.contents());a.detach()}));f.children().detach();f.append(l);g=a?"remove":"detach";i[g]();k[g]();!a&&c&&(c.insertBefore(e,b.nTableReinsertBefore),i.css("width",
b.sDestroyWidth).removeClass(d.sTable),(p=b.asDestroyStripes.length)&&f.children().each(function(a){h(this).addClass(b.asDestroyStripes[a%p])}));c=h.inArray(b,m.settings);-1!==c&&m.settings.splice(c,1)})});h.each(["column","row","cell"],function(a,b){p(b+"s().every()",function(a){var d=this.selector.opts,e=this;return this.iterator(b,function(f,g,h,i,m){a.call(e[b](g,"cell"===b?h:d,"cell"===b?d:k),g,h,i,m)})})});p("i18n()",function(a,b,c){var d=this.context[0],a=R(a)(d.oLanguage);a===k&&(a=b);c!==
k&&h.isPlainObject(a)&&(a=a[c]!==k?a[c]:a._);return a.replace("%d",c)});m.version="1.10.13";m.settings=[];m.models={};m.models.oSearch={bCaseInsensitive:!0,sSearch:"",bRegex:!1,bSmart:!0};m.models.oRow={nTr:null,anCells:null,_aData:[],_aSortData:null,_aFilterData:null,_sFilterRow:null,_sRowStripe:"",src:null,idx:-1};m.models.oColumn={idx:null,aDataSort:null,asSorting:null,bSearchable:null,bSortable:null,bVisible:null,_sManualType:null,_bAttrSrc:!1,fnCreatedCell:null,fnGetData:null,fnSetData:null,
mData:null,mRender:null,nTh:null,nTf:null,sClass:null,sContentPadding:null,sDefaultContent:null,sName:null,sSortDataType:"std",sSortingClass:null,sSortingClassJUI:null,sTitle:null,sType:null,sWidth:null,sWidthOrig:null};m.defaults={aaData:null,aaSorting:[[0,"asc"]],aaSortingFixed:[],ajax:null,aLengthMenu:[10,25,50,100],aoColumns:null,aoColumnDefs:null,aoSearchCols:[],asStripeClasses:null,bAutoWidth:!0,bDeferRender:!1,bDestroy:!1,bFilter:!0,bInfo:!0,bJQueryUI:!1,bLengthChange:!0,bPaginate:!0,bProcessing:!1,
bRetrieve:!1,bScrollCollapse:!1,bServerSide:!1,bSort:!0,bSortMulti:!0,bSortCellsTop:!1,bSortClasses:!0,bStateSave:!1,fnCreatedRow:null,fnDrawCallback:null,fnFooterCallback:null,fnFormatNumber:function(a){return a.toString().replace(/\B(?=(\d{3})+(?!\d))/g,this.oLanguage.sThousands)},fnHeaderCallback:null,fnInfoCallback:null,fnInitComplete:null,fnPreDrawCallback:null,fnRowCallback:null,fnServerData:null,fnServerParams:null,fnStateLoadCallback:function(a){try{return JSON.parse((-1===a.iStateDuration?
sessionStorage:localStorage).getItem("DataTables_"+a.sInstance+"_"+location.pathname))}catch(b){}},fnStateLoadParams:null,fnStateLoaded:null,fnStateSaveCallback:function(a,b){try{(-1===a.iStateDuration?sessionStorage:localStorage).setItem("DataTables_"+a.sInstance+"_"+location.pathname,JSON.stringify(b))}catch(c){}},fnStateSaveParams:null,iStateDuration:7200,iDeferLoading:null,iDisplayLength:10,iDisplayStart:0,iTabIndex:0,oClasses:{},oLanguage:{oAria:{sSortAscending:": activate to sort column ascending",
sSortDescending:": activate to sort column descending"},oPaginate:{sFirst:"First",sLast:"Last",sNext:"Next",sPrevious:"Previous"},sEmptyTable:"No data available in table",sInfo:"Showing _START_ to _END_ of _TOTAL_ entries",sInfoEmpty:"Showing 0 to 0 of 0 entries",sInfoFiltered:"(filtered from _MAX_ total entries)",sInfoPostFix:"",sDecimal:"",sThousands:",",sLengthMenu:"Show _MENU_ entries",sLoadingRecords:"Loading...",sProcessing:"Processing...",sSearch:"Search:",sSearchPlaceholder:"",sUrl:"",sZeroRecords:"No matching records found"},
oSearch:h.extend({},m.models.oSearch),sAjaxDataProp:"data",sAjaxSource:null,sDom:"lfrtip",searchDelay:null,sPaginationType:"simple_numbers",sScrollX:"",sScrollXInner:"",sScrollY:"",sServerMethod:"GET",renderer:null,rowId:"DT_RowId"};Y(m.defaults);m.defaults.column={aDataSort:null,iDataSort:-1,asSorting:["asc","desc"],bSearchable:!0,bSortable:!0,bVisible:!0,fnCreatedCell:null,mData:null,mRender:null,sCellType:"td",sClass:"",sContentPadding:"",sDefaultContent:null,sName:"",sSortDataType:"std",sTitle:null,
sType:null,sWidth:null};Y(m.defaults.column);m.models.oSettings={oFeatures:{bAutoWidth:null,bDeferRender:null,bFilter:null,bInfo:null,bLengthChange:null,bPaginate:null,bProcessing:null,bServerSide:null,bSort:null,bSortMulti:null,bSortClasses:null,bStateSave:null},oScroll:{bCollapse:null,iBarWidth:0,sX:null,sXInner:null,sY:null},oLanguage:{fnInfoCallback:null},oBrowser:{bScrollOversize:!1,bScrollbarLeft:!1,bBounding:!1,barWidth:0},ajax:null,aanFeatures:[],aoData:[],aiDisplay:[],aiDisplayMaster:[],
aIds:{},aoColumns:[],aoHeader:[],aoFooter:[],oPreviousSearch:{},aoPreSearchCols:[],aaSorting:null,aaSortingFixed:[],asStripeClasses:null,asDestroyStripes:[],sDestroyWidth:0,aoRowCallback:[],aoHeaderCallback:[],aoFooterCallback:[],aoDrawCallback:[],aoRowCreatedCallback:[],aoPreDrawCallback:[],aoInitComplete:[],aoStateSaveParams:[],aoStateLoadParams:[],aoStateLoaded:[],sTableId:"",nTable:null,nTHead:null,nTFoot:null,nTBody:null,nTableWrapper:null,bDeferLoading:!1,bInitialised:!1,aoOpenRows:[],sDom:null,
searchDelay:null,sPaginationType:"two_button",iStateDuration:0,aoStateSave:[],aoStateLoad:[],oSavedState:null,oLoadedState:null,sAjaxSource:null,sAjaxDataProp:null,bAjaxDataGet:!0,jqXHR:null,json:k,oAjaxData:k,fnServerData:null,aoServerParams:[],sServerMethod:null,fnFormatNumber:null,aLengthMenu:null,iDraw:0,bDrawing:!1,iDrawError:-1,_iDisplayLength:10,_iDisplayStart:0,_iRecordsTotal:0,_iRecordsDisplay:0,bJUI:null,oClasses:{},bFiltered:!1,bSorted:!1,bSortCellsTop:null,oInit:null,aoDestroyCallback:[],
fnRecordsTotal:function(){return"ssp"==y(this)?1*this._iRecordsTotal:this.aiDisplayMaster.length},fnRecordsDisplay:function(){return"ssp"==y(this)?1*this._iRecordsDisplay:this.aiDisplay.length},fnDisplayEnd:function(){var a=this._iDisplayLength,b=this._iDisplayStart,c=b+a,d=this.aiDisplay.length,e=this.oFeatures,f=e.bPaginate;return e.bServerSide?!1===f||-1===a?b+d:Math.min(b+a,this._iRecordsDisplay):!f||c>d||-1===a?d:c},oInstance:null,sInstance:null,iTabIndex:0,nScrollHead:null,nScrollFoot:null,
aLastSort:[],oPlugins:{},rowIdFn:null,rowId:null};m.ext=x={buttons:{},classes:{},builder:"-source-",errMode:"alert",feature:[],search:[],selector:{cell:[],column:[],row:[]},internal:{},legacy:{ajax:null},pager:{},renderer:{pageButton:{},header:{}},order:{},type:{detect:[],search:{},order:{}},_unique:0,fnVersionCheck:m.fnVersionCheck,iApiIndex:0,oJUIClasses:{},sVersion:m.version};h.extend(x,{afnFiltering:x.search,aTypes:x.type.detect,ofnSearch:x.type.search,oSort:x.type.order,afnSortData:x.order,aoFeatures:x.feature,
oApi:x.internal,oStdClasses:x.classes,oPagination:x.pager});h.extend(m.ext.classes,{sTable:"dataTable",sNoFooter:"no-footer",sPageButton:"paginate_button",sPageButtonActive:"current",sPageButtonDisabled:"disabled",sStripeOdd:"odd",sStripeEven:"even",sRowEmpty:"dataTables_empty",sWrapper:"dataTables_wrapper",sFilter:"dataTables_filter",sInfo:"dataTables_info",sPaging:"dataTables_paginate paging_",sLength:"dataTables_length",sProcessing:"dataTables_processing",sSortAsc:"sorting_asc",sSortDesc:"sorting_desc",
sSortable:"sorting",sSortableAsc:"sorting_asc_disabled",sSortableDesc:"sorting_desc_disabled",sSortableNone:"sorting_disabled",sSortColumn:"sorting_",sFilterInput:"",sLengthSelect:"",sScrollWrapper:"dataTables_scroll",sScrollHead:"dataTables_scrollHead",sScrollHeadInner:"dataTables_scrollHeadInner",sScrollBody:"dataTables_scrollBody",sScrollFoot:"dataTables_scrollFoot",sScrollFootInner:"dataTables_scrollFootInner",sHeaderTH:"",sFooterTH:"",sSortJUIAsc:"",sSortJUIDesc:"",sSortJUI:"",sSortJUIAscAllowed:"",
sSortJUIDescAllowed:"",sSortJUIWrapper:"",sSortIcon:"",sJUIHeader:"",sJUIFooter:""});var Ea="",Ea="",G=Ea+"ui-state-default",ka=Ea+"css_right ui-icon ui-icon-",Yb=Ea+"fg-toolbar ui-toolbar ui-widget-header ui-helper-clearfix";h.extend(m.ext.oJUIClasses,m.ext.classes,{sPageButton:"fg-button ui-button "+G,sPageButtonActive:"ui-state-disabled",sPageButtonDisabled:"ui-state-disabled",sPaging:"dataTables_paginate fg-buttonset ui-buttonset fg-buttonset-multi ui-buttonset-multi paging_",sSortAsc:G+" sorting_asc",
sSortDesc:G+" sorting_desc",sSortable:G+" sorting",sSortableAsc:G+" sorting_asc_disabled",sSortableDesc:G+" sorting_desc_disabled",sSortableNone:G+" sorting_disabled",sSortJUIAsc:ka+"triangle-1-n",sSortJUIDesc:ka+"triangle-1-s",sSortJUI:ka+"carat-2-n-s",sSortJUIAscAllowed:ka+"carat-1-n",sSortJUIDescAllowed:ka+"carat-1-s",sSortJUIWrapper:"DataTables_sort_wrapper",sSortIcon:"DataTables_sort_icon",sScrollHead:"dataTables_scrollHead "+G,sScrollFoot:"dataTables_scrollFoot "+G,sHeaderTH:G,sFooterTH:G,sJUIHeader:Yb+
" ui-corner-tl ui-corner-tr",sJUIFooter:Yb+" ui-corner-bl ui-corner-br"});var Nb=m.ext.pager;h.extend(Nb,{simple:function(){return["previous","next"]},full:function(){return["first","previous","next","last"]},numbers:function(a,b){return[ia(a,b)]},simple_numbers:function(a,b){return["previous",ia(a,b),"next"]},full_numbers:function(a,b){return["first","previous",ia(a,b),"next","last"]},first_last_numbers:function(a,b){return["first",ia(a,b),"last"]},_numbers:ia,numbers_length:7});h.extend(!0,m.ext.renderer,
{pageButton:{_:function(a,b,c,d,e,f){var g=a.oClasses,j=a.oLanguage.oPaginate,i=a.oLanguage.oAria.paginate||{},m,l,p=0,r=function(b,d){var k,t,u,s,v=function(b){Va(a,b.data.action,true)};k=0;for(t=d.length;k<t;k++){s=d[k];if(h.isArray(s)){u=h("<"+(s.DT_el||"div")+"/>").appendTo(b);r(u,s)}else{m=null;l="";switch(s){case "ellipsis":b.append('<span class="ellipsis">&#x2026;</span>');break;case "first":m=j.sFirst;l=s+(e>0?"":" "+g.sPageButtonDisabled);break;case "previous":m=j.sPrevious;l=s+(e>0?"":" "+
g.sPageButtonDisabled);break;case "next":m=j.sNext;l=s+(e<f-1?"":" "+g.sPageButtonDisabled);break;case "last":m=j.sLast;l=s+(e<f-1?"":" "+g.sPageButtonDisabled);break;default:m=s+1;l=e===s?g.sPageButtonActive:""}if(m!==null){u=h("<a>",{"class":g.sPageButton+" "+l,"aria-controls":a.sTableId,"aria-label":i[s],"data-dt-idx":p,tabindex:a.iTabIndex,id:c===0&&typeof s==="string"?a.sTableId+"_"+s:null}).html(m).appendTo(b);Ya(u,{action:s},v);p++}}}},t;try{t=h(b).find(H.activeElement).data("dt-idx")}catch(u){}r(h(b).empty(),
d);t!==k&&h(b).find("[data-dt-idx="+t+"]").focus()}}});h.extend(m.ext.type.detect,[function(a,b){var c=b.oLanguage.sDecimal;return ab(a,c)?"num"+c:null},function(a){if(a&&!(a instanceof Date)&&!cc.test(a))return null;var b=Date.parse(a);return null!==b&&!isNaN(b)||M(a)?"date":null},function(a,b){var c=b.oLanguage.sDecimal;return ab(a,c,!0)?"num-fmt"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Sb(a,c)?"html-num"+c:null},function(a,b){var c=b.oLanguage.sDecimal;return Sb(a,c,!0)?"html-num-fmt"+
c:null},function(a){return M(a)||"string"===typeof a&&-1!==a.indexOf("<")?"html":null}]);h.extend(m.ext.type.search,{html:function(a){return M(a)?a:"string"===typeof a?a.replace(Pb," ").replace(Ca,""):""},string:function(a){return M(a)?a:"string"===typeof a?a.replace(Pb," "):a}});var Ba=function(a,b,c,d){if(0!==a&&(!a||"-"===a))return-Infinity;b&&(a=Rb(a,b));a.replace&&(c&&(a=a.replace(c,"")),d&&(a=a.replace(d,"")));return 1*a};h.extend(x.type.order,{"date-pre":function(a){return Date.parse(a)||-Infinity},
"html-pre":function(a){return M(a)?"":a.replace?a.replace(/<.*?>/g,"").toLowerCase():a+""},"string-pre":function(a){return M(a)?"":"string"===typeof a?a.toLowerCase():!a.toString?"":a.toString()},"string-asc":function(a,b){return a<b?-1:a>b?1:0},"string-desc":function(a,b){return a<b?1:a>b?-1:0}});fb("");h.extend(!0,m.ext.renderer,{header:{_:function(a,b,c,d){h(a.nTable).on("order.dt.DT",function(e,f,g,h){if(a===f){e=c.idx;b.removeClass(c.sSortingClass+" "+d.sSortAsc+" "+d.sSortDesc).addClass(h[e]==
"asc"?d.sSortAsc:h[e]=="desc"?d.sSortDesc:c.sSortingClass)}})},jqueryui:function(a,b,c,d){h("<div/>").addClass(d.sSortJUIWrapper).append(b.contents()).append(h("<span/>").addClass(d.sSortIcon+" "+c.sSortingClassJUI)).appendTo(b);h(a.nTable).on("order.dt.DT",function(e,f,g,h){if(a===f){e=c.idx;b.removeClass(d.sSortAsc+" "+d.sSortDesc).addClass(h[e]=="asc"?d.sSortAsc:h[e]=="desc"?d.sSortDesc:c.sSortingClass);b.find("span."+d.sSortIcon).removeClass(d.sSortJUIAsc+" "+d.sSortJUIDesc+" "+d.sSortJUI+" "+
d.sSortJUIAscAllowed+" "+d.sSortJUIDescAllowed).addClass(h[e]=="asc"?d.sSortJUIAsc:h[e]=="desc"?d.sSortJUIDesc:c.sSortingClassJUI)}})}}});var Zb=function(a){return"string"===typeof a?a.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;"):a};m.render={number:function(a,b,c,d,e){return{display:function(f){if("number"!==typeof f&&"string"!==typeof f)return f;var g=0>f?"-":"",h=parseFloat(f);if(isNaN(h))return Zb(f);h=h.toFixed(c);f=Math.abs(h);h=parseInt(f,10);f=c?b+(f-h).toFixed(c).substring(2):
"";return g+(d||"")+h.toString().replace(/\B(?=(\d{3})+(?!\d))/g,a)+f+(e||"")}}},text:function(){return{display:Zb}}};h.extend(m.ext.internal,{_fnExternApiFunc:Ob,_fnBuildAjax:ua,_fnAjaxUpdate:nb,_fnAjaxParameters:wb,_fnAjaxUpdateDraw:xb,_fnAjaxDataSrc:va,_fnAddColumn:Ga,_fnColumnOptions:la,_fnAdjustColumnSizing:Z,_fnVisibleToColumnIndex:$,_fnColumnIndexToVisible:aa,_fnVisbleColumns:ba,_fnGetColumns:na,_fnColumnTypes:Ia,_fnApplyColumnDefs:kb,_fnHungarianMap:Y,_fnCamelToHungarian:J,_fnLanguageCompat:Fa,
_fnBrowserDetect:ib,_fnAddData:N,_fnAddTr:oa,_fnNodeToDataIndex:function(a,b){return b._DT_RowIndex!==k?b._DT_RowIndex:null},_fnNodeToColumnIndex:function(a,b,c){return h.inArray(c,a.aoData[b].anCells)},_fnGetCellData:B,_fnSetCellData:lb,_fnSplitObjNotation:La,_fnGetObjectDataFn:R,_fnSetObjectDataFn:S,_fnGetDataMaster:Ma,_fnClearTable:pa,_fnDeleteIndex:qa,_fnInvalidate:da,_fnGetRowElements:Ka,_fnCreateTr:Ja,_fnBuildHead:mb,_fnDrawHead:fa,_fnDraw:O,_fnReDraw:T,_fnAddOptionsHtml:pb,_fnDetectHeader:ea,
_fnGetUniqueThs:ta,_fnFeatureHtmlFilter:rb,_fnFilterComplete:ga,_fnFilterCustom:Ab,_fnFilterColumn:zb,_fnFilter:yb,_fnFilterCreateSearch:Ra,_fnEscapeRegex:Sa,_fnFilterData:Bb,_fnFeatureHtmlInfo:ub,_fnUpdateInfo:Eb,_fnInfoMacros:Fb,_fnInitialise:ha,_fnInitComplete:wa,_fnLengthChange:Ta,_fnFeatureHtmlLength:qb,_fnFeatureHtmlPaginate:vb,_fnPageChange:Va,_fnFeatureHtmlProcessing:sb,_fnProcessingDisplay:C,_fnFeatureHtmlTable:tb,_fnScrollDraw:ma,_fnApplyToChildren:I,_fnCalculateColumnWidths:Ha,_fnThrottle:Qa,
_fnConvertToWidth:Gb,_fnGetWidestNode:Hb,_fnGetMaxLenString:Ib,_fnStringToCss:v,_fnSortFlatten:W,_fnSort:ob,_fnSortAria:Kb,_fnSortListener:Xa,_fnSortAttachListener:Oa,_fnSortingClasses:ya,_fnSortData:Jb,_fnSaveState:za,_fnLoadState:Lb,_fnSettingsFromNode:Aa,_fnLog:K,_fnMap:F,_fnBindAction:Ya,_fnCallbackReg:z,_fnCallbackFire:s,_fnLengthOverflow:Ua,_fnRenderer:Pa,_fnDataSource:y,_fnRowAttributes:Na,_fnCalculateEnd:function(){}});h.fn.dataTable=m;m.$=h;h.fn.dataTableSettings=m.settings;h.fn.dataTableExt=
m.ext;h.fn.DataTable=function(a){return h(this).dataTable(a).api()};h.each(m,function(a,b){h.fn.DataTable[a]=b});return h.fn.dataTable});

/*!
 DataTables Bootstrap 3 integration
 ©2011-2015 SpryMedia Ltd - datatables.net/license
*/
(function(b){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(a){return b(a,window,document)}):"object"===typeof exports?module.exports=function(a,d){a||(a=window);if(!d||!d.fn.dataTable)d=require("datatables.net")(a,d).$;return b(d,a,a.document)}:b(jQuery,window,document)})(function(b,a,d,m){var f=b.fn.dataTable;b.extend(!0,f.defaults,{dom:"<'row'<'col-sm-6'l><'col-sm-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>",renderer:"bootstrap"});b.extend(f.ext.classes,
{sWrapper:"dataTables_wrapper form-inline dt-bootstrap",sFilterInput:"form-control input-sm",sLengthSelect:"form-control input-sm",sProcessing:"dataTables_processing panel panel-default"});f.ext.renderer.pageButton.bootstrap=function(a,h,r,s,j,n){var o=new f.Api(a),t=a.oClasses,k=a.oLanguage.oPaginate,u=a.oLanguage.oAria.paginate||{},e,g,p=0,q=function(d,f){var l,h,i,c,m=function(a){a.preventDefault();!b(a.currentTarget).hasClass("disabled")&&o.page()!=a.data.action&&o.page(a.data.action).draw("page")};
l=0;for(h=f.length;l<h;l++)if(c=f[l],b.isArray(c))q(d,c);else{g=e="";switch(c){case "ellipsis":e="&#x2026;";g="disabled";break;case "first":e=k.sFirst;g=c+(0<j?"":" disabled");break;case "previous":e=k.sPrevious;g=c+(0<j?"":" disabled");break;case "next":e=k.sNext;g=c+(j<n-1?"":" disabled");break;case "last":e=k.sLast;g=c+(j<n-1?"":" disabled");break;default:e=c+1,g=j===c?"active":""}e&&(i=b("<li>",{"class":t.sPageButton+" "+g,id:0===r&&"string"===typeof c?a.sTableId+"_"+c:null}).append(b("<a>",{href:"#",
"aria-controls":a.sTableId,"aria-label":u[c],"data-dt-idx":p,tabindex:a.iTabIndex}).html(e)).appendTo(d),a.oApi._fnBindAction(i,{action:c},m),p++)}},i;try{i=b(h).find(d.activeElement).data("dt-idx")}catch(v){}q(b(h).empty().html('<ul class="pagination"/>').children("ul"),s);i!==m&&b(h).find("[data-dt-idx="+i+"]").focus()};return f});

/*!
 FixedColumns 3.2.2
 ©2010-2016 SpryMedia Ltd - datatables.net/license
*/
(function(d){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(q){return d(q,window,document)}):"object"===typeof exports?module.exports=function(q,r){q||(q=window);if(!r||!r.fn.dataTable)r=require("datatables.net")(q,r).$;return d(r,q,q.document)}:d(jQuery,window,document)})(function(d,q,r,t){var s=d.fn.dataTable,u,m=function(a,b){var c=this;if(this instanceof m){if(b===t||!0===b)b={};var e=d.fn.dataTable.camelToHungarian;e&&(e(m.defaults,m.defaults,!0),e(m.defaults,
b));e=(new d.fn.dataTable.Api(a)).settings()[0];this.s={dt:e,iTableColumns:e.aoColumns.length,aiOuterWidths:[],aiInnerWidths:[],rtl:"rtl"===d(e.nTable).css("direction")};this.dom={scroller:null,header:null,body:null,footer:null,grid:{wrapper:null,dt:null,left:{wrapper:null,head:null,body:null,foot:null},right:{wrapper:null,head:null,body:null,foot:null}},clone:{left:{header:null,body:null,footer:null},right:{header:null,body:null,footer:null}}};if(e._oFixedColumns)throw"FixedColumns already initialised on this table";
e._oFixedColumns=this;e._bInitComplete?this._fnConstruct(b):e.oApi._fnCallbackReg(e,"aoInitComplete",function(){c._fnConstruct(b)},"FixedColumns")}else alert("FixedColumns warning: FixedColumns must be initialised with the 'new' keyword.")};d.extend(m.prototype,{fnUpdate:function(){this._fnDraw(!0)},fnRedrawLayout:function(){this._fnColCalc();this._fnGridLayout();this.fnUpdate()},fnRecalculateHeight:function(a){delete a._DTTC_iHeight;a.style.height="auto"},fnSetRowHeight:function(a,b){a.style.height=
b+"px"},fnGetPosition:function(a){var b=this.s.dt.oInstance;if(d(a).parents(".DTFC_Cloned").length){if("tr"===a.nodeName.toLowerCase())return a=d(a).index(),b.fnGetPosition(d("tr",this.s.dt.nTBody)[a]);var c=d(a).index(),a=d(a.parentNode).index();return[b.fnGetPosition(d("tr",this.s.dt.nTBody)[a]),c,b.oApi._fnVisibleToColumnIndex(this.s.dt,c)]}return b.fnGetPosition(a)},_fnConstruct:function(a){var b=this;if("function"!=typeof this.s.dt.oInstance.fnVersionCheck||!0!==this.s.dt.oInstance.fnVersionCheck("1.8.0"))alert("FixedColumns "+
m.VERSION+" required DataTables 1.8.0 or later. Please upgrade your DataTables installation");else if(""===this.s.dt.oScroll.sX)this.s.dt.oInstance.oApi._fnLog(this.s.dt,1,"FixedColumns is not needed (no x-scrolling in DataTables enabled), so no action will be taken. Use 'FixedHeader' for column fixing when scrolling is not enabled");else{this.s=d.extend(!0,this.s,m.defaults,a);a=this.s.dt.oClasses;this.dom.grid.dt=d(this.s.dt.nTable).parents("div."+a.sScrollWrapper)[0];this.dom.scroller=d("div."+
a.sScrollBody,this.dom.grid.dt)[0];this._fnColCalc();this._fnGridSetup();var c,e=!1;d(this.s.dt.nTableWrapper).on("mousedown.DTFC",function(){e=!0;d(r).one("mouseup",function(){e=!1})});d(this.dom.scroller).on("mouseover.DTFC touchstart.DTFC",function(){e||(c="main")}).on("scroll.DTFC",function(a){!c&&a.originalEvent&&(c="main");if("main"===c&&(0<b.s.iLeftColumns&&(b.dom.grid.left.liner.scrollTop=b.dom.scroller.scrollTop),0<b.s.iRightColumns))b.dom.grid.right.liner.scrollTop=b.dom.scroller.scrollTop});
var f="onwheel"in r.createElement("div")?"wheel.DTFC":"mousewheel.DTFC";if(0<b.s.iLeftColumns)d(b.dom.grid.left.liner).on("mouseover.DTFC touchstart.DTFC",function(){e||(c="left")}).on("scroll.DTFC",function(a){!c&&a.originalEvent&&(c="left");"left"===c&&(b.dom.scroller.scrollTop=b.dom.grid.left.liner.scrollTop,0<b.s.iRightColumns&&(b.dom.grid.right.liner.scrollTop=b.dom.grid.left.liner.scrollTop))}).on(f,function(a){b.dom.scroller.scrollLeft-="wheel"===a.type?-a.originalEvent.deltaX:a.originalEvent.wheelDeltaX});
if(0<b.s.iRightColumns)d(b.dom.grid.right.liner).on("mouseover.DTFC touchstart.DTFC",function(){e||(c="right")}).on("scroll.DTFC",function(a){!c&&a.originalEvent&&(c="right");"right"===c&&(b.dom.scroller.scrollTop=b.dom.grid.right.liner.scrollTop,0<b.s.iLeftColumns&&(b.dom.grid.left.liner.scrollTop=b.dom.grid.right.liner.scrollTop))}).on(f,function(a){b.dom.scroller.scrollLeft-="wheel"===a.type?-a.originalEvent.deltaX:a.originalEvent.wheelDeltaX});d(q).on("resize.DTFC",function(){b._fnGridLayout.call(b)});
var g=!0,h=d(this.s.dt.nTable);h.on("draw.dt.DTFC",function(){b._fnColCalc();b._fnDraw.call(b,g);g=!1}).on("column-sizing.dt.DTFC",function(){b._fnColCalc();b._fnGridLayout(b)}).on("column-visibility.dt.DTFC",function(a,c,d,e,f){if(f===t||f)b._fnColCalc(),b._fnGridLayout(b),b._fnDraw(!0)}).on("select.dt.DTFC deselect.dt.DTFC",function(a){"dt"===a.namespace&&b._fnDraw(!1)}).on("destroy.dt.DTFC",function(){h.off(".DTFC");d(b.dom.scroller).off(".DTFC");d(q).off(".DTFC");d(b.s.dt.nTableWrapper).off(".DTFC");
d(b.dom.grid.left.liner).off(".DTFC "+f);d(b.dom.grid.left.wrapper).remove();d(b.dom.grid.right.liner).off(".DTFC "+f);d(b.dom.grid.right.wrapper).remove()});this._fnGridLayout();this.s.dt.oInstance.fnDraw(!1)}},_fnColCalc:function(){var a=this,b=0,c=0;this.s.aiInnerWidths=[];this.s.aiOuterWidths=[];d.each(this.s.dt.aoColumns,function(e,f){var g=d(f.nTh),h;if(g.filter(":visible").length){var i=g.outerWidth();0===a.s.aiOuterWidths.length&&(h=d(a.s.dt.nTable).css("border-left-width"),i+="string"===
typeof h?1:parseInt(h,10));a.s.aiOuterWidths.length===a.s.dt.aoColumns.length-1&&(h=d(a.s.dt.nTable).css("border-right-width"),i+="string"===typeof h?1:parseInt(h,10));a.s.aiOuterWidths.push(i);a.s.aiInnerWidths.push(g.width());e<a.s.iLeftColumns&&(b+=i);a.s.iTableColumns-a.s.iRightColumns<=e&&(c+=i)}else a.s.aiInnerWidths.push(0),a.s.aiOuterWidths.push(0)});this.s.iLeftWidth=b;this.s.iRightWidth=c},_fnGridSetup:function(){var a=this._fnDTOverflow(),b;this.dom.body=this.s.dt.nTable;this.dom.header=
this.s.dt.nTHead.parentNode;this.dom.header.parentNode.parentNode.style.position="relative";var c=d('<div class="DTFC_ScrollWrapper" style="position:relative; clear:both;"><div class="DTFC_LeftWrapper" style="position:absolute; top:0; left:0;"><div class="DTFC_LeftHeadWrapper" style="position:relative; top:0; left:0; overflow:hidden;"></div><div class="DTFC_LeftBodyWrapper" style="position:relative; top:0; left:0; overflow:hidden;"><div class="DTFC_LeftBodyLiner" style="position:relative; top:0; left:0; overflow-y:scroll;"></div></div><div class="DTFC_LeftFootWrapper" style="position:relative; top:0; left:0; overflow:hidden;"></div></div><div class="DTFC_RightWrapper" style="position:absolute; top:0; right:0;"><div class="DTFC_RightHeadWrapper" style="position:relative; top:0; left:0;"><div class="DTFC_RightHeadBlocker DTFC_Blocker" style="position:absolute; top:0; bottom:0;"></div></div><div class="DTFC_RightBodyWrapper" style="position:relative; top:0; left:0; overflow:hidden;"><div class="DTFC_RightBodyLiner" style="position:relative; top:0; left:0; overflow-y:scroll;"></div></div><div class="DTFC_RightFootWrapper" style="position:relative; top:0; left:0;"><div class="DTFC_RightFootBlocker DTFC_Blocker" style="position:absolute; top:0; bottom:0;"></div></div></div></div>')[0],
e=c.childNodes[0],f=c.childNodes[1];this.dom.grid.dt.parentNode.insertBefore(c,this.dom.grid.dt);c.appendChild(this.dom.grid.dt);this.dom.grid.wrapper=c;0<this.s.iLeftColumns&&(this.dom.grid.left.wrapper=e,this.dom.grid.left.head=e.childNodes[0],this.dom.grid.left.body=e.childNodes[1],this.dom.grid.left.liner=d("div.DTFC_LeftBodyLiner",c)[0],c.appendChild(e));0<this.s.iRightColumns&&(this.dom.grid.right.wrapper=f,this.dom.grid.right.head=f.childNodes[0],this.dom.grid.right.body=f.childNodes[1],this.dom.grid.right.liner=
d("div.DTFC_RightBodyLiner",c)[0],f.style.right=a.bar+"px",b=d("div.DTFC_RightHeadBlocker",c)[0],b.style.width=a.bar+"px",b.style.right=-a.bar+"px",this.dom.grid.right.headBlock=b,b=d("div.DTFC_RightFootBlocker",c)[0],b.style.width=a.bar+"px",b.style.right=-a.bar+"px",this.dom.grid.right.footBlock=b,c.appendChild(f));if(this.s.dt.nTFoot&&(this.dom.footer=this.s.dt.nTFoot.parentNode,0<this.s.iLeftColumns&&(this.dom.grid.left.foot=e.childNodes[2]),0<this.s.iRightColumns))this.dom.grid.right.foot=f.childNodes[2];
this.s.rtl&&d("div.DTFC_RightHeadBlocker",c).css({left:-a.bar+"px",right:""})},_fnGridLayout:function(){var a=this,b=this.dom.grid;d(b.wrapper).width();var c=d(this.s.dt.nTable.parentNode).outerHeight(),e=d(this.s.dt.nTable.parentNode.parentNode).outerHeight(),f=this._fnDTOverflow(),g=this.s.iLeftWidth,h=this.s.iRightWidth,i="rtl"===d(this.dom.body).css("direction"),j=function(b,c){f.bar?a._firefoxScrollError()?34<d(b).height()&&(b.style.width=c+f.bar+"px"):b.style.width=c+f.bar+"px":(b.style.width=
c+20+"px",b.style.paddingRight="20px",b.style.boxSizing="border-box")};f.x&&(c-=f.bar);b.wrapper.style.height=e+"px";0<this.s.iLeftColumns&&(e=b.left.wrapper,e.style.width=g+"px",e.style.height="1px",i?(e.style.left="",e.style.right=0):(e.style.left=0,e.style.right=""),b.left.body.style.height=c+"px",b.left.foot&&(b.left.foot.style.top=(f.x?f.bar:0)+"px"),j(b.left.liner,g),b.left.liner.style.height=c+"px");0<this.s.iRightColumns&&(e=b.right.wrapper,e.style.width=h+"px",e.style.height="1px",this.s.rtl?
(e.style.left=f.y?f.bar+"px":0,e.style.right=""):(e.style.left="",e.style.right=f.y?f.bar+"px":0),b.right.body.style.height=c+"px",b.right.foot&&(b.right.foot.style.top=(f.x?f.bar:0)+"px"),j(b.right.liner,h),b.right.liner.style.height=c+"px",b.right.headBlock.style.display=f.y?"block":"none",b.right.footBlock.style.display=f.y?"block":"none")},_fnDTOverflow:function(){var a=this.s.dt.nTable,b=a.parentNode,c={x:!1,y:!1,bar:this.s.dt.oScroll.iBarWidth};a.offsetWidth>b.clientWidth&&(c.x=!0);a.offsetHeight>
b.clientHeight&&(c.y=!0);return c},_fnDraw:function(a){this._fnGridLayout();this._fnCloneLeft(a);this._fnCloneRight(a);null!==this.s.fnDrawCallback&&this.s.fnDrawCallback.call(this,this.dom.clone.left,this.dom.clone.right);d(this).trigger("draw.dtfc",{leftClone:this.dom.clone.left,rightClone:this.dom.clone.right})},_fnCloneRight:function(a){if(!(0>=this.s.iRightColumns)){var b,c=[];for(b=this.s.iTableColumns-this.s.iRightColumns;b<this.s.iTableColumns;b++)this.s.dt.aoColumns[b].bVisible&&c.push(b);
this._fnClone(this.dom.clone.right,this.dom.grid.right,c,a)}},_fnCloneLeft:function(a){if(!(0>=this.s.iLeftColumns)){var b,c=[];for(b=0;b<this.s.iLeftColumns;b++)this.s.dt.aoColumns[b].bVisible&&c.push(b);this._fnClone(this.dom.clone.left,this.dom.grid.left,c,a)}},_fnCopyLayout:function(a,b,c){for(var e=[],f=[],g=[],h=0,i=a.length;h<i;h++){var j=[];j.nTr=d(a[h].nTr).clone(c,!1)[0];for(var l=0,o=this.s.iTableColumns;l<o;l++)if(-1!==d.inArray(l,b)){var p=d.inArray(a[h][l].cell,g);-1===p?(p=d(a[h][l].cell).clone(c,
!1)[0],f.push(p),g.push(a[h][l].cell),j.push({cell:p,unique:a[h][l].unique})):j.push({cell:f[p],unique:a[h][l].unique})}e.push(j)}return e},_fnClone:function(a,b,c,e){var f=this,g,h,i,j,l,o,p,n,m,k=this.s.dt;if(e){d(a.header).remove();a.header=d(this.dom.header).clone(!0,!1)[0];a.header.className+=" DTFC_Cloned";a.header.style.width="100%";b.head.appendChild(a.header);n=this._fnCopyLayout(k.aoHeader,c,!0);j=d(">thead",a.header);j.empty();g=0;for(h=n.length;g<h;g++)j[0].appendChild(n[g].nTr);k.oApi._fnDrawHead(k,
n,!0)}else{n=this._fnCopyLayout(k.aoHeader,c,!1);m=[];k.oApi._fnDetectHeader(m,d(">thead",a.header)[0]);g=0;for(h=n.length;g<h;g++){i=0;for(j=n[g].length;i<j;i++)m[g][i].cell.className=n[g][i].cell.className,d("span.DataTables_sort_icon",m[g][i].cell).each(function(){this.className=d("span.DataTables_sort_icon",n[g][i].cell)[0].className})}}this._fnEqualiseHeights("thead",this.dom.header,a.header);"auto"==this.s.sHeightMatch&&d(">tbody>tr",f.dom.body).css("height","auto");null!==a.body&&(d(a.body).remove(),
a.body=null);a.body=d(this.dom.body).clone(!0)[0];a.body.className+=" DTFC_Cloned";a.body.style.paddingBottom=k.oScroll.iBarWidth+"px";a.body.style.marginBottom=2*k.oScroll.iBarWidth+"px";null!==a.body.getAttribute("id")&&a.body.removeAttribute("id");d(">thead>tr",a.body).empty();d(">tfoot",a.body).remove();var q=d("tbody",a.body)[0];d(q).empty();if(0<k.aiDisplay.length){h=d(">thead>tr",a.body)[0];for(p=0;p<c.length;p++)l=c[p],o=d(k.aoColumns[l].nTh).clone(!0)[0],o.innerHTML="",j=o.style,j.paddingTop=
"0",j.paddingBottom="0",j.borderTopWidth="0",j.borderBottomWidth="0",j.height=0,j.width=f.s.aiInnerWidths[l]+"px",h.appendChild(o);d(">tbody>tr",f.dom.body).each(function(a){var a=f.s.dt.oFeatures.bServerSide===false?f.s.dt.aiDisplay[f.s.dt._iDisplayStart+a]:a,b=f.s.dt.aoData[a].anCells||d(this).children("td, th"),e=this.cloneNode(false);e.removeAttribute("id");e.setAttribute("data-dt-row",a);for(p=0;p<c.length;p++){l=c[p];if(b.length>0){o=d(b[l]).clone(true,true)[0];o.setAttribute("data-dt-row",
a);o.setAttribute("data-dt-column",p);e.appendChild(o)}}q.appendChild(e)})}else d(">tbody>tr",f.dom.body).each(function(){o=this.cloneNode(true);o.className=o.className+" DTFC_NoData";d("td",o).html("");q.appendChild(o)});a.body.style.width="100%";a.body.style.margin="0";a.body.style.padding="0";k.oScroller!==t&&(h=k.oScroller.dom.force,b.forcer?b.forcer.style.height=h.style.height:(b.forcer=h.cloneNode(!0),b.liner.appendChild(b.forcer)));b.liner.appendChild(a.body);this._fnEqualiseHeights("tbody",
f.dom.body,a.body);if(null!==k.nTFoot){if(e){null!==a.footer&&a.footer.parentNode.removeChild(a.footer);a.footer=d(this.dom.footer).clone(!0,!0)[0];a.footer.className+=" DTFC_Cloned";a.footer.style.width="100%";b.foot.appendChild(a.footer);n=this._fnCopyLayout(k.aoFooter,c,!0);b=d(">tfoot",a.footer);b.empty();g=0;for(h=n.length;g<h;g++)b[0].appendChild(n[g].nTr);k.oApi._fnDrawHead(k,n,!0)}else{n=this._fnCopyLayout(k.aoFooter,c,!1);b=[];k.oApi._fnDetectHeader(b,d(">tfoot",a.footer)[0]);g=0;for(h=n.length;g<
h;g++){i=0;for(j=n[g].length;i<j;i++)b[g][i].cell.className=n[g][i].cell.className}}this._fnEqualiseHeights("tfoot",this.dom.footer,a.footer)}b=k.oApi._fnGetUniqueThs(k,d(">thead",a.header)[0]);d(b).each(function(a){l=c[a];this.style.width=f.s.aiInnerWidths[l]+"px"});null!==f.s.dt.nTFoot&&(b=k.oApi._fnGetUniqueThs(k,d(">tfoot",a.footer)[0]),d(b).each(function(a){l=c[a];this.style.width=f.s.aiInnerWidths[l]+"px"}))},_fnGetTrNodes:function(a){for(var b=[],c=0,d=a.childNodes.length;c<d;c++)"TR"==a.childNodes[c].nodeName.toUpperCase()&&
b.push(a.childNodes[c]);return b},_fnEqualiseHeights:function(a,b,c){if(!("none"==this.s.sHeightMatch&&"thead"!==a&&"tfoot"!==a)){var e,f,g=b.getElementsByTagName(a)[0],c=c.getElementsByTagName(a)[0],a=d(">"+a+">tr:eq(0)",b).children(":first");a.outerHeight();a.height();for(var g=this._fnGetTrNodes(g),b=this._fnGetTrNodes(c),h=[],c=0,a=b.length;c<a;c++)e=g[c].offsetHeight,f=b[c].offsetHeight,e=f>e?f:e,"semiauto"==this.s.sHeightMatch&&(g[c]._DTTC_iHeight=e),h.push(e);c=0;for(a=b.length;c<a;c++)b[c].style.height=
h[c]+"px",g[c].style.height=h[c]+"px"}},_firefoxScrollError:function(){if(u===t){var a=d("<div/>").css({position:"absolute",top:0,left:0,height:10,width:50,overflow:"scroll"}).appendTo("body");u=a[0].clientWidth===a[0].offsetWidth&&0!==this._fnDTOverflow().bar;a.remove()}return u}});m.defaults={iLeftColumns:1,iRightColumns:0,fnDrawCallback:null,sHeightMatch:"semiauto"};m.version="3.2.2";s.Api.register("fixedColumns()",function(){return this});s.Api.register("fixedColumns().update()",function(){return this.iterator("table",
function(a){a._oFixedColumns&&a._oFixedColumns.fnUpdate()})});s.Api.register("fixedColumns().relayout()",function(){return this.iterator("table",function(a){a._oFixedColumns&&a._oFixedColumns.fnRedrawLayout()})});s.Api.register("rows().recalcHeight()",function(){return this.iterator("row",function(a,b){a._oFixedColumns&&a._oFixedColumns.fnRecalculateHeight(this.row(b).node())})});s.Api.register("fixedColumns().rowIndex()",function(a){a=d(a);return a.parents(".DTFC_Cloned").length?this.rows({page:"current"}).indexes()[a.index()]:
this.row(a).index()});s.Api.register("fixedColumns().cellIndex()",function(a){a=d(a);if(a.parents(".DTFC_Cloned").length){var b=a.parent().index(),b=this.rows({page:"current"}).indexes()[b],a=a.parents(".DTFC_LeftWrapper").length?a.index():this.columns().flatten().length-this.context[0]._oFixedColumns.s.iRightColumns+a.index();return{row:b,column:this.column.index("toData",a),columnVisible:a}}return this.cell(a).index()});d(r).on("init.dt.fixedColumns",function(a,b){if("dt"===a.namespace){var c=b.oInit.fixedColumns,
e=s.defaults.fixedColumns;if(c||e)e=d.extend({},c,e),!1!==c&&new m(b,e)}});d.fn.dataTable.FixedColumns=m;return d.fn.DataTable.FixedColumns=m});

/*!
 FixedHeader 3.1.2
 ©2009-2016 SpryMedia Ltd - datatables.net/license
*/
(function(d){"function"===typeof define&&define.amd?define(["jquery","datatables.net"],function(g){return d(g,window,document)}):"object"===typeof exports?module.exports=function(g,h){g||(g=window);if(!h||!h.fn.dataTable)h=require("datatables.net")(g,h).$;return d(h,g,g.document)}:d(jQuery,window,document)})(function(d,g,h,k){var j=d.fn.dataTable,l=0,i=function(b,a){if(!(this instanceof i))throw"FixedHeader must be initialised with the 'new' keyword.";!0===a&&(a={});b=new j.Api(b);this.c=d.extend(!0,
{},i.defaults,a);this.s={dt:b,position:{theadTop:0,tbodyTop:0,tfootTop:0,tfootBottom:0,width:0,left:0,tfootHeight:0,theadHeight:0,windowHeight:d(g).height(),visible:!0},headerMode:null,footerMode:null,autoWidth:b.settings()[0].oFeatures.bAutoWidth,namespace:".dtfc"+l++,scrollLeft:{header:-1,footer:-1},enable:!0};this.dom={floatingHeader:null,thead:d(b.table().header()),tbody:d(b.table().body()),tfoot:d(b.table().footer()),header:{host:null,floating:null,placeholder:null},footer:{host:null,floating:null,
placeholder:null}};this.dom.header.host=this.dom.thead.parent();this.dom.footer.host=this.dom.tfoot.parent();var e=b.settings()[0];if(e._fixedHeader)throw"FixedHeader already initialised on table "+e.nTable.id;e._fixedHeader=this;this._constructor()};d.extend(i.prototype,{enable:function(b){this.s.enable=b;this.c.header&&this._modeChange("in-place","header",!0);this.c.footer&&this.dom.tfoot.length&&this._modeChange("in-place","footer",!0);this.update()},headerOffset:function(b){b!==k&&(this.c.headerOffset=
b,this.update());return this.c.headerOffset},footerOffset:function(b){b!==k&&(this.c.footerOffset=b,this.update());return this.c.footerOffset},update:function(){this._positions();this._scroll(!0)},_constructor:function(){var b=this,a=this.s.dt;d(g).on("scroll"+this.s.namespace,function(){b._scroll()}).on("resize"+this.s.namespace,function(){b.s.position.windowHeight=d(g).height();b.update()});var e=d(".fh-fixedHeader");!this.c.headerOffset&&e.length&&(this.c.headerOffset=e.outerHeight());e=d(".fh-fixedFooter");
!this.c.footerOffset&&e.length&&(this.c.footerOffset=e.outerHeight());a.on("column-reorder.dt.dtfc column-visibility.dt.dtfc draw.dt.dtfc column-sizing.dt.dtfc",function(){b.update()});a.on("destroy.dtfc",function(){a.off(".dtfc");d(g).off(b.s.namespace)});this._positions();this._scroll()},_clone:function(b,a){var e=this.s.dt,c=this.dom[b],f="header"===b?this.dom.thead:this.dom.tfoot;!a&&c.floating?c.floating.removeClass("fixedHeader-floating fixedHeader-locked"):(c.floating&&(c.placeholder.remove(),
this._unsize(b),c.floating.children().detach(),c.floating.remove()),c.floating=d(e.table().node().cloneNode(!1)).css("table-layout","fixed").removeAttr("id").append(f).appendTo("body"),c.placeholder=f.clone(!1),c.host.prepend(c.placeholder),this._matchWidths(c.placeholder,c.floating))},_matchWidths:function(b,a){var e=function(a){return d(a,b).map(function(){return d(this).width()}).toArray()},c=function(b,c){d(b,a).each(function(a){d(this).css({width:c[a],minWidth:c[a]})})},f=e("th"),e=e("td");c("th",
f);c("td",e)},_unsize:function(b){var a=this.dom[b].floating;a&&("footer"===b||"header"===b&&!this.s.autoWidth)?d("th, td",a).css({width:"",minWidth:""}):a&&"header"===b&&d("th, td",a).css("min-width","")},_horizontal:function(b,a){var e=this.dom[b],c=this.s.position,d=this.s.scrollLeft;e.floating&&d[b]!==a&&(e.floating.css("left",c.left-a),d[b]=a)},_modeChange:function(b,a,e){var c=this.dom[a],f=this.s.position,g=d.contains(this.dom["footer"===a?"tfoot":"thead"][0],h.activeElement)?h.activeElement:
null;if("in-place"===b){if(c.placeholder&&(c.placeholder.remove(),c.placeholder=null),this._unsize(a),"header"===a?c.host.prepend(this.dom.thead):c.host.append(this.dom.tfoot),c.floating)c.floating.remove(),c.floating=null}else"in"===b?(this._clone(a,e),c.floating.addClass("fixedHeader-floating").css("header"===a?"top":"bottom",this.c[a+"Offset"]).css("left",f.left+"px").css("width",f.width+"px"),"footer"===a&&c.floating.css("top","")):"below"===b?(this._clone(a,e),c.floating.addClass("fixedHeader-locked").css("top",
f.tfootTop-f.theadHeight).css("left",f.left+"px").css("width",f.width+"px")):"above"===b&&(this._clone(a,e),c.floating.addClass("fixedHeader-locked").css("top",f.tbodyTop).css("left",f.left+"px").css("width",f.width+"px"));g&&g!==h.activeElement&&g.focus();this.s.scrollLeft.header=-1;this.s.scrollLeft.footer=-1;this.s[a+"Mode"]=b},_positions:function(){var b=this.s.dt.table(),a=this.s.position,e=this.dom,b=d(b.node()),c=b.children("thead"),f=b.children("tfoot"),e=e.tbody;a.visible=b.is(":visible");
a.width=b.outerWidth();a.left=b.offset().left;a.theadTop=c.offset().top;a.tbodyTop=e.offset().top;a.theadHeight=a.tbodyTop-a.theadTop;f.length?(a.tfootTop=f.offset().top,a.tfootBottom=a.tfootTop+f.outerHeight(),a.tfootHeight=a.tfootBottom-a.tfootTop):(a.tfootTop=a.tbodyTop+e.outerHeight(),a.tfootBottom=a.tfootTop,a.tfootHeight=a.tfootTop)},_scroll:function(b){var a=d(h).scrollTop(),e=d(h).scrollLeft(),c=this.s.position,f;if(this.s.enable&&(this.c.header&&(f=!c.visible||a<=c.theadTop-this.c.headerOffset?
"in-place":a<=c.tfootTop-c.theadHeight-this.c.headerOffset?"in":"below",(b||f!==this.s.headerMode)&&this._modeChange(f,"header",b),this._horizontal("header",e)),this.c.footer&&this.dom.tfoot.length))a=!c.visible||a+c.windowHeight>=c.tfootBottom+this.c.footerOffset?"in-place":c.windowHeight+a>c.tbodyTop+c.tfootHeight+this.c.footerOffset?"in":"above",(b||a!==this.s.footerMode)&&this._modeChange(a,"footer",b),this._horizontal("footer",e)}});i.version="3.1.2";i.defaults={header:!0,footer:!1,headerOffset:0,
footerOffset:0};d.fn.dataTable.FixedHeader=i;d.fn.DataTable.FixedHeader=i;d(h).on("init.dt.dtfh",function(b,a){if("dt"===b.namespace){var e=a.oInit.fixedHeader,c=j.defaults.fixedHeader;if((e||c)&&!a._fixedHeader)c=d.extend({},c,e),!1!==e&&new i(a,c)}});j.Api.register("fixedHeader()",function(){});j.Api.register("fixedHeader.adjust()",function(){return this.iterator("table",function(b){(b=b._fixedHeader)&&b.update()})});j.Api.register("fixedHeader.enable()",function(b){return this.iterator("table",
function(a){(a=a._fixedHeader)&&a.enable(b!==k?b:!0)})});j.Api.register("fixedHeader.disable()",function(){return this.iterator("table",function(b){(b=b._fixedHeader)&&b.enable(!1)})});d.each(["header","footer"],function(b,a){j.Api.register("fixedHeader."+a+"Offset()",function(b){var c=this.context;return b===k?c.length&&c[0]._fixedHeader?c[0]._fixedHeader[a+"Offset"]():k:this.iterator("table",function(c){if(c=c._fixedHeader)c[a+"Offset"](b)})})});return i});

/*
 * File:        FixedHeader.js
 * Version:     2.1.0.dev
 * Description: "Fix" a header at the top of the table, so it scrolls with the table
 * Author:      Allan Jardine (www.sprymedia.co.uk)
 * Created:     Wed 16 Sep 2009 19:46:30 BST
 * Language:    Javascript
 * License:     GPL v2 or BSD 3 point style
 * Project:     Just a little bit of fun - enjoy :-)
 * Contact:     www.sprymedia.co.uk/contact
 *
 * Copyright 2009-2012 Allan Jardine, all rights reserved.
 *
 * This source file is free software, under either the GPL v2 license or a
 * BSD style license, available at:
 *   http://datatables.net/license_gpl2
 *   http://datatables.net/license_bsd
 */

/* Global scope for FixedColumns */
var FixedHeader;


(function (window, document, $) {

    /*
     * Function: FixedHeader
     * Purpose:  Provide 'fixed' header, footer and columns on an HTML table
     * Returns:  object:FixedHeader - must be called with 'new'
     * Inputs:   mixed:mTable - target table
     *					   1. DataTable object - when using FixedHeader with DataTables, or
     *					   2. HTML table node - when using FixedHeader without DataTables
     *           object:oInit - initialisation settings, with the following properties (each optional)
     *             bool:top -    fix the header (default true)
     *             bool:bottom - fix the footer (default false)
     *             bool:left -   fix the left most column (default false)
     *             bool:right -  fix the right most column (default false)
     *             int:zTop -    fixed header zIndex
     *             int:zBottom - fixed footer zIndex
     *             int:zLeft -   fixed left zIndex
     *             int:zRight -  fixed right zIndex
     */
    FixedHeader = function (mTable, oInit) {
        /* Sanity check - you just know it will happen */
        if (typeof this.fnInit != 'function') {
            alert("FixedHeader warning: FixedHeader must be initialised with the 'new' keyword.");
            return;
        }

        var that = this;
        var oSettings = {
            "aoCache":[],
            "oSides":{
                "top":true,
                "bottom":false,
                "left":false,
                "right":false
            },
            "oZIndexes":{
                "top":104,
                "bottom":103,
                "left":102,
                "right":101
            },
            "oCloneOnDraw":{
                "top":true,
                "bottom":false,
                "left":true,
                "right":true
            },
            "oMes":{
                "iTableWidth":0,
                "iTableHeight":0,
                "iTableLeft":0,
                "iTableRight":0, /* note this is left+width, not actually "right" */
                "iTableTop":0,
                "iTableBottom":0 /* note this is top+height, not actually "bottom" */
            },
            "oOffset":{
                "top":0
            },
            "nTable":null,
            "bUseAbsPos":false,
            "bFooter":false,
            "bInitComplete":false
        };

        /*
         * Function: fnGetSettings
         * Purpose:  Get the settings for this object
         * Returns:  object: - settings object
         * Inputs:   -
         */
        this.fnGetSettings = function () {
            return oSettings;
        };

        /*
         * Function: fnUpdate
         * Purpose:  Update the positioning and copies of the fixed elements
         * Returns:  -
         * Inputs:   -
         */
        this.fnUpdate = function () {
            this._fnUpdateClones();
            this._fnUpdatePositions();
        };

        /*
         * Function: fnPosition
         * Purpose:  Update the positioning of the fixed elements
         * Returns:  -
         * Inputs:   -
         */
        this.fnPosition = function () {
            this._fnUpdatePositions();
        };

        /* Let's do it */
        this.fnInit(mTable, oInit);

        /* Store the instance on the DataTables object for easy access */
        if (typeof mTable.fnSettings == 'function') {
            mTable._oPluginFixedHeader = this;
        }
    };


    /*
     * Variable: FixedHeader
     * Purpose:  Prototype for FixedHeader
     * Scope:    global
     */
    FixedHeader.prototype = {
        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Initialisation
         */

        /*
         * Function: fnInit
         * Purpose:  The "constructor"
         * Returns:  -
         * Inputs:   {as FixedHeader function}
         */
        fnInit:function (oTable, oInit) {
            var s = this.fnGetSettings();
            var that = this;

            /* Record the user definable settings */
            this.fnInitSettings(s, oInit);

            /* DataTables specific stuff */
            if (typeof oTable.fnSettings == 'function') {
                if (typeof oTable.fnVersionCheck == 'functon' &&
                    oTable.fnVersionCheck('1.6.0') !== true) {
                    alert("FixedHeader 2 required DataTables 1.6.0 or later. " +
                        "Please upgrade your DataTables installation");
                    return;
                }

                var oDtSettings = oTable.fnSettings();

                if (oDtSettings.oScroll.sX != "" || oDtSettings.oScroll.sY != "") {
                    alert("FixedHeader 2 is not supported with DataTables' scrolling mode at this time");
                    return;
                }

                s.nTable = oDtSettings.nTable;
                oDtSettings.aoDrawCallback.unshift({
                    "fn":function () {
                        FixedHeader.fnMeasure();
                        that._fnUpdateClones.call(that);
                        that._fnUpdatePositions.call(that);
                    },
                    "sName":"FixedHeader"
                });
            }
            else {
                s.nTable = oTable;
            }

            s.bFooter = ($('>tfoot', s.nTable).length > 0) ? true : false;

            /* "Detect" browsers that don't support absolute positioing - or have bugs */
            s.bUseAbsPos = (isIE && (IEv == "6.0" || IEv == "7.0"));

            /* Add the 'sides' that are fixed */
            if (s.oSides.top) {
                s.aoCache.push(that._fnCloneTable("fixedHeader", "FixedHeader_Header", that._fnCloneThead));
            }
            if (s.oSides.bottom) {
                s.aoCache.push(that._fnCloneTable("fixedFooter", "FixedHeader_Footer", that._fnCloneTfoot));
            }
            if (s.oSides.left) {
                s.aoCache.push(that._fnCloneTable("fixedLeft", "FixedHeader_Left", that._fnCloneTLeft));
            }
            if (s.oSides.right) {
                s.aoCache.push(that._fnCloneTable("fixedRight", "FixedHeader_Right", that._fnCloneTRight));
            }
            if (s.oSides.left && s.oSides.top) {
                s.aoCache.push(that._fnCloneTable("fixedLeftHead", "FixedHeader_LeftHead", that._fnCloneTLeftHead));
            }

            /* Event listeners for window movement */
            FixedHeader.afnScroll.push(function () {
                that._fnUpdatePositions.call(that);
            });

            $(window).resize(function () {
                FixedHeader.fnMeasure();
                that._fnUpdateClones.call(that);
                that._fnUpdatePositions.call(that);
            });

            /* Get things right to start with */
            FixedHeader.fnMeasure();
            that._fnUpdateClones();
            that._fnUpdatePositions();

            s.bInitComplete = true;
        },


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Support functions
         */

        /*
         * Function: fnInitSettings
         * Purpose:  Take the user's settings and copy them to our local store
         * Returns:  -
         * Inputs:   object:s - the local settings object
         *           object:oInit - the user's settings object
         */
        fnInitSettings:function (s, oInit) {
            if (typeof oInit != 'undefined') {
                if (typeof oInit.top != 'undefined') {
                    s.oSides.top = oInit.top;
                }
                if (typeof oInit.bottom != 'undefined') {
                    s.oSides.bottom = oInit.bottom;
                }
                if (typeof oInit.left != 'undefined') {
                    s.oSides.left = oInit.left;
                }
                if (typeof oInit.right != 'undefined') {
                    s.oSides.right = oInit.right;
                }

                if (typeof oInit.zTop != 'undefined') {
                    s.oZIndexes.top = oInit.zTop;
                }
                if (typeof oInit.zBottom != 'undefined') {
                    s.oZIndexes.bottom = oInit.zBottom;
                }
                if (typeof oInit.zLeft != 'undefined') {
                    s.oZIndexes.left = oInit.zLeft;
                }
                if (typeof oInit.zRight != 'undefined') {
                    s.oZIndexes.right = oInit.zRight;
                }

                if (typeof oInit.offsetTop != 'undefined') {
                    s.oOffset.top = oInit.offsetTop;
                }
                if (typeof oInit.alwaysCloneTop != 'undefined') {
                    s.oCloneOnDraw.top = oInit.alwaysCloneTop;
                }
                if (typeof oInit.alwaysCloneBottom != 'undefined') {
                    s.oCloneOnDraw.bottom = oInit.alwaysCloneBottom;
                }
                if (typeof oInit.alwaysCloneLeft != 'undefined') {
                    s.oCloneOnDraw.left = oInit.alwaysCloneLeft;
                }
                if (typeof oInit.alwaysCloneRight != 'undefined') {
                    s.oCloneOnDraw.right = oInit.alwaysCloneRight;
                }
            }

            /* Detect browsers which have poor position:fixed support so we can use absolute positions.
             * This is much slower since the position must be updated for each scroll, but widens
             * compatibility
             */
            s.bUseAbsPos = (isIE &&
                (IEv == "6.0" || IEv == "7.0"));
        },

        /*
         * Function: _fnCloneTable
         * Purpose:  Clone the table node and do basic initialisation
         * Returns:  -
         * Inputs:   -
         */
        _fnCloneTable:function (sType, sClass, fnClone) {
            var s = this.fnGetSettings();
            var nCTable;

            /* We know that the table _MUST_ has a DIV wrapped around it, because this is simply how
             * DataTables works. Therefore, we can set this to be relatively position (if it is not
             * alreadu absolute, and use this as the base point for the cloned header
             */
            if ($(s.nTable.parentNode).css('position') != "absolute") {
                s.nTable.parentNode.style.position = "relative";
            }

            /* Just a shallow clone will do - we only want the table node */
            nCTable = s.nTable.cloneNode(false);
            nCTable.removeAttribute('id');

            var nDiv = document.createElement('div');
            nDiv.style.position = "absolute";
            nDiv.style.top = "0px";
            nDiv.style.left = "0px";
            nDiv.className += " FixedHeader_Cloned " + sType + " " + sClass;

            /* Set the zIndexes */
            if (sType == "fixedHeader") {
                nDiv.style.zIndex = s.oZIndexes.top;
            }
            if (sType == "fixedFooter") {
                nDiv.style.zIndex = s.oZIndexes.bottom;
            }
            if (sType == "fixedLeft") {
                nDiv.style.zIndex = s.oZIndexes.left;
            }
            if (sType == "fixedLeftHead") {
                nDiv.style.zIndex = s.oZIndexes.left;
            }
            else if (sType == "fixedRight") {
                nDiv.style.zIndex = s.oZIndexes.right;
            }

            /* remove margins since we are going to position it absolutely */
            nCTable.style.margin = "0";

            /* Insert the newly cloned table into the DOM, on top of the "real" header */
            nDiv.appendChild(nCTable);
            document.body.appendChild(nDiv);

            return {
                "nNode":nCTable,
                "nWrapper":nDiv,
                "sType":sType,
                "sPosition":"",
                "sTop":"",
                "sLeft":"",
                "fnClone":fnClone
            };
        },

        /*
         * Function: _fnUpdatePositions
         * Purpose:  Get the current positioning of the table in the DOM
         * Returns:  -
         * Inputs:   -
         */
        _fnMeasure:function () {
            var
                s = this.fnGetSettings(),
                m = s.oMes,
                jqTable = $(s.nTable),
                oOffset = jqTable.offset(),
                iParentScrollTop = this._fnSumScroll(s.nTable.parentNode, 'scrollTop'),
                iParentScrollLeft = this._fnSumScroll(s.nTable.parentNode, 'scrollLeft');

            m.iTableWidth = jqTable.outerWidth();
            m.iTableHeight = jqTable.outerHeight();
            m.iTableLeft = oOffset.left + s.nTable.parentNode.scrollLeft;
            m.iTableTop = oOffset.top + iParentScrollTop;
            m.iTableRight = m.iTableLeft + m.iTableWidth;
            m.iTableRight = FixedHeader.oDoc.iWidth - m.iTableLeft - m.iTableWidth;
            m.iTableBottom = FixedHeader.oDoc.iHeight - m.iTableTop - m.iTableHeight;
        },

        /*
         * Function: _fnSumScroll
         * Purpose:  Sum node parameters all the way to the top
         * Returns:  int: sum
         * Inputs:   node:n - node to consider
         *           string:side - scrollTop or scrollLeft
         */
        _fnSumScroll:function (n, side) {
            var i = n[side];
            while (n = n.parentNode) {
                if (n.nodeName == 'HTML' || n.nodeName == 'BODY') {
                    break;
                }
                i = n[side];
            }
            return i;
        },

        /*
         * Function: _fnUpdatePositions
         * Purpose:  Loop over the fixed elements for this table and update their positions
         * Returns:  -
         * Inputs:   -
         */
        _fnUpdatePositions:function () {
            var s = this.fnGetSettings();
            this._fnMeasure();

            for (var i = 0, iLen = s.aoCache.length; i < iLen; i++) {
                if (s.aoCache[i].sType == "fixedHeader") {
                    this._fnScrollFixedHeader(s.aoCache[i]);
                }
                else if (s.aoCache[i].sType == "fixedFooter") {
                    this._fnScrollFixedFooter(s.aoCache[i]);
                }
                else if (s.aoCache[i].sType == "fixedLeft") {
                    this._fnScrollHorizontalLeft(s.aoCache[i]);
                }
                else if (s.aoCache[i].sType == "fixedLeftHead") {
                    this._fnScrollHorizontalLeftHead(s.aoCache[i]);
                }
                else {
                    this._fnScrollHorizontalRight(s.aoCache[i]);
                }
            }

            // Trigger custom event to update filters
            $(this.fnGetSettings().nTable).trigger("updateSelects");
        },

        /*
         * Function: _fnUpdateClones
         * Purpose:  Loop over the fixed elements for this table and call their cloning functions
         * Returns:  -
         * Inputs:   -
         */
        _fnUpdateClones:function () {
            var s = this.fnGetSettings();
            for (var i = 0, iLen = s.aoCache.length; i < iLen; i++) {
                s.aoCache[i].fnClone.call(this, s.aoCache[i]);
            }
        },


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Scrolling functions
         */

        /*
         * Function: _fnScrollHorizontalLeft
         * Purpose:  Update the positioning of the scrolling elements
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnScrollHorizontalRight:function (oCache) {
            var
                s = this.fnGetSettings(),
                oMes = s.oMes,
                oWin = FixedHeader.oWin,
                oDoc = FixedHeader.oDoc,
                nTable = oCache.nWrapper,
                iFixedWidth = $(nTable).outerWidth();

            if (oWin.iScrollRight < oMes.iTableRight) {
                /* Fully right aligned */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft + oMes.iTableWidth - iFixedWidth) + "px", 'left', nTable.style);
            }
            else if (oMes.iTableLeft < oDoc.iWidth - oWin.iScrollRight - iFixedWidth) {
                /* Middle */
                if (s.bUseAbsPos) {
                    this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', (oDoc.iWidth - oWin.iScrollRight - iFixedWidth) + "px", 'left', nTable.style);
                }
                else {
                    this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop - oWin.iScrollTop) + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', (oWin.iWidth - iFixedWidth) + "px", 'left', nTable.style);
                }
            }
            else {
                /* Fully left aligned */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
        },

        /*
         * Function: _fnScrollHorizontalLeft
         * Purpose:  Update the positioning of the scrolling elements
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnScrollHorizontalLeft:function (oCache) {
            var
                s = this.fnGetSettings(),
                oMes = s.oMes,
                oWin = FixedHeader.oWin,
                oDoc = FixedHeader.oDoc,
                nTable = oCache.nWrapper,
                iCellWidth = $(nTable).outerWidth();

            if (oWin.iScrollLeft < oMes.iTableLeft) {
                /* Fully left align */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
            else if (oWin.iScrollLeft < oMes.iTableLeft + oMes.iTableWidth - iCellWidth) {
                /* Middle */
                if (s.bUseAbsPos) {
                    this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', oWin.iScrollLeft + "px", 'left', nTable.style);
                }
                else {
                    this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop - oWin.iScrollTop) + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', "0px", 'left', nTable.style);
                }
            }
            else {
                /* Fully right align */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft + oMes.iTableWidth - iCellWidth) + "px", 'left', nTable.style);
            }
        },

        /*
         * Function: _fnScrollHorizontalLeftHead
         * Purpose:  Update the positioning of the scrolling elements
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnScrollHorizontalLeftHead:function (oCache) {
            var
                s = this.fnGetSettings(),
                oMes = s.oMes,
                oWin = FixedHeader.oWin,
                oDoc = FixedHeader.oDoc,
                nTable = oCache.nWrapper,
                iCellWidth = $(nTable).outerWidth(),
                iTbodyHeight = 0,
                anTbodies = s.nTable.getElementsByTagName('tbody');

            for (var i = 0; i < anTbodies.length; ++i) {
                iTbodyHeight += anTbodies[i].offsetHeight;
            }

            if (oMes.iTableTop > oWin.iScrollTop + s.oOffset.top) {
                // Page top not reached
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                if (oWin.iScrollLeft < oMes.iTableLeft) {
                    // Page left boundary not reached
                    this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
                }
                else if (oWin.iScrollLeft < oMes.iTableLeft + oMes.iTableWidth - iCellWidth) {
                     // Reach left boundary
                    if (s.bUseAbsPos) {
                        // IF IE
                        this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                        this._fnUpdateCache(oCache, 'sLeft', oWin.iScrollLeft + "px", 'left', nTable.style);
                    }
                    else {
                        this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                        this._fnUpdateCache(oCache, 'sLeft', "0px", 'left', nTable.style);
                        this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop - oWin.iScrollTop) + "px", 'top', nTable.style);
                    }
                }
                else {
                    // Fully right aligned (reached right table boundary)
                    this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft + oMes.iTableWidth - iCellWidth) + "px", 'left', nTable.style);
                }
            }
            else if (oWin.iScrollTop + s.oOffset.top > oMes.iTableTop + iTbodyHeight) {
                // Bottom of the table reached
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop + iTbodyHeight) + "px", 'top', nTable.style);
                if (oWin.iScrollLeft < oMes.iTableLeft) {
                    // Page left boundary not reached
                    this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
                }
                else if (oWin.iScrollLeft < oMes.iTableLeft + oMes.iTableWidth - iCellWidth) {
                     // Reach left boundary
                    if (s.bUseAbsPos) {
                        // IF IE
                        this._fnUpdateCache(oCache, 'sLeft', oWin.iScrollLeft + "px", 'left', nTable.style);
                    }
                    else {
                        this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                        this._fnUpdateCache(oCache, 'sLeft', "0px", 'left', nTable.style);
                        this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop + iTbodyHeight - oWin.iScrollTop) + "px", 'top', nTable.style);
                    }
                }
                else {
                    // Fully right aligned (reached right table boundary)
                    this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft + oMes.iTableWidth - iCellWidth) + "px", 'left', nTable.style);
                }
            }
            else {
                 // In the middle of the table (page top reached)
                if (s.bUseAbsPos) {
                    // IF IE
                    this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                }
                else {
                    this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', s.oOffset.top + "px", 'top', nTable.style);
                    if (oWin.iScrollLeft < oMes.iTableLeft) {
                        // Page left boundary not reached
                        this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft - oWin.iScrollLeft) + "px", 'left', nTable.style);
                    }
                    else if (oWin.iScrollLeft < oMes.iTableLeft + oMes.iTableWidth - iCellWidth) {
                         // Reach left boundary
                        if (s.bUseAbsPos) {
                            // IF IE
                            // this._fnUpdateCache(oCache, 'sLeft', oWin.iScrollLeft + "px", 'left', nTable.style);
                        }
                        else {
                            this._fnUpdateCache(oCache, 'sLeft', "0px", 'left', nTable.style);
                        }
                    }
                    else {
                        // Fully right aligned (reached right table boundary)
                        this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft + oMes.iTableWidth - iCellWidth) + "px", 'left', nTable.style);
                    }
                }
            }
        },

        /*
         * Function: _fnScrollFixedFooter
         * Purpose:  Update the positioning of the scrolling elements
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnScrollFixedFooter:function (oCache) {
            var
                s = this.fnGetSettings(),
                oMes = s.oMes,
                oWin = FixedHeader.oWin,
                oDoc = FixedHeader.oDoc,
                nTable = oCache.nWrapper,
                iTheadHeight = $("thead", s.nTable).outerHeight(),
                iCellHeight = $(nTable).outerHeight();

            if (oWin.iScrollBottom < oMes.iTableBottom) {
                /* Below */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop + oMes.iTableHeight - iCellHeight) + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
            else if (oWin.iScrollBottom < oMes.iTableBottom + oMes.iTableHeight - iCellHeight - iTheadHeight) {
                /* Middle */
                if (s.bUseAbsPos) {
                    this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', (oDoc.iHeight - oWin.iScrollBottom - iCellHeight) + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
                }
                else {
                    this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', (oWin.iHeight - iCellHeight) + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft - oWin.iScrollLeft) + "px", 'left', nTable.style);
                }
            }
            else {
                /* Above */
                this._fnUpdateCache(oCache, 'sPosition', 'absolute', 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop + iCellHeight) + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
        },

        /*
         * Function: _fnScrollFixedHeader
         * Purpose:  Update the positioning of the scrolling elements
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnScrollFixedHeader:function (oCache) {
            var
                s = this.fnGetSettings(),
                oMes = s.oMes,
                oWin = FixedHeader.oWin,
                oDoc = FixedHeader.oDoc,
                nTable = oCache.nWrapper,
                iTbodyHeight = 0,
                anTbodies = s.nTable.getElementsByTagName('tbody');

            for (var i = 0; i < anTbodies.length; ++i) {
                iTbodyHeight += anTbodies[i].offsetHeight;
            }

            if (oMes.iTableTop > oWin.iScrollTop + s.oOffset.top) {
                /* Above the table */
                this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', oMes.iTableTop + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
            else if (oWin.iScrollTop + s.oOffset.top > oMes.iTableTop + iTbodyHeight) {
                /* At the bottom of the table */
                this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                this._fnUpdateCache(oCache, 'sTop', (oMes.iTableTop + iTbodyHeight) + "px", 'top', nTable.style);
                this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
            }
            else {
                /* In the middle of the table */
                if (s.bUseAbsPos) {
                    this._fnUpdateCache(oCache, 'sPosition', "absolute", 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', oWin.iScrollTop + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', oMes.iTableLeft + "px", 'left', nTable.style);
                }
                else {
                    this._fnUpdateCache(oCache, 'sPosition', 'fixed', 'position', nTable.style);
                    this._fnUpdateCache(oCache, 'sTop', s.oOffset.top + "px", 'top', nTable.style);
                    this._fnUpdateCache(oCache, 'sLeft', (oMes.iTableLeft - oWin.iScrollLeft) + "px", 'left', nTable.style);
                }
            }
        },

        /*
         * Function: _fnUpdateCache
         * Purpose:  Check the cache and update cache and value if needed
         * Returns:  -
         * Inputs:   object:oCache - local cache object
         *           string:sCache - cache property
         *           string:sSet - value to set
         *           string:sProperty - object property to set
         *           object:oObj - object to update
         */
        _fnUpdateCache:function (oCache, sCache, sSet, sProperty, oObj) {
            if (oCache[sCache] != sSet) {
                oObj[sProperty] = sSet;
                oCache[sCache] = sSet;
            }
        },


        /**
         * Copy the classes of all child nodes from one element to another. This implies
         * that the two have identical structure - no error checking is performed to that
         * fact.
         *  @param {element} source Node to copy classes from
         *  @param {element} dest Node to copy classes too
         */
        _fnClassUpdate:function (source, dest) {
            var that = this;

            if (source.nodeName.toUpperCase() === "TR" || source.nodeName.toUpperCase() === "TH" ||
                source.nodeName.toUpperCase() === "TD" || source.nodeName.toUpperCase() === "SPAN") {
                dest.className = source.className;
            }

            $(source).children().each(function (i) {
                that._fnClassUpdate($(source).children()[i], $(dest).children()[i]);
            });
        },


        /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
         * Cloning functions
         */

        /*
         * Function: _fnCloneThead
         * Purpose:  Clone the thead element
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnCloneThead:function (oCache) {
            var s = this.fnGetSettings();
            var nTable = oCache.nNode;

            if (s.bInitComplete && !s.oCloneOnDraw.top) {
                this._fnClassUpdate($('thead', s.nTable)[0], $('thead', nTable)[0]);
                return;
            }

            /* Set the wrapper width to match that of the cloned table */
            var iDtWidth = $(s.nTable).outerWidth();
            oCache.nWrapper.style.width = iDtWidth + "px";
            nTable.style.width = iDtWidth + "px";

            /* Remove any children the cloned table has */
            while (nTable.childNodes.length > 0) {
                $('thead th', nTable).unbind('click');
                nTable.removeChild(nTable.childNodes[0]);
            }

            /* Clone the DataTables header */
            var nThead = $('thead', s.nTable).clone(true)[0];
            nTable.appendChild(nThead);

            /* Copy the widths across - apparently a clone isn't good enough for this */
            var a = [];
            var b = [];

            jQuery("thead>tr th", s.nTable).each(function (i) {
                a.push(jQuery(this).width());
            });

            jQuery("thead>tr td", s.nTable).each(function (i) {
                b.push(jQuery(this).width());
            });

            jQuery("thead>tr th", s.nTable).each(function (i) {
                jQuery("thead>tr th:eq(" + i + ")", nTable).width(a[i]);
                $(this).width(a[i]);
            });

            jQuery("thead>tr td", s.nTable).each(function (i) {
                jQuery("thead>tr td:eq(" + i + ")", nTable).width(b[i]);
                $(this).width(b[i]);
            });

            // Stop DataTables 1.9 from putting a focus ring on the headers when
            // clicked to sort
            $('th.sorting, th.sorting_desc, th.sorting_asc', nTable).bind('click', function () {
                this.blur();
            });
        },

        /*
         * Function: _fnCloneTfoot
         * Purpose:  Clone the tfoot element
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnCloneTfoot:function (oCache) {
            var s = this.fnGetSettings();
            var nTable = oCache.nNode;

            /* Set the wrapper width to match that of the cloned table */
            oCache.nWrapper.style.width = $(s.nTable).outerWidth() + "px";

            /* Remove any children the cloned table has */
            while (nTable.childNodes.length > 0) {
                nTable.removeChild(nTable.childNodes[0]);
            }

            /* Clone the DataTables footer */
            var nTfoot = $('tfoot', s.nTable).clone(true)[0];
            nTable.appendChild(nTfoot);

            /* Copy the widths across - apparently a clone isn't good enough for this */
            $("tfoot:eq(0)>tr th", s.nTable).each(function (i) {
                $("tfoot:eq(0)>tr th:eq(" + i + ")", nTable).width($(this).width());
            });

            $("tfoot:eq(0)>tr td", s.nTable).each(function (i) {
                $("tfoot:eq(0)>tr th:eq(" + i + ")", nTable)[0].style.width($(this).width());
            });
        },

        /*
         * Function: _fnCloneTLeft
         * Purpose:  Clone the left column
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnCloneTLeft:function (oCache) {
            var s = this.fnGetSettings();
            var nTable = oCache.nNode;
            var nBody = $('tbody', s.nTable)[0];
            var iCols = $('tbody tr:eq(0) td', s.nTable).length;
            var bRubbishOldIE = (isIE && (IEv == "6.0" || IEv == "7.0"));

            /* Remove any children the cloned table has */
            while (nTable.childNodes.length > 0) {
                nTable.removeChild(nTable.childNodes[0]);
            }

            /* Is this the most efficient way to do this - it looks horrible... */
            nTable.appendChild($("thead", s.nTable).clone(true)[0]);
            nTable.appendChild($("tbody", s.nTable).clone(true)[0]);
            if (s.bFooter) {
                nTable.appendChild($("tfoot", s.nTable).clone(true)[0]);
            }

            /* Remove unneeded cells */
            $('thead tr', nTable).each(function (k) {
                $('th:gt(0)', this).remove();
            });

            $('tfoot tr', nTable).each(function (k) {
                $('th:gt(0)', this).remove();
            });

            $('tbody tr', nTable).each(function (k) {
                $('td:gt(0)', this).remove();
            });

            this.fnEqualiseHeights('thead', nBody.parentNode, nTable);
            this.fnEqualiseHeights('tbody', nBody.parentNode, nTable);
            this.fnEqualiseHeights('tfoot', nBody.parentNode, nTable);

            // Custom width counter
            // var iWidth = $('thead tr th:eq(0)', s.nTable).outerWidth();
            // var iWidth = $('thead tr:eq(1) th:eq(0)', s.nTable).outerWidth();
            var iWidth = $('thead tr:eq(1) th:eq(0)', s.nTable).width();
            nTable.style.width = iWidth + "px";
            oCache.nWrapper.style.width = iWidth + "px";
        },

        /*
         * Function: _fnCloneTRight
         * Purpose:  Clone the right most colun
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnCloneTRight:function (oCache) {
            var s = this.fnGetSettings();
            var nBody = $('tbody', s.nTable)[0];
            var nTable = oCache.nNode;
            var iCols = $('tbody tr:eq(0) td', s.nTable).length;
            var bRubbishOldIE = (isIE && (IEv == "6.0" || IEv == "7.0"));

            /* Remove any children the cloned table has */
            while (nTable.childNodes.length > 0) {
                nTable.removeChild(nTable.childNodes[0]);
            }

            /* Is this the most efficient way to do this - it looks horrible... */
            nTable.appendChild($("thead", s.nTable).clone(true)[0]);
            nTable.appendChild($("tbody", s.nTable).clone(true)[0]);
            if (s.bFooter) {
                nTable.appendChild($("tfoot", s.nTable).clone(true)[0]);
            }
            $('thead tr th:not(:nth-child(' + iCols + 'n))', nTable).remove();
            $('tfoot tr th:not(:nth-child(' + iCols + 'n))', nTable).remove();

            /* Remove unneeded cells */
            $('tbody tr', nTable).each(function (k) {
                $('td:lt(' + (iCols - 1) + ')', this).remove();
            });

            this.fnEqualiseHeights('thead', nBody.parentNode, nTable);
            this.fnEqualiseHeights('tbody', nBody.parentNode, nTable);
            this.fnEqualiseHeights('tfoot', nBody.parentNode, nTable);

            var iWidth = $('thead tr th:eq(' + (iCols - 1) + ')', s.nTable).outerWidth();
            nTable.style.width = iWidth + "px";
            oCache.nWrapper.style.width = iWidth + "px";
        },

        /*
         * Function: _fnCloneTLeftHead
         * Purpose:  Clone the left column header
         * Returns:  -
         * Inputs:   object:oCache - the cached values for this fixed element
         */
        _fnCloneTLeftHead:function (oCache) {
            var s = this.fnGetSettings();
            var nTable = oCache.nNode;
            var nBody = $('tbody', s.nTable)[0];
            var bRubbishOldIE = (isIE && (IEv == "6.0" || IEv == "7.0"));

            /* Remove any children the cloned table has */
            while (nTable.childNodes.length > 0) {
                nTable.removeChild(nTable.childNodes[0]);
            }

            /* Is this the most efficient way to do this - it looks horrible... */
            nTable.appendChild($("thead", s.nTable).clone(true)[0]);

            /* Remove unneeded cells */
            $('thead tr', nTable).each(function (k) {
                $('th:gt(0)', this).remove();
            });

            this.fnEqualiseHeights('thead', nBody.parentNode, nTable);

            // Custom width counter
            // var iWidth = $('thead tr th:eq(0)', s.nTable).outerWidth();
            // var iWidth = $('thead tr:eq(1) th:eq(0)', s.nTable).outerWidth();
            var iWidth = $('thead tr:eq(1) th:eq(0)', s.nTable).width();
            nTable.style.width = iWidth + "px";
            oCache.nWrapper.style.width = iWidth + "px";
        },


        /**
         * Equalise the heights of the rows in a given table node in a cross browser way. Note that this
         * is more or less lifted as is from FixedColumns
         *  @method  fnEqualiseHeights
         *  @returns void
         *  @param   {string} parent Node type - thead, tbody or tfoot
         *  @param   {element} original Original node to take the heights from
         *  @param   {element} clone Copy the heights to
         *  @private
         */
        "fnEqualiseHeights":function (parent, original, clone) {
            var that = this,
                jqBoxHack = $(parent + ' tr:eq(0)', original).children(':eq(0)'),
                iBoxHack = jqBoxHack.outerHeight() - jqBoxHack.height(),
                bRubbishOldIE = (isIE && (IEv == "6.0" || IEv == "7.0"));

            /* Remove cells which are not needed and copy the height from the original table */
            $(parent + ' tr', clone).each(function (k) {
                /* Can we use some kind of object detection here?! This is very nasty - damn browsers */
                // if ($.browser.mozilla && parseFloat(IEv) < 16 || $.browser.opera) {
                    // $(this).children().height($(parent + ' tr:eq(' + k + ') td:eq(0)', original).outerHeight());
                // }
                // else {
                    // Custom hack for different outer table border width
                    if (parent == "tbody" && k == ($(parent + ' tr', clone).length -1)) {
                        iBoxHack++
                    }
                    $(this).children().height($(parent + ' tr:eq(' + k + ') td:eq(0)', original).outerHeight() - iBoxHack);
                // }

                if (!bRubbishOldIE) {
                    $(parent + ' tr:eq(' + k + ')', original).height($(parent + ' tr:eq(' + k + ')', original).outerHeight());
                }
            });
        }
    };


    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Static properties and methods
     *   We use these for speed! This information is common to all instances of FixedHeader, so no
     * point if having them calculated and stored for each different instance.
     */

    /*
     * Variable: oWin
     * Purpose:  Store information about the window positioning
     * Scope:    FixedHeader
     */
    FixedHeader.oWin = {
        "iScrollTop":0,
        "iScrollRight":0,
        "iScrollBottom":0,
        "iScrollLeft":0,
        "iHeight":0,
        "iWidth":0
    };

    /*
     * Variable: oDoc
     * Purpose:  Store information about the document size
     * Scope:    FixedHeader
     */
    FixedHeader.oDoc = {
        "iHeight":0,
        "iWidth":0
    };

    /*
     * Variable: afnScroll
     * Purpose:  Array of functions that are to be used for the scrolling components
     * Scope:    FixedHeader
     */
    FixedHeader.afnScroll = [];

    /*
     * Function: fnMeasure
     * Purpose:  Update the measurements for the window and document
     * Returns:  -
     * Inputs:   -
     */
    FixedHeader.fnMeasure = function () {
        var
            jqWin = $(window),
            jqDoc = $(document),
            oWin = FixedHeader.oWin,
            oDoc = FixedHeader.oDoc;

        oDoc.iHeight = jqDoc.height();
        oDoc.iWidth = jqDoc.width();

        oWin.iHeight = jqWin.height();
        oWin.iWidth = jqWin.width();
        oWin.iScrollTop = jqWin.scrollTop();
        oWin.iScrollLeft = jqWin.scrollLeft();
        oWin.iScrollRight = oDoc.iWidth - oWin.iScrollLeft - oWin.iWidth;
        oWin.iScrollBottom = oDoc.iHeight - oWin.iScrollTop - oWin.iHeight;
    };


    FixedHeader.VERSION = "2.1.0.dev";
    FixedHeader.prototype.VERSION = FixedHeader.VERSION;


    /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
     * Global processing
     */

    /*
     * Just one 'scroll' event handler in FixedHeader, which calls the required components. This is
     * done as an optimisation, to reduce calculation and proagation time
     */
    $(window).scroll(function () {
        FixedHeader.fnMeasure();
        for (var i = 0, iLen = FixedHeader.afnScroll.length; i < iLen; i++) {
            FixedHeader.afnScroll[i]();
        }
    });


}(window, document, jQuery));

/*
autogrow.js - Copyright (C) 2014, Jason Edelman <edelman.jason@gmail.com>

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and
associated documentation files (the "Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or
sell copies of the Software, and to permit persons to whom the Software is furnished to
do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
DEALINGS IN THE SOFTWARE.
*/
;(function(e){e.fn.autogrow=function(t){function s(n){var r=e(this),i=r.innerHeight(),s=this.scrollHeight,o=r.data("autogrow-start-height")||0,u;if(i<s){this.scrollTop=0;t.animate?r.stop().animate({height:s},t.speed):r.innerHeight(s)}else if(!n||n.which==8||n.which==46||n.ctrlKey&&n.which==88){if(i>o){u=r.clone().addClass(t.cloneClass).css({position:"absolute",zIndex:-10,height:""}).val(r.val());r.after(u);do{s=u[0].scrollHeight-1;u.innerHeight(s)}while(s===u[0].scrollHeight);s++;u.remove();r.focus();s<o&&(s=o);i>s&&t.animate?r.stop().animate({height:s},t.speed):r.innerHeight(s)}else{r.innerHeight(o)}}}var n=e(this).css({overflow:"hidden",resize:"none"}),r=n.selector,i={context:e(document),animate:true,speed:200,fixMinHeight:true,cloneClass:"autogrowclone",onInitialize:false};t=e.isPlainObject(t)?t:{context:t?t:e(document)};t=e.extend({},i,t);n.each(function(n,r){var i,o;r=e(r);if(r.is(":visible")||parseInt(r.css("height"),10)>0){i=parseInt(r.css("height"),10)||r.innerHeight()}else{o=r.clone().addClass(t.cloneClass).val(r.val()).css({position:"absolute",visibility:"hidden",display:"block"});e("body").append(o);i=o.innerHeight();o.remove()}if(t.fixMinHeight){r.data("autogrow-start-height",i)}r.css("height",i);if(t.onInitialize&&r.length){s.call(r[0])}});t.context.on("keyup paste",r,s);return n}})(jQuery);

/*
 * delayKeyup
 * http://code.azerti.net/javascript/jquery/delaykeyup.htm
 * Inspired by CMS in this post : http://stackoverflow.com/questions/1909441/jquery-keyup-delay
 * Written by Gaten
 * Exemple : $("#input").delayKeyup(function(){ alert("5 secondes passed from the last event keyup."); }, 5000);
 */
(function ($) {
    $.fn.delayKeyup = function(callback, ms){
        var timer = 0;
        $(this).keyup(function(){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        });
        return $(this);
    };
})(jQuery);


/*
 * Flexigrid for jQuery - New Wave Grid
 *
 * Copyright (c) 2008 Paulo P. Marinas (webplicity.net/flexigrid)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * $Date: 2008-04-01 00:09:43 +0800 (Tue, 01 Apr 2008) $
 */
eval(function(p,a,c,k,e,d){e=function(c){return(c<a?"":e(parseInt(c/a)))+((c=c%a)>35?String.fromCharCode(c+29):c.toString(36))};if(!''.replace(/^/,String)){while(c--){d[e(c)]=k[c]||e(c)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(b($){$.3N=b(t,p){8(t.1D)D o;p=$.4L({G:5Z,l:\'1l\',3o:P,4d:o,5W:30,4A:7m,3n:P,2o:o,5F:\'7l\',2g:\'3E\',5N:\'7k 7j\',3Y:o,5B:P,18:1,1r:1,5b:P,1F:15,2W:[10,15,20,25,40],2Q:o,5J:\'7i {5I} 4s {4s} 5i {1r} 62\',5H:\'7h, 7g 7f ...\',2U:\'\',1u:\'\',5M:\'7e 62\',3i:1,4S:P,4p:P,4O:P,4Y:0.5,4y:o,4v:o,4w:o,4q:o},p);$(t).1U().V({5v:0,5u:0,7d:0}).3e(\'l\');c g={1w:{},21:b(){c 2P=0-6.f.1C;8(6.f.1C>0)2P-=3t.4a(p.32/2);$(g.17).d({1i:g.f.1Q+1});c 1n=6.1n;$(\'9\',g.17).L();$(\'X j:1j u:Z\',6.f).T(b(){c n=$(\'X j:1j u:Z\',g.f).2d(6);c 2O=B($(\'9\',6).l());c 7c=2O;8(2P==0)2P-=3t.4a(p.32/2);2O=2O+2P+1n;$(\'9:U(\'+n+\')\',g.17).d({\'1c\':2O+\'2b\'}).1U();2P=2O})},2p:b(1d){1d=o;8(!1d)1d=$(g.E).G();c 61=$(6.f).G();$(\'9\',6.17).T(b(){$(6).G(1d+61)});c 60=B($(g.z).G());8(60>1d)$(g.z).G(1d).l(5Z);k $(g.z).G(\'1l\').l(\'1l\');$(g.1E).d({G:1d,3T:(1d*-1)});c 4D=g.E.1Q+1d;8(p.G!=\'1l\'&&p.3n)4D=g.2Z.1Q;$(g.2E).d({G:4D})},2Y:b(3H,e,O){8(3H==\'12\'){$(g.z).L();$(g.19).L();c n=$(\'9\',6.17).2d(O);c 3G=$(\'u:Z 9:U(\'+n+\')\',6.f).l();$(O).M(\'2F\').3y().L();$(O).2S().M(\'2F\').1U();6.12={5Y:e.2j,5X:B(O.1z.1c),3G:3G,n:n};$(\'1x\').d(\'2M\',\'2r-4C\')}k 8(3H==\'1R\'){c 2N=o;$(\'1x\').d(\'2M\',\'1K-4C\');8(O){2N=P;$(\'1x\').d(\'2M\',\'2r-4C\')}6.1R={h:p.G,5U:e.3c,w:p.l,5T:e.2j,2N:2N}}k 8(3H==\'5n\'){$(g.z).L();$(g.19).L();6.1w=$(6.f).7b();6.1w.5R=6.1w.1c+$(\'2u\',6.f).l();6.1w.5Q=6.1w.1i+$(\'2u\',6.f).G();6.3b=O;6.2J=$(\'u\',6.f).2d(O);6.16=r.A("9");6.16.R="16";6.16.11=O.11;8($.J.1k){6.16.R="16 5y"}$(6.16).d({4Z:\'7a\',79:\'1c\',1O:\'2k\',4b:O.1B});$(\'1x\').F(6.16);$(6.17).L()}$(\'1x\').2l()},4R:b(e){8(6.12){c n=6.12.n;c 3d=e.2j-6.12.5Y;c 5V=6.12.5X+3d;c 1A=6.12.3G+3d;8(1A>p.5W){$(\'9:U(\'+n+\')\',6.17).d(\'1c\',5V);6.12.1A=1A}}k 8(6.1R){c v=6.1R;c y=e.3c;c 3d=y-v.5U;8(!p.4B)p.4B=p.l;8(p.l!=\'1l\'&&!p.5k&&v.2N){c x=e.2j;c 5S=x-v.5T;c 3F=v.w+5S;8(3F>p.4B){6.K.1z.l=3F+\'2b\';p.l=3F}}c 1d=v.h+3d;8((1d>p.4A||p.G<p.4A)&&!v.2N){6.E.1z.G=1d+\'2b\';p.G=1d;6.2p(1d)}v=N}k 8(6.16){$(6.3b).M(\'3u\').W(\'3r\');8(e.2j>6.1w.5R||e.2j<6.1w.1c||e.3c>6.1w.5Q||e.3c<6.1w.1i){$(\'1x\').d(\'2M\',\'78\')}k $(\'1x\').d(\'2M\',\'77\');$(6.16).d({1i:e.3c+10,1c:e.2j+20,1O:\'1E\'})}},3P:b(){8(6.12){c n=6.12.n;c 1A=6.12.1A;$(\'u:Z 9:U(\'+n+\')\',6.f).d(\'l\',1A);$(\'j\',6.E).T(b(){$(\'m:Z 9:U(\'+n+\')\',6).d(\'l\',1A)});6.f.1C=6.E.1C;$(\'9:U(\'+n+\')\',6.17).3y().1U();$(\'.2F\',6.17).W(\'2F\');6.21();6.2p();6.12=o}k 8(6.1R){6.1R=o}k 8(6.16){$(6.16).2H();8(6.1S!=N){8(6.2J>6.1S)$(\'u:U(\'+6.1S+\')\',6.f).2c(6.3b);k $(\'u:U(\'+6.1S+\')\',6.f).2x(6.3b);6.5P(6.2J,6.1S);$(6.2w).2H();$(6.2v).2H();6.21()}6.3b=N;6.1w=N;6.2J=N;6.1S=N;6.16=N;$(\'.3u\',6.f).W(\'3u\');$(6.17).1U()}$(\'1x\').d(\'2M\',\'76\');$(\'1x\').2l(o)},3M:b(2n,Z){c 2i=$("u[2s=\'2r"+2n+"\']",6.f)[0];c n=$(\'X u\',g.f).2d(2i);c 4z=$(\'Q[1b=\'+2n+\']\',g.z)[0];8(Z==N){Z=2i.L}8($(\'Q:1y\',g.z).1h<p.3i&&!Z)D o;8(Z){2i.L=o;$(2i).1U();4z.1y=P}k{2i.L=P;$(2i).L();4z.1y=o}$(\'1f j\',t).T(b(){8(Z)$(\'m:U(\'+n+\')\',6).1U();k $(\'m:U(\'+n+\')\',6).L()});6.21();8(p.4y)p.4y(2n,Z);D Z},5P:b(2h,1Y){$(\'1f j\',t).T(b(){8(2h>1Y)$(\'m:U(\'+1Y+\')\',6).2c($(\'m:U(\'+2h+\')\',6));k $(\'m:U(\'+1Y+\')\',6).2x($(\'m:U(\'+2h+\')\',6))});8(2h>1Y)$(\'j:U(\'+1Y+\')\',6.z).2c($(\'j:U(\'+2h+\')\',6.z));k $(\'j:U(\'+1Y+\')\',6.z).2x($(\'j:U(\'+2h+\')\',6.z));8($.J.1k&&$.J.1N<7.0)$(\'j:U(\'+1Y+\') Q\',6.z)[0].1y=P;6.f.1C=6.E.1C},45:b(){6.f.1C=6.E.1C;6.21()},3L:b(Y){8(p.5O)Y=p.5O(Y);$(\'.3m\',6.I).W(\'2f\');6.2f=o;8(!Y){$(\'.2X\',6.I).1t(p.5N);D o}8(p.2g==\'3E\')p.1r=+$(\'3D 1r\',Y).2y();k p.1r=Y.1r;8(p.1r==0){$(\'j, a, m, 9\',t).3f();$(t).3v();p.1J=1;p.18=1;6.4u();$(\'.2X\',6.I).1t(p.5M);D o}p.1J=3t.75(p.1r/p.1F);8(p.2g==\'3E\')p.18=+$(\'3D 18\',Y).2y();k p.18=Y.18;6.4u();c 1f=r.A(\'1f\');8(p.2g==\'74\'){$.T(Y.3D,b(i,1K){c j=r.A(\'j\');8(i%2&&p.3o)j.R=\'3Z\';8(1K.2e)j.2e=\'1K\'+1K.2e;$(\'X j:1j u\',g.f).T(b(){c m=r.A(\'m\');c 1X=$(6).V(\'2s\').4m(3);m.1B=6.1B;m.11=1K.3a[1X];$(j).F(m);m=N});8($(\'X\',6.K).1h<1){2A(1X=0;1X<3a.1h;1X++){c m=r.A(\'m\');m.11=1K.3a[1X];$(j).F(m);m=N}}$(1f).F(j);j=N})}k 8(p.2g==\'3E\'){i=1;$("3D 1K",Y).T(b(){i++;c j=r.A(\'j\');8(i%2&&p.3o)j.R=\'3Z\';c 3C=$(6).V(\'2e\');8(3C)j.2e=\'1K\'+3C;3C=N;c 4x=6;$(\'X j:1j u\',g.f).T(b(){c m=r.A(\'m\');c 1X=$(6).V(\'2s\').4m(3);m.1B=6.1B;m.11=$("3a:U("+1X+")",4x).2y();$(j).F(m);m=N});8($(\'X\',6.K).1h<1){$(\'3a\',6).T(b(){c m=r.A(\'m\');m.11=$(6).2y();$(j).F(m);m=N})}$(1f).F(j);j=N;4x=N})}$(\'j\',t).3f();$(t).3v();$(t).F(1f);6.44();6.43();6.21();1f=N;Y=N;i=N;8(p.4w)p.4w();8(p.4p)$(g.1E).2H();6.f.1C=6.E.1C;8($.J.3g)$(t).d(\'5G\',\'Z\')},5q:b(u){8(6.2f)D P;$(g.z).L();$(g.19).L();8(p.1o==$(u).V(\'1p\')){8(p.1g==\'2I\')p.1g=\'46\';k p.1g=\'2I\'}$(u).M(\'34\').3y().W(\'34\');$(\'.5L\',6.f).W(\'5L\');$(\'.5K\',6.f).W(\'5K\');$(\'9\',u).M(\'s\'+p.1g);p.1o=$(u).V(\'1p\');8(p.4v)p.4v(p.1o,p.1g);k 6.1L()},4u:b(){$(\'.2D Q\',6.I).23(p.18);$(\'.2D H\',6.I).1t(p.1J);c 4t=(p.18-1)*p.1F+1;c 3B=4t+p.1F-1;8(p.1r<3B)3B=p.1r;c 1W=p.5J;1W=1W.4r(/{5I}/,4t);1W=1W.4r(/{4s}/,3B);1W=1W.4r(/{1r}/,p.1r);$(\'.2X\',6.I).1t(1W)},1L:b(){8(6.2f)D P;8(p.4q){c 2t=p.4q();8(!2t)D o}6.2f=P;8(!p.2o)D o;$(\'.2X\',6.I).1t(p.5H);$(\'.3m\',6.I).M(\'2f\');$(g.1E).d({1i:g.E.1Q});8(p.4p)$(6.K).1P(g.1E);8($.J.3g)$(t).d(\'5G\',\'73\');8(!p.1m)p.1m=1;8(p.18>p.1J)p.18=p.1J;c 3z=[{S:\'18\',1b:p.1m},{S:\'1F\',1b:p.1F},{S:\'1o\',1b:p.1o},{S:\'1g\',1b:p.1g},{S:\'2U\',1b:p.2U},{S:\'1u\',1b:p.1u}];8(p.4o){2A(c 3A=0;3A<p.4o.1h;3A++)3z[3z.1h]=p.4o[3A]}$.72({24:p.5F,2o:p.2o,Y:3z,2g:p.2g,71:b(Y){g.3L(Y)},70:b(Y){6Z{8(p.5E)p.5E(Y)}6Y(e){}}})},3U:b(){p.2U=$(\'Q[S=q]\',g.1e).23();p.1u=$(\'26[S=1u]\',g.1e).23();p.1m=1;6.1L()},2C:b(5D){8(6.2f)D P;6X(5D){39\'1j\':p.1m=1;38;39\'2S\':8(p.18>1)p.1m=B(p.18)-1;38;39\'3Q\':8(p.18<p.1J)p.1m=B(p.18)+1;38;39\'5d\':p.1m=p.1J;38;39\'Q\':c 1v=B($(\'.2D Q\',6.I).23());8(1G(1v))1v=1;8(1v<1)1v=1;k 8(1v>p.1J)1v=p.1J;$(\'.2D Q\',6.I).23(1v);p.1m=1v;38}8(p.1m==p.18)D o;8(p.5C)p.5C(p.1m);k 6.1L()},44:b(){$(\'1f j m\',g.E).T(b(){c 2L=r.A(\'9\');c n=$(\'m\',$(6).2R()).2d(6);c 1I=$(\'u:U(\'+n+\')\',g.f).42(0);8(1I!=N){8(p.1o==$(1I).V(\'1p\')&&p.1o){6.R=\'34\'}$(2L).d({4b:1I.1B,l:$(\'9:1j\',1I)[0].1z.l});8(1I.L)$(6).d(\'1O\',\'2k\')}8(p.5B==o)$(2L).d(\'50-6W\',\'6V\');8(6.11==\'\')6.11=\'&2V;\';2L.11=6.11;c 4n=$(6).2R()[0];c 4l=o;8(4n.2e)4l=4n.2e.4m(3);8(1I!=N){8(1I.37)1I.37(2L,4l)}$(6).3v().F(2L).3e(\'l\')})},6U:b(O){c 4k=B($(O).G());c 4g=B($(O).2R().G());c 4j=B(O.1z.l);c 4f=B($(O).2R().l());c 1i=O.5A.1Q;c 1c=O.5A.6T;c 4i=B($(O).d(\'2G\'));c 4h=B($(O).d(\'6S\'));D{4k:4k,4j:4j,1i:1i,1c:1c,4i:4i,4h:4h,4g:4g,4f:4f}},43:b(){$(\'1f j\',g.E).T(b(){$(6).1a(b(e){c O=(e.5t||e.5s);8(O.5r||O.24)D P;$(6).2T(\'3x\');8(p.6R)$(6).3y().W(\'3x\')}).1Z(b(e){8(e.6Q){$(6).2T(\'3x\');g.2q=P;6.3I();$(g.K).2l()}}).4Q(b(){8(g.2q){g.2q=o;$(g.K).2l(o)}}).1s(b(e){8(g.2q){$(6).2T(\'3x\')}},b(){});8($.J.1k&&$.J.1N<7.0){$(6).1s(b(){$(6).M(\'5z\')},b(){$(6).W(\'5z\')})}})},6P:0};8(p.4e){X=r.A(\'X\');j=r.A(\'j\');2A(i=0;i<p.4e.1h;i++){c 1q=p.4e[i];c u=r.A(\'u\');u.11=1q.1O;8(1q.S&&1q.6O)$(u).V(\'1p\',1q.S);$(u).V(\'2s\',\'2r\'+i);8(1q.1B)u.1B=1q.1B;8(1q.l)$(u).V(\'l\',1q.l);8(1q.L){u.L=P}8(1q.37){u.37=1q.37}$(j).F(u)}$(X).F(j);$(t).1P(X)}g.K=r.A(\'9\');g.1M=r.A(\'9\');g.f=r.A(\'9\');g.E=r.A(\'9\');g.2Z=r.A(\'9\');g.2E=r.A(\'9\');g.17=r.A(\'9\');g.1E=r.A(\'9\');g.z=r.A(\'9\');g.19=r.A(\'9\');g.3h=r.A(\'9\');g.22=r.A(\'9\');g.1e=r.A(\'9\');8(p.3Y)g.I=r.A(\'9\');g.36=r.A(\'2u\');g.K.R=\'4N\';8(p.l!=\'1l\')g.K.1z.l=p.l+\'2b\';8($.J.1k)$(g.K).M(\'5y\');8(p.4d)$(g.K).M(\'4d\');$(t).2c(g.K);$(g.K).F(t);8(p.4c){g.22.R=\'22\';c 2K=r.A(\'9\');2K.R=\'2K\';2A(i=0;i<p.4c.1h;i++){c 1V=p.4c[i];8(!1V.6N){c 1H=r.A(\'9\');1H.R=\'6M\';1H.11="<9><H>"+1V.S+"</H></9>";8(1V.5x)$(\'H\',1H).M(1V.5x).d({2G:20});1H.3w=1V.3w;1H.S=1V.S;8(1V.3w){$(1H).1a(b(){6.3w(6.S,g.K)})}$(2K).F(1H);8($.J.1k&&$.J.1N<7.0){$(1H).1s(b(){$(6).M(\'5w\')},b(){$(6).W(\'5w\')})}}k{$(2K).F("<9 C=\'28\'></9>")}}$(g.22).F(2K);$(g.22).F("<9 1z=\'53:52\'></9>");$(g.K).1P(g.22)}g.f.R=\'f\';$(t).2c(g.f);g.36.5v=0;g.36.5u=0;$(g.f).F(\'<9 C="6L"></9>\');$(\'9\',g.f).F(g.36);c X=$("X:1j",t).42(0);8(X)$(g.36).F(X);X=N;8(!p.5p)c 5o=0;$(\'X j:1j u\',g.f).T(b(){c 35=r.A(\'9\');8($(6).V(\'1p\')){$(6).1a(b(e){8(!$(6).47(\'3r\'))D o;c O=(e.5t||e.5s);8(O.5r||O.24)D P;g.5q(6)});8($(6).V(\'1p\')==p.1o){6.R=\'34\';35.R=\'s\'+p.1g}}8(6.L)$(6).L();8(!p.5p){$(6).V(\'2s\',\'2r\'+5o++)}$(35).d({4b:6.1B,l:6.l+\'2b\'});35.11=6.11;$(6).3v().F(35).3e(\'l\').1Z(b(e){g.2Y(\'5n\',e,6)}).1s(b(){8(!g.12&&!$(6).47(\'3u\')&&!g.16)$(6).M(\'3r\');8($(6).V(\'1p\')!=p.1o&&!g.16&&!g.12&&$(6).V(\'1p\'))$(\'9\',6).M(\'s\'+p.1g);k 8($(6).V(\'1p\')==p.1o&&!g.16&&!g.12&&$(6).V(\'1p\')){c 1T=\'\';8(p.1g==\'2I\')1T=\'46\';k 1T=\'2I\';$(\'9\',6).W(\'s\'+p.1g).M(\'s\'+1T)}8(g.16){c n=$(\'u\',g.f).2d(6);8(n==g.2J)D o;8(n<g.2J)$(6).F(g.2w);k $(6).F(g.2v);g.1S=n}k 8(!g.12){c 1v=$(\'u:Z\',g.f).2d(6);c 49=B($(\'9:U(\'+1v+\')\',g.17).d(\'1c\'));c 1A=B($(g.19).l())+B($(g.19).d(\'33\'));3s=49-1A+3t.4a(p.32/2);$(g.z).L();$(g.19).L();$(g.19).d({\'1c\':3s,1i:g.f.1Q}).1U();c 48=B($(g.z).l());$(g.z).d({1i:g.E.1Q});8((3s+48)>$(g.K).l())$(g.z).d(\'1c\',49-48+1);k $(g.z).d(\'1c\',3s);8($(6).47(\'34\'))$(g.19).M(\'5m\');k $(g.19).W(\'5m\')}},b(){$(6).W(\'3r\');8($(6).V(\'1p\')!=p.1o)$(\'9\',6).W(\'s\'+p.1g);k 8($(6).V(\'1p\')==p.1o){c 1T=\'\';8(p.1g==\'2I\')1T=\'46\';k 1T=\'2I\';$(\'9\',6).M(\'s\'+p.1g).W(\'s\'+1T)}8(g.16){$(g.2w).2H();$(g.2v).2H();g.1S=N}})});g.E.R=\'E\';$(t).2c(g.E);$(g.E).d({G:(p.G==\'1l\')?\'1l\':p.G+"2b"}).45(b(e){g.45()}).F(t);8(p.G==\'1l\'){$(\'2u\',g.E).M(\'6K\')}g.44();g.43();c 14=$(\'X j:1j u:1j\',g.f).42(0);8(14!=N){g.17.R=\'17\';g.1n=0;g.1n+=(1G(B($(\'9\',14).d(\'33\')))?0:B($(\'9\',14).d(\'33\')));g.1n+=(1G(B($(\'9\',14).d(\'3q\')))?0:B($(\'9\',14).d(\'3q\')));g.1n+=(1G(B($(\'9\',14).d(\'2G\')))?0:B($(\'9\',14).d(\'2G\')));g.1n+=(1G(B($(\'9\',14).d(\'3p\')))?0:B($(\'9\',14).d(\'3p\')));g.1n+=(1G(B($(14).d(\'33\')))?0:B($(14).d(\'33\')));g.1n+=(1G(B($(14).d(\'3q\')))?0:B($(14).d(\'3q\')));g.1n+=(1G(B($(14).d(\'2G\')))?0:B($(14).d(\'2G\')));g.1n+=(1G(B($(14).d(\'3p\')))?0:B($(14).d(\'3p\')));$(g.E).2c(g.17);c 5l=$(g.E).G();c 41=$(g.f).G();$(g.17).d({1i:-41+\'2b\'});$(\'X j:1j u\',g.f).T(b(){c 31=r.A(\'9\');$(g.17).F(31);8(!p.32)p.32=$(31).l();$(31).d({G:5l+41}).1Z(b(e){g.2Y(\'12\',e,6)});8($.J.1k&&$.J.1N<7.0){g.2p($(g.K).G());$(31).1s(b(){g.2p();$(6).M(\'2F\')},b(){8(!g.12)$(6).W(\'2F\')})}})}8(p.3o)$(\'1f j:6J\',g.E).M(\'3Z\');8(p.3n&&p.G!=\'1l\'){g.2Z.R=\'4P\';$(g.2Z).1Z(b(e){g.2Y(\'1R\',e)}).1t(\'<H></H>\');$(g.E).2x(g.2Z)}8(p.3n&&p.l!=\'1l\'&&!p.5k){g.2E.R=\'6I\';$(g.2E).1Z(b(e){g.2Y(\'1R\',e,P)}).1t(\'<H></H>\').d(\'G\',$(g.K).G());8($.J.1k&&$.J.1N<7.0){$(g.2E).1s(b(){$(6).M(\'5j\')},b(){$(6).W(\'5j\')})}$(g.K).F(g.2E)}8(p.3Y){g.I.R=\'I\';g.I.11=\'<9 C="3W"></9>\';$(g.E).2x(g.I);c 1t=\' <9 C="2a"> <9 C="5h 29"><H></H></9><9 C="5g 29"><H></H></9> </9> <9 C="28"></9> <9 C="2a"><H C="2D">6H <Q 24="2y" 57="4" 1b="1" /> 5i <H> 1 </H></H></9> <9 C="28"></9> <9 C="2a"> <9 C="5f 29"><H></H></9><9 C="5e 29"><H></H></9> </9> <9 C="28"></9> <9 C="2a"> <9 C="3m 29"><H></H></9> </9> <9 C="28"></9> <9 C="2a"><H C="2X"></H></9>\';$(\'9\',g.I).1t(1t);$(\'.3m\',g.I).1a(b(){g.1L()});$(\'.5h\',g.I).1a(b(){g.2C(\'1j\')});$(\'.5g\',g.I).1a(b(){g.2C(\'2S\')});$(\'.5f\',g.I).1a(b(){g.2C(\'3Q\')});$(\'.5e\',g.I).1a(b(){g.2C(\'5d\')});$(\'.2D Q\',g.I).56(b(e){8(e.55==13)g.2C(\'Q\')});8($.J.1k&&$.J.1N<7)$(\'.29\',g.I).1s(b(){$(6).M(\'5c\')},b(){$(6).W(\'5c\')});8(p.5b){c 3X="";2A(c 2B=0;2B<p.2W.1h;2B++){8(p.1F==p.2W[2B])2z=\'3l="3l"\';k 2z=\'\';3X+="<3k 1b=\'"+p.2W[2B]+"\' "+2z+" >"+p.2W[2B]+"&2V;&2V;</3k>"};$(\'.3W\',g.I).1P("<9 C=\'2a\'><26 S=\'1F\'>"+3X+"</26></9> <9 C=\'28\'></9>");$(\'26\',g.I).6G(b(){8(p.5a)p.5a(+6.1b);k{p.1m=1;p.1F=+6.1b;g.1L()}})}8(p.58){$(\'.3W\',g.I).1P("<9 C=\'2a\'> <9 C=\'59 29\'><H></H></9> </9>  <9 C=\'28\'></9>");$(\'.59\',g.I).1a(b(){$(g.1e).6F(\'6E\',b(){$(\'.1e:Z Q:1j\',g.K).3J(\'3I\')})});g.1e.R=\'1e\';27=p.58;c 3V="";2A(c s=0;s<27.1h;s++){8(p.1u==\'\'&&27[s].6D==P){p.1u=27[s].S;2z=\'3l="3l"\'}k 2z=\'\';3V+="<3k 1b=\'"+27[s].S+"\' "+2z+" >"+27[s].1O+"&2V;&2V;</3k>"}8(p.1u==\'\')p.1u=27[0].S;$(g.1e).F("<9 C=\'6C\'>6B 6A <Q 24=\'2y\' 57=\'30\' S=\'q\' C=\'6z\' /> <26 S=\'1u\'>"+3V+"</26> <Q 24=\'6y\' 1b=\'54\' /></9>");$(\'Q[S=q],26[S=1u]\',g.1e).56(b(e){8(e.55==13)g.3U()});$(\'Q[1b=54]\',g.1e).1a(b(){$(\'Q[S=q]\',g.1e).23(\'\');p.2U=\'\';g.3U()});$(g.E).2x(g.1e)}}$(g.I,g.1e).F("<9 1z=\'53:52\'></9>");8(p.2Q){g.1M.R=\'1M\';g.1M.11=\'<9 C="6x">\'+p.2Q+\'</9>\';$(g.K).1P(g.1M);8(p.6w){$(g.1M).F(\'<9 C="51" 2Q="6v/6u 6t"><H></H></9>\');$(\'9.51\',g.1M).1a(b(){$(g.K).2T(\'6s\');$(6).2T(\'6r\')})}}g.2w=r.A(\'H\');g.2w.R=\'2w\';g.2v=r.A(\'H\');g.2v.R=\'2v\';g.1E.R=\'6q\';c 2t=$(g.E).G();c 3S=g.E.1Q;$(g.1E).d({l:g.E.1z.l,G:2t,6p:\'50\',4Z:\'6o\',3T:(2t*-1),6n:1,1i:3S,1c:\'6m\'});$(g.1E).6l(0,p.4Y);8($(\'u\',g.f).1h){g.z.R=\'z\';g.z.11="<2u 6k=\'0\' 6j=\'0\'><1f></1f></2u>";$(g.z).d({3T:(2t*-1),1O:\'2k\',1i:3S}).2l();c 3j=0;$(\'u 9\',g.f).T(b(){c 4X=$("u[2s=\'2r"+3j+"\']",g.f)[0];c 3R=\'1y="1y"\';8(4X.1z.1O==\'2k\')3R=\'\';$(\'1f\',g.z).F(\'<j><m C="6i"><Q 24="6h" \'+3R+\' C="4T" 1b="\'+3j+\'" /></m><m C="4V">\'+6.11+\'</m></j>\');3j++});8($.J.1k&&$.J.1N<7.0)$(\'j\',g.z).1s(b(){$(6).M(\'4W\')},b(){$(6).W(\'4W\')});$(\'m.4V\',g.z).1a(b(){8($(\'Q:1y\',g.z).1h<=p.3i&&$(6).2S().4U(\'Q\')[0].1y)D o;D g.3M($(6).2S().4U(\'Q\').23())});$(\'Q.4T\',g.z).1a(b(){8($(\'Q:1y\',g.z).1h<p.3i&&6.1y==o)D o;$(6).2R().3Q().3J(\'1a\')});$(g.K).1P(g.z);$(g.19).M(\'19\').1t(\'<9></9>\').V(\'2Q\',\'6g/6f 6e\').1a(b(){$(g.z).6d();D P});8(p.4S)$(g.K).1P(g.19)}$(g.3h).M(\'3h\').d({1O:\'2k\'});$(g.E).F(g.3h);$(g.E).1s(b(){$(g.z).L();$(g.19).L()},b(){8(g.2q)g.2q=o});$(g.K).1s(b(){},b(){$(g.z).L();$(g.19).L()});$(r).6c(b(e){g.4R(e)}).4Q(b(e){g.3P()}).1s(b(){},b(){g.3P()});8($.J.1k&&$.J.1N<7.0){$(\'.f,.E,.1M,.I,.4P,.22, .1e\',g.K).d({l:\'6b%\'});$(g.K).M(\'6a\');8(p.l!=\'1l\')$(g.K).M(\'69\')}g.21();g.2p();t.p=p;t.1D=g;8(p.2o&&p.4O){g.1L()}D t};c 3O=o;$(r).4M(b(){3O=P});$.2m.4N=b(p){D 6.T(b(){8(!3O){$(6).L();c t=6;$(r).4M(b(){$.3N(t,p)})}k{$.3N(6,p)}})};$.2m.68=b(p){D 6.T(b(){8(6.1D&&6.p.2o)6.1D.1L()})};$.2m.67=b(p){D 6.T(b(){8(6.1D)$.4L(6.p,p)})};$.2m.66=b(2n,Z){D 6.T(b(){8(6.1D)6.1D.3M(2n,Z)})};$.2m.65=b(Y){D 6.T(b(){8(6.1D)6.1D.3L(Y)})};$.2m.2l=b(p){8(p==N)3K=P;k 3K=p;8(3K){D 6.T(b(){8($.J.1k||$.J.4J)$(6).4K(\'4I\',b(){D o});k 8($.J.4H){$(6).d(\'4G\',\'2k\');$(\'1x\').3J(\'3I\')}k 8($.J.3g)$(6).4K(\'1Z\',b(){D o});k $(6).V(\'4F\',\'4E\')})}k{D 6.T(b(){8($.J.1k||$.J.4J)$(6).3f(\'4I\');k 8($.J.4H)$(6).d(\'4G\',\'64\');k 8($.J.3g)$(6).3f(\'1Z\');k $(6).3e(\'4F\',\'4E\')})}}})(63);',62,457,'||||||this||if|div||function|var|css||hDiv||||tr|else|width|td||false|||document|||th|||||nDiv|createElement|parseInt|class|return|bDiv|append|height|span|pDiv|browser|gDiv|hide|addClass|null|obj|true|input|className|name|each|eq|attr|removeClass|thead|data|visible||innerHTML|colresize||cdcol||colCopy|cDrag|page|nBtn|click|value|left|newH|sDiv|tbody|sortorder|length|top|first|msie|auto|newp|cdpad|sortname|abbr|cm|total|hover|html|qtype|nv|hset|body|checked|style|nw|align|scrollLeft|grid|block|rp|isNaN|btnDiv|pth|pages|row|populate|mDiv|version|display|prepend|offsetTop|vresize|dcolt|no|show|btn|stat|idx|cdrop|mousedown||rePosDrag|tDiv|val|type||select|sitems|btnseparator|pButton|pGroup|px|before|index|id|loading|dataType|cdrag|ncol|pageX|none|noSelect|fn|cid|url|fixHeight|multisel|col|axis|gh|table|cdropright|cdropleft|after|text|sel|for|nx|changePage|pcontrol|rDiv|dragging|paddingLeft|remove|asc|dcoln|tDiv2|tdDiv|cursor|hgo|cdpos|cdleft|title|parent|prev|toggleClass|query|nbsp|rpOptions|pPageStat|dragStart|vDiv||cgDiv|cgwidth|borderLeftWidth|sorted|thdiv|hTable|process|break|case|cell|dcol|pageY|diff|removeAttr|unbind|opera|iDiv|minColToggle|cn|option|selected|pReload|resizable|striped|paddingRight|borderRightWidth|thOver|nl|Math|thMove|empty|onpress|trSelected|siblings|param|pi|r2|nid|rows|xml|newW|ow|dragtype|focus|trigger|prevent|addData|toggleCol|addFlex|docloaded|dragEnd|next|chk|gtop|marginBottom|doSearch|sopt|pDiv2|opt|usepager|erow||hdheight|get|addRowProp|addCellProp|scroll|desc|hasClass|ndw|onl|floor|textAlign|buttons|novstripe|colModel|pwt|pht|pdt|pdl|wt|ht|pid|substr|prnt|params|hideOnSubmit|onSubmit|replace|to|r1|buildpager|onChangeSort|onSuccess|robj|onToggleCol|cb|minheight|defwidth|resize|hrH|on|unselectable|MozUserSelect|mozilla|selectstart|safari|bind|extend|ready|flexigrid|autoload|vGrip|mouseup|dragMove|showToggleBtn|togCol|find|ndcol2|ndcolover|kcol|blockOpacity|position|white|ptogtitle|both|clear|Clear|keyCode|keydown|size|searchitems|pSearch|onRpChange|useRp|pBtnOver|last|pLast|pNext|pPrev|pFirst|of|hgOver|nohresize|cdheight|srtd|colMove|ci|colmodel|changeSort|href|srcElement|target|cellSpacing|cellPadding|fbOver|bclass|ie|trOver|offsetParent|nowrap|onChangePage|ctype|onError|method|visibility|procmsg|from|pagestat|sasc|sdesc|nomsg|errormsg|preProcess|switchCol|bottom|right|xdiff|sx|sy|nleft|minwidth|ol|startX|200|nd|hdHeight|items|jQuery|inherit|flexAddData|flexToggleCol|flexOptions|flexReload|ie6fullwidthbug|ie6|100|mousemove|toggle|Columns|Show|Hide|checkbox|ndcol1|cellspacing|cellpadding|fadeTo|0px|zIndex|relative|background|gBlock|vsble|hideBody|Table|Maximize|Minimize|showTableToggleBtn|ftitle|button|qsbox|Search|Quick|sDiv2|isdefault|fast|slideToggle|change|Page|hGrip|odd|autoht|hDivBox|fbutton|separator|sortable|pager|shiftKey|singleSelect|paddingTop|offsetLeft|getCellDim|normal|space|switch|catch|try|error|success|ajax|hidden|json|ceil|default|pointer|move|float|absolute|offset|ppos|border|No|wait|please|Processing|Displaying|Error|Connection|POST|80'.split('|'),0,{}))

// Based on "Dynamic Client Side Table Sorting" by Tom Dell'Aringa at http://www.dmxzone.com/

// index of the column that was sorted last. -1 specifies that the user has never clicked a sort column
var lastSort = -1;

// @param tableid string ID of the table to sort (e.g., <table id="rr_table" ...)
// @param sortColumn int Column index to sort (e.g., <tr><th>ID</th><th>Title</th></tr>, 0 = sort by id, 1 = sort by title)
// @param type string Specifies which algorithm to use when comparing values. (e.g., 'string','int','date')
function SortTable(tableid, sortColumn, type)
{
    // get table
    var table = document.getElementById(tableid);
    // get the table body
    var tbody = table.getElementsByTagName('tbody')[0];
    // get all rows of the table body
    var rows = tbody.getElementsByTagName('tr');
    // our new array of rows
    var rowArray = new Array();
    // number of rows we are working with
    var length = rows.length;
    //clone each row for sorting
    for (var i=0; i<length; i++)
    {
		// Ignore TH headers
		if (rows[i].getElementsByTagName('td').length > 0) {
			rowArray[i] = rows[i].cloneNode(true);
		}
    }
    // if user clicked on column 1 header two times in a row (for example)
    if (sortColumn == lastSort)
    {
        // merely reverse the array
        rowArray.reverse();
    }
    // else user is sorting by a different column header
    else
    {
        // save the index of the column we are sorting by in case we need to reverse
        lastSort = sortColumn;
        // what type of values exist in the column? string, int, date, float?
        switch(type)
        {
            // sort by number
            case 'float':
                rowArray.sort(RowCompareNumbers);
                break;
            // sort by integer
            case 'int':
                rowArray.sort(RowCompareIntegers);
                break;
            // sort by string/text
            case 'string':
                rowArray.sort(RowCompare);
                break;
            // sort by date
            case 'date':
                rowArray.sort(RowCompareDates);
                break;
        }
    }
    // create our new tbody to replace the old one
    var newTbody = document.createElement('tbody');
    var length = rowArray.length;
    var rowclass = '';
    // append all of our newly sorted rows
    for (var i=0; i<length; i++)
    {
        // determine row class (e.g., use "even" or "odd" css class)
        rowclass = (i % 2) ? 'erow' : '';
        // set class
        rowArray[i].className = rowclass;
        // append row to new tbody
        newTbody.appendChild(rowArray[i]);
    }
    // replace old data with new data
    table.replaceChild(newTbody, tbody);
}

// @param tableid string ID of the table to sort (e.g., <table id="rr_table" ...)
// @param sortColumn int Column index to sort (e.g., <tr><th>ID</th><th>Title</th></tr>, 0 = sort by id, 1 = sort by title)
// @param type string Specifies which algorithm to use when comparing values. (e.g., 'string','int','date')
function SortTableScore(tableid, sortColumn, type)
{
    // get table
    var table = document.getElementById(tableid);
    // get the table body
    var tbody = table.getElementsByTagName('tbody')[0];
    // get all rows of the table body
    var rows = tbody.getElementsByTagName('tr');
    // our new array of rows
    var rowArray = new Array();
    // number of rows we are working with
    var length = rows.length;
    //clone each row for sorting
    for (var i=0; i<length; i++)
    {
		// Ignore TH headers
		if (rows[i].getElementsByTagName('td').length > 0) {
			rowArray[i] = rows[i].cloneNode(true);
		}
    }
    // if user clicked on column 1 header two times in a row (for example)
    if (sortColumn == lastSort)
    {
        // merely reverse the array
        rowArray.reverse();
    }
    // else user is sorting by a different column header
    else
    {
        // save the index of the column we are sorting by in case we need to reverse
        lastSort = sortColumn;
        // what type of values exist in the column? string, int, date, float?
        switch(type)
        {
            // sort by number
            case 'float':
                rowArray.sort(RowCompareNumbers);
                break;
            // sort by integer
            case 'int':
                rowArray.sort(RowCompareIntegers);
                break;
            // sort by string/text
            case 'string':
                rowArray.sort(RowCompare);
                break;
            // sort by date
            case 'date':
                rowArray.sort(RowCompareDates);
                break;
        }
    }
    // create our new tbody to replace the old one
    var newTbody = document.createElement('tbody');
    var length = rowArray.length;
    var rowclass = 'odd';
    // append all of our newly sorted rows
    for (var i=0; i<length; i++)
    {
        // determine row class (e.g., use "even" or "odd" css class)
        //rowclass = (i % 2) ? 'even' : 'odd';
        // set class
        //rowArray[i].className = rowclass;
        // append row to new tbody
        newTbody.appendChild(rowArray[i]);
    }
    // replace old data with new data
    table.replaceChild(newTbody, tbody);
}
// Text sort
function RowCompare(a, b)
{
	// Get all innerHtml
    var aValPre = a.getElementsByTagName('td')[lastSort].innerHTML.toLowerCase();
    var bValPre = b.getElementsByTagName('td')[lastSort].innerHTML.toLowerCase();
	// Remove all html
    var aValStripTags = aValPre.replace(/(<([^>]+)>)/ig,"").replace(/^\s*|\s*$/g,"");
    var bValStripTags = bValPre.replace(/(<([^>]+)>)/ig,"").replace(/^\s*|\s*$/g,"");
	// If contains only html and nothing else, then leave html (so we have something to compare against), else strip all tags
	var aVal = (aValStripTags.length==0) ? aValPre : aValStripTags;
	var bVal = (bValStripTags.length==0) ? bValPre : bValStripTags;
    var rVal;
    if(aVal == bVal)
    {
        rVal = 0;
    }
    else
    {
        if(aVal > bVal)
        {
              rVal = 1;
        }
        else
        {
              rVal = -1;
        }
    }
    return rVal;
}
// Integer sort
function RowCompareIntegers(a, b)
{
    var aVal = parseInt(a.getElementsByTagName('td')[lastSort].innerHTML.replace(/(<([^>]+)>)/ig,""), 10);
    var bVal = parseInt(b.getElementsByTagName('td')[lastSort].innerHTML.replace(/(<([^>]+)>)/ig,""), 10);
    return (aVal - bVal);
}
// Number sort
function RowCompareNumbers(a, b)
{
    var aVal = a.getElementsByTagName('td')[lastSort].innerHTML.replace(/(<([^>]+)>)/ig,"")*1;
    var bVal = b.getElementsByTagName('td')[lastSort].innerHTML.replace(/(<([^>]+)>)/ig,"")*1;
    return (aVal - bVal);
}
// Date sort
function RowCompareDates(a, b)
{
	var aVal = a.getElementsByTagName('td')[lastSort].innerHTML;
	var bVal = b.getElementsByTagName('td')[lastSort].innerHTML;

	if((a == '' || aVal == '&nbsp;') && (bVal == '' || bVal == '&nbsp;'))
		return 0;
	if(a == '' || aVal == '&nbsp;')
		return -1;
	if(bVal == '' || bVal == '&nbsp;')
		return 1;

    aVal = Date.parse(aVal.replace(/(<([^>]+)>)/ig,""));
    bVal = Date.parse(bVal.replace(/(<([^>]+)>)/ig,""));
    return (aVal - bVal);
}
// Quicksearch for searching text in html tables
jQuery(function ($) {
    $.fn.quicksearch = function (target, opt) {
	var timeout, cache, rowcache, jq_results, val = '', e = this, options = $.extend({
	    delay: 100,
	    selector: null,
	    stripeRows: null,
	    loader: null,
	    noResults: '',
	    bind: 'keyup',
	    onBefore: function () {
		return;
	    },
	    onAfter: function () {
		return;
	    },
	    show: function () {
		this.style.display = "";
	    },
	    hide: function () {
		this.style.display = "none";
	    }
	}, opt);

	this.go = function () {

	    var i = 0, noresults = true, vals = val.toLowerCase().split(' ');

	    var rowcache_length = rowcache.length;
	    for (var i = 0; i < rowcache_length; i++)
	    {
		if (this.test(vals, cache[i]) || val == "") {
		    options.show.apply(rowcache[i]);
		    noresults = false;
		} else {
		    options.hide.apply(rowcache[i]);
		}
	    }

	    if (noresults) {
		this.results(false);
	    } else {
		this.results(true);
		this.stripe();
	    }

	    this.loader(false);
	    options.onAfter();

	    return this;
	};

	this.stripe = function () {

	    if (typeof options.stripeRows === "object" && options.stripeRows !== null)
	    {
		var joined = options.stripeRows.join(' ');
		var stripeRows_length = options.stripeRows.length;

		jq_results.not(':hidden').each(function (i) {
		    $(this).removeClass(joined).addClass(options.stripeRows[i % stripeRows_length]);
		});
	    }

	    return this;
	};

	this.strip_html = function (input) {
	    var output = input.replace(/<\/?[^>]+>/gi, '');
	    output = $.trim(output.toLowerCase());
	    return output;
	};

	this.results = function (bool) {
	    if (typeof options.noResults === "string" && options.noResults !== "") {
		if (bool) {
		    $(options.noResults).hide();
		} else {
		    $(options.noResults).show();
		}
	    }
	    return this;
	};

	this.loader = function (bool) {
	    if (typeof options.loader === "string" && options.loader !== "") {
		(bool) ? $(options.loader).show() : $(options.loader).hide();
	    }
	    return this;
	};

	this.test = function (vals, t) {
	    for (var i = 0; i < vals.length; i += 1) {
		if (t.indexOf(vals[i]) === -1) {
		    return false;
		}
	    }
	    return true;
	};

	this.cache = function () {

	    jq_results = $(target);

	    if (typeof options.noResults === "string" && options.noResults !== "") {
		jq_results = jq_results.not(options.noResults);
	    }

	    var t = (typeof options.selector === "string") ? jq_results.find(options.selector) : $(target).not(options.noResults);
	    cache = t.map(function () {
		return e.strip_html(this.innerHTML);
	    });

	    rowcache = jq_results.map(function () {
		return this;
	    });

	    return this.go();
	};

	this.trigger = function () {
	    this.loader(true);
	    options.onBefore();

	    window.clearTimeout(timeout);
	    timeout = window.setTimeout(function () {
		e.go();
	    }, options.delay);

	    return this;
	};

	this.cache();
	this.results(true);
	this.stripe();
	this.loader(false);

	return this.each(function () {
	    $(this).bind(options.bind, function () {
		val = $(this).val();
		e.trigger();
	    });
	});

    };
});


/*
 * jQuery doTimeout: Like setTimeout, but better! - v1.0 - 3/3/2010
 * http://benalman.com/projects/jquery-dotimeout-plugin/
 *
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($){var a={},c="doTimeout",d=Array.prototype.slice;$[c]=function(){return b.apply(window,[0].concat(d.call(arguments)))};$.fn[c]=function(){var f=d.call(arguments),e=b.apply(this,[c+f[0]].concat(f));return typeof f[0]==="number"||typeof f[1]==="number"?this:e};function b(l){var m=this,h,k={},g=l?$.fn:$,n=arguments,i=4,f=n[1],j=n[2],p=n[3];if(typeof f!=="string"){i--;f=l=0;j=n[1];p=n[2]}if(l){h=m.eq(0);h.data(l,k=h.data(l)||{})}else{if(f){k=a[f]||(a[f]={})}}k.id&&clearTimeout(k.id);delete k.id;function e(){if(l){h.removeData(l)}else{if(f){delete a[f]}}}function o(){k.id=setTimeout(function(){k.fn()},j)}if(p){k.fn=function(q){if(typeof p==="string"){p=g[p]}p.apply(m,d.call(n,i))===true&&!q?o():e()};o()}else{if(k.fn){j===undefined?e():k.fn(j===false);return true}else{e()}}}})(jQuery);

/****************************************************************************************************/
// FormChek.js
//
// SUMMARY
//
// This is a set of JavaScript functions for validating input on
// an HTML form.  Functions are provided to validate:
//
//      - U.S. and international phone/fax numbers
//      - U.S. ZIP codes (5 or 9 digit postal codes)
//      - U.S. Postal Codes (2 letter abbreviations for names of states)
//      - U.S. Social Security Numbers (abbreviated as SSNs)
//      - email addresses
//	- dates (entry of year, month, and day and validity of combined date)
//	- credit card numbers
//
// Supporting utility functions validate that:
//
//      - characters are Letter, Digit, or LetterOrDigit
//      - strings are a Signed, Positive, Negative, Nonpositive, or
//        Nonnegative integer
//      - strings are a Float or a SignedFloat
//      - strings are Alphabetic, Alphanumeric, or Whitespace
//      - strings contain an integer within a specified range
//
// Functions are also provided to interactively check the
// above kinds of data and prompt the user if they have
// been entered incorrectly.
//
// Other utility functions are provided to:
//
// 	- remove from a string characters which are/are not
//	  in a "bag" of selected characters
// 	- reformat a string, adding delimiter characters
//	- strip whitespace/leading whitespace from a string
//      - reformat U.S. phone numbers, ZIP codes, and Social
//        Security numbers
//
//
// Many of the below functions take an optional parameter eok (for "emptyOK")
// which determines whether the empty string will return true or false.
// Default behavior is controlled by global variable defaultEmptyOK.
//
// BASIC DATA VALIDATION FUNCTIONS:
//
// isWhitespace (s)                    Check whether string s is empty or whitespace.
// isLetter (c)                        Check whether character c is an English letter
// isDigit (c)                         Check whether character c is a digit
// isLetterOrDigit (c)                 Check whether character c is a letter or digit.
// isInteger (s [,eok])                True if all characters in string s are numbers.
// isSignedInteger (s [,eok])          True if all characters in string s are numbers; leading + or - allowed.
// isPositiveInteger (s [,eok])        True if string s is an integer > 0.
// isNonnegativeInteger (s [,eok])     True if string s is an integer >= 0.
// isNegativeInteger (s [,eok])        True if s is an integer < 0.
// isNonpositiveInteger (s [,eok])     True if s is an integer <= 0.
// isFloat (s [,eok])                  True if string s is an unsigned floating point (real) number. (Integers also OK.)
// isSignedFloat (s [,eok])            True if string s is a floating point number; leading + or - allowed. (Integers also OK.)
// isAlphabetic (s [,eok])             True if string s is English letters
// isAlphanumeric (s [,eok])           True if string s is English letters and numbers only.
//
// isSSN (s [,eok])                    True if string s is a valid U.S. Social Security Number.
// isUSPhoneNumber (s [,eok])          True if string s is a valid U.S. Phone Number.
// isInternationalPhoneNumber (s [,eok]) True if string s is a valid international phone number.
// isZIPCode (s [,eok])                True if string s is a valid U.S. ZIP code.
// isStateCode (s [,eok])              True if string s is a valid U.S. Postal Code
// isEmail (s [,eok])                  True if string s is a valid email address.
// isYear (s [,eok])                   True if string s is a valid Year number.
// isIntegerInRange (s, a, b [,eok])   True if string s is an integer between a and b, inclusive.
// isMonth (s [,eok])                  True if string s is a valid month between 1 and 12.
// isDay (s [,eok])                    True if string s is a valid day between 1 and 31.
// daysInFebruary (year)               Returns number of days in February of that year.
// isDate (year, month, day)           True if string arguments form a valid date.


// FUNCTIONS TO REFORMAT DATA:
//
// stripCharsInBag (s, bag)            Removes all characters in string bag from string s.
// stripCharsNotInBag (s, bag)         Removes all characters NOT in string bag from string s.
// stripWhitespace (s)                 Removes all whitespace characters from s.
// stripInitialWhitespace (s)          Removes initial (leading) whitespace characters from s.
// reformat (TARGETSTRING, STRING,     Function for inserting formatting characters or
//   INTEGER, STRING, INTEGER ... )       delimiters into TARGETSTRING.
// reformatZIPCode (ZIPString)         If 9 digits, inserts separator hyphen.
// reformatSSN (SSN)                   Reformats as 123-45-6789.
// reformatUSPhone (USPhone)           Reformats as (123) 456-789.


// FUNCTIONS TO PROMPT USER:
//
// prompt (s)                          Display prompt string s in status bar.
// promptEntry (s)                     Display data entry prompt string s in status bar.
// warnEmpty (theField, s)             Notify user that required field theField is empty.
// warnInvalid (theField, s)           Notify user that contents of field theField are invalid.


// FUNCTIONS TO INTERACTIVELY CHECK FIELD CONTENTS:
//
// checkString (theField, s [,eok])    Check that theField.value is not empty or all whitespace.
// checkStateCode (theField)           Check that theField.value is a valid U.S. state code.
// checkZIPCode (theField [,eok])      Check that theField.value is a valid ZIP code.
// checkUSPhone (theField [,eok])      Check that theField.value is a valid US Phone.
// checkInternationalPhone (theField [,eok])  Check that theField.value is a valid International Phone.
// checkEmail (theField [,eok])        Check that theField.value is a valid Email.
// checkSSN (theField [,eok])          Check that theField.value is a valid SSN.
// checkYear (theField [,eok])         Check that theField.value is a valid Year.
// checkMonth (theField [,eok])        Check that theField.value is a valid Month.
// checkDay (theField [,eok])          Check that theField.value is a valid Day.
// checkDate (yearField, monthField, dayField, labelString, OKtoOmitDay)
//                                     Check that field values form a valid date.
// getRadioButtonValue (radio)         Get checked value from radio button.
// checkCreditCard (radio, theField)   Validate credit card info.


// CREDIT CARD DATA VALIDATION FUNCTIONS
//
// isCreditCard (st)              True if credit card number passes the Luhn Mod-10 test.
// isVisa (cc)                    True if string cc is a valid VISA number.
// isMasterCard (cc)              True if string cc is a valid MasterCard number.
// isAmericanExpress (cc)         True if string cc is a valid American Express number.
// isDinersClub (cc)              True if string cc is a valid Diner's Club number.
// isCarteBlanche (cc)            True if string cc is a valid Carte Blanche number.
// isDiscover (cc)                True if string cc is a valid Discover card number.
// isEnRoute (cc)                 True if string cc is a valid enRoute card number.
// isJCB (cc)                     True if string cc is a valid JCB card number.
// isAnyCard (cc)                 True if string cc is a valid card number for any of the accepted types.
// isCardMatch (Type, Number)     True if Number is valid for credic card of type Type.
//
// Other stub functions are retained for backward compatibility with LivePayment code.
// See comments below for details.
//
// Performance hint: when you deploy this file on your website, strip out the
// comment lines from the source code as well as any of the functions which
// you don't need.  This will give you a smaller .js file and achieve faster
// downloads.
//
// 18 Feb 97 created Eric Krock
//
// (c) 1997 Netscape Communications Corporation



// VARIABLE DECLARATIONS

var digits = "0123456789";

var lowercaseLetters = "abcdefghijklmnopqrstuvwxyz"

var uppercaseLetters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"


// whitespace characters
var whitespace = " \t\n\r";


// decimal point character differs by language and culture
var decimalPointDelimiter = "."


// non-digit characters which are allowed in phone numbers
var phoneNumberDelimiters = "()- ";


// characters which are allowed in US phone numbers
var validUSPhoneChars = digits + phoneNumberDelimiters;


// characters which are allowed in international phone numbers
// (a leading + is OK)
var validWorldPhoneChars = digits + phoneNumberDelimiters + "+";


// non-digit characters which are allowed in
// Social Security Numbers
var SSNDelimiters = "- ";



// characters which are allowed in Social Security Numbers
var validSSNChars = digits + SSNDelimiters;



// U.S. Social Security Numbers have 9 digits.
// They are formatted as 123-45-6789.
var digitsInSocialSecurityNumber = 9;



// U.S. phone numbers have 10 digits.
// They are formatted as 123 456 7890 or (123) 456-7890.
var digitsInUSPhoneNumber = 10;



// non-digit characters which are allowed in ZIP Codes
var ZIPCodeDelimiters = "-";



// our preferred delimiter for reformatting ZIP Codes
var ZIPCodeDelimeter = "-"


// characters which are allowed in Social Security Numbers
var validZIPCodeChars = digits + ZIPCodeDelimiters



// U.S. ZIP codes have 5 or 9 digits.
// They are formatted as 12345 or 12345-6789.
var digitsInZIPCode1 = 5
var digitsInZIPCode2 = 9


// non-digit characters which are allowed in credit card numbers
var creditCardDelimiters = " "


// CONSTANT STRING DECLARATIONS
// (grouped for ease of translation and localization)

// m is an abbreviation for "missing"
var mPrefix = "You did not enter a value into the "
var mSuffix = " field. This is a required field. Please enter it now."

// s is an abbreviation for "string"
var sUSLastName = "Last Name"
var sUSFirstName = "First Name"
var sWorldLastName = "Family Name"
var sWorldFirstName = "Given Name"
var sTitle = "Title"
var sCompanyName = "Company Name"
var sUSAddress = "Street Address"
var sWorldAddress = "Address"
var sCity = "City"
var sStateCode = "State Code"
var sWorldState = "State, Province, or Prefecture"
var sCountry = "Country"
var sZIPCode = "ZIP Code"
var sWorldPostalCode = "Postal Code"
var sPhone = "Phone Number"
var sFax = "Fax Number"
var sDateOfBirth = "Date of Birth"
var sExpirationDate = "Expiration Date"
var sEmail = "Email"
var sSSN = "Social Security Number"
var sCreditCardNumber = "Credit Card Number"
var sOtherInfo = "Other Information"

// i is an abbreviation for "invalid"
var iZIPCode = "This field must be a 5 or 9 digit U.S. ZIP Code (like 94043). Please re-enter it now.";
var iUSPhone = "This field must be a 10 digit U.S. phone number. Please use a format such as (999) 999-9999, 999-999-9999, 9999999999, or with an extension such as (999) 999-9999 x9999 or 999-999-9999x999. Please re-enter it now.";
var iEmail = "This field must be a valid email address (like joe@user.com). Please re-enter it now.";
var iStateCode = "This field must be a valid two character U.S. state abbreviation (like CA for California). Please re-enter it now."
var iWorldPhone = "This field must be a valid international phone number. Please re-enter it now."
var iSSN = "This field must be a 9 digit U.S. social security number (like 123 45 6789). Please re-enter it now."
var iCreditCardPrefix = "This is not a valid "
var iCreditCardSuffix = " credit card number. (Click the link on this form to see a list of sample numbers.) Please re-enter it now."
var iDay = "This field must be a day number between 1 and 31.  Please re-enter it now."
var iMonth = "This field must be a month number between 1 and 12.  Please re-enter it now."
var iYear = "This field must be a 2 or 4 digit year number.  Please re-enter it now."
var iDatePrefix = "The Day, Month, and Year for "
var iDateSuffix = " do not form a valid date.  Please re-enter them now."

// p is an abbreviation for "prompt"
var pEntryPrompt = "Please enter a "
var pStateCode = "2 character code (like CA)."
var pZIPCode = "5 or 9 digit U.S. ZIP Code (like 94043)."
var pUSPhone = "10 digit U.S. phone number (like 415 555 1212)."
var pWorldPhone = "international phone number."
var pSSN = "9 digit U.S. social security number (like 123 45 6789)."
var pEmail = "valid email address (like joe@user.com)."
var pCreditCard = "valid credit card number."
var pDay = "day number between 1 and 31."
var pMonth = "month number between 1 and 12."
var pYear = "2 or 4 digit year number."


// Global variable defaultEmptyOK defines default return value
// for many functions when they are passed the empty string.
// By default, they will return defaultEmptyOK.
//
// defaultEmptyOK is false, which means that by default,
// these functions will do "strict" validation.  Function
// isInteger, for example, will only return true if it is
// passed a string containing an integer; if it is passed
// the empty string, it will return false.
//
// You can change this default behavior globally (for all
// functions which use defaultEmptyOK) by changing the value
// of defaultEmptyOK.
//
// Most of these functions have an optional argument emptyOK
// which allows you to override the default behavior for
// the duration of a function call.
//
// This functionality is useful because it is possible to
// say "if the user puts anything in this field, it must
// be an integer (or a phone number, or a string, etc.),
// but it's OK to leave the field empty too."
// This is the case for fields which are optional but which
// must have a certain kind of content if filled in.

var defaultEmptyOK = false




// Attempting to make this library run on Navigator 2.0,
// so I'm supplying this array creation routine as per
// JavaScript 1.0 documentation.  If you're using
// Navigator 3.0 or later, you don't need to do this;
// you can use the Array constructor instead.

function makeArray(n) {
//*** BUG: If I put this line in, I get two error messages:
//(1) Window.length can't be set by assignment
//(2) daysInMonth has no property indexed by 4
//If I leave it out, the code works fine.
//   this.length = n;
   for (var i = 1; i <= n; i++) {
      this[i] = 0
   }
   return this
}



var daysInMonth = makeArray(12);
daysInMonth[1] = 31;
daysInMonth[2] = 29;   // must programmatically check this
daysInMonth[3] = 31;
daysInMonth[4] = 30;
daysInMonth[5] = 31;
daysInMonth[6] = 30;
daysInMonth[7] = 31;
daysInMonth[8] = 31;
daysInMonth[9] = 30;
daysInMonth[10] = 31;
daysInMonth[11] = 30;
daysInMonth[12] = 31;




// Valid U.S. Postal Codes for states, territories, armed forces, etc.
// See http://www.usps.gov/ncsc/lookups/abbr_state.txt.

var USStateCodeDelimiter = "|";
var USStateCodes = "AL|AK|AS|AZ|AR|CA|CO|CT|DE|DC|FM|FL|GA|GU|HI|ID|IL|IN|IA|KS|KY|LA|ME|MH|MD|MA|MI|MN|MS|MO|MT|NE|NV|NH|NJ|NM|NY|NC|ND|MP|OH|OK|OR|PW|PA|PR|RI|SC|SD|TN|TX|UT|VT|VI|VA|WA|WV|WI|WY|AE|AA|AE|AE|AP"




// Check whether string s is empty.

function isEmpty(s)
{   return ((s == null) || (s.length == 0))
}



// Returns true if string s is empty or
// whitespace characters only.

function isWhitespace (s)

{   var i;

    // Is s empty?
    if (isEmpty(s)) return true;

    // Search through string's characters one by one
    // until we find a non-whitespace character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);

        if (whitespace.indexOf(c) == -1) return false;
    }

    // All characters are whitespace.
    return true;
}



// Removes all characters which appear in string bag from string s.

function stripCharsInBag (s, bag)

{   var i;
    var returnString = "";

    // Search through string's characters one by one.
    // If character is not in bag, append to returnString.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) == -1) returnString += c;
    }

    return returnString;
}



// Removes all characters which do NOT appear in string bag
// from string s.

function stripCharsNotInBag (s, bag)

{   var i;
    var returnString = "";

    // Search through string's characters one by one.
    // If character is in bag, append to returnString.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character isn't whitespace.
        var c = s.charAt(i);
        if (bag.indexOf(c) != -1) returnString += c;
    }

    return returnString;
}



// Removes all whitespace characters from s.
// Global variable whitespace (see above)
// defines which characters are considered whitespace.

function stripWhitespace (s)

{   return stripCharsInBag (s, whitespace)
}




// WORKAROUND FUNCTION FOR NAVIGATOR 2.0.2 COMPATIBILITY.
//
// The below function *should* be unnecessary.  In general,
// avoid using it.  Use the standard method indexOf instead.
//
// However, because of an apparent bug in indexOf on
// Navigator 2.0.2, the below loop does not work as the
// body of stripInitialWhitespace:
//
// while ((i < s.length) && (whitespace.indexOf(s.charAt(i)) != -1))
//   i++;
//
// ... so we provide this workaround function charInString
// instead.
//
// charInString (CHARACTER c, STRING s)
//
// Returns true if single character c (actually a string)
// is contained within string s.

function charInString (c, s)
{   for (i = 0; i < s.length; i++)
    {   if (s.charAt(i) == c) return true;
    }
    return false
}



// Removes initial (leading) whitespace characters from s.
// Global variable whitespace (see above)
// defines which characters are considered whitespace.

function stripInitialWhitespace (s)

{   var i = 0;

    while ((i < s.length) && charInString (s.charAt(i), whitespace))
       i++;

    return s.substring (i, s.length);
}







// Returns true if character c is an English letter
// (A .. Z, a..z).
//
// NOTE: Need i18n version to support European characters.
// This could be tricky due to different character
// sets and orderings for various languages and platforms.

function isLetter (c)
{   return ( ((c >= "a") && (c <= "z")) || ((c >= "A") && (c <= "Z")) )
}



// Returns true if character c is a digit
// (0 .. 9).

function isDigit (c)
{   return ((c >= "0") && (c <= "9"))
}



// Returns true if character c is a letter or digit.

function isLetterOrDigit (c)
{   return (isLetter(c) || isDigit(c))
}



// isInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if all characters in string s are numbers.
//
// Accepts non-signed integers only. Does not accept floating
// point, exponential notation, etc.
//
// We don't use parseInt because that would accept a string
// with trailing non-numeric characters.
//
// By default, returns defaultEmptyOK if s is empty.
// There is an optional second argument called emptyOK.
// emptyOK is used to override for a single function call
//      the default behavior which is specified globally by
//      defaultEmptyOK.
// If emptyOK is false (or any value other than true),
//      the function will return false if s is empty.
// If emptyOK is true, the function will return true if s is empty.
//
// EXAMPLE FUNCTION CALL:     RESULT:
// isInteger ("5")            true
// isInteger ("")             defaultEmptyOK
// isInteger ("-5")           false
// isInteger ("", true)       true
// isInteger ("", false)      false
// isInteger ("5", false)     true

function isInteger (s)

{   var i;

    if (isEmpty(s))
       if (isInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isInteger.arguments[1] == true);

    // Search through string's characters one by one
    // until we find a non-numeric character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number.
        var c = s.charAt(i);

        if (!isDigit(c)) return false;
    }

    // All characters are numbers.
    return true;
}







// isSignedInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if all characters are numbers;
// first character is allowed to be + or - as well.
//
// Does not accept floating point, exponential notation, etc.
//
// We don't use parseInt because that would accept a string
// with trailing non-numeric characters.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.
//
// EXAMPLE FUNCTION CALL:          RESULT:
// isSignedInteger ("5")           true
// isSignedInteger ("")            defaultEmptyOK
// isSignedInteger ("-5")          true
// isSignedInteger ("+5")          true
// isSignedInteger ("", false)     false
// isSignedInteger ("", true)      true

function isSignedInteger (s)

{   if (isEmpty(s))
       if (isSignedInteger.arguments.length == 1) return defaultEmptyOK;
       else return (isSignedInteger.arguments[1] == true);

    else {
        var startPos = 0;
        var secondArg = defaultEmptyOK;

        if (isSignedInteger.arguments.length > 1)
            secondArg = isSignedInteger.arguments[1];

        // skip leading + or -
        if ( (s.charAt(0) == "-") || (s.charAt(0) == "+") )
           startPos = 1;
        return (isInteger(s.substring(startPos, s.length), secondArg))
    }
}




// isPositiveInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is an integer > 0.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isPositiveInteger (s)
{   var secondArg = defaultEmptyOK;

    if (isPositiveInteger.arguments.length > 1)
        secondArg = isPositiveInteger.arguments[1];

    // The next line is a bit byzantine.  What it means is:
    // a) s must be a signed integer, AND
    // b) one of the following must be true:
    //    i)  s is empty and we are supposed to return true for
    //        empty strings
    //    ii) this is a positive, not negative, number

    return (isSignedInteger(s, secondArg)
         && ( (isEmpty(s) && secondArg)  || (parseInt (s) > 0) ) );
}






// isNonnegativeInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is an integer >= 0.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isNonnegativeInteger (s)
{   var secondArg = defaultEmptyOK;

    if (isNonnegativeInteger.arguments.length > 1)
        secondArg = isNonnegativeInteger.arguments[1];

    // The next line is a bit byzantine.  What it means is:
    // a) s must be a signed integer, AND
    // b) one of the following must be true:
    //    i)  s is empty and we are supposed to return true for
    //        empty strings
    //    ii) this is a number >= 0

    return (isSignedInteger(s, secondArg)
         && ( (isEmpty(s) && secondArg)  || (parseInt (s) >= 0) ) );
}






// isNegativeInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is an integer < 0.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isNegativeInteger (s)
{   var secondArg = defaultEmptyOK;

    if (isNegativeInteger.arguments.length > 1)
        secondArg = isNegativeInteger.arguments[1];

    // The next line is a bit byzantine.  What it means is:
    // a) s must be a signed integer, AND
    // b) one of the following must be true:
    //    i)  s is empty and we are supposed to return true for
    //        empty strings
    //    ii) this is a negative, not positive, number

    return (isSignedInteger(s, secondArg)
         && ( (isEmpty(s) && secondArg)  || (parseInt (s) < 0) ) );
}






// isNonpositiveInteger (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is an integer <= 0.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isNonpositiveInteger (s)
{   var secondArg = defaultEmptyOK;

    if (isNonpositiveInteger.arguments.length > 1)
        secondArg = isNonpositiveInteger.arguments[1];

    // The next line is a bit byzantine.  What it means is:
    // a) s must be a signed integer, AND
    // b) one of the following must be true:
    //    i)  s is empty and we are supposed to return true for
    //        empty strings
    //    ii) this is a number <= 0

    return (isSignedInteger(s, secondArg)
         && ( (isEmpty(s) && secondArg)  || (parseInt (s) <= 0) ) );
}





// isFloat (STRING s [, BOOLEAN emptyOK])
//
// True if string s is an unsigned floating point (real) number.
//
// Also returns true for unsigned integers. If you wish
// to distinguish between integers and floating point numbers,
// first call isInteger, then call isFloat.
//
// Does not accept exponential notation.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isFloat (s)

{   var i;
    var seenDecimalPoint = false;

    if (isEmpty(s))
       if (isFloat.arguments.length == 1) return defaultEmptyOK;
       else return (isFloat.arguments[1] == true);

    if (s == decimalPointDelimiter) return false;

    // Search through string's characters one by one
    // until we find a non-numeric character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number.
        var c = s.charAt(i);

        if ((c == decimalPointDelimiter) && !seenDecimalPoint) seenDecimalPoint = true;
        else if (!isDigit(c)) return false;
    }

    // All characters are numbers.
    return true;
}







// isSignedFloat (STRING s [, BOOLEAN emptyOK])
//
// True if string s is a signed or unsigned floating point
// (real) number. First character is allowed to be + or -.
//
// Also returns true for unsigned integers. If you wish
// to distinguish between integers and floating point numbers,
// first call isSignedInteger, then call isSignedFloat.
//
// Does not accept exponential notation.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isSignedFloat (s) {
	if (isEmpty(s)) {
       if (isSignedFloat.arguments.length == 1) {
			return defaultEmptyOK;
		} else {
			return (isSignedFloat.arguments[1] == true);
		}
    } else {
        var startPos = 0;
        var secondArg = defaultEmptyOK;
        if (isSignedFloat.arguments.length > 1) {
            secondArg = isSignedFloat.arguments[1];
		}
        // skip leading + or -
        if ( (s.charAt(0) == "-") || (s.charAt(0) == "+") ) {
			startPos = 1;
		}
        return (isFloat(s.substring(startPos, s.length), secondArg))
    }
}


// isAlphabetic (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is English letters
// (A .. Z, a..z) only.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.
//
// NOTE: Need i18n version to support European characters.
// This could be tricky due to different character
// sets and orderings for various languages and platforms.

function isAlphabetic (s)

{   var i;

    if (isEmpty(s))
       if (isAlphabetic.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphabetic.arguments[1] == true);

    // Search through string's characters one by one
    // until we find a non-alphabetic character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character is letter.
        var c = s.charAt(i);

        if (!isLetter(c))
        return false;
    }

    // All characters are letters.
    return true;
}




// isAlphanumeric (STRING s [, BOOLEAN emptyOK])
//
// Returns true if string s is English letters
// (A .. Z, a..z) and numbers only.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.
//
// NOTE: Need i18n version to support European characters.
// This could be tricky due to different character
// sets and orderings for various languages and platforms.

function isAlphanumeric (s)

{   var i;

    if (isEmpty(s))
       if (isAlphanumeric.arguments.length == 1) return defaultEmptyOK;
       else return (isAlphanumeric.arguments[1] == true);

    // Search through string's characters one by one
    // until we find a non-alphanumeric character.
    // When we do, return false; if we don't, return true.

    for (i = 0; i < s.length; i++)
    {
        // Check that current character is number or letter.
        var c = s.charAt(i);

        if (! (isLetter(c) || isDigit(c) ) )
        return false;
    }

    // All characters are numbers or letters.
    return true;
}




// reformat (TARGETSTRING, STRING, INTEGER, STRING, INTEGER ... )
//
// Handy function for arbitrarily inserting formatting characters
// or delimiters of various kinds within TARGETSTRING.
//
// reformat takes one named argument, a string s, and any number
// of other arguments.  The other arguments must be integers or
// strings.  These other arguments specify how string s is to be
// reformatted and how and where other strings are to be inserted
// into it.
//
// reformat processes the other arguments in order one by one.
// * If the argument is an integer, reformat appends that number
//   of sequential characters from s to the resultString.
// * If the argument is a string, reformat appends the string
//   to the resultString.
//
// NOTE: The first argument after TARGETSTRING must be a string.
// (It can be empty.)  The second argument must be an integer.
// Thereafter, integers and strings must alternate.  This is to
// provide backward compatibility to Navigator 2.0.2 JavaScript
// by avoiding use of the typeof operator.
//
// It is the caller's responsibility to make sure that we do not
// try to copy more characters from s than s.length.
//
// EXAMPLES:
//
// * To reformat a 10-digit U.S. phone number from "1234567890"
//   to "(123) 456-7890" make this function call:
//   reformat("1234567890", "(", 3, ") ", 3, "-", 4)
//
// * To reformat a 9-digit U.S. Social Security number from
//   "123456789" to "123-45-6789" make this function call:
//   reformat("123456789", "", 3, "-", 2, "-", 4)
//
// HINT:
//
// If you have a string which is already delimited in one way
// (example: a phone number delimited with spaces as "123 456 7890")
// and you want to delimit it in another way using function reformat,
// call function stripCharsNotInBag to remove the unwanted
// characters, THEN call function reformat to delimit as desired.
//
// EXAMPLE:
//
// reformat (stripCharsNotInBag ("123 456 7890", digits),
//           "(", 3, ") ", 3, "-", 4)

function reformat (s)

{   var arg;
    var sPos = 0;
    var resultString = "";

    for (var i = 1; i < reformat.arguments.length; i++) {
       arg = reformat.arguments[i];
       if (i % 2 == 1) resultString += arg;
       else {
           resultString += s.substring(sPos, sPos + arg);
           sPos += arg;
       }
    }
    return resultString;
}




// isSSN (STRING s [, BOOLEAN emptyOK])
//
// isSSN returns true if string s is a valid U.S. Social
// Security Number.  Must be 9 digits.
//
// NOTE: Strip out any delimiters (spaces, hyphens, etc.)
// from string s before calling this function.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isSSN (s)
{   if (isEmpty(s))
       if (isSSN.arguments.length == 1) return defaultEmptyOK;
       else return (isSSN.arguments[1] == true);
    return (isInteger(s) && s.length == digitsInSocialSecurityNumber)
}




// isUSPhoneNumber (STRING s [, BOOLEAN emptyOK])
//
// isUSPhoneNumber returns true if string s is a valid U.S. Phone
// Number.  Must be 10 digits.
//
// NOTE: Strip out any delimiters (spaces, hyphens, parentheses, etc.)
// from string s before calling this function.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isUSPhoneNumber (s)
{   if (isEmpty(s))
       if (isUSPhoneNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isUSPhoneNumber.arguments[1] == true);
    return (isInteger(s) && s.length == digitsInUSPhoneNumber)
}




// isInternationalPhoneNumber (STRING s [, BOOLEAN emptyOK])
//
// isInternationalPhoneNumber returns true if string s is a valid
// international phone number.  Must be digits only; any length OK.
// May be prefixed by + character.
//
// NOTE: A phone number of all zeros would not be accepted.
// I don't think that is a valid phone number anyway.
//
// NOTE: Strip out any delimiters (spaces, hyphens, parentheses, etc.)
// from string s before calling this function.  You may leave in
// leading + character if you wish.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isInternationalPhoneNumber (s)
{   if (isEmpty(s))
       if (isInternationalPhoneNumber.arguments.length == 1) return defaultEmptyOK;
       else return (isInternationalPhoneNumber.arguments[1] == true);
    return (isPositiveInteger(s))
}




// isZIPCode (STRING s [, BOOLEAN emptyOK])
//
// isZIPCode returns true if string s is a valid
// U.S. ZIP code.  Must be 5 or 9 digits only.
//
// NOTE: Strip out any delimiters (spaces, hyphens, etc.)
// from string s before calling this function.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isZIPCode (s)
{  if (isEmpty(s))
       if (isZIPCode.arguments.length == 1) return defaultEmptyOK;
       else return (isZIPCode.arguments[1] == true);
   return (isInteger(s) &&
            ((s.length == digitsInZIPCode1) ||
             (s.length == digitsInZIPCode2)))
}





// isStateCode (STRING s [, BOOLEAN emptyOK])
//
// Return true if s is a valid U.S. Postal Code
// (abbreviation for state).
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isStateCode(s)
{   if (isEmpty(s))
       if (isStateCode.arguments.length == 1) return defaultEmptyOK;
       else return (isStateCode.arguments[1] == true);
    return ( (USStateCodes.indexOf(s) != -1) &&
             (s.indexOf(USStateCodeDelimiter) == -1) )
}




// isEmail (STRING s [, BOOLEAN emptyOK])
//
// Email address must be of form a@b.c -- in other words:
// * there must be at least one character before the @
// * there must be at least one character before and after the .
// * the characters @ and . are both required
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isEmail (s)
{
	re5 = /^([_a-z0-9-']+)(\.[_a-z0-9-']+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i;
	return re5.test(s);
}





// isYear (STRING s [, BOOLEAN emptyOK])
//
// isYear returns true if string s is a valid
// Year number.  Must be 2 or 4 digits only.
//
// For Year 2000 compliance, you are advised
// to use 4-digit year numbers everywhere.
//
// And yes, this function is not Year 10000 compliant, but
// because I am giving you 8003 years of advance notice,
// I don't feel very guilty about this ...
//
// For B.C. compliance, write your own function. ;->
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isYear (s)
{   if (isEmpty(s))
       if (isYear.arguments.length == 1) return defaultEmptyOK;
       else return (isYear.arguments[1] == true);
    if (!isNonnegativeInteger(s)) return false;
    return ((s.length == 2) || (s.length == 4));
}



// isIntegerInRange (STRING s, INTEGER a, INTEGER b [, BOOLEAN emptyOK])
//
// isIntegerInRange returns true if string s is an integer
// within the range of integer arguments a and b, inclusive.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.


function isIntegerInRange (s, a, b)
{   if (isEmpty(s))
       if (isIntegerInRange.arguments.length == 1) return defaultEmptyOK;
       else return (isIntegerInRange.arguments[1] == true);

    // Catch non-integer strings to avoid creating a NaN below,
    // which isn't available on JavaScript 1.0 for Windows.

    //MODIFIED BY PAUL HARRIS - 051204 WAS isInteger(...)
    if (!isSignedInteger(s, false)) return false;

    // Now, explicitly change the type to integer via parseInt
    // so that the comparison code below will work both on
    // JavaScript 1.2 (which typechecks in equality comparisons)
    // and JavaScript 1.1 and before (which doesn't).
    var num = parseInt (s);
    return ((num >= a) && (num <= b));
}



// isMonth (STRING s [, BOOLEAN emptyOK])
//
// isMonth returns true if string s is a valid
// month number between 1 and 12.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isMonth (s)
{   if (isEmpty(s))
       if (isMonth.arguments.length == 1) return defaultEmptyOK;
       else return (isMonth.arguments[1] == true);
    return isIntegerInRange (s, 1, 12);
}



// isDay (STRING s [, BOOLEAN emptyOK])
//
// isDay returns true if string s is a valid
// day number between 1 and 31.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function isDay (s)
{   if (isEmpty(s))
       if (isDay.arguments.length == 1) return defaultEmptyOK;
       else return (isDay.arguments[1] == true);
    return isIntegerInRange (s, 1, 31);
}



// daysInFebruary (INTEGER year)
//
// Given integer argument year,
// returns number of days in February of that year.

function daysInFebruary (year)
{   // February has 29 days in any year evenly divisible by four,
    // EXCEPT for centurial years which are not also divisible by 400.
    return (  ((year % 4 == 0) && ( (!(year % 100 == 0)) || (year % 400 == 0) ) ) ? 29 : 28 );
}



// isDate (STRING year, STRING month, STRING day)
//
// isDate returns true if string arguments year, month, and day
// form a valid date.
//

function isDate (year, month, day)
{   // catch invalid years (not 2- or 4-digit) and invalid months and days.
    if (! (isYear(year, false) && isMonth(month, false) && isDay(day, false))) return false;

    // Explicitly change type to integer to make code work in both
    // JavaScript 1.1 and JavaScript 1.2.
    var intYear = parseInt(year);
    var intMonth = parseInt(month);
    var intDay = parseInt(day);

    // catch invalid days, except for February
    if (intDay > daysInMonth[intMonth]) return false;

    if ((intMonth == 2) && (intDay > daysInFebruary(intYear))) return false;

    return true;
}




/* FUNCTIONS TO NOTIFY USER OF INPUT REQUIREMENTS OR MISTAKES. */


// Display prompt string s in status bar.

function prompt (s)
{   window.status = s
}



// Display data entry prompt string s in status bar.

function promptEntry (s)
{   window.status = pEntryPrompt + s
}




// Notify user that required field theField is empty.
// String s describes expected contents of theField.value.
// Put focus in theField and return false.

function warnEmpty (theField, s)
{   theField.focus()
    alert(mPrefix + s + mSuffix)
    return false
}



// Notify user that contents of field theField are invalid.
// String s describes expected contents of theField.value.
// Put select theField, pu focus in it, and return false.

function warnInvalid (theField, s)
{
	theField.style.fontWeight = 'bold';
	theField.style.backgroundColor='#FFB7BE';
	// Set id for regex validation dialog div
	var valPopupId = 'redcapValidationErrorPopup';
	// Get ID of field: If field does not have an id, then given it a random one so later we can reference it directly.
	var obId = $(theField).attr('id');
	if (obId == null) {
		obId = "val-"+Math.floor(Math.random()*10000000000000000);
		$(theField).attr('id', obId);
	}
	// Set the Javascript for returning focus back on element (if specified)
	setTimeout(function(){
		simpleDialog(s, null,valPopupId, null, "$('#"+obId+"').focus();");
		$('#'+valPopupId).parent().find('button:first').focus();
	},10);
    return false;
}




/* FUNCTIONS TO INTERACTIVELY CHECK VARIOUS FIELDS. */

// checkString (TEXTFIELD theField, STRING s, [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is not all whitespace.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkString (theField, s, emptyOK)
{   // Next line is needed on NN3 to avoid "undefined is not a number" error
    // in equality comparison below.
    if (checkString.arguments.length == 2) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    if (isWhitespace(theField.value))
       return warnEmpty (theField, s);
    else return true;
}



// checkStateCode (TEXTFIELD theField [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is a valid U.S. state code.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkStateCode (theField, emptyOK)
{   if (checkStateCode.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else
    {  theField.value = theField.value.toUpperCase();
       if (!isStateCode(theField.value, false))
          return warnInvalid (theField, iStateCode);
       else return true;
    }
}



// takes ZIPString, a string of 5 or 9 digits;
// if 9 digits, inserts separator hyphen

function reformatZIPCode (ZIPString)
{   if (ZIPString.length == 5) return ZIPString;
    else return (reformat (ZIPString, "", 5, "-", 4));
}




// checkZIPCode (TEXTFIELD theField [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is a valid ZIP code.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkZIPCode (theField, emptyOK)
{   if (checkZIPCode.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else
    { var normalizedZIP = stripCharsInBag(theField.value, ZIPCodeDelimiters)
      if (!isZIPCode(normalizedZIP, false))
         return warnInvalid (theField, iZIPCode);
      else
      {  // if you don't want to insert a hyphen, comment next line out
         theField.value = reformatZIPCode(normalizedZIP)
         return true;
      }
    }
}



// takes USPhone, a string of 10 digits
// and reformats as (123) 456-789

function reformatUSPhone (USPhone)
{   return (reformat (USPhone, "(", 3, ") ", 3, "-", 4))
}



// checkUSPhone (TEXTFIELD theField [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is a valid US Phone.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

/*
function checkUSPhone (theField, emptyOK)
{   if (checkUSPhone.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else
    {  var normalizedPhone = stripCharsInBag(theField.value, phoneNumberDelimiters)
       if (!isUSPhoneNumber(normalizedPhone, false))
          return warnInvalid (theField, iUSPhone);
       else
       {  // if you don't want to reformat as (123) 456-789, comment next line out
          theField.value = reformatUSPhone(normalizedPhone)
          return true;
       }
    }
}
 */
function checkUSPhone (theField, emptyOK)
{ if (checkUSPhone.arguments.length == 1) emptyOK = defaultEmptyOK;
   if ((emptyOK == true) && (isEmpty(theField.value))) return true;
   else
   { var ext = ""; // A.P. start
     var fv = new String(theField.value);
     if (fv.indexOf("x") > -1) // Extension; check it and remove
     { ext = fv.slice(fv.indexOf("x")+1);
       ext = ext.replace(/[\s-\.]/g,"");
       fv = fv.slice(0,fv.indexOf("x"));
       if (/[^\d]/.test(ext)) return warnInvalid (theField, iUSPhone);
       ext = " x"+ext;
     }
     var normalizedPhone = stripCharsInBag(fv, phoneNumberDelimiters);
     fv = fv.replace(/[\s]/g,"");
     fv = fv.replace(/[-]/g,"");
	 if (!/^\(?\d{3}\)?\d{3}-?\d{4}$/.test(fv)) // A.P. end
		// if (!isUSPhoneNumber(normalizedPhone, false))
        return warnInvalid (theField, iUSPhone);
     else
     {  // if you don't want to reformat as (123) 456-7890 x12345, comment next line out
       theField.value = reformatUSPhone(normalizedPhone)+ext; // OK, one more change - "+ext" added
       return true;
     }
   }
}



// checkInternationalPhone (TEXTFIELD theField [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is a valid International Phone.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkInternationalPhone (theField, emptyOK)
{   if (checkInternationalPhone.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else
    {  if (!isInternationalPhoneNumber(theField.value, false))
          return warnInvalid (theField, iWorldPhone);
       else return true;
    }
}



// checkEmail (TEXTFIELD theField [, BOOLEAN emptyOK==false])
//
// Check that string theField.value is a valid Email.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkEmail (theField, emptyOK)
{   if (checkEmail.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else if (!isEmail(theField.value, false)) {
		return warnInvalid (theField, iEmail);
	}
    else return true;
}



// takes SSN, a string of 9 digits
// and reformats as 123-45-6789

function reformatSSN (SSN)
{   return (reformat (SSN, "", 3, "-", 2, "-", 4))
}


// Check that string theField.value is a valid SSN.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkSSN (theField, emptyOK)
{   if (checkSSN.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    else
    {  var normalizedSSN = stripCharsInBag(theField.value, SSNDelimiters)
       if (!isSSN(normalizedSSN, false))
          return warnInvalid (theField, iSSN);
       else
       {  // if you don't want to reformats as 123-456-7890, comment next line out
          theField.value = reformatSSN(normalizedSSN)
          return true;
       }
    }
}




// Check that string theField.value is a valid Year.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkYear (theField, emptyOK)
{   if (checkYear.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    if (!isYear(theField.value, false))
       return warnInvalid (theField, iYear);
    else return true;
}


// Check that string theField.value is a valid Month.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkMonth (theField, emptyOK)
{   if (checkMonth.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    if (!isMonth(theField.value, false))
       return warnInvalid (theField, iMonth);
    else return true;
}


// Check that string theField.value is a valid Day.
//
// For explanation of optional argument emptyOK,
// see comments of function isInteger.

function checkDay (theField, emptyOK)
{   if (checkDay.arguments.length == 1) emptyOK = defaultEmptyOK;
    if ((emptyOK == true) && (isEmpty(theField.value))) return true;
    if (!isDay(theField.value, false))
       return warnInvalid (theField, iDay);
    else return true;
}



// checkDate (yearField, monthField, dayField, STRING labelString [, OKtoOmitDay==false])
//
// Check that yearField.value, monthField.value, and dayField.value
// form a valid date.
//
// If they don't, labelString (the name of the date, like "Birth Date")
// is displayed to tell the user which date field is invalid.
//
// If it is OK for the day field to be empty, set optional argument
// OKtoOmitDay to true.  It defaults to false.

function checkDate (yearField, monthField, dayField, labelString, OKtoOmitDay)
{   // Next line is needed on NN3 to avoid "undefined is not a number" error
    // in equality comparison below.
    if (checkDate.arguments.length == 4) OKtoOmitDay = false;
    if (!isYear(yearField.value)) return warnInvalid (yearField, iYear);
    if (!isMonth(monthField.value)) return warnInvalid (monthField, iMonth);
    if ( (OKtoOmitDay == true) && isEmpty(dayField.value) ) return true;
    else if (!isDay(dayField.value))
       return warnInvalid (dayField, iDay);
    if (isDate (yearField.value, monthField.value, dayField.value))
       return true;
    alert (iDatePrefix + labelString + iDateSuffix)
    return false
}



// Get checked value from radio button.

function getRadioButtonValue (radio)
{   for (var i = 0; i < radio.length; i++)
    {   if (radio[i].checked) { break }
    }
    return radio[i].value
}
//Credit Card code omitted.


//Begin Add - script from Vanderbilt
//2004-05-12 by Paul Harris

// ===================================================================
// Author: Matt Kruse <matt@mattkruse.com>
// WWW: http://www.mattkruse.com/
//
// NOTICE: You may use this code for any purpose, commercial or
// private, without any further permission from the author. You may
// remove this notice from your final code if you wish, however it is
// appreciated by the author if at least my web site address is kept.
//
// You may *NOT* re-distribute this code in any way except through its
// use. That means, you can include it in your product, or your web
// site, or any other form where the code is actually being used. You
// may not put the plain javascript up on your site for download or
// include it in your javascript libraries for download.
// If you wish to share this code with others, please just point them
// to the URL instead.
// Please DO NOT link directly to my .js files from your site. Copy
// the files to your server and use them there. Thank you.
// ===================================================================

// HISTORY
// ------------------------------------------------------------------
// May 17, 2003: Fixed bug in parseDate() for dates <1970
// March 11, 2003: Added parseDate() function
// March 11, 2003: Added "NNN" formatting option. Doesn't match up
//                 perfectly with SimpleDateFormat formats, but
//                 backwards-compatability was required.

// ------------------------------------------------------------------
// These functions use the same 'format' strings as the
// java.text.SimpleDateFormat class, with minor exceptions.
// The format string consists of the following abbreviations:
//
// Field        | Full Form          | Short Form
// -------------+--------------------+-----------------------
// Year         | yyyy (4 digits)    | yy (2 digits), y (2 or 4 digits)
// Month        | MMM (name or abbr.)| MM (2 digits), M (1 or 2 digits)
//              | NNN (abbr.)        |
// Day of Month | dd (2 digits)      | d (1 or 2 digits)
// Day of Week  | EE (name)          | E (abbr)
// Hour (1-12)  | hh (2 digits)      | h (1 or 2 digits)
// Hour (0-23)  | HH (2 digits)      | H (1 or 2 digits)
// Hour (0-11)  | KK (2 digits)      | K (1 or 2 digits)
// Hour (1-24)  | kk (2 digits)      | k (1 or 2 digits)
// Minute       | mm (2 digits)      | m (1 or 2 digits)
// Second       | ss (2 digits)      | s (1 or 2 digits)
// AM/PM        | a                  |
//
// NOTE THE DIFFERENCE BETWEEN MM and mm! Month=MM, not mm!
// Examples:
//  "MMM d, y" matches: January 01, 2000
//                      Dec 1, 1900
//                      Nov 20, 00
//  "M/d/yy"   matches: 01/20/00
//                      9/2/00
//  "MMM dd, yyyy hh:mm:ssa" matches: "January 01, 2000 12:30:45AM"
// ------------------------------------------------------------------

var MONTH_NAMES=new Array('January','February','March','April','May','June','July','August','September','October','November','December','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
var DAY_NAMES=new Array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sun','Mon','Tue','Wed','Thu','Fri','Sat');
function LZ(x) {return(x<0||x>9?"":"0")+x}

// ------------------------------------------------------------------
// isDate ( date_string, format_string )
// Returns true if date string matches format of format string and
// is a valid date. Else returns false.
// It is recommended that you trim whitespace around the value before
// passing it to this function, as whitespace is NOT ignored!
// ------------------------------------------------------------------
function isDate(val,format) {
	var date=getDateFromFormat(val,format);
	if (date==0) { return false; }
	return true;
	}

// -------------------------------------------------------------------
// compareDates(date1,date1format,date2,date2format)
//   Compare two date strings to see which is greater.
//   Returns:
//   1 if date1 is greater than date2
//   0 if date2 is greater than date1 or if they are the same
//  -1 if either of the dates is in an invalid format
// -------------------------------------------------------------------
function compareDates(date1,dateformat1,date2,dateformat2) {
	var d1=getDateFromFormat(date1,dateformat1);
	var d2=getDateFromFormat(date2,dateformat2);
	if (d1==0 || d2==0) {
		return -1;
		}
	else if (d1 > d2) {
		return 1;
		}
	return 0;
	}

// ------------------------------------------------------------------
// formatDate (date_object, format)
// Returns a date in the output format specified.
// The format string uses the same abbreviations as in getDateFromFormat()
// ------------------------------------------------------------------
function formatDate(date,format) {
	format=format+"";
	var result="";
	var i_format=0;
	var c="";
	var token="";
	var y=date.getYear()+"";
	var M=date.getMonth()+1;
	var d=date.getDate();
	var E=date.getDay();
	var H=date.getHours();
	var m=date.getMinutes();
	var s=date.getSeconds();
	var yyyy,yy,MMM,MM,dd,hh,h,mm,ss,ampm,HH,H,KK,K,kk,k;
	// Convert real date parts into formatted versions
	var value=new Array();
	if (y.length < 4) {
		y=""+(y-0+1900);
	}
	value["y"]=""+y;
	value["yyyy"]=y;
	value["yy"]=y.substring(2,4);
	value["M"]=M;
	value["MM"]=LZ(M);
	value["MMM"]=MONTH_NAMES[M-1];
	value["NNN"]=MONTH_NAMES[M+11];
	value["d"]=d;
	value["dd"]=LZ(d);
	value["E"]=DAY_NAMES[E+7];
	value["EE"]=DAY_NAMES[E];
	value["H"]=H;
	value["HH"]=LZ(H);
	if (H==0){value["h"]=12;}
	else if (H>12){value["h"]=H-12;}
	else {value["h"]=H;}
	value["hh"]=LZ(value["h"]);
	if (H>11){value["K"]=H-12;} else {value["K"]=H;}
	value["k"]=H+1;
	value["KK"]=LZ(value["K"]);
	value["kk"]=LZ(value["k"]);
	if (H > 11) { value["a"]="PM"; }
	else { value["a"]="AM"; }
	value["m"]=m;
	value["mm"]=LZ(m);
	value["s"]=s;
	value["ss"]=LZ(s);
	while (i_format < format.length) {
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		if (value[token] != null) { result=result + value[token]; }
		else { result=result + token; }
		}
	return result;
	}

// ------------------------------------------------------------------
// Utility functions for parsing in getDateFromFormat()
// ------------------------------------------------------------------
function _isInteger(val) {
	var digits="1234567890";
	for (var i=0; i < val.length; i++) {
		if (digits.indexOf(val.charAt(i))==-1) { return false; }
		}
	return true;
	}
function _getInt(str,i,minlength,maxlength) {
	for (var x=maxlength; x>=minlength; x--) {
		var token=str.substring(i,i+x);
		if (token.length < minlength) { return null; }
		if (_isInteger(token)) { return token; }
		}
	return null;
	}

// ------------------------------------------------------------------
// getDateFromFormat( date_string , format_string )
//
// This function takes a date string and a format string. It matches
// If the date string matches the format string, it returns the
// getTime() of the date. If it does not match, it returns 0.
// ------------------------------------------------------------------
function getDateFromFormat(val,format) {
	val=val+"";
	format=format+"";
	var i_val=0;
	var i_format=0;
	var c="";
	var token="";
	var token2="";
	var x,y;
	var now=new Date();
	var year=now.getYear();
	var month=now.getMonth()+1;
	var date=1;
	var hh=now.getHours();
	var mm=now.getMinutes();
	var ss=now.getSeconds();
	var ampm="";

	while (i_format < format.length) {
		// Get next token from format string
		c=format.charAt(i_format);
		token="";
		while ((format.charAt(i_format)==c) && (i_format < format.length)) {
			token += format.charAt(i_format++);
			}
		// Extract contents of value based on format token
		if (token=="yyyy" || token=="yy" || token=="y") {
			if (token=="yyyy") { x=4;y=4; }
			if (token=="yy")   { x=2;y=2; }
			if (token=="y")    { x=2;y=4; }
			year=_getInt(val,i_val,x,y);
			if (year==null) { return 0; }
			i_val += year.length;
			if (year.length==2) {
				//START RT Changed this Code
				var this_year_2d = ""+now.getFullYear();
				this_year_2d = this_year_2d.substring(2)*1;
				year = (year <= (this_year_2d+10)) ? (year-0+2000) : (year-0+1900);
				//END RT Changed this Code
				//START PH Changed this Code
				//The code now assumes any 2 digit year is in the future if
				//within 5 years of this year or in the past if otherwise.
				// var thisyear=now.getYear();
				// year=2000+(year-0);
				// if (year>thisyear+5){
					// year=year-100;
				// }
				//WAS
				//if (year > 70) { year=1900+(year-0); }
				//else { year=2000+(year-0); }
				//END PH Changed this Code
				}
			}
		else if (token=="MMM"||token=="NNN"){
			month=0;
			for (var i=0; i<MONTH_NAMES.length; i++) {
				var month_name=MONTH_NAMES[i];
				if (val.substring(i_val,i_val+month_name.length).toLowerCase()==month_name.toLowerCase()) {
					if (token=="MMM"||(token=="NNN"&&i>11)) {
						month=i+1;
						if (month>12) { month -= 12; }
						i_val += month_name.length;
						break;
						}
					}
				}
			if ((month < 1)||(month>12)){return 0;}
			}
		else if (token=="EE"||token=="E"){
			for (var i=0; i<DAY_NAMES.length; i++) {
				var day_name=DAY_NAMES[i];
				if (val.substring(i_val,i_val+day_name.length).toLowerCase()==day_name.toLowerCase()) {
					i_val += day_name.length;
					break;
					}
				}
			}
		else if (token=="MM"||token=="M") {
			month=_getInt(val,i_val,token.length,2);
			if(month==null||(month<1)||(month>12)){return 0;}
			i_val+=month.length;}
		else if (token=="dd"||token=="d") {
			date=_getInt(val,i_val,token.length,2);
			if(date==null||(date<1)||(date>31)){return 0;}
			i_val+=date.length;}
		else if (token=="hh"||token=="h") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<1)||(hh>12)){return 0;}
			i_val+=hh.length;}
		else if (token=="HH"||token=="H") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<0)||(hh>23)){return 0;}
			i_val+=hh.length;}
		else if (token=="KK"||token=="K") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<0)||(hh>11)){return 0;}
			i_val+=hh.length;}
		else if (token=="kk"||token=="k") {
			hh=_getInt(val,i_val,token.length,2);
			if(hh==null||(hh<1)||(hh>24)){return 0;}
			i_val+=hh.length;hh--;}
		else if (token=="mm"||token=="m") {
			mm=_getInt(val,i_val,token.length,2);
			if(mm==null||(mm<0)||(mm>59)){return 0;}
			i_val+=mm.length;}
		else if (token=="ss"||token=="s") {
			ss=_getInt(val,i_val,token.length,2);
			if(ss==null||(ss<0)||(ss>59)){return 0;}
			i_val+=ss.length;}
		else if (token=="a") {
			if (val.substring(i_val,i_val+2).toLowerCase()=="am") {ampm="AM";}
			else if (val.substring(i_val,i_val+2).toLowerCase()=="pm") {ampm="PM";}
			else {return 0;}
			i_val+=2;}
		else {
			if (val.substring(i_val,i_val+token.length)!=token) {return 0;}
			else {i_val+=token.length;}
			}
		}
	// If there are any trailing characters left in the value, it doesn't match
	if (i_val != val.length) { return 0; }
	// Is date valid for month?
	if (month==2) {
		// Check for leap year
		if ( ( (year%4==0)&&(year%100 != 0) ) || (year%400==0) ) { // leap year
			if (date > 29){ return 0; }
			}
		else { if (date > 28) { return 0; } }
		}
	if ((month==4)||(month==6)||(month==9)||(month==11)) {
		if (date > 30) { return 0; }
		}
	// Correct hours value
	if (hh<12 && ampm=="PM") { hh=hh-0+12; }
	else if (hh>11 && ampm=="AM") { hh-=12; }
	var newdate=new Date(year,month-1,date,hh,mm,ss);
	return newdate.getTime();
	}

// ------------------------------------------------------------------
// parseDate( date_string [, prefer_euro_format] )
//
// This function takes a date string and tries to match it to a
// number of possible date formats to get the value. It will try to
// match against the following international formats, in this order:
// y-M-d   MMM d, y   MMM d,y   y-MMM-d   d-MMM-y  MMM d
// M/d/y   M-d-y      M.d.y     MMM-d     M/d      M-d
// d/M/y   d-M-y      d.M.y     d-MMM     d/M      d-M
// A second argument may be passed to instruct the method to search
// for formats like d/M/y (european format) before M/d/y (American).
// Returns a Date object or null if no patterns match.
// ------------------------------------------------------------------
function parseDate(val) {
	var preferEuro=(arguments.length==2)?arguments[1]:false;
	generalFormats=new Array('y-M-d','MMM d, y','MMM d,y','y-MMM-d','d-MMM-y','MMM d');
	monthFirst=new Array('M/d/y','M-d-y','M.d.y','MMM-d','M/d','M-d');
	dateFirst =new Array('d/M/y','d-M-y','d.M.y','d-MMM','d/M','d-M');
	var checkList=new Array('generalFormats',preferEuro?'dateFirst':'monthFirst',preferEuro?'monthFirst':'dateFirst');
	var d=null;
	for (var i=0; i<checkList.length; i++) {
		var l=window[checkList[i]];
		for (var j=0; j<l.length; j++) {
			d=getDateFromFormat(val,l[j]);
			if (d!=0) { return new Date(d); }
			}
		}
	return null;
	}

// Check if in HH:MM military format
function isTime(val,hasSeconds) {
	if (hasSeconds) {
		var regex=/^(00|01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23)[:](0|1|2|3|4|5)\d{1}[:](0|1|2|3|4|5)\d{1}$/;
	} else {
		var regex=/^(00|01|02|03|04|05|06|07|08|09|10|11|12|13|14|15|16|17|18|19|20|21|22|23)[:](0|1|2|3|4|5)\d{1}$/;
	}
	return regex.test(val);
}

// Return boolean if val is a number (integer or floating point)
function isnumber(val) {
	return isNumeric(val);
}

// Return boolean if val is a number (integer or floating point)
function isinteger(val) {
	return (Number(val)===val && val%1===0);
}


// Convert date format from DD-MM-YYYY to YYYY-MM-DD
function date_dmy2ymd(val)
{
	val = trim(val);
	if (val == '') return val;
	var date_arr = val.split('-');
	if (date_arr.length != 3) return '';
	if (date_arr[0].length < 2) date_arr[0] = "0" + date_arr[0];
	if (date_arr[1].length < 2) date_arr[1] = "0" + date_arr[1];
	return date_arr[2]+"-"+date_arr[1]+"-"+date_arr[0];
}
// Convert date format from MM-DD-YYYY to YYYY-MM-DD
function date_mdy2ymd(val)
{
	val = trim(val);
	if (val == '') return '';
	var date_arr = val.split('-');
	if (date_arr.length != 3) return '';
	if (date_arr[0].length < 2) date_arr[0] = "0" + date_arr[0];
	if (date_arr[1].length < 2) date_arr[1] = "0" + date_arr[1];
	return date_arr[2]+"-"+date_arr[0]+"-"+date_arr[1];
}
// Convert date format from YYYY-MM-DD to DD-MM-YYYY
function date_ymd2dmy(val)
{
	val = trim(val);
	if (val == '') return val;
	var date_arr = val.split('-');
	if (date_arr.length != 3) return '';
	if (date_arr[1].length < 2) date_arr[1] = "0" + date_arr[1];
	if (date_arr[2].length < 2) date_arr[2] = "0" + date_arr[2];
	return date_arr[2]+"-"+date_arr[1]+"-"+date_arr[0];
}
// Convert date format from YYYY-MM-DD to MM-DD-YYYY
function date_ymd2mdy(val)
{
	val = trim(val);
	if (val == '') return '';
	var date_arr = val.split('-');
	if (date_arr.length != 3) return '';
	if (date_arr[1].length < 2) date_arr[1] = "0" + date_arr[1];
	if (date_arr[2].length < 2) date_arr[2] = "0" + date_arr[2];
	return date_arr[1]+"-"+date_arr[2]+"-"+date_arr[0];
}
// For date fields (any format type), replace any periods or slashes in the date with a dash and add any leading zeros.
function redcap_clean_date(this_date,texttype)
{
	if (this_date == '') return '';
	// For legacy "date" format (YYYY-MM-DD) entered by user as MM/DD/YYYY, reformat to YYYY-MM-DD
	if (/_ymd/.test(texttype) && this_date.split('/').length == 3) { // if correctly has 2 slashes AND is in MM/DD/YYYY format
		if (/^(\d{1,2})([\/])(\d{1,2})([\/])(\d{4})$/.test(this_date)) {
			var this_date_parsed = parseDate(this_date);
			if (this_date_parsed == null) return this_date;
			return formatDate(this_date_parsed,'y-MM-dd');
		}
	}
	// Replace periods and slashes with dashes
	var this_date = this_date.replace(/[.\/]/g,'-');
	// Check to make sure 2 dashes exist. If not, return current value, unless an eight digit number, in which case add dashes.
	if (this_date.split('-').length == 1) {
		if (this_date.length == 8) { // Assuming have all 8 digits
			if (/_ymd/.test(texttype)) {
				this_date = this_date.substr(0,4)+"-"+this_date.substr(4,2)+"-"+this_date.substr(6,2);
			} else {
				this_date = this_date.substr(0,2)+"-"+this_date.substr(2,2)+"-"+this_date.substr(4,4);
			}
		} else if (this_date.length == 6) { // Assuming have all 4 digits of year but 1 for month and day
			if (/_ymd/.test(texttype)) {
				this_date = this_date.substr(0,4)+"-0"+this_date.substr(4,1)+"-0"+this_date.substr(5,1);
			} else {
				this_date = "0"+this_date.substr(0,1)+"-0"+this_date.substr(1,1)+"-"+this_date.substr(2,4);
			}
		} else {
			// Can't figure out the format
			return this_date;
		}
	} else if (this_date.split('-').length != 3) {
		// Can't figure out the format
		return this_date;
	}
	// Make sure has leading zeros
	var date_arr = this_date.split('-');
	if (date_arr[1].length < 2) date_arr[1] = "0" + date_arr[1];
	if (/_mdy/.test(texttype) || /_dmy/.test(texttype)) {
		if (date_arr[0].length < 2) date_arr[0] = "0" + date_arr[0];
		var year = date_arr[2];
	} else {
		if (date_arr[2].length < 2) date_arr[2] = "0" + date_arr[2];
		var year = date_arr[0];
	}
	// Make sure year has 4 digits
	if (year.length == 2) {
		var this_year_2d = "" + new Date().getFullYear();
		this_year_2d = this_year_2d.substring(2)*1;
		year = (year <= (this_year_2d+10)) ? (year-0+2000) : (year-0+1900);
		if (/_mdy/.test(texttype) || /_dmy/.test(texttype)) {
			date_arr[2] = year;
		} else {
			date_arr[0] = year;
		}
	}
	// Return formatted date
	return date_arr[0]+"-"+date_arr[1]+"-"+date_arr[2];
}

// Make sure all times (HH:MM[:SS]) have zeroes padding)
function redcap_pad_time(time) {
	// Break into components
	var time_comp = time.split(':');
	// Make sure each component is padded with a zero if only one digit long
	for (var i=0; i<time_comp.length; i++) {
		if (time_comp[i].length < 2) {
			time_comp[i] = "0" + time_comp[i];
		}
	}
	// Return time
	return time_comp.join(':');
}

// REDCap form validation function
function redcap_validate(ob, min, max, returntype, texttype, regexVal, returnFocus, dateDelimiterReturned)
{
	var return_value;
	var kickout_message;
	var holder1;
	var holder2;
	var holder3;

	// Reset flag on page
	$('#field_validation_error_state').val('0');

	// If blank, do nothing
	if (ob.value == '') {
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		return true;
	}

	// Get ID of field: If field does not have an id, then given it a random one so later we can reference it directly.
	var obId = $(ob).attr('id');
	if (obId == null) {
		obId = "val-"+Math.floor(Math.random()*10000000000000000);
		$(ob).attr('id', obId);
	}

	// Set the Javascript for returning focus back on element (if specified)
	if (returnFocus == null) returnFocus = 1;
	var returnFocusJS = (returnFocus == 1) ? "$('#"+obId+"').focus();" : "";

	//REGULAR EXPRESSION
	if (regexVal != null)
	{
		// Before evaluating with regex, first do some cleaning
		ob.value = trim(ob.value);

		// Set id for regex validation dialog div
		var regexValPopupId = 'redcapValidationErrorPopup';

		// For date[time][_seconds] fields, replace any periods or slashes with a dash. Add any leading zeros.
		if (texttype=="date_ymd" || texttype=="date_mdy" || texttype=="date_dmy") {
			ob.value = redcap_clean_date(ob.value,texttype);
			if (ob.value.split('-').length == 2) {
				// If somehow contains just one dash, then remove the dash and re-validate it to force reformatting
				return $(ob).val(ob.value.replace(/-/g,'')).trigger('blur');
			}
			var thisdate = ob.value;
			var thistime = '';
		} else if (texttype=="datetime_ymd" || texttype=="datetime_mdy" || texttype=="datetime_dmy"
				|| texttype=="datetime_seconds_ymd" || texttype=="datetime_seconds_mdy" || texttype=="datetime_seconds_dmy") {
			var dt_array = ob.value.split(' ');
			if (dt_array[1] == null) dt_array[1] = '';
			var thisdate = redcap_clean_date(dt_array[0],texttype);
			var thistime = redcap_pad_time(dt_array[1]);
			ob.value = trim(thisdate+' '+thistime);
			if (ob.value.split('-').length == 2) {
				// If somehow contains just one dash, then remove the dash and re-validate it to force reformatting
				return $(ob).val(ob.value.replace(/-/g,'')).trigger('blur');
			}
		}

		// Obtain regex from hidden divs on page (where they are stored)
		var regexDataType = '';
		if (regexVal === 1) {
			regexVal = $('#valregex_divs #valregex-'+texttype).html();
			regexDataType = $('#valregex_divs #valregex-'+texttype).attr('datatype');
		}

		// Evaluate value with regex
		eval('var regexVal2 = '+regexVal+';');
		if (regexVal2.test(ob.value))
		{
			// Passed the regex test!

			// Reformat phone format, if needed
			if (texttype=="phone") {
				ob.value = ob.value.replace(/-/g,"").replace(/ /g,"").replace(/\(/g,"").replace(/\)/g,"").replace(/\./g,"");
				if (ob.value.length > 10) {
					ob.value = trim(reformatUSPhone(ob.value.substr(0,10))+" "+trim(ob.value.substr(10)));
				} else {
					ob.value = reformatUSPhone(ob.value);
				}
			}
			// Make sure time has a leading zero if hour is single digit
			else if (texttype=="time" && ob.value.length == 4) {
				ob.value = "0"+ob.value;
			}
			// If a date[time] field and the returnDelimiter is specified, then do a delimiter replace
			else if (dateDelimiterReturned != null && dateDelimiterReturned != '-' && (texttype.substring(0,5) == 'date_' || texttype.substring(0,9) == 'datetime_')) {
				ob.value = ob.value.replace(/-/g, dateDelimiterReturned);
			}

			// Now do range check (if needed) for various validation types
			if (min != '' || max != '')
			{
				holder1 = ob.value;
				holder2 = min;
				holder3 = max;

				// Range check - integer/number
				if (texttype=="integer" || texttype=="number" || regexDataType=="integer" || regexDataType=="number" || regexDataType=="number_comma_decimal")
				{
					holder1 = (holder1.replace(',','.'))*1;
					holder2 = (holder2==='') ? '' : (holder2.replace(',','.'))*1;
					holder3 = (holder3==='') ? '' : (holder3.replace(',','.'))*1;
				}
				// Range check - time
				else if (texttype=="time")
				{
					// Remove all non-numerals so we can compare them numerically
					holder1 = (holder1.replace(/:/g,""))*1;
					holder2 = (holder2==='') ? '' : (holder2.replace(/:/g,""))*1;
					holder3 = (holder3==='') ? '' : (holder3.replace(/:/g,""))*1;
				}
				// Range check - date[time][_seconds]
				else if (texttype=="date_ymd" || texttype=="date_mdy" || texttype=="date_dmy"
					|| texttype=="datetime_ymd" || texttype=="datetime_mdy" || texttype=="datetime_dmy"
					|| texttype=="datetime_seconds_ymd" || texttype=="datetime_seconds_mdy" || texttype=="datetime_seconds_dmy")
				{
					// Convert date format of value to YMD to compare with min/max, which are already in YMD format
					if (/_mdy/.test(texttype)) {
						holder1 = trim(date_mdy2ymd(thisdate)+' '+thistime);
						var min_array = min.split(' ');
						if (min_array[1] == null) min_array[1] = '';
						min = trim(date_ymd2mdy(min_array[0],texttype)+' '+min_array[1]);
						var max_array = max.split(' ');
						if (max_array[1] == null) max_array[1] = '';
						max = trim(date_ymd2mdy(max_array[0],texttype)+' '+max_array[1]);
					} else if (/_dmy/.test(texttype)) {
						holder1 = trim(date_dmy2ymd(thisdate)+' '+thistime);
						var min_array = min.split(' ');
						if (min_array[1] == null) min_array[1] = '';
						min = trim(date_ymd2dmy(min_array[0],texttype)+' '+min_array[1]);
						var max_array = max.split(' ');
						if (max_array[1] == null) max_array[1] = '';
						max = trim(date_ymd2dmy(max_array[0],texttype)+' '+max_array[1]);
					} else {
						holder1 = trim(thisdate+' '+thistime);
					}
					// Ensure that min/max are in YMD format (legacy values could've been in M/D/Y format)
					if (texttype.substr(0,5) == "date_") {
						holder2 = redcap_clean_date(holder2,"date_ymd");
						holder3 = redcap_clean_date(holder3,"date_ymd");
					}
					// Remove all non-numerals so we can compare them numerically
					holder1 = (holder1.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
					holder2 = (holder2==='') ? '' : (holder2.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
					holder3 = (holder3==='') ? '' : (holder3.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
				}
				// Check range
				if ((holder2 !== '' && holder1 < holder2) || (holder3 !== '' && holder1 > holder3)) {
					var msg1 = ($('#valtext_divs #valtext_rangesoft1').length) ? $('#valtext_divs #valtext_rangesoft1').text() : 'The value you provided is outside the suggested range.';
					var msg2 = ($('#valtext_divs #valtext_rangesoft2').length) ? $('#valtext_divs #valtext_rangesoft2').text() : 'This value is admissible, but you may wish to verify.';
					ob.style.backgroundColor='#FFB7BE';
					var msg = msg1 + ' (' + (min==''?'no limit':min) + ' - ' + (max==''?'no limit':max) +'). ' + msg2;
					$('#'+regexValPopupId).remove();
					initDialog(regexValPopupId);
					$('#'+regexValPopupId).html(msg);
					setTimeout(function(){
						simpleDialog(msg, null, regexValPopupId);
					},10);
					return true;
				}
			}
			// Not out of range, so leave the field as normal
			ob.style.fontWeight = 'normal';
			ob.style.backgroundColor='#FFFFFF';
			return true;
		}
		// Set default generic message for failure
		var msg = ($('#valtext_divs #valtext_regex').length) ? $('#valtext_divs #valtext_regex').text() : 'The value you provided could not be validated because it does not follow the expected format. Please try again.';
		// Custom messages for legacy validation types
		if (texttype=="zipcode") {
			msg = ($('#valtext_divs #valtext_zipcode').length) ? $('#valtext_divs #valtext_zipcode').text() : iZIPCode;
		} else if (texttype=="email") {
			msg = ($('#valtext_divs #valtext_email').length) ? $('#valtext_divs #valtext_email').text() : iEmail;
		} else if (texttype=="phone") {
			msg = ($('#valtext_divs #valtext_phone').length) ? $('#valtext_divs #valtext_phone').text() : iUSPhone;
		} else if (texttype=="integer") {
			msg = ($('#valtext_divs #valtext_integer').length) ? $('#valtext_divs #valtext_integer').text() : 'This value you provided is not an integer. Please try again.';
		} else if (texttype=="number") {
			msg = ($('#valtext_divs #valtext_number').length) ? $('#valtext_divs #valtext_number').text() : 'This value you provided is not a number. Please try again.';
		} else if (texttype=="vmrn") {
			msg = ($('#valtext_divs #valtext_vmrn').length) ? $('#valtext_divs #valtext_vmrn').text() : 'The value entered is not a valid Vanderbilt Medical Record Number (i.e. 4- to 9-digit number, excluding leading zeros). Please try again.';
		} else if (texttype=="time") {
			msg = ($('#valtext_divs #valtext_time').length) ? $('#valtext_divs #valtext_time').text() : 'The value entered must be a time value in the following format HH:MM within the range 00:00-23:59 (e.g., 04:32 or 23:19).';
		}
		// Because of strange syncronicity issues of back-to-back fields with validation, set pop-up content first here
		$('#'+regexValPopupId).remove();
		initDialog(regexValPopupId);
		$('#'+regexValPopupId).html(msg);
		// Give alert message of failure
		setTimeout(function(){
			simpleDialog(msg, null, regexValPopupId, null, returnFocusJS);
			$('#'+regexValPopupId).parent().find('button:first').focus();
		},10);
		ob.style.fontWeight = 'bold';
		ob.style.backgroundColor = '#FFB7BE';
		// Set flag on page
		$('#field_validation_error_state').val('1');
		return false;
	}

	//ZIPCODE
	if(texttype=="zipcode")
	{
		if ($('#valtext_divs #valtext_zipcode').length) iZIPCode = $('#valtext_divs #valtext_zipcode').text();
	    if (checkZIPCode(ob,true)) {
			ob.style.fontWeight = 'normal';
			ob.style.backgroundColor='#FFFFFF';
			return true;
		}
		return false;
	}

	//EMAIL
	if (texttype=="email")
    {
		if ($('#valtext_divs #valtext_email').length) iEmail = $('#valtext_divs #valtext_email').text();
		if (checkEmail(ob,true)) {
			ob.style.fontWeight = 'normal';
			ob.style.backgroundColor='#FFFFFF';
			return true;
		}
		return false;
	}

	//Phone
	if (texttype=="phone")
    {
		if ($('#valtext_divs #valtext_phone').length) iUSPhone = $('#valtext_divs #valtext_phone').text();
		if (checkUSPhone(ob,true)) {
			ob.style.fontWeight = 'normal';
			ob.style.backgroundColor='#FFFFFF';
			return true;
		}
		return false;
	}

	//Time (HH:MM)
	if (texttype=="time")
    {
		if (ob.value != "") {
			if (!isTime(ob.value,0)) {
				var msg = ($('#valtext_divs #valtext_time').length) ? $('#valtext_divs #valtext_time').text() : 'The value entered must be a time value in the following format HH:MM within the range 00:00-23:59 (e.g., 04:32 or 23:19).';
				simpleDialog(msg, null, null, null, returnFocusJS);
				ob.style.fontWeight = 'bold';
				ob.style.backgroundColor = '#FFB7BE';
				return false;
			}
			//Now handle limits
			holder1 = (ob.value.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			holder2 = (min=='') ? '' : (min.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			holder3 = (max=='') ? '' : (max.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			if ((holder2 != '' && holder1 < holder2) || (holder3 != '' && holder1 > holder3)) {
				if(returntype=="hard") {
					var msg = ($('#valtext_divs #valtext_rangehard').length) ? $('#valtext_divs #valtext_rangehard').text() : 'The value you provided must be within the suggested range';
					simpleDialog(msg + ' (' + min + ' - ' + max +').', null, null, null, returnFocusJS);
					ob.style.backgroundColor='#FFB7BE';
				}
				else
				{
					var msg1 = ($('#valtext_divs #valtext_rangesoft1').length) ? $('#valtext_divs #valtext_rangesoft1').text() : 'The value you provided is outside the suggested range.';
					var msg2 = ($('#valtext_divs #valtext_rangesoft2').length) ? $('#valtext_divs #valtext_rangesoft2').text() : 'This value is admissible, but you may wish to verify.';
					simpleDialog(msg1 + ' (' + min + ' - ' + max +'). ' + msg2, null, null, null, returnFocusJS);
					ob.style.backgroundColor='#FFB7BE';
				}
			}
		}
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		return true;
	}


	//Datetime (YYYY-MM-DD HH:MM) and Datetime w/ seconds (YYYY-MM-DD HH:MM:SS)
	if (texttype=="datetime" || texttype=="datetime_seconds")
    {
		if (ob.value != "") {
			var dt_array = ob.value.split(' ');
			var dt_date = dt_array[0];
			var dt_time = dt_array[1];
			var holder1 = parseDate(dt_date);
			var hasSeconds = (texttype=="datetime_seconds");
			if (!isTime(dt_time,hasSeconds) || holder1==null) {
				if (!hasSeconds) {
					var msg = ($('#valtext_divs #valtext_datetime').length) ? $('#valtext_divs #valtext_datetime').text() : 'The value entered must be a datetime value in the following format YYYY-MM-DD HH:MM with the time in the range 00:00-23:59.';
				} else {
					var msg = ($('#valtext_divs #valtext_datetime_seconds').length) ? $('#valtext_divs #valtext_datetime_seconds').text() : 'The value entered must be a datetime value in the following format YYYY-MM-DD HH:MM:SS with the time in the range 00:00:00-23:59:59.';
				}
				simpleDialog(msg, null, null, null, returnFocusJS);
				ob.style.fontWeight = 'bold';
				ob.style.backgroundColor = '#FFB7BE';
				return false;
			}
			ob.value=formatDate(holder1,'y-MM-dd')+' '+dt_time;
			//Now handle limits
			holder1 = (ob.value.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			holder2 = (min=='') ? '' : (min.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			holder3 = (max=='') ? '' : (max.replace(/:/g,"").replace(/ /g,"").replace(/-/g,""))*1;
			if ((holder2 != '' && holder1 < holder2) || (holder3 != '' && holder1 > holder3)) {
				if(returntype=="hard") {
					var msg = ($('#valtext_divs #valtext_rangehard').length) ? $('#valtext_divs #valtext_rangehard').text() : 'The value you provided must be within the suggested range';
					simpleDialog(msg + ' (' + min + ' - ' + max +').', null, null, null, returnFocusJS);
					ob.style.backgroundColor='#FFB7BE';
				}
				else
				{
					var msg1 = ($('#valtext_divs #valtext_rangesoft1').length) ? $('#valtext_divs #valtext_rangesoft1').text() : 'The value you provided is outside the suggested range.';
					var msg2 = ($('#valtext_divs #valtext_rangesoft2').length) ? $('#valtext_divs #valtext_rangesoft2').text() : 'This value is admissible, but you may wish to verify.';
					simpleDialog(msg1 + ' (' + min + ' - ' + max +'). ' + msg2, null, null, null, returnFocusJS);
					ob.style.backgroundColor='#FFB7BE';
				}
			}
		}
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		return true;
	}


	//Dates
	if(texttype=="date")
	{
	    //if empty, let it go
		if(isEmpty(ob.value)){return true;}
	    var result;
	    var holder1 = parseDate(ob.value);
		if(holder1==null){
			var msg = ($('#valtext_divs #valtext_date').length) ? $('#valtext_divs #valtext_date').text() : 'The value entered in this field must be a date. You may use one of several formats (ex. YYYY-MM-DD or MM/DD/YYYY), but the final result must constitute a real date. Please try again.';
			simpleDialog(msg, null, null, null, returnFocusJS);
		    ob.style.fontWeight = 'bold';
			ob.style.backgroundColor='#FFB7BE';
	        return false;
		}
		holder1=formatDate(holder1,'y-MM-dd');
        ob.value=holder1;
        //Reset field style
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		//Now handle limits
		holder2 = (!min=='') ? formatDate(parseDate(min),'y-MM-dd') : formatDate(parseDate(ob.value),'y-MM-dd');
		holder3 = (!max=='') ? formatDate(parseDate(max),'y-MM-dd') : formatDate(parseDate(ob.value),'y-MM-dd');
		if(compareDates(holder2,'y-MM-dd',holder1,'y-MM-dd')==1 || compareDates(holder1,'y-MM-dd',holder3,'y-MM-dd')==1){
			if(returntype=="hard") {
				var msg = ($('#valtext_divs #valtext_rangehard').length) ? $('#valtext_divs #valtext_rangehard').text() : 'The value you provided must be within the suggested range';
				simpleDialog(msg + ' (' + holder2 + ' - ' + holder3 +').', null, null, null, returnFocusJS);
				ob.style.backgroundColor='#FFB7BE';
			}
			else
			{
				var msg1 = ($('#valtext_divs #valtext_rangesoft1').length) ? $('#valtext_divs #valtext_rangesoft1').text() : 'The value you provided is outside the suggested range.';
				var msg2 = ($('#valtext_divs #valtext_rangesoft2').length) ? $('#valtext_divs #valtext_rangesoft2').text() : 'This value is admissible, but you may wish to verify.';
				simpleDialog(msg1 + ' (' + holder2 + ' - ' + holder3 +'). ' + msg2, null, null, null, returnFocusJS);
				ob.style.backgroundColor='#FFB7BE';
			}
			return true;
		}
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		return true;
	}

	//Vanderbilt MRN
	if (texttype=="vmrn")
	{
		reformat_vanderbilt_mrn(ob); // Remove all non-numerals
		if (!is_vanderbilt_mrn(ob.value)) {
			var msg = ($('#valtext_divs #valtext_vmrn').length) ? $('#valtext_divs #valtext_vmrn').text() : 'The value entered is not a valid Vanderbilt Medical Record Number (i.e. 4- to 9-digit number, excluding leading zeros). Please try again.';
			simpleDialog(msg, null, null, null, returnFocusJS);
			ob.style.fontWeight = 'bold';
			ob.style.backgroundColor = '#FFB7BE';
			return false;
		} else {
			ob.style.fontWeight = 'normal';
			ob.style.backgroundColor='#FFFFFF';
			return true;
		}
	}

	//Numbers
	if (texttype=="int" ||texttype=="float")
    {
        //if empty, let it go
		if(isEmpty(ob.value)){return true;}
        var range_text;

		if(!min == '' && !max == ''){
	  			range_text = 'Range = ' + min + ' to ' + max;
	    } else {
	       	if(!min==''){
	            range_text = 'Minimum = ' + min;
	        } else {
	            range_text = max + ' = Maximum';
	        }
		}

		//First, make sure the type is correct
		if(texttype=="int")
		{
			return_value=isSignedInteger(ob.value,true);
			if(!return_value)
			{
				var msg = ($('#valtext_divs #valtext_integer').length) ? $('#valtext_divs #valtext_integer').text() : 'This value you provided is not an integer. Please try again.';
		    	simpleDialog(msg, null, null, null, returnFocusJS);
				ob.style.fontWeight = 'bold';
				ob.style.backgroundColor='#FFB7BE';
		        return false;
			}
		} else if(texttype=="float") {
			return_value=isSignedFloat(ob.value,true);
			if(!return_value)
			{
				var msg = ($('#valtext_divs #valtext_number').length) ? $('#valtext_divs #valtext_number').text() : 'This value you provided is not a number. Please try again.';
		    	simpleDialog(msg, null, null, null, returnFocusJS);
				ob.style.fontWeight = 'bold';
				ob.style.backgroundColor='#FFB7BE';
		        return false;
			}
		}

		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';

		//Handle case where min AND max not provided.
		if(min=='' && max==''){ return true; }
		//Handle case where min and/or max provided.
		if(!min==''){holder1 = min-0;} else {holder1=ob.value;}
		if(!max==''){holder2 = max-0;} else {holder2=ob.value;}
		if(ob.value > holder2 || ob.value < holder1){
			ob.style.fontWeight = 'bold';
			ob.style.backgroundColor='#FFB7BE';
			if(returntype=="hard") {
				var msg = ($('#valtext_divs #valtext_rangehard').length) ? $('#valtext_divs #valtext_rangehard').text() : 'The value you provided must be within the suggested range.';
				simpleDialog(msg + ' (' + range_text + ')', null, null, null, returnFocusJS);
			} else {
				var msg1 = ($('#valtext_divs #valtext_rangesoft1').length) ? $('#valtext_divs #valtext_rangesoft1').text() : 'The value you provided is outside the suggested range.';
				var msg2 = ($('#valtext_divs #valtext_rangesoft2').length) ? $('#valtext_divs #valtext_rangesoft2').text() : 'This value is admissible, but you may wish to verify.';
				simpleDialog(msg1 + ' (' + range_text +') ' + msg2, null, null, null, returnFocusJS);
			}
			return false;
		}
		ob.style.fontWeight = 'normal';
		ob.style.backgroundColor='#FFFFFF';
		return true;
	}
}

// Validate a Vanderbilt University Medical Record Number (4-9 digit number)
function is_vanderbilt_mrn(mrn) {
	// Remove non-numerals
	mrn = mrn.replace(/[^0-9]/ig, '');
	if (mrn == '') return true; // Ignore null value
	mrn = mrn*1;
	// Must be 4-9 digits
	return (mrn > 999 && mrn <= 999999999);
}
// Reformat a Vanderbilt University Medical Record Number (4-9 digit number)
function reformat_vanderbilt_mrn(ob) {
	mrn = ob.value;
	// Remove non-numerals
	mrn = mrn.replace(/[^0-9]/ig, '');
	if (mrn != '') {
		mrn = (mrn*1)+'';
		// Add leading zeros, if needed
		while (mrn.length < 9) mrn = "0" + mrn;
	}
	ob.value = mrn;
}


// Date Differencing Functions
function datediff(d1,d2,unit,dateformat,returnSigned)
{
	// Make sure Units are provided
	if (unit == null) {
		alert('CALCULATION ERRORS EXIST!\n\nThere is a syntactical error in a DATEDIFF calculation on this page. '
			+ 'The UNIT parameter is not specified. Please edit the equation to fix this.\n\n'
			+ 'See the Help & FAQ page for documentation on using the DATEDIFF function.');
		return;
	}
	// Initialize parameters first
	var d1 = String(d1).toLowerCase();
	var d2 = String(d2).toLowerCase();
	var dateformatProvided = (dateformat != null);
	if (dateformatProvided && dateformat != '') var dateformat = dateformat.toLowerCase();
	if (dateformat != "mdy" && dateformat != "dmy") dateformat = "ymd";
	returnSigned = (returnSigned == null) ? false : (returnSigned == true || returnSigned == 'true');
	var d1isToday = (d1 == "today" || d1 == today);
	// Determine data type of field ("date", "time", "datetime", or "datetime_seconds")
	var format_checkfield = (d1isToday ? d2 : d1);
	var numcolons = format_checkfield.split(":").length - 1;
	if (numcolons == 1) {
		if (format_checkfield.indexOf("-") > -1) {
			var datatype = "datetime";
		} else {
			var datatype = "time";
		}
	} else if (numcolons > 1) {
		var datatype = "datetime_seconds";
	} else {
		var datatype = "date";
	}
	// TIME
	if (datatype == "time") {
		// Return in specified units
		return secondDiff(timeToSeconds(d1),timeToSeconds(d2),unit,returnSigned);
	}
	// DATE	pre-check
	if (datatype == "date") {
		// If either is set as today's date
		if (d1isToday) {
			if (dateformat == "mdy") {
				d1 = today_mdy;
			} else if (dateformat == "dmy") {
				d1 = today_dmy;
			} else {
				d1 = today;
			}
		}
		if (d2 == "today" || d2 == today) {
			if (dateformat == "mdy") {
				d2 = today_mdy;
			} else if (dateformat == "dmy") {
				d2 = today_dmy;
			} else {
				d2 = today;
			}
		}
		if (d1.indexOf("-") < 0 || d2.indexOf("-") < 0) {
			return 'NaN';
		}
	}
	// Make sure the date/time values aren't empty
	if (d1 == "" || d2 == "" || d1 == null || d2 == null) return 'NaN';
	// When possible, check if dates are both in same format and also in same format as specified by dateformat parameter
	if (dateformat == "mdy" || dateformat == "dmy") {
		// For DMY or MDY, make sure hyphens are in correct places
		var dateformat1Correct = (d1.substr(2,1) == '-' && d1.substr(5,1) == '-');
		var dateformat2Correct = (d2.substr(2,1) == '-' && d2.substr(5,1) == '-');
	} else {
		// For YMD, make sure hyphens are in correct places
		var dateformat1Correct = (d1.substr(4,1) == '-' && d1.substr(7,1) == '-');
		var dateformat2Correct = (d2.substr(4,1) == '-' && d2.substr(7,1) == '-');
	}
	if (!(dateformat1Correct && dateformat2Correct)) {
		var msg = 'CALCULATION ERRORS EXIST!\n\nThere is a syntactical error in a DATEDIFF calculation on this page. ';
		if ((dateformat1Correct && !dateformat2Correct) || (!dateformat1Correct && dateformat2Correct)) {
			msg += '\n\nPROBLEM: The two values ("'+d1+'", "'+d2+'") appear to be in different formats from each other. They must both be in the same format. You will need to modify at least one of these fields so that its format is the same as the other (i.e. "ymd", "mdy", or "dmy").';
		}
		if (!dateformat1Correct) {
			msg += '\n\nPROBLEM: The first value ("'+d1+'") is not in the format specified in the equation (i.e. "'+dateformat+'"). ';
			if (!dateformatProvided) msg += 'Since the DATEFORMAT parameter was not provided as the fourth parameter in the equation, "ymd" format was assumed. ';
			msg += 'You will need to modify this field so that its validation format is now "'+dateformat+'" or else modify the DATEFORMAT parameter in the equation.';
		}
		if (!dateformat2Correct) {
			msg += '\n\nPROBLEM: The second value ("'+d2+'") is not in the format specified in the equation (i.e. "'+dateformat+'"). ';
			if (!dateformatProvided) msg += 'Since the DATEFORMAT parameter was not provided as the fourth parameter in the equation, "ymd" format was assumed. ';
			msg += 'You will need to modify this field so that its validation format is now "'+dateformat+'" or else modify the DATEFORMAT parameter in the equation.';
		}
		msg += '\n\nSee the Help & FAQ page for documentation on using the DATEDIFF function.';
		alert(msg);
		return;
	}
	// DATE, DATETIME, or DATETIME_SECONDS
	var d1sec = 0;
	var d2sec = 0;
	// Separate time if datetime or datetime_seconds
	if (datatype != "date") {
		d1b = d1.split(" ");
		d2b = d2.split(" ");
		// Split into date and time (in seconds)
		d1 = d1b[0];
		d2 = d2b[0];
		d1sec = timeToSeconds(d1b[1]);
		d2sec = timeToSeconds(d2b[1]);
	}
	var dt1 = d1.split("-");
	var dt2 = d2.split("-");
	// Convert the dates to seconds (conversion varies due to dateformat)
	if (dateformat == "ymd") {
		var dat1 = new Date(parseInt(dt1[0],10), parseInt(dt1[1],10)-1, parseInt(dt1[2],10), 0, 0, d1sec).valueOf();
		var dat2 = new Date(parseInt(dt2[0],10), parseInt(dt2[1],10)-1, parseInt(dt2[2],10), 0, 0, d2sec).valueOf();
	} else if (dateformat == "mdy") {
		var dat1 = new Date(parseInt(dt1[2],10), parseInt(dt1[0],10)-1, parseInt(dt1[1],10), 0, 0, d1sec).valueOf();
		var dat2 = new Date(parseInt(dt2[2],10), parseInt(dt2[0],10)-1, parseInt(dt2[1],10), 0, 0, d2sec).valueOf();
	} else if (dateformat == "dmy") {
		var dat1 = new Date(parseInt(dt1[2],10), parseInt(dt1[1],10)-1, parseInt(dt1[0],10), 0, 0, d1sec).valueOf();
		var dat2 = new Date(parseInt(dt2[2],10), parseInt(dt2[1],10)-1, parseInt(dt2[0],10), 0, 0, d2sec).valueOf();
	} else {
		return 'NaN';
	}
	// Get the difference in seconds
	var sec = (dat2-dat1)/1000;
	if (!returnSigned) sec = Math.abs(sec);
	// Return in specified units
	if (unit == "s") {
		return sec;
	} else if (unit == "m") {
		return sec/60;
	} else if (unit == "h") {
		return sec/3600;
	} else if (unit == "d") {
		return (datatype == "date" ? Math.round(sec/86400) : sec/86400);
	} else if (unit == "M") {
		return sec/2630016; // Use 1 month = 30.44 days
	} else if (unit == "y") {
		return sec/31556952; // Use 1 year = 365.2425 days
	}
	return 'NaN';
}
// Convert military time to seconds (i.e. number of seconds since midnight)
function timeToSeconds(time) {
	if (typeof time == "undefined") return 'NaN';
	if (time.indexOf(":") < 0) return 'NaN';
	timearray = time.split(":");
	return (timearray[0]*3600) + (timearray[1]*60) + (timearray[2] == undefined ? 0 : timearray[2]*1);
}
// Return the difference of two number values in desired units converted from seconds
function secondDiff(time1,time2,unit,returnSigned) {
	sec = time2-time1;
	if (!returnSigned) sec = Math.abs(sec);
	// Return in specified units
	if (unit == "s") {
		return sec;
	} else if (unit == "m") {
		return sec/60;
	} else if (unit == "h") {
		return sec/3600;
	} else if (unit == "d") {
		return sec/86400;
	} else if (unit == "M") {
		return sec/2630016; // Use 1 month = 30.44 days
	} else if (unit == "y") {
		return sec/31556952; // Use 1 year = 365.2425 days
	}
	return 'NaN';
}

// Calculate logarithm of a number with optional base (defaults to "e")
function log(number,base) {
	if (number == null) return 'NaN';
	// If missing numeric base, then do natural log
	if (!isNumeric(base)) return Math.log(number);
	// Return log of number for the given base
	return Math.log(number) / Math.log(base);
}
// Round numbers to a given decimal point
function round(number,decimal_points) {
	if (number == null) return 'NaN';
	if (!decimal_points || decimal_points == null) return Math.round(number);
	var exp = Math.pow(10, decimal_points);
	number = Math.round(number * exp) / exp;
	return parseFloat(number.toFixed(decimal_points));
}
// Round numbers up to a given decimal point
function roundup(number,decimal_points) {
	if (number == null) return 'NaN';
	if (!decimal_points || decimal_points == null) return Math.ceil(number);
	var exp = Math.pow(10, decimal_points);
	number = Math.ceil(number * exp) / exp;
	return parseFloat(number.toFixed(decimal_points));
}
// Round numbers down to a given decimal point
function rounddown(number,decimal_points) {
	if (number == null) return 'NaN';
	if (!decimal_points || decimal_points == null) return Math.floor(number);
	var exp = Math.pow(10, decimal_points);
	number = Math.floor(number * exp) / exp;
	return parseFloat(number.toFixed(decimal_points));
}
// Find mean of list of numbers (can input unlimited amount of arguments)
function mean() {
	var items = mean.arguments.length;
	var count = items;
	var sum = 0;
	var thisnum;
	for (i = 0; i < items; i++) {
		thisnum = mean.arguments[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			sum += parseFloat(thisnum);
		} else if (thisnum == null || thisnum == "undefined" || thisnum == "" || thisnum == "NaN") {
			count--;
		} else {
			return 'NaN';
		}
	}
	return (sum/count);
}
// Find median of list of numbers (can input unlimited amount of arguments)
function median() {
	var items = median.arguments;
	var n = items.length;
	var count = 0;
	var items2 = new Array();
	var thisnum;
	for (i = 0; i < n; i++) {
		thisnum = items[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			items2[i] = thisnum;
			count++;
		} else if (thisnum != null && thisnum != "undefined" && thisnum != "" && thisnum != 'NaN') {
			return 'NaN';
		}
	}
	// Sort the array
	items2.sort(function(a,b){return a - b});
	// Find median
	var h = Math.floor(count/2);
	if (count % 2 == 0) {
		return (items2[h]*1 + items2[h-1]*1) / 2;
	} else {
		return items2[h];
	}
}
// Find max of list of numbers (can input unlimited amount of arguments)
function max() {
	var items = max.arguments;
	var items2 = new Array();
	var thisnum;
	var count = 0;
	for (i = 0; i < items.length; i++) {
		thisnum = items[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			items2[count] = thisnum;
			count++;
		} else if (thisnum != null && thisnum != "undefined" && thisnum != "" && thisnum != 'NaN') {
			return 'NaN';
		}
	}
	return Math.max.apply(Math, items2);
}
// Find min of list of numbers (can input unlimited amount of arguments)
function min() {
	var items = min.arguments;
	var items2 = new Array();
	var thisnum;
	var count = 0;
	for (i = 0; i < items.length; i++) {
		thisnum = items[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			items2[count] = thisnum;
			count++;
		} else if (thisnum != null && thisnum != "undefined" && thisnum != "" && thisnum != 'NaN') {
			return 'NaN';
		}
	}
	return Math.min.apply(Math, items2);
}
// Find standard deviation of list of numbers (can input unlimited amount of arguments)
function stdev() {
	var data = stdev.arguments;
	var deviation = new Array();
	var valid_data = new Array();
	var sum = 0;
	var devnsum = 0;
	var stddevn = 0;
	var len = data.length;
	var valid_len = 0;
	for (var i=0; i<len; i++) {
		thisnum = data[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			sum = sum + (thisnum * 1);  // ensure number
			valid_data[valid_len] = thisnum;
			valid_len++;
		} else if (thisnum != null && thisnum != "undefined" && thisnum != "" && thisnum != 'NaN') {
			return 'NaN';
		}
	}
	data = new Array(); // clear data from memory
	if (valid_len == 0) return 'NaN';
	var mean = (sum/valid_len);
	for (i=0; i<valid_len; i++) {
		deviation[i] = valid_data[i] - mean;
		deviation[i] = deviation[i] * deviation[i];
		devnsum = devnsum + deviation[i];
	}
	return Math.sqrt(devnsum/(valid_len-1));
}
// Return absolute value of a number
function abs(val) {
	return (isFloat(val) ? Math.abs(val) : 'NaN');
}
// Find sum of list of numbers (can input unlimited amount of arguments)
function sum() {
	var items = sum.arguments.length;
	var thissum = 0;
	var thisnum;
	var usedNums = false;
	for (i = 0; i < items; i++) {
		thisnum = sum.arguments[i];
		if (isFloat(thisnum) && thisnum != 'NaN') {
			thissum += parseFloat(thisnum);
			usedNums = true;
		} else if (thisnum != null && thisnum != "undefined" && thisnum != "" && thisnum != 'NaN') {
			return 'NaN';
		}
	}
	return (usedNums ? thissum : 'NaN');
}

// Serialize a selector (i.e. a web form) into a JSON object with all its components
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

/****************************************************************************************************/
/***************** Custom JavaScript ******************************************************************/
/****************************************************************************************************/

// Center a jQuery object via .center()
jQuery.fn.center = function () {
    this.css("position","absolute");
    this.css("top", Math.max(0, (($(window).height() - $(this).outerHeight()) / 2) +
                                                $(window).scrollTop()) + "px");
    this.css("left", Math.max(0, (($(window).width() - $(this).outerWidth()) / 2) +
                                                $(window).scrollLeft()) + "px");
    return this;
}

// Returns version of Internet Explorer (if user is using IE)
function vIE(){
	var rv = -1;
	if (navigator.appName == 'Microsoft Internet Explorer')
	{
		var ua = navigator.userAgent;
		var re  = new RegExp("MSIE ([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null)
		  rv = parseFloat( RegExp.$1 );
	}
	else if (navigator.appName == 'Netscape')
	{
		var ua = navigator.userAgent;
		var re  = new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})");
		if (re.exec(ua) != null)
		  rv = parseFloat( RegExp.$1 );
	}
	// If IE7, 8, 9, or 10, use the Document Mode to really determine version
	if (rv >= 7 && rv <= 10) {
		rv = (document.documentMode) ? document.documentMode : 7;
	}
	return rv;
}

//AJAX object
var req = createXMLHttpRequest();
function createXMLHttpRequest() {
	var ua;
	if (window.XMLHttpRequest) {
		try {
			ua = new XMLHttpRequest();
		} catch(e) {
			ua = false;
		}
	} else if(window.ActiveXObject) {
		try {
			ua = new ActiveXObject("Microsoft.XMLHTTP");
		} catch(e) {
			ua = false;
		}
	}
	return ua;
}

//Allow for dynamic style changes
function changeSty(thisfield,classpassed){
	document.getElementById(thisfield).className=classpassed;
}

//Focus for radio fields
function doFocusRadio(field,form) {
	eval("try{ document."+form+"."+field+"___radio[0].focus() } catch(err) { try{ document."+form+"."+field+"___radio.focus() } catch(err) { document."+form+"."+field+".focus() } }");
}

// Move to next field when put focus on "reset value" link for radio fields (for easy tabbing on page)
function doFocusNext(field,form,iteration) {
	if (!isNumeric(iteration)) iteration = 1;
	var nexttabindex = ($('form#'+form+' [name="'+field+'"]').attr('tabindex')*1) + iteration;
	var nextfield = $('form#'+form+' input[tabindex="'+nexttabindex+'"]:enabled:visible:first, form#'+form+' select[tabindex="'+nexttabindex+'"]:enabled:visible:first, form#'+form+' textarea[tabindex="'+nexttabindex+'"]:enabled:visible:first');
	var nextradiofield = $('form#'+form+' input[name="'+nextfield.attr('name')+'___radio"]:first');
	if (nextradiofield.length && (nextradiofield.css('visibility') == 'visible' || nextradiofield.css('visibility') == 'inherit')) {
		// Next input is a radio, so put focus on it
		nextradiofield.trigger('focus');
	} else if (nextfield.length && (nextfield.css('visibility') == 'visible' || nextfield.css('visibility') == 'inherit')
		&& !nextfield.prop('readonly') && !nextfield.prop('disabled')) {
		// Put focus on next input, select, or textarea
		nextfield.trigger('focus');
	} else if (iteration <= 20) {
		// Don't do more than 20 recursions if field not found
		doFocusNext(field,form,iteration+1);
	} else {
		// Give up! Couldn't find the next field.
	}
}

// Highlight a form/survey table row with green background color
function doGreenHighlight(rowob) {
	// Reset bgcolor for all rows in case others are highlighted
	$('form#form #questiontable tr td.greenhighlight').removeClass('greenhighlight');
	// If found the row element, highlight all cells
	rowob.children("td").each(function() {
		$(this).addClass('greenhighlight');
		if ($(this).hasClass('labelmatrix')) {
			$(this).find('table tr td.data_matrix, table.mtxchoicetablechk tr td.data, table.mtxchoicetable tr td.data')
				.addClass('greenhighlight');
		}
	});
}

// Enable green row highlight for data entry form table
function enableDataEntryRowHighlight() {
	$('form#form #questiontable :input, form#form #questiontable a')
	.bind('click focus select', function(event){
		// If save buttons are not displayed (e.g., form is locked), then don't highlight row
		if ($('#__SUBMITBUTTONS__-div').css('display') == 'none') return;
		// Exclude if clicked the Data History and balloon icons for this field
		if ($(this).has('img').length) return;
		// Obtain type of html tag source that triggered this event
		var targetTag = event.target.nodeName.toLowerCase();
		// Exclude "reset" links for radios (unless directly clicked)
		if ($(this).hasClass('cclink') && event.type != 'click') return;
		// Exclude text input, textarea, and drop-down click because it would have already been triggered by focus
		if (event.type == 'click' && (targetTag == 'textarea' || targetTag == 'select'
			|| (targetTag == 'input' && $(event.target).attr('type') == 'text'))) return;
		// Skip over calc fields
		if (targetTag == 'input' && $(event.target).attr('type') == 'text' && $(event.target).attr('readonly') == 'readonly') return;
		// Find row element
		var tr = $(this).closest('tr');
		// Go up one or two levels if table nested within table
		if (tr.attr('sq_id') == null) tr = tr.parent().closest('tr');
		if (tr.attr('sq_id') == null) tr = tr.parent().closest('tr');
		// If could not find the row element, then stop
		if (tr.attr('sq_id') == null || tr.attr('id') == null || tr.attr('id').indexOf('-sh-tr') > -1) return;
		// Do green highlight on row
		doGreenHighlight(tr);
		// Add custom "Save and Open Query Popup" button
		if (data_resolution_enabled == '2') {
			var hasExclRedIcon = (tr.html().indexOf('balloon_exclamation.gif') > -1);
			var hasExclBlueIcon = (tr.html().indexOf('balloon_exclamation_blue.gif') > -1);
			if (hasExclRedIcon || hasExclBlueIcon) {
				// Get field name
				var fieldname = tr.attr('id').replace('-tr','');
				// Add content to tooltip
				$('#tooltipDRWsave').html( '<div style="padding:12px 0 0 8px;overflow:hidden;">'+
					'<button name="submit-btn-saverecord" class="jqbuttonmed" onclick="appendHiddenInputToForm(\'scroll-top\',\''+($(window).scrollTop())+'\');appendHiddenInputToForm(\'dqres-fld\',\''+fieldname+'\');dataEntrySubmit(this);return false;">'+
					'<img src="'+app_path_images+'balloon_exclamation'+(hasExclBlueIcon ? '_blue' : '')+'.gif"> Save and then open <br>Data Resolution Pop-up</button>'+
					'</div>');
				// Buttonize the Save&Open Popup button
				$('#tooltipDRWsave button').button();
				// Open tooltip	to right of field
				$('#tooltipDRWsave').css({
					position: "absolute",
					top: (tr.position().top + tr.outerHeight()/2 - $('#tooltipDRWsave').outerHeight()/2)+ "px",
					left: (tr.position().left + tr.outerWidth() - 10) + "px"
				}).show();
			} else {
				$('#tooltipDRWsave').hide();
			}
		}
	});
}

// Append hidden input to Data Entry Form (i.e. form#form)
function appendHiddenInputToForm(name,val) {
	$('form#form').append('<input type="hidden" value="'+val+'" name="'+name+'">');
}

//For unchecking radio buttons
function uncheckRadioGroup (radioButtonOrGroup) {
  if (radioButtonOrGroup.length) { // we have a group
    for (var b = 0; b < radioButtonOrGroup.length; b++)
      if (radioButtonOrGroup[b].checked) {
        radioButtonOrGroup[b].checked = false;
        break;
      }
  }
  else
    try{radioButtonOrGroup.checked = false}catch(err){};
}

//For check and uncheck reset password
//check box is unchecked, reset field not shown
var checkedIndex = true;
function ckReset(temp_pass) {
	var e = document.getElementById('resetFieldLeft');
	var d = resetFieldLeft_text + "<input type='hidden' name='reset_flag' value='1'>";
	if (checkedIndex == true) {
		if (temp_pass) {
			e.innerHTML = d + ckreset_msg1;
		} else {
			e.innerHTML = d + ckreset_msg2;
		}
		checkedIndex = false;
	} else if (checkedIndex == false) {
		e.innerHTML = "";
		checkedIndex = true;
	}
}

function chk_username(pass) {
   // pass - field to check
   // returns false if there are characters other than letters,
   // 	numbers, and underscores
   //re = /^\w@+$/;
   //Allow alphanumeric, underscore, period, hyphen, ampersand
   re = /^([a-zA-Z0-9_\.\-\@])+$/;
   return re.test(pass.value);
}
function chk_cont(pass) {
   // pass - field to check
   // returns false if there is not at least one lower-case letter,
   // 	one upper-case letter, and one number.
   re1 = /\d+/;
   re2 = /[a-z]+/;
   re3 = /[A-Z]+/;
   return re1.test(pass.value) && re2.test(pass.value) && re3.test(pass.value);
}

function chk_len(pass,mn,mx) {
   // pass - field to check
   // mn   - minimum allowed length
   // mx   - maximum allowed length
   // returns false if pass.value.length is less than
   //          or greater than mx
   var str = trim(pass.value);
return str.length >= mn && str.length <= mx }

function trim(s) {
   // str - any string
   // returns the same string with stripped leading and trailing blanks
   var str = new String(s);
   return (str == '') ? '' : str.replace(/^\s*|\s*$/g,"");
}

function alertbad(fld,mess) {
   alert(mess);
   setTimeout(function () { fld.focus() }, 1);
   return false;
}

function delete_doc(docs_id) {
	if(confirm(delete_doc_msg)) {
		window.location.href=app_path_webroot+page+"?pid="+pid+"&delete="+docs_id+addGoogTrans();
		return true;
	}
	return false;
}


//For individual field File uploads
function filePopUp(field_name,label_page,signature) {
	// Reset value of hidden field used to determine if signature was signed
	$('#f1_upload_form input[name="myfile_base64_edited"]').val('0');
	// Set dialog content, etc.
	document.getElementById('file_upload').innerHTML = file_upload_win;
	document.getElementById('field_name').value = field_name+'-linknew';
	// Ajax call
	$.get(label_page, { s: getParameterByName('s'), field_name: field_name, event_id: event_id, record: getParameterByName('id') },
		function(data) {
			$("#field_name_popup").html(data);
			$('#file_upload').dialog({ title: (signature == 1 ? lang_file_upload_title2 : lang_file_upload_title1), bgiframe: true, modal: true, width: (isMobileDevice ? $('#questiontable').width() : 500) });
			// Signature?
			if (signature == 1) {
				$('#signature-div, #signature-div-actions').show();
				$('#f1_upload_form').hide();
				$('#signature-div').jSignature();
				// $('#signature-div').jSignature({'decor-color': 'transparent'});
			} else {
				$('#signature-div, #signature-div-actions').hide();
				// Since iOS (v5.1 and below) devices do not support file uploading on webpages in Mobile Safari, give note to user about this.
				if (isIOS && iOSv <= 5) {
					$('#this_upload_field').hide();
					$('#f1_upload_form').html("<p style='color:red;'><b>CANNOT UPLOAD FILE!</b><br>"
						+ "We're sorry, but Apple does not support uploading files onto web pages "
						+ "in their Mobile Safari browser for iOS devices (iPhones, iPads, and iPod Touches) that "
						+ "are running iOS version 5.1 and below. "
						+ "Because it appears that you are using an iOS device on such an older version, you will not be able to upload a file here."
						+ "This is not an issue in REDCap but is merely a limitation imposed by Apple. NOTE: iOS version 6 and above *does* support uploading "
						+ "of pictures and videos (but not other file types).</p>");
				} else {
					$('#f1_upload_form').show();
				}
			}
			// In case any unsaved data from the form needs to be piped into the label in the dialog, manually trigger onblur for the field(s)
			$('#file_upload .piping_receiver').each(function(){
				// Get class that begins with "piperec"
				var classList = $(this).attr('class').split(/\s+/);
				for (var i = 0; i < classList.length; i++) {
					classList[i] = trim(classList[i]);
					if (classList[i].indexOf('piperec') === 0) {
						var evtRec = classList[i].split('-');
						// If the event_id is the current event_id of this form
						if (evtRec[1] == event_id) {
							// Trigger onblur/change/click of the field (cover all the bases, even radio elements)
							if ($('form#form [name="'+evtRec[2]+'___radio"]').length) {
								$('form#form [name="'+evtRec[2]+'___radio"]:checked').trigger('click');
							} else if ($('form#form [name="'+evtRec[2]+'"]').prop("tagName").toLowerCase() == 'select') {
								$('form#form [name="'+evtRec[2]+'"] option:selected').trigger('change');
							} else {
								$('form#form [name="'+evtRec[2]+'"]').trigger('blur');
							}
						}
					}
				}
			});
		}
	);
}
// Obtain the base64 data from a signature File Upload field
function saveSignature() {
	// Make sure we have a signature first (bypass this for IE8 and lower or iOS 6 and lower because of some strange issue)
	if ($('#f1_upload_form input[name="myfile_base64_edited"]').val() == '0' && !((isIOS && iOSv <= 6) || (isIE && IEv <= 8))) {
		simpleDialog("You must first sign your signature","ERROR",null,300);
		return false;
	}
	$('#signature-div, #signature-div-actions').hide();
	$('#f1_upload_form').show();
	var data = $('#signature-div').jSignature('getData', 'default');
	$('#f1_upload_form input[name="myfile_base64"]').val( data.substring(data.indexOf(',')+1) );
	$('form#form_file_upload').submit();
}
function startUpload(){
	// If didn't select a file, give an error msg
	var isSignature = ($('#f1_upload_form input[name="myfile_base64"]').val().length > 0);
	var missingFile = (!isSignature && $('#f1_upload_form input[name="myfile"]').val().length + $('#f1_upload_form input[name="myfile_base64"]').val().length == 0);
	if (!isSignature && missingFile) {
		simpleDialog("You must first choose a file to upload","ERROR",null,300);
		return false;
	} else {
		document.getElementById('f1_upload_process').style.display = 'block';
		document.getElementById('f1_upload_form').style.display = 'none';
		return true;
	}
}

function stopUpload(success,this_field,doc_id,doc_name,study_id,doc_size,event_id,download_page,delete_page,doc_id_hash,instance){
	var result = '';
	if (success == 1){
		result = '<div style="font-weight:bold;font-size:14px;text-align:center;color:green;"><br><img src="'+app_path_webroot+'Resources/images/tick.png"> Document was successfully uploaded!<\/div>';
		document.getElementById(this_field+"-link").style.display = 'block';
		if (doc_name.length > 34) doc_name = doc_name.substring(0,32)+"...";
		document.getElementById(this_field+"-link").innerHTML = doc_name+doc_size;
		document.getElementById(this_field+"-link").href = download_page+"&doc_id_hash="+doc_id_hash+"&id="+doc_id+"&s="+getParameterByName('s')+"&record="+study_id+"&page="+getParameterByName('page')+"&event_id="+event_id+"&field_name="+this_field+"&instance="+instance;
		$('#'+this_field+"-link").attr('onclick', "return appendRespHash('"+this_field+"');");
		var newlinktext = '<img src="'+app_path_images+'bullet_delete.png"> '
			+ '<a href="javascript:;" style="font-size:10px;color:red;" onclick=\'deleteDocumentConfirm('+doc_id+',"'+this_field+'","'+study_id+'",'+event_id+','+instance+',"'+delete_page+'&__response_hash__="+$("#form :input[name=__response_hash__]").val());return false;\'>Remove file</a>';
		if (sendit_enabled) {
			newlinktext += "<span class=\"sendit-lnk\"><span style=\"font-size:10px;padding:0 10px;\">or</span><img src=\""+app_path_images+"mail_small.png\"/><a onclick=\"popupSendIt("+doc_id+",3);return false;\" href=\"javascript:;\" style=\"font-size:10px;\">Send-It</a>&nbsp;</span>";
		}
		document.getElementById(this_field+"-linknew").innerHTML = newlinktext;
		eval("document.form."+this_field+".value = '"+doc_id+"';");
		// If a signature field, then add inline image
		var sigimg = $('#'+this_field+'-sigimg');
		if (sigimg.length) {
			sigimg.show().html('<img src="'+download_page.replace('file_download.php','image_view.php')+"&doc_id_hash="+doc_id_hash+"&id="+doc_id+"&s="+getParameterByName('s')+"&record="+study_id+"&page="+getParameterByName('page')+"&event_id="+event_id+"&instance="+instance+"&field_name="+this_field+'&signature=1" alt="[SIGNATURE]">');
		}
	} else {
		result = '<div style="font-weight:bold;color:#C00000;margin-top:15px;font-size:14px;text-align:center;">There was an error during file upload!<\/div>';
	}
	document.getElementById('f1_upload_form').style.display = 'block';
	document.getElementById('f1_upload_form').innerHTML = result;
	document.getElementById('f1_upload_process').style.display = 'none';
	// Close dialog automatically with fade effect
	if ($("#file_upload").hasClass('ui-dialog-content')) {
		if (success == 1) {
			// If this is a signature field, then close dialog immediately
			if ($('#'+this_field+'-sigimg').length) {
				$('#file_upload').dialog('destroy');
			} else {
				$('#file_upload').dialog('option', 'buttons', { "Close": function() { $(this).dialog("destroy"); } });
				setTimeout(function(){
					if ($("#file_upload").hasClass('ui-dialog-content')) $('#file_upload').dialog('option', 'hide', {effect:'fade', duration: 200}).dialog('close');
					// Destroy the dialog so that fade effect doesn't persist if reopened
					setTimeout(function(){
						if ($("#file_upload").hasClass('ui-dialog-content')) $('#file_upload').dialog('destroy');
					},200);
				},1500);
			}
		} else {
			$('#file_upload').dialog('option', 'buttons', { "Close": function() { $(this).dialog("destroy"); },
				"Try again": function() { $('#file_upload').dialog('destroy'); $('#'+this_field+'-linknew a.fileuploadlink').trigger('click'); } });
		}
	}
	// Trigger branching logic in case a "file" field is involved in branching
	calculate();
	doBranching();
	return true;
}

function deleteDocumentConfirm(doc_id,this_field,id,event_id,instance,delete_page) {
	simpleDialog("Are you sure you want to permanently remove this document?","Delete document?",null,420,null,"Cancel",function(){
		deleteDocument(doc_id,this_field,id,event_id,instance,delete_page);
	},"Yes, delete it");
}
function deleteDocument(doc_id,this_field,id,event_id,instance,delete_page) {
	eval("document.form."+this_field+".value = '';");
	$.get(delete_page, { s: getParameterByName('s'), id: doc_id, field_name: this_field, record: id, event_id: event_id, instance: instance },function(data) {
		$("#"+this_field+"-linknew").html(data);
		$("#"+this_field+"-link").hide();
		$('#'+this_field+'-sigimg').hide();
		dataEntryFormValuesChanged = true;
		// Display confirmation dialog
		var file_delete_dialog_id = 'file_delete_dialog';
		initDialog(file_delete_dialog_id);
		$('#'+file_delete_dialog_id).html('The document "<b>'+$("#"+this_field+"-link").html()+'</b>" has been deleted.');
		simpleDialog(null,"File deleted",file_delete_dialog_id);
		// Close dialog automatically with fade effect
		setTimeout(function(){
			if ($('#'+file_delete_dialog_id).hasClass('ui-dialog-content')) $('#'+file_delete_dialog_id).dialog('option', 'hide', {effect:'fade', duration: 500}).dialog('close');
			// Destroy the dialog so that fade effect doesn't persist if reopened
			setTimeout(function(){
				if ($('#'+file_delete_dialog_id).hasClass('ui-dialog-content')) $('#'+file_delete_dialog_id).dialog('destroy');
			},500);
		},2200);
	});
	// Trigger branching logic in case a "file" field is involved in branching
	doBranching();
	return true;
}

//Opens pop-up for sending Send-It files on forms and in File Repository
function popupSendIt(doc_id,loc) {
	window.open(app_path_webroot+'index.php?route=SendItController:upload&loc='+loc+'&id='+doc_id,'sendit','width=900, height=700, toolbar=0,menubar=0,location=0,status=0,scrollbars=1,resizable=1');
}



//Functions used in Branching Logic for hiding/showing fields
function checkAll(flag, formname, field) {
   var this_code;
   eval("var chkLen=document."+formname+"."+field+".length;");
   if (chkLen) {
      for (var x = 0; x < chkLen; x++) {
         if (flag == 1) {
			eval("document."+formname+"."+field+"[x].checked = true;");
         } else {
			eval("document."+formname+"."+field+"[x].checked = false;"
				+"this_code = document."+formname+"."+field+"[x].getAttribute('code');");
			eval("document."+formname+".__chk__"+field.substring(8)+"_RC_"+this_code+".value='';");
         }
      }
   } else {
      if (flag == 1) {
		eval("document."+formname+"."+field+".checked = true;");
      } else {
		eval("document."+formname+"."+field+".checked = false;"
			+"this_code = document."+formname+"."+field+".getAttribute('code');");
		eval("document."+formname+".__chk__"+field.substring(8)+"_RC_"+this_code+".value='';");
      }
   }
}

// Check if any checkboxes in a group are checked
function anyChecked(formname, field) {
	var numChecked = 0;
	var domfld = document.forms[formname].elements[field];
	// If field doesn't exist, it must be a "descriptive" field
	try {
		var fldexists = (domfld != null);
	} catch(e) {
		try {
			var fldexists = (domfld.value != null);
		} catch(e) {
			var fldexists = false;
		}
	}
   if (!fldexists) return 0;
   var chkLen2 = domfld.length;
   if (chkLen2) {
      for (var x = 0; x < chkLen2; x++) {
		if (document.forms[formname].elements[field][x].checked) numChecked++;
      }
   } else {
		if (document.forms[formname].elements[field].checked) numChecked++;
   }
   return numChecked;
}

// Return boolean for whether DOM element exists
function elementExists(domfld) {
	try {
		return (domfld != null);
	} catch(e) {
		return false;
	}
}

// Evaluate branching logic and show/hide table row based upon its evaluation
function evalLogic(this_field,logic) {
	if (logic == false) {
		// HIDE ROW (first evaluate if a checkbox)
		var is_chkbx = 0;
		var fldLen = 0;
		eval("var domfld = document.forms['form']."+this_field+";");
		if (isIE) {
			try {
				var fldexists = (domfld.value != null);
				if (fldexists) fldLen = domfld.value.length;
			} catch(e) {
				var fldexists = false;
				var fldLen = 0;
			}
		} else {
			var fldexists = (domfld != null);
			if (fldexists) fldLen = domfld.value.length;
		}
		if (!fldexists) {
			// Checkbox fields (might also be a "descriptive" field)
			var fldLen = anyChecked("form","__chkn__"+this_field);
			is_chkbx = 1;
		}
		var msg = (fldLen > 0) ? 'show' : '';
		// Now hide the row
		if (msg=='show') {
			if (showEraseValuePrompt) {
				// If using randomization, make sure we're not going to erase the randomization field or stata field values
				if (randomizationCriteriaFieldList != null && in_array(this_field, randomizationCriteriaFieldList)) {
					// Randomization fields CANNOT be hidden after randomization has happened, so stop here.
					return false;
				}
				// Determine if we should prompt the user and erase the value
				var eraseIt = (page == 'surveys/index.php') ? true : confirm(brErase(this_field));
			} else {
				var eraseIt = false;
			}
			if (eraseIt) {
				if (is_chkbx) {
					// Checkbox fields
					checkAll(0,"form","__chkn__"+this_field);
				} else {
					// Regular field
					domfld.value = '';
					// If a radio field, additionally make sure the radio buttons are all unchecked
					if (document.forms['form'].elements[this_field+'___radio'] != null) {
						uncheckRadioGroup(document.forms['form'].elements[this_field+'___radio']);
					}
					// If a select field with auto-complete enabled, then
					if (document.getElementById('rc-ac-input_'+this_field) != null) {
						document.getElementById('rc-ac-input_'+this_field).value = '';
					}
				}
				document.getElementById(this_field+'-tr').style.display='none';
			}
		} else {
			document.getElementById(this_field+'-tr').style.display='none';
		}
	} else {
		// SHOW ROW
		var showit = true;
		var getClassTerm = ((isIE && IEv<8) ? 'className' : 'class');
		if (page == 'surveys/index.php') {
			// Survey page: Treat differently since it contains fields on the form that might need to remain hidden (because of multi-paging)
			if (document.getElementById(this_field+'-tr').getAttribute(getClassTerm) != null) {
				if (document.getElementById(this_field+'-tr').getAttribute(getClassTerm).indexOf('hide') > -1) {
					// If row has class 'hide', then keep hidden
					showit = false;
				}
			}
		}
		// Now show the row, if applicable
		if (showit) document.getElementById(this_field+'-tr').style.display = (isIE && IEv<10 ? 'block' : 'table-row');
	}
}


//Data Cleaner functions
function ToggleDataCleanerDiv(fid,prefix,divId,spinId,field,svc,formVar,group_id,usingGCT) {
	if (usingGCT == null) usingGCT = false;
	var d = document.getElementById(divId);
	if (d.style.display != 'none' && d.style.display != '') {
		d.style.display = 'none';
		return;
	}
	/* Else we've got something to do */
	var s = document.getElementById(spinId);
	s.style.display = 'inline';
	//AJAX request to fetch values
	$.post(app_path_webroot+'DataExport/stats_highlowmiss.php?pid='+pid, { field: field, svc: svc, group_id: group_id, includeRecordsEvents: includeRecordsEvents }, function(data) {
		var val;
		var label;
		var id;
		var evtid;
		var instance;
		var html = prefix;
		s.style.display='none';
		/* element 0 is the count */
		var case_id = data.split('|');
		if (case_id[0] == 0) {
			//Zero records returned
			html += 'none';
		} else {
			//More than zero records returned. Parse them.
			for (var i = 1; i <= case_id[0]; i++) {
				var idv = case_id[i].split(':');
				id = idv[0];
				if (idv.length == 4){
					//High or Low values
					val = idv[1];					
					evtid = idv[2];
					instance = idv[3];
				} else {
					//Missing values
					val = idv[0];
					evtid = idv[1];
					instance = idv[2];
				}
				if (instance > 1) val += " (#"+instance+")";
				html += '<a target="_blank" style="text-decoration:underline;" onclick="$(\'#'+field+'-mperc\').html(\'\'); return true;" href="'+app_path_webroot+'DataEntry/index.php?pid='+pid+'&page='+formVar+'&event_id='+evtid+'&id='+id+'&instance='+instance+'&fldfocus='+field+'#'+field+'-tr">'+val+'</a>, ';
			}
			html = html.substring(0,html.length-2);
		}
		d.innerHTML = html;
		d.style.display='block';
	});
}
function PlotLoaded(divPlotId,spinId){
	s = document.getElementById(spinId);
	s.style.display = 'none';
	d = document.getElementById(divPlotId);
	d.style.display = 'inline';
}
function RefreshPlot(divPlotId,spinId,imgId){
	d = document.getElementById(divPlotId);
	s = document.getElementById(spinId);
	i = document.getElementById(imgId);
	im = s.childNodes[0]; /* image spinner */
	s.style.width = i.width + 'px';
	s.style.height= i.height + 'px';
	im.style.position  = 'relative';
	im.style.top = (Math.round(i.height / 2) - Math.round(im.height / 2))+ 'px';
	im.style.left = (Math.round(i.width / 2) - Math.round(im.width / 2)) + 'px';
	s.style.display = 'block';
	d.style.display = 'none';
	// Add "refresh" flag to prevent the pacing when done when viewing whole page (prevents lag)
	// Also add random num in URL to ensure refresh (make sure does not get added multiple times from multiple refreshes)
	var rgx = new RegExp("&refresh=0\.\\d*");
	if (rgx.test(i.src)){
		i.src = i.src.replace(rgx,'&refresh=' + Math.random());
	} else {
		i.src += '&refresh=' + Math.random();
	}

}
function ToggleFormPullDown(){
	d = document.getElementById("dc-form-list");
	i = document.getElementById("dc-expand");

	if (d.style.display != 'none' && d.style.display != ''){
		d.style.display = 'none';
		i.src = i.src.replace('collapse','expand');
	} else {
		i.src = i.src.replace('expand','collapse');
		d.style.display = 'block';
	}
}
var __isFireFox = navigator.userAgent.match(/gecko/i);

//returns the absolute position of some element within document
function GetElementAbsolutePos(element) {
	var res = new Object();
	res.x = 0; res.y = 0;
	if (element !== null) {
		res.x = element.offsetLeft;
		res.y = element.offsetTop;

		var offsetParent = element.offsetParent;
		var parentNode = element.parentNode;

		while (offsetParent !== null) {
			res.x += offsetParent.offsetLeft;
			res.y += offsetParent.offsetTop;

			if (offsetParent != document.body && offsetParent != document.documentElement) {
				res.x -= offsetParent.scrollLeft;
				res.y -= offsetParent.scrollTop;
			}
			//next lines are necessary to support FireFox problem with offsetParent
			if (__isFireFox) {
				while (offsetParent != parentNode && parentNode !== null) {
					res.x -= parentNode.scrollLeft;
					res.y -= parentNode.scrollTop;

					parentNode = parentNode.parentNode;
				}
			}
			parentNode = offsetParent.parentNode;
			offsetParent = offsetParent.offsetParent;
		}
	}
    return res;
}
function TogglePositionDesc(x,id,disp){
	d = document.getElementById(id);
	if ($('#'+id).hasClass('ui-dialog-content')) $('#'+id).dialog('destroy');
	$('#'+id).dialog({ bgiframe: true, modal: true, width: 500, buttons: { Close: function() { $(this).dialog('close'); } } });
}



//Function that makes table draggable
function AddTableDrag() {
	var table2 = document.getElementById('draggable');
	var tableDnD2 = new TableDnD();
	tableDnD2.init(table2);
}

function showEv(day_num) {
	document.getElementById('hiddenlink'+day_num).style.display = 'none';
	document.getElementById('hidden'+day_num).style.display = 'block';
}

// Highlight a whole html table (by ID) for a specified amount of time
function highlightTable(tblid,event_time) {
	if (document.getElementById(tblid) == null) return;
	$('#'+tblid+' td').effect('highlight',{},event_time);
}
//Highlight a table row (by ID) for a specified amount of time
function highlightTableRow(rowid,event_time) {
	$('#'+rowid+' td').effect('highlight',{},event_time);
}
//Highlight a table row (by jQuery object) for a specified amount of time
function highlightTableRowOb(ob,event_time) {
	ob.children('td').effect('highlight',{},event_time);
}

//Display "Working" div as progress indicator
function showProgress(show,ms) {
	// Set default time for fade-in/fade-out
	if (ms == null) ms = 500;
	if (!$("#working").length) 	$('body').append('<div id="working"><img src="'+app_path_images+'progress_circle.gif">&nbsp; Working...</div>');
	if (!$("#fade").length) 	$('body').append('<div id="fade"></div>');

	if (show) {
		$('#fade').addClass('black_overlay').show();
		$('#working').center().fadeIn(ms);
	} else {
		setTimeout(function(){
			$("#fade").removeClass('black_overlay').hide();
			$("#working").fadeOut(ms);
		},ms);
	}
}


//Place focus at end of text in an input Text field
function setCaretToEnd(el) {
	try {
		if (isIE) {
			if (el.createTextRange) {
				var v = el.value;
				var r = el.createTextRange();
				r.moveStart('character', v.length);
				r.select();
				return;
			}
			el.focus();
			return;
		}
		el.focus();
	} catch(e) { }
}

//Open pop-up for month/year/week conversion to days
function openConvertPopup() {
	if ($('#convert').hasClass('ui-dialog-content')) $('#convert').dialog('destroy');
	var this_day = $('#day_offset').val();
	if (this_day != '') {
		$("#calc_year").val(this_day/365);
		$("#calc_month").val(this_day/30);
		$("#calc_week").val(this_day/7);
		$("#calc_day").val(this_day);
	} else {
		$("#calc_year").val('');
		$("#calc_month").val('');
		$("#calc_week").val('');
		$("#calc_day").val('');
	}
	var pos = $('#day_offset').offset();
	$('#convTimeBtn').addClass('ui-state-default ui-corner-all');
	$('#convert').addClass('simpleDialog').dialog({ bgiframe: true, modal: true, width: 350, height: 250});
}
//Provide month/year/week conversion to days
function calcDay(el) {
	var isNumeric=function(symbol){var objRegExp=/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;return objRegExp.test(symbol);};
	if (!isNumeric(el.value)) {
		var oldval = el.value;
		$("#calc_year").val('');
		$("#calc_month").val('');
		$("#calc_week").val('');
		$("#calc_day").val('');
		$("#"+el.id).val(oldval);
	} else if (el.id == "calc_year") {
		$("#calc_month").val(el.value*12);
		$("#calc_week").val(el.value*52);
		$("#calc_day").val(Math.round(el.value*365));
	} else if (el.id == "calc_month") {
		$("#calc_year").val(el.value/12);
		$("#calc_week").val(el.value*4);
		$("#calc_day").val(Math.round(el.value*30));
	} else if (el.id == "calc_week") {
		$("#calc_year").val(el.value/52);
		$("#calc_month").val(el.value/4);
		$("#calc_day").val(Math.round(el.value*7));
	} else if (el.id == "calc_day") {
		$("#calc_year").val(el.value/365);
		$("#calc_month").val(el.value/30);
		$("#calc_week").val(el.value/7);
	}
	//Value of 9999 days is max
	if ($("#calc_day").val() != '' && isNumeric($("#calc_day").val())) {
		if ($("#calc_day").val() > 9999) $("#calc_day").val(9999);
	}
}


//Function for deleting an event/visit
function delVisit(arm,event_id,num_events_total) {
	if (confirm('DELETE EVENT?\n\nAre you sure you wish to delete this event?')) {
		if (status > 0) {
			if (!confirm('ARE YOU SURE?\n\nDeleting this event will DELETE ALL DATA collected for this event. Are you sure you wish to delete this event?')) {
				return;
			}
		}
		document.getElementById("progress").style.visibility = "visible";
		$.get(app_path_webroot+"Design/define_events_ajax.php", { pid: pid, arm: arm, action: 'delete', event_id: event_id },
			function(data) {
				document.getElementById("table").innerHTML = data;
				initDefineEvents();
				//Reload page if just added second event (so that all Longitudinal functions show)
				if (num_events_total == 2) {
					showProgress(1);
					setTimeout("window.location.reload();",300);
				}
			}
		);
	}
}
function delVisit2(arm,event_id,num_events_total) {
	if (confirm('DELETE EVENT?\n\nAre you sure you wish to delete this event?')) {
		document.getElementById("progress").style.visibility = "visible";
		$.get(app_path_webroot+"Design/define_events_ajax.php", { pid: pid, arm: arm, action: 'delete', event_id: event_id },
			function(data) {
				document.getElementById("table").innerHTML = data;
				initDefineEvents();
				//Reload page if just added second event (so that all Longitudinal functions show)
				if (num_events_total == 2) {
					showProgress(1);
					window.location.reload();
				}
			}
		);
	}
}

// Init Designate Instruments page
function initDesigInstruments() {
	initButtonWidgets();
	$('#downloadUploadEventsInstrDropdown').menu();
	$('#downloadUploadEventsInstrDropdownDiv ul li a').click(function(){
		$('#downloadUploadEventsInstrDropdownDiv').hide();
	});
	// Enable fixed table headers for event grid
	enableFixedTableHdrs('event_grid_table');
}

// Init Define Events page
function initDefineEvents() {
	initButtonWidgets();
	$('#downloadUploadEventsArmsDropdown').menu();
	$('#downloadUploadEventsArmsDropdownDiv ul li a').click(function(){
		$('#downloadUploadEventsArmsDropdownDiv').hide();
	});
	// If not using scheduling, then enable drag-n-drop for events in table
	if (!scheduling && $('.dragHandle').length > 1) {
		// Modify event order: Enable drag-n-drop on table
		$('#event_table').tableDnD({
			onDrop: function(table, row) {
				// Loop through table
				var event_ids = new Array(); var i=0;
				$("#event_table tr").each(function() {
					if ($(this).attr('id') != null) {
						event_ids[i++] = $(this).attr('id').substr(7);
					}
				});
				// Save event order
				$.post(app_path_webroot+'Design/define_events_ajax.php?pid='+pid, { action: 'reorder_events', arm: $('#arm').val(), event_ids: event_ids.join(',') }, function(data){
					$('#table').html(data);
					initDefineEvents();
					highlightTableRow($(row).attr('id'),2000);
				});
			},
			dragHandle: "dragHandle"
		});
		// Create mouseover image for drag-n-drop action and enable button fading on row hover
		$("#event_table tr:not(.nodrop)").mouseenter(function() {
			$(this.cells[0]).css('background','#fafafa url("'+app_path_images+'updown.gif") no-repeat center');
		}).mouseleave(function() {
			$(this.cells[0]).css('background','');
		});
		// Set up drag-n-drop pop-up tooltip
		$('.dragHandle').mouseenter(function() {
			$("#reorderTrigger").trigger('mouseover');
		}).mouseleave(function() {
			$("#reorderTrigger").trigger('mouseout');
		});
		// Miscellaneous things to init
		$('#reorderTip').hide('fade');
		$("#reorderTrigger").tooltip2({ tip: '#reorderTip', relative: true, effect: 'fade', position: 'top center', offset: [35,0] });
	}
}

//Function to begin editing an event/visit
function beginEdit(arm,event_id) {
	document.getElementById("progress").style.visibility = "visible";
	$.get(app_path_webroot+"Design/define_events_ajax.php", { pid: pid, arm: arm, edit: '', event_id: event_id },
		function(data) {
			document.getElementById("table").innerHTML = data;
			initDefineEvents();
			setCaretToEnd(document.getElementById("day_offset_edit"));
		}
	);
}
//Function for editing an event/visit
function editVisit(arm,event_id) {
	if (trim($("#descrip_edit").val()) == "" || ($("#offset_min_edit").length && ($("#offset_min_edit").val() == "" || $("#offset_max_edit").val() == "" || $("#day_offset_edit").val() == ""))) {
		simpleDialog("Please enter a value for Days Offset and Event Name");
		return;
	} else if ($("#offset_min_edit").length) {
		var offset_min = $("#offset_min_edit").val();
		var offset_max = $("#offset_max_edit").val();
		var day_offset = $("#day_offset_edit").val();
	} else {
		var offset_min = '';
		var offset_max = '';
		var day_offset = '';
	}
	if ($("#offset_min_edit").length) {
		document.getElementById("day_offset_edit").disabled = true;
		document.getElementById("offset_min_edit").disabled = true;
		document.getElementById("offset_max_edit").disabled = true;
	}
	document.getElementById("editbutton").disabled = true;
	document.getElementById("descrip_edit").disabled = true;
	document.getElementById("progress").style.visibility = "visible";
	$.post(app_path_webroot+"Design/define_events_ajax.php", { pid: pid, arm: arm, action: 'edit', event_id: event_id, offset_min: offset_min, offset_max: offset_max, day_offset: day_offset, descrip: document.getElementById("descrip_edit").value, custom_event_label: document.getElementById("custom_event_label_edit").value },
		function(data) {
			document.getElementById("table").innerHTML = data;
			initDefineEvents();
			highlightTableRow('design_'+event_id,2000);
		}
	);
}
//Function for adding an event/visit
function addEvents(arm,num_events_total) {
	if (trim($("#descrip").val()) == "") {
		simpleDialog("Please enter a name for the event you wish to add");
		$("#descrip").val(jQuery.trim($("#descrip").val()));
		return;
	} else if ($("#offset_min").length && ($("#offset_min").val() == "" || $("#offset_max").val() == "" || $("#day_offset").val() == "" || trim($("#descrip").val()) == "")) {
		simpleDialog("Please enter a value for Days Offset and Event Name");
		$("#descrip").val(jQuery.trim($("#descrip").val()));
		return;
	} else if ($("#offset_min").length) {
		var offset_min = $("#offset_min").val();
		var offset_max = $("#offset_max").val();
		var day_offset = $("#day_offset").val();
	} else {
		var offset_min = 0;
		var offset_max = 0;
		var day_offset = 9999;
	}
	// Check if event name is duplicated
	var event_names = "|";
	$("#event_table .evt_name").each(function(){
		event_names += jQuery.trim($(this).html()) + "|";
	});
	if (event_names.indexOf("|"+jQuery.trim($("#descrip").val())+"|") > -1) {
		simpleDialog("You have duplicated an existing event name. All events must have unique names. Please enter a different value.",null,null,null,'$("#descrip").focus()');
		return;
	}
	document.getElementById("progress").style.visibility = "visible";
	document.getElementById("addbutton").disabled = true;
	document.getElementById("descrip").disabled = true;
	if ($("#offset_min").length) {
		document.getElementById("day_offset").disabled = true;
		document.getElementById("offset_min").disabled = true;
		document.getElementById("offset_max").disabled = true;
	}
	$.get(app_path_webroot+"Design/define_events_ajax.php", { pid: pid, arm: arm, action: 'add', offset_min: offset_min, offset_max: offset_max, day_offset: day_offset, descrip: document.getElementById("descrip").value, custom_event_label: document.getElementById("custom_event_label").value },
		function(data) {
			$("#table").html(data);
			initDefineEvents();
			highlightTableRow('design_'+$("#new_event_id").val(), 2000);
			$('#descrip').focus();
			//Reload page if just added second event (so that all Longitudinal functions show)
			if (num_events_total == 1) {
				showProgress(1);
				setTimeout("window.location.reload();",300);
			} else {
				// If add event for first time on page, show tooltip reminder about designating forms
				if (hasShownDesignatePopup == 0) {
					$("#popupTrigger").trigger('mouseover');
					hasShownDesignatePopup++;
				}
			}
		}
	);
}


// Create/Edit Project form manipulation
function setFieldsCreateForm(slide_effect) {

	// Disble blind toggle sliding effect?
	if (slide_effect == null) slide_effect = true;
	var slow = (slide_effect) ? 'slow' : 0;

	// Check if step 1 is checked
	if ($('#projecttype1').prop('checked') || $('#projecttype2').prop('checked') ) {
		// Forms or Survey+Forms
		$('#repeatforms_chk1').removeAttr('disabled');
		$('#repeatforms_chk2').removeAttr('disabled');
		$('#step2').fadeTo(slow, 1);
	} else {
		$('#repeatforms_chk1').prop('disabled', 'disabled');
		$('#repeatforms_chk1').prop('checked',false);
		$('#repeatforms_chk2').prop('disabled', 'disabled');
		$('#repeatforms_chk2').prop('checked',false);
		if ($('#projecttype0').prop('checked')) {
			// Single Survey is selected
			if (slide_effect) {
				$('#step2').hide('fade',slow);
				$('#additional_options').hide('fade',slow);
			} else {
				$('#step2').hide();
				$('#additional_options').hide();
			}
			// Uncheck all checkboxes in "Additional options"
			$('#additional_options input[type="checkbox"]').prop('checked',false);
		} else {
			$('#step2').fadeTo('fast', 0.2);
			$('#additional_options').fadeTo('fast', 0.2);
		}
	}

	// Check if step 2 is checked
	if ($('#repeatforms_chk2').prop('checked')) {
		$('#step3').fadeTo(slow, 1);
		$('#scheduling_chk').removeAttr('disabled');
	} else {
		$('#scheduling_chk').prop('disabled', 'disabled');
		$('#scheduling_chk').prop('checked', false);
		$('#step3').fadeTo('fast', 0.2);
	}

	// Show additional options if step 2 is selected
	if ($('#repeatforms_chk1').prop('checked') || $('#repeatforms_chk2').prop('checked')) {
		$('#additional_options').fadeTo(slow, 1);
		$('#additional_options input[type="checkbox"]').prop('disabled',false);
	} else {
		$('#additional_options').fadeTo('fast', 0.2);
		$('#additional_options input[type="checkbox"]').prop('checked',false).prop('disabled',true);
	}

	// Surveys enabled
	if ($('#datacollect_chk').prop('checked') && $('#projecttype0').prop('checked')) {
		$('#surveys_enabled').val(2);
	} else if ($('#datacollect_chk').prop('checked') && $('#projecttype2').prop('checked')) {
		$('#surveys_enabled').val(1);
	} else {
		$('#surveys_enabled').val(0);
	}
	// Repeatforms field
	$('#repeatforms').val( ((($('#datacollect_chk').prop('checked') && $('#repeatforms_chk2').prop('checked')) || $('#scheduling_chk').prop('checked')) ? 1 : 0) );
	// Scheduling field
	$('#scheduling').val( (($('#scheduling_chk').prop('checked')) ? 1 : 0) );
	// Randomization field
	$('#randomization').val( (($('#randomization_chk').prop('checked')) ? 1 : 0) );
}

// Check values before submission on Create/Edit Project form
function setFieldsCreateFormChk() {
	if ($('#app_title').val().length < 1) {
		simpleDialog('Please provide a project title.','Missing title');
		return false;
	}
	if (page != "ProjectGeneral/copy_project_form.php") {
		if (
			(!$('#projecttype0').prop('checked') && !$('#projecttype1').prop('checked') && !$('#projecttype2').prop('checked'))
			|| ( ( $('#projecttype1').prop('checked') || $('#projecttype2').prop('checked') ) && ( !$('#repeatforms_chk1').prop('checked') && !$('#repeatforms_chk2').prop('checked') ) )
		   ) {
			simpleDialog('Please fill out all the fields and steps.','Some steps not completed');
			return false;
		}
	}
	if ($('#purpose').val() == '' || ($('#purpose').val() == '1' && $('#purpose_other_text').val() == '')) {
		simpleDialog('Please specify the purpose for creating this project','Specify purpose');
		return false;
	}
	var numChkBoxes = $('#purpose_other_research input[type=checkbox]').length - 1; // Number of Research checkboxes
	if ($('#purpose').val() == '2'){
		var numChecked = 0;
		for (i = 0; i <= numChkBoxes; i++) {
			if (document.getElementById('purpose_other['+i+']').checked) {
				numChecked++;
			}
		}
		if (numChecked < 1)	{
			simpleDialog('Please specify one or more areas of research for this project.','Specify research area');
			return false;
		}
	} else {
		for (i = 0; i <= numChkBoxes; i++) {
			document.getElementById('purpose_other['+i+']').checked = false;
		}
	}
	// If "template" option is selected, make sure the user has chosen a template from the table
	if ($('input[name="project_template_radio"]').length && !isNumeric($('input[name="copyof"]:checked').val())) {
		if ($('input[name="project_template_radio"]:checked').val() == '1') {
			simpleDialog('You have not selected a project template from the list. Please select a template.','Select a template');
			return false;
		} else if ($('input[name="project_template_radio"]:checked').val() == '2' && $('input[name="odm_edoc_id"]').length < 1
			&& ($('input[name="odm"]').val() == ''
			|| ($('input[name="odm"]').val() != '' && $('input[name="project_template_radio"]:checked').val() == '2'
				&& getfileextension(trim($('input[name="odm"]').val().toLowerCase())) != 'xml'))) {
			simpleDialog('You have not selected an XML file to upload. Please select an XML file.','Select an XML file');
			return false;
		}
	}
	return true;
}

// Change status of project
function doChangeStatus(archive,super_user_action,user_email,randomization,randProdAllocTableExists) {
	randomization = (randomization == null) ? 0 : (randomization == 1 ? 1 : 0);
	randProdAllocTableExists = (randProdAllocTableExists == null) ? 0 : (randProdAllocTableExists == 1 ? 1 : 0);
	var delete_data = 0;
	if (randomization == 1 && randProdAllocTableExists == 0) {
		alert('ERROR: This project is utilizing the randomization module and cannot be moved to production status yet because a randomization allocation table has not been uploaded for use in production status. Someone with appropriate rights must first go to the Randomization page and upload an allocation table.');
		return false;
	}
	var alertMessage =  '<div class="select-radio-button-msg" style="color: #C00000; font-size: 16px; margin-top: 10px;">Please select one of the options above before moving to production.</div>';
    if (archive == 0 && $('#delete_data').length) {
		if ($('#delete_data:checked').val() !== undefined ) {
			if ($('#delete_data:checked').val() == "on") {
				delete_data = 1;
		  $('.select-radio-button-msg').remove();
				// Make user confirm that they want to delete data
				if (archive == 0 && super_user_action != 'move_to_prod') { // Don't show prompt when super users are processing users' requests to push to prod
					if (!confirm("DELETE ALL DATA?\n\nAre you sure you really want to delete all existing data when the project is moved to production? If not, click Cancel and change the setting inside the yellow box.")) {
						return false;
					}
				}
			} else if (randomization) {
				// If not deleting all data BUT using randomization module, remind that the randomization field's values will be erased
				if (!confirm("WARNING: RANDOMIZATION FIELD'S DATA WILL BE DELETED\n\nSince you have enabled the randomization module, please be advised that if any records contain a value for your randomization field (i.e. have been randomized), those values will be PERMANENTLY DELETED once the project is moved to production. (Only data for that field will be deleted. Other fields will not be touched.) Is this okay?")) {
					return false;
				}
			}
		}else if($('#keep_data:checked').val() !== undefined){
			if ($('#keep_data:checked').val() == "on") {
			  delete_data = 0;
			  $('.select-radio-button-msg').remove();
			}
		}else{//if both undefined display message
			$('.select-radio-button-msg').remove();
			$('#status_dialog .yellow').append(alertMessage);
			return false;
		}
	}
	$(":button:contains('YES, Move to Production Status')").html('Please wait...');
	$(":button:contains('Cancel')").css("display","none");
	$.post(app_path_webroot+'ProjectGeneral/change_project_status.php?pid='+pid, { do_action_status: 1, archive: archive, delete_data: delete_data },
		function(data) {
			if (archive == 1) $('#archive_dialog').dialog('destroy'); else $('#status_dialog').dialog('destroy');
			if (data != '0') {
				if (archive == 1) {
					alert("The project has now been ARCHIVED.\n\n(You will now be redirected back to the Home page.)");
					window.location.href = app_path_webroot_full+'index.php?action=myprojects';
				} else {
					if (data == '1') {
						if (super_user_action == 'move_to_prod') {
							$.get(app_path_webroot+'ProjectGeneral/notifications.php', { pid: pid, type: 'move_to_prod_user', this_user_email: user_email },
								function(data2) {
                  if(self!=top){//decect if in iframe
                    simpleDialog('The user request for their REDCap project to be moved to production status has been approved.','Request Approved / User Notified');
                  }else{
									window.location.href = app_path_webroot_full+'index.php?action=approved_movetoprod&user_email='+user_email+addGoogTrans();
								}
                }
							);
						} else {
							window.location.href = app_path_webroot+'ProjectSetup/index.php?pid='+pid+'&msg=movetoprod'+addGoogTrans();
						}
					} else {
						alert("The project has now been set to INACTIVE status.\n\n(The page will now be reloaded to reflect the change.)");
						window.location.href = app_path_webroot+'index.php?pid='+pid+addGoogTrans();
					}
				}
			} else {
				alert('ERROR: The action could not be performed.');
			}
		}
	);
}

// Check if REDCap needs to upgrade (i.e. has new version folder on web server already)
function version_check() {
	$.get(app_path_webroot+'ControlCenter/version_check.php', { },
		function(data) {
			if (data != '0') {
				setTimeout(function(){
					$('#version_check').html(data);
					$('#version_check').slideToggle(500);
				},500);
			}
		}
	);
}
// View User list on User Controls page in Control Center
function view_user(username) {
	// Close userlist dialog pop-up, if opened
	if ($('#userList').hasClass('ui-dialog-content')) $('#userList').dialog('destroy');

	if (username.length < 1) return;
	$('#view_user_progress').css({'visibility':'visible'});
	$('#user_search_btn').prop('disabled',true);
	$('#user_search').prop('disabled',true);
	$.get(app_path_webroot+'ControlCenter/user_controls_ajax.php', { user_view: 'view_user', view: 'user_controls', username: username },
		function(data) {
			$('#view_user_div').html(data);
			highlightTable('indv_user_info',1000);
			enableUserSearch();
		}
	);
}

// For selecting values for merging in Data Comparison Tool when using Double Data Entry module
function dataCmpChk(col,field,val) {
	if (col < 3) {
		eval('document.create_new.'+field+'.value = val; document.create_new.'+field+'___RAD3.disabled = true;');
		changeSty(field+'___RAD3','data');
		if (col == 1) {
			changeSty(field+'___RAD1','header');
			changeSty(field+'___RAD2','data');
		} else if (col == 2) {
			changeSty(field+'___RAD1','data');
			changeSty(field+'___RAD2','header');
		}
	} else if (col == 3) {
		eval('document.create_new.'+field+'.value = ""; document.create_new.'+field+'___RAD3.disabled = false;');
		changeSty(field+'___RAD1','data');
		changeSty(field+'___RAD2','data');
		changeSty(field+'___RAD3','header');
	}
}

// Round corners of an html element
function roundCorners(element) {
	var size = 20;
	var settings = {
		tl: { radius: size },
		tr: { radius: size },
		bl: { radius: size },
		br: { radius: size },
		antiAlias: true
	}
	curvyCorners(settings, element);
}

// Check if vertical scrollbars exist
function IsYScrollBarExist(ObjectId) {
    Object = document.getElementById(ObjectId);
	Object.scrollTop = 1;
	if (Object.scrollTop > 0) {
		Object.scrollTop = 0;
		return true;
	} else {
		return false;
	}
}
// Check if horizontal scrollbars exist
function IsXScrollBarExist(ObjectId) {
	Object = document.getElementById(ObjectId);
	Object.scrollLeft=1;
	if (Object.scrollLeft>0) {Object.scrollLeft=0; return true;}
	else {return false;}
}

// Grow a textarea field on data entry form when "expand" link is clicked
function growTextarea(field) {
	if ($('#'+field).val().length > 0) {
		$('#'+field+'-expand').css({'visibility':'hidden'});
		$('#'+field).autogrow({onInitialize:true,speed:100});
	}
}

// Open pop-up window for viewing videos
function popupvid(video,title) {
	if (title == null) title = "REDCap Video";
	window.open('https://redcap.vanderbilt.edu/consortium/videoplayer.php?video='+video+'&title='+title+'&referer='+server_name,'myWin','width=1050, height=800, toolbar=0, menubar=0, location=0, status=0, scrollbars=1, resizable=1');
}

// Shared Library functionality
function shareForm() {
	window.location.href = app_path_webroot+"SharedLibrary/index.php?pid="+pid+"&page="+$('#form_names').val();
}
function loadSharedForm() {
	window.location.href = shared_lib_browse_url;
}

// Report Builder functionality to add new row to table
function addRow(thisFieldNum) {
	if ($('#dropdown-operator_'+thisFieldNum).length) {
		if ($('#dropdown-operator_'+thisFieldNum).prop('disabled')) {
			document.getElementById('num_query_fields').value++;
			document.getElementById('query_table').innerHTML = document.getElementById('query_table').innerHTML.substring(0,document.getElementById('query_table').innerHTML.length-16) + new_row.replace(/{__fieldnum__}/ig,document.getElementById('num_query_fields').value) + '</tbody></table>';
			for (var b = 1; b <= document.getElementById('num_query_fields').value; b++) {
				document.getElementById('dropdown-field_'+b).value = document.getElementById('allfield_'+b).value;
				document.getElementById('dropdown-operator_'+b).value = document.getElementById('operator_'+b).value;
				document.getElementById('visible-condvalue_'+b).value = document.getElementById('condvalue_'+b).value;
			}
			document.getElementById('visible-TITLE').value = document.getElementById('__TITLE__').value;
		}
	}
}

// Retrieve variable's value from URL
function getParameterByName(name,use_parent_window) {
	if (use_parent_window == null) use_parent_window = false;
	var loc = (use_parent_window ? window.opener.location.href : window.location.href);
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( loc );
	if( results == null )
		return "";
	else
		return results[1];
}

// Get, set, and delete cookies
function getCookie(c_name) {
	if (document.cookie.length>0)
	  {
	  c_start=document.cookie.indexOf(c_name + "=");
	  if (c_start!=-1)
		{
		c_start=c_start + c_name.length+1;
		c_end=document.cookie.indexOf(";",c_start);
		if (c_end==-1) c_end=document.cookie.length;
		return unescape(document.cookie.substring(c_start,c_end));
		}
	  }
	return "";
}
function deleteCookie(name) {
	document.cookie = name + "=" + ";expires=Thu, 01-Jan-1970 00:00:01 GMT; path=/";
}
// Set cookie with expiration at day-level
function setCookie(c_name,value,expiredays) {
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString())+"; path=/";
}
// Set cookie with expiration at minute-level
function setCookieMin(c_name,value,expiremin) {
	var exdate = new Date();
	var exdatemin = Math.floor(expiremin);
	var exdatesec = round((expiremin-exdatemin)*60);
	exdate.setMinutes(exdate.getMinutes()+exdatemin,exdate.getSeconds()+exdatesec,0);
	document.cookie=c_name+ "=" +escape(value)+((expiremin==null) ? "" : ";expires="+exdate.toGMTString())+"; path=/";
}

// Auto-suggest for entering new records on data entry page
function suggest(inputString,arm){
	if(inputString.length == 0) {
		$('#suggestions').fadeOut();
	} else {
	$('#inputString').addClass('load');
		$.post(app_path_webroot+'DataEntry/auto_complete.php?pid='+pid+'&arm='+arm, {query: ""+inputString+""}, function(data){
			if(data.length >0) {
				$('#suggestions').fadeIn();
				$('#suggestionsList').html(data);
				$('#inputString').removeClass('load');
			}
		});
	}
}

// Chack Two-byte character (for Japanese)
function checkIsTwoByte(value) {
	for (var i = 0; i < value.length; ++i) {
		var c = value.charCodeAt(i);
		if (c >= 256 || (c >= 0xff61 && c <= 0xff9f)) {
			return true;
		}
	}
	return false;
}

// After running branching logic, hide any section headers in which all fields in the section have been hidden
function hideSectionHeaders() {
	var this_id;
	var this_display;
	var lastSH = "";
	var numFields = 0;
	var numFieldsHidden = 0;
	var tbl = document.getElementById("questiontable");
	var rows = tbl.tBodies[0].rows; //getElementsByTagName("tr")
	var getClassTerm = ((isIE && IEv<8) ? 'className' : 'class'); // Weird issues with IE
	var matrixGroup = "";
	var lastMatrixGroup = "";
	var matrixGroups = new Array();
	var fieldIsHidden;
	var getClassTerm = ((isIE && IEv<8) ? 'className' : 'class');
	var thisClass;
	var isSurveyPage = (page == 'surveys/index.php');
	//Get index somewhere in middle of table
	for (var i=0; i<rows.length; i++) {
		// Get id for this row
		this_id = rows[i].getAttribute("id");

		// If this row has an id, then check if SH, matrix header, matrix field, or regular field
		if (this_id != null && this_id.indexOf("-tr") > 0) {

			// If a Section Header, then check if previous section's fields were all hidden. If so, then hide the SH too.
			if (this_id.indexOf("-sh-tr") > 0) {
				if (lastSH != "") {
					if (numFieldsHidden == numFields && numFields > 0) {
						// Hide SH
						document.getElementById(lastSH).style.display = 'none';
					} else {
						// Possibly show SH OR do nothing
						var showit = true;
						if (isSurveyPage) {
							// Survey page: Treat differently since it contains fields on the form that might need to remain hidden (because of multi-paging)
							if (document.getElementById(lastSH).getAttribute(getClassTerm) != null) {
								if (document.getElementById(lastSH).getAttribute(getClassTerm).indexOf('hide') > -1) {
									// If row has class 'hide', then keep hidden
									showit = false;
								}
							}
						}
						// Make SH visible (in case it was hidden)
						if (showit) document.getElementById(lastSH).style.display = (isIE && IEv<10 ? 'block' : 'table-row');
					}
				}
				// Reset values for next section
				lastSH = this_id;
				numFields = 0;
				numFieldsHidden = 0;
				matrixGroup = "";
			}

			// If a Matrix Header, then hide the Matrix Header too.
			else if (this_id.indexOf("-mtxhdr-tr") > 0) {
				matrixGroup = lastMatrixGroup = document.getElementById(this_id).getAttribute('mtxgrp');
				matrixGroups[matrixGroup] = 0;
			}

			// If a normal field, then check its display value AND if it's in a matrix group
			else {
				// Check if hidden
				fieldIsHidden = document.getElementById(this_id).style.display == "none";
				if (!fieldIsHidden) {
					// Also check if has @HIDDEN action tag
					if (document.getElementById(this_id).getAttribute(getClassTerm) != null) {
						thisClass = document.getElementById(this_id).getAttribute(getClassTerm);
						if (thisClass.indexOf('@HIDDEN ') > -1 || thisClass.substr(thisClass.length-7) == '@HIDDEN' 
							|| (isSurveyPage && thisClass.indexOf('@HIDDEN-SURVEY') > -1)
							|| (!isSurveyPage && thisClass.indexOf('@HIDDEN-FORM') > -1)) 
						{
							// Set as hidden
							fieldIsHidden = true;
							document.getElementById(this_id).style.display == "none";
						}
					}
				}
				if (fieldIsHidden) numFieldsHidden++;
				// Count field for this section
				numFields++;
				// If field is in a matrix group, get group name
				if (document.getElementById(this_id).getAttribute('mtxgrp') != null) {
					matrixGroup = document.getElementById(this_id).getAttribute('mtxgrp');
					if (!fieldIsHidden) matrixGroups[matrixGroup]++;
				}
			}

		}
	}

	// For survey pages only: Check if we need to hide the last SH on the page (will not hide by itself with current logic)
	if (isSurveyPage && lastSH != "") {
		if (numFieldsHidden == numFields && numFields > 0) {
			// Hide SH
			document.getElementById(lastSH).style.display = 'none';
		} else {
			// Possibly show SH OR do nothing
			var showit = true;
			if (isSurveyPage) {
				// Survey page: Treat differently since it contains fields on the form that might need to remain hidden (because of multi-paging)
				if (document.getElementById(lastSH).getAttribute(getClassTerm) != null) {
					if (document.getElementById(lastSH).getAttribute(getClassTerm).indexOf('hide') > -1) {
						// If row has class 'hide', then keep hidden
						showit = false;
					}
				}
			}
			// Make SH visible (in case it was hidden)
			if (showit) document.getElementById(lastSH).style.display = (isIE && IEv<10 ? 'block' : 'table-row');
		}
	}

	// If any matrix groups have all their fields hidden (i.e. value=0), then hide the matrix header
	for (var grpname in matrixGroups) {
		var mtxhdr_id = grpname+'-mtxhdr-tr';
		if (matrixGroups[grpname] == 0) {
			// Hide matrix header
			document.getElementById(mtxhdr_id).style.display = 'none';
		} else {
			// Possibly show matrix header OR do nothing
			var showit = true;
			if (isSurveyPage) {
				// Survey page: Treat differently since it contains fields on the form that might need to remain hidden (because of multi-paging)
				if (document.getElementById(mtxhdr_id).getAttribute(getClassTerm) != null) {
					if (document.getElementById(mtxhdr_id).getAttribute(getClassTerm).indexOf('hide') > -1) {
						// If row has class 'hide', then keep hidden
						showit = false;
					}
				}
			}
			// Make matrix header visible (in case it was hidden)
			if (showit) document.getElementById(mtxhdr_id).style.display = (isIE && IEv<10 ? 'block' : 'table-row');
		}
	}
}

// Data history icon onmouseover/out actions
function dh1(ob) {
	ob.src = app_path_images+'history_active.png';
}
function dh2(ob) {
	ob.src = app_path_images+'history.png';
}

// Open pop-up dialog for viewing data history of a field
function dataHist(field,event_id,record) {
	// Get window scroll position before we load dialog content
	var windowScrollTop = $(window).scrollTop();
	if (record == null) record = decodeURIComponent(getParameterByName('id'));
	if ($('#data_history').hasClass('ui-dialog-content')) $('#data_history').dialog('destroy');
	$('#dh_var').html(field);
	$('#data_history2').html('<p><img src="'+app_path_images+'progress_circle.gif"> Loading...</p>');
	$('#data_history').dialog({ bgiframe: true, title: 'Data History for variable "'+field+'" for record "'+record+'"', modal: true, width: 650, zIndex: 3999, buttons: {
		Close: function() { $(this).dialog('destroy'); } }
	});
	$.post(app_path_webroot+"DataEntry/data_history_popup.php?pid="+pid, {field_name: field, event_id: event_id, record: record, instance: getParameterByName('instance') }, function(data){
		$('#data_history2').html(data);
		// Adjust table height within the dialog to fit
		var tableHeightMax = 300;
		if ($('#data_history3').height() > tableHeightMax) {
			$('#data_history3').height(tableHeightMax);
			$('#data_history3').scrollTop( $('#data_history3')[0].scrollHeight );
			// Reset window scroll position, if got moved when dialog content was loaded
			$(window).scrollTop(windowScrollTop);
			// Re-center dialog
			$('#data_history').dialog('option', 'position', { my: "center", at: "center", of: window });
		}
		// Highlight the last row in DH table
		if ($('table#dh_table tr').length > 1) {
			setTimeout(function(){
				highlightTableRowOb($('table#dh_table tr:last'), 3500);
			},300);
		}
	});
}

// Data Cleaner icon onmouseover/out actions
function dc1(ob) {
	ob.src = app_path_images+'balloon_left.png';
}
function dc2(ob) {
	ob.src = app_path_images+'balloon_left_bw2.gif';
}

// Modify the page's URL in browser's address bar *without* reloading the page
function modifyURL(newUrl) {
	if (window.history.pushState && window.history.replaceState) {
		window.history.pushState({}, document.title, newUrl);
	}
}

// Open DRW Introduction pop-up
function openDataResolutionIntroPopup() {
	$.post(app_path_webroot+"DataQuality/data_resolution_intro_popup.php?pid="+pid, { }, function(data){
		var json_data = jQuery.parseJSON(data);
		simpleDialog(json_data.content,json_data.title,'drw_intro_popup',700);
		fitDialog($('#drw_intro_popup'));
	});
}

// Reload the Data Resolution Log table in Data Quality module
function dataResLogReload(show_progress) {
	var status_type = $('#choose_status_type').val();
	var field_rule = $('#choose_field_rule').val();
	var group_id = ($('#choose_dag').length) ? $('#choose_dag').val() : '';
	var event_id = ($('#choose_event').length) ? $('#choose_event').val() : '';
	var assigned_user_id = ($('#choose_assigned_user').length) ? $('#choose_assigned_user').val() : '';
	var query_string = 'pid='+pid+'&status_type='+status_type+'&field_rule_filter='+field_rule;
	if (group_id != '') query_string += '&group_id='+group_id;
	if (event_id != '') query_string += '&event_id='+event_id;
	if (assigned_user_id != '') query_string += '&assigned_user_id='+assigned_user_id;
	show_progress = !!show_progress;
	if (show_progress) showProgress(1);
	$.post(app_path_webroot+'DataQuality/resolve_ajax.php?'+query_string,{},function(data){
		// Parse JSON
		var json_data = jQuery.parseJSON(data);
		// Replace table html
		$('#resTableParent').html(json_data.html);
		// Update count in tab badge
		$('#dq_tab_issue_count').html(json_data.num_issues);
		// Initialize other things
		initWidgets();
		if (show_progress) showProgress(0);
		// Modify URL without reloading page
		modifyURL(app_path_webroot+page+'?'+query_string);
	});
}

// Open pop-up dialog for viewing data resolution for a field
function dataResPopup(field,event_id,record,existing_record,rule_id,instance) {
	if (typeof instance == "undefined") instance = 1;
	if (record == null) record = getParameterByName('id');
	if (existing_record == null) existing_record = $('form#form :input[name="hidden_edit_flag"]').val();
	if (rule_id == null) rule_id = '';
	// Hide floating field tooltip on form (if visible)
	$('#tooltipDRWsave').hide();
	showProgress(1,0);
	// Get dialog content via ajax
	$.post(app_path_webroot+"DataQuality/data_resolution_popup.php?pid="+pid+'&instance='+instance, { rule_id: rule_id, action: 'view', field_name: field, event_id: event_id, record: record, existing_record: existing_record }, function(data){
		showProgress(0,0);
		// Parse JSON
		var json_data = jQuery.parseJSON(data);
		if (existing_record == 1) {
			// Get window scroll position before we load dialog content
			var windowScrollTop = $(window).scrollTop();
			// Load the dialog content
			initDialog('data_resolution');
			$('#data_resolution').html(json_data.content);
			initWidgets();
			// Set dialog width
			var dialog_width = (data_resolution_enabled == '1') ? 700 : 750;
			// Open dialog
			$('#data_resolution').dialog({ bgiframe: true, title: json_data.title, modal: true, width: dialog_width, zIndex: 3999, destroy: 'fade' });
			// Adjust table height within the dialog to fit
			var existingRowsHeightMax = 300;
			if ($('#existingDCHistoryDiv').height() > existingRowsHeightMax) {
				$('#existingDCHistoryDiv').height(existingRowsHeightMax);
				$('#existingDCHistoryDiv').scrollTop( $('#existingDCHistoryDiv')[0].scrollHeight );
				// Reset window scroll position, if got moved when dialog content was loaded
				$(window).scrollTop(windowScrollTop);
				// Re-center dialog
				$('#data_resolution').dialog('option', 'position', { my: "center", at: "center", of: window });
			}
			// Put cursor inside text box
			$('#dc-comment').focus();
		} else {
			// If record does not exist yet, then give warning that will not work
			initDialog('data_resolution');
			$('#data_resolution').css('background-color','#FFF7D2').html(json_data.content);
			initWidgets();
			$('#data_resolution').dialog({ bgiframe: true, title: json_data.title, modal: true, width: 500, zIndex: 3999 });
		}
	});
}

// Edit a Field Comment
function editFieldComment(res_id, form, openForEditing, cancelEdit) {
	var td_div = $('table#existingDCHistory tr#res_id-'+res_id+' td:eq(3) div:first');
	if (openForEditing) {
		// Make the text an editable textarea
		var comment = br2nl(td_div.html().replace(/\t/g,'').replace(/\r/g,'').replace(/\n/g,''));
		var textarea = '<div id="dc-comment-edit-div-'+res_id+'"><textarea id="dc-comment-edit-'+res_id+'" class="x-form-field notesbox" style="height:45px;width:97%;display:block;margin-bottom:2px;">'+comment+'</textarea>'
					 + '<button id="dc-comment-savebtn-'+res_id+'" class="jqbuttonmed" style="font-size:11px;font-weight:bold;" onclick="editFieldComment('+res_id+',\''+form+'\',0,0);">Save</button>'
					 + '<button id="dc-comment-cancelbtn-'+res_id+'" class="jqbuttonmed" style="font-size:11px;" onclick="editFieldComment('+res_id+',\''+form+'\',0,1);">Cancel</button></div>';
		td_div.hide().after(textarea);
		$('#dc-comment-savebtn-'+res_id+', #dc-comment-cancelbtn-'+res_id).button();
		$('table#existingDCHistory tr#res_id-'+res_id+' td:eq(0) img').css('visibility','hidden');
	} else if (cancelEdit) {
		// Cancel the edit (return as it was)
		$('table#existingDCHistory tr#res_id-'+res_id+' td:eq(0) img').css('visibility','visible');
		td_div.show();
		$('#dc-comment-edit-div-'+res_id).remove();
	} else {
		var comment = $('#dc-comment-edit-'+res_id).val();
		// Make ajax call
		$.post(app_path_webroot+"DataQuality/field_comment_log_edit_delete_ajax.php?pid="+pid, { action: 'edit', comment: comment, form_name: form, res_id: res_id}, function(data){
			if (data=='0') {
				alert(woops);
			} else {
				// Parse JSON
				var json_data = jQuery.parseJSON(data);
				$('table#existingDCHistory tr#res_id-'+res_id+' td:eq(0) img').css('visibility','visible');
				highlightTableRowOb( $('table#existingDCHistory tr#res_id-'+res_id), 3000);
				td_div.show().html(nl2br(comment));
				$('#dc-comment-edit-div-'+res_id).remove();
				// Display the "edit" text
				$('table#existingDCHistory tr#res_id-'+res_id+' .fc-comment-edit').show();
			}
		});
	}
}

// Delete a Field Comment
function deleteFieldComment(res_id, form, confirmDelete) {
	var url = app_path_webroot+"DataQuality/field_comment_log_edit_delete_ajax.php?pid="+pid;
	// Make ajax call
	$.post(url, { action: 'delete', form_name: form, res_id: res_id, confirmDelete: confirmDelete}, function(data){
		if (data=='0') {
			alert(woops);
		} else {
			// Parse JSON
			var json_data = jQuery.parseJSON(data);
			if (confirmDelete) {
				simpleDialog(json_data.html,json_data.title,null,null,null,json_data.closeButton,'deleteFieldComment('+res_id+', "'+form+'",0);',json_data.actionButton);
			} else {
				$('table#existingDCHistory tr#res_id-'+res_id+' td:eq(0) img').css('visibility','hidden');
				$('table#existingDCHistory tr#res_id-'+res_id+' td').each(function(){
					$(this).removeClass('data').addClass('red').css('color','gray');
				});
				setTimeout(function(){
					$('table#existingDCHistory tr#res_id-'+res_id).hide('fade');
				},3000);
			}
		}
	});
}

// Save new values from data cleaner pop-up dialog for individual field
function dataResolutionSave(field,event_id,record,rule_id,instance) {
	if (typeof instance == "undefined") instance = 1;
	// Set vars
	if (record == null) record = getParameterByName('id');
	if (rule_id == null) rule_id = '';
	// Check input values
	var comment = trim($('#dc-comment').val());
	//alert( $('#data_resolution input[name="dc-status"]:checked').val() );return;
	if (comment.length == 0 && ($('#data_resolution input[name="dc-status"]').length == 0
		|| ($('#data_resolution input[name="dc-status"]').length && $('#data_resolution input[name="dc-status"]:checked').val() != 'VERIFIED'))) {
		simpleDialog("A comment is required. Please enter a comment.","ERROR: Enter comment");
		return;
	}
	var query_status = ($('#data_resolution input[name="dc-status"]:checked').length ? $('#data_resolution input[name="dc-status"]:checked').val() : '');
	if ($('#dc-response').length && query_status != 'CLOSED' && $('#dc-response').val().length == 0) {
		simpleDialog("A response is required. Please select a response option from the drop-down.","ERROR: Select response option");
		return;
	}
	var response = (($('#dc-response').length && query_status != 'CLOSED') ? $('#dc-response').val() : '');
	// Note if user is sending query back for further attention (rather than closing it)
	var send_back = (query_status != 'CLOSED' && $('#dc-response_requested-closed').length) ? 1 : 0;
	// Determine if we're re-opening the query (i.e. if #dc-response_requested is a checkbox and assign user drop-down is not there)
	var reopen_query = ($('#dc-response_requested').length && $('#dc-response_requested').attr('type') == 'checkbox' && $('#dc-assigned_user_id').length == 0) ? 1 : 0;
	// If user is responding to query, check for file uploaded
	var upload_doc_id = '';
	var delete_doc_id = '';
	delete_doc_id_count = 0;
	if ($('#drw_upload_file_container input.drw_upload_doc_id').length > 0) {
		// Loop through all doc_id's available
		delete_doc_id = new Array();
		$('#drw_upload_file_container input.drw_upload_doc_id').each(function(){
			if ($(this).attr('delete') == 'yes') {
				delete_doc_id[delete_doc_id_count++] = $(this).val();
			} else {
				upload_doc_id = $(this).val();
			}
		});
		delete_doc_id = delete_doc_id.join(",");
	}
	// Disable all input fields in pop-up while saving
	$('#newDCHistory :input').prop('disabled',true);
	$('#data_resolution .jqbutton').button('disable');
	// Display saving icon
	$('#drw_saving').removeClass('hidden');
	// Get start time before ajax call is made
	var starttime = new Date().getTime();
	// Make ajax call
	$.post(app_path_webroot+"DataQuality/data_resolution_popup.php?pid="+pid+'&instance='+instance, { action: 'save', field_name: field, event_id: event_id, record: record,
		comment: comment,
		response_requested: (($('#dc-response_requested').length && $('#dc-response_requested').prop('checked')) ? 1 : 0),
		upload_doc_id: upload_doc_id, delete_doc_id: delete_doc_id,
		assigned_user_id: (($('#dc-assigned_user_id').length) ? $('#dc-assigned_user_id').val() : ''),
		status: query_status, send_back: send_back,
		response: response, reopen_query: reopen_query,
		rule_id: rule_id
	}, function(data){
		if (data=='0') {
			alert(woops);
		} else {
			// Parse JSON
			var json_data = jQuery.parseJSON(data);
			// Update new timestamp for saved row (in case different)
			$('#newDCnow').html(json_data.tsNow);
			// Display saved icon
			$('#drw_saving').addClass('hidden');
			$('#drw_saved').removeClass('hidden');
			// Set bg color of last row to green
			$('table#newDCHistory tr td.data').css({'background-color':'#C1FFC1'});
			// Page-dependent actions
			if (page == 'DataQuality/field_comment_log.php') {
				// Field Comment Log page: reload table
				reloadFieldCommentLog();
			} else if (page == 'DataQuality/resolve.php') {
				// Data Quality Resolve Issues page: reload table
				dataResLogReload();
			} else if (page == 'DataQuality/index.php') {
				// Update count in tab badge
				$('#dq_tab_issue_count').html(json_data.num_issues);
			}
			// Update icons/counts
			if (page == 'DataEntry/index.php' || page == 'DataQuality/index.php') {
				// Data Quality Find Issues page: Change ballon icon for this field/rule result
				$('#dc-icon-'+rule_id+'_'+field+'__'+record).attr('src', json_data.icon);
				// Update number of comments for this field/rule result
				$('#dc-numcom-'+rule_id+'_'+field+'__'+record).html(json_data.num_comments);
				// Data Entry page: Change ballon icon for field
				$('#dc-icon-'+field).attr('src', json_data.icon).attr('onmouseover', '').attr('onmouseout', '');
			}
			// CLOSE DIALOG: Get response time of ajax call (to ensure closing time is always the same even with longer requests)
			var endtime = new Date().getTime() - starttime;
			var delaytime = 1500;
			var timeouttime = (endtime >= delaytime) ? 1000 : (delaytime - endtime);
			setTimeout(function(){
				// Close dialog with fade effect
				$('#data_resolution').dialog('option', 'hide', {effect:'fade', duration: 500}).dialog('close');
				// Highlight table row in form (to emphasize where user was) - Data Entry page only
				if (page == 'DataEntry/index.php') {
					setTimeout(function(){
						highlightTableRow(field+'-tr',3000);
					},200);
				}
				// Destroy the dialog so that fade effect doesn't persist if reopened
				setTimeout(function(){
					if ($('#data_resolution').hasClass('ui-dialog-content')) $('#data_resolution').dialog('destroy');
				},500);
			}, timeouttime);
		}
	});
}

// Data Resolution Workflow: Open dialog for uploading files (for query response)
function openDataResolutionFileUpload(record, event_id, field, rule_id) {
	// Reset all hidden/non-hidden divs
	$('#drw_upload_success').hide();
	$('#drw_upload_failed').hide();
	$('#drw_upload_progress').hide();
	$('#drw_upload_form').show();
	// Reset file input field (must replace it because val='' won't work)
	var fileInput = $('#dc-upload_doc_id-container').html();
	$('#dc-upload_doc_id-container').html('').html(fileInput);
	// Add values to the hidden inputs inside the dialog
	$("#drw_file_upload_popup input[name='record']").val(record);
	$("#drw_file_upload_popup input[name='event_id']").val(event_id);
	$("#drw_file_upload_popup input[name='field']").val(field);
	$("#drw_file_upload_popup input[name='rule_id']").val(rule_id);
	// Open dialog
	$("#drw_file_upload_popup").dialog({ bgiframe: true, modal: true, width: 450, buttons: {
		"Cancel": function() { $(this).dialog("close"); },
		"Upload document": function() { $('form#drw_upload_form').submit(); }
	}});
}
// Data Resolution Workflow: Delete uploaded file (for query response)
function dataResolutionDeleteUpload() {
	// If any hidden input doc_id's already exist, they must be deleted, so keep them but mark them for deletion
	$('#drw_upload_file_container input.drw_upload_doc_id').attr('delete','yes');
	// Show "add new document" link
	$('#drw_upload_new_container').show();
	// Hide "remove document" link
	$('#drw_upload_remove_doc').hide();
	// Hide doc_name link
	$('#dc-upload_doc_id-label').html('').hide();
}
// Data Resolution Workflow: Start uploading file (for query response)
function dataResolutionStartUpload() {
	$('#drw_upload_form').hide();
	$('#drw_upload_progress').show();
}
// Data Resolution Workflow: Stop uploading file (for query response)
function dataResolutionStopUpload(doc_id,doc_name) {
	$('#drw_file_upload_popup #drw_upload_form').hide();
	$('#drw_file_upload_popup #drw_upload_progress').hide();
	if (doc_id > 0) {
		// Success
		$('#drw_file_upload_popup #drw_upload_success').show();
		// Add doc_id as hidden input in hidden div container inside dialog
		$('#drw_upload_file_container').append('<input type="hidden" class="drw_upload_doc_id" value="'+doc_id+'">');
		// Hide "add new document" link
		$('#drw_upload_new_container').hide();
		// Show "remove document" link
		$('#drw_upload_remove_doc').show();
		// Add doc_name to hidden link
		$('#dc-upload_doc_id-label').html(doc_name).show();
	} else {
		// Failed
		$('#drw_file_upload_popup #drw_upload_failed').show();
	}
	// Add close button
	$('#drw_file_upload_popup').dialog('option', 'buttons', { "Close": function() { $(this).dialog("close"); } });
}


// Data Quality: Display the explainExclude dialog
function explainDQExclude() {
	$('#explain_exclude').dialog({ bgiframe: true, modal: true, width: 500,
		buttons: {'Close':function(){$(this).dialog("close");}}
	});
}

// Data Quality: Display the explainResolve dialog
function explainDQResolve() {
	$('#explain_resolve').dialog({ bgiframe: true, modal: true, width: 500,
		buttons: {'Close':function(){$(this).dialog("close");}}
	});
}

// Data Quality: Exclude an individual record-event[-field] from displaying in the results table
function excludeDQResult(ob,rule_id,exclude,record,event_id,field_name,instance,repeat_instrument) {
	if (typeof instance == "undefined") instance = 1;
	if (typeof repeat_instrument == "undefined") repeat_instrument = '';
	// Do ajax call to set exclude value
	$.post(app_path_webroot+'DataQuality/exclude_result_ajax.php?pid='+pid+'&instance='+instance+'&repeat_instrument='+repeat_instrument, { exclude: exclude, field_name: field_name, rule_id: rule_id, record: record, event_id: event_id }, function(data){
		if (data == '1') {
			// Change style of row to show exclusion value change
			var this_row = $(ob).parent().parent().parent();
			this_row.removeClass('erow');
			if (exclude) {
				this_row.css({'background-color':'#FFE1E1','color':'red'});
				$(ob).parent().html("<a href='javascript:;' style='font-size:10px;text-decoration:underline;color:#800000;' onclick=\"excludeDQResult(this,'"+rule_id+"',0,'"+record+"',"+event_id+",'"+field_name+"','"+instance+"','"+repeat_instrument+"');\">remove exclusion</a>");
			} else {
				this_row.css({'background-color':'#EFF6E8','color':'green'});
				$(ob).parent().html("<a href='javascript:;' style='font-size:10px;text-decoration:underline;' onclick=\"excludeDQResult(this,'"+rule_id+"',1,'"+record+"',"+event_id+",'"+field_name+"','"+instance+"','"+repeat_instrument+"');\">exclude</a>");
				// Remove the "(excluded)" label under record name
				this_row.children('td:first').find('.dq_excludelabel').html('')
			}
		} else {
			alert(woops);
		}
	});
}

// Data Quality: When user clicks data value on form for real-time execution, close dialog and highlight field with pop-up to save
function dqRteGoToField(field) {
	// Close dialog
	$('#dq_rules_violated').dialog('close');
	// Go to the field
	$('html, body').animate({
        scrollTop: $('tr#'+field+'-tr').offset().top - 150
     }, 700);
	// Put focus on field
	$('form#form :input[name="'+field+'"]').focus();
	// Open tooltip right above field
	$('tr#'+field+'-tr')
		.tooltip2({ tip: '#dqRteFieldFocusTip', relative: true, effect: 'fade', offset: [10,0], position: 'top center', events: { tooltip: "mouseenter" } })
		.trigger('mouseenter')
		.unbind();
}

// Data Quality: Reload an individual record-event[-field] table of rules violated on data entry page
function reloadDQResultSingleRecord(show_excluded) {
	// Do ajax call to set exclude value
	$.post(app_path_webroot+'DataQuality/data_entry_single_record_ajax.php?pid='+pid+'&instance='+getParameterByName('instance'), { dq_error_ruleids: getParameterByName('dq_error_ruleids'),
		show_excluded: show_excluded, record: getParameterByName('id'), event_id: getParameterByName('event_id'),
		page: getParameterByName('page')}, function(data){
		$('#dq_rules_violated').html(data);
		initWidgets();
	});
}

// Run processes when submitting form on data entry page
function formSubmitDataEntry() {
	// Is survey page?
	var isSurveyPage = (page == 'surveys/index.php');
	// Disable the onbeforeunload so that we don't get an alert before we leave
	window.onbeforeunload = function() { }
	// Before finally submitting the form, execute all calculated fields again just in case someone clicked Enter in a text field
	calculate();
	// REQUIRED FIELDS: Loop through table and remove form elements from html that are hidden due to branching logic
	// (so user is not prompted to enter values for invisible fields).
	$("#questiontable tr").each(function() {
		// Is it a required field?
		if ($(this).attr("req") != null) {
			// Is the req field hidden (i.e. on another survey page)?
			if ($(this).css("display") == "none") {
				// Only remove field from form if does not already have a saved value (i.e. has 'hasval=1' as row attribute)
				if ($(this).attr("hasval") != "1" && !($(this).hasClass("\@HIDDEN")
					|| ($(this).hasClass("\@HIDDEN-SURVEY") && isSurveyPage) || ($(this).hasClass("\@HIDDEN-FORM") && !isSurveyPage)))
				{
					$(this).html('');
				}
			}
		}
	});
	// For surveys only
	if (isSurveyPage) {
		// If using "save and return later", append to form action to point to new place
		if ($('#submit-action').val() == "submit-btn-savereturnlater") {
			$('#form').attr('action', $('#form').attr('action')+'&__return=1' );
		}
		// If using "previous page" button, append to form action to point to new place
		if ($('#submit-action').val() == "submit-btn-saveprevpage") {
			$('#form').attr('action', $('#form').attr('action')+'&__prevpage=1' );
		}
	}
	// Disable all buttons on page when submitting to prevent double submission
	setTimeout(function(){ $('#form :button').prop('disabled',true); },10);
	// Re-enable any disabled fields (due to field action tags and such) - make sure we leave any randomization fields disabled though
	$('#questiontable input:disabled, #questiontable select:disabled, #questiontable textarea:disabled').each(function(){
		var fld = $(this);
		if (randomizationCriteriaFieldList == null || !in_array(fld.parents('tr:first').attr('id').slice(0,-3), randomizationCriteriaFieldList)) {
			fld.prop('disabled', false);
		}
	});
	// If Secondary Unique Field is disabled (because it's currently being checked for uniqueness via AJAX), then don't submit form
	if (secondary_pk != '' && $('#form :input[name="'+secondary_pk+'"]').length && $('#form :input[name="'+secondary_pk+'"]').prop('disabled')) {
		return;
	}
	// Submit form (finally!)
	document.form.submit();
}

// Execute when buttons are clicked on data entry forms
function dataEntrySubmit(ob)
{
	// Set value of hidden field used in post-processing after form is submitted
	if (typeof ob === 'string' || ob instanceof String) {
		$('#submit-action').val( ob );
	} else {
		$('#submit-action').val( $(ob).attr('name') );
	}
	if ($('#submit-action').val() == '' || $('#submit-action').val() == null) {
		$('#submit-action').val('submit-btn-saverecord');
	}

	// Clicked Save or Delete
	if ($('#submit-action').val() != "submit-btn-cancel")
	{
		// Determine esign_action
		var esign_action = "";
		if ($('#__ESIGNATURE__').length && $('#__ESIGNATURE__').prop('checked') && $('#__ESIGNATURE__').prop('disabled') == false) {
			esign_action = "save";
			// If form is not locked already or checked to be locked, then stop (because is necessary)
			if ($('#__LOCKRECORD__').prop('checked') == false) {
				simpleDialog('WARNING:\n\nThe "Lock Record" option must be checked before the e-signature can be saved. Please check the "Lock Record" check box and try again.');
				return false;
			}
		}

		// Set the lock action
		var lock_action = ($('#__LOCKRECORD__').prop("disabled") && (esign_action == "save" || esign_action == "")) ? 2 : 1;

		// "change reason" popup for existing records (and lock record, if user has rights)
		if (require_change_reason && record_exists && (dataEntryFormValuesChanged || $('#submit-action').val() == 'submit-btn-delete'))
		{
			$('#change_reason_popup').dialog({ bgiframe: true, modal: true, width: 500, zIndex: 4999, buttons: {
				'Save': function() {
					$('#change_reason_popup_error').css('display','none'); //Default state
					if ($("#change_reason").val().length < 1) {
						$('#change_reason_popup_error').toggle('blind',{},'normal');
						return false;
					}
					// Before submitting the form, add change reason values from dialog as form elements for submission
					$('#form').append('<input type="hidden" name="change-reason" value="'+$("#change_reason").val().replace(/"/gi, '&quot;')+'">');
					// Save locked value
					if ($('#__LOCKRECORD__').prop('checked')) {
						$('#change_reason_popup').dialog('destroy');
						saveLocking(lock_action,esign_action);
					// Not locked, so just submit form
					} else {
						formSubmitDataEntry();
					}
				}
			} });
		}
		// Do locking and/or save e-signature, then submit form
		else if ($('#__LOCKRECORD__').prop('checked') && (!$('#__LOCKRECORD__').prop("disabled") || esign_action == "save"))
		{
			saveLocking(lock_action,esign_action);
		}
		// Just submit form if neither using change_reason nor locking
		else
		{
			formSubmitDataEntry();
		}
	}
	// Clicked Cancel (requires form submission)
	else {
		formSubmitDataEntry();
	}
}

// Set form as unlocked (enabled fields, etc.)
function setUnlocked(esign_action) {
	var form_name = getParameterByName('page');
	// Bring back Save buttons
	$('#__SUBMITBUTTONS__-div').css('display','block');
	$('#__DELETEBUTTONS__-div').css('display','block');
	// Remove locking informational text
	$('#__LOCKRECORD__').prop('checked', false);
	$('#__ESIGNATURE__').prop('checked', false);
	$('#lockingts').html('').css('display','none');
	$('#unlockbtn').css('display','none');
	$('#lock_record_msg').css('display','none');
	// Remove lock icon from menu (if visible)
	$('img#formlock-'+form_name).hide();
	$('img#formesign-'+form_name).hide();
	// Hide e-signature checkbox if e-signed but user does not have e-sign rights
	if (lock_record < 2 && $('#esignchk').length) {
		$('#esignchk').hide().html('');
	}
	// Determine if user has read-only rights for this form
	var readonly_form_rights = !($('#__SUBMITBUTTONS__-div').length && $('#__SUBMITBUTTONS__-div').css('display') != 'none');
	if (readonly_form_rights) {
		$('#__LOCKRECORD__').prop('disabled', false);
		$('#__ESIGNATURE__').prop('disabled', false);
	} else {
		// Remove the onclick attribute from the lock record checkbox so that the next locking is done via form post
		$('#__LOCKRECORD__').removeAttr('onclick');
		$('#__ESIGNATURE__').removeAttr('onclick');
		// Unlock and reset all fields on form
		$(':input').each(function() {
			// Re-enable field UNLESS field is involved in randomization (i.e. has randomizationField class)
			if (!$(this).hasClass('randomizationField')) {
				// Enable field
				$(this).prop('disabled', false);
			}
		});
		// Make radio "reset" link visible again
		$('.cclink').each(function() {
			// Re-enable link UNLESS field is involved in randomization (i.e. has randomizationField class)
			if (!$(this).hasClass('randomizationField')) {
				// Enable field
				$(this).css('display','block');
			}
		});
		// Enable "Randomize" button, if using randomization
		$('#redcapRandomizeBtn').removeAttr('aria-disabled').removeClass('ui-state-disabled').prop('disabled', false);
		// Add all options back to Form Status drop-down, and set value back afterward
		var form_status_field = $(':input[name='+form_name+'_complete]');
		var form_val = form_status_field.val();
		var sel = ' selected ';
		form_status_field
			.find('option')
			.remove()
			.end()
			.append('<option value="0"'+(form_val==0?sel:'')+'>Incomplete</option><option value="1"'+(form_val==1?sel:'')+'>Unverified</option><option value="2"'+(form_val==2?sel:'')+'>Complete</option>');
		// If editing a survey response, do NOT re-enable the Form Status field
		if (getParameterByName('editresp') == "1") form_status_field.prop("disabled",true);
		// Enable green row highlight for data entry form table
		enableDataEntryRowHighlight();
		// Re-display the save form buttons tooltip
		displayFormSaveBtnTooltip();
	}
	// Check for e-sign negation
	var esign_msg = "";
	if (esign_action == "negate") {
		$('#esignts').hide();
		$('#esign_msg').hide();
		$('#__ESIGNATURE__').prop('checked', false);
		esign_msg = ", and the existing e-signature has been negated";
	}
	// Give confirmation
	simpleDialog("This form has now been unlocked"+esign_msg+". Users can now modify the data again on this form.","UNLOCK SUCCESSFUL!");
}

// Lock/Unlock records for multiple forms
function lockUnlockForms(fetched, fetched2, event_id, arm, grid, lock) {
	if (lock == 'lock') {
		var prompt = 'LOCK ALL FORMS?\n\nDo you wish to lock all data entry forms for record "'+fetched2+'"? '
				   + 'After doing this, no one will be able to edit this record until it is unlocked by someone with Lock/Unlock privileges.';
		var alertmsg = 'All data entry forms have now been LOCKED for record "'+fetched2+'".';
	} else if (lock == 'unlock') {
		var prompt = 'UNLOCK ALL FORMS?\n\nDo you wish to unlock all data entry forms for record "'+fetched2+'"? '
				   + 'NOTE: Any e-signatures that have been saved for any forms will be negated in this process.';
		var alertmsg = 'All data entry forms have now been UNLOCKED for record "'+fetched2+'".';
	} else {
		return;
	}
	alertmsg += ' The page will now reload to reflect the changes.';
	if (confirm(prompt)) {
		$.get(app_path_webroot+'Locking/all_forms_action.php', { pid: pid, id: fetched, action: lock, grid: grid, event_id: event_id, arm: arm },
			function(data) {
				if (data == "1") {
					alert(alertmsg);
					window.location.reload();
				} else {
					alert("Woops! An error occurred. Please try again.");
				}
			}
		);
	}
}

// Run any time an esign fails to verify username/password
function esignFail(numLogins) {
	if (numLogins == 3) {
		alert("SYSTEM LOGOUT:\n\nYou have failed to enter a valid username/password three (3) times. "
			+ "You will now be automatically logged out of REDCap.");
		window.location.href += "&logout=1";
	} else {
		$('#esign_popup_error').toggle('blind',{},'normal');
	}
}

// Save the locking value from the form, then submit form
function saveLocking(lock_action,esign_action)
{
	// Determine action
	if (lock_action == 2) 		var action = "";
	else if (lock_action == 1)  var action = "lock";
	else if (lock_action == 0)  var action = "unlock";
	// Error msg
	var error_msg = "Woops! An error occurred, and the changes could not be made. Please try again.";
	// E-signature required (i.e. lock_record==2), but not if simply unlocking/negating esign
	if (lock_record == 2 && $('#__ESIGNATURE__').prop('checked') && esign_action == "save")
	{
		// Count login attempts
		var numLogins = 0;
		// Username/password popup
		$('#esign_popup').dialog({ bgiframe: true, modal: true, width: 530, zIndex: 3999, buttons: {
			'Save': function() {
				// Check username/password entered is correct
				$('#esign_popup_error').css('display','none'); //Default state
				$.post(app_path_webroot+"Locking/single_form_action.php?pid="+pid, {instance: getParameterByName('instance'), esign_action: esign_action, event_id: event_id, action: action, username: $('#esign_username').val(), password: $('#esign_password').val(), record: getParameterByName('id'), form_name: getParameterByName('page')}, function(data){
					$('#esign_password').val('');
					if (data == "1") {
						// If response=1, then correct username/password was entered and e-signature was saved
						$('#esign_popup').dialog('close');
						numLogins = 0;
						// Submit the form if saving e-signature
						if (action == 'lock' || action == '') {
							formSubmitDataEntry();
						} else {
							setUnlocked(esign_action);
						}
					} else if (data == "2") {
						// If response=2, then a php/sql error occurred
						$('#esign_popup').dialog('close');
						alert(error_msg);
					} else {
						// Login failed
						numLogins++;
						esignFail(numLogins);
					}
				});
			}
		} });
	}
	// No e-signature, so just save locking value
	else
	{
		$.post(app_path_webroot+"Locking/single_form_action.php?pid="+pid, {instance: getParameterByName('instance'), esign_action: esign_action, no_auth_key: 'q4deAr8s', event_id: event_id, action: action, record: getParameterByName('id'), form_name: getParameterByName('page')}, function(data){
			if (data == "1") {
				// Submit the form if saving e-signature
				if (action == 'lock' || action == '') {
					formSubmitDataEntry();
				} else {
					setUnlocked(esign_action);
				}
			} else {
				// error occurred
				alert(error_msg);
			}
		});
	}
}

// Function used when whole form is disabled *except* the lock record checkbox (this avoids a form post to prevent issues of saving for disabled fields)
function lockDisabledForm(ob) {
	// Dialog for confirmation
	if (confirm("LOCK FORM?\n\nAre you sure you wish to lock this form for record \""+getParameterByName('id')+"\"?")) {
		$.post(app_path_webroot+"Locking/single_form_action.php?pid="+pid, {instance: getParameterByName('instance'), esign_action: '', no_auth_key: 'q4deAr8s', event_id: event_id, action: "lock", record: getParameterByName('id'), form_name: getParameterByName('page')}, function(data){
			if (data == "1") {
				$(ob).prop('disabled',true);
				simpleDialog("The form has now been locked. The page will now reload to reflect this change.","LOCK SUCCESSFUL!",null,null,"window.location.reload();");
			} else {
				alert(woops);
			}
		});
	} else {
		// Make sure we uncheck the checkbox if they decline after checking it.
		$(ob).prop('checked',false);
	}
}

// Unlock a record on a form
function unlockForm(unlockBtnJs) {
	var esign_notice = "";
	var esign_action = "";
	if (unlockBtnJs == null) unlockBtnJs = '';
	// Show extra notice if record has been e-signed (because unlocking will negate it)
	if ($('#__ESIGNATURE__').length && $('#__ESIGNATURE__').prop('checked') && $('#__ESIGNATURE__').prop('disabled')) {
		esign_notice = " NOTICE: Unlocking this form will also negate the current e-signature.";
		esign_action = "negate";
	}
	simpleDialog("Are you sure you wish to unlock this form for record \"<b>"+getParameterByName('id')+"</b>\"?"+esign_notice,"UNLOCK FORM?",null,null,
		null,"Cancel","saveLocking(0,'"+esign_action+"');"+unlockBtnJs,"Unlock");
}

// Get file extension from filename string
function getfileextension(filename) {
	if (!filename || filename == null || filename.length == 0) return "";
	var dot = filename.lastIndexOf(".");
	if (dot == -1) return "";
	var extension = filename.substr(dot+1,filename.length);
	return extension;
}

// For IE8 and below, deal with page width issues
function fixProjectPageWidthIE() {
	if (isIE && IEv < 9) {
		// Set project main window and left-hand menu
		if ($('#west').length) {
			$('#west').css('float','left');
			$('#center').width( $(window).width()-$('#west').width()-50 );
		}
		// Set Control Center main window and left-hand menu
		if ($('#control_center_menu').length) {
			$('#control_center_menu').css('float','left');
			$('#control_center_window').width( $(window).width()-$('#control_center_menu').width()-400 );
		}
		// Set other things
		$('.hideIE8, .btn-group').hide();
		$('.jqbuttonmed span').css('padding','1px');
		$('.jqbuttonsm span').css('padding','0px');
	}
}

// Set project footer position
function setProjectFooterPosition() {
	var centerHeight = $('#center').height();
	var westHeight = $('#west').height();
	var winHeight = $(window).height();
	var hasScrollBar = ($(document).height() > winHeight);
	if ((hasScrollBar && (centerHeight > winHeight || westHeight > centerHeight))
		|| (!hasScrollBar && centerHeight+$('#south').height() > winHeight))
	{
		if (westHeight > centerHeight) {
			$('#south').css({'position':'absolute','margin':'50px 0px 0px -1px','bottom':'-'+(westHeight - centerHeight)+'px'});
			$('#center').css('padding-bottom','60px');
		} else {
			$('#south').css({'position':'relative','margin':'50px 0px 0px -1px','bottom':'0px'});
			$('#center').css('padding-bottom','0px');
		}
	} else {
		$('#south').css({'position':'fixed','margin':'0 0 0 269px','bottom':'0px'});
		$('#south').width( $(window).width()-280 );
		$('#center').css('padding-bottom','60px');
	}
	$('#south').css('visibility','visible');
}

// Initialization functions for normal project-level pages
function initPage() {
	// Exclude survey theme view page
	if (page == 'Surveys/theme_view.php') return;
	// Get window height
	var winHeight = $(window).height();
	if (isMobileDevice) {
		// Make sure the bootstrap navbar stays at top-right (wide pages can push it to the right)
		var winWidth = $(window).width();
		try {
			$('button.navbar-toggle:visible').each(function(){
				var btnRight = $(this).offset().left+80;
				if (btnRight > winWidth) {
					$(this).css({'margin-right':(btnRight-winWidth)+'px'});
				}
			});
		} catch(err) {}
	} else if ($('#center').length) {
		// Set project footer position
		setProjectFooterPosition();
	}
	// Perform actions upon page resize
	window.onresize = function() {
		fixProjectPageWidthIE();
		if (isMobileDevice) $('#south').hide();
		try{ displayFormSaveBtnTooltip(); }catch(e){}
		if (!$('#west').hasClass('hidden-xs') && !isMobileDeviceFunc()) {
			toggleProjectMenuMobile($('#west'));
		}
		// Reset project footer position
		setProjectFooterPosition();
	}
	// For IE8 and below, deal with page width issues
	fixProjectPageWidthIE();
	// Add fade mouseover for "Edit instruments" and "Edit reports" links on project menu
	$("#menuLnkEditInstr, #menuLnkEditBkmrk, #menuLnkEditReports, .projMenuToggle").mouseenter(function() {
		$(this).removeClass('opacity65');
		if (isIE) $(this).find("img").removeClass('opacity65');
	}).mouseleave(function() {
		$(this).addClass('opacity65');
		if (isIE) $(this).find("img").addClass('opacity65');
	});
	// Toggle project left-hand menu sections
	$('.projMenuToggle').click(function(){
		var divBox = $(this).parent().parent().find('.x-panel-bwrap:first');
		// Toggle the box
		divBox.toggle('blind','fast');
		// Toggle the image
		var toggleImg = $(this).find('img:first');
		if (toggleImg.prop('src').indexOf('toggle-collapse.png') > 0) {
			toggleImg.prop('src', app_path_images+'toggle-expand.png');
			var collapse = 1;
		} else {
			toggleImg.prop('src', app_path_images+'toggle-collapse.png');
			var collapse = 0;
		}
		// Send ajax request to save cookie
		$.post(app_path_webroot+'ProjectGeneral/project_menu_collapse.php?pid='+pid, { menu_id: $(this).prop('id'), collapse: collapse });
	});
	// Add fade mouseover for "Choose other record" link on project menu
	$("#menuLnkChooseOtherRec").mouseenter(function() {
		$(this).removeClass('opacity65');
	}).mouseleave(function() {
		$(this).addClass('opacity65');
	});
	// Reset project footer position when the page's height changes
	onElementHeightChange(document.body, function(){
		setProjectFooterPosition();
	});
	// Put focus on main window for initial scrolling (only works in IE)
	if ($('#center').length) document.getElementById('center').focus();
}

// Call login reset page via AJAX
function callLoginResetAjax(resettime,logouttime) {
	var params = '';
	// Detect if we're on data entry page or  not
	try {
		var form = getParameterByName('page');
		var rec  = getParameterByName('id');
		if (page == 'DataEntry/index.php' && form != '' && rec != '') {
			params = '?pid='+pid+'&page='+form+'&id='+rec;
			var event_id = getParameterByName('event_id');
			if (event_id != '') params += '&event_id='+event_id;
			var auto_param = getParameterByName('auto');
			if (auto_param != '') params += '&auto='+auto_param;
		}
	} catch(err) {}
	$.get(app_path_webroot+'ProjectGeneral/keep_alive.php'+params, {}, function(data){
		if (data == "1") {
			initAutoLogout(resettime,logouttime);
		} else {
			var showFailureNotice = true;
			try {
				if (page == 'DataEntry/index.php' && getParameterByName('id') != '') {
					showFailureNotice = false;
				}
			} catch(err) {}
			if (showFailureNotice) {
				var lostSessionMsg = "<b>Your REDCap session has expired.</b><br>Click the button below to log in again.";
				$.doTimeout('autoLogoutId4', 1, function(){ $('body').html(''); autoLogoutDialog(lostSessionMsg,true,resettime,logouttime); $('.ui-widget-overlay').css({'opacity': '1', 'background-color':'#AAAAAA'}); }, true);
			}
		}
	});
}

// Initialize auto-logout popup timer and logout reset timer listener
function initAutoLogout(resettime,logouttime) {
	// Do not run pop-up alert if on the login page and not logged in
	if ($('#redcap_login_a38us_09i85').length || $('#redcap_login_openid_Re8D2_8uiMn').length) return false;
	// Set ajax call at timed interval that is triggered by typing, clicking, or mouse movement (to prevent auto-logout)
	$.doTimeout('autoLogoutResetId', (resettime*60000), function(){
		$(document).bind('keyup mousemove click', function(){
			$(this).unbind('keyup mousemove click');
			// Call login reset page via AJAX
			callLoginResetAjax(resettime,logouttime);
		});
	});
	// Set auto-logout popups to occur at set intervals
	var warn_timeout1 = "You will be automatically logged out of REDCap in <b>2 MINUTES</b> due to inactivity. Click the button below to prevent auto logout.";
	var warn_timeout2 = "You will be automatically logged out of REDCap in <b>30 SECONDS</b> due to inactivity. Click the button below to prevent auto logout.";
	var warn_timeout3 = "<b>Due to inactivity, your REDCap session has expired.</b> Click the button below to log in again.";
	$.doTimeout('autoLogoutId1', ((logouttime-2)*60000), function(){ autoLogoutDialog(warn_timeout1,false,resettime,logouttime); }, true);
	$.doTimeout('autoLogoutId2', ((logouttime-0.5)*60000), function(){ autoLogoutDialog(warn_timeout2,false,resettime,logouttime); }, true);
	$.doTimeout('autoLogoutId3', (logouttime*60000), function(){ $('body').html(''); autoLogoutDialog(warn_timeout3,true,resettime,logouttime); $('.ui-widget-overlay').css({'opacity': '1', 'background-color':'#AAAAAA'}); }, true);
}

// Display dialog pop-up with auto-logout warning text
function autoLogoutDialog(msg,doLogout,resettime,logouttime) {
	// Set dialog content and button text
	var image = (doLogout ? 'cross_big.png' : 'warning.png');
	var classname = (doLogout ? 'red' : 'yellow');
	var content = '<div class="'+classname+'" style="margin:20px 0;"><table cellspacing=10 width=100%><tr>'
				+ '<td><img src="'+app_path_images+image+'"></td>'
				+ '<td style="font-family:verdana;padding-left:10px;">'+msg+'</td></tr></table></div>';
	var btnText = (doLogout ? 'Log In' : 'Continue on this page');
	// Setup up dialog
	var div_id = 'redcapAutoLogoutDialog';
	if ($('#'+div_id).hasClass('ui-dialog-content')) $('#'+div_id).dialog('destroy');
	$('#'+div_id).remove();
	$('body').append('<div id="'+div_id+'" style="display:none;"></div>');
	// Display dialog
	$('#'+div_id).dialog({ bgiframe: true, modal: true, width: 450, title: 'REDCap Auto Logout Warning',
		open: function(){ fitDialog(this); $(this).html(content); },
		close: function(){
			if (doLogout){
				// Disable the onbeforeunload so that we don't get an alert before we leave
				window.onbeforeunload = function() { }
				// Reload page to force re-login (don't use window.location.reload() because it can cause a resubmit of Post in some browsers)
				var loc = window.location.href;
				window.location.href = loc;
			} else {
				// Contact the server via AJAX and reset the session
				callLoginResetAjax(resettime,logouttime);
			}
		},
		buttons: [{
			text: btnText,
			click: function() { $(this).dialog("close"); }
		}]
	});
}

// Return hash string from URL
function addGoogTrans() {
	return ''; // NOT USING YET
}

// JavaScript equivalent of PHP's strip_tags() function
function strip_tags(input, allowed) {
  //  discuss at: http://phpjs.org/functions/strip_tags/
  // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: Luke Godfrey
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Pul
  //    input by: Alex
  //    input by: Marc Palau
  //    input by: Brett Zamir (http://brett-zamir.me)
  //    input by: Bobby Drake
  //    input by: Evertjan Garretsen
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Onno Marsman
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Eric Nagel
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // bugfixed by: Tomasz Wesolowski
  //  revised by: Rafal Kukawski (http://blog.kukawski.pl/)
  //   example 1: strip_tags('<p>Kevin</p> <br /><b>van</b> <i>Zonneveld</i>', '<i><b>');
  //   returns 1: 'Kevin <b>van</b> <i>Zonneveld</i>'
  //   example 2: strip_tags('<p>Kevin <img src="someimage.png" onmouseover="someFunction()">van <i>Zonneveld</i></p>', '<p>');
  //   returns 2: '<p>Kevin van Zonneveld</p>'
  //   example 3: strip_tags("<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>", "<a>");
  //   returns 3: "<a href='http://kevin.vanzonneveld.net'>Kevin van Zonneveld</a>"
  //   example 4: strip_tags('1 < 5 5 > 1');
  //   returns 4: '1 < 5 5 > 1'
  //   example 5: strip_tags('1 <br/> 1');
  //   returns 5: '1  1'
  //   example 6: strip_tags('1 <br/> 1', '<br>');
  //   returns 6: '1 <br/> 1'
  //   example 7: strip_tags('1 <br/> 1', '<br><br/>');
  //   returns 7: '1 <br/> 1'

  allowed = (((allowed || '') + '')
    .toLowerCase()
    .match(/<[a-z][a-z0-9]*>/g) || [])
    .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
  var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
    commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
  return input.replace(commentsAndPhpTags, '')
    .replace(tags, function ($0, $1) {
      return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
    });
}

// Filter potentially harmful html tags
function filter_tags(val) {
	// Remove all but the allowed tags
	val = strip_tags(val, ALLOWED_TAGS);
	// If any allowed tags contain javascript inside them, then remove javascript due to security issue.
	if (val.indexOf('<') > 0 && val.indexOf('>') > 0) {
		// Replace any uses of "javascript:" inside any HTML tag attributes
		var regex = "/(<)([^<]*)(javascript\s*:)([^<]*>)/gi";
		var regex_replace = "$1$2removed;$4";
		var _flag = regex.substr(regex.lastIndexOf(regex[0])+1),
			_pattern = regex.substr(1,regex.lastIndexOf(regex[0])-1),
			regex_raw = new RegExp(_pattern,_flag);
		do {
			val = preg_replace(regex, regex_replace, val);
		} while (regex_raw.test(val));
		// Replace any JavaScript events that are used as HTML tag attributes
		var regex = "/(<)([^<]*)(onload\s*=|onerror\s*=|onabort\s*=|onclick\s*=|ondblclick\s*=|onblur\s*=|onfocus\s*=|onreset\s*=|onselect\s*=|onsubmit\s*=|onmouseup\s*=|onmouseover\s*=|onmouseout\s*=|onmousemove\s*=|onmousedown\s*=)([^<]*>)/gi";
		var regex_replace = "$1$2removed=$4";
		var _flag = regex.substr(regex.lastIndexOf(regex[0])+1),
			_pattern = regex.substr(1,regex.lastIndexOf(regex[0])-1),
			regex_raw = new RegExp(_pattern,_flag);
		do {
			val = preg_replace(regex, regex_replace, val);
		} while (regex_raw.test(val));
	}
	// Return text
	return val;
}


// JavaScript equivalent of PHP's preg_replace() function
function preg_replace(pattern, pattern_replace, subject, limit){
	// Perform a regular expression search and replace
    //
    // discuss at: http://geekfg.net/
    // +   original by: Francois-Guillaume Ribreau (http://fgribreau)
    // *     example 1: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG',1);
    // *     returns 1: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
    // *     example 2: preg_replace("/(\\@([^\\s,\\.]*))/ig",'<a href="http://twitter.com/\\0">\\1</a>','#followfriday @FGRibreau @GeekFG');
    // *     returns 2: "#followfriday <a href="http://twitter.com/@FGRibreau">@FGRibreau</a> @GeekFG"
    // *     example 3: preg_replace("/(\\#[^\\s,\\.]*)/ig",'<strong>$0</strong>','#followfriday @FGRibreau @GeekFG');
    // *     returns 3: "<strong>#followfriday</strong> @FGRibreau @GeekFG"

	if(limit === undefined){
		limit = -1;
	}

	var _flag = pattern.substr(pattern.lastIndexOf(pattern[0])+1),
		_pattern = pattern.substr(1,pattern.lastIndexOf(pattern[0])-1),
		reg = new RegExp(_pattern,_flag),
		rs = null,
		res = [],
		x = 0,
		y = 0,
		ret = subject;

	if(limit === -1){
		var tmp = [];

		do{
			tmp = reg.exec(subject);
			if(tmp !== null){
				res.push(tmp);
			}
		}while(tmp !== null && _flag.indexOf('g') !== -1)
	}
	else{
		res.push(reg.exec(subject));
	}

	for(x = res.length-1; x > -1; x--){//explore match
		tmp = pattern_replace;

		for(y = res[x].length - 1; y > -1; y--){
			tmp = tmp.replace('${'+y+'}',res[x][y])
					.replace('$'+y,res[x][y])
					.replace('\\'+y,res[x][y]);
		}
		ret = ret.replace(res[x][0],tmp);
	}
	return ret;
}

// Enforce character limit on a text box
function charLimit(id,limit) {
	var str = $("#"+id).val();
	if (str.length > limit) {
		$("#"+id).val(str.substring(0,limit));
		alert("You have exceeded the character limit of "+limit+" for this text box. The text entered will now be truncated to "+limit+" characters.");
		setTimeout(function () { $("#"+id).focus() }, 1);
	}
}

// Submit form to import records
function importDataSubmit(require_change_reason) {

	// If data change reason is required for existing record, loop through each, check for text in each, and add to form for submission
	if (require_change_reason)
	{
		var count_empty = 0;
		$('.change_reason').each(function(){
			var row_num = $(this).prop('id').replace('reason-','');
			var this_reason = $('#reason-'+row_num).val();
			if (trim(this_reason) == "") {
				count_empty++;
			} else {
				$('#change-reasons-div').append("<input name='records[]' value='"+$('#record-'+row_num).html()+"'><input name='events[]' value='"+$('#event-'+row_num).html()+"'><textarea name='reasons[]'>"+this_reason+"</textarea>");
			}
		});
		if (count_empty > 0) {
			$('#change-reasons-div').html('');
			alert("You have not entered a 'reason for data changes' for "+count_empty+" records. Please supply a reason in the text box for each before you can continue.");
			return false;
		}
	}
	$('#uploadmain2').css('display','none');
	$('#progress2').css('display','block');
	return true;
}

// Remove all unselected options from Form Status drop-down (used when page is locked but not e-signed)
function removeUnselectedFormStatusOptions() {
	$(':input[name='+getParameterByName('page')+'_complete] option').each(function(){
		if ( $(this).prop('selected') == false ) {
			$(this).remove();
		} else {
			$(this).css('color','gray');
		}
	});
}

// Branching Logic & Calculated Fields
var isNumeric 	 = function(symbol){var objRegExp=/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/;return objRegExp.test(symbol);};
var chkNull   	 = function(val){return (val !== '0' && val !== 0 && (val == 'NaN' || val == '' || val==null || isNaN(val)) ? 'NaN' : (val*1) )}
var calcErrExist = true;
var brErrExist   = true;
function calcErr(fld) {
	alert('CALCULATION ERRORS EXIST!\n\nThere is a syntactical error in the calculation for the field "'+fld+'" on this page. '
		+ 'None of the calculations on this data entry form will function correctly until this error has been corrected.\n\n'
		+ 'If you are not sure what this means, please contact your project administrator.');
}
function calcErr2() {
	alert('CALCULATION ERRORS EXIST!\n\nThere is a syntactical error in one or more of the calculations on this page. '
		+ 'It cannot be determined which fields contain the error, so please check the equation for every calculated field on this page. '
		+ 'None of the calculations on this data entry form will function correctly until this error has been corrected.\n\n'
		+ 'If you are not sure what this means, please contact your project administrator.');
}
function brErr(fld) {
	if (page == 'surveys/index.php') {
		// Survey page
		alert('SURVEY ERRORS EXIST: CANNOT CONTINUE!\n\nPlease contact your survey administrator and let them know that Branching Logic errors exist on this survey for the field "'+fld+'". This survey will not function correctly until these errors have been fixed. Sorry for any inconvenience.');
	} else {
		// Data entry form
		alert('BRANCHING LOGIC ERRORS EXIST!\n\nThere is a syntactical error in the the Branching Logic for the field "'+fld+'" on this page. '
			+ 'None of the Branching Logic on this data entry form will function correctly until this error has been corrected.\n\n'
			+ 'If you are not sure what this means, please contact your project administrator.');
	}
}
function brErr2() {
	if (page == 'surveys/index.php') {
		// Survey page
		alert('SURVEY ERRORS EXIST: CANNOT CONTINUE!\n\nPlease contact your survey administrator and let them know that Branching Logic errors exist on this survey. This survey will not function correctly until these errors have been fixed. Sorry for any inconvenience.');
	} else {
		// Data entry form
		alert('BRANCHING LOGIC ERRORS EXIST!\n\nThere is a syntactical error in the Branching Logic of one or more fields on this page. '
			+ 'It cannot be determined which fields contain the error, so please check the Branching Logic for every field on this page. '
			+ 'None of the Branching Logic on this data entry form will function correctly until this error has been corrected.\n\n'
			+ 'If you are not sure what this means, please contact your project administrator.');
	}
}
function brErase(fld) {
	return 'ERASE CURRENT VALUE OF THE FIELD "'+fld+'" ?\n\n'
		 + 'The current field for which you just entered data requires that the field named "'+fld+'" be hidden from view. '
		 + 'However, that field already has a value, so its value might need to be reset back to a blank value.\n\n'
		 + 'Click OK to HIDE this field and ERASE its current value. Click CANCEL if you DO NOT wish to hide this field or erase its current value.';
}

// Display e-signature explanation dialog pop-up
function esignExplainLink() {
	$.get(app_path_webroot+'Locking/esignature_explanation_popup.php', { }, function(data) {
		if (!$('#esignExplain').length) $('body').append('<div id="esignExplain"></div>');
		$('#esignExplain').html(data);
		$('#esignExplain').dialog({ bgiframe: true, title: 'What is an E-signature?', modal: true, width: 650, buttons: { Close: function() { $(this).dialog('close'); } } });
	});
}

// Display explanation dialog pop-up to explain create/rename/delete record settings on User Rights
function userRightsRecordsExplain() {
	$.get(app_path_webroot+'UserRights/record_rights_popup.php', { pid: pid }, function(data) {
		if (!$('#recordsExplain').length) $('body').append('<div id="recordsExplain"></div>');
		$('#recordsExplain').html(data);
		$('#recordsExplain').dialog({ bgiframe: true, modal: true, title: 'User privileges pertaining to project records', width: 650, buttons: { Close: function() { $(this).dialog('close'); } } });
	});
}

// Open popup window for viewing a calc field's equation
function viewEq(field) {
	var metadata_table = (status > 0 && page == 'Design/online_designer.php') ? 'metadata_temp' : 'metadata';
	$.get(app_path_webroot+'DataEntry/view_equation_popup.php', { pid: pid, field: field, metadata_table: metadata_table }, function(data) {
		if (!$('#viewEq').length) $('body').append('<div id="viewEq"></div>');
		$('#viewEq').html(data);
		$('#viewEq').dialog({ bgiframe: true, modal: true, title: 'Calculation equation for variable "'+field+'"', width: 600,
			buttons: { Close: function() { $(this).dialog('close'); } }, open:function(){ fitDialog(this); } });
	});
}

// Selecting logo for survey and check if an image
function checkLogo(file) {
	extension = getfileextension(file);
	extension = extension.toLowerCase();
	if (extension != "jpeg" && extension != "jpg" && extension != "gif" && extension != "png" && extension != "bmp") {
		$("#old_logo").val("");
		alert("ERROR: The file you selected is not an image file (e.g., GIF, JPG, JPEG, BMP, PNG). Please try again.");
	}
}

// Send email to oneself with survey link
function sendSelfEmail(survey_id,url) {
	$.get(app_path_webroot+'Surveys/email_self.php', { pid: pid, survey_id: survey_id, url: url }, function(data) {
		if (data != '0') {
			simpleDialog('The survey link was successfully emailed to '+data,'Email sent!');
		} else {
			alert(woops);
		}
	});
}

// Check for onblur event on element and run, if exists (for Form Renderer only)
function chkBlur(ob) {
	if (ob.getAttribute('onblur') != null) {
		// Replace "this" with "ob" if needed and eval it
		eval(ob.getAttribute('onblur').replace('this','document.form.'+ob.getAttribute('name')));
	}
}

// Open window for viewing survey
function surveyOpen(path,preview) {
	// Determine if showing a survey preview rather than official survey (default preview=false or 0)
	if (preview == null) preview = 0;
	if (preview != 1 && preview != 0) preview = 0;
	// Open window
	window.open(path+(preview ? '&preview=1' : ''),'_blank');
}

function survPubLink(survey_id,shorturl) {
	$.get(app_path_webroot+'Surveys/public_survey_link.php', { pid: pid, survey_id: survey_id }, function(data) {
		if (!$('#survPubLink').length) $('body').append('<div id="survPubLink"></div>');
		$('#survPubLink').html(data);
		$('#survPubLink').dialog({ bgiframe: true, title: 'Public Survey Link for Email or Webpage', modal: true, width: 750, buttons: { Close: function() { $(this).dialog('close'); } } });
		/*
		// Display or retrieve the short URL for the survey
		var shorturl_addtext = 'Either survey link below may be used. The Short Survey Link merely utilizes a URL shortening service to redirect to the survey using a shorter URL.';
		if (!shorturl) {
			$.get(app_path_webroot+'Surveys/shorturl.php', { pid: pid, survey_id: survey_id }, function(data) {
				if (data != '0') {
					$('#shorturl').val(data);
					$('#shorturl_div').css('display','');
					$('#shorturl_addtext').html(shorturl_addtext);
				}
			});
		} else {
			$('#shorturl_div').css('display','');
			$('#shorturl_addtext').html(shorturl_addtext);
		}
		*/
	});
}

// Open dialog box for emailing survey invitation
function OpenDlgSendSurvPart(survey_id,event_id,record) {
	$('#emailPart').dialog({ bgiframe: true, title: 'Email a Survey Invitation', modal: true, width: 500, buttons: {
		Cancel: function() { $(this).dialog('close'); },
		'Send Email': function() {
			$(":button:contains('Send Email')").css("display","none");
			$(":button:contains('Cancel')").html("Close");
			var subject = $('#emailTitle').val();
			var message = $('#emailCont').val();
			var to_email = ($('#partEmailManualInput').val().length > 0) ? trim($('#partEmailManualInput').val()) : trim($('#partEmailValue').text());
			$('#emailPart').html("<p><img src='"+app_path_images+"progress_circle.gif'> Please wait...</p>");
			$.post(app_path_webroot+'Surveys/email_participants.php?pid='+pid, { survey_id: survey_id, event_id: event_id, record: record, to_email: to_email, message: message, subject: subject }, function(data) {
				if (data != '0') {
					$('#emailPart').html(data);
					setTimeout(function(){
						$('#emailPart').dialog('close');
					},2000);
				} else {
					alert("Woops! An error occurred. Please try again.");
					$('#emailPart').dialog('close');
				}
			});
		}
	} });
}

function animateConfirmationMsg(item){
  setTimeout(function(){
    item.velocity({height:'39px'},{duration: 700, complete: function(){
        item.velocity({height:0},{duration: 700, delay:2500});
    }
  });
  },500);
}
// Delete an entire project and its data
function delete_project(this_pid,ob,user,status,delete_now) {
  if(AUTOMATE_ALL == 0 && user === 0 && status !== 0){
	if (confirm("REQUEST PROJECT BE DELETED?\nAre you really sure that you want a REDCap administrator to delete this project for you?")) {
		showProgress(1);
		$.get(app_path_webroot+'ProjectGeneral/notifications.php', { pid: pid, type: 'delete_project' },
		  function(data) {
			showProgress(0);
			var $container = $('<div>',{
			  'class': 'del-req-msg-container',
			}),
			$msgWrapper = $('<div>',{
			  'class': 'del-req-msg',
			}),
			$img = $('<img>',{
			  'class': 'del-req-img',
			  src: app_path_images+'tick.png',
			}),
			$text = $('<p>',{
			  'class': 'del-req-text',
			  text: 'Success! A request to DELETE this project has been sent to a REDCap administrator'
			});
			$msgWrapper.append($img).append($text);
			$container.append($msgWrapper);
			$('.delete-target').append($container);
			animateConfirmationMsg($container);
			$('#row_delete_project button').button('disable');
		  }
		);
	}
  }else{
	delete_now = (delete_now == null || delete_now != 1) ? '0' : '1';
	$.post(app_path_webroot+'ProjectGeneral/delete_project.php?pid='+this_pid, { action: 'prompt', delete_now: delete_now }, function(data) {
		initDialog("del_db_dialog",data);
      $('#del_db_dialog').dialog({ bgiframe: true, title: 'Permanently delete this project?', modal: true, width: 550, buttons: {
        Cancel: function() { $(this).dialog('close'); } ,
			'Delete the project': function() {
				if (trim($('#delete_project_confirm').val().toLowerCase()) != "delete") {
					simpleDialog('You must type "DELETE" first.');
					return;
				}
				simpleDialog('<span style="font-size:14px;color:#800000;">Are you really sure you wish to delete this project?</span>','CONFIRM DELETION',null,null,"$('#del_db_dialog').dialog('close');",'Cancel','delete_project_do('+this_pid+','+delete_now+')','Yes, delete the project');
			}
		} });
	})
  }
}
function delete_project_do(this_pid,delete_now,super_user_request) {
    super_user_request = (super_user_request == null || super_user_request != 1) ? '0' : '1';
	$(':button:contains("Cancel")').html('Please wait...');
	$(':button:contains("Delete the project")').css('display','none');
	showProgress(1);
	$.post(app_path_webroot+'ProjectGeneral/delete_project.php?pid='+this_pid, { action: 'delete', delete_now: delete_now, super_user_request: super_user_request }, function(data) {
		showProgress(0);
		if (data == '1') {
			if (delete_now) {
				var msg = "The project was successfully deleted from REDCap <b>PERMANENTLY</b>. The project and all its data have been completely removed from REDCap.<br><br>";
			} else {
				var msg = "The project was successfully deleted from REDCap and can no longer be accessed. If this was done by mistake, please contact your REDCap administrator.<br><br>";
			}
      if(self!=top){//decect if in iframe
          simpleDialog(msg+"You can now close this window.","Project successfully deleted!","",500,"delete_iframe");
      }else {
			if (window.location.href.indexOf("/ControlCenter/") > -1) {
				simpleDialog(msg+"The page will now reload.","Project successfully deleted!","",500,"window.location.reload();");
			} else {
				simpleDialog(msg+"You will now be redirected back to the My Projects page.","Project successfully deleted!","",500,"window.location.href = '"+app_path_webroot_full+"index.php?action=myprojects';");
			}
      }
		} else {
			simpleDialog("Woops! An error occurred. Please try again.");
		}
		$('#del_db_dialog').dialog('close');
	});
}

// Undelete a project that was previously "deleted" by a user
function undelete_project(this_pid) {
	$.post(app_path_webroot+'ProjectGeneral/delete_project.php?pid='+this_pid, { action: 'prompt_undelete' }, function(data) {
		$('#undelete_project_dialog').html(data).dialog({ bgiframe: true, modal: true, width: 550, buttons: {
			Cancel: function() { $(this).dialog('close'); } ,
			'Undelete the project': function() {
				$.post(app_path_webroot+'ProjectGeneral/delete_project.php?pid='+this_pid, { action: 'undelete' }, function(data) {
					$('#undelete_project_dialog').dialog('close');
					if (data == '1') {
						simpleDialog('The project has now been restored. The page will now reload to reflect the changes.','PROJECT RESTORED!',null,null,"window.location.reload()");
					} else {
						alert(woops);
					}
				});
			}
		} });
	});
}

// Creates hidden div needed for jQuery UI dialog box. If div exists and is a dialog already, removes as existing dialog.
function initDialog(div_id,inner_html) {
	if ($('#'+div_id).length) {
		if ($('#'+div_id).hasClass('ui-dialog-content')) $('#'+div_id).dialog('destroy');
		$('#'+div_id).addClass('simpleDialog');
	} else {
		$('body').append('<div id="'+div_id+'" class="simpleDialog"></div>');
	}
	$('#'+div_id).html((inner_html == null ? '' : inner_html));
}

// For emailing survey link for participants that wish to return later
function emailReturning(survey_id,event_id,participant_id,hash,email,page) {
	$.get(page, { s: hash, survey_id: survey_id, event_id: event_id, participant_id: participant_id, email: email }, function(data) {
		if (data == '0') {
			alert(woops);
		} else if (data == '2') {
			$('#autoEmail').hide();
			$('#provideEmail').show();
		} else if (email != '') {
			simpleDialog('The email was successfully sent to '+data,'Email sent!');
		}
	});
}

// Get current time as hh:mm or just hh, mm, or ss
function currentTime(type,showSeconds) {
	var d = new Date();
	var curr_hour = d.getHours();
	if (curr_hour < 10) curr_hour = '0'+curr_hour;
	var curr_min = d.getMinutes();
	if (curr_min < 10) curr_min = '0'+curr_min;
	var curr_sec = d.getSeconds();
	if (curr_sec < 10) curr_sec = '0'+curr_sec;
	if (type=='m') return curr_min;
	else if (type=='h') return curr_hour;
	else if (type=='s') return curr_sec;
	else return curr_hour+':'+curr_min+(showSeconds ? ':'+curr_sec : '');
}

// Get today's date in various formats
function getCurrentDate(valType) {
	var currentTime = new Date();
	var month = currentTime.getMonth() + 1;
	if (month < 10) month = "0" + month;
	var day = currentTime.getDate();
	if (day < 10) day = "0" + day;
	var year = currentTime.getFullYear();
	if (/_mdy/.test(valType)) {
		return month+'-'+day+'-'+year;
	} else if (/_dmy/.test(valType)) {
		return day+'-'+month+'-'+year;
	} else {
		return year+'-'+month+'-'+day;
	}
}

// Button to set date field to today's date
function setToday(name,valType) {
	eval("document.form."+name+".value='"+getCurrentDate(valType)+"';");
	// If user modifies any values on the data entry form, set flag to TRUE
	dataEntryFormValuesChanged = true;
	// Trigger branching/calc fields, in case fields affected
	$('[name='+name+']').focus();
	setTimeout(function(){try{calculate();doBranching();}catch(e){}},50);
}

// Button to set time field to current time as hh:ss
function setNowTime(name) {
	eval("document.form."+name+".value='"+currentTime('both')+"';");
	// If user modifies any values on the data entry form, set flag to TRUE
	dataEntryFormValuesChanged = true;
	// Trigger branching/calc fields, in case fields affected
	$('[name='+name+']').focus();
	setTimeout(function(){try{calculate();doBranching();}catch(e){}},50);
}

// Button to set datetime field to current time as yyyy-mm-dd hh:ss
function setNowDateTime(name,showSeconds,valType) {
	eval("document.form."+name+".value='"+getCurrentDate(valType)+' '+currentTime('both',showSeconds)+"';");
	// If user modifies any values on the data entry form, set flag to TRUE
	dataEntryFormValuesChanged = true;
	// Trigger branching/calc fields, in case fields affected
	$('[name='+name+']').focus();
	setTimeout(function(){try{calculate();doBranching();}catch(e){}},50);
}

//Date field functions
function dateKeyDown(event2,fldname) {
	eval("var fld = document.form."+fldname+";");
	if (event2.keyCode==13) {
		$('document.form.'+fldname).blur();
		return true;
	}
}

// Show dialog of project revision history
function revHist(this_pid) {
	$.get(app_path_webroot+'ProjectSetup/project_revision_history.php?pid='+this_pid,{},function(data){
		initDialog('revHist','<div style="height:400px;">'+data+'</div>');
		var d = $('#revHist').dialog({ bgiframe: true, title: $('#revHist #revHistPrTitle').text(), modal: true, width: 800, buttons: {
			Close: function() { $(this).dialog('close'); }
		}});
		initButtonWidgets();
		fitDialog(d);
	});
}


// Initialize all jQuery date/time-picker widgets
function initDatePickers() {
	// Pop-up date-picker initialization
	if ($('.cal').length) $('.cal').datepicker({
		onSelect: function(){ $(this).focus(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', showOn: 'button', buttonImage: app_path_images+'date.png',
		buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd'
	});
	// Pop-up date-picker initialization
	if ($('.date_ymd').length) $('.date_ymd').datepicker({
		onSelect: function(){ $(this).focus(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', showOn: 'button', buttonImage: app_path_images+'date.png',
		buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd', constrainInput: false
	});
	if ($('.date_mdy').length) $('.date_mdy').datepicker({
		onSelect: function(){ $(this).focus(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', showOn: 'button', buttonImage: app_path_images+'date.png',
		buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy', constrainInput: false
	});
	if ($('.date_dmy').length) $('.date_dmy').datepicker({
		onSelect: function(){ $(this).focus(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', showOn: 'button', buttonImage: app_path_images+'date.png',
		buttonImageOnly: true, changeMonth: true, changeYear: true, dateFormat: 'dd-mm-yy', constrainInput: false
	});
	// Pop-up time-picker initialization
	$('.time2').timepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a time',
		showOn: 'button', buttonImage: app_path_images+'timer.png', buttonImageOnly: true, timeFormat: 'hh:mm'
	});
	// Pop-up datetime-picker initialization
	$('.datetime_ymd').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm', constrainInput: false
	});
	$('.datetime_mdy').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm', constrainInput: false
	});
	$('.datetime_dmy').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'dd-mm-yy',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm', constrainInput: false
	});
	// Pop-up datetime-picker initialization (w/ seconds)
	$('.datetime_seconds_ymd').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'yy-mm-dd',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm:ss', constrainInput: false
	});
	$('.datetime_seconds_mdy').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'mm-dd-yy',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm:ss', constrainInput: false
	});
	$('.datetime_seconds_dmy').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); dataEntryFormValuesChanged=true; try{ calculate();doBranching(); }catch(e){ } },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: 'dd-mm-yy',
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm:ss', constrainInput: false
	});
}

// Initialize all jQuery UI buttons
function initButtonWidgets() {
	if ($('.jqbutton').length) 	  $('.jqbutton'   ).button();
	if ($('.jqbuttonsm').length)  $('.jqbuttonsm' ).button();
	if ($('.jqbuttonmed').length) $('.jqbuttonmed').button();
}

// Initialize all jQuery widgets, buttons, and icons
function initWidgets() {
	// Enable any jQuery UI buttons
	initButtonWidgets();
	// Enable date/time pickers
	initDatePickers();
	// Enable sliders
	initSliders();
}

//Enable sliders when clicking on them
function enableSldr(fld) {
	$("#slider-"+fld).slider({
		disabled: false,
		change: function(event, ui) {
			// Set flag as true for data changes
			dataEntryFormValuesChanged = true;
			// Set input value
			$('form[name="form"] input[name="'+fld+'"]').val(ui.value);
			try {
				// Piping: Transmit slider value to all piping receiver spans
				$('.piping_receiver.piperec-'+event_id+'-'+fld).html(ui.value);
				// Branching logic and calculations
				calculate();
				doBranching();
			} catch(e){ }
		},
		slide: function(event, ui) {
			$('form[name="form"] input[name="'+fld+'"]').val(ui.value);
		},
		click: function(event, ui) {
			// Set input value
			$('form[name="form"] input[name="'+fld+'"]').val(ui.value);
			try {
				// Piping: Transmit slider value to all piping receiver spans
				$('.piping_receiver.piperec-'+event_id+'-'+fld).html(ui.value);
				// Branching logic and calculations
				calculate();
				doBranching();
			} catch(e){ }
		}
	});
	if ($('form[name="form"] input[name="'+fld+'"]').val() == '') {
		$('form[name="form"] input[name="'+fld+'"]').val(50); //Set value to 50 when click on it (prevents ambiguity of value after first click)
	}
	$("#sldrmsg-"+fld).css('visibility','hidden');
	try {
		calculate();
		doBranching();
	} catch(e){ }
}
//Initialize all sliders on page
function initSliders() {
	$('.slider').each(function(index,item){
		var alignment = $(item).attr('data-align');
		if (alignment == null) return;
		alignment = alignment.split('-');
		$(item).slider({ value: 50, orientation: alignment[1] });
		if (alignment[1] === 'vertical') $(item).height(200);
		$(item).slider('disable');
	});
}
//Set value and enable specific slider
function setSlider(fld,val,enable) {
	$("#slider-"+fld).slider("option", "value", val);
	$("#slider-"+fld).slider("enable");
	$("#sldrmsg-"+fld).css('visibility','hidden');
}
//Reset slider value
function resetSlider(fld) {
	$("#slider-"+fld).slider("option", "value", 50);
	$("#slider-"+fld).slider("disable");
	$("#sldrmsg-"+fld).css('visibility','visible');
	$('form[name="form"] input[name="'+fld+'"]').val('');
	dataEntryFormValuesChanged = true;
	calculate();
	doBranching();
}

// Give message if PK field was changed on Design page
function update_pk_msg(reload_page,moved_source) {
	$.get(app_path_webroot+'Design/update_pk_popup.php', { pid: pid, moved_source: moved_source }, function(data) {
		if (data != '') { // Don't show dialog if no callback html (i.e. no records exist)
			initDialog("update_pk_popup",data);
			$('#update_pk_popup').dialog({title: langRecIdFldChanged, bgiframe: true, modal: true, width: 600, buttons: [
				{ text: langOkay, click: function () {
					$(this).dialog('close');
					if (reload_page != null) {
						if (reload_page) window.location.reload();
					}
				}}
			]});
		} else if (moved_source == 'form') {
			simpleDialog(form_moved_msg,null,'','','window.location.reload();');
		}
	});
}

// Fit a jQuery UI dialog box on the page if too tall.
function fitDialog(ob) {
	var winh = $(window).height();
	var thisHeight = $(ob).height();
	var dialogCollapsedOnMobile = (isMobileDevice && thisHeight < 20);
	if ($(ob).hasClass('ui-dialog-content') && ((thisHeight+110) >= winh || dialogCollapsedOnMobile)) {
		// Set new height to be slightly smaller than window size
		$(ob).dialog('option', 'height', winh - (isMobileDevice ? 130 : 30));
		// If height somehow ends up as 0 (tends to happen on mobile devices)
		if (dialogCollapsedOnMobile) {
			$(ob).height(winh - 85);
		}
		// Center it
		$(ob).dialog('option', 'position', ["center",10]);
	}
}

// Checks if value is in array (similar to PHP version of it)
function in_array(needle, haystack, argStrict) {
    // *     example 1: in_array('van', ['Kevin', 'van', 'Zonneveld']);
    // *     returns 1: true
    // *     example 2: in_array('vlado', {0: 'Kevin', vlado: 'van', 1: 'Zonneveld'});
    // *     returns 2: false
    // *     example 3: in_array(1, ['1', '2', '3']);
    // *     returns 3: true
    // *     example 3: in_array(1, ['1', '2', '3'], false);
    // *     returns 3: true
    // *     example 4: in_array(1, ['1', '2', '3'], true);
    // *     returns 4: false
    var key = '', strict = !!argStrict;
    if (strict) {
        for (key in haystack) {
            if (haystack[key] === needle) {
                return true;
            }
        }
    } else {
        for (key in haystack) {
            if (haystack[key] == needle) {
                return true;
            }
        }
    }
    return false;
}

// Find index of a given array value (similar to PHP version of it)
function array_search(needle, haystack, argStrict) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +      input by: Brett Zamir (http://brett-zamir.me)
  // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // *     example 1: array_search('zonneveld', {firstname: 'kevin', middle: 'van', surname: 'zonneveld'});
  // *     returns 1: 'surname'
  // *     example 2: ini_set('phpjs.return_phpjs_arrays', 'on');
  // *     example 2: var ordered_arr = array({3:'value'}, {2:'value'}, {'a':'value'}, {'b':'value'});
  // *     example 2: var key = array_search(/val/g, ordered_arr); // or var key = ordered_arr.search(/val/g);
  // *     returns 2: '3'

  var strict = !!argStrict,
    key = '';

  if (haystack && typeof haystack === 'object' && haystack.change_key_case) { // Duck-type check for our own array()-created PHPJS_Array
    return haystack.search(needle, argStrict);
  }
  if (typeof needle === 'object' && needle.exec) { // Duck-type for RegExp
    if (!strict) { // Let's consider case sensitive searches as strict
      var flags = 'i' + (needle.global ? 'g' : '') +
            (needle.multiline ? 'm' : '') +
            (needle.sticky ? 'y' : ''); // sticky is FF only
      needle = new RegExp(needle.source, flags);
    }
    for (key in haystack) {
      if (needle.test(haystack[key])) {
        return key;
      }
    }
    return false;
  }

  for (key in haystack) {
    if ((strict && haystack[key] === needle) || (!strict && haystack[key] == needle)) {
      return key;
    }
  }

  return false;
}

// When stop action is triggered by clicking a survey question option, give notice before ending survey
function triggerStopAction(ob) {
	var obname = ob.prop('name');
	$('#stopActionPrompt').dialog({ bgiframe: true, modal: true, width: (isMobileDevice ? $(window).width() : 550),
		close: function(){
			var varname = ''
			// Undo last response if closing and returning to survey
			if (obname.substring(0,8) == '__chkn__'){
				// Checkbox
				varname = obname.substring(8,obname.length);
				$('#form :input[name="'+obname+'"]').each(function(){
					if ($(this).attr('code') == ob.attr('code')) {
						$(this).prop('checked',false);
						// If using Enhanced Choices for radios, then deselect it
						$('#'+varname+'-tr div.enhancedchoice label.selectedchkbox[for="'+varname+',code,'+ob.attr('code')+'"]').removeClass('selectedchkbox').addClass('unselectedchkbox');
					}
				});
				$('#form :input[name="'+obname.replace('__chkn__','__chk__')+'_RC_'+ob.attr('code')+'"]').val('');
			} else if (obname.substring(obname.length-8,obname.length) == '___radio'){
				// Radio
				varname = obname.substring(0,obname.length-8);
				radioResetVal(varname,'form');
			} else {
				// Drop-down (including any auto-complete input component)
				$('#form select[name="'+obname+'"], #rc-ac-input_'+obname).val('');
				varname = obname;
			}
			// Highlight the row they need to return to
			setTimeout(function(){
				$('#stopActionReturn').dialog({ bgiframe: true, modal: true, width: 320,
					buttons: [{ text: stopAction3, click: function() {
						highlightTableRow(varname+'-tr',2500); $(this).dialog('close');
					 } } ]
				});
			},100);
		},
		buttons: [{ text: stopAction2, click: function() {
					// Trigger calculations and branching logic
					setTimeout(function(){calculate();doBranching();},50);
					$(this).dialog('close');
				 } },
				 { text: stopAction1, click: function() {
					// Make sure that auto-complete drop-downs get their value set prior to ending survey
					if ($('#form select[name="'+obname+'"]').hasClass('rc-autocomplete') && $('#rc-ac-input_'+obname).length) {
						$('#rc-ac-input_'+obname).trigger('blur');
					}
					// Change form action URL to force it to end the survey
					$('#form').prop('action', $('#form').prop('action')+'&__endsurvey=1' );
					// Submit the survey
					dataEntrySubmit(document.getElementById('submit-action'));
				 } } ]
	});
}

// Run when click the "reset value" for radio button fields
function radioResetVal(field,form) {
	$('form[name="'+form+'"] input[name="'+field+'___radio"]').prop('checked',false);
	$('form[name="'+form+'"] input[name="'+field+'"]').val('');
	if (form == 'form') {
		// If using Enhanced Choices for radios, then deselect it
		$('#'+field+'-tr div.enhancedchoice label.selectedradio').removeClass('selectedradio');
		// Piping: Transmit blank value to all piping receiver spans
		if (event_id != null) {
			$('.piping_receiver.piperec-'+event_id+'-'+field).html('______');
			// Update drop-down options separately via ajax
			try{ updatePipingDropdowns(field,''); } catch(e) { }
		}
		dataEntryFormValuesChanged = true;
		// Branching logic and calculations
		try { calculate();doBranching(); } catch(e){ }
	}
	return false;
}

// Checks survey page's URL for any reserved parameters (prevents confliction when using survey pre-filling)
function checkReservedSurveyParams(haystack) {
	var hu = window.location.search.substring(1);
	var gy = hu.split("&");
	var param, paramVal;
	var listRes = new Array();
	var listcount = 0;
	for (i=0;i<gy.length;i++) {
		ft = gy[i].split("=");
		param = ft[0];
		paramVal = ft[1];
		if (param != "s" && param != "hash" && !(param == "preview" && paramVal == "1")) {
			if (in_array(param, haystack)) {
				listRes[listcount] = param;
				listcount++;
			}
		}
	}
	if (listcount>0) {
		msg = "NOTICE: You are attempting to pass parameters in the URL that are reserved. "
			+ "Below are the parameters that you will need to remove from the URL's query string, as they will not be able to pre-fill "
			+ "survey questions because they are reserved. If you do not know what this means, please contact "
			+ "your survey administrator.\n\nReserved parameters:\n - " + listRes.join("\n - ");
		alert(msg);
	};
}

// Append the CSRF token from user's session to all forms on the webpage
function appendCsrfTokenToForm() {
	if (window.redcap_csrf_token) {
		setTimeout(function(){
			$('form').each(function(){
				$(this).append('<input type="hidden" name="redcap_csrf_token" value="'+redcap_csrf_token+'">')
			});
		},100);
	}
}

// Function to download data dictionary (give warning if project has any forms downloaded from Shared Library)
function downloadDD(draft,showLegal) {
	var url = app_path_webroot+'Design/data_dictionary_download.php?pid='+pid;
	if (draft) url += '&draft';
	if (showLegal) {
		if (!$('#sharedLibLegal').length) $('body').append('<div id="sharedLibLegal"></div>');
		$.get(app_path_webroot+'SharedLibrary/terms_of_use.php', { }, function(data){
			$('#sharedLibLegal').html(data);
			$('#sharedLibLegal').dialog({ bgiframe: true, modal: true, width: 600, title: 'REMINDER', buttons: {
				Cancel: function() { $(this).dialog('close'); },
				'I Agree with Terms of Use': function() { window.location.href = url; $(this).dialog('close'); }
			} });
		});
	} else {
		window.location.href = url;
	}
}

// Open the dialog for info about Shared Library
function openLibInfoPopup(action_text) {
	$.post(app_path_webroot+'SharedLibrary/info.php?pid='+pid, { action_text: action_text }, function(data){
		// Add dialog content
		if (!$('#sharedLibInfo').length) $('body').append('<div id="sharedLibInfo"></div>');
		$('#sharedLibInfo').html(data);
		$('#sharedLibInfo').dialog({ bgiframe: true, modal: true, width: 650, open: function(){fitDialog(this)},
			buttons: { Close: function() { $(this).dialog('close'); } }, title: 'The REDCap Shared Library'
		});
	});
}

// Show spinner icon as plot spaceholder (using Google Chart Tools)
function showSpinner(field) {
	var currentDivHeight = $('#plot-'+field).height();
	$('#plot-'+field).html('<div style="text-align:center;width:500px;height:'+currentDivHeight+'px;"><img title="Loading..." alt="Loading..." src="'+app_path_images+'progress.gif"></div>');
}

// Render Multiple Box Plots/Bar Charts (using Google Chart Tools)
function renderCharts(nextfields,charttype,results_code_hash) {
	// Do initial checking/setting of parameters
	if (nextfields.length < 1) return;
	if (isSurveyPage == null) isSurveyPage = false;
	if (charttype == null) charttype = '';
	if (results_code_hash == null || !isSurveyPage) results_code_hash = '';
	var hash = getParameterByName('s');
	var record = getParameterByName('record');
	// Do ajax request
	var url = app_path_webroot+'DataExport/plot_chart.php?pid='+pid;
	if (hash != '') {
		// Show results to survey participant (use passthru mechanism to avoid special authentication issues)
		url = dirname(dirname(app_path_webroot))+'/surveys/index.php?pid='+pid+'&s='+hash+'&__results='+getParameterByName('__results')+'&__passthru='+escape('DataExport/plot_chart.php');
	} else if (record != '') {
		// Overlay results from one record
		var event_id = getParameterByName('event_id');
		url += '&record='+record+'&event_id='+event_id;
	}
	$.post(url, { fields: nextfields, charttype: charttype, isSurveyPage: (isSurveyPage ? '1' : '0'), results_code_hash: results_code_hash, includeRecordsEvents: includeRecordsEvents, hasFilterWithNoRecords: hasFilterWithNoRecords }, function(resp_data){
		var json_data = jQuery.parseJSON(resp_data);
		// Set variables
		var field = json_data.field;
		var form = json_data.form;
		var nextfields = json_data.nextfields;
		var raw_data = json_data.data;
		var minValue = json_data.min;
		var maxValue = json_data.max;
		var medianValue = json_data.median;
		var respondentData = json_data.respondentData;
		var showChart = json_data.showChart; // Used to hide Bar Charts if lacking diversity
		if (charttype != '') {
			var plottype = charttype;
		} else {
			var plottype = json_data.plottype;
		}
		// If no data was sent OR plot should be hidden due to lack of diversity, then do not display field (would cause error)
		if (!showChart || raw_data.length == 0) {
			// Hide the field div
			if (showChart && raw_data.length == 0) {
				$('#plot-'+field).html( $('#no_show_plot_div').html() );
			} else {
				$('#plot-'+field).hide();
			}
			if (isSurveyPage) $('#stats-'+field).remove(); // Only hide the stats table for survey results
			$('#chart-select-'+field).hide();
			$('#refresh-link-'+field).hide();
			// Perform the next ajax request if more fields still need to be processed
			if (nextfields.length > 0) {
				renderCharts(nextfields,charttype,results_code_hash);
			}
			return;
		}
		// Show download button
		$('#plot-download-btn-'+field).show();
		// Instantiate data object
		var data = new google.visualization.DataTable();
		// Box Plot
		if (plottype == 'BoxPlot')
		{
			// Store record names and event_id's into array to allow navigation to page
			var recordEvent = new Array();
			// Set text for the pop-up tooltip
			var tooltipText = (isSurveyPage ? 'Value entered by survey participant /' : 'Click plot point to go to this record /');
			// Add data columns
			data.addColumn('number', '');
			data.addColumn('number', 'Value');
			// Add data rows
			for (var i = 0; i < raw_data.length; i++) {
				// Add to chart data
				data.addRow([{v: raw_data[i][0], f: raw_data[i][0]+'\n\n'}, {v: raw_data[i][1], f: tooltipText}]);
				// Add to recordEvent array
				if (!isSurveyPage) {
					recordEvent[i] = '&id='+raw_data[i][2]+'&event_id='+raw_data[i][3]+'&instance='+raw_data[i][4];
				}
			}
			// Add median dot
			data.addColumn('number', 'Median');
			data.addRow([{v: medianValue, f: medianValue+'\n\n'}, null, {v: 0.5, f: 'Median value /'}]);
			// Add single respondent/record data point
			if (respondentData != '') {
				var tooltipTextSingleResp1, tooltipTextSingleResp2;
				if (isSurveyPage) {
					tooltipTextSingleResp1 = tooltipTextSingleResp2 = 'YOUR value';
				} else {
					tooltipTextSingleResp1 = 'Value for selected record ('+record+')';
					tooltipTextSingleResp2 = 'Click plot point to go to this record';
				}
				data.addColumn('number', tooltipTextSingleResp1);
				data.addRow([{v: respondentData*1, f: respondentData+'\n\n'}, null, null, {v: 0.5, f: tooltipTextSingleResp2+' /'}]);
				// Add to recordEvent array
				if (!isSurveyPage) {
					recordEvent[i+1] = '&id='+record+'&event_id='+event_id;
				}
			}
			// Display box plot
			var chart = new google.visualization.ScatterChart(document.getElementById('plot-'+field));
			var chartHeight = 250;
			chart.draw(data, {chartArea: {top: 10, left: 30, height: (chartHeight-50)}, width: 650, height: chartHeight, legend: 'none', vAxis: {minValue: 0, maxValue: 1, textStyle: {fontSize: 1} }, hAxis: {minValue: minValue, maxValue: maxValue} });
			// Set action to open form in new tab when select a plot point
			if (!isSurveyPage) {
				google.visualization.events.addListener(chart, 'select', function selectPlotPoint(){
					var selection = chart.getSelection();
					if (selection.length < 1) return;
					var message = '';
					for (var i = 0; i < selection.length; i++) {
						var itemrow = selection[i].row;
						if (itemrow != null && recordEvent[itemrow] != null) {
							window.open(app_path_webroot+'DataEntry/index.php?pid='+pid+'&page='+form+recordEvent[itemrow]+'&fldfocus='+field+'#'+field+'-tr','_blank');
							return;
						}
					}
				});
			}
		}
		// Bar/Pie Chart
		else
		{
			// Add data columns
			data.addColumn('string', '');
			if (isSurveyPage) {
				data.addColumn('number', 'Count from other respondents');
				data.addColumn('number', 'Count from YOU');
			} else {
				data.addColumn('number', 'Count');
				data.addColumn('number', 'Count from the selected record');
			}
			// Add data rows
			data.addRows(raw_data);
			// Display bar chart or pie chart
			if (plottype == 'PieChart') {
				var chart = new google.visualization.PieChart(document.getElementById('plot-'+field));
				var chartHeight = 300;
				chart.draw(data, {chartArea: {top: 10, height: (chartHeight-50)}, width: 600, height: chartHeight, legend: 'none', hAxis: {minValue: minValue, maxValue: maxValue} });
			} else if (plottype == 'BarChart') {
				var chart = new google.visualization.BarChart(document.getElementById('plot-'+field));
				var chartHeight = 80+(raw_data.length*60);
				chart.draw(data, {colors:['#3366CC','#FF9900'], isStacked: true, chartArea: {top: 10, height: (chartHeight-50)}, width: 600, height: chartHeight, legend: 'none', hAxis: {minValue: minValue, maxValue: maxValue} });
			}
		}
		// Perform the next ajax request if more fields still need to be processed
		if (nextfields.length > 0) {
			renderCharts(nextfields,charttype,results_code_hash);
		}
	});
}

// Graphical page: Show/hide plots and stats tables
function showPlotsStats(option,obj) {
	// Enable all buttons
	$('#showPlotsStatsOptions button').each(function(){
		$(this).prop('disabled',false);
		$(this).button('enable');
	});
	// Disable this button
	$(obj).button('disable');
	// Options
	if (option == 1) {
		// Plots only
		$('.descrip_stats_table, .gct_plot img').hide();
		$('.gct_plot, .plot-download-div').show();
	} else if (option == 2) {
		// Stats only
		$('.descrip_stats_table, .gct_plot img').show();
		$('.gct_plot, .plot-download-div').hide();
	} else {
		// Plots+Stats
		$('.descrip_stats_table, .gct_plot, .plot-download-div').show();
		$('.gct_plot img').hide();
	}
}

// Unescape a string that is URL encoded ("escape" in javascript)
function urldecode(str) {
	return decodeURIComponent((str + '').replace(/\+/g, '%20'));
}

// Determine if URL is a proper URL
function isUrl(s) {
	var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/i;
	return regexp.test(s);
}

// Test if a URL is reachable
function testUrl(url,request_method,evalJsOnFail) {
	if (url == null) return false;
	if (request_method == null) request_method = 'get';
	var errorMsg = "Unfortunately, the REDCap server was not able to reach the web address you provided and thus was not able to verify it as valid.<div style='font-size:13px;padding:20px 0 5px;color:#C00000;'>Not verifiable: &nbsp;<b>"+url+"</b></div>";
	var errorTitle = "<img src='"+app_path_images+"cross.png' style='vertical-align:middle;'> <span style='color:#C00000;vertical-align:middle;'>Failed to verify web address</span>";
	// Start "working..." progress bar
	showProgress(1,300);
	// Do ajax request to test the URL
	var thisAjax = $.post(app_path_webroot+'ProjectGeneral/test_http_request.php',{ url: url, request_method: request_method },function(data){
		showProgress(0,0);
		if (data == '1') {
			simpleDialog("The web address is a valid URL and was able to be reached by the REDCap server.<div style='font-size:13px;padding:20px 0 5px;color:green;'>Valid: &nbsp;<b>"+url+"</b></div>","<img src='"+app_path_images+"tick.png' style='vertical-align:middle;'> <span style='color:green;vertical-align:middle;'>Success!</span>");
		} else {
			simpleDialog(errorMsg, errorTitle);
			// If provided javascript to eval upon failure, the eval it here
			if (evalJsOnFail != null) eval(evalJsOnFail);
		}
	});
	// If does not finish after X seconds, then throw error msg
	var maxAjaxTime = 10; // seconds
	setTimeout(function(){
		if (thisAjax.readyState == 1) {
			thisAjax.abort();
			showProgress(0,0);
			simpleDialog(errorMsg, errorTitle);
			// If provided javascript to eval upon failure, the eval it here
			if (evalJsOnFail != null) eval(evalJsOnFail);
		}
	},maxAjaxTime*1000);
}

// Remove <script> tags from a string
function removeScriptTags(text) {
	var SCRIPT_REGEX = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi;
	while (SCRIPT_REGEX.test(text)) {
		text = text.replace(SCRIPT_REGEX, "");
	}
	return;
}

// When clicking through the External Links, do logging via ajax before sending to destination
function ExtLinkClickThru(ext_id,openNewWin,url,form) {
	$.post(app_path_webroot+'ExternalLinks/clickthru_logging_ajax.php?pid='+pid, { url: url, ext_id: ext_id }, function(data){
		if (data != '1') {
			alert(woops);
			return false;
		}
		if (!openNewWin) {
			if (form != '') {
				// Adv Link: Submit the form
				$('#'+form).submit();
			} else {
				// Simple Link: If not opening a new window, then redirect the current page
				window.location.href = url;
			}
		}
	});
}
// Open pop-up for the Help & FAQ page (can specify section using # anchor)
function helpPopup(anchor) {
	window.open(app_path_webroot_full+'index.php?action=help'+(anchor == null ? '' : '#'+anchor),'myWin','width=850, height=600, toolbar=0, menubar=0, location=0, status=0, scrollbars=1, resizable=1');
}

// Dynamics when setting email address in pop-up for inviting participant to finish a follow-up survey
function inviteFollowupSurveyPopupSelectEmail(ob) {
	var isDD = ($(ob).attr('id') == 'followupSurvEmailToDD');
	if (isDD) {
		$('#followupSurvEmailTo').val('');
	} else {
		$('#followupSurvEmailToDD').val('');
	}
}

// Dynamics when setting phone number in pop-up for inviting participant to finish a follow-up survey
function inviteFollowupSurveyPopupSelectPhone(ob) {
	var isDD = ($(ob).attr('id') == 'followupSurvPhoneToDD');
	if (isDD) {
		$('#followupSurvPhoneTo').val('');
	} else {
		$('#followupSurvPhoneToDD').val('');
	}
}

// Show/hide options for various delivery methods when sending survye invitations
function setInviteDeliveryMethod(ob) {
	var val = $(ob).val();
	$('#compose_email_subject_tr, #compose_email_from_tr, #compose_email_form_fieldset, #compose_email_to_tr').show();
	$('.show_for_sms, .show_for_voice, .show_for_part_pref, #compose_phone_to_tr').hide();
	if (val == 'VOICE_INITIATE') {
		$('#compose_email_subject_tr, #compose_email_from_tr, #compose_email_form_fieldset, #compose_email_to_tr').hide();
		$('.show_for_voice, #compose_phone_to_tr').show();
	} else if (val == 'SMS_INVITE_MAKE_CALL' || val == 'SMS_INVITE_RECEIVE_CALL' || val == 'SMS_INITIATE' || val == 'SMS_INVITE_WEB') {
		$('#compose_email_subject_tr, #compose_email_from_tr, #compose_email_to_tr').hide();
		$('.show_for_sms, #compose_phone_to_tr').show();
	} else if (val == 'PARTICIPANT_PREF') {
		$('.show_for_part_pref').show();
	}
	if ($('#inviteFollowupSurvey').length) {
		$('#inviteFollowupSurvey').dialog('option', 'position', 'center');
	}
}

// Open pop-up for inviting participant to finish a follow-up survey
function inviteFollowupSurveyPopup(survey_id,form,record,event_id,instance) {
	if (!$('#inviteFollowupSurvey').length) $('body').append('<div id="inviteFollowupSurvey" style="display:none;"></div>');
	// Get the dialog content via ajax first
	$.post(app_path_webroot+'Surveys/invite_participant_popup.php?pid='+pid+'&survey_id='+survey_id+'&event_id='+event_id+'&instance='+instance, { action: 'popup', form: form, record: record }, function(data){
		if (data == '0') {
			alert(woops);
			return;
		}
		$('#inviteFollowupSurvey').html(data);
		initWidgets();
		initSurveyReminderSettings();
		$('#inviteFollowupSurvey').dialog({ bgiframe: true, modal: true, width: 550, open: function(){fitDialog(this)},
			title: 'Send Survey Invitation to Participant "'+record+'"',
			buttons: {
			'Cancel': function() {
				$(this).dialog('close');
			},
			'Send Invitation': function() {
				// Trim email subject/message
				$('#followupSurvEmailSubject').val( trim($('#followupSurvEmailSubject').val()) );
				$('#followupSurvEmailMsg').val( trim($('#followupSurvEmailMsg').val()) );
				// If set exact time in future to send surveys, make sure time doesn't exist in the past
				var now_ymdhm = now.replace(/ /g, '').replace(/-/g, '').replace(/:/g, '');
				now_ymdhm = now_ymdhm.substring(0, now_ymdhm.length-2)*1;
				var eTs = $('#inviteFollowupSurvey #emailSendTimeTS').val();
				if (user_date_format_validation == 'mdy') {
					var emailSendTimeTs_ymdhm = eTs.substr(6,4)+eTs.substr(0,2)+eTs.substr(3,2)+eTs.substr(11,2)+eTs.substr(14,2);
				} else if (user_date_format_validation == 'dmy') {
					var emailSendTimeTs_ymdhm = eTs.substr(6,4)+eTs.substr(3,2)+eTs.substr(0,2)+eTs.substr(11,2)+eTs.substr(14,2);
				} else {
					var emailSendTimeTs_ymdhm = eTs.substr(0,4)+eTs.substr(5,2)+eTs.substr(8,2)+eTs.substr(11,2)+eTs.substr(14,2);
				}
				if ($('#inviteFollowupSurvey input[name="emailSendTime"]:checked').val() == 'EXACT_TIME') {
					if ($('#inviteFollowupSurvey #emailSendTimeTS').val().length < 1) {
						simpleDialog($('#langFollowupProvideTime').html(),null,null,null,"$('#inviteFollowupSurvey #emailSendTimeTS').focus();");
						return;
					} else if (!redcap_validate(document.getElementById('emailSendTimeTS'),'','','hard','datetime_'+user_date_format_validation,1,1,user_date_format_delimiter)) {
						return;
					} else if (emailSendTimeTs_ymdhm < now_ymdhm) {
						simpleDialog($('#langFollowupTimeInvalid').html(),$('#langFollowupTimeExistsInPast').html());
						return;
					}
				}
				// Determine delivery method
				var delivery_type = ($('#inviteFollowupSurvey select[name="delivery_type"]').length) ?
					$('#inviteFollowupSurvey select[name="delivery_type"]').val() : 'EMAIL';
				// Make sure we have email address. Typed email overrides the drop-down selection email
				var email = trim($('#followupSurvEmailTo').val());
				if (email == '' && $('#followupSurvEmailToDD').length) {
					email = trim($('#followupSurvEmailToDD').val());
				}
				// Email is a valid email address OR is an integer (i.e. participant_id)
				if (delivery_type == 'EMAIL' && !isEmail(email) && !isNumeric(email)) {
					simpleDialog('Please provide a valid email address');
					return;
				}
				// Make sure we have phone number. Typed phone overrides the drop-down selection phone
				var phone = trim($('#followupSurvPhoneTo').val());
				if (phone == '' && $('#followupSurvPhoneToDD').length) {
					phone = trim($('#followupSurvPhoneToDD').val());
				}
				// phone is a valid email address OR is an integer (i.e. participant_id)
				if (delivery_type != 'EMAIL' && (!isNumeric(phone) || phone == '')) {
					simpleDialog('Please provide a valid phone number');
					return;
				}
				// Validate the surveys reminders options
				if (!validateSurveyRemindersOptions()) return;
				// Set initial values
				var reminder_type = $('#reminders_choices_div input[name="reminder_type"]:checked').val();
				if (reminder_type == null || !$('#enable_reminders_chk').prop('checked')) reminder_type = '';
				var reminder_timelag_days = '';
				var reminder_timelag_hours = '';
				var reminder_timelag_minutes = '';
				var reminder_nextday_type = '';
				var reminder_nexttime = '';
				var reminder_exact_time = '';
				var reminder_num = '0';
				if (reminder_type == 'NEXT_OCCURRENCE') {
					reminder_nextday_type = $('#reminders_choices_div select[name="reminder_nextday_type"]').val();
					reminder_nexttime = $('#reminders_choices_div input[name="reminder_nexttime"]').val();
				} else if (reminder_type == 'TIME_LAG') {
					reminder_timelag_days = ($('#reminders_choices_div input[name="reminder_timelag_days"]').val() == '') ? '0' : $('#reminders_choices_div input[name="reminder_timelag_days"]').val();
					reminder_timelag_hours = ($('#reminders_choices_div input[name="reminder_timelag_hours"]').val() == '') ? '0' : $('#reminders_choices_div input[name="reminder_timelag_hours"]').val();
					reminder_timelag_minutes = ($('#reminders_choices_div input[name="reminder_timelag_minutes"]').val() == '') ? '0' : $('#reminders_choices_div input[name="reminder_timelag_minutes"]').val();
				} else if (reminder_type == 'EXACT_TIME') {
					reminder_exact_time = $('#reminders_choices_div input[name="reminder_exact_time"]').val();
				}
				var reminder_num = $('#reminders_choices_div select[name="reminder_num"]').val();
				// Set status message
				$(':button:contains("Cancel") span').html('Close');
				$(':button:contains("Send Invitation")').unbind().html('<span class="ui-button-text"><img src="'+app_path_images+'progress_circle.gif" style="vertical-align:middle;"> <span style="vertical-align:middle;">Sending...</span></span>');
				// Send email via ajax
				$.post(app_path_webroot+'Surveys/invite_participant_popup.php?pid='+pid+'&survey_id='+survey_id+'&event_id='+event_id+'&instance='+instance, { email: email,
					action: 'email', form: form, record: record, email_account: $('#followupSurvEmailFrom').val(), subject: $('#followupSurvEmailSubject').val(), msg: $('#followupSurvEmailMsg').val(),
					sendTime: $('#inviteFollowupSurvey input[name="emailSendTime"]:checked').val(), sendTimeTS: $('#inviteFollowupSurvey #emailSendTimeTS').val(),
					reminder_type: reminder_type,
					reminder_timelag_days: reminder_timelag_days,
					reminder_timelag_hours: reminder_timelag_hours,
					reminder_timelag_minutes: reminder_timelag_minutes,
					reminder_nextday_type: reminder_nextday_type,
					reminder_nexttime: reminder_nexttime,
					reminder_exact_time: reminder_exact_time,
					reminder_num: reminder_num,
					delivery_type: delivery_type, phone: phone
					}, function(data){
					if (data == '0') {
						alert(woops);
						return;
					}
					// Replace popup content and auto-hide after 4s
					$('#inviteFollowupSurvey').html(data);
					$('#inviteFollowupSurveyBtn').hide();
					$(':button:contains("Sending...")').remove(); //.html('<button id="closeInviteFollowupSurvey" onclick="alert(222);$(\'#inviteFollowupSurvey\').dialog(\'close\');" class="ui-button-text">Close</button>');
					//setTimeout(function(){ $('#inviteFollowupSurvey').dialog('close'); }, 6000);
				});
			} }
		});
		// Show/hide all fields in popup accordingly
		if ($('#inviteFollowupSurvey select[name="delivery_type"]').length) {
			$('#inviteFollowupSurvey select[name="delivery_type"]').trigger('change');
		}
	});
}

// Download file and append survey response_hash for File download field type on form/survey
function appendRespHash(name) {
	$('#'+name+'-link').attr('href', $('#'+name+'-link').attr('href') + '&__response_hash__='+$('#form :input[name=__response_hash__]').val());
	return true;
}

// Open dialog to randomize a record
function randomizeDialog(record) {
	// Open dialog pop-up populated by ajax call content
	if (!$('#randomizeDialog').length) $('body').append('<div id="randomizeDialog" style="display:none;"></div>');
	// Get the dialog content via ajax first
	$.post(app_path_webroot+'Randomization/randomize_record.php?pid='+pid, { action: 'view', record: record }, function(data){
		if (data == '0') {
			alert(woops);
			return;
		}
		// Load dialog content
		$('#randomizeDialog').html(data);
		// Check if returned without error
		if (!$('#randomizeDialog #randomCriteriaFields').length) {
			// Open dialog
			$('#randomizeDialog').dialog({ bgiframe: true, modal: true, width: 750, open: function(){fitDialog(this)},
				title: '<img src="'+app_path_images+'arrow_switch.png"> Cannot yet randomize '+table_pk_label+' "'+record+'"',
				buttons: {
					Close: function() {
						$(this).dialog('close');
					}
				}
			});
			return;
		}
		// Check if we're on a data entry page
		var isDataEntryPage = (page == 'DataEntry/index.php');
		// Get arrays of criteria fields/events
		var critFldsCsv = $('#randomizeDialog #randomCriteriaFields').val();
		var critFlds = (critFldsCsv.length > 0) ? critFldsCsv.split(',') : new Array();
		var critEvtsCsv = $('#randomizeDialog #randomCriteriaEvents').val();
		var critEvts = (critEvtsCsv.length > 0) ? critEvtsCsv.split(',') : new Array();
		// Check if we're on a form right now AND if our criteria fields are present.
		// If so, copy in their current values (because they may not have been saved yet).
		if (isDataEntryPage) {
			for (var i=0; i<critFlds.length; i++) {
				var field = critFlds[i];
				var event = critEvts[i];
				// Only do for correct event
				if (event == event_id) {
					if ($('#form select[name="'+field+'"]').length) {
						// Drop-down
						var fldVal = $('#form select[name="'+field+'"]').val();
						$('#random_form select[name="'+field+'"]').val(fldVal);
					} else if ($('#form :input[name="'+field+'"]').length) {
						// Radio/YN/TF
						var fldVal = $('#form :input[name="'+field+'"]').val();
						// First unselect all, then loop to find the one to select
						if ($('#random_form input[type="radio"][name="'+field+'"]').length) {
							radioResetVal(field,'random_form');
						}
						$('#random_form input[name="'+field+'"]').val(fldVal);
						if (fldVal != '' && $('#random_form input[type="radio"][name="'+field+'___radio"]').length) {
							$('#random_form input[name="'+field+'___radio"]').each(function(){
								if ($(this).val() == fldVal) {
									$(this).prop('checked',true);
								}
							});
						}
					}
				}
			}
			// If we're grouping by DAG and user is NOT in a DAG, then transfer DAG value from form to pop-up
			if ($('#form select[name="__GROUPID__"]').length && $('#random_form select[name="redcap_data_access_group"]').length) {
				$('#random_form select[name="redcap_data_access_group"]').val( $('#form select[name="__GROUPID__"]').val() );
			}
		}
		// Open dialog
		$('#randomizeDialog').dialog({ bgiframe: true, modal: true, width: 750, open: function(){fitDialog(this);if (isMobileDevice) fitDialog(this);},
			title: '<img src="'+app_path_images+'arrow_switch.png"> Randomizing '+table_pk_label+' "'+record+'"',
			buttons: {
				Cancel: function() {
					// Lastly, clear out dialog content
					$('#randomizeDialog').html('');
					$(this).dialog('close');
				},
				'Randomize': function() {
					// Disable buttons so they can't be clicked multiple times
					$('#randomizeDialog').parent().find('div.ui-dialog-buttonpane button').button('disable');
					// Make sure all fields have a value
					var critFldVals = new Array();
					if ($('#randomizeDialog #random_form table.form_border tr').length) {
						var fldsNoValCnt = 0;
						// Loop through all strata fields
						for (var i=0; i<critFlds.length; i++) {
							var isDropDownField = $('#randomizeDialog #random_form select[name="'+critFlds[i]+'"]').length;
							if (!isDropDownField && $('#randomizeDialog #random_form input[name="'+critFlds[i]+'"]').val().length < 1) {
								// Radio/TF/YN w/o value
								fldsNoValCnt++;
							} else if (isDropDownField && $('#randomizeDialog #random_form select[name="'+critFlds[i]+'"]').val().length < 1) {
								// Dropdown w/o value
								fldsNoValCnt++;
							} else {
								critFldVals[i] = (isDropDownField ? $('#randomizeDialog #random_form select[name="'+critFlds[i]+'"]').val() : $('#randomizeDialog #random_form input[name="'+critFlds[i]+'"]').val());
							}
						}
						// Also check DAG field, if exists
						if ($('#random_form select[name="redcap_data_access_group"]').length && $('#random_form select[name="redcap_data_access_group"]').val().length < 1) {
							fldsNoValCnt++;
						}
						// If any missing fields are missing a value, stop here and prompt user
						if (fldsNoValCnt > 0) {
							simpleDialog(fldsNoValCnt+" strata/criteria field(s) do not yet have a value. "
								+ "You must first provide them with a value before randomization can be performed.","VALUES MISSING FOR STRATA/CRITERIA FIELDS!");
							// Re-eable buttons
							$('#randomizeDialog').parent().find('div.ui-dialog-buttonpane button').button('enable');
							return;
						}
					}
					// AJAX call to save data and randomize record
					$.post(app_path_webroot+'Randomization/randomize_record.php?pid='+pid+'&instance='+getParameterByName('instance'), { event_id: event_id, redcap_data_access_group: $('#random_form select[name="redcap_data_access_group"]').val(), existing_record: document.form.hidden_edit_flag.value, action: 'randomize', record: record, fields: critFlds.join(','), field_values: critFldVals.join(',') }, function(data){
						if (data == '0') {
							alert(woops);
							// Re-eable buttons
							$('#randomizeDialog').parent().find('div.ui-dialog-buttonpane button').button('enable');
							return;
						}
						// Replace dialog content with response data
						$('#randomizeDialog').html(data);
						// Replace dialog buttons with a Close button
						$('#randomizeDialog').dialog("option", "buttons", []);
						fitDialog($('#randomizeDialog'));
						// Initialize widgets
						initWidgets();
						// Replace Randomize button on left-hand menu
						var success = $('#randomizeDialog #alreadyRandomizedTextWidget').length;
						if (success) {
							// Replace Randomize button on form with "Already Randomized" text and redisplay the field
							$('#alreadyRandomizedText').html( $('#randomizeDialog #alreadyRandomizedTextWidget').html() );
							$('#randomizationFieldHtml').show();
							// If on data entry form and criteria fields are on this form, disable them and set their values
							if (isDataEntryPage) {
								// Set hidden_edit_flag to 1 (in case this is a new record)
								$('#form :input[name="hidden_edit_flag"]').val('1');
								// Loop through criteria fields
								for (var i=0; i<critFlds.length; i++) {
									var field = critFlds[i];
									var fldVal = critFldVals[i];
									var event = critEvts[i];
									// Only do for correct event
									if (event == event_id) {
										if ($('#form select[name="'+field+'"]').length) {
											// Drop-down
											$('#form select[name="'+field+'"]').val(fldVal).prop('disabled',true);
											// Also set autocomplete input for drop-down (if using auto-complete)
											if ($('#form #rc-ac-input_'+field).length)
												$('#form #rc-ac-input_'+field).val( $('#form select[name="'+field+'"] option:selected').text() ).prop('disabled',true).parent().find('button.rc-autocomplete').prop('disabled',true);
										} else if ($('#form :input[name="'+field+'"]').length) {
											// Radio/YN/TF
											// First unselect all, then loop to find the one to select
											if ($('#form input[type="radio"][name="'+field+'"]').length) {
												radioResetVal(field,'form');
											}
											$('#form :input[name="'+field+'"]').val(fldVal);
											if (fldVal != '' && $('#form input[type="radio"][name="'+field+'___radio"]').length) {
												$('#form :input[name="'+field+'___radio"]').each(function(){
													if ($(this).val() == fldVal) {
														$(this).prop('checked',true);
													}
													// Disable it
													$(this).prop('disabled',true);
												});
											}
											// Now hide the "reset value" link for this field
											$('#form tr#'+field+'-tr a.cclink').hide();
										}
									}
								}
								// Now set value for randomization field, if on this form
								var fldVal = $('#randomizeDialog #randomizationFieldRawVal').val();
								var field = $('#randomizeDialog #randomizationFieldName').val();
								var event = $('#randomizeDialog #randomizationFieldEvent').val();
								// Only do for correct event
								if (event == event_id) {
									if ($('#form select[name="'+field+'"]').length) {
										// Drop-down
										$('#form select[name="'+field+'"]').val(fldVal).prop('disabled',true);
										// Also set autocomplete input for drop-down (if using auto-complete)
										if ($('#form #rc-ac-input_'+field).length)
											$('#form #rc-ac-input_'+field).val( $('#form select[name="'+field+'"] option:selected').text() ).prop('disabled',true).parent().find('button.rc-autocomplete').prop('disabled',true);
									} else if ($('#form :input[name="'+field+'"]').length) {
										// Radio/YN/TF
										// First unselect all, then loop to find the one to select
										radioResetVal(field,'form');
										$('#form :input[name="'+field+'"]').val(fldVal);
										$('#form :input[name="'+field+'___radio"]').each(function(){
											if ($(this).val() == fldVal) {
												$(this).prop('checked',true);
											}
											// Disable it
											$(this).prop('disabled',true);
										});
									}
								}
								// If we're grouping by DAG and user is NOT in a DAG, then transfer DAG value from pop-up back to form
								// after randomizing AND also disabled the DAG drop-down to prevent someone changing it.
								if ($('#form select[name="__GROUPID__"]').length && $('#randomizeDialog #redcap_data_access_group').length) {
									$('#form select[name="__GROUPID__"]').val( $('#randomizeDialog #redcap_data_access_group').val() );
									$('#form select[name="__GROUPID__"]').prop('disabled',true);
								}
							}
							// Just in case we're using auto-numbering and current ID does not reflect saved ID (due to simultaneous users),
							// change the record value on the page in all places.
							$('#form :input[name="'+table_pk+'"], #form :input[name="__old_id__"]').val( $('#randomizeDialog #record').val() );
							// Hide the duplicate randomization field label (if Left-Aligned)
							$('.randomizationDuplLabel').hide();
							// Now that record is randomized, run branching and calculations on form in case any logic is built off of fields used in randomization
							calculate();
							doBranching();
						}
					});
				}
			}
		});
		// Init any autocomplete dropdowns inside the randomization dialog
		if (isDataEntryPage) enableDropdownAutocomplete();
	});
}

// Display a simple modal dialog for a desired time (alternative to jQueryUI dialog) - no buttons or anything fancy
function simpleDialogAlt(msg_div_ob, displayTime, width, jsOnHide) {
	if (msg_div_ob.length) {
		// Set time that dialog is displayed before disappearing (default 2 seconds)
		if (displayTime == null) displayTime = 2;
		// Create modal overlay
		var randnum = Math.floor(Math.random()*10000000000000000);
		var id = "overlay_"+randnum;
		$('body').append('<div id="'+id+'" class="ui-widget-overlay" style="background-color:#555;z-index:998;display:none;"></div>');
		$('#'+id).height( $(document).height() ).width( $(document).width() ).show();
		// If msg_div_ob is a string and not an object, then convert to object
		if (jQuery.type(msg_div_ob) == 'string') {
			$('body').append('<div id="popup_'+randnum+'" style="display:none;padding:20px;background-color:#fff;border:1px solid #777;">'+msg_div_ob+'</div>');
			msg_div_ob = $('#popup_'+randnum);
		}
		// Set div's absolute position and z-index
		msg_div_ob.css({'z-index':'999','position':'absolute'})
		// Set width of div, if set
		if (width != null && isNumeric(width)) msg_div_ob.width(width);
		// Show the div on top of overlay
		msg_div_ob.show('fade','fast').position({ my: "center", at: "center", of: window });
		// After set time, make div disappear
		setTimeout(function(){
			$('#'+id).remove();
			msg_div_ob.hide('fade',1000);
			// Eval JavaScript
			if (jsOnHide != null) {
				try{ eval(jsOnHide); }catch(e){ }
			}
		},(displayTime*1000));
	}
}

// Display jQuery UI dialog with Close button (provide id, title, content, width, onClose JavaScript event as string)
function simpleDialog(content,title,id,width,onCloseJs,closeBtnTxt,okBtnJs,okBtnTxt) {
	// If no id is provided, create invisible div on the fly to use as dialog container
	var idDefined = true;
	if (id == null || trim(id) == '') {
		id = "popup"+Math.floor(Math.random()*10000000000000000);
		idDefined = false;
	}
	// If this DOM element doesn't exist yet, then add it and set title/content
	if ($('#'+id).length < 1) {
		var existInDom = false;
		initDialog(id);
	} else {
		if (title == null || title == '') title = $('#'+id).attr('title');
		var existInDom = true;
		if (!$('#'+id).hasClass('simpleDialog')) $('#'+id).addClass('simpleDialog');
	}
	// Set content
	if (content != null && content != '') $('#'+id).html(content);
	// default title
	if (title == null) title = '<span style="color:#555;font-weight:normal;">Alert</span>';
	// Set parameters
	if (!isNumeric(width)) width = 500; // default width
	// Set default button text
	if (okBtnTxt == null) {
		// Default "okay" text for secondary button
		okBtnTxt = 'Okay';
		// Default "cancel" text for first button when have 2 buttons
		if (okBtnJs != null && closeBtnTxt == null) closeBtnTxt = 'Cancel';
	}
	if (closeBtnTxt == null) {
		// Default "close" text for single button
		closeBtnTxt = 'Close';
	}
	// Set up button(s)
	if (okBtnJs == null) {
		// Only show a Close button
    var btnClass = '';
    if(onCloseJs === 'delete_iframe'){
      btnClass = 'hidden';
    }
		var btns =	[{ text: closeBtnTxt, 'class': btnClass, click: function() {
						// Destroy dialog and remove div from DOM if was created on the fly
						$(this).dialog('close').dialog('destroy');
						if (!idDefined) $('#'+id).remove();
					} }];
	} else {
		// Show two buttons
		var btns =	[{ text: closeBtnTxt, click: function() {
						// Destroy dialog and remove div from DOM if was created on the fly
						$(this).dialog('close').dialog('destroy');
						if (!idDefined) $('#'+id).remove();
					}},
					{text: okBtnTxt, click: function() {
						// If okBtnJs was provided, then eval it to execute
						if (okBtnJs != null) {
							if (typeof(okBtnJs) == 'string') {
								eval(okBtnJs);
							} else {
								var okBtnJsFunc = okBtnJs;
								eval("okBtnJsFunc()");
							}
						}
						// Destroy dialog and remove div from DOM if was created on the fly
						$(this).dialog('destroy');
						if (!idDefined) $('#'+id).remove();
					}}];
	}
	// Show dialog
	$('#'+id).dialog({ bgiframe: true, modal: true, width: width, title: title, buttons: btns });
	// If Javascript is provided for onClose event, then set it here
	if (onCloseJs != null) {
    if(onCloseJs == 'delete_iframe'){
      var dialogcloseFunc = "function(){window.location.reload()}";
    }else{
		var dialogcloseFunc = (typeof(onCloseJs) == 'string') ? "function(){"+onCloseJs+"}" : onCloseJs;
    }
		eval("$('#"+id+"').bind('dialogclose',"+dialogcloseFunc+");");
	}
	// If div already existed in DOM beforehand (i.e. wasn't created here on the fly), then re-add title to div because it gets lost when converted to dialog
	if (existInDom)	$('#'+id).attr('title', title);
}

// Convert HTML <br /> tags to new lines \n
function br2nl(val) {
	return val.replace(/<br\s*\/?>/mg,"\n");
};

// Convert new lines \n to HTML <br /> tags
function nl2br(val) {
	return val.replace(/\n/g,"<br />");
};

// Navigate to "set up survey" page
function setUpSurvey(ob) {
	if (ob.value != '') {
		window.location.href = app_path_webroot+"Surveys/create_survey.php?pid="+pid+"&view=showform&page="+ob.value;
	}
}

// Test if value is a URL. If not, give error message and return cursor to field
function isUrlError(ob) {
	ob.style.fontWeight = 'normal';
	ob.style.backgroundColor='#FFFFFF';
	var url = ob.value = trim(ob.value);
	if (url.length < 1) return true;
	if (!isUrl(url)) {
		alert('Sorry, but the web address you entered "'+url+'" does not appear to be a proper URL (e.g., http://google.com). Please fix it and try again.');
		ob.style.fontWeight = 'bold';
		ob.style.backgroundColor = '#FFB7BE';
		setTimeout(function () { ob.focus() }, 1);
		return false;
	}
	return true;
}

// Open dialog to allow user to set up secondary/tertiary email for their REDCap account
function setUpAdditionalEmails() {
	// First, load a dialog via ajax
	$.post(app_path_webroot+'Profile/set_up_emails.php',{ action: 'view' },function(data){
		var json_data = jQuery.parseJSON(data);
		initDialog('setUpAdditionalEmails');
		$('#setUpAdditionalEmails').addClass('simpleDialog').html(json_data.popupContent);
		$('#setUpAdditionalEmails').dialog({ bgiframe: true, modal: true, width: 600, title: json_data.popupTitle, buttons: [
			{ text: 'Cancel',click: function(){
				$(this).dialog('destroy');
			}},
			{ text: json_data.saveBtnTxt, click: function(){
				$('#setUpAdditionalEmails').parent().find('.ui-dialog-buttonpane button').button("disable");
				saveAdditionalEmails();
			}}
		] });
		$('#setUpAdditionalEmails').parent().find('.ui-dialog-buttonpane button').button("enable");
	});
}

// Save secondary/tertiary email for their REDCap account
function saveAdditionalEmails() {
	// Get new email value
	var new_email = $('#add_new_email').val();
	// Make sure it has a value
	if (new_email == '') {
		simpleDialog("Please enter a new email address");
		return false;
	}
	// Validate that emails match
	if (!validateEmailMatch('add_new_email','add_new_email_dup')) {
		return false;
	}
	// Make sure this email isn't the same as existing ones for this user
	if ($('#existing_user_email').val() == new_email || ($('#existing_user_email2').val() != '' && $('#existing_user_email2').val() == new_email)
		|| ($('#existing_user_email3').val() != '' && $('#existing_user_email3').val() == new_email)) {
		simpleDialog("The new email address that you entered is an email already associated with this account. Please enter another email address if you would still like to add one.");
		return false;
	}
	// Save data via ajax
	$.post(app_path_webroot+'Profile/set_up_emails.php',{ action: 'save', add_new_email: new_email },function(data){
		var json_data = jQuery.parseJSON(data);
		if (json_data.response != '1') { alert(woops); return false; }
		simpleDialog(json_data.popupContent,json_data.popupTitle,null,600);
		if ($('#setUpAdditionalEmails').hasClass('ui-dialog-content')) $('#setUpAdditionalEmails').dialog('destroy');
	});
}

// Remove user's secondary or tertiary email from their account
function removeAdditionalEmail(email_account) {
	// Place email address in span/divs in dialog
	var email = $('#user_email'+email_account+'-span').html();
	$('#user-email-dialog').html(email);
	// Open dialog
	$('#removeAdditionalEmail').dialog({ bgiframe: true, modal: true, width: 600, buttons: [
		{ text: 'Cancel',click: function(){
			$(this).dialog('destroy');
		}},
		{ text: 'Remove', click: function(){
			// Remove email from account via ajax
			$.post(app_path_webroot+'Profile/additional_email_remove.php',{ email_account: email_account },function(data){
				if (data=='1') {
					$('#removeAdditionalEmail').dialog('destroy');
					simpleDialog("The email address has now been removed from your REDCap account. The page will now reload to reflect the changes.","Email removed!",null,null,"window.location.reload();");
				} else {
					alert(woops);
				}
			});
		}}
	] });
}

// Validation that 2 email fields match (when forcing user to re-enter email)
function validateEmailMatch(email1id,email2id) {
	$('#'+email1id).val( trim($('#'+email1id).val()) );
	$('#'+email2id).val( trim($('#'+email2id).val()) );
	if ($('#'+email1id).val().length > 0 && $('#'+email1id).val() != $('#'+email2id).val()) {
		// Display error dialog and put focus back on second field
		simpleDialog("The re-entered email address did not match the first. Please re-enter your email address.",null,null,null,"$('#"+email2id+"').focus();");
		return false;
	}
	return true;
}

// Test if string is a valid domain name (i.e. domain from a URL)
function isDomainName(domain) {
	// Set regex to be used to validate the domain
	var dwRegex = /^([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i;
	// Return boolean
	return dwRegex.test(trim(domain));
}

// Check if an email address is acceptable regarding the "domain whitelist for user emails" (if enabled)
function emailInDomainWhitelist(ob,displayErrorMsg) {
	if (email_domain_whitelist.length > 0) {
		var thisEmail = trim($(ob).val());
		if (thisEmail.length < 1) return null;
		if (displayErrorMsg == null) displayErrorMsg = true;
		var thisEmailParts = thisEmail.split('@');
		var thisEmailDomain = thisEmailParts[1].toLowerCase();
		if (!in_array(thisEmailDomain, email_domain_whitelist)) {
			if (displayErrorMsg) {
				var id = $(ob).attr('id');
				var focusJS = (id == null) ? null : "$('#"+id+"').focus();";
				simpleDialog('The domain of the email entered is invalid. (The domain name is the part of the email address after the ampersand.) '
							+'The only acceptable domain names for email addresses are the ones listed below. You may only enter an email that ends '
							+'in one of these domain names. Please try another email address.<br><br>Acceptable domains:<br><b>'
							+email_domain_whitelist.join('<br>')+'</b>','"'+thisEmailDomain+'" is not an acceptable domain name for emails',null,550,focusJS);
			}
			return false;
		} else {
			return true;
		}
	}
	// Return null if domain whitelist not enabled
	return null;
}

// Add/edit/delete a template project
function projectTemplateAction(action,project_id) {
	// Check project_id
	if (project_id == null) project_id = '';
	// Set action button text and action, as well as title/description values
	var hideChooseAnother = 0;
	var cancelBtn  = "Close";
	var cancelAction = "window.location.reload();";
	var actionBtn  = null;
	var actionSave = null;
	var title = '';
	var description = '';
	var enabled = '0';
	if (action == 'prompt_delete' || action == 'prompt_addedit') {
		cancelBtn  = "Cancel";
		cancelAction = null;
		// Set flag to hide the "choose another project" when accessing this from inside a project
		if (action == 'prompt_addedit' && project_id != '' && page == 'index.php') {
			hideChooseAnother = 1;
		}
		if (action == 'prompt_addedit' && project_id == '') {
			// Choosing project to add, so don't show Save button
			actionBtn = actionSave = null;
		} else {
			// Set secondary button text and action
			actionBtn = (action == 'prompt_delete') ? "Remove" : "Save";
			actionSave = (action == 'prompt_delete') ? "projectTemplateAction('delete',"+project_id+")" : "projectTemplateAction('addedit',"+project_id+")";
		}
	} else if (action == 'addedit') {
		title = $('#projTemplateTitle').val();
		description = $('#projTemplateDescription').val();
		enabled = $('input[name="projTemplateEnabled"]:checked').val();
	}
	// Remove dialog if already exists
	if (!$('#projTemplateDialog').length) initDialog('projTemplateDialog');
	// Perform action via ajax
	$.post(app_path_webroot+'ControlCenter/project_templates_ajax.php',{ enabled: enabled, action: action, project_id: project_id, title: title, description: description, hideChooseAnother: hideChooseAnother },function(data){
		if (data=='0'){alert(woops);return;}
		var json_data = jQuery.parseJSON(data);
		simpleDialog(json_data.content,json_data.title,'projTemplateDialog',null,cancelAction,cancelBtn,actionSave,actionBtn);
	});
}

// Do quick check if logic errors exist in string (not very extensive)
// - used for both Data Quality and Automated Survey Invitations
function checkLogicErrors(brStr,display_alert,forceEventNotationForLongitudinal) {
	var brErr = false;
	if (display_alert == null) display_alert = false;
	// If forceEventNotationForLongitudinal=true, then make sure that field_names are preceded with [event_name] for longitudinal projects
	if (forceEventNotationForLongitudinal == null) forceEventNotationForLongitudinal = false;
	var msg = "<b>ERROR! Syntax errors exist in the logic:</b><br>"
	if ((typeof brStr != "undefined") && (brStr.length > 0)) {
		// Must have at least one [ or ]
		// if (brStr.split("[").length == 1 || brStr.split("]").length == 1) {
			// msg += "&bull; Square brackets are missing. You have either not included any variable names in the logic or you have forgotten to put square brackets around the variable names.<br>";
			// brErr = true;
		// }
		// If longitudinal and forcing event notation for fields, then must be referencing events for variable names
		if (longitudinal && forceEventNotationForLongitudinal && (brStr.split("][").length <= 1
			|| (brStr.split("][").length-1)*2 != (brStr.split("[").length-1)
			|| (brStr.split("][").length-1)*2 != (brStr.split("]").length-1))) {
			msg += "&bull; One or more fields are not referenced by event. Since this is a longitudinal project, you must specify the unique event name "
				 + "when referencing a field in the logic. For example, instead of using [age], you must use [enrollment_arm1][age], "
				 + "assuming that enrollment_arm1 is a valid unique event name in your project. You can find a list of all your project's "
				 + "unique event names on the Define My Events page.<br>";
			brErr = true;
		}
		// Check symmetry of "
		if ((brStr.split('"').length - 1)%2 > 0) {
			msg += "&bull; Odd number of double quotes exist<br>";
			brErr = true;
		}
		// Check symmetry of '
		if ((brStr.split("'").length - 1)%2 > 0) {
			msg += "&bull; Odd number of single quotes exist<br>";
			brErr = true;
		}
		// Check symmetry of [ with ]
		if (brStr.split("[").length != brStr.split("]").length) {
			msg += "&bull; Square bracket is missing<br>";
			brErr = true;
		}
		// Check symmetry of ( with )
		if (brStr.split("(").length != brStr.split(")").length) {
			msg += "&bull; Parenthesis is missing<br>";
			brErr = true;
		}
		// Make sure does not contain $ dollar signs
		if (brStr.indexOf('$') > -1) {
			msg += "&bull; Illegal use of dollar sign ($). Please remove.<br>";
			brErr = true;
		}
		// Make sure does not contain ` backtick character
		if (brStr.indexOf('`') > -1) {
			msg += "&bull; Illegal use of backtick character (`). Please remove.<br>";
			brErr = true;
		}
	}
	// If errors exist, stop and show message
	if (brErr && display_alert) {
		simpleDialog(msg+"<br>You must fix all errors listed before you can save this logic.");
		return true;
	}
	return brErr;
}

// Save a new value for a config setting (super users only)
function setConfigVal(settingName,value,reloadPage) {
	$.post(app_path_webroot+'ControlCenter/set_config_val.php',{ settingName: settingName, value: value },function(data){
		if (data == '1') {
			alert("The setting has been successfully saved!");
			if (reloadPage != null && reloadPage) {
				window.location.reload();
			}
		} else {
			alert(woops);
		}
	});
}

// Send single email
function sendSingleEmail(from,to,subject,message,showDialogSuccess,evalJs) {
	if (evalJs == null) evalJs = '';
	if (showDialogSuccess == null) showDialogSuccess = false;
	var this_pid = getParameterByName('pid');
	var url_pid = (isNumeric(this_pid)) ? '?pid='+this_pid : ''; // If within a project, send project_id
	$.post(app_path_webroot+'ProjectGeneral/send_single_email.php'+url_pid,{from:from,to:to,subject:subject,message:message},function(data){
		if (data != '1') {
			alert(woops);
		} else {
			if (showDialogSuccess) simpleDialog("Your email was successfully sent to <a style='text-decoration:underline;' href='mailto:"+to+"'>"+to+"</a>.","EMAIL SENT!");
			if (evalJs != '') eval(evalJs);
		}
	});
}

// Equivalent to PHP's basename function
function basename(path) {
    return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

// Equivalent to PHP's dirname function
function dirname(path) {
    return path.replace(/\\/g,'/').replace(/\/[^\/]*$/, '');
}

// Display Piping explanation dialog pop-up
function pipingExplanation() {
	// Get content via ajax
	$.get(app_path_webroot+'DataEntry/piping_explanation.php',{},function(data){
		var json_data = jQuery.parseJSON(data);
		simpleDialog(json_data.content,json_data.title,'piping_explain_popup',800);
		fitDialog($('#piping_explain_popup'));
	});
}

// Enable fixed table headers for event grid
function enableFixedTableHdrs(table_id,floatFirstRow,floatFirstCol,forceFixedHdrs) {
	// Set params
	if (floatFirstRow == null) floatFirstRow = true;
	if (floatFirstCol == null) floatFirstCol = true;
	if (forceFixedHdrs == null) forceFixedHdrs = false;
	// Check height and width of table to see if we should even try to enable floating
	var window_width = $(window).width();
	var table_width  = $('#'+table_id).width();
	floatFirstCol = (floatFirstCol && table_width  > window_width);
	floatFirstRow = (floatFirstRow && $('#'+table_id).height() > $(window).height());
	
	/* 
	if (!floatFirstCol && !floatFirstRow) return;
	$('#'+table_id).DataTable({
		"autoWidth": false,
		"processing": true,
		"paging": false,
		"info": false,
		"aaSorting": [],
		"fixedHeader": { header: true, footer: false },
		// "fixedColumns": (floatFirstCol ? { leftColumns: 1, heightMatch: 'auto' } : false),		
		// scrollY: (floatFirstCol ? ($(window).height()-200)+"px" : false),
        // scrollX: floatFirstCol,	
		// Configurable
		"searching": true,
		"ordering": true
	});
	return;
	 */
	
	// Set max columns for auto-enable
	var maxColsAutoEnable = 25;
	// Set div class for the clone table div
	var cloneClassRow = 'div.FixedHeader_Header';
	var cloneClassCol = 'div.FixedHeader_Left';
	var clondClassLeftHead = 'div.FixedHeader_LeftHead';
	// Enable if table will scroll AND not IE6 or IE7
	if (!isIE6 && !isIE7 && (floatFirstCol || floatFirstRow)) {
		// If more than X columns, then don't turn on automatically but put an option above table for user to choose to enable the fixed headers
		if (!forceFixedHdrs && $('#'+table_id+' thead tr th').length > maxColsAutoEnable) {
			// If button to force enable exists and is disabled, then stop here
			if ($('#FixedTableHdrsEnable').length && $('#FixedTableHdrsEnable').prop('disabled')) return;
			// Create new span on the page
			$('body').append('<button id="FixedTableHdrsEnable" class="jqbuttonsm" onclick="$(this).button(\'disable\');showProgress(1,50);setTimeout(function(){ enableFixedTableHdrs(\''+table_id+'\',\''+floatFirstRow+'\',\''+floatFirstCol+'\',true);showProgress(0,100); },100);">Enable floating table headers</button>');
			// Position the span
			var table_pos = $('#'+table_id).position();
			var span_pos_top  = (table_pos.top-$('#FixedTableHdrsEnable').outerHeight(true)-5);
			var span_pos_left = (window_width-$('#FixedTableHdrsEnable').outerWidth(true)-15);
			// Display the span
			$('#FixedTableHdrsEnable').show().css({'top': span_pos_top+'px', 'left': span_pos_left+'px'}).button();
			return;
		}
		// Wait a little bit (issues with some browsers when initially loading page)
		setTimeout(function(){
			// If function is re-run, then remove previous floating headers
			$(cloneClassRow).remove();
			$(cloneClassCol).remove();
			$(clondClassLeftHead).remove();
			// Set fixed headers for table
			new FixedHeader( document.getElementById(table_id), {"left": floatFirstCol, "top": floatFirstRow});
			// If floating the first column, then perform extra adjustments
			if (floatFirstRow) {
				// Set table widths to be the same
				$('#'+table_id).css({'width': table_width+'px'});
				$(cloneClassRow+' table:first').css({'width': table_width+'px'});
				// Loop through each header cell in first row
				var eq = 0;
				$('#'+table_id+' thead tr th').each(function(){
					var thisHdrCell = $(this);
					var hw = thisHdrCell.css('width');
					var hh = thisHdrCell.css('height');
					// Manually set the original table's cell width first
					thisHdrCell.css({'height': hh, 'width': hw});
					// Now set the same height/width for its clone
					$(cloneClassRow+' table:first').find('thead tr th').eq(eq).css({'height': hh, 'width': hw});
					eq++;
				});
			}
			// If floating the first column, then perform extra adjustments
			if (floatFirstCol) {
				// Header: Make some height adjustments because FixedHeader doesn't do it quite correctly in all browsers
				var thdr = $('#'+table_id+' tr th:first');
				var hw = thdr.css('width');
				var hh = thdr.css('height');
				thdr.css({'height': hh, 'width': hw});
				$(cloneClassCol+' table tr th:first').css({'height': hh, 'width': hw});
				// First column in all rows: Make some height adjustments because FixedHeader doesn't do it quite correctly in all browsers
				var eq = 0;
				$('#'+table_id+' tbody tr').each(function(){
					var firstcell = $(this).children('td:first');
					var firstcellclone = $(cloneClassCol+' table tbody tr').eq(eq);
					var tw = firstcell.css('width');
					var th = firstcell.css('height');
					firstcell.css({'height': th, 'width': tw});
					firstcellclone.children('td:first').css({'height': th, 'width': tw});
					firstcellclone.css({'height': $(this).css('height')});
					eq++;
				});
			}
		},50);
	}
}

// Equivalent of htmlspecialchars() in PHP
function htmlspecialchars(text) {
  return text
      .replace(/&/g, "&amp;")
      .replace(/</g, "&lt;")
      .replace(/>/g, "&gt;")
      .replace(/"/g, "&quot;")
      .replace(/'/g, "&#039;");
}

// Determine if an element is viewable within the current viewport of the web browser
function elementInViewport(el) {
	var top = el.offsetTop;
	var left = el.offsetLeft;
	var width = el.offsetWidth;
	var height = el.offsetHeight;
	while(el.offsetParent) {
		el = el.offsetParent;
		top += el.offsetTop;
		left += el.offsetLeft;
	}
	return (
		top >= window.pageYOffset &&
		left >= window.pageXOffset &&
		(top + height) <= (window.pageYOffset + window.innerHeight) &&
		(left + width) <= (window.pageXOffset + window.innerWidth)
	);
}

// My Projects table: Get records/fields/instruments counts via ajax
function getRecordOrFieldCountsMyProjects(thistype, theseVisiblePids) {
	// Get projects counts via ajax
	$.post(app_path_webroot+'ProjectGeneral/project_stats_ajax.php',{ type: thistype, pids: theseVisiblePids }, function(data){
		if (data != '0') {
			// Parse JSON
			var json = jQuery.parseJSON(data);
			// Loop through each project
			if (thistype == 'records') {
				// RECORDS
				for (var this_pid in json) {
					$('.pid-cntr-'+this_pid).html( json[this_pid]['r'] );
				}
				// Get list of more pid's to process
				var nextVisiblePids = json.next_pids;
				if (nextVisiblePids.length > 0) {
					// DO MORE
					getRecordOrFieldCountsMyProjects('records', nextVisiblePids);
				}
			} else if (thistype == 'fields') {
				// FIELDS/INSTRUMENTS
				for (var this_pid in json) {
					$('.pid-cntf-'+this_pid).html( json[this_pid]['f'] );
					$('.pid-cnti-'+this_pid).html( json[this_pid]['i'] );
				}
			}
		}
	});
}

// Display DDP explanation dialog
function ddpExplainDialog() {
	initDialog('ddpExplainDialog');
	var dialogHtml = $('#ddpExplainDialog').html();
	if (dialogHtml.length > 0) {
		$('#ddpExplainDialog').dialog('open');
	} else {
		$.get(app_path_webroot+'DynamicDataPull/info.php',{ },function(data) {
			var json_data = jQuery.parseJSON(data);
			$('#ddpExplainDialog').html(json_data.content).dialog({ bgiframe: true, modal: true, width: 750, title: json_data.title,
				open: function(){ fitDialog(this); },
				buttons: {
					Close: function() { $(this).dialog('close'); }
				}
			});
		});
	}
}

// Initialize a "fake" drop-down list (like a button to reveal a "drop-down" list)
function showBtnDropdownList(ob,event,list_div_id) {
	// Prevent $(window).click() from hiding this
	try {
		event.stopPropagation();
	} catch(err) {
		window.event.cancelBubble=true;
	}
	// Set drop-down div object
	var ddDiv = $('#'+list_div_id);
	// If drop-down is already visible, then hide it and stop here
	if (ddDiv.css('display') != 'none') {
		ddDiv.hide();
		return;
	}
	// Set width
	if (ddDiv.css('display') != 'none') {
		var ebtnw = $(ob).width();
		var eddw  = ddDiv.width();
		if (eddw < ebtnw) ddDiv.width( ebtnw );
	}
	// Set position
	var btnPos = $(ob).offset();
	ddDiv.show().offset({ left: btnPos.left, top: (btnPos.top+$(ob).outerHeight()) });
}

// Matrix field ranking validation function
function matrix_rank(crnt_val,crnt_var,grid_vars) {
    // Reset validation flag on page
    $('#field_validation_error_state').val('0');
    // array of all field_names within matrix group
    // gv[0]=>'w1',gv[1]=>'w2',gv[2]=>'w3',...
    var grid_vars = grid_vars.split(',');
    var id, i, crnt_var_position;
	var rank_remove_label = $('#matrix_rank_remove_label');
	var remove_label_time = 2500;
    // loop through other variables within this matrix group
    for (i = 0; i < grid_vars.length; i++) {
        if (crnt_var !== grid_vars[i]) {
            id = "mtxopt-"+grid_vars[i]+"_"+crnt_val;
			id = id.replace(/\./g,'\\.');
            if ($("#"+id).is(":checked")) {
				// Uncheck the input
				radioResetVal(grid_vars[i],'form');
				// Add temporary "value removed" label
				crnt_var_position = $("#"+id).position();
				rank_remove_label.css({'left': (crnt_var_position.left-30)+'px', 'top': (crnt_var_position.top)+'px'}).show();
				setTimeout(function(){
					rank_remove_label.hide();
				},remove_label_time);
            }
        }
    }
}

// On data export page, display/hide the Send-It option for each export type
function displaySendItExportFile(doc_id) {
	$('#sendit_'+doc_id+' div').each(function(){
		if ($(this).css('visibility') == 'hidden') $(this).hide();
	});
	$('#sendit_'+doc_id).toggle('blind',{},'fast');
}

// Get case insensitive string position just like PHP's stripos
function stripos(f_haystack, f_needle, f_offset) {
  //  discuss at: http://phpjs.org/functions/stripos/
  // original by: Martijn Wieringa
  //  revised by: Onno Marsman
  //   example 1: stripos('ABC', 'a');
  //   returns 1: 0
  var haystack = (f_haystack + '')
    .toLowerCase();
  var needle = (f_needle + '')
    .toLowerCase();
  var index = 0;
  if ((index = haystack.indexOf(needle, f_offset)) !== -1) {
    return index;
  }
  return false;
}

// Reverse a string just like PHP's strrev
function strrev(s){
    return s.split("").reverse().join("");
}

// Performs a case insensitive match of a substring in a string (used in logic)
function contains(haystack, needle) {
	return (stripos(haystack, needle) !== false);
}

// Performs a case insensitive match of a substring in a string if NOT MATCHED (used in logic)
function not_contain(haystack, needle) {
	return (stripos(haystack, needle) === false);
}

// Checks if string begins with a substring - case insensitive match (used in logic)
function starts_with(haystack, needle) {
    return (needle === "" || stripos(haystack, needle) === 0);
}

// Checks if string ends with a substring - case insensitive match (used in logic)
function ends_with(haystack, needle) {
    return starts_with(strrev(haystack), strrev(needle));
}

// Generate a survey Quick code and QR code and open dialog window
function getAccessCode(hash,shortCode) {
	// Id of dialog
	var dlgid = 'genQSC_dialog';
	// Get short code?
	if (shortCode != '1') shortCode = 0;
	// Show progres icon for short code generation
	if (shortCode) $('#gen_short_access_code_img').show();
	// Get content via ajax
	$.post(app_path_webroot+'Surveys/get_access_code.php?pid='+pid+'&hash='+hash+'&shortCode='+shortCode,{ }, function(data){
		if (data == "0") {
			alert(woops);
			return;
		}
		// Decode JSON
		var json_data = jQuery.parseJSON(data);
		// Put short code in input box
		if (shortCode) {
			$('#short_access_code_expire').html(json_data.expiration);
			$('#short_access_code').val(json_data.code);
			$('#short_access_code_div').show().effect('highlight',{},2000);
			$('#gen_short_access_code_div').hide();
		} else {
			// Add html
			initDialog(dlgid);
			$('#'+dlgid).html(json_data.content);
			// If QR codes are not being displayed, then make the dialog less wide
			var dwidth = ($('#'+dlgid+' #qrcode-info').length) ? 800 : 600;
			// Display dialog
			$('#'+dlgid).dialog({ title: json_data.title, bgiframe: true, modal: true, width: dwidth, open:function(){ fitDialog(this); }, close:function(){ $(this).dialog('destroy'); },
				buttons: [{
					text: "Close", click: function(){ $(this).dialog('close'); }
				}, {
					text: "Print for Respondent", click: function(){
						window.open(app_path_webroot+'ProjectGeneral/print_page.php?pid='+pid+'&action=accesscode&hash='+hash,'myWin','width=850, height=600, toolbar=0, menubar=1, location=0, status=0, scrollbars=1, resizable=1');
					}
				}]
			});
			$('#'+dlgid).parent().find('div.ui-dialog-buttonpane button:eq(1)').css({'font-weight':'bold','color':'#222'});
			// Init buttons
			initButtonWidgets();
		}
	});
}

// Validate the surveys reminders options
function validateSurveyRemindersOptions() {
	// If not using reminders, return true to skip it
	if (!$('#enable_reminders_chk').prop('checked')) return true;
	// Is reminder option chosen?
	var reminder_type = $('#reminders_choices_div input[name="reminder_type"]:checked').val();
	if ((reminder_type == 'NEXT_OCCURRENCE' && ($('#reminders_choices_div select[name="reminder_nextday_type"]').val() == ''
			|| $('#reminders_choices_div input[name="reminder_nexttime"]').val() == ''))
		|| (reminder_type == 'TIME_LAG' && $('#reminders_choices_div input[name="reminder_timelag_days"]').val() == ''
			 && $('#reminders_choices_div input[name="reminder_timelag_hours"]').val() == ''
			 && $('#reminders_choices_div input[name="reminder_timelag_minutes"]').val() == '')
		|| (reminder_type == 'EXACT_TIME' && $('#reminders_choices_div input[name="reminder_exact_time"]').val() == '')
		|| reminder_type == null)
	{
		// Get fieldset title
		var reminder_title = $('#reminders_choices_div').parents('fieldset:first').find('legend:first').html();
		// Display error msg
		simpleDialog("<div style='color:#C00000;font-size:13px;'><img src='"+app_path_images+"exclamation.png'> ERROR: If you are enabling reminders, please make sure all reminder choices are selected. One or more options are not entered/selected.</div>", reminder_title, null, 400);
		return false;
	}
	return true;
}

// Survey Reminder related setup
function initSurveyReminderSettings() {
	// Option up reminder options
	$('#enable_reminders_chk').click(function(){
		if ($(this).prop('checked')) {
			$('#reminders_text1').show();
			$('#reminders_choices_div').show('fade',function(){
				// Try to reposition each dialog (depending on which page we're on)
				if ($('#emailPart').length) {
					fitDialog($('#emailPart'));
					$('#emailPart').dialog('option','position','center');
				}
				if ($('#popupSetUpCondInvites').length) {
					fitDialog($('#popupSetUpCondInvites'));
					$('#popupSetUpCondInvites').dialog('option','position','center');
				}
				if ($('#inviteFollowupSurvey').length) {
					fitDialog($('#inviteFollowupSurvey'));
					$('#inviteFollowupSurvey').dialog('option','position','center');
				}
			});
		} else {
			$('#reminders_text1').hide();
			$('#reminders_choices_div').hide('fade',{ },200);
		}
	});
	// Disable recurrence option if using exact time reminder
	$('#reminders_choices_div input[name="reminder_type"]').change(function(){
		if ($(this).val() == 'EXACT_TIME') {
			$('#reminders_choices_div select[name="reminder_num"]').val('1').prop('disabled', true);
		} else {
			$('#reminders_choices_div select[name="reminder_num"]').prop('disabled', false);
		}
	});
	// Enable exact time reminder's datetime picker
	$('#reminders_choices_div .reminderdt').datetimepicker({
		onClose: function(dateText, inst){ $('#'+$(inst).attr('id')).blur(); },
		buttonText: 'Click to select a date', yearRange: '-100:+10', changeMonth: true, changeYear: true, dateFormat: user_date_format_jquery,
		hour: currentTime('h'), minute: currentTime('m'), buttonText: 'Click to select a date/time',
		showOn: 'button', buttonImage: app_path_images+'datetime.png', buttonImageOnly: true, timeFormat: 'hh:mm', constrainInput: false
	});
}

// Display explanation dialog for survey participant's invitation delivery preference
function deliveryPrefExplain() {
	// Get content via ajax
	$.get(app_path_webroot+'Surveys/delivery_preference_explain.php',{ pid: pid }, function(data){
		if (data == "") {
			alert(woops);
		} else {
			// Decode JSON
			var json_data = jQuery.parseJSON(data);
			simpleDialog(json_data.content, json_data.title, null, 600);
		}
	});
}

// Escape HTML (similar to PHP's htmlspecialchars)
function escapeHtml(text) {
	var map = {
		'&': '&amp;',
		'<': '&lt;',
		'>': '&gt;',
		'"': '&quot;',
		"'": '&#039;'
	};
	return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

// Get iOS version
function iOSversion() {
    if (/iP(hone|od|ad)/.test(navigator.platform)) {
        var v = (navigator.appVersion).match(/OS (\d+)_(\d+)_?(\d+)?/);
        // return [parseInt(v[1], 10), parseInt(v[2], 10), parseInt(v[3] || 0, 10)];
        return parseInt(v[1], 10);
    }
	return false;
}

// AJAX call to request API token from admin
function requestToken() {
	$.post(app_path_webroot +'API/project_api_ajax.php?pid='+pid,{ action: 'requestToken' },function (data) {
		if (super_user || AUTOMATE_ALL == '1') {
			window.location.reload();
		} else {
			$('.chklistbtn .jqbuttonmed, .yellow .jqbuttonmed').prop('disabled', true)
			  .addClass('api-req-pending')
			  .css('color','grey');
			$('.api-req-pending').parent().append('<p class="api-req-pending-text">Request pending</p>');
			simpleDialog(data);
			if($('.mobile-token-alert-text').length != 0){
			  $('.mobile-token-alert-text').remove();
			}else{
			  $('.chklistbtn .api-req-pending').text('Request Api token');
			  $('api-req-pending span, .mobile-token-alert-text').remove();
			}
		}
	});
}

// AJAX call to delete API token
function deleteToken() {
	$.post(app_path_webroot + "API/project_api_ajax.php?pid="+pid,{ action: "deleteToken" },function (data) {
		simpleDialog(data,null,null,400,function(){
			if (page == 'MobileApp/index.php') {
				window.location.reload();
			}
		});
		$.get(app_path_webroot + "API/project_api_ajax.php",{ action: 'getToken', pid: pid },function(data) {
			if (page != 'MobileApp/index.php') {
				if (data.length == 0) {
					$("#apiReqBoxId").show();
					$("#apiTokenBoxId").hide();
					$("#apiTokenId, #apiTokenUsersId").html("");
				} else {
					$("#apiTokenId").html(data);
				}
			}
		});
	});
}

// AJAX call to regenerate API token
function regenerateToken() {
	$.post(app_path_webroot + "API/project_api_ajax.php?pid="+pid,{ action: "regenToken" },function (data) {
		simpleDialog(data);
		$.get(app_path_webroot + "API/project_api_ajax.php",{ action: 'getToken', pid: pid },function(data) {
			$("#apiTokenId").html(data);
		});
	});
}

// Get the "export field name" for a checkbox
function getExtendedCheckboxFieldname(field_name, raw_coded_value) {
    return field_name + '___' + raw_coded_value.toLowerCase().replace(/-/g,'_').replace(/[^a-z_0-9]/g,'');
}

// Action Tags: Function that is run on forms and surveys to perform actions based on tags in the Field Annotation text
function triggerActionTags() {
	// Is this a survey page?
	var isSurvey = (page == 'surveys/index.php');

	// Note: @HIDDEN tags are handled via CSS and also inside doBranching()
	// on forms/surveys, so we don't need to force them to be hidden here.

	// DISABLES ANY FIELD THAT CONTAINS @READONLY
	// Disable survey and form
	$("#questiontable tr.\\@READONLY").disableRowActionTag();
	// Disable surveyonly
	if (isSurvey) $("#questiontable tr.\\@READONLY-SURVEY").disableRowActionTag();
	// Disable formonly
	else $("#questiontable tr.\\@READONLY-FORM").disableRowActionTag();
}

// Hide row via @HIDDEN action tag
function triggerActionTagsHidden(isSurvey) {
	// Note: This is already done by CSS, but this is in case branching logic tries to reveal it.
	// Hide survey and form
	$("#questiontable tr.\\@HIDDEN").hide();
	// Hide surveyonly
	if (isSurvey) $("#questiontable tr.\\@HIDDEN-SURVEY").hide();
	// Hide formonly
	else $("#questiontable tr.\\@HIDDEN-FORM").hide();
}

// Disable row via @READONLY action tag
(function ( $ ) {
    $.fn.disableRowActionTag = function() {
		var tr = this;
		if (tr.length < 1) return;
		// Disable all inputs row, trigger blur (to update any piping), and gray out whole row
		$('input, select, textarea', tr).prop("disabled", true);
		// Disable buttons and all text links (ignore images surrounded by links, we just want text links)
		$('a:not(a:has(img))', tr).attr('href', 'javascript:;').attr('onclick', 'return false;').attr('onfocus', '');
		$('button, .ui-datepicker-trigger', tr).hide();
		// Disable sliders
		$("[id^=sldrmsg-]", tr).css('visibility','hidden');
		$("[id^=slider-]", tr).attr('onmousedown', '').slider("disable");
		setTimeout(function(){ $("[id^=slider-]", tr).slider("disable"); },100);
		setTimeout(function(){ $("[id^=slider-]", tr).slider("disable"); },1000);
    };
}( jQuery ));

// Toggle displaying the Twilio Auth Token (for security)
function showTwilioAuthToken(input_name) {
	$('input[name="'+input_name+'"]').clone().attr('type','text').attr('size','60').width(260).insertAfter('input[name="'+input_name+'"]').prev().remove();
}

// Add or remove a password mask from a text input field
// Object "ob" should be passed to the function as the jQuery object of the input field.
// Boolean "add", in which false=remove password mask.
function passwordMask(ob, add) {
	// Remove any date/time picker widgets from input
	try { ob.datepicker('destroy'); }catch(e){ }
	try { ob.datetimepicker('destroy'); }catch(e){ }
	try { ob.timepicker('destroy'); }catch(e){ }
	ob.removeClass('hasDatepicker').unbind();
	// Clone input field and replace it
	ob.clone().attr('type', (add ? 'text' : 'password')).insertAfter(ob);
	ob.remove();
	// Reactivate any widgets whose connection to object gets lost with cloning
	initWidgets();
}

// Load ajax call into dialog to analyze a survey for use as SMS/Voice Call survey
function dialogTwilioAnalyzeSurveys() {
	$.post(app_path_webroot+'Surveys/twilio_analyze_surveys.php?pid='+pid, { }, function(data){
		var json_data = jQuery.parseJSON(data);
		if (json_data.length < 1) {
			alert(woops);
			return false;
		}
		var dlg_id = 'tas_dlg';
		$('#'+dlg_id).remove();
		initDialog(dlg_id);
		$('#'+dlg_id).html(json_data.popupContent);
		simpleDialog(null,json_data.popupTitle,dlg_id,700);
	});
}

// Report REDCap stats via direct AJAX call
function reportStatsAjax(stats_reporting_url_string, show_cc_confirm_msg) {
	if (show_cc_confirm_msg == null) show_cc_confirm_msg = false;
	if (show_cc_confirm_msg) showProgress(1);
	// Ajax call to report stats
	var thisAjax = $.ajax({ type: 'GET', crossDomain: true, url: stats_reporting_url_string,
		success: function(data) {
			if (data != '1') {
				// Ajax method failed so try server-side
				reportStatsServerSide(show_cc_confirm_msg);
			} else {
				// Save date for auto_report_stats_last_sent, and obtain JSON for library stats to send next
				$.get(app_path_webroot+'ControlCenter/report_site_stats.php?report_library_stats=1',{ },function(data){
					// Parse the shared library params and url
					var json_data = $.parseJSON(data);
					// Now report Shared Library stats
					$.ajax({ type: 'POST', crossDomain: true, url: json_data.url, data: json_data.params, success: function(data) {
						// Obtain pub matching stats to send
						$.get(app_path_webroot+'ControlCenter/report_site_stats.php?report_pub_matching_stats=1',{ },function(data){
							// If Pub Matching not enabled, then stop
							if (data == '0') {
								if (show_cc_confirm_msg) {
									window.location.href = app_path_webroot + "ControlCenter/index.php?sentstats=1";
								}
								showProgress(0,0);
								return;
							}
							// Parse the pub matching params and url
							var json_data = $.parseJSON(data);
							// Now report Pub Matching stats
							$.ajax({ type: 'POST', crossDomain: true, url: json_data.url, data: json_data.params, success: function(data) {
								if (show_cc_confirm_msg) {
									window.location.href = app_path_webroot + "ControlCenter/index.php?sentstats=1";
								}
								showProgress(0,0);
								return;
							}});
						});

					}});
				});
			}
		},
		error: function(e) {
			// Ajax method failed so try server-side
			reportStatsServerSide(show_cc_confirm_msg);
		}
	});
	// If Ajax call does not return after X seconds, then try server-side
	var maxAjaxTime = 3; // seconds
	setTimeout(function(){
		if (thisAjax.readyState == 1) {
			// Abort, which will trigger ajax error
			thisAjax.abort();
		}
	},maxAjaxTime*1000);
}

// Report REDCap stats via server-side method if direct cross-domain ajax call fails
function reportStatsServerSide(show_cc_confirm_msg) {
	$.get(app_path_webroot+'ControlCenter/report_site_stats.php',{ },function(data) {
		showProgress(0,0);
		if (show_cc_confirm_msg) {
			window.location.href = app_path_webroot + "ControlCenter/index.php?sentstats="+(data == '1' ? '1' : 'fail');
		}
	});
}

// Change default behavior of the multi-select boxes so that they are more intuitive to users when selecting/de-selecting options
function modifyMultiSelect(multiselect_jquery_object, option_css_class) {
	if (option_css_class == null) option_css_class = 'ms-selection';
	// Add classes to options in case some are already pre-selected on page load
	multiselect_jquery_object.find('option:selected').addClass(option_css_class);
	// Set click trigger to add class to whichever option is clicked and then manually select it
	multiselect_jquery_object.click(function(event){
		var obparent = $(this);
		var ob = obparent.find('option[value="'+event.target.value+'"]');
		if (!ob.hasClass(option_css_class)) {
			ob.addClass(option_css_class);
		} else {
			ob.removeClass(option_css_class);
		}
		$('option:not(.'+option_css_class+')', obparent).prop('selected', false);
		$('option.'+option_css_class, obparent).prop('selected', true);
	});
}

// Open dialog with embedded video
function openEmbedVideoDlg(video_url,unknown_video_service,field_name) {
	var dlgid = 'rc-embed-video-dlg_'+field_name;
	var vidid = 'rc-embed-video_'+field_name;
	var vidwidth = 750;
	var vidheight = 500;
	if (unknown_video_service) {
		var rc_embed_html = '<embed id="'+vidid+'" src="'+video_url+'" width="'+vidwidth+'" height="'+vidheight+'" scale="aspect" controller="true" autostart="0" autostart="false"></embed>';
	} else {
		var rc_embed_html = '<iframe id="'+vidid+'" src="'+video_url+'" type="text/html" frameborder="0" allowfullscreen width="'+vidwidth+'" height="'+vidheight+'"></iframe>';
	}
	// Add content to dialog and open it
	initDialog(dlgid);
	$('#'+dlgid)
		.show().html(rc_embed_html)
		.dialog({ height: (vidheight+130), width: (isMobileDevice ? $(window).width() : (vidwidth+60)), open:function(){ fitDialog(this); }, close:function(){ $(this).dialog('destroy'); $('#'+dlgid).remove(); },
			buttons: [{ text: "Close", click: function(){ $(this).dialog('close'); } }], title: 'Video', bgiframe: true, modal: true
		});
	// Mobile only: Resize video
	if (isMobileDevice) {
		$('#'+vidid).width( $('body').width()-40 );
		$('#'+vidid).height( $('#'+dlgid).height()-10 );
	}
}

// Set autocomplete for BioPortal ontology search for ALL fields on a page
function initAllWebServiceAutoSuggest() {
	$('input.autosug-ont-field').each(function(){
		initWebServiceAutoSuggest($(this).attr('name'));
	});
}

// Set autocomplete for BioPortal ontology search for a field
function initWebServiceAutoSuggest(field_name,retriggerClick) {
	if ($('input#'+field_name+'-autosuggest').length < 1) return;
	// Check if autocomplete has been enabled already for this field
	if ($('input#'+field_name+'-autosuggest').hasClass('ui-autocomplete-input')) return;
	// If the data entry page is locked or is a non-editable response, then don't enable this feature
	if (($('#__SUBMITBUTTONS__-tr').length && $('#__SUBMITBUTTONS__-tr').css('display') == 'none')
		|| ($('#__LOCKRECORD__').length && $('#__LOCKRECORD__').prop('checked'))) return;
	// If we need to retrigger the click (due to Online Designer not initiating this function on page load), then trigger click
	if (retriggerClick != null && retriggerClick == '1') {
		$('input[name="'+field_name+'"]').removeAttr('onclick');
		initWebServiceAutoSuggest(field_name);
		$('input[name="'+field_name+'"]').trigger('click');
		return;
	}
	// Set URLs for ajax
	if (page == 'surveys/index.php') {
		var url = dirname(app_path_webroot.substring(0,app_path_webroot.length-1))+'/surveys/index.php?s='+getParameterByName('s')+'&__passthru='+encodeURIComponent('DataEntry/web_service_auto_suggest.php')+'&field='+field_name;
		var url_cache = dirname(app_path_webroot.substring(0,app_path_webroot.length-1))+'/surveys/index.php?s='+getParameterByName('s')+'&__passthru='+encodeURIComponent('DataEntry/web_service_cache_item.php');
	} else {
		var url = app_path_webroot+'DataEntry/web_service_auto_suggest.php?pid='+pid+'&field='+field_name;
		var url_cache = app_path_webroot+'DataEntry/web_service_cache_item.php?pid='+pid;
	}
	// Init auto-complete
	$('input#'+field_name+'-autosuggest').autocomplete({
		source: url,
		minLength: 2,
		delay: 0,
		search: function( event, ui ) {
			// Show progress icon
			$('#'+field_name+'-autosuggest-progress').show();
		},
		open: function( event, ui ) {
			// Hide progress icon
			$('#'+field_name+'-autosuggest-progress').hide('fade',{ },200);
			// If user backspaces to remove all search characters, then make sure the auto-suggest list stays hidden (buggy)
			if ($('input#'+field_name+'-autosuggest').val().length == 0) {
				$('.ui-autocomplete, .ui-menu-item').hide();
			}
		},
		focus: function( event, ui ) {
			// Prevent it from putting the value in the search input (default)
			return false;
		},
		select: function( event, ui ) {
			// Add raw value to original input field
			$('input[name="'+field_name+'"]').val(ui.item.value);
			// Put the label into the span
			$('#'+field_name+'-autosuggest-span').val(ui.item.preflabel);
			// Trigger blur on search input to force it to hide
			$('input#'+field_name+'-autosuggest').trigger('blur');
			// Make ajax call to store the label
			if (page != 'Design/online_designer.php') {
				$.post(url_cache, { service: ui.item.service, category: ui.item.cat, value: ui.item.value, label: ui.item.preflabel });
			}
			// Execute branching and calculations, just in case
			try{ calculate();doBranching(); }catch(e){ }
			return false;
		}
	})
	.data('ui-autocomplete')._renderItem = function( ul, item ) {
		return $("<li></li>")
			.data("item", item)
			.append("<a>"+item.label+"</a>")
			.appendTo(ul);
	};
	// When user clicks or focuses on original input, put cursor in the search box
	$('#'+field_name+'-autosuggest-span, input[name="'+field_name+'"]').bind('click focus', function(){
		var current_val = $('#'+field_name+'-autosuggest-span').val();
		// Temporarily hide original input and display search input
		$('input[name="'+field_name+'"]').hide();
		$('#'+field_name+'-autosuggest-span').hide();
		$('input#'+field_name+'-autosuggest').val(current_val).show().focus();
		$('#'+field_name+'-autosuggest-instr').show();
	});
	// Re-display original input after choosing selection or leaving search field
	$('input#'+field_name+'-autosuggest').bind('blur', function(){
		$(this).hide();
		$('#'+field_name+'-autosuggest-instr, #'+field_name+'-autosuggest-progress').hide();
		$('input[name="'+field_name+'"], #'+field_name+'-autosuggest-span').show();
		// If auto-suggest value was removed or is empty, make sure the other inputs are empty as well so that it gets erased if already saved.
		if ($(this).val().length == 0) {
			$('#'+field_name+'-autosuggest-span').val('');
			$('input[name="'+field_name+'"]').val('');
			// Execute branching and calculations, just in case
			try{ calculate();doBranching(); }catch(e){ }
		}
	});
}

// Load a javascript file
jQuery.loadScript = function (url, callback) {
    jQuery.ajax({
        url: url,
        dataType: 'script',
        success: callback,
        async: true
    });
}

// Select the radio button or checkbox inside "this" div/object (doesn't work on IE8 and below)
function sr(ob,e) {
	ob = $(ob);
	// Ignore if the radio button itself was clicked
	try {
		var nodeName = e.target.nodeName;
	} catch(error) {
		return;
	}
	if (nodeName.toLowerCase() == 'input') return;
	// Auto-click the radio/checkbox
	if ($('input[type="radio"]', ob).length) {
		$('input[type="radio"]:first', ob).trigger('click');
	} else {
		var chkbox = $('input[type="checkbox"]:first', ob);
		var hidden = $('input[type="hidden"]:first', ob);
		var chkbox_checked = !chkbox.prop('checked');
		var chkbox_code = chkbox.attr('code');
		// Click the checkbox
		chkbox.trigger('click');
		// Manually set the value of the hidden input field (because for some reason, having jQuery trigger click doesn't set this)
		hidden.val( (chkbox_checked ? chkbox_code : '') );
	}
}

// AUTO-COMPLETE FOR DROP-DOWNS: Loop through drop-down fields on the form/survey and enable auto-complete for them
function enableDropdownAutocomplete() {
	// Class to add to select box once auto-complete has been enabled
	var selectClass = "rc-autocomplete-enabled";
	// Loop through all SELECT fields
	$('select.rc-autocomplete:not(.'+selectClass+')').each(function(){
		// If missing name attribute, then ignore
		if ($(this).attr('name') == null) return;
		// Elements
		var $tr = $(this).parents('tr:first');
		var $dropdown = $('select:first', $tr);
		var $input = $('input.rc-autocomplete:first', $tr);
		var $button = $('button.rc-autocomplete:first', $tr);
		// Add class to denote that drop-down already has auto-complete enabled
		$dropdown.addClass(selectClass);
		// Make input width same as original drop-down
		if ($tr.css('display') != 'none') {
			$input.width( $dropdown.width() );
		} else {
			// Drop-down is hidden by branching logic, so clone it to get its width
			var ddclone = $dropdown.clone();
			ddclone.css("visibility","hidden").appendTo('body');
			$input.width( ddclone.width() );
			ddclone.remove();
		}
		// If put focus/click on blank input, open the full list
		$input.bind('focus click', function(){
			if ($(this).val() == '') {
				$input.autocomplete('search','');
			}
		});
		// Prevent form submission via Enter key in input
		$input.keydown(function(e){
			if (e.which == 13) return false;
		});
		// When user changes autocomplete input to blank value
		$input.blur(function(){
			var object_clicked_local = object_clicked;
			var thisval = $(this).val();
			var ddval = $dropdown.val();
			if (thisval == '') {
				if (ddval != '') {
					$dropdown.val('').trigger('change');
				}
			} else {
				var isValid = false;
				var valueToSelect = '';
				$('option', $dropdown).each(function() {
					if ($(this).text() == thisval) {
						isValid = true;
						valueToSelect = $(this).val();
						return false;
					}
				});
				// Check if the new value is valid
				if (!isValid &&
					// object_clicked_local will be null if we just blurred out of input (as opposed to clicking)
					(object_clicked_local == null
					// If we just clicked on the autocomplete list (to choose an option), then don't throw an error.
					|| (object_clicked_local != null && object_clicked_local.parents('ul.ui-autocomplete').length == 0)))
				{
					// Not a valid value
					simpleDialog('You entered an invalid value. Please try again.','Invalid value!',null,null,"$('#"+$(this).attr('id')+"').focus().autocomplete('search',$('#"+$(this).attr('id')+"').val());");
				} else {
					// Set drop-down to same value and trigger change
					$dropdown.val(valueToSelect);
					if (ddval != valueToSelect) {
						$dropdown.trigger('change');
					}
				}
			}
		});
		// Open full list when click button/arrow icon
		$button.mousedown(function(event){
			if ($('.ui-autocomplete:visible').length) {
				$(this).attr('listopen', '1');
			} else {
				$(this).attr('listopen', '0');
			}
		});
		$button.click(function(event){
			// Get list_open attribute from button
			var list_open = $(this).attr('listopen');
			if (list_open == '1') {
				// Hide the autocomplete list
				$('.ui-autocomplete').hide();
				// Change value of listopen attribute
				$(this).attr('listopen', '0');
			} else {				
				// If click the down arrow icon, put cursor inside text box and open the full list
				$input.focus();
				if ($input.val() != '') {
					$input.autocomplete("search", "");
				}
				// Change value of list_open attribute
				$(this).attr('listopen', '1');
			}
		});
		// When page loads, add existing value's label to input field
		if ($dropdown.val() != "") {
			var saved_val_text = $("option:selected", $dropdown).text();
			$input.val(saved_val_text).attr('value',saved_val_text); // Also set attr() in case using Randomization, which replaces text inside TD cell.
		}
		// Extract options from dropdown for jQueryUI autocomplete
		var list = $dropdown.children();
		var x = [];
		for (var i = 0; i<list.length; i++){
			var this_opt_val = list[i].value;
			if (this_opt_val != '') {
				x.push({ value: html_entity_decode(list[i].innerHTML), code: this_opt_val });
			}
		}
		// Initialize jQueryUI autocomplete
		$input.autocomplete({
			source: x,
			minLength: 0,
			select: function (event, ui) {
				$dropdown.val(ui.item.code);
				$button.click();
				$dropdown.change();
			}
		})
		// Add escape character as HTML character code before the label because a single dash will turn into a divider
		.data('ui-autocomplete')._renderItem = function( ul, item ) {
			return $("<li></li>")
				.data("item", item)
				.append("&#27;" + item.label)
				.appendTo(ul);
		};
	});
}

// Decode HTML character codes
function html_entity_decode(text) {
    var entities = [
        ['apos', '\''],
        ['amp', '&'],
        ['lt', '<'],
        ['gt', '>']
    ];
    for (var i = 0, max = entities.length; i < max; ++i)
        text = text.replace(new RegExp('&'+entities[i][0]+';', 'g'), entities[i][1]);
    return text;
}

// Obtain the latitute or longitude of the user (direction = 'latitude' or 'longitude')
// and place the value inside an input field with specified 'input_name'.
// Note: It will *only* add the lat/long if the input is blank/empty.
function getGeolocation(direction,input_name,form_name,overwrite) {
	if (direction == null || input_name == null || direction == '' || input_name == '') return 0;
	if (overwrite == null) overwrite = false;
	// Get the position
	if (geoPosition.init()){
		geoPosition.getCurrentPosition(function(p){
			// Set form and input
			if (form_name == null) form_name = 'form';
			var myinput = document.forms[form_name].elements[input_name];
			// Make sure this is a textarea or input
			if (myinput.type != 'text') return;
			// Add lat or long to input
			if (overwrite == true || myinput.value == '') {
				if (direction == 'latitude') {
					myinput.value = p.coords.latitude;
				} else if (direction == 'longitude') {
					myinput.value = p.coords.longitude;
				}
				// Call calculations/branching
				try{calculate();doBranching();}catch(e){}
			}
		},function(){ },{enableHighAccuracy:true});
		return 1;
	}
	return 0;
}

// Enable all action tags
function enableActionTags() {
	// Track any changes made
	var changes = 0;
	// Enable NOW/TODAY action tags
	$("#questiontable tr.\\@NOW, #questiontable tr.\\@TODAY").each(function(){
		var name = $(this).attr('sq_id');
		var input = $('#questiontable input[name="'+name+'"]');
		var fv = (input.attr('fv') == null) ? '' : input.attr('fv');
		// Add value if doesn't already have a value
		if (input.val() == '') {
			if (fv == 'time') {
				// NOW for time fields
				document.forms['form'].elements[name].value = currentTime('both');
			} else if ($(this).hasClass("\@NOW")) {
				// NOW for datetime fields
				document.forms['form'].elements[name].value = getCurrentDate(fv)+' '+currentTime('both',(fv == '' || fv.indexOf('datetime_seconds') === 0));
			} else {
				// TODAY for date fields
				document.forms['form'].elements[name].value = getCurrentDate(fv);
			}
			// Remove the date picker
			$('img.ui-datepicker-trigger', this).remove();
			input.removeClass('hasDatepicker');
			// Increment changes count
			changes++;
		}
	});
	// Enable LATITUTE/LONGITUDE action tags
	$("#questiontable tr.\\@LATITUDE, #questiontable tr.\\@LONGITUDE").each(function(){
		var name = $(this).attr('sq_id');
		// Disable field
		$('#questiontable input[name="'+name+'"]').prop('readonly',true);
		// Add GPS value
		if (document.forms['form'].elements[name].value == '') {
			changes += getGeolocation(($(this).hasClass("\@LATITUDE") ? 'latitude' : 'longitude'), name, 'form');
		}
	});
	// Trigger branching and calculations if changes were made
	if (changes > 0) {
		dataEntryFormValuesChanged = true;
		setTimeout(function(){try{calculate();doBranching();}catch(e){}},50);
	}
}

/**
  * function to load a given css file
  */
loadCSS = function(href) {
    var cssLink = $("<link rel='stylesheet' type='text/css' href='"+href+"'>");
    $("head").append(cssLink);
};

/**
 * function to load a given js file
 */
loadJS = function(src) {
    var jsLink = $("<script type='text/javascript' src='"+src+"'>");
    $("head").append(jsLink);
};

// Get width of scrollbar
function getScrollBarWidth() {
  var inner = document.createElement('p');
  inner.style.width = "100%";
  inner.style.height = "200px";

  var outer = document.createElement('div');
  outer.style.position = "absolute";
  outer.style.top = "0px";
  outer.style.left = "0px";
  outer.style.visibility = "hidden";
  outer.style.width = "200px";
  outer.style.height = "150px";
  outer.style.overflow = "hidden";
  outer.appendChild (inner);

  document.body.appendChild (outer);
  var w1 = inner.offsetWidth;
  outer.style.overflow = 'scroll';
  var w2 = inner.offsetWidth;
  if (w1 == w2) w2 = outer.clientWidth;

  document.body.removeChild (outer);

  return (w1 - w2);
};

// Display project left-hand menu if hidden on mobile
function toggleProjectMenuMobile(ob) {
	// Don't do anything if on login page
	if ($('#redcap_login_a38us_09i85').length || $('#redcap_login_openid_Re8D2_8uiMn').length) return false;
	// Check left-hand menu
	if (ob.hasClass('hidden-xs')) {
		ob.css('top',$(window).scrollTop());
	} else {
		ob.css('top','0px');
	}
	ob.css('z-index','1002').toggleClass('hidden-xs');
	$('#fade').toggleClass('black_overlay').toggle();
}

// On forms/surveys, make sure dropdowns don't get too wide so that they create horizontal scrollbar
function shrinkWideDropDowns() {
	// Get width of viewport
	var winWidth = $(window).width();
	// If we don't have a horizontal scrollbar, then do nothing
	if ($(document).width() <= winWidth) return;
	// Loop through each drop-down
	$('form#form select.x-form-text').each(function(){
		var dd = $(this);
		var posDdLeft = dd.offset().left
		var posDdRight = posDdLeft + dd.width();
		// If drop-down spills off page, then resize it
		if (posDdRight > winWidth) dd.css('width','95%');
	});
}

function areYouSure(callBack){
  simpleDialog('Are you sure you want to cancel this request?','Cancel Request',1,400);
  $confirm =  $('<button>',{
    'class': 'confirm-btn',
    text: 'Submit'
  }).bind('click', function(){
    callBack('yes');
  });
  $('body').find('.ui-dialog').addClass('cancel-request-dialog').append($confirm);
}

function cancelRequest(pid,reqName,ui_id){
  areYouSure(function(res){
    if(res === 'yes'){
      $.post(app_path_webroot+'ToDoList/todo_list_ajax.php',
      { action: 'delete-request', pid: pid, ui_id: ui_id, req_type: reqName },
      function(data){
        if (data == '1'){
          location.reload();
        }
      });
    }
  });
}

// Determine if a mobile device based on screen size. Return true if a mobile device.
function isMobileDeviceFunc() {
	var scrollBarWidth = ($(document).height() > $(window).height()) ? getScrollBarWidth() : 0;
	return ($(window).width()+scrollBarWidth <= maxMobileWidth ? 1 : 0);
}

// Detemine if current device is a touch device
function isTouchDevice() {
  return 'ontouchstart' in window        // works on most browsers
      || navigator.maxTouchPoints;       // works on IE10/11 and Surface
}

// Action when selecting an Enhanced Choice radio or checkbox
function enhanceChoiceSelect(ob) {
	var label = $(ob);
	var attr = label.attr('for').split(',');
	var type = attr[1] == 'code' ? 'checkbox' : 'radio';
	// Set the element class
	if (type == 'checkbox') {
		var input = $('input[name="__chkn__'+attr[0]+'"]['+attr[1]+'="'+attr[2]+'"]');
		if (input.prop('checked')) {
			label.removeClass('selectedchkbox').addClass('unselectedchkbox');
		} else {
			label.removeClass('unselectedchkbox').addClass('selectedchkbox');
		}
	} else {
		var input = $('input[name="'+attr[0]+'___radio"]['+attr[1]+'="'+attr[2]+'"]');
		if (!input.length) {
			// PROMIS inputs
			input = $('input[name="'+attr[0]+'"]['+attr[1]+'="'+attr[2]+'"]');
		}
		// First, set all unchecked
		label.parentsUntil('div.enhancedchoice_wrapper').parent().find('div.enhancedchoice label').removeClass('selectedradio');
		// Now set the one selected one
		label.addClass('selectedradio');
	}
	// Trigger the original input
	input.trigger('click');
	dataEntryFormValuesChanged = true;
}

// Detect when an element's height changes
function onElementHeightChange(elm, callback){
    var lastHeight = elm.clientHeight, newHeight;
    (function run(){
        newHeight = elm.clientHeight;
        if( lastHeight != newHeight )
            callback();
        lastHeight = newHeight;
        if( elm.onElementHeightChangeTimer )
            clearTimeout(elm.onElementHeightChangeTimer);
        elm.onElementHeightChangeTimer = setTimeout(run, 200);
    })();
}

// Create a new DD snapshot via AJAX
function createDataDictionarySnapshot() {
	$.post(app_path_webroot+'Design/data_dictionary_snapshot.php?pid='+pid,{},function(data){
		if (data == '0') { 
			alert(woops);
		} else {
			$('#dd_snapshot_btn').attr('disabled','disabled').addClass('opacity65');
			$('#last_dd_snapshot_ts').html(data);
			$('#dd_snapshot_btn img:first').prop('src',app_path_images+'tick.png');
			$('#last_dd_snapshot').effect('highlight',{},3000);
		}						
	});
}

// Replace a textarea with a div for WYSIWYG effect when previewing the textarea's HTML contents
function showTextareaPreview(textareaSelector,revert,addSurveyLink) {
	var previewDivId = 'textarea-preview';
	// Always remove the preview div if already on page (to prevent confliction)
	if ($('#'+previewDivId).length) $('#'+previewDivId).remove();
	// Re-show the textrea
	if (revert) {
		textareaSelector.show();
		return;
	}
	// Create preview div and position it
	var textareaVal = textareaSelector.val();
	textareaSelector.after('<div id="'+previewDivId+'"></div>');
	$('#'+previewDivId).attr('style', textareaSelector.attr('style'))
		.css({"display":"none","margin":textareaSelector.css('margin'),"padding":textareaSelector.css('padding')})
		.width(textareaSelector.width())
		.height(textareaSelector.height());
	// Replace textarea with div
	if (!addSurveyLink && trim(textareaVal) == '') {
		textareaSelector.hide();
		$('#'+previewDivId).html(textareaVal).show();
	} else {
		// Do AJAX call to filter the HTML
		$.post(app_path_webroot+'ProjectGeneral/html_preview.php?pid='+pid,{ contents: textareaVal, addSurveyLink: addSurveyLink },function(data){
			textareaSelector.hide();
			$('#'+previewDivId).html(data).show();
		});
	}
}
// Change button view for textarea preview
function toggleTextareaPreviewBtn(ob,addSurveyLink) {
	var parentDiv = $(ob).parents('div.textarea-preview-parent:first');
	var textareaSelector = $(parentDiv.attr('message'));
	if ($(ob).hasClass('textarea-preview')) {
		// Show preview
		$('.textarea-preview').parent().addClass('active');
		$('.textarea-compose').parent().removeClass('active');
		showTextareaPreview(textareaSelector,0,addSurveyLink);
	} else {
		// Back to textarea
		$('.textarea-preview').parent().removeClass('active');
		$('.textarea-compose').parent().addClass('active');
		showTextareaPreview(textareaSelector,1,addSurveyLink);
	}
}
// Send test email for textarea preview
function textareaTestPreviewEmail(ob,addSurveyLink) {
	var parentDiv = $(ob).parents('div.textarea-preview-parent:first');
	$.post(app_path_webroot+'ProjectGeneral/html_preview.php?pid='+pid,{ contents: $(parentDiv.attr('message')).val(), subject: $(parentDiv.attr('subject')).val(), from: $(parentDiv.attr('from')+' option:selected').text(), addSurveyLink: addSurveyLink },function(data){
		simpleDialog('The test email was successfully sent to '+data,'Email sent!');
	});
}


function logicSuggestClick(text, location) {
	var originalText = $("#"+location).val();
	var lastLeftBracket = originalText.lastIndexOf("[");
	$("#"+location).val( originalText.substring(0, lastLeftBracket) + text );
	
	// Rerun the validation
    logicValidate($("#"+location), true);

    // must disable any additional checking in onblur before resetting focus
    var onblur_ev = $("#"+location).attr("onblur");
    $("#"+location).removeAttr("onblur");
    setTimeout(function() {
        $("#"+location).attr("onblur", onblur_ev);
        $("#"+location).focus();
    }, 100);
    logicSuggestHidetip(location);  // hide the tips
}

function logicSuggestHidetip(location) {
    $("#LSC_id_"+location).hide();
    var elems = $(".fs-item");
    for (var i=0; i < elems.length; i++)
    {
        if (elems[i].id && ((elems[i].id.match("LSC_fn_"+location+"_")) || (elems[i].id.match("LSC_ev_"+location+"_"))))
        {
            $("#"+elems[i].id).hide();
        }
    }
}

function logicSuggestShowtip(location) {
    var elems = $(".fs-item");
    $("#LSC_id_"+location).show();
    $("#LSC_id_"+location).css({ position: "absolute", zIndex: "1000000" });
    for (var i=0; i < elems.length; i++)
    {
        if (elems[i].id && ((elems[i].id.match("LSC_fn_"+location+"_")) || (elems[i].id.match("LSC_ev_"+location+"_"))))
        {
            $("#"+elems[i].id).show();
        }
    }
}

function logicHideSearchTip(ob) {
    var location = $(ob).prop('id');  // get name of id
    if (document.getElementById("LSC_id_"+location))
    {
        $("#LSC_id_"+location).hide();
    }
}

function logicValidate(ob, longitudinal) {
	var mssg = '<span class="logicValidatorOkay"><img src="'+app_path_images+'tick_small.png">Valid</span>'; 
	var err_mssg = "<span class='logicValidatorOkay'><img style='position:relative;top:-1px;margin-right:4px;' src='"+app_path_images+"cross_small2.png'>Error in syntax</span>";
    // timeout to let new text value to enter field;
    // just to back of queue to process
    setTimeout(function() {
		var logic = trim($(ob).val());
        var b = checkLogicErrors(logic, false, longitudinal);
        var ob_id = $(ob).prop('id');
        var confirm_ob_id = ob_id + "_Ok";
        var confirm_ob = "#"+confirm_ob_id;
        if ($(confirm_ob))
        {
            if (b || logic == '') {   // obvious errors or nothing
                $(confirm_ob).html("");
            } else {
				// If logic ends with any of these strings, then don't display OK or ERROR (to prevent confusion mid-condition)
				var allowedEndings = new Array(' and', ' or', '=', '>', '<');
				for (var i=0; i<allowedEndings.length; i++) {
					if (ends_with(logic, allowedEndings[i])) {
						$(confirm_ob).html("");
						return;
					}
				}				
				// Kill previous ajax instance (if running from previous keystroke)
				if (logicSuggestAjax !== null) {
					if (logicSuggestAjax.readyState == 1) logicSuggestAjax.abort();
				}
				// Check via AJAX if logic is really true
				logicSuggestAjax = $.post(app_path_webroot+'Design/logic_validate.php?pid='+pid, { logic: logic }, function(data){
					if (data == '1') {					
						$(confirm_ob).css({"color": "green"}).html(mssg);
					} else {
						$(confirm_ob).css({"color": "red"}).html(err_mssg);
					}
				});
            }
        }
    }, 100);
}

var logicSuggestAjax = null; 
function logicSuggestSearchTip(ob, event, longitudinalthis, draft_mode) {
	if (typeof longitudinalthis != "undefined") {
		var longitudinal = longitudinalthis;
	}
	if (typeof draft_mode == "undefined") {
		draft_mode = false;
	}
	draft_mode = (draft_mode) ? 1 : 0;
	var res_ob_id = $(ob).prop('id') + "_res";
    if ($("#"+res_ob_id))
    {
        $("#"+res_ob_id).html("");
        var sel_id = "logicTesterRecordDropdown";
        if ($("#"+sel_id))
        {
            $("#"+sel_id).val("");
        }
    }
	
	// Do preliminary validation via JS then full validation via PHP/AJAX
    logicValidate(ob, longitudinal);

    // If these keys are hit, abort, so user can keep working
    // ascii codes http://unixpapa.com/js/key.html
    // backspace event.keyCode === 8
    // [ event.keyCode === 219
    if (event.keyCode === 32 || event.keyCode === 33 || event.keyCode === 61 || event.keyCode === 60 || event.keyCode === 62 // AbortOn <Space> ! = < >
             || event.keyCode === 91  || event.keyCode === 123
             ) { 
        logicSuggestHidetip($(ob).prop('id'));  // hide the tips
        return; // since one of these disabled keys was pressed, we abort, so user can keep working
    }

    var text = $(ob).val();
    var word = "";
    if (text.indexOf(' ') >= 0) {
        word = text.split(' ').pop();
    } else {
        word = text;  // If there are no spaces, then use the word since it's first
    }
    if (trim(word) == "") return;

    // timeout to let new text value to enter field;
    // just to back of queue to process
    setTimeout(function() {
        var text = $(ob).val();
        var word = "";
        if (text.indexOf(' ') >= 0) {
            word = text.split(' ').pop();
        } else {
            word = text;  // If there are no spaces, then use the word since it's first
        }
    
        var location;
        if ($(ob).prop('id') == "") {
            location = "textarea[name='"+$(ob).prop('name')+"']";  // since we can't get the name of the id, we're gonna get the name of the name= in the textarea
        } else {
            location = '#'+$(ob).prop('id');  // get name of id
        }
    
        var location_plain = location.replace(/^\#/, "");
        var elems = $(".fs-item");
        for (var i=0; i < elems.length; i++)
        {
            if (elems[i].id && (elems[i].id.match(/^LSC_id_/)) && (!elems[i].id.match(location_plain)))
            {
                $("#"+elems[i].id).hide();
            }
        }
    
        var whereToPlaceIt = $(location).position();
    
        whereToPlaceIt.top = whereToPlaceIt.top + $(location).height();
        whereToPlaceIt.top = Math.floor(whereToPlaceIt.top);
        whereToPlaceIt.left = Math.floor(whereToPlaceIt.left);
    
        var div_offset = $(location).parent().position();
        div_offset.top = Math.floor(div_offset.top);
        div_offset.left = Math.floor(div_offset.left);

        var elem = $("#LSC_id_"+location_plain);
        if (!elem.length) return;		
        
        // If there are spaces then grab the last word and change the value of 'text' to be equal to the last word
    
        // Now that we have the word we want to autocomplete, let's run some tests    
        // If the last word is a space, then abort
        if (trim(word) == '') {
            logicSuggestHidetip($(ob).prop('id'));  // hide the tips
            return;
        }
		
		// If there's a left bracket in the word, that means we want to autocomplete it
        if ((word.indexOf('[') >= 0) && (!word.match(/\]\[[^\]^\s]+\]\[/))) 
		{
			// Kill previous ajax instance (if running from previous keystroke)
			if (logicSuggestAjax !== null) {
				if (logicSuggestAjax.readyState == 1) logicSuggestAjax.abort();
			}
			// Ajax request
			logicSuggestAjax = $.post(app_path_webroot+'Design/logic_field_suggest.php?pid='+pid, { draft_mode: draft_mode, location: location_plain, word: word.substring(1,word.length)  }, function(data){
				// Position the element
				elem.css({ left: whereToPlaceIt.left + "px", top: whereToPlaceIt.top + "px" })
					.html(data)
					.show();
				// If nothing returned, then hide the suggest box
				if (data == '') logicSuggestHidetip($(ob).prop('id'));
			});			
		} else {
            logicSuggestHidetip($(ob).prop('id')); // There is not a left bracket in the word, so hide the box
        }
    }, 0);
}

// event and field are only applicable to calc fields; can be blank for branching
function logicCheck(logic_ob, type, longitudinal, field, rec, mssg, err_mssg, invalid, action, logic_ob_id_opt)
{
    var logic_ob_id = $(logic_ob).prop('id');
    if (!logic_ob_id)
        logic_ob_id = logic_ob_id_opt;
    if (rec !== "")
    {
        setTimeout(function() {
            var res_ob_id = logic_ob_id+"_res";
            if (!checkLogicErrors($(logic_ob).val(), false, longitudinal))
            {
                var page = "";
                var page = getParameterByName("page");
                if (type == "branching")
                    page = "Design/logic_test_record.php";
                else if (type == "calc")
                    page = "Design/logic_calc_test_record.php";
                var logic = $(logic_ob).val();
				var hasrecordevent = ($(logic_ob).attr('hasrecordevent') == '1') ? 1 : 0;
                if ($("#"+res_ob_id))
                {
                    $.post(app_path_webroot+page+"?pid="+pid, { hasrecordevent: hasrecordevent, record: rec, logic: logic }, function(data) {
						if (data !== "")
						{
							if (data.match("ERROR"))
							{
								$("#"+res_ob_id).html(data);
							}
							else if (typeof mssg != "undefined")
							{
								if (data.toString().match(/hide/i))
									$("#"+res_ob_id).html(mssg+" "+action[1]);
								else if (data.toString().match(/show/i))
									$("#"+res_ob_id).html(mssg+" "+action[0]);
								else
									$("#"+res_ob_id).html(mssg+" "+data.toString());
							}
							else
							{
								$("#"+res_ob_id).html(data.toString());
							}
						}
						else
						{
							$("#"+res_ob_id).html("["+action[2]+"]");
						}
                    });
                }
            }
            else
            {
                $("#"+res_ob_id).html(invalid);
            }
        }, 0);
    }
}

function showInstrumentsToggle(ob,collapse) {
	var targetid = 'show-instruments-toggle';
	$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:saveShowInstrumentsToggle',{ object: 'sidebar', targetid: targetid, collapse: collapse },function(data){
		if (data == '0') { alert(woops);return; }
		if (collapse == 0) {
			$('.formMenuList').removeClass('hide');
		} else {
			$('.formMenuList').addClass('hide');
		}
		$('a.show-instruments-toggle').removeClass('hide');
		$(ob).addClass('hide');
	});
}
// Load table list of repeating forms/events for a record/form/event
function loadInstancesTable(ob, record, event_id, form) {
	if (!$('#instancesTablePopup').length) {
		$('body').append('<div id="instancesTablePopup"><div id="instancesTablePopupSub"> </div></div>');
	}
	$.post(app_path_webroot+'index.php?pid='+pid+'&route=DataEntryController:renderInstancesTable', {record:record, event_id:event_id, form:form },function(data){		
		$('#instancesTablePopupSub').html(data);
		$('#instancesTablePopupSub .btnAddRptEv').removeClass('opacity50');
		var cell = $(ob);
		var cellpos = cell.offset();
		var instancesTablePopup = $('#instancesTablePopup');
		instancesTablePopup.css({ 'left': cellpos.left - (instancesTablePopup.outerWidth(true) - cell.outerWidth(true))/2, 'top': cellpos.top + cell.outerHeight(true) + 3 });
		instancesTablePopup.show();
		$('#instancesTablePopup').width( $('#instancesTablePopupSub table:first').width() );
		$('#instancesTablePopupSub table:first').css('width','99%');
	});
}
// In case data entry forms don't fully load, which would prevent the save button group drop-downs 
// from working, use this replacement method to make sure the drop-down opens regardless.
function openSaveBtnDropDown(ob,e) {
	e.stopPropagation();
	var btngroup = $(ob).parent();
	if (btngroup.hasClass('open')) {
		// Close it
		btngroup.removeClass('open');
	} else {
		// Open it
		btngroup.addClass('open');
	}
}

// ****************************************************************************************************
// Variables to be set upon page load
// ****************************************************************************************************
var pid = '';
// Standard error message
var woops = "Woops! An error occurred. Please try again.";
// Determine if using Internet Explorer
var agt = navigator.userAgent.toLowerCase();
var isIE = (agt.indexOf('msie') > -1 || agt.indexOf('trident') > -1);
// Returns IE version
var IEv = vIE();
// Returns if browser is IE6
var isIE6 = (IEv == 6);
// Returns if browser is IE7
var isIE7 = (IEv == 7);
// Determine if using iOS
var isIOS = ((agt.indexOf('ipad') > -1 || agt.indexOf('iphone') > -1 || agt.indexOf('ipod') > -1) && !window.MSStream);
var iOSv = iOSversion();
// Set width as max width for phone/tablet
var maxMobileWidth = 767;
// Determine if we're on a global page or a project-level page (check for pid or pnid)
var isProjectPage = (getParameterByName('pid') != "" || getParameterByName('pnid') != "");
// Set original value to show the branching logic prompt "Erase Value" on forms when it attempts to hide a field with a value due to branching logic
var showEraseValuePrompt = 1;
// Set flag to detect if data entry form values have been modified
var dataEntryFormValuesChanged = false;
// Set placeholder for randomization criteria field list (if using randomization module)
var randomizationCriteriaFieldList = null;
// Set flag to determine if .ui-autocomplete mouseoff triggered
var mouse_inside_uiautocomplete = false;
// Track what was just clicked
var object_clicked = null;
// Initialize but also set on the page
var isPlugin = 0;
// Set initial value
var isMobileDevice = false;
// If using IE8, utilize other JavaScript for Bootstrap compatibility
if (isIE && IEv < 9) {
	/**
	* @preserve HTML5 Shiv 3.7.3 | @afarkas @jdalton @jon_neal @rem | MIT/GPL2 Licensed
	*/
	!function(a,b){function c(a,b){var c=a.createElement("p"),d=a.getElementsByTagName("head")[0]||a.documentElement;return c.innerHTML="x<style>"+b+"</style>",d.insertBefore(c.lastChild,d.firstChild)}function d(){var a=t.elements;return"string"==typeof a?a.split(" "):a}function e(a,b){var c=t.elements;"string"!=typeof c&&(c=c.join(" ")),"string"!=typeof a&&(a=a.join(" ")),t.elements=c+" "+a,j(b)}function f(a){var b=s[a[q]];return b||(b={},r++,a[q]=r,s[r]=b),b}function g(a,c,d){if(c||(c=b),l)return c.createElement(a);d||(d=f(c));var e;return e=d.cache[a]?d.cache[a].cloneNode():p.test(a)?(d.cache[a]=d.createElem(a)).cloneNode():d.createElem(a),!e.canHaveChildren||o.test(a)||e.tagUrn?e:d.frag.appendChild(e)}function h(a,c){if(a||(a=b),l)return a.createDocumentFragment();c=c||f(a);for(var e=c.frag.cloneNode(),g=0,h=d(),i=h.length;i>g;g++)e.createElement(h[g]);return e}function i(a,b){b.cache||(b.cache={},b.createElem=a.createElement,b.createFrag=a.createDocumentFragment,b.frag=b.createFrag()),a.createElement=function(c){return t.shivMethods?g(c,a,b):b.createElem(c)},a.createDocumentFragment=Function("h,f","return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&("+d().join().replace(/[\w\-:]+/g,function(a){return b.createElem(a),b.frag.createElement(a),'c("'+a+'")'})+");return n}")(t,b.frag)}function j(a){a||(a=b);var d=f(a);return!t.shivCSS||k||d.hasCSS||(d.hasCSS=!!c(a,"article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")),l||i(a,d),a}var k,l,m="3.7.3",n=a.html5||{},o=/^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,p=/^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,q="_html5shiv",r=0,s={};!function(){try{var a=b.createElement("a");a.innerHTML="<xyz></xyz>",k="hidden"in a,l=1==a.childNodes.length||function(){b.createElement("a");var a=b.createDocumentFragment();return"undefined"==typeof a.cloneNode||"undefined"==typeof a.createDocumentFragment||"undefined"==typeof a.createElement}()}catch(c){k=!0,l=!0}}();var t={elements:n.elements||"abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",version:m,shivCSS:n.shivCSS!==!1,supportsUnknownElements:l,shivMethods:n.shivMethods!==!1,type:"default",shivDocument:j,createElement:g,createDocumentFragment:h,addElements:e};a.html5=t,j(b),"object"==typeof module&&module.exports&&(module.exports=t)}("undefined"!=typeof window?window:this,document);
	/*! Respond.js v1.4.2: min/max-width media query polyfill * Copyright 2013 Scott Jehl
	 * Licensed under https://github.com/scottjehl/Respond/blob/master/LICENSE-MIT
	 *  */
	!function(a){"use strict";a.matchMedia=a.matchMedia||function(a){var b,c=a.documentElement,d=c.firstElementChild||c.firstChild,e=a.createElement("body"),f=a.createElement("div");return f.id="mq-test-1",f.style.cssText="position:absolute;top:-100em",e.style.background="none",e.appendChild(f),function(a){return f.innerHTML='&shy;<style media="'+a+'"> #mq-test-1 { width: 42px; }</style>',c.insertBefore(e,d),b=42===f.offsetWidth,c.removeChild(e),{matches:b,media:a}}}(a.document)}(this),function(a){"use strict";function b(){u(!0)}var c={};a.respond=c,c.update=function(){};var d=[],e=function(){var b=!1;try{b=new a.XMLHttpRequest}catch(c){b=new a.ActiveXObject("Microsoft.XMLHTTP")}return function(){return b}}(),f=function(a,b){var c=e();c&&(c.open("GET",a,!0),c.onreadystatechange=function(){4!==c.readyState||200!==c.status&&304!==c.status||b(c.responseText)},4!==c.readyState&&c.send(null))};if(c.ajax=f,c.queue=d,c.regex={media:/@media[^\{]+\{([^\{\}]*\{[^\}\{]*\})+/gi,keyframes:/@(?:\-(?:o|moz|webkit)\-)?keyframes[^\{]+\{(?:[^\{\}]*\{[^\}\{]*\})+[^\}]*\}/gi,urls:/(url\()['"]?([^\/\)'"][^:\)'"]+)['"]?(\))/g,findStyles:/@media *([^\{]+)\{([\S\s]+?)$/,only:/(only\s+)?([a-zA-Z]+)\s?/,minw:/\([\s]*min\-width\s*:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/,maxw:/\([\s]*max\-width\s*:[\s]*([\s]*[0-9\.]+)(px|em)[\s]*\)/},c.mediaQueriesSupported=a.matchMedia&&null!==a.matchMedia("only all")&&a.matchMedia("only all").matches,!c.mediaQueriesSupported){var g,h,i,j=a.document,k=j.documentElement,l=[],m=[],n=[],o={},p=30,q=j.getElementsByTagName("head")[0]||k,r=j.getElementsByTagName("base")[0],s=q.getElementsByTagName("link"),t=function(){var a,b=j.createElement("div"),c=j.body,d=k.style.fontSize,e=c&&c.style.fontSize,f=!1;return b.style.cssText="position:absolute;font-size:1em;width:1em",c||(c=f=j.createElement("body"),c.style.background="none"),k.style.fontSize="100%",c.style.fontSize="100%",c.appendChild(b),f&&k.insertBefore(c,k.firstChild),a=b.offsetWidth,f?k.removeChild(c):c.removeChild(b),k.style.fontSize=d,e&&(c.style.fontSize=e),a=i=parseFloat(a)},u=function(b){var c="clientWidth",d=k[c],e="CSS1Compat"===j.compatMode&&d||j.body[c]||d,f={},o=s[s.length-1],r=(new Date).getTime();if(b&&g&&p>r-g)return a.clearTimeout(h),h=a.setTimeout(u,p),void 0;g=r;for(var v in l)if(l.hasOwnProperty(v)){var w=l[v],x=w.minw,y=w.maxw,z=null===x,A=null===y,B="em";x&&(x=parseFloat(x)*(x.indexOf(B)>-1?i||t():1)),y&&(y=parseFloat(y)*(y.indexOf(B)>-1?i||t():1)),w.hasquery&&(z&&A||!(z||e>=x)||!(A||y>=e))||(f[w.media]||(f[w.media]=[]),f[w.media].push(m[w.rules]))}for(var C in n)n.hasOwnProperty(C)&&n[C]&&n[C].parentNode===q&&q.removeChild(n[C]);n.length=0;for(var D in f)if(f.hasOwnProperty(D)){var E=j.createElement("style"),F=f[D].join("\n");E.type="text/css",E.media=D,q.insertBefore(E,o.nextSibling),E.styleSheet?E.styleSheet.cssText=F:E.appendChild(j.createTextNode(F)),n.push(E)}},v=function(a,b,d){var e=a.replace(c.regex.keyframes,"").match(c.regex.media),f=e&&e.length||0;b=b.substring(0,b.lastIndexOf("/"));var g=function(a){return a.replace(c.regex.urls,"$1"+b+"$2$3")},h=!f&&d;b.length&&(b+="/"),h&&(f=1);for(var i=0;f>i;i++){var j,k,n,o;h?(j=d,m.push(g(a))):(j=e[i].match(c.regex.findStyles)&&RegExp.$1,m.push(RegExp.$2&&g(RegExp.$2))),n=j.split(","),o=n.length;for(var p=0;o>p;p++)k=n[p],l.push({media:k.split("(")[0].match(c.regex.only)&&RegExp.$2||"all",rules:m.length-1,hasquery:k.indexOf("(")>-1,minw:k.match(c.regex.minw)&&parseFloat(RegExp.$1)+(RegExp.$2||""),maxw:k.match(c.regex.maxw)&&parseFloat(RegExp.$1)+(RegExp.$2||"")})}u()},w=function(){if(d.length){var b=d.shift();f(b.href,function(c){v(c,b.href,b.media),o[b.href]=!0,a.setTimeout(function(){w()},0)})}},x=function(){for(var b=0;b<s.length;b++){var c=s[b],e=c.href,f=c.media,g=c.rel&&"stylesheet"===c.rel.toLowerCase();e&&g&&!o[e]&&(c.styleSheet&&c.styleSheet.rawCssText?(v(c.styleSheet.rawCssText,e,f),o[e]=!0):(!/^([a-zA-Z:]*\/\/)/.test(e)&&!r||e.replace(RegExp.$1,"").split("/")[0]===a.location.host)&&("//"===e.substring(0,2)&&(e=a.location.protocol+e),d.push({href:e,media:f})))}w()};x(),c.update=x,c.getEmValue=t,a.addEventListener?a.addEventListener("resize",b,!1):a.attachEvent&&a.attachEvent("onresize",b)}}(this);
}
// Functions to run after page is fully loaded
$(function(){
	// Based in screen width, is this a mobile device (phone)?
	isMobileDevice = isMobileDeviceFunc();
	// Initialize widgets, buttons, etc. on page
	initWidgets();
	// Initialize the project-level page
	if (isProjectPage) {
		initPage();
	} else {
		fixProjectPageWidthIE();
	}
	// Rewrite jQuery $.post function to automatically send CSRF token for all Post requests (do not do this for Plugins)
	if (window.redcap_csrf_token) {
		$.post = function (url, data, success) {
			$.extend(data, { redcap_csrf_token: redcap_csrf_token });
			return $.ajax({type: "POST", url: url, data: data, success: success});
		}
	}
	// Rewrite jQueryUI dialog to allow title to contain HTML
	$.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
		_title: function(title) {
			if (!this.options.title ) {
				title.html("&#160;");
			} else {
				title.html(this.options.title);
			}
		}
	}));
	// If SSL is being utilized according to REDCap base URL but user is on a non-SSL page, then redirect to SSL version of same page.
	try {
		if (app_path_webroot_full.substring(0,6) == 'https:' && document.location.protocol != 'https:') {
			window.location.href = document.URL.replace(/http:/i,'https:');
		}
	} catch(e) { }
	// User "object_clicked" to determine if something was just clicked, as opposed to merely tabbing out of a text box.
    $(document).mousedown(function(e) {
        // The latest element clicked
        object_clicked = $(e.target);
    });
    $(document).mouseup(function(e) {
		// When 'object_clicked == null' on blur, we know it was not caused by a click but maybe by pressing the tab key
        object_clicked = null;
    });
	// Disable the backspace-goes-back "feature" of browsers
	$(document).on("keydown keypress", function(event) {
		// can't use ":input" because default behavior is to go back if
		// backspacing a radio button (at least in Chrome)
		if (event.which === 8 && !$(event.target).is(":text,:password,textarea")) {
			event.preventDefault();
		}
	});
});