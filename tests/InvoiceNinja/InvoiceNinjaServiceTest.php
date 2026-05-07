<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\InvoiceNinja;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaService;
use OpenCompany\Integrations\InvoiceNinja\InvoiceNinjaToolProvider;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaBulkInvoices;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaCreateQuote;
use OpenCompany\Integrations\InvoiceNinja\Tools\InvoiceNinjaUpdateClient;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Invoice Ninja endpoint mapping and catalog metadata.
 */
final class InvoiceNinjaServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(InvoiceNinjaService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(InvoiceNinjaService::class);
        parent::tearDown();
    }

    public function test_service_maps_documented_v1_routes_and_token_header(): void
    {
        Http::fake([
            'https://api.example.test/api/v1/*' => Http::response(['data' => ['ok' => true]], 200),
        ]);

        $service = new InvoiceNinjaService('token_test', 'https://api.example.test');

        $service->apiGet('/api/v1/clients', ['per_page' => 50, 'page' => 2, 'balance' => 'gt:1000']);
        $service->apiPost('/api/v1/quotes', ['client_id' => 'client_123']);
        $service->apiPut('/api/v1/expenses/expense_123', ['amount' => 12.5]);
        $service->apiDelete('/api/v1/vendors/vendor_123');
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-API-TOKEN', 'token_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v1/clients?per_page=50&page=2&balance=gt%3A1000');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/quotes'
            && $request['client_id'] === 'client_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/api/v1/expenses/expense_123'
            && $request['amount'] === 12.5);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.example.test/api/v1/vendors/vendor_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/api/v1/users/me');
    }

    public function test_generic_endpoint_tools_delegate_to_expanded_surface(): void
    {
        Http::fake([
            'https://api.example.test/api/v1/*' => Http::response(['data' => ['ok' => true]], 200),
        ]);

        $service = new InvoiceNinjaService('token_test', 'https://api.example.test');

        self::assertNull((new InvoiceNinjaCreateQuote($service))->execute([
            'payload' => ['client_id' => 'client_123'],
        ])->error);
        self::assertNull((new InvoiceNinjaUpdateClient($service))->execute([
            'id' => 'client_123',
            'payload' => ['name' => 'Example Client', 'contacts' => []],
        ])->error);
        self::assertNull((new InvoiceNinjaBulkInvoices($service))->execute([
            'payload' => ['action' => 'archive', 'ids' => ['invoice_123']],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/quotes'
            && $request['client_id'] === 'client_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.example.test/api/v1/clients/client_123'
            && $request['name'] === 'Example Client');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/api/v1/invoices/bulk'
            && $request['action'] === 'archive');
    }

    public function test_provider_exposes_expanded_catalog_metadata(): void
    {
        Http::fake([
            'https://api.example.test/api/v1/users/me' => Http::response([
                'data' => ['first_name' => 'Ada'],
            ], 200),
        ]);

        $provider = new InvoiceNinjaToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://invoiceninja.github.io/docs/api-reference/invoice-ninja-api-reference', $provider->integrationMeta()['docs_url']);
        self::assertSame(100, count($tools));
        self::assertArrayHasKey('invoiceninja_create_quote', $tools);
        self::assertArrayHasKey('invoiceninja_list_expenses', $tools);
        self::assertArrayHasKey('invoiceninja_refund_payment', $tools);
        self::assertArrayHasKey('invoiceninja_list_recurring_invoices', $tools);
        self::assertArrayHasKey('invoiceninja_statics', $tools);

        self::assertTrue($provider->testConnection([
            'api_token' => 'token_test',
            'url' => 'https://api.example.test',
        ])['success']);
    }
}
