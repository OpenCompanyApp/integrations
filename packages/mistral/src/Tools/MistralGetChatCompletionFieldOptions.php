<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * Get options for a Mistral observability field.
 */
class MistralGetChatCompletionFieldOptions extends AbstractMistralTool
{
    protected const NAME = 'mistral_get_chat_completion_field_options';
    protected const DESCRIPTION = 'Get options for a Mistral observability field.';
    protected const METHOD = 'GET';
    protected const PATH = '/v1/observability/chat-completion-fields/{field_name}/options';
    protected const PATH_PARAMS = ['field_name'];
    protected const PARAMETERS = ['field_name' => ['type' => 'string', 'required' => true, 'description' => 'Mistral field_name.'], 'query' => ['type' => 'object', 'description' => 'Optional query parameters.']];
}
