<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "menu_items".
 *
 * @property int $id
 * @property string|null $item_name
 * @property float|null $price
 * @property string|null $description
 * @property string|null $item_photo
 * @property int|null $active
 * @property string|null $created_at
 * @property int|null $created_by
 */
class MenuItems extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_items';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['price'], 'number'],
            [['description', 'item_photo'], 'string'],
            [['active', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['item_name'], 'string', 'max' => 255],
        ];
    }

    /**
    * behaviors
    */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => null
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'item_name' => Yii::t('app', 'Nombre del platillo/Bebida'),
            'price' => Yii::t('app', 'Precio'),
            'description' => Yii::t('app', 'Descripción'),
            'item_photo' => Yii::t('app', 'Fotografía'),
            'active' => Yii::t('app', 'Activo'),
            'created_at' => Yii::t('app', 'Creado el'),
            'created_by' => Yii::t('app', 'Creado por'),
        ];
    }

    /**
     * @return string
     */
    public function getImageFile()
    {
        $uploadPath = Yii::getAlias('@web/img/menu_items');

        return isset($this->item_photo) ? $uploadPath . DIRECTORY_SEPARATOR . $this->item_photo : null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicphoto()
    {
        $uploadPath = Yii::getAlias('@domainName/img/menu_items');

        return isset($this->item_photo) ? $uploadPath . DIRECTORY_SEPARATOR . $this->item_photo : null;
    }

    /**
    * Process upload of image
    *
    * @return mixed the uploaded image instance
    */
    public function uploadImage()
    {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $image = UploadedFile::getInstance($this, 'item_photo');

        // if no image was uploaded abort the upload
        if (empty($image)) {
            return false;
        }

        // store the source file name
        $this->item_photo = $image->name;
        $tmp = explode('.', $image->name);
        $ext = end($tmp);

        // generate a unique file name
        $this->item_photo = Yii::$app->security->generateRandomString() . ".{$ext}";

        // the uploaded image instance
        return $image;
    }

    /**
    * Process deletion of image
    *
    * @return boolean the status of deletion
    */
    public function deleteImage()
    {
        $file = $this->getImageFile();

        // check if file exists on server
        if (empty($file) || !file_exists($file)) {
            return false;
        }

        // check if uploaded file can be deleted on server
        if (!unlink($file)) {
            return false;
        }

        // if deletion successful, reset your file attributes
        $this->item_photo = null;

        return true;
    }

    /**
     * @return string
     */
    public function getItemPhoto()
    {
        return Yii::getAlias('@web') . '/img/menu_items/' . $this->item_photo;
    }
}
