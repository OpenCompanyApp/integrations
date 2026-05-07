<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Mailgun;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Mailgun\MailgunService;
use OpenCompany\Integrations\Mailgun\MailgunToolProvider;
use OpenCompany\Integrations\Mailgun\Tools\MailgunApiGet;
use OpenCompany\Integrations\Mailgun\Tools\MailgunCreateBounce;
use OpenCompany\Integrations\Mailgun\Tools\MailgunListEvents;
use OpenCompany\Integrations\Mailgun\Tools\MailgunSendEmail;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Mailgun endpoint mapping and metadata.
 */
final class MailgunServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(MailgunService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(MailgunService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_api_basic_auth_and_maps_v3_v4_paths(): void
    {
        Http::fake(['*' => Http::response(['items' => []], 200)]);

        $service = new MailgunService(apiKey: 'key-test', domain: 'mg.example.test');
        $service->apiGet('/mg.example.test/events', ['limit' => 10]);
        $service->apiGet('/v4/domains', ['limit' => 1]);
        $service->apiPost('/mg.example.test/messages', ['from' => 'a@example.test']);
        $service->apiDelete('/routes/route_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('api:key-test')));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v3/mg.example.test/events?limit=10');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v4/domains?limit=1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.mailgun.net/v3/mg.example.test/messages' && $request['from'] === 'a@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.mailgun.net/v3/routes/route_123');
    }

    public function test_endpoint_tools_use_default_domain_payload_and_raw_paths(): void
    {
        $service = new MailgunService(apiKey: 'key-test', domain: 'mg.example.test');

        Http::fake(['*' => Http::response(['message' => 'Queued'], 200)]);
        self::assertTrue((new MailgunSendEmail($service))->execute([
            'from' => 'Example <noreply@example.test>',
            'to' => ['user@example.test'],
            'subject' => 'Hello',
            'text' => 'Body',
            'payload' => ['o:tag' => 'test'],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.mailgun.net/v3/mg.example.test/messages'
            && $request['subject'] === 'Hello'
            && $request['o:tag'] === 'test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        self::assertTrue((new MailgunListEvents($service))->execute(['event' => 'delivered', 'limit' => 100])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v3/mg.example.test/events?limit=100&event=delivered');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['message' => 'Created'], 200)]);
        self::assertTrue((new MailgunCreateBounce($service))->execute(['address' => 'bad@example.test', 'code' => 550])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.mailgun.net/v3/mg.example.test/bounces'
            && $request['address'] === 'bad@example.test'
            && $request['code'] === 550);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['domains' => []], 200)]);
        self::assertTrue((new MailgunApiGet($service))->execute(['path' => '/v4/domains', 'query' => ['limit' => 1]])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v4/domains?limit=1');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new MailgunToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://documentation.mailgun.com/docs/mailgun/api-reference/send/mailgun', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(70, count($tools));
        self::assertArrayHasKey('mailgun_create_route', $tools);
        self::assertArrayHasKey('mailgun_create_template_version', $tools);
        self::assertArrayHasKey('mailgun_list_bounces', $tools);
        self::assertArrayHasKey('mailgun_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'API key is required.'], $provider->testConnection(['domain' => 'mg.example.test']));
        self::assertSame(['success' => false, 'error' => 'Sending domain is required.'], $provider->testConnection(['api_key' => 'key-test']));

        Http::fake(['*' => Http::response(['domain' => ['name' => 'mg.example.test', 'state' => 'active']], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Mailgun. Domain: mg.example.test (state: active).'], $provider->testConnection([
            'api_key' => 'key-test',
            'domain' => 'mg.example.test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v4/domains/mg.example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['items' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['mailgun', 'api_key', 'mail'] => 'account-key',
                    ['mailgun', 'domain', 'mail'] => 'account.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'mailgun' && $account === 'mail';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'mailgun' ? ['mail'] : [];
            }
        });

        $tool = $provider->createTool(MailgunListEvents::class, ['account' => 'mail']);
        self::assertTrue($tool->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.mailgun.net/v3/account.example.test/events?limit=1'
            && $request->hasHeader('Authorization', 'Basic ' . base64_encode('api:account-key')));
    }
}
