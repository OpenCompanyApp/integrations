<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Instantly;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Instantly\InstantlyService;
use OpenCompany\Integrations\Instantly\InstantlyToolProvider;
use OpenCompany\Integrations\Instantly\Tools\InstantlyCreateCampaign;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDeleteAllBlocklistEntries;
use OpenCompany\Integrations\Instantly\Tools\InstantlyDownloadBlocklistEntries;
use OpenCompany\Integrations\Instantly\Tools\InstantlyTestVitals;
use PHPUnit\Framework\TestCase;

final class InstantlyServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_registers_every_tool_file(): void
    {
        $toolFiles = glob(__DIR__.'/../../packages/instantly/src/Tools/Instantly*.php') ?: [];
        $toolFiles = array_filter($toolFiles, static fn (string $path): bool => basename($path) !== 'InstantlyGenericTool.php');

        $provider = new InstantlyToolProvider;

        self::assertCount(count($toolFiles), $provider->tools());
    }

    public function test_create_campaign_tool_returns_api_response_not_request_body(): void
    {
        Http::fake([
            'https://api.instantly.ai/api/v2/campaigns' => Http::response(['id' => 'campaign-1', 'name' => 'Demo'], 200),
        ]);

        $tool = new InstantlyCreateCampaign(new InstantlyService('token'));
        $result = $tool->execute(['name' => 'Demo']);

        self::assertTrue($result->succeeded());
        self::assertSame('campaign-1', $result->data['id']);
    }

    public function test_new_official_endpoint_mappings_are_covered(): void
    {
        Http::fake([
            '*' => Http::response(['status' => 'ok'], 200),
        ]);

        $service = new InstantlyService('token');
        $service->moveAccounts([
            'emails' => ['sender@example.test'],
            'source_workspace_id' => 'workspace-source',
            'destination_workspace_id' => 'workspace-destination',
        ]);
        $service->initializeGoogleOauth();
        $service->initializeMicrosoftOauth();
        $service->getOauthSessionStatus('session-1');
        $service->shareCampaign('campaign-1');
        $service->createCampaignFromExport('campaign-1');
        $service->exportCampaign('campaign-1');
        $service->addCampaignVariables('campaign-1', ['variables' => ['firstName']]);
        $service->sendTestEmail([
            'eaccount' => 'sender@example.test',
            'to_address_email_list' => 'recipient@example.test',
            'subject' => 'Preview',
            'body' => ['html' => '<p>Preview</p>'],
        ]);
        $service->updateLeadInterestStatus(['lead_email' => 'lead@example.test', 'interest_value' => 1]);
        $service->deleteAllBlocklistEntries(['search' => 'example.test']);
        $service->bulkCreateBlocklistEntries(['bl_values' => ['example.test']]);
        $service->bulkDeleteBlocklistEntries(['ids' => ['block-1']]);

        $expected = [
            ['POST', 'https://api.instantly.ai/api/v2/accounts/move'],
            ['POST', 'https://api.instantly.ai/api/v2/oauth/google/init'],
            ['POST', 'https://api.instantly.ai/api/v2/oauth/microsoft/init'],
            ['GET', 'https://api.instantly.ai/api/v2/oauth/session/status/session-1'],
            ['POST', 'https://api.instantly.ai/api/v2/campaigns/campaign-1/share'],
            ['POST', 'https://api.instantly.ai/api/v2/campaigns/campaign-1/from-export'],
            ['POST', 'https://api.instantly.ai/api/v2/campaigns/campaign-1/export'],
            ['POST', 'https://api.instantly.ai/api/v2/campaigns/campaign-1/variables'],
            ['POST', 'https://api.instantly.ai/api/v2/emails/test'],
            ['POST', 'https://api.instantly.ai/api/v2/leads/update-interest-status'],
            ['DELETE', 'https://api.instantly.ai/api/v2/block-lists-entries'],
            ['POST', 'https://api.instantly.ai/api/v2/block-lists-entries/bulk-create'],
            ['POST', 'https://api.instantly.ai/api/v2/block-lists-entries/bulk-delete'],
        ];

        foreach ($expected as [$method, $url]) {
            Http::assertSent(static fn (Request $request): bool => $request->method() === $method && $request->url() === $url);
        }
    }

    public function test_download_blocklist_entries_returns_csv_text(): void
    {
        Http::fake([
            'https://api.instantly.ai/api/v2/block-lists-entries/download*' => Http::response("Blocked Email,Date\nexample.test,2026-04-27T00:00:00Z", 200),
        ]);

        $tool = new InstantlyDownloadBlocklistEntries(new InstantlyService('token'));
        $result = $tool->execute(['search' => 'example.test']);

        self::assertTrue($result->succeeded());
        self::assertStringContainsString('Blocked Email,Date', $result->data);

        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'GET'
                && $request->url() === 'https://api.instantly.ai/api/v2/block-lists-entries/download?search=example.test';
        });
    }

    public function test_delete_all_blocklist_tool_requires_confirmation(): void
    {
        Http::fake(['*' => Http::response([], 200)]);

        $tool = new InstantlyDeleteAllBlocklistEntries(new InstantlyService('token'));
        $result = $tool->execute(['search' => 'example.test']);

        self::assertFalse($result->succeeded());
        self::assertSame('Set confirm=true to delete block list entries.', $result->error);
        Http::assertNothingSent();
    }

    public function test_test_vitals_uses_current_accounts_array_payload(): void
    {
        Http::fake([
            'https://api.instantly.ai/api/v2/accounts/test/vitals' => Http::response(['status' => 'success'], 200),
        ]);

        $tool = new InstantlyTestVitals(new InstantlyService('token'));
        $result = $tool->execute(['accounts' => ['sender@example.test']]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://api.instantly.ai/api/v2/accounts/test/vitals'
                && $request->data() === ['accounts' => ['sender@example.test']];
        });
    }

    public function test_analytics_aliases_are_normalized_to_current_query_names(): void
    {
        Http::fake([
            'https://api.instantly.ai/api/v2/campaigns/analytics*' => Http::response([], 200),
        ]);

        $service = new InstantlyService('token');
        $service->getAnalyticsCampaign([
            'campaign_id' => 'campaign-1',
            'from' => '2026-04-01',
            'to' => '2026-04-27',
        ]);

        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://api.instantly.ai/api/v2/campaigns/analytics?id=campaign-1&start_date=2026-04-01&end_date=2026-04-27';
        });
    }
}
