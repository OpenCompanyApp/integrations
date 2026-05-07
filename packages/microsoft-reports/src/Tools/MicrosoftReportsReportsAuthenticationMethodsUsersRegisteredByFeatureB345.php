<?php

namespace OpenCompany\Integrations\MicrosoftReports\Tools;

/**
 * Invoke function usersRegisteredByFeature.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /reports/authenticationMethods/usersRegisteredByFeature(includedUserTypes='{includedUserTypes}',includedUserRoles='{includedUserRoles}').
 */
class MicrosoftReportsReportsAuthenticationMethodsUsersRegisteredByFeatureB345 extends AbstractMicrosoftReportsTool
{
    protected const NAME = 'microsoft_reports_reports_authentication_methods_users_registered_by_feature_b345';
    protected const DESCRIPTION = 'Invoke function usersRegisteredByFeature\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /reports/authenticationMethods/usersRegisteredByFeature(includedUserTypes=\'{includedUserTypes}\',includedUserRoles=\'{includedUserRoles}\').';
    protected const PARAMETERS = ['included_user_types' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `includedUserTypes`.'], 'included_user_roles' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `includedUserRoles`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/reports/authenticationMethods/usersRegisteredByFeature(includedUserTypes=\'{includedUserTypes}\',includedUserRoles=\'{includedUserRoles}\')';
    protected const PATH_PARAMS = ['includedUserTypes' => 'included_user_types', 'includedUserRoles' => 'included_user_roles'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
