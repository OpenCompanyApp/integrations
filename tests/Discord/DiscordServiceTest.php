<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Discord;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Discord\DiscordService;
use OpenCompany\Integrations\Discord\DiscordToolProvider;
use OpenCompany\Integrations\Discord\Tools\DiscordApiGet;
use OpenCompany\Integrations\Discord\Tools\DiscordCreateGuildRole;
use OpenCompany\Integrations\Discord\Tools\DiscordEditMessage;
use OpenCompany\Integrations\Discord\Tools\DiscordListGuildMembers;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Discord endpoint mapping and provider metadata.
 */
final class DiscordServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(DiscordService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(DiscordService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_supports_bot_auth_and_raw_methods(): void
    {
        Http::fake(['*' => Http::response([], 200)]);

        $service = new DiscordService('bot-token', authScheme: 'Bot');
        $service->apiGet('/guilds/guild-123/roles');
        $service->apiPost('/channels/channel-123/messages', ['content' => 'Hello']);
        $service->apiPatch('/channels/channel-123/messages/message-123', ['content' => 'Updated']);
        $service->apiPut('/guilds/guild-123/members/user-123/roles/role-123');
        $service->apiDelete('/channels/channel-123/messages/message-123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bot bot-token'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://discord.com/api/v10/guilds/guild-123/roles');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://discord.com/api/v10/channels/channel-123/messages'
            && $request['content'] === 'Hello');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://discord.com/api/v10/channels/channel-123/messages/message-123'
            && $request['content'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://discord.com/api/v10/guilds/guild-123/members/user-123/roles/role-123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://discord.com/api/v10/channels/channel-123/messages/message-123');
    }

    public function test_endpoint_tools_map_paths_query_and_bodies(): void
    {
        $service = new DiscordService('bot-token', authScheme: 'Bot');

        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new DiscordApiGet($service))->execute([
            'path' => '/guilds/guild-123/roles',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discord.com/api/v10/guilds/guild-123/roles');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new DiscordListGuildMembers($service))->execute([
            'guild_id' => 'guild-123',
            'limit' => 100,
            'after' => 'user-100',
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discord.com/api/v10/guilds/guild-123/members?limit=100&after=user-100');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new DiscordEditMessage($service))->execute([
            'channel_id' => 'channel-123',
            'message_id' => 'message-123',
            'content' => 'Updated content',
            'embeds' => [['title' => 'Build']],
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request['content'] === 'Updated content'
            && $request['embeds'][0]['title'] === 'Build');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        self::assertTrue((new DiscordCreateGuildRole($service))->execute([
            'guild_id' => 'guild-123',
            'name' => 'Deployers',
            'mentionable' => true,
        ])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discord.com/api/v10/guilds/guild-123/roles'
            && $request['name'] === 'Deployers'
            && $request['mentionable'] === true);
    }

    public function test_provider_metadata_connection_and_multi_account(): void
    {
        $provider = new DiscordToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://discord.com/developers/docs/reference', $provider->integrationMeta()['docs_url']);
        self::assertGreaterThanOrEqual(49, count($tools));
        self::assertArrayHasKey('discord_api_get', $tools);
        self::assertArrayHasKey('discord_edit_message', $tools);
        self::assertArrayHasKey('discord_list_guild_members', $tools);
        self::assertArrayHasKey('discord_create_webhook', $tools);

        $names = [];
        foreach ($tools as $tool) {
            $instance = new $tool['class'](new DiscordService('token'));
            $names[] = $instance->name();
        }
        self::assertCount(count($names), array_unique($names));

        self::assertSame(['success' => false, 'error' => 'No access token provided.'], $provider->testConnection([]));

        Http::fake(['*' => Http::response(['username' => 'bot-user'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Discord as bot-user.'], $provider->testConnection([
            'access_token' => 'bot-token',
            'token_type' => 'Bot',
        ]));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discord.com/api/v10/users/@me'
            && $request->hasHeader('Authorization', 'Bot bot-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response([], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['discord', 'access_token', 'community'] => 'account-token',
                    ['discord', 'base_url', 'community'] => 'https://discord.example.test/api/v10',
                    ['discord', 'token_type', 'community'] => 'Bot',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'discord' && $account === 'community';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'discord' ? ['community'] : [];
            }
        });

        $tool = $provider->createTool(DiscordApiGet::class, ['account' => 'community']);
        self::assertTrue($tool->execute(['path' => '/users/@me'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://discord.example.test/api/v10/users/@me'
            && $request->hasHeader('Authorization', 'Bot account-token'));
    }
}
