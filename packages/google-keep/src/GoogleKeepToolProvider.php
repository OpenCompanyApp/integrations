<?php

namespace OpenCompany\Integrations\GoogleKeep;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

/**
 * Tool catalog and configuration metadata for Google Keep.
 *
 * Exposes generated coverage for the official Keep v1 Discovery document,
 * including notes, note permissions, and media downloads.
 */
class GoogleKeepToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'oauth2_manual_token', 'legacy_auth_type' => 'oauth', 'credential_mode' => 'stored_token', 'setup_flows' => ['manual_token'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => ['access_token'], 'notes' => ['Requires a Google OAuth access token with Google Keep scopes.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_token', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string { return 'google-keep'; }
    public function appMeta(): array { return ['label' => 'Google Keep', 'description' => 'Notes, permissions, sharing, and attachment media downloads', 'icon' => 'ph:note-pencil', 'logo' => 'logos:google-keep']; }
    public function integrationMeta(): array { return ['name' => 'Google Keep', 'description' => 'Generated coverage for the Google Keep v1 REST API: notes, note permissions, and attachment media downloads.', 'icon' => 'ph:note-pencil', 'logo' => 'logos:google-keep', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developers.google.com/workspace/keep/api/reference/rest']; }
    public function configSchema(): array { return [['key' => 'access_token', 'type' => 'secret', 'label' => 'Access Token', 'placeholder' => 'Google OAuth access token', 'hint' => 'Use a Google OAuth 2.0 token with Keep or Keep readonly scopes.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://keep.googleapis.com', 'hint' => 'Override only for a proxy or compatible endpoint.', 'default' => 'https://keep.googleapis.com']]; }

    /**
     * Verify Google Keep credentials with a lightweight notes list call.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $accessToken = (string) ($config['access_token'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://keep.googleapis.com'), '/');
        if ($accessToken === '') return ['success' => false, 'error' => 'No access token provided.'];
        try {
            $response = Http::withHeaders(['Authorization' => 'Bearer '.$accessToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl.'/v1/notes', ['pageSize' => 1]);
            if (!$response->successful()) return ['success' => false, 'error' => 'Google Keep API returned HTTP '.$response->status().'.'];
            return ['success' => true, 'message' => "Connected to Google Keep at {$baseUrl}."];
        } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; }
    }

    public function validationRules(): array { return ['access_token' => 'nullable|string', 'url' => 'nullable|url']; }

    public function tools(): array
    {
        return [
            'google_keep_notes_get' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesGet',
  'type' => 'read',
  'name' => 'Notes Get',
  'description' => 'Notes Get (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
            'google_keep_notes_list' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesList',
  'type' => 'read',
  'name' => 'Notes List',
  'description' => 'Notes List (GET /v1/notes).',
  'icon' => 'ph:magnifying-glass',
),
            'google_keep_notes_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesDelete',
  'type' => 'write',
  'name' => 'Notes Delete',
  'description' => 'Notes Delete (DELETE /v1/{+name}).',
  'icon' => 'ph:note-pencil',
),
            'google_keep_notes_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesCreate',
  'type' => 'write',
  'name' => 'Notes Create',
  'description' => 'Notes Create (POST /v1/notes).',
  'icon' => 'ph:note-pencil',
),
            'google_keep_notes_permissions_batch_delete' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesPermissionsBatchDelete',
  'type' => 'write',
  'name' => 'Notes Permissions Batch Delete',
  'description' => 'Notes Permissions Batch Delete (POST /v1/{+parent}/permissions:batchDelete).',
  'icon' => 'ph:note-pencil',
),
            'google_keep_notes_permissions_batch_create' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepNotesPermissionsBatchCreate',
  'type' => 'write',
  'name' => 'Notes Permissions Batch Create',
  'description' => 'Notes Permissions Batch Create (POST /v1/{+parent}/permissions:batchCreate).',
  'icon' => 'ph:note-pencil',
),
            'google_keep_media_download' => array (
  'class' => '\\OpenCompany\\Integrations\\GoogleKeep\\Tools\\GoogleKeepMediaDownload',
  'type' => 'read',
  'name' => 'Media Download',
  'description' => 'Media Download (GET /v1/{+name}).',
  'icon' => 'ph:magnifying-glass',
),
        ];
    }

    public function credentialFields(): array { return $this->configSchema(); }
    public function isIntegration(): bool { return true; }

    /**
     * Create a Google Keep tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional account context.
     */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }

    /**
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): GoogleKeepService
    {
        $account = $context['account'] ?? null;
        if ($account !== null) {
            $creds = app(CredentialResolver::class);
            return new GoogleKeepService(accessToken: $creds->get('google-keep', 'access_token', '', $account), baseUrl: $creds->get('google-keep', 'url', 'https://keep.googleapis.com', $account));
        }
        return app(GoogleKeepService::class);
    }

    public function luaDocsPath(): ?string { return __DIR__ . '/../lua-docs/google-keep.md'; }
}