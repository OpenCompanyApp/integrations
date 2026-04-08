<?php

namespace OpenCompany\Integrations\Kimai;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Kimai\Tools\KimaiListTimesheets;
use OpenCompany\Integrations\Kimai\Tools\KimaiGetTimesheet;
use OpenCompany\Integrations\Kimai\Tools\KimaiCreateTimesheet;
use OpenCompany\Integrations\Kimai\Tools\KimaiListProjects;
use OpenCompany\Integrations\Kimai\Tools\KimaiGetProject;
use OpenCompany\Integrations\Kimai\Tools\KimaiListCustomers;
use OpenCompany\Integrations\Kimai\Tools\KimaiGetCurrentUser;

class KimaiToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'kimai';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'timesheets, projects, customers',
            'description' => 'Time tracking',
            'icon' => 'ph:clock-countdown',
            'logo' => 'simple-icons:kimai',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Kimai',
            'description' => 'Open-source time-tracking and invoicing',
            'icon' => 'ph:clock-countdown',
            'logo' => 'simple-icons:kimai',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://www.kimai.org/documentation/rest-api.html',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Kimai API token',
                'hint' => 'Generate an API token in your Kimai user profile under "API" or "API Password"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Kimai URL',
                'placeholder' => 'https://kimai.example.com',
                'hint' => 'The base URL of your Kimai instance (e.g., <code>https://kimai.example.com</code>)',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? '', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        if (empty($baseUrl)) {
            return ['success' => false, 'error' => 'No Kimai URL provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/api/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Kimai API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $error = $json['message'] ?? $json['error'] ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Kimai API error: {$error}",
                ];
            }

            $userName = $json['displayName'] ?? $json['username'] ?? 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Kimai as {$userName}.",
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
            'kimai_list_timesheets' => [
                'class' => KimaiListTimesheets::class,
                'type' => 'read',
                'name' => 'List Timesheets',
                'description' => 'List time-tracking entries with optional filters.',
                'icon' => 'ph:list-bullets',
            ],
            'kimai_get_timesheet' => [
                'class' => KimaiGetTimesheet::class,
                'type' => 'read',
                'name' => 'Get Timesheet',
                'description' => 'Get details of a specific timesheet entry.',
                'icon' => 'ph:clock',
            ],
            'kimai_create_timesheet' => [
                'class' => KimaiCreateTimesheet::class,
                'type' => 'write',
                'name' => 'Create Timesheet',
                'description' => 'Create a new time-tracking entry.',
                'icon' => 'ph:plus-circle',
            ],
            'kimai_list_projects' => [
                'class' => KimaiListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects with optional filters.',
                'icon' => 'ph:folder',
            ],
            'kimai_get_project' => [
                'class' => KimaiGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get details of a specific project.',
                'icon' => 'ph:folder-open',
            ],
            'kimai_list_customers' => [
                'class' => KimaiListCustomers::class,
                'type' => 'read',
                'name' => 'List Customers',
                'description' => 'List customers with optional filters.',
                'icon' => 'ph:users',
            ],
            'kimai_get_current_user' => [
                'class' => KimaiGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/kimai.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Kimai URL', 'required' => true],
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

            $service = new KimaiService(
                accessToken: $creds->get('kimai', 'access_token', '', $account),
                baseUrl: $creds->get('kimai', 'url', 'https://demo.kimai.org', $account),
            );

            return new $class($service);
        }

        return new $class(app(KimaiService::class));
    }
}
