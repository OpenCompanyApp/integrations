<?php

namespace OpenCompany\Integrations\AfterShip;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipBatchPredictEstimatedDeliveryDate;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipCreateCourierConnections;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipCreateTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipDeleteCourierConnection;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipDeleteTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipDetectCourier;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipGetCourierConnection;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipGetTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipListCourierConnections;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipListCouriers;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipListTrackings;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipMarkTrackingCompleted;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipPredictEstimatedDeliveryDate;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipRetrackTracking;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipUpdateCourierConnection;
use OpenCompany\Integrations\AfterShip\Tools\AfterShipUpdateTracking;

/**
 * Tool catalog and configuration metadata for AfterShip.
 *
 * Exposes Tracking API operations for trackings, couriers, courier
 * connections, and estimated delivery date predictions.
 */
class AfterShipToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'strategy' => 'api_key',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['AfterShip Tracking API requires an API key sent in the as-api-key header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'aftership';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'AfterShip',
            'description' => 'Shipment tracking and delivery prediction',
            'icon' => 'ph:package',
            'logo' => 'ph:package',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'AfterShip',
            'description' => 'AfterShip Tracking API for shipment trackings, couriers, courier connections, retracking, completion, and estimated delivery date predictions.',
            'icon' => 'ph:package',
            'logo' => 'ph:package',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.aftership.com/docs/tracking/',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'AfterShip API key', 'hint' => 'Required for all AfterShip Tracking API endpoints.', 'required' => true],
        ];
    }

    /**
     * Verify AfterShip credentials with a lightweight couriers request.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'AfterShip API key is required.'];
            }

            $response = Http::acceptJson()
                ->asJson()
                ->withHeaders(['as-api-key' => $apiKey])
                ->timeout(20)
                ->get('https://api.aftership.com/tracking/2026-01/couriers');

            return $response->successful()
                ? ['success' => true, 'message' => 'AfterShip API key accepted.']
                : ['success' => false, 'error' => 'AfterShip returned HTTP '.$response->status().'.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'AfterShip API key', 'hint' => 'Required for all AfterShip Tracking API endpoints.', 'required' => true],
        ];
    }

    public function tools(): array
    {
        return [
            'aftership_list_trackings' => ['class' => AfterShipListTrackings::class, 'type' => 'read', 'name' => 'List Trackings', 'description' => 'List shipment trackings with filters and pagination.', 'icon' => 'ph:list-bullets'],
            'aftership_create_tracking' => ['class' => AfterShipCreateTracking::class, 'type' => 'write', 'name' => 'Create Tracking', 'description' => 'Create a shipment tracking.', 'icon' => 'ph:plus-circle'],
            'aftership_get_tracking' => ['class' => AfterShipGetTracking::class, 'type' => 'read', 'name' => 'Get Tracking', 'description' => 'Get a tracking by ID.', 'icon' => 'ph:package'],
            'aftership_update_tracking' => ['class' => AfterShipUpdateTracking::class, 'type' => 'write', 'name' => 'Update Tracking', 'description' => 'Update a tracking by ID.', 'icon' => 'ph:pencil-simple'],
            'aftership_delete_tracking' => ['class' => AfterShipDeleteTracking::class, 'type' => 'write', 'name' => 'Delete Tracking', 'description' => 'Delete a tracking by ID.', 'icon' => 'ph:trash'],
            'aftership_retrack_tracking' => ['class' => AfterShipRetrackTracking::class, 'type' => 'write', 'name' => 'Retrack Tracking', 'description' => 'Retrack an expired tracking by ID.', 'icon' => 'ph:arrow-clockwise'],
            'aftership_mark_tracking_completed' => ['class' => AfterShipMarkTrackingCompleted::class, 'type' => 'write', 'name' => 'Mark Tracking Completed', 'description' => 'Mark a tracking as completed by ID.', 'icon' => 'ph:check-circle'],
            'aftership_list_couriers' => ['class' => AfterShipListCouriers::class, 'type' => 'read', 'name' => 'List Couriers', 'description' => 'List supported couriers.', 'icon' => 'ph:truck'],
            'aftership_detect_courier' => ['class' => AfterShipDetectCourier::class, 'type' => 'read', 'name' => 'Detect Courier', 'description' => 'Detect courier candidates for a tracking number.', 'icon' => 'ph:radar'],
            'aftership_list_courier_connections' => ['class' => AfterShipListCourierConnections::class, 'type' => 'read', 'name' => 'List Courier Connections', 'description' => 'List courier connections.', 'icon' => 'ph:plugs-connected'],
            'aftership_create_courier_connections' => ['class' => AfterShipCreateCourierConnections::class, 'type' => 'write', 'name' => 'Create Courier Connections', 'description' => 'Create courier connections.', 'icon' => 'ph:plug'],
            'aftership_get_courier_connection' => ['class' => AfterShipGetCourierConnection::class, 'type' => 'read', 'name' => 'Get Courier Connection', 'description' => 'Get a courier connection by ID.', 'icon' => 'ph:plug-charging'],
            'aftership_update_courier_connection' => ['class' => AfterShipUpdateCourierConnection::class, 'type' => 'write', 'name' => 'Update Courier Connection', 'description' => 'Update a courier connection by ID.', 'icon' => 'ph:pencil-simple'],
            'aftership_delete_courier_connection' => ['class' => AfterShipDeleteCourierConnection::class, 'type' => 'write', 'name' => 'Delete Courier Connection', 'description' => 'Delete a courier connection by ID.', 'icon' => 'ph:trash'],
            'aftership_predict_estimated_delivery_date' => ['class' => AfterShipPredictEstimatedDeliveryDate::class, 'type' => 'read', 'name' => 'Predict EDD', 'description' => 'Predict estimated delivery date for one shipment.', 'icon' => 'ph:calendar-check'],
            'aftership_batch_predict_estimated_delivery_date' => ['class' => AfterShipBatchPredictEstimatedDeliveryDate::class, 'type' => 'read', 'name' => 'Batch Predict EDD', 'description' => 'Predict estimated delivery dates for multiple shipments.', 'icon' => 'ph:calendar-dots'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an AfterShip tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): AfterShipService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AfterShipService(apiKey: $creds->get('aftership', 'api_key', '', $account));
        }

        return app(AfterShipService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/aftership.md';
    }
}
