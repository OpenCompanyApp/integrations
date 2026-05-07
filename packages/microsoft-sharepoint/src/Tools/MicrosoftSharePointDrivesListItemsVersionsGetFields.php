<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Get fields from drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/list/items/{listItem-id}/versions/{listItemVersion-id}/fields.
 */
class MicrosoftSharePointDrivesListItemsVersionsGetFields extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_drives_list_items_versions_get_fields';
    protected const DESCRIPTION = 'Get fields from drives

Official Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/list/items/{listItem-id}/versions/{listItemVersion-id}/fields.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'list_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `listItem-id`.'], 'list_item_version_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `listItemVersion-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/list/items/{listItem-id}/versions/{listItemVersion-id}/fields';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'listItem-id' => 'list_item_id', 'listItemVersion-id' => 'list_item_version_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
