<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\X;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;
use OpenCompany\Integrations\Twitter\TwitterToolProvider as LegacyTwitterToolProvider;
use OpenCompany\Integrations\X\Tools\XGetUsersByUsername;
use OpenCompany\Integrations\X\XService;
use OpenCompany\Integrations\X\XToolProvider;
use OpenCompany\Integrations\XAds\Tools\XAdsGetAccounts;
use OpenCompany\Integrations\XAds\XAdsService;
use OpenCompany\Integrations\XAds\XAdsToolProvider;
use PHPUnit\Framework\TestCase;

final class XIntegrationTest extends TestCase
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

    public function test_generated_x_provider_covers_current_openapi_operation_count(): void
    {
        self::assertCount(162, (new XToolProvider)->tools());
    }

    public function test_generated_x_ads_provider_covers_official_postman_operation_count(): void
    {
        $provider = new XAdsToolProvider;

        self::assertSame('x-ads', $provider->appName());
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertCount(190, $provider->tools());
    }

    public function test_generated_provider_classes_are_autoloadable(): void
    {
        self::assertTrue(class_exists(XToolProvider::class));
        self::assertTrue(class_exists(XAdsToolProvider::class));
    }

    public function test_x_generated_tool_maps_path_and_bearer_auth(): void
    {
        Http::fake([
            'https://api.x.com/2/users/by/username/XDevelopers*' => Http::response(['data' => ['username' => 'XDevelopers']], 200),
        ]);

        $tool = new XGetUsersByUsername(new XService(bearerToken: 'bearer-token'));
        $result = $tool->execute(['username' => 'XDevelopers']);

        self::assertTrue($result->succeeded());
        self::assertSame('XDevelopers', $result->data['data']['username']);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.x.com/2/users/by/username/XDevelopers'
                && $request->header('Authorization')[0] === 'Bearer bearer-token';
        });
    }

    public function test_oauth1_signer_matches_rfc5849_example(): void
    {
        $signature = OAuth1Signer::signature(
            method: 'GET',
            url: 'http://photos.example.net/photos',
            params: [
                'file' => 'vacation.jpg',
                'size' => 'original',
                'oauth_consumer_key' => 'dpf43f3p2l4k3l03',
                'oauth_token' => 'nnch734d00sl2jdk',
                'oauth_nonce' => 'kllo9940pd9333jh',
                'oauth_timestamp' => '1191242096',
                'oauth_signature_method' => 'HMAC-SHA1',
                'oauth_version' => '1.0',
            ],
            consumerSecret: 'kd94hf93k423kf44',
            tokenSecret: 'pfkkdhi9sl3r4s00',
        );

        self::assertSame('tR3+Ty81lMeYAr/Fid0kMTYa/WM=', $signature);
    }

    public function test_x_ads_generated_tool_signs_oauth1_request(): void
    {
        Http::fake([
            'https://ads-api.x.com/12/accounts*' => Http::response(['data' => []], 200),
        ]);

        $tool = new XAdsGetAccounts(new XAdsService(
            apiKey: 'key',
            apiSecret: 'secret',
            accessToken: 'token',
            accessTokenSecret: 'token-secret',
        ));
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static function (Request $request): bool {
            $authorization = $request->header('Authorization')[0] ?? '';

            return $request->method() === 'GET'
                && $request->url() === 'https://ads-api.x.com/12/accounts'
                && str_starts_with($authorization, 'OAuth ')
                && str_contains($authorization, 'oauth_consumer_key="key"')
                && str_contains($authorization, 'oauth_token="token"')
                && str_contains($authorization, 'oauth_signature=');
        });
    }

    public function test_x_ads_provider_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://legacy-ads.example.test/12/accounts*' => Http::response(['data' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'x-ads') {
                    return '';
                }

                if ($integration === 'x_ads' && $account === 'ads') {
                    return match ($key) {
                        'api_key' => 'legacy-key',
                        'api_secret' => 'legacy-secret',
                        'access_token' => 'legacy-token',
                        'access_token_secret' => 'legacy-token-secret',
                        'base_url' => 'https://legacy-ads.example.test',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'x_ads' && $account === 'ads';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'x_ads' ? ['ads'] : [];
            }
        });

        $tool = (new XAdsToolProvider)->createTool(XAdsGetAccounts::class, ['account' => 'ads']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static function (Request $request): bool {
            $authorization = $request->header('Authorization')[0] ?? '';

            return $request->method() === 'GET'
                && $request->url() === 'https://legacy-ads.example.test/12/accounts'
                && str_starts_with($authorization, 'OAuth ')
                && str_contains($authorization, 'oauth_consumer_key="legacy-key"')
                && str_contains($authorization, 'oauth_token="legacy-token"');
        });
    }

    public function test_legacy_twitter_package_aliases_canonical_provider_and_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/x/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/twitter/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-twitter']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-twitter']);
        self::assertSame('opencompanyapp/integration-x', $legacyComposer['abandoned']);

        $legacyProvider = new LegacyTwitterToolProvider;

        self::assertSame('x', $legacyProvider->appName());
        self::assertSame('Twitter / X', $legacyProvider->integrationMeta()['name']);
        self::assertCount(162, $legacyProvider->tools());

        Http::fake([
            'https://legacy.twitter.example.test/2/users/by/username/XDevelopers*' => Http::response(['data' => ['username' => 'XDevelopers']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'x') {
                    return '';
                }

                if ($integration === 'twitter' && $account === 'work') {
                    return match ($key) {
                        'access_token' => 'legacy-twitter-bearer',
                        'url' => 'https://legacy.twitter.example.test/2',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'twitter' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'twitter' ? ['work'] : [];
            }
        });

        $tool = (new XToolProvider)->createTool(XGetUsersByUsername::class, ['account' => 'work']);
        $result = $tool->execute(['username' => 'XDevelopers']);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.twitter.example.test/2/users/by/username/XDevelopers'
            && $request->hasHeader('Authorization', 'Bearer legacy-twitter-bearer'));
    }
}
