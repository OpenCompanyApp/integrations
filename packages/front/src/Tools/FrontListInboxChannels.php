<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * List channels connected to a Front inbox.
 */
class FrontListInboxChannels extends AbstractFrontTool
{
    protected const NAME = 'front_list_inbox_channels';
    protected const DESCRIPTION = 'List the channels in a Front inbox.';
    protected const METHOD = 'GET';
    protected const PATH = '/inboxes/{inbox_id}/channels';
    protected const REQUIRED = ['inbox_id'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
    ];
}
