<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\StatusCake;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\StatusCake\StatusCakeService;
use OpenCompany\Integrations\StatusCake\StatusCakeToolProvider;
use OpenCompany\Integrations\StatusCake\Tools\StatusCakeCreateUptimeTest;
use OpenCompany\Integrations\StatusCake\Tools\StatusCakeGetUptimeTest;
use OpenCompany\Integrations\StatusCake\Tools\StatusCakeListUptimeTests;
use PHPUnit\Framework\TestCase;

final class StatusCakeServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_swagger_manifest_and_docs(): void { $provider=new StatusCakeToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/statuscake/statuscake-openapi-manifest.json'),true); self::assertSame(36,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('StatusCake',$provider->integrationMeta()['name']); self::assertSame('analytics',$provider->integrationMeta()['category']); self::assertSame('bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('statuscake_list_uptime_tests',array_keys($provider->tools())); self::assertContains('statuscake_create_uptime_test',array_keys($provider->tools())); }
    public function test_service_maps_bearer_path_query_and_form_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new StatusCakeService('key','https://statuscake.example.test/v1'); $service->request('GET','/uptime',[],['page'=>1]); $service->request('POST','/uptime',[],[],[],['name'=>'Site','website_url'=>'https://example.test']); $service->request('GET','/uptime/{test_id}',['test_id'=>'test 1']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://statuscake.example.test/v1/uptime?page=1' && $request->hasHeader('Authorization','Bearer key')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://statuscake.example.test/v1/uptime' && str_contains((string)$request->body(),'name=Site') && str_contains((string)$request->body(),'website_url=https%3A%2F%2Fexample.test')); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://statuscake.example.test/v1/uptime/test%201'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new StatusCakeService('key','https://statuscake.example.test/v1'); $list=(new StatusCakeListUptimeTests($service))->execute(['page'=>2]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://statuscake.example.test/v1/uptime?page=2'); $missing=(new StatusCakeGetUptimeTest($service))->execute([]); self::assertFalse($missing->succeeded()); self::assertStringContainsString('test_id must be',(string)$missing->error); $created=(new StatusCakeCreateUptimeTest($service))->execute(['body'=>['name'=>'Site']]); self::assertTrue($created->succeeded()); }
}
