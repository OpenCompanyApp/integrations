<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get indicators from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/threatIntelligence/intelProfiles/{intelligenceProfile-id}/indicators/{intelligenceProfileIndicator-id}.
 */
class MicrosoftGraphSecurityThreatIntelligenceIntelProfilesGetIndicators extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_threat_intelligence_intel_profiles_get_indicators';
    protected const DESCRIPTION = 'Get indicators from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/threatIntelligence/intelProfiles/{intelligenceProfile-id}/indicators/{intelligenceProfileIndicator-id}.';
    protected const PARAMETERS = ['intelligence_profile_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `intelligenceProfile-id`.'], 'intelligence_profile_indicator_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `intelligenceProfileIndicator-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/threatIntelligence/intelProfiles/{intelligenceProfile-id}/indicators/{intelligenceProfileIndicator-id}';
    protected const PATH_PARAMS = ['intelligenceProfile-id' => 'intelligence_profile_id', 'intelligenceProfileIndicator-id' => 'intelligence_profile_indicator_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
