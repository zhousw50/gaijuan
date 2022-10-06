function header(config) {
    var header="<div class=\"mdui-appbar mdui-appbar-scroll-hide mdui-appbar-fixed mdui-appbar-inset\">";
    header += "<div class=\"mdui-toolbar mdui-color-"+config["color"]+"\">";
    header += "<span class=\"mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white\" mdui-drawer=\"{target: '#main-drawer', swipe: true}\"><i class=\"mdui-icon material-icons\">menu<\/i><\/span>";
    header += "<a href=\""+config["header_link"]+"\" class=\"mdui-typo-title\" id='title'>"+config["header_title"]+"<\/a>";
    header += "<div class=\"mdui-toolbar-spacer\"><\/div>";
    for(var i=1;i<=config["tool"];i++)
    {
        var text=!config["tool_"+i+"_text"]?"":config["tool_"+i+"_text"];
        header += "<a href=\"javascript:;\" class=\"mdui-btn\" id='"+"headertool"+i+"'>"+text+"<i class=\"mdui-icon material-icons\">"+config["tool_"+i+"_img"]+"<\/i><\/a>";
    }
    header += "<\/div>";
    header += "<div class=\"mdui-tab mdui-color-indigo mdui-tab-full-width mdui-tab-scrollable\" mdui-tab>";
    for(var i=1;i<=config["tab"];i++){
        header += "<a href=\""+config["tab_"+i+"_link"]+"\" class=\"mdui-ripple mdui-ripple-white\" id='headertab"+i+"'>";
        if(config["tab_"+i+"_img"])header += "<i class=\"mdui-icon material-icons\">"+config["tab_"+i+"_img"]+"<\/i>";
        header += "<label>"+config["tab_"+i+"_text"]+"<\/label>";
        header += "<\/a>";
    }
    header += "<\/div>";
    header += "<\/div>";
    header += "<\/div>";
    document.getElementsByTagName("header")[0].innerHTML=header;
    for(var i=1;i<=config["tool"];i++)
    {
        if(config["tool_"+i+"_tip"])document.getElementById("headertool"+i).setAttribute("mdui-tooltip","{content:'"+config["tool_"+i+"_tip"]+"'}");
    }
    for(var i=1;i<=config["tab"];i++)
    {
        if(config["tab_"+i+"_tip"])document.getElementById("headertab"+i).setAttribute("mdui-tooltip","{content:'"+config["tab_"+i+"_tip"]+"'}");
    }

    mdui.mutation();
}
