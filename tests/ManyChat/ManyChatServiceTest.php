<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ManyChat;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ManyChat\ManyChatService;
use OpenCompany\Integrations\ManyChat\ManyChatToolProvider;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatApiGet;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatCreateCustomField;
use OpenCompany\Integrations\ManyChat\Tools\ManyChatSendFlow;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Manychat Account Public API coverage.
 */
final class ManyChatServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_page_sending_subscriber_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api.manychat.com/fb/page/getFlows' => Http::response([
                'status' => 'success',
                'data' => [
                    ['flow_ns' => 'flow_1', 'name' => 'Welcome'],
                ],
            ], 200),
            'https://api.manychat.com/*' => Http::response(['status' => 'success', 'data' => []], 200),
        ]);

        $service = new ManyChatService('mc_test');

        $service->getPageInfo();
        $service->listFlows();
        self::assertSame('Welcome', $service->getFlow('flow_1')['name']);
        $service->listTags();
        $service->createTag('VIP');
        $service->removeTag(111);
        $service->removeTagByName('VIP');
        $service->listGrowthTools();
        $service->listCustomFields();
        $service->createCustomField(['caption' => 'Lead status', 'type' => 'text']);
        $service->listBotFields();
        $service->setBotField(222, 'open');
        $service->sendContent(['subscriber_id' => 123, 'data' => ['version' => 'v2']]);
        $service->sendMessage(['subscriber_id' => 123, 'message' => ['text' => 'Hello']]);
        $service->sendFlow(123, 'flow_1');
        $service->getSubscriberInfo(123);
        $service->findSubscriberByName('Example');
        $service->addSubscriberTag(123, 111);
        $service->removeSubscriberTag(123, 111);
        $service->setSubscriberCustomField(123, 333, 'qualified');
        $service->createSubscriber(['email' => 'user@example.test', 'has_opt_in_email' => true]);
        $service->updateSubscriber(['subscriber_id' => 123, 'email' => 'new@example.test']);
        $service->apiGet('/fb/page/getOtnTopics');
        $service->apiPost('/fb/subscriber/addTagByName', ['subscriber_id' => 123, 'tag_name' => 'VIP']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer mc_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.manychat.com/fb/page/getInfo');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.manychat.com/fb/page/getFlows');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.manychat.com/fb/page/createTag');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.manychat.com/fb/page/removeTagByName');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.manychat.com/fb/page/getCustomFields');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.manychat.com/fb/sending/sendContent');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.manychat.com/fb/sending/sendFlow');
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'https://api.manychat.com/fb/subscriber/getInfo?subscriber_id=123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.manychat.com/fb/subscriber/setCustomField');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.manychat.com/fb/page/getOtnTopics');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.manychat.com/*' => Http::response(['status' => 'success'], 200),
        ]);

        $service = new ManyChatService('mc_test');

        self::assertTrue((new ManyChatCreateCustomField($service))->execute([
            'caption' => 'Lead status',
            'type' => 'text',
        ])->succeeded());
        self::assertTrue((new ManyChatSendFlow($service))->execute([
            'subscriber_id' => 123,
            'flow_ns' => 'flow_1',
        ])->succeeded());
        self::assertTrue((new ManyChatApiGet($service))->execute([
            'path' => '/fb/page/getOtnTopics',
        ])->succeeded());
        self::assertFalse((new ManyChatSendFlow($service))->execute([
            'subscriber_id' => 0,
            'flow_ns' => 'flow_1',
        ])->succeeded());
        self::assertFalse((new ManyChatApiGet($service))->execute([
            'path' => 'https://example.test/fb/page/getTags',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.manychat.com/fb/page/getInfo' => Http::response(['status' => 'success'], 200),
        ]);

        $provider = new ManyChatToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('manychat_get_page_info', $tools);
        self::assertArrayHasKey('manychat_list_custom_fields', $tools);
        self::assertArrayHasKey('manychat_send_flow', $tools);
        self::assertArrayHasKey('manychat_get_subscriber_info', $tools);
        self::assertArrayHasKey('manychat_update_subscriber', $tools);
        self::assertArrayHasKey('manychat_api_post', $tools);
        self::assertSame(25, count($tools));
        self::assertTrue($provider->testConnection([
            'api_key' => 'mc_test',
        ])['success']);
    }
}
