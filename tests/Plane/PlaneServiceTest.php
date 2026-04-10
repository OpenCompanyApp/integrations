<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Plane;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Plane\PlaneService;
use OpenCompany\Integrations\Plane\PlaneToolProvider;
use PHPUnit\Framework\TestCase;

final class PlaneServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_plane_service_normalizes_workspace_urls_to_origin(): void
    {
        self::assertSame(
            'https://plane.example.test',
            PlaneService::normalizeBaseUrl('https://plane.example.test/demo-workspace'),
        );
        self::assertSame(
            'https://plane.example.test',
            PlaneService::normalizeBaseUrl('https://plane.example.test/api'),
        );
        self::assertSame(
            'https://api.plane.so',
            PlaneService::normalizeBaseUrl('https://api.plane.so'),
        );
    }

    public function test_plane_config_schema_warns_against_workspace_or_api_paths(): void
    {
        $provider = new PlaneToolProvider;
        $fields = $provider->configSchema();
        $urlField = null;
        foreach ($fields as $field) {
            if (($field['key'] ?? null) === 'url') {
                $urlField = $field;
                break;
            }
        }

        self::assertIsArray($urlField);
        self::assertStringContainsString('site origin only', (string) ($urlField['hint'] ?? ''));
        self::assertStringContainsString('workspace slug', (string) ($urlField['hint'] ?? ''));
        self::assertStringContainsString('/api', (string) ($urlField['hint'] ?? ''));
    }

    public function test_project_active_status_is_derived_from_archived_at_when_needed(): void
    {
        self::assertTrue(PlaneService::isProjectActive(['archived_at' => null]));
        self::assertFalse(PlaneService::isProjectActive(['archived_at' => '2026-04-10T00:00:00Z']));
        self::assertFalse(PlaneService::isProjectActive(['is_active' => false, 'archived_at' => null]));
    }

    public function test_filter_issues_applies_priority_and_search_locally(): void
    {
        $issues = [
            [
                'id' => '1',
                'project' => 'project-1',
                'name' => 'Fix cache invalidation',
                'description_html' => '<p>Handle stale issue results</p>',
                'priority' => 'urgent',
                'state' => 'todo',
                'assignees' => [['id' => 'user-1']],
                'labels' => [['id' => 'label-a']],
            ],
            [
                'id' => '2',
                'project' => 'project-1',
                'name' => 'Write docs',
                'description_html' => '<p>Lower priority chore</p>',
                'priority' => 'low',
                'state' => 'todo',
                'assignees' => [['id' => 'user-2']],
                'labels' => [['id' => 'label-b']],
            ],
        ];

        $filtered = PlaneService::filterIssues($issues, [
            'project' => 'project-1',
            'priority' => 'urgent',
            'search' => 'cache',
            'assignee' => 'user-1',
            'labels' => 'label-a',
        ]);

        self::assertCount(1, $filtered);
        self::assertSame('1', $filtered[0]['id']);
    }

    public function test_search_issues_falls_back_to_project_issue_enumeration_on_404(): void
    {
        Http::fake([
            'https://plane.example.test/api/v1/workspaces/demo-workspace/search/*' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/workspaces/demo-workspace/search/*' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/' => Http::response([
                'results' => [
                    ['id' => 'project-1', 'name' => 'Demo Project', 'identifier' => 'DEM'],
                ],
            ], 200),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/project-1/issues/' => Http::response([
                'results' => [
                    ['id' => 'issue-1', 'project' => 'project-1', 'name' => 'Cache invalidation', 'description_html' => '<p>Stale search results</p>', 'priority' => 'urgent'],
                    ['id' => 'issue-2', 'project' => 'project-1', 'name' => 'Docs cleanup', 'description_html' => '<p>Unrelated</p>', 'priority' => 'low'],
                ],
            ], 200),
        ]);

        $service = new PlaneService(
            apiKey: 'token',
            baseUrl: 'https://plane.example.test',
            workspaceSlug: 'demo-workspace',
        );

        $issues = $service->searchIssues('demo-workspace', ['search' => 'cache']);

        self::assertCount(1, $issues);
        self::assertSame('issue-1', $issues[0]['id']);
        self::assertSame('DEM', $issues[0]['project_detail']['identifier']);
    }

    public function test_workspace_members_fall_back_to_project_members_when_endpoint_is_missing(): void
    {
        Http::fake([
            'https://plane.example.test/api/v1/workspaces/demo-workspace/members/' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/workspaces/demo-workspace/members/' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/' => Http::response([
                'results' => [
                    ['id' => 'project-1'],
                    ['id' => 'project-2'],
                ],
            ], 200),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/project-1/members/' => Http::response([
                ['member' => ['id' => 'user-1', 'email' => 'user@example.test', 'display_name' => 'Demo User'], 'role' => 20],
            ], 200),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/project-2/members/' => Http::response([
                ['member' => ['id' => 'user-1', 'email' => 'user@example.test', 'display_name' => 'Demo User'], 'role' => 20],
            ], 200),
        ]);

        $service = new PlaneService(
            apiKey: 'token',
            baseUrl: 'https://plane.example.test',
            workspaceSlug: 'demo-workspace',
        );

        $members = $service->listWorkspaceMembers('demo-workspace');

        self::assertCount(1, $members);
        self::assertSame('user-1', $members[0]['member']['id']);
    }

    public function test_get_issue_falls_back_to_workspace_issue_reference_route(): void
    {
        Http::fake([
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/project-1/issues/DEM-55/' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/workspaces/demo-workspace/projects/project-1/issues/DEM-55/' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/v1/workspaces/demo-workspace/issues/DEM-55/' => Http::response([
                'id' => 'issue-55',
                'name' => 'Cache invalidation breaks search',
            ], 200),
        ]);

        $service = new PlaneService(
            apiKey: 'token',
            baseUrl: 'https://plane.example.test',
            workspaceSlug: 'demo-workspace',
        );

        $issue = $service->getIssue('demo-workspace', 'project-1', 'DEM-55');

        self::assertSame('issue-55', $issue['id']);
    }

    public function test_list_pages_returns_clear_error_when_pages_api_is_unavailable(): void
    {
        Http::fake([
            'https://plane.example.test/api/v1/workspaces/demo-workspace/projects/project-1/pages/' => Http::response(['error' => 'Page not found.'], 404),
            'https://plane.example.test/api/workspaces/demo-workspace/projects/project-1/pages/' => Http::response(['error' => 'Page not found.'], 404),
        ]);

        $service = new PlaneService(
            apiKey: 'token',
            baseUrl: 'https://plane.example.test',
            workspaceSlug: 'demo-workspace',
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('pages are not available');

        $service->listPages('demo-workspace', 'project-1');
    }

    public function test_search_fallback_sends_expected_header(): void
    {
        Http::fake([
            '*' => Http::response(['results' => []], 200),
        ]);

        $service = new PlaneService(
            apiKey: 'token',
            baseUrl: 'https://plane.example.test',
            workspaceSlug: 'demo-workspace',
        );

        $service->listProjects('demo-workspace');

        Http::assertSent(static function (Request $request): bool {
            return $request->hasHeader('X-Api-Key', 'token');
        });
    }
}
