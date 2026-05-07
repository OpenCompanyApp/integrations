<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get trackers from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/threatIntelligence/hosts/{host-id}/trackers/{hostTracker-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceHostsGetTrackers extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_hosts_get_trackers';
    protected const DESCRIPTION = 'Get trackers from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/threatIntelligence/hosts/{host-id}/trackers/{hostTracker-id}.';
    protected const PARAMETERS = ['host_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `host-id`.'], 'host_tracker_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `hostTracker-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/threatIntelligence/hosts/{host-id}/trackers/{hostTracker-id}';
    protected const PATH_PARAMS = ['host-id' => 'host_id', 'hostTracker-id' => 'host_tracker_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
