<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Invoke action onenotePatchContent.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /sites/{site-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/onenotePatchContent.
 */
class MicrosoftSharePointSitesSiteOnenoteSectionsOnenoteSectionPagesOnenotePageOnenotePatchContent extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_site_onenote_sections_onenote_section_pages_onenote_page_onenote_patch_content';
    protected const DESCRIPTION = 'Invoke action onenotePatchContent

Official Microsoft Graph v1.0 endpoint: POST /sites/{site-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/onenotePatchContent.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'onenote_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenotePage-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/sites/{site-id}/onenote/sections/{onenoteSection-id}/pages/{onenotePage-id}/onenotePatchContent';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'onenoteSection-id' => 'onenote_section_id', 'onenotePage-id' => 'onenote_page_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
