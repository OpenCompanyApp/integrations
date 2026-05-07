<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Get operations from users.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /users/{user-id}/onenote/operations/{onenoteOperation-id}.
 */
class MicrosoftOneNoteUsersOnenoteGetOperations extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_users_onenote_get_operations';
    protected const DESCRIPTION = 'Get operations from users\n\nOfficial Microsoft Graph v1.0 endpoint: GET /users/{user-id}/onenote/operations/{onenoteOperation-id}.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'onenote_operation_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteOperation-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/users/{user-id}/onenote/operations/{onenoteOperation-id}';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'onenoteOperation-id' => 'onenote_operation_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
