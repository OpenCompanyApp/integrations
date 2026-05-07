<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Sendy;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Sendy\SendyService;
use OpenCompany\Integrations\Sendy\SendyToolProvider;
use OpenCompany\Integrations\Sendy\Tools\SendyCreateCampaign;
use OpenCompany\Integrations\Sendy\Tools\SendyGetLists;
use OpenCompany\Integrations\Sendy\Tools\SendySubscribe;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Sendy's documented API endpoint mappings and provider metadata.
 */
final class SendyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_official_sendy_api_paths(): void
    {
        Http::fake([
            'https://sendy.example.test/subscribe' => Http::response('true', 200),
            'https://sendy.example.test/unsubscribe' => Http::response('true', 200),
            'https://sendy.example.test/api/subscribers/delete.php' => Http::response('true', 200),
            'https://sendy.example.test/api/subscribers/subscription-status.php' => Http::response('Subscribed', 200),
            'https://sendy.example.test/api/subscribers/active-subscriber-count.php' => Http::response('42', 200),
            'https://sendy.example.test/api/lists/get-lists.php' => Http::response([['id' => 'list_123', 'name' => 'Main']], 200),
            'https://sendy.example.test/api/brands/get-brands.php' => Http::response([['id' => '1', 'name' => 'Example']], 200),
            'https://sendy.example.test/api/campaigns/create.php' => Http::response('Campaign scheduled', 200),
        ]);

        $service = new SendyService('key_test', 'https://sendy.example.test');
        $service->subscribe('list_123', 'reader@example.test', 'Reader', ['country' => 'US']);
        $service->unsubscribe('list_123', 'reader@example.test');
        $service->deleteSubscriber('list_123', 'reader@example.test');
        $service->getSubscriptionStatus('list_123', 'reader@example.test');
        $service->activeSubscriberCount('list_123');
        $service->getLists('1', true);
        $service->getBrands();
        $service->getCurrentUser();
        $service->createCampaign([
            'from_name' => 'Example',
            'from_email' => 'newsletter@example.test',
            'reply_to' => 'support@example.test',
            'title' => 'Monthly',
            'subject' => 'Monthly update',
            'html_text' => '<h1>Hello</h1>',
            'list_ids' => 'list_123',
            'send_campaign' => 1,
            'schedule_date_time' => 'June 15, 2026 6:05pm',
        ]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/subscribe' && $request['api_key'] === 'key_test' && $request['country'] === 'US');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/unsubscribe' && $request['boolean'] === 'true');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/subscribers/delete.php' && $request['list_id'] === 'list_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/subscribers/subscription-status.php' && $request['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/subscribers/active-subscriber-count.php');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/lists/get-lists.php' && $request['brand_id'] === '1' && $request['include_hidden'] === 'yes');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/brands/get-brands.php');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://sendy.example.test/api/campaigns/create.php' && $request['send_campaign'] === 1 && $request['schedule_date_time'] === 'June 15, 2026 6:05pm');
    }

    public function test_tools_map_agent_arguments_to_form_fields(): void
    {
        Http::fake([
            'https://sendy.example.test/subscribe' => Http::response('Already subscribed.', 200),
            'https://sendy.example.test/api/lists/get-lists.php' => Http::response([['id' => 'list_123']], 200),
            'https://sendy.example.test/api/campaigns/create.php' => Http::response('Campaign created and now sending', 200),
        ]);

        $service = new SendyService('key_test', 'https://sendy.example.test');
        self::assertNull((new SendySubscribe($service))->execute([
            'list' => 'list_123',
            'email' => 'reader@example.test',
            'custom_fields' => ['Plan' => 'Pro'],
        ])->error);
        self::assertNull((new SendyGetLists($service))->execute([
            'brand_id' => '1',
            'include_hidden' => true,
        ])->error);
        self::assertNull((new SendyCreateCampaign($service))->execute([
            'from_name' => 'Example',
            'from_email' => 'newsletter@example.test',
            'reply_to' => 'support@example.test',
            'title' => 'Monthly',
            'subject' => 'Monthly update',
            'html_text' => '<h1>Hello</h1>',
            'segment_ids' => 'seg_123',
            'track_opens' => 2,
            'track_clicks' => 1,
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sendy.example.test/subscribe' && $request['Plan'] === 'Pro');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sendy.example.test/api/lists/get-lists.php' && $request['include_hidden'] === 'yes');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sendy.example.test/api/campaigns/create.php' && $request['segment_ids'] === 'seg_123' && $request['track_opens'] === 2);
    }

    public function test_provider_exposes_official_api_surface_and_productivity_category(): void
    {
        $provider = new SendyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://sendy.co/api', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('sendy_delete_subscriber', $tools);
        self::assertArrayHasKey('sendy_subscription_status', $tools);
        self::assertArrayHasKey('sendy_get_lists', $tools);
        self::assertArrayHasKey('sendy_get_brands', $tools);
        self::assertArrayHasKey('sendy_get_current_user', $tools);
        self::assertSame(9, count($tools));
    }
}
