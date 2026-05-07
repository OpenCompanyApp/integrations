<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\ElasticEmail;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\ElasticEmail\ElasticEmailService;
use OpenCompany\Integrations\ElasticEmail\ElasticEmailToolProvider;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailApiGet;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailGetContact;
use OpenCompany\Integrations\ElasticEmail\Tools\ElasticEmailListCampaigns;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Elastic Email API v4 routing.
 */
final class ElasticEmailServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_v4_email_contact_list_campaign_event_and_stats_endpoints(): void
    {
        Http::fake([
            'https://api.elasticemail.test/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ElasticEmailService('elastic_test', 'https://api.elasticemail.test/v4');

        $service->sendEmail('person@example.test', 'Subject', '<p>Hello</p>', ['from' => 'sender@example.test']);
        $service->sendBulkEmail(['Recipients' => ['To' => ['person@example.test']]]);
        $service->getEmailStatus('tx_123');
        $service->listTemplates(['limit' => 10]);
        $service->getTemplate('welcome');
        $service->listContacts(['limit' => 10]);
        $service->getContact('person@example.test');
        $service->createContact('person@example.test', 'Newsletter');
        $service->updateContact('person@example.test', ['FirstName' => 'Example']);
        $service->deleteContact('person@example.test');
        $service->listLists();
        $service->getList('Newsletter');
        $service->listListContacts('Newsletter');
        $service->addContactsToList('Newsletter', ['person@example.test']);
        $service->removeContactsFromList('Newsletter', ['person@example.test']);
        $service->listCampaigns();
        $service->getCampaign('Launch');
        $service->pauseCampaign('Launch');
        $service->listEvents(['limit' => 10]);
        $service->listEmailEvents('tx_123');
        $service->listSuppressions('bounces');
        $service->getStatistics();
        $service->getCampaignStatistics('Launch');
        $service->listFiles();
        $service->apiGet('/domains');
        $service->apiPost('/contacts/export', ['FileFormat' => 'Csv']);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('X-ElasticEmail-ApiKey', 'elastic_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/emails/transactional' && $request['Content']['Subject'] === 'Subject');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/emails');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/emails/tx_123/status');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.elasticemail.test/v4/templates?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/templates/welcome');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.elasticemail.test/v4/contacts?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/contacts/person%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/contacts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.elasticemail.test/v4/contacts/person%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.elasticemail.test/v4/contacts/person%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/lists');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/lists/Newsletter');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/lists/Newsletter/contacts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/lists/Newsletter/contacts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/lists/Newsletter/contacts/remove');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/campaigns');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/campaigns/Launch');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.elasticemail.test/v4/campaigns/Launch/pause');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.elasticemail.test/v4/events?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/events/tx_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/suppressions/bounces');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/statistics');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/statistics/campaigns/Launch');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/files');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.elasticemail.test/v4/domains');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.elasticemail.test/v4/contacts/export');
    }

    public function test_new_tools_delegate_to_service(): void
    {
        Http::fake([
            'https://api.elasticemail.test/v4/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new ElasticEmailService('elastic_test', 'https://api.elasticemail.test/v4');

        self::assertTrue((new ElasticEmailGetContact($service))->execute([
            'email' => 'person@example.test',
        ])->succeeded());
        self::assertTrue((new ElasticEmailListCampaigns($service))->execute([])->succeeded());
        self::assertTrue((new ElasticEmailApiGet($service))->execute([
            'path' => '/domains',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.elasticemail.com/v4/statistics' => Http::response(['ok' => true], 200),
        ]);

        $provider = new ElasticEmailToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('elasticemail_get_contact', $tools);
        self::assertArrayHasKey('elasticemail_list_lists', $tools);
        self::assertArrayHasKey('elasticemail_list_campaigns', $tools);
        self::assertArrayHasKey('elasticemail_list_events', $tools);
        self::assertArrayHasKey('elasticemail_list_suppressions', $tools);
        self::assertArrayHasKey('elasticemail_get_statistics', $tools);
        self::assertArrayHasKey('elasticemail_api_get', $tools);
        self::assertArrayNotHasKey('elasticemail_get'.'_current_user', $tools);
        self::assertSame(26, count($tools));
        self::assertTrue($provider->testConnection(['api_key' => 'elastic_test'])['success']);
    }
}
