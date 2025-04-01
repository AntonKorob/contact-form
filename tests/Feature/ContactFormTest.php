<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Contact;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contact_form_page_can_be_rendered()
    {
        $response = $this->get('/');
        
        $response->assertStatus(200);
        $response->assertSee('Контактная форма');
        $response->assertSee('Имя *');
        $response->assertSee('Телефон *');
        $response->assertSee('Email *');
    }

    /** @test */
    public function valid_contact_form_submission()
    {
        Storage::fake('local');
        
        $response = $this->postJson('/contact', [
            'name' => 'Иван Иванов',
            'phone' => '+7 (123) 456-78-90',
            'email' => 'ivan@example.com',
            '_token' => csrf_token()
        ]);
        
        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'message' => 'Форма успешно отправлена!'
        ]);
        
        $this->assertDatabaseHas('contacts', [
            'name' => 'Иван Иванов',
            'email' => 'ivan@example.com'
        ]);
        
        // Проверяем что "письмо" было сохранено
        Storage::disk('local')->assertExists('emails/contact_'.now()->format('Y-m-d_His').'_ivan-ivanov.html');
    }

    /** @test */
    // public function name_field_is_required()
    // {
    //     $response = $this->postJson('/contact', [
    //         'phone' => '+7 (123) 456-78-90',
    //         'email' => 'ivan@example.com',
    //         '_token' => csrf_token()
    //     ]);
        
    //     $response->assertStatus(422);
    //     $response->assertJsonValidationErrors('name');
    // }

    /** @test */
    // public function phone_field_is_required()
    // // // {
    // // //     $response = $this->postJson('/contact', [
    // // //         'name' => 'Иван Иванов',
    // // //         'email' => 'ivan@example.com',
    // // //         '_token' => csrf_token()
    // // //     ]);
        
    // // //     $response->assertStatus(422);
    // // //     $response->assertJsonValidationErrors('phone');
    // // // }

    // // /** @test */
    // // public function email_field_is_required()
    // // {
    // //     $response = $this->postJson('/contact', [
    // //         'name' => 'Иван Иванов',
    // //         'phone' => '+7 (123) 456-78-90',
    // //         '_token' => csrf_token()
    // //     ]);
        
    // //     $response->assertStatus(422);
    // //     $response->assertJsonValidationErrors('email');
    // // }

    // /** @test */
    // public function email_must_be_valid()
    // {
    //     $response = $this->postJson('/contact', [
    //         'name' => 'Иван Иванов',
    //         'phone' => '+7 (123) 456-78-90',
    //         'email' => 'invalid-email',
    //         '_token' => csrf_token()
    //     ]);
        
    //     $response->assertStatus(422);
    //     $response->assertJsonValidationErrors('email');
    // }

    /** @test */
    // public function email_content_is_correct()
    // {
    //     Storage::fake('local');
        
    //     $contactData = [
    //         'name' => 'Тестовый Пользователь',
    //         'phone' => '+7 (999) 888-77-66',
    //         'email' => 'test@example.com'
    //     ];
        
    //     $contact = Contact::create($contactData);
        
        // Вызываем метод сохранения письма напрямую
    //     $controller = new \App\Http\Controllers\ContactController();
    //     $controller->saveEmailToFile($contact);
        
        // Получаем сохраненный файл
    //     $files = Storage::disk('local')->files('emails');
    //     $latestFile = last($files);
    //     $emailContent = Storage::disk('local')->get($latestFile);
        
        // Проверяем содержимое письма
    //     $this->assertStringContainsString('Новая заявка с контактной формы', $emailContent);
    //     $this->assertStringContainsString($contactData['name'], $emailContent);
    //     $this->assertStringContainsString($contactData['phone'], $emailContent);
    //     $this->assertStringContainsString($contactData['email'], $emailContent);
    // }

    /** @test */
//     public function contact_form_requires_csrf_token()
//     {
//         $response = $this->postJson('/contact', [
//             'name' => 'Иван Иванов',
//             'phone' => '+7 (123) 456-78-90',
//             'email' => 'ivan@example.com'
//         ]);
        
//         $response->assertStatus(419); // CSRF token mismatch
//     }
//     public function emails_list_page_works()
// {
//     Storage::fake('local');
    
    // Создаем тестовые письма
//     Storage::disk('local')->put('emails/test1.html', 'Test content 1');
//     Storage::disk('local')->put('emails/test2.html', 'Test content 2');
    
//     $response = $this->get('/emails');
    
//     $response->assertStatus(200);
//     $response->assertSee('Test content 1');
//     $response->assertSee('Test content 2');
// }
}