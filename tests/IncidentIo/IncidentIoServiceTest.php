<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\IncidentIo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\IncidentIo\IncidentIoService;
use OpenCompany\Integrations\IncidentIo\IncidentIoToolProvider;
use OpenCompany\Integrations\IncidentIo\Tools\IncidentIoActionsV1List;
use OpenCompany\Integrations\IncidentIo\Tools\IncidentIoIncidentsV2List;
use OpenCompany\Integrations\IncidentIo\Tools\IncidentIoUtilitiesV1Identity;
use PHPUnit\Framework\TestCase;

final class IncidentIoServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new IncidentIoToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/incident-io/incident-io-openapi-manifest.json'),true); self::assertSame(169,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('incident.io',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('incident_io_utilities_v1_identity',array_keys($provider->tools())); self::assertContains('incident_io_incidents_v2_list',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new IncidentIoService('tok','https://incident.example.test'); $service->request('GET','/v2/incidents/{id}',['id'=>'inc 1'],['include_private'=>true]); $service->request('POST','/v2/incidents',[],[],[],['name'=>'Database outage']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://incident.example.test/v2/incidents/inc%201?include_private=true' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://incident.example.test/v2/incidents' && $request['name']==='Database outage'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new IncidentIoService('tok'); $identity=(new IncidentIoUtilitiesV1Identity($service))->execute([]); self::assertTrue($identity->succeeded()); $actions=(new IncidentIoActionsV1List($service))->execute(['incident_mode'=>'test']); self::assertTrue($actions->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.incident.io/v1/identity'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.incident.io/v1/actions?incident_mode=test'); $incidents=(new IncidentIoIncidentsV2List($service))->execute(['page_size'=>10]); self::assertTrue($incidents->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.incident.io/v2/incidents?page_size=10'); }
}
