<?php

final class m260218_123528_create_books_table extends CDbMigration
{
	public function up(): void
    {
        $this->createTable('tbl_books', array(
            'id' => 'pk',
            'title' => 'string NOT NULL',
            'year' => 'integer NOT NULL',
            'description' => 'string NOT NULL',
            'isbn' => 'string NOT NULL',
            'image' => 'string NOT NULL',
        ));

        $this->createIndex('idx_books_year', 'tbl_books', 'year');
	}

	public function down(): void
    {
        $this->dropTable('tbl_books');
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