<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ApiTemplateIO;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOService;
use OpenCompany\Integrations\ApiTemplateIO\ApiTemplateIOToolProvider;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreateImage;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOCreatePdfFromHtml;
use OpenCompany\Integrations\ApiTemplateIO\Tools\ApiTemplateIOMergePdfs;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for APITemplate.io REST API v2 endpoint coverage and provider metadata.
 */
final class ApiTemplateIOServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_v2_generation_and_management_paths(): void
    {
        Http::fake([
            'https://api.apitemplate.test/v2/create-pdf*' => Http::response(['status' => 'success', 'download_url' => 'https://cdn.example.test/a.pdf'], 200),
            'https://api.apitemplate.test/v2/create-image*' => Http::response(['status' => 'success', 'download_url_png' => 'https://cdn.example.test/a.png'], 200),
            'https://api.apitemplate.test/v2/create-pdf-from-html*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/create-pdf-from-url*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/create-pdf-from-markdown*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/list-objects*' => Http::response(['status' => 'success', 'objects' => []], 200),
            'https://api.apitemplate.test/v2/delete-object*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/account-information' => Http::response(['status' => 'success', 'plan' => 'test'], 200),
            'https://api.apitemplate.test/v2/list-templates*' => Http::response(['status' => 'success', 'templates' => []], 200),
            'https://api.apitemplate.test/v2/get-template*' => Http::response(['status' => 'success', 'template_id' => 'tpl_123'], 200),
            'https://api.apitemplate.test/v2/update-template' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/merge-pdfs' => Http::response(['status' => 'success', 'download_url' => 'https://cdn.example.test/merged.pdf'], 200),
        ]);

        $service = new ApiTemplateIOService('key_test', 'https://api.apitemplate.test');
        $service->createPdf('tpl_123', ['invoice_number' => 'INV-001'], ['filename' => 'invoice.pdf', 'async' => '1']);
        $service->createImage('tpl_img', ['overrides' => [['name' => 'title', 'text' => 'Launch']]], ['output_image_type' => 'pngOnly']);
        $service->createPdfFromHtml('<h1>{{name}}</h1>', '<style>h1{color:blue}</style>', ['name' => 'Ada'], ['paper_size' => 'A4']);
        $service->createPdfFromUrl('https://example.test/report', ['print_background' => '1']);
        $service->createPdfFromMarkdown('# {{title}}', '', ['title' => 'Report']);
        $service->listObjects(['limit' => 25, 'transaction_type' => 'PDF']);
        $service->deleteObject('txn_123');
        $service->getCurrentUser();
        $service->listTemplates(['format' => 'PDF', 'with_layer_info' => '1']);
        $service->getTemplate('tpl_123');
        $service->updateTemplate('tpl_123', ['body' => '<h1>Updated</h1>']);
        $service->mergePdfs(['https://example.test/a.pdf', 'https://example.test/b.pdf'], ['expiration' => 60]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-API-KEY', 'key_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/create-pdf?')
            && str_contains($request->url(), 'template_id=tpl_123')
            && str_contains($request->url(), 'filename=invoice.pdf')
            && str_contains($request->url(), 'async=1')
            && $request['invoice_number'] === 'INV-001');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/create-image?')
            && str_contains($request->url(), 'template_id=tpl_img')
            && str_contains($request->url(), 'output_image_type=pngOnly')
            && $request['overrides'][0]['text'] === 'Launch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.apitemplate.test/v2/create-pdf-from-html'
            && $request['body'] === '<h1>{{name}}</h1>'
            && $request['data']['name'] === 'Ada'
            && $request['settings']['paper_size'] === 'A4');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.apitemplate.test/v2/create-pdf-from-url'
            && $request['url'] === 'https://example.test/report');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.apitemplate.test/v2/create-pdf-from-markdown'
            && $request['body'] === '# {{title}}');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/list-objects?')
            && str_contains($request->url(), 'limit=25')
            && str_contains($request->url(), 'transaction_type=PDF'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/delete-object?')
            && str_contains($request->url(), 'transaction_ref=txn_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.apitemplate.test/v2/account-information');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/list-templates?')
            && str_contains($request->url(), 'format=PDF')
            && str_contains($request->url(), 'with_layer_info=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.apitemplate.test/v2/get-template?')
            && str_contains($request->url(), 'template_id=tpl_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.apitemplate.test/v2/update-template'
            && $request['template_id'] === 'tpl_123'
            && $request['body'] === '<h1>Updated</h1>');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.apitemplate.test/v2/merge-pdfs'
            && $request['expiration'] === 60
            && $request['urls'][1] === 'https://example.test/b.pdf');
    }

    public function test_tools_map_agent_arguments_to_current_v2_payloads(): void
    {
        Http::fake([
            'https://api.apitemplate.test/v2/create-image*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/create-pdf-from-html*' => Http::response(['status' => 'success'], 200),
            'https://api.apitemplate.test/v2/merge-pdfs' => Http::response(['status' => 'success'], 200),
        ]);

        $service = new ApiTemplateIOService('key_test', 'https://api.apitemplate.test');
        self::assertNull((new ApiTemplateIOCreateImage($service))->execute([
            'template_id' => 'tpl_img',
            'overrides' => [['name' => 'title', 'text' => 'Hello']],
            'output_format' => 'png',
        ])->error);
        self::assertNull((new ApiTemplateIOCreatePdfFromHtml($service))->execute([
            'body' => '<h1>{{name}}</h1>',
            'data' => ['name' => 'Ada'],
            'async' => true,
            'webhook_url' => 'https://example.test/webhook',
        ])->error);
        self::assertNull((new ApiTemplateIOMergePdfs($service))->execute([
            'urls' => ['https://example.test/a.pdf', 'https://example.test/b.pdf'],
            'export_type' => 'json',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.apitemplate.test/v2/create-image?')
            && str_contains($request->url(), 'output_image_type=pngOnly')
            && $request['overrides'][0]['name'] === 'title');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.apitemplate.test/v2/create-pdf-from-html?')
            && str_contains($request->url(), 'async=1')
            && str_contains($request->url(), 'webhook_url=https%3A%2F%2Fexample.test%2Fwebhook')
            && $request['data']['name'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.apitemplate.test/v2/merge-pdfs'
            && $request['export_type'] === 'json'
            && $request['urls'][0] === 'https://example.test/a.pdf');
    }

    public function test_provider_exposes_v2_surface_and_rendering_category(): void
    {
        $provider = new ApiTemplateIOToolProvider();
        $tools = $provider->tools();

        self::assertSame('rendering', $provider->integrationMeta()['category']);
        self::assertSame('https://apitemplate.io/apiv2/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://rest.apitemplate.io', $provider->credentialFields()[1]['default']);
        self::assertArrayHasKey('apitemplateio_create_pdf_from_html', $tools);
        self::assertArrayHasKey('apitemplateio_create_pdf_from_url', $tools);
        self::assertArrayHasKey('apitemplateio_create_pdf_from_markdown', $tools);
        self::assertArrayHasKey('apitemplateio_list_objects', $tools);
        self::assertArrayHasKey('apitemplateio_delete_object', $tools);
        self::assertArrayHasKey('apitemplateio_update_template', $tools);
        self::assertArrayHasKey('apitemplateio_merge_pdfs', $tools);
        self::assertSame(12, count($tools));
    }
}
