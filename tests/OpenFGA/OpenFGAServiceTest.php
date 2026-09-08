<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OpenFGA;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OpenFGA\OpenFGAService;
use OpenCompany\Integrations\OpenFGA\OpenFGAToolProvider;
use OpenCompany\Integrations\OpenFGA\Tools\OpenFGACheck;
use OpenCompany\Integrations\OpenFGA\Tools\OpenFGAListStores;
use OpenCompany\Integrations\OpenFGA\Tools\OpenFGAReadAuthorizationModel;
use PHPUnit\Framework\TestCase;

final class OpenFGAServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_swagger_manifest_and_docs(): void { $provider=new OpenFGAToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/openfga/openfga-swagger-manifest.json'),true); self::assertSame(24,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('OpenFGA',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('optional_bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('openfga_list_stores',array_keys($provider->tools())); self::assertContains('openfga_check',array_keys($provider->tools())); }
    public function test_service_maps_optional_bearer_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new OpenFGAService('tok','https://openfga.example.test'); $service->request('GET','/stores',[],['page_size'=>10]); $service->request('POST','/stores/{store_id}/check',['store_id'=>'store 1'],[],[],['tuple_key'=>['user'=>'user:anne']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://openfga.example.test/stores?page_size=10' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://openfga.example.test/stores/store%201/check' && $request['tuple_key']['user']==='user:anne'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new OpenFGAService('', 'https://openfga.example.test'); $list=(new OpenFGAListStores($service))->execute(['page_size'=>25]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://openfga.example.test/stores?page_size=25'); $missing=(new OpenFGAReadAuthorizationModel($service))->execute(['store_id'=>'store']); self::assertFalse($missing->succeeded()); self::assertStringContainsString('id must be',(string)$missing->error); $check=(new OpenFGACheck($service))->execute(['store_id'=>'store','body'=>['tuple_key'=>['user'=>'user:anne','relation'=>'viewer','object'=>'doc:1']]]); self::assertTrue($check->succeeded()); }
}
