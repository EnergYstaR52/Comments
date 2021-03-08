<?php


namespace app\service;


use app\models\Comment;
use Exception;

class CommentService
{
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

    public function getCommentTree(array $comments, Comment $comment) : void
    {
        if ($comment->parent_id === 0) {
            echo '<li class="media">
                        <div class="media-left">
                             <a href="#">
                                <img class="media-object img-thumbnail" src="' . $comment->author->avatar_url . '" alt="...">
                             </a>
                        </div>
                        <div class="media-body">
                          <div class="media-heading">
                            <div class="author">' . $comment->author->name . '</div>
                            <div class="metadata">
                              <span class="date">' . $comment->created_at . '</span>
                            </div>
                          </div>
                          <div class="media-text text-justify">' . $comment->body . '</div>
                          <div class="footer-comment">
                            <a class="btn btn-default" data-parentId = "' . $comment->id . '" href="#">Ответить</a>
                        </div>
                        <hr>';
        }

        foreach ($comments as $childComment) {
           if ($childComment->parent_id === $comment->id) {
               echo '<div class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object img-thumbnail" src="' . $childComment->author->avatar_url . '" alt="">
                          </a>
                     </div>
                    <div class="media-body">
                      <div class="media-heading">
                        <div class="author">' . $childComment->author->name . '</div>
                        <div class="metadata">
                          <span class="date">' . $childComment->created_at . '</span>
                        </div>
                      </div>
                      <div class="media-text text-justify">' . $childComment->body . '</div>
                      <div class="footer-comment">
                    <a class="btn btn-default" data-parentId = "' . $childComment->id . '" href="#">Ответить</a>
                  </div>
                  <hr>';
                    $this->getCommentTree($comments, $childComment);
                }
            }

        echo '</li>';
    }

    public function buildTopicCommentsTree(array $comments) : void
    {
        foreach ($comments as $comment) {
            $this->getCommentTree($comments, $comment);
        }
    }
}