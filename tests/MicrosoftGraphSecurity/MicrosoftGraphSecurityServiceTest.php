<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftGraphSecurity;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftGraphSecurity\MicrosoftGraphSecurityService;
use OpenCompany\Integrations\MicrosoftGraphSecurity\MicrosoftGraphSecurityToolProvider;
use OpenCompany\Integrations\MicrosoftGraphSecurity\Tools\MicrosoftGraphSecurityGetAlertsV2;
use OpenCompany\Integrations\MicrosoftGraphSecurity\Tools\MicrosoftGraphSecurityListAlertsV2;
use OpenCompany\Integrations\MicrosoftGraphSecurity\Tools\MicrosoftGraphSecurityListIncidents;
use OpenCompany\Integrations\MicrosoftGraphSecurity\Tools\MicrosoftGraphSecurityUpdateAlertsV2;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Graph Security integration.
 */
final class MicrosoftGraphSecurityServiceTest extends TestCase
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
        $provider = new MicrosoftGraphSecurityToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-graph-security/microsoft-graph-security-openapi-manifest.json'), true);

        self::assertSame(606, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertSame(['/security'], $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Graph Security', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertContains('microsoft_graph_security_list_alerts_v2', array_keys($provider->tools()));
        self::assertContains('microsoft_graph_security_list_incidents', array_keys($provider->tools()));
        self::assertContains('microsoft_graph_security_list_secure_scores', array_keys($provider->tools()));
        self::assertContains('microsoft_graph_security_threat_intelligence_list_hosts', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_query_headers_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftGraphSecurityService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/security/alerts_v2/{alert-id}', ['alert-id' => 'alert 1'], ['$select' => 'id,title,severity', '$count' => true], ['ConsistencyLevel' => 'eventual']);
        $service->request('PATCH', '/security/alerts_v2/{alert-id}', ['alert-id' => 'alert 1'], [], [], ['status' => 'resolved']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/security/alerts_v2/alert%201?%24select=id%2Ctitle%2Cseverity&%24count=true'
            && $request->hasHeader('Authorization', 'Bearer graph-token')
            && $request->hasHeader('ConsistencyLevel', 'eventual'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/security/alerts_v2/alert%201'
            && $request->data()['status'] === 'resolved');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftGraphSecurityService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftGraphSecurityListAlertsV2($service))->execute(['top' => 5])->succeeded());
        self::assertTrue((new MicrosoftGraphSecurityGetAlertsV2($service))->execute(['alert_id' => 'alert-123', 'select' => 'id,title'])->succeeded());
        self::assertTrue((new MicrosoftGraphSecurityUpdateAlertsV2($service))->execute(['alert_id' => 'alert-123', 'body' => ['status' => 'resolved']])->succeeded());
        self::assertTrue((new MicrosoftGraphSecurityListIncidents($service))->execute(['filter' => "status ne 'resolved'"])->succeeded());

        $missingPath = (new MicrosoftGraphSecurityGetAlertsV2($service))->execute([]);
        $badBody = (new MicrosoftGraphSecurityUpdateAlertsV2($service))->execute(['alert_id' => 'alert-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftGraphSecurityUpdateAlertsV2($service))->execute(['alert_id' => 'alert-123']);
        $unconfigured = (new MicrosoftGraphSecurityGetAlertsV2(new MicrosoftGraphSecurityService('', 'https://graph.example.test/v1.0')))->execute(['alert_id' => 'alert-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('alert_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_alerts_probe(): void
    {
        Http::fake(['graph.example.test/v1.0/security/alerts_v2*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftGraphSecurityToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/security/alerts_v2?%24top=1'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));
    }

    public function test_create_tool_resolves_account_specific_credentials(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
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

        $tool = (new MicrosoftGraphSecurityToolProvider)->createTool(MicrosoftGraphSecurityGetAlertsV2::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['alert_id' => 'alert-123'])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
