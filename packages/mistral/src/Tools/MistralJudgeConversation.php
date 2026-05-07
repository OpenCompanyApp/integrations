<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Run live judging with a Mistral judge.
 */
class MistralJudgeConversation extends AbstractMistralTool
{
    protected const NAME = 'mistral_judge_conversation';
    protected const DESCRIPTION = 'Run live judging with a Mistral judge.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/judges/{judge_id}/live-judging';
    protected const PATH_PARAMS = ['judge_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['judge_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral judge_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
