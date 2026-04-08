# HTTP client for the GitLab REST API (v4) — Lua API Reference

## gitlab_accept_merge_request

Accept (merge) a GitLab merge request. Optionally set a custom merge commit message..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `mr_iid` | integer | yes | The project-scoped merge request IID to accept. |
| `merge_commit_message` | string | no | Custom merge commit message. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_accept_merge_request({
  project_id = ""
  mr_iid = 0
  merge_commit_message = ""
})
```

## gitlab_create_branch

Create a new branch in a GitLab project repository. Requires a branch name and a ref (branch name or commit SHA) to create from..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `branch` | string | yes | The name of the new branch. Example:  |
| `ref` | string | yes | The branch name or commit SHA to create from. Example:  |

### Example

```lua
local result = app.integrations.gitlab.gitlab_create_branch({
  project_id = ""
  branch = ""
  ref = ""
})
```

## gitlab_create_issue

Create a new issue in a GitLab project. Requires a project ID and title. Optionally set description, labels, assignees, milestone, and weight..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project (e.g.  |
| `title` | string | yes | The title of the issue. |
| `description` | string | no | The description of the issue. Supports GitLab Markdown. |
| `labels` | string | no | Comma-separated label names to apply. Example:  |
| `assignee_ids` | array | no |  |
| `milestone_id` | integer | no | The milestone ID to associate with the issue. |
| `weight` | integer | no | The weight of the issue (0-9). |

### Example

```lua
local result = app.integrations.gitlab.gitlab_create_issue({
  project_id = ""
  title = ""
  description = ""
})
```

## gitlab_create_issue_comment

Add a comment (note) to a GitLab issue. The comment body supports GitLab Markdown..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `issue_iid` | integer | yes | The project-scoped issue IID. |
| `body` | string | yes | The comment body. Supports GitLab Markdown. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_create_issue_comment({
  project_id = ""
  issue_iid = 0
  body = ""
})
```

## gitlab_create_merge_request

Create a new merge request in a GitLab project. Requires source branch, target branch, and title..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `source_branch` | string | yes | The source branch name (where changes come from). |
| `target_branch` | string | yes | The target branch name (where changes merge into). |
| `title` | string | yes | The title of the merge request. |
| `description` | string | no | The description of the merge request. Supports GitLab Markdown. |
| `labels` | string | no | Comma-separated label names. Example:  |

### Example

```lua
local result = app.integrations.gitlab.gitlab_create_merge_request({
  project_id = ""
  source_branch = ""
  target_branch = ""
})
```

## gitlab_get_file

Get a file from a GitLab project repository. Returns file content (base64-encoded), file name, size, and encoding..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `file_path` | string | yes | The path of the file in the repository. Example:  |
| `ref` | string | yes | The name of the branch, tag, or commit SHA. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_get_file({
  project_id = ""
  file_path = ""
  ref = ""
})
```

## gitlab_get_issue

Get detailed information about a specific GitLab issue, including title, description, labels, assignees, milestone, and state..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `issue_iid` | integer | yes | The project-scoped issue IID (not the global ID). |

### Example

```lua
local result = app.integrations.gitlab.gitlab_get_issue({
  project_id = ""
  issue_iid = 0
})
```

## gitlab_get_merge_request

Get detailed information about a specific GitLab merge request, including title, description, source/target branches, and state..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `mr_iid` | integer | yes | The project-scoped merge request IID (not the global ID). |

### Example

```lua
local result = app.integrations.gitlab.gitlab_get_merge_request({
  project_id = ""
  mr_iid = 0
})
```

## gitlab_get_project

Get details for a specific GitLab project, including name, description, default branch, visibility, and statistics..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project (e.g.  |

### Example

```lua
local result = app.integrations.gitlab.gitlab_get_project({
  project_id = ""
})
```

## gitlab_list_branches

List branches in a GitLab project repository. Supports searching by branch name and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `search` | string | no | Search term to filter branches by name. |
| `page` | integer | no | Page number for pagination. Default: 1. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_branches({
  project_id = ""
  search = ""
  page = 0
})
```

## gitlab_list_commits

List commits in a GitLab project repository. Supports filtering by branch or tag name. Paginated..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `ref_name` | string | no | The name of the branch or tag to filter commits by. |
| `page` | integer | no | Page number for pagination. Default: 1. |
| `per_page` | integer | no | Results per page (1-100). Default: 20. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_commits({
  project_id = ""
  ref_name = ""
  page = 0
})
```

## gitlab_list_groups

List GitLab groups visible to the authenticated user. Paginated..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `page` | integer | no | Page number for pagination. Default: 1. |
| `per_page` | integer | no | Results per page (1-100). Default: 20. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_groups({
  page = 0
  per_page = 0
})
```

## gitlab_list_issues

List issues in a GitLab project. Supports filtering by state (opened, closed, all), labels, and search text. Paginated..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `state` | string | no | Issue state filter: opened, closed, all. Default: opened. |
| `labels` | string | no | Comma-separated label names to filter by. Example:  |
| `search` | string | no | Search text to filter issues by title or description. |
| `page` | integer | no | Page number for pagination. Default: 1. |
| `per_page` | integer | no | Results per page (1-100). Default: 20. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_issues({
  project_id = ""
  state = ""
  labels = ""
})
```

## gitlab_list_labels

List all labels for a GitLab project, including name, color, description, and open/closed issue counts..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_labels({
  project_id = ""
})
```

## gitlab_list_merge_requests

List merge requests in a GitLab project. Supports filtering by state (opened, closed, merged, all). Paginated..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `state` | string | no | Merge request state filter: opened, closed, merged, all. Default: opened. |
| `page` | integer | no | Page number for pagination. Default: 1. |
| `per_page` | integer | no | Results per page (1-100). Default: 20. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_merge_requests({
  project_id = ""
  state = ""
  page = 0
})
```

## gitlab_list_project_members

List members of a GitLab project and their access levels. Paginated..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `page` | integer | no | Page number for pagination. Default: 1. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_project_members({
  project_id = ""
  page = 0
})
```

## gitlab_list_projects

List GitLab projects visible to the authenticated user. Supports filtering by membership, search text, and pagination..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `membership` | boolean | no | Limit to projects where the user is a member. Default: false. |
| `search` | string | no | Search term to filter projects by name or path. |
| `page` | integer | no | Page number for pagination. Default: 1. |
| `per_page` | integer | no | Results per page (1-100). Default: 20. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_list_projects({
  membership = true
  search = ""
  page = 0
})
```

## gitlab_search_issues

Search for issues in a GitLab project by keyword. Searches issue titles and descriptions. Optionally filter by state..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `search` | string | yes | Search text to find in issue titles and descriptions. |
| `state` | string | no | Issue state filter: opened, closed, all. Default: opened. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_search_issues({
  project_id = ""
  search = ""
  state = ""
})
```

## gitlab_update_issue

Update an existing issue in a GitLab project. Can change title, description, labels, state (close/reopen), and assignees..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `issue_iid` | integer | yes | The project-scoped issue IID to update. |
| `title` | string | no | New title for the issue. |
| `description` | string | no | New description for the issue. Supports GitLab Markdown. |
| `labels` | string | no | Comma-separated label names. Replaces existing labels. Example:  |
| `state_event` | string | no | State transition action:  |
| `assignee_ids` | array | no | Array of user IDs to assign. Replaces existing assignees. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_update_issue({
  project_id = ""
  issue_iid = 0
  title = ""
})
```

## gitlab_update_merge_request

Update an existing merge request in a GitLab project. Can change title, description, labels, and state (close/reopen)..

### Parameters

| Name | Type | Required | Description |
|------|------|----------|-------------|
| `project_id` | string | yes | The ID or URL-encoded path of the project. |
| `mr_iid` | integer | yes | The project-scoped merge request IID to update. |
| `title` | string | no | New title for the merge request. |
| `description` | string | no | New description for the merge request. Supports GitLab Markdown. |
| `state_event` | string | no | State transition action:  |
| `labels` | string | no | Comma-separated label names. Replaces existing labels. |

### Example

```lua
local result = app.integrations.gitlab.gitlab_update_merge_request({
  project_id = ""
  mr_iid = 0
  title = ""
})
```

---

## Multi-Account Usage

If you have multiple gitlab accounts configured, use account-specific namespaces:

```lua
-- Default account (always works)
app.integrations.gitlab.function_name({...})

-- Explicit default (portable across setups)
app.integrations.gitlab.default.function_name({...})

-- Named accounts
app.integrations.gitlab.work.function_name({...})
app.integrations.gitlab.personal.function_name({...})
```

All functions are identical across accounts — only the credentials differ.
