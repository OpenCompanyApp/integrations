<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Fivetran;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Fivetran\FivetranService;
use OpenCompany\Integrations\Fivetran\FivetranToolProvider;
use OpenCompany\Integrations\Fivetran\Tools\FivetranConnectionDetails;
use OpenCompany\Integrations\Fivetran\Tools\FivetranCreateConnection;
use OpenCompany\Integrations\Fivetran\Tools\FivetranListConnections;
use PHPUnit\Framework\TestCase;

final class FivetranServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new FivetranToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/fivetran/fivetran-openapi-manifest.json'),true); self::assertSame(161,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Fivetran',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('basic',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('fivetran_get_account_info',array_keys($provider->tools())); self::assertContains('fivetran_list_connections',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new FivetranService('key','secret','https://fivetran.example.test'); $service->request('GET','/v1/connections/{connectionId}',['connectionId'=>'conn 1'],['limit'=>10]); $service->request('POST','/v1/connections',[],[],[],['service'=>'postgres']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://fivetran.example.test/v1/connections/conn%201?limit=10' && $request->hasHeader('Authorization','Basic '.base64_encode('key:secret'))); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://fivetran.example.test/v1/connections' && $request['service']==='postgres'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new FivetranService('key','secret'); $list=(new FivetranListConnections($service))->execute(['limit'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.fivetran.com/v1/connections?limit=10'); $missingPath=(new FivetranConnectionDetails($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('connection_id must be',(string)$missingPath->error); $created=(new FivetranCreateConnection($service))->execute(['body'=>['service'=>'postgres']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.fivetran.com/v1/connections' && $request['service']==='postgres'); }
}