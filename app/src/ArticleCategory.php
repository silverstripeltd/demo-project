<?php

namespace App\Web;




use App\Web\ArticleHolder;
use App\Web\ArticlePage;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;



class ArticleCategory extends DataObject {

	private static $db = array (
		'Title' => 'Varchar'
	);


	private static $has_one = array (
		'ArticleHolder' => ArticleHolder::class
	);


	private static $belongs_many_many = array (
		'Articles' => ArticlePage::class,
	);

	private static $table_name = 'ArticleCategory';

	
	public function getCMSFields() {
		return FieldList::create(
			TextField::create('Title')
		);
	}

	public function Link () {
		return $this->ArticleHolder()->Link(
			'category/'.$this->ID
		);
	}
	
}