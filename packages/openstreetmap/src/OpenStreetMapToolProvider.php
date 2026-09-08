<?php

namespace OpenCompany\Integrations\OpenStreetMap;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapMapUrl;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimDetails;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimLookup;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimReverse;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimSearch;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapNominatimStatus;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapObjectUrl;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapOverpassQuery;
use OpenCompany\Integrations\OpenStreetMap\Tools\OpenStreetMapOverpassStatus;

/**
 * Tool catalog and metadata for OpenStreetMap.
 *
 * Exposes public Nominatim geocoding, Overpass data query, status, and stable
 * OpenStreetMap URL helper tools without requiring credentials.
 */
class OpenStreetMapToolProvider implements ToolProvider, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'none', 'legacy_auth_type' => 'none', 'credential_mode' => 'none', 'setup_flows' => ['none'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['OpenStreetMap public read APIs used here require no credentials.']],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'openstreetmap';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'OpenStreetMap',
            'description' => 'Public geocoding and OSM data queries',
            'icon' => 'ph:map-trifold',
            'logo' => 'ph:map-trifold',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'OpenStreetMap',
            'description' => 'OpenStreetMap public APIs for Nominatim geocoding and lookup, Overpass QL queries, service status checks, and stable object/map URLs.',
            'icon' => 'ph:map-trifold',
            'logo' => 'ph:map-trifold',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://nominatim.org/release-docs/latest/api/Overview/',
        ];
    }

    public function configSchema(): array
    {
        return [];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'openstreetmap_nominatim_search' => ['class' => OpenStreetMapNominatimSearch::class, 'type' => 'read', 'name' => 'Nominatim Search', 'description' => 'Search for places by free-form or structured address query.', 'icon' => 'ph:magnifying-glass'],
            'openstreetmap_nominatim_reverse' => ['class' => OpenStreetMapNominatimReverse::class, 'type' => 'read', 'name' => 'Nominatim Reverse', 'description' => 'Reverse geocode latitude and longitude.', 'icon' => 'ph:map-pin'],
            'openstreetmap_nominatim_lookup' => ['class' => OpenStreetMapNominatimLookup::class, 'type' => 'read', 'name' => 'Nominatim Lookup', 'description' => 'Look up address details by OSM object IDs.', 'icon' => 'ph:identification-card'],
            'openstreetmap_nominatim_details' => ['class' => OpenStreetMapNominatimDetails::class, 'type' => 'read', 'name' => 'Nominatim Details', 'description' => 'Get detailed Nominatim place information.', 'icon' => 'ph:info'],
            'openstreetmap_nominatim_status' => ['class' => OpenStreetMapNominatimStatus::class, 'type' => 'read', 'name' => 'Nominatim Status', 'description' => 'Check Nominatim service status.', 'icon' => 'ph:heartbeat'],
            'openstreetmap_overpass_query' => ['class' => OpenStreetMapOverpassQuery::class, 'type' => 'read', 'name' => 'Overpass Query', 'description' => 'Execute an Overpass QL query.', 'icon' => 'ph:code'],
            'openstreetmap_overpass_status' => ['class' => OpenStreetMapOverpassStatus::class, 'type' => 'read', 'name' => 'Overpass Status', 'description' => 'Check Overpass API status.', 'icon' => 'ph:activity'],
            'openstreetmap_object_url' => ['class' => OpenStreetMapObjectUrl::class, 'type' => 'read', 'name' => 'Object URL', 'description' => 'Build a stable OpenStreetMap node, way, or relation URL.', 'icon' => 'ph:link'],
            'openstreetmap_map_url' => ['class' => OpenStreetMapMapUrl::class, 'type' => 'read', 'name' => 'Map URL', 'description' => 'Build a stable OpenStreetMap map URL for coordinates.', 'icon' => 'ph:map-pin-line'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an OpenStreetMap tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(OpenStreetMapService::class));
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/openstreetmap.md';
    }
}
