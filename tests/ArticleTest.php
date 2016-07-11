<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Artisan;
class ArticleTest extends TestCase
{

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        /**
         * testing Feed page accessibility
         */
        $this->visit('/')
                ->click('Feed')
                ->seePageIs('/article');
        /**
         * testing show action in case of guest user
         */
        $this->click('article one')
                ->seePageIs('/article/1')
                ->see('First Article')
                ->see('Ahmed')
                ->see('First Article\'s body')
                ->see('To comment please click on link to')
                ->dontsee('Leave a Comment:')
                ;

        $this->click('log in')
                ->seePageIs('/login')
                ;
                
        
        
        
        
        
        
    }

}
