<?php

namespace OpenCompany\Integrations\Box;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for official Box Platform API operations.
 */
class BoxToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    public function appName(): string
    {
        return 'box';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Box',
            'description' => 'Cloud content management',
            'icon' => 'ph:folder',
            'logo' => 'simple-icons:box',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Box',
            'description' => 'Official Box Platform API tools for files, folders, users, groups, collaborations, metadata, tasks, retention, legal holds, sign requests, webhooks, and events.',
            'icon' => 'ph:folder',
            'logo' => 'simple-icons:box',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://developer.box.com/reference/',
            'source_url' => 'https://raw.githubusercontent.com/box/box-openapi/main/openapi.json',
        ];
    }

    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'oauth2_manual_token',
                'legacy_auth_type' => 'oauth',
                'credential_mode' => 'stored_token',
                'setup_flows' => ['manual_token'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['access_token'],
                'notes' => ['Token acquisition may happen outside this package; the host stores the resulting Box access token.'],
            ],
            'host_availability' => [
                'web' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
                ],
                'cli' => [
                    'setup_supported' => true,
                    'runtime_supported' => true,
                    'setup_mode' => 'manual_token',
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

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Box access token',
                'hint' => 'Use a Box OAuth2 access token or developer token.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.box.com/2.0',
                'default' => 'https://api.box.com/2.0',
            ],
            [
                'key' => 'upload_url',
                'type' => 'url',
                'label' => 'Upload API Base URL',
                'placeholder' => 'https://upload.box.com/api/2.0',
                'default' => 'https://upload.box.com/api/2.0',
            ],
        ];
    }

    /**
     * Verify credentials with the official current user endpoint.
     *
     * @param  array<string, mixed>  $config  Connection form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.box.com/2.0'), '/');

        if ($accessToken === '') {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$accessToken,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/users/me');

            if (! $response->successful()) {
                $error = $response->json('message') ?? $response->json('error_description') ?? $response->json('error') ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Box API error: '.(is_string($error) ? $error : json_encode($error)),
                ];
            }

            $userName = ($response->json('name') ?? 'Unknown').' ('.($response->json('login') ?? '').')';

            return [
                'success' => true,
                'message' => "Connected to Box as {$userName}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
            'upload_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        $tools = [];

        foreach (BoxService::operations() as $operation) {
            $tools[(string) $operation['slug']] = [
                'class' => __NAMESPACE__.'\\Tools\\'.$operation['class'],
                'type' => $operation['type'],
                'name' => $operation['name'],
                'description' => $operation['description'],
                'icon' => $operation['type'] === 'read' ? 'ph:eye' : 'ph:folder',
            ];
        }

        return $tools;
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/box.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.box.com/2.0'],
            ['key' => 'upload_url', 'type' => 'url', 'label' => 'Upload API Base URL', 'required' => false, 'default' => 'https://upload.box.com/api/2.0'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Box service for a default or account-scoped context.
     *
     * @param  array<string, mixed>  $context  Optional host context including account.
     */
    private function resolveService(array $context = []): BoxService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new BoxService(
                accessToken: $creds->get('box', 'access_token', '', $account),
                baseUrl: $creds->get('box', 'url', 'https://api.box.com/2.0', $account),
                uploadUrl: $creds->get('box', 'upload_url', 'https://upload.box.com/api/2.0', $account),
            );
        }

        return app(BoxService::class);
    }
}
