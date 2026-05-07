<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Kubernetes;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Kubernetes\KubernetesService;
use OpenCompany\Integrations\Kubernetes\KubernetesToolProvider;
use OpenCompany\Integrations\Kubernetes\Tools\KubernetesCreateCoreV1NamespacedPod;
use OpenCompany\Integrations\Kubernetes\Tools\KubernetesListCoreV1NamespacedPod;
use OpenCompany\Integrations\Kubernetes\Tools\KubernetesReadCoreV1NamespacedPod;
use PHPUnit\Framework\TestCase;

final class KubernetesServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_openapi_manifest_and_docs(): void { $provider=new KubernetesToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/kubernetes/kubernetes-openapi-manifest.json'),true); self::assertSame(1111,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Kubernetes',$provider->integrationMeta()['name']); self::assertSame('data',$provider->integrationMeta()['category']); self::assertSame('api_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('kubernetes_list_core_v1_namespaced_pod',array_keys($provider->tools())); self::assertContains('kubernetes_create_core_v1_namespaced_pod',array_keys($provider->tools())); }
    public function test_service_maps_bearer_auth_path_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new KubernetesService('tok','https://kubernetes.example.test'); $service->request('GET','/api/v1/namespaces/{namespace}/pods/{name}',['namespace'=>'default','name'=>'web 1'],['pretty'=>'true']); $service->request('POST','/api/v1/namespaces/{namespace}/pods',['namespace'=>'default'],[],[],['metadata'=>['name'=>'web']]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://kubernetes.example.test/api/v1/namespaces/default/pods/web%201?pretty=true' && $request->hasHeader('Authorization','Bearer tok')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://kubernetes.example.test/api/v1/namespaces/default/pods' && $request['metadata']['name']==='web'); }
    public function test_tools_validate_and_map_parameters(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new KubernetesService('tok','https://kubernetes.example.test'); $list=(new KubernetesListCoreV1NamespacedPod($service))->execute(['namespace'=>'default','label_selector'=>'app=web']); self::assertTrue($list->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://kubernetes.example.test/api/v1/namespaces/default/pods?labelSelector=app%3Dweb'); $missingPath=(new KubernetesReadCoreV1NamespacedPod($service))->execute(['namespace'=>'default']); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('name must be',(string)$missingPath->error); $created=(new KubernetesCreateCoreV1NamespacedPod($service))->execute(['namespace'=>'default','body'=>['metadata'=>['name'=>'web']]]); self::assertTrue($created->succeeded()); }
}