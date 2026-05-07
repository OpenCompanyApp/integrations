<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a single Front message by ID.
 */
class FrontGetMessage extends AbstractFrontTool
{
    protected const NAME = 'front_get_message';
    protected const DESCRIPTION = 'Get details for a specific Front message by ID or resource alias.';
    protected const METHOD = 'GET';
    protected const PATH = '/messages/{message_id}';
    protected const REQUIRED = ['message_id'];
    protected const PARAMETERS = [
        'message_id' => ['type' => 'string', 'required' => true, 'description' => 'Message ID, such as msg_123abc, or an alias such as alt:uid:abc123.'],
    ];
}
