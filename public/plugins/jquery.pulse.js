/*global jQuery*/
/*jshint curly:false*/

/*
Copyright (c) 2012, Jarrod Overson All rights reserved.

Redistribution and use in source and binary forms,
with or without modification, are permitted provided
that the following conditions are met:

  * Redistributions of source code must retain the above copyright
    notice, this list of conditions and the following disclaimer.

  * Redistributions in binary form must reproduce the above copyright
    notice, this list of conditions and the following disclaimer
    in the documentation and/or other materials provided with the distribution.

  * The names of its contributors may not be used to endorse or
    promote products derived from this software without specific
    prior written permission.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND
CONTRIBUTORS "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES,
INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF
MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL JARROD OVERSON BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY,
OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED
AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING
IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF
THE POSSIBILITY OF SUCH DAMAGE
*/
;(function ( $, window) {
  "use strict";

  var defaults = {
      pulses   : 1,
      interval : 0,
      returnDelay : 0,
      duration : 500
    };

  $.fn.pulse = function(properties, options, callback) {
    // $(...).pulse('destroy');
    var stop = properties === 'destroy';

    if (typeof options === 'function') {
      callback = options;
      options = {};
    }

    options = $.extend({}, defaults, options);

    if (!(options.interval >= 0))    options.interval = 0;
    if (!(options.returnDelay >= 0)) options.returnDelay = 0;
    if (!(options.duration >= 0))    options.duration = 500;
    if (!(options.pulses >= -1))     options.pulses = 1;
    if (typeof callback !== 'function') callback = function(){};

    return this.each(function () {
      var el = $(this),
          property,
          original = {};

      var data = el.data('pulse') || {};
      data.stop = stop;
      el.data('pulse', data);

      for (property in properties) {
        if (properties.hasOwnProperty(property)) original[property] = el.css(property);
      }

      var timesPulsed = 0;

      var fromOptions = $.extend({}, options);
      fromOptions.duration = options.duration / 2;
      fromOptions.complete = function() {
        window.setTimeout(animate, options.interval);
      };

      var toOptions = $.extend({}, options);
      toOptions.duration = options.duration / 2;
      toOptions.complete = function(){
        window.setTimeout(function(){
          el.animate(original, fromOptions);
        },options.returnDelay);
      };

      function animate() {
        if (typeof el.data('pulse') === 'undefined') return;
        if (el.data('pulse').stop) return;
        if (options.pulses > -1 && ++timesPulsed > options.pulses) return callback.apply(el);
        el.animate(
          properties,
          toOptions
        );
      }

      animate();
    });
  };

})( jQuery, window, document );
