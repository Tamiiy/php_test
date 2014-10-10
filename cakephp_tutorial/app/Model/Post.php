<?php
    class Post extends AppModel {
        public $validate = array(
            'title' => array(
                'rule' => 'notEmpty' //空っぽだったらエラーだよ
            ),
            'body' => array(
                'rule' => 'notEmpty'
            )
        );
    }
