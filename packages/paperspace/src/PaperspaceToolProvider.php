<?php

namespace OpenCompany\Integrations\Paperspace;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceListMachines;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceGetMachine;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceListNotebooks;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceListDatasets;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceListProjects;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceListSshKeys;
use OpenCompany\Integrations\Paperspace\Tools\PaperspaceGetCurrentUser;

class PaperspaceToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'paperspace';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'machines, notebooks, datasets, projects',
            'description' => 'GPU cloud computing',
            'icon' => 'ph:gpu',
            'logo' => 'simple-icons:paperspace',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Paperspace',
            'description' => 'GPU cloud computing — machines, notebooks, datasets, and projects',
            'icon' => 'ph:gpu',
            'logo' => 'simple-icons:paperspace',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://docs.paperspace.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Paperspace API token',
                'hint' => 'Generate an API token in the Paperspace console under <strong>Settings → API</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.paperspace.com/v1',
                'hint' => 'Override only if using a custom Paperspace-compatible endpoint',
                'default' => 'https://api.paperspace.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.paperspace.com/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Paperspace API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Paperspace API error ({$response->status()}): {$message}",
                ];
            }

            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Paperspace as {$email}.",
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
        ];
    }

    public function tools(): array
    {
        return [
            'paperspace_list_machines' => [
                'class' => PaperspaceListMachines::class,
                'type' => 'read',
                'name' => 'List Machines',
                'description' => 'List all GPU machines in the account.',
                'icon' => 'ph:gpu',
            ],
            'paperspace_get_machine' => [
                'class' => PaperspaceGetMachine::class,
                'type' => 'read',
                'name' => 'Get Machine',
                'description' => 'Get details for a specific machine.',
                'icon' => 'ph:gpu',
            ],
            'paperspace_list_notebooks' => [
                'class' => PaperspaceListNotebooks::class,
                'type' => 'read',
                'name' => 'List Notebooks',
                'description' => 'List all Gradient notebooks.',
                'icon' => 'ph:notebook',
            ],
            'paperspace_list_datasets' => [
                'class' => PaperspaceListDatasets::class,
                'type' => 'read',
                'name' => 'List Datasets',
                'description' => 'List all datasets.',
                'icon' => 'ph:database',
            ],
            'paperspace_list_projects' => [
                'class' => PaperspaceListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List all Gradient projects.',
                'icon' => 'ph:folder',
            ],
            'paperspace_list_ssh_keys' => [
                'class' => PaperspaceListSshKeys::class,
                'type' => 'read',
                'name' => 'List SSH Keys',
                'description' => 'List all SSH keys in the account.',
                'icon' => 'ph:key',
            ],
            'paperspace_get_current_user' => [
                'class' => PaperspaceGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/paperspace.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.paperspace.com/v1'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new PaperspaceService(
                accessToken: $creds->get('paperspace', 'access_token', '', $account),
                baseUrl: $creds->get('paperspace', 'url', 'https://api.paperspace.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PaperspaceService::class));
    }
}
