<?php

namespace OpenCompany\Integrations\Helicone;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Helicone\Tools\HeliconeGatewayChatCompletions;
use OpenCompany\Integrations\Helicone\Tools\HeliconeGatewayResponses;
use OpenCompany\Integrations\Helicone\Tools\HeliconeGetRequest;
use OpenCompany\Integrations\Helicone\Tools\HeliconeListGatewayModels;
use OpenCompany\Integrations\Helicone\Tools\HeliconeQueryRequests;
use OpenCompany\Integrations\Helicone\Tools\HeliconeQueryRequestsByIds;
use OpenCompany\Integrations\Helicone\Tools\HeliconeQueryUserMetrics;
use OpenCompany\Integrations\Helicone\Tools\HeliconeQueryUserMetricsOverview;
use OpenCompany\Integrations\Helicone\Tools\HeliconeSubmitFeedback;

/**
 * Tool catalog and configuration metadata for Helicone.
 *
 * Exposes Helicone request analytics, feedback, user metrics, and AI Gateway
 * operations with account-specific credential resolution.
 */
class HeliconeToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
                'token_keys' => [],
                'notes' => ['Uses Authorization: Bearer <HELICONE_API_KEY>.'],
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
        return 'helicone';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'Helicone',
            'description' => 'LLM observability, request analytics, feedback, and AI Gateway',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:helicone',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Helicone',
            'description' => 'Helicone request analytics, request lookup, user feedback, user metrics, and OpenAI-compatible AI Gateway calls.',
            'icon' => 'ph:chart-line',
            'logo' => 'simple-icons:helicone',
            'category' => 'analytics',
            'badge' => 'verified',
            'docs_url' => 'https://docs.helicone.ai/references/api',
        ];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'placeholder' => 'Helicone API key', 'hint' => 'Create an API key in Helicone.', 'required' => true],
            ['key' => 'api_url', 'type' => 'url', 'label' => 'Observability API URL', 'placeholder' => 'https://api.helicone.ai', 'hint' => 'Use https://eu.api.helicone.ai for EU projects.', 'default' => 'https://api.helicone.ai'],
            ['key' => 'gateway_url', 'type' => 'url', 'label' => 'AI Gateway URL', 'placeholder' => 'https://ai-gateway.helicone.ai', 'hint' => 'OpenAI-compatible Helicone AI Gateway base URL.', 'default' => 'https://ai-gateway.helicone.ai'],
        ];
    }

    /**
     * Verify Helicone credentials with the gateway model list endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $gatewayUrl = rtrim((string) ($config['gateway_url'] ?? 'https://ai-gateway.helicone.ai'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get($gatewayUrl . '/v1/models');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Helicone API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => "Connected to Helicone AI Gateway at {$gatewayUrl}."];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'api_url' => 'nullable|url',
            'gateway_url' => 'nullable|url',
        ];
    }

    public function tools(): array
    {
        return [
            'helicone_query_requests' => ['class' => HeliconeQueryRequests::class, 'type' => 'read', 'name' => 'Query Requests', 'description' => 'Query Helicone request analytics with the ClickHouse endpoint.', 'icon' => 'ph:magnifying-glass'],
            'helicone_query_requests_by_ids' => ['class' => HeliconeQueryRequestsByIds::class, 'type' => 'read', 'name' => 'Query Requests By IDs', 'description' => 'Fetch request rows by explicit Helicone request IDs.', 'icon' => 'ph:list-magnifying-glass'],
            'helicone_get_request' => ['class' => HeliconeGetRequest::class, 'type' => 'read', 'name' => 'Get Request', 'description' => 'Retrieve a single Helicone request by ID.', 'icon' => 'ph:file-search'],
            'helicone_submit_feedback' => ['class' => HeliconeSubmitFeedback::class, 'type' => 'write', 'name' => 'Submit Feedback', 'description' => 'Submit positive or negative user feedback for a request.', 'icon' => 'ph:thumbs-up'],
            'helicone_query_user_metrics' => ['class' => HeliconeQueryUserMetrics::class, 'type' => 'read', 'name' => 'Query User Metrics', 'description' => 'Query Helicone user metrics.', 'icon' => 'ph:users'],
            'helicone_query_user_metrics_overview' => ['class' => HeliconeQueryUserMetricsOverview::class, 'type' => 'read', 'name' => 'Query User Metrics Overview', 'description' => 'Query Helicone user metrics overview.', 'icon' => 'ph:chart-pie'],
            'helicone_list_gateway_models' => ['class' => HeliconeListGatewayModels::class, 'type' => 'read', 'name' => 'List Gateway Models', 'description' => 'List AI Gateway models.', 'icon' => 'ph:list'],
            'helicone_gateway_chat_completions' => ['class' => HeliconeGatewayChatCompletions::class, 'type' => 'write', 'name' => 'Gateway Chat Completions', 'description' => 'Create an OpenAI-compatible AI Gateway chat completion.', 'icon' => 'ph:chat-circle-text'],
            'helicone_gateway_responses' => ['class' => HeliconeGatewayResponses::class, 'type' => 'write', 'name' => 'Gateway Responses', 'description' => 'Create an OpenAI-compatible AI Gateway Responses API response.', 'icon' => 'ph:sparkle'],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/helicone.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_url', 'type' => 'url', 'label' => 'Observability API URL', 'required' => false, 'default' => 'https://api.helicone.ai'],
            ['key' => 'gateway_url', 'type' => 'url', 'label' => 'AI Gateway URL', 'required' => false, 'default' => 'https://ai-gateway.helicone.ai'],
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
     * Resolve a service for the default or named account.
     *
     * @param  array<string, mixed>  $context  Tool creation context.
     */
    private function resolveService(array $context = []): HeliconeService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new HeliconeService(
                apiKey: $creds->get('helicone', 'api_key', '', $account),
                apiUrl: $creds->get('helicone', 'api_url', 'https://api.helicone.ai', $account),
                gatewayUrl: $creds->get('helicone', 'gateway_url', 'https://ai-gateway.helicone.ai', $account),
            );
        }

        return app(HeliconeService::class);
    }
}
