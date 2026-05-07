<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftEntraId;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftEntraId\MicrosoftEntraIdService;
use OpenCompany\Integrations\MicrosoftEntraId\MicrosoftEntraIdToolProvider;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdApplicationsApplicationListApplication;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdGroupsGroupListGroup;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdRoleManagementDirectoryListRoleAssignments;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdUsersUserGetUser;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdUsersUserListUser;
use OpenCompany\Integrations\MicrosoftEntraId\Tools\MicrosoftEntraIdUsersUserUpdateUser;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Entra ID integration.
 */
final class MicrosoftEntraIdServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftEntraIdToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-entra-id/microsoft-entra-id-openapi-manifest.json'), true);

        self::assertSame(2906, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/users', $manifest['path_prefixes']);
        self::assertContains('/roleManagement/directory', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Entra ID', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_entra_id_users_user_list_user', array_keys($provider->tools()));
        self::assertContains('microsoft_entra_id_groups_group_list_group', array_keys($provider->tools()));
        self::assertContains('microsoft_entra_id_applications_application_list_application', array_keys($provider->tools()));
        self::assertContains('microsoft_entra_id_role_management_directory_list_role_assignments', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_directory_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftEntraIdService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/users/{user-id}', ['user-id' => 'user 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/users/{user-id}',
            ['user-id' => 'user 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['displayName' => 'Example User'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/users/user%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/users/user%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['displayName'] === 'Example User');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftEntraIdService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftEntraIdUsersUserListUser($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftEntraIdUsersUserGetUser($service))->execute(['user_id' => 'user-123', 'select' => 'id,userPrincipalName'])->succeeded());
        self::assertTrue((new MicrosoftEntraIdUsersUserUpdateUser($service))->execute(['user_id' => 'user-123', 'if_match' => 'W/"etag"', 'body' => ['displayName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftEntraIdGroupsGroupListGroup($service))->execute(['filter' => "startswith(displayName,'Ops')", 'count' => true, 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftEntraIdApplicationsApplicationListApplication($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftEntraIdRoleManagementDirectoryListRoleAssignments($service))->execute(['expand' => 'principal,roleDefinition'])->succeeded());

        $missingPath = (new MicrosoftEntraIdUsersUserGetUser($service))->execute([]);
        $badBody = (new MicrosoftEntraIdUsersUserUpdateUser($service))->execute(['user_id' => 'user-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftEntraIdUsersUserUpdateUser($service))->execute(['user_id' => 'user-123']);
        $unconfigured = (new MicrosoftEntraIdUsersUserGetUser(new MicrosoftEntraIdService('', 'https://graph.example.test/v1.0')))->execute(['user_id' => 'user-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('user_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_organization_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/organization' => Http::response(['value' => [['id' => 'tenant']]], 200)]);

        $result = (new MicrosoftEntraIdToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/organization'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftEntraIdToolProvider)->createTool(MicrosoftEntraIdUsersUserGetUser::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['user_id' => 'user-123'])->succeeded());

        self::assertSame(['microsoft-entra-id', 'microsoft-entra-id'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
