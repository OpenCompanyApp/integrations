<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Update the navigation property details in security.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /security/attackSimulation/landingPages/{landingPage-id}/details/{landingPageDetail-id}.
 */
class MicrosoftGraphSecurityAttackSimulationLandingPagesUpdateDetails extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_attack_simulation_landing_pages_update_details';
    protected const DESCRIPTION = 'Update the navigation property details in security\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /security/attackSimulation/landingPages/{landingPage-id}/details/{landingPageDetail-id}.';
    protected const PARAMETERS = ['landing_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `landingPage-id`.'], 'landing_page_detail_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `landingPageDetail-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/security/attackSimulation/landingPages/{landingPage-id}/details/{landingPageDetail-id}';
    protected const PATH_PARAMS = ['landingPage-id' => 'landing_page_id', 'landingPageDetail-id' => 'landing_page_detail_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
