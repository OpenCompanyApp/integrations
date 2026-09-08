<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftIntune;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftIntune\MicrosoftIntuneService;
use OpenCompany\Integrations\MicrosoftIntune\MicrosoftIntuneToolProvider;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneDeviceAppManagementListMobileApps;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneDeviceManagementGetManagedDevices;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneDeviceManagementListDeviceConfigurations;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneDeviceManagementListManagedDevices;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneDeviceManagementUpdateManagedDevices;
use OpenCompany\Integrations\MicrosoftIntune\Tools\MicrosoftIntuneUsersListManagedDevices;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Intune integration.
 */
final class MicrosoftIntuneServiceTest extends TestCase
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
        $provider = new MicrosoftIntuneToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-intune/microsoft-intune-openapi-manifest.json'), true);

        self::assertSame(1470, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/deviceManagement', $manifest['path_prefixes']);
        self::assertContains('/deviceAppManagement', $manifest['path_prefixes']);
        self::assertContains('/manageddevices', $manifest['user_me_markers']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Intune', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_intune_device_management_list_managed_devices', array_keys($provider->tools()));
        self::assertContains('microsoft_intune_device_management_get_managed_devices', array_keys($provider->tools()));
        self::assertContains('microsoft_intune_device_app_management_list_mobile_apps', array_keys($provider->tools()));
        self::assertContains('microsoft_intune_device_management_list_device_configurations', array_keys($provider->tools()));
        self::assertContains('microsoft_intune_users_list_managed_devices', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_intune_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftIntuneService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/deviceManagement/managedDevices/{managedDevice-id}', ['managedDevice-id' => 'device 1'], ['$select' => 'id,deviceName']);
        $service->request(
            'PATCH',
            '/deviceManagement/managedDevices/{managedDevice-id}',
            ['managedDevice-id' => 'device 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['deviceName' => 'Example Device'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/deviceManagement/managedDevices/device%201?%24select=id%2CdeviceName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/deviceManagement/managedDevices/device%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['deviceName'] === 'Example Device');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftIntuneService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftIntuneDeviceManagementListManagedDevices($service))->execute(['top' => 5, 'select' => 'id,deviceName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftIntuneDeviceManagementGetManagedDevices($service))->execute(['managed_device_id' => 'device-123', 'select' => 'id,deviceName'])->succeeded());
        self::assertTrue((new MicrosoftIntuneDeviceManagementUpdateManagedDevices($service))->execute(['managed_device_id' => 'device-123', 'if_match' => 'W/"etag"', 'body' => ['deviceName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftIntuneDeviceAppManagementListMobileApps($service))->execute(['filter' => "startswith(displayName,'Office')", 'count' => true, 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftIntuneDeviceManagementListDeviceConfigurations($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftIntuneUsersListManagedDevices($service))->execute(['user_id' => 'user-123', 'select' => 'id,deviceName'])->succeeded());

        $missingPath = (new MicrosoftIntuneDeviceManagementGetManagedDevices($service))->execute([]);
        $badBody = (new MicrosoftIntuneDeviceManagementUpdateManagedDevices($service))->execute(['managed_device_id' => 'device-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftIntuneDeviceManagementUpdateManagedDevices($service))->execute(['managed_device_id' => 'device-123']);
        $unconfigured = (new MicrosoftIntuneDeviceManagementGetManagedDevices(new MicrosoftIntuneService('', 'https://graph.example.test/v1.0')))->execute(['managed_device_id' => 'device-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('managed_device_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_device_management_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/deviceManagement' => Http::response(['id' => 'device-management'], 200)]);

        $result = (new MicrosoftIntuneToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/deviceManagement'
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
        $tool = (new MicrosoftIntuneToolProvider)->createTool(MicrosoftIntuneDeviceManagementGetManagedDevices::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['managed_device_id' => 'device-123'])->succeeded());

        self::assertSame(['microsoft-intune', 'microsoft-intune'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
