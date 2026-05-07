<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Update content for the navigation property resources in groups.
 *
 * Maps to Microsoft Graph v1.0 endpoint PUT /groups/{group-id}/onenote/resources/{onenoteResource-id}/content.
 */
class MicrosoftOneNoteGroupsOnenoteUpdateResourcesContent extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_groups_onenote_update_resources_content';
    protected const DESCRIPTION = 'Update content for the navigation property resources in groups\n\nOfficial Microsoft Graph v1.0 endpoint: PUT /groups/{group-id}/onenote/resources/{onenoteResource-id}/content.';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'onenote_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteResource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw content body. Use `content` for bytes/text and optional `content_type`; defaults to application/octet-stream.']];
    protected const METHOD = 'PUT';
    protected const PATH = '/groups/{group-id}/onenote/resources/{onenoteResource-id}/content';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'onenoteResource-id' => 'onenote_resource_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'raw';
}
