<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftPrint;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftPrint\MicrosoftPrintService;
use OpenCompany\Integrations\MicrosoftPrint\MicrosoftPrintToolProvider;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintGetPrinters;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintListPrinters;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintListShares;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintPrintersPrinterJobsPrintJobStart;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintSharesListJobs;
use OpenCompany\Integrations\MicrosoftPrint\Tools\MicrosoftPrintPrintUpdatePrinters;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the generated Microsoft Universal Print integration.
 */
final class MicrosoftPrintServiceTest extends TestCase
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
        $provider = new MicrosoftPrintToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__.'/../../packages/microsoft-print/microsoft-print-openapi-manifest.json'), true);

        self::assertSame(142, $manifest['method_count']);
        self::assertSame('v1.0', $manifest['version']);
        self::assertContains('/print', $manifest['path_prefixes']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Microsoft Universal Print', $provider->integrationMeta()['name']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertContains('microsoft_print_print_list_printers', array_keys($provider->tools()));
        self::assertContains('microsoft_print_print_get_printers', array_keys($provider->tools()));
        self::assertContains('microsoft_print_print_list_shares', array_keys($provider->tools()));
        self::assertContains('microsoft_print_print_shares_list_jobs', array_keys($provider->tools()));
        self::assertContains('microsoft_print_print_printers_printer_jobs_print_job_start', array_keys($provider->tools()));
    }

    public function test_service_maps_bearer_path_odata_print_headers_and_json_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPrintService('graph-token', 'https://graph.example.test/v1.0');
        $service->request('GET', '/print/printers/{printer-id}', ['printer-id' => 'printer 1'], ['$select' => 'id,displayName']);
        $service->request(
            'PATCH',
            '/print/printers/{printer-id}',
            ['printer-id' => 'printer 1'],
            [],
            ['If-Match' => 'W/"etag"', 'Prefer' => 'return=representation', 'ConsistencyLevel' => 'eventual'],
            ['displayName' => 'Updated Printer'],
        );

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/print/printers/printer%201?%24select=id%2CdisplayName'
            && $request->hasHeader('Authorization', 'Bearer graph-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://graph.example.test/v1.0/print/printers/printer%201'
            && $request->hasHeader('If-Match', 'W/"etag"')
            && $request->hasHeader('Prefer', 'return=representation')
            && $request->hasHeader('ConsistencyLevel', 'eventual')
            && $request->data()['displayName'] === 'Updated Printer');
    }

    public function test_tools_validate_and_map_parameters(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new MicrosoftPrintService('graph-token', 'https://graph.example.test/v1.0');

        self::assertTrue((new MicrosoftPrintPrintListPrinters($service))->execute(['top' => 5, 'select' => 'id,displayName', 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftPrintPrintGetPrinters($service))->execute(['printer_id' => 'printer-123', 'select' => 'id,displayName'])->succeeded());
        self::assertTrue((new MicrosoftPrintPrintUpdatePrinters($service))->execute(['printer_id' => 'printer-123', 'if_match' => 'W/"etag"', 'body' => ['displayName' => 'Updated']])->succeeded());
        self::assertTrue((new MicrosoftPrintPrintListShares($service))->execute(['filter' => "startswith(displayName,'Floor')", 'count' => true, 'consistency_level' => 'eventual'])->succeeded());
        self::assertTrue((new MicrosoftPrintPrintSharesListJobs($service))->execute(['printer_share_id' => 'share-123', 'top' => 2])->succeeded());
        self::assertTrue((new MicrosoftPrintPrintPrintersPrinterJobsPrintJobStart($service))->execute(['printer_id' => 'printer-123', 'print_job_id' => 'job-123'])->succeeded());

        $missingPath = (new MicrosoftPrintPrintGetPrinters($service))->execute([]);
        $badBody = (new MicrosoftPrintPrintUpdatePrinters($service))->execute(['printer_id' => 'printer-123', 'body' => 'not-object']);
        $missingBody = (new MicrosoftPrintPrintUpdatePrinters($service))->execute(['printer_id' => 'printer-123']);
        $unconfigured = (new MicrosoftPrintPrintGetPrinters(new MicrosoftPrintService('', 'https://graph.example.test/v1.0')))->execute(['printer_id' => 'printer-123']);

        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('printer_id must be a non-empty parameter', (string) $missingPath->error);
        self::assertFalse($badBody->succeeded());
        self::assertStringContainsString('body must be an object', (string) $badBody->error);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be a non-empty object', (string) $missingBody->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('access token is required', (string) $unconfigured->error);
    }

    public function test_connection_uses_printers_probe(): void
    {
        Http::fake(['*' => Http::response(['value' => []], 200)]);

        $result = (new MicrosoftPrintToolProvider)->testConnection([
            'access_token' => 'graph-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/print/printers?$top=1'
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
        $tool = (new MicrosoftPrintToolProvider)->createTool(MicrosoftPrintPrintGetPrinters::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['printer_id' => 'printer-123'])->succeeded());

        self::assertSame(['microsoft-print', 'microsoft-print'], $resolver->seenIntegrations);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer work-token'));
    }
}
