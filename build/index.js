!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{configurable:!1,enumerable:!0,get:r})},n.r=function(t){Object.defineProperty(t,"__esModule",{value:!0})},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="",n(n.s=1)}([function(t,e){!function(){t.exports=this.wp.element}()},function(t,e,n){"use strict";n.r(e);var r=n(0),o=wp.plugins.registerPlugin,u=wp.editPost.PluginPostStatusInfo;o("post-status-info-test",{render:function(){return Object(r.createElement)(u,null,Object(r.createElement)("p",null,"Post Status Info SlotFill"))}})}]);