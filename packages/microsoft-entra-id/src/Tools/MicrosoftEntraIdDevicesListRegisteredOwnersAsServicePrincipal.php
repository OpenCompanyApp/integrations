<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get the items of type microsoft.graph.servicePrincipal in the microsoft.graph.directoryObject collection.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /devices/{device-id}/registeredOwners/graph.servicePrincipal.
 */
class MicrosoftEntraIdDevicesListRegisteredOwnersAsServicePrincipal extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_devices_list_registered_owners_as_service_principal';
    protected const DESCRIPTION = 'Get the items of type microsoft.graph.servicePrincipal in the microsoft.graph.directoryObject collection\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /devices/{device-id}/registeredOwners/graph.servicePrincipal.';
    protected const PARAMETERS = ['device_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `device-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/devices/{device-id}/registeredOwners/graph.servicePrincipal';
    protected const PATH_PARAMS = ['device-id' => 'device_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
