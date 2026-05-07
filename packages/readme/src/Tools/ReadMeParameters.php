<?php

namespace OpenCompany\Integrations\ReadMe\Tools;

/**
 * Parameter schemas shared by ReadMe tool classes.
 *
 * Documents common branch, section, slug, pagination, and search arguments
 * agents need for ReadMe API calls.
 */
class ReadMeParameters
{
    /**
     * @return array<string, array<string, mixed>>
     */
    public static function pagination(): array
    {
        return [
            'page' => ['type' => 'integer', 'required' => false, 'description' => 'Page number.'],
            'per_page' => ['type' => 'integer', 'required' => false, 'description' => 'Results per page. ReadMe commonly supports 1 to 100.'],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function branch(): array
    {
        return ['branch' => ['type' => 'string', 'required' => true, 'description' => 'ReadMe branch, previously version. Use stable for the default branch.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function section(): array
    {
        return self::branch() + [
            'section' => ['type' => 'string', 'required' => true, 'description' => 'ReadMe sidebar section.', 'enum' => ['guides', 'reference', 'recipes', 'custom_pages']],
        ];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function category(): array
    {
        return self::section() + ['title' => ['type' => 'string', 'required' => true, 'description' => 'Category title or URI-safe category identifier.']];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function slug(string $label): array
    {
        return self::branch() + ['slug' => ['type' => 'string', 'required' => true, 'description' => $label]];
    }

    /**
     * @return array<string, array<string, mixed>>
     */
    public static function search(): array
    {
        return [
            'search' => ['type' => 'string', 'required' => true, 'description' => 'Search text.'],
            'version' => ['type' => 'string', 'required' => false, 'description' => 'Legacy x-readme-version header value.'],
        ];
    }
}
