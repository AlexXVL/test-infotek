<?php

final class AuthorService
{
    public function init(): void
    {
    }

    /**
     * @throws Exception
     */
    public function top10(?int $year = null): CArrayDataProvider
    {
        if ($year === null) {
            $year = (int)date('Y');
        }

        $data = Yii::app()->db->createCommand('select tbl_authors.id, tbl_authors.name, count(*) as count
from tbl_books
    left join tbl_author_book ON tbl_author_book.book_id = tbl_books.id
    left join tbl_authors ON tbl_authors.id = tbl_author_book.author_id
where year=:year
group by tbl_author_book.author_id
 order by count desc limit 10')
            ->bindValue(':year', $year)
            ->queryAll();

        return new CArrayDataProvider($data, array(
            'id' => 'top10-data',
            'sort' => array(
                'attributes' => array('id', 'name', 'count'),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
    }
}