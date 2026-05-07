<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Resend;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Resend\ResendOperations;
use OpenCompany\Integrations\Resend\ResendService;
use OpenCompany\Integrations\Resend\ResendToolProvider;
use OpenCompany\Integrations\Resend\Tools\ResendGetEmail;
use OpenCompany\Integrations\Resend\Tools\ResendListDomains;
use PHPUnit\Framework\TestCase;

final class ResendServiceTest extends TestCase
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
        $provider = new ResendToolProvider;
        self::assertSame('resend', $provider->appName());
        self::assertSame('Resend', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://raw.githubusercontent.com/resend/resend-openapi/main/resend.yaml', $provider->integrationMeta()['source_url']);
        self::assertCount(83, ResendOperations::all());
        self::assertCount(83, $provider->tools());
        foreach (['resend_send_email', 'resend_get_email', 'resend_list_emails', 'resend_create_domain', 'resend_list_domains', 'resend_verify_domain', 'resend_create_api_key', 'resend_list_api_keys', 'resend_create_contact', 'resend_send_batch_emails'] as $slug) {
            self::assertArrayHasKey($slug, $provider->tools());
        }
    }

    public function test_service_maps_common_endpoints_and_bearer_header(): void
    {
        Http::fake([
            'https://api.example.test/emails' => Http::response(['id' => 'email_1'], 200),
            'https://api.example.test/emails/email_1' => Http::response(['id' => 'email_1'], 200),
            'https://api.example.test/domains' => Http::response(['data' => [['id' => 'domain_1']]], 200),
            'https://api.example.test/domains/domain_1/verify' => Http::response(['id' => 'domain_1'], 200),
        ]);

        $service = new ResendService(apiKey: 're_test', baseUrl: 'https://api.example.test');
        self::assertSame('email_1', $service->sendEmail(['from' => 'a@example.test', 'to' => ['b@example.test'], 'subject' => 'Hi', 'text' => 'Hello'])['id']);
        self::assertSame('email_1', $service->getEmail('email_1')['id']);
        self::assertSame('domain_1', $service->listDomains()['data'][0]['id']);
        self::assertSame('domain_1', $service->verifyDomain('domain_1')['id']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer re_test'));
    }

    public function test_generated_tools_map_path_query_body_and_missing_required_parameters(): void
    {
        Http::fake([
            'https://api.example.test/emails/email_1' => Http::response(['id' => 'email_1'], 200),
            'https://api.example.test/emails/batch' => Http::response(['data' => [['id' => 'email_2']]], 200),
        ]);

        $service = new ResendService(apiKey: 're_test', baseUrl: 'https://api.example.test');
        $get = new ResendGetEmail($service);
        $success = $get->execute(['id' => 'email_1']);
        self::assertTrue($success->succeeded());
        self::assertSame('email_1', $success->data['id']);

        $missing = $get->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertSame('The id parameter is required.', $missing->error);

        $batch = $service->executeOperation(ResendOperations::all()['resend_send_batch_emails'], ['emails' => [['from' => 'a@example.test', 'to' => ['b@example.test'], 'subject' => 'Hi', 'text' => 'Hello']]]);
        self::assertSame('email_2', $batch['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/emails/batch'
            && is_array($request['emails'] ?? null));
    }

    public function test_provider_resolves_named_account_credentials(): void
    {
        Http::fake(['https://tenant-resend.example.test/domains' => Http::response(['data' => [['id' => 'domain_1']]], 200)]);
        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration !== 'resend' || $account !== 'work') return $default;
                return match ($key) {'api_key' => 're_tenant', 'url' => 'https://tenant-resend.example.test', default => $default};
            }
            public function isConfigured(string $integration, ?string $account = null): bool { return $integration === 'resend' && $account === 'work'; }
            public function getAccounts(string $integration): array { return $integration === 'resend' ? ['work'] : []; }
        });
        $tool = (new ResendToolProvider)->createTool(ResendListDomains::class, ['account' => 'work']);
        $result = $tool->execute([]);
        self::assertTrue($result->succeeded());
        self::assertSame('domain_1', $result->data['data'][0]['id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://tenant-resend.example.test/domains' && $request->hasHeader('Authorization', 'Bearer re_tenant'));
    }
}
