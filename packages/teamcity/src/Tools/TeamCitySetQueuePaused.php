<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Pause or resume the TeamCity build queue.
 */
class TeamCitySetQueuePaused extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_set_queue_paused';
    protected const DESCRIPTION = 'Pause or resume the TeamCity build queue using /buildQueue/pausedState.';
    protected const METHOD = 'setQueuePaused';
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'description' => 'PausedState payload such as {"paused":true,"reason":"Maintenance"}.'],
        'paused' => ['type' => 'boolean', 'description' => 'Queue paused state when not using payload.'],
        'reason' => ['type' => 'string', 'description' => 'Optional queue pause reason when not using payload.'],
    ];
}
