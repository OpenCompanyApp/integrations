<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Canva;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Canva\CanvaService;
use OpenCompany\Integrations\Canva\CanvaToolProvider;
use OpenCompany\Integrations\Canva\Tools\CanvaGetDesign;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Canva Connect API coverage and request mapping.
 */
final class CanvaServiceTest extends TestCase
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

    public function test_provider_exposes_official_canva_connect_surface(): void
    {
        $provider = new CanvaToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://www.canva.dev/docs/connect/', $provider->integrationMeta()['docs_url']);
        self::assertCount(48, $tools);
        self::assertArrayHasKey('canva_create_url_asset_upload_job', $tools);
        self::assertArrayHasKey('canva_create_design_export_job', $tools);
        self::assertArrayHasKey('canva_get_current_user', $tools);
        self::assertArrayNotHasKey('canva_list_folders', $tools);
        self::assertArrayNotHasKey('canva_upload_asset', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/canva/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_maps_query_path_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CanvaService('canva-token', 'https://api.example.test/rest');
        $service->call('canva_get_design_pages', [
            'design_id' => 'DAGexample',
            'offset' => 2,
            'limit' => 5,
        ]);
        $service->call('canva_create_design_export_job', [
            'payload' => [
                'design_id' => 'DAGexample',
                'format' => ['type' => 'pdf'],
            ],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/rest/v1/designs/DAGexample/pages?offset=2&limit=5'
            && $request->hasHeader('Authorization', 'Bearer canva-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/rest/v1/exports'
            && $request->hasHeader('Authorization', 'Bearer canva-token')
            && $request['design_id'] === 'DAGexample'
            && $request['format']['type'] === 'pdf');
    }

    public function test_oauth_form_operations_can_use_client_credentials(): void
    {
        Http::fake(['*' => Http::response(['access_token' => 'new-token'], 200)]);

        $service = new CanvaService('', 'https://api.example.test/rest', 'client-id', 'client-secret');
        $service->call('canva_exchange_access_token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => 'refresh-token',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/rest/v1/oauth/token'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('client-id:client-secret'))
            && $request['grant_type'] === 'refresh_token'
            && $request['refresh_token'] === 'refresh-token');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new CanvaGetDesign(new CanvaService('canva-token'));
        $result = $tool->execute([]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('design_id is required', (string) $result->error);
    }
}
