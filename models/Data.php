<?php

namespace app\models;

/**
 * This is the model class for table "data".
 *
 * @property int $id
 * @property string|null $articule
 * @property string|null $name
 * @property float|null $balance
 * @property string|null $unit
 */
class Data extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['balance'], 'number'],
            [['articule', 'name'], 'string', 'max' => 255],
            [['unit'], 'string', 'max' => 55],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => '',
            'articule' => 'Артикул',
            'name' => 'Наименование комплектующие',
            'balance' => 'Остаток на складе',
            'unit' => 'Ед. изм.',
        ];
    }
}
