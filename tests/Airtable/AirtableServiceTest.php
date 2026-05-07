<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Airtable;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Airtable\AirtableService;
use OpenCompany\Integrations\Airtable\AirtableToolProvider;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateComment;
use OpenCompany\Integrations\Airtable\Tools\AirtableCreateRecord;
use OpenCompany\Integrations\Airtable\Tools\AirtableListRecords;
use OpenCompany\Integrations\Airtable\Tools\AirtableListWebhookPayloads;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Airtable endpoint mapping and metadata.
 */
final class AirtableServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AirtableService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AirtableService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_bearer_auth_and_maps_methods(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AirtableService(accessToken: 'pat-test');
        $service->apiGet('/meta/bases', ['offset' => 'itr123']);
        $service->apiPost('/app123/Contacts', ['fields' => ['Name' => 'Ada']]);
        $service->apiPatch('/app123/Contacts/rec123', ['fields' => ['Status' => 'Active']]);
        $service->apiDelete('/app123/Contacts/rec123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer pat-test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/meta/bases?offset=itr123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.airtable.com/v0/app123/Contacts'
            && $request['fields']['Name'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.airtable.com/v0/app123/Contacts/rec123'
            && $request['fields']['Status'] === 'Active');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.airtable.com/v0/app123/Contacts/rec123');
    }

    public function test_tools_shape_record_comment_and_webhook_requests(): void
    {
        $service = new AirtableService(accessToken: 'pat-test');

        Http::fake(['*' => Http::response(['records' => []], 200)]);
        self::assertTrue((new AirtableListRecords($service))->execute([
            'base_id' => 'app123',
            'table' => 'Contacts',
            'filterByFormula' => "{Status}='Active'",
            'pageSize' => 50,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === "https://api.airtable.com/v0/app123/Contacts?filterByFormula=%7BStatus%7D%3D%27Active%27&pageSize=50");

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'rec123'], 200)]);
        self::assertTrue((new AirtableCreateRecord($service))->execute([
            'base_id' => 'app123',
            'table' => 'Contacts',
            'fields' => ['Name' => 'Ada'],
            'payload' => ['typecast' => true],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/app123/Contacts'
            && $request['fields']['Name'] === 'Ada'
            && $request['typecast'] === true);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'com123'], 200)]);
        self::assertTrue((new AirtableCreateComment($service))->execute([
            'base_id' => 'app123',
            'table' => 'Contacts',
            'record_id' => 'rec123',
            'text' => 'Follow up.',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/app123/Contacts/rec123/comments'
            && $request['text'] === 'Follow up.');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['payloads' => []], 200)]);
        self::assertTrue((new AirtableListWebhookPayloads($service))->execute([
            'base_id' => 'app123',
            'webhook_id' => 'ach123',
            'cursor' => 7,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/bases/app123/webhooks/ach123/payloads?cursor=7');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new AirtableToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(29, count($tools));
        self::assertArrayHasKey('airtable_create_table', $tools);
        self::assertArrayHasKey('airtable_create_comment', $tools);
        self::assertArrayHasKey('airtable_list_webhooks', $tools);
        self::assertArrayHasKey('airtable_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'Access token is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['name' => 'Example User'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Airtable as Example User.'], $provider->testConnection([
            'access_token' => 'pat-test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/whoami');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['records' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['airtable', 'access_token', 'workspace'] => 'account-token',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'airtable' && $account === 'workspace';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'airtable' ? ['workspace'] : [];
            }
        });

        $tool = $provider->createTool(AirtableListRecords::class, ['account' => 'workspace']);
        self::assertTrue($tool->execute(['base_id' => 'app123', 'table' => 'Contacts'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.airtable.com/v0/app123/Contacts'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
