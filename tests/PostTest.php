<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

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
        $user = factory(App\User::class)->create();

        /*$this->actingAs($user)
          ->visit('/posts/create')
          ->type('new test post3', 'title')
          ->type('first content', 'content')
          ->attach($this->getFile(), 'image')
          ->press('Save')
          ->see('Post was created successfully'); */
    }

    public function testCreatePost()
    {
        $user = factory(App\User::class)->create();
        $response = $this->actingAs($user)->call('POST', '/posts/create', [
            'title'   => 'mohamed',
            'content' => 'test',
            'image'   => $this->getFile()
        ]);
         $this->assertEquals(302, $response->status());
        // $this->assertRedirectedToRoute('post-details',[19]);
    }

    public function getFile()
    {
        $uploadedFile = public_path('postspics/') . '1483274113.jpg';
        $file = [
            'name'     => $uploadedFile,
            'type'     => 'image/png',
            'size'     => 5093,
            'tmp_name' => $uploadedFile,
            'error'    => 0
        ];
        return $this->getUploadedFileForTesting($file, [$uploadedFile => $uploadedFile], $uploadedFile);
    }

}
