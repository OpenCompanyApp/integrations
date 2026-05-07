<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Cancel a queued TeamCity build.
 */
class TeamCityCancelQueuedBuild extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_cancel_queued_build';
    protected const DESCRIPTION = 'Cancel a queued TeamCity build by locator with an optional BuildCancelRequest payload.';
    protected const METHOD = 'cancelQueuedBuild';
    protected const REQUIRED = ['locator'];
    protected const PARAMETERS = [
        'locator' => ['type' => 'string', 'required' => true, 'description' => 'Queued build locator, for example id:12345.'],
        'payload' => ['type' => 'object', 'description' => 'Optional BuildCancelRequest payload with comment and readdIntoQueue.'],
    ];
}
