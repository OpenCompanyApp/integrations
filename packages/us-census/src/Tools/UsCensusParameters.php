<?php

namespace OpenCompany\Integrations\UsCensus\Tools;

/**
 * Parameter schemas shared by US Census tool classes.
 *
 * Documents common dataset path, metadata filtering, and query predicates in a
 * reusable form for agents.
 */
class UsCensusParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function dataset(): array
    {
        return [
            'dataset' => ['type' => 'string', 'required' => true, 'description' => 'Dataset path without /data, such as 2023/acs/acs5 or 2020/dec/pl.'],
            'year' => ['type' => 'string', 'required' => false, 'description' => 'Alternative to dataset: vintage year. Use with name.'],
            'name' => ['type' => 'string', 'required' => false, 'description' => 'Alternative to dataset: dataset path after year, such as acs/acs5.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function discovery(): array
    {
        return [
            'q' => ['type' => 'string', 'required' => false, 'description' => 'Search text applied to dataset metadata.'],
            'vintage' => ['type' => 'string', 'required' => false, 'description' => 'Vintage year filter.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum datasets to return. Defaults to 50.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function variables(): array
    {
        return self::dataset() + [
            'group' => ['type' => 'string', 'required' => false, 'description' => 'Optional group code, such as B01001.'],
            'q' => ['type' => 'string', 'required' => false, 'description' => 'Search text applied to variable names and metadata.'],
            'predicate_only' => ['type' => 'boolean', 'required' => false, 'description' => 'Only return variables marked predicateOnly.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum variables to return. Defaults to 100.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function metadataList(): array
    {
        return self::dataset() + [
            'q' => ['type' => 'string', 'required' => false, 'description' => 'Search text applied to metadata rows.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum rows to return. Defaults to 100.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function dataQuery(bool $url = false): array
    {
        return self::dataset() + [
            'get' => ['type' => 'string', 'required' => !$url, 'description' => 'Comma-separated variables or group call, such as NAME,B01001_001E or group(B01001).'],
            'for' => ['type' => 'string', 'required' => false, 'description' => 'Census geography predicate, such as state:* or county:*'],
            'in' => ['type' => 'string', 'required' => false, 'description' => 'Parent geography predicate, such as state:06.'],
            'ucgid' => ['type' => 'string', 'required' => false, 'description' => 'Uniform Census Geography Identifier predicate. Alternative to for/in.'],
            'predicates' => ['type' => 'object', 'required' => false, 'description' => 'Additional dataset-specific predicates.'],
            'include_key' => ['type' => 'boolean', 'required' => false, 'description' => 'For URL builder only: include configured API key in the generated URL.'],
        ];
    }
}
