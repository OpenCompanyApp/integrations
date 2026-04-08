<?php

namespace OpenCompany\Integrations\Harvest;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Harvest\Tools\HarvestListTimeEntries;
use OpenCompany\Integrations\Harvest\Tools\HarvestCreateTimeEntry;
use OpenCompany\Integrations\Harvest\Tools\HarvestGetTimeEntry;
use OpenCompany\Integrations\Harvest\Tools\HarvestUpdateTimeEntry;
use OpenCompany\Integrations\Harvest\Tools\HarvestDeleteTimeEntry;
use OpenCompany\Integrations\Harvest\Tools\HarvestListProjects;
use OpenCompany\Integrations\Harvest\Tools\HarvestGetProject;
use OpenCompany\Integrations\Harvest\Tools\HarvestListClients;
use OpenCompany\Integrations\Harvest\Tools\HarvestListTasks;
use OpenCompany\Integrations\Harvest\Tools\HarvestListUsers;
use OpenCompany\Integrations\Harvest\Tools\HarvestGetUser;
use OpenCompany\Integrations\Harvest\Tools\HarvestGetCurrentUser;

/**
 * Registers all Harvest tools and provides integration metadata.
 *
 * Exposes 12 tools covering time entries, projects, clients,
 * tasks, and users via the ToolProvider contract.
 */
class HarvestToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'harvest';
    }

    public function appMeta(): array
    {
        return [
            'label'       => 'time entries, projects, clients, users',
            'description' => 'Time Tracking',
            'icon'        => 'ph:clock-countdown',
            'logo'        => 'simple-icons:harvest',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name'        => 'Harvest',
            'description' => 'Time entries, projects, clients, tasks, and users',
            'icon'        => 'ph:clock-countdown',
            'logo'        => 'simple-icons:harvest',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://help.getharvest.com/api-v2/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key'         => 'access_token',
                'type'        => 'secret',
                'label'       => 'Access Token',
                'placeholder' => 'ptu-...',
                'hint'        => 'Harvest personal access token or OAuth2 bearer token.',
                'required'    => true,
            ],
            [
                'key'         => 'account_id',
                'type'        => 'text',
                'label'       => 'Account ID',
                'placeholder' => '1234567',
                'hint'        => 'Your Harvest account ID (found in Settings > Integrities).',
                'required'    => true,
            ],
        ];
    }

    /**
     * Test the Harvest connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token' and 'account_id'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $accountId   = $config['account_id'] ?? '';

        if (empty($accessToken) || empty($accountId)) {
            return ['success' => false, 'error' => 'Access token and account ID are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization'      => 'Bearer ' . $accessToken,
                'Harvest-Account-Id' => $accountId,
                'Content-Type'       => 'application/json',
            ])->timeout(10)->get('https://api.harvestapp.com/v2/users/me');

            if ($response->successful()) {
                $body   = $response->json() ?? [];
                $name   = trim(($body['first_name'] ?? '') . ' ' . ($body['last_name'] ?? ''));
                $email  = $body['email'] ?? 'unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Harvest as {$name} ({$email}).",
                ];
            }

            return [
                'success' => false,
                'error'   => 'Harvest API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'account_id'   => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Time Entries
            'harvest_list_time_entries' => [
                'class'       => HarvestListTimeEntries::class,
                'type'        => 'read',
                'name'        => 'List Time Entries',
                'description' => 'List time entries with optional filters.',
                'icon'        => 'ph:list-bullets',
            ],
            'harvest_create_time_entry' => [
                'class'       => HarvestCreateTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Create Time Entry',
                'description' => 'Create a new time entry.',
                'icon'        => 'ph:plus-circle',
            ],
            'harvest_get_time_entry' => [
                'class'       => HarvestGetTimeEntry::class,
                'type'        => 'read',
                'name'        => 'Get Time Entry',
                'description' => 'Get a single time entry by ID.',
                'icon'        => 'ph:clock',
            ],
            'harvest_update_time_entry' => [
                'class'       => HarvestUpdateTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Update Time Entry',
                'description' => 'Update an existing time entry.',
                'icon'        => 'ph:pencil-simple',
            ],
            'harvest_delete_time_entry' => [
                'class'       => HarvestDeleteTimeEntry::class,
                'type'        => 'write',
                'name'        => 'Delete Time Entry',
                'description' => 'Delete a time entry.',
                'icon'        => 'ph:trash',
            ],
            // Projects
            'harvest_list_projects' => [
                'class'       => HarvestListProjects::class,
                'type'        => 'read',
                'name'        => 'List Projects',
                'description' => 'List projects with optional filters.',
                'icon'        => 'ph:folder',
            ],
            'harvest_get_project' => [
                'class'       => HarvestGetProject::class,
                'type'        => 'read',
                'name'        => 'Get Project',
                'description' => 'Get a single project by ID.',
                'icon'        => 'ph:folder-open',
            ],
            // Clients
            'harvest_list_clients' => [
                'class'       => HarvestListClients::class,
                'type'        => 'read',
                'name'        => 'List Clients',
                'description' => 'List clients with optional filters.',
                'icon'        => 'ph:buildings',
            ],
            // Tasks
            'harvest_list_tasks' => [
                'class'       => HarvestListTasks::class,
                'type'        => 'read',
                'name'        => 'List Tasks',
                'description' => 'List tasks with optional filters.',
                'icon'        => 'ph:check-square',
            ],
            // Users
            'harvest_list_users' => [
                'class'       => HarvestListUsers::class,
                'type'        => 'read',
                'name'        => 'List Users',
                'description' => 'List users with optional filters.',
                'icon'        => 'ph:users',
            ],
            'harvest_get_user' => [
                'class'       => HarvestGetUser::class,
                'type'        => 'read',
                'name'        => 'Get User',
                'description' => 'Get a single user by ID.',
                'icon'        => 'ph:user',
            ],
            'harvest_get_current_user' => [
                'class'       => HarvestGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/harvest.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'account_id',   'type' => 'text',   'label' => 'Account ID',   'required' => true],
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
     * Resolve the HarvestService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): HarvestService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new HarvestService(
                accessToken: $creds->get('harvest', 'access_token', '', $account),
                accountId:   $creds->get('harvest', 'account_id', '', $account),
            );
        }

        return app(HarvestService::class);
    }
}
