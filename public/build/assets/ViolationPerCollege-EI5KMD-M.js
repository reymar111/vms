import{m as g,P as x,j as c,c as f,o as a,w as b,a as y,b as t,f as p,F as _,l as v,t as s}from"./app-D6fEnl88.js";import{A as w}from"./AuthenticatedLayout-CYKAFKPo.js";import{_ as C}from"./_plugin-vue_export-helper-DlAUqK2U.js";/* empty css            */const k={props:["data"],components:{AuthenticatedLayout:w,Link:x,Head:g},data(){return{start_date:null,end_date:null}},mounted(){},computed:{},methods:{filterData(){this.$inertia.post("/reports/vehicle_utilization",{start_date:this.start_date,end_date:this.end_date})},printReport(){const l=this.$refs.printTable,e=window.open("","","width=1000,height=800"),i=`
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        padding: 20px;
                    }
                    h3 {
                        text-align: center;
                        margin-bottom: 20px;
                    }
                    .title-main {
                        text-align: center;
                        font-weight: bold;
                        margin-bottom: 1px;
                    }
                    .title-sub {
                        text-align: center;
                        font-style: italic;
                        margin-bottom: 25px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                    }
                    th, td {
                        border: 1px solid #ccc;
                        padding: 8px;
                        text-align: left;
                    }
                    th {
                        background-color: #f3f4f6;
                    }
                </style>
            
                <div class="title-main">Kalinga State University</div>
                <div class="title-sub">Bulanao, Tabuk City, Kalinga</div>
                <h3>Violation Per College Report</h3>
            ${l.outerHTML}`;e.document.write(i),e.document.close(),e.onload=function(){e.focus(),e.print()}}}},V={class:"py-1"},H={class:"mx-auto sm:px-6 lg:px-8"},B={class:"overflow-hidden bg-white shadow-lg sm:rounded-lg"},L={class:"p-6 text-gray-900 flex flex-col md:flex-row md:justify-between md:items-center space-y-4 md:space-y-0"},R={class:"min-w-full border border-gray-200",ref:"printTable"},$={class:"px-4 py-2"},A={class:"px-4 py-2"},P={class:"px-4 py-2"};function T(l,e,n,h,i,r){const m=c("Head"),u=c("AuthenticatedLayout");return a(),f(u,null,{default:b(()=>[y(m,{title:"Reports / Violation/College"}),t("div",V,[t("div",H,[t("div",B,[t("div",L,[e[2]||(e[2]=t("h3",{class:"text-2xl font-bold"},"Reports - Violation Per College",-1)),t("button",{onClick:e[0]||(e[0]=(...o)=>r.printReport&&r.printReport(...o)),class:"px-4 py-2 mb-2 bg-green-600 text-white rounded-lg hover:bg-green-700 flex items-center space-x-2"},e[1]||(e[1]=[t("svg",{class:"w-6 h-6 text-white-800","aria-hidden":"true",xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"currentColor",viewBox:"0 0 24 24"},[t("path",{"fill-rule":"evenodd",d:"M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z","clip-rule":"evenodd"})],-1)]))]),t("table",R,[e[3]||(e[3]=t("thead",{class:"bg-gray-100"},[t("tr",null,[t("th",{class:"px-4 py-2 text-left text-gray-700 border-b"},"#"),t("th",{class:"px-4 py-2 text-left text-gray-700 border-b"},"College"),t("th",{class:"px-4 py-2 text-left text-gray-700 border-b"},"Total Violations")])],-1)),t("tbody",null,[(a(!0),p(_,null,v(n.data,(o,d)=>(a(),p("tr",{class:"border-b",key:d},[t("td",$,s(d+1),1),t("td",A,s(o.college_name),1),t("td",P,s(o.total_violations),1)]))),128))])],512)])])])]),_:1})}const K=C(k,[["render",T]]);export{K as default};
