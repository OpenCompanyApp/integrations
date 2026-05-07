<?php

namespace OpenCompany\Integrations\Canva;

/**
 * Official Canva Connect API operation metadata.
 *
 * Generated from https://www.canva.dev/sources/connect/api/latest/api.yml.
 */
class CanvaOperations
{
    /**
     * Return Canva Connect operations keyed by tool slug.
     *
     * @return list<array<string, mixed>>
     */
    public static function all(): array
    {
        return [
            [
                "slug" => "canva_get_app_jwks",
                "operation" => "getAppJwks",
                "class" => "CanvaGetAppJWKS",
                "method" => "GET",
                "path" => "/v1/apps/{appId}/jwks",
                "type" => "read",
                "name" => "Get App JWKS",
                "description" => "Returns the Json Web Key Set (public keys) of an app.",
                "auth" => "none",
                "scopes" => [],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "appId",
                        "param" => "app_id",
                        "required" => true,
                        "description" => "The app ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_delete_asset",
                "operation" => "deleteAsset",
                "class" => "CanvaDeleteAsset",
                "method" => "DELETE",
                "path" => "/v1/assets/{assetId}",
                "type" => "write",
                "name" => "Delete Asset",
                "description" => "You can delete an asset by specifying its assetId.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "assetId",
                        "param" => "asset_id",
                        "required" => true,
                        "description" => "The ID of the asset."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_asset",
                "operation" => "getAsset",
                "class" => "CanvaGetAsset",
                "method" => "GET",
                "path" => "/v1/assets/{assetId}",
                "type" => "read",
                "name" => "Get Asset",
                "description" => "You can retrieve the metadata of an asset by specifying its assetId.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "assetId",
                        "param" => "asset_id",
                        "required" => true,
                        "description" => "The ID of the asset."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_update_asset",
                "operation" => "updateAsset",
                "class" => "CanvaUpdateAsset",
                "method" => "PATCH",
                "path" => "/v1/assets/{assetId}",
                "type" => "write",
                "name" => "Update Asset",
                "description" => "You can update the name and tags of an asset by specifying its assetId.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "assetId",
                        "param" => "asset_id",
                        "required" => true,
                        "description" => "The ID of the asset."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_create_asset_upload_job",
                "operation" => "CreateAssetUploadJob",
                "class" => "CanvaCreateAssetUploadJob",
                "method" => "POST",
                "path" => "/v1/asset-uploads",
                "type" => "write",
                "name" => "Create Asset Upload Job",
                "description" => "Starts a new to upload an asset to the user's content library.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:write"
                ],
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "Asset-Upload-Metadata",
                        "param" => "asset_upload_metadata",
                        "required" => true,
                        "description" => null
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/octet-stream"
            ],
            [
                "slug" => "canva_get_asset_upload_job",
                "operation" => "GetAssetUploadJob",
                "class" => "CanvaGetAssetUploadJob",
                "method" => "GET",
                "path" => "/v1/asset-uploads/{jobId}",
                "type" => "read",
                "name" => "Get Asset Upload Job",
                "description" => "Get the result of an asset upload job that was created using the .",
                "auth" => "bearer",
                "scopes" => [
                    "asset:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The asset upload job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_url_asset_upload_job",
                "operation" => "createUrlAssetUploadJob",
                "class" => "CanvaCreateURLAssetUploadJob",
                "method" => "POST",
                "path" => "/v1/url-asset-uploads",
                "type" => "write",
                "name" => "Create URL Asset Upload Job",
                "description" => "Execute the Canva create url asset upload job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_url_asset_upload_job",
                "operation" => "getUrlAssetUploadJob",
                "class" => "CanvaGetURLAssetUploadJob",
                "method" => "GET",
                "path" => "/v1/url-asset-uploads/{jobId}",
                "type" => "read",
                "name" => "Get URL Asset Upload Job",
                "description" => "Execute the Canva get url asset upload job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "asset:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The asset upload job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_design_autofill_job",
                "operation" => "createDesignAutofillJob",
                "class" => "CanvaCreateDesignAutofillJob",
                "method" => "POST",
                "path" => "/v1/autofills",
                "type" => "write",
                "name" => "Create Design Autofill Job",
                "description" => "Execute the Canva create design autofill job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_design_autofill_job",
                "operation" => "getDesignAutofillJob",
                "class" => "CanvaGetDesignAutofillJob",
                "method" => "GET",
                "path" => "/v1/autofills/{jobId}",
                "type" => "read",
                "name" => "Get Design Autofill Job",
                "description" => "Execute the Canva get design autofill job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "design:meta:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The design autofill job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_list_brand_templates",
                "operation" => "listBrandTemplates",
                "class" => "CanvaListBrandTemplates",
                "method" => "GET",
                "path" => "/v1/brand-templates",
                "type" => "read",
                "name" => "List Brand Templates",
                "description" => "Execute the Canva list brand templates operation.",
                "auth" => "bearer",
                "scopes" => [
                    "brandtemplate:meta:read"
                ],
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "query",
                        "param" => "query",
                        "required" => false,
                        "description" => "Lets you search the brand templates available to the user using a search term or terms."
                    ],
                    [
                        "source" => "query",
                        "name" => "continuation",
                        "param" => "continuation",
                        "required" => false,
                        "description" => "If the success response contains a continuation token, the user has access to more brand templates you can list."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of brand templates to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "ownership",
                        "param" => "ownership",
                        "required" => false,
                        "description" => "Filter the list of brand templates based on the user's ownership of the brand templates."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "Sort the list of brand templates."
                    ],
                    [
                        "source" => "query",
                        "name" => "dataset",
                        "param" => "dataset",
                        "required" => false,
                        "description" => "Filter the list of brand templates based on the brand templates' dataset definitions."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_brand_template",
                "operation" => "getBrandTemplate",
                "class" => "CanvaGetBrandTemplate",
                "method" => "GET",
                "path" => "/v1/brand-templates/{brandTemplateId}",
                "type" => "read",
                "name" => "Get Brand Template",
                "description" => "Execute the Canva get brand template operation.",
                "auth" => "bearer",
                "scopes" => [
                    "brandtemplate:meta:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "brandTemplateId",
                        "param" => "brand_template_id",
                        "required" => true,
                        "description" => "The brand template ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_brand_template_dataset",
                "operation" => "getBrandTemplateDataset",
                "class" => "CanvaGetBrandTemplateDataset",
                "method" => "GET",
                "path" => "/v1/brand-templates/{brandTemplateId}/dataset",
                "type" => "read",
                "name" => "Get Brand Template Dataset",
                "description" => "Execute the Canva get brand template dataset operation.",
                "auth" => "bearer",
                "scopes" => [
                    "brandtemplate:content:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "brandTemplateId",
                        "param" => "brand_template_id",
                        "required" => true,
                        "description" => "The brand template ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_comment",
                "operation" => "createComment",
                "class" => "CanvaCreateComment",
                "method" => "POST",
                "path" => "/v1/comments",
                "type" => "write",
                "name" => "Create Comment",
                "description" => "This API is deprecated, so you should use the API instead.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_create_reply_deprecated",
                "operation" => "createReplyDeprecated",
                "class" => "CanvaCreateReplyDeprecated",
                "method" => "POST",
                "path" => "/v1/comments/{commentId}/replies",
                "type" => "write",
                "name" => "Create Reply Deprecated",
                "description" => "This API is deprecated, so you should use the API instead.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "commentId",
                        "param" => "comment_id",
                        "required" => true,
                        "description" => "The ID of the comment."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_list_replies",
                "operation" => "listReplies",
                "class" => "CanvaListReplies",
                "method" => "GET",
                "path" => "/v1/designs/{designId}/comments/{threadId}/replies",
                "type" => "read",
                "name" => "List Replies",
                "description" => "Execute the Canva list replies operation.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "threadId",
                        "param" => "thread_id",
                        "required" => true,
                        "description" => "The ID of the thread."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => null
                    ],
                    [
                        "source" => "query",
                        "name" => "continuation",
                        "param" => "continuation",
                        "required" => false,
                        "description" => "If the success response contains a continuation token, the list contains more items you can list."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_reply",
                "operation" => "createReply",
                "class" => "CanvaCreateReply",
                "method" => "POST",
                "path" => "/v1/designs/{designId}/comments/{threadId}/replies",
                "type" => "write",
                "name" => "Create Reply",
                "description" => "Execute the Canva create reply operation.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "threadId",
                        "param" => "thread_id",
                        "required" => true,
                        "description" => "The ID of the thread."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_thread",
                "operation" => "getThread",
                "class" => "CanvaGetThread",
                "method" => "GET",
                "path" => "/v1/designs/{designId}/comments/{threadId}",
                "type" => "read",
                "name" => "Get Thread",
                "description" => "Execute the Canva get thread operation.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "threadId",
                        "param" => "thread_id",
                        "required" => true,
                        "description" => "The ID of the thread."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_reply",
                "operation" => "getReply",
                "class" => "CanvaGetReply",
                "method" => "GET",
                "path" => "/v1/designs/{designId}/comments/{threadId}/replies/{replyId}",
                "type" => "read",
                "name" => "Get Reply",
                "description" => "Execute the Canva get reply operation.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ],
                    [
                        "source" => "path",
                        "name" => "threadId",
                        "param" => "thread_id",
                        "required" => true,
                        "description" => "The ID of the thread."
                    ],
                    [
                        "source" => "path",
                        "name" => "replyId",
                        "param" => "reply_id",
                        "required" => true,
                        "description" => "The ID of the reply."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_thread",
                "operation" => "createThread",
                "class" => "CanvaCreateThread",
                "method" => "POST",
                "path" => "/v1/designs/{designId}/comments",
                "type" => "write",
                "name" => "Create Thread",
                "description" => "Execute the Canva create thread operation.",
                "auth" => "bearer",
                "scopes" => [
                    "comment:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_signing_public_keys",
                "operation" => "getSigningPublicKeys",
                "class" => "CanvaGetSigningPublicKeys",
                "method" => "GET",
                "path" => "/v1/connect/keys",
                "type" => "read",
                "name" => "Get Signing Public Keys",
                "description" => "Execute the Canva get signing public keys operation.",
                "auth" => "none",
                "scopes" => [],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_list_designs",
                "operation" => "listDesigns",
                "class" => "CanvaListDesigns",
                "method" => "GET",
                "path" => "/v1/designs",
                "type" => "read",
                "name" => "List Designs",
                "description" => "Lists metadata for all the designs in a Canva user's .",
                "auth" => "bearer",
                "scopes" => [
                    "design:meta:read"
                ],
                "parameters" => [
                    [
                        "source" => "query",
                        "name" => "query",
                        "param" => "query",
                        "required" => false,
                        "description" => "Lets you search the user's designs, and designs shared with the user, using a search term or terms."
                    ],
                    [
                        "source" => "query",
                        "name" => "continuation",
                        "param" => "continuation",
                        "required" => false,
                        "description" => "If the success response contains a continuation token, the list contains more designs you can list."
                    ],
                    [
                        "source" => "query",
                        "name" => "ownership",
                        "param" => "ownership",
                        "required" => false,
                        "description" => "Filter the list of designs based on the user's ownership of the designs."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "Sort the list of designs."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of designs to return."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_design",
                "operation" => "createDesign",
                "class" => "CanvaCreateDesign",
                "method" => "POST",
                "path" => "/v1/designs",
                "type" => "write",
                "name" => "Create Design",
                "description" => "Creates a new Canva design.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_design",
                "operation" => "getDesign",
                "class" => "CanvaGetDesign",
                "method" => "GET",
                "path" => "/v1/designs/{designId}",
                "type" => "read",
                "name" => "Get Design",
                "description" => "Gets the metadata for a design.",
                "auth" => "bearer",
                "scopes" => [
                    "design:meta:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_design_pages",
                "operation" => "getDesignPages",
                "class" => "CanvaGetDesignPages",
                "method" => "GET",
                "path" => "/v1/designs/{designId}/pages",
                "type" => "read",
                "name" => "Get Design Pages",
                "description" => "Execute the Canva get design pages operation.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ],
                    [
                        "source" => "query",
                        "name" => "offset",
                        "param" => "offset",
                        "required" => false,
                        "description" => "The page index to start the range of pages to return."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => "The number of pages to return, starting at the page index specified using the offset parameter."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_design_export_formats",
                "operation" => "getDesignExportFormats",
                "class" => "CanvaGetDesignExportFormats",
                "method" => "GET",
                "path" => "/v1/designs/{designId}/export-formats",
                "type" => "read",
                "name" => "Get Design Export Formats",
                "description" => "Lists the available file formats for .",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "designId",
                        "param" => "design_id",
                        "required" => true,
                        "description" => "The design ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_design_import_job",
                "operation" => "createDesignImportJob",
                "class" => "CanvaCreateDesignImportJob",
                "method" => "POST",
                "path" => "/v1/imports",
                "type" => "write",
                "name" => "Create Design Import Job",
                "description" => "Starts a new to import an external file as a new design in Canva.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [
                    [
                        "source" => "header",
                        "name" => "Import-Metadata",
                        "param" => "import_metadata",
                        "required" => true,
                        "description" => null
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/octet-stream"
            ],
            [
                "slug" => "canva_get_design_import_job",
                "operation" => "getDesignImportJob",
                "class" => "CanvaGetDesignImportJob",
                "method" => "GET",
                "path" => "/v1/imports/{jobId}",
                "type" => "read",
                "name" => "Get Design Import Job",
                "description" => "Gets the result of a design import job created using the .",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The design import job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_url_import_job",
                "operation" => "createUrlImportJob",
                "class" => "CanvaCreateURLImportJob",
                "method" => "POST",
                "path" => "/v1/url-imports",
                "type" => "write",
                "name" => "Create URL Import Job",
                "description" => "Starts a new to import an external file from a URL as a new design in Canva.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_url_import_job",
                "operation" => "getUrlImportJob",
                "class" => "CanvaGetURLImportJob",
                "method" => "GET",
                "path" => "/v1/url-imports/{jobId}",
                "type" => "read",
                "name" => "Get URL Import Job",
                "description" => "Gets the result of a URL import job created using the .",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The ID of the URL import job."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_design_export_job",
                "operation" => "createDesignExportJob",
                "class" => "CanvaCreateDesignExportJob",
                "method" => "POST",
                "path" => "/v1/exports",
                "type" => "write",
                "name" => "Create Design Export Job",
                "description" => "Starts a new to export a file from Canva.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_design_export_job",
                "operation" => "getDesignExportJob",
                "class" => "CanvaGetDesignExportJob",
                "method" => "GET",
                "path" => "/v1/exports/{exportId}",
                "type" => "read",
                "name" => "Get Design Export Job",
                "description" => "Gets the result of a design export job that was created using the .",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "exportId",
                        "param" => "export_id",
                        "required" => true,
                        "description" => "The export job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_delete_folder",
                "operation" => "deleteFolder",
                "class" => "CanvaDeleteFolder",
                "method" => "DELETE",
                "path" => "/v1/folders/{folderId}",
                "type" => "write",
                "name" => "Delete Folder",
                "description" => "Deletes a folder with the specified folderID.",
                "auth" => "bearer",
                "scopes" => [
                    "folder:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "folderId",
                        "param" => "folder_id",
                        "required" => true,
                        "description" => "The folder ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_folder",
                "operation" => "getFolder",
                "class" => "CanvaGetFolder",
                "method" => "GET",
                "path" => "/v1/folders/{folderId}",
                "type" => "read",
                "name" => "Get Folder",
                "description" => "Gets the name and other details of a folder using a folder's folderID.",
                "auth" => "bearer",
                "scopes" => [
                    "folder:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "folderId",
                        "param" => "folder_id",
                        "required" => true,
                        "description" => "The folder ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_update_folder",
                "operation" => "updateFolder",
                "class" => "CanvaUpdateFolder",
                "method" => "PATCH",
                "path" => "/v1/folders/{folderId}",
                "type" => "write",
                "name" => "Update Folder",
                "description" => "Updates a folder's details using its folderID.",
                "auth" => "bearer",
                "scopes" => [
                    "folder:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "folderId",
                        "param" => "folder_id",
                        "required" => true,
                        "description" => "The folder ID."
                    ]
                ],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_list_folder_items",
                "operation" => "listFolderItems",
                "class" => "CanvaListFolderItems",
                "method" => "GET",
                "path" => "/v1/folders/{folderId}/items",
                "type" => "read",
                "name" => "List Folder Items",
                "description" => "Lists the items in a folder, including each item's type.",
                "auth" => "bearer",
                "scopes" => [
                    "folder:read"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "folderId",
                        "param" => "folder_id",
                        "required" => true,
                        "description" => "The folder ID."
                    ],
                    [
                        "source" => "query",
                        "name" => "continuation",
                        "param" => "continuation",
                        "required" => false,
                        "description" => "If the success response contains a continuation token, the folder contains more items you can list."
                    ],
                    [
                        "source" => "query",
                        "name" => "limit",
                        "param" => "limit",
                        "required" => false,
                        "description" => null
                    ],
                    [
                        "source" => "query",
                        "name" => "item_types",
                        "param" => "item_types",
                        "required" => false,
                        "description" => "Filter the folder items to only return specified types."
                    ],
                    [
                        "source" => "query",
                        "name" => "sort_by",
                        "param" => "sort_by",
                        "required" => false,
                        "description" => "Sort the list of folder items."
                    ],
                    [
                        "source" => "query",
                        "name" => "pin_status",
                        "param" => "pin_status",
                        "required" => false,
                        "description" => "Filter the folder items by their pinned status."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_move_folder_item",
                "operation" => "moveFolderItem",
                "class" => "CanvaMoveFolderItem",
                "method" => "POST",
                "path" => "/v1/folders/move",
                "type" => "write",
                "name" => "Move Folder Item",
                "description" => "Moves an item to another folder.",
                "auth" => "bearer",
                "scopes" => [
                    "folder:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_create_folder",
                "operation" => "createFolder",
                "class" => "CanvaCreateFolder",
                "method" => "POST",
                "path" => "/v1/folders",
                "type" => "write",
                "name" => "Create Folder",
                "description" => "Creates a folder in one of the following locations: - The top level of a Canva user's (using the ID root), - The user's Uploads folder (using the ID uploads), - Another folder (using the parent folder's ID).",
                "auth" => "bearer",
                "scopes" => [
                    "folder:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_exchange_access_token",
                "operation" => "exchangeAccessToken",
                "class" => "CanvaExchangeAccessToken",
                "method" => "POST",
                "path" => "/v1/oauth/token",
                "type" => "write",
                "name" => "Exchange Access Token",
                "description" => "This endpoint implements the OAuth 2.0 token endpoint, as part of the Authorization Code flow with Proof Key for Code Exchange (PKCE).",
                "auth" => "basic_or_body",
                "scopes" => [],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/x-www-form-urlencoded"
            ],
            [
                "slug" => "canva_introspect_token",
                "operation" => "introspectToken",
                "class" => "CanvaIntrospectToken",
                "method" => "POST",
                "path" => "/v1/oauth/introspect",
                "type" => "write",
                "name" => "Introspect Token",
                "description" => "Introspect an access token to see whether it is valid and active.",
                "auth" => "basic_or_body",
                "scopes" => [],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/x-www-form-urlencoded"
            ],
            [
                "slug" => "canva_revoke_tokens",
                "operation" => "revokeTokens",
                "class" => "CanvaRevokeTokens",
                "method" => "POST",
                "path" => "/v1/oauth/revoke",
                "type" => "write",
                "name" => "Revoke Tokens",
                "description" => "Revoke an access token or a refresh token.",
                "auth" => "basic_or_body",
                "scopes" => [],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => true,
                "content_type" => "application/x-www-form-urlencoded"
            ],
            [
                "slug" => "canva_get_oidc_jwks",
                "operation" => "getOidcJwks",
                "class" => "CanvaGetOIDCJWKS",
                "method" => "GET",
                "path" => "/v1/oidc/jwks",
                "type" => "read",
                "name" => "Get OIDC JWKS",
                "description" => "Gets the JSON Web Key Set (public keys) for OIDC.",
                "auth" => "none",
                "scopes" => [],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_oidc_user_info",
                "operation" => "userInfo",
                "class" => "CanvaGetOIDCUserInfo",
                "method" => "GET",
                "path" => "/v1/oidc/userinfo",
                "type" => "read",
                "name" => "Get OIDC User Info",
                "description" => "Fetches the current UserInfo claims for the authorized user.",
                "auth" => "bearer",
                "scopes" => [
                    "openid",
                    "profile",
                    "email"
                ],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_create_design_resize_job",
                "operation" => "createDesignResizeJob",
                "class" => "CanvaCreateDesignResizeJob",
                "method" => "POST",
                "path" => "/v1/resizes",
                "type" => "write",
                "name" => "Create Design Resize Job",
                "description" => "Execute the Canva create design resize job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read",
                    "design:content:write"
                ],
                "parameters" => [],
                "request_body" => true,
                "request_body_required" => false,
                "content_type" => "application/json"
            ],
            [
                "slug" => "canva_get_design_resize_job",
                "operation" => "getDesignResizeJob",
                "class" => "CanvaGetDesignResizeJob",
                "method" => "GET",
                "path" => "/v1/resizes/{jobId}",
                "type" => "read",
                "name" => "Get Design Resize Job",
                "description" => "Execute the Canva get design resize job operation.",
                "auth" => "bearer",
                "scopes" => [
                    "design:content:read",
                    "design:content:write"
                ],
                "parameters" => [
                    [
                        "source" => "path",
                        "name" => "jobId",
                        "param" => "job_id",
                        "required" => true,
                        "description" => "The design resize job ID."
                    ]
                ],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_current_user",
                "operation" => "usersMe",
                "class" => "CanvaGetCurrentUser",
                "method" => "GET",
                "path" => "/v1/users/me",
                "type" => "read",
                "name" => "Get Current User",
                "description" => "Returns the User ID and Team ID of the user account associated with the provided access token.",
                "auth" => "bearer",
                "scopes" => [],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_user_capabilities",
                "operation" => "getUserCapabilities",
                "class" => "CanvaGetUserCapabilities",
                "method" => "GET",
                "path" => "/v1/users/me/capabilities",
                "type" => "read",
                "name" => "Get User Capabilities",
                "description" => "Lists the API capabilities for the user account associated with the provided access token.",
                "auth" => "bearer",
                "scopes" => [
                    "profile:read"
                ],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ],
            [
                "slug" => "canva_get_user_profile",
                "operation" => "getUserProfile",
                "class" => "CanvaGetUserProfile",
                "method" => "GET",
                "path" => "/v1/users/me/profile",
                "type" => "read",
                "name" => "Get User Profile",
                "description" => "Currently, this returns the display name of the user account associated with the provided access token.",
                "auth" => "bearer",
                "scopes" => [
                    "profile:read"
                ],
                "parameters" => [],
                "request_body" => false,
                "request_body_required" => false,
                "content_type" => null
            ]
        ];
    }
}
