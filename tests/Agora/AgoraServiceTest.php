<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Agora;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Agora\AgoraService;
use OpenCompany\Integrations\Agora\AgoraToolProvider;
use OpenCompany\Integrations\Agora\Tools\AgoraAcquireRecordingResource;
use OpenCompany\Integrations\Agora\Tools\AgoraStartRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraStopRecording;
use OpenCompany\Integrations\Agora\Tools\AgoraUpdateRecordingLayout;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Agora Cloud Recording RESTful API integration.
 */
final class AgoraServiceTest extends TestCase
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

    public function test_provider_metadata_matches_cloud_recording_api(): void
    {
        $provider = new AgoraToolProvider;

        self::assertSame('Agora', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://docs.agora.io/en/cloud-recording/reference/restful-api', $provider->integrationMeta()['docs_url']);
        self::assertSame('basic_auth', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertSame(['customer_id', 'customer_secret', 'app_id'], $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertSame(['customer_id', 'customer_secret', 'app_id', 'url'], array_column($provider->credentialFields(), 'key'));
        self::assertCount(7, $provider->tools());
        self::assertArrayHasKey('agora_acquire_recording_resource', $provider->tools());
        self::assertArrayHasKey('agora_start_recording', $provider->tools());
        self::assertArrayHasKey('agora_query_recording', $provider->tools());
        self::assertArrayHasKey('agora_update_recording', $provider->tools());
        self::assertArrayHasKey('agora_update_recording_layout', $provider->tools());
        self::assertArrayHasKey('agora_stop_recording', $provider->tools());
        self::assertArrayHasKey('agora_get_notification_ips', $provider->tools());
        self::assertFileExists((string) $provider->scriptDocsPath());
    }

    public function test_service_maps_basic_auth_paths_and_payloads(): void
    {
        Http::fake(['*' => Http::response(['ok' => true, 'resourceId' => 'res_123', 'sid' => 'sid_123'], 200)]);

        $service = new AgoraService('customer_test', 'secret_test', 'app_123', 'https://agora.example.test');

        $service->acquireResource('room-one', '527841', ['scene' => 0, 'resourceExpiredHour' => 24]);
        $service->startRecording('res_123', 'mix', 'room-one', '527841', [
            'recordingConfig' => ['streamTypes' => 2],
            'storageConfig' => ['vendor' => 1, 'bucket' => 'bucket-example'],
        ]);
        $service->queryRecording('res_123', 'sid_123', 'mix');
        $service->updateRecording('res_123', 'sid_123', 'mix', 'room-one', '527841', [
            'streamSubscribe' => ['audioUidList' => ['subscribeAudioUids' => ['123']]],
        ]);
        $service->updateLayout('res_123', 'sid_123', 'room-one', '527841', [
            'mixedVideoLayout' => 3,
            'layoutConfig' => [['uid' => '123', 'x_axis' => 0]],
        ]);
        $service->stopRecording('res_123', 'sid_123', 'mix', 'room-one', '527841', ['async_stop' => false]);
        $service->getNotificationIps();

        Http::assertSentCount(7);
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('customer_test:secret_test')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/acquire'
            && $request['cname'] === 'room-one'
            && $request['clientRequest']['resourceExpiredHour'] === 24);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/resourceid/res_123/mode/mix/start'
            && $request['clientRequest']['recordingConfig']['streamTypes'] === 2
            && $request['clientRequest']['storageConfig']['bucket'] === 'bucket-example');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/resourceid/res_123/sid/sid_123/mode/mix/query');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/resourceid/res_123/sid/sid_123/mode/mix/update'
            && $request['clientRequest']['streamSubscribe']['audioUidList']['subscribeAudioUids'] === ['123']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/resourceid/res_123/sid/sid_123/mode/mix/updateLayout'
            && $request['clientRequest']['mixedVideoLayout'] === 3);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/resourceid/res_123/sid/sid_123/mode/mix/stop'
            && $request['clientRequest']['async_stop'] === false);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://agora.example.test/v1/ncs/ip');
    }

    public function test_tools_validate_configuration_and_shape_client_requests(): void
    {
        Http::fake(['*' => Http::response(['ok' => true, 'resourceId' => 'res_123', 'sid' => 'sid_123'], 200)]);

        $service = new AgoraService('customer_test', 'secret_test', 'app_123', 'https://agora.example.test');

        $acquired = (new AgoraAcquireRecordingResource($service))->execute([
            'cname' => 'room-one',
            'uid' => '527841',
            'scene' => 0,
            'resource_expired_hour' => 12,
            'client_request' => ['resourceExpiredHour' => 24],
        ]);
        $started = (new AgoraStartRecording($service))->execute([
            'resource_id' => 'res_123',
            'mode' => 'mix',
            'cname' => 'room-one',
            'uid' => '527841',
            'token' => 'rtc-token',
            'recording_config' => ['streamTypes' => 2],
            'storage_config' => ['vendor' => 1, 'bucket' => 'bucket-example'],
        ]);
        $layout = (new AgoraUpdateRecordingLayout($service))->execute([
            'resource_id' => 'res_123',
            'sid' => 'sid_123',
            'cname' => 'room-one',
            'uid' => '527841',
            'mixed_video_layout' => 3,
            'layout_config' => [['uid' => '123', 'x_axis' => 0]],
        ]);
        $stopped = (new AgoraStopRecording($service))->execute([
            'resource_id' => 'res_123',
            'sid' => 'sid_123',
            'mode' => 'mix',
            'cname' => 'room-one',
            'uid' => '527841',
            'async_stop' => true,
        ]);

        self::assertTrue($acquired->succeeded());
        self::assertTrue($started->succeeded());
        self::assertTrue($layout->succeeded());
        self::assertTrue($stopped->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://agora.example.test/v1/apps/app_123/cloud_recording/acquire'
            && $request['clientRequest']['resourceExpiredHour'] === 12);
        Http::assertSent(static fn (Request $request): bool => str_ends_with($request->url(), '/mode/mix/start')
            && $request['clientRequest']['token'] === 'rtc-token'
            && $request['clientRequest']['storageConfig']['bucket'] === 'bucket-example');
        Http::assertSent(static fn (Request $request): bool => str_ends_with($request->url(), '/mode/mix/updateLayout')
            && $request['clientRequest']['layoutConfig'][0]['uid'] === '123');
        Http::assertSent(static fn (Request $request): bool => str_ends_with($request->url(), '/mode/mix/stop')
            && $request['clientRequest']['async_stop'] === true);

        $unconfigured = (new AgoraStartRecording(new AgoraService('', '', '', 'https://agora.example.test')))->execute([
            'resource_id' => 'res_123',
            'mode' => 'mix',
            'cname' => 'room-one',
            'uid' => '527841',
        ]);

        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        $missing = (new AgoraStopRecording($service))->execute(['resource_id' => 'res_123']);

        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('sid is required', (string) $missing->error);
    }

    public function test_connection_validates_config_without_mutating_api(): void
    {
        Http::fake(['*' => Http::response(['ok' => true], 200)]);

        $provider = new AgoraToolProvider;

        $result = $provider->testConnection([
            'customer_id' => 'customer_test',
            'customer_secret' => 'secret_test',
            'app_id' => 'app_123',
            'url' => 'https://api.sd-rtn.com',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('mutating', (string) $result['message']);
        Http::assertNothingSent();

        $missing = $provider->testConnection([]);

        self::assertFalse($missing['success']);
        self::assertStringContainsString('customer ID', (string) $missing['error']);

        $badUrl = $provider->testConnection([
            'customer_id' => 'customer_test',
            'customer_secret' => 'secret_test',
            'app_id' => 'app_123',
            'url' => 'not-a-url',
        ]);

        self::assertFalse($badUrl['success']);
        self::assertStringContainsString('valid URL', (string) $badUrl['error']);
    }
}
