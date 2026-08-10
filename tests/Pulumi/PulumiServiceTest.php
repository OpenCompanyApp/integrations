<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Pulumi;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Pulumi\PulumiService;
use OpenCompany\Integrations\Pulumi\PulumiToolProvider;
use OpenCompany\Integrations\Pulumi\Tools\PulumiMiscellaneousCapabilities;
use OpenCompany\Integrations\Pulumi\Tools\PulumiOrganizationsCreateGate;
use OpenCompany\Integrations\Pulumi\Tools\PulumiOrganizationsReadGate;
use PHPUnit\Framework\TestCase;

final class PulumiServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new PulumiToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/pulumi/pulumi-openapi-manifest.json'),true); self::assertSame(581,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Pulumi',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('pulumi_miscellaneous_capabilities',array_keys($provider->tools())); self::assertContains('pulumi_organizations_read_gate',array_keys($provider->tools())); }
    public function test_service_maps_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new PulumiService('tok','https://pulumi.example.test'); $service->request('GET','/api/change-gates/{orgName}/{gateID}',['orgName'=>'acme org','gateID'=>'gate 1'],['limit'=>10]); $service->request('POST','/api/change-gates/{orgName}',['orgName'=>'acme'],[],[],['name'=>'Gate']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://pulumi.example.test/api/change-gates/acme%20org/gate%201?limit=10' && $request->hasHeader('Authorization','token tok') && $request->hasHeader('Accept','application/vnd.pulumi+8')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://pulumi.example.test/api/change-gates/acme' && $request['name']==='Gate'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new PulumiService('tok'); $caps=(new PulumiMiscellaneousCapabilities($service))->execute([]); self::assertTrue($caps->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.pulumi.com/api/capabilities'); $missingPath=(new PulumiOrganizationsReadGate($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('org_name must be',(string)$missingPath->error); $created=(new PulumiOrganizationsCreateGate($service))->execute(['org_name'=>'acme','body'=>['name'=>'Gate']]); self::assertTrue($created->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://api.pulumi.com/api/change-gates/acme' && $request['name']==='Gate'); }
}