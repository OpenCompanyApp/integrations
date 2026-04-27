<?php

namespace OpenCompany\Integrations\CoinGecko;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoGlobal;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoHistory;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoInfo;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoMarkets;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoOhlc;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoPrice;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoSearchCoins;
use OpenCompany\Integrations\CoinGecko\Tools\CoinGeckoTrending;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
class CoinGeckoToolProvider implements ConfigurableIntegration, ToolProvider, HasIntegrationCapabilities
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
        return 'coingecko';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'crypto, bitcoin, ethereum, prices, market data, coins, tokens',
            'description' => 'Cryptocurrency market data',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'CoinGecko',
            'description' => 'Cryptocurrency prices, market data, trending coins, and historical charts',
            'icon' => 'ph:coin',
            'logo' => 'ph:coin',
            'category' => 'finance',
            'badge' => 'verified',
            'docs_url' => 'https://docs.coingecko.com',
        ];
    }    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'Demo API Key',
                'placeholder' => 'CG-...',
                'hint' => 'Free key from <a href="https://www.coingecko.com/en/api/pricing" target="_blank">CoinGecko Developer Dashboard</a>. 30 calls/min, 10k calls/month.',
                'required' => false,
            ],
        ];
    }

    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';

        try {
            $headers = $apiKey !== ''
                ? ['x-cg-demo-api-key' => $apiKey]
                : [];

            $response = Http::withHeaders($headers)->timeout(10)->get('https://api.coingecko.com/api/v3/simple/price', [
                'ids' => 'bitcoin',
                'vs_currencies' => 'usd',
            ]);

            if ($response->successful()) {
                $price = $response->json('bitcoin.usd');

                return [
                    'success' => true,
                    'message' => $price
                        ? ($apiKey !== '' ? "Connected to CoinGecko. BTC = \${$price}" : "Connected to CoinGecko without API key. BTC = \${$price}")
                        : ($apiKey !== '' ? 'Connected to CoinGecko.' : 'Connected to CoinGecko without API key.'),
                ];
            }

            $error = $response->json('status.error_message') ?? $response->body();

            return [
                'success' => false,
                'error' => 'CoinGecko API error ('.$response->status().'): '.(is_string($error) ? $error : json_encode($error)),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => false, 'placeholder' => 'Optional — increases rate limits'],
        ];
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new CoinGeckoService(
                apiKey: $creds->get('coingecko', 'api_key', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(CoinGeckoService::class));
    }
}
