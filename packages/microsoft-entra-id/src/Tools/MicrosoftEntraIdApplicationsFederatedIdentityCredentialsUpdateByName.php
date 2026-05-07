<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Upsert federatedIdentityCredential.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /applications/{application-id}/federatedIdentityCredentials(name='{name}').
 */
class MicrosoftEntraIdApplicationsFederatedIdentityCredentialsUpdateByName extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_applications_federated_identity_credentials_update_by_name';
    protected const DESCRIPTION = 'Upsert federatedIdentityCredential\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /applications/{application-id}/federatedIdentityCredentials(name=\'{name}\').';
    protected const PARAMETERS = ['application_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `application-id`.'], 'name' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `name`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/applications/{application-id}/federatedIdentityCredentials(name=\'{name}\')';
    protected const PATH_PARAMS = ['application-id' => 'application_id', 'name' => 'name'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
