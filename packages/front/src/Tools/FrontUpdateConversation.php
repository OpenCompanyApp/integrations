<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Update assignee, inbox, status, tags, or custom fields on a conversation.
 */
class FrontUpdateConversation extends AbstractFrontTool
{
    protected const NAME = 'front_update_conversation';
    protected const DESCRIPTION = 'Update a Front conversation. Pass custom_fields carefully because Front replaces the full custom field set.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/conversations/{conversation_id}';
    protected const REQUIRED = ['conversation_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['assignee_id', 'inbox_id', 'status', 'status_id', 'tag_ids', 'custom_fields'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID.'],
        'assignee_id' => ['type' => 'string', 'description' => 'Teammate ID to assign. Use the raw body object if you need to send null to unassign.'],
        'inbox_id' => ['type' => 'string', 'description' => 'Inbox ID to move the conversation to.'],
        'status' => ['type' => 'string', 'enum' => ['archived', 'open', 'deleted', 'spam'], 'description' => 'New conversation status.'],
        'status_id' => ['type' => 'string', 'description' => 'Ticketing status ID. Only one of status or status_id should be provided.'],
        'tag_ids' => ['type' => 'array', 'description' => 'Full replacement list of tag IDs.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Full replacement custom fields object.'],
        'body' => ['type' => 'object', 'description' => 'Optional raw update payload. Use this to send null values.'],
    ];
}
