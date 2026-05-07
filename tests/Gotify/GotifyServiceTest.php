<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Gotify;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Gotify\GotifyService;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Gotify token modes and core REST endpoint mappings.
 */
final class GotifyServiceTest extends TestCase
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

    public function test_create_message_uses_application_token(): void
    {
        Http::fake([
            'https://gotify.example.test/message' => Http::response(['id' => 10], 200),
        ]);

        $service = new GotifyService(
            appToken: 'app-token',
            baseUrl: 'https://gotify.example.test',
            clientToken: 'client-token',
        );

        $service->createMessage('Title', 'Body', 7, [
            'client::display' => ['contentType' => 'text/markdown'],
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://gotify.example.test/message'
                && $request->header('X-Gotify-Key')[0] === 'app-token'
                && $request->data()['title'] === 'Title'
                && $request->data()['message'] === 'Body'
                && $request->data()['priority'] === 7
                && $request->data()['extras']['client::display']['contentType'] === 'text/markdown';
        });
    }

    public function test_message_management_uses_client_token(): void
    {
        Http::fake([
            'https://gotify.example.test/message*' => Http::response(['messages' => []], 200),
            'https://gotify.example.test/message/42' => Http::response('', 200),
            'https://gotify.example.test/application/7/message*' => Http::response(['messages' => []], 200),
            'https://gotify.example.test/application/7/message' => Http::response('', 200),
        ]);

        $service = new GotifyService(
            appToken: 'app-token',
            baseUrl: 'https://gotify.example.test',
            clientToken: 'client-token',
        );

        $service->listMessages(limit: 50, since: 100);
        $service->deleteMessage(42);
        $service->deleteMessages();
        $service->listApplicationMessages(applicationId: 7, limit: 25, since: 90);
        $service->deleteApplicationMessages(7);

        foreach (['/message?limit=50&since=100', '/message/42', '/message', '/application/7/message?limit=25&since=90', '/application/7/message'] as $path) {
            Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gotify.example.test' . $path
                && $request->header('X-Gotify-Key')[0] === 'client-token');
        }
    }

    public function test_application_endpoints_use_client_token(): void
    {
        Http::fake([
            'https://gotify.example.test/application' => Http::response([], 200),
            'https://gotify.example.test/application/7' => Http::response(['id' => 7], 200),
        ]);

        $service = new GotifyService(
            appToken: 'app-token',
            baseUrl: 'https://gotify.example.test',
            clientToken: 'client-token',
        );

        $service->listApplications();
        $service->createApplication(['name' => 'CI', 'description' => 'Builds']);
        $service->updateApplication(7, ['name' => 'CI Alerts', 'description' => 'Deploys']);
        $service->deleteApplication(7);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://gotify.example.test/application' && $request->header('X-Gotify-Key')[0] === 'client-token');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://gotify.example.test/application' && $request->data()['name'] === 'CI');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://gotify.example.test/application/7' && $request->data()['name'] === 'CI Alerts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://gotify.example.test/application/7');
    }

    public function test_client_endpoints_use_client_token(): void
    {
        Http::fake([
            'https://gotify.example.test/client' => Http::response([], 200),
            'https://gotify.example.test/client/12' => Http::response(['id' => 12], 200),
        ]);

        $service = new GotifyService(
            appToken: 'app-token',
            baseUrl: 'https://gotify.example.test',
            clientToken: 'client-token',
        );

        $service->listClients();
        $service->createClient(['name' => 'Automation']);
        $service->updateClient(12, ['name' => 'Worker']);
        $service->deleteClient(12);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://gotify.example.test/client' && $request->header('X-Gotify-Key')[0] === 'client-token');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://gotify.example.test/client' && $request->data()['name'] === 'Automation');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://gotify.example.test/client/12' && $request->data()['name'] === 'Worker');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://gotify.example.test/client/12');
    }

    public function test_health_and_version_do_not_send_tokens(): void
    {
        Http::fake([
            'https://gotify.example.test/health' => Http::response(['health' => 'green'], 200),
            'https://gotify.example.test/version' => Http::response(['version' => '2.6.0'], 200),
            'https://gotify.example.test/current/user' => Http::response(['name' => 'admin'], 200),
        ]);

        $service = new GotifyService(
            appToken: 'app-token',
            baseUrl: 'https://gotify.example.test',
            clientToken: 'client-token',
        );

        $service->getHealth();
        $service->getVersion();
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gotify.example.test/health'
            && $request->header('X-Gotify-Key') === []);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gotify.example.test/version'
            && $request->header('X-Gotify-Key') === []);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://gotify.example.test/current/user'
            && $request->header('X-Gotify-Key')[0] === 'client-token');
    }

    public function test_unhealthy_health_response_still_returns_body(): void
    {
        Http::fake([
            'https://gotify.example.test/health' => Http::response(['health' => 'red', 'database' => 'red'], 500),
        ]);

        $service = new GotifyService(baseUrl: 'https://gotify.example.test');

        self::assertSame(['health' => 'red', 'database' => 'red'], $service->getHealth());
    }
}
