<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Dub;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Dub\DubService;
use OpenCompany\Integrations\Dub\DubToolProvider;
use OpenCompany\Integrations\Dub\Tools\DubLinksUpdate;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Dub API coverage and request mapping.
 */
final class DubServiceTest extends TestCase
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

    public function test_provider_exposes_official_dub_surface(): void
    {
        $provider = new DubToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://dub.co/docs/api-reference', $provider->integrationMeta()['docs_url']);
        self::assertCount(52, $tools);
        self::assertArrayHasKey('dub_links_list', $tools);
        self::assertArrayHasKey('dub_analytics_retrieve', $tools);
        self::assertArrayHasKey('dub_partners_analytics', $tools);
        self::assertArrayHasKey('dub_track_sale', $tools);
        self::assertArrayNotHasKey('dub_get_current_user', $tools);

        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__.'/../../packages/dub/src/Tools/'.$shortName.'.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_maps_query_path_json_and_bearer_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new DubService('dub-token', 'https://api.example.test');
        $service->call('dub_links_list', ['query' => ['pageSize' => 5]]);
        $service->call('dub_links_update', [
            'link_id' => 'link_123',
            'payload' => ['url' => 'https://example.test/updated'],
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/links?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer dub-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.example.test/links/link_123'
            && $request->hasHeader('Authorization', 'Bearer dub-token')
            && $request['url'] === 'https://example.test/updated');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new DubLinksUpdate(new DubService('dub-token'));
        $result = $tool->execute(['payload' => ['url' => 'https://example.test']]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('link_id is required', (string) $result->error);
    }
}
