<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleAds;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\GoogleAds\GoogleAdsService;
use OpenCompany\Integrations\GoogleAds\GoogleAdsToolProvider;
use OpenCompany\Integrations\GoogleAds\Support\GoogleAdsIdentifierHasher;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateSearchCampaign;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsCreateBatchJob;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsListAccessibleCustomers;
use OpenCompany\Integrations\GoogleAds\Tools\GoogleAdsSearch;
use PHPUnit\Framework\TestCase;

final class GoogleAdsServiceTest extends TestCase
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

    public function test_provider_registers_every_declared_tool_file_and_docs(): void
    {
        $provider = new GoogleAdsToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-ads/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame('google-ads', $provider->appName());
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_with_developer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['setup_supported']);
    }

    public function test_search_sets_google_ads_headers_and_page_size(): void
    {
        Http::fake([
            'https://googleads.googleapis.com/v24/customers/1234567890/googleAds:search' => Http::response(['results' => []], 200, ['request-id' => 'req-1']),
        ]);

        $tool = new GoogleAdsSearch(new GoogleAdsService(
            accessToken: 'access-token',
            developerToken: 'developer-token',
            managerCustomerId: '999-888-7777',
            defaultCustomerId: '123-456-7890',
        ));

        $result = $tool->execute([
            'query' => 'SELECT campaign.id FROM campaign LIMIT 1',
            'page_size' => 50,
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://googleads.googleapis.com/v24/customers/1234567890/googleAds:search'
                && $request->hasHeader('developer-token', 'developer-token')
                && $request->hasHeader('login-customer-id', '9998887777')
                && $request->data()['pageSize'] === 50;
        });
    }

    public function test_refresh_token_only_cli_credentials_are_configured_and_refresh_before_request(): void
    {
        Http::fake([
            'https://oauth2.googleapis.com/token' => Http::response([
                'access_token' => 'fresh-token',
                'expires_in' => 3600,
            ], 200),
            'https://googleads.googleapis.com/v24/customers:listAccessibleCustomers' => Http::response([
                'resourceNames' => ['customers/1234567890'],
            ], 200),
        ]);

        $service = new GoogleAdsService(
            clientId: 'client-id',
            clientSecret: 'client-secret',
            refreshToken: 'refresh-token',
            developerToken: 'developer-token',
        );

        self::assertTrue($service->isConfigured());
        $result = $service->listAccessibleCustomers();

        self::assertSame(['customers/1234567890'], $result['resourceNames']);
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://googleads.googleapis.com/v24/customers:listAccessibleCustomers'
                && $request->hasHeader('Authorization', 'Bearer fresh-token');
        });
    }

    public function test_live_campaign_creation_requires_confirmation(): void
    {
        $tool = new GoogleAdsCreateSearchCampaign(new GoogleAdsService(
            accessToken: 'access-token',
            developerToken: 'developer-token',
            defaultCustomerId: '1234567890',
        ));

        $result = $tool->execute([
            'spec' => ['name' => 'Example', 'daily_budget' => 10],
        ]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('confirm_execute=true is required', (string) $result->error);
    }

    public function test_batch_job_first_add_operations_omits_sequence_token(): void
    {
        Http::fake([
            'https://googleads.googleapis.com/v24/customers/1234567890/batchJobs:mutate' => Http::response([
                'results' => [['resourceName' => 'customers/1234567890/batchJobs/1']],
            ], 200),
            'https://googleads.googleapis.com/v24/customers/1234567890/batchJobs/1:addOperations' => Http::response([
                'nextSequenceToken' => 'token-2',
            ], 200),
        ]);

        $tool = new GoogleAdsCreateBatchJob(new GoogleAdsService(
            accessToken: 'access-token',
            developerToken: 'developer-token',
            defaultCustomerId: '1234567890',
        ));
        $result = $tool->execute([
            'confirm_execute' => true,
            'operations' => [['campaignOperation' => ['create' => ['name' => 'Example']]]],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://googleads.googleapis.com/v24/customers/1234567890/batchJobs/1:addOperations'
                && ! array_key_exists('sequenceToken', $request->data())
                && count($request->data()['mutateOperations']) === 1;
        });
    }

    public function test_customer_match_hashing_normalizes_identifiers(): void
    {
        self::assertSame(hash('sha256', 'person@example.test'), GoogleAdsIdentifierHasher::hashEmail(' Person@Example.Test '));
        self::assertSame(hash('sha256', '+15550101010'), GoogleAdsIdentifierHasher::hashPhone(' +1 (555) 010-1010 '));
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://googleads.googleapis.com/v24/customers:listAccessibleCustomers' => Http::response([
                'resourceNames' => ['customers/1234567890'],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'google-ads') {
                    return '';
                }

                if ($integration === 'google_ads' && $account === 'ads') {
                    return match ($key) {
                        'access_token' => 'legacy-access-token',
                        'developer_token' => 'legacy-developer-token',
                        'manager_customer_id' => '999-888-7777',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'google_ads' && $account === 'ads';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'google_ads' ? ['ads'] : [];
            }
        });

        $tool = (new GoogleAdsToolProvider)->createTool(GoogleAdsListAccessibleCustomers::class, ['account' => 'ads']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://googleads.googleapis.com/v24/customers:listAccessibleCustomers'
            && $request->hasHeader('Authorization', 'Bearer legacy-access-token')
            && $request->hasHeader('developer-token', 'legacy-developer-token'));
    }
}
