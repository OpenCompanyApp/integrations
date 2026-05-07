<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\WorkOS;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\WorkOS\WorkOSService;
use OpenCompany\Integrations\WorkOS\WorkOSToolProvider;
use OpenCompany\Integrations\WorkOS\Tools\WorkOSOrganizationsList;
use OpenCompany\Integrations\WorkOS\Tools\WorkOSOrganizationsFind;
use OpenCompany\Integrations\WorkOS\Tools\WorkOSOrganizationsCreate;
use PHPUnit\Framework\TestCase;

final class WorkOSServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new WorkOSToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/workos/workos-openapi-manifest.json'),true); self::assertSame(172,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('WorkOS',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('workos_organizations_list',array_keys($provider->tools())); self::assertContains('workos_userland_users_get_0',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new WorkOSService('sk_test','https://workos.example.test'); $service->request('GET','/organizations/{organization_id}',['organization_id'=>'org 1'],['limit'=>10]); $service->request('POST','/organizations',[],[],[],['name'=>'Acme']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://workos.example.test/organizations/org%201?limit=10' && $request->hasHeader('Authorization','Bearer sk_test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://workos.example.test/organizations' && $request['name']==='Acme'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new WorkOSService('sk_test'); $list=(new WorkOSOrganizationsList($service))->execute(['limit'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.workos.com/organizations?limit=10'); $missingPath=(new WorkOSOrganizationsFind($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('id must be',(string)$missingPath->error); $created=(new WorkOSOrganizationsCreate($service))->execute(['body'=>['name'=>'Acme']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.workos.com/organizations' && $request['name']==='Acme'); }
}
