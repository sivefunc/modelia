<?php
 
namespace App\Http\Responses;
 
use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as Responsable;
use Illuminate\Http\RedirectResponse;
 
class LogoutResponse implements Responsable
{
    public function toResponse($request): RedirectResponse
    {
        return to_route('home');
    }
}
