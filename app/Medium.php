<?php

/**
 * Created by Reliese Model.
 * Date: Tue, 05 Jun 2018 13:53:53 +0000.
 */

namespace App;

use Reliese\Database\Eloquent\Model as Eloquent;

class Medium extends Eloquent
{
	protected $casts = [
		'model_id' => 'int',
		'size' => 'int',
		'manipulations' => 'json',
		'custom_properties' => 'json',
		'responsive_images' => 'json',
		'order_column' => 'int'
	];

	protected $fillable = [
		'model_type',
		'model_id',
		'collection_name',
		'name',
		'file_name',
		'mime_type',
		'disk',
		'size',
		'manipulations',
		'custom_properties',
		'responsive_images',
		'order_column'
	];

	public function registerMediaCollections()
{
      
      $this->addMediaCollection('featured-bar')->singleFile();

      $this->addMediaCollection('featured-publication')->singleFile();
      
      $this->addMediaCollection('featured-event')->singleFile();
      
      $this->addMediaCollection('featured-reco')->singleFile();
      
      $this->addMediaCollection('avatar-user')->singleFile();
      
      $this->addMediaCollection('banner-user')->singleFile();


      $this->addMediaCollection('gallery-bar');


}

}
