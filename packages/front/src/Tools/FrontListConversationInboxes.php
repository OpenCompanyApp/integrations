<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List inboxes that contain a Front conversation.
 */
class FrontListConversationInboxes extends AbstractFrontTool
{
    protected const NAME = 'front_list_conversation_inboxes';
    protected const DESCRIPTION = 'List the inboxes in which a Front conversation is listed.';
    protected const METHOD = 'GET';
    protected const PATH = '/conversations/{conversation_id}/inboxes';
    protected const REQUIRED = ['conversation_id'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
    ];
}
