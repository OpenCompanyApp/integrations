<?php

namespace OpenCompany\Integrations\TrustMrr;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrGetStartup;
use OpenCompany\Integrations\TrustMrr\Tools\TrustMrrListStartups;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class TrustMrrToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
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
        return 'trustmrr';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'TrustMRR',
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
    }    public function configSchema(): array
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
    }    public function credentialFields(): array
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
