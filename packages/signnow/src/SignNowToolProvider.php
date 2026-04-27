<?php

namespace OpenCompany\Integrations\SignNow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\SignNow\Tools\SignNowListDocuments;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowCreateDocument;
use OpenCompany\Integrations\SignNow\Tools\SignNowListTemplates;
use OpenCompany\Integrations\SignNow\Tools\SignNowSendInvite;
use OpenCompany\Integrations\SignNow\Tools\SignNowGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class SignNowToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
            'strategy' => 'oauth2_manual_token',
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
              0 => 'Token acquisition may happen outside this package, but the host only needs to store the resulting token.',
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

    /**
     * Unique integration identifier.
     */
    public function appName(): string
    {
        return 'signnow';
    }    /**
     * Configuration schema for the integrations settings UI.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Access Token',
                'placeholder' => 'Enter your SignNow OAuth2 access token',
                'hint' => 'Generate an access token via OAuth2 or from your SignNow developer account',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.signnow.com',
                'hint' => 'Use <code>https://api.signnow.com</code> for production, or <code>https://api-eval.signnow.com</code> for sandbox',
                'default' => 'https://api.signnow.com',
            ],
        ];
    }

    /**
     * Test the connection to the SignNow API using the provided configuration.
     *
     * @param array<string, mixed> $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://api.signnow.com', '/');

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
                    'error' => "Could not reach SignNow API at {$baseUrl}. Check the URL.",
                ];
            }

            return [
                'success' => true,
                'message' => "Connected to SignNow API at {$baseUrl}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Validation rules for configuration values.
     *
     * @return array<string, string|string[]>
     */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
            'url' => 'nullable|url',
        ];
    }

    /**
     * Registered tools keyed by tool name.
     *
     * @return array<string, array{class: class-string<Tool>, type: string, name: string, description: string, icon: string}>
     */
    public function tools(): array
    {
        return [
            'signnow_list_documents' => [
                'class' => SignNowListDocuments::class,
                'type' => 'read',
                'name' => 'List Documents',
                'description' => 'List documents accessible to the authenticated user.',
                'icon' => 'ph:files',
            ],
            'signnow_get_document' => [
                'class' => SignNowGetDocument::class,
                'type' => 'read',
                'name' => 'Get Document',
                'description' => 'Get details for a specific document.',
                'icon' => 'ph:file-text',
            ],
            'signnow_create_document' => [
                'class' => SignNowCreateDocument::class,
                'type' => 'write',
                'name' => 'Create Document',
                'description' => 'Upload a file to create a new document.',
                'icon' => 'ph:upload-simple',
            ],
            'signnow_list_templates' => [
                'class' => SignNowListTemplates::class,
                'type' => 'read',
                'name' => 'List Templates',
                'description' => 'List available document templates.',
                'icon' => 'ph:copy',
            ],
            'signnow_send_invite' => [
                'class' => SignNowSendInvite::class,
                'type' => 'write',
                'name' => 'Send Signing Invite',
                'description' => 'Send a signing invitation for a document.',
                'icon' => 'ph:paper-plane-tilt',
            ],
            'signnow_get_current_user' => [
                'class' => SignNowGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Path to the Lua API reference documentation.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/signnow.md';
    }

    /**
     * Credential fields required for the integration.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.signnow.com'],
        ];
    }

    /**
     * Confirm this is an integration (not a standalone tool).
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Instantiate a tool class, optionally with account-specific credentials.
     *
     * @param class-string<Tool> $class   Fully-qualified tool class name
     * @param array<string, mixed> $context Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new SignNowService(
                accessToken: $creds->get('signnow', 'access_token', '', $account),
                baseUrl: $creds->get('signnow', 'url', 'https://api.signnow.com', $account),
            );

            return new $class($service);
        }

        return new $class(app(SignNowService::class));
    }
}
