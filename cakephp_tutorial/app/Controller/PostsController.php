<?php

    class PostsController extends AppController {
   	public $helpers = array('Html', 'Form', 'Session');
	public $components = array('Session');


    	public function index() {
            // ModelからPostデータ一覧を取得
            $postList = $this->Post->find('all');

            // Viewに$postsという名前でデータを渡す
            $this->set('posts', $postList);
        }

    	public function view($id) {
            if (!$id) {
              	throw new NotFoundException(__('Invalid post'));
            }

            $post = $this->Post->findById($id);
            if (!$post) {
                throw new NotFoundException(__('Invalid post'));
            }
            $this->set('post', $post);
    	}

        public function add() {
            if ($this->request->is('post')) { //postでrequestがきたときに
                $this->Post->create(); //INSERTする処理を呼んでいる
                if ($this->Post->save($this->request->data)) { //saveができたらtrue
                    $this->Session->setFlash(__('Your post has been saved.')); //この文字列を出力
                    return $this->redirect(array('action' => 'index')); //リダイレクトして一覧ページに戻る
                }
                $this->Session->setFlash(__('Unable to add your post.')); //保存できなかったよというエラーメッセージ
            }
        }
    }


