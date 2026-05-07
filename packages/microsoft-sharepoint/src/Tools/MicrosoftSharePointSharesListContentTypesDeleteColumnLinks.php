<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Delete navigation property columnLinks for shares.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}.
 */
class MicrosoftSharePointSharesListContentTypesDeleteColumnLinks extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_shares_list_content_types_delete_column_links';
    protected const DESCRIPTION = 'Delete navigation property columnLinks for shares

Official Microsoft Graph v1.0 endpoint: DELETE /shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}.';
    protected const PARAMETERS = ['shared_drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sharedDriveItem-id`.'], 'content_type_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `contentType-id`.'], 'column_link_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `columnLink-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/columnLinks/{columnLink-id}';
    protected const PATH_PARAMS = ['sharedDriveItem-id' => 'shared_drive_item_id', 'contentType-id' => 'content_type_id', 'columnLink-id' => 'column_link_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
