<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CheckoutCom;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CheckoutCom\CheckoutComService;
use OpenCompany\Integrations\CheckoutCom\CheckoutComToolProvider;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComCaptureAPayment;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentDetails;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComGetPaymentMethods;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAnAccessToken;
use OpenCompany\Integrations\CheckoutCom\Tools\CheckoutComRequestAPaymentOrPayout;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Checkout.com OpenAPI integration.
 */
final class CheckoutComServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new CheckoutComToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/checkout-com/checkout-com-openapi-manifest.json'), true);

        self::assertSame(195, $manifest['method_count']);
        self::assertSame('v1.0.0', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Checkout.com', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(1, $provider->credentialFields());
        self::assertSame('api_key', $provider->credentialFields()[0]['key']);
        self::assertCount(3, $provider->configSchema());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('checkout_com_request_a_payment_or_payout', array_keys($provider->tools()));
        self::assertContains('checkout_com_request_an_access_token', array_keys($provider->tools()));
        self::assertContains('checkout_com_get_payment_methods', array_keys($provider->tools()));
    }

    public function test_service_maps_auth_path_query_json_form_and_idempotency_headers(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CheckoutComService('secret', 'https://checkout.example.test', 'https://access.checkout.example.test');
        $service->request('GET', '/payments/{id}', ['id' => 'pay 123'], ['expand' => ['actions', 'balances']]);
        $service->request('POST', '/payments', [], [], ['Cko-Idempotency-Key' => 'pay-key'], ['amount' => 1299]);
        $service->request('POST', '/connect/token', [], [], [], ['grant_type' => 'client_credentials', 'client_id' => 'ack_example'], 'application/x-www-form-urlencoded', false);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://checkout.example.test/payments/pay%20123?expand=actions&expand=balances'
            && $request->hasHeader('Authorization', 'Bearer secret'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://checkout.example.test/payments'
            && $request->hasHeader('Cko-Idempotency-Key', 'pay-key')
            && $request['amount'] === 1299);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://access.checkout.example.test/connect/token'
            && !$request->hasHeader('Authorization')
            && $request['grant_type'] === 'client_credentials');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CheckoutComService('secret', 'https://checkout.example.test', 'https://access.checkout.example.test');

        self::assertTrue((new CheckoutComGetPaymentMethods($service))->execute([])->succeeded());
        self::assertTrue((new CheckoutComGetPaymentDetails($service))->execute(['id' => 'pay_123'])->succeeded());
        self::assertTrue((new CheckoutComRequestAPaymentOrPayout($service))->execute(['cko_idempotency_key' => 'key-1', 'body' => ['amount' => 1299]])->succeeded());
        self::assertTrue((new CheckoutComCaptureAPayment($service))->execute(['id' => 'pay_123', 'body' => ['amount' => 1299]])->succeeded());
        self::assertTrue((new CheckoutComRequestAnAccessToken(new CheckoutComService('', 'https://checkout.example.test', 'https://access.checkout.example.test')))->execute(['body' => ['grant_type' => 'client_credentials', 'client_id' => 'ack_example', 'client_secret' => 'secret']])->succeeded());

        $missingPath = (new CheckoutComGetPaymentDetails($service))->execute([]);
        $badBody = (new CheckoutComRequestAPaymentOrPayout($service))->execute(['body' => 'not-object']);
        $unconfigured = (new CheckoutComGetPaymentMethods(new CheckoutComService('', 'https://checkout.example.test')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('id must be', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_payment_methods_endpoint(): void
    {
        Http::fake(['checkout.example.test/payment-methods' => Http::response(['methods' => []], 200)]);

        $result = (new CheckoutComToolProvider)->testConnection(['api_key' => 'secret', 'url' => 'https://checkout.example.test']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://checkout.example.test/payment-methods'
            && $request->hasHeader('Authorization', 'Bearer secret'));
    }

    public function test_multi_account_resolves_key_and_urls(): void
    {
        Http::fake(['*' => Http::response(['merchant' => 'ok'], 200)]);

        app()->instance(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class, new class implements \OpenCompany\IntegrationCore\Contracts\CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['checkout-com', 'api_key', 'merchant'] => 'account-secret',
                    ['checkout-com', 'url', 'merchant'] => 'https://checkout.example.test',
                    ['checkout-com', 'access_url', 'merchant'] => 'https://access.checkout.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'checkout-com' && $account === 'merchant';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'checkout-com' ? ['merchant'] : [];
            }
        });

        $tool = (new CheckoutComToolProvider)->createTool(CheckoutComGetPaymentMethods::class, ['account' => 'merchant']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://checkout.example.test/payment-methods'
            && $request->hasHeader('Authorization', 'Bearer account-secret'));
    }
}
