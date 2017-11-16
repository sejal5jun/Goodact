<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Munttoo - @yield('title')</title>
        <style>
            body {
                padding: 0;
                margin: 0;background-color:#f1f5f6
            }

            html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
            @media only screen and (max-device-width: 680px), only screen and (max-width: 680px) { 
                *[class="table_width_100"] {
                    width: 96% !important;
                }
                *[class="border-right_mob"] {
                    border-right: 1px solid #dddddd;
                }
                *[class="mob_100"] {
                    width: 100% !important;
                }
                *[class="mob_center"] {
                    text-align: center !important;
                }
                *[class="mob_center_bl"] {
                    float: none !important;
                    display: block !important;
                    margin: 0px auto;
                }   
                .iage_footer a {
                    text-decoration: none;
                    color: #929ca8;
                }
                img.mob_display_none {
                    width: 0px !important;
                    height: 0px !important;
                    display: none !important;
                }
                img.mob_width_50 {
                    width: 40% !important;
                    height: auto !important;
                }
            }
            .table_width_100 {
                width: 680px;
            }
        </style>
    </head>
    <body>
        <div id="mailsub" class="notification" align="center">
            @yield('content')
        </div>
    </body>
</html>
