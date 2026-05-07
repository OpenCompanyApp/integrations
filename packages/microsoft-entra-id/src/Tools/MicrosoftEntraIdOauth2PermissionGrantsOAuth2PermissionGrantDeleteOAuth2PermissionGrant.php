<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete oAuth2PermissionGrant (a delegated permission grant).
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /oauth2PermissionGrants/{oAuth2PermissionGrant-id}.
 */
class MicrosoftEntraIdOauth2PermissionGrantsOAuth2PermissionGrantDeleteOAuth2PermissionGrant extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_oauth2_permission_grants_o_auth2_permission_grant_delete_oauth2_permission_grant';
    protected const DESCRIPTION = 'Delete oAuth2PermissionGrant (a delegated permission grant)\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /oauth2PermissionGrants/{oAuth2PermissionGrant-id}.';
    protected const PARAMETERS = ['o_auth2_permission_grant_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `oAuth2PermissionGrant-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/oauth2PermissionGrants/{oAuth2PermissionGrant-id}';
    protected const PATH_PARAMS = ['oAuth2PermissionGrant-id' => 'o_auth2_permission_grant_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
