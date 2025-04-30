<div class="top__title">        
            <h1>{!! $page->title !!}</h1>            
</div>  
<div class="main__payment" id="main__payment">
    <pay-component
         :data_all = '@json($data_calculator)'
         :payments = '@json($payments)'
          
         :data = '@json(isset($data) ? $data : '')'
         ></pay-component>
</div>
 