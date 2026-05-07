<?php

namespace OpenCompany\Integrations\Databricks\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\Databricks\DatabricksService;

/**
 * Shared executor for Databricks endpoint-specific tools.
 *
 * Child classes map to official Databricks SDK REST methods while this base
 * handles configured-state checks, path/query/header/body shaping, and errors.
 */
abstract class AbstractDatabricksTool implements Tool
{
    protected const NAME=''; protected const DESCRIPTION=''; protected const PARAMETERS=[]; protected const METHOD='GET'; protected const PATH=''; protected const PATH_PARAMS=[];
    /** @param  DatabricksService  $service  Databricks API client. */ public function __construct(protected DatabricksService $service) {}
    public function name(): string { return static::NAME; } public function description(): string { return static::DESCRIPTION; } public function parameters(): array { return static::PARAMETERS; }
    /** @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint. */ public function execute(array $args): ToolResult { try { if(!$this->service->isConfigured()) return ToolResult::error('Databricks integration is not configured.'); return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->pathParams($args), $this->objectArg($args,'query'), $this->objectArg($args,'headers'), $this->objectArg($args,'body'))); } catch(\Throwable $e) { return ToolResult::error($e->getMessage()); } }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */ private function pathParams(array $args): array { $out=[]; foreach(static::PATH_PARAMS as $official=>$key){ if(!array_key_exists($key,$args)||$args[$key]===null||$args[$key]==='') throw new InvalidArgumentException($key.' must be a non-empty parameter.'); $out[$official]=$args[$key]; } return $out; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */ private function objectArg(array $args, string $key): array { $value=$args[$key]??[]; if($value!==[]&&!is_array($value)) throw new InvalidArgumentException($key.' must be an object.'); return $value; }
}