import{T as b,o as i,e as u,b as t,u as s,w as m,F as h,Z as x,t as y,f as c,a as o,j as f,g as d,n as v,c as k,i as V}from"./app-f916c78d.js";import{A as $}from"./AuthenticationCard-8f8d2834.js";import{_ as B}from"./AuthenticationCardLogo-0dbdc234.js";import{_ as C}from"./Checkbox-5bacc9c0.js";import{_ as p,a as _}from"./TextInput-272e296c.js";import{_ as g}from"./InputLabel-437451cd.js";import{_ as N}from"./PrimaryButton-e581b12c.js";import"./_plugin-vue_export-helper-c27b6911.js";const P={key:0,class:"mb-4 font-medium text-sm text-green-600"},R=["onSubmit"],S={class:"mt-4"},j={class:"block mt-4"},q={class:"flex items-center"},F=o("span",{class:"ml-2 text-sm text-gray-600"},"Remember me",-1),L={class:"flex items-center justify-end mt-4"},U={class:"flex items-center justify-end mt-4"},H={__name:"Login",props:{canResetPassword:Boolean,status:String},setup(n){const e=b({email:"",password:"",remember:!1}),w=()=>{e.transform(l=>({...l,remember:e.remember?"on":""})).post(route("login"),{onFinish:()=>e.reset("password")})};return(l,a)=>(i(),u(h,null,[t(s(x),{title:"Log in"}),t($,null,{logo:m(()=>[t(B)]),default:m(()=>[n.status?(i(),u("div",P,y(n.status),1)):c("",!0),o("form",{onSubmit:V(w,["prevent"])},[o("div",null,[t(g,{for:"email",value:"Email"}),t(p,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":a[0]||(a[0]=r=>s(e).email=r),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username"},null,8,["modelValue"]),t(_,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),o("div",S,[t(g,{for:"password",value:"Password"}),t(p,{id:"password",modelValue:s(e).password,"onUpdate:modelValue":a[1]||(a[1]=r=>s(e).password=r),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"current-password"},null,8,["modelValue"]),t(_,{class:"mt-2",message:s(e).errors.password},null,8,["message"])]),o("div",j,[o("label",q,[t(C,{checked:s(e).remember,"onUpdate:checked":a[2]||(a[2]=r=>s(e).remember=r),name:"remember"},null,8,["checked"]),F])]),o("div",L,[t(s(f),{href:l.route("register"),class:"underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[d(" Don't have account? ")]),_:1},8,["href"]),t(N,{class:v(["ml-4",{"opacity-25":s(e).processing}]),disabled:s(e).processing},{default:m(()=>[d(" Log in ")]),_:1},8,["class","disabled"])]),o("div",U,[n.canResetPassword?(i(),k(s(f),{key:0,href:l.route("password.request"),class:"underline text-sm text-gray-400 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"},{default:m(()=>[d(" Reset Password ")]),_:1},8,["href"])):c("",!0)])],40,R)]),_:1})],64))}};export{H as default};