<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Update content for the navigation property resources in users.
 *
 * Maps to Microsoft Graph v1.0 endpoint PUT /users/{user-id}/onenote/resources/{onenoteResource-id}/content.
 */
class MicrosoftOneNoteUsersOnenoteUpdateResourcesContent extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_users_onenote_update_resources_content';
    protected const DESCRIPTION = 'Update content for the navigation property resources in users\n\nOfficial Microsoft Graph v1.0 endpoint: PUT /users/{user-id}/onenote/resources/{onenoteResource-id}/content.';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'onenote_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteResource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw content body. Use `content` for bytes/text and optional `content_type`; defaults to application/octet-stream.']];
    protected const METHOD = 'PUT';
    protected const PATH = '/users/{user-id}/onenote/resources/{onenoteResource-id}/content';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'onenoteResource-id' => 'onenote_resource_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'raw';
}
