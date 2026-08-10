<?php

namespace OpenCompany\Integrations\CloudConvert;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Throwable;

/**
 * Provides CloudConvert tools, metadata, configuration, and connection checks.
 */
class CloudConvertToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'setup_flows' => ['manual_secret'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => ['api_key'],
                'notes' => ['CloudConvert uses bearer-token API key authentication.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
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
        return 'cloudconvert';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'CloudConvert',
            'description' => 'File conversion and processing',
            'icon' => 'ph:file-arrow-down',
            'logo' => 'simple-icons:cloudconvert',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CloudConvert',
            'description' => 'Manage CloudConvert jobs, tasks, operations, webhooks, signed URLs, and common file-processing operations.',
            'icon' => 'ph:file-arrow-down',
            'logo' => 'simple-icons:cloudconvert',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://cloudconvert.com/api/v2',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'CloudConvert API key', 'hint' => 'Create an API key in the CloudConvert dashboard.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.cloudconvert.com/v2', 'hint' => 'Async API base URL.', 'default' => 'https://api.cloudconvert.com/v2'],
            ['key' => 'sync_url', 'type' => 'url', 'label' => 'Sync API Base URL', 'placeholder' => 'https://sync.api.cloudconvert.com/v2', 'hint' => 'Sync API base URL used by wait tools.', 'default' => 'https://sync.api.cloudconvert.com/v2'],
        ];
    }

    /**
     * Verify CloudConvert credentials with a lightweight current-user lookup.
     *
     * @param  array<string, mixed>  $config  API key and optional base URLs.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        try {
            $service = new CloudConvertService(
                apiKey: $apiKey,
                baseUrl: (string) ($config['url'] ?? 'https://api.cloudconvert.com/v2'),
                syncBaseUrl: (string) ($config['sync_url'] ?? 'https://sync.api.cloudconvert.com/v2'),
            );
            $result = $service->getCurrentUser();
            $email = $result['data']['email'] ?? $result['data']['username'] ?? 'user';

            return ['success' => true, 'message' => "Connected to CloudConvert as {$email}."];
        } catch (Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'sync_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'cloudconvert_api_get' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertApiGet',
                'type' => 'read',
                'name' => 'API GET',
                'description' => 'Call any CloudConvert API GET endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'cloudconvert_api_post' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertApiPost',
                'type' => 'write',
                'name' => 'API POST',
                'description' => 'Call any CloudConvert API POST endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'cloudconvert_api_put' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertApiPut',
                'type' => 'write',
                'name' => 'API PUT',
                'description' => 'Call any CloudConvert API PUT endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'cloudconvert_api_delete' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertApiDelete',
                'type' => 'write',
                'name' => 'API DELETE',
                'description' => 'Call any CloudConvert API DELETE endpoint path.',
                'icon' => 'ph:brackets-curly',
            ],
            'cloudconvert_get_current_user' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetCurrentUser',
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated CloudConvert user profile and remaining credits.',
                'icon' => 'ph:user',
            ],
            'cloudconvert_list_operations' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListOperations',
                'type' => 'read',
                'name' => 'List Operations',
                'description' => 'List available operations, formats, engines, versions, and options.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'cloudconvert_create_job' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJob',
                'type' => 'write',
                'name' => 'Create Job',
                'description' => 'Create an async CloudConvert job with named tasks.',
                'icon' => 'ph:plus-circle',
            ],
            'cloudconvert_create_job_sync' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateJobSync',
                'type' => 'write',
                'name' => 'Create Job Sync',
                'description' => 'Create a CloudConvert job and wait for completion using the sync API.',
                'icon' => 'ph:clock-countdown',
            ],
            'cloudconvert_get_job' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetJob',
                'type' => 'read',
                'name' => 'Get Job',
                'description' => 'Get details and status for a CloudConvert job.',
                'icon' => 'ph:eye',
            ],
            'cloudconvert_wait_job' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertWaitJob',
                'type' => 'read',
                'name' => 'Wait Job',
                'description' => 'Wait until a CloudConvert job finishes or fails using the sync API.',
                'icon' => 'ph:timer',
            ],
            'cloudconvert_list_jobs' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListJobs',
                'type' => 'read',
                'name' => 'List Jobs',
                'description' => 'List CloudConvert jobs with documented filters.',
                'icon' => 'ph:list',
            ],
            'cloudconvert_delete_job' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertDeleteJob',
                'type' => 'write',
                'name' => 'Delete Job',
                'description' => 'Delete a CloudConvert job and its temporary data.',
                'icon' => 'ph:trash',
            ],
            'cloudconvert_get_task' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertGetTask',
                'type' => 'read',
                'name' => 'Get Task',
                'description' => 'Get details and status for a CloudConvert task.',
                'icon' => 'ph:eye',
            ],
            'cloudconvert_wait_task' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertWaitTask',
                'type' => 'read',
                'name' => 'Wait Task',
                'description' => 'Wait until a CloudConvert task finishes or fails using the sync API.',
                'icon' => 'ph:timer',
            ],
            'cloudconvert_list_tasks' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListTasks',
                'type' => 'read',
                'name' => 'List Tasks',
                'description' => 'List CloudConvert tasks with documented filters.',
                'icon' => 'ph:list',
            ],
            'cloudconvert_cancel_task' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCancelTask',
                'type' => 'write',
                'name' => 'Cancel Task',
                'description' => 'Cancel a waiting or processing CloudConvert task.',
                'icon' => 'ph:x-circle',
            ],
            'cloudconvert_retry_task' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertRetryTask',
                'type' => 'write',
                'name' => 'Retry Task',
                'description' => 'Create a retry task from the payload of another task.',
                'icon' => 'ph:arrow-clockwise',
            ],
            'cloudconvert_delete_task' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertDeleteTask',
                'type' => 'write',
                'name' => 'Delete Task',
                'description' => 'Delete a CloudConvert task and its temporary data.',
                'icon' => 'ph:trash',
            ],
            'cloudconvert_create_webhook' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateWebhook',
                'type' => 'write',
                'name' => 'Create Webhook',
                'description' => 'Create an account-level CloudConvert webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
            'cloudconvert_list_webhooks' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertListWebhooks',
                'type' => 'read',
                'name' => 'List Webhooks',
                'description' => 'List account-level CloudConvert webhooks.',
                'icon' => 'ph:webhooks-logo',
            ],
            'cloudconvert_delete_webhook' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertDeleteWebhook',
                'type' => 'write',
                'name' => 'Delete Webhook',
                'description' => 'Delete an account-level CloudConvert webhook.',
                'icon' => 'ph:trash',
            ],
            'cloudconvert_create_signed_url' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertCreateSignedUrl',
                'type' => 'write',
                'name' => 'Create Signed URL',
                'description' => 'Create a CloudConvert signed URL for on-demand conversions.',
                'icon' => 'ph:signature',
            ],
            'cloudconvert_verify_webhook_signature' => [
                'class' => 'OpenCompany\Integrations\CloudConvert\Tools\CloudConvertVerifyWebhookSignature',
                'type' => 'read',
                'name' => 'Verify Webhook Signature',
                'description' => 'Verify a CloudConvert webhook HMAC signature.',
                'icon' => 'ph:shield-check',
            ],
        ];
    }

    public function scriptDocsPath(): ?string
    {
        return __DIR__ . '/../script-docs/cloudconvert.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.cloudconvert.com/v2'],
            ['key' => 'sync_url', 'type' => 'url', 'label' => 'Sync API Base URL', 'required' => false, 'default' => 'https://sync.api.cloudconvert.com/v2'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve a CloudConvert service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Optional host runtime context.
     */
    private function resolveService(array $context = []): CloudConvertService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new CloudConvertService(
                apiKey: (string) $creds->get('cloudconvert', 'api_key', '', $account),
                baseUrl: (string) $creds->get('cloudconvert', 'url', 'https://api.cloudconvert.com/v2', $account),
                syncBaseUrl: (string) $creds->get('cloudconvert', 'sync_url', 'https://sync.api.cloudconvert.com/v2', $account),
            );
        }

        return app(CloudConvertService::class);
    }
}