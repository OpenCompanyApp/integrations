<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Databricks;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Databricks\DatabricksService;
use OpenCompany\Integrations\Databricks\DatabricksToolProvider;
use OpenCompany\Integrations\Databricks\Tools\DatabricksIamMe;
use OpenCompany\Integrations\Databricks\Tools\DatabricksJobsCreate;
use OpenCompany\Integrations\Databricks\Tools\DatabricksJobsGetPermissionLevels;
use OpenCompany\Integrations\Databricks\Tools\DatabricksJobsList;
use PHPUnit\Framework\TestCase;

final class DatabricksServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_generated_manifest_and_docs(): void { $provider=new DatabricksToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/databricks/databricks-openapi-manifest.json'),true); self::assertSame(1098,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Databricks',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('databricks_iam_me',array_keys($provider->tools())); self::assertContains('databricks_jobs_create',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_workspace_header_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new DatabricksService('tok','https://dbc.example.test','acct-1','123'); $service->request('GET','/api/2.0/permissions/jobs/{job_id}/permissionLevels',['job_id'=>'job 1'],['limit'=>10]); $service->request('POST','/api/2.2/jobs/create',[],[],[],['name'=>'Nightly']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://dbc.example.test/api/2.0/permissions/jobs/job%201/permissionLevels?limit=10' && $request->hasHeader('Authorization','Bearer tok') && $request->hasHeader('X-Databricks-Org-Id','123')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://dbc.example.test/api/2.2/jobs/create' && $request['name']==='Nightly'); }
    public function test_tools_validate_path_parameters_and_map_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new DatabricksService('tok','https://dbc.example.test'); $me=(new DatabricksIamMe($service))->execute([]); self::assertTrue($me->succeeded()); $list=(new DatabricksJobsList($service))->execute(['query'=>['limit'=>25]]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://dbc.example.test/api/2.0/preview/scim/v2/Me'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://dbc.example.test/api/2.2/jobs/list?limit=25'); $missingPath=(new DatabricksJobsGetPermissionLevels($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('job_id must be',(string)$missingPath->error); $created=(new DatabricksJobsCreate($service))->execute(['body'=>['name'=>'Nightly']]); self::assertTrue($created->succeeded()); }
}