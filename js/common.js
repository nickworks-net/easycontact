

/*
* hrefにCustomerIdを付与.
*/
var attachCustomerIdToHref = function(elem){
	var delimiter = ( 0 < elem.href.indexOf("?") )? "&" : "?" ;
	elem.href = elem.href + delimiter + "cid=" + getCustomerId();
	return true;
};

/*
* CustomerIdを取得.
*/
var getCustomerId = function(){
	var KEY_NAME = "customerId";
	if ( !localStorage.getItem(KEY_NAME) ) {
		localStorage.setItem(KEY_NAME, generateCustomerId() );
	}
	//console.log( localStorage.getItem(KEY_NAME) );
	return localStorage.getItem(KEY_NAME);
}

/*
* 被らないであろうIdを生成.
*/
var generateCustomerId = function(){
	var ts = new Date().getTime();
	var rand = Math.floor( Math.random() * 0xffffffff );
	return ts.toString(36) + rand.toString(36);
}
