function sendMessage(){
    var input = document.getElementById('userinput');

    if(input.value == ""){
        return;
    }else{
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status != 200) {
                alert('Shit Dud, Error Occured');
            }
        };
        xmlhttp.open("GET", "php/functions/func_exec.php?function=sendMessage&room="+ parseInt(document.getElementById('roomName').dataset.roomid) +"&msg=" + input.value, true);
        xmlhttp.send();
    };
    input.value = "";
    var ifrm = document.getElementById('messagesIframe');
    ifrm.src = ifrm.src;

    setTimeout(function(){
        document.getElementById('messagesIframe').contentWindow.scrollTo( 0, 999999 );
    },500);
};

function joinRoom(){
    var roomid = prompt("Please enter the room id you wish to join!");
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status != 200) {
                alert('Shit Dud, Error Occured');
            }
        };
        xmlhttp.open("GET", "php/functions/func_exec.php?function=joinRoom&room="+roomid, true);
        xmlhttp.send();

    location.reload();
}

function leaveRoom(){
    var roomList = document.getElementById('roomListSelect');
    var roomid = roomList[roomList.selectedIndex].dataset.roomid;

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status != 200) {
                alert('Shit Dud, Error Occured');
            }
        };
        xmlhttp.open("GET", "php/functions/func_exec.php?function=leaveRoom&room="+parseInt(roomid), true);
        xmlhttp.send();

    location.reload();
}

function createRoom(){
    var name = prompt("Please enter the room name");
    var img = prompt("Please enter the img URL or leave blank for the default one");

    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status != 200) {
                alert('Shit Dud, Error Occured');
            }
        };
        xmlhttp.open("GET", "php/functions/func_exec.php?function=createRoom&name="+name+"&img="+img, true);
        xmlhttp.send();

    location.reload();
}

function MsgKeyDown(event){
    switch (true){
        case !event.altKey && !event.ctrlKey && !event.shiftKey && event.key == "Enter":
            sendMessage();
            break;
    }
}

function validateEmail(input){
    var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

    if(!regex.test(input.value)){
        input.style.border = "2px solid red";
    }else{
        input.style.border = "1px solid rgba(0,0,0,.3)";
    }
}