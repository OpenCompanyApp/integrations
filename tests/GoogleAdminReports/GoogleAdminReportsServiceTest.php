<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleAdminReports;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleAdminReports\GoogleAdminReportsService;
use OpenCompany\Integrations\GoogleAdminReports\GoogleAdminReportsToolProvider;
use OpenCompany\Integrations\GoogleAdminReports\Tools\GoogleAdminReportsActivitiesList;
use OpenCompany\Integrations\GoogleAdminReports\Tools\GoogleAdminReportsActivitiesWatch;
use OpenCompany\Integrations\GoogleAdminReports\Tools\GoogleAdminReportsCustomerUsageReportsGet;
use PHPUnit\Framework\TestCase;

final class GoogleAdminReportsServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleAdminReportsToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-admin-reports/google-admin-reports-discovery-manifest.json'), true);

        self::assertSame(6, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Admin Reports', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('google_admin_reports_activities_list', array_keys($provider->tools()));
        self::assertContains('google_admin_reports_activities_watch', array_keys($provider->tools()));
    }

    public function test_service_maps_auth_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleAdminReportsService('token-test', 'https://example.test');
        $service->request('GET', '/admin/reports/v1/activity/users/{userKey}/applications/{applicationName}', ['userKey' => 'all', 'applicationName' => 'login'], [], ['maxResults' => 5]);
        $service->request('POST', '/admin/reports/v1/activity/users/{userKey}/applications/{applicationName}/watch', ['userKey' => 'all', 'applicationName' => 'drive'], [], ['eventName' => 'edit'], ['id' => 'channel-1', 'type' => 'web_hook']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/admin/reports/v1/activity/users/all/applications/login?maxResults=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/admin/reports/v1/activity/users/all/applications/drive/watch?eventName=edit'
            && $request['id'] === 'channel-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleAdminReportsService('token-test');

        $list = new GoogleAdminReportsActivitiesList($service);
        $result = $list->execute(['userKey' => 'all', 'applicationName' => 'login', 'maxResults' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://admin.googleapis.com/admin/reports/v1/activity/users/all/applications/login?maxResults=10');

        $missingPath = (new GoogleAdminReportsCustomerUsageReportsGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('date must be', (string) $missingPath->error);

        $missingBody = (new GoogleAdminReportsActivitiesWatch($service))->execute(['userKey' => 'all', 'applicationName' => 'login']);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}