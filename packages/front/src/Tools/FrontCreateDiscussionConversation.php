<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a comment-only discussion conversation in Front.
 */
class FrontCreateDiscussionConversation extends AbstractFrontTool
{
    protected const NAME = 'front_create_discussion_conversation';
    protected const DESCRIPTION = 'Create a Front discussion conversation that supports comments only. Use front_create_message for message-capable conversations.';
    protected const METHOD = 'POST';
    protected const PATH = '/conversations';
    protected const REQUIRED = ['type'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['type', 'inbox_id', 'teammate_ids', 'subject', 'comment', 'custom_fields'];
    protected const PARAMETERS = [
        'type' => ['type' => 'string', 'required' => true, 'description' => 'Conversation type. Front expects discussion.'],
        'inbox_id' => ['type' => 'string', 'description' => 'Inbox ID for the conversation. Do not combine with teammate_ids.'],
        'teammate_ids' => ['type' => 'array', 'description' => 'Teammates to add. Do not combine with inbox_id.'],
        'subject' => ['type' => 'string', 'required' => true, 'description' => 'Conversation subject.'],
        'comment' => ['type' => 'object', 'required' => true, 'description' => 'Starter comment object.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Conversation custom fields.'],
    ];
}
