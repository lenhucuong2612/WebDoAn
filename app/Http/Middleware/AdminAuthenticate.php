<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $table)
    {
        $id = $request->route('id'); // Lấy giá trị của {id} từ URL
        $model = app($table); // Lấy instance của model từ tên bảng
        
        $check = $model->find($id);

        if (Auth::user()->id == $check->created_by|| Auth::user()->id == 1) {
            return $next($request);
        } else {
            return redirect()->back()->with('error', 'No duplicate creator');
        }
    }
}
