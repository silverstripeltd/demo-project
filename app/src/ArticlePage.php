<?php

namespace App\Web;

use Page;












use SilverStripe\Assets\Image;
use SilverStripe\Assets\File;
use App\Web\Region;
use App\Web\ArticleCategory;
use App\Web\ArticleComment;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\TextField;
use SilverStripe\Control\Email\Email;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\Form;
use SilverStripe\Control\Session;
use PageController;



class ArticlePage extends Page {

	private static $has_one = array (
		'Photo' => Image::class,
		'Brochure' => File::class,
		'Region' => Region::class
	);


	private static $many_many = array (
		'Categories' => ArticleCategory::class
	);


	private static $has_many = array (
		'Comments' => ArticleComment::class
	);


	private static $can_be_root = false;

	private static $table_name = 'ArticlePage';


	public function getCMSFields() {
		$fields = parent::getCMSFields();

		$fields->addFieldToTab('Root.Attachments', $photo = UploadField::create('Photo'));
		$fields->addFieldToTab('Root.Attachments', $brochure = UploadField::create('Brochure','Travel brochure, optional (PDF only)'));

		$photo->getValidator()->setAllowedExtensions(array('png','gif','jpg','jpeg'));
		$photo->setFolderName('travel-photos');

		$brochure->getValidator()->setAllowedExtensions(array('pdf'));
		$brochure->setFolderName('travel-brochures');

		$fields->addFieldToTab('Root.Categories', CheckboxSetField::create(
			'Categories',
			'Selected categories',
			$this->Parent()->Categories()->map('ID', 'Title')
		));

		$fields->addFieldToTab('Root.Main', DropdownField::create(
			'RegionID',
			Region::class,
			Region::get()->map('ID','Title')
		)->setEmptyString('-- None --'), 'Content');

		return $fields;
	}


	public function CategoriesList() {
		if($this->Categories()->exists()) {
			return implode(', ', $this->Categories()->column('Title'));
		}
	}
	
}

class ArticlePage_Controller extends PageController {


	private static $allowed_actions = array (
		'CommentForm',
	);


	public function CommentForm() {
		$form = Form::create(
			$this,
			__FUNCTION__,
			FieldList::create(
				TextField::create('Name',''),
				EmailField::create(Email::class,''),
				TextareaField::create('Comment','')
			),
			FieldList::create(
				FormAction::create('handleComment','Post Comment')
					->setUseButtonTag(true)
					->addExtraClass('btn btn-default-color btn-lg')
			),
			RequiredFields::create('Name',Email::class,'Comment')
		)->addExtraClass('form-style');

		foreach($form->Fields() as $field) {
			$field->addExtraClass('form-control')
				  ->setAttribute('placeholder', $field->getName().'*');
		}

		$data = $this->getRequest()->getSession()->get("FormData.{$form->getName()}.data");
		
		return $data ? $form->loadDataFrom($data) : $form;
	}


	public function handleComment($data, $form) {
		Session::set("FormData.{$form->getName()}.data", $data);
		$existing = $this->Comments()->filter(array(
			'Comment' => $data['Comment']
		));		
		if($existing->exists() && strlen($data['Comment']) > 20) {
			$form->sessionMessage('That comment already exists! Spammer!','bad');

			return $this->redirectBack();
		}
		$comment = ArticleComment::create();
		$comment->ArticlePageID = $this->ID;
		$form->saveInto($comment);
		$comment->write();

		Session::clear("FormData.{$form->getName()}.data");
		$form->sessionMessage('Thanks for your comment','good');

		return $this->redirectBack();
	}







}