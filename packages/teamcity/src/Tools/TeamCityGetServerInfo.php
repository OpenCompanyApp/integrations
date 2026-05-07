<?php

namespace OpenCompany\Integrations\TeamCity\Tools;

/**
 * Get TeamCity server version and metadata.
 */
class TeamCityGetServerInfo extends AbstractTeamCityTool
{
    protected const NAME = 'teamcity_get_server_info';
    protected const DESCRIPTION = 'Get TeamCity server details such as version and build number.';
    protected const METHOD = 'getServerInfo';
}
