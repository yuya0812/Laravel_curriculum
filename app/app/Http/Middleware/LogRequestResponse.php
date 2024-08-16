<?php

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequestResponse
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
        // リクエストの内容をログに記録
        Log::info('Request Data', [
            'method' => $request->getMethod(),
            'url' => $request->getUri(),
            'headers' => $request->headers->all(),
            'body' => $request->all()
        ]);

        // 次のミドルウェアまたはコントローラーへリクエストを渡す
        $response = $next($request);

        // レスポンスの内容をログに記録
        Log::info('Response Data', [
            'status' => $response->getStatusCode(),
            'headers' => $response->headers->all(),
            'body' => $response->getContent()
        ]);

        return $response;
    }
}

