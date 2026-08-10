<?php

namespace OpenCompany\Integrations\Typeform;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Typeform\Tools\TypeformCreateWebhook;
use OpenCompany\Integrations\Typeform\Tools\TypeformDeleteResponse;
use OpenCompany\Integrations\Typeform\Tools\TypeformDeleteWebhook;
use OpenCompany\Integrations\Typeform\Tools\TypeformGetForm;
use OpenCompany\Integrations\Typeform\Tools\TypeformGetResponse;
use OpenCompany\Integrations\Typeform\Tools\TypeformGetWorkspace;
use OpenCompany\Integrations\Typeform\Tools\TypeformListForms;
use OpenCompany\Integrations\Typeform\Tools\TypeformListResponses;
use OpenCompany\Integrations\Typeform\Tools\TypeformListWebhooks;
use OpenCompany\Integrations\Typeform\Tools\TypeformListWorkspaces;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
/**
 * Registers all Typeform tools and provides integration metadata.
 *
 * Exposes 10 tools covering forms, responses, workspaces,
 * and webhooks via the ToolProvider contract.
 */
class TypeformToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities {

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
        return 'typeform';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Typeform',
            'description' => 'Forms & Surveys',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:typeform',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Typeform',
            'description' => 'Forms, responses, workspaces, and webhooks',
            'icon' => 'ph:notebook',
            'logo' => 'simple-icons:typeform',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.typeform.com/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'access_token',
                'type' => 'secret',
                'label' => 'Personal Access Token',
                'placeholder' => 'tfp_...',
                'hint' => 'Typeform Personal Access Token. Generate one in your Typeform account settings.',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Typeform connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'access_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = $config['access_token'] ?? '';

        if (empty($accessToken)) {
            return ['success' => false, 'error' => 'No access token provided. Generate a Personal Access Token in your Typeform account settings.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.typeform.com/me');

            $body = $response->json() ?? [];

            if ($response->failed()) {
                $error = $body['error'] ?? $body['message'] ?? $response->body();

                return [
                    'success' => false,
                    'error' => 'Typeform API error: ' . (is_string($error) ? $error : json_encode($error)),
                ];
            }

            $email = $body['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Typeform as {$email}.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'access_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Forms
            'typeform_list_forms' => [
                'class' => TypeformListForms::class,
                'type' => 'read',
                'name' => 'List Forms',
                'description' => 'List Typeform forms with optional search and filtering.',
                'icon' => 'ph:list',
            ],
            'typeform_get_form' => [
                'class' => TypeformGetForm::class,
                'type' => 'read',
                'name' => 'Get Form',
                'description' => 'Get details of a specific Typeform form.',
                'icon' => 'ph:file-text',
            ],
            // Responses
            'typeform_list_responses' => [
                'class' => TypeformListResponses::class,
                'type' => 'read',
                'name' => 'List Responses',
                'description' => 'List responses for a Typeform form with filtering and pagination.',
                'icon' => 'ph:chat-circle-text',
            ],
            'typeform_get_response' => [
                'class' => TypeformGetResponse::class,
                'type' => 'read',
                'name' => 'Get Response',
                'description' => 'Get a single Typeform response by ID.',
                'icon' => 'ph:chat-circle',
            ],
            'typeform_delete_response' => [
                'class' => TypeformDeleteResponse::class,
                'type' => 'write',
                'name' => 'Delete Response',
                'description' => 'Delete a Typeform response.',
                'icon' => 'ph:trash',
            ],
            // Workspaces
            'typeform_list_workspaces' => [
                'class' => TypeformListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List Typeform workspaces.',
                'icon' => 'ph:folder',
            ],
            'typeform_get_workspace' => [
                'class' => TypeformGetWorkspace::class,
                'type' => 'read',
                'name' => 'Get Workspace',
                'description' => 'Get details of a specific Typeform workspace.',
                'icon' => 'ph:folder-open',
            ],
            // Webhooks
            'typeform_create_webhook' => [
                'class' => TypeformCreateWebhook::class,
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create or update a webhook for a Typeform form.',
                'icon' => 'ph:webhook',
            ],
            'typeform_list_webhooks' => [
                'class' => TypeformListWebhooks::class,
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List webhooks for a Typeform form.',
                'icon' => 'ph:webhook-logo',
            ],
            'typeform_delete_webhook' => [
                'class' => TypeformDeleteWebhook::class,
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete a webhook from a Typeform form.',
                'icon' => 'ph:trash',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/typeform.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'access_token', 'type' => 'secret', 'label' => 'Personal Access Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TypeformService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): TypeformService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TypeformService(
                accessToken: $creds->get('typeform', 'access_token', '', $account),
            );
        }

        return app(TypeformService::class);
    }
}
