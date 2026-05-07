<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete navigation property extensions for devices.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /devices/{device-id}/extensions/{extension-id}.
 */
class MicrosoftEntraIdDevicesDeleteExtensions extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_devices_delete_extensions';
    protected const DESCRIPTION = 'Delete navigation property extensions for devices\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /devices/{device-id}/extensions/{extension-id}.';
    protected const PARAMETERS = ['device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `device-id`.'], 'extension_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `extension-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/devices/{device-id}/extensions/{extension-id}';
    protected const PATH_PARAMS = ['device-id' => 'device_id', 'extension-id' => 'extension_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
