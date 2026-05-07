<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ConstantContact;

use Illuminate\Http\Client\Request;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\ConstantContact\ConstantContactService;
use OpenCompany\Integrations\ConstantContact\ConstantContactToolProvider;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactApiGet;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactGetCampaign;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListTags;
use OpenCompany\Integrations\ConstantContact\Tools\ConstantContactListContacts;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Constant Contact V3 endpoint coverage.
 */
final class ConstantContactServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_service_maps_contacts_lists_campaigns_reports_segments_and_account_endpoints(): void
    {
        Http::fake([
            'https://api.cc.test/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ConstantContactService('ctct_test', 'https://api.cc.test/v3');

        $service->listContacts(25, null, 'active');
        $service->getContact('contact_123');
        $service->createContact('person@example.test', 'Example', 'Person', ['list_123']);
        $service->createOrUpdateContact(['email_address' => ['address' => 'person@example.test']]);
        $service->updateContact('contact_123', ['first_name' => 'Updated']);
        $service->deleteContact('contact_123');
        $service->getContactActivitySummary('contact_123');
        $service->listLists();
        $service->getList('list_123');
        $service->createList('Newsletter');
        $service->updateList('list_123', ['name' => 'Newsletter']);
        $service->deleteList('list_123');
        $service->listCampaigns(10);
        $service->getCampaign('campaign_123');
        $service->getCampaignActivity('activity_123');
        $service->getEmailSendsReport('activity_123', ['limit' => 10]);
        $service->getEmailBouncesReport('activity_123');
        $service->getEmailClicksReport('activity_123');
        $service->listTags();
        $service->listCustomFields();
        $service->listSegments(['limit' => 10]);
        $service->getSegment('segment_123');
        $service->listActivities(['status' => 'completed']);
        $service->getActivity('activity_bulk_123');
        $service->getAccountSummary(['extra_fields' => 'physical_address']);
        $service->getUserPrivileges();
        $service->apiGet('/reports/email_reports/activity_123/tracking/opens');
        $service->apiPost('/activities/contact_exports', ['file_type' => 'CSV']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer ctct_test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/contacts?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/contacts/contact_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cc.test/v3/contacts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cc.test/v3/contacts/sign_up_form');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.cc.test/v3/contacts/contact_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.cc.test/v3/contacts/contact_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/reports/contact_reports/contact_123/activity_summary');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/contact_lists');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/contact_lists/list_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/emails?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/emails/campaign_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/emails/activities/activity_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/reports/email_reports/activity_123/tracking/sends?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/reports/email_reports/activity_123/tracking/bounces');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/reports/email_reports/activity_123/tracking/clicks');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/contact_tags');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/contact_custom_fields');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/segments?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/segments/segment_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/activities?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/activities/activity_bulk_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.cc.test/v3/account/summary?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/account/user/privileges');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.cc.test/v3/reports/email_reports/activity_123/tracking/opens');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.cc.test/v3/activities/contact_exports');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.cc.test/v3/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ConstantContactService('ctct_test', 'https://api.cc.test/v3');

        self::assertTrue((new ConstantContactGetCampaign($service))->execute([
            'campaign_id' => 'campaign_123',
        ])->succeeded());
        self::assertTrue((new ConstantContactListTags($service))->execute([])->succeeded());
        self::assertTrue((new ConstantContactApiGet($service))->execute([
            'path' => '/account/summary',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.cc.email/v3/account/summary' => Http::response(['organization_name' => 'Example'], 200),
        ]);

        $provider = new ConstantContactToolProvider();
        $tools = $provider->tools();

        self::assertSame('constant-contact', $provider->appName());
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('constantcontact_update_contact', $tools);
        self::assertArrayHasKey('constantcontact_get_campaign', $tools);
        self::assertArrayHasKey('constantcontact_get_email_sends_report', $tools);
        self::assertArrayHasKey('constantcontact_list_tags', $tools);
        self::assertArrayHasKey('constantcontact_list_segments', $tools);
        self::assertArrayHasKey('constantcontact_get_account_summary', $tools);
        self::assertArrayHasKey('constantcontact_api_get', $tools);
        self::assertSame(29, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'ctct_test'])['success']);
    }

    public function test_multi_account_resolution_supports_legacy_constant_contact_credentials(): void
    {
        Http::fake([
            'https://legacy-cc.example.test/v3/contacts*' => Http::response(['contacts' => []], 200),
        ]);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                if ($integration === 'constant-contact') {
                    return '';
                }

                if ($integration === 'constant_contact' && $account === 'marketing') {
                    return match ($key) {
                        'access_token' => 'legacy-ctct-token',
                        'url' => 'https://legacy-cc.example.test/v3',
                        default => $default,
                    };
                }

                return $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return $integration === 'constant_contact' && $account === 'marketing';
            }

            public function getAccounts(string $integration): array
            {
                return $integration === 'constant_contact' ? ['marketing'] : [];
            }
        });

        $tool = (new ConstantContactToolProvider)->createTool(ConstantContactListContacts::class, ['account' => 'marketing']);
        $result = $tool->execute(['limit' => 25]);

        self::assertTrue($result->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://legacy-cc.example.test/v3/contacts?limit=25'
            && $request->hasHeader('Authorization', 'Bearer legacy-ctct-token'));
    }
}
