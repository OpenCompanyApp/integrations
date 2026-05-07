<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get citationTemplate from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/labels/retentionLabels/{retentionLabel-id}/descriptors/citationTemplate.
 */
class MicrosoftGraphSecurityLabelsRetentionLabelsDescriptorsGetCitationTemplate extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_labels_retention_labels_descriptors_get_citation_template';
    protected const DESCRIPTION = 'Get citationTemplate from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/labels/retentionLabels/{retentionLabel-id}/descriptors/citationTemplate.';
    protected const PARAMETERS = ['retention_label_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `retentionLabel-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/labels/retentionLabels/{retentionLabel-id}/descriptors/citationTemplate';
    protected const PATH_PARAMS = ['retentionLabel-id' => 'retention_label_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
