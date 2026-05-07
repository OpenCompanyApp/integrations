<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Venmo;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Venmo\Tools\VenmoCreatePayment;
use OpenCompany\Integrations\Venmo\Tools\VenmoGetCurrentUser;
use OpenCompany\Integrations\Venmo\Tools\VenmoListPayments;
use OpenCompany\Integrations\Venmo\Tools\VenmoListTransactions;
use OpenCompany\Integrations\Venmo\Tools\VenmoListUsers;
use OpenCompany\Integrations\Venmo\VenmoService;
use OpenCompany\Integrations\Venmo\VenmoServiceProvider;
use OpenCompany\Integrations\Venmo\VenmoToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the legacy Venmo Developer API integration.
 */
final class VenmoServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(VenmoService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(VenmoService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
        parent::tearDown();
    }

    public function test_provider_metadata_marks_venmo_as_legacy_retired_access(): void
    {
        $provider = new VenmoToolProvider;

        self::assertSame('venmo', $provider->appName());
        self::assertSame('Venmo', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('legacy', $provider->integrationMeta()['badge']);
        self::assertSame('https://venmo.com/docs/webhooks', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertStringContainsString('retired for new businesses', implode(' ', $provider->integrationCapabilities()['auth']['notes']));
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertCount(1, $provider->credentialFields());
    }

    public function test_legacy_service_routes_and_bearer_auth_are_preserved_for_grandfathered_accounts(): void
    {
        $service = new VenmoService('venmo-token');

        Http::fake(['*' => Http::response(['data' => [['id' => 'payment-id']], 'paging' => []], 200)]);
        self::assertTrue((new VenmoListPayments($service))->execute(['limit' => 10, 'offset' => 20])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://api.venmo.com/v1/payments?limit=10&offset=20'
            && $request->hasHeader('Authorization', 'Bearer venmo-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'user-id']]], 200)]);
        self::assertTrue((new VenmoListUsers($service))->execute(['query' => 'buyer@example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.venmo.com/v1/users?query=buyer%40example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'transaction-id']]], 200)]);
        self::assertTrue((new VenmoListTransactions($service))->execute(['action' => 'pay'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.venmo.com/v1/transactions?action=pay');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'payment-id', 'status' => 'pending']], 200)]);
        self::assertTrue((new VenmoCreatePayment($service))->execute([
            'amount' => 25.50,
            'user_id' => 'user-id',
            'note' => 'Dinner',
            'audience' => 'private',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://api.venmo.com/v1/payments'
            && $request['amount'] === 25.50
            && $request['user_id'] === 'user-id'
            && $request['note'] === 'Dinner'
            && $request['audience'] === 'private');
    }

    public function test_connection_validation_multi_account_and_service_provider_registration(): void
    {
        $unconfigured = (new VenmoGetCurrentUser(new VenmoService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['api.venmo.com/v1/me' => Http::response(['data' => ['user' => ['username' => 'legacy_user']]], 200)]);
        $connection = (new VenmoToolProvider)->testConnection(['access_token' => 'venmo-token']);
        self::assertTrue($connection['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.venmo.com/v1/me'
            && $request->hasHeader('Authorization', 'Bearer venmo-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'payment-id']]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['venmo', 'access_token', 'legacy'] => 'account-token',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'venmo' && $account === 'legacy';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'venmo' ? ['legacy'] : [];
            }
        });

        $tool = (new VenmoToolProvider)->createTool(VenmoListPayments::class, ['account' => 'legacy']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer account-token'));

        $registry = new ToolProviderRegistry;
        app()->instance(ToolProviderRegistry::class, $registry);
        (new VenmoServiceProvider(app()))->boot();
        self::assertTrue($registry->has('venmo'));
        self::assertInstanceOf(VenmoToolProvider::class, $registry->get('venmo'));
    }
}
