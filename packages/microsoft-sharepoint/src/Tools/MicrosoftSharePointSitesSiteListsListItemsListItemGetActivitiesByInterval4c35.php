<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Invoke function getActivitiesByInterval.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /sites/{site-id}/lists/{list-id}/items/{listItem-id}/getActivitiesByInterval().
 */
class MicrosoftSharePointSitesSiteListsListItemsListItemGetActivitiesByInterval4c35 extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_site_lists_list_items_list_item_get_activities_by_interval_4c35';
    protected const DESCRIPTION = 'Invoke function getActivitiesByInterval

Official Microsoft Graph v1.0 endpoint: GET /sites/{site-id}/lists/{list-id}/items/{listItem-id}/getActivitiesByInterval().';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'list_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `list-id`.'], 'list_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `listItem-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/sites/{site-id}/lists/{list-id}/items/{listItem-id}/getActivitiesByInterval()';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'list-id' => 'list_id', 'listItem-id' => 'list_item_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
