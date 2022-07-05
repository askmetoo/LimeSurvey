<?php


/**
 * This is the model class for table "{{failed_email}}".
 *
 * The following are the available columns in table '{{failed_email}}':
 * @property integer $id primary key
 * @property integer $surveyid the surveyid this one belongs to
 * @property string $subject the email subject
 * @property string $recipient the recipients email address
 * @property string $content the content of the failed email
 * @property string $created datetime when this entry is created
 * @property string $status status in which this entry is default 'SEND FAILED'
 * @property string $update datetim when it was last updated
 */
class FailedEmail extends LSActiveRecord
{
    /**
     * @inheritdoc
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{failed_email}}';
    }

    /**
     * @inheritdoc
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['id, surveyid, subject, recipient, content, created', 'required'],
            ['subject', 'length', 'max' => 200],
            ['recipient', 'length', 'max' => 320],
            ['status', 'length', 'max' => 20],
            ['created, updated', 'safe'],
            // The following rule is used by search().
            ['id, subject, recipient, content, created, status, updated', 'safe', 'on' => 'search'],
        ];
    }

    /**
     * @inheritdoc
     * @return array relational rules.
     */
    public function relations()
    {
        return [];
    }

    /**
     * @inheritdoc
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'subject'   => gt('Email subject'),
            'recipient' => gt('Recipient'),
            'content'   => gt('Email content'),
            'created'   => gt('Date of email failing'),
            'status'    => gt('Status'),
            'update'    => gt('Updated')
        ];
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
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('subject', $this->subject, true);
        $criteria->compare('recipient', $this->recipient, true);
        $criteria->compare('content', $this->content, true);
        $criteria->compare('created', $this->created, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('updated', $this->updated, true);

        return new CActiveDataProvider($this, [
            'criteria' => $criteria,
        ]);
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FailedEmail the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }
}
