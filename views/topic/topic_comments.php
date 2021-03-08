<?php
/**
 * @var $comments Comment[]
 * @var $service CommentService
 * @var $topicId string
 */

use app\models\Comment;
use app\service\CommentService;

?>
<div class="comments" data-topicId="<?=$topicId?>">
    <h3 class="title-comments">Коментарии (<?= count($comments)?>)</h3>
    <ul class="media-list">
        <?php $service->buildTopicCommentsTree($comments) ?>
    </ul>
</div>