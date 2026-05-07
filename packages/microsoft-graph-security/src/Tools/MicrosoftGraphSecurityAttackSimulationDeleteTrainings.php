<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete navigation property trainings for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/attackSimulation/trainings/{training-id}.
 */
class MicrosoftGraphSecurityAttackSimulationDeleteTrainings extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_delete_trainings';
    protected const DESCRIPTION = 'Delete navigation property trainings for security\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/attackSimulation/trainings/{training-id}.';
    protected const PARAMETERS = ['training_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `training-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/attackSimulation/trainings/{training-id}';
    protected const PATH_PARAMS = ['training-id' => 'training_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
