<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MessageBird;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\MessageBird\MessageBirdService;
use OpenCompany\Integrations\MessageBird\MessageBirdToolProvider;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdCreateContact;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdCreateVerify;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendSms;
use OpenCompany\Integrations\MessageBird\Tools\MessageBirdSendVoiceMessage;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for MessageBird REST API endpoint mappings and provider metadata.
 */
final class MessageBirdServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_messagebird_rest_api_paths_with_accesskey_auth(): void
    {
        Http::fake([
            'https://messagebird.example.test/messages*' => Http::response(['id' => 'msg_123', 'items' => []], 200),
            'https://messagebird.example.test/messages/msg_123' => Http::response(['id' => 'msg_123'], 200),
            'https://messagebird.example.test/voicemessages*' => Http::response(['id' => 'voice_123', 'items' => []], 200),
            'https://messagebird.example.test/voicemessages/voice_123' => Http::response(['id' => 'voice_123'], 200),
            'https://messagebird.example.test/contacts*' => Http::response(['id' => 'contact_123', 'items' => []], 200),
            'https://messagebird.example.test/contacts/contact_123' => Http::response(['id' => 'contact_123'], 200),
            'https://messagebird.example.test/contacts/contact_123/groups' => Http::response(['items' => []], 200),
            'https://messagebird.example.test/contacts/contact_123/messages*' => Http::response(['items' => []], 200),
            'https://messagebird.example.test/groups*' => Http::response(['id' => 'group_123', 'items' => []], 200),
            'https://messagebird.example.test/groups/group_123' => Http::response(['id' => 'group_123'], 200),
            'https://messagebird.example.test/groups/group_123/contacts*' => Http::response(['items' => []], 200),
            'https://messagebird.example.test/groups/group_123/contacts/contact_123' => Http::response([], 204),
            'https://messagebird.example.test/lookup/31612345678*' => Http::response(['phoneNumber' => 31612345678], 200),
            'https://messagebird.example.test/lookup/31612345678/hlr' => Http::response(['id' => 'hlr_123'], 200),
            'https://messagebird.example.test/verify*' => Http::response(['id' => 'verify_123'], 200),
            'https://messagebird.example.test/verify/verify_123*' => Http::response(['id' => 'verify_123'], 200),
            'https://messagebird.example.test/balance' => Http::response(['amount' => 10, 'type' => 'prepaid'], 200),
            'https://messagebird.example.test/numbers*' => Http::response(['items' => []], 200),
            'https://messagebird.example.test/numbers/31612345678' => Http::response(['number' => '31612345678'], 200),
        ]);

        $service = new MessageBirdService('key_test', 'https://messagebird.example.test/');
        $service->sendSms('ExampleCo', ['31612345678'], 'Hello', ['reference' => 'ord_123']);
        $service->listMessages(['limit' => 10, 'status' => 'delivered']);
        $service->getMessage('msg_123');
        $service->deleteMessage('msg_123');
        $service->sendVoiceMessage('31612345678', ['31687654321'], 'Hello voice', ['language' => 'en-gb']);
        $service->listVoiceMessages(['limit' => 10]);
        $service->getVoiceMessage('voice_123');
        $service->deleteVoiceMessage('voice_123');
        $service->listContacts(['limit' => 10]);
        $service->createContact(['msisdn' => 31612345678, 'firstName' => 'Ada']);
        $service->getContact('contact_123');
        $service->updateContact('contact_123', ['firstName' => 'Grace']);
        $service->deleteContact('contact_123');
        $service->listContactGroups('contact_123');
        $service->listContactMessages('contact_123', ['limit' => 5]);
        $service->listGroups(['limit' => 10]);
        $service->createGroup('Customers');
        $service->getGroup('group_123');
        $service->updateGroup('group_123', 'VIP');
        $service->deleteGroup('group_123');
        $service->listGroupContacts('group_123', ['limit' => 5]);
        $service->addContactToGroup('group_123', 'contact_123');
        $service->removeContactFromGroup('group_123', 'contact_123');
        $service->lookupPhoneNumber('31612345678', 'NL');
        $service->getHlrLookup('31612345678');
        $service->requestHlrLookup('31612345678', ['reference' => 'crm_123']);
        $service->createVerify('31612345678', ['originator' => 'Code']);
        $service->getVerify('verify_123');
        $service->verifyToken('verify_123', '123456');
        $service->deleteVerify('verify_123');
        $service->listBalance();
        $service->listNumbers(['country_code' => 'NL']);
        $service->getNumber('31612345678');
        $service->updateNumber('31612345678', ['smsUrl' => 'https://example.test/inbound']);
        $service->getCurrentUser();

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'AccessKey key_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://messagebird.example.test/messages' && $request['originator'] === 'ExampleCo' && $request['reference'] === 'ord_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://messagebird.example.test/messages?') && str_contains($request->url(), 'status=delivered'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://messagebird.example.test/messages/msg_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://messagebird.example.test/voicemessages' && $request['language'] === 'en-gb');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://messagebird.example.test/contacts/contact_123' && $request['firstName'] === 'Grace');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://messagebird.example.test/groups/group_123/contacts/contact_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://messagebird.example.test/lookup/31612345678?') && str_contains($request->url(), 'countryCode=NL'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://messagebird.example.test/lookup/31612345678/hlr' && $request['reference'] === 'crm_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://messagebird.example.test/verify/verify_123?') && str_contains($request->url(), 'token=123456'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://messagebird.example.test/numbers/31612345678' && $request['smsUrl'] === 'https://example.test/inbound');
    }

    public function test_tools_map_agent_arguments_to_current_payloads(): void
    {
        Http::fake([
            'https://messagebird.example.test/messages' => Http::response(['id' => 'msg_123'], 200),
            'https://messagebird.example.test/voicemessages' => Http::response(['id' => 'voice_123'], 200),
            'https://messagebird.example.test/contacts' => Http::response(['id' => 'contact_123'], 200),
            'https://messagebird.example.test/verify' => Http::response(['id' => 'verify_123'], 200),
        ]);

        $service = new MessageBirdService('key_test', 'https://messagebird.example.test');
        self::assertNull((new MessageBirdSendSms($service))->execute([
            'originator' => 'ExampleCo',
            'recipients' => ['31612345678'],
            'body' => 'Hello',
            'options' => ['reference' => 'ord_123'],
        ])->error);
        self::assertNull((new MessageBirdSendVoiceMessage($service))->execute([
            'originator' => '31612345678',
            'recipients' => ['31687654321'],
            'body' => 'Hello voice',
            'options' => ['language' => 'en-gb'],
        ])->error);
        self::assertNull((new MessageBirdCreateContact($service))->execute([
            'contact' => ['msisdn' => 31612345678, 'firstName' => 'Ada'],
        ])->error);
        self::assertNull((new MessageBirdCreateVerify($service))->execute([
            'recipient' => '31612345678',
            'options' => ['originator' => 'Code'],
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://messagebird.example.test/messages' && $request['reference'] === 'ord_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://messagebird.example.test/voicemessages' && $request['language'] === 'en-gb');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://messagebird.example.test/contacts' && $request['firstName'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://messagebird.example.test/verify' && $request['originator'] === 'Code');
    }

    public function test_provider_exposes_expanded_surface_and_allowed_category(): void
    {
        $provider = new MessageBirdToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.messagebird.com/api/', $provider->integrationMeta()['docs_url']);
        self::assertSame('https://rest.messagebird.com', $provider->credentialFields()[1]['default']);
        self::assertArrayHasKey('messagebird_send_voice_message', $tools);
        self::assertArrayHasKey('messagebird_create_contact', $tools);
        self::assertArrayHasKey('messagebird_add_contact_to_group', $tools);
        self::assertArrayHasKey('messagebird_lookup_phone_number', $tools);
        self::assertArrayHasKey('messagebird_create_verify', $tools);
        self::assertArrayHasKey('messagebird_update_number', $tools);
        self::assertSame(35, count($tools));
    }
}
