let modal = $("#popup");
let content = $(".content");
let modalimg = $(".popup__photo");
let title = $(".title");
let date = $(".date");
let postlink = $(".postlink");
let next = $(".next");
let previous = $(".previous");
let count = $(".count").attr("data-count");


$(document).ready(function(){
    $(".instapost").slice(0, 6).show();
});

$("#loadMore").on("click", function(e){
        e.preventDefault();
        $(".instapost:hidden").slice(0, 6).show();
        if($(".instapost:hidden").length == 0) {
        $("#loadMore").hide();
    }
});

$(".popup__close").on("click",function(e){
    e.preventDefault();
    close();
});

$(".instapost").on("click",function(e){
    e.preventDefault();
    let This = $(this);
    let img = This.children("img");
    let username = img.attr("data-username");
    let timestamp = img.attr("data-time").split("T")[0];
    let media_url = img.attr("data-media_url");
    let id = This.attr("data-id");
    timestamp = timestamp.split("-");
    timestamp = timestamp[2]+"-"+timestamp[1]+"-"+timestamp[0];
    modal.css("visibility","visible");
    modal.css("opacity","1");
    content.html(HtmlEncode(img.attr("data-caption")));
    date.html(timestamp);
    title.html(username);
    postlink.attr("href",img.attr("data-postlink"));
    title.parent("a").attr("href",`https://instagram.com/${username}`);


    let nextid = 0, preid = 0;
    if(parseInt(id) - 1 > 0){
        preid = parseInt(id) - 1;
    }else{
        preid = count;
    }

    if(parseInt(id) + 1 < count){
        nextid = parseInt(id) + 1;
    }else{
        nextid = 1;
    }

    next.attr("data-next",nextid);
    previous.attr("data-pre",preid);
    modalimg.html(`<video controls autoplay loop class="video">
        <source src="${media_url}" type="video/mp4">
        <source src="${media_url}" type="video/ogg">
        Your browser does not support the video tag.
    </video>`);
});

next.on("click", function(e){
    e.preventDefault();
    let This = $(this);
    let next = This.attr("data-next");
    close();
    $('a[data-id="'+next+'"]').trigger("click");
});

previous.on("click", function(e){
    e.preventDefault();
    let This = $(this);
    let pre = This.attr("data-pre");
    close();
    $('a[data-id="'+pre+'"]').trigger("click");
});

function close(){
    modal.css("opacity","0");
    modal.css("visibility","hidden");
    $('video').trigger('pause');
    modalimg.html("");
    title.html("");
    date.html("");
    content.html("");
}

function HtmlEncode(s)
{
    var el = document.createElement("div");
    el.innerText = el.textContent = s;
    s = el.innerHTML;
    return s;
}