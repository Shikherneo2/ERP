// JavaScript Document
jake = 0 ;
noProds = 0; 
indexXml = null;
xmlDoc = null;
tableObj = null;
allObj = new Array(5);

locArray = new Array(20);

function loadXMLDoc() {
  
  if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
  }
  else {
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  
  xhttp.open("GET","http://localhost/erp/products.xml",false);
  xhttp.send("");
  
  xmlDoc = xhttp.responseXML; // so only once
} 

function loi2(i, opt){
  if(opt==1)
    use="code";
  else
    use="name";

  if(xmlDoc.getElementsByTagName(use)[i]){
    x = xmlDoc.getElementsByTagName(use)[i];
    y = x.childNodes[0];
    
    return y.nodeValue;
  }
}

function show2(){
  tableObj.style.display='';
}

function hide2(){
  tableObj.style.display='none';
}

function sh2(ss, j, opt){
    
  indexXml = checkCode(ss, opt);
  
  x=xmlDoc.getElementsByTagName("name")[j];
  name=x.childNodes[0].nodeValue;
  
  x=xmlDoc.getElementsByTagName("code")[j];
  code=x.childNodes[0].nodeValue;
  
  x=xmlDoc.getElementsByTagName("price")[j];
  price_temp=x.childNodes[0].nodeValue;
  
  allObj[1].value=name;
  allObj[0].value=code;
  allObj[4].value=price_temp;
  
  if(opt==1)
    searchLoc(1,ss); // 1 for code
  else
    searchLoc(2,ss);
  
  allObj[3].length=0;
  
  for(var f=0; f<locArray[indexXml].noLoc; f++){
    allObj[3].options[f] = new Option( locArray[indexXml].location[f] );
  }
}

function searchLoc(opt, code){
  var j = 0;
  var k = 0;
  var found = 0;
  var indexXml = checkCode(code, opt);
  
  locArray[indexXml].location = new Array(30);
  
  while(xmlDoc.getElementsByTagName(use)[j]){
    x=xmlDoc.getElementsByTagName(use)[j];        
    
    if(x.childNodes[0].nodeValue == code){
      found++;
      locArray[indexXml].location[k] = xmlDoc.getElementsByTagName("location")[j].childNodes[0].nodeValue;
      k++;
    }
    j++;           
  }
    
  if(found)
    locArray[indexXml].noLoc = k;
            
}

function now2(evt, obj, opt){

  var i=0;
  var num_times=0;
  var done = 0;
  var nam; 

  noProds = 0;
  varId = new String(obj.id);
  temp = varId.substr(0,3);


  for(j=1; j<=5; j++){
    temp2 = new String(temp.concat(""+j));
    
    allObj[j-1] = document.getElementById(temp2);
  }
      
  var str = allObj[opt-1].value + String.fromCharCode(evt.which);
  var h = str.length;
  
  //checks if the node returned is a text node
  if(isNodeWhitespace(obj.nextSibling.nextSibling))
    tableObj = obj.nextSibling.nextSibling.nextSibling;
  else
    tableObj = obj.nextSibling.nextSibling;

  if(opt==1){
    while( loi2(i,1) ){
        
      nam=loi2(i,1);
        
       if(nam.substring(0,h).toLowerCase()==str.toLowerCase()){
         
          if(checkCode(nam,1) == -1){
              
              locArray[noProds] = new Object();
              locArray[noProds].code = nam;
              noProds++;
              
              if(done==0){
                show2();
                tableObj.innerHTML="<tr><td class=high> <a onMouseOver=sh2(this.innerHTML,"+i+",1)>"+nam+ '</a></td></tr>';
              }
              else
                tableObj.innerHTML+="<tr><td class=high> <a onMouseOver=sh2(this.innerHTML,"+i+",1)>"+nam+ '</a></td></tr>'; //alows to refresh
                
              done++;
          }
        
      }
      i++;
    }
  }
  else{
      while( loi2(i,2) ){

        nam=loi2(i,2);

        if(nam.substring(0,h).toLowerCase()==str.toLowerCase()){
         
          if(checkCode(nam,2) == -1){

            locArray[noProds] = new Object();
            locArray[noProds].name = nam;
            noProds++;

            if(done==0){
              show2();

              tableObj.innerHTML="<tr><td class=high onMouseOver=sh2('"+nam+"',"+i+",2)> <a>"+nam+ '</a></td></tr>';
            }
            else
              tableObj.innerHTML+="<tr><td class=high onMouseOver=sh2('"+nam+"',"+i+",2)> <a>"+nam+ '</a></td></tr>'; 
            
            done++;
          }
        }
        i++;
      }
  }
  if(done==0)
    tableObj.innerHTML='<tr><td>Not Found</td></tr>';
}

function isNodeWhitespace(node) {
  return node.nodeType == 3 && /^\s*$/.test(node.data);
}

function loadAll(){
  tableObj = document.getElementById('wow2');
  for(j=0; j<5; j++){
    temp = "a1_"+(j+1);
    allObj[j] = document.getElementById(temp);
  }
  
  document.getElementById('a1_3').value='';
  document.getElementById('a1_5').value='';
  document.getElementById('a1_2').value='';
  document.getElementById('a1_1').value='';
  
  document.getElementById('rows').value=1; 
  hide2(); 
  loadXMLDoc();
}

function checkCode(code, opt){
  var i=0;
  
  if(opt==1){
    while( i<noProds ){
        
      if(locArray[i].code==code)
        return i;
      
      ++i;
    }
  }
  else{
    while( i<noProds ){
        
      if(locArray[i].name==code)
        return i;
      
      ++i;
    }
  }

  return -1; 
}

/*
function addQty(){

  var opt = allObj[3].selectedIndex;
  allObj[2].value = locArray[indexXml].qty[opt];
}*/
