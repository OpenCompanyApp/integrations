<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Rootly;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Rootly\RootlyService;
use OpenCompany\Integrations\Rootly\RootlyToolProvider;
use OpenCompany\Integrations\Rootly\Tools\RootlyCreateIncident;
use OpenCompany\Integrations\Rootly\Tools\RootlyGetIncident;
use OpenCompany\Integrations\Rootly\Tools\RootlyListIncidents;
use PHPUnit\Framework\TestCase;

final class RootlyServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new RootlyToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/rootly/rootly-openapi-manifest.json'),true); self::assertSame(536,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Rootly',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('rootly_list_incidents',array_keys($provider->tools())); self::assertContains('rootly_create_incident',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_body_and_jsonapi_headers(): void { Http::fake(['*'=>Http::response(['data'=>[]],200)]); $service=new RootlyService('tok','https://rootly.example.test'); $service->request('GET','/v1/incidents/{id}',['id'=>'inc 1'],['page[number]'=>2]); $service->request('POST','/v1/incidents',[],[],[],['data'=>['type'=>'incidents']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://rootly.example.test/v1/incidents/inc%201?page%5Bnumber%5D=2' && $request->hasHeader('Authorization','Bearer tok') && $request->hasHeader('Content-Type','application/vnd.api+json')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://rootly.example.test/v1/incidents' && $request['data']['type']==='incidents'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['data'=>[]],200)]); $service=new RootlyService('tok'); $list=(new RootlyListIncidents($service))->execute(['page_number'=>1,'page_size'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.rootly.com/v1/incidents?page%5Bnumber%5D=1&page%5Bsize%5D=10'); $missingPath=(new RootlyGetIncident($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('id must be',(string)$missingPath->error); $created=(new RootlyCreateIncident($service))->execute(['body'=>['data'=>['type'=>'incidents']]]); self::assertTrue($created->succeeded()); }
}