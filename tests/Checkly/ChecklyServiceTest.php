<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Checkly;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Checkly\ChecklyService;
use OpenCompany\Integrations\Checkly\ChecklyToolProvider;
use OpenCompany\Integrations\Checkly\Tools\ChecklyGetV1Checks;
use OpenCompany\Integrations\Checkly\Tools\ChecklyPostV1Checks;
use OpenCompany\Integrations\Checkly\Tools\ChecklyGetV1ChecksId;
use PHPUnit\Framework\TestCase;

final class ChecklyServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new ChecklyToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/checkly/checkly-openapi-manifest.json'),true); self::assertSame(164,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Checkly',$provider->integrationMeta()['name']); self::assertSame('analytics',$provider->integrationMeta()['category']); self::assertSame('bearer_token_with_account_header',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('checkly_get_v1_checks',array_keys($provider->tools())); self::assertContains('checkly_post_v1_checks',array_keys($provider->tools())); }
    public function test_service_maps_bearer_account_header_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new ChecklyService('key','acct','https://checkly.example.test'); $service->request('GET','/v1/checks',[],['limit'=>20]); $service->request('POST','/v1/checks',[],[],[],['name'=>'API']); $service->request('GET','/v1/checks/{id}',['id'=>'check 1']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://checkly.example.test/v1/checks?limit=20' && $request->hasHeader('Authorization','Bearer key') && $request->hasHeader('X-Checkly-Account','acct')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://checkly.example.test/v1/checks' && $request['name']==='API'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://checkly.example.test/v1/checks/check%201'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new ChecklyService('key','acct','https://checkly.example.test'); $checks=(new ChecklyGetV1Checks($service))->execute(['limit'=>10]); self::assertTrue($checks->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://checkly.example.test/v1/checks?limit=10'); $missing=(new ChecklyGetV1ChecksId($service))->execute([]); self::assertFalse($missing->succeeded()); self::assertStringContainsString('id must be',(string)$missing->error); $created=(new ChecklyPostV1Checks($service))->execute(['body'=>['name'=>'API']]); self::assertTrue($created->succeeded()); }
}
