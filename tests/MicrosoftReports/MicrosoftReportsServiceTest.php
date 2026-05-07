<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftReports;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftReports\MicrosoftReportsService;
use OpenCompany\Integrations\MicrosoftReports\MicrosoftReportsToolProvider;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsAuthenticationMethodsGetUserRegistrationDetails;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsAuthenticationMethodsListUserRegistrationDetails;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsAuthenticationMethodsUpdateUserRegistrationDetails;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsGetEmailActivityUserDetail6549;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsListMonthlyPrintUsageByPrinter;
use OpenCompany\Integrations\MicrosoftReports\Tools\MicrosoftReportsReportsSecurityGetAttackSimulationRepeatOffenders;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Reports integration.
 */
final class MicrosoftReportsServiceTest extends TestCase
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
        parent::tearDown();
    }

    public function test_provider_matches_openapi_manifest_and_docs(): void
    {
        $provider = new MicrosoftReportsToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-reports/microsoft-reports-openapi-manifest.json'), true);

        self::assertSame(187, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/reports', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Reports', $provider->integrationMeta()['name']);
        self::assertSame('analytics', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_reports_reports_authentication_methods_list_user_registration_details', array_keys($provider->tools()));
        self::assertContains('microsoft_reports_reports_authentication_methods_get_user_registration_details', array_keys($provider->tools()));
        self::assertContains('microsoft_reports_reports_get_email_activity_user_detail_6549', array_keys($provider->tools()));
        self::assertContains('microsoft_reports_reports_list_monthly_print_usage_by_printer', array_keys($provider->tools()));
        self::assertContains('microsoft_reports_reports_security_get_attack_simulation_repeat_offenders', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_report_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftReportsService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/reports/authenticationMethods/userRegistrationDetails/{userRegistrationDetails-id}', ['userRegistrationDetails-id' => 'user 1'], ['$select' => 'id,userPrincipalName']);
        $service->request(
            'PATCH',
            '/reports/authenticationMethods/userRegistrationDetails/{userRegistrationDetails-id}',
            ['userRegistrationDetails-id' => 'user 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['isMfaRegistered' => true],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/reports/authenticationMethods/userRegistrationDetails/user%201?%24select=id%2CuserPrincipalName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/reports/authenticationMethods/userRegistrationDetails/user%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['isMfaRegistered'] === true);
    }

    public function test_redirect_report_downloads_return_location(): void
    {
        Http::fake(['*' => Http::response('', 302, ['Location' => 'https://download.example.test/report.csv'])]);

        $result = (new MicrosoftReportsService('graph-token', 'https://graph.example.test/v1.0'))
            ->request('GET', "/reports/getEmailActivityUserDetail(period='{period}')", ['period' => 'D7']);

        self::assertSame(['success' => true, 'status' => 302, 'location' => 'https://download.example.test/report.csv'], $result);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === "https://graph.example.test/v1.0/reports/getEmailActivityUserDetail(period='D7')");
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftReportsService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftReportsReportsAuthenticationMethodsListUserRegistrationDetails($service))->execute(['top' => 5, 'select' => 'id,userPrincipalName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftReportsReportsAuthenticationMethodsGetUserRegistrationDetails($service))->execute(['user_registration_details_id' => 'registration-123', 'select' => 'id,userPrincipalName'])->succeeded());
        self::assertTrue((new MicrosoftReportsReportsAuthenticationMethodsUpdateUserRegistrationDetails($service))->execute(['user_registration_details_id' => 'registration-123', 'if_match' => 'W/"etag"', 'body' => ['isMfaRegistered' => true]])->succeeded());
        self::assertTrue((new MicrosoftReportsReportsGetEmailActivityUserDetail6549($service))->execute(['period' => 'D7'])->succeeded());
        self::assertTrue((new MicrosoftReportsReportsListMonthlyPrintUsageByPrinter($service))->execute(['top' => 2])->succeeded());
        self::assertTrue((new MicrosoftReportsReportsSecurityGetAttackSimulationRepeatOffenders($service))->execute(['top' => 3])->succeeded());

        $missingPath = (new MicrosoftReportsReportsAuthenticationMethodsGetUserRegistrationDetails($service))->execute([]);
        $badBody = (new MicrosoftReportsReportsAuthenticationMethodsUpdateUserRegistrationDetails($service))->execute(['user_registration_details_id' => 'registration-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftReportsReportsAuthenticationMethodsUpdateUserRegistrationDetails($service))->execute(['user_registration_details_id' => 'registration-123']);
        $unconfigured = (new MicrosoftReportsReportsAuthenticationMethodsGetUserRegistrationDetails(new MicrosoftReportsService('', 'https://graph.example.test/v1.0')))->execute(['user_registration_details_id' => 'registration-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('user_registration_details_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_accepts_success_or_redirect_probe(): void
    {
        Http::fake(['*' => Http::response('', 302, ['Location' => 'https://download.example.test/report.csv'])]);

        $result = (new MicrosoftReportsToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/reports/authenticationMethods/userRegistrationDetails?$top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            /** @var list<string> */
            public array $seenIntegrations = [];

            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $this->seenIntegrations[] = $integration;

                $values = [
                    'access_token' => $account === 'work' ? 'work-token' : 'default-token',
                    'base_url' => 'https://graph.example.test/v1.0',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $resolver = Container::getInstance()->make(CredentialResolver::class);
        $tool = (new MicrosoftReportsToolProvider)->createTool(MicrosoftReportsReportsAuthenticationMethodsGetUserRegistrationDetails::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['user_registration_details_id' => 'registration-123'])->succeeded());

        self::assertSame(['microsoft-reports', 'microsoft-reports'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
