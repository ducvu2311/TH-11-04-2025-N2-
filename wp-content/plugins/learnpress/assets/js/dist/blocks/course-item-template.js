/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./assets/src/apps/js/blocks/courses/course-item-template/edit.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/blocks/courses/course-item-template/edit.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/data */ "@wordpress/data");
/* harmony import */ var _wordpress_data__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_data__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var _js_api_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! ../../../../../js/api.js */ "./assets/src/js/api.js");







function PostTemplateInnerBlocks({
  classList
}) {
  const innerBlocksProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useInnerBlocksProps)();
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    ...innerBlocksProps
  });
}
function PostTemplateBlockPreview({
  blocks,
  blockContextId,
  classList,
  isHidden,
  setActiveBlockContextId
}) {
  const blockPreviewProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.__experimentalUseBlockPreview)({
    blocks
  });
  const handleOnClick = () => {
    setActiveBlockContextId(blockContextId);
  };
  const style = {
    display: isHidden ? 'none' : undefined
  };
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", {
    ...blockPreviewProps,
    tabIndex: 0
    // eslint-disable-next-line jsx-a11y/no-noninteractive-element-to-interactive-role
    ,
    role: "button",
    onClick: handleOnClick,
    onKeyPress: handleOnClick,
    style: style
  });
}
const fetchLearnPressCourses = async (courseQuery, signal) => {
  const url = _js_api_js__WEBPACK_IMPORTED_MODULE_6__["default"].apiCourses;
  const params = '?return_type=json';
  const response = await fetch(url + params, {
    method: 'GET',
    signal
  });
  return await response.json();
};
const MemoizedPostTemplateBlockPreview = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.memo)(PostTemplateBlockPreview);
const Edit = ({
  clientId,
  context,
  attributes,
  setAttributes
}) => {
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps)();
  const [activeBlockContextId, setActiveBlockContextId] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)();
  const [coursesData, setCoursesData] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)();
  const [listCourses, setListCourses] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)([]);
  const [loadingAPI, setLoadingAPI] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useState)(0);
  const {
    columns
  } = attributes;

  // Fetch courses when query parameters change
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useEffect)(() => {
    var _context$lpCourseQuer;
    const courseQuery = (_context$lpCourseQuer = context.lpCourseQuery) !== null && _context$lpCourseQuer !== void 0 ? _context$lpCourseQuer : {};
    let signal, controller;
    const fetchCourses = async () => {
      try {
        setLoadingAPI(1);
        controller = new AbortController();
        signal = controller.signal;
        const data = await fetchLearnPressCourses(courseQuery, signal);
        setCoursesData(data);
        setListCourses(data.data.courses);
      } catch (error) {
        if (error.name !== 'AbortError') {
          console.error('Failed to fetch courses:', error);
        }
      } finally {
        setLoadingAPI(0);
      }
    };
    fetchCourses();
    return () => {
      controller.abort();
    };
  }, [context.lpCourseQuery]);
  const {
    blocks
  } = (0,_wordpress_data__WEBPACK_IMPORTED_MODULE_2__.useSelect)(select => {
    const {
      getBlocks
    } = select(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.store);
    return {
      blocks: getBlocks(clientId)
    };
  }, [clientId]);
  const blockContexts = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_3__.useMemo)(() => listCourses?.map(course => ({
    lpCourseData: course,
    courseId: course?.ID
  })), [listCourses]);
  if (loadingAPI) {
    return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
      ...blockProps
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("li", null, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Courses Fetching…', 'learnpress')));
  }
  if (listCourses.length === 0 && !loadingAPI) {
    const dataDummy = [{
      ID: 1,
      post_title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Course One', 'learnpress')
    }, {
      ID: 2,
      post_title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Course two', 'learnpress')
    }];
    setListCourses(dataDummy);
  }
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(react__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InspectorControls, null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Layout Settings')
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_4__.RangeControl, {
    label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_5__.__)('Columns'),
    value: columns,
    onChange: value => setAttributes({
      columns: value
    }),
    min: 1,
    max: 12
  }))), (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("ul", {
    ...blockProps
  }, blockContexts && blockContexts.map(blockContext => (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.BlockContextProvider, {
    key: blockContext.courseId,
    value: blockContext
  }, blockContext.courseId === (activeBlockContextId || blockContexts[0]?.courseId) ? (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(PostTemplateInnerBlocks, {
    classList: blockContext.classList
  }) : null, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(MemoizedPostTemplateBlockPreview, {
    blocks: blocks,
    blockContextId: blockContext.courseId,
    classList: blockContext.classList,
    setActiveBlockContextId: setActiveBlockContextId,
    isHidden: blockContext.courseId === (activeBlockContextId || blockContexts[0]?.courseId)
  })))));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Edit);

/***/ }),

/***/ "./assets/src/apps/js/blocks/courses/course-item-template/save.js":
/*!************************************************************************!*\
  !*** ./assets/src/apps/js/blocks/courses/course-item-template/save.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__);


const Save = props => {
  const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.useBlockProps.save();
  return (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ...blockProps
  }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_1__.InnerBlocks.Content, null));
};
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (Save);

/***/ }),

/***/ "./assets/src/js/api.js":
/*!******************************!*\
  !*** ./assets/src/js/api.js ***!
  \******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/**
 * List API on backend
 *
 * @since 4.2.6
 * @version 1.0.1
 */

const lplistAPI = {};
let lp_rest_url;
if ('undefined' !== typeof lpDataAdmin) {
  lp_rest_url = lpDataAdmin.lp_rest_url;
  lplistAPI.admin = {
    apiAdminNotice: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/admin-notices',
    apiAdminOrderStatic: lpDataAdmin.lp_rest_url + 'lp/v1/orders/statistic',
    apiAddons: lpDataAdmin.lp_rest_url + 'lp/v1/addon/all',
    apiAddonAction: lpDataAdmin.lp_rest_url + 'lp/v1/addon/action-n',
    apiAddonsPurchase: lpDataAdmin.lp_rest_url + 'lp/v1/addon/info-addons-purchase',
    apiSearchCourses: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/search-course',
    apiSearchUsers: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/search-user',
    apiAssignUserCourse: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/assign-user-course',
    apiUnAssignUserCourse: lpDataAdmin.lp_rest_url + 'lp/v1/admin/tools/unassign-user-course'
  };
}
if ('undefined' !== typeof lpData) {
  lp_rest_url = lpData.lp_rest_url;
  lplistAPI.frontend = {
    apiWidgets: lpData.lp_rest_url + 'lp/v1/widgets/api',
    apiCourses: lpData.lp_rest_url + 'lp/v1/courses/archive-course',
    apiAJAX: lpData.lp_rest_url + 'lp/v1/load_content_via_ajax/',
    apiProfileCoverImage: lpData.lp_rest_url + 'lp/v1/profile/cover-image'
  };
}
if (lp_rest_url) {
  lplistAPI.apiAJAX = lp_rest_url + 'lp/v1/load_content_via_ajax/';
  lplistAPI.apiCourses = lp_rest_url + 'lp/v1/courses/';
}
/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (lplistAPI);

/***/ }),

/***/ "react":
/*!************************!*\
  !*** external "React" ***!
  \************************/
/***/ ((module) => {

module.exports = window["React"];

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ ((module) => {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ ((module) => {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ ((module) => {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/data":
/*!******************************!*\
  !*** external ["wp","data"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["data"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ ((module) => {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ ((module) => {

module.exports = window["wp"]["i18n"];

/***/ }),

/***/ "./assets/src/apps/js/blocks/courses/course-item-template/block.json":
/*!***************************************************************************!*\
  !*** ./assets/src/apps/js/blocks/courses/course-item-template/block.json ***!
  \***************************************************************************/
/***/ ((module) => {

module.exports = /*#__PURE__*/JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","apiVersion":3,"name":"learnpress/course-item-template","title":"Course Item Template","category":"","description":"Course Item Template","textdomain":"learnpress","keywords":["course item","learnpress"],"usesContext":["lpCourseQuery"],"supports":{"align":true},"attributes":{"columns":{"type":"number","default":1}},"ancestor":["learnpress/list-courses"]}');

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			var getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
/*!*************************************************************************!*\
  !*** ./assets/src/apps/js/blocks/courses/course-item-template/index.js ***!
  \*************************************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./edit */ "./assets/src/apps/js/blocks/courses/course-item-template/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./save */ "./assets/src/apps/js/blocks/courses/course-item-template/save.js");
/* harmony import */ var _block_json__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./block.json */ "./assets/src/apps/js/blocks/courses/course-item-template/block.json");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__);

/**
 * Register block single course property.
 */




(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__.registerBlockType)('learnpress/course-item-template', {
  ..._block_json__WEBPACK_IMPORTED_MODULE_3__,
  icon: {
    src: (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("svg", {
      xmlns: "http://www.w3.org/2000/svg",
      viewBox: "0 0 24 24",
      width: "24",
      height: "24",
      "aria-hidden": "true",
      focusable: "false"
    }, (0,react__WEBPACK_IMPORTED_MODULE_0__.createElement)("path", {
      fillRule: "evenodd",
      d: "M5 5.5h14a.5.5 0 01.5.5v1.5a.5.5 0 01-.5.5H5a.5.5 0 01-.5-.5V6a.5.5 0 01.5-.5zM4 9.232A2 2 0 013 7.5V6a2 2 0 012-2h14a2 2 0 012 2v1.5a2 2 0 01-1 1.732V18a2 2 0 01-2 2H6a2 2 0 01-2-2V9.232zm1.5.268V18a.5.5 0 00.5.5h12a.5.5 0 00.5-.5V9.5h-13z",
      clipRule: "evenodd"
    }))
  },
  edit: _edit__WEBPACK_IMPORTED_MODULE_1__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_2__["default"]
});
/******/ })()
;
//# sourceMappingURL=course-item-template.js.map