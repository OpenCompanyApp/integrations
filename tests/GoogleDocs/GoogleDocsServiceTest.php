<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleDocs;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleDocs\GoogleDocsService;
use OpenCompany\Integrations\GoogleDocs\GoogleDocsToolProvider;
use OpenCompany\Integrations\GoogleDocs\Tools\GoogleDocsDocumentsGet;
use OpenCompany\Integrations\GoogleDocs\Tools\GoogleDocsDocumentsBatchUpdate;
use PHPUnit\Framework\TestCase;

final class GoogleDocsServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleDocsToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-docs/google-docs-discovery-manifest.json'),true); self::assertSame(3,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Docs',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->scriptDocsPath()); self::assertContains('google_docs_documents_batch_update',array_keys($provider->tools())); self::assertContains('google_docs_documents_create',array_keys($provider->tools())); }
    public function test_service_maps_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleDocsService('token-test','https://example.test'); $service->request('GET','/v1/documents/{documentId}',['documentId'=>'doc 1'],[],['includeTabsContent'=>true]); $service->request('POST','/v1/documents/{documentId}:batchUpdate',['documentId'=>'doc 1'],[],[],['requests'=>[]]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v1/documents/doc%201?includeTabsContent=1' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v1/documents/doc%201:batchUpdate' && is_array($request['requests'])); }
    public function test_tools_require_path_params_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleDocsService('token-test'); $get=new GoogleDocsDocumentsGet($service); $result=$get->execute(['documentId'=>'doc-1','includeTabsContent'=>true]); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://docs.googleapis.com/v1/documents/doc-1?includeTabsContent=1'); $missingPath=(new GoogleDocsDocumentsGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('documentId must be',(string)$missingPath->error); $missingBody=(new GoogleDocsDocumentsBatchUpdate($service))->execute(['documentId'=>'doc-1']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); }
}
