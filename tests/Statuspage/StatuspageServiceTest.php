<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Statuspage;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Statuspage\StatuspageService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Statuspage endpoint coverage and payload mappings.
 */
final class StatuspageServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_current_user_uses_oauth_authorization_header(): void
    {
        Http::fake([
            'https://api.statuspage.test/v1/users/me' => Http::response([
                'id' => 'user-test',
                'email' => 'person@example.test',
            ], 200),
        ]);

        $service = new StatuspageService(
            apiKey: 'key-test',
            pageId: 'page-test',
            baseUrl: 'https://api.statuspage.test/v1',
        );

        $user = $service->getCurrentUser();

        self::assertSame('person@example.test', $user['email']);
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.statuspage.test/v1/users/me'
                && $request->hasHeader('Authorization', 'OAuth key-test');
        });
    }

    public function test_page_endpoints_map_to_manage_api_paths(): void
    {
        Http::fake([
            'https://api.statuspage.test/v1/pages?*' => Http::response([
                ['id' => 'page-test', 'name' => 'Example Status'],
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test' => Http::response([
                'id' => 'page-test',
                'name' => 'Example Status',
            ], 200),
            'https://api.statuspage.test/v1/pages/page-other' => Http::response([
                'id' => 'page-other',
                'name' => 'Other Status',
            ], 200),
        ]);

        $service = new StatuspageService(
            apiKey: 'key-test',
            pageId: 'page-test',
            baseUrl: 'https://api.statuspage.test/v1/',
        );

        $service->listPages(['page' => 2, 'per_page' => 50]);
        $configured = $service->getPage();
        $other = $service->getPage('page-other');

        self::assertSame('page-test', $configured['id']);
        self::assertSame('page-other', $other['id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.statuspage.test/v1/pages?page=2&per_page=50');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.statuspage.test/v1/pages/page-test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.statuspage.test/v1/pages/page-other');
    }

    public function test_incident_endpoints_map_to_page_scoped_paths(): void
    {
        Http::fake([
            'https://api.statuspage.test/v1/pages/page-test/incidents' => Http::response([
                'id' => 'incident-test',
                'status' => 'investigating',
            ], 201),
            'https://api.statuspage.test/v1/pages/page-test/incidents?*' => Http::response([
                ['id' => 'incident-test', 'status' => 'investigating'],
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/incidents/unresolved*' => Http::response([
                ['id' => 'incident-open', 'status' => 'monitoring'],
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/incidents/upcoming*' => Http::response([
                ['id' => 'incident-maintenance', 'status' => 'scheduled'],
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/incidents/incident-test' => Http::response([
                'id' => 'incident-test',
                'status' => 'monitoring',
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/incidents/incident-delete' => Http::response('', 204),
        ]);

        $service = new StatuspageService(
            apiKey: 'key-test',
            pageId: 'page-test',
            baseUrl: 'https://api.statuspage.test/v1',
        );

        $service->listIncidents(['limit' => 10, 'page' => 1]);
        $service->listUnresolvedIncidents(['limit' => 5]);
        $service->listUpcomingIncidents(['limit' => 5]);
        $service->createIncident([
            'name' => 'Example API latency',
            'status' => 'investigating',
            'impact' => 'minor',
        ]);
        $service->updateIncident('incident-test', [
            'status' => 'monitoring',
            'body' => 'Monitoring after recovery.',
        ]);
        $service->deleteIncident('incident-delete');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents?limit=10&page=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents/unresolved?limit=5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents/upcoming?limit=5');
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents'
                && $request->data()['incident']['name'] === 'Example API latency'
                && $request->data()['incident']['impact'] === 'minor';
        });
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'PATCH'
                && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents/incident-test'
                && $request->data()['incident']['status'] === 'monitoring';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/incidents/incident-delete');
    }

    public function test_component_endpoints_map_to_page_scoped_paths(): void
    {
        Http::fake([
            'https://api.statuspage.test/v1/pages/page-test/components' => Http::response([
                'id' => 'component-test',
                'name' => 'Example API',
            ], 201),
            'https://api.statuspage.test/v1/pages/page-test/components?*' => Http::response([
                ['id' => 'component-test', 'name' => 'Example API'],
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/components/component-test' => Http::response([
                'id' => 'component-test',
                'name' => 'Example API',
                'status' => 'operational',
            ], 200),
            'https://api.statuspage.test/v1/pages/page-test/components/component-delete' => Http::response('', 204),
        ]);

        $service = new StatuspageService(
            apiKey: 'key-test',
            pageId: 'page-test',
            baseUrl: 'https://api.statuspage.test/v1',
        );

        $service->listComponents(['page' => 3, 'per_page' => 25]);
        $service->getComponent('component-test');
        $service->createComponent([
            'name' => 'Example API',
            'status' => 'operational',
        ]);
        $service->updateComponent('component-test', [
            'status' => 'degraded_performance',
        ]);
        $service->deleteComponent('component-delete');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/components?page=3&per_page=25');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/components/component-test');
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/components'
                && $request->data()['component']['name'] === 'Example API';
        });
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'PATCH'
                && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/components/component-test'
                && $request->data()['component']['status'] === 'degraded_performance';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.statuspage.test/v1/pages/page-test/components/component-delete');
    }

    public function test_empty_delete_response_does_not_error(): void
    {
        Http::fake([
            'https://api.statuspage.test/v1/pages/page-test/components/component-test' => Http::response('', 204),
        ]);

        $service = new StatuspageService(
            apiKey: 'key-test',
            pageId: 'page-test',
            baseUrl: 'https://api.statuspage.test/v1',
        );

        $service->deleteComponent('component-test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE');
    }
}
