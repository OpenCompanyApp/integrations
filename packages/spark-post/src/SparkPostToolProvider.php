<?php

namespace OpenCompany\Integrations\SparkPost;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostListSendingDomains;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostGetSendingDomain;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostListTemplates;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostGetTemplate;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostSendTransmission;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostListWebhooks;
use OpenCompany\Integrations\SparkPost\Tools\SparkPostGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;

/**
 * Registers the integration provider and exposes its tools.
 */
class SparkPostToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'api_key',
            'legacy_auth_type' => 'api_key',
            'credential_mode' => 'secret',
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
     * {@inheritdoc}
     */
    public function appName(): string
    {
        return 'spark-post';
    }

    /**
     * {@inheritdoc}
     */
    public function appMeta(): array
    {
        return [
            'label' => 'SparkPost',
            'description' => 'Email delivery',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:sparkpost',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'SparkPost',
            'description' => 'Email delivery and analytics platform',
            'icon' => 'ph:envelope-simple',
            'logo' => 'simple-icons:sparkpost',
            'category' => 'marketing',
            'badge' => 'verified',
            'docs_url' => 'https://developers.sparkpost.com/api/',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your SparkPost API key',
                'hint' => 'Generate an API key in your SparkPost account under Account > API Keys',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.sparkpost.com/api/v1',
                'hint' => 'Use the default for SparkPost cloud, or your SparkPost EU / self-hosted URL',
                'default' => 'https://api.sparkpost.com/api/v1',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.sparkpost.com/api/v1', '/');

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($baseUrl . '/account');

            $json = $response->json();

            if ($json === null) {
                return [
                    'success' => false,
                    'error' => "Could not reach SparkPost API at {$baseUrl}. Check the URL.",
                ];
            }

            if (! $response->successful()) {
                $error = $json['errors'][0]['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => "SparkPost API error: {$error}",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to SparkPost API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function tools(): array
    {
        return [
            'spark_post_list_sending_domains' => [
                'class' => SparkPostListSendingDomains::class,
                'type' => 'read',
                'name' => 'List Sending Domains',
                'description' => 'List sending domains configured in SparkPost.',
                'icon' => 'ph:globe',
            ],
            'spark_post_get_sending_domain' => [
                'class' => SparkPostGetSendingDomain::class,
                'type' => 'read',
                'name' => 'Get Sending Domain',
                'description' => 'Get details for a specific sending domain.',
                'icon' => 'ph:globe',
            ],
            'spark_post_list_templates' => [
                'class' => SparkPostListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List email templates in SparkPost.',
                'icon' => 'ph:file-text',
            ],
            'spark_post_get_template' => [
                'class' => SparkPostGetTemplate::class,
                'type' => 'read',
                'name' => 'Get Template',
                'description' => 'Get a specific email template by ID.',
                'icon' => 'ph:file-text',
            ],
            'spark_post_send_transmission' => [
                'class' => SparkPostSendTransmission::class,
                'type' => 'write',
                'name' => 'Send Transmission',
                'description' => 'Send an email transmission via SparkPost.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'spark_post_list_webhooks' => [
                'class' => SparkPostListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List webhooks configured in SparkPost.',
                'icon' => 'ph:webhooks-logo',
            ],
            'spark_post_get_current_user' => [
                'class' => SparkPostGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current SparkPost account information.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/spark-post.md';
    }

    /**
     * {@inheritdoc}
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.sparkpost.com/api/v1'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SparkPostService(
                apiKey: $creds->get('spark-post', 'api_key', '', $account),
                baseUrl: $creds->get('spark-post', 'url', 'https://api.sparkpost.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(SparkPostService::class));
    }
}
