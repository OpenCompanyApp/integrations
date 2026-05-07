<?php

namespace OpenCompany\Integrations\MicrosoftPlaces\Tools;

/**
 * Update fixtureMap.
 *
 * Maps to Microsoft Graph v1.0 endpoint PATCH /places/{place-id}/graph.building/map/levels/{levelMap-id}/fixtures/{fixtureMap-id}.
 */
class MicrosoftPlacesPlacesAsBuildingMapLevelsUpdateFixtures extends AbstractMicrosoftPlacesTool
{
    protected const NAME = 'microsoft_places_places_as_building_map_levels_update_fixtures';
    protected const DESCRIPTION = 'Update fixtureMap\\n\\nOfficial Microsoft Graph v1.0 endpoint: PATCH /places/{place-id}/graph.building/map/levels/{levelMap-id}/fixtures/{fixtureMap-id}.';
    protected const PARAMETERS = ['place_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `place-id`.'], 'level_map_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `levelMap-id`.'], 'fixture_map_id' => ['type' => 'string', 'required' => true, 'description' => 'Path parameter `fixtureMap-id`.'], 'top' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$top`.'], 'skip' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$skip`.'], 'search' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$search`.'], 'filter' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$filter`.'], 'orderby' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$orderby`.'], 'select' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$select`.'], 'expand' => ['type' => 'string', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$expand`.'], 'count' => ['type' => 'boolean', 'required' => false, 'description' => 'Microsoft Graph OData query parameter `$count`.'], 'if_match' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `If-Match` header for conditional updates or deletes.'], 'prefer' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `Prefer` header.'], 'consistency_level' => ['type' => 'string', 'required' => false, 'description' => 'Optional Microsoft Graph `ConsistencyLevel` header, usually `eventual` for advanced queries.'], 'body' => ['type' => 'object', 'required' => true, 'description' => 'Request body matching the official Microsoft Graph OpenAPI schema for this operation.']];
    protected const METHOD = 'PATCH';
    protected const PATH = '/places/{place-id}/graph.building/map/levels/{levelMap-id}/fixtures/{fixtureMap-id}';
    protected const PATH_PARAMS = ['place-id' => 'place_id', 'levelMap-id' => 'level_map_id', 'fixtureMap-id' => 'fixture_map_id'];
    protected const QUERY_PARAMS = ['$top' => 'top', '$skip' => 'skip', '$search' => 'search', '$filter' => 'filter', '$orderby' => 'orderby', '$select' => 'select', '$expand' => 'expand', '$count' => 'count'];
    protected const BODY_REQUIRED = true;
}
