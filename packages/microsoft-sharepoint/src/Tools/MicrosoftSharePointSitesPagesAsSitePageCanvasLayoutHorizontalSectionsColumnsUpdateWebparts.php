<?php

namespace OpenCompany\Integrations\MicrosoftSharePoint\Tools;

/**
 * Update the navigation property webparts in sites.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/horizontalSections/{horizontalSection-id}/columns/{horizontalSectionColumn-id}/webparts/{webPart-id}.
 */
class MicrosoftSharePointSitesPagesAsSitePageCanvasLayoutHorizontalSectionsColumnsUpdateWebparts extends AbstractMicrosoftSharePointTool
{
    protected const NAME = 'microsoft_sharepoint_sites_pages_as_site_page_canvas_layout_horizontal_sections_columns_update_webparts';
    protected const DESCRIPTION = 'Update the navigation property webparts in sites

Official Microsoft Graph v1.0 endpoint: PATCH /sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/horizontalSections/{horizontalSection-id}/columns/{horizontalSectionColumn-id}/webparts/{webPart-id}.';
    protected const PARAMETERS = ['site_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `site-id`.'], 'base_site_page_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `baseSitePage-id`.'], 'horizontal_section_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `horizontalSection-id`.'], 'horizontal_section_column_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `horizontalSectionColumn-id`.'], 'web_part_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `webPart-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph ConsistencyLevel header, commonly `eventual` for advanced directory/search queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/sites/{site-id}/pages/{baseSitePage-id}/graph.sitePage/canvasLayout/horizontalSections/{horizontalSection-id}/columns/{horizontalSectionColumn-id}/webparts/{webPart-id}';
    protected const PATH_PARAMS = ['site-id' => 'site_id', 'baseSitePage-id' => 'base_site_page_id', 'horizontalSection-id' => 'horizontal_section_id', 'horizontalSectionColumn-id' => 'horizontal_section_column_id', 'webPart-id' => 'web_part_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
    protected const BODY_MODE = 'json';
}
