<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Get the number of the resource.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/$count.
 */
class MicrosoftOneNoteGroupsSitesOnenoteNotebooksSectionGroupsGetCountB8c2 extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_groups_sites_onenote_notebooks_section_groups_get_count_b8c2';
    protected const DESCRIPTION = 'Get the number of the resource\n\nOfficial Microsoft Graph v1.0 endpoint: GET /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/$count.';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'notebook_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `notebook-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/$count';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'site-id' => 'site_id', 'notebook-id' => 'notebook_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
