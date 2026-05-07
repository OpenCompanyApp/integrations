<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Line;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Line\LineService;
use OpenCompany\Integrations\Line\LineToolProvider;
use OpenCompany\Integrations\Line\Tools\LineCreateRichMenu;
use OpenCompany\Integrations\Line\Tools\LineReplyMessage;
use OpenCompany\Integrations\Line\Tools\LineSendMessage;
use OpenCompany\Integrations\Line\Tools\LineValidateMessages;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for LINE Messaging API endpoint mappings and catalog metadata.
 */
final class LineServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_line_messaging_api_paths(): void
    {
        Http::fake([
            'https://api.line.test/v2/bot/message/reply' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/push' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/multicast' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/narrowcast' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/progress/narrowcast*' => Http::response(['phase' => 'succeeded'], 200),
            'https://api.line.test/v2/bot/message/broadcast' => Http::response([], 200),
            'https://api.line.test/v2/bot/chat/markAsRead' => Http::response([], 200),
            'https://api.line.test/v2/bot/chat/loading/start' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/quota' => Http::response(['type' => 'limited', 'value' => 1000], 200),
            'https://api.line.test/v2/bot/message/quota/consumption' => Http::response(['totalUsage' => 10], 200),
            'https://api.line.test/v2/bot/message/delivery/push*' => Http::response(['status' => 'ready', 'success' => 10], 200),
            'https://api.line.test/v2/bot/message/validate/push' => Http::response([], 200),
            'https://api.line.test/v2/bot/channel/webhook/endpoint' => Http::response(['endpoint' => 'https://example.test/line'], 200),
            'https://api.line.test/v2/bot/channel/webhook/test' => Http::response(['success' => true], 200),
            'https://api.line.test/v2/bot/profile/U0000000000' => Http::response(['displayName' => 'Test User'], 200),
            'https://api.line.test/v2/bot/followers/ids*' => Http::response(['userIds' => ['U0000000000']], 200),
            'https://api.line.test/v2/bot/info' => Http::response(['displayName' => 'Test Bot'], 200),
            'https://api.line.test/v2/bot/group/C0000000000/summary' => Http::response(['groupName' => 'Test Group'], 200),
            'https://api.line.test/v2/bot/group/C0000000000/members/count' => Http::response(['count' => 3], 200),
            'https://api.line.test/v2/bot/group/C0000000000/members/ids*' => Http::response(['memberIds' => ['U0000000000']], 200),
            'https://api.line.test/v2/bot/group/C0000000000/member/U0000000000' => Http::response(['displayName' => 'Member'], 200),
            'https://api.line.test/v2/bot/group/C0000000000/leave' => Http::response([], 200),
            'https://api.line.test/v2/bot/richmenu' => Http::response(['richMenuId' => 'richmenu_123'], 200),
            'https://api.line.test/v2/bot/richmenu/validate' => Http::response([], 200),
            'https://api.line.test/v2/bot/richmenu/list' => Http::response(['richmenus' => []], 200),
            'https://api.line.test/v2/bot/richmenu/richmenu_123' => Http::response(['richMenuId' => 'richmenu_123'], 200),
            'https://api.line.test/v2/bot/user/all/richmenu/richmenu_123' => Http::response([], 200),
            'https://api.line.test/v2/bot/user/all/richmenu' => Http::response(['richMenuId' => 'richmenu_123'], 200),
            'https://api.line.test/v2/bot/user/U0000000000/richmenu/richmenu_123' => Http::response([], 200),
            'https://api.line.test/v2/bot/user/U0000000000/richmenu' => Http::response(['richMenuId' => 'richmenu_123'], 200),
            'https://api.line.test/v2/bot/user/U0000000000/linkToken' => Http::response(['linkToken' => 'link_token_123'], 200),
        ]);

        $service = new LineService('token_test', 'https://api.line.test/v2');
        $messages = [['type' => 'text', 'text' => 'Hello']];
        $richMenu = ['name' => 'main', 'areas' => []];

        $service->replyMessage('reply_token', $messages);
        $service->sendMessage('U0000000000', $messages, false, 'orders');
        $service->multicastMessage(['U0000000000', 'U1111111111'], $messages);
        $service->narrowcastMessage($messages, ['type' => 'operator'], ['gender' => 'male']);
        $service->getNarrowcastProgress('request_123');
        $service->broadcastMessage($messages);
        $service->markAsRead('U0000000000');
        $service->startLoadingAnimation('U0000000000', 20);
        $service->getMessageQuota();
        $service->getMessageQuotaConsumption();
        $service->getMessageDelivery('push', '20260506');
        $service->validateMessages('push', $messages);
        $service->setWebhookEndpoint('https://example.test/line');
        $service->getWebhookEndpoint();
        $service->testWebhookEndpoint('https://example.test/line');
        $service->getProfile('U0000000000');
        $service->listFriends(200, 'next_token');
        $service->getCurrentUser();
        $service->getGroupSummary('C0000000000');
        $service->getGroupMemberCount('C0000000000');
        $service->listGroupMemberIds('C0000000000', 'group_next');
        $service->getGroupMemberProfile('C0000000000', 'U0000000000');
        $service->leaveGroup('C0000000000');
        $service->createRichMenu($richMenu);
        $service->validateRichMenu($richMenu);
        $service->listRichMenus();
        $service->getRichMenu('richmenu_123');
        $service->deleteRichMenu('richmenu_123');
        $service->setDefaultRichMenu('richmenu_123');
        $service->getDefaultRichMenu();
        $service->clearDefaultRichMenu();
        $service->linkRichMenuToUser('U0000000000', 'richmenu_123');
        $service->getUserRichMenu('U0000000000');
        $service->unlinkRichMenuFromUser('U0000000000');
        $service->issueLinkToken('U0000000000');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/reply' && $request['replyToken'] === 'reply_token');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/push' && $request['customAggregationUnits'] === 'orders');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/multicast' && $request['to'][1] === 'U1111111111');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/narrowcast' && $request['recipient']['type'] === 'operator');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.line.test/v2/bot/message/progress/narrowcast?') && str_contains($request->url(), 'requestId=request_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/broadcast');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/chat/markAsRead' && $request['chatId'] === 'U0000000000');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/chat/loading/start' && $request['loadingSeconds'] === 20);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/message/quota');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/message/quota/consumption');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.line.test/v2/bot/message/delivery/push?') && str_contains($request->url(), 'date=20260506'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/message/validate/push');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.line.test/v2/bot/channel/webhook/endpoint' && $request['endpoint'] === 'https://example.test/line');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/channel/webhook/endpoint');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/channel/webhook/test' && $request['endpoint'] === 'https://example.test/line');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/profile/U0000000000');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.line.test/v2/bot/followers/ids?') && str_contains($request->url(), 'limit=200'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/info');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/group/C0000000000/summary');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/group/C0000000000/members/count');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.line.test/v2/bot/group/C0000000000/members/ids?') && str_contains($request->url(), 'start=group_next'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/group/C0000000000/member/U0000000000');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/group/C0000000000/leave');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/richmenu' && $request['name'] === 'main');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/richmenu/validate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/richmenu/list');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/richmenu/richmenu_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.line.test/v2/bot/richmenu/richmenu_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/user/all/richmenu/richmenu_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/user/all/richmenu');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.line.test/v2/bot/user/all/richmenu');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/user/U0000000000/richmenu/richmenu_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.line.test/v2/bot/user/U0000000000/richmenu');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.line.test/v2/bot/user/U0000000000/richmenu');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.line.test/v2/bot/user/U0000000000/linkToken');
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer token_test'));
    }

    public function test_tools_map_agent_arguments_to_line_payloads(): void
    {
        Http::fake([
            'https://api.line.test/v2/bot/message/reply' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/push' => Http::response([], 200),
            'https://api.line.test/v2/bot/message/validate/push' => Http::response([], 200),
            'https://api.line.test/v2/bot/richmenu' => Http::response(['richMenuId' => 'richmenu_123'], 200),
        ]);

        $service = new LineService('token_test', 'https://api.line.test');
        self::assertNull((new LineReplyMessage($service))->execute([
            'reply_token' => 'reply_token',
            'messages' => [['type' => 'text', 'text' => 'Thanks']],
            'notification_disabled' => true,
        ])->error);
        self::assertNull((new LineSendMessage($service))->execute([
            'to' => 'U0000000000',
            'messages' => [['type' => 'text', 'text' => 'Hello']],
            'custom_aggregation_units' => 'orders',
        ])->error);
        self::assertNull((new LineValidateMessages($service))->execute([
            'type' => 'push',
            'messages' => [['type' => 'text', 'text' => 'Preview']],
        ])->error);
        self::assertNull((new LineCreateRichMenu($service))->execute([
            'rich_menu' => ['name' => 'main', 'areas' => []],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.line.test/v2/bot/message/reply' && $request['notificationDisabled'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.line.test/v2/bot/message/push' && $request['customAggregationUnits'] === 'orders');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.line.test/v2/bot/message/validate/push' && $request['messages'][0]['text'] === 'Preview');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.line.test/v2/bot/richmenu' && $request['name'] === 'main');
    }

    public function test_provider_exposes_expanded_surface_and_allowed_category(): void
    {
        $provider = new LineToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.line.biz/en/reference/messaging-api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://api.line.me', $provider->credentialFields()[1]['default']);
        self::assertArrayHasKey('line_reply_message', $tools);
        self::assertArrayHasKey('line_mark_as_read', $tools);
        self::assertArrayHasKey('line_set_webhook_endpoint', $tools);
        self::assertArrayHasKey('line_get_group_member_profile', $tools);
        self::assertArrayHasKey('line_validate_rich_menu', $tools);
        self::assertArrayHasKey('line_unlink_rich_menu_from_user', $tools);
        self::assertArrayHasKey('line_issue_link_token', $tools);
        self::assertSame(35, count($tools));
    }
}
