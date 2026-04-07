<?php

namespace OpenCompany\Integrations\Kafka;

use OpenCompany\Integrations\Kafka\Tools\KafkaListTopics;
use OpenCompany\Integrations\Kafka\Tools\KafkaGetTopic;
use OpenCompany\Integrations\Kafka\Tools\KafkaCreateTopic;
use OpenCompany\Integrations\Kafka\Tools\KafkaListClusters;
use OpenCompany\Integrations\Kafka\Tools\KafkaGetCluster;
use OpenCompany\Integrations\Kafka\Tools\KafkaListProducers;
use OpenCompany\Integrations\Kafka\Tools\KafkaGetCurrentUser;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use Illuminate\Support\Facades\Http;

/**
 * Tool provider for Kafka (Confluent Cloud) integration.
 *
 * Registers 7 tools for topics, clusters, producers, and user info.
 * Implements ConfigurableIntegration for multi-account support with api_token and cluster_id fields.
 */
class KafkaToolProvider implements ToolProvider, ConfigurableIntegration
{
    /**
     * Get the application name identifier.
     */
    public function appName(): string
    {
        return 'kafka';
    }

    /**
     * Get metadata for the app listing.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'topics, clusters, producers',
            'description' => 'Apache Kafka messaging via Confluent Cloud',
            'icon' => 'ph:waveform',
            'logo' => 'simple-icons:apachekafka',
        ];
    }

    /**
     * Get metadata for the integration catalog.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'Apache Kafka',
            'description' => 'Distributed event streaming platform via Confluent Cloud',
            'icon' => 'ph:waveform',
            'logo' => 'simple-icons:apachekafka',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://docs.confluent.io/platform/current/rest.html',
        ];
    }

    /**
     * Get the configuration schema for Kafka credentials.
     *
     * @return array<int, array<string, mixed>>
     */
    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Enter your Confluent Cloud API token',
                'hint' => 'Generate an API token in Confluent Cloud under <strong>Administration → API Keys</strong>',
                'required' => true,
            ],
            [
                'key' => 'cluster_id',
                'type' => 'text',
                'label' => 'Cluster ID',
                'placeholder' => 'Enter your Kafka cluster ID',
                'hint' => 'Find your cluster ID in Confluent Cloud under <strong>Cluster → Settings</strong>',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the connection to Confluent Cloud using the /users/me endpoint.
     *
     * @param  array<string, mixed>  $config  Configuration containing api_token and cluster_id
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiToken)) {
            return ['success' => false, 'error' => 'No API token provided'];
        }

        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(10)->get('https://api.confluent.cloud/v1/users/me');

            if ($response->successful()) {
                return [
                    'success' => true,
                    'message' => 'Connected to Confluent Cloud. API token validated.',
                ];
            }

            return [
                'success' => false,
                'error' => 'Confluent Cloud API token validation failed. Check your credentials.',
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /**
     * Get the validation rules for configuration fields.
     *
     * @return array<string, string>
     */
    public function validationRules(): array
    {
        return [
            'api_token' => 'nullable|string',
            'cluster_id' => 'nullable|string',
        ];
    }

    /**
     * Get the list of tools provided by this integration.
     *
     * @return array<string, array<string, mixed>>
     */
    public function tools(): array
    {
        return [
            'kafka_list_topics' => [
                'class' => KafkaListTopics::class,
                'type' => 'read',
                'name' => 'List Topics',
                'description' => 'List Kafka topics in a cluster.',
                'icon' => 'ph:list',
            ],
            'kafka_get_topic' => [
                'class' => KafkaGetTopic::class,
                'type' => 'read',
                'name' => 'Get Topic',
                'description' => 'Get details of a specific Kafka topic.',
                'icon' => 'ph:info',
            ],
            'kafka_create_topic' => [
                'class' => KafkaCreateTopic::class,
                'type' => 'write',
                'name' => 'Create Topic',
                'description' => 'Create a new Kafka topic in a cluster.',
                'icon' => 'ph:plus-circle',
            ],
            'kafka_list_clusters' => [
                'class' => KafkaListClusters::class,
                'type' => 'read',
                'name' => 'List Clusters',
                'description' => 'List Kafka clusters in your Confluent Cloud environment.',
                'icon' => 'ph:cube',
            ],
            'kafka_get_cluster' => [
                'class' => KafkaGetCluster::class,
                'type' => 'read',
                'name' => 'Get Cluster',
                'description' => 'Get details of a specific Kafka cluster.',
                'icon' => 'ph:cube-focus',
            ],
            'kafka_list_producers' => [
                'class' => KafkaListProducers::class,
                'type' => 'read',
                'name' => 'List Producers',
                'description' => 'List producers for a specific Kafka topic.',
                'icon' => 'ph:arrow-up-circle',
            ],
            'kafka_get_current_user' => [
                'class' => KafkaGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the currently authenticated Confluent Cloud user. Useful for verifying credentials.',
                'icon' => 'ph:user',
            ],
        ];
    }

    /**
     * Get the path to the Lua documentation file.
     */
    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/kafka.md';
    }

    /**
     * Get the credential fields for Kafka authentication.
     *
     * @return array<int, array<string, mixed>>
     */
    public function credentialFields(): array
    {
        return [
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
            ['key' => 'cluster_id', 'type' => 'text', 'label' => 'Cluster ID', 'required' => false],
        ];
    }

    /**
     * Confirm this class is an integration provider.
     */
    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create a tool instance, optionally resolving credentials for a specific account.
     *
     * @param  class-string<Tool>  $class  The tool class to instantiate
     * @param  array<string, mixed>  $context  Context containing optional 'account' key
     */
    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new KafkaService(
                apiToken: $creds->get('kafka', 'api_token', '', $account),
                clusterId: $creds->get('kafka', 'cluster_id', '', $account),
            );

            return new $class($service);
        }

        return new $class(app(KafkaService::class));
    }
}
