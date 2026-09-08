<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoCrm;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ZohoCrm\Tools\ZohoCrmGetCurrentUser;
use OpenCompany\Integrations\ZohoCrm\ZohoCrmService;
use OpenCompany\Integrations\ZohoCrm\ZohoCrmToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho CRM integration.
 */
final class ZohoCrmServiceTest extends TestCase
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

    public function test_provider_uses_canonical_namespace_allowed_category_and_docs(): void
    {
        $provider = new ZohoCrmToolProvider;

        self::assertSame('zoho-crm', $provider->appName());
        self::assertSame('Zoho CRM', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertCount(15, $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_uses_zoho_oauth_header_and_v7_endpoint(): void
    {
        Http::fake([
            'https://www.zohoapis.com/crm/v7/Deals*' => Http::response([
                'data' => [['id' => 'deal-1']],
            ], 200),
        ]);

        $result = (new ZohoCrmService('token-test'))->listDeals(['page' => 2, 'per_page' => 25]);

        self::assertSame('deal-1', $result['data'][0]['id']);

        Http::assertSent(static function (Request $request): bool {
            parse_str((string) parse_url($request->url(), PHP_URL_QUERY), $query);

            return $request->method() === 'GET'
                && str_starts_with($request->url(), 'https://www.zohoapis.com/crm/v7/Deals?')
                && $query === ['page' => '2', 'per_page' => '25']
                && $request->hasHeader('Authorization', 'Zoho-oauthtoken token-test');
        });
    }

    public function test_named_account_falls_back_to_legacy_underscore_credentials(): void
    {
        Http::fake([
            'https://www.zohoapis.com/crm/v7/users/me' => Http::response([
                'users' => [['id' => 'user-1']],
            ], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'zoho-crm') {
                    return '';
                }

                if ($integration === 'zoho_crm' && $account === 'sales') {
                    return match ($key) {
                        'access_token' => 'legacy-token',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'zoho_crm' && $account === 'sales';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'zoho_crm' ? ['sales'] : [];
            }
        });

        $tool = (new ZohoCrmToolProvider)->createTool(ZohoCrmGetCurrentUser::class, ['account' => 'sales']);
        $result = $tool->execute([]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://www.zohoapis.com/crm/v7/users/me'
            && $request->hasHeader('Authorization', 'Zoho-oauthtoken legacy-token'));
    }
}
