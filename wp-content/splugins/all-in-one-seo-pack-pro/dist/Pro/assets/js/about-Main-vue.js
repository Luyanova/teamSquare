(window["aioseopjsonp"]=window["aioseopjsonp"]||[]).push([["about-Main-vue","about-GettingStarted-vue","about-pro-LiteVsPro-vue"],{"0e93":function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("div")},o=[],a=s("2877"),n={},r=Object(a["a"])(n,i,o,!1,null,null,null);e["default"]=r.exports},7976:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,s=t._self._c||e;return s("core-main",{attrs:{"page-name":t.strings.pageName,showSaveButton:!1}},[s(t.$route.name,{tag:"component"})],1)},o=[],a=s("325d"),n=s("c0d2"),r=s("0e93"),l={components:{AboutUs:a["default"],GettingStarted:n["default"],LiteVsPro:r["default"]},data:function(){return{strings:{pageName:this.$t.__("About Us",this.$td)}}}},d=l,h=s("2877"),c=Object(h["a"])(d,i,o,!1,null,null,null);e["default"]=c.exports},c0d2:function(t,e,s){"use strict";s.r(e);var i=function(){var t=this,e=t.$createElement,i=t._self._c||e;return i("div",{staticClass:"aioseo-getting-started"},[t.$allowed("aioseo_setup_wizard")?i("core-getting-started",{attrs:{"disable-close":""}}):t._e(),t.$isPro?t._e():i("cta",{staticClass:"aioseo-getting-started-cta",attrs:{type:2,floating:!1,"button-text":t.strings.cta.button,"cta-link":t.$links.utmUrl("getting-started","main-cta"),"learn-more-link":t.$links.getUpsellUrl("getting-started","main-cta","home"),"feature-list":t.strings.cta.features,showLink:!1},scopedSlots:t._u([{key:"featured-image",fn:function(){return[i("img",{attrs:{src:s("cd82")}})]},proxy:!0}],null,!1,4266759503)},[i("template",{slot:"header-text"},[t._v(" "+t._s(t.strings.cta.header)+" ")]),i("template",{slot:"description"},[t._v(" "+t._s(t.upgradeToday)+" ")])],2),i("div",{staticClass:"aioseo-getting-started-documentation"},[i("grid-row",{staticClass:"header"},[i("grid-column",{staticClass:"header-title",attrs:{sm:"6",md:"6"}},[t._v(" "+t._s(t.strings.documentation.title)+" ")]),i("grid-column",{staticClass:"header-link",attrs:{sm:"6",md:"6"}},[i("a",{attrs:{href:t.strings.documentation.linkUrl,target:"_blank"}},[t._v(" "+t._s(t.strings.documentation.linkText)+" → ")])])],1),i("grid-row",{staticClass:"docs"},t._l(t.docs,(function(e,s){return i("grid-column",{key:s,staticClass:"doc",attrs:{sm:"12",md:"6"}},[i("div",{staticClass:"d-flex"},[i("svg-book"),i("a",{attrs:{href:e.url,target:"_blank"}},[t._v(" "+t._s(e.title)+" ")])],1)])})),1)],1)],1)},o=[],a={data:function(){return{strings:{cta:{title:this.$t.sprintf(this.$t.__("Get %1$s %2$s and Unlock all the Powerful Features",this.$td),"AIOSEO",this.$t.__("Pro",this.$td)),header:this.$t.sprintf(this.$t.__("Get %1$s %2$s and Unlock all the Powerful Features.",this.$td),"AIOSEO",this.$t.__("Pro",this.$td)),button:this.$t.sprintf(this.$t.__("Upgrade to %1$s Today",this.$td),"Pro"),features:[this.$t.__("Smart Schema",this.$td),this.$t.__("Local SEO",this.$td),this.$t.__("Redirection Manager",this.$t),this.$t.__("Link Assistant",this.$td),this.$t.__("News Sitemap",this.$td),this.$t.__("Video Sitemap",this.$td),this.$t.__("Image SEO",this.$td),this.$t.__("Custom Breadcrumb Templates",this.$td),this.$t.__("Advanced support for e-commerce",this.$td),this.$t.__("User Access Control",this.$td),this.$t.__("SEO for Categories, Tags and Custom Taxonomies",this.$td),this.$t.__("Social meta for Categories, Tags and Custom Taxonomies",this.$td),this.$t.__("Ad free (no banner adverts)",this.$td)]},videos:{title:this.$t.__("Video Tutorials",this.$td),linkText:this.$t.__("View all video tutorials",this.$td),linkUrl:"https://changeme"},documentation:{title:this.$t.sprintf(this.$t.__("%1$s Documentation",this.$td),"AIOSEO"),linkText:this.$t.__("See our full documentation",this.$td),linkUrl:this.$links.getDocUrl("home")}},videos:{video1:{title:this.$t.__("Basic Guide to Google Analytics",this.$td),url:"https://changeme"},video2:{title:this.$t.__("Basic Guide to Google Search Console",this.$td),url:"https://changeme"},video3:{title:this.$t.__("Best Practices for Domains and URLs",this.$td),url:"https://changeme"},video4:{title:this.$t.__("How to Control Search Results",this.$td),url:"https://changeme"},video5:{title:this.$t.sprintf(this.$t.__("Installing %1$s %2$s",this.$td),"AIOSEO",this.$t.__("Pro",this.$td)),url:"https://changeme"},video6:{title:this.$t.__("Optimizing your Content Headings",this.$td),url:"https://changeme"}},docs:{doc1:{title:"How do I get Google to show sitelinks for my site?",url:this.$links.getDocUrl("showSitelinks")},doc2:{title:"How do I use your API code examples?",url:this.$links.getDocUrl("apiCodeExamples")},doc3:{title:"What are media attachments and should I submit them to search engines?",url:this.$links.getDocUrl("whatAreMediaAttachments")},doc4:{title:"When to use NOINDEX or the robots.txt?",url:this.$links.getDocUrl("whenToUseNoindex")},doc5:{title:"How do I troubleshoot issues with AIOSEO?",url:this.$links.getDocUrl("troubleshootIssues")},doc6:{title:"How does the import process for SEO data work?",url:this.$links.getDocUrl("importProcessSeoData")},doc7:{title:"Installation instructions for AIOSEO Pro",url:this.$links.getDocUrl("installAioseoPro")},doc8:{title:"What are the minimum requirements for All in One SEO?",url:this.$links.getDocUrl("minimumRequirements")}}}},computed:{upgradeToday:function(){return this.$t.sprintf(this.$t.__("%1$s %2$s comes with many additional features to help take your site's SEO to the next level!",this.$td),"AIOSEO","Pro")}}},n=a,r=(s("dc35"),s("2877")),l=Object(r["a"])(n,i,o,!1,null,null,null);e["default"]=l.exports},cd82:function(t,e,s){t.exports=s.p+"img/news-sitemap.png"},dc35:function(t,e,s){"use strict";s("feca")},feca:function(t,e,s){}}]);