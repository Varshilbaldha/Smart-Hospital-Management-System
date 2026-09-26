// Database-driven reports charts and local exports.
const d=window.reportChartData||{};
const revenueChart=document.getElementById('revenueChart');
if(revenueChart)new Chart(revenueChart,{type:'line',data:{labels:d.revenueLabels||[],datasets:[{label:'Revenue',data:d.revenueData||[],borderColor:'#28bf37',backgroundColor:'rgba(160,239,180,.17)',borderWidth:2,fill:true,tension:.4,pointRadius:3}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{color:'#f0f1f6ab'}},y:{beginAtZero:true,grid:{color:'#f0f1f6ab'}}}}});
const departmentChart=document.getElementById('departmentChart');
if(departmentChart)new Chart(departmentChart,{type:'doughnut',data:{labels:d.departmentLabels||[],datasets:[{data:d.departmentData||[],backgroundColor:['#f56fee','#78c8e5','#63f325','#6ce1ba','#635bff','#ffb84d','#ef6b6b','#7c8cff'],borderWidth:1}]},options:{responsive:true,maintainAspectRatio:false,cutout:'70%',plugins:{legend:{position:'right',labels:{boxWidth:12,font:{size:12}}}}}});
const appointmentChart=document.getElementById('appointmentChart');
if(appointmentChart)new Chart(appointmentChart,{type:'bar',data:{labels:d.appointmentLabels||[],datasets:[{data:d.appointmentData||[],backgroundColor:'#635BFF',borderRadius:8,borderSkipped:false}]},options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{x:{grid:{display:false}},y:{beginAtZero:true,grid:{color:'#eef2f7'}}}}});

document.getElementById('exportPdf')?.addEventListener('click',()=>window.print());
document.getElementById('exportExcel')?.addEventListener('click',()=>downloadCsv());
document.querySelectorAll('.report-download').forEach(btn=>btn.addEventListener('click',()=>downloadCsv(btn.dataset.report||'Hospital Report')));
function downloadCsv(){const table=document.getElementById('reportsTable');if(!table)return;const rows=[...table.querySelectorAll('tr')].map(r=>[...r.querySelectorAll('th,td')].slice(0,4).map(c=>'"'+c.innerText.replace(/"/g,'""').replace(/\n/g,' ')+'"').join(','));const blob=new Blob([rows.join('\n')],{type:'text/csv;charset=utf-8'});const a=document.createElement('a');a.href=URL.createObjectURL(blob);a.download='hospital_reports.csv';a.click();URL.revokeObjectURL(a.href);}
