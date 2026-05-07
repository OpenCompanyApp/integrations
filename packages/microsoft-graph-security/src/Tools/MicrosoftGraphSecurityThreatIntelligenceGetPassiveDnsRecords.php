<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get passiveDnsRecord.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/threatIntelligence/passiveDnsRecords/{passiveDnsRecord-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceGetPassiveDnsRecords extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_get_passive_dns_records';
    protected const DESCRIPTION = 'Get passiveDnsRecord\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/threatIntelligence/passiveDnsRecords/{passiveDnsRecord-id}.';
    protected const PARAMETERS = ['passive_dns_record_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `passiveDnsRecord-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/threatIntelligence/passiveDnsRecords/{passiveDnsRecord-id}';
    protected const PATH_PARAMS = ['passiveDnsRecord-id' => 'passive_dns_record_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
