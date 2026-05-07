<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pushbullet;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Pushbullet\PushbulletService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Pushbullet endpoint coverage and payload mappings.
 */
final class PushbulletServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_current_user_uses_access_token_header(): void
    {
        Http::fake([
            'https://api.pushbullet.test/v2/users/me' => Http::response([
                'iden' => 'user-test',
                'email' => 'person@example.test',
            ], 200),
        ]);

        $service = new PushbulletService(
            accessToken: 'token-test',
            baseUrl: 'https://api.pushbullet.test/v2',
        );

        $service->getCurrentUser();

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.pushbullet.test/v2/users/me'
                && $request->hasHeader('Access-Token', 'token-test');
        });
    }

    public function test_push_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://api.pushbullet.test/v2/pushes?*' => Http::response(['pushes' => []], 200),
            'https://api.pushbullet.test/v2/pushes' => Http::response(['iden' => 'push-test'], 200),
            'https://api.pushbullet.test/v2/pushes/push-test' => Http::response(['iden' => 'push-test', 'dismissed' => true], 200),
            'https://api.pushbullet.test/v2/pushes/push-delete' => Http::response('', 200),
        ]);

        $service = new PushbulletService('token-test', 'https://api.pushbullet.test/v2/');
        $service->listPushes(['limit' => 25, 'active' => true, 'modified_after' => 123.45]);
        $service->createPush('file', 'Report', 'Attached.', [
            'file_name' => 'report.pdf',
            'file_type' => 'application/pdf',
            'file_url' => 'https://files.example.test/report.pdf',
        ]);
        $service->updatePush('push-test', ['dismissed' => true]);
        $service->deletePush('push-delete');
        $service->deleteAllPushes();

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushbullet.test/v2/pushes?limit=25&active=1&modified_after=123.45');
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.pushbullet.test/v2/pushes'
                && $request->data()['type'] === 'file'
                && $request->data()['file_name'] === 'report.pdf'
                && $request->data()['file_url'] === 'https://files.example.test/report.pdf';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/pushes/push-test' && $request->data()['dismissed'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.pushbullet.test/v2/pushes/push-delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.pushbullet.test/v2/pushes');
    }

    public function test_device_endpoints_map_to_official_paths(): void
    {
        Http::fake([
            'https://api.pushbullet.test/v2/devices?*' => Http::response(['devices' => []], 200),
            'https://api.pushbullet.test/v2/devices' => Http::response(['iden' => 'device-test'], 200),
            'https://api.pushbullet.test/v2/devices/device-test' => Http::response(['iden' => 'device-test'], 200),
            'https://api.pushbullet.test/v2/devices/device-delete' => Http::response('', 200),
        ]);

        $service = new PushbulletService('token-test', 'https://api.pushbullet.test/v2');
        $service->listDevices(['active' => true]);
        $service->createDevice(['nickname' => 'Ops Console', 'icon' => 'desktop']);
        $service->updateDevice('device-test', ['nickname' => 'Ops Console 2']);
        $service->deleteDevice('device-delete');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushbullet.test/v2/devices?active=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/devices' && $request->data()['nickname'] === 'Ops Console');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/devices/device-test' && $request->data()['nickname'] === 'Ops Console 2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.pushbullet.test/v2/devices/device-delete');
    }

    public function test_chat_subscription_channel_ephemeral_and_upload_paths(): void
    {
        Http::fake([
            'https://api.pushbullet.test/v2/chats?*' => Http::response(['chats' => []], 200),
            'https://api.pushbullet.test/v2/chats' => Http::response(['iden' => 'chat-test'], 200),
            'https://api.pushbullet.test/v2/chats/chat-test' => Http::response(['iden' => 'chat-test', 'muted' => true], 200),
            'https://api.pushbullet.test/v2/chats/chat-delete' => Http::response('', 200),
            'https://api.pushbullet.test/v2/subscriptions?*' => Http::response(['subscriptions' => []], 200),
            'https://api.pushbullet.test/v2/subscriptions' => Http::response(['iden' => 'subscription-test'], 200),
            'https://api.pushbullet.test/v2/subscriptions/subscription-test' => Http::response(['iden' => 'subscription-test', 'muted' => true], 200),
            'https://api.pushbullet.test/v2/subscriptions/subscription-delete' => Http::response('', 200),
            'https://api.pushbullet.test/v2/channel-info?*' => Http::response(['tag' => 'example-channel'], 200),
            'https://api.pushbullet.test/v2/channels' => Http::response(['tag' => 'example-channel'], 200),
            'https://api.pushbullet.test/v2/ephemerals' => Http::response([], 200),
            'https://api.pushbullet.test/v2/upload-request' => Http::response(['upload_url' => 'https://upload.example.test', 'file_url' => 'https://files.example.test/report.pdf'], 200),
        ]);

        $service = new PushbulletService('token-test', 'https://api.pushbullet.test/v2');
        $service->listChats(['limit' => 10]);
        $service->createChat('person@example.test');
        $service->updateChat('chat-test', ['muted' => true]);
        $service->deleteChat('chat-delete');
        $service->listSubscriptions(['active' => true]);
        $service->createSubscription('example-channel');
        $service->updateSubscription('subscription-test', ['muted' => true]);
        $service->deleteSubscription('subscription-delete');
        $service->getChannelInfo('example-channel', true);
        $service->createChannel(['tag' => 'example-channel', 'name' => 'Example Channel', 'description' => 'Example alerts.']);
        $service->pushEphemeral(['type' => 'push', 'push' => ['type' => 'clip', 'body' => 'https://example.test']]);
        $service->requestUpload('report.pdf', 'application/pdf');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushbullet.test/v2/chats?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/chats' && $request->data()['email'] === 'person@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/chats/chat-test' && $request->data()['muted'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.pushbullet.test/v2/chats/chat-delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushbullet.test/v2/subscriptions?active=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/subscriptions' && $request->data()['channel_tag'] === 'example-channel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/subscriptions/subscription-test' && $request->data()['muted'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.pushbullet.test/v2/subscriptions/subscription-delete');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.pushbullet.test/v2/channel-info?tag=example-channel&no_recent_pushes=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/channels' && $request->data()['tag'] === 'example-channel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/ephemerals' && $request->data()['push']['type'] === 'clip');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.pushbullet.test/v2/upload-request' && $request->data()['file_name'] === 'report.pdf');
    }
}
