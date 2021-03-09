<?php
/**
 * @var $comments Comment[]
 * @var $service CommentService
 * @var $topic Topic
 */

use app\models\Comment;
use app\models\Topic;
use app\service\CommentService;
use yii\widgets\Pjax;

?>
<?php Pjax::begin(); ?>
<h2><?= $topic->title ?></h2>
<p> <?= nl2br($topic->body) ?> </p>
<hr>
<div class="col-md-12">
    <div class="panel">
        <div class="panel-body">
            <textarea class="form-control comment-body" rows="2" placeholder="Добавьте Ваш комментарий"></textarea>
            <div class="mar-top clearfix">
                <button class="btn btn-sm btn-primary pull-right comment-submit" data-parentId = "0" type="submit">Добавить</button>
            </div>
        </div>
    </div>
</div>
<div class="comments" data-topicId="<?= $topic->id ?>">
    <h3 class="title-comments">Коментарии (<?= count($comments)?>)</h3>
    <ul class="media-list">
        <?php $service->buildTopicCommentsTree($comments) ?>
    </ul>
</div>
<?php Pjax::end(); ?>
<div class="modal fade" id="commentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-body">
                    <textarea class="form-control comment-body" rows="2" placeholder="Добавьте Ваш комментарий"></textarea>
                    <div class="mar-top clearfix">
                        <button class="btn btn-sm btn-primary pull-right comment-submit" data-parentId = "0" type="submit">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$js = <<< JS
$(document).ready(function() {
    
     $('.feedback-button').on('click', function (e) {
         e.preventDefault();
         let parentId = this.getAttribute('data-parentId');
         $('.comment-submit').attr('data-parentId', parentId);
         console.log($('#comment-submit').data('parentid'));
     })
     
     $(document).on('click', '.comment-submit', function (e) {
         e.preventDefault();
         let parentId = this.getAttribute('data-parentId');
         let topicId = $('.comments').data('topicid');
         let body = $('.comment-body').val();
         console.log(body);
         console.log(topicId);
          $.post('add-comment', {
                topicId: topicId,
                parentId: parentId,
                body: body
        }, function (response) {
                  $('#commentModal').modal('hide');
                  $.pjax.reload({container: '#p0'});
                  $('.comment-body').val('');
        });
     })
});
JS;
$this->registerJs($js);
?>
