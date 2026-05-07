<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Salesloft;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\Salesloft\SalesloftService;
use OpenCompany\Integrations\Salesloft\SalesloftToolProvider;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftApiGet;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftCreatePerson;
use OpenCompany\Integrations\Salesloft\Tools\SalesloftUpdateTask;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for expanded Salesloft API coverage.
 */
final class SalesloftServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_core_resources_and_generic_endpoints(): void
    {
        Http::fake([
            'https://api.salesloft.com/*' => Http::response(['data' => [], 'metadata' => ['paging' => []]], 200),
        ]);

        $service = new SalesloftService('sl_test');

        $service->getCurrentUser();
        $service->listUsers(['per_page' => 10]);
        $service->getUser(1);
        $service->listPeople(['email_address' => 'person@example.test']);
        $service->getPerson(2);
        $service->createPerson(['email_address' => 'person@example.test']);
        $service->updatePerson(2, ['first_name' => 'Ada']);
        $service->deletePerson(2);
        $service->listAccounts(['domain' => 'example.test']);
        $service->getAccount(3);
        $service->createAccount(['name' => 'Example']);
        $service->updateAccount(3, ['name' => 'Updated']);
        $service->deleteAccount(3);
        $service->listCadences(['per_page' => 25]);
        $service->getCadence(4);
        $service->listCadenceMemberships(['cadence_id' => 4]);
        $service->createCadenceMembership(['person_id' => 2, 'cadence_id' => 4]);
        $service->listTasks(['user_id' => 1]);
        $service->getTask(5);
        $service->updateTask(5, ['completed' => true]);
        $service->listCalls(['person_id' => 2]);
        $service->createCall(['person_id' => 2, 'user_id' => 1]);
        $service->listEmails(['person_id' => 2]);
        $service->listNotes(['person_id' => 2]);
        $service->createNote(['person_id' => 2, 'content' => 'Followed up']);
        $service->listSequences();
        $service->getSequence(6);
        $service->createSequence(['name' => 'Legacy']);
        $service->listRules();
        $service->getRule(7);
        $service->apiGet('/v2/people');
        $service->apiPost('/v2/people', ['email_address' => 'person@example.test']);
        $service->apiPut('/v2/people/2', ['first_name' => 'Ada']);
        $service->apiDelete('/v2/people/2');

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Bearer sl_test'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.salesloft.com/v3/users/me');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/users?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.salesloft.com/v2/users/1');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/people?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.salesloft.com/v2/people');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.salesloft.com/v2/people/2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://api.salesloft.com/v2/people/2');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/accounts?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.salesloft.com/v2/accounts');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/cadences?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://api.salesloft.com/v2/cadences/4');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/cadence_memberships?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.salesloft.com/v2/cadence_memberships');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/tasks?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://api.salesloft.com/v2/tasks/5');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/activities/calls?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.salesloft.com/v2/activities/calls');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/activities/emails?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v2/notes?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://api.salesloft.com/v2/notes');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v3/call-sequences?'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://api.salesloft.com/v3/rules?'));
    }

    public function test_new_tools_delegate_and_validate_required_arguments(): void
    {
        Http::fake([
            'https://api.salesloft.com/*' => Http::response(['data' => []], 200),
        ]);

        $service = new SalesloftService('sl_test');

        self::assertTrue((new SalesloftCreatePerson($service))->execute([
            'payload' => ['email_address' => 'person@example.test'],
        ])->succeeded());
        self::assertTrue((new SalesloftUpdateTask($service))->execute([
            'id' => 5,
            'payload' => ['completed' => true],
        ])->succeeded());
        self::assertTrue((new SalesloftApiGet($service))->execute([
            'path' => '/v2/people',
        ])->succeeded());
        self::assertFalse((new SalesloftCreatePerson($service))->execute([])->succeeded());
        self::assertFalse((new SalesloftUpdateTask($service))->execute([
            'id' => 5,
        ])->succeeded());
        self::assertFalse((new SalesloftApiGet($service))->execute([
            'path' => 'https://example.test/v2/people',
        ])->succeeded());
    }

    public function test_provider_exposes_expanded_catalog_and_allowed_category(): void
    {
        Http::fake([
            'https://api.salesloft.com/v3/users/me' => Http::response(['data' => ['first_name' => 'Ada']], 200),
        ]);

        $provider = new SalesloftToolProvider();
        $tools = $provider->tools();

        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertArrayHasKey('salesloft_list_people', $tools);
        self::assertArrayHasKey('salesloft_create_account', $tools);
        self::assertArrayHasKey('salesloft_create_cadence_membership', $tools);
        self::assertArrayHasKey('salesloft_update_task', $tools);
        self::assertArrayHasKey('salesloft_create_call', $tools);
        self::assertArrayHasKey('salesloft_create_note', $tools);
        self::assertArrayHasKey('salesloft_api_delete', $tools);
        self::assertSame(34, count($tools));
        self::assertTrue($provider->testConnection([
            'access_token' => 'sl_test',
        ])['success']);
    }
}
