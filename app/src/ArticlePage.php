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

    private static $db = [
        'Date' => 'Date',
        'Teaser' => 'Text',
        'Author' => 'Varchar(50)'
    ];

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

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', DateField::create('Date','Date of article'), 'Content');

        $fields->addFieldToTab('Root.Attachments', $photo = UploadField::create('Photo'));
        $fields->addFieldToTab('Root.Attachments',
            $brochure = UploadField::create('Brochure', 'Travel brochure, optional (PDF only)'));

        $photo->getValidator()->setAllowedExtensions(['png', 'gif', 'jpg', 'jpeg']);
        $photo->setFolderName('travel-photos');


        $fields->addFieldToTab('Root.Main', TextareaField::create('Teaser')
            ->setDescription('This is the summary that appears on the article list page.'),
            'Content'
        );

        $fields->addFieldToTab('Root.Main', TextField::create('Author','Author of article'),'Content');

        $brochure->getValidator()->setAllowedExtensions(['pdf']);
        $brochure->setFolderName('travel-brochures');

        $fields->addFieldToTab('Root.Categories', CheckboxSetField::create(
            'Categories',
            'Selected categories',
            $this->Parent()->Categories()->map('ID', 'Title')
        ));

        $fields->addFieldToTab('Root.Main', DropdownField::create(
            'RegionID',
            'Region',
            Region::get()->map('ID', 'Title')
        )->setEmptyString('-- None --'), 'Content');

        return $fields;
    }

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
