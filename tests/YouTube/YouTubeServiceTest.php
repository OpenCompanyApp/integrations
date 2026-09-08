<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\YouTube;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\YouTube\Tools\YouTubeChannelsList;
use OpenCompany\Integrations\YouTube\Tools\YouTubeCommentsInsert;
use OpenCompany\Integrations\YouTube\Tools\YouTubeVideosInsert;
use OpenCompany\Integrations\YouTube\YouTubeService;
use OpenCompany\Integrations\YouTube\YouTubeToolProvider;
use PHPUnit\Framework\TestCase;

final class YouTubeServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new YouTubeToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/youtube/youtube-discovery-manifest.json'),true); self::assertSame(83,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('YouTube',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('youtube_videos_insert',array_keys($provider->tools())); self::assertContains('youtube_captions_download',array_keys($provider->tools())); }
    public function test_service_maps_api_key_query_body_and_oauth(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $apiKeyService=new YouTubeService('', 'key-test', 'https://example.test'); $apiKeyService->request('GET','/youtube/v3/videos',[],[],['part'=>'snippet','id'=>['a','b']]); $oauthService=new YouTubeService('token-test','', 'https://example.test'); $oauthService->request('POST','/youtube/v3/comments',[],[],['part'=>'snippet'],['snippet'=>['textOriginal'=>'Hi']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/youtube/v3/videos?part=snippet&id=a&id=b&key=key-test'); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/youtube/v3/comments?part=snippet' && $request->hasHeader('Authorization','Bearer token-test') && $request['snippet']['textOriginal']==='Hi'); }
    public function test_tools_filter_query_require_body_and_upload_files(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new YouTubeService('token-test'); $channels=new YouTubeChannelsList($service); $result=$channels->execute(['part'=>'snippet','mine'=>true,'unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://youtube.googleapis.com/youtube/v3/channels?part=snippet&mine=1'); $missingBody=(new YouTubeCommentsInsert($service))->execute(['part'=>'snippet']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $file=tempnam(sys_get_temp_dir(),'youtube-upload-'); file_put_contents((string)$file,'video'); try{$upload=(new YouTubeVideosInsert($service))->execute(['part'=>'snippet,status','file_path'=>(string)$file,'mime_type'=>'video/mp4','body'=>['snippet'=>['title'=>'Demo']]]); self::assertTrue($upload->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://youtube.googleapis.com/upload/youtube/v3/videos?part=snippet%2Cstatus&uploadType=multipart' && str_starts_with((string)$request->header('Content-Type')[0],'multipart/related; boundary=') && str_contains((string)$request->body(),'Demo') && str_contains((string)$request->body(),'video')); } finally { if(is_string($file)&&file_exists($file)) unlink($file); } }
}
