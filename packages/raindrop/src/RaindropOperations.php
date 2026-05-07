<?php

namespace OpenCompany\Integrations\Raindrop;

/**
 * Official Raindrop.io REST API operation metadata.
 *
 * Generated from Raindrop.io's GitBook markdown API reference pages.
 */
class RaindropOperations
{
    /**
     * Return Raindrop.io operations keyed by tool slug.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                "slug" => "raindrop_backups_download_file",
                "operation" => "backups_download_file",
                "class" => "RaindropBackupsDownloadFile",
                "method" => "GET",
                "path" => "/backup/{ID}.{format}",
                "type" => "read",
                "name" => "Download file",
                "description" => "Download file.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "ID",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ],
                    [
                        "source" => "path",
                        "name" => "format",
                        "param" => "format",
                        "required" => true,
                        "description" => "Format path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/backups.md"
            ],
            [
                "slug" => "raindrop_backups_generate_new",
                "operation" => "backups_generate_new",
                "class" => "RaindropBackupsGenerateNew",
                "method" => "GET",
                "path" => "/backup",
                "type" => "read",
                "name" => "Generate new",
                "description" => "Generate new.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/backups.md"
            ],
            [
                "slug" => "raindrop_backups_get_all",
                "operation" => "backups_get_all",
                "class" => "RaindropBackupsGetAll",
                "method" => "GET",
                "path" => "/backups",
                "type" => "read",
                "name" => "Get all",
                "description" => "Get all.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/backups.md"
            ],
            [
                "slug" => "raindrop_collections_create_collection",
                "operation" => "collections_create_collection",
                "class" => "RaindropCollectionsCreateCollection",
                "method" => "POST",
                "path" => "/collection",
                "type" => "write",
                "name" => "Create collection",
                "description" => "Create collection.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_empty_trash",
                "operation" => "collections_empty_trash",
                "class" => "RaindropCollectionsEmptyTrash",
                "method" => "DELETE",
                "path" => "/collection/-99",
                "type" => "write",
                "name" => "Empty Trash",
                "description" => "Empty Trash.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_expand_collapse_all",
                "operation" => "collections_expand_collapse_all",
                "class" => "RaindropCollectionsExpandCollapseAll",
                "method" => "PUT",
                "path" => "/collections",
                "type" => "write",
                "name" => "Expand/collapse all collections",
                "description" => "Expand/collapse all collections.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_get_child_collections",
                "operation" => "collections_get_child_collections",
                "class" => "RaindropCollectionsGetChildCollections",
                "method" => "GET",
                "path" => "/collections/childrens",
                "type" => "read",
                "name" => "Get child collections",
                "description" => "Get child collections.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_get_collection",
                "operation" => "collections_get_collection",
                "class" => "RaindropCollectionsGetCollection",
                "method" => "GET",
                "path" => "/collection/{id}",
                "type" => "read",
                "name" => "Get collection",
                "description" => "Get collection.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_get_root_collections",
                "operation" => "collections_get_root_collections",
                "class" => "RaindropCollectionsGetRootCollections",
                "method" => "GET",
                "path" => "/collections",
                "type" => "read",
                "name" => "Get root collections",
                "description" => "Get root collections.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_get_system_collections_count",
                "operation" => "collections_get_system_collections_count",
                "class" => "RaindropCollectionsGetSystemCollectionsCount",
                "method" => "GET",
                "path" => "/user/stats",
                "type" => "read",
                "name" => "Get system collections count",
                "description" => "Get system collections count.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_merge_collections",
                "operation" => "collections_merge_collections",
                "class" => "RaindropCollectionsMergeCollections",
                "method" => "PUT",
                "path" => "/collections/merge",
                "type" => "write",
                "name" => "Merge collections",
                "description" => "Merge collections.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_remove_all_empty_collections",
                "operation" => "collections_remove_all_empty_collections",
                "class" => "RaindropCollectionsRemoveAllEmptyCollections",
                "method" => "PUT",
                "path" => "/collections/clean",
                "type" => "write",
                "name" => "Remove all empty collections",
                "description" => "Remove all empty collections.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_remove_collection",
                "operation" => "collections_remove_collection",
                "class" => "RaindropCollectionsRemoveCollection",
                "method" => "DELETE",
                "path" => "/collection/{id}",
                "type" => "write",
                "name" => "Remove collection",
                "description" => "Remove collection.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_remove_multiple_collections",
                "operation" => "collections_remove_multiple_collections",
                "class" => "RaindropCollectionsRemoveMultipleCollections",
                "method" => "DELETE",
                "path" => "/collections",
                "type" => "write",
                "name" => "Remove multiple collections",
                "description" => "Remove multiple collections.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_reorder_all",
                "operation" => "collections_reorder_all",
                "class" => "RaindropCollectionsReorderAll",
                "method" => "PUT",
                "path" => "/collections",
                "type" => "write",
                "name" => "Reorder all collections",
                "description" => "Reorder all collections.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_update_collection",
                "operation" => "collections_update_collection",
                "class" => "RaindropCollectionsUpdateCollection",
                "method" => "PUT",
                "path" => "/collection/{id}",
                "type" => "write",
                "name" => "Update collection",
                "description" => "Update collection.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_collections_upload_cover",
                "operation" => "collections_upload_cover",
                "class" => "RaindropCollectionsUploadCover",
                "method" => "PUT",
                "path" => "/collection/{id}/cover",
                "type" => "write",
                "name" => "Upload cover",
                "description" => "Upload cover.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "multipart/form-data",
                "docs_source" => "https://developer.raindrop.io/v1/collections/methods.md"
            ],
            [
                "slug" => "raindrop_export_export_in_format",
                "operation" => "export_export_in_format",
                "class" => "RaindropExportExportInFormat",
                "method" => "GET",
                "path" => "/raindrops/{collectionId}/export.{format}",
                "type" => "read",
                "name" => "Export in format",
                "description" => "Export in format.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ],
                    [
                        "source" => "path",
                        "name" => "format",
                        "param" => "format",
                        "required" => true,
                        "description" => "Format path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/export.md"
            ],
            [
                "slug" => "raindrop_filters_get_filters",
                "operation" => "filters_get_filters",
                "class" => "RaindropFiltersGetFilters",
                "method" => "GET",
                "path" => "/filters/{collectionId}",
                "type" => "read",
                "name" => "Get filters",
                "description" => "Get filters.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/filters.md"
            ],
            [
                "slug" => "raindrop_highlights_add",
                "operation" => "highlights_add",
                "class" => "RaindropHighlightsAdd",
                "method" => "PUT",
                "path" => "/raindrop/{id}",
                "type" => "write",
                "name" => "Add highlight",
                "description" => "Add highlight.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_highlights_get_all_highlights",
                "operation" => "highlights_get_all_highlights",
                "class" => "RaindropHighlightsGetAllHighlights",
                "method" => "GET",
                "path" => "/highlights",
                "type" => "read",
                "name" => "Get all highlights",
                "description" => "Get all highlights.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_highlights_get_all_highlights_in_a_collection",
                "operation" => "highlights_get_all_highlights_in_a_collection",
                "class" => "RaindropHighlightsGetAllHighlightsInACollection",
                "method" => "GET",
                "path" => "/highlights/{collectionId}",
                "type" => "read",
                "name" => "Get all highlights in a collection",
                "description" => "Get all highlights in a collection.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_highlights_get_raindrop_highlights",
                "operation" => "highlights_get_raindrop_highlights",
                "class" => "RaindropHighlightsGetRaindropHighlights",
                "method" => "GET",
                "path" => "/raindrop/{id}",
                "type" => "read",
                "name" => "Get highlights of raindrop",
                "description" => "Get highlights of raindrop.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_highlights_remove",
                "operation" => "highlights_remove",
                "class" => "RaindropHighlightsRemove",
                "method" => "PUT",
                "path" => "/raindrop/{id}",
                "type" => "write",
                "name" => "Remove highlight",
                "description" => "Remove highlight.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_highlights_update",
                "operation" => "highlights_update",
                "class" => "RaindropHighlightsUpdate",
                "method" => "PUT",
                "path" => "/raindrop/{id}",
                "type" => "write",
                "name" => "Update highlight",
                "description" => "Update highlight.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/highlights.md"
            ],
            [
                "slug" => "raindrop_import_check_url_s_existence",
                "operation" => "import_check_url_s_existence",
                "class" => "RaindropImportCheckUrlSExistence",
                "method" => "POST",
                "path" => "/import/url/exists",
                "type" => "write",
                "name" => "Check URL(s) existence",
                "description" => "Check URL(s) existence.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/import.md"
            ],
            [
                "slug" => "raindrop_import_parse_html_import_file",
                "operation" => "import_parse_html_import_file",
                "class" => "RaindropImportParseHtmlImportFile",
                "method" => "POST",
                "path" => "/import/file",
                "type" => "write",
                "name" => "Parse HTML import file",
                "description" => "Parse HTML import file.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "multipart/form-data",
                "docs_source" => "https://developer.raindrop.io/v1/import.md"
            ],
            [
                "slug" => "raindrop_import_parse_url",
                "operation" => "import_parse_url",
                "class" => "RaindropImportParseUrl",
                "method" => "GET",
                "path" => "/import/url/parse",
                "type" => "read",
                "name" => "Parse URL",
                "description" => "Parse URL.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/import.md"
            ],
            [
                "slug" => "raindrop_raindrops_multiple_create_many_raindrops",
                "operation" => "raindrops_multiple_create_many_raindrops",
                "class" => "RaindropRaindropsMultipleCreateManyRaindrops",
                "method" => "POST",
                "path" => "/raindrops",
                "type" => "write",
                "name" => "Create many raindrops",
                "description" => "Create many raindrops.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/multiple.md"
            ],
            [
                "slug" => "raindrop_raindrops_multiple_get_raindrops",
                "operation" => "raindrops_multiple_get_raindrops",
                "class" => "RaindropRaindropsMultipleGetRaindrops",
                "method" => "GET",
                "path" => "/raindrops/{collectionId}",
                "type" => "read",
                "name" => "Get raindrops",
                "description" => "Get raindrops.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/multiple.md"
            ],
            [
                "slug" => "raindrop_raindrops_multiple_remove_many_raindrops",
                "operation" => "raindrops_multiple_remove_many_raindrops",
                "class" => "RaindropRaindropsMultipleRemoveManyRaindrops",
                "method" => "DELETE",
                "path" => "/raindrops/{collectionId}",
                "type" => "write",
                "name" => "Remove many raindrops",
                "description" => "Remove many raindrops.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/multiple.md"
            ],
            [
                "slug" => "raindrop_raindrops_multiple_update_many_raindrops",
                "operation" => "raindrops_multiple_update_many_raindrops",
                "class" => "RaindropRaindropsMultipleUpdateManyRaindrops",
                "method" => "PUT",
                "path" => "/raindrops/{collectionId}",
                "type" => "write",
                "name" => "Update many raindrops",
                "description" => "Update many raindrops.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => true,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/multiple.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_create_raindrop",
                "operation" => "raindrops_single_create_raindrop",
                "class" => "RaindropRaindropsSingleCreateRaindrop",
                "method" => "POST",
                "path" => "/raindrop",
                "type" => "write",
                "name" => "Create raindrop",
                "description" => "Create raindrop.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_get_permanent_copy",
                "operation" => "raindrops_single_get_permanent_copy",
                "class" => "RaindropRaindropsSingleGetPermanentCopy",
                "method" => "GET",
                "path" => "/raindrop/{id}/cache",
                "type" => "read",
                "name" => "Get permanent copy",
                "description" => "Get permanent copy.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_get_raindrop",
                "operation" => "raindrops_single_get_raindrop",
                "class" => "RaindropRaindropsSingleGetRaindrop",
                "method" => "GET",
                "path" => "/raindrop/{id}",
                "type" => "read",
                "name" => "Get raindrop",
                "description" => "Get raindrop.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_remove_raindrop",
                "operation" => "raindrops_single_remove_raindrop",
                "class" => "RaindropRaindropsSingleRemoveRaindrop",
                "method" => "DELETE",
                "path" => "/raindrop/{id}",
                "type" => "write",
                "name" => "Remove raindrop",
                "description" => "Remove raindrop.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_suggest_collection_and_tags_for_existing_bookmark",
                "operation" => "raindrops_single_suggest_collection_and_tags_for_existing_bookmark",
                "class" => "RaindropRaindropsSingleSuggestCollectionAndTagsForExistingBookmark",
                "method" => "GET",
                "path" => "/raindrop/{id}/suggest",
                "type" => "read",
                "name" => "Suggest collection and tags for existing bookmark",
                "description" => "Suggest collection and tags for existing bookmark.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_suggest_collection_and_tags_for_new_bookmark",
                "operation" => "raindrops_single_suggest_collection_and_tags_for_new_bookmark",
                "class" => "RaindropRaindropsSingleSuggestCollectionAndTagsForNewBookmark",
                "method" => "POST",
                "path" => "/raindrop/suggest",
                "type" => "write",
                "name" => "Suggest collection and tags for new bookmark",
                "description" => "Suggest collection and tags for new bookmark.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_update_raindrop",
                "operation" => "raindrops_single_update_raindrop",
                "class" => "RaindropRaindropsSingleUpdateRaindrop",
                "method" => "PUT",
                "path" => "/raindrop/{id}",
                "type" => "write",
                "name" => "Update raindrop",
                "description" => "Update raindrop.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_upload_cover",
                "operation" => "raindrops_single_upload_cover",
                "class" => "RaindropRaindropsSingleUploadCover",
                "method" => "PUT",
                "path" => "/raindrop/{id}/cover",
                "type" => "write",
                "name" => "Upload cover",
                "description" => "Upload cover.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "id",
                        "param" => "id",
                        "required" => true,
                        "description" => "ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "multipart/form-data",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_raindrops_single_upload_file",
                "operation" => "raindrops_single_upload_file",
                "class" => "RaindropRaindropsSingleUploadFile",
                "method" => "PUT",
                "path" => "/raindrop/file",
                "type" => "write",
                "name" => "Upload file",
                "description" => "Upload file.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "multipart/form-data",
                "docs_source" => "https://developer.raindrop.io/v1/raindrops/single.md"
            ],
            [
                "slug" => "raindrop_tags_get_tags",
                "operation" => "tags_get_tags",
                "class" => "RaindropTagsGetTags",
                "method" => "GET",
                "path" => "/tags/{collectionId}",
                "type" => "read",
                "name" => "Get tags",
                "description" => "Get tags.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => false,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/tags.md"
            ],
            [
                "slug" => "raindrop_tags_merge",
                "operation" => "tags_merge",
                "class" => "RaindropTagsMerge",
                "method" => "PUT",
                "path" => "/tags/{collectionId}",
                "type" => "write",
                "name" => "Merge tags",
                "description" => "Merge tags.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => false,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/tags.md"
            ],
            [
                "slug" => "raindrop_tags_remove",
                "operation" => "tags_remove",
                "class" => "RaindropTagsRemove",
                "method" => "DELETE",
                "path" => "/tags/{collectionId}",
                "type" => "write",
                "name" => "Remove tag(s)",
                "description" => "Remove tag(s).",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => false,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/tags.md"
            ],
            [
                "slug" => "raindrop_tags_rename",
                "operation" => "tags_rename",
                "class" => "RaindropTagsRename",
                "method" => "PUT",
                "path" => "/tags/{collectionId}",
                "type" => "write",
                "name" => "Rename tag",
                "description" => "Rename tag.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "collectionId",
                        "param" => "collection_id",
                        "required" => false,
                        "description" => "Collection ID path parameter."
                    ]
                ],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/tags.md"
            ],
            [
                "slug" => "raindrop_user_authenticated_connect_social_network_account",
                "operation" => "user_authenticated_connect_social_network_account",
                "class" => "RaindropUserAuthenticatedConnectSocialNetworkAccount",
                "method" => "GET",
                "path" => "/user/connect/{provider}",
                "type" => "read",
                "name" => "Connect social network account",
                "description" => "Connect social network account.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "provider",
                        "param" => "provider",
                        "required" => true,
                        "description" => "Provider path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/user/authenticated.md"
            ],
            [
                "slug" => "raindrop_user_authenticated_disconnect_social_network_account",
                "operation" => "user_authenticated_disconnect_social_network_account",
                "class" => "RaindropUserAuthenticatedDisconnectSocialNetworkAccount",
                "method" => "GET",
                "path" => "/user/connect/{provider}/revoke",
                "type" => "read",
                "name" => "Disconnect social network account",
                "description" => "Disconnect social network account.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "provider",
                        "param" => "provider",
                        "required" => true,
                        "description" => "Provider path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/user/authenticated.md"
            ],
            [
                "slug" => "raindrop_user_authenticated_get_user",
                "operation" => "user_authenticated_get_user",
                "class" => "RaindropUserAuthenticatedGetUser",
                "method" => "GET",
                "path" => "/user",
                "type" => "read",
                "name" => "Get user",
                "description" => "Get user.",
                "parameters" => [],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/user/authenticated.md"
            ],
            [
                "slug" => "raindrop_user_authenticated_get_user_by_name",
                "operation" => "user_authenticated_get_user_by_name",
                "class" => "RaindropUserAuthenticatedGetUserByName",
                "method" => "GET",
                "path" => "/user/{name}",
                "type" => "read",
                "name" => "Get user by name",
                "description" => "Get user by name.",
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "name",
                        "param" => "name",
                        "required" => true,
                        "description" => "Name path parameter."
                    ]
                ],
                "request_body" => false,
                "content_type" => null,
                "docs_source" => "https://developer.raindrop.io/v1/user/authenticated.md"
            ],
            [
                "slug" => "raindrop_user_authenticated_update_user",
                "operation" => "user_authenticated_update_user",
                "class" => "RaindropUserAuthenticatedUpdateUser",
                "method" => "PUT",
                "path" => "/user",
                "type" => "write",
                "name" => "Update user",
                "description" => "Update user.",
                "parameters" => [],
                "request_body" => true,
                "content_type" => "application/json",
                "docs_source" => "https://developer.raindrop.io/v1/user/authenticated.md"
            ]
        ];
    }
}
