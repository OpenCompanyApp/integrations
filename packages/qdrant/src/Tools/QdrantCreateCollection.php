<?php

namespace OpenCompany\Integrations\Qdrant\Tools;

use OpenCompany\Integrations\Qdrant\QdrantService;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;

/**
 * Create a Qdrant vector collection.
 */
class QdrantCreateCollection implements Tool
{
    /**
     * @param  QdrantService  $service  The Qdrant REST API client.
     */
    public function __construct(
        private QdrantService $service,
    ) {}

    public function name(): string
    {
        return 'qdrant_create_collection';
    }

    public function description(): string
    {
        return 'Create a new vector collection in Qdrant. You must specify the vector configuration (size, distance metric). Optionally provide HNSW, quantization, and optimization settings.';
    }

    public function parameters(): array
    {
        return [
            'name' => ['type' => 'string', 'required' => true, 'description' => 'Name for the new collection.'],
            'vectors' => ['type' => 'object', 'required' => true, 'description' => 'Vector configuration. Example: {"size": 1536, "distance": "Cosine"}. Distance options: Cosine, Euclid, Dot.'],
            'hnsw_config' => ['type' => 'object', 'description' => 'HNSW index configuration (e.g., {"m": 16, "ef_construct": 100}).'],
            'optimizers_config' => ['type' => 'object', 'description' => 'Optimizer configuration (e.g., {"indexing_threshold": 20000}).'],
            'quantization_config' => ['type' => 'object', 'description' => 'Quantization configuration for memory savings (scalar or product).'],
            'replication_factor' => ['type' => 'integer', 'description' => 'Number of replicas for each shard (default: 1).'],
            'shard_number' => ['type' => 'integer', 'description' => 'Number of shards for the collection (default: 1 for single-node).'],
        ];
    }

    /**
     * Create a collection with vector configuration.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (! $this->service->isConfigured()) {
                return ToolResult::error('Qdrant integration is not configured.');
            }

            if (empty($args['name'])) {
                return ToolResult::error('The "name" parameter is required.');
            }

            if (empty($args['vectors'])) {
                return ToolResult::error('The "vectors" parameter is required. Specify at least size and distance (e.g., {"size": 1536, "distance": "Cosine"}).');
            }

            $config = [];

            // Handle vectors — can be a single config or named vectors
            $vectors = $args['vectors'];
            if (is_string($vectors)) {
                $vectors = json_decode($vectors, true);
                if ($vectors === null) {
                    return ToolResult::error('Invalid JSON in "vectors" parameter.');
                }
            }
            $config['vectors'] = $vectors;

            // Optional configurations
            if (isset($args['hnsw_config'])) {
                $hnsw = $args['hnsw_config'];
                $config['hnsw_config'] = is_string($hnsw) ? json_decode($hnsw, true) : $hnsw;
            }

            if (isset($args['optimizers_config'])) {
                $opt = $args['optimizers_config'];
                $config['optimizers_config'] = is_string($opt) ? json_decode($opt, true) : $opt;
            }

            if (isset($args['quantization_config'])) {
                $quant = $args['quantization_config'];
                $config['quantization_config'] = is_string($quant) ? json_decode($quant, true) : $quant;
            }

            if (isset($args['replication_factor'])) {
                $config['replication_factor'] = (int) $args['replication_factor'];
            }

            if (isset($args['shard_number'])) {
                $config['shard_number'] = (int) $args['shard_number'];
            }

            $result = $this->service->createCollection($args['name'], $config);

            return ToolResult::success($result);
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
