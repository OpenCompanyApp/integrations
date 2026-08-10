<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bitrise;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Bitrise\BitriseService;
use OpenCompany\Integrations\Bitrise\BitriseToolProvider;
use OpenCompany\Integrations\Bitrise\Tools\BitriseApiGet;
use OpenCompany\Integrations\Bitrise\Tools\BitriseGetBuildLog;
use OpenCompany\Integrations\Bitrise\Tools\BitriseListAppBuilds;
use OpenCompany\Integrations\Bitrise\Tools\BitriseTriggerBuild;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Bitrise API v0.1 integration.
 */
final class BitriseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BitriseService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BitriseService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new BitriseToolProvider();

        self::assertSame('bitrise', $provider->appName());
        self::assertSame('Bitrise', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(49, $provider->tools());
        self::assertArrayHasKey('bitrise_trigger_build', $provider->tools());
        self::assertArrayHasKey('bitrise_list_artifacts', $provider->tools());
        self::assertArrayHasKey('bitrise_put_secret', $provider->tools());
        self::assertArrayHasKey('bitrise_api_get', $provider->tools());
    }

    public function test_service_maps_documented_bitrise_api_endpoints(): void
    {
        Http::fake([
            'https://api.bitrise.test/v0.1/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new BitriseService('bitrise-token', 'https://api.bitrise.test/v0.1');
        $service->listApps(['limit' => 20]);
        $service->registerApp(['provider' => 'github', 'repo_url' => 'git@example.test:acme/web.git']);
        $service->getApp('app-slug');
        $service->updateApp('app-slug', ['title' => 'Mobile App']);
        $service->deleteApp('app-slug');
        $service->getBitriseYml('app-slug');
        $service->uploadBitriseYml('app-slug', ['app_config_datastore_yaml' => ['format_version' => 11]]);
        $service->getBitriseYmlConfig('app-slug');
        $service->updateBitriseYmlConfig('app-slug', ['location' => 'bitrise.io']);
        $service->listBranches('app-slug', ['limit' => 5]);
        $service->registerSshKey('app-slug', ['is_register_key_into_provider_service' => false]);
        $service->finishApp('app-slug', ['project_type' => 'ios', 'mode' => 'manual']);
        $service->listOrganizationApps('org-slug', ['limit' => 10]);
        $service->listUserApps('user-slug', ['limit' => 10]);
        $service->getRoleGroups('app-slug', 'admin');
        $service->setRoleGroups('app-slug', 'admin', ['groups' => ['group-one']]);
        $service->updateEmailNotifications('app-slug', ['on_failure' => 'change']);
        $service->migrateUserAppMachineTypes('user-slug', ['from_machine' => 'g2-m1.4core', 'to_machine' => 'g2-m1.8core']);
        $service->migrateOrganizationAppMachineTypes('org-slug', ['from_machine' => 'g2.mac.4large', 'to_machine' => 'g2.mac.4x-large']);
        $service->triggerBuild('app-slug', ['hook_info' => ['type' => 'bitrise'], 'build_params' => ['branch' => 'main', 'workflow_id' => 'primary']]);
        $service->abortBuild('app-slug', 'build-slug', ['abort_reason' => 'duplicate']);
        $service->listAppBuilds('app-slug', ['branch' => 'main', 'workflow' => 'primary']);
        $service->listArchivedBuilds('app-slug', ['limit' => 1]);
        $service->listBuildWorkflows('app-slug');
        $service->getBuild('app-slug', 'build-slug');
        $service->getBuildBitriseYml('app-slug', 'build-slug');
        $service->getBuildLog('app-slug', 'build-slug');
        $service->listBuilds(['limit' => 10]);
        $service->registerWebhook('app-slug');
        $service->listOutgoingWebhooks('app-slug');
        $service->createOutgoingWebhook('app-slug', ['url' => 'https://example.test/webhook']);
        $service->updateOutgoingWebhook('app-slug', 'webhook-slug', ['events' => ['build_failed']]);
        $service->deleteOutgoingWebhook('app-slug', 'webhook-slug');
        $service->listArtifacts('app-slug', 'build-slug', ['limit' => 5]);
        $service->getArtifact('app-slug', 'build-slug', 'artifact-slug');
        $service->updateArtifact('app-slug', 'build-slug', 'artifact-slug', ['is_public_page_enabled' => false]);
        $service->deleteArtifact('app-slug', 'build-slug', 'artifact-slug');
        $service->listSecrets('app-slug');
        $service->getSecretValue('app-slug', 'DEPLOY_TOKEN');
        $service->putSecret('app-slug', 'DEPLOY_TOKEN', ['value' => 'dummy', 'is_protected' => true]);
        $service->deleteSecret('app-slug', 'DEPLOY_TOKEN');
        $service->listAndroidKeystoreFiles('app-slug', ['limit' => 5]);
        $service->createAndroidKeystoreFile('app-slug', ['upload_file_name' => 'release.keystore']);
        $service->deleteAndroidKeystoreFile('app-slug', 'file-slug');
        $service->apiGet('/apps', ['limit' => 1]);
        $service->apiPost('/apps/app-slug/builds', ['hook_info' => ['type' => 'bitrise']]);
        $service->apiPut('/apps/app-slug/secrets/DEPLOY_TOKEN', ['value' => 'dummy']);
        $service->apiPatch('/apps/app-slug', ['title' => 'Updated']);
        $service->apiDelete('/apps/app-slug/builds/build-slug/artifacts/artifact-slug', ['hard' => true]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'bitrise-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/apps?limit=20');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bitrise.test/v0.1/apps/register' && $request->data()['provider'] === 'github');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug' && $request->data()['title'] === 'Mobile App');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/bitrise.yml/config' && $request->data()['location'] === 'bitrise.io');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/organizations/org-slug/apps?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/roles/admin' && $request->data()['groups'][0] === 'group-one');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.bitrise.test/v0.1/user/user-slug/apps/machine_types');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds' && ($request->data()['build_params']['workflow_id'] ?? null) === 'primary');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds/build-slug/abort' && $request->data()['abort_reason'] === 'duplicate');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds?branch=main&workflow=primary');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds/build-slug/log');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/builds?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/outgoing-webhooks/webhook-slug' && $request->data()['events'][0] === 'build_failed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds/build-slug/artifacts?limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/secrets/DEPLOY_TOKEN' && $request->data()['value'] === 'dummy');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/android-keystore-files' && $request->data()['upload_file_name'] === 'release.keystore');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.bitrise.test/v0.1/apps/app-slug/builds/build-slug/artifacts/artifact-slug?hard=1');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.bitrise.test/v0.1/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new BitriseService('bitrise-token', 'https://api.bitrise.test/v0.1');

        self::assertTrue((new BitriseTriggerBuild($service))->execute([
            'app_slug' => 'app-slug',
            'payload' => ['hook_info' => ['type' => 'bitrise'], 'build_params' => ['branch' => 'main']],
        ])->succeeded());
        self::assertTrue((new BitriseListAppBuilds($service))->execute([
            'app_slug' => 'app-slug',
            'branch' => 'main',
        ])->succeeded());
        self::assertTrue((new BitriseGetBuildLog($service))->execute([
            'app_slug' => 'app-slug',
            'build_slug' => 'build-slug',
        ])->succeeded());

        $badRaw = (new BitriseApiGet($service))->execute(['path' => 'https://evil.example.test/apps']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new BitriseApiGet(new BitriseService('', 'https://api.bitrise.test/v0.1')))->execute(['path' => '/apps']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new BitriseToolProvider();

        self::assertSame(['success' => false, 'error' => 'Bitrise API token is required.'], $provider->testConnection([]));

        Http::fake(['https://api.bitrise.io/v0.1/apps' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Bitrise API.'], $provider->testConnection([
            'api_token' => 'bitrise-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.bitrise.test/v0.1/apps?limit=1' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['bitrise', 'api_token', 'ops'] => 'account-token',
                    ['bitrise', 'url', 'ops'] => 'https://ops.bitrise.test/v0.1',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'bitrise' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'bitrise' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(BitriseApiGet::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['path' => '/apps', 'query' => ['limit' => 1]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.bitrise.test/v0.1/apps?limit=1'
            && $request->hasHeader('Authorization', 'account-token'));
    }
}
