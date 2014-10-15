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

    public function getPostsWithCategoryId($categoryId){ //関数名は自分でつけたもの
        //パラメータを初期化
        $posts = array();

        $conditions = array(
            'Post.category_id' => $categoryId,
            //Where文：'Post.category_id'と$categoryIdが一致したものをfindせよ！
        );
        $order = array('Post.created ASC');
        //並べ替え条件の指定

        //$sql = "SELECT * FROM posts WHERE category_id = $categoryId ORDER BY created ASC"
        $posts = $this->find('all', array(
            'conditions' => $conditions,
            'order' => $order
        ));
        //$thisは俺！postModelが俺だからpostを指定する必要がない
        //$conditionsの条件をすべてもってこい！
        //ここでSELECT文発行！

        return $posts;
    }
}
