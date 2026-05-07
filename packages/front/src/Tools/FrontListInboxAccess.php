<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List teammates with access to a Front inbox.
 */
class FrontListInboxAccess extends AbstractFrontTool
{
    protected const NAME = 'front_list_inbox_access';
    protected const DESCRIPTION = 'List teammates with access to a Front inbox.';
    protected const METHOD = 'GET';
    protected const PATH = '/inboxes/{inbox_id}/teammates';
    protected const REQUIRED = ['inbox_id'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
    ];
}
