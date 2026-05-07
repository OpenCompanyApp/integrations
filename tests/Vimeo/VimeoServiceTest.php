<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Vimeo;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Vimeo\Tools\VimeoApiGet;
use OpenCompany\Integrations\Vimeo\Tools\VimeoCreateAlbum;
use OpenCompany\Integrations\Vimeo\Tools\VimeoUpdateVideo;
use OpenCompany\Integrations\Vimeo\VimeoService;
use OpenCompany\Integrations\Vimeo\VimeoToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Vimeo API coverage.
 */
final class VimeoServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_video_album_folder_comment_text_track_picture_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api.vimeo.com/*' => Http::response(['ok' => true, 'data' => []], 200),
        ]);

        $service = new VimeoService('vim_test');

        $service->listVideos(['query' => 'launch']);
        $service->getVideo('100');
        $service->createVideo(['upload' => ['approach' => 'post']]);
        $service->uploadVideo(['name' => 'Upload']);
        $service->updateVideo('100', ['name' => 'Updated']);
        $service->deleteVideo('100');
        $service->listVideoComments('100');
        $service->createVideoComment('100', 'Looks good.');
        $service->listVideoTextTracks('100');
        $service->createVideoTextTrack('100', ['type' => 'subtitles', 'language' => 'en', 'name' => 'English']);
        $service->listVideoPictures('100');
        $service->createVideoPicture('100');
        $service->listAlbums();
        $service->getAlbum('200');
        $service->createAlbum(['name' => 'Showcase']);
        $service->updateAlbum('200', ['name' => 'Updated']);
        $service->deleteAlbum('200');
        $service->listAlbumVideos('200');
        $service->addVideoToAlbum('200', '100');
        $service->removeVideoFromAlbum('200', '100');
        $service->listFolders();
        $service->createFolder(['name' => 'Project']);
        $service->updateFolder('300', ['name' => 'Updated']);
        $service->deleteFolder('300');
        $service->listChannels(1, 10);
        $service->listCategories();
        $service->getCurrentUser();
        $service->apiGet('/me/team_members');
        $service->apiPost('/me/albums', ['name' => 'Showcase']);
        $service->apiPatch('/videos/100', ['name' => 'Updated']);
        $service->apiDelete('/videos/100');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer vim_test'));
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'https://api.vimeo.com/me/videos?query=launch'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.vimeo.com/videos/100');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.vimeo.com/videos/100');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/videos/100/comments');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/videos/100/texttracks');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/videos/100/pictures');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.vimeo.com/me/albums');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.vimeo.com/me/albums/200/videos/100');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.vimeo.com/me/folders/300');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/channels?page=1&per_page=10');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/categories');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.vimeo.com/me');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.vimeo.com/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new VimeoService('vim_test');

        self::assertTrue((new VimeoUpdateVideo($service))->execute([
            'video_id' => '100',
            'data' => ['name' => 'Updated'],
        ])->succeeded());
        self::assertTrue((new VimeoCreateAlbum($service))->execute([
            'data' => ['name' => 'Showcase'],
        ])->succeeded());
        self::assertTrue((new VimeoApiGet($service))->execute([
            'path' => '/me/videos',
            'params' => ['per_page' => 5],
        ])->succeeded());
        self::assertFalse((new VimeoUpdateVideo($service))->execute([
            'video_id' => '',
            'data' => ['name' => 'Updated'],
        ])->succeeded());
        self::assertFalse((new VimeoApiGet($service))->execute([
            'path' => 'https://example.test/me/videos',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.vimeo.com/me' => Http::response(['uri' => '/users/1'], 200),
        ]);

        $provider = new VimeoToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('vimeo_upload_video', $tools);
        self::assertArrayHasKey('vimeo_update_video', $tools);
        self::assertArrayHasKey('vimeo_list_video_comments', $tools);
        self::assertArrayHasKey('vimeo_create_video_text_track', $tools);
        self::assertArrayHasKey('vimeo_add_video_to_album', $tools);
        self::assertArrayHasKey('vimeo_api_delete', $tools);
        self::assertSame(27, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'vim_test',
        ])['success']);
    }
}
