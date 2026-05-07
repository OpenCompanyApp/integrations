<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Update the navigation property components in security.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /security/threatIntelligence/vulnerabilities/{vulnerability-id}/components/{vulnerabilityComponent-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceVulnerabilitiesUpdateComponents extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_vulnerabilities_update_components';
    protected const DESCRIPTION = 'Update the navigation property components in security\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /security/threatIntelligence/vulnerabilities/{vulnerability-id}/components/{vulnerabilityComponent-id}.';
    protected const PARAMETERS = ['vulnerability_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `vulnerability-id`.'], 'vulnerability_component_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `vulnerabilityComponent-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/security/threatIntelligence/vulnerabilities/{vulnerability-id}/components/{vulnerabilityComponent-id}';
    protected const PATH_PARAMS = ['vulnerability-id' => 'vulnerability_id', 'vulnerabilityComponent-id' => 'vulnerability_component_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
