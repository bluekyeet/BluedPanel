(window.webpackJsonp=window.webpackJsonp||[]).push([[13],{416:function(e,a,t){"use strict";t.r(a);var i=t(2),n=t(150),o=t(3),c=t(55),s=t(161),r=t(0),l=t.n(r),m=t(167),d=t(54),p=t(56);a.default=()=>{const[e,a]=Object(r.useState)(!1),[t]=Object(r.useState)(!1),i=c.a.useStoreState((e=>e.status.value)),{clearFlashes:d}=Object(n.a)(),{connected:p,instance:j}=c.a.useStoreState((e=>e.socket)),D=Object(o.useStoreState)((e=>e.user.data.rootAdmin));return Object(r.useEffect)((()=>{if(!p||!j||"running"===i)return;const e=["steamcmd needs 250mb of free disk space to update","0x202 after update job"],t=t=>{e.some((e=>t.toLowerCase().includes(e)))&&a(!0)};return j.addListener(m.a.CONSOLE_OUTPUT,t),()=>{j.removeListener(m.a.CONSOLE_OUTPUT,t)}}),[p,j,i]),Object(r.useEffect)((()=>{d("feature:steamDiskSpace")}),[]),l.a.createElement(s.b,{visible:e,onDismissed:()=>a(!1),closeOnBackground:!1,showSpinnerOverlay:t},l.a.createElement(u,{key:"feature:steamDiskSpace"}),D?l.a.createElement(l.a.Fragment,null,l.a.createElement(h,null,l.a.createElement(S,null,"Out of available disk space...")),l.a.createElement(b,null,"This server has run out of available disk space and cannot complete the install or update process."),l.a.createElement(g,null,"Ensure the machine has enough disk space by typing"," ",l.a.createElement(f,null,"df -h")," on the machine hosting this server. Delete files or increase the available disk space to resolve the issue."),l.a.createElement(k,null,l.a.createElement(y,{onClick:()=>a(!1)},"Close"))):l.a.createElement(l.a.Fragment,null,l.a.createElement(_,null,l.a.createElement(w,null,"Out of available disk space...")),l.a.createElement(O,null,"This server has run out of available disk space and cannot complete the install or update process. Please get in touch with the administrator(s) and inform them of disk space issues."),l.a.createElement(C,null,l.a.createElement(v,{onClick:()=>a(!1)},"Close"))))};var u=Object(i.c)(p.a).withConfig({displayName:"SteamDiskSpaceFeature___StyledFlashMessageRender",componentId:"sc-1ak76ba-0"})({marginBottom:"1rem"}),h=Object(i.c)("div").withConfig({displayName:"SteamDiskSpaceFeature___StyledDiv",componentId:"sc-1ak76ba-1"})({marginTop:"1rem",alignItems:"center","@media (min-width: 640px)":{display:"flex"}}),S=Object(i.c)("h2").withConfig({displayName:"SteamDiskSpaceFeature___StyledH",componentId:"sc-1ak76ba-2"})({fontSize:"1.5rem",lineHeight:"2rem",marginBottom:"1rem","--tw-text-opacity":"1",color:"hsla(214, 15%, 91%, var(--tw-text-opacity))"}),b=Object(i.c)("p").withConfig({displayName:"SteamDiskSpaceFeature___StyledP",componentId:"sc-1ak76ba-3"})({marginTop:"1rem"}),g=Object(i.c)("p").withConfig({displayName:"SteamDiskSpaceFeature___StyledP2",componentId:"sc-1ak76ba-4"})({marginTop:"1rem"}),f=Object(i.c)("code").withConfig({displayName:"SteamDiskSpaceFeature___StyledCode",componentId:"sc-1ak76ba-5"})({fontFamily:'ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace',"--tw-bg-opacity":"1",backgroundColor:"rgba(47, 49, 54, var(--tw-bg-opacity))",borderRadius:"0.25rem",paddingTop:"0.25rem",paddingBottom:"0.25rem",paddingLeft:"0.5rem",paddingRight:"0.5rem"}),k=Object(i.c)("div").withConfig({displayName:"SteamDiskSpaceFeature___StyledDiv2",componentId:"sc-1ak76ba-6"})({marginTop:"2rem",alignItems:"center",justifyContent:"flex-end","@media (min-width: 640px)":{display:"flex"}}),y=Object(i.c)(d.a).withConfig({displayName:"SteamDiskSpaceFeature___StyledButton",componentId:"sc-1ak76ba-7"})({width:"100%",borderColor:"rgba(0, 0, 0, 0)","@media (min-width: 640px)":{width:"auto"}}),_=Object(i.c)("div").withConfig({displayName:"SteamDiskSpaceFeature___StyledDiv3",componentId:"sc-1ak76ba-8"})({marginTop:"1rem",alignItems:"center","@media (min-width: 640px)":{display:"flex"}}),w=Object(i.c)("h2").withConfig({displayName:"SteamDiskSpaceFeature___StyledH2",componentId:"sc-1ak76ba-9"})({fontSize:"1.5rem",lineHeight:"2rem",marginBottom:"1rem","--tw-text-opacity":"1",color:"hsla(214, 15%, 91%, var(--tw-text-opacity))"}),O=Object(i.c)("p").withConfig({displayName:"SteamDiskSpaceFeature___StyledP3",componentId:"sc-1ak76ba-10"})({marginTop:"1rem"}),C=Object(i.c)("div").withConfig({displayName:"SteamDiskSpaceFeature___StyledDiv4",componentId:"sc-1ak76ba-11"})({marginTop:"2rem",alignItems:"center",justifyContent:"flex-end","@media (min-width: 640px)":{display:"flex"}}),v=Object(i.c)(d.a).withConfig({displayName:"SteamDiskSpaceFeature___StyledButton2",componentId:"sc-1ak76ba-12"})({width:"100%",borderColor:"rgba(0, 0, 0, 0)","@media (min-width: 640px)":{width:"auto"}})}}]);