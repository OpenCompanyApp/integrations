<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Ramp;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Ramp\RampService;
use OpenCompany\Integrations\Ramp\RampToolProvider;
use OpenCompany\Integrations\Ramp\Tools\RampGetCardListWithPagination;
use OpenCompany\Integrations\Ramp\Tools\RampGetGlAccountResource;
use OpenCompany\Integrations\Ramp\Tools\RampPostGlAccountListResource;
use PHPUnit\Framework\TestCase;

final class RampServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new RampToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/ramp/ramp-openapi-manifest.json'),true); self::assertSame(228,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Ramp',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('ramp_get_card_list_with_pagination',array_keys($provider->tools())); self::assertContains('ramp_post_gl_account_list_resource',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new RampService('token-test','https://api.ramp.test'); $service->request('GET','/developer/v1/accounting/accounts/{gl_account_id}',['gl_account_id'=>'acct 1'],['include_inactive'=>false]); $service->request('POST','/developer/v1/accounting/accounts',[],[],[],['name'=>'Travel']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://api.ramp.test/developer/v1/accounting/accounts/acct%201?include_inactive=false' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://api.ramp.test/developer/v1/accounting/accounts' && $request['name']==='Travel'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new RampService('token-test'); $list=(new RampGetCardListWithPagination($service))->execute(['page_size'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => str_contains($request->url(),'page_size=10')); $missingPath=(new RampGetGlAccountResource($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('gl_account_id must be',(string)$missingPath->error); $missingBody=(new RampPostGlAccountListResource($service))->execute([]); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $created=(new RampPostGlAccountListResource($service))->execute(['body'=>['name'=>'Travel']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.ramp.com/developer/v1/accounting/accounts' && $request['name']==='Travel'); }
}