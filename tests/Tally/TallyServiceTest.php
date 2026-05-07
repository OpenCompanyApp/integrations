<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Tally;

use Illuminate\Http\Client\Request;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Tally\TallyService;
use OpenCompany\Integrations\Tally\TallyToolProvider;
use OpenCompany\Integrations\Tally\Tools\TallyApiGet;
use OpenCompany\Integrations\Tally\Tools\TallyCreateWebhook;
use OpenCompany\Integrations\Tally\Tools\TallyGetSubmission;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for Tally's current REST API coverage.
 */
final class TallyServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Http::swap(new HttpFactory);
    }

    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        Http::swap(new HttpFactory);
        parent::tearDown();
    }

    public function test_service_maps_current_tally_endpoints_and_headers(): void
    {
        Http::fake([
            'https://api.tally.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new TallyService('tally_test', 'https://api.tally.test', '2026-02-05');

        $service->getCurrentUser();
        $service->listForms(['limit' => 50, 'workspaceIds' => ['ws_123']]);
        $service->createForm(['workspaceId' => 'ws_123', 'status' => 'draft']);
        $service->getForm('form_123');
        $service->updateForm('form_123', ['name' => 'Updated']);
        $service->deleteForm('form_123');
        $service->listQuestions('form_123');
        $service->updateQuestion('form_123', 'question_123', 'Updated title');
        $service->listBlocks('form_123');
        $service->updateBlocks('form_123', [['id' => 'block_123']]);
        $service->listSubmissions('form_123', ['filter' => 'completed']);
        $service->getSubmission('form_123', 'submission_123');
        $service->deleteSubmission('form_123', 'submission_123');
        $service->listWorkspaces(['page' => 1]);
        $service->createWorkspace('Example workspace');
        $service->getWorkspace('ws_123');
        $service->updateWorkspace('ws_123', 'Renamed');
        $service->deleteWorkspace('ws_123');
        $service->listOrganizationUsers('org_123');
        $service->removeOrganizationUser('org_123', 'user_123');
        $service->listOrganizationInvites('org_123');
        $service->createOrganizationInvite('org_123', ['ws_123'], 'person@example.test');
        $service->cancelOrganizationInvite('org_123', 'invite_123');
        $service->listWebhooks(['limit' => 25]);
        $service->createWebhook(['formId' => 'form_123', 'url' => 'https://example.test/hook', 'eventTypes' => ['FORM_RESPONSE']]);
        $service->updateWebhook('webhook_123', ['isEnabled' => false]);
        $service->deleteWebhook('webhook_123');
        $service->listWebhookEvents('webhook_123', ['page' => 1]);
        $service->retryWebhookEvent('webhook_123', 'event_123');
        $service->apiGet('/forms', ['limit' => 1]);
        $service->apiPost('/webhooks', ['formId' => 'form_123']);
        $service->apiPatch('/webhooks/webhook_123', ['isEnabled' => true]);
        $service->apiDelete('/webhooks/webhook_123');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer tally_test'));
        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('tally-version', '2026-02-05'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/users/me');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tally.test/forms?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tally.test/forms');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://api.tally.test/forms/form_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.tally.test/forms/form_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123/questions');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123/questions/question_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123/blocks');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tally.test/forms/form_123/submissions?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123/submissions/submission_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tally.test/workspaces?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tally.test/workspaces');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/workspaces/ws_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/organizations/org_123/users');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/organizations/org_123/users/user_123');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/organizations/org_123/invites');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/organizations/org_123/invites/invite_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tally.test/webhooks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.tally.test/webhooks');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/webhooks/webhook_123');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://api.tally.test/webhooks/webhook_123/events?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/webhooks/webhook_123/events/event_123');
    }

    public function test_new_tools_delegate_to_service_and_map_snake_case_parameters(): void
    {
        Http::fake([
            'https://api.tally.test/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new TallyService('tally_test', 'https://api.tally.test');

        self::assertTrue((new TallyGetSubmission($service))->execute([
            'form_id' => 'form_123',
            'submission_id' => 'submission_123',
        ])->succeeded());
        self::assertTrue((new TallyCreateWebhook($service))->execute([
            'form_id' => 'form_123',
            'url' => 'https://example.test/hook',
            'event_types' => ['FORM_RESPONSE'],
            'signing_secret' => 'dummy-secret',
        ])->succeeded());
        self::assertTrue((new TallyApiGet($service))->execute([
            'path' => '/forms',
            'params' => ['limit' => 1],
        ])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://api.tally.test/forms/form_123/submissions/submission_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->data()['formId'] === 'form_123');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->data()['eventTypes'] === ['FORM_RESPONSE']);
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.tally.so/users/me' => Http::response(['id' => 'user_123'], 200),
        ]);

        $provider = new TallyToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('tally_create_form', $tools);
        self::assertArrayHasKey('tally_update_blocks', $tools);
        self::assertArrayHasKey('tally_delete_submission', $tools);
        self::assertArrayHasKey('tally_create_organization_invite', $tools);
        self::assertArrayHasKey('tally_retry_webhook_event', $tools);
        self::assertArrayHasKey('tally_api_get', $tools);
        self::assertSame(33, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'tally_test'])['success']);
    }
}
