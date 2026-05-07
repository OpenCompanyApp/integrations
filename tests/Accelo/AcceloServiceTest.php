<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Accelo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Accelo\AcceloService;
use OpenCompany\Integrations\Accelo\AcceloToolProvider;
use OpenCompany\Integrations\Accelo\Tools\AcceloCreateTicket;
use OpenCompany\Integrations\Accelo\Tools\AcceloGetCurrentUser;
use OpenCompany\Integrations\Accelo\Tools\AcceloListProjects;
use OpenCompany\Integrations\Accelo\Tools\AcceloListTickets;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for Accelo public REST API endpoint mapping.
 */
final class AcceloServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_metadata_and_credentials(): void
    {
        $provider = new AcceloToolProvider;

        self::assertSame('Accelo', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(7, $provider->tools());
        self::assertSame(['access_token', 'deployment', 'url'], array_column($provider->credentialFields(), 'key'));
        self::assertFileExists((string) $provider->luaDocsPath());
    }

    public function test_service_uses_official_api_host_resources_and_form_writes(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AcceloService('token_test', 'example');
        $service->listTickets(50, 2, 'open');
        $service->getTicket(123);
        $service->createTicket('Login issue', 'Cannot sign in', 44, 2);
        $service->listProjects(25, 1, 'active');
        $service->getCurrentUser();

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.api.accelo.com/api/v0/issues?_limit=50&_page=2&_filters=standing%28open%29'
            && $request->hasHeader('Authorization', 'Bearer token_test'));

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.api.accelo.com/api/v0/issues/123');

        Http::assertSent(function (Request $request): bool {
            $body = $request->data();

            return $request->method() === 'POST'
                && $request->url() === 'https://example.api.accelo.com/api/v0/issues'
                && ($body['title'] ?? '') === 'Login issue'
                && ($body['description'] ?? '') === 'Cannot sign in'
                && ($body['contract_id'] ?? null) === 44
                && ($body['priority_id'] ?? null) === 2;
        });

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.api.accelo.com/api/v0/jobs?_limit=25&_page=1&_filters=standing%28active%29');

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.api.accelo.com/api/v0/tokeninfo');
    }

    public function test_tools_call_correct_service_methods_and_validate_configuration(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new AcceloService('token_test', '', 'https://api.example.test');

        self::assertTrue((new AcceloListTickets($service))->execute(['limit' => 10, 'page' => 1, 'status' => 'open'])->succeeded());
        self::assertTrue((new AcceloCreateTicket($service))->execute(['title' => 'Issue', 'body' => 'Description'])->succeeded());
        self::assertTrue((new AcceloListProjects($service))->execute(['status' => 'active'])->succeeded());
        self::assertTrue((new AcceloGetCurrentUser($service))->execute([])->succeeded());

        $unconfigured = (new AcceloListTickets(new AcceloService('', '', 'https://api.example.test')))->execute([]);

        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_tokeninfo_on_api_host(): void
    {
        Http::fake(['example.api.accelo.com/api/v0/tokeninfo' => Http::response([
            'firstname' => 'Ada',
            'surname' => 'Lovelace',
            'email' => 'ada@example.test',
        ], 200)]);

        $result = (new AcceloToolProvider)->testConnection([
            'access_token' => 'token_test',
            'deployment' => 'example',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Ada Lovelace', (string) $result['message']);

        Http::assertSent(fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.api.accelo.com/api/v0/tokeninfo'
            && $request->hasHeader('Authorization', 'Bearer token_test'));
    }
}
