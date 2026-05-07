<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Temporal;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Temporal\TemporalService;
use OpenCompany\Integrations\Temporal\TemporalToolProvider;
use OpenCompany\Integrations\Temporal\Tools\TemporalDescribeWorkflowExecution;
use OpenCompany\Integrations\Temporal\Tools\TemporalListNamespaces;
use OpenCompany\Integrations\Temporal\Tools\TemporalListWorkflowExecutions;
use OpenCompany\Integrations\Temporal\Tools\TemporalStartWorkflowExecution;
use PHPUnit\Framework\TestCase;

final class TemporalServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new TemporalToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/temporal/temporal-openapi-manifest.json'),true); self::assertSame(224,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Temporal',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('temporal_list_namespaces',array_keys($provider->tools())); self::assertContains('temporal_start_workflow_execution',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new TemporalService('tok','https://temporal.example.test'); $service->request('GET','/api/v1/namespaces/{namespace}/workflows/{execution.workflow_id}',['namespace'=>'default','execution.workflow_id'=>'wf 1'],['wait_new_event'=>true]); $service->request('POST','/api/v1/namespaces/{namespace}/workflows/{workflowId}',['namespace'=>'default','workflowId'=>'wf-1'],[],[],['workflowType'=>['name'=>'OrderWorkflow']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://temporal.example.test/api/v1/namespaces/default/workflows/wf%201?wait_new_event=true' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://temporal.example.test/api/v1/namespaces/default/workflows/wf-1' && $request['workflowType']['name']==='OrderWorkflow'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new TemporalService('tok','https://temporal.example.test'); $namespaces=(new TemporalListNamespaces($service))->execute([]); self::assertTrue($namespaces->succeeded()); $list=(new TemporalListWorkflowExecutions($service))->execute(['namespace'=>'default','query'=>'WorkflowType = "OrderWorkflow"']); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://temporal.example.test/api/v1/namespaces'); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://temporal.example.test/api/v1/namespaces/default/workflows?query=WorkflowType%20%3D%20%22OrderWorkflow%22'); $missingPath=(new TemporalDescribeWorkflowExecution($service))->execute(['namespace'=>'default']); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('execution_workflow_id must be',(string)$missingPath->error); $started=(new TemporalStartWorkflowExecution($service))->execute(['namespace'=>'default','workflow_id'=>'wf-1','body'=>['workflowType'=>['name'=>'OrderWorkflow']]]); self::assertTrue($started->succeeded()); }
}
