<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="<?php echo $description; ?>" />
        <meta name="keywords" content="<?php echo $keywords; ?>" />
        <meta property="og:site_name" content="<?php echo $site_name; ?>" />
        <meta property="og:type" content="Website" />
        <meta property="og:title" content="<?php echo $title_seo; ?>" />
        <meta property="og:url" content="<?php echo current_url(); ?>" />
        <meta property="og:description" content="<?php echo $description; ?>" />
        <meta property="og:image" content="https://combosale.net/assets/images/combosale.jpg" />
        <meta property="fb:app_id" content="<?php echo $this->config->item('app_id', 'facebook'); ?>" />
        <meta name="facebook-domain-verification" content="v8vnuk6xbicgysifolom2b3za3d73e" />
        <title>Không tìm thấy trang này</title>
        <link rel="icon" href="<?php echo base_url(get_module_path('logo') . $favicon); ?>" type="image/x-icon">
        <style type="text/css">
            body {
                width: 99%;
                height: 100%;
                background-color: mediumturquoise;
                color: white;
                font-family: sans-serif;
            }

            div {
                position: absolute;
                width: 400px;
                height: 300px;
                z-index: 15;
                top: 45%;
                left: 50%;
                margin: -100px 0 0 -200px;
                text-align: center;
            }

            h1,
            h2 {
                text-align: center;
            }

            h1 {
                font-size: 60px;
                margin-bottom: 10px;
                border-bottom: 1px solid white;
                padding-bottom: 10px;
            }

            h2 {
                margin-bottom: 40px;
            }

            a {
                margin-top: 10px;
                text-decoration: none;
                padding: 10px 25px;
                background-color: ghostwhite;
                color: black;
                margin-top: 20px;
            }
        </style>
    </head>
    <body>
        <div>
            <h1>404</h1>
            <h2>Không tìm thấy trang yêu cầu!</h2>
            <a href="<?php echo base_url(); ?>">Về trang chủ</a>
        </div>
        </div>
    </body>
</html>