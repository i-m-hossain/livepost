<?php

test('example', function () {
    dump(config('database.default'));
    dump(config('database.connections.sqlite.database'));
    $response = $this->get('/');

    $response->assertStatus(200);
});
