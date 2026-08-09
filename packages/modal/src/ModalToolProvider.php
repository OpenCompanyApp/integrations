<?php

namespace OpenCompany\Integrations\Modal;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Modal\Tools\ModalListApps;
use OpenCompany\Integrations\Modal\Tools\ModalGetApp;
use OpenCompany\Integrations\Modal\Tools\ModalListFunctions;
use OpenCompany\Integrations\Modal\Tools\ModalListSchedules;
use OpenCompany\Integrations\Modal\Tools\ModalListVolumes;
use OpenCompany\Integrations\Modal\Tools\ModalListSecrets;
use OpenCompany\Integrations\Modal\Tools\ModalGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all available Modal tools and provides integration metadata, configuration schema, and connection testing.
 */
class ModalToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
            'credential_mode' => 'secret',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }

    public function appName(): string
    {
        return 'modal';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Modal',
            'description' => 'Serverless GPU',
            'icon' => 'ph:lightning',
            'logo' => 'simple-icons:modal',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Modal',
            'description' => 'Serverless GPU platform — run AI workloads, manage apps, functions, schedules, volumes, and secrets',
            'icon' => 'ph:lightning',
            'logo' => 'simple-icons:modal',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://modal.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Modal API key',
                'hint' => 'Generate a token in the Modal dashboard under <strong>Settings → API Tokens</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.modal.com/v1',
                'hint' => 'Override only if using a custom Modal-compatible endpoint',
                'default' => 'https://api.modal.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.modal.com/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided. Generate one in the Modal dashboard under Settings → API Tokens.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return ['success' => false, 'error' => "Could not reach Modal API at {$baseUrl}. Check the URL."];
            }

            if (! $response->successful()) {
                $message = $json['message'] ?? $json['error'] ?? $response->body();

                return ['success' => false, 'error' => "Modal API error ({$response->status()}): {$message}"];
            }

            $name = $json['name'] ?? $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Modal as \"{$name}\".",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'modal_list_apps' => [
                'class' => ModalListApps::class,
                'type' => 'read',
                'name' => 'List Apps',
                'description' => 'List all Modal apps.',
                'icon' => 'ph:folder',
            ],
            'modal_get_app' => [
                'class' => ModalGetApp::class,
                'type' => 'read',
                'name' => 'Get App',
                'description' => 'Get details for a specific Modal app.',
                'icon' => 'ph:folder-open',
            ],
            'modal_list_functions' => [
                'class' => ModalListFunctions::class,
                'type' => 'read',
                'name' => 'List Functions',
                'description' => 'List all functions for a Modal app.',
                'icon' => 'ph:code',
            ],
            'modal_list_schedules' => [
                'class' => ModalListSchedules::class,
                'type' => 'read',
                'name' => 'List Schedules',
                'description' => 'List all schedules for a Modal app.',
                'icon' => 'ph:clock',
            ],
            'modal_list_volumes' => [
                'class' => ModalListVolumes::class,
                'type' => 'read',
                'name' => 'List Volumes',
                'description' => 'List all Modal volumes.',
                'icon' => 'ph:hard-drives',
            ],
            'modal_list_secrets' => [
                'class' => ModalListSecrets::class,
                'type' => 'read',
                'name' => 'List Secrets',
                'description' => 'List all Modal secrets.',
                'icon' => 'ph:key',
            ],
            'modal_get_current_user' => [
                'class' => ModalGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated Modal user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/modal.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.modal.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the ModalService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): ModalService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new ModalService(
                apiKey: $creds->get('modal', 'api_key', '', $account),
                baseUrl: $creds->get('modal', 'url', 'https://api.modal.com/v1', $account),
            );
        }

        return app(ModalService::class);
    }
}
