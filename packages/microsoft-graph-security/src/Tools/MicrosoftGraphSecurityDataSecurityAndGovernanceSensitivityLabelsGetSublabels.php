<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get sublabels from security.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/{sensitivityLabel-id1}.
 */
class MicrosoftGraphSecurityDataSecurityAndGovernanceSensitivityLabelsGetSublabels extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_data_security_and_governance_sensitivity_labels_get_sublabels';
    protected const DESCRIPTION = 'Get sublabels from security\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/{sensitivityLabel-id1}.';
    protected const PARAMETERS = ['sensitivity_label_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sensitivityLabel-id`.'], 'sensitivity_label_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sensitivityLabel-id1`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/dataSecurityAndGovernance/sensitivityLabels/{sensitivityLabel-id}/sublabels/{sensitivityLabel-id1}';
    protected const PATH_PARAMS = ['sensitivityLabel-id' => 'sensitivity_label_id', 'sensitivityLabel-id1' => 'sensitivity_label_id1'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
