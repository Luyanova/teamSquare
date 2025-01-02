(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["local-seo-OpeningHours-vue","local-seo-lite-opening-hours-Blur-vue","local-seo-lite-opening-hours-OpeningHours-vue","local-seo-pro-opening-hours-Activate-vue","local-seo-pro-opening-hours-OpeningHours-vue","local-seo-pro-opening-hours-Update-vue","local-seo-pro-partials-ActivateCta-vue","local-seo-pro-partials-UpdateCta-vue"],{"0a43":function(t,s,e){"use strict";e("de52")},"0eaa":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("cta",{attrs:{"cta-button-visible":t.$addons.userCanUpdate("aioseo-local-business"),"cta-button-visible-warning":t.strings.permissionWarning,"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-local-business","cta-button-action":"","cta-button-loading":t.activationLoading,"same-tab":"","button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getDocUrl("localSeo"),"feature-list":[t.strings.businessType,t.strings.businessContact,t.strings.paymentInfo,t.strings.image,t.strings.showOpeningHours,t.strings.googleMaps]},on:{"cta-button-click":t.activateAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.locationSeoHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[e("core-alert",{attrs:{type:"yellow"}},[t._v(" "+t._s(t.strings.updateRequired)+" ")]),t.failed?e("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})},i=[],o=e("5530"),n=e("2f62"),l={data:function(){return{failed:!1,activationLoading:!1,strings:{locationSeoHeader:this.$t.__("Enable Local SEO on your Site",this.$tdPro),ctaDescription:this.$t.__("The Local SEO module is a premium feature that enables businesses to tell Google about their business, including their business name, address and phone number, opening hours and price range.  This information may be displayed as a Knowledge Graph card or business carousel in the search engine sidebar.",this.$tdPro),ctaButtonText:this.$t.__("Update Local SEO",this.$tdPro),learnMoreText:this.$t.__("Learn more about Local SEO",this.$tdPro),showOpeningHours:this.$t.__("Show Opening Hours",this.$td),selectTimeZoneCTA:this.$t.__("Select your timezone",this.$td),googleMaps:this.$t.__("Google Maps",this.$td),businessType:this.$t.__("Type",this.$td),businessContact:this.$t.__("Contact Info",this.$td),paymentInfo:this.$t.__("Payment Info",this.$td),image:this.$t.__("Image",this.$td),permissionWarning:this.$t.__("You currently don't have permission to update this addon. Please ask a site administrator to update.",this.$td),activateError:this.$t.__("An error occurred while activating the addon. Please upload it manually or contact support for more information.",this.$td),updateRequired:this.$t.sprintf(this.$t.__("This addon requires an update. %1$s %2$s requires a minimum version of %3$s for the %4$s addon. You currently have %5$s installed.",this.$td),"AIOSEO","Pro",this.$addons.getAddon("aioseo-local-business").minimumVersion,"Local SEO",this.$addons.getAddon("aioseo-local-business").installedVersion)}}},methods:Object(o["a"])(Object(o["a"])({},Object(n["b"])(["upgradePlugins"])),{},{activateAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var s=this.$addons.getAddon("aioseo-local-business");this.upgradePlugins([{plugin:s.sku}]).then((function(s){if(s.body.failed.length)return t.activationLoading=!1,void(t.failed=!0);window.location.reload()})).catch((function(){t.activationLoading=!1}))}})},r=l,c=e("2877"),u=Object(c["a"])(r,a,i,!1,null,null,null);s["default"]=u.exports},"16c1":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-opening-hours"},[e("core-card",{attrs:{slug:"localBusinessOpeningHours","header-text":t.strings.openingHours}},[e("core-settings-row",{staticClass:"info-openinghours-row",attrs:{name:t.strings.showOpeningHours,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("base-radio-toggle",{attrs:{name:"openingHours",options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]},model:{value:t.getDataObject().show,callback:function(s){t.$set(t.getDataObject(),"show",s)},expression:"getDataObject().show"}})],1)]},proxy:!0}])}),e("local-business-opening-hours-display-info",{attrs:{label:t.strings.displayOpeningHours,displayOptions:t.displayInfo}}),t.getDataObject().show&&t.isMultipleLocations()&&t.$aioseo.license.isActive?e("core-settings-row",{attrs:{name:t.strings.defaultLocationSettings,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("core-alert",{domProps:{innerHTML:t._s(t.strings.closedLabelIntro)}})]},proxy:!0}],null,!1,496858497)}):t._e(),t.getDataObject().show?e("core-settings-row",{staticClass:"info-labels-row",attrs:{name:t.strings.labels,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("span",{staticClass:"field-description mt-8"},[t._v(t._s(t.strings.open24Label))]),e("base-input",{attrs:{size:"medium"},model:{value:t.getDataObject().labels.alwaysOpen,callback:function(s){t.$set(t.getDataObject().labels,"alwaysOpen",s)},expression:"getDataObject().labels.alwaysOpen"}}),e("div",{staticClass:"aioseo-description"},[t._v(t._s(t.strings.open24LabelDesc))])],1),e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("span",{staticClass:"field-description"},[t._v(t._s(t.strings.closedLabel))]),e("base-input",{attrs:{type:"text",size:"medium"},model:{value:t.getDataObject().labels.closed,callback:function(s){t.$set(t.getDataObject().labels,"closed",s)},expression:"getDataObject().labels.closed"}}),e("div",{staticClass:"aioseo-description"},[t._v(t._s(t.strings.closedLabelDesc))])],1)]},proxy:!0}],null,!1,609632856)}):t._e(),t.getDataObject().show?e("core-settings-row",{staticClass:"info-settings-row",attrs:{name:"Settings",align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("base-toggle",{model:{value:t.getDataObject().alwaysOpen,callback:function(s){t.$set(t.getDataObject(),"alwaysOpen",s)},expression:"getDataObject().alwaysOpen"}},[t._v(" "+t._s(t.strings.open247)+" ")])],1),e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left mt-16"},[t.getDataObject().alwaysOpen?t._e():e("base-toggle",{model:{value:t.getDataObject().use24hFormat,callback:function(s){t.$set(t.getDataObject(),"use24hFormat",s)},expression:"getDataObject().use24hFormat"}},[t._v(" "+t._s(t.strings.use24hFormat)+" ")])],1)]},proxy:!0}],null,!1,1790874724)}):t._e(),t.getDataObject().show&&!t.getDataObject().alwaysOpen?e("core-settings-row",{staticClass:"info-hours-row",attrs:{name:t.strings.hours,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},t._l(t.weekdays,(function(s,a){return e("div",{key:a,staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(s)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{disabled:t.getWeekDay(a).open24h||t.getWeekDay(a).closed,size:"medium",options:t.getDataObject().use24hFormat?t.$constants.HOURS_24H_FORMAT:t.$constants.HOURS_12H_FORMAT,value:t.getSelectOptions(t.getWeekDay(a).openTime)},on:{input:function(s){return t.saveDay(a,"openTime",s.value)}}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{disabled:t.getWeekDay(a).open24h||t.getWeekDay(a).closed,size:"medium",options:t.getDataObject().use24hFormat?t.$constants.HOURS_24H_FORMAT:t.$constants.HOURS_12H_FORMAT,value:t.getSelectOptions(t.getWeekDay(a).closeTime)},on:{input:function(s){return t.saveDay(a,"closeTime",s.value)}}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{disabled:t.getWeekDay(a).closed,size:"medium"},model:{value:t.getWeekDay(a).open24h,callback:function(s){t.$set(t.getWeekDay(a),"open24h",s)},expression:"getWeekDay(index).open24h"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"},model:{value:t.getWeekDay(a).closed,callback:function(s){t.$set(t.getWeekDay(a),"closed",s)},expression:"getWeekDay(index).closed"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)])})),0)]},proxy:!0}],null,!1,3629777455)}):t._e()],1)],1)},i=[],o=e("5530"),n=(e("7db0"),e("2f62")),l={data:function(){return{displayInfo:{block:{copy:"",desc:this.$t.sprintf(this.$t.__('To add this block, edit a page or post and search for the "%1$s Local - Opening Hours" block.',this.$td),"AIOSEO")},shortcode:{copy:"[aioseo_local_opening_hours]",desc:this.$t.sprintf(this.$t.__("Use the following shortcode to display the opening hours info. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"localSeoShortcodeOpeningHours",!0))},widget:{copy:"",desc:this.$t.sprintf(this.$t.__('To add this widget, visit the %1$swidgets page%2$s and look for the "%3$s Local - Opening Hours" widget.',this.$td),'<a href="'.concat(this.$aioseo.urls.admin.widgets,'" target="_blank">'),"</a>","AIOSEO")},php:{copy:"<?php if( function_exists( 'aioseo_local_opening_hours' ) ) aioseo_local_opening_hours(); ?>",desc:this.$t.sprintf(this.$t.__("Use the following PHP code anywhere in your theme to display the opening hours. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"localSeoFunctionOpeningHours",!0))}},strings:{openingHours:this.$t.__("Opening Hours Settings",this.$td),showOpeningHours:this.$t.__("Show Opening Hours",this.$td),displayOpeningHours:this.$t.__("Display Opening Hours",this.$td),labels:this.$t.__("Labels",this.$td),defaultLocationSettings:this.$t.__("Default Location Settings",this.$td),closedLabel:this.$t.__("Closed",this.$td),closedLabelDesc:this.$t.__("Displayed when the business is closed.",this.$td),closedLabelIntro:this.$t.sprintf(this.$t.__("Below are the default settings for all locations, which can be overwritten per %1$slocation%2$s.",this.$td),'<a href="'.concat(this.$aioseo.localBusiness.postTypeEditLink,'">'),"</a>"),alwaysOpenLabel:this.$t.__("Open 24h label",this.$td),open24LabelDesc:this.$t.__("Displayed when the business is open all day long.",this.$td),open24Label:this.$t.__("Open 24h",this.$td),open247:this.$t.__("Open 24/7",this.$td),use24hFormat:this.$t.__("Use 24h format",this.$td),timezone:this.$t.__("Timezone",this.$td),selectTimeZone:this.$t.__("Select your timezone",this.$td),hours:this.$t.__("Hours",this.$td),open24h:this.$t.__("Open 24h",this.$td),closed:this.$t.__("Closed",this.$td)},weekdays:{monday:this.$t.__("Monday",this.$td),tuesday:this.$t.__("Tuesday",this.$td),wednesday:this.$t.__("Wednesday",this.$td),thursday:this.$t.__("Thursday",this.$td),friday:this.$t.__("Friday",this.$td),saturday:this.$t.__("Saturday",this.$td),sunday:this.$t.__("Sunday",this.$td)}}},computed:Object(o["a"])({},Object(n["e"])(["currentPost","options"])),methods:{isMultipleLocations:function(){return"metabox"===this.$root._data.screenContext?this.currentPost.local_seo.locations.general.multiple:this.options.localBusiness.locations.general.multiple},getDataObject:function(){return"metabox"===this.$root._data.screenContext?this.currentPost.local_seo.openingHours:this.options.localBusiness.openingHours},getSelectOptions:function(t){return this.getDataObject().use24hFormat?this.$constants.HOURS_24H_FORMAT.find((function(s){return s.value===t})):this.$constants.HOURS_12H_FORMAT.find((function(s){return s.value===t}))},getSelectTimezone:function(t){return this.$constants.TIMEZONES.find((function(s){return s.value===t}))},saveDay:function(t,s,e){this.$set(this.getDataObject().days[t],s,e)},saveTimezone:function(t){this.$set(this.getDataObject(),"timezone",t)},getWeekDay:function(t){return this.getDataObject().days[t]}}},r=l,c=(e("48cc"),e("2877")),u=Object(c["a"])(r,a,i,!1,null,null,null);s["default"]=u.exports},"19f8":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("core-card",{attrs:{slug:"localBusinessOpeningHours","header-text":t.strings.openingHours,noSlide:!0}},[e("blur"),e("update-cta")],1)],1)},i=[],o=e("8f5a"),n=e("0eaa"),l={components:{Blur:o["default"],UpdateCta:n["default"]},data:function(){return{strings:{openingHours:this.$t.__("Opening Hours Settings",this.$td)}}}},r=l,c=e("2877"),u=Object(c["a"])(r,a,i,!1,null,null,null);s["default"]=u.exports},2195:function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("cta",{attrs:{"cta-button-visible":t.$addons.userCanInstallOrActivate("aioseo-local-business"),"cta-button-visible-warning":t.strings.permissionWarning,"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-local-business","cta-button-action":"","cta-button-loading":t.activationLoading,"same-tab":"","button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getDocUrl("localSeo"),"feature-list":[t.strings.businessType,t.strings.businessContact,t.strings.paymentInfo,t.strings.image,t.strings.showOpeningHours,t.strings.googleMaps]},on:{"cta-button-click":t.activateAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.locationSeoHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.failed?e("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})},i=[],o=e("5530"),n=e("2f62"),l={data:function(){return{failed:!1,activationLoading:!1,strings:{locationSeoHeader:this.$t.__("Enable Local SEO on your Site",this.$tdPro),ctaDescription:this.$t.__("The Local SEO module is a premium feature that enables businesses to tell Google about their business, including their business name, address and phone number, opening hours and price range.  This information may be displayed as a Knowledge Graph card or business carousel in the search engine sidebar.",this.$tdPro),ctaButtonText:this.$t.__("Activate Local SEO",this.$tdPro),learnMoreText:this.$t.__("Learn more about Local SEO",this.$tdPro),showOpeningHours:this.$t.__("Show Opening Hours",this.$td),selectTimeZoneCTA:this.$t.__("Select your timezone",this.$td),googleMaps:this.$t.__("Google Maps",this.$td),businessType:this.$t.__("Type",this.$td),businessContact:this.$t.__("Contact Info",this.$td),paymentInfo:this.$t.__("Payment Info",this.$td),image:this.$t.__("Image",this.$td),activateError:this.$t.__("An error occurred while activating the addon. Please upload it manually or contact support for more information.",this.$td),permissionWarning:this.$t.__("You currently don't have permission to activate this addon. Please ask a site administrator to activate first.",this.$td)}}},methods:Object(o["a"])(Object(o["a"])(Object(o["a"])({},Object(n["b"])(["installPlugins"])),Object(n["d"])(["updateAddon"])),{},{activateAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var s=this.$addons.getAddon("aioseo-local-business");this.installPlugins([{plugin:s.basename}]).then((function(s){if(s.body.failed.length)return t.activationLoading=!1,void(t.failed=!0);window.location.reload()})).catch((function(){t.activationLoading=!1}))}})},r=l,c=e("2877"),u=Object(c["a"])(r,a,i,!1,null,null,null);s["default"]=u.exports},"474a":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-opening-hours"},[t.shouldShowMain?e("opening-hours"):t._e(),t.shouldShowActivate?e("activate"):t._e(),t.shouldShowUpdate?e("update"):t._e(),t.shouldShowLite?e("lite"):t._e()],1)},i=[],o=e("16c1"),n=e("8c21"),l=e("adb8"),r=e("19f8"),c=e("9c0e"),u={mixins:[c["a"]],components:{OpeningHours:o["default"],Activate:n["default"],Lite:l["default"],Update:r["default"]},data:function(){return{addonSlug:"aioseo-local-business"}}},d=u,h=e("2877"),_=Object(h["a"])(d,a,i,!1,null,null,null);s["default"]=_.exports},"48cc":function(t,s,e){"use strict";e("99c4")},"8c21":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",[e("core-card",{attrs:{slug:"localBusinessOpeningHours","header-text":t.strings.openingHours,noSlide:!0}},[e("blur"),e("activate-cta")],1)],1)},i=[],o=e("2195"),n=e("8f5a"),l={components:{ActivateCta:o["default"],Blur:n["default"]},data:function(){return{strings:{openingHours:this.$t.__("Opening Hours Settings",this.$td)}}}},r=l,c=e("2877"),u=Object(c["a"])(r,a,i,!1,null,null,null);s["default"]=u.exports},"8f5a":function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-opening-hours-blur"},[e("core-blur",[e("core-settings-row",{staticClass:"info-openinghours-row",attrs:{name:t.strings.showOpeningHours,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("base-radio-toggle",{attrs:{name:"openingHours",value:!0,options:[{label:t.$constants.GLOBAL_STRINGS.no,value:!1},{label:t.$constants.GLOBAL_STRINGS.yes,value:!0}]}})],1)]},proxy:!0}])}),e("core-settings-row",{staticClass:"info-hours-row",attrs:{name:t.strings.hours,align:""},scopedSlots:t._u([{key:"content",fn:function(){return[e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("base-toggle",[t._v(" "+t._s(t.strings.open247)+" ")])],1),e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left mt-16"},[e("base-toggle",[t._v(" "+t._s(t.strings.use24hFormat)+" ")])],1),e("div",{staticClass:"aioseo-col col-xs-12 text-xs-left"},[e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.monday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.tuesday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.wednesday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.thursday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.friday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.saturday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)]),e("div",{staticClass:"aioseo-col-flex text-xs-left"},[e("div",{staticClass:"aioseo-col-day text-xs-left"},[t._v(" "+t._s(t.strings.sunday)+" ")]),e("div",{staticClass:"aioseo-col-hours text-xs-left"},[e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"09:00"}}),e("span",{staticClass:"separator"},[t._v("-")]),e("base-select",{attrs:{size:"medium",options:t.$constants.HOURS_24H_FORMAT,value:"17:00"}})],1),e("div",{staticClass:"aioseo-col-alwaysopen text-xs-left"},[e("base-checkbox",{attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.open24h)+" ")]),e("base-checkbox",{staticClass:"closed-label",attrs:{size:"medium"}},[t._v(" "+t._s(t.strings.closed)+" ")])],1)])])]},proxy:!0}])})],1)],1)},i=[],o={data:function(){return{strings:{showOpeningHours:this.$t.__("Show Opening Hours",this.$td),displayOpeningHours:this.$t.__("Display Opening Hours",this.$td),labels:this.$t.__("Labels",this.$td),closedLabel:this.$t.__("Closed label",this.$td),closedLabelDesc:this.$t.__("Text to display when 'Closed' setting is checked",this.$td),alwaysOpenLabel:this.$t.__("Open 24h label",this.$td),alwaysOpenLabelDesc:this.$t.__("Text to display when 'Open 24h' setting is checked",this.$td),open247:this.$t.__("Open 24/7",this.$td),use24hFormat:this.$t.__("Use 24h format",this.$td),timezone:this.$t.__("Timezone",this.$td),selectTimeZone:this.$t.__("Select your timezone:",this.$td),hours:this.$t.__("Opening Hours",this.$td),monday:this.$t.__("Monday",this.$td),tuesday:this.$t.__("Tuesday",this.$td),wednesday:this.$t.__("Wednesday",this.$td),thursday:this.$t.__("Thursday",this.$td),friday:this.$t.__("Friday",this.$td),saturday:this.$t.__("Saturday",this.$td),sunday:this.$t.__("Sunday",this.$td),open24h:this.$t.__("Open 24h",this.$td),closed:this.$t.__("Closed",this.$td)}}}},n=o,l=e("2877"),r=Object(l["a"])(n,a,i,!1,null,null,null);s["default"]=r.exports},"99c4":function(t,s,e){},adb8:function(t,s,e){"use strict";e.r(s);var a=function(){var t=this,s=t.$createElement,e=t._self._c||s;return e("div",{staticClass:"aioseo-opening-hours"},[e("core-card",{attrs:{slug:"localBusinessOpeningHours",noSlide:!0},scopedSlots:t._u([{key:"header",fn:function(){return[t._v(" "+t._s(t.strings.openingHours)+" "),e("core-pro-badge")]},proxy:!0}])},[e("blur"),e("cta",{attrs:{"cta-link":t.$links.getPricingUrl("local-seo","local-seo-upsell","opening-hours"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("local-seo",null,"home"),"feature-list":t.features},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.$isPro&&t.$addons.requiresUpgrade("aioseo-local-business")&&t.$addons.currentPlans("aioseo-local-business")?e("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.thisFeatureRequires)+" "),e("strong",[t._v(t._s(t.$addons.currentPlans("aioseo-local-business")))])]):t._e(),t._v(" "+t._s(t.strings.locationInfo1)+" ")]},proxy:!0}])})],1)],1)},i=[],o=e("8f5a"),n={components:{Blur:o["default"]},data:function(){return{features:[this.$t.__("Show Opening Hours",this.$td),this.$t.__("Multiple Locations",this.$td),this.$t.__("Opening Hours block, widget and shortcode",this.$td)],strings:{locationInfo1:this.$t.__("Local Business schema markup enables you to tell Google about your business, including your business name, address and phone number, opening hours and price range. This information may be displayed as a Knowledge Graph card or business carousel.",this.$td),openingHours:this.$t.__("Opening Hours Settings",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Local SEO",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Local SEO is only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td)}}}},l=n,r=(e("0a43"),e("2877")),c=Object(r["a"])(l,a,i,!1,null,null,null);s["default"]=c.exports},de52:function(t,s,e){}}]);