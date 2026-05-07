<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\PagerDuty;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Pagerduty\PagerdutyOperations;
use OpenCompany\Integrations\Pagerduty\PagerdutyService;
use OpenCompany\Integrations\Pagerduty\PagerDutyToolProvider;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetCurrentUser;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyGetIncident;
use OpenCompany\Integrations\Pagerduty\Tools\PagerdutyListIncidents;
use PHPUnit\Framework\TestCase;

final class PagerDutyServiceTest extends TestCase
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

    public function test_provider_exposes_generated_metadata_and_preserved_tools(): void
    {
        $provider = new PagerDutyToolProvider;

        self::assertSame('pagerduty', $provider->appName());
        self::assertSame('PagerDuty', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.pagerduty.com/api-reference/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://raw.githubusercontent.com/PagerDuty/api-schema/main/reference/REST/openapiv3.json', $provider->integrationMeta()['source_url']);
        self::assertCount(420, PagerdutyOperations::all());
        self::assertCount(420, $provider->tools());
        self::assertArrayHasKey('pagerduty_list_incidents', $provider->tools());
        self::assertArrayHasKey('pagerduty_get_incident', $provider->tools());
        self::assertArrayHasKey('pagerduty_list_services', $provider->tools());
        self::assertArrayHasKey('pagerduty_get_service', $provider->tools());
        self::assertArrayHasKey('pagerduty_list_teams', $provider->tools());
        self::assertArrayHasKey('pagerduty_get_team', $provider->tools());
        self::assertArrayHasKey('pagerduty_get_current_user', $provider->tools());
        self::assertArrayHasKey('pagerduty_create_automation_action', $provider->tools());
        self::assertArrayHasKey('pagerduty_list_status_page_post_updates', $provider->tools());
    }

    public function test_service_maps_common_endpoints_and_bearer_auth(): void
    {
        Http::fake([
            'https://api.example.test/incidents*' => static function (Request $request) {
                if (parse_url($request->url(), PHP_URL_PATH) === '/incidents/Q0123456789ABC') {
                    return Http::response(['incident' => ['id' => 'Q0123456789ABC']], 200);
                }

                return Http::response(['incidents' => [['id' => 'Q0123456789ABC']]], 200);
            },
            'https://api.example.test/services/PSERVICE123' => Http::response(['service' => ['id' => 'PSERVICE123']], 200),
            'https://api.example.test/services*' => Http::response(['services' => [['id' => 'PSERVICE123']]], 200),
            'https://api.example.test/teams/PTEAM123' => Http::response(['team' => ['id' => 'PTEAM123']], 200),
            'https://api.example.test/teams*' => Http::response(['teams' => [['id' => 'PTEAM123']]], 200),
            'https://api.example.test/users/me' => Http::response(['user' => ['email' => 'agent@example.test']], 200),
        ]);

        $service = new PagerdutyService(apiToken: 'pd-token', baseUrl: 'https://api.example.test');

        self::assertSame(['incidents' => [['id' => 'Q0123456789ABC']]], $service->listIncidents('triggered', 'high', 'PSERVICE123', 'PTEAM123', 10, 5));
        self::assertSame(['incident' => ['id' => 'Q0123456789ABC']], $service->getIncident('Q0123456789ABC'));
        self::assertSame(['services' => [['id' => 'PSERVICE123']]], $service->listServices('PTEAM123'));
        self::assertSame(['service' => ['id' => 'PSERVICE123']], $service->getService('PSERVICE123'));
        self::assertSame(['teams' => [['id' => 'PTEAM123']]], $service->listTeams());
        self::assertSame(['team' => ['id' => 'PTEAM123']], $service->getTeam('PTEAM123'));
        self::assertSame(['user' => ['email' => 'agent@example.test']], $service->getCurrentUser());

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/incidents?')
                && ($query['statuses'][0] ?? null) === 'triggered'
                && ($query['urgencies'][0] ?? null) === 'high'
                && ($query['service_ids'][0] ?? null) === 'PSERVICE123'
                && ($query['team_ids'][0] ?? null) === 'PTEAM123'
                && ($query['limit'] ?? null) === '10'
                && ($query['offset'] ?? null) === '5'
                && $request->hasHeader('Authorization', 'Bearer pd-token')
                && $request->hasHeader('Accept', 'application/vnd.pagerduty+json;version=2');
        });
    }

    public function test_generated_tools_map_path_query_header_and_body_arguments(): void
    {
        Http::fake([
            'https://api.example.test/incidents*' => static function (Request $request) {
                if (parse_url($request->url(), PHP_URL_PATH) === '/incidents/Q0123456789ABC') {
                    return Http::response(['incident' => ['id' => 'Q0123456789ABC']], 200);
                }

                return Http::response(['incidents' => [['id' => 'Q0123456789ABC']]], 200);
            },
            'https://api.example.test/automation_actions/actions' => Http::response(['action' => ['name' => 'Restart app']], 200),
        ]);

        $service = new PagerdutyService(apiToken: 'pd-token', baseUrl: 'https://api.example.test');

        $get = new PagerdutyGetIncident($service);
        $success = $get->execute(['id' => 'Q0123456789ABC']);
        self::assertTrue($success->succeeded());
        self::assertSame('Q0123456789ABC', $success->data['incident']['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $list = new PagerdutyListIncidents($service);
        $listed = $list->execute(['statuses' => ['triggered'], 'limit' => 10]);
        self::assertTrue($listed->succeeded());
        self::assertSame('Q0123456789ABC', $listed->data['incidents'][0]['id']);

        $operation = PagerdutyOperations::all()['pagerduty_create_automation_action'];
        $created = $service->executeOperation($operation, [
            'automation_action' => ['name' => 'Restart app'],
        ]);
        self::assertSame('Restart app', $created['action']['name']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return str_starts_with($request->url(), 'https://api.example.test/incidents?')
                && ($query['statuses'][0] ?? null) === 'triggered'
                && ($query['limit'] ?? null) === '10';
        });
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/automation_actions/actions'
            && $request['automation_action']['name'] === 'Restart app');
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake([
            'https://tenant-api.example.test/users/me' => Http::response(['user' => ['email' => 'tenant@example.test']], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'pagerduty' || $account !== 'work') {
                    return $default;
                }

                return match ($key) {
                    'api_token' => 'tenant-pd-token',
                    'base_url' => 'https://tenant-api.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'pagerduty' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'pagerduty' ? ['work'] : [];
            }
        });

        $tool = (new PagerDutyToolProvider)->createTool(PagerdutyGetCurrentUser::class, ['account' => 'work']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        self::assertSame('tenant@example.test', $result->data['user']['email']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://tenant-api.example.test/users/me'
            && $request->hasHeader('Authorization', 'Bearer tenant-pd-token'));
    }
}
