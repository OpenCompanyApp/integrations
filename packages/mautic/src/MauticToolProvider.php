<?php

namespace OpenCompany\Integrations\Mautic;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Mautic\Tools\MauticListContacts;
use OpenCompany\Integrations\Mautic\Tools\MauticGetContact;
use OpenCompany\Integrations\Mautic\Tools\MauticCreateContact;
use OpenCompany\Integrations\Mautic\Tools\MauticUpdateContact;
use OpenCompany\Integrations\Mautic\Tools\MauticDeleteContact;
use OpenCompany\Integrations\Mautic\Tools\MauticListEmails;
use OpenCompany\Integrations\Mautic\Tools\MauticListSegments;
use OpenCompany\Integrations\Mautic\Tools\MauticListForms;
use OpenCompany\Integrations\Mautic\Tools\MauticGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class MauticToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'basic',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'username_password',
            'setup_flows' =>
            [
              0 => 'manual_secret',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
            ],
            'notes' =>
            [
            ],
          ],
          'host_availability' => [
            'web' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_secret',
              'runtime_mode' => 'normal',
            ],
          ],
          'runtime_requirements' => [
          ],
          'compatibility' => [
            'web_setup_supported' => true,
            'web_runtime_supported' => true,
            'cli_setup_supported' => true,
            'cli_runtime_supported' => true,
          ],
        ];
    }




/**
     * The application identifier used in the tool provider registry.
     */
    public function appName(): string
    {
        return 'mautic';
    }

/**
     * Short metadata for the application (label, description, icons).
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, emails, segments, forms',
            'description' => 'Marketing automation & CRM',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mautic',
        ];
    }

/**
     * Extended integration metadata for the UI (name, category, badge, docs URL).
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Mautic',
            'description' => 'Open-source marketing automation platform — manage contacts, emails, segments, and forms.',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:mautic',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.mautic.org/#rest-api',
        ];
    }/**
     * Configuration schema for the Mautic integration.
     *
     * Defines the fields shown in the integration settings UI:
     * - hostname: the Mautic instance URL
     * - username: HTTP Basic Auth username
     * - password: HTTP Basic Auth password (stored as secret)
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'hostname',
                'type' => 'url',
                'label' => 'Mautic URL',
                'placeholder' => 'https://mautic.example.com',
                'hint' => 'The base URL of your Mautic instance (e.g., <code>https://mautic.example.com</code>)',
                'required' => true,
            ],
            [
                'key' => 'username',
                'type' => 'text',
                'label' => 'Username',
                'placeholder' => 'Enter your Mautic username',
                'hint' => 'The username for HTTP Basic Authentication',
                'required' => true,
            ],
            [
                'key' => 'password',
                'type' => 'secret',
                'label' => 'Password',
                'placeholder' => 'Enter your Mautic password',
                'hint' => 'The password for HTTP Basic Authentication. Consider using an API-specific password.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to the Mautic instance using the provided config.
     *
     * Calls the /api/users/me endpoint to verify that the credentials are valid.
     *
     * @param  array<string, mixed>  $config  Configuration values (hostname, username, password).
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $hostname = rtrim($config['hostname'] ?? '', '/');
        $username = $config['username'] ?? '';
        $password = $config['password'] ?? '';

        if (empty($hostname) || empty($username) || empty($password)) {
            return ['success' => false, 'error' => 'Hostname, username, and password are required.'];
        }

        try {
            $response = Http::withBasicAuth($username, $password)
                ->withHeaders(['Content-Type' => 'application/json'])
                ->timeout(10)
                ->get($hostname . '/api/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Mautic API at {$hostname}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                return [
                    'success' => false,
                    'error' => "Authentication failed (HTTP {$response->status()}). Check username and password.",
                ];
            }

            $name = $json['username'] ?? $json['id'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Mautic as user \"{$name}\" at {$hostname}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Laravel validation rules for the configuration fields.
     *
     * @return array<string, string|array<int, string>>
     */
    public function validationRules(): array
    {
        return [
            'hostname' => 'required|url',
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }

    /**
     * Return all Mautic tools with their metadata.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'mautic_list_contacts' => [
                'class' => MauticListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts in Mautic with optional search and filters.',
                'icon' => 'ph:users',
            ],
            'mautic_get_contact' => [
                'class' => MauticGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single Mautic contact by ID.',
                'icon' => 'ph:user',
            ],
            'mautic_create_contact' => [
                'class' => MauticCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact in Mautic.',
                'icon' => 'ph:user-plus',
            ],
            'mautic_update_contact' => [
                'class' => MauticUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing Mautic contact.',
                'icon' => 'ph:pencil-simple',
            ],
            'mautic_delete_contact' => [
                'class' => MauticDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact from Mautic.',
                'icon' => 'ph:trash',
            ],
            'mautic_list_emails' => [
                'class' => MauticListEmails::class,
                'type' => 'read',
                'name' => 'List Emails',
                'description' => 'List marketing emails from Mautic.',
                'icon' => 'ph:envelope',
            ],
            'mautic_list_segments' => [
                'class' => MauticListSegments::class,
                'type' => 'read',
                'name' => 'List Segments',
                'description' => 'List contact segments (lists) from Mautic.',
                'icon' => 'ph:list-bullets',
            ],
            'mautic_list_forms' => [
                'class' => MauticListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List forms from Mautic.',
                'icon' => 'ph:notebook',
            ],
            'mautic_get_current_user' => [
                'class' => MauticGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Mautic user.',
                'icon' => 'ph:identification-card',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation for Mautic tools.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/mautic.md';
    }

    /**
     * Credential fields used by the CredentialResolver.
     *
     * @return array<int, array{key: string, type: string, label: string, required: bool, default?: string}>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'hostname', 'type' => 'url', 'label' => 'Mautic URL', 'required' => true],
            ['key' => 'username', 'type' => 'text', 'label' => 'Username', 'required' => true],
            ['key' => 'password', 'type' => 'secret', 'label' => 'Password', 'required' => true],
        ];
    }

    /**
     * Confirm this class represents an integration (not a single tool).
     */
    public function isIntegration(): bool
    {        return true;
    }

    /**
     * Create a tool instance, optionally with account-specific credentials.
     *
     * When a multi-account context is provided, resolves credentials for that
     * specific account; otherwise falls back to the app-wide MauticService.
     *
     * @param  class-string<Tool>  $class    The tool class to instantiate.
     * @param  array<string, mixed>  $context  Context containing optional 'account' key.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new MauticService(
                username: $creds->get('mautic', 'username', '', $account),
                password: $creds->get('mautic', 'password', '', $account),
                baseUrl: $creds->get('mautic', 'hostname', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(MauticService::class));
    }
}
