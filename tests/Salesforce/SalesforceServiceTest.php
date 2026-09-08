<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Salesforce;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Salesforce\SalesforceService;
use OpenCompany\Integrations\Salesforce\SalesforceToolProvider;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateLead;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceCreateTask;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceListRecent;
use OpenCompany\Integrations\Salesforce\Tools\SalesforceQuery;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Salesforce REST API integration.
 */
final class SalesforceServiceTest extends TestCase
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
        Container::getInstance()->forgetInstance(CredentialResolver::class);
        parent::tearDown();
    }

    public function test_provider_metadata_credentials_tools_and_docs(): void
    {
        $provider = new SalesforceToolProvider;
        $tools = $provider->tools();

        self::assertSame('salesforce', $provider->appName());
        self::assertSame('Salesforce', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.salesforce.com/docs/apis', $provider->integrationMeta()['docs_url']);
        self::assertSame('oauth2_manual_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(18, $tools);
        self::assertArrayHasKey('salesforce_create_lead', $tools);
        self::assertArrayHasKey('salesforce_query', $tools);
        self::assertArrayHasKey('salesforce_create_case', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_salesforce_objects_queries_and_updates(): void
    {
        Http::fake(['*' => Http::response(['id' => '00Q123', 'success' => true], 200)]);

        $service = new SalesforceService('sf-test-token', 'https://salesforce.example.test');

        $service->testConnection();
        $service->createLead(['LastName' => 'Smith', 'Company' => 'Example']);
        $service->getLead('00Q123');
        $service->updateLead('00Q123', ['Title' => 'VP']);
        $service->createContact(['LastName' => 'Smith', 'AccountId' => '001123']);
        $service->getContact('003123');
        $service->createAccount(['Name' => 'Example']);
        $service->getAccount('001123');
        $service->updateAccount('001123', ['Website' => 'https://example.test']);
        $service->createOpportunity(['Name' => 'Deal', 'StageName' => 'Prospecting', 'CloseDate' => '2026-06-01']);
        $service->getOpportunity('006123');
        $service->createTask(['Subject' => 'Call']);
        $service->createCase(['Subject' => 'Support']);
        $service->getUser('005123');
        $service->query('SELECT Id, Name FROM Account LIMIT 10');
        $service->search('FIND {Acme} IN ALL FIELDS RETURNING Account(Id, Name)');
        $service->describeObject('Account');
        $service->listObjects();
        $service->listRecent(5);

        Http::assertSentCount(19);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/'
            && $request->hasHeader('Authorization', 'Bearer sf-test-token')
            && $request->hasHeader('Content-Type', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Lead'
            && $request->data()['LastName'] === 'Smith'
            && $request->data()['Company'] === 'Example');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PATCH'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Lead/00Q123'
            && $request->data()['Title'] === 'VP');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Opportunity'
            && $request->data()['StageName'] === 'Prospecting');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/query?q=SELECT%20Id%2C%20Name%20FROM%20Account%20LIMIT%2010');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && str_starts_with($request->url(), 'https://salesforce.example.test/services/data/v60.0/search?q=FIND%20%7BAcme%7D'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Account/describe');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/recent?limit=5');
    }

    public function test_service_normalizes_errors_and_update_no_content(): void
    {
        Http::fake([
            'https://salesforce.example.test/services/data/v60.0/sobjects/Lead/00Q123' => Http::sequence()
                ->push('', 204)
                ->push([['message' => 'Session expired or invalid']], 401),
        ]);

        $service = new SalesforceService('sf-test-token', 'https://salesforce.example.test');

        self::assertSame([], $service->updateLead('00Q123', ['Title' => 'VP']));

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Salesforce API error (401): Session expired or invalid');

        $service->getLead('00Q123');
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://salesforce.example.test/services/data/v60.0/sobjects/Lead' => Http::response(['id' => '00Q123', 'success' => true], 200),
            'https://salesforce.example.test/services/data/v60.0/sobjects/Task' => Http::response(['id' => '00T123', 'success' => true], 200),
            'https://salesforce.example.test/services/data/v60.0/query*' => Http::response(['totalSize' => 1, 'records' => [['Id' => '001123']]], 200),
        ]);

        $service = new SalesforceService('sf-test-token', 'https://salesforce.example.test');

        $lead = (new SalesforceCreateLead($service))->execute([
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'company' => 'Analytical Engines',
            'email' => 'ada@example.test',
            'other_fields' => ['LeadSource' => 'Web'],
        ]);
        $task = (new SalesforceCreateTask($service))->execute([
            'subject' => 'Follow up',
            'status' => 'Not Started',
            'priority' => 'High',
            'who_id' => '00Q123',
            'activity_date' => '2026-06-01',
        ]);
        $query = (new SalesforceQuery($service))->execute(['soql' => 'SELECT Id FROM Account LIMIT 1']);
        $missingLeadFields = (new SalesforceCreateLead($service))->execute(['last_name' => 'Only']);
        $unconfigured = (new SalesforceListRecent(new SalesforceService('', '')))->execute([]);

        self::assertTrue($lead->succeeded());
        self::assertTrue($task->succeeded());
        self::assertTrue($query->succeeded());
        self::assertFalse($missingLeadFields->succeeded());
        self::assertStringContainsString('last_name and company are required', (string) $missingLeadFields->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Lead'
            && $request->data()['FirstName'] === 'Ada'
            && $request->data()['LeadSource'] === 'Web');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/sobjects/Task'
            && $request->data()['WhoId'] === '00Q123'
            && $request->data()['ActivityDate'] === '2026-06-01');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new SalesforceToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://salesforce.example.test/services/data/v60.0/' => Http::response(['resources' => []], 200),
            'https://salesforce.internal.test/services/data/v60.0/recent?limit=5' => Http::response([['id' => '001123']], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'sf-test-token',
            'instance_url' => 'https://salesforce.example.test',
        ]);

        self::assertTrue($result['success']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'sf-work-token' : 'sf-default-token',
                    'instance_url' => 'https://salesforce.internal.test',
                ];

                return $values[$key] ?? $default;
            }

            public function isConfigured(string $integration, ?string $account = null): bool
            {
                return true;
            }

            public function getAccounts(string $integration): array
            {
                return ['work'];
            }
        });

        $tool = $provider->createTool(SalesforceListRecent::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['limit' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.example.test/services/data/v60.0/'
            && $request->hasHeader('Authorization', 'Bearer sf-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://salesforce.internal.test/services/data/v60.0/recent?limit=5'
            && $request->hasHeader('Authorization', 'Bearer sf-work-token'));
    }
}
