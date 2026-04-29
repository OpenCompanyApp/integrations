<?php

namespace OpenCompany\Integrations\AmazonSes;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesSendEmail;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesGetTemplate;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListTemplates;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesCreateTemplate;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesListSuppressions;
use OpenCompany\Integrations\AmazonSes\Tools\AmazonSesGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class AmazonSesToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'bearer_token',
            'legacy_auth_type' => 'oauth',
            'credential_mode' => 'stored_token',
            'setup_flows' =>
            [
              0 => 'manual_token',
            ],
            'requires_browser_for_setup' => false,
            'refreshable' => false,
            'token_keys' =>
            [
              0 => 'access_token',
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
              'setup_mode' => 'manual_token',
            ],
            'cli' =>
            [
              'setup_supported' => true,
              'runtime_supported' => true,
              'setup_mode' => 'manual_token',
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

    public function appName(): string
    {
        return 'amazon-ses';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Amazon SES',
            'description' => 'Transactional email',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:amazons3',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Amazon SES',
            'description' => 'Scalable transactional and marketing email service by AWS',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:amazons3',
            'category' => 'email',
            'badge' => 'verified',
            'docs_url' => 'https://docs.aws.amazon.com/ses/',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your Amazon SES access token',
                'hint' => 'Provide the Bearer token for authenticating with the Amazon SES API',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://email.us-east-1.amazonaws.com',
                'hint' => 'The regional SES endpoint URL. Change the region as needed (e.g., <code>email.eu-west-1.amazonaws.com</code>)',
                'default' => 'https://email.us-east-1.amazonaws.com',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://email.us-east-1.amazonaws.com', '/');

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/user');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach Amazon SES API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to Amazon SES API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'amazonses_send_email' => [
                'class' => AmazonSesSendEmail::class,
                'type' => 'write',
                'name' => 'Send Email',
                'description' => 'Send an email via Amazon SES.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'amazonses_get_template' => [
                'class' => AmazonSesGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get an email template by name.',
                'icon' => 'ph:file-text',
            ],
            'amazonses_list_templates' => [
                'class' => AmazonSesListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List all email templates.',
                'icon' => 'ph:files',
            ],
            'amazonses_create_template' => [
                'class' => AmazonSesCreateTemplate::class,
                'type' => 'write',
                'name' => 'Create Template',
                'description' => 'Create a new email template.',
                'icon' => 'ph:file-plus',
            ],
            'amazonses_list_suppressions' => [
                'class' => AmazonSesListSuppressions::class,
                'type' => 'read',
                'name' => 'List Suppressions',
                'description' => 'List suppressed email addresses for a configuration set.',
                'icon' => 'ph:prohibit',
            ],
            'amazonses_get_current_user' => [
                'class' => AmazonSesGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated user.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/amazon-ses.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'SES API URL', 'required' => false, 'default' => 'https://email.us-east-1.amazonaws.com'],
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

            $service = new AmazonSesService(
                accessToken: $creds->get('amazon-ses', 'access_token', '', $account),
                baseUrl: $creds->get('amazon-ses', 'url', 'https://email.us-east-1.amazonaws.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(AmazonSesService::class));
    }
}
