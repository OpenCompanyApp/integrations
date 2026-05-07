<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Cursor;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Cursor\CursorService;
use OpenCompany\Integrations\Cursor\CursorToolProvider;
use OpenCompany\Integrations\Cursor\Tools\CursorGetSpend;
use OpenCompany\Integrations\Cursor\Tools\CursorListTeamMembers;
use OpenCompany\Integrations\Cursor\Tools\CursorSetUserSpendLimit;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Cursor Admin API endpoint mappings and auth.
 */
final class CursorServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_cursor_admin_api_paths_with_basic_auth(): void
    {
        Http::fake([
            'https://api.cursor.test/teams/members' => Http::response(['teamMembers' => []], 200),
            'https://api.cursor.test/teams/daily-usage-data' => Http::response(['data' => []], 200),
            'https://api.cursor.test/teams/spend' => Http::response(['teamMemberSpend' => []], 200),
            'https://api.cursor.test/teams/filtered-usage-events' => Http::response(['usageEvents' => []], 200),
            'https://api.cursor.test/teams/user-spend-limit' => Http::response(['outcome' => 'success'], 200),
            'https://api.cursor.test/settings/repo-blocklists/repos' => Http::response(['repos' => []], 200),
            'https://api.cursor.test/settings/repo-blocklists/repos/upsert' => Http::response(['repos' => []], 200),
            'https://api.cursor.test/settings/repo-blocklists/repos/repo_123' => Http::response('', 204),
        ]);

        $service = new CursorService('key_test', 'https://api.cursor.test');
        $service->listTeamMembers();
        $service->getDailyUsageData(['startDate' => 1710720000000, 'endDate' => 1710892800000]);
        $service->getSpend(['searchTerm' => 'alex@example.test', 'page' => 2, 'pageSize' => 25]);
        $service->getUsageEvents(['email' => 'alex@example.test', 'page' => 1]);
        $service->setUserSpendLimit('alex@example.test', 100);
        $service->listRepoBlocklists();
        $service->upsertRepoBlocklists([['url' => 'https://github.com/example/repo', 'patterns' => ['*.env']]]);
        $service->deleteRepoBlocklist('repo_123');

        $authHeader = 'Basic ' . base64_encode('key_test:');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cursor.test/teams/members' && $request->hasHeader('Authorization', $authHeader));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cursor.test/teams/daily-usage-data' && $request['startDate'] === 1710720000000);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cursor.test/teams/spend' && $request['searchTerm'] === 'alex@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cursor.test/teams/filtered-usage-events' && $request['email'] === 'alex@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cursor.test/teams/user-spend-limit' && $request['userEmail'] === 'alex@example.test' && $request['spendLimitDollars'] === 100);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.cursor.test/settings/repo-blocklists/repos');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cursor.test/settings/repo-blocklists/repos/upsert' && $request['repos'][0]['patterns'] === ['*.env']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.cursor.test/settings/repo-blocklists/repos/repo_123');
    }

    public function test_tools_map_agent_snake_case_to_cursor_request_bodies(): void
    {
        Http::fake([
            'https://api.cursor.test/teams/members' => Http::response(['teamMembers' => [['email' => 'alex@example.test']]], 200),
            'https://api.cursor.test/teams/spend' => Http::response(['teamMemberSpend' => []], 200),
            'https://api.cursor.test/teams/user-spend-limit' => Http::response(['outcome' => 'success'], 200),
        ]);

        $service = new CursorService('key_test', 'https://api.cursor.test');
        self::assertNull((new CursorListTeamMembers($service))->execute([])->error);
        self::assertNull((new CursorGetSpend($service))->execute([
            'search_term' => 'alex@example.test',
            'sort_by' => 'amount',
            'sort_direction' => 'desc',
            'page' => 2,
            'page_size' => 25,
        ])->error);
        self::assertNull((new CursorSetUserSpendLimit($service))->execute([
            'user_email' => 'alex@example.test',
            'spend_limit_dollars' => 100,
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cursor.test/teams/spend'
            && $request['searchTerm'] === 'alex@example.test'
            && $request['sortBy'] === 'amount'
            && $request['sortDirection'] === 'desc'
            && $request['page'] === 2
            && $request['pageSize'] === 25);
    }

    public function test_provider_exposes_current_admin_api_surface_without_stale_workspace_tools(): void
    {
        $provider = new CursorToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.cursor.com/account/teams/admin-api', $provider->integrationMeta()['docs_url']);
        self::assertArrayNotHasKey('cursor_list_workspaces', $tools);
        self::assertArrayNotHasKey('cursor_get_workspace', $tools);
        self::assertArrayNotHasKey('cursor_list_extensions', $tools);
        self::assertArrayHasKey('cursor_list_team_members', $tools);
        self::assertArrayHasKey('cursor_get_spend', $tools);
        self::assertArrayHasKey('cursor_upsert_repo_blocklists', $tools);
        self::assertSame(8, count($tools));
    }
}
