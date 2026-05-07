<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Get endpoints from servicePrincipals.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /servicePrincipals/{servicePrincipal-id}/endpoints/{endpoint-id}.
 */
class MicrosoftEntraIdServicePrincipalsGetEndpoints extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_service_principals_get_endpoints';
    protected const DESCRIPTION = 'Get endpoints from servicePrincipals\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /servicePrincipals/{servicePrincipal-id}/endpoints/{endpoint-id}.';
    protected const PARAMETERS = ['service_principal_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `servicePrincipal-id`.'], 'endpoint_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `endpoint-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/servicePrincipals/{servicePrincipal-id}/endpoints/{endpoint-id}';
    protected const PATH_PARAMS = ['servicePrincipal-id' => 'service_principal_id', 'endpoint-id' => 'endpoint_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
