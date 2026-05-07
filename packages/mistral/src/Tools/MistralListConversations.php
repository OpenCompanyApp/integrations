<?php

namespace OpenCompany\Integrations\Mistral\Tools;

/**
 * List Mistral conversations.
 */
class MistralListConversations extends AbstractMistralTool
{
    protected const NAME = 'mistral_list_conversations';
    protected const DESCRIPTION = 'List Mistral conversations.';
    protected const PATH = '/v1/conversations';
    protected const PARAMETERS = ['query' => ['type' => 'object', 'description' => 'Optional conversation list query parameters.']];
}
