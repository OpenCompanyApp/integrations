<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Invoke function preview.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /users/{user-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/preview().
 */
class MicrosoftOneNoteUsersUserOnenoteSectionsOnenoteSectionPagesOnenotePagePreview extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_users_user_onenote_sections_onenote_section_pages_onenote_page_preview';
    protected const DESCRIPTION = 'Invoke function preview\n\nOfficial Microsoft Graph v1.0 endpoint: GET /users/{user-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/preview().';
    protected const PARAMETERS = ['user_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `user-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'onenote_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenotePage-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/users/{user-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/preview()';
    protected const PATH_PARAMS = ['user-id' => 'user_id', 'onenoteSection-id' => 'onenote_section_id', 'onenotePage-id' => 'onenote_page_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
