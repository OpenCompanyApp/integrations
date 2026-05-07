<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleSlides;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleSlides\GoogleSlidesService;
use OpenCompany\Integrations\GoogleSlides\GoogleSlidesToolProvider;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesPresentationsGet;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesPresentationsBatchUpdate;
use OpenCompany\Integrations\GoogleSlides\Tools\GoogleSlidesPresentationsPagesGetThumbnail;
use PHPUnit\Framework\TestCase;

final class GoogleSlidesServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleSlidesToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-slides/google-slides-discovery-manifest.json'),true); self::assertSame(5,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Slides',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_slides_presentations_batch_update',array_keys($provider->tools())); self::assertContains('google_slides_presentations_pages_get_thumbnail',array_keys($provider->tools())); }
    public function test_service_maps_reserved_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleSlidesService('token-test','https://example.test'); $service->request('GET','/v1/presentations/{+presentationId}',['presentationId'=>'folder/deck'],['presentationId'],['fields'=>'presentationId']); $service->request('POST','/v1/presentations/{presentationId}:batchUpdate',['presentationId'=>'deck 1'],[],[],['requests'=>[]]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v1/presentations/folder/deck?fields=presentationId' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v1/presentations/deck%201:batchUpdate' && is_array($request['requests'])); }
    public function test_tools_filter_query_require_path_params_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleSlidesService('token-test'); $thumb=new GoogleSlidesPresentationsPagesGetThumbnail($service); $result=$thumb->execute(['presentationId'=>'deck-1','pageObjectId'=>'slide-1','thumbnailProperties.mimeType'=>'PNG','unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => str_contains($request->url(),'https://slides.googleapis.com/v1/presentations/deck-1/pages/slide-1/thumbnail')); $missingPath=(new GoogleSlidesPresentationsGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('presentationId must be',(string)$missingPath->error); $missingBody=(new GoogleSlidesPresentationsBatchUpdate($service))->execute(['presentationId'=>'deck-1']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); }
}
