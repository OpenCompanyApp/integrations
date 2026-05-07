<?php

namespace OpenCompany\Integrations\EasyPost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for EasyPost.
 *
 * Exposes shipping, tracking, address, customs, batch, pickup, scan-form,
 * refund, insurance, carrier-account, webhook, event, report, and raw tools.
 */
class EasyPostToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const RAW_TOOLS = [
        'easypost_api_get' => ['EasyPostApiGet', 'read', 'API GET', 'Call a safe relative EasyPost API GET path.', 'ph:code'],
        'easypost_api_post' => ['EasyPostApiPost', 'write', 'API POST', 'Call a safe relative EasyPost API POST path.', 'ph:code'],
        'easypost_api_put' => ['EasyPostApiPut', 'write', 'API PUT', 'Call a safe relative EasyPost API PUT path.', 'ph:code'],
        'easypost_api_patch' => ['EasyPostApiPatch', 'write', 'API PATCH', 'Call a safe relative EasyPost API PATCH path.', 'ph:code'],
        'easypost_api_delete' => ['EasyPostApiDelete', 'write', 'API DELETE', 'Call a safe relative EasyPost API DELETE path.', 'ph:code'],
    ];

    /**
     * Describe authentication and host capabilities.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'api_key_basic',
                'legacy_auth_type' => 'api_key',
                'credential_mode' => 'required_secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['EasyPost uses HTTP Basic auth with the API key as username and a blank password.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'easypost'; }

    public function appMeta(): array
    {
        return ['label' => 'EasyPost', 'description' => 'Shipping labels, address verification, tracking, pickups, insurance, and carrier accounts', 'icon' => 'ph:package', 'logo' => 'ph:package'];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'EasyPost',
            'description' => 'Manage EasyPost addresses, parcels, customs, shipments, trackers, orders, batches, pickups, scan forms, refunds, insurance, carrier accounts, webhooks, reports, and API keys.',
            'icon' => 'ph:package',
            'logo' => 'ph:package',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.easypost.com/docs',
        ];
    }

    public function configSchema(): array { return $this->credentialFields(); }

    /**
     * Verify EasyPost credentials with a lightweight API-key list call.
     *
     * @param  array<string, mixed>  $config  Credential settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = (string) ($config['api_key'] ?? '');
            if ($apiKey === '') {
                return ['success' => false, 'error' => 'EasyPost API key is required.'];
            }

            $baseUrl = rtrim((string) ($config['url'] ?? ''), '/') ?: 'https://api.easypost.com/v2';
            $response = Http::withBasicAuth($apiKey, '')->acceptJson()->timeout(20)->get($baseUrl.'/api_keys');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'EasyPost API returned HTTP '.$response->status().'.'];
            }

            return ['success' => true, 'message' => 'Connected to EasyPost API.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'required|string', 'url' => 'nullable|string'];
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'EZAK...', 'hint' => 'EasyPost production or test API key.', 'required' => true],
            ['key' => 'url', 'type' => 'text', 'label' => 'API URL', 'placeholder' => 'https://api.easypost.com/v2', 'hint' => 'Optional EasyPost API base URL override.', 'required' => false],
        ];
    }

    public function tools(): array
    {
        $tools = [];
        foreach (EasyPostService::operations() as $operation => $definition) {
            [, , , $type, $name, $description] = $definition;
            $class = $this->classNameForOperation($operation);
            $tools['easypost_'.$operation] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $type === 'read' ? 'ph:list' : 'ph:pencil-simple',
            ];
        }

        foreach (self::RAW_TOOLS as $slug => [$class, $type, $name, $description, $icon]) {
            $tools[$slug] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$class,
                'type' => $type,
                'name' => $name,
                'description' => $description,
                'icon' => $icon,
            ];
        }

        return $tools;
    }

    public function isIntegration(): bool { return true; }

    /**
     * Create an EasyPost tool instance.
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
    private function resolveService(array $context = []): EasyPostService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new EasyPostService(
                apiKey: $creds->get('easypost', 'api_key', '', $account),
                baseUrl: $creds->get('easypost', 'url', 'https://api.easypost.com/v2', $account),
            );
        }

        return app(EasyPostService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/easypost.md';
    }

    private function classNameForOperation(string $operation): string
    {
        return 'EasyPost'.str_replace(' ', '', ucwords(str_replace('_', ' ', $operation)));
    }
}
