<?php

namespace OpenCompany\Integrations\Samsara;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Samsara.
 *
 * Exposes Samsara fleet, telematics, routing, address, tag, documents,
 * maintenance, users, sensors, and raw relative REST API tools.
 */
class SamsaraToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'bearer_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Samsara API tokens are permissioned by endpoint category and license. A 403 usually means the token is valid but lacks the required scope or license.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'samsara';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Samsara',
            'description' => 'Fleet telematics, routes, assets, sensors, documents, and maintenance data',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:samsara',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Samsara',
            'description' => 'Samsara REST API coverage for fleet vehicles, drivers, trailers, equipment, routes, addresses, tags, documents, defects, sensors, and users.',
            'icon' => 'ph:truck',
            'logo' => 'simple-icons:samsara',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developers.samsara.com/reference/overview',
        ];
    }

    /**
     * Get the configuration schema for the settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Enter your Samsara API access token', 'hint' => 'Generate an API token in Samsara under Settings > API Tokens.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'placeholder' => 'https://api.samsara.com', 'hint' => 'Defaults to https://api.samsara.com. Use a compatible proxy only when needed.', 'default' => 'https://api.samsara.com'],
        ];
    }

    /**
     * Test the connection to the Samsara API using the provided config.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.samsara.com'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $data = $response->json();
                $email = is_array($data) ? ($data['email'] ?? $data['data']['email'] ?? 'unknown') : 'unknown';

                return ['success' => true, 'message' => "Connected to Samsara API as {$email}."];
            }

            return ['success' => false, 'error' => "Samsara API returned HTTP {$response->status()}. Check your access token and token permissions."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return ['access_token' => 'nullable|string', 'url' => 'nullable|url'];
    }

    /**
     * Get the tool definitions for this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'samsara_list_vehicles' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraListVehicles', 'type' => 'read', 'name' => 'List Vehicles', 'description' => 'List fleet vehicles with pagination.', 'icon' => 'ph:truck'],
            'samsara_get_vehicle' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraGetVehicle', 'type' => 'read', 'name' => 'Get Vehicle', 'description' => 'Get details for a specific vehicle.', 'icon' => 'ph:truck'],
            'samsara_list_drivers' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraListDrivers', 'type' => 'read', 'name' => 'List Drivers', 'description' => 'List fleet drivers with pagination.', 'icon' => 'ph:identification-card'],
            'samsara_get_driver' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraGetDriver', 'type' => 'read', 'name' => 'Get Driver', 'description' => 'Get details for a specific driver.', 'icon' => 'ph:identification-card'],
            'samsara_list_sensors' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraListSensors', 'type' => 'read', 'name' => 'List Sensors', 'description' => 'List IoT sensors with pagination.', 'icon' => 'ph:gauge'],
            'samsara_get_current_user' => ['class' => 'OpenCompany\Integrations\Samsara\Tools\SamsaraGetCurrentUser', 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the currently authenticated Samsara user.', 'icon' => 'ph:user-circle'],
            'samsara_api_get' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraApiGet', 'type' => 'read', 'name' => 'Api Get', 'description' => 'Call a safe relative Samsara API path with GET.', 'icon' => 'ph:magnifying-glass'],
            'samsara_api_post' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraApiPost', 'type' => 'write', 'name' => 'Api Post', 'description' => 'Call a safe relative Samsara API path with POST.', 'icon' => 'ph:pencil-simple'],
            'samsara_api_patch' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraApiPatch', 'type' => 'write', 'name' => 'Api Patch', 'description' => 'Call a safe relative Samsara API path with PATCH.', 'icon' => 'ph:pencil-simple'],
            'samsara_api_delete' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraApiDelete', 'type' => 'write', 'name' => 'Api Delete', 'description' => 'Call a safe relative Samsara API path with DELETE.', 'icon' => 'ph:trash'],
            'samsara_get_vehicle_stats' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetVehicleStats', 'type' => 'read', 'name' => 'Get Vehicle Stats', 'description' => 'Get latest vehicle stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_vehicle_stats_history' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetVehicleStatsHistory', 'type' => 'read', 'name' => 'Get Vehicle Stats History', 'description' => 'Get historical vehicle stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_vehicle_stats_feed' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetVehicleStatsFeed', 'type' => 'read', 'name' => 'Get Vehicle Stats Feed', 'description' => 'Follow a vehicle stats feed.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_trailers' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListTrailers', 'type' => 'read', 'name' => 'List Trailers', 'description' => 'List trailers.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_trailer' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetTrailer', 'type' => 'read', 'name' => 'Get Trailer', 'description' => 'Retrieve a trailer.', 'icon' => 'ph:magnifying-glass'],
            'samsara_create_trailer' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraCreateTrailer', 'type' => 'write', 'name' => 'Create Trailer', 'description' => 'Create a trailer.', 'icon' => 'ph:pencil-simple'],
            'samsara_update_trailer' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraUpdateTrailer', 'type' => 'write', 'name' => 'Update Trailer', 'description' => 'Update a trailer.', 'icon' => 'ph:pencil-simple'],
            'samsara_delete_trailer' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraDeleteTrailer', 'type' => 'write', 'name' => 'Delete Trailer', 'description' => 'Delete a trailer.', 'icon' => 'ph:trash'],
            'samsara_get_trailer_stats' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetTrailerStats', 'type' => 'read', 'name' => 'Get Trailer Stats', 'description' => 'Get latest trailer stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_trailer_stats_history' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetTrailerStatsHistory', 'type' => 'read', 'name' => 'Get Trailer Stats History', 'description' => 'Get historical trailer stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_trailer_stats_feed' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetTrailerStatsFeed', 'type' => 'read', 'name' => 'Get Trailer Stats Feed', 'description' => 'Follow a trailer stats feed.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_equipment' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListEquipment', 'type' => 'read', 'name' => 'List Equipment', 'description' => 'List equipment.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_equipment' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetEquipment', 'type' => 'read', 'name' => 'Get Equipment', 'description' => 'Retrieve equipment.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_equipment_stats' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetEquipmentStats', 'type' => 'read', 'name' => 'Get Equipment Stats', 'description' => 'Get latest equipment stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_equipment_stats_history' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetEquipmentStatsHistory', 'type' => 'read', 'name' => 'Get Equipment Stats History', 'description' => 'Get historical equipment stats.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_equipment_stats_feed' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetEquipmentStatsFeed', 'type' => 'read', 'name' => 'Get Equipment Stats Feed', 'description' => 'Follow an equipment stats feed.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_routes' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListRoutes', 'type' => 'read', 'name' => 'List Routes', 'description' => 'List routes.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_route' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetRoute', 'type' => 'read', 'name' => 'Get Route', 'description' => 'Retrieve a route.', 'icon' => 'ph:magnifying-glass'],
            'samsara_create_route' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraCreateRoute', 'type' => 'write', 'name' => 'Create Route', 'description' => 'Create a route.', 'icon' => 'ph:pencil-simple'],
            'samsara_update_route' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraUpdateRoute', 'type' => 'write', 'name' => 'Update Route', 'description' => 'Update a route.', 'icon' => 'ph:pencil-simple'],
            'samsara_delete_route' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraDeleteRoute', 'type' => 'write', 'name' => 'Delete Route', 'description' => 'Delete a route.', 'icon' => 'ph:trash'],
            'samsara_list_addresses' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListAddresses', 'type' => 'read', 'name' => 'List Addresses', 'description' => 'List addresses.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_address' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetAddress', 'type' => 'read', 'name' => 'Get Address', 'description' => 'Retrieve an address.', 'icon' => 'ph:magnifying-glass'],
            'samsara_create_address' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraCreateAddress', 'type' => 'write', 'name' => 'Create Address', 'description' => 'Create an address.', 'icon' => 'ph:pencil-simple'],
            'samsara_update_address' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraUpdateAddress', 'type' => 'write', 'name' => 'Update Address', 'description' => 'Update an address.', 'icon' => 'ph:pencil-simple'],
            'samsara_delete_address' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraDeleteAddress', 'type' => 'write', 'name' => 'Delete Address', 'description' => 'Delete an address.', 'icon' => 'ph:trash'],
            'samsara_list_tags' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListTags', 'type' => 'read', 'name' => 'List Tags', 'description' => 'List tags.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_tag' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetTag', 'type' => 'read', 'name' => 'Get Tag', 'description' => 'Retrieve a tag.', 'icon' => 'ph:magnifying-glass'],
            'samsara_create_tag' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraCreateTag', 'type' => 'write', 'name' => 'Create Tag', 'description' => 'Create a tag.', 'icon' => 'ph:pencil-simple'],
            'samsara_update_tag' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraUpdateTag', 'type' => 'write', 'name' => 'Update Tag', 'description' => 'Update a tag.', 'icon' => 'ph:pencil-simple'],
            'samsara_delete_tag' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraDeleteTag', 'type' => 'write', 'name' => 'Delete Tag', 'description' => 'Delete a tag.', 'icon' => 'ph:trash'],
            'samsara_list_users' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListUsers', 'type' => 'read', 'name' => 'List Users', 'description' => 'List users.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_user' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetUser', 'type' => 'read', 'name' => 'Get User', 'description' => 'Retrieve a user.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_defects' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListDefects', 'type' => 'read', 'name' => 'List Defects', 'description' => 'List DVIR defects.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_defects_history' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetDefectsHistory', 'type' => 'read', 'name' => 'Get Defects History', 'description' => 'Get historical DVIR defects.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_defect_types' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListDefectTypes', 'type' => 'read', 'name' => 'List Defect Types', 'description' => 'List defect types.', 'icon' => 'ph:magnifying-glass'],
            'samsara_list_documents' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListDocuments', 'type' => 'read', 'name' => 'List Documents', 'description' => 'List documents.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_document' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetDocument', 'type' => 'read', 'name' => 'Get Document', 'description' => 'Retrieve a document.', 'icon' => 'ph:magnifying-glass'],
            'samsara_create_document' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraCreateDocument', 'type' => 'write', 'name' => 'Create Document', 'description' => 'Create a document.', 'icon' => 'ph:pencil-simple'],
            'samsara_list_document_types' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraListDocumentTypes', 'type' => 'read', 'name' => 'List Document Types', 'description' => 'List document types.', 'icon' => 'ph:magnifying-glass'],
            'samsara_get_document_type' => ['class' => 'OpenCompany\\Integrations\\Samsara\\Tools\\SamsaraGetDocumentType', 'type' => 'read', 'name' => 'Get Document Type', 'description' => 'Retrieve a document type.', 'icon' => 'ph:magnifying-glass'],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/samsara.md';
    }

    /**
     * Get the credential fields required by this integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.samsara.com'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally using account-specific credentials.
     *
     * @param  class-string<Tool>  $class  Tool class name.
     * @param  array<string, mixed>  $context  Runtime context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Runtime context.
     */
    private function resolveService(array $context = []): SamsaraService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new SamsaraService(
                accessToken: $creds->get('samsara', 'access_token', '', $account),
                baseUrl: $creds->get('samsara', 'url', 'https://api.samsara.com', $account),
            );
        }

        return app(SamsaraService::class);
    }
}
