<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\PostHog;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\PostHog\Tools\PostHogCaptureEvent;

/**
 * Tool catalog and setup metadata for the PostHog integration.
 *
 * Exposes generated tools from PostHog's official OpenAPI schema and resolves
 * account-specific credentials for host applications.
 */
class PostHogToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    private const RAW_TOOLS = ['posthog_capture_event' => [PostHogCaptureEvent::class, 'write', 'Capture Event', 'Send one event through PostHog ingestion API.', 'ph:lightning']];

    /** @return array<string, mixed> */
    public function integrationCapabilities(): array { return ['auth' => ['strategy' => 'api_token', 'legacy_auth_type' => 'api_token', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Private API requests use Authorization: Bearer <api_token>. Event ingestion can use project_api_key.']], 'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']], 'runtime_requirements' => [], 'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true]]; }
    public function appName(): string { return 'posthog'; }
    public function appMeta(): array { return ['label' => 'PostHog', 'description' => 'Product analytics, feature flags, replay, warehouse, experiments, surveys, logs, and LLM analytics', 'icon' => 'ph:chart-bar', 'logo' => 'simple-icons:posthog']; }
    public function integrationMeta(): array { return ['name' => 'PostHog', 'description' => 'Manage PostHog analytics, feature flags, dashboards, insights, cohorts, persons, replay, warehouse, experiments, surveys, logs, LLM analytics, and organization resources through the official API.', 'icon' => 'ph:chart-bar', 'logo' => 'simple-icons:posthog', 'category' => 'analytics', 'badge' => 'verified', 'docs_url' => 'https://posthog.com/docs/api', 'source_url' => 'https://us.posthog.com/api/schema/']; }
    public function configSchema(): array { return [['key' => 'api_token', 'type' => 'secret', 'label' => 'Personal API Token', 'placeholder' => 'phx_...', 'hint' => 'Personal API token for private PostHog API endpoints.', 'required' => true], ['key' => 'url', 'type' => 'url', 'label' => 'PostHog URL', 'placeholder' => 'https://us.posthog.com', 'default' => 'https://us.posthog.com', 'required' => false], ['key' => 'project_id', 'type' => 'text', 'label' => 'Default Project ID', 'required' => false], ['key' => 'environment_id', 'type' => 'text', 'label' => 'Default Environment ID', 'required' => false], ['key' => 'project_api_key', 'type' => 'secret', 'label' => 'Project API Key', 'hint' => 'Optional key for event ingestion through posthog_capture_event.', 'required' => false]]; }

    /** @param  array<string, mixed>  $config  Credential and endpoint settings. @return array{success: bool, message?: string, error?: string} */
    public function testConnection(array $config): array { $apiToken = (string) ($config['api_token'] ?? ''); $baseUrl = rtrim((string) ($config['url'] ?? 'https://us.posthog.com'), '/'); if ($apiToken === '') return ['success' => false, 'error' => 'PostHog API token is not configured.']; try { $response = Http::withHeaders(['Authorization' => 'Bearer ' . $apiToken, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/api/users/', ['limit' => 1]); if (!$response->successful()) return ['success' => false, 'error' => 'PostHog API returned HTTP ' . $response->status() . '.']; return ['success' => true, 'message' => 'Connected to PostHog.']; } catch (\Throwable $e) { return ['success' => false, 'error' => $e->getMessage()]; } }
    /** @return array<string, string> */
    public function validationRules(): array { return ['api_token' => 'nullable|string', 'url' => 'nullable|url', 'project_id' => 'nullable|string', 'environment_id' => 'nullable|string', 'project_api_key' => 'nullable|string']; }
    /** @return array<int, array<string, mixed>> */
    public function credentialFields(): array { return $this->configSchema(); }

    /** @return array<string, array<string, mixed>> */
    public function tools(): array
    {
        $tools = [];
        foreach (self::RAW_TOOLS as $slug => $definition) { [$class, $type, $name, $description, $icon] = $definition; $tools[$slug] = ['class' => $class, 'type' => $type, 'name' => $name, 'description' => $description, 'icon' => $icon]; }
        foreach (PostHogService::operations() as $slug => $operation) $tools[$slug] = ['class' => __NAMESPACE__ . '\\Tools\\' . $operation['class'], 'type' => $operation['type'] ?? 'read', 'name' => $operation['name'] ?? $slug, 'description' => $operation['description'] ?? '', 'icon' => $this->iconFor($operation)];
        return $tools;
    }
    public function scriptDocsPath(): ?string { return __DIR__ . '/../script-docs/posthog.md'; }
    public function isIntegration(): bool { return true; }
    /** @param  class-string<Tool>  $class  Tool class to instantiate. @param  array<string, mixed>  $context  Optional context containing an account key. */
    public function createTool(string $class, array $context = []): Tool { return new $class($this->resolveService($context)); }
    /** @param  array<string, mixed>  $context  Tool creation context. */
    private function resolveService(array $context = []): PostHogService { $account = $context['account'] ?? null; if ($account !== null) { $creds = app(CredentialResolver::class); return new PostHogService(apiToken: (string) $creds->get('posthog', 'api_token', '', (string) $account), baseUrl: (string) $creds->get('posthog', 'url', 'https://us.posthog.com', (string) $account), projectId: (string) $creds->get('posthog', 'project_id', '', (string) $account), environmentId: (string) $creds->get('posthog', 'environment_id', '', (string) $account), projectApiKey: (string) $creds->get('posthog', 'project_api_key', '', (string) $account)); } return app(PostHogService::class); }
    /** @param  array<string, mixed>  $operation  Operation metadata. */
    private function iconFor(array $operation): string { $tags = implode(' ', $operation['tags'] ?? []); $path = (string) ($operation['path'] ?? ''); return match (true) { str_contains($tags, 'feature_flags') => 'ph:flag', str_contains($tags, 'dashboards') => 'ph:squares-four', str_contains($tags, 'insights') => 'ph:chart-line', str_contains($tags, 'persons') => 'ph:users-three', str_contains($tags, 'cohorts') => 'ph:users', str_contains($tags, 'experiments') => 'ph:flask', str_contains($tags, 'surveys') => 'ph:clipboard-text', str_contains($tags, 'session_record') || str_contains($tags, 'replay') => 'ph:video', str_contains($tags, 'data_warehouse') => 'ph:database', str_contains($tags, 'logs') => 'ph:list-magnifying-glass', str_contains($path, '/users') => 'ph:user', default => ($operation['type'] ?? 'read') === 'read' ? 'ph:list' : 'ph:pencil-simple', }; }
}
