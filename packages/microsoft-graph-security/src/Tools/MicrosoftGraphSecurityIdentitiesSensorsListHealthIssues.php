<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get healthIssues from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/identities/sensors/{sensor-id}/healthIssues.
 */
class MicrosoftGraphSecurityIdentitiesSensorsListHealthIssues extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_identities_sensors_list_health_issues';
    protected const DESCRIPTION = 'Get healthIssues from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/identities/sensors/{sensor-id}/healthIssues.';
    protected const PARAMETERS = ['sensor_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sensor-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/identities/sensors/{sensor-id}/healthIssues';
    protected const PATH_PARAMS = ['sensor-id' => 'sensor_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
