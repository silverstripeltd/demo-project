<?php

namespace App\Web;

use Page;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\ArrayList;
use SilverStripe\Versioned\Versioned;
use SilverStripe\View\ArrayData;

class ArticleHolder extends Page
{
    private static $has_many = [
        'Categories' => ArticleCategory::class
    ];

    private static $allowed_children = [
        ArticlePage::class
    ];

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Categories', GridField::create(
            'Categories',
            'Article categories',
            $this->Categories(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }

    public function Regions()
    {
        $page = RegionsPage::get()->first();

        if ($page) {
            return $page->Regions();
        }
    }

    public function ArchiveDates()
    {
        $list = ArrayList::create();
        $stage = Versioned::get_stage();

        $query = new SQLSelect([]);
        $query->selectField("DATE_FORMAT(`Date`,'%Y_%M_%m')", "DateString")
            ->setFrom("ArticlePage_{$stage}")
            ->setOrderBy("Date", "ASC")
            ->setDistinct(true);

        $result = $query->execute();

        if ($result) {
            foreach ($result as $record) {
                list($year, $monthName, $monthNumber) = explode('_', $record['DateString']);

                $list->push(ArrayData::create([
                    'Year' => $year,
                    'MonthName' => $monthName,
                    'MonthNumber' => $monthNumber,
                    'Link' => $this->Link("date/$year/$monthNumber"),
                    'ArticleCount' => ArticlePage::get()->where("
                    DATE_FORMAT(`Date`,'%Y%m') = '{$year}{$monthNumber}'
                            AND ParentID = {$this->ID}
                        ")->count()
                ]));
            }
        }

        return $list;
    }

}
