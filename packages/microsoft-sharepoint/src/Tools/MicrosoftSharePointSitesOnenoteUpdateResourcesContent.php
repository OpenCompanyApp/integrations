<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Update content for the navigation property resources in sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint PUT /sites/{site-id}/onenote/resources/{onenoteResource-id}/content.
 */
class MicrosoftSharePointSitesOnenoteUpdateResourcesContent extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_onenote_update_resources_content';
    protected const DESCRIPTION = 'Update content for the navigation property resources in sites

Official Microsoft Graph v1.0 endpoint: PUT /sites/{site-id}/onenote/resources/{onenoteResource-id}/content.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'onenote_resource_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `onenoteResource-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Raw upload payload: provide `content` as a string and optional `content_type`.']];
    protected const METHOD = 'PUT';
    protected const PATH = '/sites/{site-id}/onenote/resources/{onenoteResource-id}/content';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'onenoteResource-id' => 'onenote_resource_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'raw';
}
