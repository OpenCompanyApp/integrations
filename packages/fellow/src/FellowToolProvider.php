<?php

namespace OpenCompany\Integrations\Fellow;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Fellow\Tools\FellowApiDelete;
use OpenCompany\Integrations\Fellow\Tools\FellowApiGet;
use OpenCompany\Integrations\Fellow\Tools\FellowApiPatch;
use OpenCompany\Integrations\Fellow\Tools\FellowApiPost;
use OpenCompany\Integrations\Fellow\Tools\FellowArchiveActionItem;
use OpenCompany\Integrations\Fellow\Tools\FellowCreateWebhook;
use OpenCompany\Integrations\Fellow\Tools\FellowDeleteNote;
use OpenCompany\Integrations\Fellow\Tools\FellowDeleteRecording;
use OpenCompany\Integrations\Fellow\Tools\FellowDeleteWebhook;
use OpenCompany\Integrations\Fellow\Tools\FellowGetActionItem;
use OpenCompany\Integrations\Fellow\Tools\FellowGetCurrentUser;
use OpenCompany\Integrations\Fellow\Tools\FellowGetNote;
use OpenCompany\Integrations\Fellow\Tools\FellowGetRecording;
use OpenCompany\Integrations\Fellow\Tools\FellowGetWebhook;
use OpenCompany\Integrations\Fellow\Tools\FellowListActionItems;
use OpenCompany\Integrations\Fellow\Tools\FellowListNotes;
use OpenCompany\Integrations\Fellow\Tools\FellowListRecordings;
use OpenCompany\Integrations\Fellow\Tools\FellowListWebhooks;
use OpenCompany\Integrations\Fellow\Tools\FellowMarkActionItemComplete;
use OpenCompany\Integrations\Fellow\Tools\FellowUpdateWebhook;

/**
 * Tool provider for Fellow's Developer API.
 *
 * Exposes the documented v1 notes, action items, recordings, webhooks, user,
 * and generic relative-path endpoints with multi-account credentials.
 */
class FellowToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'notes' => ['Fellow sends API keys in the X-API-KEY header.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => ['workspace_subdomain'],
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
        return 'fellow';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Fellow',
            'description' => 'Meeting notes, action items, recordings, and webhooks',
            'icon' => 'ph:calendar-check',
            'logo' => 'ph:calendar-check',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Fellow',
            'description' => 'Fellow Developer API for meeting notes, action items, recordings, webhooks, and workspace user data',
            'icon' => 'ph:calendar-check',
            'logo' => 'ph:calendar-check',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.fellow.ai/reference',
        ];
    }

    public function configSchema(): array
    {
        return $this->credentialFields();
    }

    /**
     * Test the connection to the Fellow API using the provided config.
     *
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? $config['access_token'] ?? '';
        $baseUrl = $this->baseUrlFromConfig($config);

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'API key is required.'];
        }

        if ($baseUrl === '') {
            return ['success' => false, 'error' => 'Workspace subdomain or API URL is required.'];
        }

        try {
            $response = Http::withHeaders([
                'X-API-KEY' => $apiKey,
                'Accept' => 'application/json',
            ])->timeout(10)->get($baseUrl.'/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Fellow Developer API.',
                ];
            }

            $error = $response->json('error') ?? $response->json('message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'Fellow API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'required_without:access_token|string',
            'access_token' => 'nullable|string',
            'subdomain' => 'required_without:url|string',
            'url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'fellow_get_current_user' => ['class' => FellowGetCurrentUser::class, 'type' => 'read', 'name' => 'Get Current User', 'description' => 'Get the authenticated Fellow user and workspace.', 'icon' => 'ph:user-circle'],
            'fellow_list_notes' => ['class' => FellowListNotes::class, 'type' => 'read', 'name' => 'List Notes', 'description' => 'List Fellow notes with optional filters and pagination.', 'icon' => 'ph:note'],
            'fellow_get_note' => ['class' => FellowGetNote::class, 'type' => 'read', 'name' => 'Get Note', 'description' => 'Retrieve a Fellow note by ID.', 'icon' => 'ph:note'],
            'fellow_delete_note' => ['class' => FellowDeleteNote::class, 'type' => 'write', 'name' => 'Delete Note', 'description' => 'Delete a Fellow note by ID. Requires privileged API access.', 'icon' => 'ph:trash'],
            'fellow_list_action_items' => ['class' => FellowListActionItems::class, 'type' => 'read', 'name' => 'List Action Items', 'description' => 'List Fellow action items with optional filters and pagination.', 'icon' => 'ph:check-square'],
            'fellow_get_action_item' => ['class' => FellowGetActionItem::class, 'type' => 'read', 'name' => 'Get Action Item', 'description' => 'Retrieve a Fellow action item by ID.', 'icon' => 'ph:check-square'],
            'fellow_mark_action_item_complete' => ['class' => FellowMarkActionItemComplete::class, 'type' => 'write', 'name' => 'Mark Action Item Complete', 'description' => 'Mark a Fellow action item complete or incomplete.', 'icon' => 'ph:check-circle'],
            'fellow_archive_action_item' => ['class' => FellowArchiveActionItem::class, 'type' => 'write', 'name' => 'Archive Action Item', 'description' => 'Archive a Fellow action item as won\'t do.', 'icon' => 'ph:archive'],
            'fellow_list_recordings' => ['class' => FellowListRecordings::class, 'type' => 'read', 'name' => 'List Recordings', 'description' => 'List Fellow recordings with optional filters and pagination.', 'icon' => 'ph:record'],
            'fellow_get_recording' => ['class' => FellowGetRecording::class, 'type' => 'read', 'name' => 'Get Recording', 'description' => 'Retrieve a Fellow recording by ID.', 'icon' => 'ph:record'],
            'fellow_delete_recording' => ['class' => FellowDeleteRecording::class, 'type' => 'write', 'name' => 'Delete Recording', 'description' => 'Delete a Fellow recording by ID. Requires privileged API access.', 'icon' => 'ph:trash'],
            'fellow_list_webhooks' => ['class' => FellowListWebhooks::class, 'type' => 'read', 'name' => 'List Webhooks', 'description' => 'List Fellow webhooks.', 'icon' => 'ph:webhooks-logo'],
            'fellow_create_webhook' => ['class' => FellowCreateWebhook::class, 'type' => 'write', 'name' => 'Create Webhook', 'description' => 'Create a Fellow webhook endpoint.', 'icon' => 'ph:webhooks-logo'],
            'fellow_get_webhook' => ['class' => FellowGetWebhook::class, 'type' => 'read', 'name' => 'Get Webhook', 'description' => 'Retrieve a Fellow webhook by ID.', 'icon' => 'ph:webhooks-logo'],
            'fellow_update_webhook' => ['class' => FellowUpdateWebhook::class, 'type' => 'write', 'name' => 'Update Webhook', 'description' => 'Update a Fellow webhook endpoint.', 'icon' => 'ph:webhooks-logo'],
            'fellow_delete_webhook' => ['class' => FellowDeleteWebhook::class, 'type' => 'write', 'name' => 'Delete Webhook', 'description' => 'Delete a Fellow webhook endpoint.', 'icon' => 'ph:webhooks-logo'],
            'fellow_api_get' => ['class' => FellowApiGet::class, 'type' => 'read', 'name' => 'Fellow API GET', 'description' => 'Call a relative Fellow API GET path.', 'icon' => 'ph:brackets-curly'],
            'fellow_api_post' => ['class' => FellowApiPost::class, 'type' => 'write', 'name' => 'Fellow API POST', 'description' => 'Call a relative Fellow API POST path.', 'icon' => 'ph:brackets-curly'],
            'fellow_api_patch' => ['class' => FellowApiPatch::class, 'type' => 'write', 'name' => 'Fellow API PATCH', 'description' => 'Call a relative Fellow API PATCH path.', 'icon' => 'ph:brackets-curly'],
            'fellow_api_delete' => ['class' => FellowApiDelete::class, 'type' => 'write', 'name' => 'Fellow API DELETE', 'description' => 'Call a relative Fellow API DELETE path.', 'icon' => 'ph:brackets-curly'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/fellow.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'subdomain', 'type' => 'text', 'label' => 'Workspace Subdomain', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance with optional account-specific context.
     *
     * @param  class-string<Tool>  $class
     * @param  array<string, mixed>  $context
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Fellow service for default or account-scoped credentials.
     *
     * @param  array<string, mixed>  $context  Runtime context.
     */
    private function resolveService(array $context = []): FellowService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new FellowService(
                apiKey: $creds->get('fellow', 'api_key', $creds->get('fellow', 'access_token', '', $account), $account),
                subdomain: $creds->get('fellow', 'subdomain', '', $account),
                baseUrl: $creds->get('fellow', 'url', '', $account),
            );
        }

        return app(FellowService::class);
    }

    /**
     * Build a Fellow API base URL from settings.
     *
     * @param  array<string, mixed>  $config
     */
    private function baseUrlFromConfig(array $config): string
    {
        if (! empty($config['url'])) {
            return rtrim((string) $config['url'], '/');
        }

        $subdomain = trim((string) ($config['subdomain'] ?? ''));

        if ($subdomain === '') {
            return '';
        }

        $subdomain = preg_replace('/\.fellow\.app$/', '', $subdomain) ?? $subdomain;
        $subdomain = preg_replace('#^https?://#', '', $subdomain) ?? $subdomain;
        $subdomain = trim($subdomain, '/');

        return "https://{$subdomain}.fellow.app/api/v1";
    }
}
