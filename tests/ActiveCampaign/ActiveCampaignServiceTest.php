<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ActiveCampaign;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignService;
use OpenCompany\Integrations\ActiveCampaign\ActiveCampaignToolProvider;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignAddContactTag;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignApiGet;
use OpenCompany\Integrations\ActiveCampaign\Tools\ActiveCampaignSyncContact;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded ActiveCampaign API v3 coverage.
 */
final class ActiveCampaignServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_contacts_tags_fields_campaigns_accounts_and_deal_metadata(): void
    {
        Http::fake([
            'https://example.api-us1.com/api/3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ActiveCampaignService('ac_test', 'example');

        $service->getCurrentUser();
        $service->listUsers(['limit' => 10]);
        $service->syncContact(['email' => 'person@example.test']);
        $service->listTags(['limit' => 10]);
        $service->createTag('Lead', 'Sales lead');
        $service->addContactTag(123, 456);
        $service->removeContactTag(789);
        $service->listContactTags(123);
        $service->listFields(['limit' => 100]);
        $service->createField(['title' => 'Plan', 'type' => 'text']);
        $service->createFieldValue(123, 456, 'Pro');
        $service->updateFieldValue(789, 'Enterprise');
        $service->listCampaigns(['limit' => 5]);
        $service->getCampaign(123);
        $service->listMessages(['limit' => 5]);
        $service->listAccounts(['limit' => 5]);
        $service->getAccount(123);
        $service->createAccount(['name' => 'Example Co']);
        $service->updateAccount(123, ['name' => 'Updated Co']);
        $service->listDealGroups();
        $service->listDealStages();
        $service->deleteDeal(123);
        $service->apiGet('/contacts', ['limit' => 1]);
        $service->apiPost('/tags', ['tag' => ['tag' => 'VIP']]);
        $service->apiPut('/accounts/123', ['account' => ['name' => 'Updated']]);
        $service->apiDelete('/contactTags/789');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Api-Token', 'ac_test'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/users/me');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/users?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.api-us1.com/api/3/contact/sync');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/tags?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://example.api-us1.com/api/3/tags');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/contactTags');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/contactTags/789');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/contacts/123/contactTags');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/fields?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/fieldValues');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/fieldValues/789');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/campaigns?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/campaigns/123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/messages?'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://example.api-us1.com/api/3/accounts?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/accounts/123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/dealGroups');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/dealStages');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://example.api-us1.com/api/3/deals/123');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://example.api-us1.com/api/3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ActiveCampaignService('ac_test', 'example');

        self::assertTrue((new ActiveCampaignSyncContact($service))->execute([
            'contact' => ['email' => 'person@example.test'],
        ])->succeeded());
        self::assertTrue((new ActiveCampaignAddContactTag($service))->execute([
            'contact_id' => 123,
            'tag_id' => 456,
        ])->succeeded());
        self::assertTrue((new ActiveCampaignApiGet($service))->execute([
            'path' => '/contacts',
            'params' => ['limit' => 1],
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://example.api-us1.com/api/3/users/me' => Http::response(['user' => ['email' => 'person@example.test']], 200),
        ]);

        $provider = new ActiveCampaignToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('activecampaign_sync_contact', $tools);
        self::assertArrayHasKey('activecampaign_list_tags', $tools);
        self::assertArrayHasKey('activecampaign_list_fields', $tools);
        self::assertArrayHasKey('activecampaign_list_campaigns', $tools);
        self::assertArrayHasKey('activecampaign_list_accounts', $tools);
        self::assertArrayHasKey('activecampaign_list_deal_stages', $tools);
        self::assertArrayHasKey('activecampaign_api_delete', $tools);
        self::assertSame(41, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'ac_test', 'account_name' => 'example'])['success']);
    }
}
