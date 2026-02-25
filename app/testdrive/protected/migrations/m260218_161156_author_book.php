<?php

final class m260218_161156_author_book extends CDbMigration
{
	public function up(): void
    {
        $this->createTable('tbl_author_book', array(
            'id' => 'pk',
            'author_id' => 'integer NOT NULL',
            'book_id' => 'integer NOT NULL',
        ));

        $this->createIndex('idx_author_book_book_id', 'tbl_author_book', 'book_id');
	}

	public function down(): void
    {
        $this->dropTable('tbl_author_book');
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