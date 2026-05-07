<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Get columnLinks from drives.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /drives/{drive-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}.
 */
class MicrosoftSharePointDrivesListContentTypesGetColumnLinks extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_drives_list_content_types_get_column_links';
    protected const DESCRIPTION = 'Get columnLinks from drives

Official Microsoft Graph v1.0 endpoint: GET /drives/{drive-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}.';
    protected const PARAMETERS = ['drive_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `drive-id`.'], 'content_type_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `contentType-id`.'], 'column_link_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `columnLink-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/drives/{drive-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}';
    protected const PATH_PARAMS = ['drive-id' => 'drive_id', 'contentType-id' => 'content_type_id', 'columnLink-id' => 'column_link_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
