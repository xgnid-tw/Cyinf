<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Cyinf\Comment;
use Cyinf\Course;

class RouteControllerTest extends TestCase
{

    use WithoutMiddleware;

    protected $seedRowNumber = 25;

    /**
     * Seeding data
     */
    protected function seedData()
    {
        factory( Course::class , $this->seedRowNumber )->create();
        factory( Comment::class , $this->seedRowNumber )->create();
    }

    /**
     * Setup
     */
    public function setUp()
    {
        parent::setUp();
        $this->init();
        $this->seedData();
    }

    public function tearDown()
    {
        $this->reset();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex(){
        $this->call( 'GET' , '/');

        $this->assertResponseOk();

        $this->assertViewHas( [ "total" , "latest_comments" ] );
    }

    public function testCoursePage(){
        $id = mt_rand( 0 , $this->seedRowNumber );

        $this->call( 'GET' , '/course/' . $id );

        $this->assertResponseOk();

        $this->assertViewHas( [ "course" , "comments" ] );

    }

    public function testSearch(){

        $courses_name = Course::all()->pluck('course_nameEN')->random( 5 );

        foreach( $courses_name as $course_name ){
            $result = $this->call( 'POST' , '/search/course/' . $course_name );

            $this->assertResponseOk();

            $this->assertInternalType( "string" ,  $result->content() );
        }


    }
}