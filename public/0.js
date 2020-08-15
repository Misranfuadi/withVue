(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js&":
/*!****************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js& ***!
  \****************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
/* harmony default export */ __webpack_exports__["default"] = ({
  data: function data() {
    return {
      counter: 1000,
      blogs: [],
      showItem: true
    };
  },
  methods: {
    ubah: function ubah(angka) {
      this.counter += angka;
    }
  },
  created: function created() {
    this.counter = 0;
    var posts = [{
      title: "judul 1",
      post: "ini isi post 1",
      id: 1
    }, {
      title: "judul 2",
      post: "ini isi post 2",
      id: 2
    }, {
      title: "judul 3",
      post: "ini isi post 3",
      id: 3
    }, {
      title: "judul 4",
      post: "ini isi post 4",
      id: 4
    }];
    this.blogs = posts;
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2&":
/*!********************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2& ***!
  \********************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c("div", [
    _c("h2", [_vm._v("data counter " + _vm._s(_vm.counter))]),
    _vm._v(" "),
    _c(
      "button",
      {
        on: {
          click: function($event) {
            return _vm.ubah(1)
          }
        }
      },
      [_vm._v("Tambah")]
    ),
    _vm._v(" "),
    _c(
      "button",
      {
        on: {
          click: function($event) {
            return _vm.ubah(-1)
          }
        }
      },
      [_vm._v("Kurang")]
    ),
    _vm._v(" "),
    _c("br"),
    _vm._v(" "),
    _c("div", [
      _vm.showItem
        ? _c("h2", [_vm._v("ini tampilan TRUE")])
        : _c("h2", [_vm._v("ini tampilan FALSE")])
    ]),
    _vm._v(" "),
    _c(
      "button",
      {
        on: {
          click: function($event) {
            _vm.showItem = !_vm.showItem
          }
        }
      },
      [_vm._v("Ubah tampilan")]
    ),
    _vm._v(" "),
    _c("br"),
    _vm._v(" "),
    _vm.blogs.length
      ? _c(
          "div",
          _vm._l(_vm.blogs, function(blog, i) {
            return _c("div", { key: i }, [
              _c("h3", [_vm._v(_vm._s(blog.title))]),
              _vm._v(" "),
              _c("p", [_vm._v(_vm._s(blog.post))])
            ])
          }),
          0
        )
      : _c("div", [_c("h2", [_vm._v("no data")])])
  ])
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/pages/basic/datas.vue":
/*!*******************************************************!*\
  !*** ./resources/js/components/pages/basic/datas.vue ***!
  \*******************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./datas.vue?vue&type=template&id=5223b1e2& */ "./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2&");
/* harmony import */ var _datas_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./datas.vue?vue&type=script&lang=js& */ "./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _datas_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__["render"],
  _datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/pages/basic/datas.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js&":
/*!********************************************************************************!*\
  !*** ./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js& ***!
  \********************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_datas_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../node_modules/vue-loader/lib??vue-loader-options!./datas.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/basic/datas.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_datas_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2&":
/*!**************************************************************************************!*\
  !*** ./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2& ***!
  \**************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../../../node_modules/vue-loader/lib??vue-loader-options!./datas.vue?vue&type=template&id=5223b1e2& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/pages/basic/datas.vue?vue&type=template&id=5223b1e2&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_datas_vue_vue_type_template_id_5223b1e2___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);