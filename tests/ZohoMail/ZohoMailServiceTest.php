<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ZohoMail;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailApiGet;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailGetMessage;
use OpenCompany\Integrations\ZohoMail\Tools\ZohoMailUpdateMessages;
use OpenCompany\Integrations\ZohoMail\ZohoMailService;
use OpenCompany\Integrations\ZohoMail\ZohoMailToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Zoho Mail REST API integration.
 */
final class ZohoMailServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(ZohoMailService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(ZohoMailService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_and_docs(): void
    {
        $provider = new ZohoMailToolProvider;

        self::assertSame('zoho-mail', $provider->appName());
        self::assertSame('Zoho Mail', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->luaDocsPath());
        self::assertCount(29, $provider->tools());
        self::assertArrayHasKey('zohomail_search_messages', $provider->tools());
        self::assertArrayHasKey('zohomail_get_attachment_info', $provider->tools());
        self::assertArrayHasKey('zohomail_update_messages', $provider->tools());
        self::assertArrayHasKey('zohomail_create_label', $provider->tools());
        self::assertArrayHasKey('zohomail_api_put', $provider->tools());
    }

    public function test_service_uses_current_api_base_auth_header_and_mailbox_paths(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true]], 200)]);

        $service = new ZohoMailService('token-test', 'https://mail.example.test/api');
        $service->listAccounts();
        $service->listMessages('account-123', ['folderId' => 'folder-123', 'limit' => 25]);
        $service->getMessage('account-123', 'folder-123', 'message-123', true);
        $service->getAttachmentInfo('account-123', 'folder-123', 'message-123');
        $service->sendMessage('account-123', ['toAddress' => 'recipient@example.test', 'subject' => 'Hello']);
        $service->updateMessages('account-123', ['mode' => 'markAsRead', 'messageId' => ['message-123']]);
        $service->createLabel('account-123', ['labelName' => 'Follow up']);
        $service->apiGet('/accounts/account-123/folders', ['ids' => ['one', 'two']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mail.example.test/api/accounts'
            && $request->hasHeader('Authorization', 'Zoho-oauthtoken token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mail.example.test/api/accounts/account-123/messages/view?folderId=folder-123&limit=25');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mail.example.test/api/accounts/account-123/folders/folder-123/messages/message-123/content?includeBlockContent=true');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT'
            && $request->url() === 'https://mail.example.test/api/accounts/account-123/updatemessage'
            && $request['mode'] === 'markAsRead');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mail.example.test/api/accounts/account-123/folders?ids=one&ids=two');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/accounts');
    }

    public function test_tools_validate_required_arguments_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['data' => ['ok' => true]], 200)]);

        $service = new ZohoMailService('token-test', 'https://mail.example.test/api');
        $message = (new ZohoMailGetMessage($service))->execute([
            'accountId' => 'account-123',
            'folderId' => 'folder-123',
            'messageId' => 'message-123',
        ]);
        $updated = (new ZohoMailUpdateMessages($service))->execute([
            'accountId' => 'account-123',
            'payload' => ['mode' => 'markAsUnread', 'messageId' => ['message-123']],
        ]);
        $raw = (new ZohoMailApiGet($service))->execute(['path' => '/accounts']);

        self::assertTrue($message->succeeded());
        self::assertTrue($updated->succeeded());
        self::assertTrue($raw->succeeded());

        $missing = (new ZohoMailGetMessage($service))->execute(['accountId' => 'account-123']);
        self::assertFalse($missing->succeeded());
        self::assertStringContainsString('folderId is required', (string) $missing->error);

        $unconfigured = (new ZohoMailApiGet(new ZohoMailService('', 'https://mail.example.test/api')))->execute(['path' => '/accounts']);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);
    }

    public function test_connection_uses_accounts_endpoint(): void
    {
        Http::fake(['*' => Http::response(['data' => ['accounts' => []]], 200)]);

        $result = (new ZohoMailToolProvider)->testConnection([
            'access_token' => 'token-test',
            'url' => 'https://mail.example.test/api',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://mail.example.test/api/accounts'
            && $request->hasHeader('Authorization', 'Zoho-oauthtoken token-test'));
    }
}
