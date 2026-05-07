<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ConvertKit;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ConvertKit\ConvertKitService;
use OpenCompany\Integrations\ConvertKit\ConvertKitToolProvider;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitApiGet;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitCreateBroadcast;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitCreateSubscriber;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitListSubscribers;
use OpenCompany\Integrations\ConvertKit\Tools\ConvertKitTagSubscriberByEmail;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for current Kit V4 API endpoint coverage.
 */
final class ConvertKitServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_uses_current_v4_auth_and_safe_paths(): void
    {
        Http::fake([
            'https://api.kit.com/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ConvertKitService('kit_test');

        self::assertSame(['ok' => true], $service->getCurrentAccount());
        self::assertSame(['ok' => true], $service->apiGet('/subscribers', ['per_page' => 25]));
        self::assertSame(['ok' => true], $service->apiPost('/subscribers', ['email_address' => 'reader@example.test']));
        self::assertSame(['ok' => true], $service->apiPut('/tags/12', ['name' => 'Customers']));
        self::assertSame(['ok' => true], $service->apiDelete('/webhooks/2'));

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Kit-Api-Key', 'kit_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.kit.com/v4/account');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.kit.com/v4/subscribers?per_page=25');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.kit.com/v4/subscribers' && $request['email_address'] === 'reader@example.test');
    }

    public function test_oauth_token_takes_precedence_for_oauth_only_endpoints(): void
    {
        Http::fake([
            'https://api.kit.com/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ConvertKitService(apiKey: 'kit_test', accessToken: 'oauth_test');
        $service->apiPost('/purchases', ['transaction_id' => 'txn_test']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer oauth_test'));
    }

    public function test_tools_delegate_to_current_v4_endpoints(): void
    {
        Http::fake([
            'https://api.kit.com/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ConvertKitService('kit_test');

        self::assertTrue((new ConvertKitListSubscribers($service))->execute([
            'email_address' => 'reader@example.test',
            'per_page' => 10,
        ])->succeeded());

        self::assertTrue((new ConvertKitCreateSubscriber($service))->execute([
            'email_address' => 'reader@example.test',
            'first_name' => 'Ada',
        ])->succeeded());

        self::assertTrue((new ConvertKitCreateBroadcast($service))->execute([
            'payload' => [
                'subject' => 'Hello',
                'content' => '<p>Hello</p>',
                'description' => 'Intro',
                'public' => false,
                'published_at' => '2026-01-01T00:00:00Z',
                'preview_text' => 'Hello',
                'subscriber_filter' => [],
            ],
        ])->succeeded());

        self::assertTrue((new ConvertKitTagSubscriberByEmail($service))->execute([
            'tag_id' => 42,
            'email_address' => 'reader@example.test',
        ])->succeeded());

        self::assertTrue((new ConvertKitApiGet($service))->execute([
            'path' => '/segments',
            'params' => ['per_page' => 5],
        ])->succeeded());

        self::assertFalse((new ConvertKitApiGet($service))->execute([
            'path' => 'https://example.test/subscribers',
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.kit.com/v4/subscribers?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.kit.com/v4/subscribers' && $request['email_address'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.kit.com/v4/broadcasts' && $request['subject'] === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.kit.com/v4/tags/42/subscribers' && $request['email_address'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.kit.com/v4/segments?per_page=5');
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.kit.com/v4/account' => Http::response([
                'account' => ['name' => 'Example Kit'],
            ], 200),
        ]);

        $provider = new ConvertKitToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.kit.com/api-reference/overview', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('convertkit_list_subscribers', $tools);
        self::assertArrayHasKey('convertkit_create_subscriber', $tools);
        self::assertArrayHasKey('convertkit_create_broadcast', $tools);
        self::assertArrayHasKey('convertkit_list_custom_fields', $tools);
        self::assertArrayHasKey('convertkit_add_subscriber_to_form_by_email', $tools);
        self::assertArrayHasKey('convertkit_create_purchase', $tools);
        self::assertArrayHasKey('convertkit_add_subscriber_to_sequence', $tools);
        self::assertArrayHasKey('convertkit_bulk_tag_subscribers', $tools);
        self::assertArrayHasKey('convertkit_create_webhook', $tools);
        self::assertArrayHasKey('convertkit_api_delete', $tools);
        self::assertSame(72, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'kit_test'])['success']);
    }
}
