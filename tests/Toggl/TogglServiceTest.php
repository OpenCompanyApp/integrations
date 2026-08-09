<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Toggl;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Toggl\TogglService;
use OpenCompany\Integrations\Toggl\TogglToolProvider;
use OpenCompany\Integrations\Toggl\Tools\TogglCreateProject;
use OpenCompany\Integrations\Toggl\Tools\TogglDeleteTimeEntry;
use OpenCompany\Integrations\Toggl\Tools\TogglListWorkspaces;
use OpenCompany\Integrations\Toggl\Tools\TogglUpdateTimeEntry;
use OpenCompany\Integrations\TogglTrack\TogglTrackToolProvider as LegacyTogglTrackToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Toggl Track API integration and legacy alias.
 */
final class TogglServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_exposes_canonical_tools_metadata_and_docs(): void
    {
        $provider = new TogglToolProvider;
        $tools = $provider->tools();

        self::assertSame('toggl', $provider->appName());
        self::assertSame('Toggl', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.track.toggl.com/docs/', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertArrayHasKey('toggl_create_project', $tools);
        self::assertArrayHasKey('toggl_update_time_entry', $tools);
        self::assertArrayHasKey('toggl_delete_time_entry', $tools);
        self::assertCount(10, $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'] . ' should exist.');
        }
    }

    public function test_service_maps_project_time_entry_and_base_url_requests(): void
    {
        Http::fake([
            'https://toggl.example.test/api/v9/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new TogglService('toggl-test-token', 'https://toggl.example.test');

        $service->getCurrentUser();
        $service->listWorkspaces();
        $service->createProject('123', ['name' => 'Agent Work']);
        $service->updateTimeEntry('123', 456, ['description' => 'Updated']);
        $service->deleteTimeEntry('123', 456);

        $auth = 'Basic ' . base64_encode('toggl-test-token:api_token');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', $auth));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://toggl.example.test/api/v9/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://toggl.example.test/api/v9/me/workspaces');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://toggl.example.test/api/v9/workspaces/123/projects'
            && $request['name'] === 'Agent Work');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://toggl.example.test/api/v9/workspaces/123/time_entries/456'
            && $request['description'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://toggl.example.test/api/v9/workspaces/123/time_entries/456');
    }

    public function test_tools_validate_project_and_time_entry_mutation_arguments(): void
    {
        Http::fake([
            'https://api.track.toggl.com/api/v9/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new TogglService('toggl-test-token');

        self::assertTrue((new TogglCreateProject($service))->execute([
            'workspace_id' => 123,
            'name' => 'Agent Work',
        ])->succeeded());
        self::assertFalse((new TogglCreateProject($service))->execute(['workspace_id' => 123])->succeeded());

        self::assertTrue((new TogglUpdateTimeEntry($service))->execute([
            'workspace_id' => 123,
            'time_entry_id' => 456,
            'description' => 'Updated',
        ])->succeeded());
        self::assertFalse((new TogglUpdateTimeEntry($service))->execute([
            'workspace_id' => 123,
            'time_entry_id' => 456,
        ])->succeeded());

        self::assertTrue((new TogglDeleteTimeEntry($service))->execute([
            'workspace_id' => 123,
            'time_entry_id' => 456,
        ])->succeeded());
    }

    public function test_legacy_toggl_track_package_aliases_canonical_provider_and_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/toggl/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/toggl-track/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-toggl-track']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-toggl-track']);
        self::assertSame('opencompanyapp/integration-toggl', $legacyComposer['abandoned']);

        $legacyProvider = new LegacyTogglTrackToolProvider;

        self::assertSame('toggl', $legacyProvider->appName());
        self::assertSame('Toggl', $legacyProvider->integrationMeta()['name']);
        self::assertArrayHasKey('toggl_create_project', $legacyProvider->tools());

        Http::fake([
            'https://legacy.toggl.example.test/api/v9/me/workspaces' => Http::response([], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'toggl') {
                    return '';
                }

                if ($integration === 'toggl-track' && $account === 'work') {
                    return match ($key) {
                        'api_token' => 'legacy-toggl-token',
                        'url' => 'https://legacy.toggl.example.test',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'toggl-track' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'toggl-track' ? ['work'] : [];
            }
        });

        $tool = (new TogglToolProvider)->createTool(TogglListWorkspaces::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy.toggl.example.test/api/v9/me/workspaces'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('legacy-toggl-token:api_token')));
    }
}
