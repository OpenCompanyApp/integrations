<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MicrosoftTeams;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsService;
use OpenCompany\Integrations\MicrosoftTeams\MicrosoftTeamsToolProvider;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsListTeams;
use OpenCompany\Integrations\MicrosoftTeams\Tools\MicrosoftTeamsSendMessage;
use OpenCompany\Integrations\Teams\TeamsToolProvider as LegacyTeamsToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Microsoft Teams Graph API integration.
 */
final class MicrosoftTeamsServiceTest extends TestCase
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
        $provider = new MicrosoftTeamsToolProvider;
        $tools = $provider->tools();

        self::assertSame('microsoft-teams', $provider->appName());
        self::assertSame('Microsoft Teams', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://learn.microsoft.com/en-us/graph/api/resources/teams-api-overview', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(8, $tools);
        self::assertArrayHasKey('microsoft_teams_list_teams', $tools);
        self::assertArrayHasKey('microsoft_teams_send_message', $tools);
        self::assertArrayHasKey('microsoft_teams_list_chats', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_graph_team_channel_message_chat_and_user_requests(): void
    {
        Http::fake(['*' => Http::response(['id' => 'team_123', 'value' => []], 200)]);

        $service = new MicrosoftTeamsService('teams-test-token', 'https://graph.example.test/v1.0');

        $service->listTeams();
        $service->getTeam('team 123');
        $service->listChannels('team 123');
        $service->getChannel('team 123', '19:channel@example');
        $service->listMessages('team 123', '19:channel@example', 10);
        $service->sendMessage('team 123', '19:channel@example', '<b>Hello</b>', 'html');
        $service->listChats(5);
        $service->getCurrentUser();

        Http::assertSentCount(8);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/joinedTeams'
            && $request->hasHeader('Authorization', 'Bearer teams-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team%20123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team%20123/channels');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team%20123/channels/19%3Achannel%40example');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team%20123/channels/19%3Achannel%40example/messages?%24top=10');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team%20123/channels/19%3Achannel%40example/messages'
            && $request->data()['body']['content'] === '<b>Hello</b>'
            && $request->data()['body']['contentType'] === 'html');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me/chats?%24top=5');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me');
    }

    public function test_service_normalizes_errors(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/me' => Http::response([
                'error' => ['message' => 'Access token has expired'],
            ], 401),
        ]);

        $service = new MicrosoftTeamsService('teams-test-token', 'https://graph.example.test/v1.0');

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Microsoft Graph API error (401): Access token has expired');

        $service->getCurrentUser();
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://graph.example.test/v1.0/teams/team_123/channels/channel_123/messages' => Http::response([
                'id' => 'message_123',
                'createdDateTime' => '2026-06-01T10:00:00Z',
                'webUrl' => 'https://teams.example.test/message_123',
            ], 201),
        ]);

        $service = new MicrosoftTeamsService('teams-test-token', 'https://graph.example.test/v1.0');

        $sent = (new MicrosoftTeamsSendMessage($service))->execute([
            'team_id' => 'team_123',
            'channel_id' => 'channel_123',
            'content' => '<b>Deployment complete</b>',
            'content_type' => 'html',
        ]);
        $missingContent = (new MicrosoftTeamsSendMessage($service))->execute([
            'team_id' => 'team_123',
            'channel_id' => 'channel_123',
        ]);
        $badContentType = (new MicrosoftTeamsSendMessage($service))->execute([
            'team_id' => 'team_123',
            'channel_id' => 'channel_123',
            'content' => 'Hello',
            'content_type' => 'markdown',
        ]);
        $unconfigured = (new MicrosoftTeamsListTeams(new MicrosoftTeamsService('', 'https://graph.example.test/v1.0')))->execute([]);

        self::assertTrue($sent->succeeded());
        self::assertSame('message_123', $sent->data['id']);
        self::assertFalse($missingContent->succeeded());
        self::assertStringContainsString('content is required', (string) $missingContent->error);
        self::assertFalse($badContentType->succeeded());
        self::assertStringContainsString('content_type must be "text" or "html"', (string) $badContentType->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://graph.example.test/v1.0/teams/team_123/channels/channel_123/messages'
            && $request->data()['body']['contentType'] === 'html');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new MicrosoftTeamsToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://graph.example.test/v1.0/me' => Http::sequence()
                ->push(['displayName' => 'Agent User', 'userPrincipalName' => 'agent@example.test'], 200)
                ->push(['error' => ['message' => 'InvalidAuthenticationToken']], 401),
            'https://graph.internal.test/v1.0/me/joinedTeams' => Http::response(['value' => []], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'teams-test-token',
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
                    'access_token' => $account === 'work' ? 'teams-work-token' : 'teams-default-token',
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

        $tool = $provider->createTool(MicrosoftTeamsListTeams::class, ['account' => 'work']);
        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.example.test/v1.0/me'
            && $request->hasHeader('Authorization', 'Bearer teams-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.internal.test/v1.0/me/joinedTeams'
            && $request->hasHeader('Authorization', 'Bearer teams-work-token'));
    }

    public function test_legacy_teams_package_aliases_canonical_provider_and_credentials(): void
    {
        $canonicalComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/microsoft-teams/composer.json'), true);
        $legacyComposer = json_decode((string) file_get_contents(__DIR__ . '/../../packages/teams/composer.json'), true);

        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/integration-teams']);
        self::assertSame('self.version', $canonicalComposer['replace']['opencompanyapp/ai-tool-teams']);
        self::assertSame('opencompanyapp/integration-microsoft-teams', $legacyComposer['abandoned']);

        $legacyProvider = new LegacyTeamsToolProvider;

        self::assertSame('microsoft-teams', $legacyProvider->appName());
        self::assertSame('Microsoft Teams', $legacyProvider->integrationMeta()['name']);
        self::assertArrayHasKey('microsoft_teams_list_chats', $legacyProvider->tools());

        Http::fake([
            'https://graph.legacy.example.test/v1.0/me/joinedTeams' => Http::response(['value' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'microsoft-teams') {
                    return '';
                }

                if ($integration === 'teams' && $account === 'work') {
                    return match ($key) {
                        'access_token' => 'legacy-teams-token',
                        'base_url' => 'https://graph.legacy.example.test/v1.0',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'teams' && $account === 'work';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'teams' ? ['work'] : [];
            }
        });

        $tool = (new MicrosoftTeamsToolProvider)->createTool(MicrosoftTeamsListTeams::class, ['account' => 'work']);

        self::assertTrue($tool->execute([])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://graph.legacy.example.test/v1.0/me/joinedTeams'
            && $request->hasHeader('Authorization', 'Bearer legacy-teams-token'));
    }
}
