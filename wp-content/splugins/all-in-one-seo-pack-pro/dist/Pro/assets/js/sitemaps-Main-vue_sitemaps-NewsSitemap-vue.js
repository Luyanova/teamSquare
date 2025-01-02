(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["sitemaps-Main-vue_sitemaps-NewsSitemap-vue"],{"0874":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("core-blur",[s("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[t._v(" "+t._s(t.strings.description)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"newsSitemaps",!0))}})]),s("core-settings-row",{attrs:{name:t.strings.enableSitemap},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-toggle",{attrs:{value:!0}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"aioseo-sitemap-preview"},[s("base-button",{attrs:{size:"medium",type:"blue"}},[s("svg-external"),t._v(" "+t._s(t.strings.openSitemap)+" ")],1)],1),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.noIndexDisplayed)+" "),s("br"),t._v(" "+t._s(t.strings.doYou404)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"blankSitemap",!0))}})])]},proxy:!0}])})],1)},n=[],a=s("92e5"),o={mixins:[a["b"]]},r=o,c=s("2877"),l=Object(c["a"])(r,i,n,!1,null,null,null);e["default"]=l.exports},2758:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("core-card",{attrs:{slug:"newsSitemap","header-text":t.strings.news}},[s("blur"),s("cta",{attrs:{"cta-button-visible":t.$addons.userCanInstallOrActivate("aioseo-news-sitemap"),"cta-button-visible-warning":t.strings.permissionWarning,"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-news-sitemap","same-tab":"","cta-button-action":"","cta-button-loading":t.activationLoading,"button-text":t.strings.ctaButtonTextActivate,"learn-more-link":t.$links.getDocUrl("newsSitemaps"),"feature-list":[t.strings.setPublicationName,t.strings.exclude]},on:{"cta-button-click":t.activateAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.newsSitemapHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.failed?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.description)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})],1)],1)},n=[],a=s("5530"),o=s("17a7"),r=s("9c0e"),c=s("92e5"),l=s("2f62"),d={mixins:[r["g"],c["b"]],components:{Blur:o["default"]},data:function(){return{failed:!1,activationLoading:!1,pagePostOptions:[],strings:{newsSitemapHeader:this.$t.__("Enable Google News Sitemap on your Site",this.$tdPro),ctaButtonTextActivate:this.$t.__("Activate News Sitemap",this.$tdPro),learnMoreText:this.$t.__("Learn more about News Sitemaps",this.$tdPro),sitemapSettings:this.$t.__("News Sitemap Settings",this.$tdPro),publicationName:this.$t.__("Publication Name",this.$tdPro),postTypes:this.$t.__("Post Types",this.$tdPro),includeAllPostTypes:this.$t.__("Include All Post Types",this.$tdPro),selectPostTypes:this.$t.__("Select which Post Types appear in your sitemap.",this.$tdPro),advancedSettings:this.$t.__("Advanced Settings",this.$tdPro),excludePostsPages:this.$t.__("Exclude Posts / Pages",this.$tdPro),priorityScore:this.$t.__("Priority Score",this.$tdPro),activateError:this.$t.__("An error occurred while activating the addon. Please upload it manually or contact support for more information.",this.$td),permissionWarning:this.$t.__("You currently don't have permission to activate this addon. Please ask a site administrator to activate first.",this.$td)}}},computed:Object(a["a"])(Object(a["a"])({},Object(l["e"])(["options","addons"])),{},{getExcludedPostTypes:function(){return["attachment"]}}),methods:Object(a["a"])(Object(a["a"])(Object(a["a"])({},Object(l["b"])(["installPlugins"])),Object(l["d"])(["updateAddon"])),{},{activateAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var e=this.$addons.getAddon("aioseo-news-sitemap");this.installPlugins([{plugin:e.basename}]).then((function(s){t.activationLoading=!1,s.body.failed.length?t.failed=!0:(e.isActive=!0,t.updateAddon(e))})).catch((function(){t.activationLoading=!1}))}})},p=d,u=s("2877"),m=Object(u["a"])(p,i,n,!1,null,null,null);e["default"]=m.exports},"47c1":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("core-card",{attrs:{slug:"newsSitemap","header-text":t.strings.news}},[s("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[t._v(" "+t._s(t.strings.description)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"newsSitemaps",!0))}})]),s("core-settings-row",{attrs:{name:t.strings.enableSitemap},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-toggle",{model:{value:t.options.sitemap.news.enable,callback:function(e){t.$set(t.options.sitemap.news,"enable",e)},expression:"options.sitemap.news.enable"}})]},proxy:!0}])}),t.options.sitemap.news.enable?s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"aioseo-sitemap-preview"},[s("base-button",{attrs:{size:"medium",type:"blue",tag:"a",href:t.$aioseo.urls.newsSitemapUrl,target:"_blank"}},[s("svg-external"),t._v(" "+t._s(t.strings.openSitemap)+" ")],1)],1),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.noIndexDisplayed)+" "),s("br"),t._v(" "+t._s(t.strings.doYou404)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"blankSitemap",!0))}})])]},proxy:!0}],null,!1,3776392846)}):t._e()],1),t.options.sitemap.news.enable?s("core-card",{attrs:{slug:"newsSitemapSettings","header-text":t.strings.sitemapSettings}},[s("core-settings-row",{attrs:{id:"news-sitemap-publication-name",name:t.strings.publicationName},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-input",{attrs:{size:"medium"},model:{value:t.options.sitemap.news.publicationName,callback:function(e){t.$set(t.options.sitemap.news,"publicationName",e)},expression:"options.sitemap.news.publicationName"}})]},proxy:!0}],null,!1,1216089854)}),s("core-settings-row",{attrs:{name:t.strings.postTypes},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-checkbox",{attrs:{size:"medium"},model:{value:t.options.sitemap.news.postTypes.all,callback:function(e){t.$set(t.options.sitemap.news.postTypes,"all",e)},expression:"options.sitemap.news.postTypes.all"}},[t._v(" "+t._s(t.strings.includeAllPostTypes)+" ")]),t.options.sitemap.news.postTypes.all?t._e():s("core-post-type-options",{attrs:{options:t.options.sitemap.news,type:"postTypes",excluded:t.getExcludedPostTypes}}),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.selectPostTypes)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"selectPostTypesNews",!0))}})])]},proxy:!0}],null,!1,1747524496)})],1):t._e(),t.options.sitemap.news.enable?s("core-card",{attrs:{slug:"newsAdvancedSettings",toggles:t.options.sitemap.news.advancedSettings.enable},scopedSlots:t._u([{key:"header",fn:function(){return[s("base-toggle",{model:{value:t.options.sitemap.news.advancedSettings.enable,callback:function(e){t.$set(t.options.sitemap.news.advancedSettings,"enable",e)},expression:"options.sitemap.news.advancedSettings.enable"}}),t._v(" "+t._s(t.strings.advancedSettings)+" ")]},proxy:!0}],null,!1,357191883)},[s("core-settings-row",{staticClass:"aioseo-exclude-pages-posts",attrs:{name:t.strings.excludePostsPages},scopedSlots:t._u([{key:"content",fn:function(){return[s("core-exclude-posts",{attrs:{options:t.options.sitemap.news.advancedSettings,type:"posts"}})]},proxy:!0}],null,!1,2817990227)})],1):t._e()],1)},n=[],a=s("5530"),o=(s("4d63"),s("ac1f"),s("25f0"),s("5319"),s("9c0e")),r=s("92e5"),c=s("2f62"),l={mixins:[o["g"],r["b"]],data:function(){return{pagePostOptions:[],strings:{sitemapSettings:this.$t.__("News Sitemap Settings",this.$tdPro),publicationName:this.$t.__("Publication Name",this.$tdPro),postTypes:this.$t.__("Post Types",this.$tdPro),includeAllPostTypes:this.$t.__("Include All Post Types",this.$tdPro),selectPostTypes:this.$t.__("Select which Post Types appear in your sitemap.",this.$tdPro),advancedSettings:this.$t.__("Advanced Settings",this.$tdPro),excludePostsPages:this.$t.__("Exclude Posts / Pages",this.$tdPro),priorityScore:this.$t.__("Priority Score",this.$tdPro),noResult:this.$t.__("No pages or posts found with that title or ID. Try again!",this.$tdPro),clear:this.$t.__("Clear",this.$tdPro)}}},computed:Object(a["a"])(Object(a["a"])({},Object(c["e"])(["options"])),{},{getExcludedPostTypes:function(){return["attachment"]}}),methods:Object(a["a"])(Object(a["a"])({},Object(c["b"])(["getObjects"])),{},{processGetPagesPosts:function(t){var e=this;return this.getObjects(t).then((function(t){e.pagePostOptions=t.body.posts}))},getOptionTitle:function(t,e){var s=new RegExp("(".concat(e,")"),"gi");return t.replace(s,'<span class="search-term">$1</span>')}})},d=l,p=s("2877"),u=Object(p["a"])(d,i,n,!1,null,null,null);e["default"]=u.exports},"68ec":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-news-sitemap"},[t.shouldShowMain?s("news-sitemap"):t._e(),t.shouldShowActivate?s("activate"):t._e(),t.shouldShowUpdate?s("update"):t._e(),t.shouldShowLite?s("lite"):t._e()],1)},n=[],a=s("2758"),o=s("b96e"),r=s("47c1"),c=s("c472"),l=s("9c0e"),d={mixins:[l["a"]],components:{Activate:a["default"],Lite:o["default"],NewsSitemap:r["default"],Update:c["default"]},data:function(){return{addonSlug:"aioseo-news-sitemap"}}},p=d,u=(s("e67e"),s("2877")),m=Object(u["a"])(p,i,n,!1,null,null,null);e["default"]=m.exports},b96e:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",{staticClass:"aioseo-news-sitemap-lite"},[s("core-card",{attrs:{slug:"newsSitemap","header-text":t.strings.news,noSlide:!0}},[s("blur"),s("cta",{attrs:{"feature-list":[t.strings.setPublicationName,t.strings.exclude],"cta-link":t.$links.getPricingUrl("news-sitemap","news-sitemap-upsell"),"button-text":t.strings.ctaButtonText,"learn-more-link":t.$links.getUpsellUrl("news-sitemap",null,"home")},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.ctaHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[t.$isPro&&t.$addons.requiresUpgrade("aioseo-news-sitemap")&&t.$addons.currentPlans("aioseo-news-sitemap")?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.thisFeatureRequires)+" "),s("strong",[t._v(t._s(t.$addons.currentPlans("aioseo-news-sitemap")))])]):t._e(),t._v(" "+t._s(t.strings.description)+" ")]},proxy:!0}])})],1)],1)},n=[],a=s("0874"),o=s("92e5"),r={mixins:[o["b"]],components:{Blur:a["default"]}},c=r,l=(s("fe08"),s("2877")),d=Object(l["a"])(c,i,n,!1,null,null,null);e["default"]=d.exports},c472:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div",[s("core-card",{attrs:{slug:"newsSitemap","header-text":t.strings.news}},[s("blur"),s("cta",{attrs:{"cta-button-visible":t.$addons.userCanUpdate("aioseo-news-sitemap"),"cta-button-visible-warning":t.strings.permissionWarning,"cta-link":t.$aioseo.urls.aio.featureManager+"&aioseo-activate=aioseo-news-sitemap","same-tab":"","cta-button-action":"","cta-button-loading":t.activationLoading,"button-text":t.strings.ctaButtonTextActivate,"learn-more-link":t.$links.getDocUrl("newsSitemaps"),"feature-list":[t.strings.setPublicationName,t.strings.exclude]},on:{"cta-button-click":t.upgradeAddon},scopedSlots:t._u([{key:"header-text",fn:function(){return[t._v(" "+t._s(t.strings.newsSitemapHeader)+" ")]},proxy:!0},{key:"description",fn:function(){return[s("core-alert",{attrs:{type:"yellow"}},[t._v(" "+t._s(t.strings.updateRequired)+" ")]),t.failed?s("core-alert",{attrs:{type:"red"}},[t._v(" "+t._s(t.strings.activateError)+" ")]):t._e(),t._v(" "+t._s(t.strings.ctaDescription)+" ")]},proxy:!0},{key:"learn-more-text",fn:function(){return[t._v(" "+t._s(t.strings.learnMoreText)+" ")]},proxy:!0}])})],1)],1)},n=[],a=s("5530"),o=s("17a7"),r=s("9c0e"),c=s("92e5"),l=s("2f62"),d={mixins:[r["g"],c["b"]],components:{Blur:o["default"]},data:function(){return{failed:!1,activationLoading:!1,pagePostOptions:[],strings:{newsSitemapHeader:this.$t.__("Enable Google News Sitemap on your Site",this.$tdPro),ctaButtonTextActivate:this.$t.__("Update News Sitemap",this.$tdPro),learnMoreText:this.$t.__("Learn more about News Sitemaps",this.$tdPro),sitemapSettings:this.$t.__("News Sitemap Settings",this.$tdPro),publicationName:this.$t.__("Publication Name",this.$tdPro),postTypes:this.$t.__("Post Types",this.$tdPro),includeAllPostTypes:this.$t.__("Include All Post Types",this.$tdPro),selectPostTypes:this.$t.__("Select which Post Types appear in your sitemap.",this.$tdPro),advancedSettings:this.$t.__("Advanced Settings",this.$tdPro),excludePostsPages:this.$t.__("Exclude Posts / Pages",this.$tdPro),priorityScore:this.$t.__("Priority Score",this.$tdPro),activateError:this.$t.__("An error occurred while activating the addon. Please upload it manually or contact support for more information.",this.$td),permissionWarning:this.$t.__("You currently don't have permission to update this addon. Please ask a site administrator to update.",this.$td),updateRequired:this.$t.sprintf(this.$t.__("This addon requires an update. %1$s %2$s requires a minimum version of %3$s for the %4$s addon. You currently have %5$s installed.",this.$td),"AIOSEO","Pro",this.$addons.getAddon("aioseo-news-sitemap").minimumVersion,"News Sitemap",this.$addons.getAddon("aioseo-news-sitemap").installedVersion)}}},computed:Object(a["a"])(Object(a["a"])({},Object(l["e"])(["options","addons"])),{},{getExcludedPostTypes:function(){return["attachment"]}}),methods:Object(a["a"])(Object(a["a"])(Object(a["a"])({},Object(l["b"])(["upgradePlugins"])),Object(l["d"])(["updateAddon"])),{},{upgradeAddon:function(){var t=this;this.failed=!1,this.activationLoading=!0;var e=this.$addons.getAddon("aioseo-news-sitemap");this.upgradePlugins([{plugin:e.sku}]).then((function(s){if(s.body.failed.length)return t.activationLoading=!1,void(t.failed=!0);var i=s.body.completed[e.sku];t.activationLoading=!1,e.hasMinimumVersion=!0,e.isActive=!0,e.installedVersion=i.installedVersion,t.updateAddon(e)})).catch((function(){t.activationLoading=!1}))}})},p=d,u=s("2877"),m=Object(u["a"])(p,i,n,!1,null,null,null);e["default"]=m.exports},e67e:function(t,e,s){"use strict";s("f932")},f4e5:function(t,e,s){},f932:function(t,e,s){},fe08:function(t,e,s){"use strict";s("f4e5")}}]);