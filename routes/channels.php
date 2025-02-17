<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::routes(['middleware' => ['auth']]);

Broadcast::channel('document.{id}', function ($user, $id) {
    return $user ? ['id' => $user->id, 'name' => $user->name] : null;
});

Broadcast::channel('presence-document.{id}', function ($user, $id) {
    return ['id' => $user->id, 'name' => $user->name];
});