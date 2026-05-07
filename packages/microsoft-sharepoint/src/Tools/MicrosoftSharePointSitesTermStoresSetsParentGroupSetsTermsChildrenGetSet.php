<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Get set from sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /sites/{site-id}/termStores/{store-id}/sets/{set-id}/parentGroup/sets/{set-id1}/terms/{term-id}/children/{term-id1}/set.
 */
class MicrosoftSharePointSitesTermStoresSetsParentGroupSetsTermsChildrenGetSet extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_term_stores_sets_parent_group_sets_terms_children_get_set';
    protected const DESCRIPTION = 'Get set from sites

Official Microsoft Graph v1.0 endpoint: GET /sites/{site-id}/termStores/{store-id}/sets/{set-id}/parentGroup/sets/{set-id1}/terms/{term-id}/children/{term-id1}/set.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'store_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `store-id`.'], 'set_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `set-id`.'], 'set_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `set-id1`.'], 'term_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `term-id`.'], 'term_id1' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `term-id1`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/sites/{site-id}/termStores/{store-id}/sets/{set-id}/parentGroup/sets/{set-id1}/terms/{term-id}/children/{term-id1}/set';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'store-id' => 'store_id', 'set-id' => 'set_id', 'set-id1' => 'set_id1', 'term-id' => 'term_id', 'term-id1' => 'term_id1'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
