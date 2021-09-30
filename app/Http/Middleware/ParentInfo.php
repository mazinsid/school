<?php

namespace App\Http\Middleware;

use App\Models\Parents;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ParentInfo
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
        $iduser = Auth::user()->id;
      
        $user_id = Parents::all()->where('user_id', $iduser)->count();
        if ($user_id == 0) {
            session()->flash('error', 'الرجاء اتمام بيانات التسجيل');
        
               return redirect(route('parents.create'));
            
        
    }
        return $next($request);
    }
}
