<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Typefully;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Typefully\TypefullyService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Typefully API v2 endpoint coverage and payload mappings.
 */
final class TypefullyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_current_user_uses_v2_me_and_bearer_authorization(): void
    {
        Http::fake([
            'https://api.typefully.test/v2/me' => Http::response([
                'id' => 'user-test',
                'name' => 'Example User',
            ], 200),
        ]);

        $service = new TypefullyService(
            apiKey: 'key-test',
            baseUrl: 'https://api.typefully.test/v2',
        );

        $service->getCurrentUser();

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.typefully.test/v2/me'
                && $request->hasHeader('Authorization', 'Bearer key-test');
        });
    }

    public function test_social_set_endpoints_map_to_v2_paths(): void
    {
        Http::fake([
            'https://api.typefully.test/v2/social-sets?*' => Http::response(['results' => []], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test' => Http::response([
                'id' => 'social-set-test',
                'name' => 'Example Brand',
            ], 200),
        ]);

        $service = new TypefullyService('key-test', 'https://api.typefully.test/v2/');
        $service->listSocialSets(['limit' => 10, 'offset' => 5]);
        $service->getSocialSet('social-set-test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets?limit=10&offset=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test');
    }

    public function test_draft_endpoints_map_to_social_set_scoped_v2_paths(): void
    {
        Http::fake([
            'https://api.typefully.test/v2/social-sets/social-set-test/drafts?*' => Http::response(['results' => []], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test/drafts' => Http::response(['id' => 'draft-test'], 201),
            'https://api.typefully.test/v2/social-sets/social-set-test/drafts/draft-test' => Http::response(['id' => 'draft-test'], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test/drafts/draft-delete' => Http::response('', 204),
        ]);

        $service = new TypefullyService('key-test', 'https://api.typefully.test/v2');
        $service->listDrafts('social-set-test', ['status' => 'scheduled', 'limit' => 10, 'sort' => 'scheduled_date']);
        $service->createDraft('social-set-test', [
            'platforms' => [
                'x' => [
                    'enabled' => true,
                    'posts' => [
                        ['text' => 'Example post'],
                    ],
                ],
            ],
            'publish_at' => 'next-free-slot',
        ]);
        $service->getDraft('social-set-test', 'draft-test');
        $service->updateDraft('social-set-test', 'draft-test', ['share' => true]);
        $service->deleteDraft('social-set-test', 'draft-delete');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/drafts?status=scheduled&limit=10&sort=scheduled_date');
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/drafts'
                && $request->data()['platforms']['x']['posts'][0]['text'] === 'Example post'
                && $request->data()['publish_at'] === 'next-free-slot';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/drafts/draft-test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/drafts/draft-test' && $request->data()['share'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/drafts/draft-delete');
    }

    public function test_media_tag_and_queue_endpoints_map_to_social_set_scoped_v2_paths(): void
    {
        Http::fake([
            'https://api.typefully.test/v2/social-sets/social-set-test/media/upload' => Http::response([
                'media_id' => 'media-test',
                'upload_url' => 'https://upload.example.test/media',
            ], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test/media/media-test' => Http::response([
                'media_id' => 'media-test',
                'status' => 'ready',
            ], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test/tags?*' => Http::response(['results' => []], 200),
            'https://api.typefully.test/v2/social-sets/social-set-test/tags' => Http::response(['slug' => 'product-launch'], 201),
            'https://api.typefully.test/v2/social-sets/social-set-test/queue?*' => Http::response(['results' => []], 200),
        ]);

        $service = new TypefullyService('key-test', 'https://api.typefully.test/v2');
        $service->requestMediaUpload('social-set-test', ['file_name' => 'launch.png', 'file_type' => 'image/png']);
        $service->getMedia('social-set-test', 'media-test');
        $service->listTags('social-set-test', ['limit' => 20]);
        $service->createTag('social-set-test', 'Product Launch');
        $service->getQueue('social-set-test', ['limit' => 10]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/media/upload' && $request->data()['file_name'] === 'launch.png');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/media/media-test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/tags?limit=20');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/tags' && $request->data()['name'] === 'Product Launch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.typefully.test/v2/social-sets/social-set-test/queue?limit=10');
    }
}
