<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cloudsmith;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Cloudsmith\CloudsmithService;
use OpenCompany\Integrations\Cloudsmith\CloudsmithToolProvider;
use OpenCompany\Integrations\Cloudsmith\Tools\CloudsmithPackagesList;
use OpenCompany\Integrations\Cloudsmith\Tools\CloudsmithPackagesRead;
use OpenCompany\Integrations\Cloudsmith\Tools\CloudsmithPackagesUploadPython;
use OpenCompany\Integrations\Cloudsmith\Tools\CloudsmithUserSelf;
use PHPUnit\Framework\TestCase;

final class CloudsmithServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new CloudsmithToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/cloudsmith/cloudsmith-openapi-manifest.json'),true); self::assertSame(349,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Cloudsmith',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('cloudsmith_user_self',array_keys($provider->tools())); self::assertContains('cloudsmith_packages_upload_python',array_keys($provider->tools())); }
    public function test_service_maps_token_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new CloudsmithService('tok','https://cloudsmith.example.test'); $service->request('GET','/packages/{owner}/{repo}/{identifier}/',['owner'=>'acme','repo'=>'repo','identifier'=>'pkg 1'],['page'=>1]); $service->request('POST','/packages/{owner}/{repo}/upload/python/',['owner'=>'acme','repo'=>'repo'],[],[],['name'=>'dist.whl']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://cloudsmith.example.test/packages/acme/repo/pkg%201/?page=1' && $request->hasHeader('Authorization','token tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://cloudsmith.example.test/packages/acme/repo/upload/python/' && $request['name']==='dist.whl'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new CloudsmithService('tok'); $me=(new CloudsmithUserSelf($service))->execute([]); self::assertTrue($me->succeeded()); $list=(new CloudsmithPackagesList($service))->execute(['owner'=>'acme','repo'=>'repo','page'=>1]); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.cloudsmith.io/user/self/'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.cloudsmith.io/packages/acme/repo/?page=1'); $missingPath=(new CloudsmithPackagesRead($service))->execute(['owner'=>'acme','repo'=>'repo']); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('identifier must be',(string)$missingPath->error); $created=(new CloudsmithPackagesUploadPython($service))->execute(['owner'=>'acme','repo'=>'repo','body'=>['name'=>'dist.whl']]); self::assertTrue($created->succeeded()); }
}
