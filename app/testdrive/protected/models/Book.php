<?php

/**
 * This is the model class for table "tbl_books".
 *
 * The followings are the available columns in table 'tbl_books':
 * @property integer $id
 * @property string $title
 * @property integer $year
 * @property string $description
 * @property string $isbn
 * @property string $image
 *
 * @property Author[] $authors
 */
class Book extends CActiveRecord
{
    private ?string $_oldImage = null;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_books';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, year, description, isbn, image', 'required'),
			array('year', 'numerical', 'integerOnly'=>true),
			array('title, description, isbn', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, year, description, isbn', 'safe', 'on'=>'search'),

            array('image', 'file',
                'types'=>'jpg, jpeg, gif, png',
                'allowEmpty' => true,
                'maxSize'=>1024*1024),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(): array
    {
        return array(
            'authors' => array(self::MANY_MANY, Author::class, 'tbl_author_book(book_id, author_id)'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'year' => 'Year',
			'description' => 'Description',
			'isbn' => 'Isbn',
			'image' => 'Image',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('isbn',$this->isbn,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Book the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

    public function syncAuthors(array $authorIds)
    {
        Yii::app()->db->createCommand()
            ->delete('tbl_author_book', 'book_id=:bookId', [
                ':bookId' => $this->id,
            ]);

        foreach ($authorIds as $authorId) {
            Yii::app()->db->createCommand()->insert('tbl_author_book', [
                'book_id'   => $this->id,
                'author_id' => $authorId,
            ]);
        }
    }

    public function beforeValidate(): bool
    {
        $uploadedFile = CUploadedFile::getInstance($this, 'image');

        if ($uploadedFile !== null) {
            $this->image = $uploadedFile;
        } elseif (!is_null($this->_oldImage)) {
            $this->image = $this->_oldImage;
        }

        return parent::beforeValidate();
    }

    public function beforeSave(): bool
    {
        if (!parent::beforeSave()) {
            return false;
        }

        $uploadedFile = CUploadedFile::getInstance($this, 'image');

        if ($uploadedFile !== null) {

            $fileName = uniqid('book_', true) . '.' . $uploadedFile->extensionName;

            $dir = Yii::getPathOfAlias('webroot.uploads.books');

            if (!is_dir($dir) && !mkdir($dir, 0777, true) && !is_dir($dir)) {
                throw new RuntimeException(sprintf('Directory "%s" was not created', $dir));
            }

            $path = $dir . DIRECTORY_SEPARATOR . $fileName;

            if ($uploadedFile->saveAs($path)) {
                $this->image = '/uploads/books/' . $fileName;
            }
        } elseif (!is_null($this->_oldImage)) {
            $this->image = $this->_oldImage;
        }

        return true;
    }

    public function afterFind(): void
    {
        parent::afterFind();
        $this->_oldImage = $this->image;
    }
}
