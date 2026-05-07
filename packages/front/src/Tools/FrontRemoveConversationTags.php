<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Remove one or more tags from a Front conversation.
 */
class FrontRemoveConversationTags extends AbstractFrontTool
{
    protected const NAME = 'front_remove_conversation_tags';
    protected const DESCRIPTION = 'Remove one or more tag IDs from a Front conversation.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/conversations/{conversation_id}/tags';
    protected const REQUIRED = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['tag_ids'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
        'tag_ids' => ['type' => 'array', 'required' => true, 'description' => 'Tag IDs to remove.'],
    ];
}
