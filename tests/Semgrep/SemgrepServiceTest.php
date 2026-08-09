<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Semgrep;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Semgrep\SemgrepService;
use OpenCompany\Integrations\Semgrep\SemgrepToolProvider;
use OpenCompany\Integrations\Semgrep\Tools\SemgrepFindingsServiceListFindings;
use OpenCompany\Integrations\Semgrep\Tools\SemgrepMiscServicePing;
use OpenCompany\Integrations\Semgrep\Tools\SemgrepPoliciesServiceUpdatePolicy;
use PHPUnit\Framework\TestCase;

final class SemgrepServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new SemgrepToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/semgrep/semgrep-openapi-manifest.json'),true); self::assertSame(27,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Semgrep',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('semgrep_misc_service_ping',array_keys($provider->tools())); self::assertContains('semgrep_findings_service_list_findings',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new SemgrepService('tok','https://semgrep.example.test'); $service->request('GET','/api/v1/deployments/{deploymentSlug}/findings',['deploymentSlug'=>'acme deployment'],['limit'=>10]); $service->request('PUT','/api/v1/deployments/{deploymentId}/policies/{policyId}',['deploymentId'=>'dep-1','policyId'=>'pol-1'],[],[],['enabled'=>true]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://semgrep.example.test/api/v1/deployments/acme%20deployment/findings?limit=10' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='PUT' && $request->url()==='https://semgrep.example.test/api/v1/deployments/dep-1/policies/pol-1' && $request['enabled']===true); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new SemgrepService('tok'); $ping=(new SemgrepMiscServicePing($service))->execute([]); self::assertTrue($ping->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://semgrep.dev/api/v1/ping'); $missingPath=(new SemgrepFindingsServiceListFindings($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('deployment_slug must be',(string)$missingPath->error); $updated=(new SemgrepPoliciesServiceUpdatePolicy($service))->execute(['deployment_id'=>'dep-1','policy_id'=>'pol-1','body'=>['enabled'=>true]]); self::assertTrue($updated->succeeded()); }
}