<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mindee;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Mindee\MindeeService;
use OpenCompany\Integrations\Mindee\MindeeToolProvider;
use OpenCompany\Integrations\Mindee\Tools\MindeeGetAsyncPrediction;
use OpenCompany\Integrations\Mindee\Tools\MindeeParseCustom;
use OpenCompany\Integrations\Mindee\Tools\MindeePredictDocument;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Mindee documented v1 endpoint mappings.
 */
final class MindeeServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_prediction_async_polling_and_convenience_endpoints(): void
    {
        Http::fake([
            'https://api.mindee.test/v1/*' => Http::response(['api_request' => ['status' => 'success'], 'job' => ['id' => 'job_123']], 201),
        ]);

        $service = new MindeeService('mindee_test', 'https://api.mindee.test/v1');

        $service->parseInvoice('base64-invoice', options: ['include_mvision' => true]);
        $service->parseReceipt('base64-receipt');
        $service->parsePassport('base64-passport');
        $service->parseCustom('acme/purchase_orders/v1', 'base64-custom');
        $service->predictProduct('mindee', 'bank_account_details', 'v2', 'base64-bank');
        $service->predictProductAsync('mindee', 'invoices', 'v4', 'base64-invoice');
        $service->getAsyncPrediction('mindee', 'invoices', 'v4', 'job_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Token mindee_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_starts_with($request->url(), 'https://api.mindee.test/v1/products/mindee/invoices/v4/predict?') && str_contains($request->url(), 'include_mvision=true') && $request['document'] === 'base64-invoice');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/mindee/expense_receipts/v5/predict' && $request['document'] === 'base64-receipt');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/mindee/passport/v1/predict');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/acme/purchase_orders/v1/predict');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/mindee/bank_account_details/v2/predict');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/mindee/invoices/v4/predict_async');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.mindee.test/v1/products/mindee/invoices/v4/documents/queue/job_123');
    }

    public function test_tools_delegate_to_generic_and_custom_service_methods(): void
    {
        Http::fake([
            'https://api.mindee.test/v1/*' => Http::response(['api_request' => ['status' => 'success']], 201),
        ]);

        $service = new MindeeService('mindee_test', 'https://api.mindee.test/v1');

        self::assertNull((new MindeePredictDocument($service))->execute([
            'account' => 'mindee',
            'api_name' => 'invoices',
            'api_version' => 'v4',
            'document' => 'base64-invoice',
        ])->error);
        self::assertNull((new MindeeParseCustom($service))->execute([
            'endpoint_id' => 'acme/purchase_orders/v1',
            'document' => 'base64-custom',
        ])->error);
        self::assertNull((new MindeeGetAsyncPrediction($service))->execute([
            'account' => 'mindee',
            'api_name' => 'invoices',
            'api_version' => 'v4',
            'job_id' => 'job_123',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/mindee/invoices/v4/predict');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mindee.test/v1/products/acme/purchase_orders/v1/predict');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.mindee.test/v1/products/mindee/invoices/v4/documents/queue/job_123');
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        $provider = new MindeeToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.mindee.com/docs/endpoints', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('mindee_predict_document', $tools);
        self::assertArrayHasKey('mindee_predict_document_async', $tools);
        self::assertArrayHasKey('mindee_get_async_prediction', $tools);
        self::assertArrayHasKey('mindee_parse_custom', $tools);
        self::assertArrayNotHasKey('mindee_get_current_user', $tools);
        self::assertSame(7, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'mindee_test'])['success']);
    }
}
