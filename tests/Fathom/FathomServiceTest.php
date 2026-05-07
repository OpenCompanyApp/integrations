<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Fathom;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Fathom\FathomService;
use OpenCompany\Integrations\Fathom\FathomToolProvider;
use OpenCompany\Integrations\Fathom\Tools\FathomCreateEvent;
use OpenCompany\Integrations\Fathom\Tools\FathomGetAccount;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Fathom Analytics endpoint coverage and provider metadata.
 */
final class FathomServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_account_sites_events_and_milestones_map_to_documented_paths(): void
    {
        Http::fake([
            'https://api.fathom.test/v1/account' => Http::response(['object' => 'account', 'name' => 'Example User'], 200),
            'https://api.fathom.test/v1/sites*' => Http::response(['object' => 'site', 'id' => 'SITE1'], 200),
            'https://api.fathom.test/v1/sites/SITE1/events*' => Http::response(['object' => 'event', 'id' => 'EV1'], 200),
            'https://api.fathom.test/v1/sites/SITE1/milestones*' => Http::response(['object' => 'milestone', 'id' => 'MS1'], 200),
        ]);

        $service = new FathomService('token-test', 'https://api.fathom.test/v1');
        $service->getAccount();
        $service->listSites(10, 'site-start', 'site-end');
        $service->getSite('SITE1');
        $service->createSite(['name' => 'Example']);
        $service->updateSite('SITE1', ['name' => 'Renamed']);
        $service->wipeSite('SITE1');
        $service->deleteSite('SITE1');
        $service->listEvents('SITE1', 10, 'event-start', 'event-end');
        $service->getEvent('SITE1', 'EV1');
        $service->createEvent('SITE1', 'Signup');
        $service->updateEvent('SITE1', 'EV1', ['name' => 'Lead']);
        $service->wipeEvent('SITE1', 'EV1');
        $service->deleteEvent('SITE1', 'EV1');
        $service->listMilestones('SITE1', 10, 'milestone-start', 'milestone-end');
        $service->getMilestone('SITE1', 'MS1');
        $service->createMilestone('SITE1', ['name' => 'Launch', 'milestone_date' => '2026-01-15']);
        $service->updateMilestone('SITE1', 'MS1', ['name' => 'Relaunch']);
        $service->deleteMilestone('SITE1', 'MS1');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.fathom.test/v1/account');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.fathom.test/v1/sites?') && str_contains($request->url(), 'limit=10') && str_contains($request->url(), 'starting_after=site-start') && str_contains($request->url(), 'ending_before=site-end'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites' && $request->data()['name'] === 'Example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1' && $request->data()['name'] === 'Renamed');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/data');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.fathom.test/v1/sites/SITE1/events?') && str_contains($request->url(), 'starting_after=event-start'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/events/EV1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/events' && $request->data()['name'] === 'Signup');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/events/EV1' && $request->data()['name'] === 'Lead');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/events/EV1/data');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/events/EV1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.fathom.test/v1/sites/SITE1/milestones?') && str_contains($request->url(), 'starting_after=milestone-start'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/milestones/MS1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/milestones' && $request->data()['milestone_date'] === '2026-01-15');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/milestones/MS1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.fathom.test/v1/sites/SITE1/milestones/MS1');
    }

    public function test_reports_use_current_aggregation_and_current_visitors_endpoints(): void
    {
        Http::fake([
            'https://api.fathom.test/v1/aggregations*' => Http::response([['pathname' => '/pricing', 'pageviews' => '42']], 200),
            'https://api.fathom.test/v1/current_visitors*' => Http::response(['total' => 3], 200),
        ]);

        $service = new FathomService('token-test', 'https://api.fathom.test/v1');
        $service->getAggregate('SITE1', metrics: 'pageviews,visits', groupBy: 'pathname', dateGrouping: 'day', timezone: 'UTC');
        $service->getCurrentVisitors('SITE1', true);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.fathom.test/v1/aggregations?')
            && str_contains($request->url(), 'entity=pageview')
            && str_contains($request->url(), 'entity_id=SITE1')
            && str_contains($request->url(), 'aggregates=pageviews%2Cvisits')
            && str_contains($request->url(), 'field_grouping=pathname')
            && str_contains($request->url(), 'date_grouping=day')
            && str_contains($request->url(), 'timezone=UTC'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://api.fathom.test/v1/current_visitors?')
            && str_contains($request->url(), 'site_id=SITE1')
            && str_contains($request->url(), 'detailed=true'));
    }

    public function test_tools_and_provider_expose_documented_surface_without_pageviews(): void
    {
        Http::fake([
            'https://api.fathom.test/v1/account' => Http::response(['object' => 'account', 'name' => 'Example User'], 200),
            'https://api.fathom.test/v1/sites/SITE1/events' => Http::response(['object' => 'event', 'id' => 'signup'], 200),
        ]);

        $service = new FathomService('token-test', 'https://api.fathom.test/v1');
        self::assertNull((new FathomGetAccount($service))->execute([])->error);
        self::assertNull((new FathomCreateEvent($service))->execute(['site_id' => 'SITE1', 'name' => 'Signup'])->error);

        $provider = new FathomToolProvider();
        $tools = $provider->tools();

        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertArrayNotHasKey('fathom_list_pageviews', $tools);
        self::assertArrayHasKey('fathom_get_account', $tools);
        self::assertArrayHasKey('fathom_get_current_visitors', $tools);
        self::assertArrayHasKey('fathom_create_site', $tools);
        self::assertArrayHasKey('fathom_delete_milestone', $tools);
        self::assertSame(21, count($tools));
    }
}
