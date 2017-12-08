window.onload=function(){
  // Ex 2: JavaScript alert
  // alert("Hello, world!");

  $("BiggerPimpin").addEventListener('click', bigger);
  $("Snoopify").addEventListener('click', snoopify);
  $("Igpay_Atinlay").addEventListener('click', textChange);
  $("Malkovitch").addEventListener('click', malkovitch);


  document.getElementById("Bling").onchange = changeStyle;

};
const bigger = ()=>{

  // Ex 3: Hello World Button
  // alert("Hello, world!");

  // Ex 4: Bigger Pimpin'! Button
  //
  // if($("TextInput").style.fontSize === "")
  // 		$("TextInput").style.fontSize = "24pt";
  setInterval(function(){

    if($("TextInput").style.fontSize === ""){
    	$("TextInput").style.fontSize = "12pt";
    }
    else {
    	let fontsize = parseInt($("TextInput").style.fontSize)+2;
    	$("TextInput").style.fontSize = fontsize+"pt";
    }
  },500);
};

const changeStyle = () => {

	if($("Bling").checked){
		$("TextInput").style.fontWeight = "bold";
		$("TextInput").style.color = "green";
		$("TextInput").style.textDecoration = "underline";
    document.body.style.backgroundImage="url('http://selab.hanyang.ac.kr/courses/cse326/2017/labs/images/8/hundred.jpg')"
	}
  else{
		$("TextInput").style.fontWeight = "normal";
		$("TextInput").style.fontWeight = "normal";
    $("TextInput").style.color = "black";
    $("TextInput").style.textDecoration = "none";
    document.body.style.backgroundImage="";

	}

};
const snoopify = ()=>{
  $("TextInput").value = $("TextInput").value.toUpperCase();
	$("TextInput").value = $("TextInput").value.split(".").join("-izzle.");

};


const textChange = ()=>{
    const text = $("TextInput");
    var arr = text.value.split(" ");
    for(let i=0;i<arr.length;i++){
        let index = arr[i].indexOf(arr[i].match(/[aeiou]+/i));
        let temp1 = arr[i].substring(0,index);
        let temp2 = arr[i].substring(index,arr[i].length+1);
        arr[i] = temp2+temp1+"ay";
    }
    text.value = arr.join(" ");
};

const malkovitch = ()=>{
    const text = $("TextInput");

    for(var i=0;i<text.value.length;i++)
      if(text.value.length>=5)
          text.value="Malkovich";


};
