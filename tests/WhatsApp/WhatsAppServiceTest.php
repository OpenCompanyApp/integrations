<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\WhatsApp;

use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppApiGet;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppCheckContacts;
use OpenCompany\Integrations\WhatsApp\Tools\WhatsAppListTemplates;
use OpenCompany\Integrations\WhatsApp\WhatsAppService;
use OpenCompany\Integrations\WhatsApp\WhatsAppToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the WhatsApp Business Platform integration.
 */
final class WhatsAppServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
        app()->forgetInstance(WhatsAppService::class);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        app()->forgetInstance(WhatsAppService::class);
        parent::tearDown();
    }

    public function test_provider_metadata_tools_category_credentials_and_docs(): void
    {
        $provider = new WhatsAppToolProvider;

        self::assertSame('whatsapp', $provider->appName());
        self::assertSame('WhatsApp Business', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());
        self::assertCount(30, $provider->tools());
        self::assertArrayHasKey('whatsapp_send_message_payload', $provider->tools());
        self::assertArrayHasKey('whatsapp_check_contacts', $provider->tools());
        self::assertArrayHasKey('whatsapp_create_template', $provider->tools());
        self::assertArrayHasKey('whatsapp_list_phone_numbers', $provider->tools());
        self::assertArrayHasKey('whatsapp_subscribe_app', $provider->tools());
        self::assertContains('whatsapp_business_account_id', array_column($provider->credentialFields(), 'key'));
    }

    public function test_service_uses_waba_template_endpoint_and_contact_validation_endpoint(): void
    {
        Http::fake(['*' => Http::response(['data' => [['id' => 'ok']]], 200)]);

        $service = new WhatsAppService('token-test', 'phone-123', 'waba-456', 'https://example.test/v24.0');

        $templates = $service->listTemplates(25, 'cursor-test', 'APPROVED', 'order_update');
        $contacts = $service->checkContacts(['15551234567']);

        self::assertSame('ok', $templates['data'][0]['id']);
        self::assertSame('ok', $contacts['data'][0]['id']);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v24.0/waba-456/message_templates?limit=25&fields=id%2Cname%2Cstatus%2Clanguage%2Ccategory%2Ccomponents%2Cquality_score%2Crejected_reason&after=cursor-test&status=APPROVED&name=order_update'
            && $request->hasHeader('Authorization', 'Bearer token-test'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v24.0/phone-123/contacts'
            && $request['messaging_product'] === 'whatsapp'
            && $request['contacts'] === ['15551234567']);
    }

    public function test_service_maps_message_media_phone_profile_subscription_and_raw_paths(): void
    {
        Http::fake(['*' => Http::response(['success' => true], 200)]);

        $service = new WhatsAppService('token-test', 'phone-123', 'waba-456', 'https://example.test/v24.0');
        $service->sendMessagePayload(['to' => '15551234567', 'type' => 'image', 'image' => ['link' => 'https://example.test/image.jpg']]);
        $service->markMessageRead('wamid-test');
        $service->getMedia('media-123');
        $service->deleteMedia('media-123');
        $service->getPhoneNumber();
        $service->listPhoneNumbers(10);
        $service->getBusinessProfile();
        $service->updateBusinessProfile(['about' => 'Support']);
        $service->subscribeApp();
        $service->listSubscribedApps();
        $service->unsubscribeApp();
        $service->apiGet('/me', ['fields' => 'id,name', 'ids' => ['one', 'two']]);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v24.0/phone-123/messages'
            && $request['messaging_product'] === 'whatsapp'
            && ($request->data()['type'] ?? null) === 'image');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v24.0/waba-456/phone_numbers?limit=10&fields=id%2Cdisplay_phone_number%2Cverified_name%2Ccode_verification_status%2Cquality_rating%2Cplatform_type%2Cthroughput');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://example.test/v24.0/phone-123/whatsapp_business_profile'
            && $request['messaging_product'] === 'whatsapp');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE'
            && $request->url() === 'https://example.test/v24.0/waba-456/subscribed_apps');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v24.0/me?fields=id%2Cname&ids=one&ids=two');

        $this->expectException(\RuntimeException::class);
        $service->apiGet('https://evil.example.test/me');
    }

    public function test_endpoint_tools_require_relevant_configuration_and_preserve_legacy_contacts_alias(): void
    {
        Http::fake(['*' => Http::response(['data' => [['id' => 'ok']]], 200)]);

        $service = new WhatsAppService('token-test', 'phone-123', 'waba-456', 'https://example.test/v24.0');

        $contacts = (new WhatsAppCheckContacts($service))->execute(['contacts' => ['15551234567']]);
        self::assertTrue($contacts->succeeded());

        $templates = (new WhatsAppListTemplates($service))->execute(['limit' => 5]);
        self::assertTrue($templates->succeeded());

        $raw = (new WhatsAppApiGet($service))->execute([
            'path' => '/me',
            'params' => ['fields' => 'id'],
        ]);
        self::assertTrue($raw->succeeded());

        $missingWaba = (new WhatsAppListTemplates(new WhatsAppService('token-test', 'phone-123', '', 'https://example.test/v24.0')))->execute([]);
        self::assertFalse($missingWaba->succeeded());
        self::assertStringContainsString('Business Account ID', (string) $missingWaba->error);
    }

    public function test_connection_uses_current_graph_base_url(): void
    {
        Http::fake(['*' => Http::response(['id' => 'user-123', 'name' => 'Test User'], 200)]);

        $result = (new WhatsAppToolProvider)->testConnection([
            'access_token' => 'token-test',
            'base_url' => 'https://example.test/v24.0',
        ]);

        self::assertTrue($result['success']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://example.test/v24.0/me?fields=id%2Cname'
            && $request->hasHeader('Authorization', 'Bearer token-test'));
    }
}
