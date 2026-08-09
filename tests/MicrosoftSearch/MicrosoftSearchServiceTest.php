<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftSearch;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftSearch\MicrosoftSearchService;
use OpenCompany\Integrations\MicrosoftSearch\MicrosoftSearchToolProvider;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchGetBookmarks;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchListAcronyms;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchListBookmarks;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchListQnas;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchQuery;
use OpenCompany\Integrations\MicrosoftSearch\Tools\MicrosoftSearchSearchUpdateBookmarks;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Search integration.
 */
final class MicrosoftSearchServiceTest extends TestCase
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
        $provider = new MicrosoftSearchToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-search/microsoft-search-openapi-manifest.json'), true);

        self::assertSame(21, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/search', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Search', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_search_search_query', array_keys($provider->tools()));
        self::assertContains('microsoft_search_search_list_bookmarks', array_keys($provider->tools()));
        self::assertContains('microsoft_search_search_get_bookmarks', array_keys($provider->tools()));
        self::assertContains('microsoft_search_search_list_acronyms', array_keys($provider->tools()));
        self::assertContains('microsoft_search_search_list_qnas', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_search_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftSearchService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/search/bookmarks/{bookmark-id}', ['bookmark-id' => 'bookmark 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/search/bookmarks/{bookmark-id}',
            ['bookmark-id' => 'bookmark 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['displayName' => 'Updated Bookmark'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/search/bookmarks/bookmark%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/search/bookmarks/bookmark%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['displayName'] === 'Updated Bookmark');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftSearchService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftSearchSearchListBookmarks($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftSearchSearchGetBookmarks($service))->execute(['bookmark_id' => 'bookmark-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftSearchSearchUpdateBookmarks($service))->execute(['bookmark_id' => 'bookmark-123', 'if_match' => 'W/"etag"', 'body' => ['displayName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftSearchSearchListAcronyms($service))->execute(['filter' => "startswith(displayName,'API')", 'count' => true, 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftSearchSearchListQnas($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftSearchSearchQuery($service))->execute(['body' => ['requests' => [['entityTypes' => ['driveItem'], 'query' => ['queryString' => 'quarterly report']]]]])->succeeded());

        $missingPath = (new MicrosoftSearchSearchGetBookmarks($service))->execute([]);
        $badBody = (new MicrosoftSearchSearchUpdateBookmarks($service))->execute(['bookmark_id' => 'bookmark-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftSearchSearchQuery($service))->execute([]);
        $unconfigured = (new MicrosoftSearchSearchGetBookmarks(new MicrosoftSearchService('', 'https://graph.example.test/v1.0')))->execute(['bookmark_id' => 'bookmark-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('bookmark_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_bookmarks_probe(): void
    {
        Http::fake(['*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftSearchToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/search/bookmarks?$top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftSearchToolProvider)->createTool(MicrosoftSearchSearchGetBookmarks::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['bookmark_id' => 'bookmark-123'])->succeeded());

        self::assertSame(['microsoft-search', 'microsoft-search'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
