<?php

namespace OpenCompany\Integrations\ServiceNow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowCreateIncident;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowCreateTask;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowGetCurrentUser;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowGetIncident;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowGetTask;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowGetUser;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowListIncidents;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowListTasks;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowListUsers;
use OpenCompany\Integrations\ServiceNow\Tools\ServiceNowUpdateIncident;

/**
 * Tool provider and configurable integration for ServiceNow.
 *
 * Implements {@see ToolProvider} to expose 10 ServiceNow tools and
 * {@see ConfigurableIntegration} for multi-account support with
 * username, password, and instance configuration fields.
 */
class ServiceNowToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * The application identifier used for credential resolution and routing.
     */
    public function appName(): string
    {
        return 'servicenow';
    }

    /**
     * Short metadata for the integration registry.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'incidents, tasks, users',
            'description' => 'IT service management',
            'icon' => 'ph:cloud-lightning',
            'logo' => 'simple-icons:servicenow',
        ];
    }

    /**
     * Detailed metadata shown in the integration catalog.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'ServiceNow',
            'description' => 'IT service management platform — manage incidents, tasks, and users.',
            'icon' => 'ph:cloud-lightning',
            'logo' => 'simple-icons:servicenow',
            'category' => 'itsm',
            'badge' => 'verified',
            'docs_url' => 'https://developer.servicenow.com/dev.do#!/reference/api/now/rest',
        ];
    }

    /**
     * Schema for the per-account configuration form.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key'         => 'username',
                'type'        => 'string',
                'label'       => 'Username',
                'placeholder' => 'Enter your ServiceNow username',
                'hint'        => 'The ServiceNow account username (e.g. <code>admin</code>)',
                'required'    => true,
            ],
            [
                'key'         => 'password',
                'type'        => 'secret',
                'label'       => 'Password',
                'placeholder' => 'Enter your ServiceNow password',
                'hint'        => 'The password for the ServiceNow user account',
                'required'    => true,
            ],
            [
                'key'         => 'instance',
                'type'        => 'string',
                'label'       => 'Instance Name',
                'placeholder' => 'e.g. dev12345',
                'hint'        => 'Your ServiceNow instance name (the subdomain before <code>.service-now.com</code>)',
                'required'    => true,
            ],
        ];
    }

    /**
     * Verify connectivity by fetching the current user profile.
     */
    public function testConnection(array $config): array
    {
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';
        $instance = $config['instance'] ?? '';

        if (empty($username) || empty($password) || empty($instance)) {
            return ['success' => false, 'error' => 'Username, password, and instance are all required.'];
        }

        try {
            $baseUrl = rtrim("https://{$instance}.service-now.com/api/now", '/');

            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept'       => 'application/json',
            ])->withBasicAuth($username, $password)
              ->timeout(10)
              ->get($baseUrl . '/user_profile');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => "Connected to ServiceNow instance {$instance}.",
                ];
            }

            return [
                'success' => false,
                'error'   => "Authentication failed (HTTP {$response->status()}). Check your credentials and instance name.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for the configuration fields.
     */
    public function validationRules(): array
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
            'instance' => 'required|string',
        ];
    }

    /**
     * Return the list of ServiceNow tools.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'servicenow_list_incidents' => [
                'class'       => ServiceNowListIncidents::class,
                'type'        => 'read',
                'name'        => 'List Incidents',
                'description' => 'List incidents from the ServiceNow incident table.',
                'icon'        => 'ph:list-bullets',
            ],
            'servicenow_get_incident' => [
                'class'       => ServiceNowGetIncident::class,
                'type'        => 'read',
                'name'        => 'Get Incident',
                'description' => 'Retrieve a single ServiceNow incident by sys_id.',
                'icon'        => 'ph:eye',
            ],
            'servicenow_create_incident' => [
                'class'       => ServiceNowCreateIncident::class,
                'type'        => 'write',
                'name'        => 'Create Incident',
                'description' => 'Create a new ServiceNow incident.',
                'icon'        => 'ph:plus-circle',
            ],
            'servicenow_update_incident' => [
                'class'       => ServiceNowUpdateIncident::class,
                'type'        => 'write',
                'name'        => 'Update Incident',
                'description' => 'Update an existing ServiceNow incident.',
                'icon'        => 'ph:pencil-simple',
            ],
            'servicenow_list_tasks' => [
                'class'       => ServiceNowListTasks::class,
                'type'        => 'read',
                'name'        => 'List Tasks',
                'description' => 'List tasks from the ServiceNow task table.',
                'icon'        => 'ph:list-checks',
            ],
            'servicenow_get_task' => [
                'class'       => ServiceNowGetTask::class,
                'type'        => 'read',
                'name'        => 'Get Task',
                'description' => 'Retrieve a single ServiceNow task by sys_id.',
                'icon'        => 'ph:eye',
            ],
            'servicenow_create_task' => [
                'class'       => ServiceNowCreateTask::class,
                'type'        => 'write',
                'name'        => 'Create Task',
                'description' => 'Create a new ServiceNow task.',
                'icon'        => 'ph:plus-circle',
            ],
            'servicenow_list_users' => [
                'class'       => ServiceNowListUsers::class,
                'type'        => 'read',
                'name'        => 'List Users',
                'description' => 'List users from the ServiceNow sys_user table.',
                'icon'        => 'ph:users',
            ],
            'servicenow_get_user' => [
                'class'       => ServiceNowGetUser::class,
                'type'        => 'read',
                'name'        => 'Get User',
                'description' => 'Retrieve a single ServiceNow user by sys_id.',
                'icon'        => 'ph:user',
            ],
            'servicenow_get_current_user' => [
                'class'       => ServiceNowGetCurrentUser::class,
                'type'        => 'read',
                'name'        => 'Get Current User',
                'description' => 'Get the profile of the currently authenticated ServiceNow user.',
                'icon'        => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/servicenow.md';
    }

    /**
     * Credential fields exposed for per-account configuration.
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'username', 'type' => 'string', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => true],
            ['key' => 'instance', 'type' => 'string', 'label' => 'Instance Name', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool with either account-specific or default credentials.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ServiceNowService(
                username: $creds->get('servicenow', 'username', '', $account),
                password: $creds->get('servicenow', 'password', '', $account),
                instance: $creds->get('servicenow', 'instance', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ServiceNowService::class));
    }
}
