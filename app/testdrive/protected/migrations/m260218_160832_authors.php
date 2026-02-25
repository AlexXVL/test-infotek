<?php

final class m260218_160832_authors extends CDbMigration
{
	public function up(): void
    {
        $this->createTable('tbl_authors', array(
            'id' => 'pk',
            'name' => 'string NOT NULL',
            'description' => 'string NOT NULL',
        ));
	}

	public function down(): void
    {
        $this->dropTable('tbl_authors');
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