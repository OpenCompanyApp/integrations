<?php

namespace OpenCompany\Integrations\ClickUp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * HTTP client for the ClickUp REST APIs.
 *
 * Handles v2 and v3 authentication, endpoint dispatch, error normalization,
 * and request details that tools should not duplicate.
 */
class ClickUpService
{
    private const BASE_URL = 'https://api.clickup.com/api/v2';

    /**
     * @param  string  $apiToken  ClickUp personal API token
     * @param  string  $workspaceId  Optional default workspace/team ID
     */
    public function __construct(
        private string $apiToken = '',
        private string $workspaceId = '',
    ) {}

    public function isConfigured(): bool
    {
        return ! empty($this->apiToken);
    }

    public function getWorkspaceId(): string
    {
        return $this->workspaceId;
    }

    // ── Workspace ──────────────────────────────────────────

    /**
     * Get all workspaces (teams) the token has access to.
     *
     * @return array<string, mixed>
     */
    public function getTeams(): array
    {
        return $this->request('GET', '/team');
    }

    /**
     * Get the authorized ClickUp user for the configured token.
     *
     * @return array<string, mixed>
     */
    public function getAuthorizedUser(): array
    {
        return $this->request('GET', '/user');
    }

    /**
     * Get all spaces in a workspace.
     *
     * @return array<string, mixed>
     */
    public function getSpaces(string $teamId): array
    {
        return $this->request('GET', "/team/{$teamId}/space");
    }

    /**
     * Get all folders in a space.
     *
     * @return array<string, mixed>
     */
    public function getFolders(string $spaceId): array
    {
        return $this->request('GET', "/space/{$spaceId}/folder");
    }

    /**
     * Get folderless lists in a space.
     *
     * @return array<string, mixed>
     */
    public function getSpaceLists(string $spaceId): array
    {
        return $this->request('GET', "/space/{$spaceId}/list");
    }

    /**
     * Get lists in a folder.
     *
     * @return array<string, mixed>
     */
    public function getFolderLists(string $folderId): array
    {
        return $this->request('GET', "/folder/{$folderId}/list");
    }

    // ── Search ─────────────────────────────────────────────

    /**
     * Search tasks in a workspace.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function searchTasks(string $teamId, array $params = []): array
    {
        return $this->request('GET', "/team/{$teamId}/task", $params);
    }

    // ── Members ────────────────────────────────────────────

    /**
     * Get all workspace members.
     *
     * @return array<string, mixed>
     */
    public function getMembers(string $teamId): array
    {
        $response = $this->request('GET', '/team');

        if ($teamId === '') {
            return $response;
        }

        $teams = array_values(array_filter(
            $response['teams'] ?? [],
            static fn (array $team): bool => (string) ($team['id'] ?? '') === $teamId
        ));

        return ['teams' => $teams];
    }

    // ── Tasks ──────────────────────────────────────────────

    /**
     * Get tasks in a list.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTasks(string $listId, array $params = []): array
    {
        return $this->request('GET', "/list/{$listId}/task", $params);
    }

    /**
     * Get a single task.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTask(string $taskId, array $params = []): array
    {
        return $this->request('GET', "/task/{$taskId}", $params);
    }

    /**
     * Create a task.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createTask(string $listId, array $data): array
    {
        return $this->request('POST', "/list/{$listId}/task", $data);
    }

    /**
     * Update a task.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateTask(string $taskId, array $data, array $params = []): array
    {
        return $this->request('PUT', "/task/{$taskId}", $data, $params);
    }

    /**
     * Delete a task.
     *
     * @return array<string, mixed>
     */
    public function deleteTask(string $taskId, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}", [], $params);
    }

    /**
     * Merge one task into another task.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function mergeTask(string $taskId, string $targetTaskId, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/merge", ['target_task_id' => $targetTaskId], $params);
    }

    // ── Tags ───────────────────────────────────────────────

    /**
     * Add a tag to a task.
     *
     * @return array<string, mixed>
     */
    public function addTagToTask(string $taskId, string $tagName, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/tag/" . urlencode($tagName), [], $params);
    }

    /**
     * Remove a tag from a task.
     *
     * @return array<string, mixed>
     */
    public function removeTagFromTask(string $taskId, string $tagName, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}/tag/" . urlencode($tagName), [], $params);
    }

    /**
     * Get tags available in a space.
     *
     * @return array<string, mixed>
     */
    public function getSpaceTags(string $spaceId): array
    {
        return $this->request('GET', "/space/{$spaceId}/tag");
    }

    /**
     * Create a tag in a space.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createSpaceTag(string $spaceId, array $data): array
    {
        return $this->request('POST', "/space/{$spaceId}/tag", $data);
    }

    /**
     * Update a tag in a space.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateSpaceTag(string $spaceId, string $tagName, array $data): array
    {
        return $this->request('PUT', "/space/{$spaceId}/tag/" . urlencode($tagName), $data);
    }

    /**
     * Delete a tag from a space.
     *
     * @return array<string, mixed>
     */
    public function deleteSpaceTag(string $spaceId, string $tagName): array
    {
        return $this->request('DELETE', "/space/{$spaceId}/tag/" . urlencode($tagName));
    }

    // ── Attachments ────────────────────────────────────────

    /**
     * Attach a local file to a task using ClickUp's multipart upload endpoint.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function attachFileToTask(string $taskId, string $filePath, ?string $filename = null, array $params = []): array
    {
        return $this->upload('POST', "/task/{$taskId}/attachment", 'attachment', $filePath, $filename, $params);
    }

    /**
     * Get v3 attachments for a supported entity.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getAttachments(string $workspaceId, string $entityType, string $entityId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/{$entityType}/{$entityId}/attachments", $params);
    }

    /**
     * Create a v3 attachment for a supported entity.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function createAttachment(string $workspaceId, string $entityType, string $entityId, string $filePath, ?string $filename = null, array $params = []): array
    {
        return $this->upload('POST', "/workspaces/{$workspaceId}/{$entityType}/{$entityId}/attachments", 'attachment', $filePath, $filename, $params, true);
    }

    // ── Comments ───────────────────────────────────────────

    /**
     * Get task comments.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTaskComments(string $taskId, array $params = []): array
    {
        return $this->request('GET', "/task/{$taskId}/comment", $params);
    }

    /**
     * Create a task comment.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createTaskComment(string $taskId, array $data, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/comment", $data, $params);
    }

    /**
     * Get comments attached to a list.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getListComments(string $listId, array $params = []): array
    {
        return $this->request('GET', "/list/{$listId}/comment", $params);
    }

    /**
     * Create a comment on a list.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createListComment(string $listId, array $data): array
    {
        return $this->request('POST', "/list/{$listId}/comment", $data);
    }

    /**
     * Get comments attached to a view.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getViewComments(string $viewId, array $params = []): array
    {
        return $this->request('GET', "/view/{$viewId}/comment", $params);
    }

    /**
     * Create a comment on a view.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createViewComment(string $viewId, array $data): array
    {
        return $this->request('POST', "/view/{$viewId}/comment", $data);
    }

    /**
     * Update a comment.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateComment(string $commentId, array $data): array
    {
        return $this->request('PUT', "/comment/{$commentId}", $data);
    }

    /**
     * Delete a comment.
     *
     * @return array<string, mixed>
     */
    public function deleteComment(string $commentId): array
    {
        return $this->request('DELETE', "/comment/{$commentId}");
    }

    /**
     * Get threaded comment replies.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getCommentReplies(string $commentId, array $params = []): array
    {
        return $this->request('GET', "/comment/{$commentId}/reply", $params);
    }

    /**
     * Create a threaded comment reply.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createCommentReply(string $commentId, array $data): array
    {
        return $this->request('POST', "/comment/{$commentId}/reply", $data);
    }

    // ── Time Tracking ──────────────────────────────────────

    /**
     * Get time entries for a task.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTaskTimeEntries(string $taskId, array $params = []): array
    {
        return $this->request('GET', "/task/{$taskId}/time", $params);
    }

    /**
     * Add a legacy tracked-time interval directly to a task.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function trackTaskTime(string $taskId, array $data, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/time", $data, $params);
    }

    /**
     * Edit a legacy tracked-time interval.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function updateTaskTime(string $taskId, string $intervalId, array $data, array $params = []): array
    {
        return $this->request('PUT', "/task/{$taskId}/time/{$intervalId}", $data, $params);
    }

    /**
     * Delete a legacy tracked-time interval.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteTaskTime(string $taskId, string $intervalId, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}/time/{$intervalId}", [], $params);
    }

    /**
     * Start a timer on a task.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function startTimeEntry(string $teamId, string $taskId, array $data = []): array
    {
        $data['tid'] = $taskId;

        return $this->request('POST', "/team/{$teamId}/time_entries/start", $data);
    }

    /**
     * Stop the running timer.
     *
     * @return array<string, mixed>
     */
    public function stopTimeEntry(string $teamId): array
    {
        return $this->request('POST', "/team/{$teamId}/time_entries/stop");
    }

    /**
     * Add a manual time entry.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function addTimeEntry(string $teamId, array $data): array
    {
        return $this->request('POST', "/team/{$teamId}/time_entries", $data);
    }

    /**
     * Get the currently running time entry.
     *
     * @return array<string, mixed>
     */
    public function getCurrentTimeEntry(string $teamId): array
    {
        return $this->request('GET', "/team/{$teamId}/time_entries/current");
    }

    /**
     * Get modern time entries in a workspace date range.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getTimeEntries(string $teamId, array $params = []): array
    {
        return $this->request('GET', "/team/{$teamId}/time_entries", $params);
    }

    /**
     * Get one modern time entry.
     *
     * @return array<string, mixed>
     */
    public function getTimeEntry(string $teamId, string $timerId): array
    {
        return $this->request('GET', "/team/{$teamId}/time_entries/{$timerId}");
    }

    /**
     * Update a modern time entry.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateTimeEntry(string $teamId, string $timerId, array $data): array
    {
        return $this->request('PUT', "/team/{$teamId}/time_entries/{$timerId}", $data);
    }

    /**
     * Delete a modern time entry.
     *
     * @return array<string, mixed>
     */
    public function deleteTimeEntry(string $teamId, string $timerId): array
    {
        return $this->request('DELETE', "/team/{$teamId}/time_entries/{$timerId}");
    }

    /**
     * Get the change history for a modern time entry.
     *
     * @return array<string, mixed>
     */
    public function getTimeEntryHistory(string $teamId, string $timerId): array
    {
        return $this->request('GET', "/team/{$teamId}/time_entries/{$timerId}/history");
    }

    /**
     * Get all workspace time-entry tags.
     *
     * @return array<string, mixed>
     */
    public function getTimeEntryTags(string $teamId): array
    {
        return $this->request('GET', "/team/{$teamId}/time_entries/tags");
    }

    /**
     * Add tags to time entries.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function addTimeEntryTags(string $teamId, array $data): array
    {
        return $this->request('POST', "/team/{$teamId}/time_entries/tags", $data);
    }

    /**
     * Rename time-entry tags.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateTimeEntryTags(string $teamId, array $data): array
    {
        return $this->request('PUT', "/team/{$teamId}/time_entries/tags", $data);
    }

    /**
     * Remove tags from time entries.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function removeTimeEntryTags(string $teamId, array $data): array
    {
        return $this->request('DELETE', "/team/{$teamId}/time_entries/tags", $data);
    }

    // ── Lists ──────────────────────────────────────────────

    /**
     * Get a list.
     *
     * @return array<string, mixed>
     */
    public function getList(string $listId): array
    {
        return $this->request('GET', "/list/{$listId}");
    }

    /**
     * Create a list in a space.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createList(string $spaceId, array $data): array
    {
        return $this->request('POST', "/space/{$spaceId}/list", $data);
    }

    /**
     * Create a list in a folder.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createListInFolder(string $folderId, array $data): array
    {
        return $this->request('POST', "/folder/{$folderId}/list", $data);
    }

    /**
     * Update a list.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateList(string $listId, array $data): array
    {
        return $this->request('PUT', "/list/{$listId}", $data);
    }

    /**
     * Delete a list.
     *
     * @return array<string, mixed>
     */
    public function deleteList(string $listId): array
    {
        return $this->request('DELETE', "/list/{$listId}");
    }

    /**
     * Add a task to an additional list.
     *
     * @return array<string, mixed>
     */
    public function addTaskToList(string $listId, string $taskId): array
    {
        return $this->request('POST', "/list/{$listId}/task/{$taskId}");
    }

    /**
     * Remove a task from an additional list.
     *
     * @return array<string, mixed>
     */
    public function removeTaskFromList(string $listId, string $taskId): array
    {
        return $this->request('DELETE', "/list/{$listId}/task/{$taskId}");
    }

    // ── Folders ────────────────────────────────────────────

    /**
     * Get a folder.
     *
     * @return array<string, mixed>
     */
    public function getFolder(string $folderId): array
    {
        return $this->request('GET', "/folder/{$folderId}");
    }

    /**
     * Create a folder in a space.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createFolder(string $spaceId, array $data): array
    {
        return $this->request('POST', "/space/{$spaceId}/folder", $data);
    }

    /**
     * Update a folder.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateFolder(string $folderId, array $data): array
    {
        return $this->request('PUT', "/folder/{$folderId}", $data);
    }

    /**
     * Delete a folder.
     *
     * @return array<string, mixed>
     */
    public function deleteFolder(string $folderId): array
    {
        return $this->request('DELETE', "/folder/{$folderId}");
    }

    // ── Spaces ─────────────────────────────────────────────

    /**
     * Get one space.
     *
     * @return array<string, mixed>
     */
    public function getSpace(string $spaceId): array
    {
        return $this->request('GET', "/space/{$spaceId}");
    }

    /**
     * Create a space in a workspace.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createSpace(string $teamId, array $data): array
    {
        return $this->request('POST', "/team/{$teamId}/space", $data);
    }

    /**
     * Update a space.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateSpace(string $spaceId, array $data): array
    {
        return $this->request('PUT', "/space/{$spaceId}", $data);
    }

    /**
     * Delete a space.
     *
     * @return array<string, mixed>
     */
    public function deleteSpace(string $spaceId): array
    {
        return $this->request('DELETE', "/space/{$spaceId}");
    }

    /**
     * Get shared workspace hierarchy.
     *
     * @return array<string, mixed>
     */
    public function getSharedHierarchy(string $teamId): array
    {
        return $this->request('GET', "/team/{$teamId}/shared");
    }

    // ── Custom Fields ──────────────────────────────────────

    /**
     * Get custom fields available at a list, folder, space, or workspace.
     *
     * @return array<string, mixed>
     */
    public function getCustomFields(string $scope, string $scopeId): array
    {
        if (! in_array($scope, ['list', 'folder', 'space', 'team'], true)) {
            throw new \RuntimeException('Custom field scope must be one of: list, folder, space, team.');
        }

        return $this->request('GET', "/{$scope}/{$scopeId}/field");
    }

    /**
     * Set a task custom field value.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function setCustomFieldValue(string $taskId, string $fieldId, array $data, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/field/{$fieldId}", $data, $params);
    }

    /**
     * Remove a task custom field value.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function removeCustomFieldValue(string $taskId, string $fieldId, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}/field/{$fieldId}", [], $params);
    }

    // ── Checklists ─────────────────────────────────────────

    /**
     * Create a checklist on a task.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function createChecklist(string $taskId, array $data, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/checklist", $data, $params);
    }

    /**
     * Update a checklist.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateChecklist(string $checklistId, array $data): array
    {
        return $this->request('PUT', "/checklist/{$checklistId}", $data);
    }

    /**
     * Delete a checklist.
     *
     * @return array<string, mixed>
     */
    public function deleteChecklist(string $checklistId): array
    {
        return $this->request('DELETE', "/checklist/{$checklistId}");
    }

    /**
     * Create a checklist item.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createChecklistItem(string $checklistId, array $data): array
    {
        return $this->request('POST', "/checklist/{$checklistId}/checklist_item", $data);
    }

    /**
     * Update a checklist item.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateChecklistItem(string $checklistId, string $checklistItemId, array $data): array
    {
        return $this->request('PUT', "/checklist/{$checklistId}/checklist_item/{$checklistItemId}", $data);
    }

    /**
     * Delete a checklist item.
     *
     * @return array<string, mixed>
     */
    public function deleteChecklistItem(string $checklistId, string $checklistItemId): array
    {
        return $this->request('DELETE', "/checklist/{$checklistId}/checklist_item/{$checklistItemId}");
    }

    // ── Chat ───────────────────────────────────────────────

    /**
     * Get chat channels. Uses v3 API.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatChannels(string $teamId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/channels", $params);
    }

    /**
     * Create a ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createChatChannel(string $teamId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/channels", $data);
    }

    /**
     * Create a ClickUp Chat channel attached to a location.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createLocationChatChannel(string $teamId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/channels/location", $data);
    }

    /**
     * Create a direct-message ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createDirectMessageChannel(string $teamId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/channels/direct_message", $data);
    }

    /**
     * Retrieve one ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatChannel(string $teamId, string $channelId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/channels/{$channelId}", $params);
    }

    /**
     * Update a ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateChatChannel(string $teamId, string $channelId, array $data): array
    {
        return $this->requestV3('PATCH', "/workspaces/{$teamId}/chat/channels/{$channelId}", $data);
    }

    /**
     * Delete a ClickUp Chat channel.
     *
     * @return array<string, mixed>
     */
    public function deleteChatChannel(string $teamId, string $channelId): array
    {
        return $this->requestV3('DELETE', "/workspaces/{$teamId}/chat/channels/{$channelId}");
    }

    /**
     * Retrieve followers for a ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatChannelFollowers(string $teamId, string $channelId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/channels/{$channelId}/followers", $params);
    }

    /**
     * Retrieve members for a ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatChannelMembers(string $teamId, string $channelId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/channels/{$channelId}/members", $params);
    }

    /**
     * Retrieve messages in a ClickUp Chat channel.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatChannelMessages(string $teamId, string $channelId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/channels/{$channelId}/messages", $params);
    }

    /**
     * Send a chat message. Uses v3 API.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function sendChatMessage(string $teamId, string $channelId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/channels/{$channelId}/messages", $data);
    }

    /**
     * Update a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateChatMessage(string $teamId, string $messageId, array $data): array
    {
        return $this->requestV3('PATCH', "/workspaces/{$teamId}/chat/messages/{$messageId}", $data);
    }

    /**
     * Delete a ClickUp Chat message.
     *
     * @return array<string, mixed>
     */
    public function deleteChatMessage(string $teamId, string $messageId): array
    {
        return $this->requestV3('DELETE', "/workspaces/{$teamId}/chat/messages/{$messageId}");
    }

    /**
     * Retrieve reactions for a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatMessageReactions(string $teamId, string $messageId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/messages/{$messageId}/reactions", $params);
    }

    /**
     * Create a reaction on a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createChatMessageReaction(string $teamId, string $messageId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/messages/{$messageId}/reactions", $data);
    }

    /**
     * Delete a reaction from a ClickUp Chat message.
     *
     * @return array<string, mixed>
     */
    public function deleteChatMessageReaction(string $teamId, string $messageId, string $reaction): array
    {
        return $this->requestV3('DELETE', "/workspaces/{$teamId}/chat/messages/{$messageId}/reactions/" . urlencode($reaction));
    }

    /**
     * Retrieve replies to a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatMessageReplies(string $teamId, string $messageId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/messages/{$messageId}/replies", $params);
    }

    /**
     * Create a reply to a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createChatMessageReply(string $teamId, string $messageId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$teamId}/chat/messages/{$messageId}/replies", $data);
    }

    /**
     * Retrieve users tagged in a ClickUp Chat message.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getChatMessageTaggedUsers(string $teamId, string $messageId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$teamId}/chat/messages/{$messageId}/tagged_users", $params);
    }

    // ── Documents ──────────────────────────────────────────

    /**
     * Create a document. Uses v3 API.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createDocument(string $workspaceId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$workspaceId}/docs", $data);
    }

    /**
     * Search for ClickUp Docs in a workspace.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function searchDocuments(string $workspaceId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs", $params);
    }

    /**
     * Fetch a ClickUp Doc by ID.
     *
     * @return array<string, mixed>
     */
    public function getDocument(string $workspaceId, string $docId): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs/{$docId}");
    }

    /**
     * Fetch the page listing tree for a ClickUp Doc.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getDocumentPageListing(string $workspaceId, string $docId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs/{$docId}/page_listing", $params);
    }

    /**
     * List document pages. Uses v3 API.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function listDocumentPages(string $workspaceId, string $docId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs/{$docId}/pages", $params);
    }

    /**
     * Get document page content. Uses v3 API.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getDocumentPages(string $workspaceId, string $docId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs/{$docId}/pages", $params);
    }

    /**
     * Create a document page. Uses v3 API.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function createDocumentPage(string $workspaceId, string $docId, array $data): array
    {
        return $this->requestV3('POST', "/workspaces/{$workspaceId}/docs/{$docId}/pages", $data);
    }

    /**
     * Update a document page. Uses v3 API.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateDocumentPage(string $workspaceId, string $docId, string $pageId, array $data): array
    {
        return $this->requestV3('PUT', "/workspaces/{$workspaceId}/docs/{$docId}/pages/{$pageId}", $data);
    }

    /**
     * Fetch one ClickUp Doc page by ID.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function getDocumentPage(string $workspaceId, string $docId, string $pageId, array $params = []): array
    {
        return $this->requestV3('GET', "/workspaces/{$workspaceId}/docs/{$docId}/pages/{$pageId}", $params);
    }

    // ── Webhooks ────────────────────────────────────────────

    /**
     * Register a webhook on a workspace.
     *
     * @param  array<string, mixed>  $data  Must include 'endpoint' and 'events'.
     *                                       Optional: 'space_id', 'folder_id', 'list_id', 'task_id'
     * @return array<string, mixed>
     */
    public function createWebhook(string $teamId, array $data): array
    {
        return $this->request('POST', "/team/{$teamId}/webhook", $data);
    }

    /**
     * Delete a webhook.
     *
     * @return array<string, mixed>
     */
    public function deleteWebhook(string $webhookId): array
    {
        return $this->request('DELETE', "/webhook/{$webhookId}");
    }

    /**
     * List all webhooks for a workspace.
     *
     * @return array<string, mixed>
     */
    public function getWebhooks(string $teamId): array
    {
        return $this->request('GET', "/team/{$teamId}/webhook");
    }

    /**
     * Update a webhook registration.
     *
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    public function updateWebhook(string $webhookId, array $data): array
    {
        return $this->request('PUT', "/webhook/{$webhookId}", $data);
    }

    // ── Relationships ──────────────────────────────────────

    /**
     * Add a task dependency.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function addDependency(string $taskId, array $data, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/dependency", $data, $params);
    }

    /**
     * Delete a task dependency.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteDependency(string $taskId, array $data, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}/dependency", $data, $params);
    }

    /**
     * Add a link between two tasks.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function addTaskLink(string $taskId, string $linksTo, array $params = []): array
    {
        return $this->request('POST', "/task/{$taskId}/link/{$linksTo}", [], $params);
    }

    /**
     * Remove a link between two tasks.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function deleteTaskLink(string $taskId, string $linksTo, array $params = []): array
    {
        return $this->request('DELETE', "/task/{$taskId}/link/{$linksTo}", [], $params);
    }

    // ── Helpers ─────────────────────────────────────────────

    /**
     * Detect whether a task ID is a custom ID (e.g., "DEV-42").
     */
    public function isCustomTaskId(string $taskId): bool
    {
        if (preg_match('/^[0-9a-f]{8,}$/i', $taskId) || preg_match('/^\d+$/', $taskId)) {
            return false;
        }

        return str_contains($taskId, '-');
    }

    /**
     * Build query params for custom task IDs.
     *
     * @param  array<string, mixed>  $params
     * @return array<string, mixed>
     */
    public function withCustomIdParams(string $taskId, array $params = []): array
    {
        if ($this->isCustomTaskId($taskId) && $this->workspaceId) {
            $params['custom_task_ids'] = 'true';
            $params['team_id'] = $this->workspaceId;
        }

        return $params;
    }

    /**
     * Convert an ISO 8601 date string to millisecond timestamp.
     */
    public static function toMillis(string $date): int
    {
        return (int) (strtotime($date) * 1000);
    }

    /**
     * Convert a millisecond timestamp to ISO 8601 string.
     */
    public static function fromMillis(int $millis): string
    {
        return date('Y-m-d H:i:s', (int) ($millis / 1000));
    }

    // ── HTTP ───────────────────────────────────────────────

    /**
     * Make an API v2 request.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function request(string $method, string $path, array $data = [], array $query = []): array
    {
        return $this->doRequest($method, self::BASE_URL . $path, $data, $query);
    }

    /**
     * Make an API v3 request.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function requestV3(string $method, string $path, array $data = [], array $query = []): array
    {
        return $this->doRequest($method, 'https://api.clickup.com/api/v3' . $path, $data, $query);
    }

    /**
     * Execute an HTTP request.
     *
     * @param  array<string, mixed>  $data
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function doRequest(string $method, string $url, array $data = [], array $query = []): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('ClickUp API token is not configured.');
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->apiToken,
                'Content-Type' => 'application/json',
            ])->timeout(30);

            $requestUrl = $this->urlWithQuery($url, $query);

            $response = match (strtoupper($method)) {
                'GET' => $http->get($requestUrl, $data),
                'POST' => $http->post($requestUrl, $data),
                'PUT' => $http->put($requestUrl, $data),
                'PATCH' => $http->patch($requestUrl, $data),
                'DELETE' => $http->delete($requestUrl, $data),
                default => throw new \RuntimeException("Unsupported HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['err'] ?? $body['error'] ?? $response->body();
                $ecode = $body['ECODE'] ?? '';

                Log::error("ClickUp API error: {$method} {$requestUrl}", [
                    'status' => $response->status(),
                    'err' => $err,
                    'ECODE' => $ecode,
                ]);

                $msg = is_string($err) ? $err : json_encode($err);
                if ($ecode) {
                    $msg .= " (code: {$ecode})";
                }

                throw new \RuntimeException('ClickUp API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ClickUp API connection error: {$method} {$url}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ClickUp API: {$e->getMessage()}");
        }
    }

    /**
     * Upload a local file using multipart/form-data.
     *
     * @param  array<string, mixed>  $query
     * @return array<string, mixed>
     */
    private function upload(string $method, string $path, string $field, string $filePath, ?string $filename = null, array $query = [], bool $v3 = false): array
    {
        if (! $this->apiToken) {
            throw new \RuntimeException('ClickUp API token is not configured.');
        }

        if (! is_file($filePath) || ! is_readable($filePath)) {
            throw new \RuntimeException("Attachment file is not readable: {$filePath}");
        }

        $url = ($v3 ? 'https://api.clickup.com/api/v3' : self::BASE_URL) . $path;
        $requestUrl = $this->urlWithQuery($url, $query);
        $handle = fopen($filePath, 'r');

        if ($handle === false) {
            throw new \RuntimeException("Unable to open attachment file: {$filePath}");
        }

        try {
            $http = Http::withHeaders([
                'Authorization' => $this->apiToken,
            ])->timeout(60)->attach($field, $handle, $filename ?: basename($filePath));

            $response = match (strtoupper($method)) {
                'POST' => $http->post($requestUrl),
                default => throw new \RuntimeException("Unsupported upload HTTP method: {$method}"),
            };

            if (! $response->successful()) {
                $body = $response->json() ?? [];
                $err = $body['err'] ?? $body['error'] ?? $response->body();
                $msg = is_string($err) ? $err : json_encode($err);

                Log::error("ClickUp upload error: {$method} {$requestUrl}", [
                    'status' => $response->status(),
                    'err' => $err,
                ]);

                throw new \RuntimeException('ClickUp API error (' . $response->status() . '): ' . $msg);
            }

            return $response->json() ?? [];
        } catch (\Illuminate\Http\Client\ConnectionException $e) {
            Log::error("ClickUp upload connection error: {$method} {$requestUrl}", [
                'error' => $e->getMessage(),
            ]);
            throw new \RuntimeException("Failed to connect to ClickUp API: {$e->getMessage()}");
        } finally {
            fclose($handle);
        }
    }

    /**
     * Append query parameters to a URL without mixing them into path strings.
     *
     * @param  array<string, mixed>  $query
     */
    private function urlWithQuery(string $url, array $query): string
    {
        if ($query === []) {
            return $url;
        }

        return $url . (str_contains($url, '?') ? '&' : '?') . http_build_query($query);
    }
}
