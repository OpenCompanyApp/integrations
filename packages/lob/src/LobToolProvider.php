<?php

namespace OpenCompany\Integrations\Lob;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Lob\Tools\LobSendPostcard;
use OpenCompany\Integrations\Lob\Tools\LobSendLetter;
use OpenCompany\Integrations\Lob\Tools\LobGetPostcard;
use OpenCompany\Integrations\Lob\Tools\LobListPostcards;
use OpenCompany\Integrations\Lob\Tools\LobVerifyAddress;
use OpenCompany\Integrations\Lob\Tools\LobGetCurrentUser;

class LobToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'lob';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'postcards, letters, address verification',
            'description' => 'Direct mail & address verification',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:lob',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lob',
            'description' => 'Direct mail automation and address verification API',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:lob',
            'category' => 'mail',
            'badge' => 'verified',
            'docs_url' => 'https://docs.lob.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Lob API key',
                'hint' => 'Find your API key in the Lob Dashboard under Settings → API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'Base URL',
                'placeholder' => 'https://api.lob.com/v1',
                'hint' => 'Use <code>https://api.lob.com/v1</code> for production, or <code>https://api.lob.com/v1</code> with a test key for the sandbox',
                'default' => 'https://api.lob.com/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.lob.com/v1', '/');

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
                    'error' => "Could not reach Lob API at {$baseUrl}. Check the URL and API key.",
                ];
            }

            $companyName = $json['company_name'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Lob API as \"{$companyName}\".",
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
            'lob_send_postcard' => [
                'class' => LobSendPostcard::class,
                'type' => 'write',
                'name' => 'Send Postcard',
                'description' => 'Send a postcard via Lob direct mail API.',
                'icon' => 'ph:postcard',
            ],
            'lob_send_letter' => [
                'class' => LobSendLetter::class,
                'type' => 'write',
                'name' => 'Send Letter',
                'description' => 'Send a letter via Lob direct mail API.',
                'icon' => 'ph:envelope',
            ],
            'lob_get_postcard' => [
                'class' => LobGetPostcard::class,
                'type' => 'read',
                'name' => 'Get Postcard',
                'description' => 'Retrieve a postcard by ID.',
                'icon' => 'ph:postcard',
            ],
            'lob_list_postcards' => [
                'class' => LobListPostcards::class,
                'type' => 'read',
                'name' => 'List Postcards',
                'description' => 'List postcards with pagination.',
                'icon' => 'ph:list',
            ],
            'lob_verify_address' => [
                'class' => LobVerifyAddress::class,
                'type' => 'read',
                'name' => 'Verify Address',
                'description' => 'Verify a US mailing address.',
                'icon' => 'ph:map-pin',
            ],
            'lob_get_current_user' => [
                'class' => LobGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current Lob account info.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/lob.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'Base URL', 'required' => false, 'default' => 'https://api.lob.com/v1'],
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

            $service = new LobService(
                apiKey: $creds->get('lob', 'api_key', '', $account),
                baseUrl: $creds->get('lob', 'url', 'https://api.lob.com/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(LobService::class));
    }
}
