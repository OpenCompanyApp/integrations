<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Adyen;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Adyen\AdyenService;
use OpenCompany\Integrations\Adyen\AdyenToolProvider;
use OpenCompany\Integrations\Adyen\Tools\AdyenCheckoutGetPaymentLinksLinkId;
use OpenCompany\Integrations\Adyen\Tools\AdyenCheckoutPostPayments;
use OpenCompany\Integrations\Adyen\Tools\AdyenManagementGetCompaniesCompanyIdUsers;
use OpenCompany\Integrations\Adyen\Tools\AdyenManagementGetStores;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Adyen official OpenAPI operation coverage.
 */
final class AdyenServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AdyenService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AdyenService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new AdyenToolProvider;
        $tools = $provider->tools();

        self::assertSame('adyen', $provider->appName());
        self::assertSame('Adyen', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://github.com/Adyen/adyen-openapi', $provider->integrationMeta()['source_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(162, $tools);
        self::assertCount(3, $provider->credentialFields());
        self::assertCount(5, $provider->configSchema());
        self::assertArrayHasKey('adyen_checkout_post_payments', $tools);
        self::assertArrayHasKey('adyen_checkout_get_payment_links_link_id', $tools);
        self::assertArrayHasKey('adyen_management_get_merchants_merchant_id_stores', $tools);
        self::assertArrayHasKey('adyen_management_post_merchants_merchant_id_webhooks', $tools);
        self::assertArrayNotHasKey('adyen_get_transaction', $tools);
        self::assertArrayNotHasKey('adyen_list_transactions', $tools);
    }

    public function test_service_maps_checkout_and_management_operations(): void
    {
        $service = new AdyenService(
            apiKey: 'test-key',
            merchantAccount: 'MerchantECOM',
            baseUrl: 'https://checkout.example.test',
            managementUrl: 'https://management.example.test',
            companyId: 'Company123',
        );

        Http::fake(['*' => Http::response(['resultCode' => 'Authorised'], 200)]);
        self::assertTrue((new AdyenCheckoutPostPayments($service))->execute([
            'body' => [
                'amount' => ['value' => 2500, 'currency' => 'EUR'],
                'paymentMethod' => ['type' => 'scheme'],
                'reference' => 'ORDER-123',
                'returnUrl' => 'https://example.test/return',
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://checkout.example.test/v72/payments'
            && $request->hasHeader('X-API-Key', 'test-key')
            && $request['merchantAccount'] === 'MerchantECOM'
            && $request['paymentMethod']['type'] === 'scheme');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'PL123'], 200)]);
        self::assertTrue((new AdyenCheckoutGetPaymentLinksLinkId($service))->execute(['link_id' => 'PL123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://checkout.example.test/v72/paymentLinks/PL123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'store_123']]], 200)]);
        self::assertTrue((new AdyenManagementGetStores($service))->execute(['page_size' => 20])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://management.example.test/v3/stores?')
            && str_contains($request->url(), 'merchantId=MerchantECOM')
            && str_contains($request->url(), 'pageSize=20'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'user_123']]], 200)]);
        self::assertTrue((new AdyenManagementGetCompaniesCompanyIdUsers($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://management.example.test/v3/companies/Company123/users');
    }

    public function test_validation_errors_test_connection_and_multi_account(): void
    {
        $service = new AdyenService(
            apiKey: 'test-key',
            merchantAccount: 'MerchantECOM',
            baseUrl: 'https://checkout.example.test',
            managementUrl: 'https://management.example.test',
        );

        $missingBody = (new AdyenCheckoutPostPayments($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body is required', (string) $missingBody->error);

        $missingCompany = (new AdyenManagementGetCompaniesCompanyIdUsers($service))->execute([]);
        self::assertFalse($missingCompany->succeeded());
        self::assertStringContainsString('company_id is required', (string) $missingCompany->error);

        $unconfigured = (new AdyenCheckoutPostPayments(new AdyenService))->execute(['body' => []]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid API key'], 401)]);
        $apiError = (new AdyenManagementGetStores($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['paymentMethods' => []], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to Adyen API.'],
            (new AdyenToolProvider)->testConnection([
                'api_key' => 'test-key',
                'merchant_account' => 'MerchantECOM',
                'url' => 'https://checkout.example.test',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://checkout.example.test/v72/paymentMethods'
            && $request->hasHeader('X-API-Key', 'test-key'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'api_credential'], 200)]);
        self::assertSame(
            ['success' => true, 'message' => 'Connected to Adyen API.'],
            (new AdyenToolProvider)->testConnection([
                'api_key' => 'test-key',
                'management_url' => 'https://management.example.test',
            ]),
        );
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://management.example.test/v3/me');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['adyen', 'api_key', 'merchant'] => 'account-key',
                    ['adyen', 'merchant_account', 'merchant'] => 'AccountMerchant',
                    ['adyen', 'company_id', 'merchant'] => 'AccountCompany',
                    ['adyen', 'url', 'merchant'] => 'https://account-checkout.example.test',
                    ['adyen', 'management_url', 'merchant'] => 'https://account-management.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'adyen' && $account === 'merchant';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'adyen' ? ['merchant'] : [];
            }
        });

        $tool = (new AdyenToolProvider)->createTool(AdyenManagementGetStores::class, ['account' => 'merchant']);
        self::assertTrue($tool->execute(['page_size' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://account-management.example.test/v3/stores?')
            && $request->hasHeader('X-API-Key', 'account-key')
            && str_contains($request->url(), 'merchantId=AccountMerchant')
            && str_contains($request->url(), 'pageSize=5'));
    }
}
