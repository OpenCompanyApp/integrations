<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\FireHydrant;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\FireHydrant\FireHydrantService;
use OpenCompany\Integrations\FireHydrant\FireHydrantToolProvider;
use OpenCompany\Integrations\FireHydrant\Tools\FireHydrantCreateIncident;
use OpenCompany\Integrations\FireHydrant\Tools\FireHydrantGetIncident;
use OpenCompany\Integrations\FireHydrant\Tools\FireHydrantListIncidents;
use OpenCompany\Integrations\FireHydrant\Tools\FireHydrantPing;
use PHPUnit\Framework\TestCase;

final class FireHydrantServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new FireHydrantToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/firehydrant/firehydrant-openapi-manifest.json'),true); self::assertSame(477,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('FireHydrant',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('firehydrant_ping',array_keys($provider->tools())); self::assertContains('firehydrant_create_incident',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new FireHydrantService('tok','https://firehydrant.example.test'); $service->request('GET','/v1/incidents/{incident_id}',['incident_id'=>'inc 1'],['include_archived'=>true]); $service->request('POST','/v1/incidents',[],[],[],['name'=>'Database outage']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://firehydrant.example.test/v1/incidents/inc%201?include_archived=true' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://firehydrant.example.test/v1/incidents' && $request['name']==='Database outage'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new FireHydrantService('tok'); $ping=(new FireHydrantPing($service))->execute([]); self::assertTrue($ping->succeeded()); $list=(new FireHydrantListIncidents($service))->execute(['page'=>1,'per_page'=>25]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.firehydrant.io/v1/ping'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.firehydrant.io/v1/incidents?page=1&per_page=25'); $missingPath=(new FireHydrantGetIncident($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('incident_id must be',(string)$missingPath->error); $created=(new FireHydrantCreateIncident($service))->execute(['body'=>['name'=>'Database outage']]); self::assertTrue($created->succeeded()); }
}