<?php

namespace OpenCompany\Integrations\Resend;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Resend\Tools\ResendCreateApiKey;
use OpenCompany\Integrations\Resend\Tools\ResendCreateContact;
use OpenCompany\Integrations\Resend\Tools\ResendCreateDomain;
use OpenCompany\Integrations\Resend\Tools\ResendGetDomain;
use OpenCompany\Integrations\Resend\Tools\ResendGetEmail;
use OpenCompany\Integrations\Resend\Tools\ResendListApiKeys;
use OpenCompany\Integrations\Resend\Tools\ResendListDomains;
use OpenCompany\Integrations\Resend\Tools\ResendListEmails;
use OpenCompany\Integrations\Resend\Tools\ResendSendEmail;
use OpenCompany\Integrations\Resend\Tools\ResendVerifyDomain;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Resend tools and provides integration metadata, configuration schema, and connection testing.
 */
class ResendToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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

    public function appName(): string
    {
        return 'resend';
    }

    public function appMeta(): array
    {
        return [
            'label'       => 'Resend',
            'description' => 'Email delivery platform — send emails, manage domains, API keys, and contacts.',
            'icon'        => 'ph:envelope-simple',
            'logo'        => 'simple-icons:resend',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name'        => 'Resend',
            'description' => 'Connect Resend to send emails, manage domains, API keys, and audience contacts.',
            'icon'        => 'ph:envelope-simple',
            'logo'        => 'simple-icons:resend',
            'category'    => 'productivity',
            'badge'       => 'verified',
            'docs_url'    => 'https://resend.com/docs/api-reference',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'name'        => 'api_key',
                'label'       => 'API Key',
                'type'        => 'text',
                'required'    => true,
                'description' => 'Your Resend API key with the necessary permissions.',
                'placeholder' => 're_xxxxxxxxxxxxxxxxxxxxxx',
            ],
        ];
    }

    /** @param array<string, mixed> $config */
    public function testConnection(array $config): array
    {
        try {
            $apiKey = $config['api_key'] ?? '';
            $service = new ResendService(apiKey: $apiKey);

            if (! $service->isConfigured()) {
                return [
                    'success' => false,
                    'error'   => 'Resend API key is not configured.',
                ];
            }

            $result = $service->listDomains();
            $count = count($result['data'] ?? []);

            return [
                'success' => true,
                'message' => sprintf('Connected to Resend — %d domain(s) found.', $count),
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'error'   => $e->getMessage(),
            ];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string'];
    }

    public function tools(): array
    {
        return [
            'resend_send_email' => [
                'class'       => ResendSendEmail::class,
                'type'        => 'write',
                'name'        => 'Send Email',
                'description' => 'Send an email via Resend.',
                'icon'        => 'ph:paper-plane-tilt',
            ],
            'resend_get_email' => [
                'class'       => ResendGetEmail::class,
                'type'        => 'read',
                'name'        => 'Get Email',
                'description' => 'Retrieve a single email by ID from Resend.',
                'icon'        => 'ph:envelope-open',
            ],
            'resend_list_emails' => [
                'class'       => ResendListEmails::class,
                'type'        => 'read',
                'name'        => 'List Emails',
                'description' => 'List emails from Resend with pagination.',
                'icon'        => 'ph:envelopes',
            ],
            'resend_create_api_key' => [
                'class'       => ResendCreateApiKey::class,
                'type'        => 'write',
                'name'        => 'Create API Key',
                'description' => 'Create a new API key in Resend.',
                'icon'        => 'ph:key',
            ],
            'resend_list_api_keys' => [
                'class'       => ResendListApiKeys::class,
                'type'        => 'read',
                'name'        => 'List API Keys',
                'description' => 'List all API keys in Resend.',
                'icon'        => 'ph:keys',
            ],
            'resend_create_domain' => [
                'class'       => ResendCreateDomain::class,
                'type'        => 'write',
                'name'        => 'Create Domain',
                'description' => 'Create a new domain in Resend.',
                'icon'        => 'ph:globe',
            ],
            'resend_get_domain' => [
                'class'       => ResendGetDomain::class,
                'type'        => 'read',
                'name'        => 'Get Domain',
                'description' => 'Retrieve a single domain by ID from Resend.',
                'icon'        => 'ph:globe-hemisphere-west',
            ],
            'resend_list_domains' => [
                'class'       => ResendListDomains::class,
                'type'        => 'read',
                'name'        => 'List Domains',
                'description' => 'List all domains in Resend.',
                'icon'        => 'ph:globe-simple',
            ],
            'resend_verify_domain' => [
                'class'       => ResendVerifyDomain::class,
                'type'        => 'write',
                'name'        => 'Verify Domain',
                'description' => 'Trigger domain verification in Resend.',
                'icon'        => 'ph:check-circle',
            ],
            'resend_create_contact' => [
                'class'       => ResendCreateContact::class,
                'type'        => 'write',
                'name'        => 'Create Contact',
                'description' => 'Create a contact in a Resend audience.',
                'icon'        => 'ph:user-plus',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/resend.md';
    }    public function credentialFields(): array
    {
        return [
            'api_key' => [
                'label'       => 'API Key',
                'type'        => 'text',
                'required'    => true,
                'description' => 'Your Resend API key.',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param array<string, mixed> $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /** @param array<string, mixed> $context */
    private function resolveService(array $context = []): ResendService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ResendService(
                apiKey: $creds->get('resend', 'api_key', '', $account),
            );
        }

        return app(ResendService::class);
    }
}
