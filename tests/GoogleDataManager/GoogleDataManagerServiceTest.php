<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleDataManager;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleDataManager\GoogleDataManagerService;
use OpenCompany\Integrations\GoogleDataManager\GoogleDataManagerToolProvider;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerIngestAudienceMembers;
use OpenCompany\Integrations\GoogleDataManager\Tools\GoogleDataManagerIngestEvents;
use PHPUnit\Framework\TestCase;

final class GoogleDataManagerServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_registers_every_declared_tool_file_and_docs(): void
    {
        $provider = new GoogleDataManagerToolProvider;

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], '\\') + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-data-manager/src/Tools/' . $shortName . '.php');
        }

        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertSame('oauth2', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertTrue($provider->integrationCapabilities()['host_availability']['cli']['setup_supported']);
    }

    public function test_audience_ingestion_requires_confirmation(): void
    {
        $tool = new GoogleDataManagerIngestAudienceMembers(new GoogleDataManagerService(accessToken: 'access-token'));

        $result = $tool->execute([
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'audience_members' => [['userData' => ['emailAddress' => 'person@example.test']]],
        ]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('confirm_execute=true is required', (string) $result->error);
    }

    public function test_audience_ingestion_posts_to_data_manager_endpoint(): void
    {
        Http::fake([
            'https://datamanager.googleapis.com/v1/audienceMembers:ingest' => Http::response(['requestId' => 'request-1'], 200),
        ]);

        $tool = new GoogleDataManagerIngestAudienceMembers(new GoogleDataManagerService(accessToken: 'access-token'));
        $result = $tool->execute([
            'confirm_execute' => true,
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'audience_members' => [['userData' => ['emailAddress' => 'person@example.test']]],
            'consent' => ['adUserData' => 'GRANTED'],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->method() === 'POST'
                && $request->url() === 'https://datamanager.googleapis.com/v1/audienceMembers:ingest'
                && $request->hasHeader('Authorization', 'Bearer access-token')
                && $request->data()['audienceMembers'][0]['userData']['emailAddress'] === 'person@example.test';
        });
    }

    public function test_event_ingestion_passes_encoding_and_enforces_event_limit(): void
    {
        Http::fake([
            'https://datamanager.googleapis.com/v1/events:ingest' => Http::response(['requestId' => 'request-1'], 200),
        ]);

        $tool = new GoogleDataManagerIngestEvents(new GoogleDataManagerService(accessToken: 'access-token'));
        $result = $tool->execute([
            'confirm_execute' => true,
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'events' => [['eventTimestamp' => '2026-06-01T10:00:00Z']],
            'encoding' => 'HEX',
            'encryption_info' => ['wrappedKey' => 'wrapped-key'],
        ]);

        self::assertTrue($result->succeeded());
        Http::assertSent(static function (Request $request): bool {
            return $request->url() === 'https://datamanager.googleapis.com/v1/events:ingest'
                && $request->data()['encoding'] === 'HEX'
                && $request->data()['encryptionInfo']['wrappedKey'] === 'wrapped-key';
        });

        $tooMany = array_fill(0, 2001, ['eventTimestamp' => '2026-06-01T10:00:00Z']);
        $result = $tool->execute([
            'confirm_execute' => true,
            'destinations' => [['operatingAccount' => ['product' => 'GOOGLE_ADS', 'accountId' => '1234567890']]],
            'events' => $tooMany,
        ]);

        self::assertFalse($result->succeeded());
        self::assertStringContainsString('at most 2,000 events', (string) $result->error);
    }

    public function test_refresh_token_only_cli_credentials_refresh_before_request(): void
    {
        Http::fake([
            'https://oauth2.googleapis.com/token' => Http::response([
                'access_token' => 'fresh-token',
                'expires_in' => 3600,
            ], 200),
            'https://datamanager.googleapis.com/v1/requestStatus:retrieve*' => Http::response([
                'requestStatusPerDestination' => [],
            ], 200),
        ]);

        $service = new GoogleDataManagerService(
            clientId: 'client-id',
            clientSecret: 'client-secret',
            refreshToken: 'refresh-token',
        );

        self::assertTrue($service->isConfigured());
        $result = $service->retrieveRequestStatus('request-1');

        self::assertSame([], $result['requestStatusPerDestination']);
        Http::assertSent(static function (Request $request): bool {
            return str_starts_with($request->url(), 'https://datamanager.googleapis.com/v1/requestStatus:retrieve')
                && $request->hasHeader('Authorization', 'Bearer fresh-token');
        });
    }
}
