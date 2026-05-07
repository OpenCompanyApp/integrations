<?php

namespace OpenCompany\Integrations\OpenAlex\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenAlex\OpenAlexService;

/**
 * Shared executor for OpenAlex singleton entity endpoints.
 *
 * Child tools bind a specific entity slug while this class validates the ID and
 * passes through optional select/query parameters.
 */
abstract class AbstractOpenAlexGetTool implements Tool
{
    protected const NAME = '';
    protected const ENTITY = '';
    protected const LABEL = '';

    /**
     * @param  OpenAlexService  $service  OpenAlex API client.
     */
    public function __construct(protected OpenAlexService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return 'Get one OpenAlex '.static::LABEL.' by OpenAlex ID or supported external ID.';
    }

    public function parameters(): array
    {
        return [
            'id' => ['type' => 'string', 'required' => true, 'description' => 'OpenAlex ID or supported external ID, such as doi:10.7717/peerj.4375, ORCID, ROR, ISSN, or PMID where the endpoint supports it.'],
            'select' => ['type' => ['string', 'array'], 'required' => false, 'description' => 'Fields to return. Arrays are sent comma-separated.', 'items' => ['type' => 'string']],
            'query' => ['type' => 'object', 'required' => false, 'description' => 'Additional official OpenAlex query parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the OpenAlex singleton endpoint.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            $id = (string) ($args['id'] ?? '');
            if ($id === '') {
                throw new InvalidArgumentException('id is required.');
            }

            $query = isset($args['query']) && is_array($args['query']) ? $args['query'] : [];
            unset($args['query'], $args['id']);

            return ToolResult::success($this->service->get(static::ENTITY, $id, array_merge($query, $args)));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }
}
