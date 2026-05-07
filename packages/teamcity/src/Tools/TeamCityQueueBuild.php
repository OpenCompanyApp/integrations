<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Add a TeamCity build to the queue.
 */
class TeamCityQueueBuild extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_queue_build';
    protected const DESCRIPTION = 'Queue a TeamCity build by sending an official Build entity payload to /buildQueue.';
    protected const METHOD = 'queueBuild';
    protected const REQUIRED = ['payload'];
    protected const PARAMETERS = [
        'payload' => ['type' => 'object', 'required' => true, 'description' => 'TeamCity Build entity, for example {"buildType":{"id":"Project_Build"}}.'],
    ];
}
