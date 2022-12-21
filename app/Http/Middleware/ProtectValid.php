<?php

namespace App\Http\Middleware;

use App\Models\LinkHash;
use App\Models\Scopes\MyScope;
use Closure;
use Illuminate\Http\Request;

class ProtectValid
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $protect = $request->route('protect');

        $link_hash = LinkHash::withoutGlobalScope(MyScope::class)
            ->where('hash', $protect)
            ->firstOrFail();

        $link_hash->delete();

        return $next($request);
    }
}
