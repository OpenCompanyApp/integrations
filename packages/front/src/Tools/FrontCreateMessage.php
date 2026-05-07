<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a new outbound message through a Front channel.
 */
class FrontCreateMessage extends AbstractFrontTool
{
    protected const NAME = 'front_create_message';
    protected const DESCRIPTION = 'Create and send a new outbound message from a Front channel. Multipart attachments are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/messages';
    protected const REQUIRED = ['channel_id', 'body'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['to', 'cc', 'bcc', 'sender_name', 'subject', 'author_id', 'body', 'text', 'options', 'signature_id', 'should_add_default_signature'];
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Sending channel ID or channel address alias.'],
        'to' => ['type' => 'array', 'description' => 'Recipient handles as strings. One of to, cc, or bcc is required by Front.'],
        'cc' => ['type' => 'array', 'description' => 'CC recipient handles as strings.'],
        'bcc' => ['type' => 'array', 'description' => 'BCC recipient handles as strings.'],
        'subject' => ['type' => 'string', 'description' => 'Email subject.'],
        'body' => ['type' => 'string', 'required' => true, 'description' => 'Message body.'],
        'text' => ['type' => 'string', 'description' => 'Plain-text body for email messages.'],
        'author_id' => ['type' => 'string', 'description' => 'Teammate ID or alias on whose behalf the message is sent.'],
    ];
}
