<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\PostHog;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\PostHog\PostHogOperations;
use OpenCompany\Integrations\PostHog\PostHogService;
use OpenCompany\Integrations\PostHog\PostHogToolProvider;
use OpenCompany\Integrations\PostHog\Tools\PostHogGetEvent;
use OpenCompany\Integrations\PostHog\Tools\PostHogListEvents;
use PHPUnit\Framework\TestCase;

final class PostHogServiceTest extends TestCase
{
    protected function setUp(): void { parent::setUp(); Http::swap(new HttpFactory); }
    protected function tearDown(): void { Http::preventStrayRequests(false); Http::swap(new HttpFactory); Container::getInstance()->forgetInstance(CredentialResolver::class); parent::tearDown(); }

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new PostHogToolProvider;
        self::assertSame('posthog', $provider->appName());
        self::assertSame('PostHog', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('https://us.posthog.com/api/schema/', $provider->integrationMeta()['source_url']);
        self::assertCount(1600, PostHogOperations::all());
        self::assertCount(1601, $provider->tools());
        foreach (['posthog_capture_event', 'posthog_list_events', 'posthog_get_event', 'posthog_list_persons', 'posthog_list_feature_flags', 'posthog_create_feature_flag', 'posthog_list_insights', 'posthog_list_dashboards', 'posthog_list_cohorts'] as $slug) self::assertArrayHasKey($slug, $provider->tools());
    }

    public function test_generated_tools_map_defaults_path_query_and_bearer_header(): void
    {
        Http::fake(['https://posthog.example.test/api/environments/env_1/events/?limit=2' => Http::response(['results' => [['id' => 'event_1']]], 200), 'https://posthog.example.test/api/environments/env_1/events/event_1/' => Http::response(['id' => 'event_1'], 200)]);
        $service = new PostHogService(apiToken: 'phx_test', baseUrl: 'https://posthog.example.test', projectId: 'proj_1', environmentId: 'env_1');
        self::assertSame('event_1', $service->listEvents(['limit' => 2])['results'][0]['id']);
        $success = (new PostHogGetEvent($service))->execute(['id' => 'event_1']);
        self::assertTrue($success->succeeded());
        self::assertSame('event_1', $success->data['id']);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer phx_test'));
    }

    public function test_generated_tool_reports_missing_default_path_parameter(): void
    {
        $result = (new PostHogGetEvent(new PostHogService(apiToken: 'phx_test', baseUrl: 'https://posthog.example.test')))->execute(['id' => 'event_1']);
        self::assertFalse($result->succeeded());
        self::assertSame('The environment_id parameter is required.', $result->error);
    }

    public function test_capture_event_uses_project_api_key_without_bearer_header(): void
    {
        Http::fake(['https://posthog.example.test/capture/' => Http::response(['status' => 1], 200)]);
        $service = new PostHogService(apiToken: 'phx_test', baseUrl: 'https://posthog.example.test', projectApiKey: 'phc_project');
        self::assertSame(1, $service->captureEvent(['event' => 'purchase', 'distinct_id' => 'user_1', 'properties' => ['plan' => 'pro']])['status']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://posthog.example.test/capture/' && !$request->hasHeader('Authorization') && $request['api_key'] === 'phc_project' && $request['event'] === 'purchase');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake(['https://tenant-posthog.example.test/api/environments/env_tenant/events/?limit=1' => Http::response(['results' => [['id' => 'event_2']]], 200)]);
        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed { if ($integration !== 'posthog' || $account !== 'work') return $default; return match ($key) { 'api_token' => 'phx_tenant', 'url' => 'https://tenant-posthog.example.test', 'project_id' => 'proj_tenant', 'environment_id' => 'env_tenant', 'project_api_key' => 'phc_tenant', default => $default }; }
            public function isConfigured(string $integration, ?string $account = null): bool { return $integration === 'posthog' && $account === 'work'; }
            public function getAccounts(string $integration): array { return $integration === 'posthog' ? ['work'] : []; }
        });
        $result = (new PostHogToolProvider)->createTool(PostHogListEvents::class, ['account' => 'work'])->execute(['limit' => 1]);
        self::assertTrue($result->succeeded());
        self::assertSame('event_2', $result->data['results'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant-posthog.example.test/api/environments/env_tenant/events/?limit=1' && $request->hasHeader('Authorization', 'Bearer phx_tenant'));
    }
}
