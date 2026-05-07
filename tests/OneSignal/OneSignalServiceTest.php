<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OneSignal;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OneSignal\OneSignalService;
use OpenCompany\Integrations\OneSignal\OneSignalToolProvider;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalApiGet;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalCreateSegment;
use OpenCompany\Integrations\OneSignal\Tools\OneSignalCreateUser;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for current OneSignal API endpoint coverage.
 */
final class OneSignalServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_current_onesignal_resources(): void
    {
        Http::fake([
            'https://api.onesignal.com/*' => Http::response(['success' => true, 'data' => []], 200),
        ]);

        $service = new OneSignalService('os_test', 'app_123');

        $service->listNotifications(null, ['limit' => 10, 'kind' => 1]);
        $service->getNotification('msg_123', null, ['outcome_names' => 'os__click.count']);
        $service->createMessage(null, ['contents' => ['en' => 'Hello'], 'included_segments' => ['Subscribed Users']]);
        $service->cancelNotification('msg_123');
        $service->listDevices(null, 25, 0);
        $service->getDevice('player_123');
        $service->listApps();
        $service->getCurrentApp();
        $service->updateApp(null, ['name' => 'Updated']);
        $service->createUser(null, ['identity' => ['external_id' => 'user_123']]);
        $service->getUser(null, 'external_id', 'user_123');
        $service->updateUser(null, 'external_id', 'user_123', ['properties' => ['tags' => ['plan' => 'pro']]]);
        $service->deleteUser(null, 'external_id', 'user_123');
        $service->getUserIdentity(null, 'external_id', 'user_123');
        $service->createOrUpdateAlias(null, 'external_id', 'user_123', ['crm_id' => 'crm_123']);
        $service->deleteAlias(null, 'external_id', 'user_123', 'crm_id');
        $service->getIdentityBySubscription(null, 'sub_123');
        $service->createAliasBySubscription(null, 'sub_123', ['external_id' => 'user_123']);
        $service->createSubscription(null, 'external_id', 'user_123', ['type' => 'Email', 'token' => 'reader@example.test']);
        $service->updateSubscription(null, 'sub_123', ['enabled' => false]);
        $service->transferSubscription(null, 'sub_123', ['external_id' => 'user_456']);
        $service->listSegments(null, ['limit' => 300]);
        $service->getSegment(null, 'segment_123', ['include-segment-detail' => true]);
        $service->createSegment(null, ['name' => 'Active', 'filters' => []]);
        $service->updateSegment(null, 'segment_123', ['name' => 'Updated']);
        $service->deleteSegment(null, 'segment_123');
        $service->listTemplates(null, ['limit' => 50]);
        $service->getTemplate(null, 'template_123');
        $service->createTemplate(null, ['name' => 'Welcome', 'contents' => ['en' => 'Hi']]);
        $service->updateTemplate(null, 'template_123', ['name' => 'Updated']);
        $service->deleteTemplate(null, 'template_123');
        $service->viewOutcomes(null, ['outcome_names' => 'os__click.count']);
        $service->apiGet('/notifications', ['app_id' => 'app_123']);
        $service->apiPost('/notifications', ['app_id' => 'app_123']);
        $service->apiPatch('/apps/app_123/users/by/external_id/user_123', ['properties' => []]);
        $service->apiDelete('/notifications/msg_123', ['app_id' => 'app_123']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Key os_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/notifications?') && str_contains($request->url(), 'app_id=app_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/notifications/msg_123?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.onesignal.com/notifications' && ($request->data()['contents']['en'] ?? null) === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_starts_with($request->url(), 'https://api.onesignal.com/notifications/msg_123?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/players?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.onesignal.com/apps');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.onesignal.com/apps/app_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.onesignal.com/apps/app_123/users' && $request['identity']['external_id'] === 'user_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.onesignal.com/apps/app_123/users/by/external_id/user_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.onesignal.com/apps/app_123/users/by/external_id/user_123/identity' && $request['identity']['crm_id'] === 'crm_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.onesignal.com/apps/app_123/subscriptions/sub_123/user/identity');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.onesignal.com/apps/app_123/users/by/external_id/user_123/subscriptions');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.onesignal.com/apps/app_123/subscriptions/sub_123/owner');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/apps/app_123/segments?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.onesignal.com/apps/app_123/segments');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/templates?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.onesignal.com/templates/template_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.onesignal.com/apps/app_123/outcomes?'));
    }

    public function test_tools_delegate_and_validate_safe_raw_paths(): void
    {
        Http::fake([
            'https://api.onesignal.com/*' => Http::response(['success' => true], 200),
        ]);

        $service = new OneSignalService('os_test', 'app_123');

        self::assertTrue((new OneSignalCreateUser($service))->execute([
            'payload' => ['identity' => ['external_id' => 'user_123']],
        ])->succeeded());
        self::assertTrue((new OneSignalCreateSegment($service))->execute([
            'payload' => ['name' => 'Active', 'filters' => []],
        ])->succeeded());
        self::assertTrue((new OneSignalApiGet($service))->execute([
            'path' => '/notifications',
            'params' => ['app_id' => 'app_123'],
        ])->succeeded());
        self::assertFalse((new OneSignalCreateUser($service))->execute([])->succeeded());
        self::assertFalse((new OneSignalApiGet($service))->execute([
            'path' => 'https://example.test/notifications',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.onesignal.com/notifications*' => Http::response(['notifications' => []], 200),
        ]);

        $provider = new OneSignalToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://documentation.onesignal.com/reference/rest-api-overview', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('onesignal_create_user', $tools);
        self::assertArrayHasKey('onesignal_create_subscription', $tools);
        self::assertArrayHasKey('onesignal_list_segments', $tools);
        self::assertArrayHasKey('onesignal_create_template', $tools);
        self::assertArrayHasKey('onesignal_view_outcomes', $tools);
        self::assertArrayHasKey('onesignal_api_patch', $tools);
        self::assertSame(36, count($tools));

        self::assertTrue($provider->testConnection([
            'api_key' => 'os_test',
            'app_id' => 'app_123',
        ])['success']);
    }
}
