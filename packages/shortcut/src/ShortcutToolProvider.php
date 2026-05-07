<?php

namespace OpenCompany\Integrations\Shortcut;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasIntegrationCapabilities;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListCategories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateCategory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetCategory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateCategory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteCategory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListCategoryMilestones;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListCategoryObjectives;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListCustomFields;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetCustomField;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateCustomField;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteCustomField;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListDocs;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateDoc;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetDoc;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateDoc;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteDoc;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListDocumentEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutLinkDocumentToEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUnlinkDocumentFromEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutLoadTiptapDocumentJSON;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEntityTemplates;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateEntityTemplate;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDisableStoryTemplates;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutEnableStoryTemplates;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetEntityTemplate;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateEntityTemplate;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteEntityTemplate;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetEpicWorkflow;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpicsPaginated;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteEpic;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpicComments;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateEpicComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateEpicCommentComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetEpicComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateEpicComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteEpicComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpicDocuments;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetEpicHealth;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateEpicHealth;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpicHealths;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListEpicStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetExternalLinkStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListFiles;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUploadFiles;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListGroups;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateGroup;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetGroup;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateGroup;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListGroupStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateHealth;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateGenericIntegration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetGenericIntegration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteGenericIntegration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListIterations;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateIteration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDisableIterations;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutEnableIterations;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetIteration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateIteration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteIteration;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListIterationStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetKeyResult;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateKeyResult;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListLabels;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateLabel;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetLabel;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateLabel;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteLabel;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListLabelEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListLabelStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListLinkedFiles;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateLinkedFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetLinkedFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateLinkedFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteLinkedFile;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetCurrentMemberInfo;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListMembers;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetMember;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListMilestones;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateMilestone;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetMilestone;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateMilestone;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteMilestone;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListMilestoneEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListObjectives;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateObjective;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetObjective;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateObjective;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteObjective;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListObjectiveEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetObjectiveHealth;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateObjectiveHealth;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListObjectiveHealths;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListProjects;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateProject;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetProject;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateProject;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteProject;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListRepositories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetRepository;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearch;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchDocuments;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchEpics;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchIterations;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchMilestones;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchObjectives;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutSearchStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateMultipleStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateMultipleStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteMultipleStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStoryFromTemplate;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutQueryStories;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteStory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListStoryComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStoryComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetStoryComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateStoryComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteStoryComment;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStoryReaction;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteStoryReaction;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUnlinkCommentThreadFromSlack;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutStoryHistory;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListStorySubTasks;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateTask;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetTask;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateTask;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteTask;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutCreateStoryLink;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetStoryLink;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutUpdateStoryLink;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutDeleteStoryLink;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutListWorkflows;
use OpenCompany\Integrations\Shortcut\Tools\ShortcutGetWorkflow;

/**
 * Tool catalog and configuration metadata for Shortcut.
 *
 * Exposes the official Shortcut REST v3 Swagger operation set as endpoint-specific
 * tools and resolves account-specific API tokens for multi-account hosts.
 */
class ShortcutToolProvider implements ToolProvider, ConfigurableIntegration, HasIntegrationCapabilities
{
    /**
     * Describe host and authentication capabilities for catalog and setup flows.
     *
     * @return array<string, mixed>
     */
    public function integrationCapabilities(): array
    {
        return [
            'auth' => ['strategy' => 'api_key', 'legacy_auth_type' => 'api_key', 'credential_mode' => 'secret', 'setup_flows' => ['manual_secret'], 'requires_browser_for_setup' => false, 'refreshable' => false, 'token_keys' => [], 'notes' => ['Shortcut uses the Shortcut-Token request header.']],
            'host_availability' => ['web' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret'], 'cli' => ['setup_supported' => true, 'runtime_supported' => true, 'setup_mode' => 'manual_secret', 'runtime_mode' => 'normal']],
            'runtime_requirements' => [],
            'compatibility' => ['web_setup_supported' => true, 'web_runtime_supported' => true, 'cli_setup_supported' => true, 'cli_runtime_supported' => true],
        ];
    }

    public function appName(): string
    {
        return 'shortcut';
    }

    public function appMeta(): array
    {
        return ['label' => 'Shortcut', 'description' => 'Stories, epics, objectives, iterations, docs, workflows, files, and members', 'icon' => 'ph:kanban', 'logo' => 'ph:kanban'];
    }

    public function integrationMeta(): array
    {
        return ['name' => 'Shortcut', 'description' => 'Manage Shortcut stories, epics, objectives, iterations, docs, workflows, files, members, labels, projects, groups, and webhooks.', 'icon' => 'ph:kanban', 'logo' => 'ph:kanban', 'category' => 'productivity', 'badge' => 'verified', 'docs_url' => 'https://developer.shortcut.com/api/rest/v3'];
    }

    public function configSchema(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Token', 'placeholder' => 'Shortcut API token', 'hint' => 'Create a token in Shortcut account settings. It is sent as Shortcut-Token.', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'placeholder' => 'https://api.app.shortcut.com', 'hint' => 'Use https://api.app.shortcut.com unless Shortcut provides a dedicated origin.', 'default' => 'https://api.app.shortcut.com'],
        ];
    }

    /**
     * Verify Shortcut credentials with the lightweight current member endpoint.
     *
     * @param  array<string, mixed>  $config  Credential and endpoint settings.
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = (string) ($config['api_key'] ?? '');
        $baseUrl = rtrim((string) ($config['url'] ?? 'https://api.app.shortcut.com'), '/');

        if ($apiKey === '') {
            return ['success' => false, 'error' => 'Shortcut API token is required.'];
        }

        try {
            $response = Http::withHeaders(['Shortcut-Token' => $apiKey, 'Accept' => 'application/json'])->timeout(10)->get($baseUrl . '/api/v3/member');

            if (!$response->successful()) {
                return ['success' => false, 'error' => 'Shortcut API returned HTTP ' . $response->status() . '.'];
            }

            return ['success' => true, 'message' => 'Connected to Shortcut at ' . $baseUrl . '.'];
        } catch (\Throwable $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return ['api_key' => 'nullable|string', 'url' => 'nullable|url'];
    }

    public function credentialFields(): array
    {
        return $this->configSchema();
    }

    public function tools(): array
    {
        return [
            'shortcut_list_categories' => [
                'class' => ShortcutListCategories::class,
                'name' => 'List Categories',
                'description' => 'List Categories

Official Shortcut endpoint: GET /api/v3/categories.',
                'parameters' => [],
            ],
            'shortcut_create_category' => [
                'class' => ShortcutCreateCategory::class,
                'name' => 'Create Category',
                'description' => 'Create Category

Official Shortcut endpoint: POST /api/v3/categories.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_category' => [
                'class' => ShortcutGetCategory::class,
                'name' => 'Get Category',
                'description' => 'Get Category

Official Shortcut endpoint: GET /api/v3/categories/{category-public-id}.',
                'parameters' => [
                    'category_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Category.',
                    ],
                ],
            ],
            'shortcut_update_category' => [
                'class' => ShortcutUpdateCategory::class,
                'name' => 'Update Category',
                'description' => 'Update Category

Official Shortcut endpoint: PUT /api/v3/categories/{category-public-id}.',
                'parameters' => [
                    'category_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Category you wish to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_category' => [
                'class' => ShortcutDeleteCategory::class,
                'name' => 'Delete Category',
                'description' => 'Delete Category

Official Shortcut endpoint: DELETE /api/v3/categories/{category-public-id}.',
                'parameters' => [
                    'category_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Category.',
                    ],
                ],
            ],
            'shortcut_list_category_milestones' => [
                'class' => ShortcutListCategoryMilestones::class,
                'name' => 'List Category Milestones',
                'description' => 'List Category Milestones

Official Shortcut endpoint: GET /api/v3/categories/{category-public-id}/milestones.',
                'parameters' => [
                    'category_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Category.',
                    ],
                ],
            ],
            'shortcut_list_category_objectives' => [
                'class' => ShortcutListCategoryObjectives::class,
                'name' => 'List Category Objectives',
                'description' => 'List Category Objectives

Official Shortcut endpoint: GET /api/v3/categories/{category-public-id}/objectives.',
                'parameters' => [
                    'category_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Category.',
                    ],
                ],
            ],
            'shortcut_list_custom_fields' => [
                'class' => ShortcutListCustomFields::class,
                'name' => 'List Custom Fields',
                'description' => 'List Custom Fields

Official Shortcut endpoint: GET /api/v3/custom-fields.',
                'parameters' => [],
            ],
            'shortcut_get_custom_field' => [
                'class' => ShortcutGetCustomField::class,
                'name' => 'Get Custom Field',
                'description' => 'Get Custom Field

Official Shortcut endpoint: GET /api/v3/custom-fields/{custom-field-public-id}.',
                'parameters' => [
                    'custom_field_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the CustomField.',
                    ],
                ],
            ],
            'shortcut_update_custom_field' => [
                'class' => ShortcutUpdateCustomField::class,
                'name' => 'Update Custom Field',
                'description' => 'Update Custom Field

Official Shortcut endpoint: PUT /api/v3/custom-fields/{custom-field-public-id}.',
                'parameters' => [
                    'custom_field_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the CustomField.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_custom_field' => [
                'class' => ShortcutDeleteCustomField::class,
                'name' => 'Delete Custom Field',
                'description' => 'Delete Custom Field

Official Shortcut endpoint: DELETE /api/v3/custom-fields/{custom-field-public-id}.',
                'parameters' => [
                    'custom_field_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the CustomField.',
                    ],
                ],
            ],
            'shortcut_list_docs' => [
                'class' => ShortcutListDocs::class,
                'name' => 'List Docs',
                'description' => 'List Docs

Official Shortcut endpoint: GET /api/v3/documents.',
                'parameters' => [],
            ],
            'shortcut_create_doc' => [
                'class' => ShortcutCreateDoc::class,
                'name' => 'Create Doc',
                'description' => 'Create Doc

Official Shortcut endpoint: POST /api/v3/documents.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_doc' => [
                'class' => ShortcutGetDoc::class,
                'name' => 'Get Doc',
                'description' => 'Get Doc

Official Shortcut endpoint: GET /api/v3/documents/{doc-public-id}.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Doc\'s public ID',
                    ],
                    'content_format' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Format of the content to return. Defaults to \'markdown\'. If \'html\', includes HTML content in response.',
                        'enum' => [
                            'markdown',
                            'html',
                        ],
                    ],
                ],
            ],
            'shortcut_update_doc' => [
                'class' => ShortcutUpdateDoc::class,
                'name' => 'Update Doc',
                'description' => 'Update Doc

Official Shortcut endpoint: PUT /api/v3/documents/{doc-public-id}.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Doc\'s public ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_doc' => [
                'class' => ShortcutDeleteDoc::class,
                'name' => 'Delete Doc',
                'description' => 'Delete Doc

Official Shortcut endpoint: DELETE /api/v3/documents/{doc-public-id}.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Doc\'s public ID',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_document_epics' => [
                'class' => ShortcutListDocumentEpics::class,
                'name' => 'List Document Epics',
                'description' => 'List Document Epics

Official Shortcut endpoint: GET /api/v3/documents/{doc-public-id}/epics.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The public ID of the Document.',
                    ],
                ],
            ],
            'shortcut_link_document_to_epic' => [
                'class' => ShortcutLinkDocumentToEpic::class,
                'name' => 'Link Document To Epic',
                'description' => 'Link Document to Epic

Official Shortcut endpoint: PUT /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The public ID of the Document.',
                    ],
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The public ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_unlink_document_from_epic' => [
                'class' => ShortcutUnlinkDocumentFromEpic::class,
                'name' => 'Unlink Document From Epic',
                'description' => 'Unlink Document from Epic

Official Shortcut endpoint: DELETE /api/v3/documents/{doc-public-id}/epics/{epic-public-id}.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The public ID of the Document.',
                    ],
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The public ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_load_tiptap_document_json' => [
                'class' => ShortcutLoadTiptapDocumentJSON::class,
                'name' => 'Load Tiptap Document Json',
                'description' => 'Load Tiptap Document JSON

Official Shortcut endpoint: GET /api/v3/documents/{doc-public-id}/tiptap-load.',
                'parameters' => [
                    'doc_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Doc\'s public ID',
                    ],
                    'content_format' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Format of the content to return. Defaults to \'markdown\'. If \'html\', includes HTML content in response.',
                        'enum' => [
                            'markdown',
                            'html',
                        ],
                    ],
                ],
            ],
            'shortcut_list_entity_templates' => [
                'class' => ShortcutListEntityTemplates::class,
                'name' => 'List Entity Templates',
                'description' => 'List Entity Templates

Official Shortcut endpoint: GET /api/v3/entity-templates.',
                'parameters' => [],
            ],
            'shortcut_create_entity_template' => [
                'class' => ShortcutCreateEntityTemplate::class,
                'name' => 'Create Entity Template',
                'description' => 'Create Entity Template

Official Shortcut endpoint: POST /api/v3/entity-templates.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request parameters for creating an entirely new entity template.',
                    ],
                ],
            ],
            'shortcut_disable_story_templates' => [
                'class' => ShortcutDisableStoryTemplates::class,
                'name' => 'Disable Story Templates',
                'description' => 'Disable Story Templates

Official Shortcut endpoint: PUT /api/v3/entity-templates/disable.',
                'parameters' => [],
            ],
            'shortcut_enable_story_templates' => [
                'class' => ShortcutEnableStoryTemplates::class,
                'name' => 'Enable Story Templates',
                'description' => 'Enable Story Templates

Official Shortcut endpoint: PUT /api/v3/entity-templates/enable.',
                'parameters' => [],
            ],
            'shortcut_get_entity_template' => [
                'class' => ShortcutGetEntityTemplate::class,
                'name' => 'Get Entity Template',
                'description' => 'Get Entity Template

Official Shortcut endpoint: GET /api/v3/entity-templates/{entity-template-public-id}.',
                'parameters' => [
                    'entity_template_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the entity template.',
                    ],
                ],
            ],
            'shortcut_update_entity_template' => [
                'class' => ShortcutUpdateEntityTemplate::class,
                'name' => 'Update Entity Template',
                'description' => 'Update Entity Template

Official Shortcut endpoint: PUT /api/v3/entity-templates/{entity-template-public-id}.',
                'parameters' => [
                    'entity_template_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the template to be updated.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request parameters for changing either a template\'s name or any of the attributes it is designed to pre-populate.',
                    ],
                ],
            ],
            'shortcut_delete_entity_template' => [
                'class' => ShortcutDeleteEntityTemplate::class,
                'name' => 'Delete Entity Template',
                'description' => 'Delete Entity Template

Official Shortcut endpoint: DELETE /api/v3/entity-templates/{entity-template-public-id}.',
                'parameters' => [
                    'entity_template_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the entity template.',
                    ],
                ],
            ],
            'shortcut_get_epic_workflow' => [
                'class' => ShortcutGetEpicWorkflow::class,
                'name' => 'Get Epic Workflow',
                'description' => 'Get Epic Workflow

Official Shortcut endpoint: GET /api/v3/epic-workflow.',
                'parameters' => [],
            ],
            'shortcut_list_epics' => [
                'class' => ShortcutListEpics::class,
                'name' => 'List Epics',
                'description' => 'List Epics

Official Shortcut endpoint: GET /api/v3/epics.',
                'parameters' => [
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Epics with their descriptions.',
                    ],
                ],
            ],
            'shortcut_create_epic' => [
                'class' => ShortcutCreateEpic::class,
                'name' => 'Create Epic',
                'description' => 'Create Epic

Official Shortcut endpoint: POST /api/v3/epics.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_epics_paginated' => [
                'class' => ShortcutListEpicsPaginated::class,
                'name' => 'List Epics Paginated',
                'description' => 'List Epics Paginated

Official Shortcut endpoint: GET /api/v3/epics/paginated.',
                'parameters' => [
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Epics with their descriptions.',
                    ],
                    'page' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The page number to return, starting with 1. Defaults to 1.',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of Epics to return per page. Minimum 1, maximum 250, default 10.',
                    ],
                ],
            ],
            'shortcut_get_epic' => [
                'class' => ShortcutGetEpic::class,
                'name' => 'Get Epic',
                'description' => 'Get Epic

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_update_epic' => [
                'class' => ShortcutUpdateEpic::class,
                'name' => 'Update Epic',
                'description' => 'Update Epic

Official Shortcut endpoint: PUT /api/v3/epics/{epic-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_epic' => [
                'class' => ShortcutDeleteEpic::class,
                'name' => 'Delete Epic',
                'description' => 'Delete Epic

Official Shortcut endpoint: DELETE /api/v3/epics/{epic-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_list_epic_comments' => [
                'class' => ShortcutListEpicComments::class,
                'name' => 'List Epic Comments',
                'description' => 'List Epic Comments

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/comments.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_create_epic_comment' => [
                'class' => ShortcutCreateEpicComment::class,
                'name' => 'Create Epic Comment',
                'description' => 'Create Epic Comment

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/comments.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the associated Epic.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_create_epic_comment_comment' => [
                'class' => ShortcutCreateEpicCommentComment::class,
                'name' => 'Create Epic Comment Comment',
                'description' => 'Create Epic Comment Comment

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the associated Epic.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the parent Epic Comment.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_epic_comment' => [
                'class' => ShortcutGetEpicComment::class,
                'name' => 'Get Epic Comment',
                'description' => 'Get Epic Comment

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the associated Epic.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                ],
            ],
            'shortcut_update_epic_comment' => [
                'class' => ShortcutUpdateEpicComment::class,
                'name' => 'Update Epic Comment',
                'description' => 'Update Epic Comment

Official Shortcut endpoint: PUT /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the associated Epic.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_epic_comment' => [
                'class' => ShortcutDeleteEpicComment::class,
                'name' => 'Delete Epic Comment',
                'description' => 'Delete Epic Comment

Official Shortcut endpoint: DELETE /api/v3/epics/{epic-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the associated Epic.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                ],
            ],
            'shortcut_list_epic_documents' => [
                'class' => ShortcutListEpicDocuments::class,
                'name' => 'List Epic Documents',
                'description' => 'List Epic Documents

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/documents.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_get_epic_health' => [
                'class' => ShortcutGetEpicHealth::class,
                'name' => 'Get Epic Health',
                'description' => 'Get Epic Health

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/health.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_create_epic_health' => [
                'class' => ShortcutCreateEpicHealth::class,
                'name' => 'Create Epic Health',
                'description' => 'Create Epic Health

Official Shortcut endpoint: POST /api/v3/epics/{epic-public-id}/health.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_epic_healths' => [
                'class' => ShortcutListEpicHealths::class,
                'name' => 'List Epic Healths',
                'description' => 'List Epic Healths

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/health-history.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                ],
            ],
            'shortcut_list_epic_stories' => [
                'class' => ShortcutListEpicStories::class,
                'name' => 'List Epic Stories',
                'description' => 'List Epic Stories

Official Shortcut endpoint: GET /api/v3/epics/{epic-public-id}/stories.',
                'parameters' => [
                    'epic_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Epic.',
                    ],
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Stories with their descriptions.',
                    ],
                ],
            ],
            'shortcut_get_external_link_stories' => [
                'class' => ShortcutGetExternalLinkStories::class,
                'name' => 'Get External Link Stories',
                'description' => 'Get External Link Stories

Official Shortcut endpoint: GET /api/v3/external-link/stories.',
                'parameters' => [
                    'external_link' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The external link associated with one or more stories.',
                    ],
                ],
            ],
            'shortcut_list_files' => [
                'class' => ShortcutListFiles::class,
                'name' => 'List Files',
                'description' => 'List Files

Official Shortcut endpoint: GET /api/v3/files.',
                'parameters' => [],
            ],
            'shortcut_upload_files' => [
                'class' => ShortcutUploadFiles::class,
                'name' => 'Upload Files',
                'description' => 'Upload Files

Official Shortcut endpoint: POST /api/v3/files.',
                'parameters' => [
                    'story_id' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The story ID that these files will be associated with.',
                    ],
                    'file0' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'A file upload. At least one is required. Provide a local file path for upload.',
                    ],
                    'file1' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional additional files. Provide a local file path for upload.',
                    ],
                    'file2' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional additional files. Provide a local file path for upload.',
                    ],
                    'file3' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'Optional additional files. Provide a local file path for upload.',
                    ],
                ],
            ],
            'shortcut_get_file' => [
                'class' => ShortcutGetFile::class,
                'name' => 'Get File',
                'description' => 'Get File

Official Shortcut endpoint: GET /api/v3/files/{file-public-id}.',
                'parameters' => [
                    'file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The File’s unique ID.',
                    ],
                ],
            ],
            'shortcut_update_file' => [
                'class' => ShortcutUpdateFile::class,
                'name' => 'Update File',
                'description' => 'Update File

Official Shortcut endpoint: PUT /api/v3/files/{file-public-id}.',
                'parameters' => [
                    'file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID assigned to the file in Shortcut.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_file' => [
                'class' => ShortcutDeleteFile::class,
                'name' => 'Delete File',
                'description' => 'Delete File

Official Shortcut endpoint: DELETE /api/v3/files/{file-public-id}.',
                'parameters' => [
                    'file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The File’s unique ID.',
                    ],
                ],
            ],
            'shortcut_list_groups' => [
                'class' => ShortcutListGroups::class,
                'name' => 'List Groups',
                'description' => 'List Groups

Official Shortcut endpoint: GET /api/v3/groups.',
                'parameters' => [
                    'archived' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Filter groups by their archived state. If true, returns only archived groups. If false, returns only unarchived groups. If not provided, returns all groups',
                    ],
                ],
            ],
            'shortcut_create_group' => [
                'class' => ShortcutCreateGroup::class,
                'name' => 'Create Group',
                'description' => 'Create Group

Official Shortcut endpoint: POST /api/v3/groups.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_group' => [
                'class' => ShortcutGetGroup::class,
                'name' => 'Get Group',
                'description' => 'Get Group

Official Shortcut endpoint: GET /api/v3/groups/{group-public-id}.',
                'parameters' => [
                    'group_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the Group.',
                    ],
                ],
            ],
            'shortcut_update_group' => [
                'class' => ShortcutUpdateGroup::class,
                'name' => 'Update Group',
                'description' => 'Update Group

Official Shortcut endpoint: PUT /api/v3/groups/{group-public-id}.',
                'parameters' => [
                    'group_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the Group.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_group_stories' => [
                'class' => ShortcutListGroupStories::class,
                'name' => 'List Group Stories',
                'description' => 'List Group Stories

Official Shortcut endpoint: GET /api/v3/groups/{group-public-id}/stories.',
                'parameters' => [
                    'group_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the Group.',
                    ],
                    'limit' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The maximum number of results to return. (Defaults to 1000, max 1000)',
                    ],
                    'offset' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The offset at which to begin returning results. (Defaults to 0)',
                    ],
                ],
            ],
            'shortcut_update_health' => [
                'class' => ShortcutUpdateHealth::class,
                'name' => 'Update Health',
                'description' => 'Update Health

Official Shortcut endpoint: PUT /api/v3/health/{health-public-id}.',
                'parameters' => [
                    'health_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The unique ID of the Health record.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_create_generic_integration' => [
                'class' => ShortcutCreateGenericIntegration::class,
                'name' => 'Create Generic Integration',
                'description' => 'Create Generic Integration

Official Shortcut endpoint: POST /api/v3/integrations/webhook.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_generic_integration' => [
                'class' => ShortcutGetGenericIntegration::class,
                'name' => 'Get Generic Integration',
                'description' => 'Get Generic Integration

Official Shortcut endpoint: GET /api/v3/integrations/webhook/{integration-public-id}.',
                'parameters' => [
                    'integration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'integration-public-id',
                    ],
                ],
            ],
            'shortcut_delete_generic_integration' => [
                'class' => ShortcutDeleteGenericIntegration::class,
                'name' => 'Delete Generic Integration',
                'description' => 'Delete Generic Integration

Official Shortcut endpoint: DELETE /api/v3/integrations/webhook/{integration-public-id}.',
                'parameters' => [
                    'integration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'integration-public-id',
                    ],
                ],
            ],
            'shortcut_list_iterations' => [
                'class' => ShortcutListIterations::class,
                'name' => 'List Iterations',
                'description' => 'List Iterations

Official Shortcut endpoint: GET /api/v3/iterations.',
                'parameters' => [],
            ],
            'shortcut_create_iteration' => [
                'class' => ShortcutCreateIteration::class,
                'name' => 'Create Iteration',
                'description' => 'Create Iteration

Official Shortcut endpoint: POST /api/v3/iterations.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_disable_iterations' => [
                'class' => ShortcutDisableIterations::class,
                'name' => 'Disable Iterations',
                'description' => 'Disable Iterations

Official Shortcut endpoint: PUT /api/v3/iterations/disable.',
                'parameters' => [],
            ],
            'shortcut_enable_iterations' => [
                'class' => ShortcutEnableIterations::class,
                'name' => 'Enable Iterations',
                'description' => 'Enable Iterations

Official Shortcut endpoint: PUT /api/v3/iterations/enable.',
                'parameters' => [],
            ],
            'shortcut_get_iteration' => [
                'class' => ShortcutGetIteration::class,
                'name' => 'Get Iteration',
                'description' => 'Get Iteration

Official Shortcut endpoint: GET /api/v3/iterations/{iteration-public-id}.',
                'parameters' => [
                    'iteration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Iteration.',
                    ],
                ],
            ],
            'shortcut_update_iteration' => [
                'class' => ShortcutUpdateIteration::class,
                'name' => 'Update Iteration',
                'description' => 'Update Iteration

Official Shortcut endpoint: PUT /api/v3/iterations/{iteration-public-id}.',
                'parameters' => [
                    'iteration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Iteration.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_iteration' => [
                'class' => ShortcutDeleteIteration::class,
                'name' => 'Delete Iteration',
                'description' => 'Delete Iteration

Official Shortcut endpoint: DELETE /api/v3/iterations/{iteration-public-id}.',
                'parameters' => [
                    'iteration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Iteration.',
                    ],
                ],
            ],
            'shortcut_list_iteration_stories' => [
                'class' => ShortcutListIterationStories::class,
                'name' => 'List Iteration Stories',
                'description' => 'List Iteration Stories

Official Shortcut endpoint: GET /api/v3/iterations/{iteration-public-id}/stories.',
                'parameters' => [
                    'iteration_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Iteration.',
                    ],
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Stories with their descriptions.',
                    ],
                ],
            ],
            'shortcut_get_key_result' => [
                'class' => ShortcutGetKeyResult::class,
                'name' => 'Get Key Result',
                'description' => 'Get Key Result

Official Shortcut endpoint: GET /api/v3/key-results/{key-result-public-id}.',
                'parameters' => [
                    'key_result_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Key Result.',
                    ],
                ],
            ],
            'shortcut_update_key_result' => [
                'class' => ShortcutUpdateKeyResult::class,
                'name' => 'Update Key Result',
                'description' => 'Update Key Result

Official Shortcut endpoint: PUT /api/v3/key-results/{key-result-public-id}.',
                'parameters' => [
                    'key_result_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The ID of the Key Result.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_labels' => [
                'class' => ShortcutListLabels::class,
                'name' => 'List Labels',
                'description' => 'List Labels

Official Shortcut endpoint: GET /api/v3/labels.',
                'parameters' => [
                    'slim' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating if the slim versions of the Label should be returned.',
                    ],
                ],
            ],
            'shortcut_create_label' => [
                'class' => ShortcutCreateLabel::class,
                'name' => 'Create Label',
                'description' => 'Create Label

Official Shortcut endpoint: POST /api/v3/labels.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request parameters for creating a Label on a Shortcut Story.',
                    ],
                ],
            ],
            'shortcut_get_label' => [
                'class' => ShortcutGetLabel::class,
                'name' => 'Get Label',
                'description' => 'Get Label

Official Shortcut endpoint: GET /api/v3/labels/{label-public-id}.',
                'parameters' => [
                    'label_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Label.',
                    ],
                ],
            ],
            'shortcut_update_label' => [
                'class' => ShortcutUpdateLabel::class,
                'name' => 'Update Label',
                'description' => 'Update Label

Official Shortcut endpoint: PUT /api/v3/labels/{label-public-id}.',
                'parameters' => [
                    'label_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Label you wish to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_label' => [
                'class' => ShortcutDeleteLabel::class,
                'name' => 'Delete Label',
                'description' => 'Delete Label

Official Shortcut endpoint: DELETE /api/v3/labels/{label-public-id}.',
                'parameters' => [
                    'label_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Label.',
                    ],
                ],
            ],
            'shortcut_list_label_epics' => [
                'class' => ShortcutListLabelEpics::class,
                'name' => 'List Label Epics',
                'description' => 'List Label Epics

Official Shortcut endpoint: GET /api/v3/labels/{label-public-id}/epics.',
                'parameters' => [
                    'label_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Label.',
                    ],
                ],
            ],
            'shortcut_list_label_stories' => [
                'class' => ShortcutListLabelStories::class,
                'name' => 'List Label Stories',
                'description' => 'List Label Stories

Official Shortcut endpoint: GET /api/v3/labels/{label-public-id}/stories.',
                'parameters' => [
                    'label_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Label.',
                    ],
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Stories with their descriptions.',
                    ],
                ],
            ],
            'shortcut_list_linked_files' => [
                'class' => ShortcutListLinkedFiles::class,
                'name' => 'List Linked Files',
                'description' => 'List Linked Files

Official Shortcut endpoint: GET /api/v3/linked-files.',
                'parameters' => [],
            ],
            'shortcut_create_linked_file' => [
                'class' => ShortcutCreateLinkedFile::class,
                'name' => 'Create Linked File',
                'description' => 'Create Linked File

Official Shortcut endpoint: POST /api/v3/linked-files.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_linked_file' => [
                'class' => ShortcutGetLinkedFile::class,
                'name' => 'Get Linked File',
                'description' => 'Get Linked File

Official Shortcut endpoint: GET /api/v3/linked-files/{linked-file-public-id}.',
                'parameters' => [
                    'linked_file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of the linked file.',
                    ],
                ],
            ],
            'shortcut_update_linked_file' => [
                'class' => ShortcutUpdateLinkedFile::class,
                'name' => 'Update Linked File',
                'description' => 'Update Linked File

Official Shortcut endpoint: PUT /api/v3/linked-files/{linked-file-public-id}.',
                'parameters' => [
                    'linked_file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of the linked file.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_linked_file' => [
                'class' => ShortcutDeleteLinkedFile::class,
                'name' => 'Delete Linked File',
                'description' => 'Delete Linked File

Official Shortcut endpoint: DELETE /api/v3/linked-files/{linked-file-public-id}.',
                'parameters' => [
                    'linked_file_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of the linked file.',
                    ],
                ],
            ],
            'shortcut_get_current_member_info' => [
                'class' => ShortcutGetCurrentMemberInfo::class,
                'name' => 'Get Current Member Info',
                'description' => 'Get Current Member Info

Official Shortcut endpoint: GET /api/v3/member.',
                'parameters' => [],
            ],
            'shortcut_list_members' => [
                'class' => ShortcutListMembers::class,
                'name' => 'List Members',
                'description' => 'List Members

Official Shortcut endpoint: GET /api/v3/members.',
                'parameters' => [
                    'org_public_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique ID of the Organization to limit the list to.',
                    ],
                    'disabled' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'Filter members by their disabled state. If true, return only disabled members. If false, return only enabled members.',
                    ],
                ],
            ],
            'shortcut_get_member' => [
                'class' => ShortcutGetMember::class,
                'name' => 'Get Member',
                'description' => 'Get Member

Official Shortcut endpoint: GET /api/v3/members/{member-public-id}.',
                'parameters' => [
                    'member_public_id' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'The Member\'s unique ID.',
                    ],
                    'org_public_id' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The unique ID of the Organization to limit the lookup to.',
                    ],
                ],
            ],
            'shortcut_list_milestones' => [
                'class' => ShortcutListMilestones::class,
                'name' => 'List Milestones',
                'description' => 'List Milestones

Official Shortcut endpoint: GET /api/v3/milestones.',
                'parameters' => [],
            ],
            'shortcut_create_milestone' => [
                'class' => ShortcutCreateMilestone::class,
                'name' => 'Create Milestone',
                'description' => 'Create Milestone

Official Shortcut endpoint: POST /api/v3/milestones.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_milestone' => [
                'class' => ShortcutGetMilestone::class,
                'name' => 'Get Milestone',
                'description' => 'Get Milestone

Official Shortcut endpoint: GET /api/v3/milestones/{milestone-public-id}.',
                'parameters' => [
                    'milestone_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Milestone.',
                    ],
                ],
            ],
            'shortcut_update_milestone' => [
                'class' => ShortcutUpdateMilestone::class,
                'name' => 'Update Milestone',
                'description' => 'Update Milestone

Official Shortcut endpoint: PUT /api/v3/milestones/{milestone-public-id}.',
                'parameters' => [
                    'milestone_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Milestone.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_milestone' => [
                'class' => ShortcutDeleteMilestone::class,
                'name' => 'Delete Milestone',
                'description' => 'Delete Milestone

Official Shortcut endpoint: DELETE /api/v3/milestones/{milestone-public-id}.',
                'parameters' => [
                    'milestone_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Milestone.',
                    ],
                ],
            ],
            'shortcut_list_milestone_epics' => [
                'class' => ShortcutListMilestoneEpics::class,
                'name' => 'List Milestone Epics',
                'description' => 'List Milestone Epics

Official Shortcut endpoint: GET /api/v3/milestones/{milestone-public-id}/epics.',
                'parameters' => [
                    'milestone_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Milestone.',
                    ],
                ],
            ],
            'shortcut_list_objectives' => [
                'class' => ShortcutListObjectives::class,
                'name' => 'List Objectives',
                'description' => 'List Objectives

Official Shortcut endpoint: GET /api/v3/objectives.',
                'parameters' => [],
            ],
            'shortcut_create_objective' => [
                'class' => ShortcutCreateObjective::class,
                'name' => 'Create Objective',
                'description' => 'Create Objective

Official Shortcut endpoint: POST /api/v3/objectives.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_objective' => [
                'class' => ShortcutGetObjective::class,
                'name' => 'Get Objective',
                'description' => 'Get Objective

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Objective.',
                    ],
                ],
            ],
            'shortcut_update_objective' => [
                'class' => ShortcutUpdateObjective::class,
                'name' => 'Update Objective',
                'description' => 'Update Objective

Official Shortcut endpoint: PUT /api/v3/objectives/{objective-public-id}.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Objective.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_objective' => [
                'class' => ShortcutDeleteObjective::class,
                'name' => 'Delete Objective',
                'description' => 'Delete Objective

Official Shortcut endpoint: DELETE /api/v3/objectives/{objective-public-id}.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Objective.',
                    ],
                ],
            ],
            'shortcut_list_objective_epics' => [
                'class' => ShortcutListObjectiveEpics::class,
                'name' => 'List Objective Epics',
                'description' => 'List Objective Epics

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}/epics.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Objective.',
                    ],
                ],
            ],
            'shortcut_get_objective_health' => [
                'class' => ShortcutGetObjectiveHealth::class,
                'name' => 'Get Objective Health',
                'description' => 'Get Objective Health

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}/health.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Objective.',
                    ],
                ],
            ],
            'shortcut_create_objective_health' => [
                'class' => ShortcutCreateObjectiveHealth::class,
                'name' => 'Create Objective Health',
                'description' => 'Create Objective Health

Official Shortcut endpoint: POST /api/v3/objectives/{objective-public-id}/health.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Objective.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_list_objective_healths' => [
                'class' => ShortcutListObjectiveHealths::class,
                'name' => 'List Objective Healths',
                'description' => 'List Objective Healths

Official Shortcut endpoint: GET /api/v3/objectives/{objective-public-id}/health-history.',
                'parameters' => [
                    'objective_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Objective.',
                    ],
                ],
            ],
            'shortcut_list_projects' => [
                'class' => ShortcutListProjects::class,
                'name' => 'List Projects',
                'description' => 'List Projects

Official Shortcut endpoint: GET /api/v3/projects.',
                'parameters' => [],
            ],
            'shortcut_create_project' => [
                'class' => ShortcutCreateProject::class,
                'name' => 'Create Project',
                'description' => 'Create Project

Official Shortcut endpoint: POST /api/v3/projects.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_project' => [
                'class' => ShortcutGetProject::class,
                'name' => 'Get Project',
                'description' => 'Get Project

Official Shortcut endpoint: GET /api/v3/projects/{project-public-id}.',
                'parameters' => [
                    'project_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Project.',
                    ],
                ],
            ],
            'shortcut_update_project' => [
                'class' => ShortcutUpdateProject::class,
                'name' => 'Update Project',
                'description' => 'Update Project

Official Shortcut endpoint: PUT /api/v3/projects/{project-public-id}.',
                'parameters' => [
                    'project_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Project.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_project' => [
                'class' => ShortcutDeleteProject::class,
                'name' => 'Delete Project',
                'description' => 'Delete Project

Official Shortcut endpoint: DELETE /api/v3/projects/{project-public-id}.',
                'parameters' => [
                    'project_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Project.',
                    ],
                ],
            ],
            'shortcut_list_stories' => [
                'class' => ShortcutListStories::class,
                'name' => 'List Stories',
                'description' => 'List Stories

Official Shortcut endpoint: GET /api/v3/projects/{project-public-id}/stories.',
                'parameters' => [
                    'project_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Project.',
                    ],
                    'includes_description' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'A true/false boolean indicating whether to return Stories with their descriptions.',
                    ],
                ],
            ],
            'shortcut_list_repositories' => [
                'class' => ShortcutListRepositories::class,
                'name' => 'List Repositories',
                'description' => 'List Repositories

Official Shortcut endpoint: GET /api/v3/repositories.',
                'parameters' => [],
            ],
            'shortcut_get_repository' => [
                'class' => ShortcutGetRepository::class,
                'name' => 'Get Repository',
                'description' => 'Get Repository

Official Shortcut endpoint: GET /api/v3/repositories/{repo-public-id}.',
                'parameters' => [
                    'repo_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Repository.',
                    ],
                ],
            ],
            'shortcut_search' => [
                'class' => ShortcutSearch::class,
                'name' => 'Search',
                'description' => 'Search

Official Shortcut endpoint: GET /api/v3/search.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_search_documents' => [
                'class' => ShortcutSearchDocuments::class,
                'name' => 'Search Documents',
                'description' => 'Search Documents

Official Shortcut endpoint: GET /api/v3/search/documents.',
                'parameters' => [
                    'title' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'Search text to match against document titles. Supports fuzzy matching. Required.',
                    ],
                    'archived' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'When true, find archived documents. When false, find non-archived documents.',
                    ],
                    'created_by_me' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'When true, find documents created by the current user. When false, find documents NOT created by current user.',
                    ],
                    'followed_by_me' => [
                        'type' => 'boolean',
                        'required' => false,
                        'description' => 'When true, find documents that the current user is following. When false, find documents NOT followed.',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                ],
            ],
            'shortcut_search_epics' => [
                'class' => ShortcutSearchEpics::class,
                'name' => 'Search Epics',
                'description' => 'Search Epics

Official Shortcut endpoint: GET /api/v3/search/epics.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_search_iterations' => [
                'class' => ShortcutSearchIterations::class,
                'name' => 'Search Iterations',
                'description' => 'Search Iterations

Official Shortcut endpoint: GET /api/v3/search/iterations.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_search_milestones' => [
                'class' => ShortcutSearchMilestones::class,
                'name' => 'Search Milestones',
                'description' => 'Search Milestones

Official Shortcut endpoint: GET /api/v3/search/milestones.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_search_objectives' => [
                'class' => ShortcutSearchObjectives::class,
                'name' => 'Search Objectives',
                'description' => 'Search Objectives

Official Shortcut endpoint: GET /api/v3/search/objectives.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_search_stories' => [
                'class' => ShortcutSearchStories::class,
                'name' => 'Search Stories',
                'description' => 'Search Stories

Official Shortcut endpoint: GET /api/v3/search/stories.',
                'parameters' => [
                    'query' => [
                        'type' => 'string',
                        'required' => true,
                        'description' => 'See our help center article on [search operators](https://help.shortcut.com/hc/en-us/articles/360000046646-Search-Operators)',
                    ],
                    'page_size' => [
                        'type' => 'integer',
                        'required' => false,
                        'description' => 'The number of search results to include in a page. Minimum of 1 and maximum of 250.',
                    ],
                    'detail' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The amount of detail included in each result item. "full" will include all descriptions and comments and more fields on related items such as pull requests, branches and tasks. "slim" omits larger fulltext fields such as descriptions and comments and only references related items by id. The default is "full".',
                        'enum' => [
                            'full',
                            'slim',
                        ],
                    ],
                    'next' => [
                        'type' => 'string',
                        'required' => false,
                        'description' => 'The next page token.',
                    ],
                    'entity_types' => [
                        'type' => 'array',
                        'required' => false,
                        'description' => 'A collection of entity_types to search. Defaults to story and epic. Supports: epic, iteration, objective, story.',
                        'items' => [
                            'type' => 'string',
                        ],
                    ],
                ],
            ],
            'shortcut_create_story' => [
                'class' => ShortcutCreateStory::class,
                'name' => 'Create Story',
                'description' => 'Create Story

Official Shortcut endpoint: POST /api/v3/stories.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request parameters for creating a story.',
                    ],
                ],
            ],
            'shortcut_create_multiple_stories' => [
                'class' => ShortcutCreateMultipleStories::class,
                'name' => 'Create Multiple Stories',
                'description' => 'Create Multiple Stories

Official Shortcut endpoint: POST /api/v3/stories/bulk.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_update_multiple_stories' => [
                'class' => ShortcutUpdateMultipleStories::class,
                'name' => 'Update Multiple Stories',
                'description' => 'Update Multiple Stories

Official Shortcut endpoint: PUT /api/v3/stories/bulk.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_multiple_stories' => [
                'class' => ShortcutDeleteMultipleStories::class,
                'name' => 'Delete Multiple Stories',
                'description' => 'Delete Multiple Stories

Official Shortcut endpoint: DELETE /api/v3/stories/bulk.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_create_story_from_template' => [
                'class' => ShortcutCreateStoryFromTemplate::class,
                'name' => 'Create Story From Template',
                'description' => 'Create Story From Template

Official Shortcut endpoint: POST /api/v3/stories/from-template.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request parameters for creating a story from a story template. These parameters are merged with the values derived from the template.',
                    ],
                ],
            ],
            'shortcut_query_stories' => [
                'class' => ShortcutQueryStories::class,
                'name' => 'Query Stories',
                'description' => 'Query Stories

Official Shortcut endpoint: POST /api/v3/stories/search.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_story' => [
                'class' => ShortcutGetStory::class,
                'name' => 'Get Story',
                'description' => 'Get Story

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story.',
                    ],
                ],
            ],
            'shortcut_update_story' => [
                'class' => ShortcutUpdateStory::class,
                'name' => 'Update Story',
                'description' => 'Update Story

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of this story.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_story' => [
                'class' => ShortcutDeleteStory::class,
                'name' => 'Delete Story',
                'description' => 'Delete Story

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story.',
                    ],
                ],
            ],
            'shortcut_list_story_comment' => [
                'class' => ShortcutListStoryComment::class,
                'name' => 'List Story Comment',
                'description' => 'List Story Comment

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/comments.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                ],
            ],
            'shortcut_create_story_comment' => [
                'class' => ShortcutCreateStoryComment::class,
                'name' => 'Create Story Comment',
                'description' => 'Create Story Comment

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/comments.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_story_comment' => [
                'class' => ShortcutGetStoryComment::class,
                'name' => 'Get Story Comment',
                'description' => 'Get Story Comment

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                ],
            ],
            'shortcut_update_story_comment' => [
                'class' => ShortcutUpdateStoryComment::class,
                'name' => 'Update Story Comment',
                'description' => 'Update Story Comment

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_story_comment' => [
                'class' => ShortcutDeleteStoryComment::class,
                'name' => 'Delete Story Comment',
                'description' => 'Delete Story Comment

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}/comments/{comment-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                ],
            ],
            'shortcut_create_story_reaction' => [
                'class' => ShortcutCreateStoryReaction::class,
                'name' => 'Create Story Reaction',
                'description' => 'Create Story Reaction

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/comments/{comment-public-id}/reactions.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_story_reaction' => [
                'class' => ShortcutDeleteStoryReaction::class,
                'name' => 'Delete Story Reaction',
                'description' => 'Delete Story Reaction

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}/comments/{comment-public-id}/reactions.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Comment is in.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_unlink_comment_thread_from_slack' => [
                'class' => ShortcutUnlinkCommentThreadFromSlack::class,
                'name' => 'Unlink Comment Thread From Slack',
                'description' => 'Unlink Comment thread from Slack

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/comments/{comment-public-id}/unlink-from-slack.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story to unlink.',
                    ],
                    'comment_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Comment to unlink.',
                    ],
                ],
            ],
            'shortcut_story_history' => [
                'class' => ShortcutStoryHistory::class,
                'name' => 'Story History',
                'description' => 'Story History

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/history.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story.',
                    ],
                ],
            ],
            'shortcut_list_story_sub_tasks' => [
                'class' => ShortcutListStorySubTasks::class,
                'name' => 'List Story Sub Tasks',
                'description' => 'List Story Sub tasks

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/sub-tasks.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story.',
                    ],
                ],
            ],
            'shortcut_create_task' => [
                'class' => ShortcutCreateTask::class,
                'name' => 'Create Task',
                'description' => 'Create Task

Official Shortcut endpoint: POST /api/v3/stories/{story-public-id}/tasks.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Story that the Task will be in.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_task' => [
                'class' => ShortcutGetTask::class,
                'name' => 'Get Task',
                'description' => 'Get Task

Official Shortcut endpoint: GET /api/v3/stories/{story-public-id}/tasks/{task-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Story this Task is associated with.',
                    ],
                    'task_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Task.',
                    ],
                ],
            ],
            'shortcut_update_task' => [
                'class' => ShortcutUpdateTask::class,
                'name' => 'Update Task',
                'description' => 'Update Task

Official Shortcut endpoint: PUT /api/v3/stories/{story-public-id}/tasks/{task-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of the parent Story.',
                    ],
                    'task_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique identifier of the Task you wish to update.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_task' => [
                'class' => ShortcutDeleteTask::class,
                'name' => 'Delete Task',
                'description' => 'Delete Task

Official Shortcut endpoint: DELETE /api/v3/stories/{story-public-id}/tasks/{task-public-id}.',
                'parameters' => [
                    'story_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Story this Task is associated with.',
                    ],
                    'task_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Task.',
                    ],
                ],
            ],
            'shortcut_create_story_link' => [
                'class' => ShortcutCreateStoryLink::class,
                'name' => 'Create Story Link',
                'description' => 'Create Story Link

Official Shortcut endpoint: POST /api/v3/story-links.',
                'parameters' => [
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_get_story_link' => [
                'class' => ShortcutGetStoryLink::class,
                'name' => 'Get Story Link',
                'description' => 'Get Story Link

Official Shortcut endpoint: GET /api/v3/story-links/{story-link-public-id}.',
                'parameters' => [
                    'story_link_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Story Link.',
                    ],
                ],
            ],
            'shortcut_update_story_link' => [
                'class' => ShortcutUpdateStoryLink::class,
                'name' => 'Update Story Link',
                'description' => 'Update Story Link

Official Shortcut endpoint: PUT /api/v3/story-links/{story-link-public-id}.',
                'parameters' => [
                    'story_link_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Story Link.',
                    ],
                    'body' => [
                        'type' => 'object',
                        'required' => true,
                        'description' => 'Request body matching the official Shortcut API schema.',
                    ],
                ],
            ],
            'shortcut_delete_story_link' => [
                'class' => ShortcutDeleteStoryLink::class,
                'name' => 'Delete Story Link',
                'description' => 'Delete Story Link

Official Shortcut endpoint: DELETE /api/v3/story-links/{story-link-public-id}.',
                'parameters' => [
                    'story_link_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The unique ID of the Story Link.',
                    ],
                ],
            ],
            'shortcut_list_workflows' => [
                'class' => ShortcutListWorkflows::class,
                'name' => 'List Workflows',
                'description' => 'List Workflows

Official Shortcut endpoint: GET /api/v3/workflows.',
                'parameters' => [],
            ],
            'shortcut_get_workflow' => [
                'class' => ShortcutGetWorkflow::class,
                'name' => 'Get Workflow',
                'description' => 'Get Workflow

Official Shortcut endpoint: GET /api/v3/workflows/{workflow-public-id}.',
                'parameters' => [
                    'workflow_public_id' => [
                        'type' => 'integer',
                        'required' => true,
                        'description' => 'The ID of the Workflow.',
                    ],
                ],
            ],
        ];
    }

    /**
     * Create an endpoint tool instance.
     *
     * @param  array<string, mixed>  $context  Runtime account context.
     */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the Shortcut client for the default or selected account.
     *
     * @param  array<string, mixed>  $context  Runtime account context.
     */
    private function resolveService(array $context = []): ShortcutService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new ShortcutService(apiKey: $creds->get('shortcut', 'api_key', '', $account), baseUrl: $creds->get('shortcut', 'url', 'https://api.app.shortcut.com', $account));
        }

        return app(ShortcutService::class);
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/shortcut.md';
    }

    public function isIntegration(): bool
    {
        return true;
    }
}
