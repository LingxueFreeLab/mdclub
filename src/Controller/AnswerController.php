<?php

declare(strict_types=1);

namespace App\Controller;

use App\Abstracts\ControllerAbstracts;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * 回答
 *
 * Class AnswerController
 * @package App\Controller
 */
class AnswerController extends ControllerAbstracts
{
    /**
     * 获取指定问题下的回答列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $question_id
     * @return Response
     */
    public function getListByQuestionId(Request $request, Response $response, int $question_id): Response
    {
        return $response;
    }

    /**
     * 获取指定用户发表的回答列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $user_id
     * @return Response
     */
    public function getListByUserId(Request $request, Response $response, int $user_id): Response
    {
        return $response;
    }

    /**
     * 获取当前用户发表的回答列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function getMyList(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 获取回答列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function getList(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 在指定问题下创建回答
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $question_id
     * @return Response
     */
    public function create(Request $request, Response $response, int $question_id): Response
    {
        return $response;
    }

    /**
     * 获取指定回答的详情
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function get(Request $request, Response $response, int $answer_id): Response
    {
        return $response;
    }

    /**
     * 更新指定回答信息
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function update(Request $request, Response $response, int $answer_id): Response
    {
        return $response;
    }

    /**
     * 删除指定回答
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function delete(Request $request, Response $response, int $answer_id): Response
    {
        return $response;
    }

    /**
     * 批量删除回答
     *
     * @param  Request  $request
     * @param  Response $response
     * @return Response
     */
    public function batchDelete(Request $request, Response $response): Response
    {
        return $response;
    }

    /**
     * 添加投票
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function addVote(Request $request, Response $response, int $answer_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $type = $request->getParsedBodyParam('type');

        $this->answerVoteService->addVote($userId, $answer_id, $type);
        $voteCount = $this->answerVoteService->getVoteCount($answer_id);

        return $this->success($response, ['vote_count' => $voteCount]);
    }

    /**
     * 删除投票
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function deleteVote(Request $request, Response $response, int $answer_id): Response
    {
        $userId = $this->roleService->userIdOrFail();
        $this->answerVoteService->deleteVote($userId, $answer_id);
        $voteCount = $this->answerVoteService->getVoteCount($answer_id);

        return $this->success($response, ['vote_count' => $voteCount]);
    }

    /**
     * 获取投票者
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function getVoters(Request $request, Response $response, int $answer_id): Response
    {
        $type = $request->getQueryParam('type');
        $voters = $this->answerVoteService->getVoters($answer_id, $type, true);

        return $this->success($response, $voters);
    }

    /**
     * 获取指定回答下的评论列表
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function getComments(Request $request, Response $response, int $answer_id): Response
    {
        $list = $this->answerCommentService->getComments($answer_id, true);

        return $this->success($response, $list);
    }

    /**
     * 在指定回答下发表评论
     *
     * @param  Request  $request
     * @param  Response $response
     * @param  int      $answer_id
     * @return Response
     */
    public function addComment(Request $request, Response $response, int $answer_id): Response
    {
        $content = $request->getParsedBodyParam('content');
        $commentId = $this->answerCommentService->addComment($answer_id, $content);
        $comment = $this->commentService->get($commentId, true);

        return $this->success($response, $comment);
    }
}
