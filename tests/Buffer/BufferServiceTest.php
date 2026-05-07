<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Buffer;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Buffer\BufferService;
use OpenCompany\Integrations\Buffer\BufferToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Buffer REST and GraphQL endpoint coverage.
 */
final class BufferServiceTest extends TestCase
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

    public function test_rest_endpoint_mapping_and_form_payloads(): void
    {
        Http::fake(['*' => Http::response(['success' => true], 200)]);

        $service = new BufferService('buffer-token', 'https://api.bufferapp.test/1', 'https://api.buffer.test');

        $service->listProfileSchedules('profile_123');
        $service->updateProfileSchedules('profile_123', [
            'schedules' => [['days' => ['mon'], 'times' => ['09:00']]],
        ]);
        $service->reorderUpdates('profile_123', ['update_1', 'update_2'], 0, true);
        $service->shareUpdate('update_1');
        $service->getInfoConfiguration();
        $service->getLinkShares('https://example.test/post');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.bufferapp.test/1/profiles/profile_123/schedules.json'
            && $request->hasHeader('Authorization', 'Bearer buffer-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.bufferapp.test/1/profiles/profile_123/schedules/update.json'
            && $request['schedules'][0]['days'][0] === 'mon');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.bufferapp.test/1/profiles/profile_123/updates/reorder.json'
            && $request['order'][0] === 'update_1'
            && $request['utc'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.bufferapp.test/1/updates/update_1/share.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.bufferapp.test/1/info/configuration.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.bufferapp.test/1/links/shares.json?url=https%3A%2F%2Fexample.test%2Fpost');
    }

    public function test_graphql_uses_current_buffer_endpoint(): void
    {
        Http::fake(['*' => Http::response(['data' => ['account' => ['organizations' => []]]], 200)]);

        $service = new BufferService('buffer-token', 'https://api.bufferapp.test/1', 'https://api.buffer.test');
        $service->graphql('query GetOrganizations { account { organizations { id } } }', [], 'GetOrganizations');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.buffer.test'
            && $request->hasHeader('Authorization', 'Bearer buffer-token')
            && $request['operationName'] === 'GetOrganizations');
    }

    public function test_provider_registers_expanded_catalog(): void
    {
        $provider = new BufferToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(19, count($tools));
        self::assertArrayHasKey('buffer_list_profile_schedules', $tools);
        self::assertArrayHasKey('buffer_reorder_updates', $tools);
        self::assertArrayHasKey('buffer_get_link_shares', $tools);
        self::assertArrayHasKey('buffer_graphql', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new BufferService('buffer-token'));
            $names[] = $instance->name();
        }

        self::assertCount(count($names), array_unique($names));
    }
}
