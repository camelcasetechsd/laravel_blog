<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Faker\Factory as faker;

class PostTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
            ->seePageIs('/')
            ->assertResponseOk()
            ->assertViewHas('posts');
        
    }

    public function testCreatePostFlow()
    {
        $user = factory(App\Model\User::class)->create();

        $this->actingAs($user)
          ->visit('/posts/create')
          ->type($this->getFaker()->word, 'title')
          ->type('first content', 'content')
          ->attach($this->getFile(), 'image')
          ->press('Save')
          ->see('Post was created successfully'); 
    }

    public function testCreatePost()
    {
        $user = factory(App\Model\User::class)->create();
        $response = $this->actingAs($user)->call('POST', '/posts/create', [
            'title'   => $this->getFaker()->word,
            'content' => 'test',
            'image'   => $this->getFile()
        ]);
         $this->assertEquals(302, $response->status());
        // $id = App\Model\Post::latest()->first()->id;
         //$this->assertRedirectedToRoute('post-details',[$id]);
    }

    public function getFile()
    {
        $uploadedFile = public_path('fakeImages/') . 'fa33c7452fa295479b6a0c329f4ed294.jpg';
        $file = [
            'name'     => $uploadedFile,
            'type'     => 'image/png',
            'size'     => 5093,
            'tmp_name' => $uploadedFile,
            'error'    => 0
        ];
        return $this->getUploadedFileForTesting($file, [$uploadedFile => $uploadedFile], $uploadedFile);
    }
    public function getFaker(){
        return  faker::create();
    }

}
