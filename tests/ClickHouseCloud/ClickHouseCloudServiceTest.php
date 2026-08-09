<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ClickHouseCloud;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ClickHouseCloud\ClickHouseCloudService;
use OpenCompany\Integrations\ClickHouseCloud\ClickHouseCloudToolProvider;
use OpenCompany\Integrations\ClickHouseCloud\Tools\ClickHouseCloudInstanceCreate;
use OpenCompany\Integrations\ClickHouseCloud\Tools\ClickHouseCloudInstanceGet;
use OpenCompany\Integrations\ClickHouseCloud\Tools\ClickHouseCloudOrganizationGetList;
use PHPUnit\Framework\TestCase;

final class ClickHouseCloudServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new ClickHouseCloudToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/clickhouse-cloud/clickhouse-cloud-openapi-manifest.json'),true); self::assertSame(96,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('ClickHouse Cloud',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('basic',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('clickhouse_cloud_organization_get_list',array_keys($provider->tools())); self::assertContains('clickhouse_cloud_instance_create',array_keys($provider->tools())); }
    public function test_service_maps_basic_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['status'=>200],200)]); $service=new ClickHouseCloudService('key-id','secret','https://clickhouse.example.test'); $service->request('GET','/v1/organizations/{organizationId}/services/{serviceId}',['organizationId'=>'org 1','serviceId'=>'svc 1'],['limit'=>10]); $service->request('POST','/v1/organizations/{organizationId}/services',['organizationId'=>'org-1'],[],[],['name'=>'Warehouse']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://clickhouse.example.test/v1/organizations/org%201/services/svc%201?limit=10' && $request->hasHeader('Authorization','Basic '.base64_encode('key-id:secret'))); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://clickhouse.example.test/v1/organizations/org-1/services' && $request['name']==='Warehouse'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['status'=>200],200)]); $service=new ClickHouseCloudService('key-id','secret'); $list=(new ClickHouseCloudOrganizationGetList($service))->execute([]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.clickhouse.cloud/v1/organizations'); $missingPath=(new ClickHouseCloudInstanceGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('organization_id must be',(string)$missingPath->error); $created=(new ClickHouseCloudInstanceCreate($service))->execute(['organization_id'=>'org-1','body'=>['name'=>'Warehouse']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.clickhouse.cloud/v1/organizations/org-1/services' && $request['name']==='Warehouse'); }
}