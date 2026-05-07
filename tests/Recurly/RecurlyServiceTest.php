<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Recurly;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Recurly\RecurlyService;
use OpenCompany\Integrations\Recurly\RecurlyToolProvider;
use OpenCompany\Integrations\Recurly\Tools\RecurlyCreateAccount;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetAccount;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetCurrentUser;
use OpenCompany\Integrations\Recurly\Tools\RecurlyGetSubscription;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListAccounts;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListPlans;
use OpenCompany\Integrations\Recurly\Tools\RecurlyListSubscriptions;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Recurly integration.
 */
final class RecurlyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(RecurlyService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(RecurlyService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new RecurlyToolProvider;

        self::assertSame('recurly', $provider->appName());
        self::assertSame('Recurly', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('api_key', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame('https://recurly.com/developers/api/', $provider->integrationMeta()['docs_url']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(7, $provider->tools());
        self::assertContains('recurly_create_account', array_keys($provider->tools()));
    }

    public function test_account_subscription_plan_and_health_routes_are_mapped(): void
    {
        $service = new RecurlyService(apiKey: 'test-key');

        Http::fake(['*' => Http::response(['data' => [['id' => 'acc_123']]], 200)]);
        self::assertTrue((new RecurlyListAccounts($service))->execute(['limit' => 10, 'cursor' => 'cur_1', 'email' => 'ada@example.test', 'state' => 'active'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://v3.recurly.com/accounts?')
            && $request->hasHeader('Authorization', 'Bearer test-key')
            && $request->hasHeader('Accept', 'application/vnd.recurly.v2021-02-25')
            && str_contains($request->url(), 'limit=10')
            && str_contains($request->url(), 'cursor=cur_1')
            && str_contains($request->url(), 'email=ada%40example.test')
            && str_contains($request->url(), 'state=active'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'acc_123', 'code' => 'code-123'], 200)]);
        self::assertTrue((new RecurlyGetAccount($service))->execute(['id' => 'code-123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://v3.recurly.com/accounts/code-123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['id' => 'acc_456', 'code' => 'cust-001'], 201)]);
        self::assertTrue((new RecurlyCreateAccount($service))->execute([
            'code' => 'cust-001',
            'email' => 'ada@example.test',
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://v3.recurly.com/accounts'
            && $request['code'] === 'cust-001'
            && $request['email'] === 'ada@example.test'
            && $request['first_name'] === 'Ada'
            && $request['last_name'] === 'Lovelace');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['uuid' => 'sub_123']]], 200)]);
        self::assertTrue((new RecurlyListSubscriptions($service))->execute(['limit' => 20, 'cursor' => 'cur_2', 'account_id' => 'code-123', 'state' => 'active'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://v3.recurly.com/subscriptions?')
            && str_contains($request->url(), 'limit=20')
            && str_contains($request->url(), 'cursor=cur_2')
            && str_contains($request->url(), 'account_id=code-123')
            && str_contains($request->url(), 'state=active'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['uuid' => 'sub_123'], 200)]);
        self::assertTrue((new RecurlyGetSubscription($service))->execute(['id' => 'sub_123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://v3.recurly.com/subscriptions/sub_123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => [['id' => 'plan_123']]], 200)]);
        self::assertTrue((new RecurlyListPlans($service))->execute(['limit' => 5, 'cursor' => 'cur_3'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://v3.recurly.com/plans?')
            && str_contains($request->url(), 'limit=5')
            && str_contains($request->url(), 'cursor=cur_3'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertTrue((new RecurlyGetCurrentUser($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://v3.recurly.com/accounts?limit=1');
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new RecurlyService(apiKey: 'test-key');

        $missingAccount = (new RecurlyGetAccount($service))->execute([]);
        self::assertFalse($missingAccount->succeeded());
        self::assertStringContainsString('Account ID is required', (string) $missingAccount->error);

        $missingAccountCode = (new RecurlyCreateAccount($service))->execute([]);
        self::assertFalse($missingAccountCode->succeeded());
        self::assertStringContainsString('Account code is required', (string) $missingAccountCode->error);

        $missingSubscription = (new RecurlyGetSubscription($service))->execute([]);
        self::assertFalse($missingSubscription->succeeded());
        self::assertStringContainsString('Subscription ID is required', (string) $missingSubscription->error);

        $unconfigured = (new RecurlyListAccounts(new RecurlyService))->execute([]);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::fake(['*' => Http::response(['message' => 'Invalid API key'], 401)]);
        $apiError = (new RecurlyListAccounts($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('Invalid API key', (string) $apiError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Recurly API successfully.'], (new RecurlyToolProvider)->testConnection([
            'api_key' => 'test-key',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['recurly', 'api_key', 'billing'] => 'account-key',
                    ['recurly', 'subdomain', 'billing'] => 'account-site',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'recurly' && $account === 'billing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'recurly' ? ['billing'] : [];
            }
        });

        $tool = (new RecurlyToolProvider)->createTool(RecurlyGetCurrentUser::class, ['account' => 'billing']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://v3.recurly.com/accounts?limit=1'
            && $request->hasHeader('Authorization', 'Bearer account-key'));
    }
}
