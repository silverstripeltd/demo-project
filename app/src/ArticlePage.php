<?php

namespace App\Web;

use Page;
use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\DateField;

class ArticlePage extends Page
{
    private static $has_one = [
        'Photo' => Image::class,
        'Brochure' => File::class,
        'Region' => Region::class
    ];

    private static $many_many = [
        'Categories' => ArticleCategory::class
    ];

    private static $has_many = [
        'Comments' => ArticleComment::class
    ];

    private static $can_be_root = false;

    private static $table_name = 'ArticlePage';

    public function CategoriesList()
    {
        if ($this->Categories()->exists()) {
            return implode(', ', $this->Categories()->column('Title'));
        }
    }

    public function ArticleAuthor()
    {
        return $this->Author;
    }
}
