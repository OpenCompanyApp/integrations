<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete a user.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /users(userPrincipalName='{userPrincipalName}').
 */
class MicrosoftEntraIdUsersUserDeleteUserByUserPrincipalName extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_users_user_delete_user_by_user_principal_name';
    protected const DESCRIPTION = 'Delete a user\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /users(userPrincipalName=\'{userPrincipalName}\').';
    protected const PARAMETERS = ['user_principal_name' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userPrincipalName`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/users(userPrincipalName=\'{userPrincipalName}\')';
    protected const PATH_PARAMS = ['userPrincipalName' => 'user_principal_name'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
