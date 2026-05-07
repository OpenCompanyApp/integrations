<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get the item of type microsoft.graph.directoryObject as microsoft.graph.endpoint.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /devices/{device-id}/registeredOwners/{directoryObject-id}/graph.endpoint.
 */
class MicrosoftEntraIdDevicesGetRegisteredOwnersAsEndpoint extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_devices_get_registered_owners_as_endpoint';
    protected const DESCRIPTION = 'Get the item of type microsoft.graph.directoryObject as microsoft.graph.endpoint\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /devices/{device-id}/registeredOwners/{directoryObject-id}/graph.endpoint.';
    protected const PARAMETERS = ['device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `device-id`.'], 'directory_object_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `directoryObject-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/devices/{device-id}/registeredOwners/{directoryObject-id}/graph.endpoint';
    protected const PATH_PARAMS = ['device-id' => 'device_id', 'directoryObject-id' => 'directory_object_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
