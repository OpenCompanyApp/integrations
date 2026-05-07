<?php

namespace OpenCompany\Integrations\MicrosoftEntraId\Tools;

/**
 * Invoke action disableSmsSignIn.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /users/{user-id}/authentication/phoneMethods/{phoneAuthenticationMethod-id}/disableSmsSignIn.
 */
class MicrosoftEntraIdUsersUserAuthenticationPhoneMethodsPhoneAuthenticationMethodDisableSmsSignIn extends AbstractMicrosoftEntraIdTool
{
    protected const NAME = 'microsoft_entra_id_users_user_authentication_phone_methods_phone_authentication_method_disable_sms_sign_in';
    protected const DESCRIPTION = 'Invoke action disableSmsSignIn\\n\\nOfficial Microsoft Graph v1.0 endpoint: POST /users/{user-id}/authentication/phoneMethods/{phoneAuthenticationMethod-id}/disableSmsSignIn.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'phone_authentication_method_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `phoneAuthenticationMethod-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced directory queries.']];
    protected const METHOD = 'POST';
    protected const PATH = '/users/{user-id}/authentication/phoneMethods/{phoneAuthenticationMethod-id}/disableSmsSignIn';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'phoneAuthenticationMethod-id' => 'phone_authentication_method_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
