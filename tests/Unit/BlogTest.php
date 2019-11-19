<?php

namespace Tests\Unit;

use App\Tag;
use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_article_apprtient_a_un_utilisateur()
    {
        $user = factory(User::class)->create();
        
        $article = factory(Post::class)->create(['author_id'=>$user->id]);

        $this->assertTrue($article->author()->first()->is($user));
        $this->assertTrue($article->author->is($user));

    }


    /** @test */
    public function un_article_a_plusieurs_tags()
    {
        $article = factory(Post::class)->create();
        
        $tag = factory(Tag::class)->create(['name'=>'php']);
        $tag2 = factory(Tag::class)->create(['name'=>'laravel']);
        $this->assertCount(0,$article->tags);


        $article->tags()->attach($tag);

        //dd(__CLASS__. 'line :' .__LINE__, '____   $article->tags   ____', $article->tags()->get());

        $this->assertCount(1,$article->tags()->get());
        $this->assertTrue($article->tags()->first()->is($tag));


        //$this->assertContains('php', $article->tags()->get());
    }
}
