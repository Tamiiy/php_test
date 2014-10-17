<?php
class CategoriesController extends AppController {
public $helpers = array('Html', 'Form', 'Session');
public $components = array('Session');
    public function index() {
        //Model:Categoryからカテゴリデータをすべて取得
        $categoryList = $this->Category->find('all'); //同じ名前のControllerからはModelが引っ張れる

        // CategoryのデータをViewに渡す
        $this->set('categories',$categoryList);

        //データもってこれてる？か確認
        //var_dump($categoryList);
    }

    public function view($id) {
        $posts = $this->Category->getPostsWithCategoryId($id);
        echo '<pre>';
        var_dump($posts);
        echo '</pre>';

        if (!$id) { //識別子
            throw new NotFoundException(__('Invalid category'));
        }

        // $category = $this->Category->findById($id);
        // if (!$category) {
        //     throw new NotFoundException(__('Invalid category'));
        // }
        // $this->set('category', $category);
        $this->set('posts', $posts);
    }

    public function add() {
        if ($this->request->is('post')) { //postでrequestがきたときに
            $this->Category->create(); //INSERTする処理を呼んでいる
            if ($this->Category->save($this->request->data)) { //saveができたらtrue
                $this->Session->setFlash(__('Your category has been saved.')); //この文字列を出力
                return $this->redirect(array('action' => 'index')); //リダイレクトして一覧ページに戻る
            }
            $this->Session->setFlash(__('Unable to add your category.')); //保存できなかったよというエラーメッセージ
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid category'));
            //Exceptionは処理を止める(エラーだから)
        }

        $category = $this->Category->findById($id);
        if (!$category) { //対象idのデータがデータベースになかったら
            throw new NotFoundException(__('Invalid category'));
        }

        if ($this->request->is(array('post', 'put'))) { //postリクエストが入ってきたら(編集を終えてsaveボタンを押したら)
            $this->Category->id = $id; //今編集中のデータをモデルに伝えている
            if ($this->Category->save($this->request->data)) {
                $this->Session->setFlash(__('Your category has been updated.')); //Sessionはブラウザのタブの情報まで持っているので、ページを変えても保持できる。setFlashがどこまで表示するかを定義している。
                $this->redirect(array('action' => 'index'));
                return;
                //return で処理が終わる！ので下のsetFlashは呼ばれない
            }
            $this->Session->setFlash(__('Unable to update your category.'));
        }

        if (!$this->request->data) { //$_requestはGETもPOSTもない→単純にeditに入ってきたとき
            $this->request->data = $category; //form内に文字が入る
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__('The category with id: %s has been deleted.', h($id)));
            return $this->redirect(array('action' => 'index'));
        }
    }
}
