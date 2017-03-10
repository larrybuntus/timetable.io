$(document).ready(function(){
    // simple ajax calls function
    function myAjax(t, n, o, type = 'post') {
        if (type == 'post') {
            var id = $(t).attr("id");
            var query = $(t).attr("query");
            var value = $(t).attr("value");
            var e = 'id='+ encodeURIComponent(id) + '&query='+ encodeURIComponent(query) + '&value='+ encodeURIComponent(value);
        }else if(type == 'form'){
            var e = new FormData(t);

        }

        if (type == 'post') {
            $.ajax({
                type: "POST",
                url: n,
                data: e,
                dataType: "html",
                beforeSend: function() {
                    NProgress.start();
                },
                success: function(t) {
                    $(o).html(t).show(); 
                    NProgress.done();
                }
            });
        }else if (type == 'form'){
            $.ajax({
                type: "POST",
                url: n,
                data: e,
                cache: !1,
                contentType: !1,
                processData: !1,
                beforeSend: function() {
                    NProgress.start();
                },
                success: function(t) {
                    $(o).html(t).show(); 
                    NProgress.done();
                },
                error: function(t) {
                    console.log("something's wrong");
                }
            });
        }
    }

    /*realtime search function*/
    function getStates(thisInput){
      var id = $(thisInput).attr("id");
      var value = $(thisInput).val();
      var destination = $(thisInput).attr("dest");
      var output = $(thisInput).attr("output");

      $.post(destination, {srch:value, idAttr:id},function(data){
        $(output).html(data);
      });
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#swapImg').attr('src', e.target.result).removeClass("hidden");

                $size =  input.files[0].size; 
                $sizeMB = Math.ceil($size/1024);
                  if ($sizeMB >= 1000) {
                    $("#ajaxContent").html('<p class="text-center">Image is too big, please compress.</p>');
                    $("#myModal").modal("show");
                    $('#swapImgId').val("");
                    $('#swapImg').addClass("hidden");
                  }else{
                    // console.log("correct");
                  }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    /*ajax calls*/

    /*admin*/
    /*specific calls and output*/
    $(document).on("click", ".spec-ajax", function(e){
        e.preventDefault();

        $output = $(this).attr("output");
        $dest = $(this).attr("dest");
        $trigger = $(this).attr("trigger");
        $fade = $(this).attr("fade");


        if (typeof($trigger) != 'undefined' || $trigger != null) {
            $($trigger).trigger("click");
            return;
        }

        myAjax(this, $dest, $output);

        if ($(this).attr("modal") == 'true') {
            $("#myModal").modal("show");
        } 

        if(typeof($fade) != 'undefined' || $fade != null){
            $(this).parents($fade).fadeOut("slow").html("");
        }

        $(".selected").text("");
        if (!$("#delete").hasClass("hidden"))
            $("#delete").addClass("hidden");

    });

    /*specific form ajax calls*/
    $(document).on("submit", ".form", function(e){
        e.preventDefault();
        $output = $(this).attr("output");
        $dest = $(this).attr("dest");
        $checkout = $(this).attr("checkout");

        myAjax(this, $dest, $output, 'form');


        if ($(this).attr("modal") == 'true') {
            $("#myModal").modal("show");
        }

        if ($(this).attr("clear-input") == 'true') {
            $(this).find("input,textarea").val("");
        }

        if(typeof($checkout) != 'undefined' || $checkout != null){
            $counter = 0;
            $('input[type=checkbox]').each(function () {
                if(this.checked)
                    $(this).parents($checkout).fadeOut("slow").html("");
                $counter++;
            });
            if ($counter > 0)
                $(".selected").text($counter + " item selected");
            else if ($counter === 0)
                $(".selected").text("");

        }
    });

    $(document).on("keyup", ".dynamic-search", function(e){
        getStates(this);
    });

    $(document).on("change", ".check", function(e){
        if(this.checked) {
            $("#delete").removeClass("hidden");
        }else{
            if(!$("input.check").is(':checked')){
                $("#delete").addClass("hidden");
            }
        }
        $counter = 0;
        $('input[type=checkbox]').each(function () {
            if(this.checked)
                $counter++;
        });
        if ($counter > 0)
            $(".selected").text($counter + " item selected");
        else if ($counter === 0)
            $(".selected").text("");
    });
    /*end of admin*/

    /*img select and update*/
    $(document).on("change", "#swapImgId", function(e){
        readURL(this);
    });

    /*end of ajax calls*/ 
   
 
    /*general page scripts*/
    /* tooltip */
    $('[data-toggle="tooltip"]').tooltip();

    /*navigation*/
    $(document).on("click", ".day a", function(e){
        $(".day a").removeClass("active");
        $(this).addClass("active");
    });
    $(document).on("click", ".settings", function(e){
        e.preventDefault();
        $(".side-nav").addClass("open");
        $(".overlay").addClass("display");
    });
    $(document).on("click",".overlay", function(e){
        if ($(".side-nav").hasClass("open")){
            $(".side-nav").removeClass("open");
            $(".overlay").removeClass("display");
        }
    });
    function scrollDown(div){
        // scroll in zero seconds
        $(div).animate({ scrollTop: $(div)[0].scrollHeight}, 0);
    }
    $(document).on("click", ".repo-toggle-button a, .repo-toggle", function(e){
        e.preventDefault();
        if (!$(".repo-container").hasClass("open"))
            myAjax(this, $(this).attr("dest"), ".repo-body");
        $(".repo-container").toggleClass("open");

        setTimeout(function(){scrollDown(".repo-body")}, 250);
    })
    /*end of navigation*/ 



    /* chat js */
    function spawnNotification(theTitle,theIcon,theBody,vibration) {
        var options = {
            body: theBody,
            icon: theIcon,
            vibrate: vibration
        }
        var n = new Notification(theTitle,options);
        n.vibrate;
    }
    function chat(t, n, o){
        var e = new FormData(t);
        $.ajax({
            type: "POST",
            url: n,
            data: e,
            cache: !1,
            contentType: !1,
            processData: !1,
            beforeSend: function() {
            },
            success: function(t) {
                $(o).append(t).fadeIn("show"); 
            },
            error: function(t) {
                console.log("something's wrong");
            }
        });
    }
    $(document).on("click", "#open-chat", function(e){
        e.preventDefault();
        // if chat container is not opened already
        if (!$(".chat-container").hasClass("open"))
            myAjax(this, $(this).attr("dest"), ".chat-body");

        // chat container toggle class open
        $(".chat-container").toggleClass("open");

        // set timeout to scroll down
        setTimeout(function(){scrollDown(".chat-body")}, 250);

        // chat menu remove open class
        $(".chat-drop-menu").removeClass("open");
    }); 
    $(document).on("submit",  "#chatForm", function(e){
        e.preventDefault();
        $dest = $(this).attr("dest");
        chat(this, $dest, ".chat-body");
        $(this).find("textarea").val("");
        $(this).find("textarea").attr("rows", 1);
        
        // remove highlighting from any selected chat
        $(".highlighted").removeClass("highlighted");
        // hide chat drop menu
        $(".chat-drop-menu").removeClass("open");

        // scroll down to bottom of chat chat body
        $(".chat-body").animate({ scrollTop: $(".chat-body")[0].scrollHeight}, 1000);
        $counter = 0;
    });
    $(document).on("click", ".down-chat>a", function(e){
        e.preventDefault();
        $(".chat-body").animate({ scrollTop: $(".chat-body")[0].scrollHeight}, 500);
    });

    function updater(){
        $("#message-updater").trigger("click");
    }

    function scroll(element, counter){
        if (element != $(".chat-body")[0].scrollHeight){
            $(".chat-body").animate({ scrollTop: $(".chat-body")[0].scrollHeight}, 1000); 
                if ((counter-1) != 0 && !$(".chat-container").hasClass("open"))
                    spawnNotification('Group Chat', 'assets/img/icon.jpg', "New messages in group chat", [200,200,200,200,200]);
        }
    }

    $counter = 0;
    $(document).on("click", "#message-updater", function(e){
        e.preventDefault();
        $height = $(".chat-body")[0].scrollHeight;

        console.log("active");

        $dest = $(this).attr("dest");
        $.ajax({
            type: "POST",
            url: $dest,
            data: 'id=' + $(this).attr("id"),
            dataType: "html",
            success: function(t) {
                $(".chat-body").html(t).show(); 
            }
        });

        setTimeout(function() {scroll($height, $counter)}, 1000);
        $counter++;
    });

    var updaterFunction = setInterval(updater, 1000*5);

    /*double click or long press chat*/
    function chatMenu(){
        $pointer = $(".highlighted").length;
        if ($pointer > 1) $(".reply-chat, .copy-chat").fadeOut(100);
        else $(".reply-chat, .copy-chat").fadeIn(100);
        
        $(".chat-counter").text($pointer);

        if ($pointer == 0){
            $(".chat-drop-menu").removeClass("open");
            return true;
        }
    }
    
    /*double click*/ 
    var DELAY = 400, clicks = 0, timer = null;
    $(document).on("click", ".me, .others" ,function(e){
        $selected = this;
        clicks++;  //count clicks
        if(clicks === 1) {
            timer = setTimeout(function() {
                if ($(".highlighted").length > 0){
                    $($selected).toggleClass("highlighted");

                    // clear all sections
                    for ($i = 1; $i <= 1000; $i++)
                        clearInterval($i);                  
                }
                if(chatMenu() == true)
                    $updaterFunction = setInterval(updater, 1000*5);   
                
                clicks = 0;             //after action performed, reset counter

            }, DELAY);

        } else {
            clearTimeout(timer);    //prevent single-click action
            $($selected).toggleClass("highlighted");
            $(".chat-drop-menu").addClass("open");

            // 
            for ($i = 1; $i <= 1000; $i++)
                clearInterval($i);

            if(chatMenu() == true)
                $updaterFunction = setInterval(updater, 1000*5);   
            
            clicks = 0;             //after action performed, reset counter
        }
    })
    .on("dblclick", function(e){
        e.preventDefault();  //cancel system double-click event
    });
    /*end of double click*/ 

    /*delete chat*/
    $(document).on("click", ".trash-chat", function(e){
        e.preventDefault();
        $highlighted = '';
        $this = $(".delete-message-ids");

        $(".highlighted").each(function(){
            $highlighted += $(this).attr("id")+', ';    
        });

        $($this).attr("id", $highlighted);

        myAjax($this, $($this).attr('dest'), "#ajaxContent");

        $(".highlighted").fadeOut("slow").remove(); // remove highlighted chat
        $(".chat-drop-menu").removeClass("open");   // hide the chat drop menu
        $updaterFunction = setInterval(updater, 1000*5);    // restart the chat updater function
    });
    /*end of delete chat*/ 

    /*auto expand chat textarea with max limits*/
    $(document).one('focus.autoExpand', 'textarea.autoExpand', function(){
        var savedValue = this.value;
        this.value = '';
        this.baseScrollHeight = this.scrollHeight;
        this.value = savedValue;
    })
    .on('input.autoExpand', 'textarea.autoExpand', function(){
        var minRows = this.getAttribute('data-min-rows')|0, rows;
        this.rows = minRows;
        rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 17);
        this.rows = minRows + rows;
    });
    /*end of auto expand*/

    /*reply message*/
    $(document).on("click", ".reply-chat", function(e){
        e.preventDefault();
        $clone = $('.highlighted .message').clone();
        $('p.reply', $clone).remove();
        $message = $.trim($clone.text().substring(0, 255));

        $dataIndex = $(".highlighted").attr("data-index");
        $textarea = $(".message-body textarea").val();

        $(".message-body textarea").val('<p class="reply small"><a href="#' + $dataIndex + '">' + $message + "</a></p>" + $textarea);
    })
    /*end of reply message*/

    /*copy selected chat*/
    $(document).on("click", ".copy-chat", function(e){
        e.preventDefault();
        $clone = $('.highlighted .message').clone();
        $('p.reply', $clone).remove();
        $message = $.trim($clone.text());

        console.log($message);

        new Clipboard(".copy-chat", {
          text: function(e) {
            return $message; 
          }
        });
    });
    /*end of copy*/
});