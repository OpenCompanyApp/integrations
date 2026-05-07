<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Webex;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Webex\Tools\WebexApiGet;
use OpenCompany\Integrations\Webex\Tools\WebexCreateRoom;
use OpenCompany\Integrations\Webex\Tools\WebexUpdateMessage;
use OpenCompany\Integrations\Webex\WebexService;
use OpenCompany\Integrations\Webex\WebexToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Cisco Webex REST API coverage.
 */
final class WebexServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_messaging_people_teams_meetings_webhooks_and_generic_endpoints(): void
    {
        Http::fake([
            'https://webexapis.com/v1/*' => Http::response(['ok' => true, 'items' => []], 200),
        ]);

        $service = new WebexService('webex_test');

        $service->getCurrentUser();
        $service->listRooms(20);
        $service->getRoom('room_1');
        $service->createRoom(['title' => 'Project']);
        $service->updateRoom('room_1', ['title' => 'Renamed']);
        $service->deleteRoom('room_1');
        $service->listMessages('room_1', 25);
        $service->createMessage('room_1', 'Hello');
        $service->getMessage('msg_1');
        $service->updateMessage('msg_1', ['text' => 'Updated']);
        $service->deleteMessage('msg_1');
        $service->listPeople(['email' => 'person@example.test']);
        $service->getPerson('person_1');
        $service->listMemberships(['roomId' => 'room_1']);
        $service->createMembership(['roomId' => 'room_1', 'personEmail' => 'person@example.test']);
        $service->deleteMembership('mem_1');
        $service->listTeams(['max' => 10]);
        $service->getTeam('team_1');
        $service->createTeam(['name' => 'Example']);
        $service->updateTeam('team_1', ['name' => 'Renamed']);
        $service->deleteTeam('team_1');
        $service->listTeamMemberships(['teamId' => 'team_1']);
        $service->listMeetings('2026-05-08T10:00:00Z', '2026-05-08T11:00:00Z');
        $service->getMeeting('meeting_1');
        $service->createMeeting(['title' => 'Sync', 'start' => '2026-05-08T10:00:00Z', 'end' => '2026-05-08T10:30:00Z']);
        $service->updateMeeting('meeting_1', ['title' => 'Updated']);
        $service->deleteMeeting('meeting_1');
        $service->listWebhooks(['max' => 10]);
        $service->getWebhook('hook_1');
        $service->createWebhook(['name' => 'Hook', 'targetUrl' => 'https://example.test/webex', 'resource' => 'messages', 'event' => 'created']);
        $service->updateWebhook('hook_1', ['name' => 'Renamed']);
        $service->deleteWebhook('hook_1');
        $service->apiGet('/rooms');
        $service->apiPost('/messages', ['roomId' => 'room_1', 'text' => 'Hello']);
        $service->apiPut('/rooms/room_1', ['title' => 'Renamed']);
        $service->apiDelete('/messages/msg_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer webex_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/people/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/rooms?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/rooms/room_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://webexapis.com/v1/rooms');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://webexapis.com/v1/rooms/room_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://webexapis.com/v1/rooms/room_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/messages?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://webexapis.com/v1/messages');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/messages/msg_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://webexapis.com/v1/messages/msg_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://webexapis.com/v1/messages/msg_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/people?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/people/person_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/memberships?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://webexapis.com/v1/memberships');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://webexapis.com/v1/memberships/mem_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/teams?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/teams/team_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/team/memberships?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/meetings?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/meetings/meeting_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://webexapis.com/v1/meetings');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://webexapis.com/v1/meetings/meeting_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://webexapis.com/v1/webhooks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://webexapis.com/v1/webhooks/hook_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://webexapis.com/v1/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://webexapis.com/v1/webhooks/hook_1');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://webexapis.com/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new WebexService('webex_test');

        self::assertTrue((new WebexCreateRoom($service))->execute([
            'title' => 'Project',
        ])->succeeded());
        self::assertTrue((new WebexUpdateMessage($service))->execute([
            'message_id' => 'msg_1',
            'text' => 'Updated',
        ])->succeeded());
        self::assertTrue((new WebexApiGet($service))->execute([
            'path' => '/rooms',
        ])->succeeded());
        self::assertFalse((new WebexCreateRoom($service))->execute([])->succeeded());
        self::assertFalse((new WebexUpdateMessage($service))->execute([
            'message_id' => 'msg_1',
        ])->succeeded());
        self::assertFalse((new WebexApiGet($service))->execute([
            'path' => 'https://example.test/rooms',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://webexapis.com/v1/people/me' => Http::response(['displayName' => 'Example User'], 200),
        ]);

        $provider = new WebexToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('webex_create_room', $tools);
        self::assertArrayHasKey('webex_update_message', $tools);
        self::assertArrayHasKey('webex_list_people', $tools);
        self::assertArrayHasKey('webex_create_membership', $tools);
        self::assertArrayHasKey('webex_list_team_memberships', $tools);
        self::assertArrayHasKey('webex_create_meeting', $tools);
        self::assertArrayHasKey('webex_create_webhook', $tools);
        self::assertArrayHasKey('webex_api_delete', $tools);
        self::assertSame(36, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'webex_test',
        ])['success']);
    }
}
