<?php

namespace OpenCompany\Integrations\RabbitMQ;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use RuntimeException;

/**
 * HTTP client for the RabbitMQ Management HTTP API.
 *
 * Handles HTTP Basic authentication, JSON request dispatch, path encoding for vhosts
 * such as "/", and normalized errors for broker management endpoints.
 */
class RabbitMQService
{
    /**
     * @param  string  $username  RabbitMQ management username
     * @param  string  $password  RabbitMQ management password
     * @param  string  $baseUrl  RabbitMQ Management API base URL
     */
    public function __construct(
        private string $username = '',
        private string $password = '',
        private string $baseUrl = 'http://localhost:15672',
    ) {
        $this->baseUrl = rtrim($this->baseUrl, '/');
    }

    public function isConfigured(): bool
    {
        return $this->username !== '' && $this->password !== '';
    }

    /**
     * Get cluster overview.
     *
     * @return array<string, mixed>
     */
    public function getOverview(): array
    {
        return $this->request('GET', '/api/overview');
    }

    /**
     * List cluster nodes.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listNodes(): array
    {
        return $this->request('GET', '/api/nodes');
    }

    /**
     * Get one cluster node.
     *
     * @param  string  $name  Node name
     * @return array<string, mixed>
     */
    public function getNode(string $name): array
    {
        return $this->request('GET', '/api/nodes/' . $this->encodePath($name));
    }

    /**
     * Run a documented RabbitMQ health check.
     *
     * @param  string  $check  Health check name such as alarms, certificate-expiration, local-alarms, node-is-mirror-sync-critical, port-listener, protocol-listener, virtual-hosts, or node-is-quorum-critical
     * @param  array<string, mixed>  $params  Query parameters for checks that require port, protocol, or timeout
     * @return array<string, mixed>
     */
    public function healthCheck(string $check, array $params = []): array
    {
        return $this->request('GET', '/api/health/checks/' . $this->encodePath($check), $params);
    }

    /**
     * Run an aliveness test for a vhost.
     *
     * @param  string  $vhost  Virtual host name
     * @return array<string, mixed>
     */
    public function alivenessTest(string $vhost = '/'): array
    {
        return $this->request('GET', '/api/aliveness-test/' . $this->encodePath($vhost));
    }

    /**
     * List queues, optionally scoped to a vhost.
     *
     * @param  string|null  $vhost  Optional virtual host name
     * @param  array<string, mixed>  $params  Query parameters such as page, page_size, name, use_regex, disable_stats, enable_queue_totals
     * @return array<int, array<string, mixed>>|array<string, mixed>
     */
    public function listQueues(?string $vhost = null, array $params = []): array
    {
        $path = $vhost === null ? '/api/queues' : '/api/queues/' . $this->encodePath($vhost);

        return $this->request('GET', $path, $params);
    }

    /**
     * Get details for a specific queue.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @return array<string, mixed>
     */
    public function getQueue(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name));
    }

    /**
     * Declare or update a queue.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @param  array<string, mixed>  $definition  Queue definition with durable, auto_delete, arguments, node
     * @return array<string, mixed>
     */
    public function declareQueue(string $vhost, string $name, array $definition = []): array
    {
        return $this->request('PUT', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name), $definition);
    }

    /**
     * Delete a queue.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @param  bool|null  $ifEmpty  Only delete if empty
     * @param  bool|null  $ifUnused  Only delete if unused
     * @return array<string, mixed>
     */
    public function deleteQueue(string $vhost, string $name, ?bool $ifEmpty = null, ?bool $ifUnused = null): array
    {
        return $this->request('DELETE', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name), array_filter([
            'if-empty' => $ifEmpty,
            'if-unused' => $ifUnused,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Purge ready messages from a queue.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @return array<string, mixed>
     */
    public function purgeQueue(string $vhost, string $name): array
    {
        return $this->request('DELETE', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/contents');
    }

    /**
     * Get bindings for a queue.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @return array<int, array<string, mixed>>
     */
    public function getQueueBindings(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/bindings');
    }

    /**
     * Get messages from a queue using RabbitMQ's destructive HTTP API operation.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Queue name
     * @param  array<string, mixed>  $options  count, ackmode, encoding, truncate, requeue
     * @return array<int, array<string, mixed>>
     */
    public function getMessages(string $vhost, string $name, array $options = []): array
    {
        return $this->request('POST', '/api/queues/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/get', array_merge([
            'count' => 1,
            'ackmode' => 'ack_requeue_true',
            'encoding' => 'auto',
            'truncate' => 50000,
        ], $options));
    }

    /**
     * List exchanges, optionally scoped to a vhost.
     *
     * @param  string|null  $vhost  Optional virtual host name
     * @param  array<string, mixed>  $params  Query parameters
     * @return array<int, array<string, mixed>>|array<string, mixed>
     */
    public function listExchanges(?string $vhost = null, array $params = []): array
    {
        $path = $vhost === null ? '/api/exchanges' : '/api/exchanges/' . $this->encodePath($vhost);

        return $this->request('GET', $path, $params);
    }

    /**
     * Get one exchange.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @return array<string, mixed>
     */
    public function getExchange(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name));
    }

    /**
     * Declare or update an exchange.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @param  array<string, mixed>  $definition  Exchange definition with type, durable, auto_delete, internal, arguments
     * @return array<string, mixed>
     */
    public function declareExchange(string $vhost, string $name, array $definition): array
    {
        return $this->request('PUT', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name), $definition);
    }

    /**
     * Delete an exchange.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @param  bool|null  $ifUnused  Only delete if unused
     * @return array<string, mixed>
     */
    public function deleteExchange(string $vhost, string $name, ?bool $ifUnused = null): array
    {
        return $this->request('DELETE', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name), array_filter([
            'if-unused' => $ifUnused,
        ], static fn (mixed $value): bool => $value !== null));
    }

    /**
     * Publish a message to an exchange.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @param  array<string, mixed>  $message  properties, routing_key, payload, payload_encoding
     * @return array<string, mixed>
     */
    public function publishMessage(string $vhost, string $name, array $message): array
    {
        return $this->request('POST', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/publish', $message);
    }

    /**
     * List bindings where an exchange is the source.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @return array<int, array<string, mixed>>
     */
    public function listExchangeSourceBindings(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/bindings/source');
    }

    /**
     * List bindings where an exchange is the destination.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $name  Exchange name
     * @return array<int, array<string, mixed>>
     */
    public function listExchangeDestinationBindings(string $vhost, string $name): array
    {
        return $this->request('GET', '/api/exchanges/' . $this->encodePath($vhost) . '/' . $this->encodePath($name) . '/bindings/destination');
    }

    /**
     * List bindings across the cluster or one vhost.
     *
     * @param  string|null  $vhost  Optional virtual host name
     * @return array<int, array<string, mixed>>
     */
    public function listBindings(?string $vhost = null): array
    {
        $path = $vhost === null ? '/api/bindings' : '/api/bindings/' . $this->encodePath($vhost);

        return $this->request('GET', $path);
    }

    /**
     * Create a binding from an exchange to a queue or exchange.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $source  Source exchange
     * @param  string  $destinationType  queue or exchange
     * @param  string  $destination  Destination queue or exchange
     * @param  string  $routingKey  Routing key
     * @param  array<string, mixed>  $arguments  Binding arguments
     * @return array<string, mixed>
     */
    public function createBinding(string $vhost, string $source, string $destinationType, string $destination, string $routingKey = '', array $arguments = []): array
    {
        $kind = $destinationType === 'exchange' ? 'e' : 'q';

        return $this->request('POST', '/api/bindings/' . $this->encodePath($vhost) . '/e/' . $this->encodePath($source) . '/' . $kind . '/' . $this->encodePath($destination), [
            'routing_key' => $routingKey,
            'arguments' => $arguments,
        ]);
    }

    /**
     * Delete a binding by properties key.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $source  Source exchange
     * @param  string  $destinationType  queue or exchange
     * @param  string  $destination  Destination queue or exchange
     * @param  string  $propertiesKey  Binding properties key from RabbitMQ
     * @return array<string, mixed>
     */
    public function deleteBinding(string $vhost, string $source, string $destinationType, string $destination, string $propertiesKey): array
    {
        $kind = $destinationType === 'exchange' ? 'e' : 'q';

        return $this->request('DELETE', '/api/bindings/' . $this->encodePath($vhost) . '/e/' . $this->encodePath($source) . '/' . $kind . '/' . $this->encodePath($destination) . '/' . $this->encodePath($propertiesKey));
    }

    /**
     * List active connections.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listConnections(): array
    {
        return $this->request('GET', '/api/connections');
    }

    /**
     * Get one connection.
     *
     * @param  string  $name  Connection name
     * @return array<string, mixed>
     */
    public function getConnection(string $name): array
    {
        return $this->request('GET', '/api/connections/' . $this->encodePath($name));
    }

    /**
     * Close a connection.
     *
     * @param  string  $name  Connection name
     * @param  string|null  $reason  Optional close reason
     * @return array<string, mixed>
     */
    public function closeConnection(string $name, ?string $reason = null): array
    {
        $headers = $reason === null ? [] : ['X-Reason' => $reason];

        return $this->request('DELETE', '/api/connections/' . $this->encodePath($name), [], $headers);
    }

    /**
     * List channels.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listChannels(): array
    {
        return $this->request('GET', '/api/channels');
    }

    /**
     * Get one channel.
     *
     * @param  string  $name  Channel name
     * @return array<string, mixed>
     */
    public function getChannel(string $name): array
    {
        return $this->request('GET', '/api/channels/' . $this->encodePath($name));
    }

    /**
     * List consumers globally or for one vhost.
     *
     * @param  string|null  $vhost  Optional virtual host name
     * @return array<int, array<string, mixed>>
     */
    public function listConsumers(?string $vhost = null): array
    {
        $path = $vhost === null ? '/api/consumers' : '/api/consumers/' . $this->encodePath($vhost);

        return $this->request('GET', $path);
    }

    /**
     * List virtual hosts.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listVhosts(): array
    {
        return $this->request('GET', '/api/vhosts');
    }

    /**
     * Get one virtual host.
     *
     * @param  string  $name  Virtual host name
     * @return array<string, mixed>
     */
    public function getVhost(string $name): array
    {
        return $this->request('GET', '/api/vhosts/' . $this->encodePath($name));
    }

    /**
     * Create or update a virtual host.
     *
     * @param  string  $name  Virtual host name
     * @param  array<string, mixed>  $metadata  description, tags, default_queue_type, protected_from_deletion, tracing
     * @return array<string, mixed>
     */
    public function createVhost(string $name, array $metadata = []): array
    {
        return $this->request('PUT', '/api/vhosts/' . $this->encodePath($name), $metadata);
    }

    /**
     * Delete a virtual host.
     *
     * @param  string  $name  Virtual host name
     * @return array<string, mixed>
     */
    public function deleteVhost(string $name): array
    {
        return $this->request('DELETE', '/api/vhosts/' . $this->encodePath($name));
    }

    /**
     * List permissions for a vhost.
     *
     * @param  string  $vhost  Virtual host name
     * @return array<int, array<string, mixed>>
     */
    public function listVhostPermissions(string $vhost): array
    {
        return $this->request('GET', '/api/vhosts/' . $this->encodePath($vhost) . '/permissions');
    }

    /**
     * List users.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listUsers(): array
    {
        return $this->request('GET', '/api/users');
    }

    /**
     * Get one user.
     *
     * @param  string  $name  Username
     * @return array<string, mixed>
     */
    public function getUser(string $name): array
    {
        return $this->request('GET', '/api/users/' . $this->encodePath($name));
    }

    /**
     * List permissions globally.
     *
     * @return array<int, array<string, mixed>>
     */
    public function listPermissions(): array
    {
        return $this->request('GET', '/api/permissions');
    }

    /**
     * Set permissions for a user on a vhost.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $user  Username
     * @param  string  $configure  Configure regex
     * @param  string  $write  Write regex
     * @param  string  $read  Read regex
     * @return array<string, mixed>
     */
    public function setPermissions(string $vhost, string $user, string $configure, string $write, string $read): array
    {
        return $this->request('PUT', '/api/permissions/' . $this->encodePath($vhost) . '/' . $this->encodePath($user), [
            'configure' => $configure,
            'write' => $write,
            'read' => $read,
        ]);
    }

    /**
     * Delete permissions for a user on a vhost.
     *
     * @param  string  $vhost  Virtual host name
     * @param  string  $user  Username
     * @return array<string, mixed>
     */
    public function deletePermissions(string $vhost, string $user): array
    {
        return $this->request('DELETE', '/api/permissions/' . $this->encodePath($vhost) . '/' . $this->encodePath($user));
    }

    /**
     * List policies globally or for one vhost.
     *
     * @param  string|null  $vhost  Optional virtual host name
     * @return array<int, array<string, mixed>>
     */
    public function listPolicies(?string $vhost = null): array
    {
        $path = $vhost === null ? '/api/policies' : '/api/policies/' . $this->encodePath($vhost);

        return $this->request('GET', $path);
    }

    /**
     * Export broker definitions.
     *
     * @return array<string, mixed>
     */
    public function exportDefinitions(): array
    {
        return $this->request('GET', '/api/definitions');
    }

    /**
     * Import broker definitions.
     *
     * @param  array<string, mixed>  $definitions  RabbitMQ definitions document
     * @return array<string, mixed>
     */
    public function importDefinitions(array $definitions): array
    {
        return $this->request('POST', '/api/definitions', $definitions);
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @param  array<string, string>  $headers  Extra request headers
     * @return array<string, mixed>|array<int, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $headers = []): array
    {
        $response = $this->rawRequest($method, $path, $data, $headers);

        if ($response->status() === 204) {
            return [];
        }

        $json = $response->json();
        if (is_array($json)) {
            return $json;
        }

        return ['message' => trim($response->body())];
    }

    /**
     * Dispatch a raw HTTP request.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Query parameters or JSON body
     * @param  array<string, string>  $headers  Extra request headers
     * @return Response
     */
    private function rawRequest(string $method, string $path, array $data = [], array $headers = []): Response
    {
        if (! $this->isConfigured()) {
            throw new RuntimeException('RabbitMQ credentials (username and password) are not configured.');
        }

        $url = $this->baseUrl . $path;

        try {
            $http = Http::withBasicAuth($this->username, $this->password)
                ->withHeaders(array_merge(['Accept' => 'application/json', 'Content-Type' => 'application/json'], $headers))
                ->timeout(30);

            if (strtoupper($method) === 'DELETE' && $data !== []) {
                $url .= (str_contains($url, '?') ? '&' : '?') . http_build_query($data);
                $data = [];
            }

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $this->throwApiError($method, $path, $response);
            }

            return $response;
        } catch (ConnectionException $e) {
            Log::error("RabbitMQ API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);

            throw new RuntimeException("Failed to connect to RabbitMQ API: {$e->getMessage()}");
        }
    }

    /**
     * Log and throw a normalized API error.
     *
     * @throws RuntimeException
     */
    private function throwApiError(string $method, string $path, Response $response): never
    {
        $error = $response->json('reason') ?? $response->json('error') ?? $response->body();

        Log::error("RabbitMQ API error: {$method} {$path}", [
            'status' => $response->status(),
            'error' => $error,
        ]);

        throw new RuntimeException("RabbitMQ API error ({$response->status()}): " . (is_string($error) ? $error : json_encode($error)));
    }

    /**
     * URL-encode one RabbitMQ path segment.
     */
    private function encodePath(string $segment): string
    {
        return rawurlencode($segment);
    }
}
