(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["redirects-pro-Settings-vue","redirects-pro-FullSiteRedirect-vue","redirects-pro-partials-ServerConfigReloadWarning-vue"],{1095:function(e,t,s){"use strict";s.r(t);var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return s("div",{staticClass:"aioseo-redirects-settings"},[s("server-config-reload-warning"),s("core-card",{attrs:{slug:"redirectSettings","header-text":e.strings.redirectSettings}},[s("core-settings-row",{attrs:{name:e.strings.redirectMethod},scopedSlots:e._u([{key:"content",fn:function(){return[s("base-box-toggle",{attrs:{name:"breadcrumbsType",options:[{value:"php",slot:"php"},{value:"server",slot:"server"}]},scopedSlots:e._u([{key:"php",fn:function(){return[s("svg-php"),s("p",[e._v(e._s(e.strings.php))])]},proxy:!0},{key:"server",fn:function(){return[s("svg-globe"),s("p",[e._v(e._s(e.strings.webServer))])]},proxy:!0}]),model:{value:e.redirectOptions.main.method,callback:function(t){e.$set(e.redirectOptions.main,"method",t)},expression:"redirectOptions.main.method"}}),"server"===e.redirectOptions.main.method?s("div",{staticClass:"web-server-settings"},[e.detectedServer?e._e():s("core-alert",{staticClass:"detected-web-server unknown",attrs:{type:"red"},domProps:{innerHTML:e._s(e.strings.unknownServer)}}),e.detectedServer?[s("core-alert",{staticClass:"detected-web-server",attrs:{type:"blue"}},[e._v(" "+e._s(e.serverDetected)+" ")]),!0===e.redirectServerTest.failed?s("core-alert",{staticClass:"missing-include",attrs:{type:"yellow"},domProps:{innerHTML:e._s(e.missingInclude)}}):e._e()]:e._e(),s("base-button",{attrs:{type:"gray",size:"medium",loading:e.nginxLoading},on:{click:function(t){return e.exportRedirects("nginx")}}},[e._v(" "+e._s(e.strings.exportNginxConfigFile)+" ")]),s("base-button",{attrs:{type:"gray",size:"medium",loading:e.apacheLoading},on:{click:function(t){return e.exportRedirects("apache")}}},[e._v(" "+e._s(e.strings.exportHtaccessFile)+" ")])],2):e._e()]},proxy:!0}])}),s("core-settings-row",{staticClass:"redirects-logs",attrs:{name:e.strings.logs},scopedSlots:e._u([{key:"content",fn:function(){return[s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.logs.log404.enabled,callback:function(t){e.$set(e.redirectOptions.logs.log404,"enabled",t)},expression:"redirectOptions.logs.log404.enabled"}},[e._v(" "+e._s(e.strings.logs404)+" ")])],1),s("table-column",[s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.logs.log404.length),size:"small",options:e.lengthOptions,disabled:!e.redirectOptions.logs.log404.enabled},on:{input:function(t){return e.redirectOptions.logs.log404.length=e.setJsonValue(t)}}})],1)],1),"php"===e.redirectOptions.main.method?s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.logs.redirects.enabled,callback:function(t){e.$set(e.redirectOptions.logs.redirects,"enabled",t)},expression:"redirectOptions.logs.redirects.enabled"}},[e._v(" "+e._s(e.strings.redirectLogs)+" ")])],1),s("table-column",[s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.logs.redirects.length),size:"small",options:e.lengthOptions,disabled:!e.redirectOptions.logs.redirects.enabled},on:{input:function(t){return e.redirectOptions.logs.redirects.length=e.setJsonValue(t)}}})],1)],1):e._e(),e.redirectOptions.logs.redirects.enabled&&"php"===e.redirectOptions.main.method?s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.logs.external,callback:function(t){e.$set(e.redirectOptions.logs,"external",t)},expression:"redirectOptions.logs.external"}},[e._v(" "+e._s(e.strings.logExternal)+" "),s("core-tooltip",{scopedSlots:e._u([{key:"tooltip",fn:function(){return[e._v(" "+e._s(e.strings.logExternalDescription)+" ")]},proxy:!0}],null,!1,3501289874)},[s("svg-circle-question-mark")],1)],1)],1)],1):e._e(),e.redirectOptions.logs.redirects.enabled&&"php"===e.redirectOptions.main.method||e.redirectOptions.logs.log404.enabled?s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.logs.httpHeader,callback:function(t){e.$set(e.redirectOptions.logs,"httpHeader",t)},expression:"redirectOptions.logs.httpHeader"}},[e._v(" "+e._s(e.strings.logHttpHeader)+" "),s("core-tooltip",{scopedSlots:e._u([{key:"tooltip",fn:function(){return[e._v(" "+e._s(e.strings.logHeaderInformationDescription)+" ")]},proxy:!0}],null,!1,2011477852)},[s("svg-circle-question-mark")],1)],1)],1)],1):e._e()]},proxy:!0}])}),e.redirectOptions.logs.redirects.enabled&&"php"===e.redirectOptions.main.method||e.redirectOptions.logs.log404.enabled?s("core-settings-row",{staticClass:"redirects-ip-logging",attrs:{name:e.strings.ipLogging,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.logs.ipAddress.enabled,callback:function(t){e.$set(e.redirectOptions.logs.ipAddress,"enabled",t)},expression:"redirectOptions.logs.ipAddress.enabled"}},[e._v(" "+e._s(e.strings.logIpAddresses)+" ")])],1),s("table-column",[s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.logs.ipAddress.level),size:"small",options:e.ipLoggingOptions,disabled:!e.redirectOptions.logs.ipAddress.enabled},on:{input:function(t){return e.redirectOptions.logs.ipAddress.level=e.setJsonValue(t)}}})],1)],1),s("table-row",[s("table-column",[s("div",{staticClass:"aioseo-description",domProps:{innerHTML:e._s(e.strings.ipLoggingDescription)}})])],1)]},proxy:!0}],null,!1,507341610)}):e._e(),"php"===e.redirectOptions.main.method?[e.redirectOptions.logs.redirects.enabled&&"php"===e.redirectOptions.main.method?s("core-settings-row",{staticClass:"redirects-cache",attrs:{name:e.strings.httpCacheHeader,align:""},scopedSlots:e._u([{key:"content",fn:function(){return[s("table-row",[s("table-column",[s("base-toggle",{model:{value:e.redirectOptions.cache.httpHeader.enabled,callback:function(t){e.$set(e.redirectOptions.cache.httpHeader,"enabled",t)},expression:"redirectOptions.cache.httpHeader.enabled"}},[e._v(" "+e._s(e.strings.cacheRedirects)+" ")])],1),s("table-column",[s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.cache.httpHeader.length),size:"small",options:e.lengthOptions,disabled:!e.redirectOptions.cache.httpHeader.enabled},on:{input:function(t){return e.redirectOptions.cache.httpHeader.length=e.setJsonValue(t)}}})],1)],1)]},proxy:!0}],null,!1,3372802612)}):e._e()]:e._e(),s("core-settings-row",{staticClass:"redirects-monitor",attrs:{name:e.strings.monitorChanges},scopedSlots:e._u([{key:"name",fn:function(){return[e._v(" "+e._s(e.strings.monitorChanges)+" "),s("core-tooltip",{scopedSlots:e._u([{key:"tooltip",fn:function(){return[e._v(" "+e._s(e.strings.monitorChangesTooltip)+" ")]},proxy:!0}])},[s("svg-circle-question-mark")],1)]},proxy:!0},{key:"content",fn:function(){return[s("div",{staticClass:"option"},[s("base-toggle",{attrs:{size:"medium"},model:{value:e.redirectOptions.monitor.postTypes.all,callback:function(t){e.$set(e.redirectOptions.monitor.postTypes,"all",t)},expression:"redirectOptions.monitor.postTypes.all"}},[e._v(" "+e._s(e.strings.includeAllPostTypes)+" ")])],1),e.redirectOptions.monitor.postTypes.all?e._e():s("core-post-type-options",{attrs:{options:e.redirectOptions.monitor,type:"postTypes",excluded:["attachment"]}}),s("div",{staticClass:"option"},[s("base-toggle",{attrs:{size:"medium"},model:{value:e.redirectOptions.monitor.trash,callback:function(t){e.$set(e.redirectOptions.monitor,"trash",t)},expression:"redirectOptions.monitor.trash"}},[e._v(" "+e._s(e.strings.monitorTrash)+" ")])],1)]},proxy:!0}])}),s("core-settings-row",{staticClass:"redirects-defaults",attrs:{name:e.strings.redirectDefaults},scopedSlots:e._u([{key:"content",fn:function(){return[s("div",{staticClass:"option"},[s("base-toggle",{model:{value:e.redirectOptions.redirectDefaults.ignoreSlash,callback:function(t){e.$set(e.redirectOptions.redirectDefaults,"ignoreSlash",t)},expression:"redirectOptions.redirectDefaults.ignoreSlash"}},[e._v(" "+e._s(e.strings.ignoreSlash)+" ")])],1),s("div",{staticClass:"option"},[s("base-toggle",{model:{value:e.redirectOptions.redirectDefaults.ignoreCase,callback:function(t){e.$set(e.redirectOptions.redirectDefaults,"ignoreCase",t)},expression:"redirectOptions.redirectDefaults.ignoreCase"}},[e._v(" "+e._s(e.strings.ignoreCase)+" ")])],1),s("div",{staticClass:"option"},[s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.redirectType)+" ")]),s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.redirectDefaults.redirectType),size:"medium",options:e.$constants.REDIRECT_TYPES},on:{input:function(t){return e.redirectOptions.redirectDefaults.redirectType=e.setJsonValue(t)}}})],1),s("div",{staticClass:"option"},[s("div",{staticClass:"aioseo-description"},[e._v(" "+e._s(e.strings.queryParams)+" ")]),s("base-select",{attrs:{value:e.getJsonValue(e.redirectOptions.redirectDefaults.queryParam),size:"medium",options:e.$constants.REDIRECT_QUERY_PARAMS},on:{input:function(t){return e.redirectOptions.redirectDefaults.queryParam=e.setJsonValue(t)}}})],1)]},proxy:!0}])})],2)],1)},i=[],o=s("5530"),n=(s("d3b7"),s("3ca3"),s("ddb0"),s("2b3d"),s("99af"),s("2f62")),a=s("9c0e"),c=s("ab04"),d={components:{ServerConfigReloadWarning:c["default"]},mixins:[a["g"]],data:function(){return{saving:!1,nginxLoading:!1,apacheLoading:!1,strings:{redirectSettings:this.$t.__("Redirect Settings",this.$td),redirectMethod:this.$t.__("Redirect Method",this.$td),unknownServer:this.$t.sprintf(this.$t.__("We cannot detect your web server. Server redirects are disabled. %1$s",this.$td),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"redirectUnknownWebserver",!0)),php:this.$t.__("PHP",this.$td),webServer:this.$t.__("Web Server",this.$td),logs:this.$t.__("Logs",this.$td),ipLogging:this.$t.__("IP Logging",this.$td),httpCacheHeader:this.$t.__("HTTP Cache Header",this.$td),redirectDefaults:this.$t.__("Redirect Defaults",this.$td),logs404:this.$t.__("404 Logs",this.$td),redirectLogs:this.$t.__("Redirect Logs",this.$td),logExternal:this.$t.__("Log External Redirects",this.$td),logHttpHeader:this.$t.__("Log HTTP Header Information",this.$td),enableRedirectCache:this.$t.__("Enable Redirect Cache",this.$td),ignoreCase:this.$t.__("Ignore Case",this.$td),ignoreSlash:this.$t.__("Ignore Slash",this.$td),cacheRedirects:this.$t.__("Cache Redirects",this.$td),objectCache:this.$t.__("Object Cache",this.$td),ipLoggingDescription:this.$t.sprintf(this.$t.__("%1$sGDPR / Privacy information%2$s",this.$td),'<a target="_blank" href="'+this.$links.getDocUrl("redirectGdpr")+'">',"</a>"),logIpAddresses:this.$t.__("Log IP Addresses",this.$td),redirectType:this.$t.__("Redirect Type",this.$td),queryParams:this.$t.__("Query Parameters",this.$td),logExternalDescription:this.$t.sprintf(this.$t.__("Log redirects that happen on your site even if the redirect happened outside of %1$s",this.$td),"AIOSEO"),logHeaderInformationDescription:this.$t.__("Capture HTTP header information with the logs (except for cookies).",this.$td),exportNginxConfigFile:this.$t.sprintf(this.$t.__("Export %1$s config file",this.$td),"NGINX"),exportHtaccessFile:this.$t.sprintf(this.$t.__("Export %1$s file",this.$td),".htaccess"),autoWriteHtaccess:this.$t.sprintf(this.$t.__("Auto-write to %1$s",this.$td),".htaccess"),monitorChanges:this.$t.__("Automatic Redirects",this.$td),includeAllPostTypes:this.$t.__("Include All Post Types",this.$td),monitorTrash:this.$t.__("Monitor Trash",this.$td),monitorChangesTooltip:this.$t.__('This allows you to monitor changes to post types and automatically add redirects based on URL changes. These will show up with a group called "Modified Posts".',this.$td)},lengthOptions:[{label:this.$t.__("1 hour",this.$td),value:"hour"},{label:this.$t.__("1 day",this.$td),value:"day"},{label:this.$t.__("1 week",this.$td),value:"week"},{label:this.$t.__("Forever",this.$td),value:"forever"}],ipLoggingOptions:[{label:this.$t.__("Full Logging",this.$td),value:"full"},{label:this.$t.__("Anonymize IP",this.$td),value:"anonymous"}]}},computed:Object(o["a"])(Object(o["a"])({},Object(n["c"])("redirects",["redirectOptions","redirectServerTest"])),{},{serverDetected:function(){return this.$t.sprintf(this.$t.__("%1$s Server has been detected.",this.$td),this.detectedServer)},detectedServer:function(){return this.$aioseo.data.server.apache?"Apache":this.$aioseo.data.server.nginx?"NGINX":null},missingInclude:function(){var e=this.$aioseo.data.server.apache?"Include ":"include ",t=this.$aioseo.data.server.nginx?";":"",s="<br><code>"+e+this.$aioseo.redirects.path+t+"</code>";return this.$t.sprintf(this.$t.__("Make sure you include the following in your server configuration file: %1$s",this.$td),s)}}),methods:Object(o["a"])(Object(o["a"])({},Object(n["b"])("redirects",["exportServerRedirects"])),{},{exportRedirects:function(e){var t=this;this[e+"Loading"]=!0,this.exportServerRedirects(e).then((function(s){t[e+"Loading"]=!1;var r="apache"===e?"htaccess":e,i=new Blob([s.body.redirects]),o=document.createElement("a");o.href=URL.createObjectURL(i),o.download="aioseo-export-redirects-".concat(t.$moment().format("YYYY-MM-DD"),".").concat(r),o.click(),URL.revokeObjectURL(o.href)}))}})},l=d,p=(s("dde7"),s("2877")),g=Object(p["a"])(l,r,i,!1,null,null,null);t["default"]=g.exports},"1ddf":function(e,t,s){},2094:function(e,t,s){"use strict";s("1ddf")},ab04:function(e,t,s){"use strict";s.r(t);var r=function(){var e=this,t=e.$createElement,s=e._self._c||t;return e.redirectServerTest.failed&&"server"===e.redirectOptions.main.method?s("core-alert",{attrs:{size:"small",type:"yellow"}},[s("div",{domProps:{innerHTML:e._s(e.strings.nginxReload)}}),s("div",{domProps:{innerHTML:e._s(e.strings.dontKnow)}}),s("base-button",{attrs:{type:"blue",size:"small",loading:e.redirectServerTest.testing},on:{click:function(t){return e.testServerRedirects()}}},[e._v(" "+e._s(e.strings.checkAgain)+" ")])],1):e._e()},i=[],o=s("5530"),n=s("2f62"),a={data:function(){return{strings:{nginxReload:this.$t.sprintf(this.$t.__("Your redirect settings have been updated. In order for them to work properly you may need to reload your %1$s configuration. %2$s",this.$td),this.detectedServer(),this.$links.getDocLink(this.$constants.GLOBAL_STRINGS.learnMore,"redirectServerConfigReload",!0)),dontKnow:this.$t.__("If you don't know how to do that please revert your Redirect Method to PHP.",this.$td),checkAgain:this.$t.__("Check Again",this.$td)}}},computed:Object(o["a"])({},Object(n["c"])("redirects",["redirectOptions","redirectServerTest"])),methods:Object(o["a"])(Object(o["a"])({},Object(n["b"])("redirects",["testServerRedirects"])),{},{maybeTest:function(){this.testServerRedirects()},detectedServer:function(){return this.$aioseo.data.server.apache?"Apache":this.$aioseo.data.server.nginx?"NGINX":this.$t.__("Server",this.$td)}}),mounted:function(){this.maybeTest(),this.$bus.$on("changes-saved",this.maybeTest)},beforeDestroy:function(){this.$bus.$off("changes-saved",this.maybeTest)}},c=a,d=(s("2094"),s("2877")),l=Object(d["a"])(c,r,i,!1,null,"7fef8436",null);t["default"]=l.exports},dde7:function(e,t,s){"use strict";s("e945")},e945:function(e,t,s){}}]);