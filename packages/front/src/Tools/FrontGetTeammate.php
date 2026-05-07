<?php

namespace OpenCompany\Integrations\Front\Tools;

/**
 * Fetch a single Front teammate by ID or email alias.
 */
class FrontGetTeammate extends AbstractFrontTool
{
    protected const NAME = 'front_get_teammate';
    protected const DESCRIPTION = 'Get a Front teammate by teammate ID or email alias.';
    protected const METHOD = 'GET';
    protected const PATH = '/teammates/{teammate_id}';
    protected const REQUIRED = ['teammate_id'];
    protected const PARAMETERS = [
        'teammate_id' => ['type' => 'string', 'required' => true, 'description' => 'Teammate ID or email alias.'],
    ];
}
