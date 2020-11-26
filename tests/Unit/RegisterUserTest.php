<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Mail;

class RegisterUserTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    /** @test */
    public function user_can_register()
    {
        $this->withoutExceptionHandling();

        // Kunjungi halaman '/register'
        $this->get('/register');

        // Submit form register dengan nama, email dan password 2 kali
        $this->post('register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'username@example.net',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Lihat halaman ter-redirect ke url '/home' (register sukses).
        $response = $this->get('/email/verify');

        // Kita melihat halaman tulisan "Dashboard" pada halaman itu.
        $response->assertSee('John Thor Nom');

        // Lihat di database, tabel users, data user yang register sudah masuk
        $this->assertDatabaseHas('users', [
            'name'  => 'John Thor Nom',
            'email' => 'username@example.net',
        ]);

        // Cek hash password yang tersimpan cocok dengan password yang diinput
        $this->assertTrue(app('hash')->check('password', User::first()->password));
    }

/** @test */
    public function user_name_is_required()
    {
        // Submit form untuk register dengan field 'name' kosong.
        $response = $this->post('/register', [
            'name'                  => '',
            'email'                 => 'username@example.net',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'name'.
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function user_name_maximum_is_255_characters()
    {
        // Submit form untuk register dengan field 'name' 260 karakter.
        $response = $this->post('/register', [
            'name'                  => str_repeat('John Thor Nom', 26),
            'email'                 => 'username@example.net',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'name'.
        $response->assertSessionHasErrors(['name']);
    }

    /** @test */
    public function user_email_is_required()
    {
        // Submit form untuk register dengan field 'email' kosong.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => '',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'email'.
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_email_must_be_a_valid_email()
    {
        // Submit form untuk register dengan field 'email' tidak valid.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'username.example.net',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'email'.
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_email_maximum_is_255_characters()
    {
        // Submit form untuk register dengan field 'email' 260 karakter.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => str_repeat('username@example.net', 13),
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'email'.
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_email_must_be_unique_on_users_table()
    {
        // Buat satu user baru
        $user = factory(User::class)->create(['email' => 'emailsama@example.net']);

        // Submit form untuk register dengan field
        // 'email' yang sudah ada di tabel users.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'emailsama@example.net',
            'password'              => 'password',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'email'.
        $response->assertSessionHasErrors(['email']);
    }

    /** @test */
    public function user_password_is_required()
    {
        // Submit form untuk register dengan field 'password' kosong.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'username@example.net',
            'password'              => '',
            'password_confirmation' => 'password',
        ]);

        // Cek pada session apakah ada error untuk field 'password'.
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function user_password_minimum_is_8_characters()
    {
        // Submit form untuk register dengan field 'password' 5 karakter.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'username@example.net',
            'password'              => 'ecret',
            'password_confirmation' => 'ecret',
        ]);

        // Cek pada session apakah ada error untuk field 'password'.
        $response->assertSessionHasErrors(['password']);
    }

    /** @test */
    public function user_password_must_be_same_with_password_confirmation_field()
    {
        // Submit form untuk register dengan field 'password'
        // beda dengan 'password_confirmation'.
        $response = $this->post('/register', [
            'name'                  => 'John Thor Nom',
            'email'                 => 'username@example.net',
            'password'              => 'password',
            'password_confirmation' => 'escret',
        ]);

        // Cek pada session apakah ada error untuk field 'password'.
        $response->assertSessionHasErrors(['password']);
    }
}
