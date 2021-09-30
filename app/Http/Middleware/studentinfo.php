<?php

namespace App\Http\Middleware;

use App\Models\students;
use Closure;
use Illuminate\Http\Request;

class studentinfo
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user_id= students::all()->where('user_id', $request->id)->count();
        if ($user_id == 0) {
            session()->flash('error', 'الرجاء اتمام بيانات  الطالب');
        
               return redirect(route('parent.students'));
            
        
    }
        return $next($request);
    }
}
