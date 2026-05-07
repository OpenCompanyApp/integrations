<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Invoke function getRecentNotebooks.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks}).
 */
class MicrosoftSharePointSitesSiteOnenoteNotebooksGetRecentNotebooks extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_site_onenote_notebooks_get_recent_notebooks';
    protected const DESCRIPTION = 'Invoke function getRecentNotebooks

Official Microsoft Graph v1.0 endpoint: GET /sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks}).';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'include_personal_notebooks' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `includePersonalNotebooks`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/sites/{site-id}/onenote/notebooks/getRecentNotebooks(includePersonalNotebooks={includePersonalNotebooks})';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'includePersonalNotebooks' => 'include_personal_notebooks'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
