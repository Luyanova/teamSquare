(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["sitemaps-NewsSitemap-vue","sitemaps-lite-video-sitemap-Blur-vue"],{"17a7":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("core-blur",[s("div",{staticClass:"aioseo-settings-row aioseo-section-description"},[t._v(" "+t._s(t.strings.description)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"videoSitemaps",!0))}})]),s("core-settings-row",{attrs:{name:t.strings.enableSitemap},scopedSlots:t._u([{key:"content",fn:function(){return[s("base-toggle",{attrs:{value:!0}})]},proxy:!0}])}),s("core-settings-row",{attrs:{name:t.$constants.GLOBAL_STRINGS.preview},scopedSlots:t._u([{key:"content",fn:function(){return[s("div",{staticClass:"aioseo-sitemap-preview"},[s("base-button",{attrs:{size:"medium",type:"blue"}},[s("svg-external"),t._v(" "+t._s(t.strings.openSitemap)+" ")],1)],1),s("div",{staticClass:"aioseo-description"},[t._v(" "+t._s(t.strings.noIndexDisplayed)+" "),s("br"),t._v(" "+t._s(t.strings.doYou404)+" "),s("span",{domProps:{innerHTML:t._s(t.$links.getDocLink(t.$constants.GLOBAL_STRINGS.learnMore,"blankSitemap",!0))}})])]},proxy:!0}])})],1)},o=[],n=s("92e5"),a={mixins:[n["c"]]},r=a,d=s("2877"),l=Object(d["a"])(r,i,o,!1,null,null,null);e["default"]=l.exports},"92e5":function(t,e,s){"use strict";s.d(e,"a",(function(){return i})),s.d(e,"b",(function(){return o})),s.d(e,"c",(function(){return n}));var i={methods:{validateLinksPerIndex:function(t){1>t.target.value&&(t.target.value=1),5e4<t.target.value&&(t.target.value=5e4)}}},o={data:function(){return{strings:{news:this.$t.__("News Sitemap",this.$td),setPublicationName:this.$t.__("Set Publication Name",this.$td),exclude:this.$t.__("Exclude Pages/Posts",this.$td),description:this.$t.__("Our Google News Sitemap lets you control which content you submit to Google News and only contains articles that were published in the last 48 hours. In order to submit a News Sitemap to Google, you must have added your site to Google’s Publisher Center and had it approved.",this.$td),enableSitemap:this.$t.__("Enable Sitemap",this.$td),openSitemap:this.$t.__("Open News Sitemap",this.$td),noIndexDisplayed:this.$t.__("Noindexed content will not be displayed in your sitemap.",this.$td),doYou404:this.$t.__("Do you get a blank sitemap or 404 error?",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock News Sitemaps",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("News Sitemaps are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td)}}}},n={data:function(){return{strings:{customFieldSupport:this.$t.__("Custom Field Support",this.$td),exclude:this.$t.__("Exclude Pages/Posts",this.$td),video:this.$t.__("Video Sitemap",this.$td),description:this.$t.__("The Video Sitemap works in much the same way as the XML Sitemap module, it generates an XML Sitemap specifically for video content on your site. Search engines use this information to display rich snippet information in search results.",this.$td),enableSitemap:this.$t.__("Enable Sitemap",this.$td),openSitemap:this.$t.__("Open Video Sitemap",this.$td),noIndexDisplayed:this.$t.__("Noindexed content will not be displayed in your sitemap.",this.$td),doYou404:this.$t.__("Do you get a blank sitemap or 404 error?",this.$td),ctaButtonText:this.$t.__("Upgrade to Pro and Unlock Video Sitemaps",this.$td),ctaHeader:this.$t.sprintf(this.$t.__("Video Sitemaps are only available for licensed %1$s %2$s users.",this.$td),"AIOSEO","Pro"),thisFeatureRequires:this.$t.__("This feature requires one of the following plans:",this.$td)}}}}}}]);