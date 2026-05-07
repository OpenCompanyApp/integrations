<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/$count.
 */
class MicrosoftGraphSecurityDataSecurityAndGovernanceSensitivityLabelsSublabelsGetCount6580 extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_data_security_and_governance_sensitivity_labels_sublabels_get_count_6580';
    protected const DESCRIPTION = 'Get the number of the resource\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/$count.';
    protected const PARAMETERS = ['sensitivity_label_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sensitivityLabel-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/$count';
    protected const PATH_PARAMS = ['sensitivityLabel-id' => 'sensitivity_label_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
