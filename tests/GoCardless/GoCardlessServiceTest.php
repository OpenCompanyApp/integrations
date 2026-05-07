<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoCardless;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoCardless\GoCardlessService;
use OpenCompany\Integrations\GoCardless\GoCardlessToolProvider;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCancelPayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessCreatePayment;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetBankAccountDetails;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessGetPayments;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListBillingRequest;
use OpenCompany\Integrations\GoCardless\Tools\GoCardlessListPayment;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated GoCardless OpenAPI integration.
 */
final class GoCardlessServiceTest extends TestCase
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
        $provider = new GoCardlessToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/gocardless/gocardless-openapi-manifest.json'), true);

        self::assertSame(137, $manifest['method_count']);
        self::assertSame('2015-07-06', $manifest['version']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('GoCardless', $provider->integrationMeta()['name']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('gocardless_list_payment', array_keys($provider->tools()));
        self::assertContains('gocardless_create_payment', array_keys($provider->tools()));
        self::assertContains('gocardless_list_billing_request', array_keys($provider->tools()));
    }

    public function test_service_injects_bearer_version_header_and_maps_path_query_arrays_body_and_idempotency(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoCardlessService('token', 'https://gocardless.example.test', '2015-07-06');
        $service->request('GET', '/payments', [], ['status' => ['confirmed', 'paid_out'], 'limit' => 2]);
        $service->request('GET', '/payments/{payment_id}', ['payment_id' => 'PM 123']);
        $service->request('POST', '/payments', [], [], ['Idempotency-Key' => 'payment-key'], ['payments' => ['amount' => 1299]]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gocardless.example.test/payments?status=confirmed&status=paid_out&limit=2'
            && $request->hasHeader('Authorization', 'Bearer token')
            && $request->hasHeader('GoCardless-Version', '2015-07-06'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gocardless.example.test/payments/PM%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://gocardless.example.test/payments'
            && $request->hasHeader('Idempotency-Key', 'payment-key')
            && $request['payments']['amount'] === 1299);
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoCardlessService('token', 'https://gocardless.example.test');

        self::assertTrue((new GoCardlessListPayment($service))->execute(['limit' => 5])->succeeded());
        self::assertTrue((new GoCardlessListBillingRequest($service))->execute(['limit' => 5])->succeeded());
        self::assertTrue((new GoCardlessGetPayments($service))->execute(['payment_id' => 'PM000000000000'])->succeeded());
        self::assertTrue((new GoCardlessGetBankAccountDetails($service))->execute(['customer_bank_account_id' => 'BA000000000000', 'gc_key_id' => 'key-id-example'])->succeeded());
        self::assertTrue((new GoCardlessCancelPayment($service))->execute(['payment_id' => 'PM000000000000', 'body' => ['payments' => ['metadata' => ['reason' => 'example']]]])->succeeded());
        self::assertTrue((new GoCardlessCreatePayment($service))->execute(['idempotency_key' => 'key-1', 'body' => ['payments' => ['amount' => 1299]]])->succeeded());

        $missingPath = (new GoCardlessGetPayments($service))->execute([]);
        $badBody = (new GoCardlessCreatePayment($service))->execute(['body' => 'not-object']);
        $unconfigured = (new GoCardlessListPayment(new GoCardlessService('', 'https://gocardless.example.test')))->execute([]);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('payment_id must be', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gocardless.example.test/bank_account_details/BA000000000000'
            && $request->hasHeader('Gc-Key-Id', 'key-id-example'));
    }

    public function test_connection_uses_creditors_endpoint_with_version_header(): void
    {
        Http::fake(['gocardless.example.test/creditors*' => Http::response(['creditors' => []], 200)]);

        $result = (new GoCardlessToolProvider)->testConnection(['api_key' => 'token', 'url' => 'https://gocardless.example.test', 'api_version' => '2015-07-06']);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://gocardless.example.test/creditors?limit=1'
            && $request->hasHeader('Authorization', 'Bearer token')
            && $request->hasHeader('GoCardless-Version', '2015-07-06'));
    }
}
