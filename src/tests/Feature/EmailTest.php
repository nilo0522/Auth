<?php


namespace Tests\Feature;


use Fligno\Auth\Mail\WebsiteLaunched;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function testEmail(){
        Mail::fake();


//        Mail::assertNothingSent();

        Mail::to('test@example.com')->send(new WebsiteLaunched());

        Mail::assertSent(WebsiteLaunched::class, function ($mail) {
            return $mail;
        });
    }

}
