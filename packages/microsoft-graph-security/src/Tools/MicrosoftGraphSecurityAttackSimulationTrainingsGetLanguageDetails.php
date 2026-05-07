<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get trainingLanguageDetail.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/attackSimulation/trainings/{training-id}/languageDetails/{trainingLanguageDetail-id}.
 */
class MicrosoftGraphSecurityAttackSimulationTrainingsGetLanguageDetails extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_trainings_get_language_details';
    protected const DESCRIPTION = 'Get trainingLanguageDetail\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/attackSimulation/trainings/{training-id}/languageDetails/{trainingLanguageDetail-id}.';
    protected const PARAMETERS = ['training_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `training-id`.'], 'training_language_detail_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `trainingLanguageDetail-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/attackSimulation/trainings/{training-id}/languageDetails/{trainingLanguageDetail-id}';
    protected const PATH_PARAMS = ['training-id' => 'training_id', 'trainingLanguageDetail-id' => 'training_language_detail_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
