<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\RingCentral;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\RingCentral\RingCentralService;
use OpenCompany\Integrations\RingCentral\RingCentralToolProvider;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralApiGet;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralGetExtension;
use OpenCompany\Integrations\RingCentral\Tools\RingCentralUpdateMessage;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded RingCentral REST API coverage.
 */
final class RingCentralServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_messages_calls_contacts_account_and_generic_endpoints(): void
    {
        Http::fake([
            'https://platform.ringcentral.com/restapi/v1.0/*' => Http::response(['ok' => true, 'records' => []], 200),
        ]);

        $service = new RingCentralService('rc_test');

        $service->getCurrentUser();
        $service->getAccount();
        $service->listExtensions(['perPage' => 10]);
        $service->getExtension('ext_1');
        $service->listAccountPhoneNumbers(['usageType' => 'DirectNumber']);
        $service->listExtensionPhoneNumbers();
        $service->getPresence(['detailedTelephonyState' => true]);
        $service->listMessages(['messageType' => 'Sms']);
        $service->getMessage('msg_1');
        $service->updateMessage('msg_1', ['readStatus' => 'Read']);
        $service->deleteMessage('msg_1');
        $service->sendSms('+16505550100', '+16505550101', 'Hello');
        $service->listCalls(['direction' => 'Inbound']);
        $service->listAccountCalls(['perPage' => 100]);
        $service->getCall('call_1');
        $service->listContacts(['startsWith' => 'Ada']);
        $service->getContact('contact_1');
        $service->createContact(['firstName' => 'Ada']);
        $service->updateContact('contact_1', ['lastName' => 'Lovelace']);
        $service->deleteContact('contact_1');
        $service->apiGet('/restapi/v1.0/account/~');
        $service->apiPost('/restapi/v1.0/account/~/extension/~/sms', ['text' => 'Hello']);
        $service->apiPut('/restapi/v1.0/account/~/extension/~/message-store/msg_1', ['readStatus' => 'Read']);
        $service->apiDelete('/restapi/v1.0/account/~/extension/~/message-store/msg_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer rc_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/ext_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://platform.ringcentral.com/restapi/v1.0/account/~/phone-number?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/phone-number');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/presence?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/message-store/msg_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/sms');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://platform.ringcentral.com/restapi/v1.0/account/~/call-log?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/call-log/call_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/address-book/contact');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~/address-book/contact/contact_1');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://platform.ringcentral.com/restapi/v1.0/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new RingCentralService('rc_test');

        self::assertTrue((new RingCentralGetExtension($service))->execute([
            'extension_id' => 'ext_1',
        ])->succeeded());
        self::assertTrue((new RingCentralUpdateMessage($service))->execute([
            'message_id' => 'msg_1',
            'readStatus' => 'Read',
        ])->succeeded());
        self::assertTrue((new RingCentralApiGet($service))->execute([
            'path' => '/restapi/v1.0/account/~',
        ])->succeeded());
        self::assertFalse((new RingCentralGetExtension($service))->execute([])->succeeded());
        self::assertFalse((new RingCentralUpdateMessage($service))->execute([
            'message_id' => 'msg_1',
        ])->succeeded());
        self::assertFalse((new RingCentralApiGet($service))->execute([
            'path' => 'https://example.test/restapi/v1.0/account/~',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://platform.ringcentral.com/restapi/v1.0/account/~/extension/~' => Http::response(['name' => 'Example'], 200),
        ]);

        $provider = new RingCentralToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('ringcentral_get_account', $tools);
        self::assertArrayHasKey('ringcentral_list_extensions', $tools);
        self::assertArrayHasKey('ringcentral_list_account_phone_numbers', $tools);
        self::assertArrayHasKey('ringcentral_get_presence', $tools);
        self::assertArrayHasKey('ringcentral_update_message', $tools);
        self::assertArrayHasKey('ringcentral_delete_contact', $tools);
        self::assertArrayHasKey('ringcentral_api_delete', $tools);
        self::assertSame(24, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'rc_test',
        ])['success']);
    }
}
