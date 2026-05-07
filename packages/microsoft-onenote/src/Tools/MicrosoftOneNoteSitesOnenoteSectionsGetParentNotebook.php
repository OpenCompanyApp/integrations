<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Get parentNotebook from sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /sites/{site-id}/onenote/sections/{onenoteSection-id}/parentNotebook.
 */
class MicrosoftOneNoteSitesOnenoteSectionsGetParentNotebook extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_sites_onenote_sections_get_parent_notebook';
    protected const DESCRIPTION = 'Get parentNotebook from sites\n\nOfficial Microsoft Graph v1.0 endpoint: GET /sites/{site-id}/onenote/sections/{onenoteSection-id}/parentNotebook.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/sites/{site-id}/onenote/sections/{onenoteSection-id}/parentNotebook';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'onenoteSection-id' => 'onenote_section_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
