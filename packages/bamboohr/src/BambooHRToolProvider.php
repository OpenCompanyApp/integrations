<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListEmployees;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRCreateEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRUpdateEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListDepartments;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListTimeOffRequests;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetTimeOffRequest;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListReports;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetCurrentUser;

class BambooHRToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'bamboohr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'employees, departments, time-off',
            'description' => 'HR management',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:bamboohr',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'BambooHR',
            'description' => 'Human resources management — employees, departments, and time-off',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:bamboohr',
            'category' => 'hr',
            'badge' => 'verified',
            'docs_url' => 'https://documentation.bamboohr.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your BambooHR API key',
                'hint' => 'Generate an API key in BambooHR under Settings > API Keys',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'string',
                'label' => 'Subdomain',
                'placeholder' => 'your-company',
                'hint' => 'Your BambooHR subdomain (the part before .bamboohr.com)',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $subdomain = $config['subdomain'] ?? '';

        if (empty($apiKey) || empty($subdomain)) {
            return ['success' => false, 'error' => 'API key and subdomain are required.'];
        }

        try {
            $baseUrl = 'https://api.bamboohr.com/api/gateway.php/' . $subdomain . '/v1';

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->withBasicAuth($apiKey, 'x')->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null && !$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Could not reach BambooHR API. Check your API key and subdomain.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to BambooHR ({$subdomain}).",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required|string',
            'subdomain' => 'required|string',
        ];
    }

    public function tools(): array
    {
        return [
            'bamboohr_list_employees' => [
                'class' => BambooHRListEmployees::class,
                'type' => 'read',
                'name' => 'List Employees',
                'description' => 'List employees from the company directory.',
                'icon' => 'ph:users',
            ],
            'bamboohr_get_employee' => [
                'class' => BambooHRGetEmployee::class,
                'type' => 'read',
                'name' => 'Get Employee',
                'description' => 'Get detailed information for a specific employee.',
                'icon' => 'ph:user',
            ],
            'bamboohr_create_employee' => [
                'class' => BambooHRCreateEmployee::class,
                'type' => 'write',
                'name' => 'Create Employee',
                'description' => 'Create a new employee record.',
                'icon' => 'ph:user-plus',
            ],
            'bamboohr_update_employee' => [
                'class' => BambooHRUpdateEmployee::class,
                'type' => 'write',
                'name' => 'Update Employee',
                'description' => 'Update an existing employee record.',
                'icon' => 'ph:pencil',
            ],
            'bamboohr_list_departments' => [
                'class' => BambooHRListDepartments::class,
                'type' => 'read',
                'name' => 'List Departments',
                'description' => 'List all company departments.',
                'icon' => 'ph:buildings',
            ],
            'bamboohr_list_time_off_requests' => [
                'class' => BambooHRListTimeOffRequests::class,
                'type' => 'read',
                'name' => 'List Time-Off Requests',
                'description' => 'List time-off requests with optional filters.',
                'icon' => 'ph:calendar-dots',
            ],
            'bamboohr_get_time_off_request' => [
                'class' => BambooHRGetTimeOffRequest::class,
                'type' => 'read',
                'name' => 'Get Time-Off Request',
                'description' => 'Get details for a specific time-off request.',
                'icon' => 'ph:calendar-check',
            ],
            'bamboohr_list_reports' => [
                'class' => BambooHRListReports::class,
                'type' => 'read',
                'name' => 'List Reports',
                'description' => 'Generate a custom report with specified employee fields.',
                'icon' => 'ph:file-text',
            ],
            'bamboohr_get_current_user' => [
                'class' => BambooHRGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/bamboohr.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'subdomain', 'type' => 'string', 'label' => 'Subdomain', 'required' => true],
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

            $service = new BambooHRService(
                apiKey: $creds->get('bamboohr', 'api_key', '', $account),
                subdomain: $creds->get('bamboohr', 'subdomain', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(BambooHRService::class));
    }
}
