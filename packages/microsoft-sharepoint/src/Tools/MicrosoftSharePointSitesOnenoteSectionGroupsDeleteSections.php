<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Delete navigation property sections for sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /sites/{site-id}/onenote/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}.
 */
class MicrosoftSharePointSitesOnenoteSectionGroupsDeleteSections extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_onenote_section_groups_delete_sections';
    protected const DESCRIPTION = 'Delete navigation property sections for sites

Official Microsoft Graph v1.0 endpoint: DELETE /sites/{site-id}/onenote/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'section_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sectionGroup-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/sites/{site-id}/onenote/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'sectionGroup-id' => 'section_group_id', 'onenoteSection-id' => 'onenote_section_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
