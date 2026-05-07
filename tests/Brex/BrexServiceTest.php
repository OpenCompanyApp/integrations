<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Brex;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Brex\BrexService;
use OpenCompany\Integrations\Brex\BrexToolProvider;
use OpenCompany\Integrations\Brex\Tools\BrexTeamCreateCard;
use OpenCompany\Integrations\Brex\Tools\BrexTeamGetCardById;
use OpenCompany\Integrations\Brex\Tools\BrexTeamListCardsByUserId;
use PHPUnit\Framework\TestCase;

final class BrexServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new BrexToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/brex/brex-openapi-manifest.json'),true); self::assertSame(108,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Brex',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('brex_team_create_card',array_keys($provider->tools())); self::assertContains('brex_payments_create_vendor',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_headers_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new BrexService('token-test','https://api.brex.test'); $service->request('GET','/v2/cards/{id}',['id'=>'card 1'],['expand'=>['user','limit']],[]); $service->request('POST','/v2/cards',[],[],['Idempotency-Key'=>'idem-1'],['user_id'=>'user-1']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://api.brex.test/v2/cards/card%201?expand=user&expand=limit' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://api.brex.test/v2/cards' && $request->hasHeader('Idempotency-Key','idem-1') && $request['user_id']==='user-1'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new BrexService('token-test'); $list=(new BrexTeamListCardsByUserId($service))->execute(['user_id'=>'user-1','limit'=>10]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.brex.com/v2/cards?user_id=user-1&limit=10'); $missingPath=(new BrexTeamGetCardById($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('id must be',(string)$missingPath->error); $missingBody=(new BrexTeamCreateCard($service))->execute(['idempotency_key'=>'idem-1']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $created=(new BrexTeamCreateCard($service))->execute(['idempotency_key'=>'idem-1','body'=>['user_id'=>'user-1']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->hasHeader('Idempotency-Key','idem-1') && $request['user_id']==='user-1'); }
}