<?php

namespace OpenCompany\Integrations\MicrosoftGraphSecurity\Tools;

/**
 * Update property mailboxSettings value..
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /security/subjectRightsRequests/{subjectRightsRequest-id}/collaborators/{user-id}/mailboxSettings.
 */
class MicrosoftGraphSecuritySubjectRightsRequestsCollaboratorsUpdateMailboxSettings extends AbstractMicrosoftGraphSecurityTool
{
    protected const NAME = 'microsoft_graph_security_subject_rights_requests_collaborators_update_mailbox_settings';
    protected const DESCRIPTION = 'Update property mailboxSettings value.\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /security/subjectRightsRequests/{subjectRightsRequest-id}/collaborators/{user-id}/mailboxSettings.';
    protected const PARAMETERS = ['subject_rights_request_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `subjectRightsRequest-id`.'], 'user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced security queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph security OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/security/subjectRightsRequests/{subjectRightsRequest-id}/collaborators/{user-id}/mailboxSettings';
    protected const PATH_PARAMS = ['subjectRightsRequest-id' => 'subject_rights_request_id', 'user-id' => 'user_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
