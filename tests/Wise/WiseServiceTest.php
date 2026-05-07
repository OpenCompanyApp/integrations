<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Wise;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Wise\Tools\WiseCreateTransfer;
use OpenCompany\Integrations\Wise\Tools\WiseGetCurrentUser;
use OpenCompany\Integrations\Wise\Tools\WiseGetProfile;
use OpenCompany\Integrations\Wise\Tools\WiseGetTransfer;
use OpenCompany\Integrations\Wise\Tools\WiseListBalances;
use OpenCompany\Integrations\Wise\Tools\WiseListProfiles;
use OpenCompany\Integrations\Wise\Tools\WiseListTransfers;
use OpenCompany\Integrations\Wise\WiseService;
use OpenCompany\Integrations\Wise\WiseToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Wise integration.
 */
final class WiseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(WiseService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(WiseService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new WiseToolProvider;

        self::assertSame('wise', $provider->appName());
        self::assertSame('Wise', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertCount(1, $provider->credentialFields());
        self::assertCount(2, $provider->configSchema());
    }

    public function test_routes_and_payloads_match_current_wise_api_shape(): void
    {
        $service = new WiseService('wise-token', 'https://api.wise-sandbox.com');

        Http::fake(['*' => Http::response([['id' => 123, 'type' => 'personal']], 200)]);
        self::assertTrue((new WiseListProfiles($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.wise-sandbox.com/v1/profiles'
            && $request->hasHeader('Authorization', 'Bearer wise-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 123], 200)]);
        self::assertTrue((new WiseGetProfile($service))->execute(['profile_id' => 123])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.wise-sandbox.com/v1/profiles/123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 456, 'currency' => 'EUR']], 200)]);
        self::assertTrue((new WiseListBalances($service))->execute(['profile_id' => 123, 'types' => 'STANDARD'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.wise-sandbox.com/v4/profiles/123/balances?types=STANDARD');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 789]], 200)]);
        self::assertTrue((new WiseListTransfers($service))->execute(['profile_id' => 123, 'status' => 'outgoing_payment_sent', 'limit' => 10, 'offset' => 20])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.wise-sandbox.com/v1/transfers?')
            && str_contains($request->url(), 'profile=123')
            && str_contains($request->url(), 'status=outgoing_payment_sent')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'offset=20'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 789], 200)]);
        self::assertTrue((new WiseGetTransfer($service))->execute(['transfer_id' => 789])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.wise-sandbox.com/v1/transfers/789');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 789], 200)]);
        self::assertTrue((new WiseCreateTransfer($service))->execute([
            'target_account' => 456,
            'quote_uuid' => '11111111-2222-3333-4444-555555555555',
            'customer_transaction_id' => 'aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee',
            'source_account' => 123,
            'reference' => 'Invoice 123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.wise-sandbox.com/v1/transfers'
            && $request['targetAccount'] === 456
            && $request['sourceAccount'] === 123
            && $request['quoteUuid'] === '11111111-2222-3333-4444-555555555555'
            && $request['customerTransactionId'] === 'aaaaaaaa-bbbb-cccc-dddd-eeeeeeeeeeee'
            && $request['details']['reference'] === 'Invoice 123');
    }

    public function test_validation_errors_test_connection_and_multi_account(): void
    {
        $service = new WiseService('wise-token', 'https://api.wise-sandbox.com');

        $missingTransfer = (new WiseCreateTransfer($service))->execute([]);
        self::assertFalse($missingTransfer->succeeded());
        self::assertStringContainsString('target_account', (string) $missingTransfer->error);

        $unconfigured = (new WiseGetCurrentUser(new WiseService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['firstName' => 'Ada', 'lastName' => 'Example'], 200)]);
        $connection = (new WiseToolProvider)->testConnection([
            'api_key' => 'wise-token',
            'url' => 'https://api.wise-sandbox.com',
        ]);
        self::assertTrue($connection['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.wise-sandbox.com/v1/me'
            && $request->hasHeader('Authorization', 'Bearer wise-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['id' => 123]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['wise', 'api_key', 'business'] => 'account-token',
                    ['wise', 'url', 'business'] => 'https://account-wise.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'wise' && $account === 'business';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'wise' ? ['business'] : [];
            }
        });

        $tool = (new WiseToolProvider)->createTool(WiseListProfiles::class, ['account' => 'business']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-wise.example.test/v1/profiles'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
