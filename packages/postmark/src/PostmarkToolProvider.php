<?php

namespace OpenCompany\Integrations\Postmark;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendEmail;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendTemplate;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetDeliveryStats;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListMessages;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetMessage;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListTemplates;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetCurrentUser;

class PostmarkToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'postmark';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'send, templates, delivery',
            'description' => 'Email delivery',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:postmark',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Postmark',
            'description' => 'Fast and reliable email delivery service',
            'icon' => 'ph:envelope',
            'logo' => 'simple-icons:postmark',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://postmarkapp.com/developer',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'server_token',
                'type' => 'secret',
                'label' => 'Server Token',
                'placeholder' => 'Enter your Postmark server token',
                'hint' => 'Find your server token in the Postmark dashboard under Server → API Tokens',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.postmarkapp.com',
                'hint' => 'Use the default Postmark API URL unless using a custom endpoint',
                'default' => 'https://api.postmarkapp.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $serverToken = $config['server_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.postmarkapp.com', '/');

        if (empty($serverToken)) {
            return ['success' => false, 'error' => 'No server token provided'];
        }

        try {
            $response = Http::withHeaders([
                'X-Postmark-Server-Token' => $serverToken,
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/server');

            $json = $response->json();

            if ($response->successful() && isset($json['ID'])) {
                return [
                    'success' => true,
                    'message' => "Connected to Postmark server \"{$json['Name']}\" (ID: {$json['ID']}).",
                ];
            }

            $error = $json['Message'] ?? $response->body();

            return [
                'success' => false,
                'error' => "Postmark API error: {$error}",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'server_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'postmark_send_email' => [
                'class' => PostmarkSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email through Postmark.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'postmark_send_template' => [
                'class' => PostmarkSendTemplate::class,
                'type' => 'write',
                'name' => 'Send Template Email',
                'description' => 'Send an email using a Postmark template.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'postmark_get_delivery_stats' => [
                'class' => PostmarkGetDeliveryStats::class,
                'type' => 'read',
                'name' => 'Delivery Stats',
                'description' => 'Get email delivery statistics.',
                'icon' => 'ph:chart-bar',
            ],
            'postmark_list_messages' => [
                'class' => PostmarkListMessages::class,
                'type' => 'read',
                'name' => 'List Messages',
                'description' => 'List outbound email messages.',
                'icon' => 'ph:envelopes',
            ],
            'postmark_get_message' => [
                'class' => PostmarkGetMessage::class,
                'type' => 'read',
                'name' => 'Get Message',
                'description' => 'Get details of a specific email message.',
                'icon' => 'ph:envelope',
            ],
            'postmark_list_templates' => [
                'class' => PostmarkListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates.',
                'icon' => 'ph:files',
            ],
            'postmark_get_current_user' => [
                'class' => PostmarkGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Server Info',
                'description' => 'Get Postmark server information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/postmark.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'server_token', 'type' => 'secret', 'label' => 'Server Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.postmarkapp.com'],
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

            $service = new PostmarkService(
                serverToken: $creds->get('postmark', 'server_token', '', $account),
                baseUrl: $creds->get('postmark', 'url', 'https://api.postmarkapp.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(PostmarkService::class));
    }
}
