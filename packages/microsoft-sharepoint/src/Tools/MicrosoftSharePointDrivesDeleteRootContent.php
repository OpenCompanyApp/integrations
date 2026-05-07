<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Delete content for the navigation property root in drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /drives/{drive-id}/root/content.
 */
class MicrosoftSharePointDrivesDeleteRootContent extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_drives_delete_root_content';
    protected const DESCRIPTION = 'Delete content for the navigation property root in drives

Official Microsoft Graph v1.0 endpoint: DELETE /drives/{drive-id}/root/content.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/drives/{drive-id}/root/content';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
