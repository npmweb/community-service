<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, minimum-scale=1, user-scalable=0" />

<title>Community Service</title>

@include('layouts.scripts._scripts')

{{-- compiled via sass --}}
<link rel="stylesheet" type="text/css" href="{{ asset('includes/css/dist/main.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ asset('includes/css/makeitbetter.css') }}" />
@yield('css')

@if (is_production())
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-XXXXXX-X', 'auto');
    ga('send', 'pageview');
</script>
@else
<!-- Analytics will go here in prod -->
<script>
if (typeof console === 'undefined') {
    console = {log: function() {},info: function() {}};
}
var ga = ga || function(a,b,c) { console.log('ga undefined, TRACK '+ c.eventCategory + ': '+c.eventLabel); };
</script>
@endif
