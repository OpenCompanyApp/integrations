<?php

namespace OpenCompany\Integrations\MicrosoftOneNote\Tools;

/**
 * Invoke function getRecentNotebooks.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /groups/{group-id}/sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks}).
 */
class MicrosoftOneNoteGroupsGroupSitesSiteOnenoteNotebooksGetRecentNotebooks extends AbstractMicrosoftOneNoteTool
{
    protected const NAME = 'microsoft_onenote_groups_group_sites_site_onenote_notebooks_get_recent_notebooks';
    protected const DESCRIPTION = 'Invoke function getRecentNotebooks\n\nOfficial Microsoft Graph v1.0 endpoint: GET /groups/{group-id}/sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks}).';
    protected const PARAMETERS = ['group_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `group-id`.'], 'site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'include_personal_notebooks' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `includePersonalNotebooks`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.']];
    protected const METHOD = 'GET';
    protected const PATH = '/groups/{group-id}/sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks})';
    protected const PATH_PARAMS = ['group-id' => 'group_id', 'site-id' => 'site_id', 'includePersonalNotebooks' => 'include_personal_notebooks'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
