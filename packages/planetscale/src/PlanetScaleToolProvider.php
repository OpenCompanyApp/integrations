<?php

namespace OpenCompany\Integrations\PlanetScale;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleListDatabases;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleGetDatabase;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleCreateDatabase;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleListBranches;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleGetBranch;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleListOrganizations;
use OpenCompany\Integrations\PlanetScale\Tools\PlanetScaleGetCurrentUser;

class PlanetScaleToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'planetscale';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'databases, branches, organizations',
            'description' => 'Serverless MySQL database platform',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:planetscale',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'PlanetScale',
            'description' => 'Serverless MySQL database platform with branching workflow',
            'icon' => 'ph:database',
            'logo' => 'simple-icons:planetscale',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://api-docs.planetscale.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your PlanetScale access token',
                'hint' => 'Generate a service token in PlanetScale under Settings → Service tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.planetscale.com/api/v1',
                'hint' => 'Defaults to <code>https://api.planetscale.com/api/v1</code>. Change only if using a custom endpoint.',
                'default' => 'https://api.planetscale.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.planetscale.com/api/v1', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach PlanetScale API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['error'] ?? $json['message'] ?? 'Unknown error';
                return [
                    'success' => false,
                    'error' => "PlanetScale API returned an error: {$error}",
                ];
            }

            $name = trim(($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? ''));
            $email = $json['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to PlanetScale as {$name} ({$email}).",
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
            'planetscale_list_databases' => [
                'class' => PlanetScaleListDatabases::class,
                'type' => 'read',
                'name' => 'List Databases',
                'description' => 'List databases in a PlanetScale organization.',
                'icon' => 'ph:database',
            ],
            'planetscale_get_database' => [
                'class' => PlanetScaleGetDatabase::class,
                'type' => 'read',
                'name' => 'Get Database',
                'description' => 'Get details of a specific PlanetScale database.',
                'icon' => 'ph:database',
            ],
            'planetscale_create_database' => [
                'class' => PlanetScaleCreateDatabase::class,
                'type' => 'write',
                'name' => 'Create Database',
                'description' => 'Create a new database in a PlanetScale organization.',
                'icon' => 'ph:plus-circle',
            ],
            'planetscale_list_branches' => [
                'class' => PlanetScaleListBranches::class,
                'type' => 'read',
                'name' => 'List Branches',
                'description' => 'List branches of a PlanetScale database.',
                'icon' => 'ph:git-branch',
            ],
            'planetscale_get_branch' => [
                'class' => PlanetScaleGetBranch::class,
                'type' => 'read',
                'name' => 'Get Branch',
                'description' => 'Get details of a specific database branch.',
                'icon' => 'ph:git-branch',
            ],
            'planetscale_list_organizations' => [
                'class' => PlanetScaleListOrganizations::class,
                'type' => 'read',
                'name' => 'List Organizations',
                'description' => 'List organizations the authenticated user belongs to.',
                'icon' => 'ph:buildings',
            ],
            'planetscale_get_current_user' => [
                'class' => PlanetScaleGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/planetscale.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.planetscale.com/api/v1'],
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

            $service = new PlanetScaleService(
                accessToken: $creds->get('planetscale', 'access_token', '', $account),
                baseUrl: $creds->get('planetscale', 'url', 'https://api.planetscale.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(PlanetScaleService::class));
    }
}
