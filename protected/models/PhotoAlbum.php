<?php

/**
 * This is the model class for table "photo_album".
 *
 * The followings are the available columns in table 'photo_album':
 * @property integer $id
 * @property string $name
 * @property string $created_at
 */
class PhotoAlbum extends CActiveRecord
{
    const PHOTO_TYPE = 'album_photos';

	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PhotoAlbum the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'photo_album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, created_at', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, created_at', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'photos' => array(self::HAS_MANY, 'Photo', 'model_id' , 'condition' => 'model_name = :mn' , 'params' => array(':mn' => $this::PHOTO_TYPE) ),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'created_at' => 'Created At',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('created_at',$this->created_at,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function afterSave() {
        $images = CUploadedFile::getInstancesByName($this::PHOTO_TYPE);
        MyLog::debug('..........' . print_r($_FILES , true));
        foreach($images as $image) {
            $photo = new Photo;
            $photo->model_id = $this->id;
            $photo->model_name = $this::PHOTO_TYPE;
            $photo->setImage($this::PHOTO_TYPE, $image);
            $photo->save(false);
        }
    }
}
