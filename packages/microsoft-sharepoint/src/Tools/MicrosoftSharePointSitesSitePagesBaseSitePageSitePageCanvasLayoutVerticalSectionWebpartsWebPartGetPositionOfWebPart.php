<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Invoke action getPositionOfWebPart.
 *
 * Maps to Microsoft Graph v1.0 endpoint POST /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/verticalSection/webparts/{webPart-id}/getPositionOfWebPart.
 */
class MicrosoftSharePointSitesSitePagesBaseSitePageSitePageCanvasLayoutVerticalSectionWebpartsWebPartGetPositionOfWebPart extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_site_pages_base_site_page_site_page_canvas_layout_vertical_section_webparts_web_part_get_position_of_web_part';
    protected const DESCRIPTION = 'Invoke action getPositionOfWebPart

Official Microsoft Graph v1.0 endpoint: POST /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/verticalSection/webparts/{webPart-id}/getPositionOfWebPart.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'base_site_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `baseSitePage-id`.'], 'web_part_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `webPart-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => false, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'POST';
    protected const PATH = '/sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/verticalSection/webparts/{webPart-id}/getPositionOfWebPart';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'baseSitePage-id' => 'base_site_page_id', 'webPart-id' => 'web_part_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
    protected const BODY_MODE = 'json';
}
