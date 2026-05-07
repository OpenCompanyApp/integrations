<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Invoke action copyToNotebook.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /me/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}/copyToNotebook.
 */
class MicrosoftOneNoteMeOnenoteNotebooksNotebookSectionGroupsSectionGroupSectionsOnenoteSectionCopyToNotebook extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_me_onenote_notebooks_notebook_section_groups_section_group_sections_onenote_section_copy_to_notebook';
    protected const DESCRIPTION = 'Invoke action copyToNotebook\n\nOfficial Microsoft Graph v1.0 endpoint: POST /me/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}/copyToNotebook.';
    protected const PARAMETERS = ['notebook_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `notebook-id`.'], 'section_group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `sectionGroup-id`.'], 'onenote_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteSection-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft OneNote OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/me/onenote/notebooks/{notebook-id}/sectionGroups/{sectionGroup-id}/sections/{onenoteSection-id}/copyToNotebook';
    protected const PATH_PARAMS = ['notebook-id' => 'notebook_id', 'sectionGroup-id' => 'section_group_id', 'onenoteSection-id' => 'onenote_section_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
