<?php

namespace OpenCompany\Integrations\PubMed\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\PubMed\PubMedService;

/**
 * Shared executor for focused PubMed and NCBI E-utilities tools.
 *
 * Child classes declare utility names, defaults, required arguments, and fields
 * that should be sent in a POST body instead of the query string.
 */
abstract class AbstractPubMedTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const UTILITY = '';
    protected const METHOD = 'GET';
    protected const DEFAULTS = [];
    protected const REQUIRED = [];
    protected const BODY_FIELDS = [];
    protected const REQUIRE_IDS_OR_HISTORY = false;

    /**
     * @param  PubMedService  $service  PubMed and NCBI E-utilities API client.
     */
    public function __construct(protected PubMedService $service) {}

    public function name(): string
    {
        return static::NAME;
    }

    public function description(): string
    {
        return static::DESCRIPTION;
    }

    public function parameters(): array
    {
        return static::PARAMETERS + [
            'db' => ['type' => 'string', 'required' => false, 'description' => 'Entrez database. Defaults to pubmed where the utility supports db.'],
            'api_key' => ['type' => 'string', 'required' => false, 'description' => 'Optional NCBI API key for higher rate limits.'],
            'email' => ['type' => 'string', 'required' => false, 'description' => 'Optional developer contact email registered with NCBI.'],
            'tool' => ['type' => 'string', 'required' => false, 'description' => 'Optional registered software name sent to NCBI.'],
            'extra' => ['type' => 'object', 'required' => false, 'description' => 'Additional official E-utilities parameters. Top-level arguments override duplicate keys.'],
        ];
    }

    /**
     * Execute the E-utility call with shared validation and exception handling.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                throw new InvalidArgumentException('PubMed integration is not configured.');
            }

            $args = $this->prepareArgs($args);

            foreach (static::REQUIRED as $key) {
                $this->requireValue($args, $key);
            }

            if (static::REQUIRE_IDS_OR_HISTORY) {
                $hasIds = $this->hasValue($args, 'id');
                $hasHistory = $this->hasValue($args, 'query_key') && $this->hasValue($args, 'WebEnv');
                if (!$hasIds && !$hasHistory) {
                    throw new InvalidArgumentException('Provide id or both query_key and WebEnv.');
                }
            }

            $extra = isset($args['extra']) && is_array($args['extra']) ? $args['extra'] : [];
            unset($args['extra']);
            $params = array_merge(static::DEFAULTS, $extra, $args);
            $body = [];

            foreach (static::BODY_FIELDS as $field) {
                if (array_key_exists($field, $params)) {
                    $body[$field] = $params[$field];
                    unset($params[$field]);
                }
            }

            if (static::METHOD === 'POST') {
                return ToolResult::success($this->service->post(static::UTILITY, $params, $body));
            }

            return ToolResult::success($this->service->get(static::UTILITY, $params));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Normalize tool-specific arguments before validation and dispatch.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    protected function prepareArgs(array $args): array
    {
        return $args;
    }

    /**
     * Ensure a required argument is present and non-empty.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        if (!$this->hasValue($args, $key)) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }

    /**
     * Determine whether an argument contains a usable value.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function hasValue(array $args, string $key): bool
    {
        return array_key_exists($key, $args) && $args[$key] !== null && $args[$key] !== '' && (!is_array($args[$key]) || $args[$key] !== []);
    }
}
