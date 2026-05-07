<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Browserless;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Browserless\BrowserlessService;
use OpenCompany\Integrations\Browserless\BrowserlessToolProvider;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessDeleteBrowserWildcard;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessGetJsonVersion;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostChromeFunction;
use OpenCompany\Integrations\Browserless\Tools\BrowserlessPostScreenshot;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Browserless OpenAPI integration.
 */
final class BrowserlessServiceTest extends TestCase
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
        $provider = new BrowserlessToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/browserless/browserless-openapi-manifest.json'), true);

        self::assertSame(74, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Browserless', $provider->integrationMeta()['name']);
        self::assertSame('rendering', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('browserless_get_json_version', array_keys($provider->tools()));
        self::assertContains('browserless_post_screenshot', array_keys($provider->tools()));
        self::assertContains('browserless_post_chrome_function', array_keys($provider->tools()));
    }

    public function test_service_injects_token_and_maps_json_javascript_and_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BrowserlessService('key', 'https://browserless.example.test');
        $service->request('GET', '/json/version', [], ['timeout' => 10]);
        $service->request('POST', '/screenshot', [], [], [], ['url' => 'https://example.test']);
        $service->request('POST', '/chrome/function', [], [], [], ['code' => 'module.exports = async () => 1;'], 'javascript');
        $service->request('DELETE', '/browser/{path_suffix}', ['path_suffix' => 'browser 1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://browserless.example.test/json/version?timeout=10&token=key');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://browserless.example.test/screenshot?token=key'
            && $request['url'] === 'https://example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://browserless.example.test/chrome/function?token=key'
            && $request->hasHeader('Content-Type', 'application/javascript')
            && $request->body() === 'module.exports = async () => 1;');

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://browserless.example.test/browser/browser%201?token=key');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BrowserlessService('key', 'https://browserless.example.test');

        self::assertTrue((new BrowserlessGetJsonVersion($service))->execute([])->succeeded());
        self::assertTrue((new BrowserlessPostScreenshot($service))->execute(['body' => ['url' => 'https://example.test']])->succeeded());
        self::assertTrue((new BrowserlessPostChromeFunction($service))->execute(['code' => 'module.exports = async () => 1;'])->succeeded());

        $missing = (new BrowserlessDeleteBrowserWildcard($service))->execute([]);

        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('path_suffix must be', (string) $missing->error);
    }
}
