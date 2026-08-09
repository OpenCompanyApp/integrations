<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Revolut;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Revolut\RevolutService;
use OpenCompany\Integrations\Revolut\RevolutServiceProvider;
use OpenCompany\Integrations\Revolut\RevolutToolProvider;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetAccountBankDetails;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetCurrentUser;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetSensitiveCardDetails;
use OpenCompany\Integrations\Revolut\Tools\RevolutGetTransaction;
use OpenCompany\Integrations\Revolut\Tools\RevolutListAccounts;
use OpenCompany\Integrations\Revolut\Tools\RevolutListCards;
use OpenCompany\Integrations\Revolut\Tools\RevolutListTeamMembers;
use OpenCompany\Integrations\Revolut\Tools\RevolutListTransactions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Revolut Business integration.
 */
final class RevolutServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(RevolutService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(RevolutService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new RevolutToolProvider;

        self::assertSame('revolut', $provider->appName());
        self::assertSame('Revolut', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(9, $provider->tools());
        self::assertCount(1, $provider->credentialFields());
        self::assertCount(2, $provider->configSchema());
        self::assertArrayNotHasKey('revolut_get_current_user', $provider->tools());
        self::assertArrayHasKey('revolut_get_account_bank_details', $provider->tools());
        self::assertArrayHasKey('revolut_list_team_members', $provider->tools());
    }

    public function test_routes_and_query_parameters_match_revolut_business_api(): void
    {
        $service = new RevolutService('revolut-token', 'https://sandbox-b2b.revolut.com/api/1.0');

        Http::fake(['*' => Http::response([['id' => 'account-id', 'currency' => 'GBP']], 200)]);
        self::assertTrue((new RevolutListAccounts($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/accounts'
            && $request->hasHeader('Authorization', 'Bearer revolut-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['iban' => 'GB00REV00000000000000']], 200)]);
        self::assertTrue((new RevolutGetAccountBankDetails($service))->execute(['account_id' => 'account-id'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/accounts/account-id/bank-details');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 'tx-id']], 200)]);
        self::assertTrue((new RevolutListTransactions($service))->execute([
            'account_id' => 'account-id',
            'from' => '2026-01-01T00:00:00Z',
            'to' => '2026-01-31T00:00:00Z',
            'count' => 25,
            'type' => 'card_payment',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://sandbox-b2b.revolut.com/api/1.0/transactions?')
            && str_contains($request->url(), 'account=account-id')
            && str_contains($request->url(), 'from=2026-01-01T00%3A00%3A00Z')
            && str_contains($request->url(), 'to=2026-01-31T00%3A00%3A00Z')
            && str_contains($request->url(), 'count=25')
            && str_contains($request->url(), 'type=card_payment'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'tx-id'], 200)]);
        self::assertTrue((new RevolutGetTransaction($service))->execute(['id' => 'request-id', 'id_type' => 'request_id'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/transaction/request-id?id_type=request_id');
    }

    public function test_card_team_sensitive_and_unsupported_surfaces(): void
    {
        $service = new RevolutService('revolut-token', 'https://sandbox-b2b.revolut.com/api/1.0');

        Http::fake(['*' => Http::response([['id' => 'card-id', 'state' => 'active']], 200)]);
        self::assertTrue((new RevolutListCards($service))->execute(['limit' => 500, 'created_before' => '2026-01-31T00:00:00Z'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://sandbox-b2b.revolut.com/api/1.0/cards?')
            && str_contains($request->url(), 'limit=100')
            && str_contains($request->url(), 'created_before=2026-01-31T00%3A00%3A00Z'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['pan' => '4111111111111111'], 200)]);
        self::assertTrue((new RevolutGetSensitiveCardDetails($service))->execute(['card_id' => 'card-id'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/cards/card-id/sensitive-details');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 'member-id']], 200)]);
        self::assertTrue((new RevolutListTeamMembers($service))->execute(['limit' => 1001])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/team-members?limit=1000');

        $unsupported = (new RevolutGetCurrentUser($service))->execute([]);
        self::assertFalse($unsupported->succeeded());
        self::assertStringContainsString('does not expose a current-user endpoint', (string) $unsupported->error);
    }

    public function test_connection_multi_account_and_service_provider_registration(): void
    {
        Http::fake(['sandbox-b2b.revolut.com/api/1.0/accounts' => Http::response([['id' => 'account-id']], 200)]);
        $connection = (new RevolutToolProvider)->testConnection([
            'access_token' => 'revolut-token',
            'url' => 'https://sandbox-b2b.revolut.com/api/1.0',
        ]);
        self::assertTrue($connection['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox-b2b.revolut.com/api/1.0/accounts'
            && $request->hasHeader('Authorization', 'Bearer revolut-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 'account-id']], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['revolut', 'access_token', 'business'] => 'account-token',
                    ['revolut', 'url', 'business'] => 'https://account-revolut.example.test/api/1.0',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'revolut' && $account === 'business';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'revolut' ? ['business'] : [];
            }
        });

        $tool = (new RevolutToolProvider)->createTool(RevolutListAccounts::class, ['account' => 'business']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-revolut.example.test/api/1.0/accounts'
            && $request->hasHeader('Authorization', 'Bearer account-token'));

        $registry = new ToolProviderRegistry;
        app()->instance(ToolProviderRegistry::class, $registry);
        (new RevolutServiceProvider(app()))->boot();
        self::assertTrue($registry->has('revolut'));
        self::assertInstanceOf(RevolutToolProvider::class, $registry->get('revolut'));
    }
}
