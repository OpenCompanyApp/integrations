<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Beamer;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Beamer\BeamerService;
use OpenCompany\Integrations\Beamer\BeamerToolProvider;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiGet;
use OpenCompany\Integrations\Beamer\Tools\BeamerApiPost;
use OpenCompany\Integrations\Beamer\Tools\BeamerCreatePost;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Beamer API authentication and generic endpoint coverage.
 */
final class BeamerServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_uses_beamer_api_key_header_and_generic_methods(): void
    {
        Http::fake([
            'https://api.getbeamer.test/v0/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BeamerService('beamer_test', 'https://api.getbeamer.test/v0');

        $service->listPosts(10, 1, 'published');
        $service->apiGet('/unread/count', ['userId' => 'user_123']);
        $service->apiPost('/posts/123/comments', ['comment' => 'Great update']);
        $service->apiPut('/posts/123', ['title' => 'Updated']);
        $service->apiDelete('/posts/123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Beamer-Api-Key', 'beamer_test'));
        Http::assertSent(static fn (Request $request): bool => ! $request->hasHeader('Authorization'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.getbeamer.test/v0/posts?') && str_contains($request->url(), 'status=published'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.getbeamer.test/v0/unread/count?') && str_contains($request->url(), 'userId=user_123'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.getbeamer.test/v0/posts/123/comments' && $request['comment'] === 'Great update');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.getbeamer.test/v0/posts/123' && $request['title'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.getbeamer.test/v0/posts/123');
    }

    public function test_generic_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.getbeamer.test/v0/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new BeamerService('beamer_test', 'https://api.getbeamer.test/v0');

        self::assertNull((new BeamerApiGet($service))->execute([
            'path' => '/unread/count',
            'params' => ['userId' => 'user_123'],
        ])->error);
        self::assertNull((new BeamerApiPost($service))->execute([
            'path' => '/posts/123/comments',
            'body' => ['comment' => 'Great update'],
        ])->error);

        $missingTitle = (new BeamerCreatePost($service))->execute([
            'content' => '<p>Missing title.</p>',
        ]);
        self::assertFalse($missingTitle->succeeded());
        self::assertStringContainsString('title is required', (string) $missingTitle->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_contains($request->url(), '/unread/count?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && str_contains($request->url(), '/posts/123/comments'));
    }

    public function test_provider_exposes_generic_tools_and_allowed_category(): void
    {
        Http::fake([
            'https://api.getbeamer.com/v0/me' => Http::response(['firstName' => 'Ada', 'lastName' => 'Example'], 200),
        ]);

        $provider = new BeamerToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('beamer_api_get', $tools);
        self::assertArrayHasKey('beamer_api_post', $tools);
        self::assertArrayHasKey('beamer_api_put', $tools);
        self::assertArrayHasKey('beamer_api_delete', $tools);
        self::assertSame(10, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'beamer_test'])['success']);
    }
}
