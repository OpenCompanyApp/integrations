<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Get categoryTemplate.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /security/labels/categories/{categoryTemplate-id}.
 */
class MicrosoftGraphSecurityLabelsGetCategories extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_labels_get_categories';
    protected const DESCRIPTION = 'Get categoryTemplate\n\nOfficial Microsoft Graph v1.0 endpoint: GET /security/labels/categories/{categoryTemplate-id}.';
    protected const PARAMETERS = ['category_template_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `categoryTemplate-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/security/labels/categories/{categoryTemplate-id}';
    protected const PATH_PARAMS = ['categoryTemplate-id' => 'category_template_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
