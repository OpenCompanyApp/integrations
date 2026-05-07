<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Invoke function computeInheritance.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/computeInheritance(labelIds={labelIds},locale='{locale}',contentFormats={contentFormats}).
 */
class MicrosoftGraphSecurityDataSecurityAndGovernanceSensitivityLabelsSensitivityLabelSublabelsComputeInheritance extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_data_security_and_governance_sensitivity_labels_sensitivity_label_sublabels_compute_inheritance';
    protected const DESCRIPTION = 'Invoke function computeInheritance\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/computeInheritance(labelIds={labelIds},locale=\'{locale}\',contentFormats={contentFormats}).';
    protected const PARAMETERS = ['sensitivity_label_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sensitivityLabel-id`.'], 'label_ids' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `labelIds`.'], 'locale' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `locale`.'], 'content_formats' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `contentFormats`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/computeInheritance(labelIds={labelIds},locale=\'{locale}\',contentFormats={contentFormats})';
    protected const PATH_PARAMS = ['sensitivityLabel-id' => 'sensitivity_label_id', 'labelIds' => 'label_ids', 'locale' => 'locale', 'contentFormats' => 'content_formats'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
