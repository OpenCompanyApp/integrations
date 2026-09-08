<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\OnePasswordConnect;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\OnePasswordConnect\OnePasswordConnectService;
use OpenCompany\Integrations\OnePasswordConnect\OnePasswordConnectToolProvider;
use OpenCompany\Integrations\OnePasswordConnect\Tools\OnePasswordConnectCreateVaultItem;
use OpenCompany\Integrations\OnePasswordConnect\Tools\OnePasswordConnectDownloadFileById;
use OpenCompany\Integrations\OnePasswordConnect\Tools\OnePasswordConnectGetVaultItems;
use PHPUnit\Framework\TestCase;

final class OnePasswordConnectServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new OnePasswordConnectToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/onepassword-connect/onepassword-connect-openapi-manifest.json'),true); self::assertSame(15,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('1Password Connect',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('bearer_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('onepassword_connect_get_vault_items',array_keys($provider->tools())); self::assertContains('onepassword_connect_download_file_by_id',array_keys($provider->tools())); }
    public function test_service_maps_bearer_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new OnePasswordConnectService('tok','https://connect.example.test/v1'); $service->request('GET','/vaults/{vaultUuid}/items',['vaultUuid'=>'vault 1'],['filter'=>'title eq SSH']); $service->request('POST','/vaults/{vaultUuid}/items',['vaultUuid'=>'vault 1'],[],[],['title'=>'Server']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://connect.example.test/v1/vaults/vault%201/items?filter=title%20eq%20SSH' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://connect.example.test/v1/vaults/vault%201/items' && $request['title']==='Server'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new OnePasswordConnectService('tok','https://connect.example.test/v1'); $items=(new OnePasswordConnectGetVaultItems($service))->execute(['vault_uuid'=>'vault','filter'=>'title eq SSH']); self::assertTrue($items->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://connect.example.test/v1/vaults/vault/items?filter=title%20eq%20SSH'); $missing=(new OnePasswordConnectCreateVaultItem($service))->execute([]); self::assertFalse($missing->succeeded()); self::assertStringContainsString('vault_uuid must be',(string)$missing->error); $download=(new OnePasswordConnectDownloadFileById($service))->execute(['vault_uuid'=>'vault','item_uuid'=>'item','file_uuid'=>'file']); self::assertTrue($download->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://connect.example.test/v1/vaults/vault/items/item/files/file/content'); }
}
