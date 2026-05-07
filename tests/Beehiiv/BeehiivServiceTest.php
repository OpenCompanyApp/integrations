<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Beehiiv;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Beehiiv\BeehiivService;
use OpenCompany\Integrations\Beehiiv\BeehiivToolProvider;
use OpenCompany\Integrations\Beehiiv\Tools\BeehiivAuthorsShow;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for beehiiv official OpenAPI operation coverage.
 */
final class BeehiivServiceTest extends TestCase
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

    public function test_provider_exposes_official_openapi_surface(): void
    {
        $provider = new BeehiivToolProvider;
        $tools = $provider->tools();
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(82, $tools);
        self::assertArrayHasKey('beehiiv_publications_index', $tools);
        self::assertArrayHasKey('beehiiv_posts_create', $tools);
        self::assertArrayHasKey('beehiiv_subscriptions_get_by_email', $tools);
        self::assertArrayHasKey('beehiiv_webhooks_test', $tools);
        self::assertArrayNotHasKey('beehiiv_list_posts', $tools);
        foreach ($tools as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], "\\") + 1);
            self::assertFileExists(__DIR__.'/../../packages/beehiiv/src/Tools/'.$shortName.'.php');
        }
    }

    public function test_service_maps_default_publication_path_query_body_and_auth(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new BeehiivService('key-123', 'pub_default', 'https://api.example.test/v2');
        $service->call('beehiiv_posts_index', ['limit' => 10]);
        $service->call('beehiiv_subscriptions_create', ['body' => ['email' => 'reader@example.test']]);
        $service->call('beehiiv_authors_show', ['author_id' => 'auth_123']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/publications/pub_default/posts?limit=10'
            && $request->hasHeader('Authorization', 'Bearer key-123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/v2/publications/pub_default/subscriptions'
            && $request->data()['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/v2/publications/pub_default/authors/auth_123');
    }

    public function test_tools_report_missing_required_path_arguments(): void
    {
        $tool = new BeehiivAuthorsShow(new BeehiivService('key'));
        $result = $tool->execute(['author_id' => 'auth_123']);
        self::assertFalse($result->succeeded());
        self::assertStringContainsString('publication_id is required', (string) $result->error);
    }
}