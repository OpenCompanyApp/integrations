<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Capsule;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Capsule\CapsuleService;
use OpenCompany\Integrations\Capsule\CapsuleToolProvider;
use OpenCompany\Integrations\Capsule\Tools\CapsuleApiGet;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateCase;
use OpenCompany\Integrations\Capsule\Tools\CapsuleCreateTag;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Capsule CRM API integration.
 */
final class CapsuleServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CapsuleService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CapsuleService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new CapsuleToolProvider;

        self::assertSame('capsule', $provider->appName());
        self::assertSame('Capsule CRM', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(36, $provider->tools());
        self::assertArrayHasKey('capsule_update_contact', $provider->tools());
        self::assertArrayHasKey('capsule_list_cases', $provider->tools());
        self::assertArrayHasKey('capsule_create_task', $provider->tools());
        self::assertArrayHasKey('capsule_list_tracks', $provider->tools());
        self::assertArrayHasKey('capsule_list_custom_fields', $provider->tools());
        self::assertArrayHasKey('capsule_api_delete', $provider->tools());
    }

    public function test_service_maps_party_opportunity_case_task_schema_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CapsuleService('token-test', 'https://example.test/api/v2');
        $service->listContacts(2, 25, ['embed' => ['tags', 'fields']]);
        $service->createParty(['type' => 'person', 'firstName' => 'Ada']);
        $service->updateParty(123, ['lastName' => 'Lovelace']);
        $service->listPartyOpportunities(123, ['embed' => 'party']);
        $service->createOpportunity(['name' => 'New deal']);
        $service->updateOpportunity(456, ['name' => 'Updated deal']);
        $service->listCases(['page' => 1]);
        $service->listPartyCases(123, ['perPage' => 10]);
        $service->createCase(['name' => 'Implementation']);
        $service->updateCase(789, ['name' => 'Updated implementation']);
        $service->createTask(['description' => 'Follow up']);
        $service->updateTask(321, ['status' => 'COMPLETED']);
        $service->listTracks(['entity' => 'kases']);
        $service->listTags('contacts', ['page' => 1]);
        $service->createTag('opportunities', ['name' => 'Priority']);
        $service->updateTag('cases', 55, ['name' => 'Project']);
        $service->listCustomFields('parties', ['perPage' => 100]);
        $service->createCustomField('opportunity', ['name' => 'Region', 'type' => 'text']);
        $service->updateCustomField('project', 77, ['name' => 'Segment']);
        $service->apiGet('/parties', ['include' => ['one', 'two']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/v2/parties?embed=tags&embed=fields&page=2&perPage=25'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/v2/parties'
            && $request['party']['firstName'] === 'Ada');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/v2/parties/123/opportunities?embed=party');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/v2/kases'
            && $request['kase']['name'] === 'Implementation');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/v2/opportunities/tags'
            && $request['tag']['name'] === 'Priority');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://example.test/api/v2/kases/tags/55'
            && $request['tag']['name'] === 'Project');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/api/v2/opportunities/fields/definitions'
            && $request['definition']['name'] === 'Region');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://example.test/api/v2/kases/fields/definitions/77'
            && $request['definition']['name'] === 'Segment');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/v2/parties?include=one&include=two');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/parties');
    }

    public function test_tools_validate_arguments_and_unconfigured_service(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new CapsuleService('token-test', 'https://example.test/api/v2');
        $case = (new CapsuleCreateCase($service))->execute([
            'kase' => ['name' => 'Implementation'],
        ]);
        $tag = (new CapsuleCreateTag($service))->execute([
            'entity' => 'parties',
            'tag' => ['name' => 'Customer'],
        ]);
        $raw = (new CapsuleApiGet($service))->execute([
            'path' => '/parties',
        ]);

        self::assertTrue($case->succeeded());
        self::assertTrue($tag->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new CapsuleCreateTag($service))->execute(['tag' => []]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('entity is required', (string) $missing->error);

        $unconfigured = (new CapsuleApiGet(new CapsuleService('', 'https://example.test/api/v2')))->execute([
            'path' => '/parties',
        ]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_current_user_endpoint(): void
    {
        Http::fake(['*' => Http::response(['user' => ['firstName' => 'Ada', 'lastName' => 'Lovelace']], 200)]);

        $result = (new CapsuleToolProvider)->testConnection([
            'access_token' => 'token-test',
            'url' => 'https://example.test/api/v2',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/api/v2/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
