<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Run live judging on a Mistral chat completion event.
 */
class MistralJudgeChatCompletionEvent extends AbstractMistralTool
{
    protected const NAME = 'mistral_judge_chat_completion_event';
    protected const DESCRIPTION = 'Run live judging on a Mistral chat completion event.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/chat-completion-events/{event_id}/live-judging';
    protected const PATH_PARAMS = ['event_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['event_id' => ['type' => 'string', 'required' => true, 'description' => 'Mistral event_id.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
