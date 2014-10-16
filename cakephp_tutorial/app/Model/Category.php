<?php
class Category extends AppModel {
    public $name = 'Category';
    public $hasMany = array (
        'Post' => array ( //'Post'はなんでもOK
            'className'     => 'Post', //結びつけたいモデル名
            // 'foreignKey'    => 'idct', //結びつけたいデータ
            //'conditions'    => array('Comment.status' => '1'),
            'order'         => 'Post.created DESC'
        )
    );

    public function getPostsWithCategoryId($categoryId){ 
        $posts = array();

        // $conditions = array(
        //     'Category.id' => $categoryId,
        // );

        // $posts = $this->find('all', array(
        //     'conditions' => $conditions
        // ));

        $posts = $this->findById($categoryId);
        return $posts;
    }


    public $validate = array(
        'category_name' => array(
            'rule' => 'notEmpty' //空っぽだったらエラーだよ
        )
    );
}
