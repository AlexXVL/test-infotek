<?php

class m260224_100738_subscriptions extends CDbMigration
{
	public function up(): void
    {
        $this->createTable('tbl_subscriptions', array(
            'id' => 'pk',
            'author_id' => 'integer NOT NULL',
            'email' => 'string NOT NULL',
        ));
	}

	public function down(): void
    {
        $this->dropTable('tbl_subscriptions');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}