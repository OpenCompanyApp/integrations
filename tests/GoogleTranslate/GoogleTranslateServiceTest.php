<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleTranslate;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateService;
use OpenCompany\Integrations\GoogleTranslate\GoogleTranslateToolProvider;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateProjectsGetSupportedLanguages;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateProjectsTranslateText;
use OpenCompany\Integrations\GoogleTranslate\Tools\GoogleTranslateProjectsLocationsGlossariesCreate;
use PHPUnit\Framework\TestCase;

final class GoogleTranslateServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleTranslateToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-translate/google-translate-discovery-manifest.json'),true); self::assertSame(51,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Translate',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_translate_projects_translate_text',array_keys($provider->tools())); self::assertContains('google_translate_projects_locations_glossaries_create',array_keys($provider->tools())); }
    public function test_service_maps_reserved_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleTranslateService('token-test','https://example.test'); $service->request('GET','/v3/{+parent}/supportedLanguages',['parent'=>'projects/demo/locations/global'],['parent'],['displayLanguageCode'=>'en']); $service->request('POST','/v3/{+parent}:translateText',['parent'=>'projects/demo'],['parent'],[],['contents'=>['Hello'],'targetLanguageCode'=>'es']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v3/projects/demo/locations/global/supportedLanguages?displayLanguageCode=en' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v3/projects/demo:translateText' && $request['targetLanguageCode']==='es'); }
    public function test_tools_filter_query_require_path_params_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleTranslateService('token-test'); $langs=new GoogleTranslateProjectsGetSupportedLanguages($service); $result=$langs->execute(['parent'=>'projects/demo','displayLanguageCode'=>'en','unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://translate.googleapis.com/v3/projects/demo/supportedLanguages?displayLanguageCode=en'); $missingPath=(new GoogleTranslateProjectsGetSupportedLanguages($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('parent must be',(string)$missingPath->error); $missingBody=(new GoogleTranslateProjectsTranslateText($service))->execute(['parent'=>'projects/demo']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $glossaryMissingBody=(new GoogleTranslateProjectsLocationsGlossariesCreate($service))->execute(['parent'=>'projects/demo/locations/global']); self::assertFalse($glossaryMissingBody->succeeded()); }
}
