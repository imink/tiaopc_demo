<?php


class Item extends Eloquent {
	protected $fillable = ['seller_id'];


	/**
	 * [pictures description]
	 * @return [type] [description]
	 */
	public function pictures()
	{
		return $this->hasMany('Picture')
					->orderBy('created_at','DESC'); 

	}


	public function prices()
	{
		return $this->hasMany('Price')
					->orderBy('created_at','DESC'); 
	}



	public function transactions()
	{
		return $this->hasMany('Transaction');
	}

	public function users()
	{
		return $this->belongsTo('User');
	}

	public function category()
	{
		return $this->belongsTo('Category', 'category_id', 'id');
	}
}