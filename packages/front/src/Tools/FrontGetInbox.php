<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a single Front inbox by ID.
 */
class FrontGetInbox extends AbstractFrontTool
{
    protected const NAME = 'front_get_inbox';
    protected const DESCRIPTION = 'Get details for a specific Front inbox by ID.';
    protected const METHOD = 'GET';
    protected const PATH = '/inboxes/{inbox_id}';
    protected const REQUIRED = ['inbox_id'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID, such as inb_123abc.'],
    ];
}
