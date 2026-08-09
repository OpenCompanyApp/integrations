<?php

namespace OpenCompany\Integrations\LambdaLabs;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListInstances;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsGetInstance;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsLaunchInstance;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListSshKeys;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListInstanceTypes;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsListImages;
use OpenCompany\Integrations\LambdaLabs\Tools\LambdaLabsGetCurrentUser;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class LambdaLabsToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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

    public function appName(): string
    {
        return 'lambda-labs';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Lambda Labs',
            'description' => 'GPU cloud computing',
            'icon' => 'ph:gpu',
            'logo' => 'simple-icons:lambda',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Lambda Labs',
            'description' => 'GPU cloud computing — launch and manage GPU instances, SSH keys, and machine images',
            'icon' => 'ph:gpu',
            'logo' => 'simple-icons:lambda',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://cloud.lambdalabs.com/api/v1/docs',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Lambda Labs API key',
                'hint' => 'Generate an API key in the Lambda Labs cloud dashboard under <strong>Settings → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://cloud.lambdalabs.com/api/v1',
                'hint' => 'Override only if using a custom Lambda Labs-compatible endpoint',
                'default' => 'https://cloud.lambdalabs.com/api/v1',
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $baseUrl = rtrim($config['url'] ?? 'https://cloud.lambdalabs.com/api/v1', '/');

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
                    'error' => "Could not reach Lambda Labs API at {$baseUrl}. Check the URL.",
                ];
            }

            if (!$response->successful()) {
                $message = $json['message'] ?? $json['error'] ?? $response->body();
                return [
                    'success' => false,
                    'error' => "Lambda Labs API error ({$response->status()}): {$message}",
                ];
            }

            $user = $json['data'] ?? $json;
            $email = $user['email'] ?? 'unknown';

            return [
                'success' => true,
                'message' => "Connected to Lambda Labs as {$email}.",
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
            'lambda_labs_list_instances' => [
                'class' => LambdaLabsListInstances::class,
                'type' => 'read',
                'name' => 'List Instances',
                'description' => 'List all GPU instances in the Lambda Labs account.',
                'icon' => 'ph:server',
            ],
            'lambda_labs_get_instance' => [
                'class' => LambdaLabsGetInstance::class,
                'type' => 'read',
                'name' => 'Get Instance',
                'description' => 'Get details for a specific GPU instance.',
                'icon' => 'ph:server',
            ],
            'lambda_labs_launch_instance' => [
                'class' => LambdaLabsLaunchInstance::class,
                'type' => 'write',
                'name' => 'Launch Instance',
                'description' => 'Launch a new GPU instance.',
                'icon' => 'ph:plus-circle',
            ],
            'lambda_labs_list_ssh_keys' => [
                'class' => LambdaLabsListSshKeys::class,
                'type' => 'read',
                'name' => 'List SSH Keys',
                'description' => 'List all SSH keys in the account.',
                'icon' => 'ph:key',
            ],
            'lambda_labs_list_instance_types' => [
                'class' => LambdaLabsListInstanceTypes::class,
                'type' => 'read',
                'name' => 'List Instance Types',
                'description' => 'List available GPU instance types and configurations.',
                'icon' => 'ph:gpu',
            ],
            'lambda_labs_list_images' => [
                'class' => LambdaLabsListImages::class,
                'type' => 'read',
                'name' => 'List Images',
                'description' => 'List available machine images (OS templates).',
                'icon' => 'ph:hard-drives',
            ],
            'lambda_labs_get_current_user' => [
                'class' => LambdaLabsGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the current authenticated user information.',
                'icon' => 'ph:user',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/lambda-labs.md';
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://cloud.lambdalabs.com/api/v1'],
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

            $service = new LambdaLabsService(
                apiKey: $creds->get('lambda-labs', 'api_key', '', $account),
                baseUrl: $creds->get('lambda-labs', 'url', 'https://cloud.lambdalabs.com/api/v1', $account),
            );

            return new $class($service);
        }

        return new $class(app(LambdaLabsService::class));
    }
}
