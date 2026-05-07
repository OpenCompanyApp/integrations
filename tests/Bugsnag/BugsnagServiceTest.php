<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Bugsnag;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Bugsnag\BugsnagService;
use OpenCompany\Integrations\Bugsnag\BugsnagToolProvider;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagGetProjectTrend;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListErrors;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagListOrganizations;
use OpenCompany\Integrations\Bugsnag\Tools\BugsnagNotifyBuild;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Bugsnag endpoint mapping and metadata.
 */
final class BugsnagServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BugsnagService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BugsnagService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_data_access_requests_use_token_and_version_header(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BugsnagService(apiToken: 'token-test');
        $service->apiGet('/user/organizations');
        $service->apiPatch('/errors/error-id', ['status' => 'fixed']);
        $service->apiDelete('/errors/error-id');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'token token-test'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Version', '2'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bugsnag.com/user/organizations');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://api.bugsnag.com/errors/error-id'
            && $request['status'] === 'fixed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.bugsnag.com/errors/error-id');
    }

    public function test_tools_shape_filters_trends_and_build_requests(): void
    {
        $service = new BugsnagService(apiToken: 'token-test');

        Http::fake(['*' => Http::response([['id' => 'org-id']], 200)]);
        self::assertTrue((new BugsnagListOrganizations($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bugsnag.com/user/organizations');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 'error-id']], 200)]);
        self::assertTrue((new BugsnagListErrors($service))->execute([
            'project_id' => 'project-id',
            'query' => [
                'filters[error.status][][value]' => 'open',
                'filters[error.status][][type]' => 'eq',
            ],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'https://api.bugsnag.com/projects/project-id/errors?')
            && str_contains($request->url(), 'filters%5Berror.status%5D%5B%5D%5Bvalue%5D=open'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['events_count' => 10]], 200)]);
        self::assertTrue((new BugsnagGetProjectTrend($service))->execute([
            'project_id' => 'project-id',
            'resolution' => '30m',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bugsnag.com/projects/project-id/trend?resolution=30m');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['body' => 'OK'], 200)]);
        self::assertTrue((new BugsnagNotifyBuild($service))->execute([
            'payload' => ['apiKey' => 'project-api-key', 'appVersion' => '1.2.3'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://build.bugsnag.com/'
            && $request['apiKey'] === 'project-api-key'
            && !$request->hasHeader('X-Version'));
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new BugsnagToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertGreaterThanOrEqual(31, count($tools));
        self::assertArrayHasKey('bugsnag_list_organizations', $tools);
        self::assertArrayHasKey('bugsnag_get_project_trend', $tools);
        self::assertArrayHasKey('bugsnag_create_organization_event_data_request', $tools);
        self::assertArrayHasKey('bugsnag_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'API token is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['email' => 'admin@example.test'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Bugsnag as admin@example.test.'], $provider->testConnection([
            'api_token' => 'token-test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bugsnag.com/user'
            && $request->hasHeader('X-Version', '2'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 'org-id']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['bugsnag', 'api_token', 'ops'] => 'account-token',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'bugsnag' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'bugsnag' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(BugsnagListOrganizations::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.bugsnag.com/user/organizations'
            && $request->hasHeader('Authorization', 'token account-token'));
    }
}
