
<div class="buttons">
  <h1>Notifications</h1>
  <button onclick="notifySuccess()">
    Success
  </button>
  <button onclick="notifyError()">
    Error
  </button>
  <button onclick="notifyInfo()">
    Info
  </button>
</div>

<div id="notification-area">
</div>


<style type="text/css">
    
  #notification-area {
    position:fixed;
    top: 0;
    left: 0;
    right: 0;
    margin: auto;
    max-width:50%;
    padding: 6px;
    text-align: center;
    height:100vh;
    border-radius: 2px;
    display:flex;
    flex-direction:column;
    justify-content:top-center;
  }
  #notification-area .notification {
    position:relative;
    padding:15px 10px;
    background:#111;
    color:#f5f5f5;
    font-family: sans-serif;
    font-size:18px;
    font-weight:600;
    border-radius:5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin:5px 0px;
    opacity:0;
    left:20px;
    animation:showNotification 500ms ease-in-out forwards;
  }
  @keyframes showNotification {
    to {
      opacity:1;
      left:0px;
    }
  }
  #notification-area .notification.success {
    background:#2FB45A;
  }
  #notification-area .notification.error {
    background:orangered;
  }
  #notification-area .notification.info {
    background:#00acee;
  }
</style>

<script type="text/javascript">
  function notify(type,message){
  (()=>{
    let n = document.createElement("div");
    let id = Math.random().toString(36).substr(2,10);
    n.setAttribute("id",id);
    n.classList.add("notification",type);
    n.innerText = message;
    document.getElementById("notification-area").appendChild(n);
    setTimeout(()=>{
      var notifications = document.getElementById("notification-area").getElementsByClassName("notification");
      for(let i=0;i<notifications.length;i++){
        if(notifications[i].getAttribute("id") == id){
          notifications[i].remove();
          break;
        }
      }
    },5000);
  })();
  }

  function notifySuccess(){
    notify("success","Item has been added into cart.");
  }
  function notifyError(){
    notify("error","This is demo error notification message");
  }
  function notifyInfo(){
    notify("info","This is demo info notification message");
  }
</script>