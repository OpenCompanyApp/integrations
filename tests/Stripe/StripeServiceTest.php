<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Stripe;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Stripe\StripeService;
use OpenCompany\Integrations\Stripe\StripeToolProvider;
use OpenCompany\Integrations\Stripe\Tools\StripeCreateCustomer;
use OpenCompany\Integrations\Stripe\Tools\StripeCreatePaymentIntent;
use OpenCompany\Integrations\Stripe\Tools\StripeCreatePrice;
use OpenCompany\Integrations\Stripe\Tools\StripeListCustomers;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Stripe REST API integration.
 */
final class StripeServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new StripeToolProvider;
        $tools = $provider->tools();

        self::assertSame('stripe', $provider->appName());
        self::assertSame('Stripe', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.stripe.com/api', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(25, $tools);
        self::assertArrayHasKey('stripe_create_payment_intent', $tools);
        self::assertArrayHasKey('stripe_create_subscription', $tools);
        self::assertArrayHasKey('stripe_get_balance', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_stripe_resources_auth_and_form_payloads(): void
    {
        Http::fake(['*' => Http::response(['id' => 'obj_123', 'object' => 'test'], 200)]);

        $service = new StripeService('sk_test_token');

        $service->getBalance();
        $service->createCustomer(['email' => 'person@example.test', 'metadata[account]' => 'test']);
        $service->getCustomer('cus_123');
        $service->updateCustomer('cus_123', ['name' => 'Agent']);
        $service->listCustomers(['limit' => 5]);
        $service->deleteCustomer('cus_123');
        $service->createProduct(['name' => 'Pro']);
        $service->getProduct('prod_123');
        $service->listProducts(['active' => true]);
        $service->createPrice(['product' => 'prod_123', 'unit_amount' => 1000, 'currency' => 'usd']);
        $service->listPrices(['product' => 'prod_123']);
        $service->createPaymentIntent(['amount' => 1000, 'currency' => 'usd']);
        $service->getPaymentIntent('pi_123');
        $service->updatePaymentIntent('pi_123', ['description' => 'Updated']);
        $service->confirmPaymentIntent('pi_123', ['payment_method' => 'pm_card_visa']);
        $service->cancelPaymentIntent('pi_123', ['cancellation_reason' => 'requested_by_customer']);
        $service->capturePaymentIntent('pi_123', ['amount_to_capture' => 1000]);
        $service->createInvoice(['customer' => 'cus_123']);
        $service->getInvoice('in_123');
        $service->listInvoices(['customer' => 'cus_123']);
        $service->payInvoice('in_123');
        $service->voidInvoice('in_123');
        $service->createSubscription(['customer' => 'cus_123', 'items[0][price]' => 'price_123']);
        $service->getSubscription('sub_123');
        $service->cancelSubscription('sub_123', ['invoice_now' => true]);

        Http::assertSentCount(25);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.stripe.com/v1/balance'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('sk_test_token:')));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/customers'
            && $request->data()['email'] === 'person@example.test'
            && $request->data()['metadata[account]'] === 'test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.stripe.com/v1/customers?limit=5');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/prices'
            && $request->data()['product'] === 'prod_123'
            && $request->data()['unit_amount'] === 1000);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/payment_intents/pi_123/confirm'
            && $request->data()['payment_method'] === 'pm_card_visa');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/invoices/in_123/void');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.stripe.com/v1/subscriptions/sub_123'
            && $request->data()['invoice_now'] === true);
    }

    public function test_service_normalizes_stripe_errors(): void
    {
        Http::fake([
            'https://api.stripe.com/v1/customers' => Http::response([
                'error' => [
                    'message' => 'Invalid API Key provided',
                    'code' => 'api_key_invalid',
                    'type' => 'invalid_request_error',
                ],
            ], 401),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Stripe API error (401): Invalid API Key provided (code: api_key_invalid)');

        (new StripeService('sk_test_bad'))->createCustomer(['email' => 'person@example.test']);
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://api.stripe.com/v1/customers' => Http::response(['id' => 'cus_123', 'email' => 'person@example.test'], 200),
            'https://api.stripe.com/v1/payment_intents' => Http::response(['id' => 'pi_123', 'amount' => 1000, 'currency' => 'usd'], 200),
            'https://api.stripe.com/v1/prices' => Http::response(['id' => 'price_123', 'unit_amount' => 1000, 'currency' => 'usd'], 200),
        ]);

        $service = new StripeService('sk_test_token');

        $customer = (new StripeCreateCustomer($service))->execute([
            'email' => 'person@example.test',
            'name' => 'Agent',
            'metadata' => ['account' => 'test'],
        ]);
        $paymentIntent = (new StripeCreatePaymentIntent($service))->execute([
            'amount' => 1000,
            'currency' => 'USD',
            'automatic_payment_methods_enabled' => true,
            'metadata' => ['order_id' => 'order_123'],
        ]);
        $price = (new StripeCreatePrice($service))->execute([
            'product' => 'prod_123',
            'unit_amount' => 1000,
            'currency' => 'USD',
            'recurring_interval' => 'month',
            'metadata' => ['tier' => 'pro'],
        ]);
        $missingAmount = (new StripeCreatePaymentIntent($service))->execute(['currency' => 'usd']);
        $unconfigured = (new StripeListCustomers(new StripeService('')))->execute([]);

        self::assertTrue($customer->succeeded());
        self::assertTrue($paymentIntent->succeeded());
        self::assertTrue($price->succeeded());
        self::assertFalse($missingAmount->succeeded());
        self::assertStringContainsString('amount is required', (string) $missingAmount->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/payment_intents'
            && $request->data()['currency'] === 'usd'
            && $request->data()['automatic_payment_methods[enabled]'] === 'true'
            && $request->data()['metadata[order_id]'] === 'order_123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.stripe.com/v1/prices'
            && $request->data()['recurring[interval]'] === 'month'
            && $request->data()['metadata[tier]'] === 'pro');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new StripeToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://api.stripe.com/v1/balance' => Http::response([
                'available' => [['amount' => 1234, 'currency' => 'usd']],
            ], 200),
            'https://api.stripe.com/v1/customers?limit=5' => Http::response(['data' => []], 200),
        ]);

        $result = $provider->testConnection(['api_key' => 'sk_test_token']);

        self::assertTrue($result['success']);
        self::assertStringContainsString('12.34 USD', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $key === 'api_key' && $account === 'work' ? 'sk_test_work' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = $provider->createTool(StripeListCustomers::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['limit' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.stripe.com/v1/balance'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('sk_test_token:')));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.stripe.com/v1/customers?limit=5'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('sk_test_work:')));
    }
}
