<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Abyssale;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Abyssale\AbyssaleService;
use OpenCompany\Integrations\Abyssale\AbyssaleToolProvider;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleApiGet;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGenerateMultiFormatMedia;
use OpenCompany\Integrations\Abyssale\Tools\AbyssaleGetDesign;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Abyssale's documented REST endpoint mapping.
 */
final class AbyssaleServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_documented_abyssale_api_reference_endpoints(): void
    {
        Http::fake([
            'https://api.abyssale.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AbyssaleService('abyssale_test', 'https://api.abyssale.test');

        $service->listDesigns();
        $service->getDesign('design_123');
        $service->getDesignFormat('design_123', 'facebook-feed');
        $service->generateImage('design_123', ['title' => ['text' => 'Launch']], 'facebook-feed');
        $service->generateMultiFormatMedia('design_123', [
            'elements' => ['title' => ['text' => 'Launch']],
            'template_format_names' => ['facebook-feed'],
        ]);
        $service->listFonts();
        $service->createBannerExport(['banner_123'], 'https://example.test/export');
        $service->getFile('banner_123');
        $service->listProjects();
        $service->createProject('Summer Campaign');
        $service->duplicateWorkspaceTemplate('template_123', 'project_123', 'Localized banner');
        $service->getDuplicationRequest('duplicate_123');
        $service->createDynamicImageUrl('design_123', ['enable_rate_limit' => true]);
        $service->generateMultiPagePdf('design_123', ['page_1' => ['title' => ['text' => 'Page one']]]);
        $service->apiGet('/designs');
        $service->apiPost('/projects', ['name' => 'Campaign']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('x-api-key', 'abyssale_test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/designs');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/designs/design_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/designs/design_123/formats/facebook-feed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.abyssale.test/banner-builder/design_123/generate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.abyssale.test/async/banner-builder/design_123/generate');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/fonts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.abyssale.test/async/banners/export');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/banners/banner_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.abyssale.test/projects');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.abyssale.test/projects');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/workspace-templates/template_123/use');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/design-duplication-requests/duplicate_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/designs/design_123/dynamic-image-url');
    }

    public function test_tools_delegate_and_preserve_abyssale_payload_shapes(): void
    {
        Http::fake([
            'https://api.abyssale.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new AbyssaleService('abyssale_test', 'https://api.abyssale.test');

        self::assertTrue((new AbyssaleGetDesign($service))->execute([
            'design_id' => 'design_123',
        ])->succeeded());
        self::assertTrue((new AbyssaleGenerateMultiFormatMedia($service))->execute([
            'design_id' => 'design_123',
            'elements' => ['title' => ['text' => 'Launch']],
            'template_format_names' => ['facebook-feed'],
            'callback_url' => 'https://example.test/hook',
        ])->succeeded());
        self::assertTrue((new AbyssaleApiGet($service))->execute([
            'path' => '/designs',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.abyssale.test/designs/design_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.abyssale.test/async/banner-builder/design_123/generate'
            && $request->data()['template_format_names'] === ['facebook-feed']
            && $request->data()['callback_url'] === 'https://example.test/hook');
    }

    public function test_provider_exposes_current_reference_tools_and_allowed_category(): void
    {
        Http::fake([
            'https://api.abyssale.com/designs' => Http::response([], 200),
        ]);

        $provider = new AbyssaleToolProvider();
        $tools = $provider->tools();

        self::assertSame('rendering', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('abyssale_list_designs', $tools);
        self::assertArrayHasKey('abyssale_generate_multi_format_media', $tools);
        self::assertArrayHasKey('abyssale_create_banner_export', $tools);
        self::assertArrayHasKey('abyssale_duplicate_workspace_template', $tools);
        self::assertArrayHasKey('abyssale_create_dynamic_image_url', $tools);
        self::assertArrayHasKey('abyssale_generate_multi_page_pdf', $tools);
        self::assertArrayHasKey('abyssale_api_post', $tools);
        self::assertArrayNotHasKey('abyssale_get_current_user', $tools);
        self::assertSame(16, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'abyssale_test'])['success']);
    }
}
