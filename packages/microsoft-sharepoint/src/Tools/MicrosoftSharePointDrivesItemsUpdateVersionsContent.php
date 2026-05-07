<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Update content for the navigation property versions in drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint PUT /drives/{drive-id}/items/{driveItem-id}/versions/{driveItemVersion-id}/content.
 */
class MicrosoftSharePointDrivesItemsUpdateVersionsContent extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_drives_items_update_versions_content';
    protected const DESCRIPTION = 'Update content for the navigation property versions in drives

Official Microsoft Graph v1.0 endpoint: PUT /drives/{drive-id}/items/{driveItem-id}/versions/{driveItemVersion-id}/content.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItem-id`.'], 'drive_item_version_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `driveItemVersion-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw upload payload: provide `content` as a string and optional `content_type`.']];
    protected const METHOD = 'PUT';
    protected const PATH = '/drives/{drive-id}/items/{driveItem-id}/versions/{driveItemVersion-id}/content';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'driveItem-id' => 'drive_item_id', 'driveItemVersion-id' => 'drive_item_version_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'raw';
}
