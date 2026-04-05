<?php

namespace OpenCompany\Integrations\Trello;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * Client for the Trello REST API.
 *
 * Wraps HTTP calls to Trello's REST endpoints for boards, lists,
 * cards, labels, members, checklists, and comments.
 */
class TrelloService
{
    private const BASE_URL = 'https://api.trello.com/1';

    /**
     * @param  string  $apiKey   Trello API key
     * @param  string  $apiToken Trello API token (member or server token)
     */
    public function __construct(
        private string $apiKey = '',
        private string $apiToken = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->apiToken);
    }

    // ── Connection ──────────────────────────────────────────

    /**
     * Test the connection by fetching the current member profile.
     *
     * @return array<string, mixed>
     */
    public function testConnection(): array
    {
        return $this->request('GET', '/members/me');
    }

    // ── Cards ───────────────────────────────────────────────

    /**
     * Create a new card.
     *
     * @param  array<string, mixed>  $data  Card fields (name, desc, idList, etc.)
     * @return array<string, mixed>
     */
    public function createCard(array $data): array
    {
        return $this->request('POST', '/cards', $data);
    }

    /**
     * Get a card by ID.
     *
     * @param  string  $id  Card ID
     * @return array<string, mixed>
     */
    public function getCard(string $id): array
    {
        return $this->request('GET', "/cards/{$id}");
    }

    /**
     * Update a card.
     *
     * @param  string                 $id   Card ID
     * @param  array<string, mixed>   $data Fields to update
     * @return array<string, mixed>
     */
    public function updateCard(string $id, array $data): array
    {
        return $this->request('PUT', "/cards/{$id}", $data);
    }

    /**
     * Delete a card.
     *
     * @param  string  $id  Card ID
     * @return array<string, mixed>
     */
    public function deleteCard(string $id): array
    {
        return $this->request('DELETE', "/cards/{$id}");
    }

    /**
     * Get all cards in a list.
     *
     * @param  string                 $id     List ID
     * @param  array<string, mixed>   $params Query params (limit, before)
     * @return array<string, mixed>
     */
    public function getCardsInList(string $id, array $params = []): array
    {
        return $this->request('GET', "/lists/{$id}/cards", $params);
    }

    /**
     * Search for cards across boards.
     *
     * @param  array<string, mixed>  $params  Search params (query, idBoards, modelTypes, limit)
     * @return array<string, mixed>
     */
    public function searchCards(array $params): array
    {
        return $this->request('GET', '/search', $params);
    }

    // ── Boards ──────────────────────────────────────────────

    /**
     * Create a new board.
     *
     * @param  array<string, mixed>  $data  Board fields (name, desc, etc.)
     * @return array<string, mixed>
     */
    public function createBoard(array $data): array
    {
        return $this->request('POST', '/boards', $data);
    }

    /**
     * Get a board by ID.
     *
     * @param  string  $id  Board ID
     * @return array<string, mixed>
     */
    public function getBoard(string $id): array
    {
        return $this->request('GET', "/boards/{$id}");
    }

    /**
     * List boards for the current member.
     *
     * @param  array<string, mixed>  $params  Query params (filter, fields, limit)
     * @return array<string, mixed>
     */
    public function listBoards(array $params = []): array
    {
        return $this->request('GET', '/members/me/boards', $params);
    }

    /**
     * Get all lists on a board.
     *
     * @param  string  $id  Board ID
     * @return array<string, mixed>
     */
    public function getBoardLists(string $id): array
    {
        return $this->request('GET', "/boards/{$id}/lists");
    }

    /**
     * Get all members of a board.
     *
     * @param  string  $id  Board ID
     * @return array<string, mixed>
     */
    public function getBoardMembers(string $id): array
    {
        return $this->request('GET', "/boards/{$id}/members");
    }

    // ── Lists ───────────────────────────────────────────────

    /**
     * Create a new list on a board.
     *
     * @param  array<string, mixed>  $data  List fields (name, idBoard, pos)
     * @return array<string, mixed>
     */
    public function createList(array $data): array
    {
        return $this->request('POST', '/lists', $data);
    }

    /**
     * Get a list by ID.
     *
     * @param  string  $id  List ID
     * @return array<string, mixed>
     */
    public function getList(string $id): array
    {
        return $this->request('GET', "/lists/{$id}");
    }

    /**
     * Update a list.
     *
     * @param  string                 $id   List ID
     * @param  array<string, mixed>   $data Fields to update
     * @return array<string, mixed>
     */
    public function updateList(string $id, array $data): array
    {
        return $this->request('PUT', "/lists/{$id}", $data);
    }

    // ── Labels ──────────────────────────────────────────────

    /**
     * Create a new label on a board.
     *
     * @param  array<string, mixed>  $data  Label fields (name, color, idBoard)
     * @return array<string, mixed>
     */
    public function createLabel(array $data): array
    {
        return $this->request('POST', '/labels', $data);
    }

    /**
     * Add a label to a card.
     *
     * @param  string  $cardId  Card ID
     * @param  string  $labelId Label ID to add
     * @return array<string, mixed>
     */
    public function addLabelToCard(string $cardId, string $labelId): array
    {
        return $this->request('POST', "/cards/{$cardId}/idLabels", ['value' => $labelId]);
    }

    /**
     * Remove a label from a card.
     *
     * @param  string  $cardId  Card ID
     * @param  string  $labelId Label ID to remove
     * @return array<string, mixed>
     */
    public function removeLabelFromCard(string $cardId, string $labelId): array
    {
        return $this->request('DELETE', "/cards/{$cardId}/idLabels/{$labelId}");
    }

    // ── Members ─────────────────────────────────────────────

    /**
     * Get a member by ID.
     *
     * @param  string  $id  Member ID or username
     * @return array<string, mixed>
     */
    public function getMember(string $id): array
    {
        return $this->request('GET', "/members/{$id}");
    }

    /**
     * Get the current authenticated member.
     *
     * @return array<string, mixed>
     */
    public function getCurrentMember(): array
    {
        return $this->request('GET', '/members/me');
    }

    /**
     * Add a member to a card.
     *
     * @param  string  $cardId   Card ID
     * @param  string  $memberId Member ID to add
     * @return array<string, mixed>
     */
    public function addMemberToCard(string $cardId, string $memberId): array
    {
        return $this->request('POST', "/cards/{$cardId}/idMembers", ['value' => $memberId]);
    }

    // ── Comments ────────────────────────────────────────────

    /**
     * Add a comment to a card.
     *
     * @param  string  $cardId  Card ID
     * @param  string  $text    Comment text
     * @return array<string, mixed>
     */
    public function addComment(string $cardId, string $text): array
    {
        return $this->request('POST', "/cards/{$cardId}/actions/comments", ['text' => $text]);
    }

    // ── Checklists ──────────────────────────────────────────

    /**
     * Create a new checklist on a card.
     *
     * @param  array<string, mixed>  $data  Checklist fields (idCard, name)
     * @return array<string, mixed>
     */
    public function createChecklist(array $data): array
    {
        return $this->request('POST', '/checklists', $data);
    }

    /**
     * Create a checklist item.
     *
     * @param  string                 $checklistId Checklist ID
     * @param  array<string, mixed>   $data        Item fields (name, checked)
     * @return array<string, mixed>
     */
    public function createChecklistItem(string $checklistId, array $data): array
    {
        return $this->request('POST', "/checklists/{$checklistId}/checkItems", $data);
    }

    // ── HTTP ─────────────────────────────────────────────────

    /**
     * Make an API request to Trello.
     *
     * Appends key and token as query parameters on every request.
     *
     * @param  array<string, mixed>  $data  Query or body params
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = []): array
    {
        if (! $this->isConfigured()) {
            throw new \RuntimeException('Trello API key and token are not configured.');
        }

        // Append key and token to the URL query string
        $separator = str_contains($path, '?') ? '&' : '?';
        $url = self::BASE_URL . $path . $separator . 'key=' . urlencode($this->apiKey) . '&token=' . urlencode($this->apiToken);

        try {
            $http = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])->timeout(30);

            $response = match (strtoupper($method)) {
                'GET'    => $http->get($url, $data),
                'POST'   => $http->post($url, $data),
                'PUT'    => $http->put($url, $data),
                'DELETE' => $http->delete($url, $data),
                default  => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                Log::error("Trello API error: {$method} {$path}", [
                    'status' => $response->status(),
                    'body'   => $response->body(),
                ]);

                throw new \RuntimeException("Trello API error ({$response->status()}): {$response->body()}");
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("Trello API connection error: {$method} {$path}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to Trello API: {$e->getMessage()}");
        }
    }
}
