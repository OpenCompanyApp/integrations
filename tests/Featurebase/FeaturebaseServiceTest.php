<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Featurebase;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Featurebase\FeaturebaseService;
use OpenCompany\Integrations\Featurebase\FeaturebaseToolProvider;
use OpenCompany\Integrations\Featurebase\Tools\FeaturebaseApiGet;
use OpenCompany\Integrations\Featurebase\Tools\FeaturebaseCreatePost;
use OpenCompany\Integrations\Featurebase\Tools\FeaturebaseGetContactByUserId;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Featurebase 2026-01-01.nova REST API.
 */
final class FeaturebaseServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(FeaturebaseService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(FeaturebaseService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_and_tools(): void
    {
        $provider = new FeaturebaseToolProvider();

        self::assertSame('featurebase', $provider->appName());
        self::assertSame('Featurebase', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(110, FeaturebaseService::operations());
        self::assertCount(114, $provider->tools());
        self::assertArrayHasKey('featurebase_list_boards', $provider->tools());
        self::assertArrayHasKey('featurebase_create_post', $provider->tools());
        self::assertArrayHasKey('featurebase_get_contact_by_user_id', $provider->tools());
        self::assertArrayHasKey('featurebase_reply_to_ticket', $provider->tools());
        self::assertArrayHasKey('featurebase_refresh_webhook_secret', $provider->tools());
        self::assertArrayHasKey('featurebase_api_get', $provider->tools());
    }

    public function test_service_maps_representative_featurebase_api_endpoints(): void
    {
        Http::fake([
            'https://featurebase.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new FeaturebaseService('fb-token', 'https://featurebase.test', '2026-01-01.nova');
        $service->call('listboards');
        $service->call('createpost', ['boardId' => 'board-1', 'title' => 'Export data']);
        $service->call('getpost', ['id' => 'post-1']);
        $service->call('updatepost', ['id' => 'post-1', 'title' => 'Updated']);
        $service->call('removevoter', ['id' => 'post-1', 'userId' => 'user-1']);
        $service->call('getcontactbyuserid', ['user_id' => 'external-1']);
        $service->call('updatecontactemailpreferencesbyuserid', ['user_id' => 'external-1', 'marketing' => false]);
        $service->call('attachcontacttocompany', ['id' => 'company-1', 'contactId' => 'contact-1']);
        $service->call('removecontactfromcompany', ['id' => 'company-1', 'contact_id' => 'contact-1']);
        $service->call('createarticle', ['title' => 'Install guide', 'collectionId' => 'collection-1']);
        $service->call('updateredirectrule', ['id' => 'redirect-1', 'targetUrl' => '/new']);
        $service->call('createconversation', ['subject' => 'Question']);
        $service->call('attachconversationtag', ['id' => 'conv-1', 'tagId' => 'tag-1']);
        $service->call('detachconversationtag', ['id' => 'conv-1', 'tag_id' => 'tag-1']);
        $service->call('replytoconversation', ['id' => 'conv-1', 'body' => 'Reply']);
        $service->call('redactconversationpart', ['conversationId' => 'conv-1', 'partId' => 'part-1']);
        $service->call('createticket', ['title' => 'Broken flow']);
        $service->call('replytoticket', ['id' => '42', 'body' => 'Ticket reply']);
        $service->call('createwebhook', ['url' => 'https://example.test/webhook']);
        $service->call('refreshwebhooksecret', ['id' => 'webhook-1']);
        $service->apiGet('/v2/boards');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer fb-token'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Featurebase-Version', '2026-01-01.nova'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://featurebase.test/v2/boards');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/posts' && $request->data()['boardId'] === 'board-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://featurebase.test/v2/posts/post-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://featurebase.test/v2/posts/post-1' && $request->data()['title'] === 'Updated');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_starts_with($request->url(), 'https://featurebase.test/v2/posts/post-1/voters'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://featurebase.test/v2/contacts/by-user-id/external-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://featurebase.test/v2/contacts/by-user-id/external-1/email-preferences' && $request->data()['marketing'] === false);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/companies/company-1/contacts' && $request->data()['contactId'] === 'contact-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://featurebase.test/v2/companies/company-1/contacts/contact-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/help_center/articles');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://featurebase.test/v2/help_center/redirect_rules/redirect-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/conversations');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/conversations/conv-1/tags');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://featurebase.test/v2/conversations/conv-1/tags/tag-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/conversations/conv-1/reply');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/conversations/redact');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/tickets');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/tickets/42/reply');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://featurebase.test/v2/webhooks/webhook-1/secret');
    }

    public function test_tools_map_agent_arguments_validate_paths_and_report_errors(): void
    {
        Http::fake([
            'https://featurebase.test/*' => Http::response(['id' => 'ok'], 200),
        ]);

        $service = new FeaturebaseService('fb-token', 'https://featurebase.test');

        self::assertTrue((new FeaturebaseCreatePost($service))->execute([
            'payload' => ['boardId' => 'board-1', 'title' => 'Export data'],
        ])->succeeded());
        self::assertTrue((new FeaturebaseGetContactByUserId($service))->execute(['user_id' => 'external-1'])->succeeded());

        $badRaw = (new FeaturebaseApiGet($service))->execute(['path' => 'https://evil.example.test/v2/boards']);
        self::assertFalse($badRaw->succeeded());
        self::assertStringContainsString('relative path', (string) $badRaw->error);

        $unconfigured = (new FeaturebaseApiGet(new FeaturebaseService('', 'https://featurebase.test')))->execute(['path' => '/v2/boards']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new FeaturebaseToolProvider();

        self::assertSame(['success' => false, 'error' => 'Featurebase API key is required.'], $provider->testConnection([]));

        Http::fake(['https://do.featurebase.app/v2/boards' => Http::response(['object' => 'list', 'data' => []], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Featurebase API.'], $provider->testConnection([
            'api_key' => 'fb-token',
        ]));

        Http::swap(new HttpFactory);
        Http::fake(['https://ops.featurebase.test/v2/boards' => Http::response(['object' => 'list', 'data' => []], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['featurebase', 'api_key', 'ops'] => 'account-token',
                    ['featurebase', 'url', 'ops'] => 'https://ops.featurebase.test',
                    ['featurebase', 'api_version', 'ops'] => '2026-01-01.nova',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'featurebase' && $account === 'ops';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'featurebase' ? ['ops'] : [];
            }
        });

        $tool = $provider->createTool($provider->tools()['featurebase_list_boards']['class'], ['account' => 'ops']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://ops.featurebase.test/v2/boards'
            && $request->hasHeader('Authorization', 'Bearer account-token'));
    }
}
