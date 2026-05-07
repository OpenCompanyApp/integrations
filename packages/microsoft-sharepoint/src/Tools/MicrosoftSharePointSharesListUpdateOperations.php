<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Update the navigation property operations in shares.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /shares/{sharedDriveItem-id}/list/operations/{richLongRunningOperation-id}.
 */
class MicrosoftSharePointSharesListUpdateOperations extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_shares_list_update_operations';
    protected const DESCRIPTION = 'Update the navigation property operations in shares

Official Microsoft Graph v1.0 endpoint: PATCH /shares/{sharedDriveItem-id}/list/operations/{richLongRunningOperation-id}.';
    protected const PARAMETERS = ['shared_drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sharedDriveItem-id`.'], 'rich_long_running_operation_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `richLongRunningOperation-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/shares/{sharedDriveItem-id}/list/operations/{richLongRunningOperation-id}';
    protected const PATH_PARAMS = ['sharedDriveItem-id' => 'shared_drive_item_id', 'richLongRunningOperation-id' => 'rich_long_running_operation_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
