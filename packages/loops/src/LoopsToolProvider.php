<?php

namespace OpenCompany\Integrations\Loops;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Loops\Tools\LoopsCreateContact;
use OpenCompany\Integrations\Loops\Tools\LoopsGetContact;
use OpenCompany\Integrations\Loops\Tools\LoopsGetCurrentUser;
use OpenCompany\Integrations\Loops\Tools\LoopsListContacts;
use OpenCompany\Integrations\Loops\Tools\LoopsSendEvent;
use OpenCompany\Integrations\Loops\Tools\LoopsUpdateContact;

class LoopsToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'loops';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'contacts, events',
            'description' => 'Email marketing',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:loops',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Loops',
            'description' => 'Email marketing and contact management',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:loops',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://loops.so/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Loops API key',
                'hint' => 'Generate an API key in your Loops account settings under "API"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.loops.so/api/v1',
                'hint' => 'The Loops API base URL. Change only if using a custom endpoint.',
                'default' => 'https://app.loops.so/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.loops.so/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/users/me');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Loops API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Loops API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'loops_list_contacts' => [
                'class' => LoopsListContacts::class,
                'type' => 'read',
                'name' => 'List Contacts',
                'description' => 'List contacts with pagination.',
                'icon' => 'ph:users',
            ],
            'loops_get_contact' => [
                'class' => LoopsGetContact::class,
                'type' => 'read',
                'name' => 'Get Contact',
                'description' => 'Get a single contact by ID.',
                'icon' => 'ph:user',
            ],
            'loops_create_contact' => [
                'class' => LoopsCreateContact::class,
                'type' => 'write',
                'name' => 'Create Contact',
                'description' => 'Create a new contact.',
                'icon' => 'ph:user-plus',
            ],
            'loops_update_contact' => [
                'class' => LoopsUpdateContact::class,
                'type' => 'write',
                'name' => 'Update Contact',
                'description' => 'Update an existing contact.',
                'icon' => 'ph:pencil',
            ],
            'loops_send_event' => [
                'class' => LoopsSendEvent::class,
                'type' => 'write',
                'name' => 'Send Event',
                'description' => 'Send a custom event for a contact.',
                'icon' => 'ph:lightning',
            ],
            'loops_get_current_user' => [
                'class' => LoopsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:identification-badge',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/loops.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.loops.so/api/v1'],
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

            $service = new LoopsService(
                apiKey: $creds->get('loops', 'api_key', '', $account),
                baseUrl: $creds->get('loops', 'url', 'https://app.loops.so/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(LoopsService::class));
    }
}
