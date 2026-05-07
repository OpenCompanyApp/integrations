<?php

namespace OpenCompany\Integrations\GoogleTasks\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleTasks\GoogleTasksService;

/**
 * Shared executor for Google Tasks endpoint-specific tools.
 *
 * Each child class maps to one Discovery method while this base class handles
 * configured-state checks, path/query/body shaping, and error conversion.
 */
abstract class AbstractGoogleTasksTool implements Tool
{
    protected const NAME = '';
    protected const DESCRIPTION = '';
    protected const PARAMETERS = [];
    protected const METHOD = 'GET';
    protected const PATH = '';
    protected const PATH_PARAMS = [];
    protected const RESERVED_PATH_PARAMS = [];
    protected const QUERY_KEYS = [];
    protected const BODY_REQUIRED = false;

    /**
     * @param  GoogleTasksService  $service  Google Tasks API client.
     */
    public function __construct(protected GoogleTasksService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Google Tasks REST method.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) return ToolResult::error('Google Tasks integration is not configured.');
            return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->pathParams($args), static::RESERVED_PATH_PARAMS, $this->query($args), $this->body($args)));
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }

    /**
     * Extract required path parameters.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function pathParams(array $args): array { $params=[]; foreach(static::PATH_PARAMS as $key)$params[$key]=$this->requireScalar($args,$key); return $params; }

    /**
     * Extract query parameters from `query` or known top-level shortcut keys.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function query(array $args): array
    {
        if (isset($args['query']) && is_array($args['query'])) return $args['query'];
        $query=[]; foreach(static::QUERY_KEYS as $key) if(array_key_exists($key,$args)&&$args[$key]!==null&&$args[$key]!=='') $query[$key]=$args[$key];
        return $query;
    }

    /**
     * Extract the official JSON request body from tool arguments.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     * @return array<string, mixed>
     */
    private function body(array $args): array
    {
        $body=$args['body']??[];
        if(static::BODY_REQUIRED&&(!is_array($body)||$body===[])) throw new InvalidArgumentException('body must be a non-empty object matching the Google Tasks API request schema.');
        if($body!==[]&&!is_array($body)) throw new InvalidArgumentException('body must be an object.');
        return $body;
    }

    /**
     * Ensure a required scalar argument exists.
     *
     * @param  array<string, mixed>  $args  Tool arguments.
     */
    private function requireScalar(array $args,string $key): string { $value=$args[$key]??null; if(is_int($value)||is_float($value)||is_bool($value))return(string)$value; if(!is_string($value)||trim($value)==='') throw new InvalidArgumentException($key.' must be a non-empty string.'); return $value; }
}