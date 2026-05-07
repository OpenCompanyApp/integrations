<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Invoke action copyToNotebook.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sections/{onenoteSection-id}/copyToNotebook.
 */
class MicrosoftOneNoteGroupsGroupSitesSiteOnenoteNotebooksNotebookSectionsOnenoteSectionCopyToNotebook extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_groups_group_sites_site_onenote_notebooks_notebook_sections_onenote_section_copy_to_notebook';
    protected const DESCRIPTION = 'Invoke action copyToNotebook\n\nOfficial Microsoft Graph v1.0 endpoint: POST /groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sections/{onenoteSection-id}/copyToNotebook.';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'notebook_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `notebook-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft OneNote OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/groups/{group-id}/sites/{site-id}/onenote/notebooks/{notebook-id}/sections/{onenoteSection-id}/copyToNotebook';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'site-id' => 'site_id', 'notebook-id' => 'notebook_id', 'onenoteSection-id' => 'onenote_section_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
