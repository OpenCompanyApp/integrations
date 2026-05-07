<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Update a Front teammate.
 */
class FrontUpdateTeammate extends AbstractFrontTool
{
    protected const NAME = 'front_update_teammate';
    protected const DESCRIPTION = 'Update a Front teammate by ID or email alias.';
    protected const METHOD = 'PATCH';
    protected const PATH = '/teammates/{teammate_id}';
    protected const REQUIRED = ['teammate_id'];
    protected const BODY_REQUIRED = true;
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
        'body' => ['type' => 'object', 'required' => true, 'description' => 'Front teammate update payload.'],
    ];
}
