<?php

namespace OpenCompany\Integrations\OpenFGA\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\OpenFGA\OpenFGAService;

/**
 * Shared executor for OpenFGA endpoint-specific tools.
 *
 * Child classes map to official Swagger operations while this base handles
 * configured-state checks, path/query/header/body shaping, and errors.
 */
abstract class AbstractOpenFGATool implements Tool
{
    protected const NAME=''; protected const DESCRIPTION=''; protected const PARAMETERS=[]; protected const METHOD='GET'; protected const PATH=''; protected const PATH_PARAMS=[]; protected const QUERY_PARAMS=[]; protected const HEADER_PARAMS=[]; protected const BODY_REQUIRED=false;
    /** @param  OpenFGAService  $service  OpenFGA API client. */ public function __construct(protected OpenFGAService $service) {}
    public function name(): string { return static::NAME; } public function description(): string { return static::DESCRIPTION; } public function parameters(): array { return static::PARAMETERS; }
    /** @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint. */ public function execute(array $args): ToolResult { try { if(!$this->service->isConfigured()) return ToolResult::error('OpenFGA integration is not configured.'); return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->mapped($args, static::PATH_PARAMS, true), $this->mapped($args, static::QUERY_PARAMS), $this->mapped($args, static::HEADER_PARAMS), $this->body($args))); } catch(\Throwable $e) { return ToolResult::error($e->getMessage()); } }
    /** @param  array<string, mixed>  $args  Tool arguments. @param  array<string, string>  $map  Official name to tool key map. @return array<string, mixed> */ private function mapped(array $args,array $map,bool $required=false): array { $out=[]; foreach($map as $official=>$key){ if(!array_key_exists($key,$args)||$args[$key]===null||$args[$key]===''){ if($required) throw new InvalidArgumentException($key.' must be a non-empty parameter.'); continue; } $out[$official]=$args[$key]; } return $out; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */ private function body(array $args): array { $body=$args['body']??[]; if(static::BODY_REQUIRED&&(!is_array($body)||$body===[])) throw new InvalidArgumentException('body must be a non-empty object matching the OpenFGA API request schema.'); if($body!==[]&&!is_array($body)) throw new InvalidArgumentException('body must be an object.'); return $body; }
}
