<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Miro;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Miro\MiroService;
use OpenCompany\Integrations\Miro\MiroToolProvider;
use OpenCompany\Integrations\Miro\Tools\MiroCreateImageItemUsingLocalFile;
use OpenCompany\Integrations\Miro\Tools\MiroCreateStickyNoteItem;
use OpenCompany\Integrations\Miro\Tools\MiroGetBoards;
use PHPUnit\Framework\TestCase;

final class MiroServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new MiroToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/miro/miro-openapi-manifest.json'),true); self::assertSame(197,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Miro',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth_bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('miro_get_boards',array_keys($provider->tools())); self::assertContains('miro_create_image_item_using_local_file',array_keys($provider->tools())); }
    public function test_service_maps_bearer_path_query_json_and_multipart_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new MiroService('tok','https://miro.example.test'); $service->request('GET','/v2/boards',[],['limit'=>25]); $service->request('POST','/v2/boards/{board_id}/sticky_notes',['board_id'=>'board 1'],[],[],['data'=>['content'=>'Note']]); $service->request('POST','/v2/boards/{board_id}/images',['board_id'=>'board 1'],[],[],['file'=>'image-bytes'],'multipart/form-data'); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://miro.example.test/v2/boards?limit=25' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://miro.example.test/v2/boards/board%201/sticky_notes' && $request['data']['content']==='Note'); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://miro.example.test/v2/boards/board%201/images'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new MiroService('tok','https://miro.example.test'); $boards=(new MiroGetBoards($service))->execute(['limit'=>10]); self::assertTrue($boards->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://miro.example.test/v2/boards?limit=10'); $missing=(new MiroCreateStickyNoteItem($service))->execute(['body'=>['data'=>['content'=>'Note']]]); self::assertFalse($missing->succeeded()); self::assertStringContainsString('board_id must be',(string)$missing->error); $upload=(new MiroCreateImageItemUsingLocalFile($service))->execute(['board_id_platform_file_upload'=>'board','body'=>['file'=>'bytes']]); self::assertTrue($upload->succeeded()); }
}
