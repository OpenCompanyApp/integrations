<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Paddle;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Paddle\PaddleService;
use OpenCompany\Integrations\Paddle\PaddleToolProvider;
use OpenCompany\Integrations\Paddle\Tools\PaddleCreateCustomer;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetCurrentUser;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetCustomer;
use OpenCompany\Integrations\Paddle\Tools\PaddleGetTransaction;
use OpenCompany\Integrations\Paddle\Tools\PaddleListCustomers;
use OpenCompany\Integrations\Paddle\Tools\PaddleListProducts;
use OpenCompany\Integrations\Paddle\Tools\PaddleListTransactions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Paddle integration.
 */
final class PaddleServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PaddleService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PaddleService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new PaddleToolProvider;

        self::assertSame('paddle', $provider->appName());
        self::assertSame('Paddle', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('access_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://developer.paddle.com/api-reference/overview', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertContains('paddle_create_customer', array_keys($provider->tools()));
    }

    public function test_transaction_customer_product_and_health_routes_are_mapped(): void
    {
        $service = new PaddleService(accessToken: 'test-token', baseUrl: 'https://paddle.example.test');

        Http::fake(['*' => Http::response(['data' => [['id' => 'txn_123']]], 200)]);
        self::assertTrue((new PaddleListTransactions($service))->execute([
            'limit' => 30,
            'after' => 'txn_001',
            'status' => 'completed',
            'customer_id' => 'ctm_123',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://paddle.example.test/transactions?')
            && $request->hasHeader('Authorization', 'Bearer test-token')
            && str_contains($request->url(), 'per_page=30')
            && str_contains($request->url(), 'after=txn_001')
            && str_contains($request->url(), 'status=completed')
            && str_contains($request->url(), 'customer_id=ctm_123'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'txn_123']], 200)]);
        self::assertTrue((new PaddleGetTransaction($service))->execute(['id' => 'txn_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paddle.example.test/transactions/txn_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'ctm_123']]], 200)]);
        self::assertTrue((new PaddleListCustomers($service))->execute(['limit' => 10, 'after' => 'ctm_001', 'email' => 'ada@example.test', 'name' => 'Ada'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://paddle.example.test/customers?')
            && str_contains($request->url(), 'per_page=10')
            && str_contains($request->url(), 'after=ctm_001')
            && str_contains($request->url(), 'email=ada%40example.test')
            && str_contains($request->url(), 'name=Ada'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'ctm_123']], 200)]);
        self::assertTrue((new PaddleGetCustomer($service))->execute(['id' => 'ctm_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paddle.example.test/customers/ctm_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => ['id' => 'ctm_456', 'email' => 'ada@example.test']], 201)]);
        self::assertTrue((new PaddleCreateCustomer($service))->execute(['email' => 'ada@example.test', 'name' => 'Ada Lovelace'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paddle.example.test/customers'
            && $request['email'] === 'ada@example.test'
            && $request['name'] === 'Ada Lovelace');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'pro_123']]], 200)]);
        self::assertTrue((new PaddleListProducts($service))->execute(['limit' => 20, 'after' => 'pro_001', 'status' => 'active'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://paddle.example.test/products?')
            && str_contains($request->url(), 'per_page=20')
            && str_contains($request->url(), 'after=pro_001')
            && str_contains($request->url(), 'status=active'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'txn_123']]], 200)]);
        $health = (new PaddleGetCurrentUser($service))->execute([]);
        self::assertTrue($health->succeeded());
        self::assertTrue($health->data['connected']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paddle.example.test/transactions?per_page=1');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new PaddleService(accessToken: 'test-token', baseUrl: 'https://paddle.example.test');

        $missingTransaction = (new PaddleGetTransaction($service))->execute([]);
        self::assertFalse($missingTransaction->succeeded());
        self::assertStringContainsString('Transaction ID is required', (string) $missingTransaction->error);

        $missingCustomer = (new PaddleGetCustomer($service))->execute([]);
        self::assertFalse($missingCustomer->succeeded());
        self::assertStringContainsString('Customer ID is required', (string) $missingCustomer->error);

        $missingEmail = (new PaddleCreateCustomer($service))->execute([]);
        self::assertFalse($missingEmail->succeeded());
        self::assertStringContainsString('Email is required', (string) $missingEmail->error);

        $unconfigured = (new PaddleListTransactions(new PaddleService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['error' => ['detail' => 'Invalid API key']], 401)]);
        $apiError = (new PaddleListTransactions($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Paddle API at https://paddle.example.test.'], (new PaddleToolProvider)->testConnection([
            'access_token' => 'test-token',
            'url' => 'https://paddle.example.test',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['error' => ['message' => 'Authentication failed']], 401)]);
        self::assertSame(['success' => false, 'error' => 'Authentication failed'], (new PaddleToolProvider)->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://paddle.example.test',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'txn_123']]], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['paddle', 'access_token', 'billing'] => 'account-token',
                    ['paddle', 'url', 'billing'] => 'https://paddle.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'paddle' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'paddle' ? ['billing'] : [];
            }
        });

        $tool = (new PaddleToolProvider)->createTool(PaddleGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://paddle.example.test/transactions?per_page=1'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
