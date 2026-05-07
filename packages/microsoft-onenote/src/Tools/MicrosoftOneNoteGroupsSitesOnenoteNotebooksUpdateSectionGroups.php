<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Update the navigation property sectionGroups in groups.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}.
 */
class MicrosoftOneNoteGroupsSitesOnenoteNotebooksUpdateSectionGroups extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_groups_sites_onenote_notebooks_update_section_groups';
    protected const DESCRIPTION = 'Update the navigation property sectionGroups in groups\n\nOfficial Microsoft Graph v1.0 endpoint: PATCH /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}.';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'notebook_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `notebook-id`.'], 'section_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sectionGroup-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft OneNote OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'site-id' => 'site_id', 'notebook-id' => 'notebook_id', 'sectionGroup-id' => 'section_group_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
