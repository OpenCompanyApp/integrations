<?php

namespace OpenCompany\Integrations\Kafka;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Kafka (Confluent Cloud) API service for communicating with the Confluent Cloud REST API v1.
 *
 * Handles authentication via Bearer token and provides methods for
 * topics, clusters, producers, and user information.
 */
class KafkaService
{
    /**
     * Create a new KafkaService instance.
     *
     * @param  string  $apiToken  Confluent Cloud API token
     * @param  string  $clusterId  Default Kafka cluster ID
     */
    public function __construct(
        private string $apiToken = '',
        private string $clusterId = '',
    ) {}

    /**
     * Check whether the service has the required credentials configured.
     */
    public function isConfigured(): bool
    {
        return !empty($this->apiToken);
    }

    /**
     * Get the base API URL for Confluent Cloud.
     *
     * @return string The base URL
     */
    public function getBaseUrl(): string
    {
        return 'https://api.confluent.cloud/v1';
    }

    /**
     * List topics in a Kafka cluster.
     *
     * @param  string|null  $clusterId  Override the default cluster ID
     * @return array<string, mixed>
     */
    public function listTopics(?string $clusterId = null): array
    {
        $cluster = $clusterId ?? $this->clusterId;

        return $this->request('GET', '/kafka/v3/clusters/' . $cluster . '/topics');
    }

    /**
     * Get details of a specific topic.
     *
     * @param  string  $topicName  The topic name
     * @param  string|null  $clusterId  Override the default cluster ID
     * @return array<string, mixed>
     */
    public function getTopic(string $topicName, ?string $clusterId = null): array
    {
        $cluster = $clusterId ?? $this->clusterId;

        return $this->request('GET', '/kafka/v3/clusters/' . $cluster . '/topics/' . $topicName);
    }

    /**
     * Create a new topic in a Kafka cluster.
     *
     * @param  array<string, mixed>  $body  Topic definition (topic_name, partitions_count, replication_factor, configs)
     * @param  string|null  $clusterId  Override the default cluster ID
     * @return array<string, mixed>
     */
    public function createTopic(array $body, ?string $clusterId = null): array
    {
        $cluster = $clusterId ?? $this->clusterId;

        return $this->request('POST', '/kafka/v3/clusters/' . $cluster . '/topics', $body);
    }

    /**
     * List Kafka clusters.
     *
     * @return array<string, mixed>
     */
    public function listClusters(): array
    {
        return $this->request('GET', '/kafka/v3/clusters');
    }

    /**
     * Get details of a specific Kafka cluster.
     *
     * @param  string|null  $clusterId  Override the default cluster ID
     * @return array<string, mixed>
     */
    public function getCluster(?string $clusterId = null): array
    {
        $cluster = $clusterId ?? $this->clusterId;

        return $this->request('GET', '/kafka/v3/clusters/' . $cluster);
    }

    /**
     * List producers for a specific topic.
     *
     * @param  string  $topicName  The topic name
     * @param  string|null  $clusterId  Override the default cluster ID
     * @return array<string, mixed>
     */
    public function listProducers(string $topicName, ?string $clusterId = null): array
    {
        $cluster = $clusterId ?? $this->clusterId;

        return $this->request('GET', '/kafka/v3/clusters/' . $cluster . '/topics/' . $topicName . '/producers');
    }

    /**
     * Get the currently authenticated user.
     *
     * @return array<string, mixed>
     */
    public function getCurrentUser(): array
    {
        return $this->request('GET', '/users/me');
    }

    /**
     * Make an API request and return parsed JSON.
     *
     * @param  string  $method  HTTP method (GET, POST, PUT, DELETE)
     * @param  string  $path  API path (e.g., "/kafka/v3/clusters")
     * @param  array<string, mixed>  $data  Query params (GET) or body data (POST/PUT)
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        $response = $this->rawRequest($method, $path, $data);

        if ($response->status() === 204) {
            return [];
        }

        return $response->json() ?? [];
    }

    /**
     * Make a raw HTTP request to the Confluent Cloud API.
     *
     * @param  string  $method  HTTP method
     * @param  string  $path  API path
     * @param  array<string, mixed>  $data  Request data
     * @return \Illuminate\Http\Client\Response
     *
     * @throws \RuntimeException On missing credentials, connection errors, or API errors
     */
    private function rawRequest(string $method, string $path, array $data = []): \Illuminate\Http\Client\Response
    {
        if (!$this->apiToken) {
            throw new \RuntimeException('Confluent Cloud API token is not configured.');
        }

        $url = $this->getBaseUrl() . $path;

        try {
            $http = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($url, $data),
                'POST' => $http->post($url, $data),
                'PUT' => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (!$response->successful()) {
                $error = $response->json('errors') ?? $response->json('message') ?? $response->body();

                if (is_array($error)) {
                    $error = implode(', ', $error);
                }

                Log::error("Kafka API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'error' => $error,
                ]);

                throw new \RuntimeException("Kafka API error ({$response->status()}): {$error}");
            }

            return $response;
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Kafka API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Kafka API: {$e->getMessage()}");
        }
    }
}
