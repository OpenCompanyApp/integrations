<?php

namespace OpenCompany\Integrations\BambooHR;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListEmployees;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRCreateEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRUpdateEmployee;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListDepartments;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRListTimeOffRequests;
use OpenCompany\Integrations\BambooHR\Tools\BambooHRGetCurrentUser;

/**
 * Tool provider for the BambooHR HR integration.
 *
 * Registers 7 tools for managing employees, departments, and time-off
 * requests. Supports multi-account credential resolution via createTool().
 */
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
            'logo' => 'simple-icons:bamboo',
        ];
    }

    // ── ConfigurableIntegration ───────────────────────────

    public function integrationMeta(): array
    {
        return [
            'name' => 'BambooHR',
            'description' => 'HR management — employees, departments, and time-off tracking',
            'icon' => 'ph:users-three',
            'logo' => 'simple-icons:bamboo',
            'category' => 'hr',
            'badge' => 'new',
            'docs_url' => 'https://documentation.bamboohr.com/reference',
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
                'hint' => 'Generate an API key in BambooHR under <strong>Settings → API Keys</strong>. The key authenticates via HTTP Basic Auth.',
                'required' => true,
            ],
            [
                'key' => 'subdomain',
                'type' => 'text',
                'label' => 'Subdomain',
                'placeholder' => 'yourcompany',
                'hint' => 'Your BambooHR subdomain from the login URL: <code>https://yourcompany.bamboohr.com</code>.',
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
            $baseUrl = "https://api.bamboohr.com/api/gateway.php/{$subdomain}/v1";

            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->withBasicAuth($apiKey, 'x')->timeout(10)->get($baseUrl . '/users/me');

            if ($response->successful()) {
                $user = $response->json();
                $name = trim(($user['firstName'] ?? '') . ' ' . ($user['lastName'] ?? ''));

                return [
                    'success' => true,
                    'message' => "Connected to BambooHR as {$name}.",
                ];
            }

            $error = $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'BambooHR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
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
            'subdomain' => 'nullable|string',
        ];
    }

    // ── Tools ─────────────────────────────────────────────

    public function tools(): array
    {
        return [
            'bamboohr_list_employees' => [
                'class' => BambooHRListEmployees::class,
                'type' => 'read',
                'name' => 'List Employees',
                'description' => 'List employees in BambooHR with optional field selection and pagination.',
                'icon' => 'ph:users',
            ],
            'bamboohr_get_employee' => [
                'class' => BambooHRGetEmployee::class,
                'type' => 'read',
                'name' => 'Get Employee',
                'description' => 'Get details for a single employee by ID.',
                'icon' => 'ph:user',
            ],
            'bamboohr_create_employee' => [
                'class' => BambooHRCreateEmployee::class,
                'type' => 'write',
                'name' => 'Create Employee',
                'description' => 'Create a new employee in BambooHR.',
                'icon' => 'ph:user-plus',
            ],
            'bamboohr_update_employee' => [
                'class' => BambooHRUpdateEmployee::class,
                'type' => 'write',
                'name' => 'Update Employee',
                'description' => 'Update an existing employee\'s information.',
                'icon' => 'ph:pencil-simple',
            ],
            'bamboohr_list_departments' => [
                'class' => BambooHRListDepartments::class,
                'type' => 'read',
                'name' => 'List Departments',
                'description' => 'List all departments in the company.',
                'icon' => 'ph:buildings',
            ],
            'bamboohr_list_time_off_requests' => [
                'class' => BambooHRListTimeOffRequests::class,
                'type' => 'read',
                'name' => 'List Time Off Requests',
                'description' => 'List time-off requests with optional filters for status, date range, or employee.',
                'icon' => 'ph:calendar-dots',
            ],
            'bamboohr_get_current_user' => [
                'class' => BambooHRGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user\'s profile.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    // ── Shared ────────────────────────────────────────────

    public function isIntegration(): bool
    {
        return true;
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

    /**
     * Create a tool instance with optional multi-account credential resolution.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate.
     * @param  array<string, mixed>  $context  Runtime context (may contain 'account' key).
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the BambooHRService, with optional account-specific credentials.
     *
     * When $context['account'] is set, creates a fresh service instance with
     * that account's credentials. Otherwise falls back to the container singleton.
     *
     * @param  array<string, mixed>  $context  Runtime context with optional 'account' key.
     */
    private function resolveService(array $context = []): BambooHRService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new BambooHRService(
                apiKey: $creds->get('bamboohr', 'api_key', '', $account),
                subdomain: $creds->get('bamboohr', 'subdomain', '', $account),
            );
        }

        return app(BambooHRService::class);
    }
}
