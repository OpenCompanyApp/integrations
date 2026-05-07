<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\WpEngine;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\WpEngine\Tools\WpEngineGetCurrentUser;
use OpenCompany\Integrations\WpEngine\WpEngineService;
use OpenCompany\Integrations\WpEngine\WpEngineToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for WP Engine package metadata and API mapping.
 */
final class WpEngineServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_uses_canonical_package_namespace_and_docs(): void
    {
        $provider = new WpEngineToolProvider;

        self::assertSame('wp-engine', $provider->appName());
        self::assertSame('WP Engine', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(7, $provider->tools());
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_list_sites_to_wp_engine_api(): void
    {
        Http::fake([
            'https://api.example.test/v1/sites*' => Http::response(['sites' => [['id' => 'site-1']]], 200),
        ]);

        $result = (new WpEngineService('token-test', 'https://api.example.test/v1'))->listSites(10, 2);

        self::assertSame('site-1', $result['sites'][0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://api.example.test/v1/sites?')
                && $query === ['limit' => '10', 'page' => '2']
                && $request->hasHeader('Authorization', 'Bearer token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-wpengine.example.test/v1/user' => Http::response(['email' => 'person@example.test'], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'wp-engine') {
                    return '';
                }

                if ($integration === 'wp_engine' && $account === 'production') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        'url' => 'https://legacy-wpengine.example.test/v1',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'wp_engine' && $account === 'production';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'wp_engine' ? ['production'] : [];
            }
        });

        $tool = (new WpEngineToolProvider)->createTool(WpEngineGetCurrentUser::class, ['account' => 'production']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('person@example.test', $result->data['email']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy-wpengine.example.test/v1/user'
            && $request->hasHeader('Authorization', 'Bearer legacy-token'));
    }
}
