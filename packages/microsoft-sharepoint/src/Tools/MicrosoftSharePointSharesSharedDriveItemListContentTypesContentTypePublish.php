<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Invoke action publish.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/publish.
 */
class MicrosoftSharePointSharesSharedDriveItemListContentTypesContentTypePublish extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_shares_shared_drive_item_list_content_types_content_type_publish';
    protected const DESCRIPTION = 'Invoke action publish

Official Microsoft Graph v1.0 endpoint: POST /shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/publish.';
    protected const PARAMETERS = ['shared_drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sharedDriveItem-id`.'], 'content_type_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `contentType-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/shares/{sharedDriveItem-id}/list/contentTypes/{contentType-id}/publish';
    protected const PATH_PARAMS = ['sharedDriveItem-id' => 'shared_drive_item_id', 'contentType-id' => 'content_type_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
