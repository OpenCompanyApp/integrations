<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Delete navigation property fields for shares.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /shares/{sharedDriveItem-id}/list/items/{listItem-id}/documentSetVersions/{documentSetVersion-id}/fields.
 */
class MicrosoftSharePointSharesListItemsDocumentSetVersionsDeleteFields extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_shares_list_items_document_set_versions_delete_fields';
    protected const DESCRIPTION = 'Delete navigation property fields for shares

Official Microsoft Graph v1.0 endpoint: DELETE /shares/{sharedDriveItem-id}/list/items/{listItem-id}/documentSetVersions/{documentSetVersion-id}/fields.';
    protected const PARAMETERS = ['shared_drive_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sharedDriveItem-id`.'], 'list_item_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `listItem-id`.'], 'document_set_version_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `documentSetVersion-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/shares/{sharedDriveItem-id}/list/items/{listItem-id}/documentSetVersions/{documentSetVersion-id}/fields';
    protected const PATH_PARAMS = ['sharedDriveItem-id' => 'shared_drive_item_id', 'listItem-id' => 'list_item_id', 'documentSetVersion-id' => 'document_set_version_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
