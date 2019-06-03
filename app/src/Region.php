<?php

namespace App\Web;

use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\TextField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Control\Controller;
use SilverStripe\ORM\DataObject;

class Region extends DataObject
{

    private static $db = [
        'Title' => 'Varchar',
        'Description' => 'HTMLText',
    ];


    private static $has_one = [
        'Photo' => Image::class,
        'RegionsPage' => RegionsPage::class
    ];

    private static $has_many = [
        'Articles' => ArticlePage::class
    ];

    private static $summary_fields = [
        'GridThumbnail' => '',
        'Title' => 'Title of region',
        'Description' => 'Short description',
    ];

    private static $table_name = 'Region';


    public function getGridThumbnail()
    {
        if ($this->Photo()->exists()) {
            return $this->Photo()->ScaleWidth(100);
        }

        return '(no image)';
    }

    public function getCMSFields()
    {
        $fields = FieldList::create(
            TextField::create('Title'),
            HtmlEditorField::create('Description'),
            $uploader = UploadField::create('Photo')
        );

        $uploader->setFolderName('region-photos');
        $uploader->getValidator()->setAllowedExtensions([
            'png',
            'gif',
            'jpeg',
            'jpg'
        ]);

        return $fields;
    }


    public function Link()
    {
        return $this->RegionsPage()->Link('show/' . $this->ID);
    }


    public function LinkingMode()
    {
        return Controller::curr()->getRequest()->param('ID') == $this->ID ? 'current' : 'link';
    }

    public function ArticlesLink()
    {
        $page = ArticleHolder::get()->first();

        if ($page) {
            return $page->Link('region/' . $this->ID);
        }
    }


}
