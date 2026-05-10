<?php

namespace OpenCompany\IntegrationCatalog;

final class CatalogLocator
{
    public static function path(): string
    {
        return dirname(__DIR__).'/resources/integrations-catalog.json';
    }

    public static function available(): bool
    {
        return is_file(self::path());
    }

    /**
     * @return array<string, mixed>
     */
    public static function load(): array
    {
        if (! self::available()) {
            return self::emptyCatalog();
        }

        $decoded = json_decode((string) file_get_contents(self::path()), true);

        return is_array($decoded) ? $decoded : self::emptyCatalog();
    }

    /**
     * @return array<string, mixed>
     */
    public static function emptyCatalog(): array
    {
        return [
            'generated_at' => null,
            'total_integrations' => 0,
            'total_tools' => 0,
            'integrations' => [],
        ];
    }
}
