<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%algorithm_results}}`.
 */
class m200307_204759_create_algorithm_results_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%algorithm_results}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->null(),
            'request_data' => $this->text(),
            'result' => $this->integer(),
        ]);

        $this->addForeignKey(
            'fk-algorithm_results-user_id',
            'algorithm_results',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%algorithm_results}}');
    }
}
