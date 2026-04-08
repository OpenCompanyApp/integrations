<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrGetStartup;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrListStartups;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

class TrustMrrToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'trustmrr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'startups, revenue, MRR, acquisitions',
            'description' => 'Verified startup revenue data',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'TrustMRR',
            'description' => 'Verified startup revenue data and acquisition deals',
            'icon' => 'ph:chart-line-up',
            'logo' => 'ph:chart-line-up',
            'category' => 'data',
            'docs_url' => 'https://trustmrr.com/docs',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'tmrr_...',
                'hint' => 'Generate at <a href="https://trustmrr.com/dashboard/developer" target="_blank">TrustMRR Developer Dashboard</a>. Keys start with <code>tmrr_</code>.',
                'required' => true,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided.'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://trustmrr.com/api/v1/startups', ['limit' => 1]);

            if ($response->successful()) {
                $meta = $response->json('meta') ?? [];
                $total = $meta['total'] ?? 0;

                return [
                    'success' => true,
                    'message' => "Connected to TrustMRR. {$total} startups available.",
                ];
            }

            $error = $response->json('error') ?? $response->body();

            return [
                'success' => false,
                'error' => 'TrustMRR API error (' . $response->status() . '): ' . (is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string|array<int, string>> */
    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            'trustmrr_list_startups' => [
                'class' => TrustMrrListStartups::class,
                'type' => 'read',
                'name' => 'List Startups',
                'description' => 'Browse and filter startups by revenue, MRR, growth, category, and sale status.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'trustmrr_get_startup' => [
                'class' => TrustMrrGetStartup::class,
                'type' => 'read',
                'name' => 'Get Startup',
                'description' => 'Get full details for a startup including tech stack, cofounders, and extended metrics.',
                'icon' => 'ph:info',
            ],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function luaDocsPath(): ?string
    {
        return dirname(__DIR__) . '/lua-docs/trustmrr.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            $service = new TrustMrrService(
                apiKey: $creds->get('trustmrr', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(TrustMrrService::class));
    }
}
