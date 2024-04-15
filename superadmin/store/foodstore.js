// let xmlHttp = createXmlHttpRequestObject();

// function createXmlHttpRequestObject() {
//     let xmlHttp;

//     if (window.ActiveXObject) {
//         try {
//             xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
//         } catch (error) {
//             xmlHttp = false;
//         }
//     }else{
//         try {
//             xmlHttp = new XMLHttpRequest();
//         } catch (error) {
//             xmlHttp = false;
            
//         }
//     }

//     if (!xmlHttp) {
//         alert("Cant create object file");
//     }else{
//         return xmlHttp;
//     }




// }



// function process() {
//     console.log("hello");

//     if (xmlHttp.readyState==0 || xmlHttp.readyState==4) {
//         food = encodeURIComponent(document.getElementById("userInput").value);
//         xmlHttp.open("GET", "foodstore.php?food="+food,true);
//         xmlHttp.onreadystatechange = handleServerResponse;
//         xmlHttp.send(null);
//     } else {
//         setTimeout('process()',1000)

//     }
// }



// function handleServerResponse() {
//     if (xmlHttp.readyState==4) {
//         if (xmlHttp.status==200) {
//             xmlResponse = xmlHttp.responseXML;
//             xmlDocumentElement = xmlResponse.documentElement
//             message = xmlDocumentElement.firstChild.data;
//             document.getElementById("diverror").innerHTML = '<span style="color:blue;">' + message + '</span>';
//         }else{
//             alert('Something went wrong!!');
//         }
//     }












// }


















