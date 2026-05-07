<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Paystack;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Paystack\PaystackService;
use OpenCompany\Integrations\Paystack\PaystackToolProvider;
use OpenCompany\Integrations\Paystack\Tools\PaystackCreateCustomer;
use OpenCompany\Integrations\Paystack\Tools\PaystackGetCurrentUser;
use OpenCompany\Integrations\Paystack\Tools\PaystackGetTransaction;
use OpenCompany\Integrations\Paystack\Tools\PaystackInitializeTransaction;
use OpenCompany\Integrations\Paystack\Tools\PaystackListCustomers;
use OpenCompany\Integrations\Paystack\Tools\PaystackListPlans;
use OpenCompany\Integrations\Paystack\Tools\PaystackListTransactions;
use OpenCompany\Integrations\Paystack\Tools\PaystackVerifyTransaction;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Paystack integration.
 */
final class PaystackServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PaystackService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PaystackService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new PaystackToolProvider;

        self::assertSame('paystack', $provider->appName());
        self::assertSame('Paystack', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('secret_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://paystack.com/docs/api', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertContains('paystack_verify_transaction', array_keys($provider->tools()));
    }

    public function test_transaction_customer_plan_and_health_routes_are_mapped(): void
    {
        $service = new PaystackService(secretKey: 'test-secret');

        Http::fake(['*' => Http::response(['data' => [['id' => 123456]]], 200)]);
        self::assertTrue((new PaystackListTransactions($service))->execute([
            'per_page' => 10,
            'page' => 2,
            'status' => 'success',
            'customer' => 'cus_123',
            'from' => '2026-01-01T00:00:00',
            'to' => '2026-01-31T23:59:59',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.paystack.co/transaction?')
            && $request->hasHeader('Authorization', 'Bearer test-secret')
            && str_contains($request->url(), 'perPage=10')
            && str_contains($request->url(), 'page=2')
            && str_contains($request->url(), 'status=success')
            && str_contains($request->url(), 'customer=cus_123')
            && str_contains($request->url(), 'from=2026-01-01T00%3A00%3A00')
            && str_contains($request->url(), 'to=2026-01-31T23%3A59%3A59'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 123456]], 200)]);
        self::assertTrue((new PaystackGetTransaction($service))->execute(['id' => '123456'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/transaction/123456');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['reference' => 'ref_123', 'status' => 'success']], 200)]);
        self::assertTrue((new PaystackVerifyTransaction($service))->execute(['reference' => 'ref_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/transaction/verify/ref_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['authorization_url' => 'https://checkout.example.test/pay/ref_123']], 200)]);
        self::assertTrue((new PaystackInitializeTransaction($service))->execute([
            'amount' => 50000,
            'email' => 'ada@example.test',
            'reference' => 'ref_123',
            'callback_url' => 'https://example.test/callback',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/transaction/initialize'
            && $request['amount'] === 50000
            && $request['email'] === 'ada@example.test'
            && $request['reference'] === 'ref_123'
            && $request['callback_url'] === 'https://example.test/callback');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['customer_code' => 'CUS_123']]], 200)]);
        self::assertTrue((new PaystackListCustomers($service))->execute(['per_page' => 20, 'page' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/customer?perPage=20&page=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['customer_code' => 'CUS_456']], 200)]);
        self::assertTrue((new PaystackCreateCustomer($service))->execute([
            'email' => 'grace@example.test',
            'first_name' => 'Grace',
            'last_name' => 'Hopper',
            'phone' => '+2348012345678',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/customer'
            && $request['email'] === 'grace@example.test'
            && $request['first_name'] === 'Grace'
            && $request['last_name'] === 'Hopper'
            && $request['phone'] === '+2348012345678');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['plan_code' => 'PLN_123']]], 200)]);
        self::assertTrue((new PaystackListPlans($service))->execute(['per_page' => 10, 'page' => 1, 'status' => 'active'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/plan?perPage=10&page=1&status=active');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['payment_session_timeout' => 30]], 200)]);
        self::assertTrue((new PaystackGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/integration/payment_session_timeout');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new PaystackService(secretKey: 'test-secret');

        $missingTransaction = (new PaystackGetTransaction($service))->execute([]);
        self::assertFalse($missingTransaction->succeeded());
        self::assertStringContainsString('Transaction ID is required', (string) $missingTransaction->error);

        $missingReference = (new PaystackVerifyTransaction($service))->execute([]);
        self::assertFalse($missingReference->succeeded());
        self::assertStringContainsString('Transaction reference is required', (string) $missingReference->error);

        $missingAmount = (new PaystackInitializeTransaction($service))->execute(['email' => 'ada@example.test']);
        self::assertFalse($missingAmount->succeeded());
        self::assertStringContainsString('Amount is required', (string) $missingAmount->error);

        $missingEmailTransaction = (new PaystackInitializeTransaction($service))->execute(['amount' => 50000]);
        self::assertFalse($missingEmailTransaction->succeeded());
        self::assertStringContainsString('Email is required', (string) $missingEmailTransaction->error);

        $missingCustomerEmail = (new PaystackCreateCustomer($service))->execute([]);
        self::assertFalse($missingCustomerEmail->succeeded());
        self::assertStringContainsString('Email is required', (string) $missingCustomerEmail->error);

        $unconfigured = (new PaystackListTransactions(new PaystackService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid key'], 401)]);
        $apiError = (new PaystackListTransactions($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['payment_session_timeout' => 30]], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Paystack API successfully.'], (new PaystackToolProvider)->testConnection([
            'secret_key' => 'test-secret',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/integration/payment_session_timeout'
            && $request->hasHeader('Authorization', 'Bearer test-secret'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Invalid key'], 401)]);
        self::assertSame(['success' => false, 'error' => 'Paystack API error: Invalid key'], (new PaystackToolProvider)->testConnection([
            'secret_key' => 'bad-secret',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['payment_session_timeout' => 30]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['paystack', 'secret_key', 'billing'] => 'account-secret',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'paystack' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'paystack' ? ['billing'] : [];
            }
        });

        $tool = (new PaystackToolProvider)->createTool(PaystackGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.paystack.co/integration/payment_session_timeout'
            && $request->hasHeader('Authorization', 'Bearer account-secret'));
    }
}
