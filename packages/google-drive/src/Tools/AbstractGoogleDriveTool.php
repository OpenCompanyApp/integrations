<?php

namespace OpenCompany\Integrations\GoogleDrive\Tools;

use InvalidArgumentException;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Support\ToolResult;
use OpenCompany\Integrations\GoogleDrive\GoogleDriveService;

/**
 * Shared executor for Google Drive endpoint-specific tools.
 *
 * Each child class maps to one Discovery method while this base class handles
 * configured-state checks, path/query/body shaping, media uploads, and errors.
 */
abstract class AbstractGoogleDriveTool implements Tool
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
    protected const MEDIA_UPLOAD = false;
    protected const MEDIA_UPLOAD_PATH = '';

    /**
     * @param  GoogleDriveService  $service  Google Drive API client.
     */
    public function __construct(protected GoogleDriveService $service) {}

    public function name(): string { return static::NAME; }
    public function description(): string { return static::DESCRIPTION; }
    public function parameters(): array { return static::PARAMETERS; }

    /**
     * Execute the mapped Google Drive REST method.
     *
     * @param  array<string, mixed>  $args  Tool arguments for the mapped endpoint.
     */
    public function execute(array $args): ToolResult
    {
        try {
            if (!$this->service->isConfigured()) return ToolResult::error('Google Drive integration is not configured.');
            if (static::MEDIA_UPLOAD) return ToolResult::success($this->service->upload(static::MEDIA_UPLOAD_PATH, $this->pathParams($args), static::RESERVED_PATH_PARAMS, $this->query($args), $this->body($args), $this->requireScalar($args, 'file_path'), (string) ($args['mime_type'] ?? 'application/octet-stream')));
            return ToolResult::success($this->service->request(static::METHOD, static::PATH, $this->pathParams($args), static::RESERVED_PATH_PARAMS, $this->query($args), $this->body($args)));
        } catch (\Throwable $e) { return ToolResult::error($e->getMessage()); }
    }

    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    private function pathParams(array $args): array { $params=[]; foreach(static::PATH_PARAMS as $key)$params[$key]=$this->requireScalar($args,$key); return $params; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    private function query(array $args): array { if(isset($args['query'])&&is_array($args['query'])) return $args['query']; $query=[]; foreach(static::QUERY_KEYS as $key) if(array_key_exists($key,$args)&&$args[$key]!==null&&$args[$key]!=='') $query[$key]=$args[$key]; return $query; }
    /** @param  array<string, mixed>  $args  Tool arguments. @return array<string, mixed> */
    private function body(array $args): array { $body=$args['body']??[]; if(static::BODY_REQUIRED&&(!is_array($body)||$body===[])) throw new InvalidArgumentException('body must be a non-empty object matching the Google Drive API request schema.'); if($body!==[]&&!is_array($body)) throw new InvalidArgumentException('body must be an object.'); return $body; }
    /** @param  array<string, mixed>  $args  Tool arguments. */
    private function requireScalar(array $args,string $key): string { $value=$args[$key]??null; if(is_int($value)||is_float($value)||is_bool($value))return(string)$value; if(!is_string($value)||trim($value)==='') throw new InvalidArgumentException($key.' must be a non-empty string.'); return $value; }
}