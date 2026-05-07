<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MercadoPago;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MercadoPago\MercadoPagoService;
use OpenCompany\Integrations\MercadoPago\MercadoPagoToolProvider;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoCreatePayment;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetCurrentUser;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetCustomer;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoGetPayment;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListCustomers;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListPayments;
use OpenCompany\Integrations\MercadoPago\Tools\MercadoPagoListPreferences;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Mercado Pago integration.
 */
final class MercadoPagoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MercadoPagoService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MercadoPagoService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new MercadoPagoToolProvider;

        self::assertSame('mercado-pago', $provider->appName());
        self::assertSame('Mercado Pago', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://www.mercadopago.com.br/developers/en/docs', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertContains('mercado_pago_create_payment', array_keys($provider->tools()));
    }

    public function test_payment_customer_preference_and_user_routes_are_mapped(): void
    {
        $service = new MercadoPagoService(accessToken: 'test-token', baseUrl: 'https://mercadopago.example.test/v1');

        Http::fake(['*' => Http::response(['results' => [['id' => 123]]], 200)]);
        self::assertTrue((new MercadoPagoListPayments($service))->execute([
            'limit' => 10,
            'offset' => 2,
            'external_reference' => 'ORDER-123',
            'status' => 'approved',
            'date_created_from' => '2026-01-01T00:00:00.000-00:00',
            'date_created_to' => '2026-01-31T23:59:59.999-00:00',
            'sort' => 'date_created',
            'criteria' => 'desc',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://mercadopago.example.test/v1/payments/search?')
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'offset=2')
            && str_contains($request->url(), 'external_reference=ORDER-123')
            && str_contains($request->url(), 'status=approved')
            && str_contains($request->url(), 'range=date_created')
            && str_contains($request->url(), 'begin_date=2026-01-01T00%3A00%3A00.000-00%3A00')
            && str_contains($request->url(), 'end_date=2026-01-31T23%3A59%3A59.999-00%3A00')
            && str_contains($request->url(), 'sort=date_created')
            && str_contains($request->url(), 'criteria=desc'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 123], 200)]);
        self::assertTrue((new MercadoPagoGetPayment($service))->execute(['id' => '123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/payments/123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 456], 201)]);
        self::assertTrue((new MercadoPagoCreatePayment($service))->execute([
            'transaction_amount' => 100.50,
            'payment_method_id' => 'visa',
            'payer_email' => 'ada@example.test',
            'token' => 'card_token_example',
            'installments' => 3,
            'description' => 'Example purchase',
            'external_reference' => 'ORDER-123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/payments'
            && $request['transaction_amount'] === 100.50
            && $request['payment_method_id'] === 'visa'
            && $request['payer']['email'] === 'ada@example.test'
            && $request['token'] === 'card_token_example'
            && $request['installments'] === 3
            && $request['description'] === 'Example purchase'
            && $request['external_reference'] === 'ORDER-123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['results' => [['id' => 'cust_123']]], 200)]);
        self::assertTrue((new MercadoPagoListCustomers($service))->execute(['email' => 'ada@example.test', 'limit' => 20, 'offset' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/customers/search?email=ada%40example.test&limit=20&offset=1');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'cust_123'], 200)]);
        self::assertTrue((new MercadoPagoGetCustomer($service))->execute(['id' => 'cust_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/customers/cust_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['elements' => [['id' => 'pref_123']]], 200)]);
        self::assertTrue((new MercadoPagoListPreferences($service))->execute(['limit' => 10, 'offset' => 2, 'sponsor_id' => '999'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/checkout/preferences?limit=10&offset=2&sponsor_id=999');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 999, 'first_name' => 'Ada', 'last_name' => 'Example'], 200)]);
        self::assertTrue((new MercadoPagoGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/users/me');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new MercadoPagoService(accessToken: 'test-token', baseUrl: 'https://mercadopago.example.test/v1');

        $missingPayment = (new MercadoPagoGetPayment($service))->execute([]);
        self::assertFalse($missingPayment->succeeded());
        self::assertStringContainsString('Payment ID is required', (string) $missingPayment->error);

        $missingCustomer = (new MercadoPagoGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer ID is required', (string) $missingCustomer->error);

        $missingAmount = (new MercadoPagoCreatePayment($service))->execute(['payment_method_id' => 'visa', 'payer_email' => 'ada@example.test']);
        self::assertFalse($missingAmount->succeeded());
        self::assertStringContainsString('Transaction amount is required', (string) $missingAmount->error);

        $missingMethod = (new MercadoPagoCreatePayment($service))->execute(['transaction_amount' => 100.50, 'payer_email' => 'ada@example.test']);
        self::assertFalse($missingMethod->succeeded());
        self::assertStringContainsString('Payment method ID is required', (string) $missingMethod->error);

        $missingEmail = (new MercadoPagoCreatePayment($service))->execute(['transaction_amount' => 100.50, 'payment_method_id' => 'visa']);
        self::assertFalse($missingEmail->succeeded());
        self::assertStringContainsString('Payer email is required', (string) $missingEmail->error);

        $unconfigured = (new MercadoPagoListPayments(new MercadoPagoService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid token'], 401)]);
        $apiError = (new MercadoPagoListPayments($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid token', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 999, 'first_name' => 'Ada', 'last_name' => 'Example'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Mercado Pago as Ada Example (ID: 999).'], (new MercadoPagoToolProvider)->testConnection([
            'access_token' => 'test-token',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mercadopago.com/v1/users/me'
            && $request->hasHeader('Authorization', 'Bearer test-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Invalid token'], 401)]);
        $connection = (new MercadoPagoToolProvider)->testConnection(['access_token' => 'bad-token']);
        self::assertFalse($connection['success']);
        self::assertStringContainsString('401', (string) $connection['error']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 999], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['mercado-pago', 'access_token', 'billing'] => 'account-token',
                    ['mercado-pago', 'url', 'billing'] => 'https://mercadopago.example.test/v1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mercado-pago' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mercado-pago' ? ['billing'] : [];
            }
        });

        $tool = (new MercadoPagoToolProvider)->createTool(MercadoPagoGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://mercadopago.example.test/v1/users/me'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
