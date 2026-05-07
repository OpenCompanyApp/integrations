<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Plaid;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Support\ToolProviderRegistry;
use OpenCompany\Integrations\Plaid\PlaidService;
use OpenCompany\Integrations\Plaid\PlaidServiceProvider;
use OpenCompany\Integrations\Plaid\PlaidToolProvider;
use OpenCompany\Integrations\Plaid\Tools\PlaidGetRecipient;
use OpenCompany\Integrations\Plaid\Tools\PlaidTransactionsGet;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Plaid OpenAPI integration.
 */
final class PlaidServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PlaidService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PlaidService::class);
        app()->forgetInstance(CredentialResolver::class);
        app()->forgetInstance(ToolProviderRegistry::class);
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new PlaidToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/plaid/plaid-openapi-manifest.json'), true);

        self::assertSame(330, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Plaid', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('client_id', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertContains('secret', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertCount(2, $provider->credentialFields());
        self::assertCount(4, $provider->configSchema());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('plaid_transactions_get', array_keys($provider->tools()));
        self::assertContains('plaid_link_token_create', array_keys($provider->tools()));
        self::assertContains('plaid_get_recipient', array_keys($provider->tools()));
    }

    public function test_service_maps_headers_body_and_path_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new PlaidService('client-test', 'secret-test', '2020-09-14', 'https://sandbox.plaid.com');
        $service->request('POST', '/transactions/get', [], ['access_token' => 'access-test']);
        $service->request('GET', '/fdx/recipient/{recipientId}', ['recipientId' => 'recipient 1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://sandbox.plaid.com/transactions/get'
            && $request->hasHeader('PLAID-CLIENT-ID', 'client-test')
            && $request->hasHeader('PLAID-SECRET', 'secret-test')
            && $request->hasHeader('Plaid-Version', '2020-09-14')
            && $request['access_token'] === 'access-test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://sandbox.plaid.com/fdx/recipient/recipient%201');
    }

    public function test_tools_require_body_and_delegate_path_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new PlaidService('client-test', 'secret-test');
        $missingBody = (new PlaidTransactionsGet($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);

        $result = (new PlaidTransactionsGet($service))->execute(['body' => ['access_token' => 'access-test']]);
        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox.plaid.com/transactions/get' && $request['access_token'] === 'access-test');

        $missingPath = (new PlaidGetRecipient($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('recipientId must be', (string) $missingPath->error);

        $pathResult = (new PlaidGetRecipient($service))->execute(['recipientId' => 'recipient-1']);
        self::assertTrue($pathResult->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://sandbox.plaid.com/fdx/recipient/recipient-1');
    }

    public function test_connection_multi_account_and_service_provider_registration(): void
    {
        Http::fake(['plaid.example.test/categories/get' => Http::response(['categories' => []], 200)]);

        $connection = (new PlaidToolProvider)->testConnection([
            'client_id' => 'client-test',
            'secret' => 'secret-test',
            'plaid_version' => '2020-09-14',
            'url' => 'https://plaid.example.test',
        ]);

        self::assertTrue($connection['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://plaid.example.test/categories/get'
            && $request->hasHeader('PLAID-CLIENT-ID', 'client-test')
            && $request->hasHeader('PLAID-SECRET', 'secret-test')
            && $request->hasHeader('Plaid-Version', '2020-09-14'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['plaid', 'client_id', 'merchant'] => 'account-client',
                    ['plaid', 'secret', 'merchant'] => 'account-secret',
                    ['plaid', 'plaid_version', 'merchant'] => '2020-09-14',
                    ['plaid', 'url', 'merchant'] => 'https://account-plaid.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'plaid' && $account === 'merchant';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'plaid' ? ['merchant'] : [];
            }
        });

        $tool = (new PlaidToolProvider)->createTool(PlaidTransactionsGet::class, ['account' => 'merchant']);
        self::assertTrue($tool->execute(['body' => ['access_token' => 'access-test']])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://account-plaid.example.test/transactions/get'
            && $request->hasHeader('PLAID-CLIENT-ID', 'account-client')
            && $request->hasHeader('PLAID-SECRET', 'account-secret'));

        $registry = new ToolProviderRegistry;
        app()->instance(ToolProviderRegistry::class, $registry);
        (new PlaidServiceProvider(app()))->boot();

        self::assertTrue($registry->has('plaid'));
        self::assertInstanceOf(PlaidToolProvider::class, $registry->get('plaid'));
    }
}
