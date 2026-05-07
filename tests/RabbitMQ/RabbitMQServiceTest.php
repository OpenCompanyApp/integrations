<?php

declare(strict_types=1);

namespace OpenCompany\Integrations\Tests\RabbitMQ;

use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Http;
use OpenCompany\Integrations\RabbitMQ\RabbitMQService;
use OpenCompany\Integrations\RabbitMQ\RabbitMQToolProvider;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQCreateBinding;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQDeclareQueue;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQGetMessages;
use OpenCompany\Integrations\RabbitMQ\Tools\RabbitMQHealthCheck;
use PHPUnit\Framework\TestCase;

/**
 * Regression tests for RabbitMQ Management HTTP API endpoint mappings.
 */
final class RabbitMQServiceTest extends TestCase
{
    protected function tearDown(): void
    {
        Http::preventStrayRequests(false);
        parent::tearDown();
    }

    public function test_service_maps_to_documented_management_api_paths(): void
    {
        Http::fake([
            'https://rabbitmq.example.test/api/overview' => Http::response(['node' => 'rabbit@node1'], 200),
            'https://rabbitmq.example.test/api/nodes' => Http::response([['name' => 'rabbit@node1']], 200),
            'https://rabbitmq.example.test/api/nodes/rabbit%40node1' => Http::response(['name' => 'rabbit@node1'], 200),
            'https://rabbitmq.example.test/api/health/checks/alarms*' => Http::response(['status' => 'ok'], 200),
            'https://rabbitmq.example.test/api/aliveness-test/%2F' => Http::response(['status' => 'ok'], 200),
            'https://rabbitmq.example.test/api/queues*' => Http::response([['name' => 'orders.ready']], 200),
            'https://rabbitmq.example.test/api/queues/%2F*' => Http::response([['name' => 'orders.ready']], 200),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready' => Http::response(['name' => 'orders.ready'], 200),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready/contents' => Http::response([], 204),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready/bindings' => Http::response([['source' => 'orders.events']], 200),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready/get' => Http::response([['payload' => 'hello']], 200),
            'https://rabbitmq.example.test/api/exchanges*' => Http::response([['name' => 'orders.events']], 200),
            'https://rabbitmq.example.test/api/exchanges/%2F*' => Http::response([['name' => 'orders.events']], 200),
            'https://rabbitmq.example.test/api/exchanges/%2F/orders.events' => Http::response(['name' => 'orders.events'], 200),
            'https://rabbitmq.example.test/api/exchanges/%2F/orders.events/publish' => Http::response(['routed' => true], 200),
            'https://rabbitmq.example.test/api/exchanges/%2F/orders.events/bindings/source' => Http::response([], 200),
            'https://rabbitmq.example.test/api/exchanges/%2F/orders.events/bindings/destination' => Http::response([], 200),
            'https://rabbitmq.example.test/api/bindings' => Http::response([], 200),
            'https://rabbitmq.example.test/api/bindings/%2F' => Http::response([], 200),
            'https://rabbitmq.example.test/api/bindings/%2F/e/orders.events/q/orders.ready' => Http::response(['routing_key' => 'order.created'], 201),
            'https://rabbitmq.example.test/api/bindings/%2F/e/orders.events/q/orders.ready/order.created' => Http::response([], 204),
            'https://rabbitmq.example.test/api/connections' => Http::response([['name' => 'conn 1']], 200),
            'https://rabbitmq.example.test/api/connections/conn%201' => Http::response(['name' => 'conn 1'], 200),
            'https://rabbitmq.example.test/api/channels' => Http::response([['name' => 'chan 1']], 200),
            'https://rabbitmq.example.test/api/channels/chan%201' => Http::response(['name' => 'chan 1'], 200),
            'https://rabbitmq.example.test/api/consumers' => Http::response([], 200),
            'https://rabbitmq.example.test/api/consumers/%2F' => Http::response([], 200),
            'https://rabbitmq.example.test/api/vhosts' => Http::response([['name' => '/']], 200),
            'https://rabbitmq.example.test/api/vhosts/%2F' => Http::response(['name' => '/'], 200),
            'https://rabbitmq.example.test/api/vhosts/%2F/permissions' => Http::response([], 200),
            'https://rabbitmq.example.test/api/users' => Http::response([['name' => 'agent']], 200),
            'https://rabbitmq.example.test/api/users/agent' => Http::response(['name' => 'agent'], 200),
            'https://rabbitmq.example.test/api/permissions' => Http::response([], 200),
            'https://rabbitmq.example.test/api/permissions/%2F/agent' => Http::response([], 204),
            'https://rabbitmq.example.test/api/policies' => Http::response([], 200),
            'https://rabbitmq.example.test/api/policies/%2F' => Http::response([], 200),
            'https://rabbitmq.example.test/api/definitions' => Http::response(['rabbit_version' => '4.2.0'], 200),
        ]);

        $service = new RabbitMQService('agent', 'secret', 'https://rabbitmq.example.test/');

        $service->getOverview();
        $service->listNodes();
        $service->getNode('rabbit@node1');
        $service->healthCheck('alarms', ['timeout' => 30]);
        $service->alivenessTest('/');
        $service->listQueues(null, ['disable_stats' => true]);
        $service->listQueues('/', ['page_size' => 50]);
        $service->getQueue('/', 'orders.ready');
        $service->declareQueue('/', 'orders.ready', ['durable' => true, 'arguments' => []]);
        $service->deleteQueue('/', 'orders.ready', true, true);
        $service->purgeQueue('/', 'orders.ready');
        $service->getQueueBindings('/', 'orders.ready');
        $service->getMessages('/', 'orders.ready', ['count' => 2]);
        $service->listExchanges();
        $service->listExchanges('/');
        $service->getExchange('/', 'orders.events');
        $service->declareExchange('/', 'orders.events', ['type' => 'topic', 'durable' => true]);
        $service->deleteExchange('/', 'orders.events', true);
        $service->publishMessage('/', 'orders.events', ['properties' => [], 'routing_key' => 'order.created', 'payload' => '{}', 'payload_encoding' => 'string']);
        $service->listExchangeSourceBindings('/', 'orders.events');
        $service->listExchangeDestinationBindings('/', 'orders.events');
        $service->listBindings();
        $service->listBindings('/');
        $service->createBinding('/', 'orders.events', 'queue', 'orders.ready', 'order.created');
        $service->deleteBinding('/', 'orders.events', 'queue', 'orders.ready', 'order.created');
        $service->listConnections();
        $service->getConnection('conn 1');
        $service->closeConnection('conn 1', 'maintenance');
        $service->listChannels();
        $service->getChannel('chan 1');
        $service->listConsumers();
        $service->listConsumers('/');
        $service->listVhosts();
        $service->getVhost('/');
        $service->createVhost('/', ['description' => 'Default']);
        $service->deleteVhost('/');
        $service->listVhostPermissions('/');
        $service->listUsers();
        $service->getUser('agent');
        $service->listPermissions();
        $service->setPermissions('/', 'agent', '^$', '^$', '.*');
        $service->deletePermissions('/', 'agent');
        $service->listPolicies();
        $service->listPolicies('/');
        $service->exportDefinitions();
        $service->importDefinitions(['vhosts' => [['name' => '/']]]);

        Http::assertSent(static fn (Request $request): bool => $request->hasHeader('Authorization', 'Basic ' . base64_encode('agent:secret')));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://rabbitmq.example.test/api/overview');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && str_starts_with($request->url(), 'https://rabbitmq.example.test/api/health/checks/alarms?') && str_contains($request->url(), 'timeout=30'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'GET' && $request->url() === 'https://rabbitmq.example.test/api/aliveness-test/%2F');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://rabbitmq.example.test/api/queues/%2F/orders.ready' && $request['durable'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_starts_with($request->url(), 'https://rabbitmq.example.test/api/queues/%2F/orders.ready?') && str_contains($request->url(), 'if-empty=1') && str_contains($request->url(), 'if-unused=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://rabbitmq.example.test/api/queues/%2F/orders.ready/get' && $request['ackmode'] === 'ack_requeue_true' && $request['count'] === 2);
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://rabbitmq.example.test/api/exchanges/%2F/orders.events' && $request['type'] === 'topic');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && str_starts_with($request->url(), 'https://rabbitmq.example.test/api/exchanges/%2F/orders.events?') && str_contains($request->url(), 'if-unused=1'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://rabbitmq.example.test/api/exchanges/%2F/orders.events/publish' && $request['routing_key'] === 'order.created');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://rabbitmq.example.test/api/bindings/%2F/e/orders.events/q/orders.ready' && $request['routing_key'] === 'order.created');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'DELETE' && $request->url() === 'https://rabbitmq.example.test/api/connections/conn%201' && $request->hasHeader('X-Reason', 'maintenance'));
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://rabbitmq.example.test/api/vhosts/%2F' && $request['description'] === 'Default');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'PUT' && $request->url() === 'https://rabbitmq.example.test/api/permissions/%2F/agent' && $request['read'] === '.*');
        Http::assertSent(static fn (Request $request): bool => $request->method() === 'POST' && $request->url() === 'https://rabbitmq.example.test/api/definitions' && $request['vhosts'][0]['name'] === '/');
    }

    public function test_tools_map_agent_arguments_to_management_payloads(): void
    {
        Http::fake([
            'https://rabbitmq.example.test/api/health/checks/port-listener*' => Http::response(['status' => 'ok'], 200),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready' => Http::response([], 204),
            'https://rabbitmq.example.test/api/queues/%2F/orders.ready/get' => Http::response([['payload' => 'hello']], 200),
            'https://rabbitmq.example.test/api/bindings/%2F/e/orders.events/q/orders.ready' => Http::response(['routing_key' => 'order.created'], 201),
        ]);

        $service = new RabbitMQService('agent', 'secret', 'https://rabbitmq.example.test');
        self::assertNull((new RabbitMQHealthCheck($service))->execute([
            'check' => 'port-listener',
            'params' => ['port' => 5672],
        ])->error);
        self::assertNull((new RabbitMQDeclareQueue($service))->execute([
            'vhost' => '/',
            'name' => 'orders.ready',
            'definition' => ['durable' => true],
        ])->error);
        self::assertNull((new RabbitMQGetMessages($service))->execute([
            'vhost' => '/',
            'name' => 'orders.ready',
            'options' => ['count' => 3],
        ])->error);
        self::assertNull((new RabbitMQCreateBinding($service))->execute([
            'vhost' => '/',
            'source' => 'orders.events',
            'destination_type' => 'queue',
            'destination' => 'orders.ready',
            'routing_key' => 'order.created',
        ])->error);

        Http::assertSent(static fn (Request $request): bool => str_starts_with($request->url(), 'https://rabbitmq.example.test/api/health/checks/port-listener?') && str_contains($request->url(), 'port=5672'));
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rabbitmq.example.test/api/queues/%2F/orders.ready' && $request['durable'] === true);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rabbitmq.example.test/api/queues/%2F/orders.ready/get' && $request['count'] === 3);
        Http::assertSent(static fn (Request $request): bool => $request->url() === 'https://rabbitmq.example.test/api/bindings/%2F/e/orders.events/q/orders.ready' && $request['routing_key'] === 'order.created');
    }

    public function test_provider_exposes_expanded_surface_and_allowed_category(): void
    {
        $provider = new RabbitMQToolProvider();
        $tools = $provider->tools();

        self::assertSame('data', $provider->integrationMeta()['category']);
        self::assertSame('https://www.rabbitmq.com/docs/4.2/http-api-reference', $provider->integrationMeta()['docs_url']);
        self::assertArrayHasKey('rabbitmq_list_nodes', $tools);
        self::assertArrayHasKey('rabbitmq_declare_queue', $tools);
        self::assertArrayHasKey('rabbitmq_publish_message', $tools);
        self::assertArrayHasKey('rabbitmq_list_consumers', $tools);
        self::assertArrayHasKey('rabbitmq_set_permissions', $tools);
        self::assertArrayHasKey('rabbitmq_import_definitions', $tools);
        self::assertSame(41, count($tools));
    }
}
