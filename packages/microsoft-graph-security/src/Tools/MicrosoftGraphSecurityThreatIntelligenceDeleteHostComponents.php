<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete navigation property hostComponents for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/threatIntelligence/hostComponents/{hostComponent-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceDeleteHostComponents extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_delete_host_components';
    protected const DESCRIPTION = 'Delete navigation property hostComponents for security\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/threatIntelligence/hostComponents/{hostComponent-id}.';
    protected const PARAMETERS = ['host_component_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `hostComponent-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/threatIntelligence/hostComponents/{hostComponent-id}';
    protected const PATH_PARAMS = ['hostComponent-id' => 'host_component_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
