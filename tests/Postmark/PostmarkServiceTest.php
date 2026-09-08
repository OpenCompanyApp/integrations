<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Postmark;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Postmark\PostmarkService;
use OpenCompany\Integrations\Postmark\PostmarkToolProvider;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetCurrentUser;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetMessage;
use OpenCompany\Integrations\Postmark\Tools\PostmarkGetTemplate;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListMessages;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListServers;
use OpenCompany\Integrations\Postmark\Tools\PostmarkListTemplates;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendEmail;
use OpenCompany\Integrations\Postmark\Tools\PostmarkSendTemplate;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Postmark integration.
 */
final class PostmarkServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(PostmarkService::class);
        app()->forgetInstance(CredentialResolver::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(PostmarkService::class);
        app()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_credentials_and_docs(): void
    {
        $provider = new PostmarkToolProvider;

        self::assertSame('postmark', $provider->appName());
        self::assertSame('Postmark', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('api_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertContains('server_token', $provider->integrationCapabilities()['auth']['token_keys']);
        self::assertTrue($provider->credentialFields()[0]['required']);
        self::assertSame('account_token', $provider->credentialFields()[1]['key']);
        self::assertFalse($provider->credentialFields()[1]['required']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(9, $provider->tools());
        self::assertContains('postmark_send_template', array_keys($provider->tools()));
    }

    public function test_message_template_and_server_routes_are_mapped(): void
    {
        $service = new PostmarkService(
            serverToken: 'server-token',
            accountToken: 'account-token',
            baseUrl: 'https://postmark.example.test',
        );

        Http::fake(['*' => Http::response(['Messages' => [['MessageID' => 'msg-123']]], 200)]);
        self::assertTrue((new PostmarkListMessages($service))->execute(['count' => 25, 'offset' => 5, 'recipient' => 'person@example.test'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://postmark.example.test/messages/outbound?')
            && $request->hasHeader('X-Postmark-Server-Token', 'server-token')
            && str_contains($request->url(), 'count=25')
            && str_contains($request->url(), 'offset=5')
            && str_contains($request->url(), 'recipient=person%40example.test'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['MessageID' => 'msg-123', 'Subject' => 'Hello'], 200)]);
        self::assertTrue((new PostmarkGetMessage($service))->execute(['message_id' => 'msg-123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://postmark.example.test/messages/outbound/msg-123/details'
            && $request->hasHeader('X-Postmark-Server-Token', 'server-token'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Templates' => [['TemplateId' => 123]]], 200)]);
        self::assertTrue((new PostmarkListTemplates($service))->execute(['count' => 10])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://postmark.example.test/templates?')
            && str_contains($request->url(), 'count=10'));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['TemplateId' => 123], 200)]);
        self::assertTrue((new PostmarkGetTemplate($service))->execute(['template_id' => '123'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://postmark.example.test/templates/123');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Servers' => [['ID' => 111, 'Name' => 'Primary']]], 200)]);
        self::assertTrue((new PostmarkListServers($service))->execute(['name' => 'Primary'])->succeeded());
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://postmark.example.test/servers?')
            && $request->hasHeader('X-Postmark-Account-Token', 'account-token')
            && ! $request->hasHeader('X-Postmark-Server-Token')
            && str_contains($request->url(), 'name=Primary'));
    }

    public function test_send_email_and_template_payloads_are_mapped(): void
    {
        $service = new PostmarkService(serverToken: 'server-token', baseUrl: 'https://postmark.example.test');

        Http::fake(['*' => Http::response(['MessageID' => 'msg-123', 'ErrorCode' => 0], 200)]);
        $sent = (new PostmarkSendEmail($service))->execute([
            'From' => 'sender@example.test',
            'To' => 'person@example.test',
            'Subject' => 'Hello',
            'TextBody' => 'Plain text',
            'Tag' => 'welcome',
        ]);

        self::assertTrue($sent->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://postmark.example.test/email'
            && $request->hasHeader('X-Postmark-Server-Token', 'server-token')
            && $request['From'] === 'sender@example.test'
            && $request['To'] === 'person@example.test'
            && $request['TextBody'] === 'Plain text'
            && $request['Tag'] === 'welcome');

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['MessageID' => 'msg-456', 'SubmittedAt' => '2026-05-07T12:00:00Z', 'To' => 'person@example.test', 'ErrorCode' => 0], 200)]);
        $templated = (new PostmarkSendTemplate($service))->execute([
            'From' => 'sender@example.test',
            'To' => 'person@example.test',
            'TemplateAlias' => 'welcome',
            'TemplateModel' => ['name' => 'Ada'],
            'TrackOpens' => true,
        ]);

        self::assertTrue($templated->succeeded());
        self::assertSame('msg-456', $templated->data['message_id']);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://postmark.example.test/email/withTemplate'
            && $request['TemplateAlias'] === 'welcome'
            && $request['TemplateModel'] === ['name' => 'Ada']
            && $request['TrackOpens'] === true);
    }

    public function test_validation_api_errors_test_connection_and_multi_account(): void
    {
        $service = new PostmarkService(serverToken: 'server-token', baseUrl: 'https://postmark.example.test');

        $missingMessage = (new PostmarkGetMessage($service))->execute([]);
        self::assertFalse($missingMessage->succeeded());
        self::assertStringContainsString('message_id is required', (string) $missingMessage->error);

        $missingSendField = (new PostmarkSendEmail($service))->execute(['From' => 'sender@example.test']);
        self::assertFalse($missingSendField->succeeded());
        self::assertStringContainsString('To is required', (string) $missingSendField->error);

        $missingTemplateRecipient = (new PostmarkSendTemplate($service))->execute(['From' => 'sender@example.test', 'TemplateAlias' => 'welcome']);
        self::assertFalse($missingTemplateRecipient->succeeded());
        self::assertStringContainsString('To is required', (string) $missingTemplateRecipient->error);

        $missingAccountToken = (new PostmarkListServers($service))->execute([]);
        self::assertFalse($missingAccountToken->succeeded());
        self::assertStringContainsString('account token is required', (string) $missingAccountToken->error);

        Http::fake(['*' => Http::response(['ErrorCode' => 10, 'Message' => 'Inactive recipient'], 200)]);
        $postmarkError = (new PostmarkSendTemplate($service))->execute([
            'From' => 'sender@example.test',
            'To' => 'person@example.test',
            'TemplateId' => 123,
        ]);
        self::assertFalse($postmarkError->succeeded());
        self::assertStringContainsString('Inactive recipient', (string) $postmarkError->error);

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Name' => 'Primary'], 200)]);
        self::assertSame(['success' => true, 'message' => 'Connected to Postmark server: Primary.'], (new PostmarkToolProvider)->testConnection(['server_token' => 'server-token']));

        Http::swap(new HttpFactory);
        Http::fake(['*' => Http::response(['Name' => 'Primary'], 200)]);
        app()->instance(CredentialResolver::class, new class implements CredentialResolver
        {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                return match ([$integration, $key, $account]) {
                    ['postmark', 'server_token', 'mail'] => 'account-server-token',
                    ['postmark', 'account_token', 'mail'] => 'account-account-token',
                    ['postmark', 'base_url', 'mail'] => 'https://postmark.example.test',
                    default => $default,
                };
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'postmark' && $account === 'mail';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'postmark' ? ['mail'] : [];
            }
        });

        $tool = (new PostmarkToolProvider)->createTool(PostmarkGetCurrentUser::class, ['account' => 'mail']);
        self::assertTrue($tool->execute([])->succeeded());
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-Postmark-Server-Token', 'account-server-token'));
    }
}
