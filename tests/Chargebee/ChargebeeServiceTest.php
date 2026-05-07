<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Chargebee;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Chargebee\ChargebeeService;
use OpenCompany\Integrations\Chargebee\ChargebeeToolProvider;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCheckoutNewForItems;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCollectInvoicePayment;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeCreateSubscriptionForCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCurrentUser;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetCustomer;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetInvoice;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeGetSubscription;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListEvents;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListCustomers;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListInvoices;
use OpenCompany\Integrations\Chargebee\Tools\ChargebeeListSubscriptions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Chargebee integration.
 */
final class ChargebeeServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargebeeService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ChargebeeService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new ChargebeeToolProvider;

        self::assertSame('chargebee', $provider->appName());
        self::assertSame('Chargebee', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://api-static-site.chargebee.com/docs/api', $provider->integrationMeta()['docs_url']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('API Key', $provider->credentialFields()[0]['label']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(80, $provider->tools());
        self::assertContains('chargebee_list_subscriptions', array_keys($provider->tools()));
        self::assertContains('chargebee_create_subscription_for_customer', array_keys($provider->tools()));
        self::assertContains('chargebee_checkout_new_for_items', array_keys($provider->tools()));
        self::assertContains('chargebee_list_events', array_keys($provider->tools()));
    }

    public function test_subscription_customer_invoice_and_health_routes_are_mapped(): void
    {
        $service = new ChargebeeService(accessToken: 'test-key', baseUrl: 'https://chargebee.example.test/api/v2');

        Http::fake(['*' => Http::response(['list' => [['subscription' => ['id' => 'sub_123']]], 'next_offset' => 'next-page'], 200)]);
        $subscriptions = (new ChargebeeListSubscriptions($service))->execute(['limit' => 25, 'page' => 'page-1', 'state' => 'active']);
        self::assertTrue($subscriptions->succeeded());
        self::assertSame(1, $subscriptions->data['count']);
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://chargebee.example.test/api/v2/subscriptions?')
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('test-key:'))
            && str_contains($request->url(), 'limit=25')
            && str_contains($request->url(), 'offset=page-1')
            && str_contains($request->url(), 'status%5Bis%5D=active'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['subscription' => ['id' => 'sub_123'], 'customer' => ['id' => 'cus_123']], 200)]);
        self::assertTrue((new ChargebeeGetSubscription($service))->execute(['id' => 'sub_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chargebee.example.test/api/v2/subscriptions/sub_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => [['customer' => ['id' => 'cus_123']]], 'next_offset' => 'next-page'], 200)]);
        self::assertTrue((new ChargebeeListCustomers($service))->execute(['limit' => 10, 'page' => 'page-2'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://chargebee.example.test/api/v2/customers?')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'offset=page-2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['customer' => ['id' => 'cus_123'], 'card' => ['last4' => '1111']], 200)]);
        self::assertTrue((new ChargebeeGetCustomer($service))->execute(['id' => 'cus_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chargebee.example.test/api/v2/customers/cus_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => [['invoice' => ['id' => 'inv_123']]], 'next_offset' => 'next-page'], 200)]);
        self::assertTrue((new ChargebeeListInvoices($service))->execute(['limit' => 5, 'page' => 'page-3', 'status' => 'paid'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://chargebee.example.test/api/v2/invoices?')
            && str_contains($request->url(), 'limit=5')
            && str_contains($request->url(), 'offset=page-3')
            && str_contains($request->url(), 'status%5Bis%5D=paid'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['invoice' => ['id' => 'inv_123']], 200)]);
        self::assertTrue((new ChargebeeGetInvoice($service))->execute(['id' => 'inv_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chargebee.example.test/api/v2/invoices/inv_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => []], 200)]);
        self::assertTrue((new ChargebeeGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://chargebee.example.test/api/v2/subscriptions?limit=1');
    }

    public function test_expanded_endpoint_tools_map_payload_and_action_routes(): void
    {
        $service = new ChargebeeService(accessToken: 'test-key', baseUrl: 'https://chargebee.example.test/api/v2');

        Http::fake(['*' => Http::response(['subscription' => ['id' => 'sub_123']], 200)]);
        self::assertTrue((new ChargebeeCreateSubscriptionForCustomer($service))->execute([
            'customer_id' => 'cus_123',
            'payload' => [
                'subscription_items[item_price_id][0]' => 'basic-USD',
                'subscription_items[quantity][0]' => 2,
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chargebee.example.test/api/v2/customers/cus_123/subscription_for_items'
            && $request['subscription_items[item_price_id][0]'] === 'basic-USD'
            && $request['subscription_items[quantity][0]'] === 2);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['invoice' => ['id' => 'inv_123'], 'transaction' => ['id' => 'txn_123']], 200)]);
        self::assertTrue((new ChargebeeCollectInvoicePayment($service))->execute([
            'id' => 'inv_123',
            'payload' => ['amount' => 5000],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chargebee.example.test/api/v2/invoices/inv_123/collect_payment'
            && $request['amount'] === 5000);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['hosted_page' => ['id' => 'hp_123']], 200)]);
        self::assertTrue((new ChargebeeCheckoutNewForItems($service))->execute([
            'payload' => ['subscription_items[item_price_id][0]' => 'basic-USD'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://chargebee.example.test/api/v2/hosted_pages/checkout_new_for_items');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => [['event' => ['id' => 'evt_123']]]], 200)]);
        self::assertTrue((new ChargebeeListEvents($service))->execute([
            'limit' => 10,
            'offset' => 'next-page',
            'created_at[after]' => 1700000000,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://chargebee.example.test/api/v2/events?')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'offset=next-page')
            && str_contains($request->url(), 'created_at%5Bafter%5D=1700000000'));
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new ChargebeeService(accessToken: 'test-key', baseUrl: 'https://chargebee.example.test/api/v2');

        $missingSubscription = (new ChargebeeGetSubscription($service))->execute([]);
        self::assertFalse($missingSubscription->succeeded());
        self::assertStringContainsString('Subscription ID is required', (string) $missingSubscription->error);

        $missingCustomer = (new ChargebeeGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer ID is required', (string) $missingCustomer->error);

        $missingInvoice = (new ChargebeeGetInvoice($service))->execute([]);
        self::assertFalse($missingInvoice->succeeded());
        self::assertStringContainsString('Invoice ID is required', (string) $missingInvoice->error);

        $unconfigured = (new ChargebeeListSubscriptions(new ChargebeeService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid API key'], 401)]);
        $apiError = (new ChargebeeListSubscriptions($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Chargebee site "demo".'], (new ChargebeeToolProvider)->testConnection([
            'access_token' => 'test-key',
            'site_name' => 'demo',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://demo.chargebee.com/api/v2/subscriptions?limit=1'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('test-key:')));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['api_error_code' => 'invalid_request'], 400)]);
        self::assertSame(['success' => false, 'error' => 'invalid_request'], (new ChargebeeToolProvider)->testConnection([
            'access_token' => 'bad-key',
            'site_name' => 'demo',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['list' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['chargebee', 'access_token', 'billing'] => 'account-key',
                    ['chargebee', 'site_name', 'billing'] => 'account-site',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'chargebee' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'chargebee' ? ['billing'] : [];
            }
        });

        $tool = (new ChargebeeToolProvider)->createTool(ChargebeeGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-site.chargebee.com/api/v2/subscriptions?limit=1'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('account-key:')));
    }
}
