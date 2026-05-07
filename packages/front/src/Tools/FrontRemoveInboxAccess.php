<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Remove teammates' access to a Front inbox.
 */
class FrontRemoveInboxAccess extends AbstractFrontTool
{
    protected const NAME = 'front_remove_inbox_access';
    protected const DESCRIPTION = 'Remove one or more teammates from a Front inbox access list.';
    protected const METHOD = 'DELETE';
    protected const PATH = '/inboxes/{inbox_id}/teammates';
    protected const REQUIRED = ['inbox_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['teammate_ids'];
    protected const PARAMETERS = [
        'inbox_id' => ['type' => 'string', 'required' => true, 'description' => 'Inbox ID.'],
        'teammate_ids' => ['type' => 'array', 'required' => true, 'description' => 'Teammate IDs or email aliases to remove.'],
    ];
}
