<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\GoogleMeet;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\GoogleMeet\GoogleMeetService;
use OpenCompany\Integrations\GoogleMeet\GoogleMeetToolProvider;
use OpenCompany\Integrations\GoogleMeet\Tools\GoogleMeetConferenceRecordsParticipantsList;
use OpenCompany\Integrations\GoogleMeet\Tools\GoogleMeetSpacesCreate;
use OpenCompany\Integrations\GoogleMeet\Tools\GoogleMeetSpacesGet;
use PHPUnit\Framework\TestCase;

final class GoogleMeetServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_provider_matches_discovery_manifest_and_docs(): void
    {
        $provider = new GoogleMeetToolProvider;
        $manifest = json_decode((string) file_get_contents(__DIR__ . '/../../packages/google-meet/google-meet-discovery-manifest.json'), true);

        self::assertSame(18, $manifest['method_count']);
        self::assertCount($manifest['method_count'], $provider->tools());
        self::assertSame('Google Meet', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        foreach ($provider->tools() as $tool) {
            $shortName = substr((string) $tool['class'], strrpos((string) $tool['class'], chr(92)) + 1);
            self::assertFileExists(__DIR__ . '/../../packages/google-meet/src/Tools/' . $shortName . '.php');
        }

        $manifestTools = array_column($manifest['methods'], 'tool');
        $providerTools = array_keys($provider->tools());
        sort($manifestTools);
        sort($providerTools);
        self::assertSame($manifestTools, $providerTools);
        self::assertContains('google_meet_spaces_create', $manifestTools);
        self::assertContains('google_meet_conference_records_participants_participant_sessions_list', $manifestTools);
        self::assertContains('google_meet_conference_records_transcripts_entries_list', $manifestTools);
        self::assertContains('google_meet_conference_records_smart_notes_list', $manifestTools);
    }

    public function test_service_maps_auth_resource_paths_query_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $service = new GoogleMeetService('token-test', 'https://example.test');
        $service->request('GET', '/v2/{+parent}/participants', ['parent' => 'conferenceRecords/record-1'], ['parent'], ['pageSize' => 5]);
        $service->request('POST', '/v2/spaces', [], [], [], ['config' => ['accessType' => 'TRUSTED']]);
        $service->request('GET', '/v2/{+name}', ['name' => 'conferenceRecords/record-1/transcripts/transcript-1']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v2/conferenceRecords/record-1/participants?pageSize=5'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v2/spaces'
            && $request['config']['accessType'] === 'TRUSTED');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v2/conferenceRecords/record-1/transcripts/transcript-1');
    }

    public function test_tools_filter_query_require_path_params_and_body(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);
        $service = new GoogleMeetService('token-test');

        $list = new GoogleMeetConferenceRecordsParticipantsList($service);
        $result = $list->execute(['parent' => 'conferenceRecords/record-1', 'pageSize' => 10, 'unknown' => 'ignored']);

        self::assertTrue($result->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://meet.googleapis.com/v2/conferenceRecords/record-1/participants?pageSize=10');

        $missingPath = (new GoogleMeetSpacesGet($service))->execute([]);
        self::assertFalse($missingPath->succeeded());
        self::assertStringContainsString('name must be', (string) $missingPath->error);

        $missingBody = (new GoogleMeetSpacesCreate($service))->execute([]);
        self::assertFalse($missingBody->succeeded());
        self::assertStringContainsString('body must be', (string) $missingBody->error);
    }
}