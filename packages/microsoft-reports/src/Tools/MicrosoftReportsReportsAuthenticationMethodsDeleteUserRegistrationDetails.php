<?php

namespace OpenCompany\Integrations\MicrosoftReports\Tools;

/**
 * Delete navigation property userRegistrationDetails for reports.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /reports/authenticationMethods/userRegistrationDetails/{userRegistrationDetails-id}.
 */
class MicrosoftReportsReportsAuthenticationMethodsDeleteUserRegistrationDetails extends AbstractMicrosoftReportsTool
{
    protected const NAME = 'microsoft_reports_reports_authentication_methods_delete_user_registration_details';
    protected const DESCRIPTION = 'Delete navigation property userRegistrationDetails for reports\\n\\nOfficial Microsoft Graph v1.0 endpoint: DELETE /reports/authenticationMethods/userRegistrationDetails/{userRegistrationDetails-id}.';
    protected const PARAMETERS = ['user_registration_details_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `userRegistrationDetails-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/reports/authenticationMethods/userRegistrationDetails/{userRegistrationDetails-id}';
    protected const PATH_PARAMS = ['userRegistrationDetails-id' => 'user_registration_details_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
