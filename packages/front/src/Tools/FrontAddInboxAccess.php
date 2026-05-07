<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Give teammates access to a Front inbox.
 */
class FrontAddInboxAccess extends AbstractFrontTool
{
    protected const NAME = 'front_add_inbox_access';
    protected const DESCRIPTION = 'Give one or more teammates access to a Front inbox.';
    protected const METHOD = 'POST';
    protected const PATH = '/inboxes/{inbox_id}/teammates';
    protected const REQUIRED = ['inbox_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['teammate_ids'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
        'teammate_ids' => ['type' => 'array', 'required' => true, 'description' => 'Teammate IDs or email aliases to add.'],
    ];
}
