<?php


namespace app\service;


use app\models\Comment;
use Exception;
use yii\helpers\ArrayHelper;

class CommentService
{
    private $comments =[];

    public function addChildrenComment(Comment $comment, string $body) :? Comment
    {
        $childrenComment = new Comment();
        $childrenComment->parent_id = $comment->id;
        $childrenComment->topic_id = $comment->topic_id;
        $childrenComment->body = $body;

        if ($childrenComment->save()) {
            return $childrenComment;
        }

        return null;
    }

    public function getTopicComments(string $topicId) : array
    {
        return Comment::find()
            ->where(['topic_id' => $topicId])
            ->orderBy(['parent_id' => SORT_ASC, 'id' => SORT_ASC])
            ->all();
    }

    public function getCommentTree(array $comments, Comment $comment): void
    {
        if ($comment->parent_id == 0) {
            echo '<li class="media">
                        <div class="media-left">
                             <a href="#">
                                <img class="media-object img-thumbnail" src="' . ((!empty($comment->author)) ? $comment->author->avatar_url : 'https://yt3.ggpht.com/a/AATXAJxLfPo_WnWZ1D_tOXxhpKWvcbKAyd-bDuC_JA=s900-c-k-c0xffffffff-no-rj-mo') . '" alt="...">
                             </a>
                        </div>
                        <div class="media-body">
                          <div class="media-heading">
                            <div class="author">' . ((!empty($comment->author)) ? $comment->author->name : 'Гость') . '</div>
                            <div class="metadata">
                              <span class="date">' . $comment->created_at . '</span>
                            </div>
                          </div>
                          <div class="media-text text-justify">' . $comment->body . '</div>
                          <div class="footer-comment">
                            <a class="btn btn-default feedback-button" data-toggle="modal" data-target="#commentModal" data-parentId = "' . $comment->id . '" href="#">Ответить</a>
                        </div>
                        <hr>';
        }

        foreach ($comments as $key => $childComment) {

            if ($childComment->parent_id === $comment->id) {
                echo '<div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object img-thumbnail" src="' . ((!empty($childComment->author)) ? $childComment->author->avatar_url : 'https://yt3.ggpht.com/a/AATXAJxLfPo_WnWZ1D_tOXxhpKWvcbKAyd-bDuC_JA=s900-c-k-c0xffffffff-no-rj-mo') . '" alt="">
                          </a>
                     </div>
                    <div class="media-body">
                      <div class="media-heading">
                        <div class="author">' . ((!empty($childComment->author)) ? $childComment->author->name : 'Гость') . '</div>
                        <div class="metadata">
                          <span class="date">' . $childComment->created_at . '</span>
                        </div>
                      </div>
                      <div class="media-text text-justify">' . $childComment->body . '</div>
                      <div class="footer-comment">
                    <a class="btn btn-default feedback-button" data-toggle="modal" data-target="#commentModal" data-parentId = "' . $childComment->id . '" href="#">Ответить</a>
                  </div>
                  <hr>';

                ArrayHelper::remove($this->comments, $key);

                $this->getCommentTree($comments, $childComment);

                echo '</div></div>';
            }
        }

        if ($comment->parent_id == 0) {
            echo '</div></li>';
        }
    }

    public function buildTopicCommentsTree(array $comments) : void
    {
        $this->comments = $comments;

        foreach ($this->comments as $key => $comment) {
            $this->getCommentTree($this->comments, $comment);
        }
    }
}