<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Delete windowsHelloForBusinessAuthenticationMethod.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /users/{user-id}/authentication/windowsHelloForBusinessMethods/{windowsHelloForBusinessAuthenticationMethod-id}.
 */
class MicrosoftEntraIdUsersAuthenticationDeleteWindowsHelloForBusinessMethods extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_users_authentication_delete_windows_hello_for_business_methods';
    protected const DESCRIPTION = 'Delete windowsHelloForBusinessAuthenticationMethod\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /users/{user-id}/authentication/windowsHelloForBusinessMethods/{windowsHelloForBusinessAuthenticationMethod-id}.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'windows_hello_for_business_authentication_method_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `windowsHelloForBusinessAuthenticationMethod-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/users/{user-id}/authentication/windowsHelloForBusinessMethods/{windowsHelloForBusinessAuthenticationMethod-id}';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'windowsHelloForBusinessAuthenticationMethod-id' => 'windows_hello_for_business_authentication_method_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
