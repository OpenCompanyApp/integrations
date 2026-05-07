<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Tailscale;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Tailscale\TailscaleService;
use OpenCompany\Integrations\Tailscale\TailscaleToolProvider;
use OpenCompany\Integrations\Tailscale\Tools\TailscaleCreateKey;
use OpenCompany\Integrations\Tailscale\Tools\TailscaleGetDevice;
use OpenCompany\Integrations\Tailscale\Tools\TailscaleListTailnetDevices;
use PHPUnit\Framework\TestCase;

final class TailscaleServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new TailscaleToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/tailscale/tailscale-openapi-manifest.json'),true); self::assertSame(85,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Tailscale',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('tailscale_list_tailnet_devices',array_keys($provider->tools())); self::assertContains('tailscale_create_key',array_keys($provider->tools())); }
    public function test_service_maps_basic_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new TailscaleService('tok','https://tailscale.example.test/api/v2'); $service->request('GET','/tailnet/{tailnet}/devices',['tailnet'=>'example.com'],['fields'=>'all']); $service->request('POST','/tailnet/{tailnet}/keys',['tailnet'=>'example.com'],[],[],['description'=>'CI key']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://tailscale.example.test/api/v2/tailnet/example.com/devices?fields=all' && $request->hasHeader('Authorization','Basic '.base64_encode('tok:'))); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://tailscale.example.test/api/v2/tailnet/example.com/keys' && $request['description']==='CI key'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new TailscaleService('tok'); $list=(new TailscaleListTailnetDevices($service))->execute(['tailnet'=>'-','fields'=>'all']); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.tailscale.com/api/v2/tailnet/-/devices?fields=all'); $missingPath=(new TailscaleGetDevice($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('device_id must be',(string)$missingPath->error); $created=(new TailscaleCreateKey($service))->execute(['tailnet'=>'-','body'=>['description'=>'CI key']]); self::assertTrue($created->succeeded()); }
}