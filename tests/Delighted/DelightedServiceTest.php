<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Delighted;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Delighted\DelightedService;
use OpenCompany\Integrations\Delighted\DelightedToolProvider;
use OpenCompany\Integrations\Delighted\Tools\DelightedApiGet;
use OpenCompany\Integrations\Delighted\Tools\DelightedGetMetrics;
use OpenCompany\Integrations\Delighted\Tools\DelightedSendPerson;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Delighted REST API integration.
 */
final class DelightedServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DelightedService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DelightedService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new DelightedToolProvider();

        self::assertSame('delighted', $provider->appName());
        self::assertSame('Delighted', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(21, $provider->tools());
        self::assertCount(18, DelightedService::operations());
        self::assertArrayHasKey('delighted_send_person', $provider->tools());
        self::assertArrayHasKey('delighted_get_metrics', $provider->tools());
        self::assertArrayHasKey('delighted_list_autopilot_email_memberships', $provider->tools());
        self::assertArrayHasKey('delighted_api_get', $provider->tools());
    }

    public function test_service_maps_documented_delighted_api_endpoints(): void
    {
        Http::fake([
            'https://api.delighted.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new DelightedService('delighted-key', 'https://api.delighted.test');
        $service->call('send_person', ['email' => 'customer@example.test']);
        $service->call('list_survey_responses', ['per_page' => 100]);
        $service->call('get_metrics');
        $service->call('create_survey_response', ['person' => '1', 'score' => 9]);
        $service->call('delete_pending_survey_request', ['person_identifier' => 'email:customer@example.test']);
        $service->call('unsubscribe_person', ['person' => 'customer@example.test']);
        $service->call('list_people', ['page_info' => 'cursor']);
        $service->call('list_unsubscribes');
        $service->call('list_bounces');
        $service->call('delete_person', ['person_identifier' => 'email:customer@example.test']);
        $service->call('get_autopilot_email');
        $service->call('get_autopilot_sms');
        $service->call('list_autopilot_email_memberships');
        $service->call('add_autopilot_email_membership', ['person' => 'customer@example.test']);
        $service->call('remove_autopilot_sms_membership', ['person' => 'customer@example.test']);
        $service->apiGet('/v1/metrics.json');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic '.base64_encode('delighted-key:')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.delighted.test/v1/people.json' && $request->data()['email'] === 'customer@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/survey_responses.json?per_page=100');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/metrics.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.delighted.test/v1/survey_responses.json' && $request->data()['score'] === 9);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.delighted.test/v1/people/email%3Acustomer%40example.test/survey_requests/pending.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.delighted.test/v1/unsubscribes.json' && $request->data()['person'] === 'customer@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/people.json?page_info=cursor');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/unsubscribes.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/bounces.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.delighted.test/v1/people/email%3Acustomer%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/autopilot/email.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/autopilot/sms.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.delighted.test/v1/autopilot/email/memberships.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.delighted.test/v1/autopilot/email/memberships.json');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_contains($request->url(), 'https://api.delighted.test/v1/autopilot/sms/memberships.json'));
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://api.delighted.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new DelightedService('delighted-key', 'https://api.delighted.test');

        self::assertTrue((new DelightedGetMetrics($service))->execute([])->succeeded());
        self::assertTrue((new DelightedSendPerson($service))->execute(['email' => 'customer@example.test'])->succeeded());

        $badRaw = (new DelightedApiGet($service))->execute(['path' => 'https://evil.example.test/v1/metrics.json']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new DelightedApiGet(new DelightedService('', 'https://api.delighted.test')))->execute(['path' => '/v1/metrics.json']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new DelightedToolProvider();

        self::assertSame(['success' => false, 'error' => 'Delighted API key is required.'], $provider->testConnection([]));

        Http::fake(['https://api.delighted.com/v1/metrics.json' => Http::response(['nps' => 51], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Delighted API.'], $provider->testConnection([
            'api_key' => 'delighted-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.delighted.test/v1/metrics.json' => Http::response(['nps' => 50], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['delighted', 'api_key', 'ops'] => 'account-key',
                    ['delighted', 'url', 'ops'] => 'https://ops.delighted.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'delighted' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'delighted' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool(DelightedGetMetrics::class, ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.delighted.test/v1/metrics.json'
            && $request->hasHeader('Authorization', 'Basic '.base64_encode('account-key:')));
    }
}
