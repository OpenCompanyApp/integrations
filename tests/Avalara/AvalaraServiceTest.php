<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Avalara;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Avalara\AvalaraService;
use OpenCompany\Integrations\Avalara\AvalaraToolProvider;
use OpenCompany\Integrations\Avalara\Tools\AvalaraGetCompany;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Avalara official AvaTax REST API coverage.
 */
final class AvalaraServiceTest extends TestCase
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

    public function test_provider_exposes_official_avatax_surface(): void
    {
        $provider = new AvalaraToolProvider;
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.avalara.com/api-reference/avatax/rest/v2/', $provider->integrationMeta()['docs_url']);
        self::assertCount(433, $tools);
        self::assertArrayHasKey('avalara_create_transaction', $tools);
        self::assertArrayHasKey('avalara_query_companies', $tools);
        self::assertArrayHasKey('avalara_query_tax_codes', $tools);
        self::assertArrayHasKey('avalara_ping', $tools);
        self::assertArrayNotHasKey('avalara_list_transactions', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/avalara/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_base_url_auth_default_company_path_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AvalaraService(accountId: 'acct-123', licenseKey: 'license-456', companyId: 'co-789', baseUrl: 'https://sandbox.example.test/api/v2');
        $service->call('avalara_query_companies', ['top' => 10, 'filter' => 'isActive eq true']);
        $service->call('avalara_create_transaction', ['include' => 'Summary', 'body' => ['companyCode' => 'DEFAULT', 'lines' => []]]);
        $service->call('avalara_query_customers', ['top' => 5]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sandbox.example.test/api/v2/companies?%24filter=isActive%20eq%20true&%24top=10'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('acct-123:license-456'))
            && $request->hasHeader('X-Avalara-Client'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://sandbox.example.test/api/v2/transactions/create?%24include=Summary'
            && $request->data()['companyCode'] === 'DEFAULT');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sandbox.example.test/api/v2/companies/co-789/customers?%24top=5');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new AvalaraGetCompany(new AvalaraService(accessToken: 'token'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('id is required', (string) $result->error);
    }
}
