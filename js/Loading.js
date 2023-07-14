function LoadIng(Type, Content, Width) {
    var LoadIngElement = document.getElementById("LoadIng");
    if (Type == true) {
        if (LoadIngElement == null) {
            HTMLCode = '<div style="top: 0;right: 0;bottom: 0;left: 0;z-index: 8192;position: fixed;background: rgba(0,0,0,.4);backdrop-filter: blur(7px)"></div>';
            HTMLCode += '<div id="LoadIngStyle">';
            HTMLCode += '<div style="height: 18px"></div>';
            HTMLCode += '<div style="display: flex;align-items: center;flex-direction: column">';
            HTMLCode += "<style>@keyframes spin { 0% { transform: rotate(0deg) } 100% { transform: rotate(360deg) } }</style>";
            HTMLCode += '<div style="width: 48px;height: 48px;border: 16px solid #f3f3f3;border-top: 16px solid #3f51b5;border-radius: 100%;animation: spin 1s linear infinite"></div>';
            HTMLCode += "</div>";
            HTMLCode += '<div style="height: 12px;"></div>';
            HTMLCode += '<div style="text-align: center;color: #3f51b5;font-weight: 600;font-size: 18px" id="LoadIngContentText"></div>';
            HTMLCode += "</div>";
            var DocumentDIV = document.createElement("div");
            document.body.appendChild(DocumentDIV);
            DocumentDIV.setAttribute("id", "LoadIng");
            DocumentDIV.innerHTML = HTMLCode
        }
        var Style = "position: fixed;right: 0;left: 0;z-index: 8192;margin: auto;background-color: #fff;border-radius: 12px;-webkit-box-shadow: 0 11px 15px -7px rgb(0 0 0 / 20%), 0 24px 38px 3px rgb(0 0 0 / 14%), 0 9px 46px 8px rgb(0 0 0 / 12%);display: block;top: 0;bottom: 0;left: 0;height: 145px;width: " + Width + "px";
        document.getElementById("LoadIngStyle").setAttribute("style", Style);
        document.getElementById("LoadIngContentText").innerHTML = Content
    } else if (Type == false && LoadIngElement != null) {
        LoadIngElement.parentNode.removeChild(LoadIngElement)
    }
}