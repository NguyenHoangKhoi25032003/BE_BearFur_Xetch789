<!DOCTYPE html>
<html lang="en">
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
		<meta property="og:image" content="" />
		<meta property="fb:app_id" content="<?php echo $this->config->item('app_id', 'facebook'); ?>" />


        <title><?php echo $title_seo; ?></title>
        <link rel="icon" href="<?php echo base_url(get_module_path('logo') . $favicon); ?>" type="image/x-icon">
        <link href="<?php echo get_asset('css_path'); ?>all-in-one.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>webslidemenu.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>webslidemenu-effect.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>slick.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>slick-theme.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>magiczoomplus.css" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>style.css?ver=1" rel="stylesheet">
        <link href="<?php echo get_asset('css_path'); ?>fontawesome-all.min.css" rel="stylesheet" type="text/css">
        <?php foreach ($plugins_css as $plugin_css): ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/plugins/' . $plugin_css['folder'] . '/' . $plugin_css['name'] . '.css'); ?>" />
        <?php endforeach;?>
        <?php foreach ($modules_css as $module_css): ?>
            <link rel="stylesheet" href="<?php echo base_url('assets/modules/' . $module_css['folder'] . '/css/' . $module_css['name'] . '.css'); ?>" />
        <?php endforeach;?>
        <?php echo add_css($add_css); ?>
        <style type="text/css">
            .btn-get-link-modal {
                position     : fixed;
                bottom       : 15vh;
                right        : 0;
                margin-right : -116px;
                border-radius: 0;
                transition   : all .5s ease;
            }
            .btn-get-link-modal:hover {
                margin-right: 0;
                background  : #399dba;
            }
            .btn-get-link-modal:focus {
                outline: none;
            }
            .btn-get-link-modal:active:focus {
                outline: none;
            }
            .btn-get-link-modal .fa {
                padding-right: 16px;
            }
            #get-link-modal .modal-header .close {
                margin-top: -20px;
            }
        </style>
        <?php echo $other_seo; ?>

        <script src="https://www.google.com/recaptcha/api.js?hl=vi"></script>

        <script type="text/javascript">
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', '<?php echo $analytics_UA_code; ?>', 'auto');
            ga('send', 'pageview');
        </script>
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-9JQBD30QWC"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', '<?php echo $analytics_UA_code; ?>');
        </script>
    </head>
    <body>
  		<script>
  			window.fbAsyncInit = function() {
  				FB.init({
  				  appId      : '<?php echo $this->config->item('app_id', 'facebook'); ?>',
  				  xfbml      : true,
  				  version    : 'v2.11'
  				});
  			};
  		</script>
  		<div id="fb-root"></div>
  		<script>(function(d, s, id) {
  		  var js, fjs = d.getElementsByTagName(s)[0];
  		  if (d.getElementById(id)) return;
  		  js = d.createElement(s); js.id = id;
  		  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.11";
  		  fjs.parentNode.insertBefore(js, fjs);
  		}(document, 'script', 'facebook-jssdk'));</script>
        <?php $this->load->view('header'); ?>
        <?php $this->load->view($main_content); ?>
        <?php $this->load->view('footer'); ?>

        <div class="pop-up-quickview">
          <div id="myModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <div class="modal-body iframe-load"></div>
              </div>
            </div>
          </div>
        </div>

        <!-- <div class="icons-hotline-fixed">
          <div class="box-hotline-fixed-bottom">
            <div class="close-hotline"><img src="<?php echo get_asset('img_path'); ?>close_error.png" alt="" class="img-fluid"></div>
            <a href="<?php echo isset($info_hotline_none['link']) ? $info_hotline_none['link'] : ''; ?>">
              <p>Hotline tư vấn (24/7)</p>
              <h3><?php echo isset($info_hotline_none['content']) ? $info_hotline_none['content'] : ''; ?></h3>
            </a>
          </div>
          <div class="open-hotline"><img src="<?php echo get_asset('img_path'); ?>call.png" alt="" class="img-fluid"></div>
        </div> -->



        <button type="button" class="btn btn-info btn-lg btn-get-link-modal btn-share-link"><i class="fa fa-share-alt-square" aria-hidden="true"></i>Chia sẻ link</button>
        <div id="get-link-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header p-2">
                        <h6 class="modal-title mb-0">Chia sẻ link</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-2">
                        <div class="form-group mb-0">
                            <label for="link-share-product">Vui lòng copy link này để chia sẻ cho mọi người</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="link-share-product" readonly>
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-primary btn-copy" data-clipboard-action="copy" data-clipboard-target="#link-share-product"><i class="fa fa-copy"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer p-2">
                        <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            base_url = '<?php echo base_url(); ?>';
            logo = '<?php echo base_url(get_module_path('logo') . $site_logo); ?>';
        </script>
        <script src="<?php echo get_asset('js_path'); ?>jquery-3.3.1.slim.min.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>popper.min.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>bootstrap.min.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>webslidemenu.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>slick.min.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>magiczoomplus.js"></script>
        <script src="<?php echo get_asset('js_path'); ?>bootstrap-number-input.js "></script>
        <script src="<?php echo get_asset('js_path'); ?>index.js"></script>
        <?php foreach ($plugins_script as $plugin_script) : ?>
            <script src="<?php echo base_url('assets/plugins/' . $plugin_script['folder'] . '/' . $plugin_script['name'] . '.js'); ?>" type="text/javascript"></script>
        <?php endforeach; ?>
        <?php foreach ($modules_script as $module_script) : ?>
            <script src="<?php echo base_url('assets/modules/' . $module_script['folder'] . '/js/' . $module_script['name'] . '.js') . '?v=' . rand(); ?>" type="text/javascript"></script>
        <?php endforeach; ?>
        <?php echo add_js($add_js); ?>
        <script>
            $(document).on('click', '.btn-share-link', function () {
                var ref = '<?php echo isset($ref) ? $ref : ""; ?>';
                var current_url = document.URL;
                if($.trim(ref) != ''){
                    current_url = addRefToURL(ref);
                }
                $('#link-share-product').val(current_url);
                $('#get-link-modal').modal("show");
            });
          (function ($) {
            $(document).on("click", "a.open-popup-product", function(e) {
              e.preventDefault();
              var id = $(this).attr('data-id');
              //console.log('id: ' + id);
              var noidungpopup = $('#product' + id).html();
              //console.log('noidungpopup: ' + noidungpopup);
              $("#myModal .iframe-load").html(noidungpopup);
              $("#myModal").modal("show");
              return false;

              //console.log(arrs[id]);
            });

            $(document).ready(function(){
              $('#myModal').on('hidden.bs.modal', function () {
                $("#myModal .iframe-load").html('');
              });
            });
          })(jQuery);
        </script>
        <script>
          (function ($) {
            $('#myModal').on('shown.bs.modal', function (e) {
              var sync1 = $("#sync1");
              var sync2 = $("#sync2");

              sync1.owlCarousel({
                singleItem : true,
                slideSpeed : 1000,
                navigation: true,
                pagination:false,
                afterAction : syncPosition,
                responsiveRefreshRate : 200,
                transitionStyle : "fade",
                mouseDrag: false,
                navigationText: ["<i class=\"fas fa-angle-left\"></i>", "<i class=\"fas fa-angle-right\"></i>"],
              });

              sync2.owlCarousel({
                itemsCustom: [
                  [0, 3],
                  [450, 3],
                  [600, 4],
                  [700, 4],
                  [1000, 4],
                  [1200, 4],
                  [1400, 4],
                  [1600, 4]
                ],
                pagination:false,
                mouseDrag: false,
                responsiveRefreshRate : 100,
                transitionStyle : "fade",
                afterInit : function(el){
                  el.find(".owl-item").eq(0).addClass("synced");
                }
              });

              function syncPosition(el){
                var current = this.currentItem;
                $("#sync2")
                .find(".owl-item")
                .removeClass("synced")
                .eq(current)
                .addClass("synced")
                if($("#sync2").data("owlCarousel") !== undefined){
                  center(current)
                }
              }

              $("#sync2").on("click", ".owl-item", function(e){
                e.preventDefault();
                var number = $(this).data("owlItem");
                sync1.trigger("owl.goTo",number);
              });

              function center(number){
                var sync2visible = sync2.data("owlCarousel").owl.visibleItems;
                var num = number;
                var found = false;
                for(var i in sync2visible){
                  if(num === sync2visible[i]){
                    var found = true;
                  }
                }

                if(found===false){
                  if(num>sync2visible[sync2visible.length-1]){
                    sync2.trigger("owl.goTo", num - sync2visible.length+2)
                  }else{
                    if(num - 1 === -1){
                      num = 0;
                    }
                    sync2.trigger("owl.goTo", num);
                  }
                } else if(num === sync2visible[sync2visible.length-1]){
                  sync2.trigger("owl.goTo", sync2visible[1])
                } else if(num === sync2visible[0]){
                  sync2.trigger("owl.goTo", num-1)
                }

              }
            });
          })(jQuery);
        </script>
    </body>
</html>
