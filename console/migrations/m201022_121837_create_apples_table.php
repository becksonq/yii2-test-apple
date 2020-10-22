<?php

use console\migrations\Migration;

/**
 * Handles the creation of table `{{%apples}}`.
 */
class m201022_121837_create_apples_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%apples}}', [
            'id' => $this->primaryKey(),
            'apple_color' => $this->string()->notNull(),
            'date_create' => $this->integer()->unsigned()->notNull(),
            'date_fall' => $this->integer(),
            'status' => $this->boolean()->notNull()->defaultValue(1),
            'eat_percent' => $this->decimal(5, 2),
            'created_at'   => $this->integer()->unsigned()->notNull(),
            'updated_at'   => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%apples}}');
    }
}
