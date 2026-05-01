<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\X;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Support\OAuth1Signer;
use OpenCompany\Integrations\X\Tools\XGetUsersByUsername;
use OpenCompany\Integrations\X\XService;
use OpenCompany\Integrations\X\XToolProvider;
use OpenCompany\Integrations\XAds\Tools\XAdsGetAccounts;
use OpenCompany\Integrations\XAds\XAdsService;
use OpenCompany\Integrations\XAds\XAdsToolProvider;
use PHPUnit\Framework\TestCase;

final class XIntegrationTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_generated_x_provider_covers_current_openapi_operation_count(): void
    {
        self::assertCount(162, (new XToolProvider)->tools());
    }

    public function test_generated_x_ads_provider_covers_official_postman_operation_count(): void
    {
        self::assertCount(190, (new XAdsToolProvider)->tools());
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
}
