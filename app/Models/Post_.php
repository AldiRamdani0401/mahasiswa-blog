<?php

namespace App\Models;

class Post
{
    private static $blog_posts =     [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Aldi Ramdani",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi possimus commodi debitis itaque odit repellendus pariatur tenetur nulla quos quaerat ullam, aperiam, impedit autem voluptatem esse quidem consequatur dolorem suscipit minima fugit beatae asperiores incidunt? Soluta quidem, molestias expedita illo nemo adipisci vero rerum minus voluptatum, animi saepe repudiandae omnis exercitationem accusantium error ducimus iure. Voluptatem, aut. Expedita quia quasi cum consectetur officia, explicabo illo debitis eligendi assumenda temporibus placeat, ullam, eum sequi nisi saepe natus asperiores iusto? Voluptatem sunt qui blanditiis tenetur. Magnam odit cumque praesentium nihil consequatur inventore deserunt aliquid, reiciendis ratione tempore porro alias sapiente doloremque! Id."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Ramdani Aldi",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi possimus commodi debitis itaque odit repellendus pariatur tenetur nulla quos quaerat ullam, aperiam, impedit autem voluptatem esse quidem consequatur dolorem suscipit minima fugit beatae asperiores incidunt? Soluta quidem, molestias expedita illo nemo adipisci vero rerum minus voluptatum, animi saepe repudiandae omnis exercitationem accusantium error ducimus iure. Voluptatem, aut. Expedita quia quasi cum consectetur officia, explicabo illo debitis eligendi assumenda temporibus placeat, ullam, eum sequi nisi saepe natus asperiores iusto? Voluptatem sunt qui blanditiis tenetur. Magnam odit cumque praesentium nihil consequatur inventore deserunt aliquid, reiciendis ratione tempore porro alias sapiente doloremque! Id."
        ],
        [
            "title" => "Judul Post Ketiga",
            "slug" => "judul-post-ketiga",
            "author" => "Si Ganteng",
            "body" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Excepturi possimus commodi debitis itaque odit repellendus pariatur tenetur nulla quos quaerat ullam, aperiam, impedit autem voluptatem esse quidem consequatur dolorem suscipit minima fugit beatae asperiores incidunt? Soluta quidem, molestias expedita illo nemo adipisci vero rerum minus voluptatum, animi saepe repudiandae omnis exercitationem accusantium error ducimus iure. Voluptatem, aut. Expedita quia quasi cum consectetur officia, explicabo illo debitis eligendi assumenda temporibus placeat, ullam, eum sequi nisi saepe natus asperiores iusto? Voluptatem sunt qui blanditiis tenetur. Magnam odit cumque praesentium nihil consequatur inventore deserunt aliquid, reiciendis ratione tempore porro alias sapiente doloremque! Id."
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();
        // $post = [];
        // foreach($posts as $p){
        //     if($p["slug"] === $slug){
        //         $post = $p;
        //     }
        // }
        return $posts->firstWhere('slug', $slug);
    }
}
