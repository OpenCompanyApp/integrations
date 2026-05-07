<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Create new navigation property to runs for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs.
 */
class MicrosoftGraphSecurityAttackSimulationSimulationAutomationsCreateRuns extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_simulation_automations_create_runs';
    protected const DESCRIPTION = 'Create new navigation property to runs for security\n\nOfficial Microsoft Graph v1.0 endpoint: POST /security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs.';
    protected const PARAMETERS = ['simulation_automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `simulationAutomation-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs';
    protected const PATH_PARAMS = ['simulationAutomation-id' => 'simulation_automation_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
