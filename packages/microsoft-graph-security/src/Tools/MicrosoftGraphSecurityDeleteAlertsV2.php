<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Delete navigation property alerts_v2 for security.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /security/alerts_v2/{alert-id}.
 */
class MicrosoftGraphSecurityDeleteAlertsV2 extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_delete_alerts_v2';
    protected const DESCRIPTION = 'Delete navigation property alerts_v2 for security\n\nOfficial Microsoft Graph v1.0 endpoint: DELETE /security/alerts_v2/{alert-id}.';
    protected const PARAMETERS = ['alert_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `alert-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/security/alerts_v2/{alert-id}';
    protected const PATH_PARAMS = ['alert-id' => 'alert_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
