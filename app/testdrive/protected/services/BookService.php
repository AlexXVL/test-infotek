<?php

final class BookService
{
    public function init(): void
    {
    }

    /**
     * @throws Exception
     */
    public function add(array $data, array $authorIds): Book
    {
        $this->mustBeAuthCheck();
        $this->checkAuthors($authorIds);

        $transaction = Yii::app()->db->beginTransaction();

        try {
            $book = new Book();
            $book->attributes = $data;

            if (!$book->save()) {
                throw new RuntimeException($book->getErrors());
            }

            $book->syncAuthors($authorIds);

            $transaction->commit();

            return $book;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    public function update(Book $model, array $data, array $authorIds): Book
    {
        $this->mustBeAuthCheck();
        $this->checkAuthors($authorIds);

        $transaction = Yii::app()->db->beginTransaction();

        try {
            $model->attributes = $data;

            if (!$model->save()) {
                throw new RuntimeException('Ошибка сохранения книги');
            }

            $model->syncAuthors($authorIds);

            $transaction->commit();

            return $model;
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    /**
     * @throws CDbException
     */
    public function delete(Book $model): void
    {
        $this->mustBeAuthCheck();

        $transaction = Yii::app()->db->beginTransaction();

        try {
            Yii::app()->db->createCommand()
                ->delete('tbl_author_book', 'book_id=:bookId', [
                    ':bookId' => $model->id,
                ]);

            if (!$model->delete()) {
                throw new RuntimeException('Ошибка сохранения книги');
            }

            $transaction->commit();
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
    }

    private function checkAuthors(array $authorIds): void
    {
        if (empty($authorIds)) {
            throw new RuntimeException('Не выбраны авторы');
        }

        $authors = Author::model()->findAllByPk($authorIds);

        if (count($authors) !== count($authorIds)) {
            throw new RuntimeException('Не все авторы найдены');
        }
    }

    private function mustBeAuthCheck(): void
    {
        if (Yii::app()->user->isGuest) {
            throw new RuntimeException('Пользователь должен быть аутентифицирован');
        }
    }
}