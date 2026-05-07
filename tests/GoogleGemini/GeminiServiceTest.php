<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleGemini;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleGemini\GeminiService;
use OpenCompany\Integrations\GoogleGemini\GeminiToolProvider;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiMediaUpload;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiModelsGenerateContent;
use OpenCompany\Integrations\GoogleGemini\Tools\GeminiModelsGet;
use PHPUnit\Framework\TestCase;

final class GeminiServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GeminiToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-gemini/google-gemini-discovery-manifest.json'),true); self::assertSame(79,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Gemini',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_key',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_gemini_models_generate_content',array_keys($provider->tools())); self::assertContains('google_gemini_media_upload',array_keys($provider->tools())); }
    public function test_service_maps_api_key_reserved_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GeminiService('key-test','https://example.test'); $service->request('GET','/v1beta/{+name}',['name'=>'models/gemini-pro'],['name'],[]); $service->request('POST','/v1beta/{+model}:generateContent',['model'=>'models/gemini-pro'],['model'],[],['contents'=>[]]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v1beta/models/gemini-pro' && $request->hasHeader('x-goog-api-key','key-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v1beta/models/gemini-pro:generateContent' && is_array($request['contents'])); }
    public function test_tools_require_path_body_and_upload_files(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GeminiService('key-test'); $get=new GeminiModelsGet($service); $result=$get->execute(['name'=>'models/gemini-pro']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://generativelanguage.googleapis.com/v1beta/models/gemini-pro'); $missingPath=(new GeminiModelsGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('name must be',(string)$missingPath->error); $missingBody=(new GeminiModelsGenerateContent($service))->execute(['model'=>'models/gemini-pro']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $file=tempnam(sys_get_temp_dir(),'gemini-upload-'); file_put_contents((string)$file,'media'); try{$upload=(new GeminiMediaUpload($service))->execute(['file_path'=>(string)$file,'mime_type'=>'text/plain','body'=>['file'=>['displayName'=>'demo.txt']]]); self::assertTrue($upload->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://generativelanguage.googleapis.com/upload/v1beta/files?uploadType=multipart' && str_starts_with((string)$request->header('Content-Type')[0],'multipart/related; boundary=') && str_contains((string)$request->body(),'demo.txt') && str_contains((string)$request->body(),'media')); } finally { if(is_string($file)&&file_exists($file)) unlink($file); } }
}
