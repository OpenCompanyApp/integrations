<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Wufoo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Wufoo\Tools\WufooAddWebhook;
use OpenCompany\Integrations\Wufoo\Tools\WufooApiGet;
use OpenCompany\Integrations\Wufoo\Tools\WufooSubmitEntry;
use OpenCompany\Integrations\Wufoo\WufooService;
use OpenCompany\Integrations\Wufoo\WufooToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Wufoo API v3 coverage.
 */
final class WufooServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_forms_entries_comments_reports_users_webhooks_and_generic_endpoints(): void
    {
        Http::fake([
            'https://example.wufoo.com/api/v3/*' => Http::response(['Success' => 1], 200),
        ]);

        $service = new WufooService('wufoo_test', 'https://example.wufoo.com/api/v3');

        $service->listForms(['pretty' => 'true']);
        $service->getForm('form1');
        $service->listFields('form1', ['system' => 'true']);
        $service->listEntries('form1', 0, 25, ['Filter1' => 'Field1+Is_equal_to+Example']);
        $service->countEntries('form1');
        $service->getEntry('form1', '123');
        $service->submitEntry('form1', ['Field1' => 'Example']);
        $service->listFormComments('form1', ['entryId' => 123]);
        $service->countFormComments('form1');
        $service->listReports();
        $service->getReport('report1');
        $service->listReportEntries('report1', ['pageSize' => 10]);
        $service->countReportEntries('report1');
        $service->listReportFields('report1');
        $service->listReportWidgets('report1');
        $service->listUsers();
        $service->addWebhook('form1', 'https://example.test/wufoo', 'secret', true);
        $service->deleteWebhook('form1', 'hook1');
        $service->apiGet('/forms.json', ['pretty' => 'true']);
        $service->apiPost('/forms/form1/entries.json', ['Field1' => 'Example']);
        $service->apiPut('/forms/form1/webhooks.json', ['url' => 'https://example.test/wufoo']);
        $service->apiDelete('/forms/form1/webhooks/hook1.json');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('wufoo_test:footastic')));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.wufoo.com/api/v3/forms.json?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/forms/form1.json');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.wufoo.com/api/v3/forms/form1/fields.json?'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), '/forms/form1/entries.json?'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'Filter1=EntryId%2BIs_equal_to%2B123'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/forms/form1/entries/count.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.wufoo.com/api/v3/forms/form1/entries.json');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.wufoo.com/api/v3/forms/form1/comments.json?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/forms/form1/comments/count.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/reports.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/reports/report1.json');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.wufoo.com/api/v3/reports/report1/entries.json?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/reports/report1/entries/count.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/reports/report1/fields.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/reports/report1/widgets.json');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.wufoo.com/api/v3/users.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://example.wufoo.com/api/v3/forms/form1/webhooks.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://example.wufoo.com/api/v3/forms/form1/webhooks/hook1.json');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://example.wufoo.com/api/v3/*' => Http::response(['Success' => 1], 200),
        ]);

        $service = new WufooService('wufoo_test', 'https://example.wufoo.com/api/v3');

        self::assertTrue((new WufooSubmitEntry($service))->execute([
            'form_id' => 'form1',
            'fields' => ['Field1' => 'Example'],
        ])->succeeded());
        self::assertTrue((new WufooAddWebhook($service))->execute([
            'form_id' => 'form1',
            'url' => 'https://example.test/wufoo',
        ])->succeeded());
        self::assertTrue((new WufooApiGet($service))->execute([
            'path' => '/forms.json',
        ])->succeeded());

        self::assertFalse((new WufooSubmitEntry($service))->execute([
            'form_id' => 'form1',
            'fields' => [],
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://example.wufoo.com/api/v3/users.json' => Http::response(['Users' => [['FirstName' => 'Example']]], 200),
        ]);

        $provider = new WufooToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('wufoo_list_fields', $tools);
        self::assertArrayHasKey('wufoo_submit_entry', $tools);
        self::assertArrayHasKey('wufoo_count_entries', $tools);
        self::assertArrayHasKey('wufoo_list_report_widgets', $tools);
        self::assertArrayHasKey('wufoo_add_webhook', $tools);
        self::assertArrayHasKey('wufoo_api_delete', $tools);
        self::assertSame(23, count($tools));
        self::assertTrue($provider->testConnection([
            'api_key' => 'wufoo_test',
            'base_url' => 'https://example.wufoo.com/api/v3',
        ])['success']);
    }
}
