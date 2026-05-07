<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * List Teams integration mappings.
 *
 * Executes the official Box API operation get_integration_mappings_teams.
 */
class BoxGetIntegrationMappingsTeams extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_get_integration_mappings_teams';
}
