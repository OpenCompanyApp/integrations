<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleContacts;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleContacts\GoogleContactsService;
use OpenCompany\Integrations\GoogleContacts\GoogleContactsToolProvider;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsPeopleGet;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsPeopleConnectionsList;
use OpenCompany\Integrations\GoogleContacts\Tools\GoogleContactsPeopleCreateContact;
use PHPUnit\Framework\TestCase;

final class GoogleContactsServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); parent::tearDown(); }
    public function test_provider_matches_discovery_manifest_and_docs(): void { $provider=new GoogleContactsToolProvider; $manifest=json_decode((string)file_get_contents(__DIR__.'/../../packages/google-contacts/google-contacts-discovery-manifest.json'),true); self::assertSame(24,$manifest['method_count']); self::assertCount($manifest['method_count'],$provider->tools()); self::assertSame('Google Contacts',$provider->integrationMeta()['name']); self::assertSame('productivity',$provider->integrationMeta()['category']); self::assertSame('oauth2_manual_token',$provider->integrationCapabilities()['auth']['strategy']); self::assertFileExists((string)$provider->luaDocsPath()); self::assertContains('google_contacts_people_connections_list',array_keys($provider->tools())); self::assertContains('google_contacts_contact_groups_members_modify',array_keys($provider->tools())); }
    public function test_service_maps_reserved_paths_query_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleContactsService('token-test','https://example.test'); $service->request('GET','/v1/{+resourceName}/connections',['resourceName'=>'people/me'],['resourceName'],['personFields'=>'names']); $service->request('POST','/v1/people:createContact',[],[],[],['names'=>[['givenName'=>'Ada']]]); Http::assertSent(static fn(Request $request): bool => $request->method()==='GET' && $request->url()==='https://example.test/v1/people/me/connections?personFields=names' && $request->hasHeader('Authorization','Bearer token-test')); Http::assertSent(static fn(Request $request): bool => $request->method()==='POST' && $request->url()==='https://example.test/v1/people:createContact' && $request['names'][0]['givenName']==='Ada'); }
    public function test_tools_filter_query_require_path_params_and_body(): void { Http::fake(['*'=>Http::response(['ok'=>true],200)]); $service=new GoogleContactsService('token-test'); $connections=new GoogleContactsPeopleConnectionsList($service); $result=$connections->execute(['resourceName'=>'people/me','personFields'=>'names,emailAddresses','unknown'=>'ignored']); self::assertTrue($result->succeeded()); Http::assertSent(static fn(Request $request): bool => $request->url()==='https://people.googleapis.com/v1/people/me/connections?personFields=names%2CemailAddresses'); $missingPath=(new GoogleContactsPeopleGet($service))->execute([]); self::assertFalse($missingPath->succeeded()); self::assertStringContainsString('resourceName must be',(string)$missingPath->error); $missingBody=(new GoogleContactsPeopleCreateContact($service))->execute([]); self::assertFalse($missingBody->succeeded()); self::assertStringContainsString('body must be',(string)$missingBody->error); }
}
