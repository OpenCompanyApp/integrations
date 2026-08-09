<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Unbounce;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceApiGet;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceCreateLead;
use OpenCompany\Integrations\Unbounce\Tools\UnbounceListSubAccounts;
use OpenCompany\Integrations\Unbounce\UnbounceService;
use OpenCompany\Integrations\Unbounce\UnbounceToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Unbounce REST API integration.
 */
final class UnbounceServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(UnbounceService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(UnbounceService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new UnbounceToolProvider;

        self::assertSame('unbounce', $provider->appName());
        self::assertSame('Unbounce', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(25, $provider->tools());
        self::assertArrayHasKey('unbounce_list_accounts', $provider->tools());
        self::assertArrayHasKey('unbounce_list_page_form_fields', $provider->tools());
        self::assertArrayHasKey('unbounce_create_lead', $provider->tools());
        self::assertArrayHasKey('unbounce_list_domain_pages', $provider->tools());
        self::assertArrayHasKey('unbounce_api_get', $provider->tools());
    }

    public function test_service_maps_account_page_lead_domain_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new UnbounceService('token-test', 'https://api.example.test');
        $service->listAccounts(['sort_order' => 'desc']);
        $service->listSubAccounts(25, 5, 'account-123');
        $service->listAccountPages('account-123', ['limit' => 10]);
        $service->listPageFormFields('page-123');
        $service->createLead('page-123', ['form_submission' => ['variant_id' => 'a']]);
        $service->createLeadDeletionRequest('page-123', ['lead_ids' => ['lead-123']]);
        $service->listDomains('sub-123', ['limit' => 20]);
        $service->listPageGroupPages('group-123', ['offset' => 2]);
        $service->apiGet('/accounts', ['ids' => ['one', 'two']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/accounts?sort_order=desc'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/accounts/account-123/sub_accounts?limit=25&offset=5');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/pages/page-123/form_fields');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.example.test/pages/page-123/leads'
            && $request['form_submission']['variant_id'] === 'a');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/page_groups/group-123/pages?offset=2');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/accounts?ids=one&ids=two');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/accounts');
    }

    public function test_tools_validate_arguments_and_preserve_account_scoped_sub_accounts(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new UnbounceService('token-test', 'https://api.example.test');
        $subAccounts = (new UnbounceListSubAccounts($service))->execute([
            'account_id' => 'account-123',
            'limit' => 25,
        ]);
        $lead = (new UnbounceCreateLead($service))->execute([
            'page_id' => 'page-123',
            'payload' => ['form_submission' => ['variant_id' => 'a']],
        ]);
        $raw = (new UnbounceApiGet($service))->execute(['path' => '/accounts']);

        self::assertTrue($subAccounts->succeeded());
        self::assertTrue($lead->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new UnbounceCreateLead($service))->execute(['payload' => []]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('page_id is required', (string) $missing->error);

        $unconfigured = (new UnbounceApiGet(new UnbounceService('', 'https://api.example.test')))->execute(['path' => '/accounts']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_users_me_endpoint(): void
    {
        Http::fake(['*' => Http::response(['first_name' => 'Ada', 'last_name' => 'Lovelace'], 200)]);

        $result = (new UnbounceToolProvider)->testConnection([
            'access_token' => 'token-test',
            'url' => 'https://api.example.test',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.example.test/users/me'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
