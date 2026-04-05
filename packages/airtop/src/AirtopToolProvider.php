<?php

namespace OpenCompany\Integrations\Airtop;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Airtop\Tools\AirtopCreateSession;
use OpenCompany\Integrations\Airtop\Tools\AirtopCreateWindow;
use OpenCompany\Integrations\Airtop\Tools\AirtopGetCurrentUser;
use OpenCompany\Integrations\Airtop\Tools\AirtopGetPageContent;
use OpenCompany\Integrations\Airtop\Tools\AirtopGetSession;
use OpenCompany\Integrations\Airtop\Tools\AirtopGetWindow;
use OpenCompany\Integrations\Airtop\Tools\AirtopListSessions;
use OpenCompany\Integrations\Airtop\Tools\AirtopNavigate;

class AirtopToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'airtop';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'browse, navigate, extract',
            'description' => 'Browser automation',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:airtop',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Airtop',
            'description' => 'Cloud browser automation — create sessions, navigate pages, and extract content',
            'icon' => 'ph:globe',
            'logo' => 'simple-icons:airtop',
            'category' => 'automation',
            'badge' => 'verified',
            'docs_url' => 'https://docs.airtop.ai',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Airtop API key',
                'hint' => 'Generate an API key in your Airtop account settings',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://app.airtop.ai/api/v1',
                'hint' => 'Override only if using a custom Airtop endpoint',
                'default' => 'https://app.airtop.ai/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://app.airtop.ai/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Airtop API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Airtop API as {$json['email'] ?? 'user'}.",
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
            'airtop_create_session' => [
                'class' => AirtopCreateSession::class,
                'type' => 'write',
                'name' => 'Create Session',
                'description' => 'Create a new browser session.',
                'icon' => 'ph:monitor',
            ],
            'airtop_get_session' => [
                'class' => AirtopGetSession::class,
                'type' => 'read',
                'name' => 'Get Session',
                'description' => 'Get details of a browser session.',
                'icon' => 'ph:monitor',
            ],
            'airtop_create_window' => [
                'class' => AirtopCreateWindow::class,
                'type' => 'write',
                'name' => 'Create Window',
                'description' => 'Open a new browser window in a session.',
                'icon' => 'ph:browser',
            ],
            'airtop_get_window' => [
                'class' => AirtopGetWindow::class,
                'type' => 'read',
                'name' => 'Get Window',
                'description' => 'Get details of a browser window.',
                'icon' => 'ph:browser',
            ],
            'airtop_navigate' => [
                'class' => AirtopNavigate::class,
                'type' => 'write',
                'name' => 'Navigate',
                'description' => 'Navigate a browser window to a URL.',
                'icon' => 'ph:arrow-right',
            ],
            'airtop_get_page_content' => [
                'class' => AirtopGetPageContent::class,
                'type' => 'read',
                'name' => 'Get Page Content',
                'description' => 'Extract the content of a loaded page.',
                'icon' => 'ph:file-text',
            ],
            'airtop_list_sessions' => [
                'class' => AirtopListSessions::class,
                'type' => 'read',
                'name' => 'List Sessions',
                'description' => 'List all browser sessions.',
                'icon' => 'ph:list',
            ],
            'airtop_get_current_user' => [
                'class' => AirtopGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/airtop.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://app.airtop.ai/api/v1'],
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

            $service = new AirtopService(
                apiKey: $creds->get('airtop', 'api_key', '', $account),
                baseUrl: $creds->get('airtop', 'url', 'https://app.airtop.ai/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(AirtopService::class));
    }
}
