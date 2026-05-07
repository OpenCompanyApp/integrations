<?php

namespace OpenCompany\Integrations\SauceLabs\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\SauceLabs\SauceLabsService;

/**
 * Shared executor for Sauce Labs tools.
 *
 * Child tools define operation metadata while this class validates required
 * arguments, maps query/body data, and dispatches service calls.
 */
abstract class AbstractSauceLabsTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const METHOD = '';
    protected const ARGUMENTS = [];
    protected const OPTIONAL = [];
    protected const REQUIRED = [];
    protected const USE_QUERY = false;
    protected const USE_PAYLOAD = false;

    /**
     * @param  SauceLabsService  $service  Sauce Labs API client.
     */
    public function __construct(protected SauceLabsService $service) {}

    public function name(): string { return static::NAME; }

    public function description(): string { return static::DESCRIPTION; }

    public function parameters(): array
    {
        $parameters = [];
        foreach (static::ARGUMENTS as $argument) {
            $parameters[$argument] = ['type' => 'string', 'required' => !in_array($argument, static::OPTIONAL, true), 'description' => str_replace('_', ' ', ucfirst((string) $argument)).'.'];
        }

        if (static::USE_QUERY) {
            $parameters['query'] = ['type' => 'object', 'description' => 'Query parameters.'];
        }

        if (static::USE_PAYLOAD) {
            $parameters['payload'] = ['type' => 'object', 'required' => in_array('payload', static::REQUIRED, true), 'description' => 'JSON request body.'];
        }

        return $parameters;
    }

    /**
     * Execute the Sauce Labs operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) {
                return ToolResult::error('Sauce Labs integration is not configured.');
            }

            $required = static::REQUIRED === [] ? array_values(array_diff(static::ARGUMENTS, static::OPTIONAL)) : static::REQUIRED;
            foreach ($required as $key) {
                $this->requireValue($args, (string) $key);
            }

            return ToolResult::success($this->dispatch($args));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    /**
     * Dispatch to the mapped service method.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function dispatch(array $args): array
    {
        $params = [];
        foreach (static::ARGUMENTS as $argument) {
            $params[] = (string) ($args[$argument] ?? '');
        }

        if (static::USE_QUERY) {
            $params[] = $this->query($args);
        }

        if (static::USE_PAYLOAD) {
            $params[] = $this->payload($args);
        }

        $method = static::METHOD;

        return $this->service->{$method}(...$params);
    }

    /**
     * Return explicit payload object or inferred write fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function payload(array $args): array
    {
        if (isset($args['payload']) && is_array($args['payload'])) {
            return $args['payload'];
        }

        $payload = $args;
        foreach ([...static::ARGUMENTS, 'query', 'payload'] as $key) {
            unset($payload[$key]);
        }

        return $payload;
    }

    /**
     * Return explicit query object or inferred read fields.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) {
            return $args['query'];
        }

        $query = $args;
        foreach ([...static::ARGUMENTS, 'payload'] as $key) {
            unset($query[$key]);
        }

        return $query;
    }

    /**
     * Ensure a required value is present.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireValue(array $args, string $key): void
    {
        $value = $args[$key] ?? null;
        if ($value === null || $value === '' || (is_array($value) && $value === [])) {
            throw new InvalidArgumentException($key.' is required.');
        }
    }
}
