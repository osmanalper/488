<html>
<head>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        var stopSearch;
        $(document).ready(function(){
            $('button').click(function(){
                clearTimeout(stopSearch);
                var url='http://search.twitter.com/search.json?callback=?&rpp=5&q=';
                var query;
                query = $("#query").val();
                doSearch(url, query);
            });
            function doSearch(url, query){
                $.getJSON(url + query, function (json) {
                    var counter = 0;
                    var results = $('#results');
                    results.html('');
                    $.each(json.results, function (i, tweet) {
                        counter++;
                        results.append('<table border="1" bordercolor="#4DD6F6">' +
                            '<tr>' +
                            '<td><img src="' + tweet.profile_image_url + '" widt="48" height="48" /></td>' +
                            '<td>' +
                            '<table>' +
                            '<tr>' +
                            '<td><i id="real_name">' + tweet.from_user_name + '</i>' +
                            '<a href="https://twitter.com/'+tweet.from_user+'" target="_blank" id="nick_name">@' + tweet.from_user + '</a>' +
                            '<i id="date">(' + tweet.created_at + ')</i></td>' +
                            '</tr>' +
                            '<tr>' +
                            '<td colspan="3">' + tweet.text + '</td>' +
                            '</tr>' +
                            '</table>' +
                            '</td>' +
                            '</tr>' +
                            '</table>'
                        );
                    });
                    if(counter==0){
                        results.append('<br><img src="SorryNothingFound.png">');
                    }
                    results.append('<hr>');
                });
                stopSearch = setTimeout(function(){doSearch(url, query)},10000);
            };
        });
        function change(){
            document.getElementById("query").style.backgroundColor="#4DD6F6";
            document.getElementById("query").innerHTML="";
        }
    </script>
</head>
</html>