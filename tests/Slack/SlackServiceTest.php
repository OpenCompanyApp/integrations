<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Slack;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Slack\SlackService;
use OpenCompany\Integrations\Slack\SlackToolProvider;
use OpenCompany\Integrations\Slack\Tools\SlackListChannels;
use OpenCompany\Integrations\Slack\Tools\SlackSendMessage;
use OpenCompany\Integrations\Slack\Tools\SlackUploadFile;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Slack Web API integration.
 */
final class SlackServiceTest extends TestCase
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
        $provider = new SlackToolProvider;
        $tools = $provider->tools();

        self::assertSame('slack', $provider->appName());
        self::assertSame('Slack', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://api.slack.com/methods', $provider->integrationMeta()['docs_url']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(25, $tools);
        self::assertArrayHasKey('slack_send_message', $tools);
        self::assertArrayHasKey('slack_upload_file', $tools);
        self::assertArrayHasKey('slack_update_usergroup_members', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_slack_web_api_methods_headers_queries_and_bodies(): void
    {
        Http::fake([
            'https://upload.slack.example.test/*' => Http::response('', 200),
            '*' => Http::response(['ok' => true, 'upload_url' => 'https://upload.slack.example.test/file', 'file_id' => 'F123'], 200),
        ]);

        $service = new SlackService('xoxb-test-token');

        $service->testConnection();
        $service->sendMessage(['channel' => 'C123', 'text' => 'hello']);
        $service->updateMessage(['channel' => 'C123', 'ts' => '1710000000.000100', 'text' => 'updated']);
        $service->deleteMessage(['channel' => 'C123', 'ts' => '1710000000.000100']);
        $service->getPermalink(['channel' => 'C123', 'message_ts' => '1710000000.000100']);
        $service->searchMessages(['query' => 'deploy after:2026-01-01', 'count' => 5]);
        $service->getChannelHistory(['channel' => 'C123', 'limit' => 10]);
        $service->getThreadReplies(['channel' => 'C123', 'ts' => '1710000000.000100']);
        $service->listChannels(['types' => 'public_channel,private_channel', 'exclude_archived' => true]);
        $service->getChannel(['channel' => 'C123']);
        $service->createChannel(['name' => 'ops']);
        $service->setTopic(['channel' => 'C123', 'topic' => 'Deploys']);
        $service->setPurpose(['channel' => 'C123', 'purpose' => 'Operations']);
        $service->archiveChannel(['channel' => 'C123']);
        $service->inviteToChannel(['channel' => 'C123', 'users' => 'U123,U456']);
        $service->getFileUploadURL(['filename' => 'report.txt', 'length' => 11]);
        $service->uploadFileToURL('https://upload.slack.example.test/file', 'hello world', 'report.txt');
        $service->completeUploadExternal(['files' => [['id' => 'F123']], 'channel_id' => 'C123']);
        $service->listFiles(['channel' => 'C123', 'count' => 10]);
        $service->getFile(['file' => 'F123']);
        $service->listUsers(['limit' => 10]);
        $service->getUser(['user' => 'U123']);
        $service->findUserByEmail(['email' => 'person@example.test']);
        $service->addReaction(['channel' => 'C123', 'name' => 'thumbsup', 'timestamp' => '1710000000.000100']);
        $service->removeReaction(['channel' => 'C123', 'name' => 'thumbsup', 'timestamp' => '1710000000.000100']);
        $service->listUsergroups(['include_users' => true]);
        $service->updateUsergroupMembers(['usergroup' => 'S123', 'users' => 'U123,U456']);

        Http::assertSentCount(27);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/auth.test'
            && $request->hasHeader('Authorization', 'Bearer xoxb-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/chat.postMessage'
            && $request->data()['channel'] === 'C123'
            && $request->data()['text'] === 'hello');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://slack.com/api/conversations.list?types=public_channel%2Cprivate_channel&exclude_archived=1');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://slack.com/api/files.getUploadURLExternal?filename=report.txt&length=11');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://upload.slack.example.test/file'
            && $request->hasHeader('Authorization', 'Bearer xoxb-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/files.completeUploadExternal'
            && $request->data()['files'][0]['id'] === 'F123');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/usergroups.users.update'
            && $request->data()['usergroup'] === 'S123');
    }

    public function test_service_normalizes_slack_api_errors(): void
    {
        Http::fake([
            'https://slack.com/api/chat.postMessage' => Http::response([
                'ok' => false,
                'error' => 'missing_scope',
                'needed' => 'chat:write',
            ], 200),
        ]);

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Slack API error: missing_scope (needed: chat:write)');

        (new SlackService('xoxb-test-token'))->sendMessage(['channel' => 'C123', 'text' => 'hello']);
    }

    public function test_tools_validate_configuration_and_execute_upload_flow(): void
    {
        Http::fake([
            'https://slack.com/api/chat.postMessage' => Http::response(['ok' => true, 'channel' => 'C123', 'ts' => '1710000000.000100'], 200),
            'https://slack.com/api/files.getUploadURLExternal*' => Http::response(['ok' => true, 'upload_url' => 'https://upload.slack.example.test/file', 'file_id' => 'F123'], 200),
            'https://upload.slack.example.test/*' => Http::response('', 200),
            'https://slack.com/api/files.completeUploadExternal' => Http::response(['ok' => true, 'files' => [['id' => 'F123']]], 200),
        ]);

        $service = new SlackService('xoxb-test-token');

        self::assertTrue((new SlackSendMessage($service))->execute(['channel' => 'C123', 'text' => 'hello'])->succeeded());
        self::assertTrue((new SlackUploadFile($service))->execute([
            'channel' => 'C123',
            'content' => 'hello world',
            'filename' => 'report.txt',
            'title' => 'Report',
        ])->succeeded());

        $missingChannel = (new SlackSendMessage($service))->execute(['text' => 'hello']);
        $unconfigured = (new SlackListChannels(new SlackService('')))->execute([]);

        self::assertFalse($missingChannel->succeeded());
        self::assertStringContainsString('channel is required', (string) $missingChannel->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/files.completeUploadExternal'
            && $request->data()['files'][0]['title'] === 'Report'
            && $request->data()['channel_id'] === 'C123');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new SlackToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://slack.com/api/auth.test' => Http::response(['ok' => true, 'user' => 'bot', 'team' => 'Example'], 200),
            'https://slack.com/api/conversations.list*' => Http::response(['ok' => true, 'channels' => []], 200),
        ]);

        $result = $provider->testConnection(['bot_token' => 'xoxb-test-token']);

        self::assertTrue($result['success']);
        self::assertStringContainsString('@bot', (string) $result['message']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return $key === 'bot_token' && $account === 'ops' ? 'xoxb-ops-token' : $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['ops'];
            }
        });

        $tool = $provider->createTool(SlackListChannels::class, ['account' => 'ops']);
        self::assertTrue($tool->execute(['limit' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://slack.com/api/auth.test'
            && $request->hasHeader('Authorization', 'Bearer xoxb-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://slack.com/api/conversations.list?limit=5'
            && $request->hasHeader('Authorization', 'Bearer xoxb-ops-token'));
    }
}
