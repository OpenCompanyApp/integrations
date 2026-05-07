<?php

namespace OpenCompany\Integrations\EndOfLifeDate;

use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateCategories;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateCategoryProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIdentifierTypes;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIdentifiers;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateIndex;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateLatestRelease;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProduct;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProductRelease;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateProductsFull;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateTagProducts;
use OpenCompany\Integrations\EndOfLifeDate\Tools\EndOfLifeDateTags;

/**
 * Tool catalog and metadata for endoflife.date.
 *
 * Exposes the documented API v1 endpoints for product lifecycle discovery,
 * release lookups, category/tag browsing, and identifier mapping.
 */
class EndOfLifeDateToolProvider implements ToolProvider, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => [
                'strategy' => 'none',
                'legacy_auth_type' => 'none',
                'credential_mode' => 'none',
                'setup_flows' => ['none'],
                'requires_browser_for_setup' => false,
                'refreshable' => false,
                'token_keys' => [],
                'notes' => ['endoflife.date API v1 is public and requires no API key.'],
            ],
            'host_availability' => [
                'web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none'],
                'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'none', 'runtime_mode' => 'normal'],
            ],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'endoflife-date';
    }

    /**
     * Metadata shown in app and catalog discovery UIs.
     *
     * @return array<string, mixed>
     */
    public function appMeta(): array
    {
        return [
            'label' => 'endoflife.date',
            'description' => 'Software and hardware lifecycle, support, and end-of-life data',
            'icon' => 'ph:calendar-warning',
            'logo' => 'ph:calendar-warning',
        ];
    }

    /**
     * Canonical integration metadata used by settings and generated catalogs.
     *
     * @return array<string, mixed>
     */
    public function integrationMeta(): array
    {
        return [
            'name' => 'endoflife.date',
            'description' => 'endoflife.date API v1 for product lifecycle discovery, release support status, latest release checks, categories, tags, and identifiers such as purl or cpe.',
            'icon' => 'ph:calendar-warning',
            'logo' => 'ph:calendar-warning',
            'category' => 'data',
            'badge' => 'verified',
            'docs_url' => 'https://endoflife.date/docs/api/v1/',
        ];
    }

    public function credentialFields(): array
    {
        return [];
    }

    public function tools(): array
    {
        return [
            'endoflife_date_index' => ['class' => EndOfLifeDateIndex::class, 'type' => 'read', 'name' => 'API Index', 'description' => 'List main endoflife.date API v1 endpoints.', 'icon' => 'ph:list'],
            'endoflife_date_products' => ['class' => EndOfLifeDateProducts::class, 'type' => 'read', 'name' => 'Products', 'description' => 'List product summaries.', 'icon' => 'ph:package'],
            'endoflife_date_products_full' => ['class' => EndOfLifeDateProductsFull::class, 'type' => 'read', 'name' => 'Products Full', 'description' => 'List products with full lifecycle data.', 'icon' => 'ph:archive'],
            'endoflife_date_product' => ['class' => EndOfLifeDateProduct::class, 'type' => 'read', 'name' => 'Product', 'description' => 'Get one product with release lifecycle data.', 'icon' => 'ph:cube'],
            'endoflife_date_product_release' => ['class' => EndOfLifeDateProductRelease::class, 'type' => 'read', 'name' => 'Product Release', 'description' => 'Get one product release cycle.', 'icon' => 'ph:tag'],
            'endoflife_date_latest_release' => ['class' => EndOfLifeDateLatestRelease::class, 'type' => 'read', 'name' => 'Latest Release', 'description' => 'Get the latest release cycle for a product.', 'icon' => 'ph:star'],
            'endoflife_date_categories' => ['class' => EndOfLifeDateCategories::class, 'type' => 'read', 'name' => 'Categories', 'description' => 'List lifecycle product categories.', 'icon' => 'ph:folders'],
            'endoflife_date_category_products' => ['class' => EndOfLifeDateCategoryProducts::class, 'type' => 'read', 'name' => 'Category Products', 'description' => 'List product summaries in a category.', 'icon' => 'ph:folder-open'],
            'endoflife_date_tags' => ['class' => EndOfLifeDateTags::class, 'type' => 'read', 'name' => 'Tags', 'description' => 'List lifecycle product tags.', 'icon' => 'ph:tag-chevron'],
            'endoflife_date_tag_products' => ['class' => EndOfLifeDateTagProducts::class, 'type' => 'read', 'name' => 'Tag Products', 'description' => 'List product summaries with a tag.', 'icon' => 'ph:tag-simple'],
            'endoflife_date_identifier_types' => ['class' => EndOfLifeDateIdentifierTypes::class, 'type' => 'read', 'name' => 'Identifier Types', 'description' => 'List known identifier types.', 'icon' => 'ph:fingerprint'],
            'endoflife_date_identifiers' => ['class' => EndOfLifeDateIdentifiers::class, 'type' => 'read', 'name' => 'Identifiers', 'description' => 'List identifiers for a type and their products.', 'icon' => 'ph:barcode'],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /**
     * Create an endoflife.date tool from the catalog class name.
     *
     * @param  array<string, mixed>  $context  Optional tool context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class(app(EndOfLifeDateService::class));
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/endoflife-date.md';
    }
}
