<?php

namespace app\modules\admin\models;

use Yii;
use app\modules\admin\models\Category;
use yii\db\Expression;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
/**
 * This is the model class for table "request".
 *
 * @property int $id
 * @property string|null $status Статус
 * @property string $name Название
 * @property string $before_img Фото до
 * @property string|null $after_img Фото после
 * @property string|null $why_not Причина отказа
 * @property string $created_at Дата создания
 * @property int $created_by Автор
 * @property int $category_id Категория
 * @property int $updated_by
 */
class Request extends \yii\db\ActiveRecord
{
    public $imageFile1;
    public $imageFile2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request';
    }
    //Добавление "Новая" в строку статуса
    public function __construct(array $config =[])
    {
        parent::__construct($config);
        $this->status = "Новая";
    }
    public function behaviors()
    {
        return [
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
            
        ];
    }
    /**
     * {@inheritdoc}
     */

    public function rules()
    {
        return [
            [['name', 'category_id'], 'required'],
            [['why_not'], 'string'],
            [['created_at'], 'safe'],
            [['created_by', 'category_id', 'updated_by'], 'integer'],
            [['status', 'name', 'before_img', 'after_img'], 'string', 'max' => 256],
            [['imageFile1'], 'file', 'skipOnEmpty'=> false, 'extensions'=> 'png, jpg, tmp, bmp', 'maxSize'=> 10* 1024* 1024],//Правила для расширения и размера файла
            [['imageFile2'], 'file', 'skipOnEmpty'=> true, 'extensions'=> 'png, jpg, tmp, bmp', 'maxSize'=> 10* 1024* 1024],//Правила для расширения и размера файла
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute'=> ['category_id'=>'id']],
            ['imageFile2', 'required', 'when' => function($model, $attribute) {
                return $model->status == 'Решена';
         
           }, 'enableClientValidation' => false],
        ];
    }
    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'category_id']);
    }
    public static function ListStatus(){
        $arr = [
            'Новая' => 'Новая',
            'Решена' => 'Решена',
        ];
        $arr2 = ['Отклонена' => 'Отклонена',];
        if (Yii::$app->user->identity->username=='admin'){
            return array_merge($arr,$arr2);
        }
        return $arr;
    }
    //Загрузка файлов
    public function upload()
    {
        if ($this->validate()) {
            if ($this->imageFile1){
                $path = 'uploads/' . $this->imageFile1->baseName . '.' . $this->imageFile1->extension;//Сохранение пути
                $this->imageFile1->saveAs($path);//Сохранение файла
                $this->before_img= $path;
            }
            if ($this->imageFile2){
                $path = 'uploads/' . $this->imageFile2->baseName . '.' . $this->imageFile2->extension;//Сохранение пути
                $this->imageFile2->saveAs($path);//Сохранение файла
                $this->before_img= $path;
            }
           
            return true;
        } else {
            return false;
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Статус',
            'name' => 'Имя',
            'before_img' => 'Фото до',
            'after_img' => 'Фото после',
            'why_not' => 'Отмена заявки',
            'created_at' => 'Когда создано',
            'created_by' => 'Кем создано',
            'category_id' => 'ID категории',
            'updated_by' => 'Кем обновлено',
        ];
    }
}
