<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Count options for a Mistral observability field.
 */
class MistralCountChatCompletionFieldOptions extends AbstractMistralTool
{
    protected const NAME = 'mistral_count_chat_completion_field_options';
    protected const DESCRIPTION = 'Count options for a Mistral observability field.';
    protected const METHOD = 'POST';
    protected const PATH = '/v1/observability/chat-completion-fields/{field_name}/options-counts';
    protected const PATH_PARAMS = ['field_name'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = ['field_name' => ['type' => 'string', 'required' => true, 'description' => 'Mistral field_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the Mistral API schema.']];
}
