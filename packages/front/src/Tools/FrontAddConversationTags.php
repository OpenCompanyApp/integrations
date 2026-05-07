<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Add one or more tags to a Front conversation.
 */
class FrontAddConversationTags extends AbstractFrontTool
{
    protected const NAME = 'front_add_conversation_tags';
    protected const DESCRIPTION = 'Add one or more tag IDs to a Front conversation.';
    protected const METHOD = 'POST';
    protected const PATH = '/conversations/{conversation_id}/tags';
    protected const REQUIRED = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['tag_ids'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
        'tag_ids' => ['type' => 'array', 'required' => true, 'description' => 'Tag IDs to add.'],
    ];
}
