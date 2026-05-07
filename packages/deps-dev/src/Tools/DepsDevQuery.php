<?php

namespace OpenCompany\Integrations\DepsDev\Tools;

/**
 * Query package versions by content hash, version key, or both.
 */
class DepsDevQuery extends AbstractDepsDevTool
{
    protected const NAME = 'deps_dev_query';
    protected const DESCRIPTION = 'Query deps.dev package versions by content hash, version key, or both. At most 1000 results are returned.';
    protected const METHOD = 'query';
    protected const PARAMETERS = [
        'hash_type' => ['type' => 'string', 'required' => false, 'description' => 'Hash function.', 'enum' => ['MD5', 'SHA1', 'SHA256', 'SHA512']],
        'hash_value' => ['type' => 'string', 'required' => false, 'description' => 'Base64-encoded hash value.'],
        'system' => ['type' => 'string', 'required' => false, 'description' => 'Package system for versionKey query.', 'enum' => ['GO', 'RUBYGEMS', 'NPM', 'CARGO', 'MAVEN', 'PYPI', 'NUGET']],
        'name' => ['type' => 'string', 'required' => false, 'description' => 'Package name for versionKey query.'],
        'version' => ['type' => 'string', 'required' => false, 'description' => 'Package version for versionKey query.'],
    ];
}
