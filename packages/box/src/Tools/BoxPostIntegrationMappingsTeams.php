<?php

namespace OpenCompany\Integrations\Box\Tools;

/**
 * Create Teams integration mapping.
 *
 * Executes the official Box API operation post_integration_mappings_teams.
 */
class BoxPostIntegrationMappingsTeams extends AbstractBoxOperationTool
{
    protected const OPERATION = 'box_post_integration_mappings_teams';
}
