<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a draft as the first message of a new Front conversation.
 */
class FrontCreateDraft extends AbstractFrontTool
{
    protected const NAME = 'front_create_draft';
    protected const DESCRIPTION = 'Create a draft message as the first message of a new Front conversation. Multipart attachments are not supported by this JSON helper.';
    protected const METHOD = 'POST';
    protected const PATH = '/channels/{channel_id}/drafts';
    protected const REQUIRED = ['channel_id', 'body'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['author_id', 'to', 'cc', 'bcc', 'subject', 'body', 'text', 'options', 'signature_id', 'should_add_default_signature'];
    protected const PARAMETERS = [
        'channel_id' => ['type' => 'string', 'required' => true, 'description' => 'Channel ID or address alias.'],
        'to' => ['type' => 'array', 'description' => 'Recipient handles.'],
        'cc' => ['type' => 'array', 'description' => 'CC recipient handles.'],
        'bcc' => ['type' => 'array', 'description' => 'BCC recipient handles.'],
        'subject' => ['type' => 'string', 'description' => 'Draft subject.'],
        'body' => ['type' => 'string', 'required' => true, 'description' => 'Draft body.'],
        'author_id' => ['type' => 'string', 'description' => 'Teammate ID or alias.'],
    ];
}
