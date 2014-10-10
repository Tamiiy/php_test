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

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('The post with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'index'));
        }
    }
}


