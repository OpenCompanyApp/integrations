<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\HaveIBeenPwned;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\HaveIBeenPwned\HaveIBeenPwnedService;
use OpenCompany\Integrations\HaveIBeenPwned\HaveIBeenPwnedToolProvider;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachedAccount;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreachedDomain;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedBreaches;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedGenerateDnsToken;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedPasteAccount;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedPwnedPasswordRange;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSendDomainVerificationEmail;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedStealerLogsByEmail;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSubscribedDomains;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedSubscriptionStatus;
use OpenCompany\Integrations\HaveIBeenPwned\Tools\HaveIBeenPwnedVerifyDnsToken;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Have I Been Pwned API integration.
 */
final class HaveIBeenPwnedServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(HaveIBeenPwnedService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(HaveIBeenPwnedService::class);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new HaveIBeenPwnedToolProvider;

        self::assertSame('have-i-been-pwned', $provider->appName());
        self::assertSame('Have I Been Pwned', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFalse($provider->credentialFields()[0]['required']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame([
            'hibp_breached_account',
            'hibp_breached_account_range',
            'hibp_breaches',
            'hibp_breach_by_name',
            'hibp_latest_breach',
            'hibp_data_classes',
            'hibp_paste_account',
            'hibp_breached_domain',
            'hibp_subscribed_domains',
            'hibp_generate_dns_token',
            'hibp_verify_dns_token',
            'hibp_send_domain_verification_email',
            'hibp_stealer_logs_by_email',
            'hibp_stealer_logs_by_website_domain',
            'hibp_stealer_logs_by_email_domain',
            'hibp_subscription_status',
            'hibp_pwned_password_range',
        ], array_keys($provider->tools()));
    }

    public function test_public_breach_catalogue_and_password_range_are_mapped(): void
    {
        $service = new HaveIBeenPwnedService(baseUrl: 'https://hibp.example.test/api/v3', passwordsBaseUrl: 'https://passwords.example.test');

        Http::fake(['https://hibp.example.test/*' => Http::response([
            ['Name' => 'ExampleBreach', 'Domain' => 'example.test', 'PwnCount' => 42],
        ], 200)]);

        $breaches = (new HaveIBeenPwnedBreaches($service))->execute(['domain' => 'example.test', 'is_spam_list' => false]);
        self::assertTrue($breaches->succeeded());
        self::assertSame('ExampleBreach', $breaches->data[0]['Name']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://hibp.example.test/api/v3/breaches')
            && str_contains($request->url(), 'Domain=example.test')
            && str_contains($request->url(), 'IsSpamList=false')
            && $request->hasHeader('User-Agent'));

        Http::swap(new HttpFactory);
        Http::fake(['https://passwords.example.test/*' => Http::response("0018A45C4D1DEF81644B54AB7F969B88D65:3\r\nABCDE000000000000000000000000000000:0", 200)]);
        $range = (new HaveIBeenPwnedPwnedPasswordRange($service))->execute(['prefix' => '21bd1', 'mode' => 'ntlm']);
        self::assertTrue($range->succeeded());
        self::assertSame('21BD1', $range->data['prefix']);
        self::assertSame('ntlm', $range->data['mode']);
        self::assertSame(3, $range->data['matches'][0]['count']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://passwords.example.test/range/21BD1')
            && str_contains($request->url(), 'mode=ntlm')
            && $request->hasHeader('Add-Padding', 'true'));
    }

    public function test_protected_account_paste_domain_and_stealer_endpoints_require_and_send_api_key(): void
    {
        $missing = (new HaveIBeenPwnedBreachedAccount(new HaveIBeenPwnedService(baseUrl: 'https://hibp.example.test/api/v3')))->execute([
            'account' => 'person@example.test',
        ]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('API key is required', (string) $missing->error);

        $service = new HaveIBeenPwnedService(apiKey: 'key-test', baseUrl: 'https://hibp.example.test/api/v3');

        Http::fake(['*' => Http::response([['Name' => 'ExampleBreach']], 200)]);
        $account = (new HaveIBeenPwnedBreachedAccount($service))->execute([
            'account' => 'person@example.test',
            'truncate_response' => false,
            'include_unverified' => false,
        ]);
        self::assertTrue($account->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://hibp.example.test/api/v3/breachedAccount/person%40example.test')
            && str_contains($request->url(), 'truncateResponse=false')
            && str_contains($request->url(), 'IncludeUnverified=false')
            && $request->hasHeader('hibp-api-key', 'key-test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 404)]);
        self::assertSame([], (new HaveIBeenPwnedPasteAccount($service))->execute(['account' => 'none@example.test'])->data);
        self::assertSame([], (new HaveIBeenPwnedBreachedDomain($service))->execute(['domain' => 'example.test'])->data);
        self::assertSame([], (new HaveIBeenPwnedStealerLogsByEmail($service))->execute(['email' => 'none@example.test'])->data);
    }

    public function test_domain_verification_and_subscription_paths_are_mapped(): void
    {
        $service = new HaveIBeenPwnedService(apiKey: 'key-test', baseUrl: 'https://hibp.example.test/api/v3');

        Http::fake(['*' => Http::response(['token' => 'hibp-domain-token'], 200)]);
        $token = (new HaveIBeenPwnedGenerateDnsToken($service))->execute(['domain' => 'example.test']);
        self::assertTrue($token->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://hibp.example.test/api/v3/domainVerification/generateDnsToken'
            && $request->data() === ['DomainName' => 'example.test']
            && $request->hasHeader('hibp-api-key', 'key-test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 200], 200)]);
        self::assertTrue((new HaveIBeenPwnedVerifyDnsToken($service))->execute(['domain' => 'example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hibp.example.test/api/v3/domainVerification/verifyDnsToken'
            && $request->data() === ['DomainName' => 'example.test']);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['status' => 200], 200)]);
        self::assertTrue((new HaveIBeenPwnedSendDomainVerificationEmail($service))->execute(['domain' => 'example.test', 'email_alias' => 'security'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hibp.example.test/api/v3/domainVerification/sendEmail'
            && $request->data() === ['DomainName' => 'example.test', 'EmailAlias' => 'security']);

        $badAlias = (new HaveIBeenPwnedSendDomainVerificationEmail($service))->execute(['domain' => 'example.test', 'email_alias' => 'hello']);
        self::assertFalse($badAlias->succeeded());
        self::assertStringContainsString('email_alias must be one of', (string) $badAlias->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([['DomainName' => 'example.test']], 200)]);
        self::assertTrue((new HaveIBeenPwnedSubscribedDomains($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hibp.example.test/api/v3/subscribedDomains');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['SubscriptionName' => 'Pwned 1'], 200)]);
        self::assertTrue((new HaveIBeenPwnedSubscriptionStatus($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://hibp.example.test/api/v3/subscription/status');
    }

    public function test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response(['Name' => 'Latest'], 200)]);

        $provider = new HaveIBeenPwnedToolProvider;
        $anonymous = $provider->testConnection([]);
        self::assertTrue($anonymous['success']);
        self::assertStringContainsString('public API is reachable', (string) $anonymous['message']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://haveibeenpwned.com/api/v3/latestbreach'
            && !$request->hasHeader('hibp-api-key'));

        $withKey = $provider->testConnection(['api_key' => 'key-test']);
        self::assertTrue($withKey['success']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://haveibeenpwned.com/api/v3/subscription/status'
            && $request->hasHeader('hibp-api-key', 'key-test'));

        $resolver = new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return [$integration, $key, $account] === ['have-i-been-pwned', 'api_key', 'acct_1'] ? 'key-account' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'have-i-been-pwned' && $account === 'acct_1';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'have-i-been-pwned' ? ['acct_1'] : [];
            }
        };

        Container::getInstance()->instance(CredentialResolver::class, $resolver);
        $tool = $provider->createTool(HaveIBeenPwnedSubscriptionStatus::class, ['account' => 'acct_1']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://haveibeenpwned.com/api/v3/subscription/status'
            && $request->hasHeader('hibp-api-key', 'key-account'));
    }
}
