<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleForms;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleForms\GoogleFormsService;
use OpenCompany\Integrations\GoogleForms\GoogleFormsToolProvider;
use OpenCompany\Integrations\GoogleForms\Tools\GoogleFormsFormsGet;
use OpenCompany\Integrations\GoogleForms\Tools\GoogleFormsFormsResponsesList;
use OpenCompany\Integrations\GoogleForms\Tools\GoogleFormsFormsBatchUpdate;
use PHPUnit\Framework\TestCase;

final class GoogleFormsServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider=new GoogleFormsToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-forms/google-forms-discovery-manifest.json'),true);
        self::assertSame(10,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Forms',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_forms_forms_batch_update',array_keys($provider->tools())); self::assertContains('google_forms_forms_watches_create',array_keys($provider->tools()));
    }
    public function test_service_maps_paths_query_and_body(): void
    {
        Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleFormsService('token-test','https://example.test'); $service->request('GET','/v1/forms/{formId}/responses',['formId'=>'form 1'],[],['pageSize'=>5]); $service->request('POST','/v1/forms/{formId}:batchUpdate',['formId'=>'form 1'],[],[],['requests'=>[]]);
        Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v1/forms/form%201/responses?pageSize=5' && $request->hasHeader('Authorization','Bearer token-test'));
        Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v1/forms/form%201:batchUpdate' && is_array($request['requests']));
    }
    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleFormsService('token-test'); $list=new GoogleFormsFormsResponsesList($service); $result=$list->execute(['formId'=>'form-1','pageSize'=>10,'unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://forms.googleapis.com/v1/forms/form-1/responses?pageSize=10'); $missingPath=(new GoogleFormsFormsGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('formId must be',(string)$missingPath->error); $missingBody=(new GoogleFormsFormsBatchUpdate($service))->execute(['formId'=>'form-1']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error);
    }
}
