import{_ as c}from"./AppLayout-7bae28fb.js";import p from"./DeleteUserForm-a98c4ec2.js";import l from"./LogoutOtherBrowserSessionsForm-4ce64840.js";import{S as s}from"./SectionBorder-1d4b78fa.js";import f from"./TwoFactorAuthenticationForm-c95a453e.js";import u from"./UpdatePasswordForm-14eb788d.js";import _ from"./UpdateProfileInformationForm-3c2cbacc.js";import{o,c as d,w as n,a as i,e as r,b as t,f as a,F as h}from"./app-f916c78d.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./DialogModal-e3bef957.js";import"./SectionTitle-9aeda0c6.js";import"./DangerButton-e2485935.js";import"./TextInput-272e296c.js";import"./SecondaryButton-e9fcd7b9.js";import"./ActionMessage-40bf82c2.js";import"./PrimaryButton-e581b12c.js";import"./InputLabel-437451cd.js";import"./FormSection-5dbbb7d8.js";const g=i("h2",{class:"font-semibold text-xl text-gray-800 leading-tight"}," Profile ",-1),$={class:"max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"},w={key:0},k={key:1},y={key:2},z={__name:"Show",props:{confirmsTwoFactorAuthentication:Boolean,sessions:Array},setup(m){return(e,x)=>(o(),d(c,{title:"Profile"},{header:n(()=>[g]),default:n(()=>[i("div",null,[i("div",$,[e.$page.props.jetstream.canUpdateProfileInformation?(o(),r("div",w,[t(_,{user:e.$page.props.auth.user},null,8,["user"]),t(s)])):a("",!0),e.$page.props.jetstream.canUpdatePassword?(o(),r("div",k,[t(u,{class:"mt-10 sm:mt-0"}),t(s)])):a("",!0),e.$page.props.jetstream.canManageTwoFactorAuthentication?(o(),r("div",y,[t(f,{"requires-confirmation":m.confirmsTwoFactorAuthentication,class:"mt-10 sm:mt-0"},null,8,["requires-confirmation"]),t(s)])):a("",!0),t(l,{sessions:m.sessions,class:"mt-10 sm:mt-0"},null,8,["sessions"]),e.$page.props.jetstream.hasAccountDeletionFeatures?(o(),r(h,{key:3},[t(s),t(p,{class:"mt-10 sm:mt-0"})],64)):a("",!0)])])]),_:1}))}};export{z as default};