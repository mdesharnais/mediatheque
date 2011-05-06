/*!
 * Google Chart QR Code generator
 *
 * Copyright 2011, Dmitry K
 * Artistic License 2.0
 * http://www.opensource.org/licenses/artistic-license-2.0
 *
 * Date: Sat Feb 14 09:47:06 2011 -0700
**/


(function(){$.fn.QRCode=function(a,b){var c={width:200,height:200};if(b){$.extend(c,b)}this.each(function(){$(this).append("<img src='https://chart.googleapis.com/chart?cht=qr&chs="+c.width+"x"+c.height+"&chl="+escape(a)+"&choe=UTF-8&chld=H' alt='QR Code' />")})}})(jQuery);