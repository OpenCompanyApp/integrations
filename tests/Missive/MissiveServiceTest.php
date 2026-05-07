<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Missive;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Missive\MissiveService;
use OpenCompany\Integrations\Missive\MissiveToolProvider;
use OpenCompany\Integrations\Missive\Tools\MissiveApiGet;
use OpenCompany\Integrations\Missive\Tools\MissiveCreateDraft;
use OpenCompany\Integrations\Missive\Tools\MissiveUpdateTask;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Missive REST API coverage.
 */
final class MissiveServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_conversations_drafts_tasks_contacts_admin_resources_and_generic_helpers(): void
    {
        Http::fake([
            'https://public.missiveapp.com/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MissiveService('missive_test');

        $service->listConversationMessages('conv-1', ['limit' => 10]);
        $service->listConversationComments('conv-1');
        $service->listConversationDrafts('conv-1');
        $service->listConversationPosts('conv-1');
        $service->mergeConversation('conv-1', ['target' => 'conv-2']);
        $service->createDraft(['subject' => 'Hello']);
        $service->deleteDraft('draft-1');
        $service->listMessages(['email_message_id' => '<msg@example.test>']);
        $service->createPost(['conversation' => 'conv-1', 'body' => 'Note']);
        $service->deletePost('post-1');
        $service->getTask('task-1');
        $service->updateTask('task-1', ['state' => 'completed']);
        $service->listContacts(['search' => 'Example']);
        $service->getContact('contact-1');
        $service->createContacts(['contacts' => [['email' => 'person@example.test']]]);
        $service->updateContacts('contact-1,contact-2', ['contact' => ['name' => 'Example']]);
        $service->listContactBooks();
        $service->listContactGroups(['kind' => 'group']);
        $service->listOrganizations();
        $service->listUsers(['organization' => 'org-1']);
        $service->listTeams();
        $service->createTeams(['teams' => [['name' => 'Support']]]);
        $service->listSharedLabels();
        $service->listResponses();
        $service->getResponse('response-1');
        $service->createResponses(['responses' => [['title' => 'Hello']]]);
        $service->updateResponses('response-1,response-2', ['response' => ['title' => 'Updated']]);
        $service->deleteResponses('response-1,response-2');
        $service->createAnalyticsReport(['organization' => 'org-1']);
        $service->getAnalyticsReport('report-1');
        $service->listHooks();
        $service->createHook(['url' => 'https://example.test/missive']);
        $service->deleteHook('hook-1');
        $service->apiGet('/contacts', ['limit' => 1]);
        $service->apiPost('/drafts', ['subject' => 'Hello']);
        $service->apiPatch('/tasks/task-1', ['state' => 'completed']);
        $service->apiDelete('/drafts/draft-1');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer missive_test'));
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://public.missiveapp.com/v1/conversations/conv-1/messages?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://public.missiveapp.com/v1/conversations/conv-1/comments');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://public.missiveapp.com/v1/conversations/conv-1/merge');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://public.missiveapp.com/v1/drafts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://public.missiveapp.com/v1/tasks/task-1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH' && $request->url() === 'https://public.missiveapp.com/v1/contacts/contact-1,contact-2');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://public.missiveapp.com/v1/contact_books');
        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://public.missiveapp.com/v1/contact_groups?'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://public.missiveapp.com/v1/organizations');
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://public.missiveapp.com/v1/shared_labels');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://public.missiveapp.com/v1/responses/response-1,response-2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://public.missiveapp.com/v1/analytics/reports');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://public.missiveapp.com/v1/hooks/hook-1');
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://public.missiveapp.com/v1/*' => Http::response(['ok' => true], 200),
        ]);

        $service = new MissiveService('missive_test');

        self::assertTrue((new MissiveCreateDraft($service))->execute([
            'body' => ['subject' => 'Hello'],
        ])->succeeded());
        self::assertTrue((new MissiveUpdateTask($service))->execute([
            'task_id' => 'task-1',
            'body' => ['state' => 'completed'],
        ])->succeeded());
        self::assertTrue((new MissiveApiGet($service))->execute([
            'path' => '/contacts',
        ])->succeeded());
        self::assertFalse((new MissiveCreateDraft($service))->execute([])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://public.missiveapp.com/v1/user' => Http::response(['user' => ['email' => 'person@example.test']], 200),
        ]);

        $provider = new MissiveToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('missive_list_contacts', $tools);
        self::assertArrayHasKey('missive_create_draft', $tools);
        self::assertArrayHasKey('missive_update_task', $tools);
        self::assertArrayHasKey('missive_list_responses', $tools);
        self::assertArrayHasKey('missive_create_analytics_report', $tools);
        self::assertArrayHasKey('missive_api_delete', $tools);
        self::assertSame(43, count($tools));
        self::assertTrue($provider->testConnection(['access_token' => 'missive_test'])['success']);
    }
}
