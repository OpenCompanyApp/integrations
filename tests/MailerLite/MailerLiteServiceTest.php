<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\MailerLite;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\MailerLite\MailerLiteService;
use OpenCompany\Integrations\MailerLite\MailerLiteToolProvider;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteApiGet;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteCreateCampaign;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteCreateWebhook;
use OpenCompany\Integrations\MailerLite\Tools\MailerLiteListSubscribers;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for current MailerLite API endpoint coverage.
 */
final class MailerLiteServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_current_mailerlite_resources(): void
    {
        Http::fake([
            'https://connect.mailerlite.com/api/*' => Http::response(['data' => [], 'total' => 1], 200),
        ]);

        $service = new MailerLiteService('ml_test');

        $service->getCurrentUser();
        $service->listSubscribers(['filter[status]' => 'active', 'limit' => 10, 'include' => 'groups']);
        $service->getSubscriber('reader@example.test');
        $service->createSubscriber(['email' => 'reader@example.test', 'groups' => ['group_1']]);
        $service->updateSubscriber('reader@example.test', ['fields' => ['company' => 'Example']]);
        $service->deleteSubscriber('reader@example.test');
        $service->listSubscriberActivity('subscriber_1', ['filter[log_name]' => 'email_open']);
        $service->listGroups(['limit' => 25]);
        $service->createGroup(['name' => 'Readers']);
        $service->updateGroup('group_1', ['name' => 'Customers']);
        $service->deleteGroup('group_1');
        $service->listGroupSubscribers('group_1', ['limit' => 25]);
        $service->addSubscriberToGroup('group_1', 'reader@example.test', 'Ada');
        $service->assignSubscriberToGroup('subscriber_1', 'group_1');
        $service->unassignSubscriberFromGroup('subscriber_1', 'group_1');
        $service->importSubscribersToGroup('group_1', [['email' => 'reader@example.test']]);
        $service->listSegments(['limit' => 25]);
        $service->listSegmentSubscribers('segment_1', ['limit' => 25]);
        $service->updateSegment('segment_1', ['name' => 'Qualified']);
        $service->deleteSegment('segment_1');
        $service->listFields(['limit' => 25]);
        $service->createField(['name' => 'Plan', 'type' => 'text']);
        $service->updateField('field_1', ['name' => 'Tier']);
        $service->deleteField('field_1');
        $service->listAutomations(['filter[enabled]' => true]);
        $service->getAutomation('automation_1');
        $service->listAutomationActivity('automation_1', ['limit' => 10]);
        $service->createAutomation(['name' => 'Welcome']);
        $service->deleteAutomation('automation_1');
        $service->listCampaigns(['filter[status]' => 'sent']);
        $service->getCampaign('campaign_1');
        $service->createCampaign(['type' => 'regular', 'name' => 'Newsletter']);
        $service->updateCampaign('campaign_1', ['name' => 'Updated']);
        $service->scheduleCampaign('campaign_1', ['delivery' => 'instant']);
        $service->cancelCampaign('campaign_1');
        $service->deleteCampaign('campaign_1');
        $service->listCampaignSubscriberActivity('campaign_1', ['limit' => 50]);
        $service->listForms('embedded', ['filter[name]' => 'Signup']);
        $service->getForm('form_1');
        $service->updateForm('form_1', ['name' => 'Lead capture']);
        $service->deleteForm('form_1');
        $service->listFormSubscribers('form_1', ['limit' => 50]);
        $service->listWebhooks(['limit' => 25]);
        $service->getWebhook('webhook_1');
        $service->createWebhook(['url' => 'https://example.test/hook', 'events' => ['subscriber.created']]);
        $service->updateWebhook('webhook_1', ['enabled' => false]);
        $service->deleteWebhook('webhook_1');
        $service->batch([['method' => 'GET', 'path' => 'api/fields']]);
        $service->apiGet('/subscribers', ['limit' => 1]);
        $service->apiPost('/groups', ['name' => 'VIP']);
        $service->apiPut('/groups/group_1', ['name' => 'Customers']);
        $service->apiPatch('/webhooks/webhook_1', ['enabled' => true]);
        $service->apiDelete('/groups/group_1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer ml_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/subscribers?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://connect.mailerlite.com/api/subscribers/reader%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/subscribers' && $request['email'] === 'reader@example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://connect.mailerlite.com/api/subscribers/reader%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://connect.mailerlite.com/api/subscribers/reader%40example.test');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/subscribers/subscriber_1/activity-log?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/groups' && $request['name'] === 'Readers');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/groups/group_1/subscribers?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/subscribers/subscriber_1/groups/group_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://connect.mailerlite.com/api/subscribers/subscriber_1/groups/group_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/groups/group_1/import-subscribers');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/segments?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/fields?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/automations?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://connect.mailerlite.com/api/automations/automation_1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/campaigns' && $request['name'] === 'Newsletter');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/campaigns/campaign_1/schedule');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/campaigns/campaign_1/cancel');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/forms/embedded?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://connect.mailerlite.com/api/forms/form_1/subscribers?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/webhooks' && $request['events'] === ['subscriber.created']);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://connect.mailerlite.com/api/batch');
    }

    public function test_tools_delegate_and_validate_safe_raw_paths(): void
    {
        Http::fake([
            'https://connect.mailerlite.com/api/*' => Http::response(['data' => []], 200),
        ]);

        $service = new MailerLiteService('ml_test');

        self::assertTrue((new MailerLiteListSubscribers($service))->execute([
            'status' => 'active',
            'include' => 'groups',
        ])->succeeded());
        self::assertTrue((new MailerLiteCreateCampaign($service))->execute([
            'payload' => ['type' => 'regular', 'name' => 'Newsletter'],
        ])->succeeded());
        self::assertTrue((new MailerLiteCreateWebhook($service))->execute([
            'url' => 'https://example.test/hook',
            'events' => ['subscriber.created'],
        ])->succeeded());
        self::assertTrue((new MailerLiteApiGet($service))->execute([
            'path' => '/subscribers',
            'params' => ['limit' => 1],
        ])->succeeded());
        self::assertFalse((new MailerLiteCreateCampaign($service))->execute([])->succeeded());
        self::assertFalse((new MailerLiteApiGet($service))->execute([
            'path' => 'https://example.test/subscribers',
        ])->succeeded());
    }

    public function test_provider_exposes_current_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://connect.mailerlite.com/api/subscribers*' => Http::response(['total' => 1], 200),
        ]);

        $provider = new MailerLiteToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developers.mailerlite.com/docs/', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('mailerlite_list_subscribers', $tools);
        self::assertArrayHasKey('mailerlite_create_group', $tools);
        self::assertArrayHasKey('mailerlite_list_segments', $tools);
        self::assertArrayHasKey('mailerlite_create_field', $tools);
        self::assertArrayHasKey('mailerlite_list_automations', $tools);
        self::assertArrayHasKey('mailerlite_create_campaign', $tools);
        self::assertArrayHasKey('mailerlite_list_forms', $tools);
        self::assertArrayHasKey('mailerlite_create_webhook', $tools);
        self::assertArrayHasKey('mailerlite_batch', $tools);
        self::assertArrayHasKey('mailerlite_api_patch', $tools);
        self::assertSame(53, count($tools));

        self::assertTrue($provider->testConnection(['api_key' => 'ml_test'])['success']);
    }
}
