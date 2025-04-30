<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
 
        if (jQuery('#js-free-proxy-table')) {
            jQuery.ajax({
                method: 'GET',
                'url': 'https://api.proxy-checker.net/api/free-proxy-list/',
                success: function (data) {
                    var tableData = [];
                    for (var i = 0; i < data.length; i++) {

                        if (data[i].anonymity == "Высоко-анонимные") {
                            data[i].anonymity = "{{ __('Highly anonymous') }}"
                        }
                        if (data[i].anonymity == "Анонимные") {
                            data[i].anonymity = "{{ __('Anonymous') }}"
                        }
                        if (data[i].anonymity == "прозрачные") {
                            data[i].anonymity = "{{ __('Transparent') }}"
                        }

                        var src = "{{ asset('storage/images/round_flags/') }}/";
                        tableData.push(["<span class='copy_t'></span> " + data[i].ip, data[i].port, '<img src="'+src + data[i].country + '.svg" /> ' + data[i].country + ', ' + data[i].city,
                            data[i].protocol, data[i].anonymity])
                    }
                    jQuery('#js-free-proxy-table').DataTable({
                        searching: false,
                        ordering: false,
                        info: false,
                        pagingType: 'simple_numbers',
                        lengthChange: false,
                        pageLength: 20,

                        language: {
                            paginate: {
                                previous: "←",
                                next: "→",
                                first: "|<",
                                last: ">|"
                            }
                        },
                        data: tableData,
                        columns: [

                            {title: "IP"},
                            {title: "{{ __('Port') }}"},
                            {title: "{{ __('country, city') }}"},
                            {title: "{{ __('Type') }}"},
                            {title: "{{ __('anonymity') }}"},
                        ]
                    });
                   
                }
            });

       
  
        }

function copytext(el) {
    var $tmp = $("<textarea>");
    $("body").append($tmp);
    $tmp.val(el).select();
    document.execCommand("copy");
    $tmp.remove();
}

jQuery('.content').on('click', '.copy_t', function(event) {
var ipport = jQuery(this).parent('td').text() + ":"  +  jQuery(this).parent('td').next('td').text();
copytext(ipport);
}); 
    </script>
<div class="txtpage container speed__page">
<div class="top__title">
     
            @if (count($page_metas) == 0)
                <h1>{!! $page->title !!}</h1>
            @else
            @foreach ($page_metas as $item)
                @if ($item->name == 'zagolovok')
                    {!! $item->content !!}
                @endif
                @break
            @endforeach
            @endif
 
    </div>
     <div class="black__list checkipv6 table__free">

            <div id="js-free-proxy-table_wrapper" class="">
                <table class="" id="js-free-proxy-table" style="width:100%" role="grid"></table>
            </div>
         
     </div>

    <div class="txt__content">
        {!! $page->content !!}
    </div>  
</div>