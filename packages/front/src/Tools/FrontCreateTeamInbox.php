<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Create an inbox under a Front team workspace.
 */
class FrontCreateTeamInbox extends AbstractFrontTool
{
    protected const NAME = 'front_create_team_inbox';
    protected const DESCRIPTION = 'Create an inbox for a Front team workspace.';
    protected const METHOD = 'POST';
    protected const PATH = '/teams/{team_id}/inboxes';
    protected const REQUIRED = ['team_id'];
    protected const BODY_REQUIRED = true;
    protected const BODY_KEYS = ['name', 'teammate_ids', 'is_public', 'custom_fields'];
    protected const PARAMETERS = [
        'team_id' => ['type' => 'string', 'required' => true, 'description' => 'Team workspace ID.'],
        'name' => ['type' => 'string', 'required' => true, 'description' => 'Inbox name.'],
        'teammate_ids' => ['type' => 'array', 'description' => 'Teammate IDs or email aliases that should have access.'],
        'is_public' => ['type' => 'boolean', 'description' => 'Whether the inbox is public.'],
        'custom_fields' => ['type' => 'object', 'description' => 'Inbox custom fields.'],
    ];
}
