var randkyup;
    var randkyup = Math.floor(Math.random() * 99999999999);
    var currentLocation = window.location.href;
    console.log(window.location.href);







    function likeover(){
      document.getElementById("like").setAttribute("src","/vip/unheart.png")
      document.getElementById("like").style.width = "30px"
    }

    function likeout(){
      document.getElementById("like").setAttribute("src","/vip/heart.png")
      document.getElementById("like").style.width = "30px"
    }

function addFriend(event){
  $.ajax({
    type:"post",
    url:"../php/friends.php",
    data:{friend:event},
    success:function (response){
      console.log(response);

    }


  });
}



function showShare(event) {
  var form = document.getElementById('share-form').style.display
  console.log(form)
  if(form == "none"){
    document.getElementById('share-form').style.display = "block";

  }else{
    document.getElementById('share-form').style.display = "none";
  }


}

function goPost(event){
  $.ajax({
    type:"post",
    url:"../php/onpost.php",
    data:{postid:event},
    success:function(response){
      $('.form-holder').empty()
      $('#story-line').empty()
      $('#story-line').append(response)

    }


  });
}



function mouse(event) {


  if(document.getElementById('diw')){
    var b = event.clientX
    var b = b - 50
    document.getElementById('diw').style.left = b + 'px';

    if(document.getElementById('diw').style.display == "block"){
      document.getElementById('diw').style.display = "none"
      $('#notify-content').empty()



    }else{
      document.getElementById('diw').style.display = "block"
    }
  }else{

    var b = event.clientX

    var b = b - 50
    document.getElementById('diw').style.left = b + 'px';

}
}


function notify(event){





  $.ajax({
    type:"post",
    url :"../php/notify.php",
    data:{userid:event},
    success:function(response){






    }
  });
}


function redirectProfile(event) {

  $.ajax({
           type : "post",  //type of method
           url  : "../php/otherprofile.php",  //your page
           data : {userid:event},// passing the values
           success: function(res){
                      console.log(res);
                      $('#story-line').empty();
                      $('#story-line').append(res);

                   }
       });
   }


function like(pi) {
  document.getElementById("like").setAttribute("class","liked");
  console.log(pi);
  $.ajax({
    type:"post",
    url:"../php/like.php",
    data:{
    postid:pi },
    success:function(resp){
      console.log(resp);

    }





  })
    $.ajax({type:"post",url:"../php/likes.php",data:{postid:pi},success:function(rsp){

      $('#likes_'+pi).html(rsp)



      }
  })

}



function post(){
  var header = document.getElementById('header').value;
  var adress = document.getElementById('adress').value;
  var tel = document.getElementById('tel').value;
  var price = document.getElementById('price').value;
  var comment = document.getElementById('comment').value;

  console.log(comment);
  document.getElementById('post-button').innerHTML = '<i class="fa fa-spinner fa-spin"></i>'
  $.ajax({
    type:"post",
    url:"../php/share.php",
    data:{
      header:header,
      adress:adress,
      tel:tel,
      price:price,
      comment:comment,
    },
    success:function(sys){
      console.log(sys);
      location.reload();

    }
  });
}

function comment(shareid){
  var comment = document.getElementById('comment-post').value;
  var crr = comment.search("'");
  if (crr>-1){
    comment.replace("'","--");
  }
  console.log(comment);
  if(comment == '') {}else{
  $.ajax({
    type:"post",
    url:"../php/comment.php",
    data:{
      comment:comment,
      shareid:shareid,
    },
    success:function(data){
      console.log(data);
      $('#comment_'+shareid).append(data);
    }
  });
}
}



function rmcom(postid){
  $.ajax({
    type:"post",
    url:"../php/deletecom.php",
    data:{
      postid:postid,
    },
    success:function(response){console.log(response)}
  })



}



$(document).ready(function(){
var clickHandler = document.getElementById('dragandrophandler');
if (clickHandler){
clickHandler.addEventListener('click' ,function(clickHandler){
  // Add div and append to input(file) div
    var div = document.createElement('div');
    div.innerHTML = '<input id="fileInput" type ="file" multiple style="visibility:hidden;">';
    $($('body')).append(div);
    // Open select file screen
    $('#fileInput').trigger('click');
 // get files and send to handler
    var fileInput = document.getElementById('fileInput')
    fileInput.onchange = function(){
      var obj = $("#dragandrophandler");
      files = this.files
      handleFileUpload(files,obj)
      };
  });
  };
});


// Send Files
function sendFileToServer(formData,status)
{
    var uploadURL ="../php/ajaxfile.php"; //Upload URL
    var extraData ={}; //Extra Data.
    var jqXHR=$.ajax({
            xhr: function() {
            var xhrobj = $.ajaxSettings.xhr();
            if (xhrobj.upload) {
                    xhrobj.upload.addEventListener('progress', function(event) {
                        var percent = 0;
                        var position = event.loaded || event.position;
                        var total = event.total;
                        if (event.lengthComputable) {
                            percent = Math.ceil(position / total * 100);
                        }
                        //Set progress
                        status.setProgress(percent);
                    }, false);
                }
            return xhrobj;
        },
    url: uploadURL,
    type: "POST",
    contentType:false,
    processData: false,
        cache: false,
        data: formData,
        success: function(data){
            console.log('success')
            status.setProgress(100);

            $("#status1").append("File upload Done<br>");
            var name = document.createElement('input');
            name.style = 'visibility:hidden;position:relative;';
            name.name = 'photo';
            name.value= (data);
            name.id = 'photo';
            console.log(name.name);
            $('#share-form').append(name);
        }
    });

    status.setAbort(jqXHR);
}

var rowCount=0;
function createStatusbar(obj,url)
{
     rowCount++;
     var row="odd";
     if(rowCount %2 ==0) row ="even";
     img = document.createElement('img')
     img.style = 'border:solid 1px #ddd;width:100px;height:100px;padding:5px;'
     img.src = url
     $('#bar').append(img)
     this.statusbar = $("<div class='statusbar  "+row+"'></div>");
     this.img = $("<li class = 'image-li'>  </i><img src = '"+url+"'class = 'img-upload'></li>").appendTo(this.statusbar);
     //this.filename = $("<div class='filename'></div>").appendTo(this.statusbar);
     //this.size = $("<div class='filesize'></div>").appendTo(this.statusbar);
     this.progressBar = $("<div class='progressBar'><div></div></div>").appendTo(this.statusbar);
     this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
     obj.after(this.statusbar);

    this.setFileNameSize = function(name,size)
    {
        var sizeStr="";
        var sizeKB = size/1024;
        if(parseInt(sizeKB) > 1024)
        {
            var sizeMB = sizeKB/1024;
            sizeStr = sizeMB.toFixed(2)+" MB";
        }
        else
        {
            sizeStr = sizeKB.toFixed(2)+" KB";
        }
// File Name And Size String
        // this.filename.html(name);
        // this.size.html(sizeStr);
    }
    this.setProgress = function(progress)
    {
        var progressBarWidth =progress*this.progressBar.width()/ 100;
        this.progressBar.find('div').animate({ width: progressBarWidth }, 10).html(progress + "% ");
        if(parseInt(progress) >= 100)
        {
            this.abort.hide();
        }
    }
    this.setAbort = function(jqxhr)
    {
        var sb = this.statusbar;
        this.abort.click(function()
        {
            jqxhr.abort();
            sb.hide();
        });
    }
}




// Control And Send to PHP

function handleFileUpload(files,obj)
{

   for (var i = 0; i < files.length; i++)
   {
        url =  URL.createObjectURL(files[i])
        var fd = new FormData();
        console.log(files[i])
        fd.append('file', files[i]);
        fd.append('randkey',randkyup);
        var status = new createStatusbar(obj,url); //Using this we can set progress.
        status.setFileNameSize(files[i].name,files[i].size);
        sendFileToServer(fd,status);

   }

}





function startChat(event){
  $.ajax({
    type:"post",
    url:"../php/pChat.php",
    data:{id:event},
    success:function(response){
      console.log(response)
      $('body').append(response);
    }
  })
}

// Drag And Drop Handler


$(document).ready(function(){







  var isOpen = 0;
  var isHeight = 0;
  $("#chat-link").click(function(){
     if (isHeight == 0 ){
       $("#chat").css("height","auto");
       $("#chat-friends").css("display","block");
       isHeight = 1;
     }else{

       $("#chat").css("height","35px");
       isHeight = 0;
       $("#chat-friends").css("display","none");
     }
      $.ajax({
        type:"post",
        url:"../php/chat.php",
        data:{},
        success:function(response){
          console.log(response);
          if(isOpen == 0){
            $("#chat-friends").append(response);
            isOpen = 1;
          }
        }
      });
  });






notifyD = document.createElement('div')
notifyD.setAttribute('class','notify')
notifyD.setAttribute('id','diw')
document.body.appendChild(notifyD);
notifyD.style.display = 'none'



notifyDHead = document.createElement('h3')
notifyDHead.setAttribute('class','notify-header')
notifyDHead.innerHTML = 'Bildirimler'
notifyD.appendChild(notifyDHead)


notifyCont = document.createElement('div')
notifyCont.setAttribute('class','notify-content')
notifyCont.setAttribute('id','notify-content')
notifyD.appendChild(notifyCont)


$.ajax({
         type : "post",
         url  : "../php/get-notify.php",
         data : {userid:event},
         success: function(res){

                    $('#notify-content').append(res);

                 }
     });



var obj = $("#dragandrophandler");
obj.on('dragenter', function (e)
{
    e.stopPropagation();
    e.preventDefault();
    $(this).css('border', '2px solid #0B85A1');
      $(obj).css('background-color','blue');
});
obj.on('dragover', function (e)
{
     e.stopPropagation();
     e.preventDefault();
});
obj.on('drop', function (e)
{

     $(this).css('border', '2px dotted #0B85A1');

     e.preventDefault();
     var files = e.originalEvent.dataTransfer.files;
     console.log(e)
     //We need to send dropped files to Server
     handleFileUpload(files,obj);
});
$(document).on('dragenter', function (e)
{
    e.stopPropagation();
    e.preventDefault();
});
$(document).on('dragover', function (e)
{
  e.stopPropagation();handleFileUpload(files,obj)

  e.preventDefault();
  obj.css('border', '2px dotted #0B85A1');
    $(obj).css('background-color','')
    $(obj).css('transition' ,'1s')
});
$(document).on('drop', function (e)
{
    e.stopPropagation();
    e.preventDefault();
});

});
