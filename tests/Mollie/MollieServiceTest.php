<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mollie;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Mollie\MollieService;
use OpenCompany\Integrations\Mollie\MollieToolProvider;
use OpenCompany\Integrations\Mollie\Tools\MollieCreateCustomer;
use OpenCompany\Integrations\Mollie\Tools\MollieCreatePayment;
use OpenCompany\Integrations\Mollie\Tools\MollieCreateSubscription;
use OpenCompany\Integrations\Mollie\Tools\MollieGetCurrentUser;
use OpenCompany\Integrations\Mollie\Tools\MollieGetPayment;
use OpenCompany\Integrations\Mollie\Tools\MollieListCustomers;
use OpenCompany\Integrations\Mollie\Tools\MollieListInvoices;
use OpenCompany\Integrations\Mollie\Tools\MollieListPayments;
use OpenCompany\Integrations\Mollie\Tools\MollieListSubscriptions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Mollie integration.
 */
final class MollieServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MollieService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MollieService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new MollieToolProvider;

        self::assertSame('mollie', $provider->appName());
        self::assertSame('Mollie', $provider->integrationMeta()['name']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(9, $provider->tools());
        self::assertContains('mollie_create_subscription', array_keys($provider->tools()));
    }

    public function test_payment_customer_subscription_invoice_and_method_routes_are_mapped(): void
    {
        $service = new MollieService(accessToken: 'test-token', baseUrl: 'https://mollie.example.test/v2');

        Http::fake(['*' => Http::response(['_embedded' => ['payments' => [['id' => 'tr_123']]]], 200)]);
        $payments = (new MollieListPayments($service))->execute(['limit' => 10, 'from' => 'tr_001', 'profileId' => 'pfl_123']);
        self::assertTrue($payments->succeeded());
        self::assertSame(1, $payments->data['count']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://mollie.example.test/v2/payments?')
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'from=tr_001')
            && str_contains($request->url(), 'profileId=pfl_123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'tr_123', 'status' => 'paid'], 200)]);
        self::assertTrue((new MollieGetPayment($service))->execute(['id' => 'tr_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mollie.example.test/v2/payments/tr_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'tr_456', 'status' => 'open'], 201)]);
        self::assertTrue((new MollieCreatePayment($service))->execute([
            'amount' => ['currency' => 'EUR', 'value' => '29.99'],
            'description' => 'Order 123',
            'redirectUrl' => 'https://example.test/return',
            'method' => 'ideal',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mollie.example.test/v2/payments'
            && $request['amount'] === ['currency' => 'EUR', 'value' => '29.99']
            && $request['description'] === 'Order 123'
            && $request['redirectUrl'] === 'https://example.test/return'
            && $request['method'] === 'ideal');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['customers' => [['id' => 'cst_123']]]], 200)]);
        self::assertTrue((new MollieListCustomers($service))->execute(['limit' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://mollie.example.test/v2/customers?')
            && str_contains($request->url(), 'limit=5'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'cst_123'], 201)]);
        self::assertTrue((new MollieCreateCustomer($service))->execute(['name' => 'Ada Lovelace', 'email' => 'ada@example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mollie.example.test/v2/customers'
            && $request['name'] === 'Ada Lovelace'
            && $request['email'] === 'ada@example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['subscriptions' => [['id' => 'sub_123']]]], 200)]);
        self::assertTrue((new MollieListSubscriptions($service))->execute(['customer_id' => 'cst_123', 'limit' => 3])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://mollie.example.test/v2/customers/cst_123/subscriptions?')
            && str_contains($request->url(), 'limit=3'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'sub_456'], 201)]);
        self::assertTrue((new MollieCreateSubscription($service))->execute([
            'customer_id' => 'cst_123',
            'amount' => ['currency' => 'EUR', 'value' => '9.99'],
            'interval' => '1 month',
            'description' => 'Pro plan',
            'times' => 12,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mollie.example.test/v2/customers/cst_123/subscriptions'
            && $request['amount'] === ['currency' => 'EUR', 'value' => '9.99']
            && $request['interval'] === '1 month'
            && $request['times'] === 12);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['invoices' => [['id' => 'inv_123']]]], 200)]);
        self::assertTrue((new MollieListInvoices($service))->execute(['year' => 2026, 'month' => 5])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://mollie.example.test/v2/invoices?')
            && str_contains($request->url(), 'year=2026')
            && str_contains($request->url(), 'month=5'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['methods' => [['id' => 'ideal']]]], 200)]);
        $methods = (new MollieGetCurrentUser($service))->execute([]);
        self::assertTrue($methods->succeeded());
        self::assertSame(1, $methods->data['count']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mollie.example.test/v2/methods');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new MollieService(accessToken: 'test-token', baseUrl: 'https://mollie.example.test/v2');

        $missingPayment = (new MollieGetPayment($service))->execute([]);
        self::assertFalse($missingPayment->succeeded());
        self::assertStringContainsString('Payment ID is required', (string) $missingPayment->error);

        $missingPaymentAmount = (new MollieCreatePayment($service))->execute(['description' => 'Order', 'redirectUrl' => 'https://example.test/return']);
        self::assertFalse($missingPaymentAmount->succeeded());
        self::assertStringContainsString('Amount is required', (string) $missingPaymentAmount->error);

        $missingCustomer = (new MollieCreateCustomer($service))->execute(['name' => 'Ada Lovelace']);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer email is required', (string) $missingCustomer->error);

        $missingSubscription = (new MollieCreateSubscription($service))->execute(['customer_id' => 'cst_123']);
        self::assertFalse($missingSubscription->succeeded());
        self::assertStringContainsString('Amount is required', (string) $missingSubscription->error);

        $unconfigured = (new MollieListPayments(new MollieService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['detail' => 'Invalid API key'], 401)]);
        $apiError = (new MollieListPayments($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['methods' => []]], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Mollie API at https://mollie.example.test/v2.'], (new MollieToolProvider)->testConnection([
            'access_token' => 'test-token',
            'url' => 'https://mollie.example.test/v2',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_embedded' => ['methods' => []]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['mollie', 'access_token', 'payments'] => 'account-token',
                    ['mollie', 'url', 'payments'] => 'https://mollie.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mollie' && $account === 'payments';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mollie' ? ['payments'] : [];
            }
        });

        $tool = (new MollieToolProvider)->createTool(MollieGetCurrentUser::class, ['account' => 'payments']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
