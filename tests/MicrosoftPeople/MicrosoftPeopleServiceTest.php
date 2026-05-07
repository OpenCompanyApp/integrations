<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftPeople;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftPeople\MicrosoftPeopleService;
use OpenCompany\Integrations\MicrosoftPeople\MicrosoftPeopleToolProvider;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleAdminPeopleGetProfileCardProperties;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleAdminPeopleListProfileCardProperties;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleAdminPeopleUpdateProfileCardProperties;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleMeGetPeople;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleMeListPeople;
use OpenCompany\Integrations\MicrosoftPeople\Tools\MicrosoftPeopleUsersListPeople;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft People integration.
 */
final class MicrosoftPeopleServiceTest extends TestCase
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
        $provider = new MicrosoftPeopleToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-people/microsoft-people-openapi-manifest.json'), true);

        self::assertSame(33, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/me/people', $manifest['path_prefixes']);
        self::assertContains('/admin/people', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft People', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_people_me_list_people', array_keys($provider->tools()));
        self::assertContains('microsoft_people_me_get_people', array_keys($provider->tools()));
        self::assertContains('microsoft_people_users_list_people', array_keys($provider->tools()));
        self::assertContains('microsoft_people_admin_people_list_profile_card_properties', array_keys($provider->tools()));
        self::assertContains('microsoft_people_admin_people_update_profile_card_properties', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_people_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPeopleService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/me/people/{person-id}', ['person-id' => 'person 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/admin/people/profileCardProperties/{profileCardProperty-id}',
            ['profileCardProperty-id' => 'CustomAttribute1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['annotations' => [['displayName' => 'Cost center']]],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/people/person%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/admin/people/profileCardProperties/CustomAttribute1'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['annotations'][0]['displayName'] === 'Cost center');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPeopleService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftPeopleMeListPeople($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftPeopleMeGetPeople($service))->execute(['person_id' => 'person-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftPeopleUsersListPeople($service))->execute(['user_id' => 'user-123', 'search' => 'Ada'])->succeeded());
        self::assertTrue((new MicrosoftPeopleAdminPeopleListProfileCardProperties($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftPeopleAdminPeopleGetProfileCardProperties($service))->execute(['profile_card_property_id' => 'CustomAttribute1'])->succeeded());
        self::assertTrue((new MicrosoftPeopleAdminPeopleUpdateProfileCardProperties($service))->execute(['profile_card_property_id' => 'CustomAttribute1', 'if_match' => 'W/"etag"', 'body' => ['annotations' => []]])->succeeded());

        $missingPath = (new MicrosoftPeopleMeGetPeople($service))->execute([]);
        $badBody = (new MicrosoftPeopleAdminPeopleUpdateProfileCardProperties($service))->execute(['profile_card_property_id' => 'CustomAttribute1', 'body' => 'not-object']);
        $missingBody = (new MicrosoftPeopleAdminPeopleUpdateProfileCardProperties($service))->execute(['profile_card_property_id' => 'CustomAttribute1']);
        $unconfigured = (new MicrosoftPeopleMeGetPeople(new MicrosoftPeopleService('', 'https://graph.example.test/v1.0')))->execute(['person_id' => 'person-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('person_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_me_people_probe(): void
    {
        Http::fake(['*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftPeopleToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/people?$top=1'
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
        $tool = (new MicrosoftPeopleToolProvider)->createTool(MicrosoftPeopleMeGetPeople::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['person_id' => 'person-123'])->succeeded());

        self::assertSame(['microsoft-people', 'microsoft-people'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
