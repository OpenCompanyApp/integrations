<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\DbtCloud;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\DbtCloud\DbtCloudService;
use OpenCompany\Integrations\DbtCloud\DbtCloudToolProvider;
use OpenCompany\Integrations\DbtCloud\Tools\DbtCloudV2ListAccounts;
use OpenCompany\Integrations\DbtCloud\Tools\DbtCloudV3ListAccounts;
use OpenCompany\Integrations\DbtCloud\Tools\DbtCloudV3RetrieveAccountConnection;
use PHPUnit\Framework\TestCase;

final class DbtCloudServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new DbtCloudToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/dbt-cloud/dbt-cloud-openapi-manifest.json'),true); self::assertSame(202,$manifest['method_count']); self::assertSame(52,$manifest['specs']['v2']['method_count']); self::assertSame(150,$manifest['specs']['v3']['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('dbt Cloud',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('dbt_cloud_v2_list_accounts',array_keys($provider->tools())); self::assertContains('dbt_cloud_v3_retrieve_account_connection',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new DbtCloudService('tok','https://dbt.example.test'); $service->request('GET','/api/v3/accounts/{account_id}/connections/{id}/',['account_id'=>123,'id'=>456],['limit'=>10]); $service->request('POST','/api/v3/accounts/{account_id}/connections/',['account_id'=>123],[],[],['name'=>'Warehouse']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://dbt.example.test/api/v3/accounts/123/connections/456/?limit=10' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://dbt.example.test/api/v3/accounts/123/connections/' && $request['name']==='Warehouse'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new DbtCloudService('tok'); $listV2=(new DbtCloudV2ListAccounts($service))->execute([]); self::assertTrue($listV2->succeeded()); $listV3=(new DbtCloudV3ListAccounts($service))->execute([]); self::assertTrue($listV3->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://cloud.getdbt.com/api/v2/accounts/'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://cloud.getdbt.com/api/v3/accounts/'); $missingPath=(new DbtCloudV3RetrieveAccountConnection($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('account_id must be',(string)$missingPath->error); }
}