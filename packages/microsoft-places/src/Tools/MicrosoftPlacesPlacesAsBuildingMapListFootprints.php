<?php

namespace OpenCompany\Integrations\MicrosoftPlaces\Tools;

/**
 * List footprints.
 *
 * Maps to Microsoft Graph v1.0 endpoint GET /places/{place-id}/graph.building/map/footprints.
 */
class MicrosoftPlacesPlacesAsBuildingMapListFootprints extends AbstractMicrosoftPlacesTool
{
    protected const NAME = 'microsoft_places_places_as_building_map_list_footprints';
    protected const DESCRIPTION = 'List footprints\\n\\nOfficial Microsoft Graph v1.0 endpoint: GET /places/{place-id}/graph.building/map/footprints.';
    protected const PARAMETERS = ['place_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `place-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.']];
    protected const METHOD = 'GET';
    protected const PATH = '/places/{place-id}/graph.building/map/footprints';
    protected const PATH_PARAMS = ['place-id' => 'place_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = false;
}
