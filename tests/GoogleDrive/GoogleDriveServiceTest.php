<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleDrive;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;
use OpenCompany\Integrations\GoogleDrive\GoogleDriveToolProvider;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveFilesCreate;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveFilesGet;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDriveFilesList;
use OpenCompany\Integrations\GoogleDrive\Tools\GoogleDrivePermissionsCreate;
use PHPUnit\Framework\TestCase;

final class GoogleDriveServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleDriveToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-drive/google-drive-discovery-manifest.json'),true); self::assertSame(64,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Drive',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_drive_files_create',array_keys($provider->tools())); self::assertContains('google_drive_permissions_create',array_keys($provider->tools())); }
    public function test_service_maps_auth_paths_query_body_and_uploads(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleDriveService('token-test','https://example.test'); $service->request('GET','/drive/v3/files/{fileId}',['fileId'=>'file 1'],[],['fields'=>'id,name']); $service->request('POST','/drive/v3/files/{fileId}/permissions',['fileId'=>'file 1'],[],['sendNotificationEmail'=>false],['type'=>'user','role'=>'reader']); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/drive/v3/files/file%201?fields=id%2Cname' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/drive/v3/files/file%201/permissions?sendNotificationEmail=0' && $request['role']==='reader'); }
    public function test_tools_filter_query_require_path_body_and_upload_files(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleDriveService('token-test'); $list=new GoogleDriveFilesList($service); $result=$list->execute(['pageSize'=>10,'q'=>'trashed = false','unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://www.googleapis.com/drive/v3/files?pageSize=10&q=trashed%20%3D%20false'); $missingPath=(new GoogleDriveFilesGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('fileId must be',(string)$missingPath->error); $missingBody=(new GoogleDrivePermissionsCreate($service))->execute(['fileId'=>'file-1']); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); $file=tempnam(sys_get_temp_dir(),'drive-upload-'); file_put_contents((string)$file,'drive-data'); try{$upload=(new GoogleDriveFilesCreate($service))->execute(['file_path'=>(string)$file,'mime_type'=>'text/plain','body'=>['name'=>'demo.txt']]); self::assertTrue($upload->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://www.googleapis.com/upload/drive/v3/files?uploadType=multipart' && str_starts_with((string)$request->header('Content-Type')[0],'multipart/related; boundary=') && str_contains((string)$request->body(),'demo.txt') && str_contains((string)$request->body(),'drive-data')); } finally { if(is_string($file)&&file_exists($file)) unlink($file); } }
}
