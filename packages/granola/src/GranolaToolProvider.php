<?php

namespace OpenCompany\Integrations\Granola;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Granola\Tools\GranolaGetNote;
use OpenCompany\Integrations\Granola\Tools\GranolaListFolders;
use OpenCompany\Integrations\Granola\Tools\GranolaListNotes;

/**
 * Catalog provider for the Granola integration.
 *
 * Exposes the current read-only Enterprise API for notes and folders.
 */
class GranolaToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'credential_mode' => 'secret',
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['The Granola Enterprise API is read-only for notes and folders.'],
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

    public function appName(): string
    {
        return 'granola';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Granola',
            'description' => 'Meeting notes and transcripts',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:granola',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Granola',
            'description' => 'Read Granola meeting notes, transcripts, summaries, and folders through the Enterprise API.',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:granola',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.granola.ai/api-reference/list-notes',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Granola Enterprise API key',
                'hint' => 'Generate an API key from Granola Enterprise API settings.',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://public-api.granola.ai/v1',
                'hint' => 'Override only if Granola provides a custom API URL.',
                'default' => 'https://public-api.granola.ai/v1',
            ],
        ];
    }

    /**
     * Validate credentials with a lightweight list-notes request.
     *
     * @param  array<string, mixed>  $config  Setup form values.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://public-api.granola.ai/v1', '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/notes', ['page_size' => 1]);

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Granola API returned HTTP {$response->status()}. Check the key and URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Granola API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

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
            'granola_list_notes' => [
                'class' => GranolaListNotes::class,
                'type' => 'read',
                'name' => 'List Notes',
                'description' => 'List accessible meeting notes with pagination and date filters.',
                'icon' => 'ph:list',
            ],
            'granola_get_note' => [
                'class' => GranolaGetNote::class,
                'type' => 'read',
                'name' => 'Get Note',
                'description' => 'Get one meeting note with transcript, summary, attendees, and calendar event details.',
                'icon' => 'ph:notebook',
            ],
            'granola_list_folders' => [
                'class' => GranolaListFolders::class,
                'type' => 'read',
                'name' => 'List Folders',
                'description' => 'List accessible folders and folder hierarchy metadata.',
                'icon' => 'ph:folder',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__.'/../script-docs/granola.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://public-api.granola.ai/v1'],
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
     * Resolve a Granola service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GranolaService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new GranolaService(
                apiKey: $creds->get('granola', 'api_key', '', $account),
                baseUrl: $creds->get('granola', 'url', 'https://public-api.granola.ai/v1', $account),
            );
        }

        return app(GranolaService::class);
    }
}
