<%-- 
    Document   : newjsp
    Created on : Jun 19, 2026, 11:12:13 AM
    Author     : HP
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>JSP Page</title>
    </head>
    <body>
         <%!
         int cube(int n){
         return n*n*n;
         %>
         <%="Cube of 3 is:"+cube(3)%>
         
    </body>
</html>
