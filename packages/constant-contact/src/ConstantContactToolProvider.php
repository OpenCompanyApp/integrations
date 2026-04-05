<?php

namespace OpenCompany\Integrations\ConstantContact;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListContacts;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactUpdateContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactDeleteContact;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListLists;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactCreateList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactAddContactToList;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCurrentUser;

/**
 * Constant Contact tool provider and configurable integration.
 *
 * Registers all Constant Contact tools, defines the configuration schema for
 * OAuth2 Bearer token authentication, provides connection testing, and supports
 * multi-account resolution via the CredentialResolver.
 */
class ConstantContactToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Return the application name used for namespace routing.
     */
    public function appName(): string
    {
        return 'constantcontact';
    }

    /**
     * Return short metadata for display in tool listings.
     */
    public function appMeta(): array
    {
        return [
            'label' => 'contacts, lists, account',
            'description' => 'Email marketing & contacts',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
        ];
    }

    /**
     * Return integration metadata for the marketplace / settings UI.
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Constant Contact',
            'description' => 'Email marketing platform — manage contacts, contact lists, and account details.',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:constantcontact',
            'category' => 'email_marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developer.constantcontact.com/api_reference/api_reference.html',
        ];
    }

    /**
     * Define the configuration fields required to set up the integration.
     *
     * @return array<int, array<string, mixed>> Configuration field definitions
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Constant Contact OAuth2 access token',
                'hint' => 'Generate an access token via the Constant Contact OAuth2 flow in your developer account.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to Constant Contact using the provided configuration.
     *
     * Makes a GET request to the /account/summary endpoint to verify credentials.
     *
     * @param  array<string, mixed>  $config  Configuration values (must include access_token)
     * @return array{success: bool, message?: string, error?: string} Connection test result
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.cc.email/v3/account/summary');

            if (!$response->successful()) {
                $error = $response->json('error') ?? $response->json('message') ?? "HTTP {$response->status()}";
                return [
                    'success' => false,
                    'error' => "Constant Contact API error: " . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => 'Could not reach Constant Contact API. Check your access token and try again.',
                ];
            }

            $name = ($json['first_name'] ?? '') . ' ' . ($json['last_name'] ?? '');
            $name = trim($name) ?: 'Unknown';

            return [
                'success' => true,
                'message' => "Connected to Constant Contact as {$name}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Return Laravel validation rules for the configuration fields.
     *
     * @return array<string, string> Validation rules
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'required|string',
        ];
    }

    /**
     * Return the list of tools provided by this integration.
     *
     * Each entry maps a tool key to its class, type, display name, description, and icon.
     *
     * @return array<string, array<string, mixed>> Tool definitions
     */
    public function tools(): array
    {
        return [
            'constantcontact_list_contacts' => [
                'class' => ConstantContactListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts with optional status filtering.',
                'icon' => 'ph:users',
            ],
            'constantcontact_get_contact' => [
                'class' => ConstantContactGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get details for a single contact.',
                'icon' => 'ph:user',
            ],
            'constantcontact_create_contact' => [
                'class' => ConstantContactCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact with email, first name, and last name.',
                'icon' => 'ph:user-plus',
            ],
            'constantcontact_update_contact' => [
                'class' => ConstantContactUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact\'s details.',
                'icon' => 'ph:pencil',
            ],
            'constantcontact_delete_contact' => [
                'class' => ConstantContactDeleteContact::class,
                'type' => 'write',
                'name' => 'Delete Contact',
                'description' => 'Delete a contact from Constant Contact.',
                'icon' => 'ph:trash',
            ],
            'constantcontact_list_lists' => [
                'class' => ConstantContactListLists::class,
                'type' => 'read',
                'name' => 'List Lists',
                'description' => 'List all contact lists in the account.',
                'icon' => 'ph:list',
            ],
            'constantcontact_get_list' => [
                'class' => ConstantContactGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get details for a single contact list.',
                'icon' => 'ph:list',
            ],
            'constantcontact_create_list' => [
                'class' => ConstantContactCreateList::class,
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a new contact list.',
                'icon' => 'ph:plus',
            ],
            'constantcontact_add_contact_to_list' => [
                'class' => ConstantContactAddContactToList::class,
                'type' => 'write',
                'name' => 'Add Contact to List',
                'description' => 'Add one or more contacts to a contact list.',
                'icon' => 'ph:envelope',
            ],
            'constantcontact_get_current_user' => [
                'class' => ConstantContactGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current user account summary.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * Return the path to the Lua API docs file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/constant-contact.md';
    }

    /**
     * Return the credential fields needed for authentication.
     *
     * @return array<int, array<string, mixed>> Credential field definitions
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
        ];
    }

    /**
     * Indicate this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * When an account context is provided, credentials are resolved from the
     * CredentialResolver for that account. Otherwise the default service is used.
     *
     * @param  string  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new ConstantContactService(
                accessToken: $creds->get('constantcontact', 'access_token', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(ConstantContactService::class));
    }
}
