<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request}}`.
 */
class m220428_192307_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'good_id' => $this->integer(11),
            'user_id' => $this->integer(11),
            'author_id' => $this->integer(11),
            'code' => $this->string(255),
            'status' => $this->integer(1)->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request}}');
    }
}
