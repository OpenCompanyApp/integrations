<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Reply to an existing Front conversation with a message.
 */
class FrontSendMessage extends AbstractFrontTool
{
    protected const NAME = 'front_send_message';
    protected const DESCRIPTION = 'Send a reply message to an existing Front conversation. Multipart attachments are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/conversations/{conversation_id}/messages';
    protected const REQUIRED = ['conversation_id', 'body'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['to', 'cc', 'bcc', 'sender_name', 'subject', 'author_id', 'channel_id', 'body', 'text', 'quote_body', 'options', 'signature_id', 'should_add_default_signature'];
    protected const PARAMETERS = [
        'conversation_id' => ['type' => 'string', 'required' => true, 'description' => 'Conversation ID to reply to.'],
        'body' => ['type' => 'string', 'required' => true, 'description' => 'HTML or text body of the message.'],
        'text' => ['type' => 'string', 'description' => 'Plain-text version for email messages.'],
        'to' => ['type' => 'array', 'description' => 'Recipient handles as strings, such as ["customer@example.test"].'],
        'cc' => ['type' => 'array', 'description' => 'CC recipient handles as strings.'],
        'bcc' => ['type' => 'array', 'description' => 'BCC recipient handles as strings.'],
        'channel_id' => ['type' => 'string', 'description' => 'Channel ID or alias to send from.'],
        'author_id' => ['type' => 'string', 'description' => 'Teammate ID or alias on whose behalf the answer is sent.'],
        'options' => ['type' => 'object', 'description' => 'Optional Front message options object.'],
    ];
}
