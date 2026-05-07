<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\EmailOctopus;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\EmailOctopus\EmailOctopusService;
use OpenCompany\Integrations\EmailOctopus\EmailOctopusToolProvider;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusCreateContact;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusGetCampaignReportOpened;
use OpenCompany\Integrations\EmailOctopus\Tools\EmailOctopusUpdateContactsBulk;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for EmailOctopus v1.6 endpoint mappings.
 */
final class EmailOctopusServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_v16_lists_contacts_campaigns_and_automation_endpoints(): void
    {
        Http::fake([
            'https://emailoctopus.com/api/1.6/*' => Http::response(['success' => true, 'data' => []], 200),
        ]);

        $service = new EmailOctopusService('octo_test', listId: 'list_123');

        $service->listLists(['limit' => 10, 'page' => 2]);
        $service->getList([]);
        $service->createList(['name' => 'Readers']);
        $service->updateList(['name' => 'Customers']);
        $service->deleteList([]);
        $service->listTags([]);
        $service->createTag(['tag' => 'vip']);
        $service->updateTag(['tag' => 'vip', 'new_tag' => 'customer']);
        $service->deleteTag(['tag' => 'customer']);
        $service->listContacts(['limit' => 25]);
        $service->listSubscribedContacts([]);
        $service->listUnsubscribedContacts([]);
        $service->listTaggedContacts(['tag' => 'vip']);
        $service->getContact(['member_id' => 'member_123']);
        $service->createContact(['email_address' => 'reader@example.test', 'fields' => ['FirstName' => 'Ada'], 'tags' => ['vip'], 'status' => 'SUBSCRIBED']);
        $service->updateContact(['member_id' => 'member_123', 'tags' => ['vip' => true]]);
        $service->deleteContact(['member_id' => 'member_123']);
        $service->updateContactsBulk(['data' => [['id' => 'member_123', 'status' => 'UNSUBSCRIBED']]]);
        $service->createField(['tag' => 'Birthday', 'type' => 'DATE', 'label' => 'Birthday']);
        $service->updateField(['tag' => 'Birthday', 'label' => 'Birth date']);
        $service->deleteField(['tag' => 'Birthday']);
        $service->listCampaigns(['limit' => 50]);
        $service->getCampaign(['campaign_id' => 'campaign_123']);
        $service->getCampaignReport(['campaign_id' => 'campaign_123', 'report_type' => 'opened', 'limit' => 100]);
        $service->startAutomation(['automation_id' => 'automation_123', 'list_member_id' => 'member_123']);

        Http::assertSent(static fn (Request $request): bool => str_contains($request->url(), 'api_key=octo_test') || $request['api_key'] === 'octo_test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/lists?') && str_contains($request->url(), 'limit=10'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://emailoctopus.com/api/1.6/lists' && $request['name'] === 'Readers');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/lists/list_123/contacts?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/lists/list_123/contacts/subscribed?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/lists/list_123/tags/vip/contacts?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/contacts' && $request['email_address'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/contacts/member_123' && $request['tags'] === ['vip' => true]);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/contacts' && $request['data'][0]['id'] === 'member_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/fields' && $request['tag'] === 'Birthday');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/campaigns/campaign_123/reports/opened?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://emailoctopus.com/api/1.6/automations/automation_123/queue' && $request['list_member_id'] === 'member_123');
    }

    public function test_tools_delegate_arguments_to_service(): void
    {
        Http::fake([
            'https://emailoctopus.com/api/1.6/*' => Http::response(['success' => true], 200),
        ]);

        $service = new EmailOctopusService('octo_test', listId: 'list_123');

        self::assertNull((new EmailOctopusCreateContact($service))->execute([
            'email_address' => 'reader@example.test',
            'fields' => ['FirstName' => 'Ada'],
            'tags' => ['vip'],
        ])->error);
        self::assertNull((new EmailOctopusUpdateContactsBulk($service))->execute([
            'data' => [['id' => 'member_123', 'status' => 'SUBSCRIBED']],
        ])->error);
        self::assertNull((new EmailOctopusGetCampaignReportOpened($service))->execute([
            'campaign_id' => 'campaign_123',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/contacts' && $request['fields']['FirstName'] === 'Ada');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://emailoctopus.com/api/1.6/lists/list_123/contacts' && $request['data'][0]['status'] === 'SUBSCRIBED');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://emailoctopus.com/api/1.6/campaigns/campaign_123/reports/opened?'));
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://emailoctopus.com/api/1.6/lists*' => Http::response(['data' => []], 200),
        ]);

        $provider = new EmailOctopusToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://emailoctopus.com/api-documentation', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('emailoctopus_list_lists', $tools);
        self::assertArrayHasKey('emailoctopus_update_contacts_bulk', $tools);
        self::assertArrayHasKey('emailoctopus_get_campaign_report_summary', $tools);
        self::assertArrayHasKey('emailoctopus_get_campaign_report_opened', $tools);
        self::assertArrayHasKey('emailoctopus_start_automation', $tools);
        self::assertArrayNotHasKey('emailoctopus_get_current_user', $tools);
        self::assertSame(34, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'octo_test'])['success']);
    }
}
