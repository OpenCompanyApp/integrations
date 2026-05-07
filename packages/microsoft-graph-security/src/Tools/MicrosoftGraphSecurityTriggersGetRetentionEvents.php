<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get retentionEvent.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/triggers/retentionEvents/{retentionEvent-id}.
 */
class MicrosoftGraphSecurityTriggersGetRetentionEvents extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_triggers_get_retention_events';
    protected const DESCRIPTION = 'Get retentionEvent\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/triggers/retentionEvents/{retentionEvent-id}.';
    protected const PARAMETERS = ['retention_event_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `retentionEvent-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/triggers/retentionEvents/{retentionEvent-id}';
    protected const PATH_PARAMS = ['retentionEvent-id' => 'retention_event_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
