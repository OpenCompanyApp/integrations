<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\CisaKev;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\CisaKev\CisaKevService;
use OpenCompany\Integrations\CisaKev\CisaKevToolProvider;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevCatalog;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevCsv;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevGetVulnerability;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevLicense;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevRecent;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevSchema;
use OpenCompany\Integrations\CisaKev\Tools\CisaKevSearch;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the CISA KEV catalog integration.
 */
final class CisaKevServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(CisaKevService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(CisaKevService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new CisaKevToolProvider;

        self::assertSame('cisa-kev', $provider->appName());
        self::assertSame('CISA KEV', $provider->integrationMeta()['name']);
        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('none', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame([], $provider->credentialFields());
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertSame([
            'cisa_kev_catalog',
            'cisa_kev_search',
            'cisa_kev_get_vulnerability',
            'cisa_kev_recent',
            'cisa_kev_schema',
            'cisa_kev_csv',
            'cisa_kev_license',
        ], array_keys($provider->tools()));
    }

    public function test_catalog_search_get_and_recent_filter_the_official_json_feed(): void
    {
        $service = new CisaKevService(baseUrl: 'https://cisa.example.test');
        Http::fake(['*known_exploited_vulnerabilities.json' => Http::response($this->catalogFixture(), 200)]);

        $catalog = (new CisaKevCatalog($service))->execute([]);
        self::assertTrue($catalog->succeeded());
        self::assertSame('2026.05.06', $catalog->data['catalogVersion']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cisa.example.test/sites/default/files/feeds/known_exploited_vulnerabilities.json'
            && $request->hasHeader('User-Agent'));

        $search = (new CisaKevSearch($service))->execute([
            'vendor' => 'palo alto',
            'known_ransomware_campaign_use' => 'Unknown',
            'cwe' => 'CWE-787',
            'date_added_from' => '2026-05-01',
            'limit' => 10,
        ]);
        self::assertTrue($search->succeeded());
        self::assertSame(1, $search->data['total']);
        self::assertSame('CVE-2026-0300', $search->data['vulnerabilities'][0]['cveID']);

        $get = (new CisaKevGetVulnerability($service))->execute(['cve_id' => 'cve-2026-0300']);
        self::assertTrue($get->succeeded());
        self::assertSame('PAN-OS', $get->data['product']);

        $recent = (new CisaKevRecent($service))->execute(['since' => '2026-05-01', 'limit' => 2]);
        self::assertTrue($recent->succeeded());
        self::assertSame(['CVE-2026-0300', 'CVE-2026-31431'], array_column($recent->data['vulnerabilities'], 'cveID'));
    }

    public function test_schema_csv_and_license_assets_are_mapped(): void
    {
        $service = new CisaKevService(baseUrl: 'https://cisa.example.test');

        Http::fake(['*schema.json' => Http::response(['title' => 'CISA Catalog of Known Exploited Vulnerabilities'], 200)]);
        $schema = (new CisaKevSchema($service))->execute([]);
        self::assertTrue($schema->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cisa.example.test/sites/default/files/feeds/known_exploited_vulnerabilities_schema.json');

        Http::swap(new HttpFactory);
        Http::fake(['*known_exploited_vulnerabilities.csv' => Http::response("cveID,vendorProject\nCVE-2026-0300,Palo Alto Networks\n", 200)]);
        $csv = (new CisaKevCsv($service))->execute([]);
        self::assertTrue($csv->succeeded());
        self::assertStringContainsString('CVE-2026-0300', $csv->data['body']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cisa.example.test/sites/default/files/csv/known_exploited_vulnerabilities.csv');

        Http::swap(new HttpFactory);
        Http::fake(['*license.txt' => Http::response('Public domain license text', 200)]);
        $license = (new CisaKevLicense($service))->execute([]);
        self::assertTrue($license->succeeded());
        self::assertStringContainsString('Public domain', $license->data['body']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://cisa.example.test/sites/default/files/licenses/kev/license.txt');
    }

    public function test_not_found_and_feed_errors_are_reported(): void
    {
        $service = new CisaKevService(baseUrl: 'https://cisa.example.test');
        Http::fake(['*' => Http::response($this->catalogFixture(), 200)]);

        $missing = (new CisaKevGetVulnerability($service))->execute(['cve_id' => 'CVE-2099-0001']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('CVE not found', (string) $missing->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response('Temporarily unavailable', 503)]);
        $error = (new CisaKevCatalog($service))->execute([]);
        self::assertFalse($error->succeeded());
        self::assertStringContainsString('503', (string) $error->error);
    }

    public function test_provider_creates_tools_with_default_service(): void
    {
        Http::fake(['*' => Http::response($this->catalogFixture(), 200)]);

        app()->instance(CisaKevService::class, new CisaKevService(baseUrl: 'https://cisa.example.test'));
        $tool = (new CisaKevToolProvider)->createTool(CisaKevGetVulnerability::class);
        $result = $tool->execute(['cve_id' => 'CVE-2026-0300']);

        self::assertTrue($result->succeeded());
        self::assertSame('Palo Alto Networks', $result->data['vendorProject']);
    }

    /**
     * Return a fake but shape-accurate CISA KEV catalog fixture.
     *
     * @return array<string, mixed>
     */
    private function catalogFixture(): array
    {
        return [
            'title' => 'CISA Catalog of Known Exploited Vulnerabilities',
            'catalogVersion' => '2026.05.06',
            'dateReleased' => '2026-05-06T20:05:35.8538Z',
            'count' => 3,
            'vulnerabilities' => [
                [
                    'cveID' => 'CVE-2026-0300',
                    'vendorProject' => 'Palo Alto Networks',
                    'product' => 'PAN-OS',
                    'vulnerabilityName' => 'Palo Alto Networks PAN-OS Out-of-bounds Write Vulnerability',
                    'dateAdded' => '2026-05-06',
                    'shortDescription' => 'PAN-OS contains an out-of-bounds write vulnerability.',
                    'requiredAction' => 'Apply mitigations per vendor instructions.',
                    'dueDate' => '2026-05-09',
                    'knownRansomwareCampaignUse' => 'Unknown',
                    'notes' => 'https://example.test/advisory',
                    'cwes' => ['CWE-787'],
                ],
                [
                    'cveID' => 'CVE-2026-31431',
                    'vendorProject' => 'Linux',
                    'product' => 'Kernel',
                    'vulnerabilityName' => 'Linux Kernel Incorrect Resource Transfer Vulnerability',
                    'dateAdded' => '2026-05-01',
                    'shortDescription' => 'Linux Kernel contains an incorrect resource transfer vulnerability.',
                    'requiredAction' => 'Apply updates per vendor instructions.',
                    'dueDate' => '2026-05-22',
                    'knownRansomwareCampaignUse' => 'Known',
                    'notes' => 'https://example.test/linux',
                    'cwes' => ['CWE-669'],
                ],
                [
                    'cveID' => 'CVE-2025-1000',
                    'vendorProject' => 'Example Vendor',
                    'product' => 'Example Product',
                    'vulnerabilityName' => 'Example Product Vulnerability',
                    'dateAdded' => '2025-12-01',
                    'shortDescription' => 'Example description.',
                    'requiredAction' => 'Apply updates.',
                    'dueDate' => '2025-12-22',
                    'knownRansomwareCampaignUse' => 'Unknown',
                    'notes' => 'https://example.test/example',
                    'cwes' => ['CWE-79'],
                ],
            ],
        ];
    }
}
