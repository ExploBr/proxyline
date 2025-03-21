<?php

namespace App\Http\Controllers\Admin\Page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Page\UpdateRequest;
use App\Models\Page;

class UpdateController extends BaseController
{
  
    public function __invoke(UpdateRequest $request, Page $page){
   
        $data = $request->validated();
        
        dd($data);
        $this->service->update($page, $data);
 
        return redirect()->route("admin.post.show", $page->id);

    }
}
