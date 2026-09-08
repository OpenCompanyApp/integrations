<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Flutterwave;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Flutterwave\FlutterwaveService;
use OpenCompany\Integrations\Flutterwave\FlutterwaveToolProvider;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveCreateCustomer;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveGetBanks;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveGetTransaction;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveInitiatePayment;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveListCustomers;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveListTransactions;
use OpenCompany\Integrations\Flutterwave\Tools\FlutterwaveVerifyTransaction;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Flutterwave integration.
 */
final class FlutterwaveServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FlutterwaveService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FlutterwaveService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new FlutterwaveToolProvider;

        self::assertSame('flutterwave', $provider->appName());
        self::assertSame('Flutterwave', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('secret_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://developer.flutterwave.com/v3.0/reference', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertContains('flutterwave_verify_transaction', array_keys($provider->tools()));
    }

    public function test_transaction_payment_customer_and_bank_routes_are_mapped(): void
    {
        $service = new FlutterwaveService(secretKey: 'test-secret', baseUrl: 'https://flutterwave.example.test/v3');

        Http::fake(['*' => Http::response(['status' => 'success', 'data' => []], 200)]);
        self::assertTrue((new FlutterwaveListTransactions($service))->execute([
            'page' => 2,
            'status' => 'successful',
            'from' => '2026-01-01',
            'to' => '2026-01-31',
            'customer_email' => 'ada@example.test',
            'tx_ref' => 'txn_123',
            'customer_fullname' => 'Ada Example',
            'currency' => 'NGN',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://flutterwave.example.test/v3/transactions?')
            && $request->hasHeader('Authorization', 'Bearer test-secret')
            && str_contains($request->url(), 'page=2')
            && str_contains($request->url(), 'status=successful')
            && str_contains($request->url(), 'from=2026-01-01')
            && str_contains($request->url(), 'to=2026-01-31')
            && str_contains($request->url(), 'customer_email=ada%40example.test')
            && str_contains($request->url(), 'tx_ref=txn_123')
            && str_contains($request->url(), 'customer_fullname=Ada%20Example')
            && str_contains($request->url(), 'currency=NGN'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => ['id' => 123456]], 200)]);
        self::assertTrue((new FlutterwaveGetTransaction($service))->execute(['id' => 123456])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/transactions/123456');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => ['id' => 123456, 'status' => 'successful']], 200)]);
        self::assertTrue((new FlutterwaveVerifyTransaction($service))->execute(['id' => 123456])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/transactions/123456/verify');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => ['link' => 'https://checkout.example.test/pay']], 200)]);
        self::assertTrue((new FlutterwaveInitiatePayment($service))->execute([
            'tx_ref' => 'txn_123',
            'amount' => 5000,
            'currency' => 'NGN',
            'customer' => ['email' => 'ada@example.test', 'name' => 'Ada Example'],
            'redirect_url' => 'https://example.test/callback',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/payments'
            && $request['tx_ref'] === 'txn_123'
            && $request['amount'] === 5000
            && $request['currency'] === 'NGN'
            && $request['customer']['email'] === 'ada@example.test'
            && $request['redirect_url'] === 'https://example.test/callback');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => []], 200)]);
        self::assertTrue((new FlutterwaveListCustomers($service))->execute(['page' => 3])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/customers?page=3');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => ['id' => 456]], 200)]);
        self::assertTrue((new FlutterwaveCreateCustomer($service))->execute([
            'email' => 'grace@example.test',
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
            'phone' => '+2348012345678',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/customers'
            && $request['email'] === 'grace@example.test'
            && $request['first_name'] === 'Grace'
            && $request['last_name'] === 'Hopper'
            && $request['phone'] === '+2348012345678');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => []], 200)]);
        self::assertTrue((new FlutterwaveGetBanks($service))->execute(['country' => 'ng'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://flutterwave.example.test/v3/banks/NG');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new FlutterwaveService(secretKey: 'test-secret', baseUrl: 'https://flutterwave.example.test/v3');

        $missingTransaction = (new FlutterwaveGetTransaction($service))->execute([]);
        self::assertFalse($missingTransaction->succeeded());
        self::assertStringContainsString('id', (string) $missingTransaction->error);

        $missingVerifyId = (new FlutterwaveVerifyTransaction($service))->execute([]);
        self::assertFalse($missingVerifyId->succeeded());
        self::assertStringContainsString('id', (string) $missingVerifyId->error);

        $missingCustomerEmail = (new FlutterwaveInitiatePayment($service))->execute([
            'tx_ref' => 'txn_123',
            'amount' => 5000,
            'currency' => 'NGN',
            'customer' => ['name' => 'Ada Example'],
        ]);
        self::assertFalse($missingCustomerEmail->succeeded());
        self::assertStringContainsString('customer.email', (string) $missingCustomerEmail->error);

        $missingCreateCustomerEmail = (new FlutterwaveCreateCustomer($service))->execute([]);
        self::assertFalse($missingCreateCustomerEmail->succeeded());
        self::assertStringContainsString('email', (string) $missingCreateCustomerEmail->error);

        $unconfigured = (new FlutterwaveListTransactions(new FlutterwaveService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid key'], 401)]);
        $apiError = (new FlutterwaveListTransactions($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Flutterwave API successfully.'], (new FlutterwaveToolProvider)->testConnection([
            'secret_key' => 'test-secret',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.flutterwave.com/v3/banks/NG'
            && $request->hasHeader('Authorization', 'Bearer test-secret'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'error', 'message' => 'Invalid key'], 401)]);
        self::assertSame(['success' => false, 'error' => 'Invalid key'], (new FlutterwaveToolProvider)->testConnection([
            'secret_key' => 'bad-secret',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 'success', 'data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['flutterwave', 'secret_key', 'billing'] => 'account-secret',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'flutterwave' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'flutterwave' ? ['billing'] : [];
            }
        });

        $tool = (new FlutterwaveToolProvider)->createTool(FlutterwaveGetBanks::class, ['account' => 'billing']);
        self::assertTrue($tool->execute(['country' => 'NG'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.flutterwave.com/v3/banks/NG'
            && $request->hasHeader('Authorization', 'Bearer account-secret'));
    }
}
