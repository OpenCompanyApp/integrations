<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftOutlook;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftOutlook\OutlookService;
use OpenCompany\Integrations\MicrosoftOutlook\OutlookToolProvider;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookCreateEvent;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookGetCurrentUser;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookListMessages;
use OpenCompany\Integrations\MicrosoftOutlook\Tools\OutlookSendMessage;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Microsoft Outlook Graph API integration.
 */
final class MicrosoftOutlookServiceTest extends TestCase
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
        $provider = new OutlookToolProvider;
        $tools = $provider->tools();

        self::assertSame('microsoft-outlook', $provider->appName());
        self::assertSame('Microsoft Outlook', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://learn.microsoft.com/en-us/graph/api/overview', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(7, $tools);
        self::assertArrayHasKey('outlook_list_messages', $tools);
        self::assertArrayHasKey('outlook_send_message', $tools);
        self::assertArrayHasKey('outlook_create_event', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_graph_mail_calendar_event_and_user_requests(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me/sendMail' => Http::response('', 202),
            '*' => Http::response(['id' => 'message_123', 'value' => []], 200),
        ]);

        $service = new OutlookService('outlook-test-token', 'https://graph.example.test/v1.0');

        $service->listMessages(['$top' => 5, '$select' => 'subject,from']);
        $service->getMessage('message 123', ['$select' => 'subject,body']);
        $service->sendMessage(['message' => ['subject' => 'Hello']]);
        $service->listCalendars(['$top' => 3]);
        $service->listEvents(['$orderby' => 'start/dateTime']);
        $service->createEvent(['subject' => 'Planning']);
        $service->getCurrentUser(['$select' => 'displayName,mail']);

        Http::assertSentCount(7);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/messages?%24top=5&%24select=subject%2Cfrom'
            && $request->hasHeader('Authorization', 'Bearer outlook-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/messages/message%20123?%24select=subject%2Cbody');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/sendMail'
            && $request->data()['message']['subject'] === 'Hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/calendars?%24top=3');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/calendar/events?%24orderby=start%2FdateTime');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/calendar/events'
            && $request->data()['subject'] === 'Planning');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me?%24select=displayName%2Cmail');
    }

    public function test_service_normalizes_errors_and_send_no_body_success(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me/sendMail' => Http::response('', 202),
            'https://graph.example.test/v1.0/me/messages/message_123' => Http::response([
                'error' => ['message' => 'Message not found'],
            ], 404),
        ]);

        $service = new OutlookService('outlook-test-token', 'https://graph.example.test/v1.0');

        self::assertSame([], $service->sendMessage(['message' => ['subject' => 'Hello']]));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Microsoft Graph API error (404): Message not found');

        $service->getMessage('message_123');
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me/sendMail' => Http::response('', 202),
            'https://graph.example.test/v1.0/me/calendar/events' => Http::response(['id' => 'event_123'], 201),
            'https://graph.example.test/v1.0/me?%24select=displayName%2Cmail' => Http::response(['displayName' => 'Agent User'], 200),
        ]);

        $service = new OutlookService('outlook-test-token', 'https://graph.example.test/v1.0');

        $sent = (new OutlookSendMessage($service))->execute([
            'to' => ['recipient@example.test'],
            'subject' => 'Hello',
            'body' => '<b>Hi</b>',
            'content_type' => 'HTML',
            'cc' => ['copy@example.test'],
            'reply_to' => ['reply@example.test'],
        ]);
        $event = (new OutlookCreateEvent($service))->execute([
            'subject' => 'Planning',
            'start' => '2026-06-01T10:00:00',
            'end' => '2026-06-01T10:30:00',
            'time_zone' => 'UTC',
            'body' => 'Plan',
            'attendees' => ['guest@example.test'],
        ]);
        $user = (new OutlookGetCurrentUser($service))->execute(['select' => 'displayName,mail']);
        $missingTo = (new OutlookSendMessage($service))->execute(['subject' => 'Hello', 'body' => 'Hi']);
        $badContentType = (new OutlookSendMessage($service))->execute([
            'to' => ['recipient@example.test'],
            'subject' => 'Hello',
            'body' => 'Hi',
            'content_type' => 'Markdown',
        ]);
        $missingEventSubject = (new OutlookCreateEvent($service))->execute([
            'start' => '2026-06-01T10:00:00',
            'end' => '2026-06-01T10:30:00',
        ]);
        $unconfigured = (new OutlookListMessages(new OutlookService('', 'https://graph.example.test/v1.0')))->execute([]);

        self::assertTrue($sent->succeeded());
        self::assertTrue($event->succeeded());
        self::assertTrue($user->succeeded());
        self::assertFalse($missingTo->succeeded());
        self::assertStringContainsString('to is required', (string) $missingTo->error);
        self::assertFalse($badContentType->succeeded());
        self::assertStringContainsString('content_type must be "HTML" or "Text"', (string) $badContentType->error);
        self::assertFalse($missingEventSubject->succeeded());
        self::assertStringContainsString('subject is required', (string) $missingEventSubject->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/sendMail'
            && $request->data()['message']['toRecipients'][0]['emailAddress']['address'] === 'recipient@example.test'
            && $request->data()['message']['ccRecipients'][0]['emailAddress']['address'] === 'copy@example.test'
            && $request->data()['message']['replyTo'][0]['emailAddress']['address'] === 'reply@example.test');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/me/calendar/events'
            && $request->data()['start']['dateTime'] === '2026-06-01T10:00:00'
            && $request->data()['attendees'][0]['emailAddress']['address'] === 'guest@example.test');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new OutlookToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://graph.example.test/v1.0/me' => Http::sequence()
                ->push(['displayName' => 'Agent User', 'mail' => 'agent@example.test'], 200)
                ->push(['error' => ['message' => 'InvalidAuthenticationToken']], 401),
            'https://graph.internal.test/v1.0/me/messages?%24top=5' => Http::response(['value' => []], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'outlook-test-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);
        $badResult = $provider->testConnection([
            'access_token' => 'bad-token',
            'base_url' => 'https://graph.example.test/v1.0',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent User', (string) $result['message']);
        self::assertFalse($badResult['success']);
        self::assertStringContainsString('InvalidAuthenticationToken', (string) $badResult['error']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'outlook-work-token' : 'outlook-default-token',
                    'base_url' => 'https://graph.internal.test/v1.0',
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

        $tool = $provider->createTool(OutlookListMessages::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['top' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me'
            && $request->hasHeader('Authorization', 'Bearer outlook-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.internal.test/v1.0/me/messages?%24top=5'
            && $request->hasHeader('Authorization', 'Bearer outlook-work-token'));
    }
}
