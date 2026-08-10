<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Agora;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Agora\Tools\AgoraAcquireRecordingResource;
use OpenCompany\Integrations\Agora\Tools\AgoraGetNotificationIps;
use OpenCompany\Integrations\Agora\Tools\AgoraQueryRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraStartRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraStopRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraUpdateRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraUpdateRecordingLayout;

/**
 * Tool catalog and configuration metadata for Agora Cloud Recording.
 *
 * Exposes the documented resource acquisition, recording lifecycle, layout,
 * and notification allowlist APIs for agent workflows.
 */
class AgoraToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe authentication and runtime capabilities for catalog consumers.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'basic_auth',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['customer_id', 'customer_secret', 'app_id'],
                'notes' => ['Agora Cloud Recording uses Basic auth with RESTful API customer ID and customer secret.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_secret',
                    'runtime_mode' => 'normal',
                ],
            ],
            'runtime_requirements' => [],
            'compatibility' => [
                'web_setup_supported' => true,
                'web_runtime_supported' => true,
                'cli_setup_supported' => true,
                'cli_runtime_supported' => true,
            ],
        ];
    }

    /**
     * Get the application identifier.
     */
    public function appName(): string
    {
        return 'agora';
    }

    /**
     * Get compact application metadata for discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'Agora',
            'description' => 'Cloud recording for Agora voice, video, and streaming sessions',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:agora',
        ];
    }

    /**
     * Get full integration metadata for catalog output.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Agora',
            'description' => 'Manage Agora Cloud Recording sessions: acquire resources, start, query, update, update layouts, stop, and fetch notification IPs.',
            'icon' => 'ph:video-camera',
            'logo' => 'simple-icons:agora',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.agora.io/en/cloud-recording/reference/restful-api',
        ];
    }

    /**
     * Get settings schema for the Agora integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'customer_id',
                'type' => 'text',
                'label' => 'Customer ID',
                'placeholder' => 'Agora RESTful API customer ID',
                'hint' => 'Generate this in Agora Console under Developer Toolkit > RESTful API.',
                'required' => true,
            ],
            [
                'key' => 'customer_secret',
                'type' => 'secret',
                'label' => 'Customer Secret',
                'placeholder' => 'Agora RESTful API customer secret',
                'hint' => 'Download the customer secret when it is generated. Agora only shows it once.',
                'required' => true,
            ],
            [
                'key' => 'app_id',
                'type' => 'text',
                'label' => 'App ID',
                'placeholder' => 'Agora project App ID',
                'hint' => 'Use an App ID with Cloud Recording enabled.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'REST API Base URL',
                'placeholder' => 'https://api.sd-rtn.com',
                'hint' => 'Defaults to Agora Cloud Recording REST base URL.',
                'default' => 'https://api.sd-rtn.com',
            ],
        ];
    }

    /**
     * Validate local configuration without starting a recording.
     *
     * @param  array<string, mixed>  $config  Configuration values from the host app.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $customerId = (string) ($config['customer_id'] ?? '');
        $customerSecret = (string) ($config['customer_secret'] ?? $config['api_key'] ?? '');
        $appId = (string) ($config['app_id'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.sd-rtn.com'), '/');

        if ($customerId === '' || $customerSecret === '' || $appId === '') {
            return ['success' => false, 'error' => 'Agora customer ID, customer secret, and app ID are required.'];
        }

        if (! filter_var($baseUrl, FILTER_VALIDATE_URL)) {
            return ['success' => false, 'error' => 'Agora REST API base URL must be a valid URL.'];
        }

        return [
            'success' => true,
            'message' => 'Agora Cloud Recording configuration is present. The recording lifecycle endpoints are mutating, so the first acquire/start/query call verifies credentials against Agora.',
        ];
    }

    /**
     * Get validation rules for integration settings.
     *
     * @return array<string, mixed>
     */
    public function validationRules(): array
    {
        return [
            'customer_id' => 'nullable|string',
            'customer_secret' => 'nullable|string',
            'api_key' => 'nullable|string',
            'app_id' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Get all tools provided by this integration.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'agora_acquire_recording_resource' => [
                'class' => AgoraAcquireRecordingResource::class,
                'type' => 'write',
                'name' => 'Acquire Recording Resource',
                'description' => 'Request a resource ID before starting an Agora Cloud Recording session.',
                'icon' => 'ph:key',
            ],
            'agora_start_recording' => [
                'class' => AgoraStartRecording::class,
                'type' => 'write',
                'name' => 'Start Recording',
                'description' => 'Start Agora Cloud Recording using a resource ID from acquire.',
                'icon' => 'ph:record-fill',
            ],
            'agora_query_recording' => [
                'class' => AgoraQueryRecording::class,
                'type' => 'read',
                'name' => 'Query Recording',
                'description' => 'Query the status of an active Agora Cloud Recording session.',
                'icon' => 'ph:magnifying-glass',
            ],
            'agora_update_recording' => [
                'class' => AgoraUpdateRecording::class,
                'type' => 'write',
                'name' => 'Update Recording',
                'description' => 'Update an active Agora recording subscription list or web recorder state.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'agora_update_recording_layout' => [
                'class' => AgoraUpdateRecordingLayout::class,
                'type' => 'write',
                'name' => 'Update Recording Layout',
                'description' => 'Update the video mixing layout for an active composite recording.',
                'icon' => 'ph:grid-four',
            ],
            'agora_stop_recording' => [
                'class' => AgoraStopRecording::class,
                'type' => 'write',
                'name' => 'Stop Recording',
                'description' => 'Stop an active Agora Cloud Recording session.',
                'icon' => 'ph:stop-circle',
            ],
            'agora_get_notification_ips' => [
                'class' => AgoraGetNotificationIps::class,
                'type' => 'read',
                'name' => 'Get Notification IPs',
                'description' => 'Fetch Agora message notification service IPs for firewall allowlists.',
                'icon' => 'ph:network',
            ],
        ];
    }

    /**
     * Get the path to the JavaScript supplementary documentation.
     */
    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/agora.md';
    }

    /**
     * Get credential field definitions for catalog parsers.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'customer_id', 'type' => 'text', 'label' => 'Customer ID', 'required' => true],
            ['key' => 'customer_secret', 'type' => 'secret', 'label' => 'Customer Secret', 'required' => true],
            ['key' => 'app_id', 'type' => 'text', 'label' => 'App ID', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'REST API Base URL', 'required' => false, 'default' => 'https://api.sd-rtn.com'],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance for the default or account-scoped credentials.
     *
     * @param  class-string<Tool>  $class  Tool class to instantiate.
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve an Agora service for default or named account credentials.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    private function resolveService(array $context = []): AgoraService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new AgoraService(
                customerId: $creds->get('agora', 'customer_id', '', $account),
                customerSecret: $creds->get('agora', 'customer_secret', $creds->get('agora', 'api_key', '', $account), $account),
                appId: $creds->get('agora', 'app_id', '', $account),
                baseUrl: $creds->get('agora', 'url', 'https://api.sd-rtn.com', $account),
            );
        }

        return app(AgoraService::class);
    }
}
