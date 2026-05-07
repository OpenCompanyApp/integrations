<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Import a historical or external message into a Front inbox.
 */
class FrontImportMessage extends AbstractFrontTool
{
    protected const NAME = 'front_import_message';
    protected const DESCRIPTION = 'Import a message into a Front inbox without sending it through a channel. Multipart attachments are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/inboxes/{inbox_id}/imported_messages';
    protected const REQUIRED = ['inbox_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['sender', 'to', 'cc', 'bcc', 'subject', 'body', 'body_format', 'external_id', 'created_at', 'type', 'assignee_id', 'tags', 'conversation_id', 'metadata'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
        'sender' => ['type' => 'object', 'required' => true, 'description' => 'Sender object.'],
        'to' => ['type' => 'array', 'required' => true, 'description' => 'Recipient handles.'],
        'external_id' => ['type' => 'string', 'required' => true, 'description' => 'External message ID. Front will not import duplicate external IDs.'],
        'created_at' => ['type' => 'integer', 'required' => true, 'description' => 'Unix timestamp when the message was sent or received.'],
        'body' => ['type' => 'string', 'required' => true, 'description' => 'Message body.'],
        'metadata' => ['type' => 'object', 'description' => 'Import metadata, such as is_inbound or is_archived.'],
        'body_format' => ['type' => 'string', 'enum' => ['html', 'markdown'], 'description' => 'Body format.'],
        'tags' => ['type' => 'array', 'description' => 'Tag names to add to the conversation.'],
    ];
}
