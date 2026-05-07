<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Akismet;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Akismet\AkismetService;
use OpenCompany\Integrations\Akismet\AkismetToolProvider;
use OpenCompany\Integrations\Akismet\Tools\AkismetCommentCheck;
use OpenCompany\Integrations\Akismet\Tools\AkismetKeySites;
use OpenCompany\Integrations\Akismet\Tools\AkismetSubmitHam;
use OpenCompany\Integrations\Akismet\Tools\AkismetSubmitSpam;
use OpenCompany\Integrations\Akismet\Tools\AkismetUsageLimit;
use OpenCompany\Integrations\Akismet\Tools\AkismetVerifyKey;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Akismet integration.
 */
final class AkismetServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(AkismetService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(AkismetService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new AkismetToolProvider;

        self::assertSame('akismet', $provider->appName());
        self::assertSame('Akismet', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('api_key', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertCount(2, $provider->credentialFields());
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame([
            'akismet_verify_key',
            'akismet_comment_check',
            'akismet_submit_spam',
            'akismet_submit_ham',
            'akismet_key_sites',
            'akismet_usage_limit',
        ], array_keys($provider->tools()));
    }

    public function test_verify_key_and_comment_check_parse_text_headers(): void
    {
        $service = new AkismetService(apiKey: 'test-key', blog: 'https://example.test', baseUrl: 'https://akismet.example.test');

        Http::fake(['*' => Http::response('valid', 200, ['X-akismet-debug-help' => 'ok'])]);
        $verify = (new AkismetVerifyKey($service))->execute([]);
        self::assertTrue($verify->succeeded());
        self::assertTrue($verify->data['valid']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.1/verify-key'
            && $request->data()['api_key'] === 'test-key'
            && $request->data()['blog'] === 'https://example.test');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('true', 200, ['X-akismet-pro-tip' => 'discard', 'X-akismet-recheck-after' => '900'])]);
        $check = (new AkismetCommentCheck($service))->execute([
            'user_ip' => '198.51.100.10',
            'user_agent' => 'Mozilla/5.0',
            'comment_type' => 'contact-form',
            'comment_author_email' => 'user@example.test',
            'comment_content' => 'fake content',
            'comment_context' => ['support', 'sales'],
            'is_test' => true,
        ]);

        self::assertTrue($check->succeeded());
        self::assertTrue($check->data['spam']);
        self::assertSame('discard', $check->data['pro_tip']);
        self::assertSame('900', $check->data['recheck_after']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.1/comment-check'
            && $request->data()['user_ip'] === '198.51.100.10'
            && $request->data()['comment_context[0]'] === 'support'
            && $request->data()['comment_context[1]'] === 'sales');
    }

    public function test_submit_spam_submit_ham_key_sites_and_usage_paths_are_mapped(): void
    {
        $service = new AkismetService(apiKey: 'test-key', blog: 'https://example.test', baseUrl: 'https://akismet.example.test');

        Http::fake(['*' => Http::response('Thanks for making the web a better place.', 200)]);
        self::assertTrue((new AkismetSubmitSpam($service))->execute(['user_ip' => '198.51.100.10', 'comment_content' => 'fake spam'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.1/submit-spam'
            && $request->data()['comment_content'] === 'fake spam');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('Thanks for making the web a better place.', 200)]);
        self::assertTrue((new AkismetSubmitHam($service))->execute(['user_ip' => '198.51.100.10', 'comment_content' => 'fake ham'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.1/submit-ham'
            && $request->data()['comment_content'] === 'fake ham');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['2026-05' => [['site' => 'example.test', 'api_calls' => '10']], 'limit' => 10, 'offset' => 0, 'total' => 1], 200)]);
        self::assertTrue((new AkismetKeySites($service))->execute(['month' => '2026-05', 'order' => 'spam', 'limit' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.2/key-sites'
            && $request->data()['api_key'] === 'test-key'
            && $request->data()['month'] === '2026-05'
            && $request->data()['order'] === 'spam');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['limit' => 350000, 'usage' => 12, 'percentage' => '0.01', 'throttled' => false], 200)]);
        self::assertTrue((new AkismetUsageLimit($service))->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://akismet.example.test/1.2/usage-limit'
            && $request->data()['api_key'] === 'test-key');
    }

    public function test_csv_key_sites_validation_and_api_errors_are_reported(): void
    {
        $service = new AkismetService(apiKey: 'test-key', blog: 'https://example.test', baseUrl: 'https://akismet.example.test');

        Http::fake(['*' => Http::response("Site,Total API Calls\nexample.test,10\n", 200)]);
        $csv = (new AkismetKeySites($service))->execute(['format' => 'csv']);
        self::assertTrue($csv->succeeded());
        self::assertStringContainsString('example.test', $csv->data['body']);

        $missing = (new AkismetCommentCheck($service))->execute([]);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('user_ip is required', (string) $missing->error);

        $unconfigured = new AkismetService(apiKey: '', blog: '', baseUrl: 'https://akismet.example.test');
        $missingConfig = (new AkismetVerifyKey($unconfigured))->execute([]);
        self::assertFalse($missingConfig->succeeded());
        self::assertStringContainsString('blog is required', (string) $missingConfig->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('invalid', 500, ['X-akismet-debug-help' => 'bad key'])]);
        $apiError = (new AkismetUsageLimit($service))->execute([]);
        self::assertFalse($apiError->succeeded());
        self::assertStringContainsString('bad key', (string) $apiError->error);
    }

    public function test_provider_test_connection_and_multi_account_credentials(): void
    {
        Http::fake(['*' => Http::response('valid', 200)]);
        self::assertSame(['success' => true, 'message' => 'Akismet API key accepted.'], (new AkismetToolProvider)->testConnection(['api_key' => 'test-key', 'blog' => 'https://example.test']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('valid', 200)]);

        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'akismet' && $account === 'site-a') {
                    return $key === 'api_key' ? 'account-key' : 'https://account.example.test';
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'akismet' && $account === 'site-a';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'akismet' ? ['site-a'] : [];
            }
        });

        $tool = (new AkismetToolProvider)->createTool(AkismetVerifyKey::class, ['account' => 'site-a']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->data()['api_key'] === 'account-key'
            && $request->data()['blog'] === 'https://account.example.test');
    }
}
