<?php

namespace OpenCompany\Integrations\GitBook\Tools;

/**
 * Parameter schemas shared by GitBook tool classes.
 *
 * Keeps tool files small while documenting common identifiers, pagination, and
 * content-format options from the GitBook API.
 */
class GitBookParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function pagination(): array
    {
        return [
            'page' => ['type' => 'string', 'required' => false, 'description' => 'Pagination cursor or page identifier.'],
            'limit' => ['type' => 'integer', 'required' => false, 'description' => 'Maximum results to return. GitBook supports endpoint-specific limits.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function organization(): array
    {
        return ['organization_id' => ['type' => 'string', 'required' => true, 'description' => 'GitBook organization ID.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function space(): array
    {
        return ['space_id' => ['type' => 'string', 'required' => true, 'description' => 'GitBook space ID.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function search(bool $organization = false): array
    {
        return ($organization ? self::organization() : self::space()) + [
            'query' => ['type' => 'string', 'required' => true, 'description' => 'Search query. Maximum 512 characters on space search.'],
        ] + self::pagination();
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function content(): array
    {
        return self::space() + [
            'metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.'],
            'computed' => ['type' => 'boolean', 'required' => false, 'description' => 'Include computed content.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function page(): array
    {
        return self::space() + [
            'page_id' => ['type' => 'string', 'required' => true, 'description' => 'GitBook page ID.'],
            'format' => ['type' => 'string', 'required' => false, 'description' => 'Output format for page content.', 'enum' => ['document', 'markdown']],
            'metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function pagePath(): array
    {
        return self::space() + [
            'page_path' => ['type' => 'string', 'required' => true, 'description' => 'Path of the page in the revision, without a leading slash.'],
            'format' => ['type' => 'string', 'required' => false, 'description' => 'Output format for page content.', 'enum' => ['document', 'markdown']],
            'metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function file(): array
    {
        return self::space() + [
            'file_id' => ['type' => 'string', 'required' => true, 'description' => 'GitBook file ID.'],
            'metadata' => ['type' => 'boolean', 'required' => false, 'description' => 'Include mutable git metadata.'],
        ];
    }
}
