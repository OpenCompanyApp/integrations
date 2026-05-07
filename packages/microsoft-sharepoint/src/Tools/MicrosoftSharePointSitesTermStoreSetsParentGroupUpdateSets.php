<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Update the navigation property sets in sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /sites/{site-id}/termStore/sets/{set-id}/parentGroup/sets/{set-id1}.
 */
class MicrosoftSharePointSitesTermStoreSetsParentGroupUpdateSets extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_term_store_sets_parent_group_update_sets';
    protected const DESCRIPTION = 'Update the navigation property sets in sites

Official Microsoft Graph v1.0 endpoint: PATCH /sites/{site-id}/termStore/sets/{set-id}/parentGroup/sets/{set-id1}.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'set_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `set-id`.'], 'set_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `set-id1`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/sites/{site-id}/termStore/sets/{set-id}/parentGroup/sets/{set-id1}';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'set-id' => 'set_id', 'set-id1' => 'set_id1'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
