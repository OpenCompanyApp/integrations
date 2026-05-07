<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Airbyte;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Airbyte\AirbyteService;
use OpenCompany\Integrations\Airbyte\AirbyteToolProvider;
use OpenCompany\Integrations\Airbyte\Tools\AirbyteCreateConnection;
use OpenCompany\Integrations\Airbyte\Tools\AirbyteGetConnection;
use OpenCompany\Integrations\Airbyte\Tools\AirbyteListConnections;
use PHPUnit\Framework\TestCase;

final class AirbyteServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new AirbyteToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/airbyte/airbyte-openapi-manifest.json'),true); self::assertSame(37,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Airbyte',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('airbyte_list_connections',array_keys($provider->tools())); self::assertContains('airbyte_get_connection',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new AirbyteService('tok','https://airbyte.example.test/v1'); $service->request('GET','/connections/{connectionId}',['connectionId'=>'conn 1'],['limit'=>10]); $service->request('POST','/connections',[],[],[],['name'=>'Sync']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://airbyte.example.test/v1/connections/conn%201?limit=10' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://airbyte.example.test/v1/connections' && $request['name']==='Sync'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new AirbyteService('tok'); $list=(new AirbyteListConnections($service))->execute(['limit'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.airbyte.com/v1/connections?limit=10'); $missingPath=(new AirbyteGetConnection($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('connection_id must be',(string)$missingPath->error); $created=(new AirbyteCreateConnection($service))->execute(['body'=>['name'=>'Sync']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.airbyte.com/v1/connections' && $request['name']==='Sync'); }
}