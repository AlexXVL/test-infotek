<?php

final class SubscriptionService
{
    public function init(): void
    {
    }

    public function add($data): Subscription
    {
        $model = Subscription::model()->findByAttributes(array(
            'author_id' => $data['author_id'],
            'email' => $data['email'],
        ));

        if ($model) {
            return $model;
        }

        $model = new Subscription;
        $model->attributes = $data;

        if (!$model->save()) {
            throw new RuntimeException($model->getErrors());
        }

        return $model;
    }
}