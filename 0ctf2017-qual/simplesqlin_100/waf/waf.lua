function say_html()
    html=[[
Your request is blocked by waf.
    ]]
    ngx.header.content_type = "text/html"
    ngx.status = ngx.HTTP_FORBIDDEN
    ngx.say(html)
    ngx.exit(ngx.status)
end

function url()
    rule = "(select|where|from|delete|update|insert|sleep|benchmark)"
    if rule ~="" and ngx.re.match(ngx.unescape_uri(ngx.var.request_uri),rule,"isjo") then
        say_html()
        return true
    end

    return false
end
 url()
