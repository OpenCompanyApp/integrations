<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke action restore.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /identity/conditionalAccess/deletedItems/namedLocations/{namedLocation-id}/restore.
 */
class MicrosoftEntraIdIdentityConditionalAccessDeletedItemsNamedLocationsNamedLocationRestore extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_identity_conditional_access_deleted_items_named_locations_named_location_restore';
    protected const DESCRIPTION = 'Invoke action restore\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /identity/conditionalAccess/deletedItems/namedLocations/{namedLocation-id}/restore.';
    protected const PARAMETERS = ['named_location_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `namedLocation-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/identity/conditionalAccess/deletedItems/namedLocations/{namedLocation-id}/restore';
    protected const PATH_PARAMS = ['namedLocation-id' => 'named_location_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
