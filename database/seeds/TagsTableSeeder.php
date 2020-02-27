<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //Prendo dati da array del file tags.php
        $tags = config('tags.tags_coll');
        //scorro array
        foreach ($tags as $tag) {
            $new_tag = new Tag();
            $new_tag->fill($tag);
            //Salvo dati su db
            $new_tag->save();
        }
    }
}
