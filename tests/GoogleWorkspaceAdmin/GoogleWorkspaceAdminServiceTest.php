<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleWorkspaceAdmin;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleWorkspaceAdmin\GoogleWorkspaceAdminService;
use OpenCompany\Integrations\GoogleWorkspaceAdmin\GoogleWorkspaceAdminToolProvider;
use OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools\GoogleWorkspaceAdminGroupsInsert;
use OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools\GoogleWorkspaceAdminUsersAliasesList;
use OpenCompany\Integrations\GoogleWorkspaceAdmin\Tools\GoogleWorkspaceAdminUsersList;
use PHPUnit\Framework\TestCase;

final class GoogleWorkspaceAdminServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleWorkspaceAdminToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-workspace-admin/google-workspace-admin-discovery-manifest.json'), true);

        self::assertSame(128, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Workspace Admin', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-workspace-admin/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_workspace_admin_users_list', $manifestTools);
        self::assertContains('google_workspace_admin_groups_insert', $manifestTools);
        self::assertContains('google_workspace_admin_role_assignments_insert', $manifestTools);
        self::assertContains('google_workspace_admin_chromeosdevices_list', $manifestTools);
    }

    public function test_service_maps_auth_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleWorkspaceAdminService('token-test', 'https://example.test');
        $service->request('GET', '/admin/directory/v1/users/{userKey}/aliases', ['userKey' => 'person@example.test'], [], ['event' => 'add']);
        $service->request('POST', '/admin/directory/v1/groups', [], [], [], ['email' => 'agents@example.test', 'name' => 'Agents']);
        $service->request('DELETE', '/admin/directory/v1/users/{userKey}/tokens/{clientId}', ['userKey' => 'person@example.test', 'clientId' => 'client-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/admin/directory/v1/users/person%40example.test/aliases?event=add'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/admin/directory/v1/groups'
            && $request['email'] === 'agents@example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://example.test/admin/directory/v1/users/person%40example.test/tokens/client-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleWorkspaceAdminService('token-test');

        $list = new GoogleWorkspaceAdminUsersList($service);
        $result = $list->execute(['customer' => 'my_customer', 'maxResults' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://admin.googleapis.com/admin/directory/v1/users?customer=my_customer&maxResults=10');

        $missingPath = (new GoogleWorkspaceAdminUsersAliasesList($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('userKey must be', (string) $missingPath->error);

        $missingBody = (new GoogleWorkspaceAdminGroupsInsert($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}
