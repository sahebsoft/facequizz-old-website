
/**
* Your code should call our URL and get a JSON with all relevant offers
* numOfOffers is the max number of offers you request. In this example, it asks for 4 offers to add to the page.
**/

var numOffers = 4;
var token  = "baf32730274b2853105cdf7fbf3df956";
var pid = 826;
var url = "http://smartlink.outmobile.com/Offer/GetOffersList?token=" + token + "&length=" + numOffers + "&pid=" + pid;

/** 
*  Easy start functions :
*  omLoadURL - performs an Ajax call to our server and get the JSON. When the JSon is recieved the function omUpdateElement is being called. 
*  omUpdateElement - goes over the offers and alert them. You need to modify this function so it will add new elements to the page .
**/


omLoadURL(url);


function omLoadURL(url)
{
        try {
            var xhr = null;
            if (window.XDomainRequest) xhr = new XDomainRequest();
            else if (window.XMLHttpRequest) xhr = new XMLHttpRequest();
            else xhr = new ActiveXObject("Microsoft.XMLHTTP");

            xhr.ontimeout = function () {
               
            };

            // Response handlers.
            var xml = null;
            xhr.onload = function () {
              	
                if (/*xhr.responseXML*/true) {
                    if (xhr.readyState === 4) {
					
                        if (xhr.status === 200) {                      
                             var offersJson = xhr.responseText;							   							
                             var json = JSON.parse(offersJson);
                             omUpdateElement(json);
							 
                        } else {
                            
                        }
                    }
                } else if (xhr.responseText) {
                    try {
                        xml = new ActiveXObject('Microsoft.XMLDOM');
                        xml.loadXML(xhr.responseText);
                        omUpdateElement(link);
                    }
                    catch (err) {
                
                    }
                };
            };
            xhr.open("GET", url, true);
            //xhr.timeout = this.TimeOutForXMLResponse;
            xhr.send(null);
        }
        catch (err) {          
        }
}



function omUpdateElement(offers)
{
   var i=0;

   for(i=0;i < offers.length;i++)    
   {

	alert(offers[i].AppName + "," + offers[i].Url + "," + offers[i].LogoUrl + "," + offers[i].Description);
   }	    
  
}
