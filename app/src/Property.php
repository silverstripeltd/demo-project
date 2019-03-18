<?php

namespace App\Web;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\Filters\PartialMatchFilter;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\Filters\ExactMatchFilter;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\CurrencyField;
use SilverStripe\ORM\ArrayLib;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\ORM\DataObject;


class Property extends DataObject
{

    private static $db = [
        'Title' => 'Varchar',
        'PricePerNight' => 'Currency',
        'Bedrooms' => 'Int',
        'Bathrooms' => 'Int',
        'FeaturedOnHomepage' => 'Boolean',
        'AvailableStart' => 'Date',
        'AvailableEnd' => 'Date',
        'Description' => 'Text'
    ];

    private static $has_one = [
        'Region' => Region::class,
        'PrimaryPhoto' => Image::class
    ];

    private static $summary_fields = [
        'Title' => 'Title',
        'Region.Title' => 'Region',
        'PricePerNight.Nice' => 'Price',
        'FeaturedOnHomepage.Nice' => 'Featured?'
    ];

    private static $table_name = 'Property';

    public function searchableFields()
    {
        return [
            'Title' => [
                'filter' => PartialMatchFilter::class,
                'title' => 'Title',
                'field' => TextField::class
            ],
            'RegionID' => [
                'filter' => ExactMatchFilter::class,
                'title' => Region::class,
                'field' => DropdownField::create('RegionID')
                    ->setSource(
                        Region::get()->map('ID', 'Title')
                    )
                    ->setEmptyString('-- Any region --')
            ],
            'FeaturedOnHomepage' => [
                'filter' => ExactMatchFilter::class,
                'title' => 'Only featured'
            ]
        ];
    }


    public function getCMSFields()
    {
        $fields = FieldList::create(TabSet::create('Root'));
        $fields->addFieldsToTab('Root.Main', [
            TextField::create('Title'),
            TextareaField::create('Description'),
            CurrencyField::create('PricePerNight', 'Price (per night)'),
            DropdownField::create('Bedrooms')
                ->setSource(ArrayLib::valuekey(range(1, 10))),
            DropdownField::create('Bathrooms')
                ->setSource(ArrayLib::valuekey(range(1, 10))),
            DropdownField::create('RegionID', Region::class)
                ->setSource(Region::get()->map('ID', 'Title'))
                ->setEmptyString('-- Select a region --'),
            CheckboxField::create('FeaturedOnHomepage', 'Feature on homepage')
        ]);
        $fields->addFieldToTab('Root.Photos', $upload = UploadField::create(
            'PrimaryPhoto',
            'Primary photo'
        ));

        $upload->getValidator()->setAllowedExtensions([
            'png',
            'jpeg',
            'jpg',
            'gif'
        ]);
        $upload->setFolderName('property-photos');

        return $fields;
    }

}
