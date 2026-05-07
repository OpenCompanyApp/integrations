<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Snyk;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Snyk\SnykService;
use OpenCompany\Integrations\Snyk\SnykToolProvider;
use OpenCompany\Integrations\Snyk\Tools\SnykCreateCustomBaseImage;
use OpenCompany\Integrations\Snyk\Tools\SnykGetGroup;
use OpenCompany\Integrations\Snyk\Tools\SnykListGroups;
use PHPUnit\Framework\TestCase;

final class SnykServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new SnykToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/snyk/snyk-openapi-manifest.json'),true); self::assertSame(277,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Snyk',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('snyk_list_groups',array_keys($provider->tools())); self::assertContains('snyk_get_group',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_default_version_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new SnykService('tok','https://snyk.example.test/rest','2024-10-15'); $service->request('GET','/groups/{group_id}',['group_id'=>'group 1'],['limit'=>10]); $service->request('POST','/custom_base_images',[],[],[],['data'=>['type'=>'custom_base_image']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://snyk.example.test/rest/groups/group%201?limit=10&version=2024-10-15' && $request->hasHeader('Authorization','token tok') && $request->hasHeader('Content-Type','application/vnd.api+json')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://snyk.example.test/rest/custom_base_images?version=2024-10-15' && $request['data']['type']==='custom_base_image'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new SnykService('tok'); $list=(new SnykListGroups($service))->execute(['limit'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.snyk.io/rest/groups?limit=10&version=2024-10-15'); $missingPath=(new SnykGetGroup($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('group_id must be',(string)$missingPath->error); $created=(new SnykCreateCustomBaseImage($service))->execute(['body'=>['data'=>['type'=>'custom_base_image']]]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.snyk.io/rest/custom_base_images?version=2024-10-15' && $request['data']['type']==='custom_base_image'); }
}