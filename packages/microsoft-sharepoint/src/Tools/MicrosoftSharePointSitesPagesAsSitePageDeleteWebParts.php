<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Delete webPart.
 *
 * Maps to Microsoft Graph v1.0 endpoint DELETE /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/webParts/{webPart-id}.
 */
class MicrosoftSharePointSitesPagesAsSitePageDeleteWebParts extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_pages_as_site_page_delete_web_parts';
    protected const DESCRIPTION = 'Delete webPart

Official Microsoft Graph v1.0 endpoint: DELETE /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/webParts/{webPart-id}.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'base_site_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `baseSitePage-id`.'], 'web_part_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `webPart-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.']];
    protected const METHOD = 'DELETE';
    protected const PATH = '/sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/webParts/{webPart-id}';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'baseSitePage-id' => 'base_site_page_id', 'webPart-id' => 'web_part_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
