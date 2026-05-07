<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\PayPal;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\PayPal\PayPalService;
use OpenCompany\Integrations\PayPal\PayPalToolProvider;
use OpenCompany\Integrations\PayPal\Tools\PayPalCaptureOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalCreateOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetCurrentUser;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetOrder;
use OpenCompany\Integrations\PayPal\Tools\PayPalGetPayment;
use OpenCompany\Integrations\PayPal\Tools\PayPalListInvoices;
use OpenCompany\Integrations\PayPal\Tools\PayPalListPayments;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the PayPal integration.
 */
final class PayPalServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PayPalService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PayPalService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new PayPalToolProvider;

        self::assertSame('paypal', $provider->appName());
        self::assertSame('PayPal', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://api-m.paypal.com', $provider->credentialFields()[1]['default']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertContains('paypal_capture_order', array_keys($provider->tools()));
        self::assertNotContains('paypal_list_orders', array_keys($provider->tools()));
    }

    public function test_order_payment_invoice_and_identity_routes_are_mapped(): void
    {
        $service = new PayPalService(accessToken: 'test-token', baseUrl: 'https://paypal.example.test/v1');

        Http::fake(['*' => Http::response(['id' => 'ORDER-123', 'status' => 'CREATED'], 201)]);
        self::assertTrue((new PayPalCreateOrder($service))->execute([
            'intent' => 'CAPTURE',
            'purchase_units' => [
                ['amount' => ['currency_code' => 'USD', 'value' => '29.99']],
            ],
            'payment_source' => ['paypal' => ['experience_context' => ['brand_name' => 'Example']]],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v2/checkout/orders'
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && $request['intent'] === 'CAPTURE'
            && $request['purchase_units'][0]['amount']['value'] === '29.99'
            && $request['payment_source']['paypal']['experience_context']['brand_name'] === 'Example');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'ORDER-123', 'status' => 'APPROVED'], 200)]);
        self::assertTrue((new PayPalGetOrder($service))->execute(['order_id' => 'ORDER-123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v2/checkout/orders/ORDER-123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'ORDER-123', 'status' => 'COMPLETED'], 201)]);
        self::assertTrue((new PayPalCaptureOrder($service))->execute([
            'order_id' => 'ORDER-123',
            'payment_source' => ['paypal' => ['vault_id' => 'vault_123']],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v2/checkout/orders/ORDER-123/capture'
            && $request['payment_source']['paypal']['vault_id'] === 'vault_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['payments' => [['id' => 'PAY-123']]], 200)]);
        self::assertTrue((new PayPalListPayments($service))->execute(['count' => 10, 'start_id' => 'PAY-001'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://paypal.example.test/v1/payments/payment?')
            && str_contains($request->url(), 'count=10')
            && str_contains($request->url(), 'start_id=PAY-001'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'PAY-123', 'state' => 'approved'], 200)]);
        self::assertTrue((new PayPalGetPayment($service))->execute(['payment_id' => 'PAY-123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v1/payments/payment/PAY-123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => [['id' => 'INV2-123']]], 200)]);
        self::assertTrue((new PayPalListInvoices($service))->execute(['page' => 1, 'page_size' => 20, 'total_required' => true])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://paypal.example.test/v2/invoicing/invoices?')
            && str_contains($request->url(), 'page=1')
            && str_contains($request->url(), 'page_size=20')
            && str_contains($request->url(), 'total_required=1'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['user_id' => 'USER-123', 'email' => 'person@example.test'], 200)]);
        self::assertTrue((new PayPalGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v1/identity/oauth2/userinfo');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new PayPalService(accessToken: 'test-token', baseUrl: 'https://paypal.example.test');

        $missingOrder = (new PayPalGetOrder($service))->execute([]);
        self::assertFalse($missingOrder->succeeded());
        self::assertStringContainsString('order_id is required', (string) $missingOrder->error);

        $missingCaptureOrder = (new PayPalCaptureOrder($service))->execute([]);
        self::assertFalse($missingCaptureOrder->succeeded());
        self::assertStringContainsString('order_id is required', (string) $missingCaptureOrder->error);

        $missingPurchaseUnits = (new PayPalCreateOrder($service))->execute(['intent' => 'CAPTURE']);
        self::assertFalse($missingPurchaseUnits->succeeded());
        self::assertStringContainsString('purchase_units is required', (string) $missingPurchaseUnits->error);

        $unconfigured = (new PayPalListPayments(new PayPalService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Authentication failed'], 401)]);
        $apiError = (new PayPalListPayments($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Authentication failed', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'Ada Example', 'email' => 'ada@example.test'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to PayPal API as Ada Example.'], (new PayPalToolProvider)->testConnection([
            'access_token' => 'test-token',
            'url' => 'https://paypal.example.test/v2',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v1/identity/oauth2/userinfo');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['name' => 'AUTHENTICATION_FAILURE'], 401)]);
        self::assertSame(['success' => false, 'error' => 'AUTHENTICATION_FAILURE'], (new PayPalToolProvider)->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://paypal.example.test',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['user_id' => 'USER-123'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['paypal', 'access_token', 'payments'] => 'account-token',
                    ['paypal', 'url', 'payments'] => 'https://paypal.example.test/v2',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'paypal' && $account === 'payments';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'paypal' ? ['payments'] : [];
            }
        });

        $tool = (new PayPalToolProvider)->createTool(PayPalGetCurrentUser::class, ['account' => 'payments']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paypal.example.test/v1/identity/oauth2/userinfo'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
