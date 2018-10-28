<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m181028_135954_create_table_result
 */
class m181028_135954_create_table_result extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%result}}', [
            'id' => Schema::TYPE_PK,
            'test_id' => Schema::TYPE_STRING . ' NOT NULL',
            'question_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'answer_id' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);

        $this->addForeignKey('fk_result_question_id', '{{%result}}', 'question_id',
            '{{%question}}', 'id', 'CASCADE');

        $this->addForeignKey('fk_result_answer_id', '{{%result}}', 'answer_id',
            '{{%answer}}', 'id', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_result_answer_id', '{{%result}}');
        $this->dropForeignKey('fk_result_question_id', '{{%result}}');
        $this->dropTable('{{%result}}');
    }
}
