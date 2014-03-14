<?php

namespace schmunk42\templay\models;

/**
 * This is the model class for table "templay_data".
 *
 * @property string $id
 * @property string $module
 * @property string $controller
 * @property string $action
 * @property string $param
 * @property string $tid
 * @property string $data
 */
class Template extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'tpy_template';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['data'], 'required'],
			[['data'], 'string'],
			[['module', 'controller', 'action', 'tid'], 'string', 'max' => 64],
			[['param'], 'string', 'max' => 128]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'module' => 'Module',
			'controller' => 'Controller',
			'action' => 'Action',
			'param' => 'Param',
			'tid' => 'Tid',
			'data' => 'Data',
		];
	}
}
