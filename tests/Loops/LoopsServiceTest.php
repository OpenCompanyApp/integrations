<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Loops;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Loops\LoopsService;
use OpenCompany\Integrations\Loops\LoopsToolProvider;
use OpenCompany\Integrations\Loops\Tools\LoopsCreateContact;
use OpenCompany\Integrations\Loops\Tools\LoopsFindContact;
use OpenCompany\Integrations\Loops\Tools\LoopsSendTransactionalEmail;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Loops API endpoint mappings.
 */
final class LoopsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_current_official_loops_endpoints(): void
    {
        Http::fake([
            'https://app.loops.so/api/v1/*' => Http::response(['success' => true, 'teamName' => 'Example Team'], 200),
        ]);

        $service = new LoopsService('loops_test');

        $service->createContact(['email' => 'reader@example.test', 'firstName' => 'Ada']);
        $service->updateContact(['email' => 'reader@example.test', 'subscribed' => false]);
        $service->findContact(['email' => 'reader@example.test']);
        $service->deleteContact(['userId' => 'user_123']);
        $service->checkContactSuppression(['email' => 'reader@example.test']);
        $service->removeContactSuppression(['email' => 'reader@example.test']);
        $service->createContactProperty(['name' => 'planName', 'type' => 'string', 'ignored' => 'no']);
        $service->listContactProperties();
        $service->listMailingLists();
        $service->sendEvent(['email' => 'reader@example.test', 'eventName' => 'trial_started']);
        $service->sendTransactionalEmail(['email' => 'reader@example.test', 'transactionalId' => 'txn_123'], 'idem_123');
        $service->listTransactionalEmails(['perPage' => 20, 'cursor' => 'next_cursor']);
        $service->testApiKey();
        $service->listDedicatedSendingIps();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer loops_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/contacts/create' && $request['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://app.loops.so/api/v1/contacts/update' && $request['subscribed'] === false);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://app.loops.so/api/v1/contacts/find?') && str_contains($request->url(), 'email=reader%40example.test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/contacts/delete' && $request['userId'] === 'user_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://app.loops.so/api/v1/contacts/suppression?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_starts_with($request->url(), 'https://app.loops.so/api/v1/contacts/suppression?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/contacts/properties' && $request['name'] === 'planName' && !isset($request['ignored']));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://app.loops.so/api/v1/lists');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/events/send' && $request['eventName'] === 'trial_started');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/transactional' && $request->hasHeader('Idempotency-Key', 'idem_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://app.loops.so/api/v1/transactional?') && str_contains($request->url(), 'perPage=20'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://app.loops.so/api/v1/api-key');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://app.loops.so/api/v1/dedicated-sending-ips');
    }

    public function test_tools_map_agent_arguments_and_validate_identity_lookup(): void
    {
        Http::fake([
            'https://app.loops.so/api/v1/*' => Http::response(['success' => true], 200),
        ]);

        $service = new LoopsService('loops_test');

        self::assertNull((new LoopsCreateContact($service))->execute([
            'email' => 'reader@example.test',
            'properties' => ['planName' => 'Pro'],
        ])->error);
        self::assertNotNull((new LoopsFindContact($service))->execute([
            'email' => 'reader@example.test',
            'userId' => 'user_123',
        ])->error);
        self::assertNull((new LoopsFindContact($service))->execute([
            'userId' => 'user_123',
        ])->error);
        self::assertNull((new LoopsSendTransactionalEmail($service))->execute([
            'email' => 'reader@example.test',
            'transactionalId' => 'txn_123',
            'idempotency_key' => 'idem_123',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/contacts/create' && $request['planName'] === 'Pro');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://app.loops.so/api/v1/contacts/find?') && str_contains($request->url(), 'userId=user_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://app.loops.so/api/v1/transactional' && $request->hasHeader('Idempotency-Key', 'idem_123'));
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://app.loops.so/api/v1/api-key' => Http::response(['success' => true, 'teamName' => 'Example Team'], 200),
        ]);

        $provider = new LoopsToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://loops.so/docs/api-reference', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('loops_find_contact', $tools);
        self::assertArrayHasKey('loops_send_transactional_email', $tools);
        self::assertArrayHasKey('loops_list_dedicated_sending_ips', $tools);
        self::assertArrayNotHasKey('loops_list_contacts', $tools);
        self::assertArrayNotHasKey('loops_get_current_user', $tools);
        self::assertSame(14, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'loops_test'])['success']);
    }
}
