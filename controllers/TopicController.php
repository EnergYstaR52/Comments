<?php


namespace app\controllers;


use app\models\Comment;
use app\models\Topic;
use app\service\CommentService;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;

class TopicController extends Controller
{
    protected $commentService;

    public function actionView(string $id)
    {
        $topic = Topic::findOne(['id' => $id]);
        $service = $this->getCommentService();
        $comments = $service->getTopicComments($id);

        return $this->render('topic_comments', [
            'comments' => $comments,
            'service'  => $service,
            'topic'  => $topic,
        ]);
    }

    public function actionAddComment()
    {
        $request = Yii::$app->request;

        if ($request->isPost) {
            $model = new Comment();
            $model->topic_id = $request->post('topicId');
            $model->parent_id = $request->post('parentId');
            $model->body = $request->post('body');

            return $model->save();
        } else {
            throw new HttpException('405' , 'Комент добавить можно только POST');
        }
    }

    protected function getCommentService() : CommentService
    {
        if ($this->commentService) {
            return $this->commentService;
        }

        return new CommentService();
    }
}