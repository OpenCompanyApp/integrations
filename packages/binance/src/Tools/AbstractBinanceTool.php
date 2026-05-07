<?php

namespace OpenCompany\Integrations\Binance\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Binance\BinanceService;

/**
 * Shared executor for Binance endpoint-specific tools.
 *
 * Handles configured-state checks, path/query/header mapping, authentication
 * mode selection, dispatch, and error conversion for generated endpoint tools.
 */
abstract class AbstractBinanceTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const QUERY_PARAMS = [];
    protected const HEADER_PARAMS = [];
    protected const AUTH_MODE = 'api_key';

    /**
     * @param  BinanceService  $service  Binance API client.
     */
    public function __construct(protected BinanceService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Binance API operation.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured(static::AUTH_MODE)) {
                return ToolResult::error($this->configurationError());
            }

            return ToolResult::success($this->service->request(
                static::METHOD,
                static::PATH,
                $this->mapped($args, static::PATH_PARAMS, true),
                $this->mapped($args, static::QUERY_PARAMS),
                $this->mapped($args, static::HEADER_PARAMS),
                static::AUTH_MODE,
            ));
        } catch (\Throwable $e) {
            return ToolResult::error($e->getMessage());
        }
    }

    private function configurationError(): string
    {
        return match (static::AUTH_MODE) {
            'signed' => 'Binance API key and API secret are required for this signed endpoint.',
            'api_key' => 'Binance API key is required for this endpoint.',
            default => 'Binance integration is not configured.',
        };
    }

    /**
     * @param  array<string, mixed>  $args  Tool arguments.
     * @param  array<string, string>  $map  Official parameter name to tool key map.
     * @return array<string, mixed>
     */
    private function mapped(array $args, array $map, bool $required = false): array
    {
        $out = [];
        foreach ($map as $official => $key) {
            if (!array_key_exists($key, $args) || $args[$key] === null || $args[$key] === '') {
                if ($required) {
                    throw new InvalidArgumentException($key . ' must be a non-empty parameter.');
                }
                continue;
            }
            $out[$official] = $args[$key];
        }

        return $out;
    }
}
