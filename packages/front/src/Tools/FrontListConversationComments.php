<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List comments in a Front conversation.
 */
class FrontListConversationComments extends AbstractFrontTool
{
    protected const NAME = 'front_list_conversation_comments';
    protected const DESCRIPTION = 'List comments in a Front conversation in reverse chronological order.';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations/{conversation_id}/comments';
    protected const REQUIRED = ['conversation_id'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
    ];
}
