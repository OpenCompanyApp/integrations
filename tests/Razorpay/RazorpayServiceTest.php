<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Razorpay;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Razorpay\RazorpayService;
use OpenCompany\Integrations\Razorpay\RazorpayToolProvider;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayCreateOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetCurrentUser;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetOrder;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayGetPayment;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListCustomers;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListOrders;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListPayments;
use OpenCompany\Integrations\Razorpay\Tools\RazorpayListRefunds;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Razorpay integration.
 */
final class RazorpayServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(RazorpayService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(RazorpayService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new RazorpayToolProvider;

        self::assertSame('razorpay', $provider->appName());
        self::assertSame('Razorpay', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('key_id', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertContains('key_secret', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://razorpay.com/docs/api/', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(8, $provider->tools());
        self::assertContains('razorpay_create_order', array_keys($provider->tools()));
    }

    public function test_payment_order_refund_customer_and_health_routes_are_mapped(): void
    {
        $service = new RazorpayService(keyId: 'rzp_test_key', keySecret: 'test-secret', baseUrl: 'https://razorpay.example.test/v1');

        Http::fake(['*' => Http::response(['items' => [['id' => 'pay_123']]], 200)]);
        self::assertTrue((new RazorpayListPayments($service))->execute([
            'count' => 10,
            'skip' => 2,
            'from' => 1704067200,
            'to' => 1706745600,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://razorpay.example.test/v1/payments?')
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('rzp_test_key:test-secret'))
            && str_contains($request->url(), 'count=10')
            && str_contains($request->url(), 'skip=2')
            && str_contains($request->url(), 'from=1704067200')
            && str_contains($request->url(), 'to=1706745600'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'pay_123'], 200)]);
        self::assertTrue((new RazorpayGetPayment($service))->execute(['payment_id' => 'pay_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/payments/pay_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'order_123']]], 200)]);
        self::assertTrue((new RazorpayListOrders($service))->execute(['count' => 5, 'skip' => 1, 'from' => 1704067200, 'to' => 1706745600])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://razorpay.example.test/v1/orders?')
            && str_contains($request->url(), 'count=5')
            && str_contains($request->url(), 'skip=1')
            && str_contains($request->url(), 'from=1704067200')
            && str_contains($request->url(), 'to=1706745600'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'order_123'], 200)]);
        self::assertTrue((new RazorpayGetOrder($service))->execute(['order_id' => 'order_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/orders/order_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'order_456'], 200)]);
        self::assertTrue((new RazorpayCreateOrder($service))->execute([
            'amount' => 50000,
            'currency' => 'INR',
            'receipt' => 'receipt_123',
            'notes' => ['purpose' => 'Subscription'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/orders'
            && $request['amount'] === 50000
            && $request['currency'] === 'INR'
            && $request['receipt'] === 'receipt_123'
            && $request['notes']['purpose'] === 'Subscription');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'rfnd_123']]], 200)]);
        self::assertTrue((new RazorpayListRefunds($service))->execute(['count' => 20, 'skip' => 3, 'from' => 1704067200, 'to' => 1706745600])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://razorpay.example.test/v1/refunds?')
            && str_contains($request->url(), 'count=20')
            && str_contains($request->url(), 'skip=3')
            && str_contains($request->url(), 'from=1704067200')
            && str_contains($request->url(), 'to=1706745600'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'cust_123']]], 200)]);
        self::assertTrue((new RazorpayListCustomers($service))->execute(['count' => 20, 'skip' => 4])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/customers?count=20&skip=4');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'pay_123']], 'count' => 1], 200)]);
        self::assertTrue((new RazorpayGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/payments?count=1');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new RazorpayService(keyId: 'rzp_test_key', keySecret: 'test-secret', baseUrl: 'https://razorpay.example.test/v1');

        $missingPayment = (new RazorpayGetPayment($service))->execute([]);
        self::assertFalse($missingPayment->succeeded());
        self::assertStringContainsString('Payment ID is required', (string) $missingPayment->error);

        $missingOrder = (new RazorpayGetOrder($service))->execute([]);
        self::assertFalse($missingOrder->succeeded());
        self::assertStringContainsString('Order ID is required', (string) $missingOrder->error);

        $missingAmount = (new RazorpayCreateOrder($service))->execute([]);
        self::assertFalse($missingAmount->succeeded());
        self::assertStringContainsString('Amount is required', (string) $missingAmount->error);

        $unconfigured = (new RazorpayListPayments(new RazorpayService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['error' => ['description' => 'Invalid key']], 401)]);
        $apiError = (new RazorpayListPayments($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Razorpay API successfully.'], (new RazorpayToolProvider)->testConnection([
            'key_id' => 'rzp_test_key',
            'key_secret' => 'test-secret',
            'url' => 'https://razorpay.example.test/v1',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/payments?count=1'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('rzp_test_key:test-secret')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => ['description' => 'Invalid key']], 401)]);
        self::assertSame(['success' => false, 'error' => 'Invalid Key ID or Key Secret.'], (new RazorpayToolProvider)->testConnection([
            'key_id' => 'bad-key',
            'key_secret' => 'bad-secret',
            'url' => 'https://razorpay.example.test/v1',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['razorpay', 'key_id', 'billing'] => 'account-key',
                    ['razorpay', 'key_secret', 'billing'] => 'account-secret',
                    ['razorpay', 'url', 'billing'] => 'https://razorpay.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'razorpay' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'razorpay' ? ['billing'] : [];
            }
        });

        $tool = (new RazorpayToolProvider)->createTool(RazorpayGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://razorpay.example.test/v1/payments?count=1'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-key:account-secret')));
    }
}
