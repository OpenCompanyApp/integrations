<?php

namespace OpenCompany\Integrations\BuilderIo;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoListModels;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoGetModel;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoListContent;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoGetContent;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoCreateContent;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoListSymbols;
use OpenCompany\Integrations\BuilderIo\Tools\BuilderIoGetCurrentUser;

/**
 * Registers all available Builder.io tools and provides integration metadata, configuration schema, and connection testing.
 */
class BuilderIoToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'builder-io';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'visual cms, content',
            'description' => 'Visual CMS',
            'icon' => 'ph:layout',
            'logo' => 'simple-icons:builder',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Builder.io',
            'description' => 'Models, content entries, symbols, and user management',
            'icon' => 'ph:layout',
            'logo' => 'simple-icons:builder',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://www.builder.io/c/docs/getting-started',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'e.g. abc123...',
                'hint' => 'Find your API key at <a href="https://builder.io/account/space" target="_blank">Builder.io → Account → Space</a>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://cdn.builder.io/api/v2/user');

            if ($response->successful()) {
                $data = $response->json();
                $name = $data['name'] ?? $data['email'] ?? 'Unknown user';

                return [
                    'success' => true,
                    'message' => "Connected to Builder.io as \"{$name}\".",
                ];
            }

            $body = $response->json() ?? [];
            $error = $body['message'] ?? $response->body();

            return [
                'success' => false,
                'error' => 'Builder.io API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
        ];
    }

    public function tools(): array
    {
        return [
            // Models
            'builder_io_list_models' => [
                'class' => BuilderIoListModels::class,
                'type' => 'read',
                'name' => 'List Models',
                'description' => 'List all models in the Builder.io space.',
                'icon' => 'ph:list',
            ],
            'builder_io_get_model' => [
                'class' => BuilderIoGetModel::class,
                'type' => 'read',
                'name' => 'Get Model',
                'description' => 'Get a single model by ID or name.',
                'icon' => 'ph:file-text',
            ],
            // Content
            'builder_io_list_content' => [
                'class' => BuilderIoListContent::class,
                'type' => 'read',
                'name' => 'List Content',
                'description' => 'List content entries for a model.',
                'icon' => 'ph:list',
            ],
            'builder_io_get_content' => [
                'class' => BuilderIoGetContent::class,
                'type' => 'read',
                'name' => 'Get Content',
                'description' => 'Get a single content entry by ID.',
                'icon' => 'ph:file-text',
            ],
            'builder_io_create_content' => [
                'class' => BuilderIoCreateContent::class,
                'type' => 'write',
                'name' => 'Create Content',
                'description' => 'Create a new content entry for a model.',
                'icon' => 'ph:plus-circle',
            ],
            // Symbols
            'builder_io_list_symbols' => [
                'class' => BuilderIoListSymbols::class,
                'type' => 'read',
                'name' => 'List Symbols',
                'description' => 'List all symbols in the Builder.io space.',
                'icon' => 'ph:shapes',
            ],
            // User
            'builder_io_get_current_user' => [
                'class' => BuilderIoGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Builder.io user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/builder-io.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
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
     * Resolve the BuilderIoService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): BuilderIoService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new BuilderIoService(
                apiKey: $creds->get('builder-io', 'api_key', '', $account),
            );
        }

        return app(BuilderIoService::class);
    }
}
