<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\Trello;

use Illuminate\Container\Container;
use Illuminate\Http\Client\Factory as HttpFactory;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateCard;
use OpenCompany\Integrations\Trello\Tools\TrelloListBoards;
use OpenCompany\Integrations\Trello\Tools\TrelloListCards;
use OpenCompany\Integrations\Trello\TrelloService;
use OpenCompany\Integrations\Trello\TrelloToolProvider;
use PHPUnit\Framework\TestCase;

/**
 * Regression coverage for the Trello REST API integration.
 */
final class TrelloServiceTest extends TestCase
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
        $provider = new TrelloToolProvider;
        $tools = $provider->tools();

        self::assertSame('trello', $provider->appName());
        self::assertSame('Trello', $provider->integrationMeta()['name']);
        self::assertSame('productivity', $provider->integrationMeta()['category']);
        self::assertSame('https://developer.atlassian.com/cloud/trello/rest/', $provider->integrationMeta()['docs_url']);
        self::assertSame('bearer_token', $provider->integrationCapabilities()['auth']['strategy']);
        self::assertFileExists((string) $provider->scriptDocsPath());

        self::assertCount(7, $tools);
        self::assertArrayHasKey('trello_list_boards', $tools);
        self::assertArrayHasKey('trello_create_card', $tools);
        self::assertArrayHasKey('trello_get_current_user', $tools);

        foreach ($tools as $tool) {
            self::assertTrue(class_exists($tool['class']), $tool['class'].' should exist.');
        }
    }

    public function test_service_maps_board_list_card_and_member_requests(): void
    {
        Http::fake(['*' => Http::response(['id' => 'abc123', 'username' => 'agent'], 200)]);

        $service = new TrelloService('trello-test-token', 'https://trello.example.test/1');

        $service->listBoards(['filter' => 'open', 'fields' => 'name,url', 'limit' => 10]);
        $service->getBoard('board_123');
        $service->listLists('board_123');
        $service->getList('list_123');
        $service->listCards('list_123', ['limit' => 5, 'before' => 'card_999']);
        $service->createCard(['name' => 'Follow up', 'idList' => 'list_123', 'desc' => 'Call customer']);
        $service->getCurrentUser();

        Http::assertSentCount(7);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.example.test/1/members/me/boards?filter=open&fields=name%2Curl&limit=10'
            && $request->hasHeader('Authorization', 'Bearer trello-test-token')
            && $request->hasHeader('Accept', 'application/json'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.example.test/1/boards/board_123/lists');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.example.test/1/lists/list_123/cards?limit=5&before=card_999');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://trello.example.test/1/cards'
            && $request->data()['name'] === 'Follow up'
            && $request->data()['idList'] === 'list_123'
            && $request->data()['desc'] === 'Call customer');

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.example.test/1/members/me');
    }

    public function test_service_normalizes_json_and_html_errors(): void
    {
        Http::fake([
            'https://trello.example.test/1/members/me/boards' => Http::response(['message' => 'invalid token'], 401),
            'https://trello.example.test/1/boards/missing' => Http::response('<!DOCTYPE html><html></html>', 404, ['Content-Type' => 'text/html']),
        ]);

        $service = new TrelloService('trello-test-token', 'https://trello.example.test/1');

        try {
            $service->listBoards();
            self::fail('Expected Trello JSON API error.');
        } catch (\RuntimeException $e) {
            self::assertSame('Trello API error (401): invalid token', $e->getMessage());
        }

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Trello API endpoint not available (HTTP 404).');

        $service->getBoard('missing');
    }

    public function test_tools_validate_configuration_and_map_agent_parameters(): void
    {
        Http::fake([
            'https://trello.example.test/1/cards' => Http::response(['id' => 'card_123'], 200),
            'https://trello.example.test/1/lists/list_123/cards?limit=5' => Http::response([['id' => 'card_123']], 200),
        ]);

        $service = new TrelloService('trello-test-token', 'https://trello.example.test/1');

        $created = (new TrelloCreateCard($service))->execute([
            'name' => 'Follow up',
            'id_list' => 'list_123',
            'desc' => 'Call customer',
            'id_labels' => ['label_123'],
            'id_members' => ['member_123'],
            'due' => '2026-06-01T12:00:00Z',
            'pos' => 'top',
        ]);
        $cards = (new TrelloListCards($service))->execute(['list_id' => 'list_123', 'limit' => 5]);
        $missingName = (new TrelloCreateCard($service))->execute(['id_list' => 'list_123']);
        $unconfigured = (new TrelloListBoards(new TrelloService('', 'https://trello.example.test/1')))->execute([]);

        self::assertTrue($created->succeeded());
        self::assertTrue($cards->succeeded());
        self::assertFalse($missingName->succeeded());
        self::assertStringContainsString('Card name is required', (string) $missingName->error);
        self::assertFalse($unconfigured->succeeded());
        self::assertStringContainsString('not configured', (string) $unconfigured->error);

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST'
            && $request->url() === 'https://trello.example.test/1/cards'
            && $request->data()['idList'] === 'list_123'
            && $request->data()['idLabels'][0] === 'label_123'
            && $request->data()['idMembers'][0] === 'member_123'
            && $request->data()['due'] === '2026-06-01T12:00:00Z'
            && $request->data()['pos'] === 'top');
    }

    public function test_connection_and_multi_account_resolution(): void
    {
        $provider = new TrelloToolProvider;

        self::assertFalse($provider->testConnection([])['success']);

        Http::fake([
            'https://trello.example.test/1/members/me' => Http::sequence()
                ->push(['username' => 'agent', 'fullName' => 'Agent User'], 200)
                ->push(['message' => 'invalid token'], 401),
            'https://trello.internal.test/1/members/me/boards?limit=5' => Http::response([], 200),
        ]);

        $result = $provider->testConnection([
            'access_token' => 'trello-test-token',
            'url' => 'https://trello.example.test/1',
        ]);
        $badResult = $provider->testConnection([
            'access_token' => 'bad-token',
            'url' => 'https://trello.example.test/1',
        ]);

        self::assertTrue($result['success']);
        self::assertStringContainsString('Agent User', (string) $result['message']);
        self::assertFalse($badResult['success']);
        self::assertStringContainsString('invalid token', (string) $badResult['error']);

        Container::getInstance()->instance(CredentialResolver::class, new class implements CredentialResolver {
            public function get(string $integration, string $key, mixed $default = null, ?string $account = null): mixed
            {
                $values = [
                    'access_token' => $account === 'work' ? 'trello-work-token' : 'trello-default-token',
                    'url' => 'https://trello.internal.test/1',
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

        $tool = $provider->createTool(TrelloListBoards::class, ['account' => 'work']);
        self::assertTrue($tool->execute(['limit' => 5])->succeeded());

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.example.test/1/members/me'
            && $request->hasHeader('Authorization', 'Bearer trello-test-token'));

        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET'
            && $request->url() === 'https://trello.internal.test/1/members/me/boards?limit=5'
            && $request->hasHeader('Authorization', 'Bearer trello-work-token'));
    }
}
