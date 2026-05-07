<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete navigation property runs for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs/{simulationAutomationRun-id}.
 */
class MicrosoftGraphSecurityAttackSimulationSimulationAutomationsDeleteRuns extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_simulation_automations_delete_runs';
    protected const DESCRIPTION = 'Delete navigation property runs for security\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs/{simulationAutomationRun-id}.';
    protected const PARAMETERS = ['simulation_automation_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `simulationAutomation-id`.'], 'simulation_automation_run_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `simulationAutomationRun-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/attackSimulation/simulationAutomations/{simulationAutomation-id}/runs/{simulationAutomationRun-id}';
    protected const PATH_PARAMS = ['simulationAutomation-id' => 'simulation_automation_id', 'simulationAutomationRun-id' => 'simulation_automation_run_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
