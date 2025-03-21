@foreach ($page_metas as $meta)
    @if (!is_array($meta->content))
    
        <div class="form-group  ">
            <label for="title">{{ $meta->name }}</label>
            <input class="form-control"
            value="{{$meta->content}}"
            type="text" name="{{ $meta->name }}" id="{{ $meta->name }}">
          
        </div>
    @else

    @endif
  
     
@endforeach