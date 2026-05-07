<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Brevo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Brevo\BrevoService;
use OpenCompany\Integrations\Brevo\BrevoToolProvider;
use OpenCompany\Integrations\Brevo\Tools\BrevoCreateContact;
use OpenCompany\Integrations\Brevo\Tools\BrevoListContacts;
use OpenCompany\Integrations\Brevo\Tools\BrevoSendEmail;
use OpenCompany\Integrations\Brevo\Tools\BrevoSendTransactionalSms;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Brevo endpoint mapping and metadata.
 */
final class BrevoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrevoService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(BrevoService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_uses_api_key_header_and_maps_methods(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new BrevoService(apiKey: 'key-test');
        $service->apiGet('/contacts', ['limit' => 20]);
        $service->apiPost('/smtp/email', ['subject' => 'Hello']);
        $service->apiPut('/contacts/lists/12', ['name' => 'Customers']);
        $service->apiDelete('/smtp/blockedContacts/user@example.test');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('api-key', 'key-test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/contacts?limit=20');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.brevo.com/v3/smtp/email'
            && $request['subject'] === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://api.brevo.com/v3/contacts/lists/12'
            && $request['name'] === 'Customers');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://api.brevo.com/v3/smtp/blockedContacts/user@example.test');
    }

    public function test_tools_shape_payloads_and_query_parameters(): void
    {
        $service = new BrevoService(apiKey: 'key-test');

        Http::fake(['*' => Http::response(['contacts' => []], 200)]);
        self::assertTrue((new BrevoListContacts($service))->execute(['limit' => 10, 'modified_since' => '2026-01-01'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/contacts?modifiedSince=2026-01-01&limit=10');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 123], 201)]);
        self::assertTrue((new BrevoCreateContact($service))->execute([
            'email' => 'ada@example.test',
            'attributes' => ['FIRSTNAME' => 'Ada'],
            'list_ids' => [12],
            'update_enabled' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/contacts'
            && $request['listIds'] === [12]
            && $request['updateEnabled'] === true);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['messageId' => 'msg-123'], 200)]);
        self::assertTrue((new BrevoSendEmail($service))->execute(['payload' => ['subject' => 'Hello']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/smtp/email'
            && $request['subject'] === 'Hello');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['messageId' => 'sms-123'], 200)]);
        self::assertTrue((new BrevoSendTransactionalSms($service))->execute(['payload' => ['recipient' => '15551234567']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/transactionalSMS/send'
            && $request['recipient'] === '15551234567');
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new BrevoToolProvider;
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.brevo.com/reference/', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(120, count($tools));
        self::assertArrayHasKey('brevo_send_email', $tools);
        self::assertArrayHasKey('brevo_list_smtp_templates', $tools);
        self::assertArrayHasKey('brevo_send_transactional_sms', $tools);
        self::assertArrayHasKey('brevo_api_get', $tools);

        self::assertSame(['success' => false, 'error' => 'API key is required.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['email' => 'admin@example.test'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Brevo as admin@example.test.'], $provider->testConnection([
            'api_key' => 'key-test',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.brevo.com/v3/account');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['contacts' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['brevo', 'api_key', 'mail'] => 'account-key',
                    ['brevo', 'url', 'mail'] => 'https://brevo.example.test/v3',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'brevo' && $account === 'mail';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'brevo' ? ['mail'] : [];
            }
        });

        $tool = $provider->createTool(BrevoListContacts::class, ['account' => 'mail']);
        self::assertTrue($tool->execute(['limit' => 1])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://brevo.example.test/v3/contacts?limit=1'
            && $request->hasHeader('api-key', 'account-key'));
    }
}
