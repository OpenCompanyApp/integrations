<?php

namespace OpenCompany\Integrations\Plane;

use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\CredentialResolver;
use OpenCompany\IntegrationCore\Contracts\HasTriggers;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\IntegrationCore\Contracts\Trigger;
use OpenCompany\Integrations\Plane\Tools\PlaneAddIssueToCycle;
use OpenCompany\Integrations\Plane\Tools\PlaneAddIssueToModule;
use OpenCompany\Integrations\Plane\Tools\PlaneArchiveProject;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateComment;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateCycle;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateIssue;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateIssueLink;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateLabel;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateModule;
use OpenCompany\Integrations\Plane\Tools\PlaneCreatePage;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateProject;
use OpenCompany\Integrations\Plane\Tools\PlaneCreateState;
use OpenCompany\Integrations\Plane\Tools\PlaneDeleteIssue;
use OpenCompany\Integrations\Plane\Tools\PlaneGetCurrentUser;
use OpenCompany\Integrations\Plane\Tools\PlaneGetCycle;
use OpenCompany\Integrations\Plane\Tools\PlaneGetIssue;
use OpenCompany\Integrations\Plane\Tools\PlaneGetModule;
use OpenCompany\Integrations\Plane\Tools\PlaneGetPage;
use OpenCompany\Integrations\Plane\Tools\PlaneGetProject;
use OpenCompany\Integrations\Plane\Tools\PlaneListComments;
use OpenCompany\Integrations\Plane\Tools\PlaneListCycles;
use OpenCompany\Integrations\Plane\Tools\PlaneListIssueActivities;
use OpenCompany\Integrations\Plane\Tools\PlaneListIssueRelations;
use OpenCompany\Integrations\Plane\Tools\PlaneListIssues;
use OpenCompany\Integrations\Plane\Tools\PlaneListLabels;
use OpenCompany\Integrations\Plane\Tools\PlaneListMembers;
use OpenCompany\Integrations\Plane\Tools\PlaneListModules;
use OpenCompany\Integrations\Plane\Tools\PlaneListPages;
use OpenCompany\Integrations\Plane\Tools\PlaneListProjects;
use OpenCompany\Integrations\Plane\Tools\PlaneListStates;
use OpenCompany\Integrations\Plane\Tools\PlaneListWorkspaces;
use OpenCompany\Integrations\Plane\Tools\PlaneSearchIssues;
use OpenCompany\Integrations\Plane\Tools\PlaneUpdateIssue;
use OpenCompany\Integrations\Plane\Triggers\PlaneWebhookTrigger;

/**
 * Tool provider for the Plane.so project management integration.
 *
 * Registers 34 tools and 1 webhook trigger for managing workspaces, projects, issues,
 * cycles, modules, pages, states, labels, members, and more.
 * Supports multi-account via ConfigurableIntegration.
 */
class PlaneToolProvider implements ConfigurableIntegration, HasTriggers, ToolProvider
{
    public function appName(): string
    {
        return 'plane';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'workspaces, projects, issues, cycles, modules, pages',
            'description' => 'Project management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:plane',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Plane',
            'description' => 'Open-source project management tool — issues, cycles, modules, pages, and more',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:plane',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developers.plane.so/api-reference/introduction',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'secret',
                'label' => 'API Key',
                'placeholder' => 'Enter your Plane.so API key',
                'hint' => 'Generate an API token in your Plane profile under "API Tokens"',
                'required' => true,
            ],
            [
                'key' => 'url',
                'type' => 'url',
                'label' => 'API Base URL',
                'placeholder' => 'https://api.plane.so',
                'hint' => 'Use the Plane site origin only, for example <code>https://api.plane.so</code> or <code>https://plane.example.com</code>. Do not include a workspace slug or <code>/api</code> path.',
                'default' => 'https://api.plane.so',
            ],
            [
                'key' => 'workspace_slug',
                'type' => 'text',
                'label' => 'Default Workspace Slug',
                'placeholder' => 'kosmokrator',
                'hint' => 'Recommended for self-hosted Plane. If omitted, the integration will try to infer the workspace slug from older URLs like <code>https://plane.example.com/kosmokrator</code>.',
            ],
        ];
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $rawBaseUrl = (string) ($config['url'] ?? 'https://api.plane.so');
        $baseUrl = PlaneService::normalizeBaseUrl($rawBaseUrl);
        $workspaceSlug = PlaneService::normalizeWorkspaceSlug((string) ($config['workspace_slug'] ?? ''))
            ?? PlaneService::inferWorkspaceSlugFromUrl($rawBaseUrl);

        if (empty($apiKey)) {
            return ['success' => false, 'error' => 'No API key provided'];
        }

        if ($workspaceSlug === null) {
            return ['success' => false, 'error' => 'Workspace slug is required. Set a default workspace slug or use a legacy URL that includes it.'];
        }

        try {
            $service = new PlaneService(
                apiKey: (string) $apiKey,
                baseUrl: $baseUrl,
                workspaceSlug: $workspaceSlug,
            );
            $projects = $service->listProjects($workspaceSlug, ['limit' => 1]);
            $count = is_array($projects) ? count($projects) : 0;

            return [
                'success' => true,
                'message' => "Connected to Plane.so workspace '{$workspaceSlug}' — {$count} project(s) reachable.",
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function validationRules(): array
    {
        return [
            'api_key' => 'nullable|string',
            'url' => 'nullable|url',
            'workspace_slug' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Workspaces
            'plane_list_workspaces' => [
                'class' => PlaneListWorkspaces::class,
                'type' => 'read',
                'name' => 'List Workspaces',
                'description' => 'List Plane.so workspaces.',
                'icon' => 'ph:buildings',
            ],
            // Projects
            'plane_list_projects' => [
                'class' => PlaneListProjects::class,
                'type' => 'read',
                'name' => 'List Projects',
                'description' => 'List projects in a workspace.',
                'icon' => 'ph:folder',
            ],
            'plane_get_project' => [
                'class' => PlaneGetProject::class,
                'type' => 'read',
                'name' => 'Get Project',
                'description' => 'Get project details.',
                'icon' => 'ph:folder-open',
            ],
            'plane_create_project' => [
                'class' => PlaneCreateProject::class,
                'type' => 'write',
                'name' => 'Create Project',
                'description' => 'Create a new project.',
                'icon' => 'ph:folder-plus',
            ],
            'plane_archive_project' => [
                'class' => PlaneArchiveProject::class,
                'type' => 'write',
                'name' => 'Archive Project',
                'description' => 'Archive a project.',
                'icon' => 'ph:archive',
            ],
            // Issues
            'plane_list_issues' => [
                'class' => PlaneListIssues::class,
                'type' => 'read',
                'name' => 'List Issues',
                'description' => 'List issues in a project.',
                'icon' => 'ph:list-checks',
            ],
            'plane_search_issues' => [
                'class' => PlaneSearchIssues::class,
                'type' => 'read',
                'name' => 'Search Issues',
                'description' => 'Search issues across a workspace.',
                'icon' => 'ph:magnifying-glass',
            ],
            'plane_get_issue' => [
                'class' => PlaneGetIssue::class,
                'type' => 'read',
                'name' => 'Get Issue',
                'description' => 'Get a single issue by ID.',
                'icon' => 'ph:eye',
            ],
            'plane_create_issue' => [
                'class' => PlaneCreateIssue::class,
                'type' => 'write',
                'name' => 'Create Issue',
                'description' => 'Create a new issue in a project.',
                'icon' => 'ph:plus-circle',
            ],
            'plane_update_issue' => [
                'class' => PlaneUpdateIssue::class,
                'type' => 'write',
                'name' => 'Update Issue',
                'description' => 'Update an existing issue.',
                'icon' => 'ph:pencil-simple',
            ],
            'plane_delete_issue' => [
                'class' => PlaneDeleteIssue::class,
                'type' => 'write',
                'name' => 'Delete Issue',
                'description' => 'Delete an issue.',
                'icon' => 'ph:trash',
            ],
            // Comments
            'plane_create_comment' => [
                'class' => PlaneCreateComment::class,
                'type' => 'write',
                'name' => 'Create Comment',
                'description' => 'Add a comment to an issue.',
                'icon' => 'ph:chat-circle-text',
            ],
            'plane_list_comments' => [
                'class' => PlaneListComments::class,
                'type' => 'read',
                'name' => 'List Comments',
                'description' => 'List comments on an issue.',
                'icon' => 'ph:chat-circle-dots',
            ],
            // Cycles
            'plane_list_cycles' => [
                'class' => PlaneListCycles::class,
                'type' => 'read',
                'name' => 'List Cycles',
                'description' => 'List cycles in a project.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'plane_get_cycle' => [
                'class' => PlaneGetCycle::class,
                'type' => 'read',
                'name' => 'Get Cycle',
                'description' => 'Get cycle details.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'plane_create_cycle' => [
                'class' => PlaneCreateCycle::class,
                'type' => 'write',
                'name' => 'Create Cycle',
                'description' => 'Create a new cycle.',
                'icon' => 'ph:arrows-clockwise',
            ],
            'plane_add_issue_to_cycle' => [
                'class' => PlaneAddIssueToCycle::class,
                'type' => 'write',
                'name' => 'Add Issue to Cycle',
                'description' => 'Add an issue to a cycle.',
                'icon' => 'ph:arrows-clockwise',
            ],
            // Modules
            'plane_list_modules' => [
                'class' => PlaneListModules::class,
                'type' => 'read',
                'name' => 'List Modules',
                'description' => 'List modules in a project.',
                'icon' => 'ph:squares-four',
            ],
            'plane_get_module' => [
                'class' => PlaneGetModule::class,
                'type' => 'read',
                'name' => 'Get Module',
                'description' => 'Get module details.',
                'icon' => 'ph:squares-four',
            ],
            'plane_create_module' => [
                'class' => PlaneCreateModule::class,
                'type' => 'write',
                'name' => 'Create Module',
                'description' => 'Create a new module.',
                'icon' => 'ph:squares-four',
            ],
            'plane_add_issue_to_module' => [
                'class' => PlaneAddIssueToModule::class,
                'type' => 'write',
                'name' => 'Add Issue to Module',
                'description' => 'Add an issue to a module.',
                'icon' => 'ph:squares-four',
            ],
            // States & Labels
            'plane_list_states' => [
                'class' => PlaneListStates::class,
                'type' => 'read',
                'name' => 'List States',
                'description' => 'List workflow states in a project.',
                'icon' => 'ph:funnel',
            ],
            'plane_create_state' => [
                'class' => PlaneCreateState::class,
                'type' => 'write',
                'name' => 'Create State',
                'description' => 'Create a workflow state.',
                'icon' => 'ph:funnel',
            ],
            'plane_list_labels' => [
                'class' => PlaneListLabels::class,
                'type' => 'read',
                'name' => 'List Labels',
                'description' => 'List labels in a project.',
                'icon' => 'ph:tag',
            ],
            'plane_create_label' => [
                'class' => PlaneCreateLabel::class,
                'type' => 'write',
                'name' => 'Create Label',
                'description' => 'Create a label.',
                'icon' => 'ph:tag',
            ],
            // Pages
            'plane_list_pages' => [
                'class' => PlaneListPages::class,
                'type' => 'read',
                'name' => 'List Pages',
                'description' => 'List pages in a project.',
                'icon' => 'ph:notebook',
            ],
            'plane_get_page' => [
                'class' => PlaneGetPage::class,
                'type' => 'read',
                'name' => 'Get Page',
                'description' => 'Get page content.',
                'icon' => 'ph:notebook',
            ],
            'plane_create_page' => [
                'class' => PlaneCreatePage::class,
                'type' => 'write',
                'name' => 'Create Page',
                'description' => 'Create a page.',
                'icon' => 'ph:notebook',
            ],
            // Issue extras
            'plane_list_issue_activities' => [
                'class' => PlaneListIssueActivities::class,
                'type' => 'read',
                'name' => 'List Issue Activities',
                'description' => 'List activity/audit log for an issue.',
                'icon' => 'ph:clock-counter-clockwise',
            ],
            'plane_create_issue_link' => [
                'class' => PlaneCreateIssueLink::class,
                'type' => 'write',
                'name' => 'Create Issue Link',
                'description' => 'Attach an external link to an issue.',
                'icon' => 'ph:link',
            ],
            'plane_list_issue_relations' => [
                'class' => PlaneListIssueRelations::class,
                'type' => 'read',
                'name' => 'List Issue Relations',
                'description' => 'List relations (blocking, duplicate, etc.) on an issue.',
                'icon' => 'ph:arrows-split',
            ],
            // Members & User
            'plane_list_members' => [
                'class' => PlaneListMembers::class,
                'type' => 'read',
                'name' => 'List Members',
                'description' => 'List members of a workspace or project.',
                'icon' => 'ph:users',
            ],
            'plane_get_current_user' => [
                'class' => PlaneGetCurrentUser::class,
                'type' => 'read',
                'name' => 'Get Current User',
                'description' => 'Get the authenticated user profile.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function triggers(): array
    {
        return [
            'plane_webhook' => [
                'class' => PlaneWebhookTrigger::class,
                'name' => 'Plane Webhook',
                'description' => 'Receive Plane.so workspace events via webhook.',
                'icon' => 'ph:webhooks-logo',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__.'/../lua-docs/plane.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'secret', 'label' => 'API Key', 'required' => true],
            ['key' => 'url', 'type' => 'url', 'label' => 'API Base URL', 'required' => false, 'default' => 'https://api.plane.so'],
            ['key' => 'workspace_slug', 'type' => 'string', 'label' => 'Default Workspace Slug', 'required' => false],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    public function createTool(string $class, array $context = []): Tool
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            $service = new PlaneService(
                apiKey: $creds->get('plane', 'api_key', '', $account),
                baseUrl: $creds->get('plane', 'url', 'https://api.plane.so', $account),
                workspaceSlug: $creds->get('plane', 'workspace_slug', null, $account),
            );

            return new $class($service);
        }

        return new $class(app(PlaneService::class));
    }

    public function createTrigger(string $class, array $context = []): Trigger
    {
        return new $class($this->resolveService($context));
    }

    private function resolveService(array $context = []): PlaneService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(CredentialResolver::class);

            return new PlaneService(
                apiKey: $creds->get('plane', 'api_key', '', $account),
                baseUrl: $creds->get('plane', 'url', 'https://api.plane.so', $account),
                workspaceSlug: $creds->get('plane', 'workspace_slug', null, $account),
            );
        }

        return app(PlaneService::class);
    }
}
