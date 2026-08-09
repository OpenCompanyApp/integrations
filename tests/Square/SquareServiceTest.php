<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Square;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Square\SquareService;
use OpenCompany\Integrations\Square\SquareToolProvider;
use OpenCompany\Integrations\Square\Tools\SquareCreateCustomer;
use OpenCompany\Integrations\Square\Tools\SquareCreatePayment;
use OpenCompany\Integrations\Square\Tools\SquareGetCurrentUser;
use OpenCompany\Integrations\Square\Tools\SquareGetCustomer;
use OpenCompany\Integrations\Square\Tools\SquareGetOrder;
use OpenCompany\Integrations\Square\Tools\SquareGetPayment;
use OpenCompany\Integrations\Square\Tools\SquareListCustomers;
use OpenCompany\Integrations\Square\Tools\SquareListLocations;
use OpenCompany\Integrations\Square\Tools\SquareListOrders;
use OpenCompany\Integrations\Square\Tools\SquareListPayments;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Square integration.
 */
final class SquareServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(SquareService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(SquareService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new SquareToolProvider;

        self::assertSame('square', $provider->appName());
        self::assertSame('Square', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://developer.squareup.com/reference/square', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(10, $provider->tools());
        self::assertContains('square_create_payment', array_keys($provider->tools()));
        self::assertContains('square_create_customer', array_keys($provider->tools()));
        self::assertContains('square_list_locations', array_keys($provider->tools()));
    }

    public function test_payment_customer_order_location_and_merchant_routes_are_mapped(): void
    {
        $service = new SquareService(accessToken: 'test-token');

        Http::fake(['*' => Http::response(['payments' => [['id' => 'pay_123']]], 200)]);
        self::assertTrue((new SquareListPayments($service))->execute([
            'location_id' => 'loc_123',
            'begin_time' => '2026-01-01T00:00:00Z',
            'end_time' => '2026-01-31T23:59:59Z',
            'limit' => 20,
            'cursor' => 'cursor_123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.squareup.com/v2/payments?')
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && $request->hasHeader('Square-Version', '2024-12-18')
            && str_contains($request->url(), 'location_id=loc_123')
            && str_contains($request->url(), 'begin_time=2026-01-01T00%3A00%3A00Z')
            && str_contains($request->url(), 'end_time=2026-01-31T23%3A59%3A59Z')
            && str_contains($request->url(), 'limit=20')
            && str_contains($request->url(), 'cursor=cursor_123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['payment' => ['id' => 'pay_123']], 200)]);
        self::assertTrue((new SquareGetPayment($service))->execute(['id' => 'pay_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/payments/pay_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['payment' => ['id' => 'pay_456']], 200)]);
        self::assertTrue((new SquareCreatePayment($service))->execute([
            'source_id' => 'cnon:card-nonce-ok',
            'idempotency_key' => 'idem_123',
            'amount' => 1000,
            'currency' => 'usd',
            'reference_id' => 'ORDER-123',
            'note' => 'Example',
            'customer_id' => 'cust_123',
            'location_id' => 'loc_123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/payments'
            && $request['source_id'] === 'cnon:card-nonce-ok'
            && $request['idempotency_key'] === 'idem_123'
            && $request['amount_money']['amount'] === 1000
            && $request['amount_money']['currency'] === 'USD'
            && $request['reference_id'] === 'ORDER-123'
            && $request['customer_id'] === 'cust_123'
            && $request['location_id'] === 'loc_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['customers' => [['id' => 'cust_123']]], 200)]);
        self::assertTrue((new SquareListCustomers($service))->execute(['limit' => 10, 'cursor' => 'cur', 'sort_field' => 'GIVEN_NAME', 'sort_order' => 'ASC'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.squareup.com/v2/customers?')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'cursor=cur')
            && str_contains($request->url(), 'sort_field=GIVEN_NAME')
            && str_contains($request->url(), 'sort_order=ASC'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['customer' => ['id' => 'cust_123']], 200)]);
        self::assertTrue((new SquareGetCustomer($service))->execute(['id' => 'cust_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/customers/cust_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['customer' => ['id' => 'cust_456']], 200)]);
        self::assertTrue((new SquareCreateCustomer($service))->execute([
            'given_name' => 'Ada',
            'family_name' => 'Example',
            'email_address' => 'ada@example.test',
            'phone_number' => '+15551234567',
            'idempotency_key' => 'cust-idem',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/customers'
            && $request['given_name'] === 'Ada'
            && $request['family_name'] === 'Example'
            && $request['email_address'] === 'ada@example.test'
            && $request['phone_number'] === '+15551234567'
            && $request['idempotency_key'] === 'cust-idem');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['orders' => [['id' => 'order_123']]], 200)]);
        self::assertTrue((new SquareListOrders($service))->execute(['location_id' => 'loc_123', 'limit' => 5, 'cursor' => 'next', 'states' => 'COMPLETED,CANCELED'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.squareup.com/v2/orders/search'
            && $request['location_ids'] === ['loc_123']
            && $request['limit'] === 5
            && $request['cursor'] === 'next'
            && $request['query']['filter']['state_filter']['states'] === ['COMPLETED', 'CANCELED']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['order' => ['id' => 'order_123']], 200)]);
        self::assertTrue((new SquareGetOrder($service))->execute(['id' => 'order_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/orders/order_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['locations' => [['id' => 'loc_123']]], 200)]);
        self::assertTrue((new SquareListLocations($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/locations');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['merchant' => ['id' => 'merchant_123', 'business_name' => 'Example']], 200)]);
        self::assertTrue((new SquareGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/merchants/me');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new SquareService(accessToken: 'test-token');

        $missingPayment = (new SquareGetPayment($service))->execute([]);
        self::assertFalse($missingPayment->succeeded());
        self::assertStringContainsString('id is required', (string) $missingPayment->error);

        $missingCreatePayment = (new SquareCreatePayment($service))->execute([]);
        self::assertFalse($missingCreatePayment->succeeded());
        self::assertStringContainsString('source_id is required', (string) $missingCreatePayment->error);

        $missingCustomerFields = (new SquareCreateCustomer($service))->execute([]);
        self::assertFalse($missingCustomerFields->succeeded());
        self::assertStringContainsString('At least one customer field', (string) $missingCustomerFields->error);

        $missingLocation = (new SquareListOrders($service))->execute([]);
        self::assertFalse($missingLocation->succeeded());
        self::assertStringContainsString('location_id is required', (string) $missingLocation->error);

        $unconfigured = (new SquareListPayments(new SquareService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['errors' => [['detail' => 'Invalid token', 'code' => 'UNAUTHORIZED']]], 401)]);
        $apiError = (new SquareListPayments($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid token', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['merchant' => ['id' => 'merchant_123', 'business_name' => 'Example Merchant']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Square as "Example Merchant".'], (new SquareToolProvider)->testConnection([
            'access_token' => 'test-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['errors' => [['detail' => 'Invalid token']]], 401)]);
        $connection = (new SquareToolProvider)->testConnection(['access_token' => 'bad-token']);
        self::assertFalse($connection['success']);
        self::assertStringContainsString('Invalid token', (string) $connection['error']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['merchant' => ['id' => 'merchant_123']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['square', 'access_token', 'merchant'] => 'account-token',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'square' && $account === 'merchant';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'square' ? ['merchant'] : [];
            }
        });

        $tool = (new SquareToolProvider)->createTool(SquareGetCurrentUser::class, ['account' => 'merchant']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.squareup.com/v2/merchants/me'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
