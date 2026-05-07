<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create a supported channel in a Front inbox.
 */
class FrontCreateChannel extends AbstractFrontTool
{
    protected const NAME = 'front_create_channel';
    protected const DESCRIPTION = 'Create a custom, SMTP, or Twilio channel in a Front inbox.';
    protected const METHOD = 'POST';
    protected const PATH = '/inboxes/{inbox_id}/channels';
    protected const REQUIRED = ['inbox_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'settings', 'type', 'send_as'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
        'type' => ['type' => 'string', 'required' => true, 'enum' => ['custom', 'smtp', 'twilio'], 'description' => 'Channel type.'],
        'name' => ['type' => 'string', 'description' => 'Channel name.'],
        'send_as' => ['type' => 'string', 'description' => 'Sending address, required for SMTP and Twilio channels.'],
        'settings' => ['type' => 'object', 'description' => 'Channel settings object.'],
    ];
}
