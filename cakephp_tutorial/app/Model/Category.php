<?php
    class Category extends AppModel {
        public $validate = array(
            'category_name' => array(
                'rule' => 'notEmpty' //空っぽだったらエラーだよ
            )
            //'user_id' => array(
            //    'rule' => 'notEmpty'
            //)
        );
    }
