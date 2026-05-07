<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Get parentSectionGroup from me.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /me/onenote/sections/{onenoteSection-id}/parentSectionGroup.
 */
class MicrosoftOneNoteMeOnenoteSectionsGetParentSectionGroup extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_me_onenote_sections_get_parent_section_group';
    protected const DESCRIPTION = 'Get parentSectionGroup from me\n\nOfficial Microsoft Graph v1.0 endpoint: GET /me/onenote/sections/{onenoteSection-id}/parentSectionGroup.';
    protected const PARAMETERS = ['onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/me/onenote/sections/{onenoteSection-id}/parentSectionGroup';
    protected const PATH_PARAMS = ['onenoteSection-id' => 'onenote_section_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
