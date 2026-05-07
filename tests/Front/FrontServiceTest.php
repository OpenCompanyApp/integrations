<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Front;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Front\FrontService;
use OpenCompany\Integrations\Front\FrontToolProvider;
use OpenCompany\Integrations\Front\Tools\FrontAddComment;
use OpenCompany\Integrations\Front\Tools\FrontApiGet;
use OpenCompany\Integrations\Front\Tools\FrontCreateContact;
use OpenCompany\Integrations\Front\Tools\FrontSendMessage;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Front endpoint coverage and metadata.
 */
final class FrontServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FrontService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FrontService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_raw_front_methods_and_token_auth(): void
    {
        Http::fake(['*' => Http::response(['_results' => []], 200)]);

        $service = new FrontService('front-token');
        $service->apiGet('/conversations', ['limit' => 10]);
        $service->apiPost('/contacts', ['handles' => [['source' => 'email', 'handle' => 'person@example.test']]]);
        $service->apiPatch('/conversations/cnv_123', ['status' => 'archived']);
        $service->apiPut('/some/resource', ['name' => 'Example']);
        $service->apiDelete('/tags/tag_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer front-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api2.frontapp.com/conversations?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api2.frontapp.com/contacts'
            && $request['handles'][0]['handle'] === 'person@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api2.frontapp.com/conversations/cnv_123'
            && $request['status'] === 'archived');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api2.frontapp.com/some/resource');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api2.frontapp.com/tags/tag_123');
    }

    public function test_endpoint_tools_shape_front_payloads(): void
    {
        $service = new FrontService('front-token');

        Http::fake(['*' => Http::response(['_results' => []], 200)]);
        self::assertTrue((new FrontApiGet($service))->execute([
            'path' => '/tags',
            'query' => ['limit' => 5],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api2.frontapp.com/tags?limit=5');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'msg_123'], 202)]);
        self::assertTrue((new FrontSendMessage($service))->execute([
            'conversation_id' => 'cnv_123',
            'body' => '<p>Hello</p>',
            'to' => ['person@example.test'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api2.frontapp.com/conversations/cnv_123/messages'
            && $request['body'] === '<p>Hello</p>'
            && $request['to'][0] === 'person@example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'com_123'], 201)]);
        self::assertTrue((new FrontAddComment($service))->execute([
            'conversation_id' => 'cnv_123',
            'body' => 'Internal note',
            'is_pinned' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request['body'] === 'Internal note'
            && $request['is_pinned'] === true);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'crd_123'], 201)]);
        self::assertTrue((new FrontCreateContact($service))->execute([
            'handles' => [['source' => 'email', 'handle' => 'new@example.test']],
            'name' => 'Example Person',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api2.frontapp.com/contacts'
            && $request['handles'][0]['source'] === 'email'
            && $request['name'] === 'Example Person');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new FrontToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(60, count($tools));
        self::assertArrayHasKey('front_api_get', $tools);
        self::assertArrayHasKey('front_search_conversations', $tools);
        self::assertArrayHasKey('front_create_contact', $tools);
        self::assertArrayHasKey('front_list_team_tags', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new FrontService('front-token'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No access token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['first_name' => 'Ada', 'last_name' => 'Lovelace'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Front API as Ada Lovelace.'], $provider->testConnection([
            'access_token' => 'front-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['_results' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['front', 'access_token', 'support'] => 'account-token',
                    ['front', 'url', 'support'] => 'https://front.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'front' && $account === 'support';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'front' ? ['support'] : [];
            }
        });

        $tool = $provider->createTool(FrontApiGet::class, ['account' => 'support']);
        self::assertTrue($tool->execute(['path' => '/conversations'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://front.example.test/conversations'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
