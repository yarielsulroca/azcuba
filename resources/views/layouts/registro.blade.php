<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">        
        
        <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/registro.css') !!}">
        <link rel="stylesheet" href="{!! asset('css/outdatedbrowser.css') !!}">
    </head>
    <body>
        <!-- <header role="banner">
            <div style="text-align: center;">
                AZCuba
            </div>                
        </header> -->

        <div class="main" role="main">
            @yield('contenido')
        </div>

        <footer role="contentinfo">
            
        </footer>
      
        <script>window.jQuery || document.write('<script src="{!! asset('js/jquery-1.9.1.min.js') !!}"><\/script>')</script>
        <script src="{!! asset('js/bootstrap.min.js') !!}" type="text/javascript" charset="utf-8" async defer></script>
        <script src="{!! asset('js/outdatedbrowser.min.js') !!}" type="text/javascript" charset="utf-8" async defer></script>
        <script>
        	//event listener: DOM ready
			function addLoadEvent(func) {
			    var oldonload = window.onload;
			    if (typeof window.onload != 'function') {
			        window.onload = func;
			    } else {
			        window.onload = function() {
			            if (oldonload) {
			                oldonload();
			            }
			            func();
			        }
			    }
			}
			//call plugin function after DOM ready
			addLoadEvent(function(){
			    outdatedBrowser({
			        bgColor: '#f25648',
			        color: '#ffffff',
			        lowerThan: 'transform',
			        /* languagePath: 'your_path/outdatedbrowser/lang/en.html' */
			    })
			});
        </script>

    </body>
</html>