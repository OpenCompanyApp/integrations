<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Zoom;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateMeeting;
use OpenCompany\Integrations\Zoom\Tools\ZoomCreateWebinar;
use OpenCompany\Integrations\Zoom\Tools\ZoomListMeetings;
use OpenCompany\Integrations\Zoom\Tools\ZoomUpdateMeeting;
use OpenCompany\Integrations\Zoom\ZoomService;
use OpenCompany\Integrations\Zoom\ZoomToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoom REST API v2 integration.
 */
final class ZoomServiceTest extends TestCase
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

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new ZoomToolProvider;
        $tools = $provider->tools();

        self::assertSame('zoom', $provider->appName());
        self::assertSame('Zoom', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.zoom.us/docs/api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());

        self::assertCount(16, $tools);
        self::assertArrayHasKey('zoom_create_meeting', $tools);
        self::assertArrayHasKey('zoom_create_webinar', $tools);
        self::assertArrayHasKey('zoom_update_meeting', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_meeting_user_recording_webinar_and_account_requests(): void
    {
        Http::fake(['*' => Http::response(['id' => '123', 'email' => 'agent@example.test'], 200)]);

        $service = new ZoomService('zoom-test-token', 'https://zoom.example.test/v2');

        $service->listMeetings('me', 'scheduled', 10, 'next_token');
        $service->getMeeting('meeting 123');
        $service->createMeeting('Planning', '2', '2026-06-01T10:00:00Z', 45, 'UTC', 'me', ['agenda' => 'Plan']);
        $service->listUsers(10, 'user_token');
        $service->getUser('person@example.test');
        $service->listRecordings('me', 'recording_token', 5);
        $service->getCurrentUser();
        $service->createUser(['action' => 'create', 'user_info' => ['email' => 'new@example.test']]);
        $service->createWebinar('person@example.test', ['topic' => 'Launch', 'type' => 5]);
        $service->deleteMeeting('meeting 123');
        $service->getAccount();
        $service->getUserSettings('me');
        $service->getWebinar('webinar 123');
        $service->listPastMeetings('meeting 123');
        $service->listWebinars('me', ['page_size' => 5]);
        $service->updateMeeting('meeting 123', ['topic' => 'Updated']);

        Http::assertSentCount(16);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.example.test/v2/users/me/meetings?type=scheduled&page_size=10&next_page_token=next_token'
            && $request->hasHeader('Authorization', 'Bearer zoom-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.example.test/v2/meetings/meeting+123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://zoom.example.test/v2/users/me/meetings'
            && $request->data()['topic'] === 'Planning'
            && $request->data()['type'] === 2
            && $request->data()['duration'] === 45
            && $request->data()['agenda'] === 'Plan');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.example.test/v2/users/person%40example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://zoom.example.test/v2/users'
            && $request->data()['user_info']['email'] === 'new@example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://zoom.example.test/v2/users/person%40example.test/webinars'
            && $request->data()['topic'] === 'Launch');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.example.test/v2/past_meetings/meeting+123/instances');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://zoom.example.test/v2/meetings/meeting+123'
            && $request->data()['topic'] === 'Updated');
    }

    public function test_service_normalizes_errors_and_empty_successes(): void
    {
        Http::fake([
            'https://zoom.example.test/v2/meetings/meeting+123' => Http::sequence()
                ->push('', 204)
                ->push(['message' => 'Meeting does not exist'], 404),
        ]);

        $service = new ZoomService('zoom-test-token', 'https://zoom.example.test/v2');

        self::assertSame([], $service->deleteMeeting('meeting 123'));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Zoom API error (404): Meeting does not exist');

        $service->getMeeting('meeting 123');
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://zoom.example.test/v2/users/me/meetings' => Http::response(['id' => 'meeting_123'], 200),
            'https://zoom.example.test/v2/users/me/webinars' => Http::response(['id' => 'webinar_123', 'topic' => 'Launch'], 200),
            'https://zoom.example.test/v2/meetings/meeting_123' => Http::response('', 204),
        ]);

        $service = new ZoomService('zoom-test-token', 'https://zoom.example.test/v2');

        $meeting = (new ZoomCreateMeeting($service))->execute([
            'topic' => 'Planning',
            'type' => '2',
            'start_time' => '2026-06-01T10:00:00Z',
            'duration' => 45,
            'timezone' => 'UTC',
            'agenda' => 'Plan',
            'settings' => ['join_before_host' => true],
        ]);
        $webinar = (new ZoomCreateWebinar($service))->execute([
            'user_id' => 'me',
            'topic' => 'Launch',
            'type' => 5,
        ]);
        $update = (new ZoomUpdateMeeting($service))->execute(['meeting_id' => 'meeting_123', 'topic' => 'Updated']);
        $missingTopic = (new ZoomCreateMeeting($service))->execute([]);
        $emptyUpdate = (new ZoomUpdateMeeting($service))->execute(['meeting_id' => 'meeting_123']);
        $unconfigured = (new ZoomListMeetings(new ZoomService('', 'https://zoom.example.test/v2')))->execute([]);

        self::assertTrue($meeting->succeeded());
        self::assertTrue($webinar->succeeded());
        self::assertTrue($update->succeeded());
        self::assertFalse($missingTopic->succeeded());
        self::assertStringContainsString('topic is required', (string) $missingTopic->error);
        self::assertFalse($emptyUpdate->succeeded());
        self::assertStringContainsString('At least one field', (string) $emptyUpdate->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://zoom.example.test/v2/users/me/meetings'
            && $request->data()['settings']['join_before_host'] === true);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new ZoomToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://zoom.example.test/v2/users/me' => Http::sequence()
                ->push(['first_name' => 'Agent', 'last_name' => 'User', 'email' => 'agent@example.test'], 200)
                ->push(['message' => 'Invalid access token'], 401),
            'https://zoom.internal.test/v2/users/me/meetings?type=upcoming&page_size=5' => Http::response(['meetings' => []], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'zoom-test-token',
            'url' => 'https://zoom.example.test/v2',
        ]);
        $badResult = $provider->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://zoom.example.test/v2',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent User', (string) $result['message']);
        self::assertFalse($badResult['success']);
        self::assertStringContainsString('Invalid access token', (string) $badResult['error']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'zoom-work-token' : 'zoom-default-token',
                    'url' => 'https://zoom.internal.test/v2',
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

        $tool = $provider->createTool(ZoomListMeetings::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['type' => 'upcoming', 'page_size' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.example.test/v2/users/me'
            && $request->hasHeader('Authorization', 'Bearer zoom-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://zoom.internal.test/v2/users/me/meetings?type=upcoming&page_size=5'
            && $request->hasHeader('Authorization', 'Bearer zoom-work-token'));
    }
}
