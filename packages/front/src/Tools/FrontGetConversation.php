<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a single Front conversation by ID.
 */
class FrontGetConversation extends AbstractFrontTool
{
    protected const NAME = 'front_get_conversation';
    protected const DESCRIPTION = 'Get details of a specific Front conversation by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations/{conversation_id}';
    protected const REQUIRED = ['conversation_id'];
    protected const ALIASES = ['conversation_id' => ['id']];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID, such as cnv_123abc.'],
        'id' => ['type' => 'string', 'description' => 'Deprecated alias. Use conversation_id.'],
    ];
}
