<?php

namespace OpenCompany\Integrations\Trello;

use Illuminate\Support\Facades\Http;
use OpenCompany\IntegrationCore\Contracts\ConfigurableIntegration;
use OpenCompany\IntegrationCore\Contracts\Tool;
use OpenCompany\IntegrationCore\Contracts\ToolProvider;
use OpenCompany\Integrations\Trello\Tools\TrelloAddComment;
use OpenCompany\Integrations\Trello\Tools\TrelloAddLabelToCard;
use OpenCompany\Integrations\Trello\Tools\TrelloAddMemberToCard;
use OpenCompany\Integrations\Trello\Tools\TrelloArchiveCard;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateBoard;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateCard;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateChecklist;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateChecklistItem;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateLabel;
use OpenCompany\Integrations\Trello\Tools\TrelloCreateList;
use OpenCompany\Integrations\Trello\Tools\TrelloDeleteCard;
use OpenCompany\Integrations\Trello\Tools\TrelloGetBoard;
use OpenCompany\Integrations\Trello\Tools\TrelloGetBoardLists;
use OpenCompany\Integrations\Trello\Tools\TrelloGetBoardMembers;
use OpenCompany\Integrations\Trello\Tools\TrelloGetCard;
use OpenCompany\Integrations\Trello\Tools\TrelloGetCardsInList;
use OpenCompany\Integrations\Trello\Tools\TrelloGetCurrentMember;
use OpenCompany\Integrations\Trello\Tools\TrelloGetList;
use OpenCompany\Integrations\Trello\Tools\TrelloGetMember;
use OpenCompany\Integrations\Trello\Tools\TrelloListBoards;
use OpenCompany\Integrations\Trello\Tools\TrelloMoveCard;
use OpenCompany\Integrations\Trello\Tools\TrelloRemoveLabelFromCard;
use OpenCompany\Integrations\Trello\Tools\TrelloSearchCards;
use OpenCompany\Integrations\Trello\Tools\TrelloUpdateCard;
use OpenCompany\Integrations\Trello\Tools\TrelloUpdateList;

/**
 * Registers all Trello tools and provides integration metadata.
 *
 * Exposes 25 tools covering boards, lists, cards, labels,
 * members, checklists, and comments via the ToolProvider contract.
 */
class TrelloToolProvider implements ToolProvider, ConfigurableIntegration
{
    public function appName(): string
    {
        return 'trello';
    }

    public function appMeta(): array
    {
        return [
            'label' => 'boards, lists, cards, labels, members',
            'description' => 'Project Management',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:trello',
        ];
    }

    public function integrationMeta(): array
    {
        return [
            'name' => 'Trello',
            'description' => 'Boards, lists, cards, labels, members, and checklists',
            'icon' => 'ph:kanban',
            'logo' => 'simple-icons:trello',
            'category' => 'productivity',
            'badge' => 'verified',
            'docs_url' => 'https://developer.atlassian.com/cloud/trello/rest/',
        ];
    }

    public function configSchema(): array
    {
        return [
            [
                'key' => 'api_key',
                'type' => 'text',
                'label' => 'API Key',
                'placeholder' => 'Your Trello API key',
                'hint' => 'Found at <code>https://trello.com/app-key</code>.',
                'required' => true,
            ],
            [
                'key' => 'api_token',
                'type' => 'secret',
                'label' => 'API Token',
                'placeholder' => 'Your Trello API token',
                'hint' => 'Generate a token at <code>https://trello.com/app-key</code> under "Token".',
                'required' => true,
            ],
        ];
    }

    /**
     * Test the Trello connection using the provided credentials.
     *
     * @param  array<string, mixed>  $config  Configuration containing 'api_key' and 'api_token'
     * @return array{success: bool, message?: string, error?: string}
     */
    public function testConnection(array $config): array
    {
        $apiKey = $config['api_key'] ?? '';
        $apiToken = $config['api_token'] ?? '';

        if (empty($apiKey) || empty($apiToken)) {
            return ['success' => false, 'error' => 'Both API Key and API Token are required.'];
        }

        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
            ])->timeout(10)->get('https://api.trello.com/1/members/me', [
                'key' => $apiKey,
                'token' => $apiToken,
            ]);

            if ($response->successful()) {
                $body = $response->json() ?? [];
                $username = $body['username'] ?? 'Unknown';
                $fullName = $body['fullName'] ?? 'Unknown';

                return [
                    'success' => true,
                    'message' => "Connected to Trello as {$fullName} (@{$username}).",
                ];
            }

            return [
                'success' => false,
                'error' => 'Trello API error (' . $response->status() . '): ' . $response->body(),
            ];
        } catch (\Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    /** @return array<string, string> */
    public function validationRules(): array
    {
        return [
            'api_key'   => 'nullable|string',
            'api_token' => 'nullable|string',
        ];
    }

    public function tools(): array
    {
        return [
            // Cards
            'trello_create_card' => [
                'class' => TrelloCreateCard::class,
                'type' => 'write',
                'name' => 'Create Card',
                'description' => 'Create a new card on a Trello list.',
                'icon' => 'ph:plus-card',
            ],
            'trello_get_card' => [
                'class' => TrelloGetCard::class,
                'type' => 'read',
                'name' => 'Get Card',
                'description' => 'Get detailed information about a Trello card.',
                'icon' => 'ph:card',
            ],
            'trello_update_card' => [
                'class' => TrelloUpdateCard::class,
                'type' => 'write',
                'name' => 'Update Card',
                'description' => 'Update an existing Trello card.',
                'icon' => 'ph:pencil-simple',
            ],
            'trello_delete_card' => [
                'class' => TrelloDeleteCard::class,
                'type' => 'write',
                'name' => 'Delete Card',
                'description' => 'Delete a Trello card permanently.',
                'icon' => 'ph:trash',
            ],
            'trello_move_card' => [
                'class' => TrelloMoveCard::class,
                'type' => 'write',
                'name' => 'Move Card',
                'description' => 'Move a card to a different list.',
                'icon' => 'ph:arrows-out-card',
            ],
            'trello_archive_card' => [
                'class' => TrelloArchiveCard::class,
                'type' => 'write',
                'name' => 'Archive Card',
                'description' => 'Archive a Trello card.',
                'icon' => 'ph:archive',
            ],
            'trello_get_cards_in_list' => [
                'class' => TrelloGetCardsInList::class,
                'type' => 'read',
                'name' => 'Get Cards in List',
                'description' => 'List all cards in a Trello list.',
                'icon' => 'ph:list-cards',
            ],
            'trello_search_cards' => [
                'class' => TrelloSearchCards::class,
                'type' => 'read',
                'name' => 'Search Cards',
                'description' => 'Search for cards across Trello boards.',
                'icon' => 'ph:magnifying-glass',
            ],
            // Boards
            'trello_create_board' => [
                'class' => TrelloCreateBoard::class,
                'type' => 'write',
                'name' => 'Create Board',
                'description' => 'Create a new Trello board.',
                'icon' => 'ph:square',
            ],
            'trello_get_board' => [
                'class' => TrelloGetBoard::class,
                'type' => 'read',
                'name' => 'Get Board',
                'description' => 'Get detailed information about a Trello board.',
                'icon' => 'ph:square-half',
            ],
            'trello_list_boards' => [
                'class' => TrelloListBoards::class,
                'type' => 'read',
                'name' => 'List Boards',
                'description' => 'List all boards for the authenticated member.',
                'icon' => 'ph:squares-four',
            ],
            'trello_get_board_lists' => [
                'class' => TrelloGetBoardLists::class,
                'type' => 'read',
                'name' => 'Get Board Lists',
                'description' => 'Get all lists on a Trello board.',
                'icon' => 'ph:list',
            ],
            'trello_get_board_members' => [
                'class' => TrelloGetBoardMembers::class,
                'type' => 'read',
                'name' => 'Get Board Members',
                'description' => 'Get all members of a Trello board.',
                'icon' => 'ph:users',
            ],
            // Lists
            'trello_create_list' => [
                'class' => TrelloCreateList::class,
                'type' => 'write',
                'name' => 'Create List',
                'description' => 'Create a new list on a Trello board.',
                'icon' => 'ph:list-plus',
            ],
            'trello_get_list' => [
                'class' => TrelloGetList::class,
                'type' => 'read',
                'name' => 'Get List',
                'description' => 'Get detailed information about a Trello list.',
                'icon' => 'ph:list-magnifying-glass',
            ],
            'trello_update_list' => [
                'class' => TrelloUpdateList::class,
                'type' => 'write',
                'name' => 'Update List',
                'description' => 'Update a Trello list.',
                'icon' => 'ph:list-checks',
            ],
            // Labels
            'trello_create_label' => [
                'class' => TrelloCreateLabel::class,
                'type' => 'write',
                'name' => 'Create Label',
                'description' => 'Create a new label on a Trello board.',
                'icon' => 'ph:tag',
            ],
            'trello_add_label_to_card' => [
                'class' => TrelloAddLabelToCard::class,
                'type' => 'write',
                'name' => 'Add Label to Card',
                'description' => 'Add a label to a Trello card.',
                'icon' => 'ph:tag-simple',
            ],
            'trello_remove_label_from_card' => [
                'class' => TrelloRemoveLabelFromCard::class,
                'type' => 'write',
                'name' => 'Remove Label from Card',
                'description' => 'Remove a label from a Trello card.',
                'icon' => 'ph:tag-x',
            ],
            // Members
            'trello_get_member' => [
                'class' => TrelloGetMember::class,
                'type' => 'read',
                'name' => 'Get Member',
                'description' => 'Get a Trello member by ID.',
                'icon' => 'ph:user',
            ],
            'trello_add_member_to_card' => [
                'class' => TrelloAddMemberToCard::class,
                'type' => 'write',
                'name' => 'Add Member to Card',
                'description' => 'Add a member to a Trello card.',
                'icon' => 'ph:user-plus',
            ],
            // Comments & Checklists
            'trello_add_comment' => [
                'class' => TrelloAddComment::class,
                'type' => 'write',
                'name' => 'Add Comment',
                'description' => 'Add a comment to a Trello card.',
                'icon' => 'ph:chat-circle-text',
            ],
            'trello_create_checklist' => [
                'class' => TrelloCreateChecklist::class,
                'type' => 'write',
                'name' => 'Create Checklist',
                'description' => 'Create a new checklist on a Trello card.',
                'icon' => 'ph:checks',
            ],
            'trello_create_checklist_item' => [
                'class' => TrelloCreateChecklistItem::class,
                'type' => 'write',
                'name' => 'Create Checklist Item',
                'description' => 'Add an item to a Trello checklist.',
                'icon' => 'ph:check-square',
            ],
            'trello_get_current_member' => [
                'class' => TrelloGetCurrentMember::class,
                'type' => 'read',
                'name' => 'Get Current Member',
                'description' => 'Get the currently authenticated Trello member.',
                'icon' => 'ph:user-circle',
            ],
        ];
    }

    public function luaDocsPath(): ?string
    {
        return __DIR__ . '/../lua-docs/trello.md';
    }

    public function credentialFields(): array
    {
        return [
            ['key' => 'api_key', 'type' => 'text', 'label' => 'API Key', 'required' => true],
            ['key' => 'api_token', 'type' => 'secret', 'label' => 'API Token', 'required' => true],
        ];
    }

    public function isIntegration(): bool
    {
        return true;
    }

    /** @param  array<string, mixed>  $context */
    public function createTool(string $class, array $context = []): Tool
    {
        return new $class($this->resolveService($context));
    }

    /**
     * Resolve the TrelloService, with optional account-specific credentials.
     *
     * @param  array<string, mixed>  $context
     */
    private function resolveService(array $context = []): TrelloService
    {
        $account = $context['account'] ?? null;

        if ($account !== null) {
            $creds = app(\OpenCompany\IntegrationCore\Contracts\CredentialResolver::class);

            return new TrelloService(
                apiKey: $creds->get('trello', 'api_key', '', $account),
                apiToken: $creds->get('trello', 'api_token', '', $account),
            );
        }

        return app(TrelloService::class);
    }
}
